<?php

// 在策略模式（Strategy Pattern）中，一个类的行为或其算法可以在运行时更改。行为型模式。

interface Strategy { // 抽象策略角色，以接口实现
    public function do_method(); // 算法接口
}

class ConcreteStrategyA implements Strategy { // 具体策略角色A 
    public function do_method() {
        echo 'do method 1';
    }
}

class ConcreteStrategyB implements Strategy { // 具体策略角色B 
    public function do_method() {
        echo 'do method 2';
    }
}

class ConcreteStrategyC implements Strategy { // 具体策略角色C
    public function do_method() {
        echo 'do method 3';
    }
}


class Question{ // 环境角色
    private $_strategy;

    public function __construct(Strategy $strategy) {
        $this->_strategy = $strategy;
    } 
    public function handle_question() {
        $this->_strategy->do_method();
    }
}
 
// client
$strategyA = new ConcreteStrategyA();
$question = new Question($strategyA);
$question->handle_question();

$strategyB = new ConcreteStrategyB();
$question = new Question($strategyB);
$question->handle_question();

$strategyC = new ConcreteStrategyC();
$question = new Question($strategyC);
$question->handle_question();


// 这里例子看起来就是一个简单的依赖注入，然后不同的对象做不同的事情，不过策略模式，也就是不同的情况下不同的处理方式。
// 实际应用场景：很多啦，比如不同等级发不一样的年终奖，比如销售额分阶段，不同阶段的提成百分比不同。比如下载地址时候不同地区服调用不同下载节点。

// 按照oop的编程思想，这些都是对象。


?>