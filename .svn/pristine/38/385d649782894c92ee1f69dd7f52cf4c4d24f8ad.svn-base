<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalesreportController
 *
 * @author Administrator
 */
namespace Taskadmin\Controller;
use Think\Controller;
class ShopRecordController  extends Controller{

    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->assign('result', $result);
        $this->display();
    }


}
