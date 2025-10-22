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
    $name = "";
    $randNum = rand(0, 3);
    if ($randNum === 0) $name = "";
    else if ($randNum === 1) $name = "John";
    else if ($randNum === 2) $name = "0";
    else {
        unset($name);
        echo "<h3>Variable unset</h3>";
    }

    // unset($name); // deletes variable.
    var_dump(isset($name)); // checks if variable exists
    var_dump(empty($name)); // checks if variable is empty, looks into the value of the variable
    ?>
</pre>

<?php
if (isset($name) && $name !== "") {
    echo "<h1>Exists:$name</h1>\n";
}
?>


<?php if (!empty($name)): ?>

    <h2>
        <span>
            <?php echo "Not empty:$name" ?> // HTML code
        </span>
    </h2>;

<?php endif ?>


<pre>
     <?php
     var_dump(true xor false); // XOR - only one can be true
     ?>
</pre>
</body>
</html>
