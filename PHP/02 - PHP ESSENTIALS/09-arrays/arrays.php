<?php

$names = ['Jan', 'John', 'Jane', 'Jenny',];

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

<pre>
<?php var_dump(in_array('Jan', $names));
echo 'First name in array:';
var_dump($names[0]);
echo 'Deleted first name in array:';
unset($names[0]); // key of others in array doesn't change with unset
echo 'Adds new name $names[0]:';
$names[0] = 'Anne';
var_dump($names[0]);
echo 'Overwrites name [2]';
$names[2] = 'Bob';
var_dump($names[2]);
echo 'Adds new name at end of the array:<br>';
$names[] = 'Jill';
var_dump($names);
?>
    </pre>

<h2>All names in array:</h2>
<ul>
    <?php foreach ($names as $name): ?>
        <li><?php echo $name; ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>