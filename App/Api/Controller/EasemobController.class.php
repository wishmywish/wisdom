<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/20
 * Time: 9:46
 */

namespace Api\Controller;
use Think\Controller;

class EasemobController extends Controller
{
    /**
     * ע�ỷ���û�(֧������)
     * ����:{"username":"jliu","password":"123456"}
     * ����:[{"username":"u1", "password":"p1"}, {"username":"u2", "password":"p2"}]
     * ʹ�ÿ���ע��
     */
    public function easemob_reg_user($body){
        $url = C("EasemobUrl")."users";
        //ͷ��Ϣ
        $header = array('Accept:application/json','Content-Type:application/json;charset=utf-8');
        //$header_json = json_encode($header);

        //BODY
        $body_json = json_encode($body);

        $return = $this->easemob_curl($url,$body_json,$header);

        return $return;
    }


    /**
     * ����IM�û�����
     * body=array('newpassword'=>'123456')
     */
    public function easemob_modi_password($body,$username){
        //$username = I('get.phone');
        $url = C("EasemobUrl")."users/".$username."/password";
        $access_token = $this->easemob_token_time();
        //ͷ��Ϣ
        $header = array('Accept:application/json','Content-Type:application/json;charset=utf-8','Authorization:Bearer '.$access_token);
        //$header_json = json_encode($header);

        //BODY
        $body_json = json_encode($body);

        //echo $url;
        //echo $body_json;

        $return = $this->easemob_curl($url,$body_json,$header,'PUT');

        return $return;
    }

    /**
     * �޸��û��ǳ�$body,
     * body=array('nickname'=>'����')
     */
    public function easemob_modi_nickname($body,$username){
        $url = C("EasemobUrl")."users/".$username;
        $access_token = $this->easemob_token_time();
        //ͷ��Ϣ
        $header = array('Accept:application/json','Content-Type:application/json;charset=utf-8','Authorization:Bearer '.$access_token);
        //$header_json = json_encode($header);


        //BODY
        $body_json = json_encode($body);

        $return = $this->easemob_curl($url,$body_json,$header,'PUT');

    }


    /**
     * ʹ�û���TOKEN���������ڼ��
     */
    public function easemob_token_time(){
        $nowtime = time();
        $token_time = 604800;
        $result = M("easemob_token")->where("app='wisdom'")->find();
        $ceiltime = $nowtime-$result['uptime'];
//        echo $ceiltime;
//        exit;
        if($ceiltime>=$token_time){
            //�����ʱ�������»�ȡTOKEN
            return $this->easemob_token();
        }else{
            return $result['access_token'];
        }
    }

    /**
     * ��ȡ����TOKEN
     * @return json ����token
     */
    public function easemob_token(){
        $url = C("EasemobUrl")."token";
        //ͷ��Ϣ
        $header = array('Accept:application/json','Content-Type:application/json;charset=utf-8');
        $header_json = json_encode($header);
        $body = array("grant_type"=>"client_credentials","client_id"=>"YXA6msWfgEVJEeWtT8O7B-bkvg","client_secret"=>"YXA6gNlbBA-jtqWWdsa7fwp8BwuESqc");
        $body_json = json_encode($body);
        $return = $this->easemob_curl($url,$body_json,$header_json);
        //��ȡTOKEN�󣬸��µ������ݴ棬��Ч��Ϊ7�죬ÿ7�����һ��
        $arr = json_decode($return,true);
        $arr["uptime"] = time();
        //var_dump($arr);
        M("easemob_token")->where("app='wisdom'")->save($arr);
        return $arr['access_token'];//����token
    }

    /**
     * ��Ӻ��ѹ�ϵ
     * ����city�ͷ����˵�phone
     */
    public function easemob_friend($result,$re_own1){

        for($i=0;$i<=count($result)-1;$i++){

            $token = $this->easemob_token_time();//�ж�TOKEN�Ƿ����
            $url = C("EasemobUrl")."users/".$re_own1."/contacts/users/".$result[$i]['f_mobile'];


            $header = array ();
            $header [] = 'Accept:application/json';
            $header [] = 'Content-Type:Content-Type: application/json';
            $header [] = 'Authorization:Bearer '.$token;

            $this->easemob_curl($url,'',$header);

        }
    }

    /**
     * CURL�ύ����
     */
    public function easemob_curl($url,$body='',$header='',$method='post'){
        //CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        if($method == 'post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$body);
        }else{
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$body);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}