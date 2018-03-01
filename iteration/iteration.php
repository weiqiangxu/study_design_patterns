<?php

// 迭代：自己调用自己，比如foreach一个数组，该数组不断地自己调用自己打印出内部一个个的元素
// php.net官方文档之中的Iterator（迭代器）接口有五个抽象方法

class sample implements Iterator {
    private $_items ;
 
    public function __construct(&$data) {
        $this->_items = $data;
    }
    // // Iterator::current — 返回当前元素
    public function current() {
        return current($this->_items);
    }
    // Iterator::next — 向前移动到下一个元素
    public function next() {
        next($this->_items);   
    }
    // Iterator::key — 返回当前元素的键
    public function key() {
        return key($this->_items);
    }
    // 返回第一个
    public function rewind() {
        reset($this->_items);
    }
    // Iterator::valid — 检查当前位置是否有效
    public function valid() {                                                                              
        return ($this->current() !== FALSE);
    }
}
 
// client
$data = array(1, 2, 3, 4, 5);
$sa = new sample($data);
foreach ($sa AS $key => $row) {
    echo $key, ' ', $row, '<br />';
}


// foreach一个数组，好理解，调用迭代器不断读取自身元素，指针往后走，那么调用一个对象呢，如何用迭代顺序访问集合对象的元素，而又不需要知道集合对象的底层表示。就是将这个对象作为迭代器的实现。

//  使用场景：   
// 1.访问一个聚合对象的内容而无需暴露它的内部表示

// 2.支持对聚合对象的多种遍历

// 3.为遍历不同的聚合结构提供一个统一的接口

?>