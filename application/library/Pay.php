<?php

require '../vendor/autoload.php';
use EasyWeChat\Foundation\Application;


class Pay {

    private   $Client;
    protected $Response;
    private   $ctripUrl = 'http://flights.ctrip.com/booking/';

    public function __construct()
    {
        $this->Response = new Response();

    }

    public function createQrUrl($productId)
    {
        $payment = $this->getOptions();
        return $payment->scheme($productId);

    }

    public function createOrder($order)
    {
        $payment = $this->getOptions();
        return $payment->prepare($order);
        
    }

    private function getOptions()
    {
        $options = [
                'app_id' => $_SERVER['APP_ID'],
                // payment
                'payment' => [
                'merchant_id'        => $_SERVER['MER_ID'],
                'key'                => $_SERVER['KEY'],
                'cert_path'          => '', // XXX: 绝对路径！！！！
                'key_path'           => '',      // XXX: 绝对路径！！！！
                'notify_url'         => '',       // 你也可以在下单时单独设置来想覆盖它
            ],
        ];

        $app = new Application($options);
        return $app->payment; 

    }

}
