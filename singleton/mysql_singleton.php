<?php

// 场景：
// 在PHP运行的时候，会有N个MySQL资源句柄（pdo对象或者mysqli.dll扩展的对象）被创建，但是需要保证MySQL对象是同一个，单例模式实现类对象不会被无限创建，减少内存泄漏以及mysql的最大连接数控制。
// 实现：
// 私有构造方法，用一个公共方法去获取类的对象。并且将类对象保存为类对象。

	class Mysql{
		//该属性用来保存实例
		private static $conn;

		//构造函数为private,防止创建对象
		private function __construct(){
			$this->conn = mysql_connect('localhost','root','');
		}

		//创建一个用来实例化对象的方法
		public static function getInstance(){
			if(!(self::$conn instanceof self)){
				self::$conn = new self;
			}
			return self::$conn;
		}

		//防止对象被复制
		public function __clone(){
			trigger_error('Clone is not allowed !');
		}
		
	}
    
	//只能这样取得实例，不能new 和 clone
	$mysql = Mysql::getInstance();
?>