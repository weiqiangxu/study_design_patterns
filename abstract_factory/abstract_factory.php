<?php

// 场景：
// mac对应两个对象由mac工厂生产;win对应两个对象由win工厂生产;而且这两个工厂生产的对象是一样的，而且以后可能还会有linux工厂并且这个linux工厂生产的对象也和前面两个一样的，那么你可能需要以抽象工厂模式角度去解决问题，达到解耦、复用和方便后期维护拓展的目的。

// 在win和mac系统的button和border不一样,需要不同的对象分别处理win和mac的button以及border。那么我需要不同情况下实例化四个对象，并且在每一种调用button的时候用if语句去判定到底我应该用哪一个对象然后实例化，很明显如果以后再加一个linux-button和linux-border,那么又要告诉程序员：我加了一个linux-button他的类名称是linuxButton，非常麻烦。
// 实现：
// 用对象接口interface对应方法，该对象接口不同实现类获取不同类对象。

class Button{}
class Border{}

class MacButton extends Button{
	function __construct(){
		echo 'i am MacButton'."<br/>";
	}
}
class WinButton extends Button{
	function __construct(){
		echo 'i am WinButton'."<br/>";
	}
}
class MacBorder extends Border{
	function __construct(){
		echo 'i am MacBorder'."<br/>";
	}
}
class WinBorder extends Border{
	function __construct(){
		echo 'i am WinBorder'."<br/>";
	}
}

/********菜鸟程序员角度解决问题,代码就到这里咯！************/
$MacButton = new MacButton();
$MacBorder = new MacBorder();
$WinButton = new WinButton();
$WinBorder = new WinBorder();


/**********************抽象工厂角度解决问题************************************/

interface AbstractFactory {
    public function CreateButton();
    public function CreateBorder();
}

class MacFactory implements AbstractFactory{
    public function CreateButton(){ return new MacButton(); }
    public function CreateBorder(){ return new MacBorder(); }
}

class WinFactory implements AbstractFactory{
    public function CreateButton(){ return new WinButton(); }
    public function CreateBorder(){ return new WinBorder(); }
}

// 改变工厂就可以获取到相应的类
$MacFactory = new MacFactory();
// 获取MacButton对象
$MacFactory->CreateButton();
// 获取MacBorder对象
$MacFactory->CreateBorder();


/************优化后的代码好在哪里？*********************/
// 无论小白程序需要mac的button、border对象还是win的，都只需要调用不同的工厂就可以，也不用考虑我的mac-button类名称是什么，反正简简单单,mac/win工厂调用CreateButton/CreateBorder,就可以获取四个对象了。为什么用interface呢？如果需要扩展一个linux,我不需要告诉负责扩展linux的程序员要实现什么，叫他看接口interface就可以了。使用linux的相应对象的程序员也根据这个interface，直接获取linux工厂然后createbutton就可以了。

// 结语：抽象工厂使程序具有更好的可扩展性，降低了非常多的程序员a、b、c的沟通成本。试想一下如果我要linux-button的对象的时候就要看一下这个类名称是什么，要win对应的btn对象的时候也要调用相应的类名称实例化，那该有多累，而且这种代码对于程序员就是一个low的标志。

?>