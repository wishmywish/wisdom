<?php
namespace Taskadmin\Controller;
use Think\Controller;

class AdController extends Controller {
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->display();
    }

    function addActivity(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $this->display();
    }

    function updateAd(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->getModiAd();//取要修改的记录数据
        // var_dump($reModi);exit();
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }
        $this->display();
    }
    
}