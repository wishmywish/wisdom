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
class ShopController  extends Controller{

    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $map['f_classpid'] = 0;
        $map['f_status'] = 1;

        $result = M('shopclass')->where($map)->select();

        foreach ($result as $key => $value) {
            $o['f_classpid'] = $value['f_id'];
            $o['f_status'] = 1;
            $result[$key]['secondClass'] = M('shopclass')->where($o)->select();
        }
// var_dump($result);
        $this->assign('result', $result);
        $this->display();
    }

    //递归取分类
    /*
    $f_classpid   父类id ,从0开始,

    $lv    层编号,  父类为 0, 子类以它的父类层编号加1,  

    $i 循环计数器.
    */
    function cate_arr($arr,&$arr2=array(),$f_classpid=0,$lv=0){
        static  $i=0;  //从0开始
        if ((bool)$arr) {
            foreach ($arr as $value) 
            {
                if ($value['f_classpid']==$f_classpid &&$value['f_status']==1) 
                {
                    $value['lv']=$lv;
                    $arr2[$i]=$value;
                    $i++;
                    $lv++;
                    $this->cate_arr($arr,$arr2,$value['f_id'],$lv--);
                }
            }
        }
        return $arr2;
    }

    //所有分类
    function allClass(){
        $map['f_status'] = 1;

        $result = M('shopclass')->where($map)->select();

        $tree = $this->cate_arr($result,$arr2);

        return $tree;
    }

    //添加分类
    function addShopClass() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $tree = $this->allClass();

        $this->assign('tree', $tree);
        $this->display();
    }

    //修改分类
    function modShopClass() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $reModi = A('Api/Web')->getModiClass();//取要修改的记录数据
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }

        $tree = $this->allClass();

        $this->assign('tree', $tree);

        $this->assign('firstClass', $firstClass);
        $this->display();
    }

    //添加产品
    function addShop() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $tree = $this->allClass();

        $reModi = A('Api/Web')->getModiShop();//取要修改的记录数据
        // var_dump($reModi);exit();
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }

        $this->assign('tree', $tree);
        $this->display();
    }

    //开奖
    function open(){
        set_theme();
        $shopid = I("get.shopid");
        $this->assign("shopid",$shopid);
        //取奖号
        $re = M("shoplist")->where("f_sid=".$shopid)->find();
        //取中奖人
        if($re['f_lottery']!=""){
            $this->assign("nsdk",$re['f_nsdk']);
            $this->assign("lottery",$re['f_lottery']);
            $map["f_shopid"] = $shopid;
            $map["f_award_no"] = $re['f_lottery'];
            $own_re  = M("own_award")->field("f_userid")->where($map)->find();
            $center_re = A("Api/Jhttp")->getuserinfo2($own_re["f_userid"]);
            $arr = json_decode($center_re,true);
            $this->assign("mobile",$arr['list']['mobile']);
        }
        $this->display();
    }

}
