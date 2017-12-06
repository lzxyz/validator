<?php

/**
 * FileName Validator.php
 * User: DIY
 * Date Time: 2017/12/6 13:06
 * Mail: 394028924@qq.com
 */
namespace LzXyz\Validator;

class Validator
{
    /**
     * 手机号码
     * @param $phone
     * @return bool
     */
    public static function mobile($phone){
        $rex = "/^1[3-9][0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/";
        if (preg_match($rex, $phone)) {
            return true;
        } else {
            return false;
        }
    }

    public static function mail($mail){
        $rex = '/^(\w{1,25})@(\w{1,16})(\.(\w{1,4})){1,3}$/';
        if(preg_match($rex,$mail)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * N位小数检测
     * @param $number
     * @param int $len
     * @return bool
     */
    public static function decimal($number,$len = 2){
        $rex = '/^(([1-9]{1}\d{0,9})|0)(\.\d{1,'.$len.'})?$/';
        if(preg_match($rex,$number)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 身份证号码
     * @param $vStr
     * @return bool
     */
    public static function idCard($vStr){
        $vCity = array(
            '11', '12', '13', '14', '15', '21', '22',
            '23', '31', '32', '33', '34', '35', '36',
            '37', '41', '42', '43', '44', '45', '46',
            '50', '51', '52', '53', '54', '61', '62',
            '63', '64', '65', '71', '81', '82', '91'
        );

        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;
        if (!in_array(substr($vStr, 0, 2), $vCity)) return false;

        $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
        $vLength = strlen($vStr);
        if ($vLength == 18) {
            $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
        } else {
            $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
        }

        if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
        if ($vLength == 18) {
            $vSum = 0;

            for ($i = 17; $i >= 0; $i--) {
                $vSubStr = substr($vStr, 17 - $i, 1);
                $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
            }

            if ($vSum % 11 != 1) return false;
        }
        return true;
    }

    /**
     * 匹配中文
     * @param $str
     * @param int $len
     */
    public static function zhCN($str){
        $rex = '/^[\u4e00-\u9fa5]+$/';
        if(preg_match($rex,$str)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 网址检测是否合法
     * 只支持http和https协议
     * @param $url
     * @return bool
     */
    public static function url($url){
        $rex = '/^[http|https]+://[^\s]*$/';
        if(preg_match($rex,$url)){
            return true;
        }else{
            return false;
        }
    }

    public static function dateFormat(){

    }

    public static function dateTimeFormat(){}



}