<?php

declare(strict_types=1);

namespace Mos\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller TwigView.
 */
class ControllerYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new YatzyController();
        $this->assertInstanceOf("\Mos\Controller\YatzyController", $controller);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerViewAction()
    {
        $controller = new YatzyController();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->view();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testControllerProcessAction()
    {
        $controller = new YatzyController();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that all POST-parameters work.
     */
    public function testPostAction() 
    {
        $controller = new YatzyController();

        // Posts parameters
        $_POST['n0'] = 1;
        $_POST['n1'] = 1;
        $_POST['n2'] = 1;
        $_POST['n3'] = 1;
        $_POST['n4'] = 1;

        $exp = 5;
        $controller->process();
        $this->assertCount($exp, $_SESSION['yatzy_values']);
    }

    public function testNextRoundActions() 
    {
        $controller = new YatzyController();

        // Posts parameters
        $_POST['next_round'] = 1;

        $exp = 0;
        $controller->process();
        $this->assertCount($exp, $_SESSION['yatzy_values']);
        $this->assertEquals($exp, $_SESSION['yatzy_current_throw']);
    }

    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    public function testDestroyedSession() 
    {
        session_start();
        $controller = new YatzyController();

        $_SESSION = [
            'yatzy_current_throw' => 3,
            'yatzy_current_round' => 3,
            'yatzy_values' => [1, 2, 3],
        ];

        // Reset
        $_POST['reset_full_game'] = 1;
        
        $controller->process();
        $this->assertIsArray($_SESSION);
    }

    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    // public function testCountingPoints()
    // {
    //     session_start();
    //     $controller = new YatzyController();

    //     $_SESSION = [
    //         'yatzy_current_throw' => 3, 
    //         'yatzy_values' => [1, 2, 3],
    //         'yatzy_current_round' => 1,
    //         'yatzy_sum' => 0
    //     ];

    //     $exp = 3;
    //     $controller->process();
    //     $this->assertEquals($exp, $_SESSION["yatzy_sum"]);
    // }
    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    // public function testYatzyBonus()
    // {
    //     session_start();
    //     $controller = new YatzyController();

    //     $_SESSION = [
    //         'yatzy_current_throw' => 3,
    //         'yatzy_values' => [1, 2, 3],
    //         'yatzy_current_round' => 6,
    //         'yatzy_sum' => 64
    //     ];

    //     $exp = 3;
    //     $controller->process();
    //     $this->assertGreaterThan($exp, $_SESSION["yatzy_sum"]);
    // }

}