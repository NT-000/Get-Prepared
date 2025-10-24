<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        .body-1{
            background-color: #000;
        }
        .body-2{
            background-color: red;
        }
        .body-3{
            background-color: grey;
        }
        .body-4{
            background-color: blue;
        }
        .body-5{
            background-color: purple;
        }
        .php-command{
            color: green;
        }
    </style>
</head>
<body class="body-<?php echo rand(1, 5) ?>">
<?php echo '<h1 class="php-command" >PHP command!</h1>'; ?>
<button> Click me </button>
</body>
</html>