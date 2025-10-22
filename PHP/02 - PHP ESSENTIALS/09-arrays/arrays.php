<?php

$names = ['Jan', 'John', 'Jane', 'Jenny'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arrays</title>
</head>
<body>
<?php var_dump(in_array('Jan', $names));
var_dump($names[0]);
unset($names[0]);
var_dump($names[0]);
var_dump($names[1]); ?>

<ul>
    <?php foreach ($names as $name): ?>
        <li><?php echo $name; ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>