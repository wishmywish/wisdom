<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FunController
 *
 * @author Administrator
 */
namespace Taskadmin\Controller;
use Think\Controller;
class FunController extends Controller {
    
    static public $treeList = array(); //存放无限分类结果如果一页面有多个无限分类可以使用 Tool::$treeList = array(); 清空
    /**
     * 无限级分类
     * @access public 
     * @param Array $data     //数据库里获取的结果集 
     * @param string $idField ID字段名
     * @param string $pidField PID字段名
     * @param Int $pid        ,'f_tradeID','f_parentID'     
     * @param Int $count       //第几级分类
     * @return Array $treeList
     */
    static public function tree(&$data,$idField='f_tradeID',$pidField='f_parentID',$pid = 0,$count = 1) {
        foreach ($data as $key => $value){
            if($value[$pidField]==$pid){
                $value['Count'] = $count;
                self::$treeList []=$value;
                //unset($data[$key]);
                self::tree($data,$idField,$pidField,$value[$idField],$count+1);
            }
        }
        return self::$treeList;
    }

    /**
     * 权限无限级
     * @access public
     * @param Array $data     //数据库里获取的结果集
     * @param string $idField ID字段名
     * @param string $pidField PID字段名
     * @param Int $pid        ,'f_tradeID','f_parentID'
     * @param Int $count       //第几级分类
     * @return Array $treeList
     */
    private $list = "";
    function showAccess(&$data,$idField='f_tradeID',$pidField='f_parentID',$pid = 0,$count = 1){
        foreach($data as $key => $value){
            if($value[$pidField]==$pid){
                $value['Count'] = $count;
                // if ($value['f_fieldpid'] == 0 ||$value['f_fieldpid'] == '0') {
                //     $this->list.="<div id='".$key."'>";
                // }
                if($pid==0){
                    if ($value['isChecked'] ==1 || $value['isChecked'] =='1') {
                        $this->list .= "<ul style='list-style-type:none;'><li><br><br><input type='checkbox'  id='".$value['f_id']."' value='".$value['f_fieldval']."' checked>".$value['f_fieldname']."</li></ul>";
                    }else{
                        $this->list .= "<ul style='list-style-type:none;'><li><br><br><input type='checkbox'  id='".$value['f_id']."' style='padding-left: 0px;clear:both;' name='power' value='".$value['f_fieldval']."' >".$value['f_fieldname']."</li></ul>";
                    }
                }else{
                    if ($value['isChecked'] ==1 || $value['isChecked'] =='1') {
                        $this->list .= "<div style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='".$value['f_fieldpid']."' value='".$value['f_fieldval']."' checked>".$value['f_fieldname']."</div>";
                    }else{
                        $this->list .= "<div style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='".$value['f_fieldpid']."' value='".$value['f_fieldval']."'>".$value['f_fieldname']."</div>";
                    }
                }
                 // $this->list.="</div>";
                self::showAccess($data,$idField,$pidField,$value[$idField],$count+1);
            }
        }

        return  $this->list;
    }
    
    
    
    /**
     * ===========================================公司名称简索===========================================
     */
    public function searchCname() {
        $companyName = I('post.keyword');
        //echo $companyName;
        //exit;
        $re = A('Api/Jhttp')->getCompanyName($companyName);
        $arr = json_decode($re,true);
        $errorCode = $arr['resCode'];
        $map = "";
        if($errorCode=='000000'){
            foreach ($arr['list'] as $key => $val) {
                $map[$key]['title'] = $val['companyName'];
                $map[$key]['result'] = $val['companyId'];
            }
            $a['data'] = $map;
            echo json_encode($a);
        }else{
            $a['data'] = "";
            echo json_encode($a);
        }
    }
    
    /**
     * ===========================================任务名称简索===========================================
     */
    public function searchTname() {
        $Tname = I('post.keyword');
        //echo $companyName;
        $w['f_tasktypeid'] = 3;
        $w['f_status'] = 3;
        $w['f_title']  = array('like',"%".$Tname."%");
        $re = M('task')->where($w)->select();
        $arr = json_decode($re,true);
        //$errorCode = $arr['resCode'];
        $map = "";
        if(count($re)){
            foreach ($re as $key => $val) {
                $map[$key]['title'] = $val['f_title'];
                $map[$key]['result'] = $val['f_tid'];
            }
            $a['data'] = $map;
            echo json_encode($a);
        }else{
            $a['data'] = "";
            echo json_encode($a);
        }
    }
    
    
    public function getBigTrade() {
        $t = M('tradetype');
        $re = $t->where('f_parentID=0')->select();
        //$re_1 = self::tree($re);
        //pt($re_1);
        echo json_encode($re);
    }
    
    public function getSmallTrade() {
        $f_tradeID = I('get.tradeID');
        $t = M('tradetype');
        $re = $t->where('f_parentID='.$f_tradeID)->select();
        //$re_1 = self::tree($re);
        //pt($re_1);
        echo json_encode($re);
    }
    
    public function getTasktype(){
        $t = M('tasktype');
        $re = $t->where('F_PARENTID=2')->select();
        //$re_1 = self::tree($re);
        //pt($re_1);
        echo json_encode($re);
    }

    //列出提现记录
    function getWithdrawList(){
        $map['f_label'] = I('get.label');
        $map['f_strats'] = I('get.strats');
        //$map['f_accounttype'] = I('get.accounttype',2);
        $t = M('shopsheet');
        $total = $t->where($map)->count();
        $page = I('get.page',1);

        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $out_arr['page'] = $page;
        $out_arr['total'] = $total;
        $out_arr['pageSize'] = $pageSize;
        $out_arr['totalPage'] = $totalPage;

        //$map[]="";
        $f = "t_shopsheet.f_indexid,t_shopsheet.f_userid,f_taskid,f_amount,f_useraccountid,f_optiondate,f_strats,f_label,f_accounttype,f_accountname,f_bankaccount";
        $j = array("LEFT JOIN t_useraccount ON t_useraccount.f_indexID = t_shopsheet.f_useraccountid");
        $o = "f_optiondate";
        $draw = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order($o)->order("f_optiondate desc")->select();
        foreach($draw as $key=>$val){
            $re = A("Api/Jhttp")->getUserinfo2($val['f_userid']);
            $arr = json_decode($re,true);
            //pt($arr);
            if($arr["resCode"]=="000000"){
                $draw[$key]["f_truename"] = $arr['list']["trueName"];
            }
        }
        //echo $t->getLastSql();
        $out_arr['list'] = $draw;
        echo json_encode($out_arr);
    }
    //手动标记打款成功
    public function ok(){
        $id = I("get.id",0);
        if($id!=0){
            $map['f_strats'] = 1;
            $map_s['f_indexid'] = $id;
            M('shopsheet')->where($map_s)->save($map);
        }
    }

    public function getWithdrawListNo() {
        //$this->getConf();//取数据
        $map['f_label'] = I('get.label');
        $map['f_strats'] = I('get.strats');
        $t = M('shopsheet');
        $total = $t->where($map)->count();

        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $out_arr['totalPage'] = $totalPage;
        echo json_encode($out_arr);
        //$this->pushConf();//输出数据
    }
    
    //个人设置
    public function user_setting(){
        $id = session('id');

        $reModi = M('sysuser')->where('id='.$id)->find();
        $result = M('sysaccess')->select();
        
        $this->assign('reModi', $reModi);
        $this->assign('result', $result);
        $this->display("Power:user_setting");
    }

    //退出登录
    public function user_out(){
        session(null); 
        echo '1';
    }
    
    //js检测是否已经登录
    public function jsislogin() {
        if(empty(session('id'))){
            echo "0";
        }
    }
    //检测是否已经登录
    public function islogin() {
        if(empty(session('id'))){
            $this->error('非法操作，请重新登录',U('Taskadmin/Index/index'),2);
        }
    }

    //修改经销商电话状态
    public function modidearlestatus(){
        $id = I("get.id",0);
        $status = I("get.selectId",0);

        $map['f_status'] = $status;
        $map['f_ctime'] = date("Y-m-d H:i:s", time());
        $map['f_uid'] = session('id');
        $re = M("dealerlibrary")->where("f_indexid=".$id)->save($map);
        echo $re;
    }

    //修改业务员电话状态
    public function modisalestatus(){
        $saleId = I("get.saleId",0);
        $status = I("get.selectId",0);

        $map['f_status'] = $status;
        $map['f_ctime'] = date("Y-m-d", time());
        $map['f_uid'] = session('id');
        $re = M("memberlibary")->where("f_indexid=".$saleId)->save($map);
        echo $re;
    }
    //添加经销商备注
    public function adddealercause(){
        $map['f_uninstall'] = I("post.uninstall",0);
        $map['f_ditch'] = I("post.ditch",0);
        $map['f_industry'] = I("post.industry",0);
        $map['f_job'] = I("post.job",0);
        $map['f_task'] = I("post.task",0);
        $map['f_area'] = I("post.area",0);
        $map['f_indexid'] = I("post.id",0);
        $map['f_creatdate'] = time();
        $remark = I("post.remark",0);
        $remark = ereg_replace("\t","", $remark);
        $remark = ereg_replace("\r\n","", $remark);
        $remark = ereg_replace("\r","", $remark);
        $remark = ereg_replace("\n","",$remark);
        $map['f_desctiption']=$remark;
        $map['f_userid'] = session("id");
        M("dealerlibrary_cause")->add($map);
    }
    //添加业务员备注
    public function addsalecause(){
        $map['f_uninstall'] = I("post.uninstall",0);
        $map['f_ditch'] = I("post.ditch",0);
        $map['f_industry'] = I("post.industry",0);
        $map['f_job'] = I("post.job",0);
        $map['f_task'] = I("post.task",0);
        $map['f_area'] = I("post.area",0);
        $map['f_indexid'] = I("post.id",0);
        $map['f_creatdate'] = time();
        $remark = I("post.remark",0);
        $remark = ereg_replace("\t","", $remark);
        $remark = ereg_replace("\r\n","", $remark);
        $remark = ereg_replace("\r","", $remark);
        $remark = ereg_replace("\n","",$remark);
        $map['f_desctiption']=$remark;
        $map['f_userid'] = session("id");
        $re = M("memberlibary_cause")->add($map);
        echo $re;
    }
    
}
