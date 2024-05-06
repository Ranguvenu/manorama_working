<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Checkout\CreateRequest as CheckoutRequest;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\PackagePricing;
use App\Services\Ecommerce\CheckoutService;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function order(PackagePricing $variation, CheckoutRequest $request)
    {
        $service = new CheckoutService($variation);
        $response = $service->create_order($request->validated());

        return response()->json($response, 200);
    }

    public function process()
    {
        return view('paymentgateway.razorpay');
    }

    public function cancel(Request $request)
    {
        $order = Order::where('reference_key', $request->get('order'))->first();
        $order->status = 2;
        $order->save();

        $order->notes()->create([
            'note' => 'Payment Cancelled by user',
        ]);

        return redirect()->route('checkout.cancelled', ['package' => $order->package->slug, 'order' => $order->order_key]);
    }

    public function verify(Request $request)
    {
        $input = $request->all();

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $service = new CheckoutService();
                if ($request->get('status') == 'success') {
                    $response = $service->fetch_payment($input['razorpay_payment_id']);
                    $order = Order::where('reference_key', $response['order_id'])->first();
                    $service->set_order($order);
                    $service->payment_success($response);

                    return redirect()->route('checkout.complete', ['package' => $order->package->slug, 'order' => $order->order_key, 'status' => 'success']);
                } elseif ($request->get('status') == 'failed') {
                    $order = Order::where('reference_key', $request->get('razorpay_order_id'))->first();
                    $service->set_order($order);
                    $service->payment_pending($request->all());

                    return redirect()->route('checkout.complete', ['package' => $order->package->slug, 'order' => $order->order_key, 'status' => 'success']);
                }
            } catch (Exception $e) {
                return redirect()->back();
            }
        }

        return redirect()->back();
    }
}
