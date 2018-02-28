<?php

// 定义：责任链模式的定义：使多个对象都有机会处理请求，从而避免请求的发送者和接受者之间的耦合关系， 将这个对象连成一条链，并沿着这条链传递该请求，直到有一个对象处理他为止。
// 发出这个请求的客户端并不知道链上的哪一个对象最终处理这个请求，这使得系统可以在不影响客户端的情况下动态地重新组织和分配责任。

// Demo改自：菜鸟教程-责任链模式

// 实例讲解：程序出错的时候，不同错误级别对应的处理对象也不同，通过责任链，将错误级别分级传递，直到错误级别被相应的对象处理。(也可以让请求被每一个对象处理)
// 严重错误=》错误=》警告

/**************抽象处理者(Handler)角色*********/
abstract class AbstractLogger { 
    public static $warn = 1;
    public static $error = 2;
    public static $fatal = 3;

    protected $level;

    //责任链中的下一个元素
    protected $nextLogger;

    // 设定下一个级别对象
    function setNextLogger(AbstractLogger $nextLogger){
      $this->nextLogger = $nextLogger;
    }

    // 处理请求
    function logMessage($level,$message){

        // 如果当前处理者可以处理当前请求则程序结束
        if($this->level <= $level){
            $this->write($message);
            exit();
        }

        // 如果请求未被处理传递给下一级对象处理
        if($this->nextLogger != null){
            $this->nextLogger->logMessage($level, $message);
        }
    }

   abstract protected function write($message);
}

/********具体处理者(ConcreteHandler)角色*****************/

// 警告级别
class WarnLogger extends AbstractLogger {

    function __construct($level){
        $this->level = $level;
    }

    protected function write($message) {
        echo "Warn::Logger: ".$message."<br>";
    }
}

// 错误级别
class ErrorLogger extends AbstractLogger {

   function __construct($level){
      $this->level = $level;
   }

    protected function write($message) {
        echo "Error::Logger: ".$message."<br>";
    }
}

// 严重错误级别
class FatalLogger extends AbstractLogger {

    function __construct($level){
        $this->level = $level;
    }

    protected function write($message) {
        echo  "Fatal::Logger: ".$message."<br>";
    }
}

class Chain {
    
    // 指定责任链层级关系
    public static function getChainOfLoggers(){
        // 严重错误
        $fatalLogger = new FatalLogger(AbstractLogger::$fatal);
        // 错误
        $errorLogger = new ErrorLogger(AbstractLogger::$error);
        // 警告
        $WarnLogger = new WarnLogger(AbstractLogger::$warn);
        // 如果不是严重错误交于错误级别处理
        $fatalLogger->setNextLogger($errorLogger);
        // 如果不是错误则判定是否警告级别
        $errorLogger->setNextLogger($WarnLogger);
        // 返回严重错误级别实例
        return $fatalLogger;    
   }
}

$Chain = Chain::getChainOfLoggers();

// 传递1、2、3数字，不同级别交给不同"具体处理者(ConcreteHandler)角色"处理请求。
$Chain->logMessage(1,"i am exception message.");

// 结语：通过责任链减少请求的发送者和接受者之间的耦合关系。程序出错不需要在处理时候就进行错误级别判定而是直接交给错误处理对象就可以。该对象会根据错误级别按责任链传递。

/*********************菜鸟程序员角度解决问题**********************************/
// if("warn")
// {
//     $WarnLogger = new $WarnLogger();
//     /* ---  */
// }
// elseif("error")
// {
//     $ErrorLogger = new $ErrorLogger();
//     /* ---  */
// }
// 在处理程序错误的时候需要知道不同级别的处理对象是什么，这个就叫高度耦合，而且再扩展一个debug级别，就需要大改。而不是像责任链设计模式角度实现的程序一样-仅仅扩展责任链级别