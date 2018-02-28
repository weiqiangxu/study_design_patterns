<?php

// 享元模式（Flyweight Pattern）结构型模式,主要用于减少创建对象的数量，以减少内存占用和提高性能。

// 在有大量对象时，有可能会造成内存溢出，我们把其中共同的部分抽象出来，如果有相同的业务请求，直接返回在内存中已有的对象，避免重新创建。

abstract class Resources{
	public $resource=null;

	abstract public function operate();
}

class unShareFlyWeight extends Resources{
	public function __construct($resource_str) {
        $this->resource = $resource_str;
    }

    public function operate(){
    	echo $this->resource."<br>";
    }
}

/**************不共享的对象，单独调用，这里声明了两个对象********************/
$uflyweight = new unShareFlyWeight('A');
$uflyweight->operate();
$uflyweight = new unShareFlyWeight('B');
$uflyweight->operate();
echo '<hr/>';


/***************享元模式（Flyweight Pattern）角度解决问题***************/

class shareFlyWeight extends Resources{
	private $resources = array();

    public function get_resource($resource_str){
    	if(isset($this->resources[$resource_str])) {
		    return $this->resources[$resource_str];
		}else {
		    return $this->resources[$resource_str] = $resource_str;
		}
    }

	public function operate(){
		foreach ($this->resources as $key => $resources) {
			echo $key.":".$resources."<br>";
		}
	}
}

 
// client
$flyweight = new shareFlyWeight();
$flyweight->get_resource('A');
$flyweight->get_resource('B');
$flyweight->operate();

// 结语:
// 在上面的例子之中，同样的操作a、b，但是享元模式(共享对象)只声明了一个对象，减少了内存的浪费。
// 实际开发过程之中的例子有：比如我要给10000个人发送邮件告知新春特惠活动开启，这几个对象的不同在于邮件地址不同，那么我是声明10000个对象好呢，还是共享一个对象，然后通过传参分别给10000个人发送邮件好呢

// 可以仿照 https://zhuanlan.zhihu.com/p/24454483 测试microtime程序执行时间测试享元模式是否节省了开销