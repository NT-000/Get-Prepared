<?php

// Keep in mind that the $playlist array is typically initialized before you start working with them
// However, for testing purposes, there might be instances where $playlist is not declared
// Ensure your script is robust enough to handle such scenarios

// Write your code here

$randomNum = rand(0, 2);
if ($randomNum === 0) {
    $playlist = [];
} else if ($randomNum === 1) {
    $playlist = ['Sunny Days', 'Moonlit Walk'];
} else {
    $playlist = ['Starry Night', 'Moonlit Walk', 'Whispering Wind', 'Golden Horizon'];
}

if (empty($playlist)) echo "Your playlist needs an update. Time to discover more music!";

if (in_array("Sunny Days", $playlist)) echo "You have great taste! 'Sunny Days' always lifts the mood!";
elseif (count($playlist) >= 2) {
    $playlist[1] = "Solar Whispers";
}

$songRecommendations = ['Ocean Waves', 'City Nights', 'Rising Sun', 'Dancing Shadows', 'Eclipse'];

if (!empty($playlist)) {
    $lastSong = count($playlist);
    echo "Your lastly added song was: '{$playlist[$lastSong -1]}'.";

}
if (count($playlist) <= 3) {
    $randomSongRec = rand(0, count($songRecommendations) - 1);
    $playlist[] = "{$songRecommendations[$randomSongRec]}";
} else if (count($playlist) > 10) {
    unset($playlist[0]);
}