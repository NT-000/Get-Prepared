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

    echo 'POST-data:';
    var_dump($_POST);

    function e($value)
    {
        return htmlspecialchars($value, ENT_QUOTES);
    }

    ?>

</pre>

<!--<form action="form-php" method="GET">-->
<!--    <input type="text" name="film" placeholder="Film"-->
<!--           value="--><?php //if (!empty($_GET['film'])) echo $_GET['film']; ?><!--"/>-->
<!--    <input type="submit" value="Submit"/>-->
<!--</form>-->

<h1><?php if (!empty($_POST['firstname'])) echo e($_POST['firstname']); ?>"/></h1>

<form action="xss.php" method="POST">
    <input type="text" name="firstname" placeholder="Firstname" required
           value="<?php if (!empty($_POST['firstname'])) echo e($_POST['firstname']); ?>"/>

    <!--    Injection example input:-->
    <!--    -->
    <!--    Nico" /> <script>document.location.href="https://vg.no";</script>-->
    <!--    Nico" /> <script>alert('Hello I am an injected string!');</script>-->

    <input type="submit" value="Submit"/>
</form>

<pre>
    <?php
    if (!empty($_GET['film'])) echo "<h1>Film:" . e($_GET['film']) . "---- Director:" . e($_GET['director']) . '</h1>';
    ?>
</pre>
</body>
</html>
