<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Otzv;

class IndexController extends Controller {
    public function __invoke(Request $request) {
        $new = Product::whereNew(true)->latest()->limit(3)->get();
        $hit = Product::whereHit(true)->latest()->limit(3)->get();
        $sale = Product::whereSale(true)->latest()->limit(3)->get();

        // Жадная загрузка профиля вместе с отзывами
        $allReviews = Otzv::where('archived', false)->with('profile')->latest()->limit(20)->get();

        $photoReviews = [];
        $videoReviews = [];

        foreach ($allReviews as $review) {
            if ($review->isVideo()) {
                $videoReviews[] = $review;
            } else {
                $photoReviews[] = $review;
            }
        }

        return view('index', compact('new', 'hit', 'sale', 'photoReviews', 'videoReviews'));
    }
}
