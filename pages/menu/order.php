<?php
    include '../../includes/autoload.inc.php';
    include '../../includes/order.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h2><u>The Shopping Cart</u></h2>

    <table>
        <?php foreach($orders as $order) : ?>
            <tr>
                <td style="width: 30px;"><?= $order->item_quantity ?></td>
                <td style="width: 90px;"><b><?= $order->name ?></b></td>
                <td style="width: 50px;">$<?= $order->price ?></td>
                <th>$<?= $order->price * $order->item_quantity ?></th>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <h4>Payment Method</h4>
    <form action="payment.php" method="POST">
        <input type="hidden" name="payment" value="Paypal">
        <button type="submit">Paypal</button>
    </form>
    <!-- <button>Credit Card</button> -->
    <form action="payment.php" method="POST">
        <script src="https://checkout.stripe.com/checkout.js" 
            class="stripe-button"
            data-key="pk_test_51Ie6PpL8uWnAKjvMNgFDexRRie4VQhyM8KJOBVY5aqNKW6gBffeydJm2SMbDk0ZuvaplO4KRsFqjKmJ8Oj5VAaHd00lA6oPt7I"
            data-amount="<?= $order->grand_total*100 ?>"
            data-name="Pay with Credit Card"
            data-description="Click and Collect"
            data-currency="USD"
        >
        </script>
        <script>
            // Hide default stripe button, be careful there if you
            // have more than 1 button of that class
            document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
        </script>
        <input type="hidden" name="payment" value="Stripe">
        <input type="hidden" name="invoiceId" value="<?= $order->order_number ?>">
        <input type="hidden" name="method" value="Stripe-<?= $order->order_number ?>">
        <button type="submit">Credit Card</button>
    </form>
    <!-- <button id="checkout-button">Credit Cards</button>
    <script>
        var stripe = Stripe('pk_test_51Ie6PpL8uWnAKjvMNgFDexRRie4VQhyM8KJOBVY5aqNKW6gBffeydJm2SMbDk0ZuvaplO4KRsFqjKmJ8Oj5VAaHd00lA6oPt7I');
        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function() {
            fetch('payment.php?payment=Stripe', {
                method: 'POST',
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function(result) {
                if (result.error) {
                alert(result.error.message);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    </script> -->
    <div>
        <a href="../includes/logout.inc.php">Log Out</a>
    </div>
</body>
</html>