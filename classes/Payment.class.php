<?php

class Payment extends Database {
  
    private $pdo;
    private $order;
    private $validVendors = ['Stripe','Paypal'];
  
    public function __construct($vendorName, $data){
        $this->pdo = $this->connect();
        $this->payment = new $vendorName($data);
        $this->order = new Order;
    }

    // public function loadVendor($vendorName) {
    // }

    public function placeOrder() {
        $orders = $this->order->getAll();

        return json_encode($this->payment->processPayment($orders));
    }

    public function complete($data) {
        $paymentId = $data['paymentId'];
        $payerId = $data['PayerID'];
        // $invoiceId = $data['invoiceId'];
        // $method = $data['method'];

        // if (!$invoiceId) {
            $status = $this->payment->completePayment($paymentId, $payerId);
            $invoiceId = $status['invoiceId'];
            $method = 'PayPal -'.$status['salesId'];
        // }

        $this->order->payOrder($invoiceId, $method);
    }
}