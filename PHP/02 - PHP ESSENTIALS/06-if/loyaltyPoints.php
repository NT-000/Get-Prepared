<?php

$pointsArray = [500, 2500, 3000, 5000, 10000];

$loyaltyPoints = rand($pointsArray[0], $pointsArray[4]);

var_dump($loyaltyPoints);

if($loyaltyPoints < 3000){
    echo "You have fewer than 3000 Loyalty Points. No discount is available.";
}
else if($loyaltyPoints >= 3000 && $loyaltyPoints < 6000){
    echo "You can spend 3000 Loyalty Points for a discount of 5%.";
}
else{
    echo "You can spend 6000 Loyalty Points for a discount of 15%.";
}

