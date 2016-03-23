<?php
namespace Api\Controller;
use Think\Controller;
class IntsigController extends Controller {
    
    private $vCard_url = "http://bcr1.intsig.net/BCRService/BCR_VCF2";
    private $bCard_url = "http://imgs3.intsig.net/icr/recognize_bank_card";
    private $iCard_url = "http://imgs3.intsig.net/icr/recognize_id_card";
    private $url;


    /**
     * 名片扫描
     */
    function vCard($filepath,$size){
        $data = array(
            'upfile'=>'@'.$filepath
        );
        //pt($data);
        $this->url = $this->vCard_url . "?PIN=KTGS9DFCY4J4HW7A&user=IntSig_test&pass=trial&lang=15&json=1&size=".$size;
        //echo $this->url;
        //pt($this->in_curl($data));
        return json_decode($this->in_curl($data),true);
    }
    /**
     * 银行卡扫描
     */
    function bCard($filepath){
        $this->url = $this->bCard_url . "?encoding=utf-8";
        $data = array(
            'upfile'=>'@'.$filepath
        );
        return json_decode($this->in_curl($data),true);
    }
    /**
     * 身份证扫描
     */
    function iCard($filepath){
        $this->url = $this->iCard_url . "?encoding=utf-8";
        $data = array(
            'upfile'=>'@'.$filepath
        );
        return json_decode($this->in_curl($data),true);
    }
    
    /**
     * 提交数据到JAVA
     * @param string $method 提交方式，默认为post
     * @return string json
     */
    private function in_curl($data){
        //echo $this->url;
        $ch = curl_init($this->url);
        curl_setopt ( $ch, CURLOPT_POST, 1 );//post方式
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data);
        //执行
        $result = curl_exec ( $ch );
        //释放
        curl_close ( $ch );
        return $result;
        //$this->jsontoarray($result);
    }
}
