<?php

// 中介者模式（Mediator Pattern）是用来降低多个对象和类之间的通信复杂性。
// 这种模式提供了一个中介类，该类通常处理不同类之间的通信，并支持松耦合，使代码易于维护。
// 中介者模式属于行为型模式。

// 优点： 1、降低了类的复杂度，将一对多转化成了一对一。 2、各个类之间的解耦。 3、符合迪米特原则。


// 我们通过聊天室实例来演示中介者模式。

// 创建中介类
class ChatRoom {
   public static function showMessage($user, $message){
        echo date("Y-m-d H:i:s",time())." [".$user->getName()."] : ".$message.'<br/>';
   }
}

// 对象
class User {
   private $name;

   public function getName() {
      return $this->name;
   }

   public function setName($name) {
      $this->name = $name;
   }

   public function __construct($name){
      $this->name  = $name;
   }

   public function sendMessage($message){
      ChatRoom::showMessage($this,$message);
   }
}


// client

$robert = new User("Robert");
$john = new User("John");
$jack = new User("Jack");

$robert->sendMessage("Hi! John!");
$john->sendMessage("Hello! Robert!");
$jack->sendMessage("Hello! i am jack!");

// 因为聊天室，多个对象的交互变得简单。
// 实际应用场景：赛车游戏等多人在线平台游戏，他们之间的互动比如比分不可能是一对一的处理的，比如a的得分与b\c\d对比，在拿b与a\c\d的得分做对比，太麻烦了往往是将他们的分数统统交给一个对象处理，又比如玩家交流。比如卖家买家之间的金钱流动，变成了单一的买家《=》平台，平台《=》卖家，逻辑会变得更加清晰。使得他们的交互记录也会变得简单化。

// 结语：中介者使各个对象之间不需要显式地相互引用，从而使耦合性降低，而且可以独立地改变它们之间的交互行为。


?>