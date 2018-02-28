<?php

// 在模板模式（Template Pattern）中，一个抽象类公开定义了执行它的方法的方式/模板。

// 关键代码：在抽象类实现，其他步骤在子类实现。


abstract class Game {
	abstract function initialize();
	abstract function startPlay();
	abstract function endPlay();

	//模板
	final public function play(){

		//初始化游戏
		$this->initialize();

		//开始游戏
		$this->startPlay();

		//结束游戏
		$this->endPlay();
	}
}

// 篮球游戏
class Basketball extends Game {

	public function endPlay() {
		echo "Basketball Game Finished!".'<br/>';
	}

	public function initialize() {
		echo "Basketball Game Initialized! ".'<br/>';
	}

	public function startPlay() {
		echo "Basketball Game Started.".'<br/>';
	}
}

// 足球游戏
class Football extends Game {

	public function endPlay() {
		echo "Football Game Finished!".'<br/>';
	}

	public function initialize() {
		echo "Football Game Initialized!".'<br/>';
	}

	public function startPlay() {
		echo "Football Game Started.".'<br/>';
	}
}


// 使用 Game 的模板方法 play() 来演示游戏的定义方式
$game = new Basketball();
$game->play();
echo '<hr/>';
$game = new Football();
$game->play();        

// 结语：子类实现，但是客户端执行的时候是通过抽象类的方法执行的-表示并不清楚有什么优点，好像就是子类无论怎么扩展，我调用的方法是一样的