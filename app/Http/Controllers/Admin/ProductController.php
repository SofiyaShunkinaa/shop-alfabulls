<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCatalogRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показывает список всех товаров
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // vis - true = archived - false
        $showArchived = $request->get('archived', true);

        $products = Product::where('vis', $showArchived)->paginate(5);
        
        $roots = Category::where('parent_id', 0)->where('archived', false)->get();
        $items = Category::where('archived', false)->get();
        $brands = Brand::all();

        if ($request->ajax()) {
            return view('admin.product.part.table-rows', compact('products', 'roots', 'brands', 'items', 'showArchived'));
        }

        return view('admin.product.index', compact('products', 'roots', 'brands', 'items', 'showArchived'));
    }
    
    public function searchProduct(Request $request)
    {
        $query = $request->input('name');
        $showArchived = $request->get('archived', false);
        $categoryId = $request->get('category_id');

        $items = Category::where('archived', false)->get();
        $brands = Brand::all();

        $productsQuery = Product::where('vis', $showArchived);

        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }

        if ($query) {
            $productsQuery->where('name', 'like', '%' . $query . '%');
        }

        $products = $productsQuery->paginate(5)->appends([
            'name' => $query,
            'archived' => $showArchived,
            'category_id' => $categoryId,
        ]);

        
            return view('admin.product.part.table-rows', compact('products', 'brands', 'items', 'showArchived'))->render();
        

        // Обычный возврат для полной страницы
        //return view('admin.product.index', compact('products', 'brands', 'items', 'showArchived'));
    }



    /**
     * Показывает товары категории
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Request $request, Category $category) {
        
        $showArchived = $request->get('archived', true);

        $products = Product::where('vis', $showArchived)->where('category_id', $category->id)->paginate(5);
        $roots = Category::where('parent_id', 0)->where('archived', false)->get();
        $items = Category::where('archived', false)->get();
        $brands = Brand::all();

        if ($request->ajax()) {
            return view('admin.product.part.table-rows', compact('products', 'brands', 'items', 'showArchived'));
        }

        return view('admin.product.category', compact('category', 'products', 'roots', 'brands', 'items', 'showArchived'));
    }

    /**
     * Показывает форму для создания товара
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // все категории для возможности выбора родителя
        $categories = Category::where('archived', false)->get();
        // все бренды для возмозжности выбора подходящего
        $brands = Brand::all();
        $product = new Product();
        
        return view('admin.product.create', compact('categories', 'brands', 'product'));
    }

    /**
     * Сохраняет новый товар в базу данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCatalogRequest $request)
{
    $request->merge([
        'new' => $request->has('new'),
        'hit' => $request->has('hit'),
        'sale' => $request->has('sale'),
    ]);

    $data = $request->except(['images', 'variant']); // исключаем вложенные данные

    // Главное изображение (если нужно)
    if ($request->hasFile('image')) {
        $data['image'] = $this->imageSaver->upload($request, null, 'product');
    }

    // Создание продукта
    $product = Product::create($data);

    //Костыль
    $product->brand = 1;
    $product->price = 0;
    //Костыль END

    // Привязка категории (одна)
    if ($request->filled('category_id')) {
        //$product->categories()->sync([$request->input('category_id')]);
    }

    // Обработка вариантов
    $variants = $request->input('variant', []);
    $variantCount = count($variants['weight'] ?? []);

    for ($i = 0; $i < $variantCount; $i++) {
        $variantData = [
            'product_id'   => $product->id,
            'weight'       => $variants['weight'][$i] ?? null,
            'price'        => $variants['price'][$i] ?? null,
            'oldprice'    => $variants['old_price'][$i] ?? null,
            'cost'         => $variants['cost'][$i] ?? null,
            'discount'     => $variants['discount'][$i] ?? null,
            'size'         => $variants['size'][$i] ?? null,
            'stock'        => $variants['stock'][$i] ?? null,
            'length'       => $variants['length'][$i] ?? null,
            'width'        => $variants['width'][$i] ?? null,
            'height'       => $variants['height'][$i] ?? null,
            'net_weight'   => $variants['net_weight'][$i] ?? null,
        ];
        

        $productVariant = $product->variants()->create($variantData);

        // Загрузка изображений для этого варианта
        if ($request->hasFile("images.$i")) {
            foreach ($request->file("images.$i") as $file) {
                $filename = $file->getClientOriginalName();
                //$path = $file->storeAs('/storage/catalog/product/source/',$filename, 'public');
                $path = $file->storeAs('catalog/product/source', $filename, 'public');


                $productVariant->images()->create([
                    'path' => $filename,
                ]);
            }
        }
    }

    return redirect()
        ->route('admin.product.index')
        ->with('success', 'Новый товар успешно создан');
}


    /**
     * Показывает страницу товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Показывает форму для редактирования товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {
        // все категории для возможности выбора родителя
        $product->load('variants.images'); // загружаем варианты и их изображения
        $categories = Category::where('archived', false)->get();
        // все бренды для возмозжности выбора подходящего
        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Обновляет товар каталога в базе данных
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCatalogRequest $request, Product $product)
    {
        // Обработка чекбоксов (new, hit, sale)
        $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);

        $data = $request->except(['images', 'variant']);
        $existingImages = $request->input('existing_images', []);

        // Обновление главного изображения
        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $this->imageSaver->upload($request, null, 'product');
        }

        // Обновление товара
        $product->update($data);

        // === Обработка вариантов ===
        $variants = $request->input('variant', []);
        $variantIds = $variants['id'] ?? []; // массив ID вариантов
        $currentVariantIds = $product->variants()->pluck('id')->toArray();
        $incomingIds = array_filter($variantIds); // существующие ID
        $variantsToDelete = array_diff($currentVariantIds, $incomingIds);

        // Удаление вариантов, не пришедших в запросе
        \App\Models\ProductVariant::whereIn('id', $variantsToDelete)->each(function ($variant) {
            foreach ($variant->images as $image) {
                \Storage::disk('public')->delete($image->path);
            }
            $variant->images()->delete();
            $variant->delete();
        });

        // Обработка новых и обновлённых вариантов
        $count = count($variants['weight'] ?? []);
        for ($i = 0; $i < $count; $i++) {
            $variantData = [
                'product_id'   => $product->id,
                'weight'       => $variants['weight'][$i] ?? null,
                'price'        => $variants['price'][$i] ?? null,
                'oldprice'     => $variants['old_price'][$i] ?? null,
                'cost'         => $variants['cost'][$i] ?? null,
                'discount'     => $variants['discount'][$i] ?? null,
                'size'         => $variants['size'][$i] ?? null,
                'stock'        => $variants['stock'][$i] ?? null,
                'length'       => $variants['length'][$i] ?? null,
                'width'        => $variants['width'][$i] ?? null,
                'height'       => $variants['height'][$i] ?? null,
                'net_weight'   => $variants['net_weight'][$i] ?? null,
            ];

            $variantId = $variantIds[$i] ?? null;
            

            if ($variantId) {
                // обновляем
                $variant = $product->variants()->find($variantId);
                
                if ($variant) {
                    $variant->update($variantData);

                    $existingImageIds = $existingImages[$i] ?? [];
                    // Удаляем старые изображения (и файлы, и записи)
                    foreach ($variant->images as $image) {
                        if (!in_array($image->id, $existingImageIds)) {
                            \Storage::disk('public')->delete('catalog/product/source/' . $image->path);
                            $image->delete();
                        }
                    }
                    

                    // Сохраняем новые изображения (если пришли)
                    if ($request->hasFile("images.$i")) {
                        foreach ($request->file("images.$i") as $file) {
                            $filename = $file->getClientOriginalName();
                            $file->storeAs('catalog/product/source', $filename, 'public');

                            $variant->images()->create([
                                'path' => $filename,
                            ]);
                        }
                    }

                }
            } else {
                // создаём
                $variant = $product->variants()->create($variantData);
            }

            // Загрузка новых изображений
            // if ($request->hasFile("images.$i")) {
            //     foreach ($request->file("images.$i") as $file) {
            //         $filename = $file->getClientOriginalName();
            //         //$path = $file->storeAs('/storage/catalog/product/source/', $filename, 'public');
            //         $path = $file->storeAs('catalog/product/source', $filename, 'public');

            //         $variant->images()->create([
            //             'path' => $filename,
            //         ]);
            //     }
            // }
        }

        return redirect()
            ->route('admin.product.edit', $product->id)
            ->with('success', 'Товар успешно обновлён');
    }

    /**
     * Удаляет товар каталога из базы данных
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        $this->imageSaver->remove($product, 'product');
        $product->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Товар каталога успешно удален');
    }

    public function archive(Product $product)
    {
        $product->vis = !$product->vis;
        $product->save();

        return redirect()->back()->with('success', 'Товар обновлён.');
    }

}
