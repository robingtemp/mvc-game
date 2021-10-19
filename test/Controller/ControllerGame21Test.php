<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller TwigView.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21();
        $this->assertInstanceOf("\Mos\Controller\Game21", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerViewAction()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->view();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerProcessAction()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that all POST-parameters work.
     */
    public function testPostActionOneDice() 
    {
        $controller = new Game21();

        // Posts parameters
        $_POST['oneDice'] = 1;

        $exp = 1;
        $controller->process();
        $this->assertEquals($exp, $_SESSION['dice']);
    }

    public function testPostActionTwoDices() 
    {
        $controller = new Game21();

        // Posts parameters
        $_POST['twoDices'] = 1;

        $exp = 2;
        $controller->process();
        $this->assertEquals($exp, $_SESSION['dice']);
    }

    public function testPostActionStay() 
    {
        $controller = new Game21();

        // Posts parameters
        $_POST['stay'] = 1;

        $exp = "computer";
        $controller->process();
        $this->assertEquals($exp, $_SESSION['turn']);
    }

    public function testPostActionReset() 
    {
        $controller = new Game21();

        // Posts parameters
        $_POST['reset'] = 1;

        $exp = "player";
        $controller->process();
        $this->assertEquals($exp, $_SESSION['turn']);
    }

    public function testPostActionResetFullGame() 
    {
        $controller = new Game21();

        // Posts parameters
        $_POST['resetFullGame'] = 1;

        $exp = 0;
        $controller->process();
        $this->assertEquals($exp, $_SESSION['computerRoundsWon']);
    }
}