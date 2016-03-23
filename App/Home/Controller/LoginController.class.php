<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	
	public function index(){
		$this->redirect('Login/login');
	}
	
	public function login(){
		set_theme();
        cookie("clicknum",0);
        //微信授权登录获取unionid
        $wechat_auth = 0;  //默认状态，不是微信授权登录,普通登录

        $login_mobile = '0';
        $companyID = '0';
        $unionId = '0';

        if( I("code") ){
            $code = I('code');
            $wechat_result = A('Wechat')->is_auth($code);
            if( $wechat_result['resCode'] == '000000' ){ //授权成功，返回用户信息,直接登录
//            dump($wechat_result);exit;
                $wechat_auth = 1;
                $companyID = $wechat_result['list']['companyId'];
                $login_mobile = $wechat_result['list']['mobile'];
                $unionId = $wechat_result['list']['weixinId'];
            }else{
                $wechat_auth = 2; //授权登录失败,没有绑定过,返回unionid;
                $unionId = $wechat_result;
            }
        }

//        $wechat_auth = 2 ; //测试没绑定

//        dump($login_mobile);
//        dump($companyID);

        $this->assign("unionId",$unionId);
        $this->assign("login_mobile",$login_mobile);
        $this->assign("companyID",$companyID);
        $this->assign("wechat_auth",$wechat_auth);
		$this->display('Login/index');
	}

	//
	public function verify(){
		verify();
	}

	//
	public function check_verify() {
		$code = I('post.code','');
		check_verify($code);
	}


    
    
        
}
    

    
    
   
    
 