<?php

// 1、概念
    // 门面模式是对象的结构模式，外部与一个子系统的通信必须通过一个统一的门面对象进行。门面模式提供一个高层次的接口，使得子系统更易于使用。
// 2、针对的问题
    // 为子系统提供一个高层次的接口，使子系统易于使用。当你要为一个复杂子系统提供一个简单接口时、客户程序与抽象类的实现部分之间存在着很大的依赖性、当你需要构建一个层次结构的子系统时，使用facade模式定义子系统中每层的入口点。
// 3、角色组成
// 门面模式是对象的结构模式。
// 门面(Facade)角色，子系统(subsystem)角色。客户端调用一个facade去与多个子系统交互，对于子系统而言门面facade只是一个客户端而已。
// 4、使用实例
// laravel的数据库层：Laravel 应用中，门面就是一个为容器中对象提供访问方式的类。该机制原理由 Facade 类实现。Laravel 自带的门面，以及我们创建的自定义门面，都会继承自 Illuminate\Support\Facades\Facade 基类。在laravel之中经常是facade去调用一个对象容器内部的某一个对象比如redis缓存还是MongoDB（所以经常是facade后面接着一个factory）。

// 子系统-摄像头
class Camera {
    public function turnOn() {}
    public function turnOff() {}
    public function rotate($degrees) {}
}

// 子系统-闪光灯
class Light {
    public function turnOn() {}
    public function turnOff() {}
    public function changeBulb() {}
}

// 子系统-传感器
class Sensor {
    public function activate() {}
    public function deactivate() {}
    public function trigger() {}
}

// 子系统-快门声
class Alarm {
    public function activate() {}
    public function deactivate() {}
    public function ring() {}
    public function stopRing() {}
}

// 门面-通过这个门面去调用子系统
class SecurityFacade {
    private $_camera1, $_camera2;
    private $_light1, $_light2, $_light3;
    private $_sensor;
    private $_alarm;
    
    // 构造函数
    public function __construct() {
        $this->_camera1 = new Camera();
        $this->_camera2 = new Camera();
 
        $this->_light1 = new Light();
        $this->_light2 = new Light();
        $this->_light3 = new Light();
 
        $this->_sensor = new Sensor();
        $this->_alarm = new Alarm();
    }
    // 激活
    public function activate() {
        $this->_camera1->turnOn();
        $this->_camera2->turnOn();
 
        $this->_light1->turnOn();
        $this->_light2->turnOn();
        $this->_light3->turnOn();
 
        $this->_sensor->activate();
        $this->_alarm->activate();
    }
    // 停用
    public function deactivate() {
        $this->_camera1->turnOff();
        $this->_camera2->turnOff();
 
        $this->_light1->turnOff();
        $this->_light2->turnOff();
        $this->_light3->turnOff();
 
        $this->_sensor->deactivate();
        $this->_alarm->deactivate();
    }
}
 
 
//client-客户端 
$security = new SecurityFacade();
$security->activate();

?>