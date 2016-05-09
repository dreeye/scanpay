<?php

class Common
{
    // 获取当前毫秒值
    public function getMsecond() 
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }

    // 验证手机号
    public function checkMobile($str)  
    { 
       $str = preg_replace(array('/\+86/', '/-/', '/ /'), array('', '', ''), $str);
       if (preg_match('/^\d{11}$/', $str) == 1) 
       {
            return $str;       
       }
        return FALSE;
    }

    public function checkNickName($str)
    {
        if ( ! $this->min_length($str, 1)) {
            return FALSE;
        }
        if ( ! $this->max_length($str, 15)) {
            return FALSE;
        }
        if ( ! $this->alpha_dash($str) ) {
            return FALSE;
        }
        return $str;

    }

    // 验证密码
    public function checkPassword($str)
    {
        if ( ! $this->min_length($str, 6)) {
            return FALSE;
        }
        if ( ! $this->max_length($str, 16)) {
            return FALSE;
        }
        if ( ! $this->alpha_dash($str) ) {
            return FALSE;
        }
        return $str;
    }

     //生成4位随机数            
    public function random()   
    { 
        return mt_rand(1000,9999);      
    } 
    
    
    /**
     * Create a Random String
     *
     * Useful for generating passwords or hashes.
     *
     * @param   string  type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
     * @param   int number of characters
     * @return  string
     *
     * alpha: 只含有大小写字母的字符串
     * alnum: 含有大小写字母以及数字的字符串
     * basic: 根据 mt_rand() 函数生成的一个随机数字
     * numeric: 数字字符串
     * nozero: 数字字符串（不含零）
     * md5: 根据 md5() 生成的一个加密的随机数字（长度固定为 32）
     * sha1: 根据 sha1() 生成的一个加密的随机数字（长度固定为 40）
     */
    public function random_string($type = 'alnum', $len = 8)
    {
        switch ($type)
        {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type)
                {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
    }

    /**
     * Alpha
     * 如果表单元素值包含除字母以外的其他字符，返回 FALSE
     *
     * @param   string
     * @return  bool
     */
    public function alpha($str)
    {
        return ctype_alpha($str);
    }

    /**
     * Alpha-numeric
     * 如果表单元素值包含除字母和数字以外的其他字符，返回 FALSE
     *
     * @param   string
     * @return  bool
     */
    public function alpha_numeric($str)
    {
        return ctype_alnum((string) $str);
    }

    /**
     * Alpha-numeric w/ spaces
     * 如果表单元素值包含除字母、数字和空格以外的其他字符，返回 FALSE 应该在 trim 之后使用，避免首尾的空格
     *
     * @param   string
     * @return  bool
     */
    public function alpha_numeric_spaces($str)
    {
        return (bool) preg_match('/^[A-Z0-9 ]+$/i', $str);
    }

    /**
     * Alpha-numeric with underscores and dashes
     * 如果表单元素值包含除字母/数字/下划线/破折号以外的其他字符，返回 FALSE
     * @param   string
     * @return  bool
     */
    public function alpha_dash($str)
    {
        return (bool) preg_match('/^[a-z0-9_-]+$/i', $str);
    }

    /**
     * Valid Email
     *
     * @param   string
     * @return  bool
     */
    public function valid_email($str)
    {
        if (function_exists('idn_to_ascii') && $atpos = strpos($str, '@'))
        {
            $str = substr($str, 0, ++$atpos).idn_to_ascii(substr($str, $atpos));
        }
        return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    
    /**
     * Minimum Length
     *
     * @param   string
     * @param   string
     * @return  bool
     */
    public function min_length($str, $val)
    {
        if ( ! is_numeric($val))
        {
            return FALSE;
        }
        return ($val <= mb_strlen($str));
    }
    // --------------------------------------------------------------------
    /**
     * Max Length
     *
     * @param   string
     * @param   string
     * @return  bool
     */
    public function max_length($str, $val)
    {
        if ( ! is_numeric($val))
        {
            return FALSE;
        }
        return ($val >= mb_strlen($str));
    }

    
    /**
     * Integer
     *
     * @param   string
     * @return  bool
     */
    public function integer($str)
    {
        return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
    }

    /**
     * Numeric
     *
     * @param   string
     * @return  bool
     */
    public function numeric($str)
    {
        return (bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);
    }

   /**
     * 验证日期格式
     *
     *
     *
     */
    public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    } 

      /**  
     * 输出xml字符
     * @throws WxPayException
    **/
    public function toXml($arr)
    {    
        $xml = "<xml>";
        foreach ($this->arr as $key=>$val)
        {    
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }    
        }    
        $xml.="</xml>";
        return $xml; 
    }    
}
