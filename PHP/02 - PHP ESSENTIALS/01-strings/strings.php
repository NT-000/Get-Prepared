<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="simple.css">
    <title>Document</title>
</head>
<body>
<h1>Different strings</h1>
<pre>
    line1
                 line2
</pre>

<div>
    line1
                 line2
</div>

<pre>
    <?php

    $greeting = "Hello, string!";
    echo "I'm a string \n";
    echo $greeting . "!\n" . $greeting;
    echo "I'm a string2 \n";

    $name = "Nico";
    $occupation = "Web Developer";

    $text = "Hi, my name is " . $name . " and I am a " . $occupation;

    echo $text . "!";
    ?>
</pre>

<pre>
    <?php
    $test = "Hello, string!";
    echo "{$test}_" . "!\n";

    echo $tab = "\tI'm a tab \t"; // tab = \t

    echo "I'm {$name} and I am a {$occupation}";

    echo "\t I'm a {$tab}" . "<br>";

    echo "Welcome back!\nWe're glad to see you again.<br/>Check out our new features.";
    ?>

</pre>

<pre>
    <?php
    $promoCode = 'SUMMER_SALE';
    echo "Seasonal Offer! 🤑 Use \"{$promoCode}\" for an exclusive discount.";
    ?>
</pre>
</body>
</html>