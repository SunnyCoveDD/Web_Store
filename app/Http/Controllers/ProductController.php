<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productAddView()
    {
        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    public function productAddPost(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'manufacturer' => 'required',
           'price' => 'required',
           'category_id' => 'required',
           'photo' => 'required|file|mimes:jpg,png,bmp|max:10240',
        ]);
        $name_photo = explode('/', $request->file('photo')->store('public'))[1];
        $data = [
           'photo' => $name_photo,
        ];
        $data += $request->only('name', 'manufacturer', 'price', 'category_id');
        Product::create($data);
        return redirect()->route('admin');
    }

    public function basketView()
    {
        $sum = DB::table('purchases')
//            ->join('products', 'purchases.product_id', '=', 'products.id')
//            ->where('user_id', Auth::id())
//            ->where('status', 'В корзине')
            ->sum('purchases.sum');
        $products = Product::all();
        $purchases = Purchase::where('user_id', Auth::id())->get();
        foreach ($purchases as $purchase){
            if($purchase->status == 'Куплен'){
                $sum = null;
                break;
            }
        }
        if(Auth::user()->role_id == 1)
            return view('purchase.basket', compact('products','purchases', 'sum'));
        return redirect()->route('404');
    }

    public function basketPost(Request $request)
    {
        $purchase = Purchase::find($request->id);
        $purchase->status = 'Куплен';
        $purchase->save();
        if(Auth::user()->role_id == 1)
            return redirect()->route('acc');
        return redirect()->route('404');
    }

    public function basketDeletePost(Request $request)
    {
        Purchase::find($request->id)->delete();
        $products = Product::all();
        $purchases = Purchase::where('user_id', Auth::id())->get();
        if(Auth::user()->role_id == 1)
            return redirect()->route('basket', compact('products','purchases'));
        return redirect()->route('404');
    }

    public function basketCountPost(Purchase $purchase, Request $request)
    {
       //dd($request);
        $purchase = Purchase::find($purchase->id);
        $purchase->count = $request->input('count');
        $sum = $purchase->count;
        $product = Product::find($purchase->product_id);
        $product_price = $product->price;
        $purchase->sum = $product_price*$sum;
        $purchase->save();
        $products = Product::all();
        $purchases = Purchase::where('user_id', Auth::id())->get();
        if(Auth::user()->role_id == 1)
            return redirect()->route('basket', compact('products','purchases'));
        return redirect()->route('404');
    }
}
