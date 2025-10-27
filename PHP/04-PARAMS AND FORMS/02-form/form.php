<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../simple.css">
    <title>Document</title>
</head>
<body>
<pre>
    <?php

    echo(!empty($_GET['film']) ? "<h1>Film:{$_GET['film']} ---- Director: {$_GET['director']}</h1>" : "<h1>No param</h1>");

    var_dump($_GET);
    echo 'POST-data:';
    var_dump($_POST);
    ?>

</pre>

<!--<form action="form-php" method="GET">-->
<!--    <input type="text" name="film" placeholder="Film"-->
<!--           value="--><?php //if (!empty($_GET['film'])) echo $_GET['film']; ?><!--"/>-->
<!--    <input type="submit" value="Submit"/>-->
<!--</form>-->

<form action="form.php" method="POST">
    <input type="text" name="username" placeholder="Username" required
           value="<?php if (!empty($_POST['username'])) echo $_POST['username']; ?>"/>
    <input type="password" name="password" placeholder="Password" required/>
    <input type="submit" value="Submit"/>
</form>
</body>
</html>
