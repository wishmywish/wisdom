<?php
/**
 * QQ
 */
namespace Home\Controller;
use Think\Controller;

class QQController extends Controller
{

    /**
     * Step1:在根目录中的qq.php
     */

    /**
     * Step2：登录授权
     */
    function qq_auth(){
        $appid = '101268556';  //QQ互联中申请应用的appid
        $scope='get_user_info,add_share';  //权限列表
//        $redirect_uri = 'http://intest.51lick.cn/index.php/Home/QQ/qq_back';  //回调地址，要与申请时填写的一致
        $redirect_uri = 'http://dvpt.51lick.cn//index.php/Home/QQ/qq_back';  //回调地址，要与申请时填写的一致
//        $redirect_uri = 'http://dvpt.51lick.cn/qq_back';  //回调地址，要与申请时填写的一致

        $url = 'https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id='.$appid.'&redirect_uri='.$redirect_uri.'&scope='.$scope;

        echo "<script>location.href='".$url."'</script>";
    }

    /**
     * Step3：通过Authorization Code获取Access Token
     * @param code
     */
    function qq_back(){

        $code = I('code');
//        $code = '6827F33BE452A7540BEC1F94A3119B39';
        $appid = '101268556';  //QQ互联中申请应用的appid
        $appkey = '379360d9997f74aa2a68f27e0ba85a16';  //QQ互联中申请应用的appkey
        $redirect_uri = 'http://dvpt.51lick.cn//index.php/Home/QQ/qq_back';  //跳转地址
        $state = "test";

        $url = 'https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id='.$appid.'&client_secret='.$appkey.'&code='.$code.'&state='.$state.'&redirect_uri='.$redirect_uri;

//        echo "<script>location.href='".$url."'</script>";
//        echo $url;exit;
        $html = file_get_contents($url);


        //Step4：使用Access Token来获取用户的OpenID

        //正则匹配获取token
        $pattern = '/access_token=(.*?)&/';
        preg_match($pattern, $html, $matches);
        $access_token = $matches['1'];


        //获取openid
        $url = 'https://graph.qq.com/oauth2.0/me?access_token='.$access_token;
        $openInfo = file_get_contents($url);

        echo $openInfo;



    }













}