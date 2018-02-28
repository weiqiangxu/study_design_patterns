<?php

// 简介：建造者模式（Builder Pattern）使用多个简单的对象一步一步构建成一个复杂的对象。
// 使用场景：一些基本部件不会变，而其组合经常变化的时候

/********************建造者：创建和提供实例***************************************/
// 食物条目接口（名称、包装、价格）
interface Item {
    public function name();
    public function packing();
    public function price();
}

// 食物包装的接口（包装）
interface  Packing {
    public function pack();
}


// 创建实现 Packing 接口的实体类-纸盒
class Wrapper implements Packing {
    public function pack() {
        return "Wrapper";
    }
}

// 创建实现 Packing 接口的实体类-瓶装
class Bottle implements Packing {
    public function pack() {
        return "Bottle";
    }
}

// 创建实现 Item 接口的抽象类-汉堡(纸盒)，该类提供了默认的功能。
abstract class Burger implements Item {

    public function packing() {
        return new Wrapper();
    }
    public abstract function price();
}

// 创建实现 Item 接口的抽象类-冷饮(瓶装)，该类提供了默认的功能。
abstract class ColdDrink implements Item {
    public function packing() {
        return new Bottle();
    }
    public abstract function price();
}

// 创建扩展了 Burger 的实体类-蔬菜汉堡（纸盒+价格+名称）
class VegBurger extends Burger {
    public function price() {
        return 25.0;
    }
    public function name() {
        return "Veg Burger";
    }
}

// 创建扩展了 Burger 的实体类-鸡腿堡（纸盒+价格+名称）
class ChickenBurger extends Burger {
    public function price() {
        return 50.5;
    }
    public function name() {
        return "Chicken Burger";
    }
}

// 创建扩展了 ColdDrink 的实体类-可口可乐（瓶装+价格+名称）
class Coke extends ColdDrink {
    public function price() {
        return 30.0;
    }
    public function name() {
        return "Coke";
    }
}

// 创建扩展了 ColdDrink 的实体类-百事可乐（瓶装+价格+名称）
class Pepsi extends ColdDrink {
    public function price() {
        return 35.0;
    }
    public function name() {
        return "Pepsi";
    }
}

// 创建一个 Meal 类，带有上面定义的 Item 对象。
class Meal {

    private $item = array();

    // 添加条目
    public function addItem(Item $item){
        $this->items[] = $item;
    }
    // 获取总价
    public function getCost(){
        $cost = 0.0;
        foreach ($this->items as $key => $value) {
            $cost += $value->price();
        }       
        return $cost;
    }
    // 套餐总览
    public function showItems(){
        foreach ($this->items as $key => $value) {
            echo "Item : ".$value->name().", <br>";
            echo "Packing : ".$value->packing()->pack().", <br>";
            echo "Price : ".$value->price()."<br>";
        }      
   }    
}

/*****************导演：管理建造出来的实例的依赖关系**********************************/

// 创建一个 MealBuilder 类，实际的 builder 类负责创建 Meal 对象
class MealBuilder {

    // 制造蔬菜汉堡+可乐套餐
    public function prepareVegMeal (){
        $meal = new Meal();
        $meal->addItem(new VegBurger());
        $meal->addItem(new Coke());
        return $meal;
    }   

    // 制造鸡腿汉堡+百事可乐套餐
    public function prepareNonVegMeal (){
        $meal = new Meal();
        $meal->addItem(new ChickenBurger());
        $meal->addItem(new Pepsi());
        return $meal;
    }
}

/************演示建造者模式建造复杂的对象******************/
$mealBuilder = new MealBuilder();

$vegMeal = $mealBuilder->prepareVegMeal();
echo "Veg Meal"."<br>";
$vegMeal->showItems();
echo "Total Cost: ".$vegMeal->getCost()."<br>";

echo "<hr>"."Non-Veg Meal";
$nonVegMeal = $mealBuilder->prepareNonVegMeal();

$nonVegMeal->showItems();
echo "Total Cost: ".$nonVegMeal->getCost();

// 结语：降低耦合，在组成套餐的代码之中不需要实例化每一个类对象，直接通过套餐名获取就可以（导演），实际开发之中使用情况有：比如在论坛之中，不同身份（版主、普通用户、VIP看到的模块是不一样的），每一个模块一个对象去调用（听着像是RBAC权限控制，反正原理差不多但是实现机制不同），模块为对象，导演（类似RBAC权限数据库表）指定各个身份映射的模块组合。