<?php

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
        error_log(json_encode($_GET));
echo '<pre>';print_r($_GET);echo '</pre>';exit(); 
        $cityMod = new CtripModel();
        $cityData = $cityMod->getCity();
        $this->Response->success($cityData);
    }

}
