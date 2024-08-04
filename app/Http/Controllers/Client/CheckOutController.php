<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Voucher;

class CheckOutController extends Controller
{
    public function checkOut()
    {
        $title = "Check Out";
        $cartJson = session()->get('cart', []);

        if (empty($cartJson)) {
            return redirect()->route('cart');
        }

        $cart = is_string($cartJson) ? json_decode($cartJson, true) : $cartJson;

        if (!is_array($cart)) {
            $cart = [];
        }

        $products = [];

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                $product->quantity_cart = $item['quantity'];
                $products[] = $product;
            }
        }

        $cart_total = session()->get('cart_total', 0) ?? 0;
        $voucher_code = session()->get('voucher', null) ?? '';
        $subtotal = session()->get('subtotal', 0) ?? 0;

        $voucher = NULL;
        if($voucher_code){
            $voucher = Voucher::where('code', $voucher_code)->first();
        }


        return view('Client.check_out', compact('title', 'products', 'cart_total', 'voucher', 'subtotal'));
    }
}
