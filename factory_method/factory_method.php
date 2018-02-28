<?php

// 常用场景：
// 支付宝和微信支付,在生成订单以后会出现两个付款按钮，分别对应wechat、alipay。这个时候只需要调用同一个function传递不同参数就可以分别获取不同的支付类的对象，那么这个实现订单付款的程序员a不需要知道alipay的类名称是什么，也不需要知道wechat的类名称是什么，只需要传递不同参数就可以。这是一个解耦的实现。
// 实现：
// 实现接口，通过内部方法传参获取不同的对象。

class Pay{/* ...*/}
class AliPay extends Pay{/* ...*/}
class WechatPay extends Pay{/* ...*/}

/********菜鸟程序员角度解决问题,代码就到这里咯！************/
$AliPay = new AliPay();
$WechatPay = new WechatPay();

/**************工厂方法角度解决问题*********************/

// 接口
interface PayFactory{
    public function createPay($type);
}

// 实现接口
class MyPayFactory implements PayFactory{
    // 实现工厂方法
    public function createPay($type){
        switch($type){
            case 'Wechat':
                return new WechatPay();
            case 'Ali':
                return new AliPay();
        }
    }
}

$pay_obj = new MyPayFactory();
var_dump($pay_obj->createPay('Wechat'));
var_dump($pay_obj->createPay('Ali'));

// 结语：
// 很明显，我直接实例化对象的代码显得更加简短，而工厂方法却显得代码冗余了，但是当项目变的庞大的时候，获取统统下架wechat支付，并且增加一个PayPal支付的时候，每一个用到$wechatPay = new wechatpay()的代码都需要改成$Paypal = new PaypalPay();是有多么让人疯狂。而工厂方法模式角度实现的逻辑却让你仅仅检查一下MyPayFactory()调用createPay方法时候传递的参数更改一下就可以。 

?>