<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function accountView()
    {    $sum = DB::table('purchases')
//        ->join('products', 'purchases.product_id', '=', 'products.id')
//        ->where('user_id', Auth::id())
//        ->where('status', 'В корзине')
            ->sum('purchases.sum');

        /*
         * select sum(products.`price` * purchases.count)
         * from purchases
         * join products
         *      on purchases.product_id = products.id
         * where user_id = 2
         * */

        $products = Product::all();
        $purchases = Purchase::where('user_id', Auth::id())->get();
        foreach ($purchases as $purchase){
            if($purchase->status == 'В корзине'){
                $sum = null;
                break;
            }
        }
        if(Auth::user()->role_id == 1)
            return view('users.account', compact('products','purchases', 'sum'));
        return redirect()->route('404');
    }

    public function adminView()
    {
        $products = Product::all();
        return view('admin.admin_shop', compact('products'));
    }

    public function registrationView()
    {
        return view('users.registration');
    }

    public function registrationPost(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'login' => 'required|unique:users',
           'password' => 'required|confirmed',
           'success' => 'required',
        ]);
        $request->merge(['password' => Hash::make($request->password)]);
        User::create($request->all());
        return redirect()->route('auth')->with(['success' => 'Операция регистрации успешна!']);
    }

    public function authorizationView()
    {
        return view('users.authorization');
    }

    public function authorizationPost(Request $request)
    {
        $request->validate([
           'login' => 'required',
           'password' => 'required',
        ]);
        if(Auth::attempt($request->only('login', 'password'))){
            $request->session()->regenerate();
            if(Auth::user()->role_id == 2)
                return redirect()->route('admin');
            return redirect()->route('acc');
        }
        return back()->with(['errorLogin' => 'Неверный логин или пароль']);
    }

    public function logout()
    {
        Auth()->logout();
        return redirect()->route('auth');
    }
}
