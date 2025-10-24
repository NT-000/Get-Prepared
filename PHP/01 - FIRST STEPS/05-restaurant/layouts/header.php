<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/custom.css"/>
    <link rel="stylesheet" href="styles/simple.css"/>
    <title>La Gondola <?php if (!empty($pageTitle)) : ?> &bull; <?php echo $pageTitle ?? ""; ?><?php endif; ?></title>

    <style>

        a, p, h1 {
            color: var(--gold) !important;
            border: none !important;
        }

        a:hover {
            filter: brightness(1.4);
        }

    </style>
</head>
<body>
<header class="header-with-background"
        style="background-image: url('<?php echo $headerImage ?? "images/background1.jpg"; ?>')">
    <h1>La Gondola</h1>
    <p>The home of exceptional times.</p>
    <nav>
        <?php if (!isset($page)) $page = ""; ?>
        <a class="<?php if ($page === 'mission') echo 'active' ?>" href="our-mission.php">Our
            Mission</a>
        <a class="<?php if ($page === 'history') echo 'active' ?>" href="our-history.php">Our
            History</a>
        <a class="<?php if ($page === 'menu') echo 'active' ?>" href="menu.php">Our Menu</a>
        <a href="mailto:la-gondola@gmail.com">Contact us</a>
    </nav>
</header>
</body>




