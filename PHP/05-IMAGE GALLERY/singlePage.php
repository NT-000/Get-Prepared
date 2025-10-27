<!doctype html>
<html lang="en">
<?php include './inc/images.inc.php'; ?>
<?php include './inc/functions.inc.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/singlePage.css">
    <link rel="stylesheet" href="styles/simple.css">
    <title>Image Gallery
        - <?php echo !empty($_GET['logo']) && !empty($imageTitle[$_GET['logo']]) ? e($imageTitle[$_GET['logo']]) : 'Unknown Team'; ?></title>
</head>
<body>
<main>
    <section>
        <?php include './views/header.php';
        if (!empty($imageTitle)) var_dump($imageTitle); ?>
        <br>
        <?php var_dump($_GET); ?>


        <h1><?php echo e($imageTitle[$_GET['logo']] ?? 'Unknown Team') ?></h1>
        <p><?php

            $teamName = !empty($imageTitle) ? ($imageTitle[$_GET['logo']]) : null;
            
            $teamDescription = (!empty($teamName)) ? ($imageDescriptions[$teamName] ?? 'No description available.') : 'No description available.';

            echo e($teamDescription);
            ?>
        </p>
    </section>
</main>
</body>
</html>