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
$text = file_get_contents(__DIR__ . '/inc/text.txt'); // get fil as a string, loads whole file
echo $text;

readfile(__DIR__ . '/inc/functions.inc.php'); // reads and loads file to browser at the same time, preferred for bigger files.

?>
</pre>
</body>
</html>
