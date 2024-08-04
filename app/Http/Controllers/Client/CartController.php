<?php

namespace App\Http\Controllers\Client;

use App\Models\{
    User,
    Product,
    Cart,
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $title = "Cart";

        return view('Client.cart', compact('title'));
    }
    public function addToCart(Request $request)
    {
        if ($request->isMethod("POST")) {
            $product = Product::find($request->idProduct);
            $user = User::find($request->idUser);

            if ($product && $user) {
                $cart = Cart::where('product_id', $request->idProduct)
                    ->where('user_id', $request->idUser)
                    ->first();

                if ($cart) {
                    $cart->quantity += 1;
                    $cart->save();

                    return response()->json(['success' => true, 'message' => "Sản phẩm đã tồn tại trong giỏ hàng và số lượng đã được cập nhật"]);
                }

                Cart::create([
                    'product_id' => $request->idProduct,
                    'user_id' => $request->idUser,
                    'quantity' => 1
                ]);

                return response()->json(['success' => true, 'message' => "Sản phẩm đã được thêm vào giỏ hàng"]);
            }

            return response()->json(['success' => false]);
        }

    }
    public function getCart(Request $request)
    {
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Người dùng không tồn tại'], 404);
        }

        $cart = Cart::where('user_id', $request->id)->get();
        foreach ($cart as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $item->product = $product;
            }
        }

        return response()->json(['success' => true, 'cart' => $cart]);
    }
    public function updateCart(Request $request)
    {
        $cart = Cart::where('product_id', $request->id)->where('user_id', $request->idUser)->first();

        if ($cart) {
            $cart->update([
                'quantity' => $request->quantity,
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function deleteCart(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function saveCart(Request $request)
    {
        session()->put('cart', $request->cart_items);
        session()->put('cart_total', $request->cart_total);
        session()->put('voucher_value', $request->voucher_value);
        session()->put('voucher', $request->voucher);
        session()->put('subtotal', $request->subtotal);

        return redirect()->route('checkout');
    }

}
