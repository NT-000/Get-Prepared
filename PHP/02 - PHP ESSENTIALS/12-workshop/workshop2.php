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

<?php

$individualName = '';
$randNum = rand(0, 2);

$waitingList = [];
$priorityParticipants = [];
if ($randNum === 0) {
    $waitingList = ['Alex Reed', 'Blake Jordan', 'Casey Smith', 'Drew Alex', 'Elliot Ford', 'Finley Harper', 'Jordan Kay', 'Kim Lee', 'Liam Park', 'Morgan Drew'];
    $priorityParticipants = [];
} else if ($randNum === 1) {
    $waitingList = ['Avery Quinn', 'Bailey Scott', 'Charlie Morgan', 'Dakota James', 'Emerson Riley', 'Frankie Taylor', 'Harley Brooks', 'Jesse Lane', 'Logan Reed', 'Peyton Clark'];
    $priorityParticipants = ['Jordan Kay', 'Sam Taylor', 'Zane Pryor'];
} else if ($randNum === 2) {
    $waitingList = ['Reese Carter', 'Rowan Blake', 'Sydney Drew', 'Tatum Ellis', 'Quinn Avery', 'Riley Finn', 'Taylor Morgan', 'Alex Jordan', 'Skyler Hayes', 'Cameron Lee'];
    $priorityParticipants = ['Rowan Blake', 'Sam Taylor'];
}

$mergedList = array_unique(array_merge($priorityParticipants, $waitingList));
$finalAttendees = array_splice($mergedList, 0, 5);
$backupCandidates = array_splice($mergedList, 0, 3);


if (count($finalAttendees) < 5 && !empty($backupCandidates)) {
    foreach ($backupCandidates as $key => $candidate) {
        $finalAttendees[] = $candidate;
        unset($backupCandidates[$key]);
    }
}

sort($finalAttendees);

$remainingCandidates = [];
foreach ($mergedList as $person) {
    if (!in_array($person, $finalAttendees) && !in_array($person, $backupCandidates)) {
        $remainingCandidates[] = $person;
    }
}

foreach ($mergedList as $individual) {


    if (in_array($individualName, $finalAttendees)) {
        $individualStatus = 'Final Attendee';
    } elseif (in_array($individualName, $backupCandidates)) {
        $individualStatus = 'Backup Candidate';
    } elseif (in_array($individualName, $remainingCandidates)) {
        $index = array_search($individualName, $remainingCandidates) + 1;
        $individualStatus = "Waiting, position {$index}";
    } else {
        $individualStatus = 'Not found';
    }
    $individualName = $individual;
    echo "<p><strong>$individualName</strong> $individualStatus </p>\n";
}
?>

<ul>
    <?php foreach ($backupCandidates as $backupCandidate): ?>
        <li>Hey <?php echo $backupCandidate ?>, we want to inform you that you are one of our backup candidates. 🥳</li>
    <?php endforeach; ?>
</ul>

<div class="status">

</div>
</body>
</html>