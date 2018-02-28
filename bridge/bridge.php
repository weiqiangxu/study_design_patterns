<?php

// 桥接（Bridge）是用于把抽象化(Shape)与实现化(DrawAPI)解耦，使得二者可以独立变化。

// 创建桥接实现接口-DrawAPI
interface DrawAPI {
   public function drawCircle($radius, $x, $y);
}

// 创建实现了 DrawAPI 接口的实体桥接实现类A
class RedCircle implements DrawAPI {
    public function drawCircle($radius, $x, $y) {
        echo "Drawing Circle[ color: red, radius: ".$radius.", x: ".$x.", ".$y."] ";
    }
}

// 创建实现了 DrawAPI 接口的实体桥接实现类B
class GreenCircle implements DrawAPI {
    public function drawCircle($radius,$x,$y) {
        echo "Drawing Circle[ color: green, radius: ".$radius.", x: ".$x.", ".$y."] ";
    }
}

/***********高耦合代码就到这里了-直接调用实现类**************/

$RedCircle = new RedCircle();$RedCircle->drawCircle(100,100,10);
$GreenCircle = new GreenCircle();$GreenCircle->drawCircle(100,100,10);


/*******桥接模式角度*********/

// 使用 DrawAPI 接口创建抽象类Shape
abstract class Shape {
    public $drawAPI;
    abstract public function draw();    
}

// 创建实现了 Shape 接口的实体类
class Circle extends Shape {
    public $x, $y, $radius;
    public function __construct($x, $y, $radius, DrawAPI $drawAPI) {
        $this->drawAPI = $drawAPI;
        $this->x = $x;  
        $this->y = $y;  
        $this->radius = $radius;
    }
    public function draw() {
        $this->drawAPI->drawCircle($this->radius,$this->x,$this->y);
    }
}


$redCircle = new Circle(100,100, 10, new RedCircle());
$greenCircle = new Circle(100,100, 10, new GreenCircle());

$redCircle->draw();
$greenCircle->draw();

// 个人理解: 通过依赖注入降低抽象类Shape->draw(行为执行者)与实现类DrawAPI->drawCircle(行为定义者)的耦合