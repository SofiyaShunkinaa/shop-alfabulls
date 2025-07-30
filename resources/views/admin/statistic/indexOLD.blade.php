@extends('layout.admin', ['title' => 'Статистика'])

@section('content')
<style>
  .time-btn {
    
    background-color: transparent;
    color: #FFFFFF;
  }

  .time-btn:hover,
  .time-btn.active {
    background-color: #2D2D2D;
    color: #FFFFFF;
  }
</style>

    <h1 class="dog-h1 mb-4">Статистика</h1>

<div class="flex items-center rounded text-white text-sm overflow-hidden w-fit py-4">
    <div class="flex items-center rounded text-white text-sm overflow-hidden w-fit" style="border: 1px solid #BCBCBC; border-radius: 6px;">
        <button class="px-4 py-2 border-r font-semibold focus:outline-none time-btn" data-range="week">
            Неделя
        </button>
        <button class="px-4 py-2 border-r focus:outline-none time-btn" data-range="month">
            Месяц
        </button>
        <button class="px-4 py-2 focus:outline-none time-btn" data-range="year">
            Год
        </button>
    </div>
</div>

  <div class="grid grid-cols-4 gap-4 mb-4">
    <div class="bg-purple-500 p-4 rounded">Общее число заказов<br><span class="text-2xl font-bold"> {{ $orders->count() }}</span></div>
    <div class="bg-green-500 p-4 rounded">Выручка<br><span class="text-2xl font-bold">{{ number_format($totalAmount, 2, ',', ' ') }}</span></div>
    <div class="bg-teal-400 p-4 rounded">Чистая прибыль<br><span class="text-2xl font-bold">{{ number_format($totalAmount, 2, ',', ' ') }}</span></div>
    <div class="bg-blue-400 p-4 rounded">Средний чек<br><span class="text-2xl font-bold">{{ number_format($averageCheck, 2, ',', ' ') }}</span></div>
  </div>

  <div class="grid gap-4 mb-4">
    <div class="table-con p-4 rounded">
      <canvas id="ordersChart" height="100"></canvas>
        <div class="flex gap-4 my-4 justify-center">
        <div id="btn-orders" class="bg-purple-500 p-2 rounded cursor-pointer">Число заказов</div>
        <div id="btn-revenue" class="bg-yellow-500 p-2 rounded cursor-pointer">Стоимость заказов</div>
        <div id="btn-profit" class="bg-green-500 p-2 rounded cursor-pointer">Чистая прибыль</div>
        <div id="btn-average" class="bg-blue-500 p-2 rounded cursor-pointer">Средний чек</div>
        </div>
    </div>
  </div>

    <div class="grid grid-cols-2 gap-4 mb-4">


    <div class="table-con p-4 rounded" style="height: fit-content;">
      <h2 class="text-lg font-semibold mb-2">Структура доходов</h2>
      <canvas id="incomePie" height="100"></canvas>
      <div id="customLegend" class="mt-4"></div>
    </div>

  <div class="table-con p-4 rounded" style="height: fit-content;">
    <h2 class="text-lg font-semibold mb-2">Остатки</h2>
    <table class="w-full text-left table-bordered">
      <thead class="table-header">
        <tr style="background-color: #9A9A9A;">
          <th class="table-cell">Наименование товара</th>
          <th class="table-cell">Продано</th>
          <th class="table-cell">Остаток шт</th>
          <th class="table-cell">Статус</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr class="border-t border-gray-700 table-row">
          <td class="table-cell">{{ $product->name }}</td>
          <td class="table-cell">{{ $soldCounts[$product->id] ?? 0 }}</td>
          <td class="table-cell">{{ $product->col }}</td>
          @if ($product->col <= 400)
            <td style="white-space: nowrap;" class="table-cell"><span class="bg-red-500 px-2 py-1 rounded text-xs">Заканчивается</span></td>
            @else
            <td style="white-space: nowrap;" class="table-cell"><span class="bg-green-500 px-2 py-1 rounded text-xs">В наличии</span></td>
          @endif
          
        </tr>
        @endforeach
      </tbody>
    </table>
@if ($products->links())
    <div class="py-6">
        <div class="max-w-full overflow-x-auto">
            <div class="inline-block min-w-full">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endif
  </div>
  </div>

<script>
let currentRange = 'all';

function createLineChart(ctx, labels, dataset) {
  return new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [dataset]
    },
    options: {
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { color: '#FFFFFF' }
        },
        x: {
          ticks: { color: '#FFFFFF' }
        }
      }
    }
  });
}

function createDoughnutChart(ctx, labels, data) {
  return new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: generateColors(data.length)
      }]
    },
    options: {
      plugins: { legend: { display: false } }
    }
  });
}

function generateColors(count) {
  const baseColors = ['#FFDD00', '#10EA00', '#FF9500', '#FF00E5', '#00FF77', '#AE00FF', '#FF0000', '#7B00FF'];
  return Array.from({ length: count }, (_, i) => baseColors[i % baseColors.length]);
}

// Основной график
const ctx = document.getElementById('ordersChart').getContext('2d');
let chart = createLineChart(ctx, {!! json_encode($chartLabels) !!}, {
  label: 'Стоимость заказов',
  data: {!! json_encode($chartRevenue) !!},
  borderColor: '#FFC800'
});
let currentKey = 'revenue';

// Пирог
const pieCtx = document.getElementById('incomePie').getContext('2d');
let pieChart = createDoughnutChart(pieCtx, Object.keys({!! json_encode($categorySums) !!}), Object.values({!! json_encode($categorySums) !!}));
createCustomLegend(pieChart, 'customLegend');

// Обновление line-графика
function updateDataset(key) {
  currentKey = key;

  fetch(`/admin/chartData?range=${currentRange}`)
    .then(res => res.json())
    .then(data => {
      const colorMap = {
        orders: '#A855F7',
        revenue: '#FFC800',
        average: '#3B82F6',
        profit: '#22C55E'
      };

      chart.data.labels = data.labels;
      chart.data.datasets = [{
        label: getLabel(key),
        data: data[key],
        borderColor: colorMap[key]
      }];
      chart.update();

      document.querySelectorAll('.chart-btn').forEach(btn => btn.classList.remove('opacity-100', 'ring'));
      const btn = document.getElementById(`btn-${key}`);
      if (btn) btn.classList.add('opacity-100', 'ring', 'ring-white');
    });
}

// Получение label по ключу
function getLabel(key) {
  return {
    orders: 'Число заказов',
    revenue: 'Стоимость заказов',
    profit: 'Чистая прибыль',
    average: 'Средний чек'
  }[key];
}

// Обновление пирога
function updatePieChart(range) {
  fetch(`/admin/pieData?range=${range}`)
    .then(res => res.json())
    .then(data => {
      pieChart.data.labels = Object.keys(data);
      pieChart.data.datasets[0].data = Object.values(data);
      pieChart.data.datasets[0].backgroundColor = generateColors(Object.keys(data).length);
      pieChart.update();
      createCustomLegend(pieChart, 'customLegend');
    });
}

// Обработчики переключения метрик
['orders', 'revenue', 'profit', 'average'].forEach(key => {
  const btn = document.getElementById(`btn-${key}`);
  if (btn) {
    btn.classList.add('chart-btn');
    btn.addEventListener('click', () => updateDataset(key));
  }
});

// Обработчики переключения диапазона
document.querySelectorAll('.time-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    currentRange = btn.dataset.range;

    document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('bg-white', 'text-black', 'font-semibold'));
    btn.classList.add('bg-white', 'text-black', 'font-semibold');

    updateDataset(currentKey);
    updatePieChart(currentRange);
  });
});

// Легенда для пирога
function createCustomLegend(chart, containerId) {
  const container = document.getElementById(containerId);
  container.innerHTML = '';

  const ul = document.createElement('ul');
  ul.style.listStyle = 'none';
  ul.style.padding = '0';
  ul.style.margin = '0';
  ul.style.display = 'grid';
  ul.style.gap = '0 20px';
  ul.style.gridTemplateColumns = '1fr 1fr';

  chart.data.labels.forEach((label, i) => {
    const li = document.createElement('li');
    li.style.display = 'flex';
    li.style.alignItems = 'center';
    li.style.marginBottom = '8px';

    const colorBox = document.createElement('span');
    colorBox.style.display = 'inline-block';
    colorBox.style.width = '20px';
    colorBox.style.height = '20px';
    colorBox.style.backgroundColor = chart.data.datasets[0].backgroundColor[i];
    colorBox.style.marginRight = '10px';
    colorBox.style.borderRadius = '3px';

    const text = document.createElement('span');
    text.textContent = label;
    text.style.flex = '1';
    text.style.textAlign = 'left';
    text.style.color = '#FFFFFF';
    text.style.fontSize = '14px';

    li.appendChild(colorBox);
    li.appendChild(text);
    ul.appendChild(li);
  });

  container.appendChild(ul);
}

// Стартовая инициализация
updateDataset('revenue');
updatePieChart(currentRange);
</script>

@endsection


