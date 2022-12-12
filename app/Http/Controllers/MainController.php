<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function mainView()
    {
        $products = Product::all();
        $purchases = Purchase::where('user_id', Auth::id())->get();
        return view('main', compact('products', 'purchases'));
    }

    public function mainPost(Product $product, Request $request)
    {
        //dd($request);
        $data = [
            'product_id' => $request->id,
            'user_id' => Auth::id(),
            'count' => 1,
            'sum' => $request->price,
        ];
        Purchase::create($data);
        return redirect()->route('/');
    }

    public function error_404()
    {
        return view('errors.error_404');
    }
}
