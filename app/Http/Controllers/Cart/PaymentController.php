<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Servics\Cart\Cart;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as shetabitPayment;


class PaymentController extends Controller
{
    public function payment()
    {
        $cart = Cart::all();
        if ($cart->count())
        {
            $price = $cart->sum(function ($item){
                return $item['plan']->price;
            });
            $order = auth()->user()->orders()->create([
                'status' => 'unpaid' ,
                'price' => $price
            ]);

            $order_items = $cart->mapWithKeys(function ($item){
               return [$item['plan']->id => ['quantity' => 1]];
            });

            $order->plans()->attach($order_items);

            // به جای 1000 باید price را قرار دهیم چون الان در حالت تست هستیم همان 1000 را می نویسیم
            $invoice = (new Invoice)->amount(1000);
            // Purchase and pay the given invoice.
            // You should use return statement to redirect user to the bank page.
            return shetabitPayment::callbackUrl(route('Payment_Callback'))->purchase($invoice, function($driver, $transactionId) use ($order , $cart , $invoice) {
                $order->payments()->create([
                   'resnumber' => $invoice->getUuid()
                ]);
                $cart->flush();
            })->pay()->render();



            //here code payment
//            return 'hale meraz';
        }
        //alert ->show error message
        return back();
    }

    public function Payment_Callback(Request $request)
    {
        return $request->all();
    }
}
