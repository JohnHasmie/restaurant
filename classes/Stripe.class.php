<?php

class Stripe {
    protected $stripToken;

    public function __construct($data) {
        
        $this->stripToken = $data['stripeToken'];
        \Stripe\Stripe::setApiKey('sk_test_51Ie6PpL8uWnAKjvMZ6aZwNXtiuxGyhOlUV8CXKT2JDdflqKXKyfDc96SqAzrwh92xdULc8lCX5lOMh8DSaM2vRzl00W5fOmfHN');
    }

    public function processPayment($orders) {
        $order = $orders[0];
        $stripToken = $this->stripToken;
        
        \Stripe\Charge::create ([
            "amount" => round($order->grand_total)*100,
            "currency" => 'USD',
            "source" => $stripToken,
            "description" => "Test payment from click and collect." 
        ]);
        
        $orderClass = new Order;
        $orderClass->payOrder($order->order_number, 'Stripe-'.$order->order_number);
        // $checkout_session = \Stripe\Checkout\Session::create([
        //     'payment_method_types' => ['card'],
        //     'line_items' => [[
        //         'price_data' => [
        //             'currency' => 'USD',
        //             'unit_amount' => round($order->grand_total)*100,
        //             'product_data' => [
        //                 'name' => $order->name,
        //                 // 'images' => [Config::PRODUCT_IMAGE],
        //             ],
        //         ],
        //         'quantity' => 1,
        //     ]],
        //     'mode' => 'payment',
        //     'client_reference_id' => $order->id,
        //     'success_url' => BASE_URL.'/callback/stripe.cb.php?success=true',
        //     'cancel_url' => BASE_URL.'/callback/stripe.cb.php?success=false',
        // ]);

        // return $checkout_session;
    }
}