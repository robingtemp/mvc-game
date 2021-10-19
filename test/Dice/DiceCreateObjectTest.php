<?php

namespace RoGr19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceCreateObjectTest extends TestCase
{
    /**
     * Verify object creation
     */
    public function testCreateDiceObject()
    {
        $dice = new Dice(1);
        $this->assertInstanceOf("\RoGr19\Dice\Dice", $dice);
    }

    /**
     * Verify expected value from Dice
     */
    public function testExpectedDiceValue()
    {
        $dice = new Dice(1);

        $dice->rollDice();
        $res = $dice->getCurrentValue();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify creation of DiceHand object
     */
    public function testCreateDiceHandObject()
    {
        $dicehand = new DiceHand(1);
        $this->assertInstanceOf("\RoGr19\Dice\DiceHand", $dicehand);
    }

    /**
     * Verify that the dice values are between
     * its supposed integers (1-6)
     */
    public function testExpectedDiceHandValues()
    {
        $dicehand = new DiceHand(1);
        $dicehand->rollAllDices();
        $test = $dicehand->getDiceValues();
        $expGreaterThan = 0;
        $this->assertGreaterThan($expGreaterThan, $test);

        $expLessThan = 7;
        $this->assertLessThan($expLessThan, $test);
    }

    public function testDiceValuesSeparated()
    {
        $dicehand = new DiceHand(1);
        $test = $dicehand->getDiceValuesSeparated();
        $this->assertIsArray($test);
    }
}