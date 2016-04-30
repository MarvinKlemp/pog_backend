<?php

namespace Pog;

class Question
{
    private $port;
    private $choices = [];

    public function __construct($port, array $choices)
    {
        $this->port = $port;
        $this->choices = $choices;
    }

    public function getChoices()
    {
        return $this->choices;
    }
}
