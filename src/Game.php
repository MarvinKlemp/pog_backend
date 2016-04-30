<?php

namespace Pog;

class Game
{
    private $id;
    private $nbAnswers = 0;
    private $nbCorrectAnswers = 0;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function submit(Question $question, $answer)
    {
        $this->nbAnswers ++;

        foreach ($question->getChoices() as $choice) {
            if ($answer === $choice->getText() && $choice->isCorrect()) {
                $this->nbCorrectAnswers ++;
                return true;
            }
        }

        return false;
    }

    public function getResult()
    {
        return [
            'nbAnswers' => $this->nbAnswers,
            'nbCorrectAnswers' => $this->nbCorrectAnswers,
        ];
    }
}
