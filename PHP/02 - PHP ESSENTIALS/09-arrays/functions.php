<?php

$people = ['Pam', 'Joe', 'Joe', 'Pat', 'Nico', 'Frank', 'Fran', 'Michael', 'Michael', "Dwight",];
?>

<pre>
    <?php
    echo 'Length of array:<br>';
    var_dump(count($people));

    $people = array_unique($people);

    echo 'Modified array without duplicates: <br>';
    var_dump($people);

    echo 'Sorted array: <br>';
    sort($people);
    var_dump($people);

    var_dump(array_search('Nico', $people));
    var_dump(array_slice($people, 0, 2));


    echo 'Numbers array-functions: <br>';
    $numbers = [1, 4, 8, 9, 10];
    echo 'Min number: <br>';
    var_dump(min($numbers));
    echo 'Max number: <br>';
    var_dump(max($numbers));

    echo 'Sum average: <br>';
    var_dump(array_sum($numbers) / count($numbers));
    echo 'Round numbers-array: <br>';
    $numbers2 = [10.234, 2];
    var_dump(round(...$numbers2));

    echo 'Merge arrays: <br>';
    $animals = ['Cat', 'Dog', 'Rabbit'];
    echo 'Animal-array: <br>';
    var_dump($animals);
    $animals2 = ['Pig', 'Bird', 'Horse'];
    echo 'Animal-array2: <br>';
    var_dump($animals2);

    echo 'Merged animal-array: <br>';
    $merged = array_merge($animals, $animals2);
    var_dump($merged);

    var_dump([...$animals, ...$animals2, 'Cow']);

    ?>
</pre>
