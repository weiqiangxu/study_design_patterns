<?php

// 解释器模式（Interpreter Pattern）提供了评估语言的语法或表达式的方式，它属于行为型模式。

//抽象表示
class Expression { 
    function interpreter($str) { 
        return $str; 
    } 
} 

// //表示数字
class ExpressionNum extends Expression { 
    function interpreter($str) { 
        switch($str) { 
            case "0": return "零"; 
            case "1": return "一"; 
            case "2": return "二"; 
            case "3": return "三"; 
            case "4": return "四"; 
            case "5": return "五"; 
            case "6": return "六"; 
            case "7": return "七"; 
            case "8": return "八"; 
            case "9": return "九"; 
        } 
    } 
} 

//表示字母
class ExpressionCharater extends Expression { 
    function interpreter($str) { 
        return strtoupper($str); 
    } 
} 

//解释器
class Interpreter { 
    // 解释字符
    public static function execute($string)
    { 
        $expression = null;
        foreach (str_split($string) as $v)
        {
            $expression = is_numeric($v)?new ExpressionNum():new ExpressionCharater(); 
            echo $expression->interpreter($v);
            echo "<br>"; 
        }
    } 
} 

//client
Interpreter::execute("123s45abc"); 

// 这种模式被用在 SQL 解析、符号处理引擎等。

// 就是转义的一种，比如程序员阶段有123,用中文表示是初级、中级、高级,用english表示是one、two、three,而在万物皆是对象的oop编程思想之中将中英各自封为对象以降低耦合，即使再来一个粤语也不至于改动太多代码(耦合度高)


?>