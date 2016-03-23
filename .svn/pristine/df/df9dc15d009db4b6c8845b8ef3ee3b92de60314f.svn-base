<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/26
 * Time: 20:35
 */

namespace Mobileweb\Controller;
use Think\Controller;

class ShopController extends Controller
{
    public function index(){
        set_theme();
        $userid = I('get.userid',0);
        $this->assign("userid",$userid);
        $this->display();
    }

    //加载分类
    //&$data,$idField='f_tradeID',$pidField='f_parentID'
    function showcname(){
        $re = M('shopclass')->where('f_status=1')->select();
        //pt($re);
        $relist = A("Taskadmin/Fun")->tree($re,'f_id','f_classpid');
        echo json_encode($relist);
    }

    //加载商品列表
    function showshop(){
        $cid = I('get.cid',0);
        $j = array("LEFT JOIN t_files ON t_shoplist.f_fileid=t_files.f_id");
        $o = "f_sid desc";
        if($cid==0){
            $re = M("shoplist")->join($j)->order($o)->select();
        }else{
            $re = M("shoplist")->where("f_cid=".$cid)->join($j)->order($o)->select();
        }
        //echo M("shoplist")->getLastSql();
        echo json_encode($re);
    }
    //加载商品详情
    function showshopN(){
        $sid = I('get.sid');
        $re = M("shoplist")->where("f_sid=".$sid." and f_status=1")->find();
        echo json_encode($re);
    }
    //订购
    function order(){
        $sid = I('get.sid');
        $re = M("shoplist")->field("f_description,f_note",true)->where("f_sid=".$sid)->find();
        echo json_encode($re);
    }
    //结算
    function account(){
        $sid = I('get.sid');
        $userid = I('get.userid');
        $amount = I('get.amount');
        $re = D('Api/Shopsheet')->add_shopsheet("shop",$userid,0,1,$amount,0,0,0,0,$sid);
        $this->out_arr['error_code']='success';
        $this->out_arr['error_text'] = '';
        $this->out_arr['indexid'] = $re;
    }
}