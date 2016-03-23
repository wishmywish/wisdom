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
class ReportController  extends Controller{
    //put your code here
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        // $access = I('get.access','000000');
        // A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->assign('classtype','1');
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

    function explodeCard(){
        $str = "手机号,昵称,真实姓名,金币,银票,认领任务数\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("cardSalesResult") as $key => $value) {
            $value['nickName'] = str_replace("\"", "\"\"", $value['nickName']);
            $value['nickName'] = str_replace(",", "，", $value['nickName']);
            $nickName = iconv('utf-8','GB2312//IGNORE',$value['nickName']); //中文转码  

            $value['trueName'] = str_replace("\"", "\"\"", $value['trueName']);
            $value['trueName'] = str_replace(",", "，", $value['trueName']);
            $trueName = iconv('utf-8','GB2312//IGNORE',$value['trueName']); //中文转码   
            $str .= $value['mobile'].",".$nickName.",".$trueName.",".$value['goldcoin'].",".$value['credit'].",".$value['taskdrawsum']."\n"; //用引文逗号分开   
        } 

        $filename = '已银行卡绑定的用户'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

    function explodeReal(){
        $str = "手机号,昵称,真实姓名,金币,银票,认领任务数,注册时间\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("realSalesResult") as $key => $value) {
            $value['nickName'] = str_replace("\"", "\"\"", $value['nickName']);
            $value['nickName'] = str_replace(",", "，", $value['nickName']);
            $nickName = iconv('utf-8','GB2312//IGNORE',$value['nickName']); //中文转码  

            $value['trueName'] = str_replace("\"", "\"\"", $value['trueName']);
            $value['trueName'] = str_replace(",", "，", $value['trueName']);
            $trueName = iconv('utf-8','GB2312//IGNORE',$value['trueName']); //中文转码    
			$str .= $value['mobile'].",".$nickName.",".$trueName.",".$value['goldcoin'].",".$value['credit'].",".$value['taskdrawsum'].",".$value['userCreatetime']."\n"; //用引文逗号分开   
        } 

        $filename = '已实名认证的用户'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

    function explodeAll(){
        $str = "手机号,昵称,真实姓名,金币,银票,认领任务数,注册时间\n";   
        $str = iconv('utf-8','GB2312//IGNORE',$str);

        foreach (session("allSalesResult") as $key => $value) {
            $value['tasktitle'] = str_replace("\"", "\"\"", $value['tasktitle']);
            $value['tasktitle'] = str_replace(",", "，", $value['tasktitle']);
            $tasktitle = iconv('utf-8','GB2312//IGNORE',$value['tasktitle']); //中文转码   
            $str .= $tasktitle.",".$value['taskcoin'].",".$value['ctime'].",".$value['sharenum'].",".$value['earncoin']."\n"; //用引文逗号分开   
        } 

        $filename = '全部业务员'.'.csv'; //设置文件名   
        $this->export_csv($filename,$str); //导出   

    }

}
