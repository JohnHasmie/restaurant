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
        .mt-30 {
            margin-top: 30px;
        }
        .center {
            text-align: center;
        }
        .right {
            text-align: right;
        }
    </style>
</head>
<body>
    <?php if ((array)$restaurant) : ?>
        <h3 class="center"><u><?= $restaurant->name ?></u></h3>
    <?php endif; ?>
    <h4 class="center"><i>What Do You Want?</i></h4>
    <?php if (!$menu) : ?>
        <div class="center">
            <b><u>Menu</u></b>
        </div>
        <br>
        <div class="center">
            <button><a href="product.php?id=<?= $restaurantId ?>&menu=drink">Drinks</a></button>
            <button><a href="product.php?id=<?= $restaurantId ?>&menu=hamburger">Hamburger</a></button>
        </div>
    <?php endif ?>
        <div class="flex-center">
            <?php foreach ($products as $product) : ?>
                <?php if ($menu && strpos($product->category, $menu) !== false ) : ?>
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
                <?php endif; ?>
            <?php endforeach ?>
        </div>
    <?php if (count($orders) > 0) : ?>
        <div class="center mt-30">
            You have ordered <?= count($orders) ?> items
            <a href="order.php">Go To Page Order</a>
        </div>
    <?php endif; ?>
    <div class="mt-30">
        <a href="../../includes/logout.inc.php">Log Out</a>
    </div>
</body>
</html>