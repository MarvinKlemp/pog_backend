<?php

namespace Pog\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Pog\Game;
use Pog\Question;
use Pog\Choice;

class DefaultController extends Controller
{
    /**
     * @Route("/{id}", name="game")
     */
    public function indexAction(Request $request, $id)
    {
        $session = $request->getSession();
        $game = $this->getGame($session, $id);

        if ($game->isFinished()) {
            return $this->render('result.html.twig', [
                'gameId' => $id,
                'game' => $game,
            ]);
        }

        return $this->render('game.html.twig', [
            'gameId' => $id,
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/answer/{question}/{answer}", name="answer")
     */
    public function answerAction(Request $request, $id, $question, $answer)
    {
        $session = $request->getSession();
        $game = $this->getGame($session, $id);

        $questions = $game->getQuestions();
        $game->submit($questions[$question], $answer);
        $request->getSession()->set($id, $game);

        return $this->redirectToRoute('game', ['id' => $id]);
    }

    private function getGame(SessionInterface $session, $id)
    {
        if ($game = $session->get($id)) {
            return $game;
        }

        $choices = [
            new Choice('elasticsearch', true),
            new Choice('redis', false),
            new Choice('mysql', false),
            new Choice('hadoop', false),
        ];
        shuffle($choices);
        $question1 = new Question(9200, $choices);

        $choices = [
            new Choice('redis', true),
            new Choice('zookeeper', false),
            new Choice('mysql', false),
            new Choice('memcached', false),
        ];
        shuffle($choices);
        $question2 = new Question(6379, $choices);

        $choices = [
            new Choice('mysql', true),
            new Choice('kafka', false),
            new Choice('solr', false),
            new Choice('mongodb', false),
        ];
        shuffle($choices);
        $question3 = new Question(3306, $choices);

        $choices = [
            new Choice('mongodb', true),
            new Choice('kafka', false),
            new Choice('mesos', false),
            new Choice('boot2docker', false),
        ];
        shuffle($choices);
        $question4 = new Question(28017, $choices);

        return new Game($id, [
            $question1,
            $question2,
            $question3,
            $question4,
        ]);
    }
}
