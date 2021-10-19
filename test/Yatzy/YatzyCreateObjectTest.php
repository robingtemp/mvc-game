<?php

namespace RoGr19\Yatzy;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceCreateObjectTest extends TestCase
{
    /**
     * Verify object creation
     */
    public function testCreateYatzyObject()
    {
        $yatzy = new Yatzy(1, 1, 0);
        $this->assertInstanceOf("\RoGr19\Yatzy\Yatzy", $yatzy);
    }

    public function testGetCurrThrow()
    {
        $yatzy = new Yatzy(1, 1, 0);
        $exp = 1;
        $this->assertEquals($exp, $yatzy->getCurrThrow());
    }

    public function testGetCurrRound()
    {
        $yatzy = new Yatzy(1, 1, 0);
        $exp = 1;
        $this->assertEquals($exp, $yatzy->getCurrRound());
    }

    public function testSetCurrThrow()
    {
        $yatzy = new Yatzy(1, 1, 0);
        $yatzy->setCurrThrow(2);
        $exp = 2;
        $this->assertEquals($exp, $yatzy->getCurrThrow());
    }

    public function testSetCurrRound()
    {
        $yatzy = new Yatzy(1, 1, 0);
        $yatzy->setCurrRound(2);
        $exp = 3;
        $this->assertEquals($exp, $yatzy->getCurrRound());
    }

    public function testGetDiceCount()
    {
        $yatzy = new Yatzy(1, 1, 0);
        $exp = 1;
        $this->assertEquals($exp, $yatzy->getDiceCount(4));
    }

    public function testGetSum()
    {
        $yatzy = new Yatzy(1, 1, 10);
        $exp = 10;
        $this->assertEquals($exp, $yatzy->getSum());
    }

    public function testCreateYatzyHand()
    {
        $yatzyhand = new YatzyHand(1);
        $this->assertInstanceOf("\RoGr19\Yatzy\YatzyHand", $yatzyhand);
    }

    public function testYatzyHandDiceValues()
    {
        $yatzyhand = new YatzyHand(1);
        $diceValues = $yatzyhand->getDiceValues();
        $this->assertIsArray($diceValues);

        $exp = 1;
        $this->assertCount($exp, $diceValues);
    }
}