<?php

// 通过继承或依赖(推荐)将一个类的接口转换成客户希望的另外一个接口。适配器模式使得原本由于接口不兼容而不能一起工作的那些类可以一起工作。就是，假定一个类a可以播放mp3另一个类b可以播放mp4,我要让类a能够播放mp4、这就是适配器模式角度解决的问题。不符合oop思想，所以：适配器不是在详细设计时添加的，而是解决正在服役的项目的问题。如果详细设计请把对象之间的耦合关系降低。不要随便乱用适配器模式，对象应当是更独立、完整。


/*****************对象适配器：通过类内部引用另一个类对象执行另一个类的function*******************/

interface Target {
    public function sampleMethod1();
    public function sampleMethod2();
}
 
class Adaptee {
    public function sampleMethod1() {
    	echo 'Target-Adaptee-sampleMethod1<br>';
    }
}
 
class Adapter implements Target {
    private $_adaptee;

    public function __construct(Adaptee $adaptee) {
        $this->_adaptee = $adaptee;
    }
 
    public function sampleMethod1() {
    	$this->_adaptee->sampleMethod1(); 
    }
 
    public function sampleMethod2() {
    	echo 'Target-Adapter-sampleMethod2<br>';
    }
}
 

$adapter = new Adapter(new Adaptee());
$adapter->sampleMethod1();
$adapter->sampleMethod2();


/*****************类适配器：通过类继承获取另一个类的function********************************/
interface Target2 {
    public function sampleMethod1();
    public function sampleMethod2();
}
 
class Adaptee2 { // 源角色
    public function sampleMethod1() {echo "Target2-Adaptee2-sampleMethod1<br>";}
}
 
class Adapter2 extends Adaptee2 implements Target2 { // 适配后角色
    public function sampleMethod2() {echo "Target2-Adapter2-sampleMethod2<br>";} 
}

$adapter = new Adapter2();
$adapter->sampleMethod1();
$adapter->sampleMethod2(); 

?>