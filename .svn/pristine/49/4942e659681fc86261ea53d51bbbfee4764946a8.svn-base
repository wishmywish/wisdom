<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OmsController
 *
 * @author Administrator
 */
namespace Home\Controller;
use Think\Controller;
class OmsController extends CommonController {
    public function index() {
        set_theme();
        $re = A('Api')->getBigC();
        foreach ($re as $key => $val) {
            if($val['f_sys_column_cid']=='Oms'){
                $syscolumn_id = $val['f_syscolumn_id'];
            }
        }
//        pt(cookie('facIdList'));
//        echo count(cookie('facIdList'));
        if(count(cookie('facIdList'))==0){
            $sysCid = "F";
            $this->assign('ssoToken',cookie('ssoToken'));
        }else{
            $sysCid = "A";
            //经销商获取厂商列表
            $comp_delar_list=A("Api/Jhttp")->getFacList(cookie("userId"),cookie("companyId"));
            $comp_delar_list=json_decode($comp_delar_list,true);
            if($comp_delar_list["resCode"]=="000000"){
                 $com_list=$comp_delar_list["list"];
                 $com_list_count=count($com_list);
            }
        }
        //echo $sysCid;
        $sre = A('Api')->getBigC($syscolumn_id,$sysCid);
//        pt($sre);
//        exit;
        $this->assign('bigclass', $re);
        $this->assign('smallclass', $sre);
        $this->assign('sysCid',$sysCid);
        $this->assign('com_list',$com_list);
//        pt($com_list);
//        echo $sysCid;
//        pt($com_list_count);
        $this->assign('com_list_count',$com_list_count);
        $this->display();
    }
    public function boms() {
        set_theme();
        $re = A('Api')->getBigC();
        foreach ($re as $key => $val) {
            if($val['f_sys_column_cid']=='Boms'){
                $syscolumn_id = $val['f_syscolumn_id'];
            }
        }
        $sre = A('Api')->getBigC($syscolumn_id);
        $this->assign('bigclass', $re);
        $this->assign('smallclass', $sre);
        $this->assign('ssoToken',cookie('ssoToken'));
        $this->display();
    }
}
