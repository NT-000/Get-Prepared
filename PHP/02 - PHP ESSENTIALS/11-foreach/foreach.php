<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../simple.css">
    <title>Document</title>

    <style>
        li {
            list-style: number;
        }
    </style>
</head>
<body>
<?php

$footballTeams = ['Juventus', 'Real Madrid', 'Liverpool', 'Barcelona', 'Napoli'];

?>
<pre>
    <ul>
    <?php foreach ($footballTeams as $team) : ?>
        <?php if ($team === 'Real Madrid') continue; ?>
        <?php if ($team === $footballTeams[4]) continue; ?>
        <?php if ($team === $footballTeams[3]) break; ?>
        <li><?php echo "{$team}"; ?></li>
    <?php endforeach; ?>
        </ul>
</pre>
</body>
</html>
