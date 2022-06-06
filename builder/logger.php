<?php

class LoggerMessage{
    public $userName;
    public $level;
    public $userIp;
}

function builder( $OptionFuncList ){
    $l = new LoggerMessage();
    foreach ($OptionFuncList as $value) {
        $value->set($l);
    }
    return $l;
}

interface OptionFunc {
    public function set(LoggerMessage $logger);
}

class SetLevel implements OptionFunc
{
    public $data;
    public function __construct($data) {
        $this->data = $data;    
    }
    public function set($logger){
        $logger->level = $this->data;
    }
}

class SetUserIp implements OptionFunc
{
    public $data;
    public function __construct($data) {
        $this->data = $data;    
    }
    public function set($logger){
        $logger->userIp = $this->data;
    }
}

$logger = new LoggerMessage();
$list = array(
    new SetUserIp("127.0.0.1"),
    new SetLevel("info")
);
$z = builder($list);
var_dump(json_encode($z));