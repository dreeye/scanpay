<?php

require '../vendor/autoload.php';
use EasyWeChat\Foundation\Application;


class Pay {

    private   $appId;
    private   $mchId;
    private   $key;
    protected $Response;

    public function __construct($appId, $mchId, $key)
    {
        $this->Response = new Response();
        $this->appId = $appId;
        $this->mchId = $mchId;
        $this->key = $key;

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
                'app_id' => $this->appId,
                // payment
                'payment' => [
                'merchant_id'        => $this->mchId,
                'key'                => $this->key,
                'cert_path'          => '', // XXX: 绝对路径！！！！
                'key_path'           => '',      // XXX: 绝对路径！！！！
                'notify_url'       => 'http://scanpay.vzhen.com/scan/order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            ],
        ];

        $app = new Application($options);
        return $app->payment; 

    }

}
