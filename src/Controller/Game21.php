<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller showing how to work with forms.
 */
class Game21
{
    public function view(): ResponseInterface
    {
        $data = [
            "header" => "21",
            "action" => url("/game21/process"),
        ];
        $body = renderView("layout/game21.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {
        // Check for actions
        if (isset($_POST['oneDice'])) {
            $_SESSION['dice'] = 1;
        } 
        
        if (isset($_POST['twoDices'])) {
            $_SESSION['dice'] = 2;
        } 
        
        if (isset($_POST['stay'])) {
            $_SESSION['turn'] = "computer";
        } 
        
        if (isset($_POST['reset'])) {
            $_SESSION['turn'] = "player";
        } 
        
        if (isset($_POST['resetFullGame'])) {
            $_SESSION['computerRoundsWon'] = 0;
            $_SESSION['playerRoundsWon'] = 0;
            $_SESSION['turn'] = "player";
            $_SESSION['playerPoints'] = 0;
            $_SESSION['computerPoints'] = 0;
        }

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21/view"));
    }
}
