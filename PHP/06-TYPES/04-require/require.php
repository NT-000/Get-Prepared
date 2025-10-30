<?php
require __DIR__ . '/functions/functions.inc.php'; // Always includes the file, even if it's been included before (can cause "function already defined" errors)
require_once __DIR__ . '/functions/functions.inc.php'; // Includes the file only once, preventing duplicate includes.
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../simple.css"
    <title>Document</title>
</head>
<body>
<pre>
    <?php
    $text = 'This is a text!';

    ?>

    <h1><?php echo e($text) ?> </h1>
</pre>
</body>
</html>