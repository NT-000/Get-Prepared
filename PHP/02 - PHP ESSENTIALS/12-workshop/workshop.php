<?php

$waitingList = ['Dawn White', 'Frank Smith', 'Bob Carter', 'Charlie Davis', 'Eve Black', 'Alice Brown', 'Alice Brown', 'Charlie Davis', 'Grace Jones', 'Hank Green', 'Eve Black', 'Dawn White'];
$removeFromList = ['Dawn White', 'Charlie Davis'];

foreach ($waitingList as $key => $person) {

    if (in_array($person, $removeFromList)) {
        echo "Key: {$key}, Person: {$person}\n";
        unset($waitingList[$key]);
    }
}

$cleanedWaitingList = array_unique($waitingList);

sort($cleanedWaitingList);

$selectedParticipants = array_slice($cleanedWaitingList, 0, 5);

echo '<ul>'; ?>
<?php foreach ($cleanedWaitingList as $person): ?>
    <?php echo in_array($person, $selectedParticipants) ? "<li>{$person} ✅</li>" : "<li>{$person} ❌</li>"; ?>
<?php endforeach; ?>
<?php echo '</ul>'; ?>

