<?php
// 场景：原型模式（Prototype Pattern）是用于创建重复的对象，同时又能保证性能。因为有些对象创建非常耗费内存，比如用户主页展示的模块是建造者模式实现的多个对象组合成的一个对象，每一个对象的属性都有数据并且数据是该对象从数据库之中获取的，那么这个很大的对象的创建就会变得非常耗费内存，那么就不在经由__construct而是直接clone，额好像，很多关于原型模式的说明都变成了简单的克隆对象，clone只是一种方式，虽然我还没想到其他方式

interface Prototype { public function copy(); }
 
class ConcretePrototype implements Prototype{
    private  $_name;
    public function __construct($name) { $this->_name = $name; } 
    public function copy() { return clone $this;}
}
 
class Demo {}
 
// client
 
$demo = new Demo();
$object1 = new ConcretePrototype($demo);
$object2 = $object1->copy();
?>

<!-- 优点： 1、性能提高。 2、逃避构造函数的约束。 -->