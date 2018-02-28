<?php

// 组合模式（Composite Pattern），又叫部分整体模式，是用于把一组相似的对象当作一个单一的对象。

// 解决：当一个对象由多个相似的对象组成的时候，比如菜单栏、文件夹管理，每个选项作为一个对象用于组成一个大对象，组合模式降低大对象与成员对象的耦合（就是增加一个成员对象不用改大对象的代码）。

// 例子：我们有一个类 Employee，该类被当作组合模型类。CompositePatternDemo，我们的演示类使用 Employee 类来添加部门层次结构，并打印所有员工。

// 缺点：在使用组合模式时，其叶子和树枝的声明都是实现类，而不是接口，违反了依赖倒置原则。
// 高层模块不应该依赖低层模块，二者都应该依赖其抽象，抽象不应该依赖细节，细节应该依赖抽象。

class Employee {

   private $name;
   private $dept;
   private $salary;
   private $subordinates;

   //构造函数
   public function __construct($name,$dept,$sal) {
      $this->name = $name;
      $this->dept = $dept;
      $this->salary = $sal;
      $this->subordinates = array();
   }

   public function add(Employee $e) {
      array_push($this->subordinates,$e);
   }

   public function remove(Employee $e) {
      foreach ($this->subordinates as $k => $v) {
         if($v == $e )
         {
            unset($this->subordinates[$k]);
         }
      }
   }

   public function getSubordinates(){
     return $this->subordinates;
   }

   public function toString(){
      return "Employee :[ Name : ".$this->name.", dept : ".$this->dept.", salary :".$this->salary." ]";
   }   
}


// 创建很多的叶子对象
$CEO = new Employee("John","CEO", 30000);

$headSales = new Employee("Robert","Head Sales", 20000);

$headMarketing = new Employee("Michel","Head Marketing", 20000);

$clerk1 = new Employee("Laura","Marketing", 10000);
$clerk2 = new Employee("Bob","Marketing", 10000);

$salesExecutive1 = new Employee("Richard","Sales", 10000);
$salesExecutive2 = new Employee("Rob","Sales", 10000);

// 组合成大对象
$CEO->add($headSales);
$CEO->add($headMarketing);

$headSales->add($salesExecutive1);
$headSales->add($salesExecutive2);

$headMarketing->add($clerk1);
$headMarketing->add($clerk2);

//打印该组织的所有员工(七个对象组合成的大对象)
print_r($CEO).'<br/>';

foreach ($CEO->getSubordinates() as $k => $v) {
   print_r($v);
   foreach ($v->getSubordinates() as $kk => $vv) {
      print_r($vv);
   }
}
