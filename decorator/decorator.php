<?php

// 装饰器模式（Decorator Pattern）允许向一个现有的对象添加新的功能，同时又不改变其结构。

// 场景：需要创建可以执行行为1的对象A，之后想给A对象增加一个功能却不改A类定义代码。
// 1、扩展一个类的功能。2、动态增加功能，动态撤销。这个新功能就像装饰品一样可以被随意增加移除。

// 实例：以下B只具有'加点辣椒的功能'，将A的的'加点酱油的功能'添加给B，却不用改动B类代码



/*******************装饰角色：持有一个抽象构件的引用*******************/
abstract class Decorator implements Component{ 
    protected  $_component;
    public function __construct(Component $component) {
        $this->_component = $component;
    }
    public function operation() {
        $this->_component->operation();
    }
}

// 具体装饰类A
class ConcreteDecoratorA extends Decorator { 
    public function __construct(Component $component) {
        parent::__construct($component);
    } 
    public function operation() {
        parent::operation();    //  调用装饰类的操作
        $this->addedOperationA();   //  新增加的操作
    }
    public function addedOperationA() {echo 'A加点酱油;';}
}

// 具体装饰类B
class ConcreteDecoratorB extends Decorator { 
    public function __construct(Component $component) {
        parent::__construct($component);
    } 
    public function operation() {
        parent::operation();
        $this->addedOperationB();
    }
    public function addedOperationB() {echo "B加点辣椒;";}
}


/*******************抽象构件角色：真实对象和装饰对象有相同的接口。*******************/
interface Component {
    public function operation();
}
 
//具体构件角色
class ConcreteComponent implements Component{ 
    public function operation() {} 
}


 
// 代码演示对象功能的添加
$component = new ConcreteComponent();
// 具体装饰器A
$decoratorA = new ConcreteDecoratorA($component);
// 具体装饰器B
$decoratorB = new ConcreteDecoratorB($decoratorA);

$decoratorA->operation();
echo '<br>';
$decoratorB->operation();


// 妙处在于将可功能对象作为装饰器，该装饰器也具有增减装饰器功能

// 从而实现给对象添加功能却不改代码，在上面就是给B添加功能

?>