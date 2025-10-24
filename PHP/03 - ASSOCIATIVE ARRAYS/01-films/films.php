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
    $films = [
            'Inception' => 'Christopher Nolan',
            'Parasite' => 'Bong Joon-ho',
            'The Godfather' => 'Francis Ford Coppola',
            'Pulp Fiction' => 'Quentin Tarantino',
            'Spirited Away' => 'Hayao Miyazaki',
            'The Matrix' => 'Lana & Lilly Wachowski',
            'The Lord of the Rings: The Fellowship of the Ring' => 'Peter Jackson',
            'Titanic' => 'James Cameron',
            'Se7en' => 'David Fincher',
            'Mad Max: Fury Road' => 'George Miller',
    ];

    $key = array_rand($films);

    var_dump($films[$key]);
    $films['Django'] = 'Quentin Tarantion';
    var_dump(count($films));

    foreach ($films as $film => $director) {
        echo "$film - $director <br>";
    }

    var_dump(array_keys($films)); // finds keys in array
    var_dump(array_values($films)); // finds values in array
    ?>

</pre>
</body>
</html>
