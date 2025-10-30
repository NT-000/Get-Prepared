<pre>
    <?php

    $string = 'hei';
    $number = 6;

    var_dump($number);
    var_dump($string);

    var_dump(is_numeric($number));
    var_dump(is_int($number));
    var_dump(is_float($number));
    var_dump(is_bool($number));
    var_dump(is_array($number));
    var_dump(is_string($string));

    $array = [
            ['title' => 'Great book'],
            'Excellent book!',
    ];

    foreach ($array as $book) {
        if (is_array($book)) {
            var_dump($array['title']);
        } else {
            var_dump($array);
        }
    }
    ?>
</pre>
