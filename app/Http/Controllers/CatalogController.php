<?php

namespace App\Http\Controllers;

use App\Helpers\ProductFilter;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller {
    public function index() {
        $roots = Category::where('parent_id', 0)->where('archived', false)->get();
        $brands = Brand::popular();
        $products = Product::where('vis', 1)->get();
        return view('catalog.index', compact('roots', 'brands', 'products'));
    }

    public function category(Category $category, ProductFilter $filters) {
        $roots = Category::where('parent_id', 0)->get();
        $children = Category::where('parent_id', $category->id)->get();
        $products = Product::where('category_id', $category->id)->get();
       /* $products = Product::categoryProducts($category->id)
            ->filterProducts($filters)
            ->paginate(0)
            ->withQueryString();*/
        return view('catalog.category', compact('category', 'products', 'roots', 'children'));
    }

    public function brand(Brand $brand, ProductFilter $filters) {
        $products = $brand
            ->products() // возвращает построитель запроса
            ->filterProducts($filters)
            ->paginate(6)
            ->withQueryString();
        return view('catalog.brand', compact('brand', 'products'));
    }

    public function product(Product $product) {
        
        $category = Category::where('id',$product->category_id)->get();
        
        return view('catalog.product', compact('product','category'));
    }

    public function search(Request $request) {
        $search = $request->input('query');
        $query = Product::search($search);
        $products = $query->paginate(6)->withQueryString();
        return view('catalog.search', compact('products', 'search'));
    }
}
