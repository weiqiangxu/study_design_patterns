<?php

// 概念：在代理模式（Proxy Pattern）中，一个类代表另一个类的功能。这种类型的设计模式属于结构型模式。
// 主要解决：在直接访问对象时带来的问题。
// 何时使用：想在访问一个类时做一些控制。
// 如何解决：增加中间层（代理）。

// 注意事项： 1、和适配器模式的区别：适配器模式主要改变所考虑对象的接口，而代理模式不能改变所代理类的接口。 2、和装饰器模式的区别：装饰器模式为了增强功能，而代理模式是为了加以控制。

// 实现

// 我们将创建一个 Image 接口和实现了 Image 接口的实体类。

interface Image {
   public function display();
}

class RealImage implements Image {

   private $fileName;

   public function __construct($fileName){
        $this->fileName = $fileName;
   }

   public function display() {
    echo "RealImage Displaying ".$this->fileName."<br>";
   }

   private function loadFromDisk($fileName){
    echo "Loading ".$fileName."<br>";
   }
}

// 代理类
class ProxyImage implements Image{

   private $realImage;
   private $fileName;

   public function __construct($fileName){
      $this->fileName = $fileName;
   }

   public function display() {
      if(!$this->realImage){
         $this->realImage = new RealImage($this->fileName);
      }
      $this->realImage->display();
   }
}


// client
$image = new ProxyImage("test_10mb.jpg");
$image->display(); 
 


 /*********************************github 博主的代码*************************************************/

abstract class Subject { // 抽象主题角色
    abstract public function action();
}

class RealSubject extends Subject { // 真实主题角色
    public function __construct() {}
    public function action() {
        echo 'i am RealSubject'."<br>";
    }
}

class ProxySubject extends Subject { // 代理主题角色
    private $_real_subject = NULL;
    public function __construct() {}

    public function action() {
        $this->_beforeAction();
        if (is_null($this->_real_subject)) {
            $this->_real_subject = new RealSubject();
        }
        $this->_real_subject->action();
        $this->_afterAction();
    }

    private function _beforeAction() {
        echo '在action前,我想干点啥....'."<br>";
    }

    private function _afterAction() {
         echo '在action后,我还想干点啥....'."<br>";
    }
}

// client
$subject = new ProxySubject();
$subject->action();


// 优点

// 在客户端对一个对象的引用之前，可以加一些限制，通过代理。都是通过对代理间接地对真实的对象进行引用