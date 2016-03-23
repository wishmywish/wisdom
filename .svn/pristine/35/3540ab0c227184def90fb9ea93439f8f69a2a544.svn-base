<?php
namespace Taskadmin\Controller;
use Think\Controller;

class TryOutController extends Controller {
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->display();
    }

    function ad_express()
    {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $id = I("get.id");

        $this->assign('ExpressId',$id);//传入HTML，功能权限使用
        $this->display();
    }

}