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
class YatzyController
{
    public function view(): ResponseInterface
    {
        $data = [
            "header" => "Yatzy",
            "action" => url("/yatzy/process"),
        ];

        $body = renderView("layout/yatzy.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {   
        // Adding a throw
        $_SESSION['yatzy_current_throw'] += 1;

        // Pushing currently posted values to values array
        if(isset($_POST['n0'])) {
            array_push($_SESSION['yatzy_values'], $_POST['n0']);
        }

        if(isset($_POST['n1'])) {
            array_push($_SESSION['yatzy_values'], $_POST['n1']);
        }

        if(isset($_POST['n2'])) {
            array_push($_SESSION['yatzy_values'], $_POST['n2']);
        }

        if(isset($_POST['n3'])) {
            array_push($_SESSION['yatzy_values'], $_POST['n3']);
        }

        if(isset($_POST['n4'])) {
            array_push($_SESSION['yatzy_values'], $_POST['n4']);
        }

        // Next round
        if(isset($_POST['next_round'])) {
            $_SESSION['yatzy_values'] = [];
            $_SESSION['yatzy_current_throw'] = 0;
        }

        // Reset game
        if (isset($_POST['reset_full_game'])) {
            session_destroy();
        }

        // Count points
        if ($_SESSION['yatzy_current_throw'] === 3) {
            foreach ($_SESSION['yatzy_values'] as $val) {
                if ((int)$val === $_SESSION['yatzy_current_round']) {
                    $_SESSION['yatzy_sum'] += (int)$val;
                }
            }
        }

        // Bonus
        if ($_SESSION['yatzy_current_round'] === 6 && $_SESSION['yatzy_current_throw'] === 3 && $_SESSION['yatzy_sum'] > 63) {
            $_SESSION['yatzy_sum'] += 50;
        }

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy/view"));
    }
}
