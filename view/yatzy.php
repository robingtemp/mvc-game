<?php

/**
 * Yatzy
 */

declare(strict_types=1);
namespace RoGr19\Yatzy;

// Defaults
$action = $action ?? null;
$header = $header ?? null;
$message = $message ?? null;
$_SESSION['yatzy_current_round'] = $_SESSION['yatzy_current_round'] ?? 1;
$_SESSION['yatzy_current_throw'] = $_SESSION['yatzy_current_throw'] ?? 0;
$_SESSION['yatzy_values'] = $_SESSION['yatzy_values'] ?? [];
$_SESSION['yatzy_sum'] = $_SESSION['yatzy_sum'] ?? 0;

// Starting vars
$i = 0;

// Start the round
$round = new Yatzy($_SESSION['yatzy_current_round'], $_SESSION['yatzy_current_throw'], $_SESSION['yatzy_sum']);
$currentDiceAmount = $round->getDiceCount(count($_SESSION['yatzy_values']));
$currentRound = $round->getCurrRound();
$currentThrow = $round->getCurrThrow();
$currentSum = $round->getSum();

// Header & reset form
?><h1><?= $header ?></h1>
<form method="post" action="<?= $action ?>">
    <button type="submit" name="reset_full_game">Reset full game</button>
</form>

<?php

// 6 rounds in total
if ($currentRound < 7) {
    echo "Round: <b>" . $currentRound . "</b>. Get as many <b>" . $currentRound . "</b>'s as possible.";

    // 3 throws
    if ($currentThrow < 3 && $currentDiceAmount > 0) {

        // Getting a Yatzy hand
        $throw = new YatzyHand($currentDiceAmount);
        $dices = $throw->getDiceValues();

        // Generating checkboxes
    ?> <form method="post" action="<?= $action ?>"> <?php

        foreach($dices as $dice) {
    ?>
            <label for="n<?php echo $i?>"><?php echo $dice ?></label>
            <input type="checkbox" name="n<?php echo $i?>" value="<?php echo $dice ?>" />
    <?php 
            $i += 1;
        }

        // Roll btn
    ?> 
        <input type="submit" name="submit" value="Roll" />
        </form>

    <?php

    } else {
        // Finished round
        echo "You finished the round with: <b>" . $currentSum . "</b> points.";

        // Adding 1 to round, reset throw
        $_SESSION['yatzy_current_round'] += 1;
        $_SESSION['yatzy_current_throw'] = 0;
    ?>
        <form method="post" action="<?= $action ?>">
            <input type="submit" name="next_round" value="Next round"/>
        </form>

    <?php
    }
} else {
    // Finished game
    echo "You finished your game with: " . $currentSum . " points.";
    ?>

    <form method="post" action="<?= $action ?>">
        <input type="submit" name="reset_full_game" value="Start a new game"/>
    </form>

    <?php
}