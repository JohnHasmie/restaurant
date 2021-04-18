<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use Mockery\Exception;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Details;
use PayPal\Api\ItemList;
use PayPal\Rest\ApiContext;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;

class PayPal
{
    protected $payPal;
    protected $currency;

    public function __construct($data)
    {
        $this->payPal = new ApiContext(
            new OAuthTokenCredential(
                'AQEjauhmAJaKnCLoVdYkyxK7RqO8mvhJFyc1aoyDVg-E1_KY9R3zOpQ7yeo7lCnL75gHbRWCEldKgSs2',
                'EMi9SAW6FwOZaNIhAne0eLmctFAZwxKaplfyjlPeL27L13GgMCpIUOlhzqx1mtdu9gHD0afwPIPamaYE'
            )
        );
        $this->currency = 'USD';
    }

    public function processPayment($orders)
    {
        // $shipping = sprintf('%0.2f', 0);
        // $tax = sprintf('%0.2f', 0);

        // Create a new instance of Payer class
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $items = [];

        // Adding items to the list
        $order = $orders[0];
        foreach ($orders as $item)
        {
            $orderItems[$item->item_id] = new Item();
            $orderItems[$item->item_id]->setName($item->name)
                ->setCurrency($this->currency)
                ->setQuantity($item->item_quantity)
                ->setSku($item->sku)
                ->setPrice($item->sale_price);

            array_push($items, $orderItems[$item->item_id]);
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        // Setting Shipping Details
        // $details = new Details();
        // $details->setShipping($shipping)
        //     ->setTax($tax)
        //     ->setSubtotal(sprintf('%0.2f', $order->grand_total));

        // Create chargeable amount
        $amount = new Amount();
        $amount->setCurrency($this->currency)
                ->setTotal(round($order->grand_total));

        // Creating a transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription($order->description)
                ->setInvoiceNumber($order->order_number);

        // Setting up redirection urls
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(BASE_URL.'/callback/paypal.cb.php?success=true')
                    ->setCancelUrl(BASE_URL.'/callback/paypal.cb.php?success=false');

        // Creating payment instance
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

            try {

                $payment->create($this->payPal);
            
            } catch (PayPalConnectionException $exception) {
                echo $exception->getCode(); // Prints the Error Code
                echo $exception->getData(); // Prints the detailed error message
                exit(1);
            } catch (Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
            
            $approvalUrl = $payment->getApprovalLink();
            
            header("Location: {$approvalUrl}");
            exit;
    }

    public function completePayment($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->payPal);
        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try {
            $result = $payment->execute($execute, $this->payPal);
        } catch (PayPalConnectionException $exception) {
            $data = json_decode($exception->getData());
            $_SESSION['message'] = 'Error, '. $data->message;
            // implement your own logic here to show errors from paypal
            exit;
        }

        if ($result->state === 'approved') {
            $transactions = $result->getTransactions();
            $transaction = $transactions[0];
            $invoiceId = $transaction->invoice_number;

            $relatedResources = $transactions[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $saleId = $sale->getId();

            $transactionData = ['salesId' => $saleId, 'invoiceId' => $invoiceId];

            return $transactionData;
        } else {
            echo "<h3>".$result->state."</h3>";
            var_dump($result);
            exit(1);
        }
    }
}