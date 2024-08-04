<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Voucher;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\Client\OrderPlacedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PlaceOrderRequest;
use App\Models\Product;

class OrderController extends Controller
{
    public function placeOrder(PlaceOrderRequest $request)
    {
        $params = $request->all();
        $params['status_id'] = 1;
        // $params['order_number'] = $this->generateUniqueOrderNumber();
        do {
            $order_number = $this->generateNumericOrderNumber();
        } while (Order::where('order_number', $order_number)->exists());

        $params['order_number'] = $order_number;
        $params['user_id'] = Auth::user()->id;
        $voucher = Voucher::find($request->voucher_id);

        if (!$voucher || $voucher->status !== 'active' || $voucher->limit < 1) {
            toastr()->warning('Mã giảm giá không khả dụng');

            return redirect(route('cart'));
        }

        $order = Order::create($params);
        $voucher->update([
            'limit' => $voucher->limit - 1,
        ]);

        $products = json_decode($request->products);

        $orderDetails = [];

        foreach ($products as $product) {
            $orderDetails[] = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $product->quantity_cart,
                'price' => $product->price_sale,
            ];
            Product::find($product->id)->update(['quantity' => $product->quantity - 1]);
            Cart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->delete();
        }

        OrderDetail::insert($orderDetails);

        Mail::to(Auth::user()->email)->queue(new OrderPlacedMail($order));

        toastr()->success('Đơn hàng đã được tạo thành công!');

        return redirect()->route('shop');
    }

    // private function generateUniqueOrderNumber($length = 10)
    // {
    //     do {
    //         $orderNumber = $this->generateNumericOrderNumber($length);
    //     } while ($this->orderNumberExists($orderNumber));

    //     return $orderNumber;
    // }

    private function generateNumericOrderNumber($length = 10)
    {
        $numbers = '0123456789';
        $numbersLength = strlen($numbers);
        $randomNumber = '';

        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $numbers[rand(0, $numbersLength - 1)];
        }

        return $randomNumber;
    }

    // private function orderNumberExists($orderNumber)
    // {
    //     return DB::table('orders')->where('order_number', $orderNumber)->exists();
    // }
}
