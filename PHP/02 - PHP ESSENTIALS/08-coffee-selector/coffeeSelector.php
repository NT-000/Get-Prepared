<?php

$coffees = ["drip", "espresso", ""];
$selectedCoffee = $coffees[rand(0, count($coffees) - 1)];

if (empty($selectedCoffee)) $selectedCoffee === 'drip';

?>

<?php if ($selectedCoffee === "espresso"): ?>
<div class="coffee-info">
    <div id="espresso-info">
        <h1>Espresso ☕</h1>
        <p>Espresso is a concentrated coffee drink with a bold flavor. It pairs perfectly with a chocolate croissant.
            🍫🥐</p>
    </div>

    <?php else: ?>
        <div id="drip-coffee-info">
            <h1>Drip Coffee ☕</h1>
            <p>Drip coffee, a staple in many routines, is known for its straightforward brewing process and comforting,
                familiar taste. Perfect for starting your morning or as a midday pick-me-up. ☕️🌅</p>
        </div>

    <?php endif; ?>

</div>