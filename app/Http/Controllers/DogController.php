<?php
namespace App\Http\Controllers;

use App\Models\Dogs;
use Illuminate\Http\Request;

class DogController extends Controller {
    public function __invoke(Request $request) {
       $products = Dogs::with('media')->get();
        return view('dogs', compact('products'));
    }
}
