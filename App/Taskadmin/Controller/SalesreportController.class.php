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
class SalesreportController  extends Controller{
    //put your code here
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        // $access = I('get.access','000000');
        // A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->assign('classtype','1');
        $this->display("liveness");
    }

	function contract(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $this->assign('classtype','1');
        $this->display("contract");
    }

    function shareNum(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $this->display();
    }

    function widelyShareNum(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $this->display();
    }
    
    function allTaskShare(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $this->display();
    }

    function widelyFinish(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $this->display();
    }

    function export_csv($filename,$data)   
    {   
        header("Content-type:text/csv");   
        header("Content-Disposition:attachment;filename=".$filename);   
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
        header('Expires:0');   
        header('Pragma:public'); 
        echo $data;
    }  

    function exportPush(){
        $str = "任务名称,任务金币,分享日期,分享次数,有效获得金币总数\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("pushResult") as $key => $value) {
            $value['tasktitle'] = str_replace("\"", "\"\"", $value['tasktitle']);
            $value['tasktitle'] = str_replace(",", "，", $value['tasktitle']);
            $tasktitle = iconv('utf-8','GB2312//IGNORE',$value['tasktitle']); //中文转码   
            $str .= $tasktitle.",".$value['taskcoin'].",".$value['ctime'].",".$value['sharenum'].",".$value['earncoin']."\n"; //用引文逗号分开   
        } 

        $filename = '推广赚日金币总数'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

    function exportWide(){
        $str = "任务名称,任务金币,分享日期,有效获得金币总数\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("wideResult") as $key => $value) {
            $value['tasktitle'] = str_replace("\"", "\"\"", $value['tasktitle']);
            $value['tasktitle'] = str_replace(",", "，", $value['tasktitle']);
            $tasktitle = iconv('utf-8','GB2312//IGNORE',$value['tasktitle']); //中文转码   
            $str .= $tasktitle.",".$value['taskcoin'].",".$value['ctime'].",".$value['earncoin']."\n"; //用引文逗号分开   
        } 

        $filename = '随手赚日金币总数'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

    function exportTaskShare(){
        $str = "任务名称,分享次数,分享日期\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("taskShareResult") as $key => $value) {
            $value['ftitle'] = str_replace("\"", "\"\"", $value['ftitle']);
            $value['ftitle'] = str_replace(",", "，", $value['ftitle']);
            $ftitle = iconv('utf-8','GB2312//IGNORE',$value['ftitle']); //中文转码   
            $str .= $ftitle.",".$value['sharecount'].",".$value['fdatetime']."\n"; //用引文逗号分开   
        } 

        $filename = '全部任务日分享数'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

    function exportWideFinish(){
        $str = "任务名称,总份数,单份金币,认领数量,完成数量,应付金币\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("wideFinishResult") as $key => $value) {
            $value['ftitle'] = str_replace("\"", "\"\"", $value['ftitle']);
            $value['ftitle'] = str_replace(",", "，", $value['ftitle']);
            $ftitle = iconv('utf-8','GB2312//IGNORE',$value['ftitle']); //中文转码   
            $str .= $ftitle.",".$value['ftotalcopies'].",".$value['feachcoin'].",".$value['drawqty'].",".$value['finshqty'].",".$value['ftotalcoin']."\n"; //用引文逗号分开   
        } 

        $filename = '随手赚完成情况统计'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

}
