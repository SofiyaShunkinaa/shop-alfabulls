<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatisticController extends Controller {

    /**
     * Показывает Страницу статистики
     */
    public function index() {
        // За все время
        $orders = Order::all();
        $totalAmountAll = $orders->sum('amount');
        $averageCheckAll = $orders->avg('amount');

        // За последние 7 дней
        $endDate = Carbon::now()->endOfDay();
        $startDate = Carbon::now()->subDays(6)->startOfDay(); // 6 дней назад + сегодня = 7

        $filteredOrders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalAmountFiltered = $filteredOrders->sum('amount');
        $averageCheckFiltered = $filteredOrders->avg('amount');

        // Группировка заказов по дате
        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(amount) as revenue, AVG(amount) as average')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Массивы для графика
        $labels = [];
        $ordersData = [];
        $revenueData = [];
        $averageData = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $label = $date->translatedFormat('d M');
            $labels[] = $label;

            $dayData = $dailyOrders->firstWhere('date', $formattedDate);

            $ordersData[] = $dayData ? (int)$dayData->orders : 0;
            $revenueData[] = $dayData ? (float)$dayData->revenue : 0;
            $averageData[] = $dayData ? round((float)$dayData->average, 2) : 0;
        }

            // Получаем категории
        $categories = Category::where('archived', false)->get();

        $categorySums = [];

        foreach ($categories as $category) {
            $categorySums[$category->name] = 0; // ключ — имя категории
        }

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                if ($item->product && $item->product->category) {
                    $categoryName = $item->product->category->name;
                    $categorySums[$categoryName] += $item->price * $item->quantity;
                }
            }
        }

        $products = Product::paginate(10);

        $soldCounts = OrderItem::with('product')
        ->get()
        ->groupBy('product_id')
        ->map(function ($items) {
            return $items->sum('quantity');
        });

        return view('admin.statistic.index', [
            'orders' => $orders,
            'totalAmount' => $totalAmountAll,
            'averageCheck' => $averageCheckAll,
            'totalAmountFiltered' => $totalAmountFiltered,
            'averageCheckFiltered' => $averageCheckFiltered,
            'filteredOrders' => $filteredOrders,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'chartLabels' => $labels,
            'chartOrders' => $ordersData,
            'chartRevenue' => $revenueData,
            'chartAverage' => $averageData,
            'categorySums' => $categorySums,
            'products' => $products,
            'soldCounts' => $soldCounts,
            'categories' => $categories
        ]);
    }

    public function filter(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $categoryId = $request->input('category');

        $range = $request->input('timerange');

        if($range != false){
            $to = Carbon::now()->endOfDay();

            switch ($range) {
                case 'week':
                    $from = Carbon::now()->subDays(6)->startOfDay();
                    break;
                case 'month':
                    $from = Carbon::now()->subDays(29)->startOfDay();
                    break;
                case 'year':
                    $from = Carbon::now()->subYear()->startOfDay();
                    break;                
            }
        }

        // Найдём ID заказов по категории, если выбрана
        $orderIds = null;

        if ($categoryId) {
            $orderIds = OrderItem::query()
                ->whereHas('product', function ($query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                })
                ->pluck('order_id')
                ->unique()
                ->toArray();
        }

        $orders = Order::query();

        if ($from) {
            $orders->whereDate('created_at', '>=', $from);
        }

        if ($to) {
            $orders->whereDate('created_at', '<=', $to);
        }

        if ($orderIds !== null) {
            $orders->whereIn('id', $orderIds);
        }

        $filteredOrders = $orders->get();

        // Вычисляем метрики
        $totalAmount = $filteredOrders->sum('amount');

        // Считаем прибыль как сумму всех order_item.cost
        $netProfit = 0;

        if ($filteredOrders->count() > 0) {
            $netProfit = OrderItem::whereIn('order_id', $filteredOrders->pluck('id'))
                ->sum('cost');
        }

        $averageCheck = $filteredOrders->count() > 0
            ? $totalAmount / $filteredOrders->count()
            : 0;

        return response()->json([
            'ordersCount' => $filteredOrders->count(),
            'totalAmount' => number_format($totalAmount, 2, ',', ' '),
            'netProfit' => number_format($totalAmount, 2, ',', ' '),
            'averageCheck' => number_format($averageCheck, 2, ',', ' ')
        ]);
    }


public function chartData(Request $request)
{
    $range = $request->input('range', 'all'); // теперь 'all' — по умолчанию
    $endDate = Carbon::now()->endOfDay();

    switch ($range) {
        case 'week':
            $startDate = Carbon::now()->subDays(6)->startOfDay();
            $format = 'l'; // Понедельник и т.д.
            break;

        case 'month':
            $startDate = Carbon::now()->subDays(29)->startOfDay();
            $format = 'd M'; // 01 Май
            break;

        case 'year':
            $startDate = Carbon::now()->subYear()->startOfMonth();
            $format = 'F'; // Январь
            break;

        case 'all':
        default:
            $startDate = Order::min('created_at') ?? Carbon::now(); // fallback: now
            $format = 'd M Y'; // Полная дата
            break;
    }

    $isYear = $range === 'year';
    $isAll = $range === 'all';

    $dailyOrders = Order::selectRaw(
        $isYear || $isAll
            ? 'DATE_FORMAT(created_at, "%Y-%m") as period, COUNT(*) as orders, SUM(amount) as revenue, AVG(amount) as average'
            : 'DATE(created_at) as period, COUNT(*) as orders, SUM(amount) as revenue, AVG(amount) as average'
    )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('period')
        ->orderBy('period')
        ->get()
        ->keyBy('period');

    $labels = [];
    $ordersData = [];
    $revenueData = [];
    $averageData = [];

    if ($isYear || $isAll) {
        for ($date = Carbon::parse($startDate); $date <= $endDate; $date->addMonth()) {
            $key = $date->format('Y-m');
            $labels[] = $date->translatedFormat($format);
            $day = $dailyOrders->get($key);

            $ordersData[] = $day ? (int)$day->orders : 0;
            $revenueData[] = $day ? (float)$day->revenue : 0;
            $averageData[] = $day ? round((float)$day->average, 2) : 0;
        }
    } else {
        for ($date = Carbon::parse($startDate); $date <= $endDate; $date->addDay()) {
            $key = $date->format('Y-m-d');
            $labels[] = $date->translatedFormat($format);
            $day = $dailyOrders->get($key);

            $ordersData[] = $day ? (int)$day->orders : 0;
            $revenueData[] = $day ? (float)$day->revenue : 0;
            $averageData[] = $day ? round((float)$day->average, 2) : 0;
        }
    }

    return response()->json([
        'labels' => $labels,
        'orders' => $ordersData,
        'revenue' => $revenueData,
        'average' => $averageData,
    ]);
}

public function pieData(Request $request)
{
    $range = $request->input('range', 'all');
    $endDate = Carbon::now()->endOfDay();

    switch ($range) {
        case 'week':
            $startDate = Carbon::now()->subDays(6)->startOfDay();
            break;
        case 'month':
            $startDate = Carbon::now()->subDays(29)->startOfDay();
            break;
        case 'year':
            $startDate = Carbon::now()->subYear()->startOfDay();
            break;
        case 'all':
        default:
            $startDate = Order::min('created_at') ?? Carbon::now();
            break;
    }

    $orders = Order::with('items.product.category')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    $categorySums = [];

    foreach ($orders as $order) {
        foreach ($order->items as $item) {
            if ($item->product && $item->product->category) {
                $name = $item->product->category->name;
                $categorySums[$name] = ($categorySums[$name] ?? 0) + $item->price * $item->quantity;
            }
        }
    }

    return response()->json($categorySums);
}

public function remains(Request $request)
{
    $query = Product::query();

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->status === 'available') {
        $query->where('col', '>', 400);
    } elseif ($request->status === 'low') {
        $query->where('col', '<=', 400);
    }

    $products = $query->paginate(10)->appends($request->all());

    //dd($products);

    // Предполагаем, что soldCounts вы получаете где-то отдельно
    $soldCounts = OrderItem::with('product')
        ->get()
        ->groupBy('product_id')
        ->map(function ($items) {
            return $items->sum('quantity');
        });


    return view('admin.statistic.part.table-rows', compact('products', 'soldCounts'))->render();
}

    public function sources()
    {
        // В будущем можно загрузить из базы данных
        $sources = [
            [ "name" => "Телеграм канал", "value" => 2345, "percent" => 100, "color" => "green" ],
            [ "name" => "VK", "value" => 2345, "percent" => 80, "color" => "yellow" ],
            [ "name" => "Ютуб", "value" => 2345, "percent" => 95, "color" => "green" ],
            [ "name" => "Поиск в интернете", "value" => 2345, "percent" => 70, "color" => "orange" ],
            [ "name" => "Рекомендации", "value" => 2345, "percent" => 30, "color" => "red" ],
            [ "name" => "Реферальная программа", "value" => 2345, "percent" => 100, "color" => "green" ],
            [ "name" => "Контекстная реклама", "value" => 2345, "percent" => 75, "color" => "orange" ],
            [ "name" => "VC", "value" => 2345, "percent" => 60, "color" => "yellow" ],
            [ "name" => "Остальные источники", "value" => 2345, "percent" => 25, "color" => "red" ],
        ];

        return response()->json($sources);
    }


}
