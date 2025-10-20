<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../simple.css">
    <title>If</title>
</head>
<body>
<pre>
    <?php

    $status = 'ok';

    include "vars.php";

    var_dump($status);

if($status === 'ok'){
    echo "Server is ok!";
}
else{
    echo "Server is not ok!";
}
    ?>
</pre>
</body>
</html>
