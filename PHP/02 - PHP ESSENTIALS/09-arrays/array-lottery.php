<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lottery</title>
</head>
<body>
<pre>
<?php
$names = ['Jan', 'John', 'Jane', 'Jenny', 'Bob',];
$randomNumber = rand(0, count($names) - 1);

echo "The number is: {$randomNumber} and the winner is {$names[$randomNumber]}" . '<br>';

var_dump($randomNumber);
?>
</pre>
</body>
</html>