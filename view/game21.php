<?php

/**
 * The 21 game
 */

declare(strict_types=1);

namespace RoGr19\Dice;

// Defaults
$action = $action ?? null;
$header = $header ?? null;
$message = $message ?? null;

// Sessions
$_SESSION['playerPoints'] = $_SESSION['playerPoints'] ?? 0;
$_SESSION['playerLastPoints'] = $_SESSION['playerLastPoints'] ?? 0;
$_SESSION['computerPoints'] = $_SESSION['computerPoints'] ?? 0;
$_SESSION['dice'] = $_SESSION['dice'] ?? 0;

// Saving rounds
$_SESSION['playerRoundsWon'] = $_SESSION['playerRoundsWon'] ?? 0;
$_SESSION['computerRoundsWon'] = $_SESSION['computerRoundsWon'] ?? 0;

$test = new Dice(1);

?><h1><?= $header ?></h1>

<ul>
    <li><?php echo "The player has won: " . $_SESSION['playerRoundsWon'] . " rounds." ?></li>
    <li><?php echo "The computer has won: " . $_SESSION['computerRoundsWon'] . " rounds." ?></li>
    <li><form method="post" action="<?= $action ?>"><button name="resetFullGame">Reset rounds</button></form></li>
</ul>

<?php 
    
    // Game start
    if (!isset($_SESSION['turn'])) {
        $_SESSION['turn'] = "player";
    }

    // Player's turn
    if ($_SESSION['turn'] === "player") {
        $hand = new DiceHand($_SESSION['dice']);

        echo "<h2>Player's turn</h2>";

        // Rolling & displaying current hand
        $hand->rollAllDices();
        echo "You got: " . $hand->getDiceValues() . " points this hand.";

        // Adding to total
        $_SESSION['playerPoints'] += $hand->getDiceValues();

        // Display based on points
        if ($_SESSION['playerPoints'] < 21) {

            // Total points
            echo "You currently got: <b>" . $_SESSION['playerPoints'] . "</b> points in total.";
            $_SESSION['playerLastPoints'] = $_SESSION['playerPoints'];

            // The main form
?>
            <form method="post" action="<?= $action ?>">
                <button type="submit" name="oneDice">Roll 1 dice</button>
                <button type="submit" name="twoDices">Roll 2 dices</button>
                <button type="submit" name="stay">Stay</button>
            </form>
<?php

        // For 21
        } else if ($_SESSION['playerPoints'] === 21) {
            echo "Congratulations! You got 21!";
            $_SESSION['playerPoints'] = 0;
            $_SESSION['playerLastPoints'] = 21;
            $_SESSION['playerRoundsWon'] += 1;
?>      
            <form method="post" action="<?= $action ?>">
                <button type="submit" name="reset">Next round</button>
            </form>
<?php

        // For over 21
        } else {
            echo "You went above 21. The game is over. You got " . $_SESSION['playerPoints'] . " in total.";
            $_SESSION['playerPoints'] = 0;
            $_SESSION['playerLastPoints'] = 0;
            $_SESSION['computerRoundsWon'] += 1;
?>
            <form method="post" action="<?= $action ?>">
                <button type="submit" name="reset">Next round</button>
            </form>
<?php
        }

    // Computers's turn
    } else if ($_SESSION['turn'] === "computer") {
        echo "<h2>Computer's turn</h2>";
        $_SESSION['playerPoints'] = 0;

        $hand = new DiceHand(1);
        $break = false;

        // Rolling until something happens
        while ($break != true) {
            $hand->rollAllDices();
            $_SESSION['computerPoints'] += $hand->getDiceValues();
            
            if ($_SESSION['computerPoints'] > 21) {
                echo "The computer lost the game with the points: <b>" . $_SESSION['computerPoints'] . "</b>";
                $_SESSION['computerPoints'] = 0;
                $_SESSION['playerRoundsWon'] += 1;
                $break = true;
            } else if ($_SESSION['computerPoints'] === 21) {
                echo "The computer got 21 and won the game!";
                $_SESSION['computerPoints'] = 0;
                $_SESSION['playerRoundsWon'] += 1;
                $break = true;
            } else if ($_SESSION['computerPoints'] > $_SESSION['playerLastPoints']) {
                echo "The computer won the game with the points <b>" . $_SESSION['computerPoints'] . "</b>";
                $_SESSION['computerPoints'] = 0;
                $_SESSION['computerRoundsWon'] += 1;
                $break = true;
            }
        }

        // Let the player start a new round
?>
        <form method="post" action="<?= $action ?>">
            <button type="submit" name="reset">Next round</button>
        </form>
<?php
    }

?>