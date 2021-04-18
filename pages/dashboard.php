<?php
    include '../includes/autoload.inc.php';
    include '../includes/restaurant.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <style>
        .flex-start {
            display: flex;
            justify-content: flex-start;
            text-align: center;
        }
        .square {
            width: 100px;
            height: 100px;
            background: darkgrey;   
            margin: 0px 30px 20px;
        }
        .pointer {
            cursor: pointer;
        }
        .center {
            text-align: center;
        }
        .left {
            text-align: left;
        }
        a#list-restaurant {
            text-decoration: none;
            color: black;
            width: 35%;
        }
    </style>
</head>
<body>
    <form method="GET">
        <h4 class="center">Your Address 
            <input type="text" name="current-location" value="<?= $currentLocation ?>">
            <input type="submit" value="Set">
        </h4>
    </div>
    <div>
        <?php foreach ($restaurants as $restaurant) : ?>
            <?php if ($restaurant->distance < 5) : ?>
                <a id="list-restaurant" href="menu/product.php?id=<?= $restaurant->id ?>" class="flex-start no">
                    <div class="square"></div>
                    <div class="left">
                        <h3><?= $restaurant->name ?></h3> 
                        <div><i><?= $restaurant->address ?></i></div>
                        <!-- <br> -->
                        <b><?= $restaurant->distance ?> Km</b> from your address
                    </div>
                </a>
            <?php endif ?>
        <?php endforeach ?>
    </div>
    <div>
        <a href="../includes/logout.inc.php">Log Out</a>
    </div>
</body>
</html>