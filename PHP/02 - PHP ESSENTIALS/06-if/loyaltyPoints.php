<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../simple.css">
</head>
<body>

<pre>
    <?php

    $pointsArray = [500, 2500, 3000, 5000, 10000];

    $loyaltyPoints = rand($pointsArray[0], $pointsArray[4]);

    echo "Current Loyalty Points: {$loyaltyPoints}\n\n";

    if($loyaltyPoints < 3000){
        echo "You have fewer than 3000 Loyalty Points. No discount is available.\n\n";
    }
    else if($loyaltyPoints >= 3000 && $loyaltyPoints < 6000){
        echo "You can spend 3000 Loyalty Points for a discount of 5%.\n\n";
    }
    else{
        echo "You can spend 6000 Loyalty Points for a discount of 15%.\n\n";
    }

    $totalCost = rand(10,200);

    $appliedTaxPrice = $totalCost * 1.08;

    if ($loyaltyPoints < 3000) {

        $price = $totalCost * 1.08;
        $loyaltyPoints += $price * 100;
        echo "You have fewer than 3000 Loyalty Points. No discount is available. Your final price (after taxes) would be \${$price}. Your new Loyalty Balance would be: {$loyaltyPoints}.";

    } else if ($loyaltyPoints >= 3000 && $loyaltyPoints < 6000) {

        $price = $totalCost * 0.95 * 1.08;
        $loyaltyPoints += ($price * 100) - 3000;
        echo "You can spend 3000 Loyalty Points for a discount of 5%. Your final price (after discount and taxes) would be \${$price}. Your new Loyalty Balance would be: {$loyaltyPoints}.";
    } else {

        $price = $totalCost * 0.95 * 1.08;
        $loyaltyPoints3000 = $loyaltyPoints + ($price * 100) - 3000;

        $newPrice = $totalCost * 0.85 * 1.08;
        $newLoyaltyPoints = $loyaltyPoints + ($newPrice * 100) - 6000;

        echo "You can spend 3000 Loyalty Points for a discount of 5%. Your final price (after discount and taxes) would be \${$price}. Your new Loyalty Balance would be: {$loyaltyPoints3000}.\n";
        echo "You can spend 6000 Loyalty Points for a discount of 15%. Your final price (after discount and taxes) would be \${$newPrice}. Your new Loyalty Balance would be: {$newLoyaltyPoints}.";

    }
    ?>
</pre>
</body>
</html>