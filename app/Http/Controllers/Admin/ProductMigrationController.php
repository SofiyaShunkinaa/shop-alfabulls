<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class ProductMigrationController extends Controller
{
    public function migrate()
    {
        $products = Product::all();
        $migrated = 0;

        foreach ($products as $product) {
            // Пропускаем, если уже есть варианты
            if ($product->variants()->exists()) {
                continue;
            }

            DB::beginTransaction();

            try {
                // Создаем вариант товара
                $variant = $product->variants()->create([
                    'weight'   => $product->weight,
                    'price'    => $product->price,
                    'oldprice' => $product->oldprice,
                    'length'   => $product->depth,
                    'width'    => $product->width,
                    'height'   => $product->height,
                    'stock'    => $product->col,
                ]);

                // Если есть главное изображение — добавим его
                if (!empty($product->image)) {
                    $variant->images()->create([
                        'path' => $product->image,
                    ]);
                }

                $migrated++;
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                report($e);
            }
        }

        return response()->json([
            'status' => 'done',
            'migrated_products' => $migrated,
        ]);
    }
}