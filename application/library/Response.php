<?php

# namespace Fit;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
#header('Accept:application/json;charset=utf-8;');
#header('Content-Type:application/x-www-form-urlencoded;charset=utf-8;');

class Response {

    protected $error = [

                    '40016' => '提交的参数不全',
                    '40019' => '商品描述不能为空',
                    '40020' => '商品详情不能为空',
                    '40021' => '总金额不能为空',
                    '40022' => '微信名称不能为空',
                    '40023' => '微信名不存在',
                    '40024' => 'VSN不能为空',
                    '40025' => '金额不合法',
                    '40026' => 'VSN不合法',
                    '40027' => '备注字数不能超过50字',



                    //cache
                    '40201' => 'redis store mobile data error!',
                    '40202' => 'redis store session token data error!',
                ];

    public function error($errorCode, $debug=FALSE)
    {
        $errorMSG = $this->error[$errorCode] ?? FALSE;
        if ( ! $errorCode || ! $errorMSG) {
            error_log('errcode and errmsg miss, errorCode='.$errorCode .'[Lib Response.php]');
            exit();
        }
        $error = [
            'errcode'=>$errorCode,
            'errmsg'=>$errorMSG,
        ];
        error_log('Response error '.json_encode($error));
        if ($debug) {
            error_log('debug data '.json_encode($debug));
        }

        foreach($error as $key => $val){
            $error[$key] = urlencode($val);
        }
        echo urldecode(json_encode($error));
        exit();
    }

    public function success($data)
    {
        echo json_encode($data);
        exit();
    }

}
