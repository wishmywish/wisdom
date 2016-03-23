<?php
namespace Taskadmin\Controller;
use Think\Controller;
class BehaviorAnalysisController  extends Controller{
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->assign('access',$access);//传入HTML，功能权限使用

        $this->display();
    }

    function all(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $this->display();
    }

    function checkReg(){
        set_theme();
        $result = A("Api/Web")->checkReg();   
        
        $this->assign('result',$result);

        $this->display();
    }


    function checkAllReg(){ 
        set_theme();
        $result = A("Api/Web")->checkAllReg();   
        
        $this->assign('result',$result);

        $this->display();
    }

    function checkAllBehavior(){
        set_theme();
        $result = A("Api/Web")->checkAllBehavior();   
        
        $this->assign('result',$result);

        $this->display();
    }

    function checkBehavior(){
        set_theme();
        $result = A("Api/Web")->checkBehavior();   
        
        $this->assign('result',$result);

        $this->display();
    }
    
    function add(){

        $sql1 = "SELECT * FROM `t_login_log`  WHERE f_id >= 0 AND f_id <=10";
        $result = M("login_log")->query($sql1);
        foreach ($result as $key => $value) {
            $map['f_id'] = $value['f_id'];
            $udid=M('regapp')->where('f_mobile='.$value['f_mobile'])->find();
            if (is_array($udid)) {
                $data['f_udid'] = $udid['f_udid'];
                M('login_log')->where($map)->save($data);
            }
        }

    }

}
