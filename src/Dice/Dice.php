<?php

namespace RoGr19\Dice;

class Dice
{
    public $diceSides = 6;
    public $currentValue;

    public function __construct($sides) {
        $this->diceSides = $sides;
    }

    // Returns the current dice
    public function rollDice() {
        $this->currentValue = rand(1,$this->diceSides);
    }

    public function getCurrentValue() {
        return $this->currentValue;
    }
}

// class GraphicalDice extends Dice
// {

// }

class DiceHand 
{
    public $diceAmount = 0;
    public $diceArr = [];
    public $diceArrSeparated = [];

    public function __construct($diceAmount) {
        $this->diceAmount = $diceAmount;

        for ($i = 0; $i < $this->diceAmount; $i++) {
            array_push($this->diceArr, new Dice(6));
        }
    }

    public function rollAllDices() {
        foreach ($this->diceArr as &$dice) {
            $dice->rollDice();
        }
    }

    // Show Dice sum for 21
    public function getDiceValues() {
        $tempVal = 0;
        foreach ($this->diceArr as &$dice) {
            $tempVal += $dice->getCurrentValue();
        }

        return $tempVal;
    }

    // Show values in array for Yatzy
    public function getDiceValuesSeparated() {
        foreach ($this->diceArr as &$dice) {
            array_push($this->diceArrSeparated, $dice->getCurrentValue());
        }

        return $this->diceArrSeparated;
    }
}