<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="simple.css">
    <title>Numbers</title>
</head>
<body>
<pre>
    <?php
    $number = 30.33;
    echo "Number:" . $number . "\n";
    echo ($number * 2) . "\n";
    echo ($number + 2) . "\n";
    echo ($number - 2) . "\n";
    echo ($number / 2) . "\n";
    echo ($number % 4) . "\n";
    echo round($number, 1) . "\n";

     $number *= 2;
    ?>
</pre>
</body>
</html>

