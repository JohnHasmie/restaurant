<?php
    include '../../includes/autoload.inc.php';
    include '../../includes/product.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <style>
        .flex-center {
            display: flex;
            justify-content: center;
            text-align: center;
        }
        .square {
            width: 100px;
            height: 100px;
            background: darkgrey;
            margin: 30px 30px 5px;
        }
        .pointer {
            cursor: pointer;
        }
        .mt-5 {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php if (count($orders) > 0) : ?>
        <div style="text-align:center">
            You have ordered <?= count($orders) ?> items
            <a href="order.php">Go To Page Order</a>
        </div>
    <?php endif; ?>
    <div class="flex-center">
        <?php foreach ($products as $product) : ?>
            <div>
                <form method="POST">
                    <div class="square"></div>
                    <?= $product->name ?> | $<?= $product->sale_price ?>
                    <input type="hidden" name="price" value="<?= $product->sale_price ?>">
                    <div class="mt-5">
                        <button class="pointer" type="submit" name="product" value="<?= $product->id ?>">+</button>
                    </div>
                </form> 
            </div>
        <?php endforeach ?>
    </div>
    <div>
        <a href="../includes/logout.inc.php">Log Out</a>
    </div>
</body>
</html>