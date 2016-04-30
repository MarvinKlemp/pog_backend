<?php

namespace Pog\Tests;

use Pog\Game;
use Pog\Question;
use Pog\Choice;

class GameTest extends \PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $game = new Game('732njqwu');
        $question = new Question(9200, [
            new Choice('elasticsearch', true),
            new Choice('redis', false),
            new Choice('mysql', false),
            new Choice('hadoop', false),
        ]);

        $game->submit($question, 'elasticsearch');
        $game->submit($question, 'redis');
        var_dump($game->getResult());
    }
}
