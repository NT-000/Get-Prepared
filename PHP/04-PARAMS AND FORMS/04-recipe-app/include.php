<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../simple.css">
    <title></title>
</head>
<body>
<?php
function e($value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$pages = [
        'baked-chicken-schnitzel' => 'Baked Chicken Schnitzel',
        'chicken-enchiladas' => 'Chicken Enchiladas',
        'malfatti' => 'Malfatti'
];

?>

<form method="GET" action="include.php">
    <label for="page-select" title="Select page">Select page</label>
    <select name="page" id="page-select" onchange="this.form.submit()">
        <option value>Select a recipe</option>
        <?php foreach ($pages as $page => $name): ?>
            <option value="<?php echo e($page); ?>"
                    <?php if (!empty($_GET['page']) && e($_GET['page']) == $page) echo 'selected'; ?>>
                <?php echo e($name); ?></option>
        <?php endforeach; ?>
    </select>
</form>

<?php
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    if (!empty($pages[$page])) {
        echo file_get_contents("pages/{$page}.html");
    }


}
?>


<!--http://localhost/php/04-PARAMS%20AND%20FORMS/04-recipe-app/include.php?page=../secret

-->
</body>
</html>
