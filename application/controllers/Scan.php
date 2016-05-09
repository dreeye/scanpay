<?php
require '../vendor/autoload.php';
use EasyWeChat\Payment\Order;


class ScanController extends Core
{
    private $option;

    public function init()
    {
        parent::init();
        
    }

    public function create_itemAction()
    {
        $payLib = new Pay();
        $productId = $this->Common->random_string('alnum', 32);
        $qrUrl = $payLib->createQrUrl($productId);
        $data = [
            'qr'=>$qrUrl,
            'createTime'=>time(),
        ];
        $this->Response->success($data);
        
        /*$from = ( $this->_post['from'] ?? $this->Response->error('40016')) ? : $this->Response->error('40019');
        $to = ( $this->_post['to'] ?? $this->Response->error('40016') ) ? : $this->Response->error('40020');
        $date = ( $this->_post['date'] ?? date('Y-m-d')) ? : date('Y-m-d');
        if ( ! $this->Common->validateDate($date, 'Y-m-d') ) $this->Response->error('40022');
        $flightData = $this->Trip->air($from, $to, $date); 
        echo '<pre>';print_r($flightData);echo '</pre>';exit(); 
        if ($flightData) {
            $this->Response->success($flightData);
        }*/
        
    }

    public function orderAction()
    {
       echo '<pre>';print_r($GLOBALS);echo '</pre>';exit();  
        //获取微信的请求参数
        if (isset($GLOBALS['HTTP_RAW_POST_DATA']) && ($GLOBALS['HTTP_RAW_POST_DATA'] != '')) 
        {   
            $postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
        }   
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $attributes = [
            'body'             => 'iPad mini 16G 白色',
            'detail'           => 'iPad mini 16G 白色',
            //'out_trade_no'     => '1217752501201407033233368018',
            'total_fee'        => 0.1,
            'notify_url'       => 'http://scanpay.vzhen.com/order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            // ...
        ];

        $order = new Order($attributes);
    }

    public function order_notify()
    {

    }

}
