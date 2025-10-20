<?php

$greeting = "Hello Nico!";

$greetings = ["Hello", "Bonjour!", "Hola!"]

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Variables</title>
</head>
<body>

<?php echo $greeting;
foreach($greetings as $greeting);
echo $greeting?>
</body>
</html>
