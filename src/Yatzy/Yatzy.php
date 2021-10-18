<?php

namespace RoGr19\Yatzy;

/*
* For a full round of Yatzy.
* Throwing in the current round, throw
* and sum.
*/
class Yatzy
{
    public $currRound = 0;
    public $currThrow = 0;
    public $sum = 0;
    
    public function __construct($currRound, $currThrow, $sum) {
        $this->currRound = $currRound;
        $this->currThrow = $currThrow;
        $this->sum = $sum;
    }

    public function getCurrRound() {
        return $this->currRound;
    }

    public function getCurrThrow() {
        return $this->currThrow;
    }

    public function setCurrRound($currRound) {
        $this->currRound = $currRound + 1;
    }

    public function setCurrThrow($currThrow) {
        $this->currThrow = $currThrow;
    }

    public function getDiceCount($count) {
        return 5 - $count;
    }

    public function getSum() {
        return $this->sum;
    }
}

/*
* A new Yatzy hand.
* Input amount of dices for the hand.
*/
class YatzyHand
{
    public $diceAmount = 6;
    public $diceArray = [];

    public function __construct($diceAmount) {
        $this->diceAmount = $diceAmount;
    }

    public function getDiceValues() {
        for ($x = 0; $x < $this->diceAmount; $x++) {
            array_push($this->diceArray, rand(1, 6));
        }

        return $this->diceArray;
    }
}