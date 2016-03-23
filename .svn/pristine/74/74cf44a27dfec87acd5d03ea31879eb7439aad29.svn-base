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
class UserReportController  extends Controller{

    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');

        $startTime = '2015-07';
        $time = time();
        $endTime = date("Y-m",$time);

        $map['f_month']=array(array('egt',$startTime),array('lt',$endTime+86400),"and");
        $re=M('usercount')->where($map)->select();
        $f_month = array_column($re, 'f_month');
        $f_regcount = array_column($re, 'f_regcount');
        $f_dayactivecount = array_column($re, 'f_dayactivecount');
        $f_weekactivecount = array_column($re, 'f_weekactivecount');
        $f_monthactivecount = array_column($re, 'f_monthactivecount');
        $f_monthretentionrate = array_column($re, 'f_monthretentionrate');
        $f_dayopenaverage = array_column($re, 'f_dayopenaverage');
        $f_onceuserduration = array_column($re, 'f_onceuserduration');
        $f_onceaccesspagenumber = array_column($re, 'f_onceaccesspagenumber');

        $this->assign('re',$re);
		$this->assign('count',count($f_month));
		$this->assign('f_month',$f_month);
		$this->assign('f_regcount',$f_regcount);
		$this->assign('f_dayactivecount',$f_dayactivecount);
		$this->assign('f_weekactivecount',$f_weekactivecount);
		$this->assign('f_monthactivecount',$f_monthactivecount);
		$this->assign('f_monthretentionrate',$f_monthretentionrate);
		$this->assign('f_dayopenaverage',$f_dayopenaverage);
		$this->assign('f_onceuserduration',$f_onceuserduration);
		$this->assign('f_onceaccesspagenumber',$f_onceaccesspagenumber);

        $this->assign('classtype','1');
        $this->assign('endTime',$endTime);
        $this->display();
    }

    function tubiao(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');

        $startTime = '2015-07';
        $time = time();
        $endTime = date("Y-m",$time);

        $map['f_month']=array(array('egt',$startTime),array('lt',$endTime+86400),"and");
        $re=M('usercount')->where($map)->select();

        $this->assign('classtype','2');
        $this->assign('endTime',$endTime);
        $this->display();
    }

}
