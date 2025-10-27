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
<pre>
<?php
echo(!empty($_GET['film']) ? "<h1>Film:{$_GET['film']} ---- Director: {$_GET['director']}</h1>" : "<h1>No param</h1>");
?>

    <a href="querystring.php?<?php echo http_build_query(['film' => 'Django', 'director' => 'Quentin Tarantino']); ?>">Django</a>
    <a href="querystring.php?<?php echo http_build_query(['film' => 'Bugs & Bees', 'director' => 'BeeMan']); ?>">Bugs & Bees</a>
</pre>

<form action=""
</body>
</html>
