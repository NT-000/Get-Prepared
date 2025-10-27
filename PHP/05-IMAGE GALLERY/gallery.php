<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./styles/gallery.css">
    <link rel="stylesheet" href="./styles/simple.css">
    <title>Image gallery</title>


</head>

<?php include './views/header.php'; ?>

<?php include './inc/functions.inc.php'; ?>

<?php include './inc/images.inc.php';

?>


<body>
<main>
    <section>
        <?php if (!empty($imageTitle)) : ?>

            <?php foreach ($imageTitle as $logo => $team) : ?>
                <article>
                    <?php if (!empty($logo)) $imageName = "images/{$logo}"; ?>
                    <a href="singlePage.php?<?php echo e(http_build_query(['logo' => $logo, 'team' => $team])) ?>">
                        <img src="./<?php echo e($imageName); ?>">
                        <p class="teamName"> <?php echo e($team); ?> </p>
                    </a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<?php include './views/footer.php'; ?>
</body>


</html>

