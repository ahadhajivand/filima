<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Servics\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cart()
    {
        $carts = Cart::all();
        return view('home.cart.cart' , compact('carts'));
    }

    public function AddToCart(Plan $plan)
    {

        $carts = Cart::all();
        if ($carts->count() != 0)
        {
            //   here write سبد خرید شما یک پنل اشتراک بیشتر نمی پذیرد
            return back();
        }
        elseif($carts->count() == 0)
        {
            if (! Cart::has($plan))
            {
                Cart::put([
                    'price' => $plan->price ,
                    'month' => $plan->time_month
                ] , $plan);
            }
            // here write پنل اشتراک به سبد خرید شما اضافه شد
            return redirect(route('cart'));
        }
    }

    public function delete(Plan $plan)
    {
        Cart::delete($plan);
        return back();
    }

}
