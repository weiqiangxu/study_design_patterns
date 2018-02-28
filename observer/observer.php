<?php

// 定义：当对象间存在一对多关系时，则使用观察者模式（Observer Pattern）。比如，当一个对象被修改时，则会自动通知它的依赖对象。观察者模式属于行为型模式。

// 意图：定义对象间的一种一对多的依赖关系，当一个对象的状态发生改变时，所有依赖于它的对象都得到通知并被自动更新。


/****被观察者******/

    interface Teacher{
        function addObserver( $observer );
        function removeObserver( $observer );
    }

    class English implements Teacher{

        private $_observers = array();

        // 发送消息
        public function talk( $something ){
            echo 'teacher : '.$something.'<br/>';
            foreach( $this->_observers as $obs ){
                $obs->write( $something );
            }
        }
        // 添加观察者
        public function addObserver( $observer ){
            $this->_observers[]= $observer;
        }
        // 移除观察者
        public function removeObserver($observer_name) {
            foreach($this->_observers as $index => $observer)
            {
                if ($observer->getName() === $observer_name)
                {
                    // 删除该对象
                    unset($this->_observers[$index]);
                    return;
                }
            }
        }
    }


/*********观察者*********/

    interface Student{
        function write( $something );
        function getName();
    }
    // 观察者A
    class jack implements Student{
        public function write( $something ){
            echo 'jack write '.$something.'<br/>';
        }

        public function getName(){
            return 'jack';
        }
    }
    // 观察者B
    class rose implements Student{
        public function write( $something ){
            echo 'rose write '.$something.'<br/>';
        }

        public function getName(){
            return 'rose';
        }
    }


    $obj = new English();//被观察者
    $obj->addObserver( new jack() );//增加观察者
    $obj->addObserver( new rose() );//增加观察者


    $obj->talk( " i will be a hero. " );//被观察者执行动作，观察者也会作出相应的响应
    echo '<hr/>';

    $obj->removeObserver('rose');//移除观察者
    $obj->talk( " i will be a richman. " );//被观察者执行动作，观察者也会作出相应的响应


// 实际使用场景：用户网上购票完成以后的回调：1、短信通知。2、日志记录。3、积分赠送。那么此时购票这个对象就是被观察者，另外三个操作就是观察者。

// 结语：观察者模式是非常常用的一种模式，主要解决了一个对象状态改变给其他对象通知的问题，而且提高易用和降低耦合，保证各个子系统高度的协作。


?>