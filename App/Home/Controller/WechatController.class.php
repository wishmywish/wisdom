<?php
/**
 * 微信
 */
namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller
{

    /**
     * 厂商端授权登录
     * 1、用户微信授权，获取unionid
     * 2、通过unionid判断是否绑定，已绑定返回用户信息(直接登录进去,现在用户绑定只绑定企业下的一个用户,返回的企业列表里加是否绑定标识),未绑定跳转到输入手机号和密码页面
     * 3、未绑定时通过用户输入的手机号码和密码，判断用户是否注册,已注册就先调用登录接口判断密码是否正确再调用接口绑定，返回用户信息
     * 4、未注册就在后台调用注册接口与绑定接口，最后返回用户信息
     */
    /**
     * 手机端授权登录大致思路
     * 1、用户微信授权，获取unionid
     * 2、通过unionid判断是否绑定，已绑定返回用户信息,未绑定跳转到输入手机号和密码页面
     * 3、未绑定时通过用户输入的手机号码和密码，判断用户是否注册,已注册就先调用登录接口判断密码是否正确再调用接口绑定，返回用户信息
     * 4、未注册就在后台调用注册接口与绑定接口，最后返回用户信息
     */

    /**
     * 1、生成扫码授权界面，授权成功跳转到2
     * 请求CODE,可生成扫码登录的的地址
     * 通过此方法获取扫码登录地址,微信扫描后点击确认登录，会跳转到指定页面，会返回CODE,
     * 再调用 getUserInfo方法返回的url，访问即可获取返回的相关信息
     * index.php/Home/Wechat/getCode
     */
    function getCode(){
        //微信公众平台里认证的应用里面有
        $AppID = 'wxb17e1d74611b1aa7';
        $AppSecret = '46d5286ea1208733da9f99c9eaa25102';
//        $redirect_url = 'http://wisdom.51lick.com/index.php/Home/Login/login.html'; //回调地址
        $redirect_url = 'http://wisdom.51lick.com/index.php/Home/Wechat/is_auth'; //回调地址
        $scope = "snsapi_login"; //应用授权作用域，拥有多个作用域用逗号（,）分隔，网页应用目前仅填写snsapi_login即可
        $state = "888"; //state 	否 	用于保持请求和回调的状态，授权请求后原样带回给第三方。该参数可用于防止csrf攻击（跨站请求伪造攻击），建议第三方带上该参数，可设置为简单的随机数加session进行校验

//        $url = 'https://open.weixin.qq.com/connect/qrconnect?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect';
        $url = "https://open.weixin.qq.com/connect/qrconnect?appid=".$AppID."&redirect_uri=".$redirect_url."&response_type=code&scope=".$scope."&state=STATE#wechat_redirect";

//        dump($url);


        //跳转到扫码页
        echo "<script>location.href='".$url."'</script>";
//        $this->redirect($url);

    }


    /**
     *
     * 2、判断是否绑定了微信的unionid
     * 会传一个code
     * index.php/Home/Wechat/is_auth?code=
     */
    public function is_auth(){
        header("Content-Type:text/html;charset=utf-8");
        $appid = "wxb17e1d74611b1aa7";
        $secret = "46d5286ea1208733da9f99c9eaa25102";
        $code = I("code");  //扫码登录跳转回来后自带的一个code
        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';

        $get_id = json_decode(file_get_contents($get_token_url),true);
//        echo "获取微信用户的opendid 和 unionid:&nbsp;&nbsp;";
//        dump($get_id);  //获取微信用户的opendid 和 unionid

//        $get_id['unionid'] = 'oBgZTuMs71HDev08olVS-zKh_eeQ'; //测试
//        $get_id['unionid'] = 'oBgZTuMs71H获取unionid失败xxx


        if( $get_id['errcode'] != 0 ){
//            echo "获取unionid失败xxx";
        }else{
            $unionid = trim($get_id['unionid']);
//            dump($unionid);

            //调用java接口判断是否绑定
            $auth_result = A("Api/Jhttp")->weixinLogin($unionid,2); //2为厂商登录
            $auth_array = json_decode($auth_result,true);

            $resCode = $auth_array['resCode'];

//            dump($resCode);
//            echo A('Api/Jhttpcode')->searchCode($resCode);

            if( $resCode == '000000' ){  //已经绑定过了,返回用户信息
//                dump($auth_result);
                $auth_array['resCode'] = '000000';
                return $auth_array;
//                echo "<br/>我已经绑定过了";
//                dump($auth_array);
            }else{  //没有绑定跳转到注册页面
                return $unionid; //返回unionid
//                echo "<br/><br/>我没有绑定过xxxx";
//            $this->redirect('/Home/Wechat/regist?unionid='.$unionid);
            }


        }

    }

    /**
     * 3、输入手机号与密码页面
     * 微信未绑定跳转到此注册页面(需要通过这个手机查看是否注册，如果没有为注册，有的话就是绑定微信号
     * index.php/Home/Wechat/regist
     */
    public function regist(){
        $unionid = I('unionid');

        $this->assign('unionid',$unionid);
        $this->display();
    }

    /**
     * 4、页面处理操作(绑定,有注册就绑定，没有注册就注册后绑定)
     * 判断用户是否注册,已注册就先调用登录接口判断密码是否正确再调用接口绑定，返回用户信息,进行登录
     * 未注册就在后台调用注册接口与绑定接口，最后返回用户信息
     * index.php/Home/Wechat/regist_do
     */
    public function regist_do(){
        header("Content-Type:text/html;charset=utf-8");
        //先判断该用户是否注册过
        $mobile= '15205819762';
        $password = '12345';
        $unionid = 'oBgZTuMs71HDev08olVS-zKh_222';

//        $mobile = I('mobile');
//        $password = I('password');
//        $unionid = I('unionid');

        //厂商登录
        $login_result = A("Api/Jhttp")->companylogin($mobile,$password);
        $login_arr = json_decode($login_result,true);
        dump($login_arr);

        if( $login_arr['resCode'] != '000000' ){  //没有注册，先注册
            $reg_result= A("Api/Jhttp")->zsreguser($mobile,$password);
            if( $reg_result['resCode'] != '000000' ){  //注册没成功，返回出错
                echo "注册出错";
            }
        }

        //绑定,厂商登录成功以后弹出一个选择企业的窗口,选择后返回的一个companydid,用于绑定
        $companyId = '622';

        $add_result = A("Api/Jhttp")->addWeixin($unionid,$mobile,$password,$companyId);
        echo "绑定成功";
        dump($add_result);
        dump(json_decode($add_result,true));

    }


    /**
     * 判断是否绑定
     */
    public function weixinLogin(){
//        $unionid = 'oBgZTuMs71HDev08olVS-zKh_eeQ';
        $unionid = 'oBgZTuMs71HDev08olVS-zKh_222';
        //调用java接口判断是否绑定
        $auth_result = A("Api/Jhttp")->weixinLogin($unionid);
        $auth_array = json_decode($auth_result,true);

        dump($auth_array);
    }


    /**
     * 用户绑定微信unionid
     * 绑定前需要调用登录接口判断用户名和密码是否正确
     */
    public function addWeixin(){
        $unionid = I('unionid');
        $mobile = I('mobile');

        $mobile= '15205819762';
        $password = '12345';

        $add_result = A("Api/Jhttp")->addWeixin($unionid,$mobile,$password);

        dump($add_result);
    }


    /**
     * 获取微信的token
     * index.php/Home/Wechat/getToken
     */
    function getToken(){

        //微信公众平台里认证的应用里面有
        $AppID = 'wxb17e1d74611b1aa7';
        $AppSecret = '46d5286ea1208733da9f99c9eaa25102';

        //调用网址
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$AppID."&secret=".$AppSecret;

        //调用结果
        $content = json_decode(file_get_contents($url),true);

        //打印token结果
        dump($content);
    }


    /**
     * 查询授权用户信息(测试)
     * index.php/Home/Wechat/getUserInfo?code=
     */
    function getUserInfo(){
        $appid = "wxb17e1d74611b1aa7";
        $secret = "46d5286ea1208733da9f99c9eaa25102";
        $code = $_GET["code"];
        $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';


        $get_openid = json_decode(file_get_contents($get_token_url),true);

        dump($get_openid);
        dump($get_token_url);exit;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$get_token_url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);
        $json_obj = json_decode($res,true);

        //通过登录获取的code查询用户的openid
        dump($json_obj);exit;

//根据openid和access_token查询用户信息
        $access_token = $json_obj['access_token'];
        $openid = $json_obj['openid'];
        $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $res = curl_exec($ch);
        curl_close($ch);

//解析json
        $user_obj = json_decode($res,true);
        $_SESSION['user'] = $user_obj;
        print_r($user_obj);
    }









}