<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php if (isset($_GET['price'])) {
    $price = (int)($_GET['price']);
    var_dump($price);
    var_dump($price * 1.2);
}

if (isset($_GET['name'])) {
    $name = @(string)$_GET['name'] ?? "";
    var_dump($name . '!');
}
?>

<a href="type-casting.php?<?php echo http_build_query(['name' => ['Nico', 'Pico']]); ?>">Link</a>
</body>
</html>