<?php

// 在状态模式（State Pattern）中，类的行为是基于它的状态改变的。这种类型的设计模式属于行为型模式。


interface State {
    public function doAction($context);
}

class StartState implements State {

    public function doAction($context) {
        echo "Player is in start state<br/>";
        $context->setState($this);    
    }

    public function toString(){
        return "Start State";
    }
}


class StopState implements State {

    public function doAction($context) {
        echo "Player is in stop state<br/>";
        $context->setState($this);    
    }

    public function toString(){
        return "Stop State";
    }
}


class Context {
    private $state;

    public function __construct(){
        $this->state = null;
    }

    public function setState($state){
        $this->state = $state;        
    }

    public function getState(){
        return $this->state;
    }
}


$context = new Context();

$startState = new StartState();
$startState->doAction($context);

echo $context->getState()->toString()."<br/>";

$stopState = new StopState();
$stopState->doAction($context);

echo $context->getState()->toString()."<br/>";


