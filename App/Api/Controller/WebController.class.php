<?php
namespace Api\Controller;
use Think\Crypt\Driver\Think;

use Think\Controller;

class WebController extends Controller {
    
    private  $in_arr,$out_arr;
    
    private function getConf()
    {
        $this->in_arr = array_merge($_GET,$_POST);
    }
    
    private function pushConf(){
        echo A('Api/Fun')->JSON($this->out_arr);
        //A("Fun")->JSON();
        //echo json_encode($this->out_arr);
    }

    public function getToalPage() {
        $this->getConf();//取数据
        
        $tasktypeid = $this->in_arr['tasktypeid'];
        $companyid = $this->in_arr['companyid'];
        
        //$page = $this->in_arr['page'];
        $in_Id = A('Fun')->getTaskTypeId($tasktypeid);
        //$t = M('task');
        if($tasktypeid!=0){
            $map['f_tasktypeid'] = array('in',$in_Id);
         }
         if($companyid!=0){
            $map['f_companyid'] = $companyid;
         }
//         if($page==0 || $page==""){
//            $page = 1;
//         }
         //$map['f_status']  = array('neq',0);
         
        //echo $in_Id;
        //$START_RECORD = $this->in_arr['START_RECORD'];
        $total = D('Task')->getTaskNo($in_Id,$companyid);//总记录数
        //$total = $obj->count();//总记录数
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
//        $this->out_arr['page'] = $page;
//        $this->out_arr['total'] = $total;
//        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        
        $this->pushConf();//输出数据
    }


    //WEB端调用任务列表
//    $rejava = json_decode(A('Jhttp')->getCompanyInfo($companyid),true);
//        if($rejava['resCode']=='000000'){
//            $companyName = "";
//        }else{
//            $companyName = "";
//        }
   public function getproList() {
       $this->getConf();//取数据
        
        $tasktypeid = $this->in_arr['tasktypeid'];
        $companyid = $this->in_arr['companyid'];
        //cho $tasktypeid;
        
        $page = $this->in_arr['page'];
        //echo $page;
        $in_Id = A('Fun')->getTaskTypeId($tasktypeid);
        $t = M('task');
        if($tasktypeid!=0){
            $map['f_tasktypeid'] = array('in',$in_Id);
         }else {
           $map['f_tasktypeid']=array('in','1,2,4,5,6,7');
         }
         if($companyid!=0){
            $map['f_companyid'] = $companyid;
         }
         if($page==0 || $page==""){
            $page = 1;
         }
         $map['f_status']  = array('neq',0);
        if($tasktypeid==1){
            $f = "f_tid,f_surveno,f_title,f_enddate,f_status,f_creatdate,f_eachcoin,f_totalcopies,f_tasktypeid";
            $j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid");
            
        }elseif($tasktypeid==2 || $tasktypeid==4 || $tasktypeid==5 || $tasktypeid==6||$tasktypeid==7){
           $f = "f_tid,f_surveno,f_title,f_enddate,f_status,f_creatdate,f_eachcoin,f_totalcopies,f_tasktypeid";
            $j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid");
        }else{
            $f = "f_tid,f_surveno,f_title,f_enddate,f_status,f_creatdate,f_eachcoin,f_totalcopies,f_tasktypeid";
            $j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid");
        }
        $total = $t->field($f)->where($map)->join($j)->count();//总记录数
        //echo $total;
        //$total = $obj->count();//总记录数
        $pageSize = 10; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        $list = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('f_creatdate desc')->select();
//        echo $t->getLastSql();exit;

        //echo $t->getLastSql();
        foreach ($list as $key => $val) {
            $list[$key]['f_eachcoin_plat'] = $val['f_eachcoin'];
            $list[$key]['f_plattotal'] = $val['f_eachcoin']*2*$val['f_totalcopies'];
            $taskid=$val['f_tid'];
            $map['f_taskid']=$taskid;
            $map['f_shopingtype']=1;
            $map['f_amount']=array("neq",0);
            $map['f_label']='task';
            $num=M('shopsheet')->where($map)->count();
//            if($num > $val['f_totalcopies']){
//                $val['f_status']=4;
//                $t->where('f_tid='.$taskid)->setField("f_status",4);
//            }
//          $re=M("taskreject")->where("f_taskid=".$val['f_tid'])->find();
//			$list[$key]['f_reason']=$re['f_reason'];
        }
        $this->out_arr['list']=$list;
//      print_r($this->out_arr['list']);
//      exit;
        //echo $t->getLastsql();
        $this->pushConf();//输出数据
   }
    
    public function getTaskList() {
        $this->getConf();//取数据
        
        $tasktypeid = $this->in_arr['tasktypeid'];
        $companyid = $this->in_arr['companyid'];
        //echo  $tasktypeid."==";
        $page = $this->in_arr['page'];

//        dump($page);return;

        $in_Id = A('Fun')->getTaskTypeId($tasktypeid);
        $t = M('task');
        if($tasktypeid!=0){
            $map['f_tasktypeid'] = array('in',$in_Id);
         }
         if($companyid!=0){
            $map['f_companyid'] = $companyid;
         }
         if($page==0 || $page==""){
            $page = 1;
         }
         $map['f_status']  = array('neq',0);
         
        //echo $in_Id;
        //$START_RECORD = $this->in_arr['START_RECORD'];
        $total = D('Task')->getTaskNo($in_Id,$companyid);//总记录数
        //$total = $obj->count();//总记录数
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        
        if($tasktypeid==1){
            $f = "";
            $j = array("LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid");
        }elseif($tasktypeid==2 || $tasktypeid==4 || $tasktypeid==5 || $tasktypeid==6||$tasktypeid==6){
            $f = "";
            $j = array("LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid");
        }elseif($tasktypeid==3){  //招商赚
            //{"f_tid":"35","f_companyid":"103","f_creatuserid"
            $time=date("Y-m-d",time());
            $data['f_enddate']=array('LT',$time);
            $data['f_companyid']=$companyid;
            $data['f_tasktypeid']=$tasktypeid;
            $data['f_status'] = array("neq",0);  //已经删除过了就不自动判断是否过期了
            $re=$t->where($data)->setField('f_status',4);
            $f = "f_tasktypeid,f_tid,f_surveno,f_title,f_creatdate,f_companyid,f_creatuserid,f_description,f_begindate,f_enddate,f_status,f_typename,f_linkman,f_linkphone,f_mtbrand,f_mtgoods,f_unitfirstAmount,f_unitcashdeposit,f_unitfranchisefee,f_unitotheramount,f_unittotalamount,f_tradename,f_hometask";
            $j = array("LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtdetailedinfo ON t_taskmtdetailedinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtattach ON t_taskmtattach.f_taskid = t_task.f_tid","LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid","LEFT JOIN t_tradetype ON t_tradetype.f_tradeID = t_taskmtbaseinfo.f_tradeid");
        }else{
            $f = "";
            $j = array("LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid");
        }

        $this->out_arr['list'] = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('f_hometask desc,f_creatdate desc')->select();
        foreach ($this->out_arr['list'] as $key => $value) {
            $description = trim($value['f_description']);
            $description= ereg_replace("\t","",$description);
            $description= ereg_replace("\r\n","",$description);
            $description = ereg_replace("\r","",$description);
            $description = ereg_replace("\n","",$description);
            $description = ereg_replace("\"","&quot;",$description);
            $description= ereg_replace("&","&amp;",$description);
            $description= ereg_replace("<","&lt;",$description);
            $description = ereg_replace(">","&gt;",$description);
            $this->out_arr['list'][$key]['f_description'] = ereg_replace(">","&gt;",$description);
//          $re2=M("taskreject")->where("f_taskid=".$value['f_tid'])->select();
//      	$this->out_arr['list'][$key]['f_reason']=$re2;
        }
//      //$this->out_arr['sql'] = $t->getLastsql();
//      print_r($this->out_arr['list']);
//      exit;
        $this->pushConf();//输出数据
    }
    
	public function showProReject(){
		$this->getConf();//取数据
        $taskid = $this->in_arr['taskid'];
		$re2=M("taskreject")->where("f_taskid=".$taskid)->select();
        $this->out_arr['list']=$re2;
		$this->pushConf();//输出数据
	}

    public function getPublishTask() {
        $this->getConf();//取数据
        
        $page = $this->in_arr['page'];

        if($page==0 || $page==""){
          $page = 1;
        }

        $t = M('task');
        $map['f_status']  = array('eq',3);
        $map['f_tasktypeid']  = array('eq',3);

        $total = D('Task')->getPublishTaskNo();//总记录数
        $pageSize = 10; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->out_arr['list'] = $t->field('f_description',true)->where($map)->page($page.','.$pageSize)->order('f_creatdate desc')->select();
        $this->pushConf();//输出数据
    }

    public function getActivity() {
        $this->getConf();//取数据
        
        $tabType = isset($this->in_arr['tabType'])?$this->in_arr['tabType']:1;
        $page = $this->in_arr['page'];

        if($page==0 || $page==""){
          $page = 1;
        }

        $t = M('ad');
        $map['f_type']  = $tabType;

        $total = $t->where($map)->count();//总记录数
        $pageSize = 10; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $f = "t_ad.f_id,f_title,f_datetime,f_starttime,f_endtime,f_url,f_type,f_fid,f_top,f_desc,f_filename,f_filepath";
        $j = array("LEFT JOIN t_files ON t_files.f_id = t_ad.f_fid");
        $this->out_arr['list'] = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('t_ad.f_id desc')->select();
//        foreach ($this->out_arr['list'] as $key => $value) {
//            $this->out_arr['list'][$key]['f_name'] = M("files")->where("f_id=".$value['f_fid'])->find();
//        }
// var_dump($this->out_arr['list']);exit();
        $this->pushConf();//输出数据
    }

    public function getActivityPage() {
        $this->getConf();//取数据

        $tabType = isset($this->in_arr['tabType'])?$this->in_arr['tabType']:1;
        $t = M('ad');
        $map['f_type']  = $tabType;

        $total = $t->where($map)->count();//总记录数

        $pageSize = 10; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数

        $this->out_arr['totalPage'] = $totalPage;
        
        $this->pushConf();//输出数据
    }

    public function addActivity() {
        $this->getConf();//取数据

        $t = M('ad');
        $map['f_type']  = $this->in_arr['type'];
        $map['f_title']  = $this->in_arr['title'];
        $map['f_starttime']  = strtotime($this->in_arr['startdate']);
        $map['f_endtime']  = strtotime($this->in_arr['enddate']);
        $map['f_url']  = $this->in_arr['shareUrl'];
        $map['f_isurl']  = $this->in_arr['isUrl'];
        $map['f_top']  = $this->in_arr['isShow'];
        $map['f_note']  = $this->in_arr['content'];
        $map['f_fid']  = $this->in_arr['fileid'];
        $map['f_desc']  = $this->in_arr['adDescription'];
        $map['f_datetime']  = time();

        $t->data($map)->add();//总记录数
        
        $this->pushConf();//输出数据
    }

    public function delActivity() {
        $this->getConf();//取数据
        
        $map['f_status'] = 0;
        $activityIds = explode("|", $this->in_arr['activityIds']);
        //echo count($taskids);
        for($i=0;$i<count($activityIds);$i++){
            M('ad')->where('f_id='.$activityIds[$i])->delete();
            //echo M('task')->getLastsql();
        }
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }
    
    public function getModiAd() {
        $this->getConf();//取数据
        
        $activityId = isset($this->in_arr['activityId'])?$this->in_arr['activityId']:0;
        if($activityId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $this->out_arr['list'] = M('ad')->where('f_id='.$activityId)->find();

            $this->out_arr['list']['f_starttime'] = date("Y/m/d", $this->out_arr['list']['f_starttime']) ;
            $this->out_arr['list']['f_endtime'] = date("Y/m/d", $this->out_arr['list']['f_endtime']) ;
            $this->out_arr['list']['f_note'] = str_replace(PHP_EOL, '', $this->out_arr['list']['f_note']); 

            $this->out_arr['list']['f_name'] = M("files")->where("f_id=".$this->out_arr['list']['f_fid'])->find();

            $this->out_arr['result'] = '000000';
        }
        
        return $this->out_arr;
    }

    public function upActivity() {
        $this->getConf();//取数据
        
        $t = M('ad');
        $map['f_type']  = $this->in_arr['type'];
        $map['f_title']  = $this->in_arr['title'];
        $map['f_starttime']  = strtotime($this->in_arr['startdate']);
        $map['f_endtime']  = strtotime($this->in_arr['enddate']);
        $map['f_url']  = $this->in_arr['shareUrl'];
        $map['f_isurl']  = $this->in_arr['isUrl'];
        $map['f_top']  = $this->in_arr['isShow'];
        $map['f_note']  = $this->in_arr['content'];
        $map['f_fid']  = $this->in_arr['fileid'];
        $map['f_desc']  = $this->in_arr['adDescription'];
        $map['f_datetime']  = time();

        $t->where('f_id='.$this->in_arr['activityId'])->save($map);//总记录数
        
        $this->pushConf();//输出数据
    }

    public function getCompanyInfo() {
        $this->getConf();//取数据
        
        $dealerId = isset($this->in_arr['dealerId'])?$this->in_arr['dealerId']:0;
        if($dealerId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $this->out_arr['one'] = M('taskmtbaseinfo')->field("f_mtbrand,f_mtgoods,f_unitfirstAmount,f_unitcashdeposit,f_unitfranchisefee,f_unitotheramount,f_unittotalamount,f_unitcommission,f_tradeid")->where('f_taskid='.$dealerId)->find();
            $this->out_arr['two']= M('task')->field("f_begindate,f_enddate,f_linkman,f_linkphone,f_companyid,f_title")->where('f_tid='.$dealerId)->find();
            $companyDetail = A('Api/Jhttp')->getCompanyInfo($this->out_arr['two']['f_companyid']);
            $arr=json_decode($companyDetail,true);
            $this->out_arr['companyName'] = $arr['list']['companyName'];
            if (isset($this->out_arr['one'])) {
              $this->out_arr['trade'] = M('tradetype')->field("f_tradename")->where('f_tradeID='.$this->out_arr['one']['f_tradeid'])->find();
            }else{
              $this->out_arr['trade'] = '';
            }

            $this->out_arr['three'] = M('taskmtdetailedinfo')->field("f_brandlocation,f_distributorsrequir")->where('f_taskid='.$dealerId)->find();
            $this->out_arr['four'] = M('taskmtareaqty')->field("f_area,f_qty")->where('f_taskid='.$dealerId)->select();

            $this->out_arr['result'] = '000000';
        }
        
        return $this->out_arr;
    }

    public function getDetail() {
        $this->getConf();//取数据
        
        $dealerId = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;
        if($dealerId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $this->out_arr['one'] =M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $this->out_arr['two']= M('dealerqualifyinfo')->where('f_dealerid='.$dealerId)->find();

            $userDetails = A('Api/Jhttp')->getUserinfo2($this->out_arr['one']['f_userid']);
            $arr=json_decode($userDetails,true);
            $arr['list']['userJobDeclaration']=strip_tags($arr['list']['userJobDeclaration']);
            $this->out_arr['three'] = $arr['list']; 

            $this->out_arr['result'] = '000000';
        }
        
        return $this->out_arr;
    }

    public function getDealerExport(){
        $this->getConf();//取数据
        
        $map['f_taskid'] = $this->in_arr['taskid'];

        $t = M('dealerbaseinfo');
        $f="";
        $j=array("LEFT JOIN t_dealerqualifyinfo ON t_dealerqualifyinfo.f_dealerid = t_dealerbaseinfo.f_dealerid");
        
        $this->out_arr['list'] = $t->field($f)->where($map)->join($j)->order('t_dealerbaseinfo.f_dealerid desc')->select();

        foreach ($this->out_arr['list'] as $key => $value) {
            $userDetails = A('Api/Jhttp')->getUserinfo2($value['f_userid']);
            $arr=json_decode($userDetails,true);
            $this->out_arr['list'][$key]['trueName'] = $arr['list']['trueName']; 
            $this->out_arr['list'][$key]['mobile'] = $arr['list']['mobile']; 
        }
        session("getDealerExport",$this->out_arr);

        // return $this->out_arr;

    }

    function modiDealerBtn(){
        $this->getConf();//取数据
        $f_indexid = $this->in_arr['f_indexid'];

        $map['f_dealername'] = $this->in_arr['f_dealername'];
        $map['f_area'] = $this->in_arr['f_area'];
        $map['f_industrytype'] = $this->in_arr['f_industrytype'];
        $map['f_channeltype'] = $this->in_arr['f_channeltype'];
        $map['f_managementlife'] = $this->in_arr['f_managementlife'];
        $map['f_goodsreceiptadd'] = $this->in_arr['f_goodsreceiptadd'];
        $map['f_annualturnover'] = $this->in_arr['f_annualturnover'];
        $map['f_logisticsqty'] = $this->in_arr['f_logisticsqty'];
        $map['f_employeeqty'] = $this->in_arr['f_employeeqty'];
        $map['f_mainproduct'] = $this->in_arr['f_mainproduct'];
        $map['f_warehousearea'] = $this->in_arr['f_warehousearea'];
        $map['f_coverageqty'] = $this->in_arr['f_coverageqty'];
        $map['f_customerqty'] = $this->in_arr['f_customerqty'];
        $map['f_dotqty'] = $this->in_arr['f_dotqty'];
        $map['f_chargeperson'] = $this->in_arr['f_chargeperson'];
        $map['f_moblie'] = $this->in_arr['f_moblie'];
        $map['f_telPhone'] = $this->in_arr['f_telPhone'];
        $map['f_fax'] = $this->in_arr['f_fax'];
        $map['f_communadd'] = $this->in_arr['f_communadd'];

        M('dealerlibrary')->where('f_indexid='.$f_indexid)->save($map);
        $this->out_arr['rescode'] = '000000';
        $this->pushConf();//输出数据
    }

    function salesBtn(){
        $this->getConf();//取数据
        $f_indexid = $this->in_arr['f_indexid'];

        $map['f_nickname'] = $this->in_arr['f_nickname'];
        $map['f_truename'] = $this->in_arr['f_truename'];
        $map['f_moblie'] = $this->in_arr['f_moblie'];
        $map['f_area'] = $this->in_arr['f_area'];
        $map['f_industrytype'] = $this->in_arr['f_industrytype'];

        M('memberlibary')->where('f_indexid='.$f_indexid)->save($map);
        $this->out_arr['rescode'] = '000000';
        $this->pushConf();//输出数据
    }

    public function showManDetail() {
        $this->getConf();//取数据
        
        $userid = isset($this->in_arr['userid'])?$this->in_arr['userid']:0;
        if($userid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $f['f_userid']=$userid;
            $f['f_status']=0;
            $this->out_arr['one'] = M('useraccount')->where($f)->select();
            foreach ($this->out_arr['one'] as $key => $value) {
                $this->out_arr['one'][$key]['f_linkdatetime'] = date("Y-m-d H:i:s",$value['f_linkdatetime']);
            }
            // var_dump($this->out_arr['one']);exit();

            $userDetails = A('Api/Jhttp')->getUserinfo2($userid);
            $arr=json_decode($userDetails,true);
            $this->out_arr['list']= $arr['list']; 

            $this->out_arr['result'] = '000000';
        }
        
        return $this->out_arr;
    }

    public function showCompanyDetail() {
        $this->getConf();//取数据
        
        $companyId = isset($this->in_arr['companyId'])?$this->in_arr['companyId']:0;
        $state = isset($this->in_arr['state'])?$this->in_arr['state']:0;
        if($companyId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $userDetails = A('Api/Jhttp')->getCompanyInfo($companyId);
            
            $arr=json_decode($userDetails,true);
            $this->out_arr['list']= $arr['list']; 
            if (!empty($this->out_arr['list']['companyExtList'])) {
                foreach ($this->out_arr['list']['companyExtList'] as $key => $value) {
                    if (isset($value['extValue'])) {
                        $this->out_arr['list']['companyExtList'][$key]['f_name'] = M("files")->where("f_id=".$value['extValue'])->find();
                    }
                }
            }

            $map['company_id'] = $companyId;
            $detail = M("company_set")->where($map)->find();
            $arr = array('business_licence','tax_registration','org_regist','core_logo','prod_licence','food_per','san_license');
            foreach ($detail as $key => $value) {
                if (in_array($key,$arr))
                {
                    $where['f_id'] = $detail[$key];
                    $photos[$key] = M("files")->where($where)->find();
                }
            }
            $this->out_arr['photos'] = $photos;
            $this->out_arr['result'] = '000000';
            
            if ($state == 1 || $state == '1') {
                $this->out_arr['state'] = '000000';
            }
        }
        
        return $this->out_arr;
    }

    public function checkCompany() {
        $this->getConf();//取数据
        
        $companyId = isset($this->in_arr['companyId'])?$this->in_arr['companyId']:0;
        $state = isset($this->in_arr['state'])?$this->in_arr['state']:1;
        // var_dump($state);exit();
        if($companyId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $result = A('Api/Jhttp')->checkCompany($companyId,$state);
            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    public function showdtask() {
        $this->getConf();//取数据

        $userid = isset($this->in_arr['userid'])?$this->in_arr['userid']:0;
        if($userid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $taskids = M('taskdraw')->field('distinct(f_taskid)')->where('f_userid='.$userid)->select();
            foreach ($taskids as $key => $value) {
                $tasks[] = M('task')->where('f_tid='.$value['f_taskid'])->find();
            }

            foreach ($tasks as $key => $value) {
                if (isset($value['f_tasktypeid'])) {
                    $tasks[$key]['f_tasktype'] = M('tasktype')->field('F_TYPENAME')->where('F_TYPEID='.$value['f_tasktypeid'])->find();
                }
            }
            $tasks['result'] = '000000';
            $tasks['userid'] = $userid;
        }
        return $tasks;

    }


    public function taskType($userid,$taskType) {

        if($userid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $f['f_userid'] = $userid;
            $f['f_utask_status'] = $taskType;
            if ($taskType == 0) {
                $taskids = M('taskdraw')->field('distinct(f_taskid)')->where('f_userid='.$userid)->select();
            }else{
                $taskids = M('taskdraw')->field('distinct(f_taskid)')->where($f)->select();
            }
            foreach ($taskids as $key => $value) {
                $tasks = M('task')->where('f_tid='.$value['f_taskid'])->find();
                if ($tasks) {
                    $this->out_arr['list'][]=$tasks;
                }
            }

            foreach ($this->out_arr['list'] as $key => $value) {
                if (isset($value['f_tasktypeid'])) {
                    $this->out_arr['list'][$key]['f_tasktype'] = M('tasktype')->field('F_TYPENAME')->where('F_TYPEID='.$value['f_tasktypeid'])->find();
                }
            }
            $this->out_arr['result'] = '000000';
            $this->out_arr['userid'] = $userid;
            $this->out_arr['taskType'] = $taskType;
        }

        $this->pushConf();//输出数据
    }

    public function getPublishPage() {
        $this->getConf();//取数据

        $total = D('Task')->getPublishTaskNo();//总记录数

        $pageSize = 10; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数

        $this->out_arr['totalPage'] = $totalPage;
        
        $this->pushConf();//输出数据
    }
    
    //删除任务
    public function delTask() {
        $this->getConf();//取数据
        
        $map['f_status'] = 0;
        $taskids = explode("|", $this->in_arr['taskids']);
        for($i=0;$i<count($taskids);$i++){
            M('task')->where('f_tid='.$taskids[$i])->save($map);

            //操作记录入库
            $log['f_rejectuserid'] = cookie("userId");   //操作人id
            $log['f_reason'] = "删除招商任务";  //操作说明
            $log['f_taskid'] = $taskids[$i];  //任务id
            $log['f_datetime'] = time();
            M('taskreject')->add($log);
        }
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    //设置首页任务
    public function setHomeTask() {
        $this->getConf();//取数据
        $taskids = explode("|", $this->in_arr['taskids']);
        for($i=0;$i<count($taskids);$i++){
            M('task')->where('f_tid='.$taskids[$i])->setField('f_hometask',1);
            //操作记录入库
            $log['f_rejectuserid'] = cookie("userId");   //操作人id
            $log['f_reason'] = "设置招商任务首页";  //操作说明
            $log['f_taskid'] = $taskids[$i];  //任务id
            $log['f_datetime'] = time();
            M('taskreject')->add($log);
        }
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

     //取消首页任务
    public function unSetHomeTask() {
        $this->getConf();//取数据
        $taskids = explode("|", $this->in_arr['taskids']);
        for($i=0;$i<count($taskids);$i++){
            M('task')->where('f_tid='.$taskids[$i])->setField('f_hometask',0);
            //操作记录入库
            $log['f_rejectuserid'] = cookie("userId");   //操作人id
            $log['f_reason'] = "取消招商任务首页";  //操作说明
            $log['f_taskid'] = $taskids[$i];  //任务id
            $log['f_datetime'] = time();
            M('taskreject')->add($log);
        }
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    //下架任务确定
    public function undercarriageTask() {
        $this->getConf();//取数据
        $map['f_status'] = 11;
        $taskid = $this->in_arr['taskid'];
        M('task')->where('f_tid='.$taskid)->save($map);

        // //操作记录入库
        // $log['f_rejectuserid'] = cookie("userId");   //操作人id
        // $log['f_reason'] = "下架招商任务";  //操作说明
        // $log['f_taskid'] = $taskids[$i];  //任务id
        // $log['f_datetime'] = time();
        // M('taskreject')->add($log);
        $t = M('taskreject');
        $w['f_taskid']  = $taskid;
        $w['f_rejectuserid']  = session("id");
        $w['f_proname']  = "undercarriage";
        $w['f_reason']  = $this->in_arr['undercarriage_reason'];
        $w['f_column']  = 100;
        $w['f_datetime']  = time();
        $t->data($w)->add();//总记录数


        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    //客服审核通过
    public function reviewTask() {
        $this->getConf();//取数据

        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;
        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('taskreject');
            $map['f_reason']  = $this->in_arr['reason'];
            $map['f_taskid']  = $taskid;
            $map['f_rejectuserid']  = session("id");
            $map['f_proname']  = "review";
            $map['f_column']  = 100;
            $map['f_datetime']  = time();

            $t->data($map)->add();//总记录数

            $update['f_status'] = 7;
            M("task")->where('f_tid='.$taskid)->save($update); 
        
        }
        
        $this->pushConf();//输出数据
    }

    //客服审核不通过
    public function reviewTaskNo() {
        $this->getConf();//取数据

        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;
        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('taskreject');
            $map['f_reason']  = $this->in_arr['reason'];
            $map['f_taskid']  = $taskid;
            $map['f_rejectuserid']  = session("id");
            $map['f_proname']  = "noReview";
            $map['f_column']  = 100;
            $map['f_datetime']  = time();

            $t->data($map)->add();//总记录数

            $update['f_status'] = 10;

            M("task")->where('f_tid='.$taskid)->save($update); 
        
        }
        
        $this->pushConf();//输出数据
    }

    //财务审核通过
    public function cwReviewTask() {
        $this->getConf();//取数据

        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;
        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('taskreject');
            $map['f_reason']  = $this->in_arr['reason'];
            $map['f_taskid']  = $taskid;
            $map['f_rejectuserid']  = session("id");
            $map['f_proname']  = "cwReview";
            $map['f_column']  = 100;
            $map['f_datetime']  = time();

            $t->data($map)->add();//总记录数

            $update['f_status'] = 3;
            
            M("task")->where('f_tid='.$taskid)->save($update);

            //个推推送
            // $url = "http://localhost/wisdom/Getui/respIGt.php?type=1";
            // $body = array(
            //     'title'=>'aaa',
            //     'text'=>'bbb',
            //     'task_id'=>'1',
            // );
            // $aa = A("Api/Easemob")->easemob_curl($url,$body);
            // pt($aa);

        }
        
        $this->pushConf();//输出数据
    }

    //财务审核不通过
    public function cwReviewTaskNo() {
        $this->getConf();//取数据

        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;
        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('taskreject');
            $map['f_reason']  = $this->in_arr['reason'];
            $map['f_taskid']  = $taskid;
            $map['f_rejectuserid']  = session("id");
            $map['f_proname']  = "noReview";
            $map['f_column']  = 100;
            $map['f_datetime']  = time();

            $t->data($map)->add();

            $update['f_status'] = 10;

            M("task")->where('f_tid='.$taskid)->save($update); 
        
        }
        
        $this->pushConf();//输出数据
    }

    //任务延时
    public function getDelayTask() {
        $this->getConf();//取数据

        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;
        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('task');

            $this->out_arr['list'] = $t->where("f_tid=".$taskid)->find();
            $this->out_arr['result'] = '000000';
        
        }

        return $this->out_arr;
    }

   //任务更新确定
    public function getUpdateConfirm() {
        $this->getConf();//取数据

        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;

        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('task');
            $map["f_creatdate"]=time();
            $this->out_arr['list'] = $t->where("f_tid=".$taskid)->save($map);

            $p = M('taskreject');
            $map['f_taskid']  = $taskid;
            $map['f_rejectuserid']  = session("id");
            $map['f_proname']  = "update";
            $map['f_column']  = 100;
            $map['f_datetime']  = time();
            $p->data($map)->add();

            $this->out_arr['result'] = '000000';
        
        }

        $this->pushConf();//输出数据
    }
     
    //任务延时确定
    public function getDelayConfirm() {
        $this->getConf();//取数据

        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;
        $newenddate = $this->in_arr['newenddate'];

        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('task');
            $map["f_enddate"]=$newenddate;
            $this->out_arr['list'] = $t->where("f_tid=".$taskid)->save($map);

            $p = M('taskreject');
            $map['f_taskid']  = $taskid;
            $map['f_rejectuserid']  = session("id");
            $map['f_proname']  = "delay";
            $map['f_column']  = 100;
            $map['f_datetime']  = time();
            $p->data($map)->add();

            $this->out_arr['result'] = '000000';
        
        }

        $this->pushConf();//输出数据
    }

    public function getModiTask() {
        $this->getConf();//取数据
        
        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;

        $tasktypeid = isset($this->in_arr['tasktypeid'])?$this->in_arr['tasktypeid']:0;
        if($taskid==0 || $tasktypeid==0){
            $this->out_arr['result'] = '100000';
        }else{
            //$id = A("Api/Fun")->getTaskTypeId($tasktypeid);
            //$w['f_tasktypeid'] = array("in",$id);
            //$j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid=t_task.f_tid");
            $this->out_arr['one'] = M('task')->where('f_tid='.$taskid)->find();
            if (isset($this->out_arr['one']['f_fileid'])) {
                $this->out_arr['one']['f_name'] = M("files")->where("f_id=".$this->out_arr['one']['f_fileid'])->find();
            }
            if (isset($this->out_arr['one']['f_fileid_ban'])) 
            {
                $this->out_arr['one']['f_ban'] = M("files")->where("f_id=".$this->out_arr['one']['f_fileid_ban'])->find();
            }

            if (isset($this->out_arr['one']['f_companyid'])) {
                $result = A('Api/Jhttp')->getCompanyInfo($this->out_arr['one']['f_companyid']);
                $arr=json_decode($result,true);
                $this->out_arr['one']['companyName'] = $arr['list']['companyName']; 
            }
            $this->out_arr['one']['f_description'] = trim($this->out_arr['one']['f_description']);
            $this->out_arr['one']['f_description'] = ereg_replace("\t","",$this->out_arr['one']['f_description']);
            $this->out_arr['one']['f_description'] = ereg_replace("\r\n","",$this->out_arr['one']['f_description']);
            $this->out_arr['one']['f_description'] = ereg_replace("\r","",$this->out_arr['one']['f_description']);
            $this->out_arr['one']['f_description'] = ereg_replace("\n","",$this->out_arr['one']['f_description']);

            if($tasktypeid==1){
               $this->out_arr['pro'] = M('tasksmallinfo')->where('f_taskid='.$taskid)->find();
               // $this->out_arr['pro']['f_taskrequirements'] = str_replace(PHP_EOL, '', $this->out_arr['pro']['f_taskrequirements']);
               $this->out_arr['pro']['f_taskrequirements'] = trim($this->out_arr['pro']['f_taskrequirements']);  
               $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\t","",$this->out_arr['pro']['f_taskrequirements']);  
               $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\r\n","",$this->out_arr['pro']['f_taskrequirements']);  
               $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\r","",$this->out_arr['pro']['f_taskrequirements']);  
               $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\n","",$this->out_arr['pro']['f_taskrequirements']);  

            }elseif($tasktypeid==4 || $tasktypeid==5 || $tasktypeid==6 || $tasktypeid==2||$tasktypeid==7){
                $this->out_arr['pro'] = M('tasksmallinfo')->where('f_taskid='.$taskid)->find();
                $this->out_arr['pro']['f_taskrequirements'] = trim($this->out_arr['pro']['f_taskrequirements']);  
                $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\t","",$this->out_arr['pro']['f_taskrequirements']);  
                $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\r\n","",$this->out_arr['pro']['f_taskrequirements']);  
                $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\r","",$this->out_arr['pro']['f_taskrequirements']);  
                $this->out_arr['pro']['f_taskrequirements'] = ereg_replace("\n","",$this->out_arr['pro']['f_taskrequirements']);

                $this->out_arr['detail'] = M('surveytaskdetail')->where('f_taskid='.$taskid)->order("f_serial")->select();
                foreach ( $this->out_arr['detail'] as $key => $value) {
                    $this->out_arr['detail'][$key]['answer']= explode('|', $value['f_options']);
                    $this->out_arr['detail'][$key]['trueanswer']= explode(',', $value['f_trueanswer']);
                }

                $this->out_arr['detailCount']= count($this->out_arr['detail']);

                //获取稽核赚网点数据
                $this->out_arr['aduit_list']=M("tasksuperaddress")->where('f_task_id='.$taskid)->order('f_uptime')->select();
                $re_count=M("tasksuperaddress")->where('f_task_id='.$taskid)->count();
                if($re_count==""){
                    $this->out_arr['audit_count_list']=0;
                }else{
                    $this->out_arr['audit_count_list']=$re_count;
                }


            }elseif($tasktypeid==3){

                $this->out_arr['two'] = M('taskmtbaseinfo')->where('f_taskid='.$taskid)->find();
                // var_dump($this->out_arr['two']);
                $tradeid = $this->out_arr['two']['f_tradeid'];//取出行业ID
                //取大类ID
                $map = array('f_tradeID'=>$tradeid);
//                $p = M('tradetype')->where('f_tradeID='.$tradeid)->find();
                $p = M('tradetype')->where($map)->find();
                // var_dump($p);exit();
                $this->out_arr['two']['f_parentid'] = $p['f_parentid'];
                $this->out_arr['two']['f_tradeids'] = $p['f_tradeid'];

                $this->out_arr['three']['area'] = M('taskmtareaqty')->where('f_taskid='.$taskid)->find();
                $this->out_arr['three']['pro'] = M('taskmtgoodsdetail')->where('f_taskid='.$taskid)->find();
                $this->out_arr['four'] = M('taskmtdetailedinfo')->where('f_taskid='.$taskid)->find();

                $this->out_arr['four']['f_note'] = trim($this->out_arr['four']['f_note']);  
                $this->out_arr['four']['f_note'] = ereg_replace("\t","",$this->out_arr['four']['f_note']);  
                $this->out_arr['four']['f_note'] = ereg_replace("\r\n","",$this->out_arr['four']['f_note']);  
                $this->out_arr['four']['f_note'] = ereg_replace("\r","",$this->out_arr['four']['f_note']);  
                $this->out_arr['four']['f_note'] = ereg_replace("\n","",$this->out_arr['four']['f_note']);
                // $this->out_arr['four']['f_note'] = ereg_replace(" ","",$this->out_arr['four']['f_note']);  
                // $four = $this->out_arr['four'];
                // $this->out_arr['four']['f_note'] = str_replace(PHP_EOL, '', $four['f_note']);
                // $this->out_arr['four']['f_note']= str_replace("\"",'\'',$this->out_arr['four']['f_note']);
                // pt($this->out_arr['four']);exit();
                $this->out_arr['five'] = M('taskmtattach')->where('f_taskid='.$taskid)->find();
            }
            $this->out_arr['result'] = '000000';
        }
        
        //$this->pushConf();//输出数据
        return $this->out_arr;
    }

    public function getRejectTask() {
        $this->getConf();//取数据
        
        $taskid = isset($this->in_arr['taskid'])?$this->in_arr['taskid']:0;
        if($taskid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $t = M('taskreject');
            $map['f_reason']  = $this->in_arr['reason'];
            $map['f_taskid']  = $taskid;
            $map['f_rejectuserid']  = session("id");
            $map['f_proname']  = "reject";
            $map['f_column']  = 100;
            $map['f_datetime']  = time();

            $t->data($map)->add();//总记录数

            $update['f_status'] = '5';
            
            M("task")->where('f_tid='.$taskid)->save($update); 
        
        }
        $this->pushConf();//输出数据
    }

    public function addSaleNote() {
        $this->getConf();//取数据
        
        $saleId = isset($this->in_arr['saleId'])?$this->in_arr['saleId']:0;
        if($saleId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $map['f_note']  = $this->in_arr['reason'];
            $map['f_status']  = $this->in_arr['selectid'];

            M("memberlibary")->where('f_indexid='.$saleId)->save($map); 
        
        }
        $this->pushConf();//输出数据
    }

    public function addDealerNote() {
        $this->getConf();//取数据
        
        $saleId = isset($this->in_arr['saleId'])?$this->in_arr['saleId']:0;
        if($saleId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $map['f_note']  = $this->in_arr['reason'];
            $map['f_status']  = $this->in_arr['selectid'];

            M("dealerlibrary")->where('f_indexid='.$saleId)->save($map); 
        
        }
        $this->pushConf();//输出数据
    }

    //是否存在相应的授权书
    public function isTrue() {
        $this->getConf();//取数据
        $authorityNum = isset($this->in_arr['authorityNum'])?$this->in_arr['authorityNum']:0;


        if($authorityNum==0){
            $this->out_arr['result'] = '100000';
        }else{
            $this->out_arr['authorization'] = M("authorization")->where('f_authnumber='.$authorityNum)->find(); 
            $this->out_arr['result'] = '';
            $this->out_arr['userDetail'] = '';
            $this->out_arr['companyDetail'] = '';
            $this->out_arr['phone'] = '';
            if (isset($this->out_arr['authorization'])) {
                $j = array("LEFT JOIN t_task ON t_task.f_tid = t_dealerbaseinfo.f_taskid");
                $this->out_arr['detail'] = M('dealerbaseinfo')->JOIN($j)->where('f_dealerid='.$this->out_arr['authorization']['f_dealerid'])->find();  //查找经销商任务基础信息

                $this->out_arr['userDetail'] = $this->getUserDetail($this->out_arr['detail']['f_userid']);
                $this->out_arr['companyDetail'] = $this->getCompanyDetail($this->out_arr['detail']['f_companyid']);  //公司信息

                $time = date("Y/m/d",$this->out_arr['authorization']['f_datetime']);
                $this->out_arr['date']= explode("/", $time);

            }
            $map['f_proname']='remit';
            $map['f_dealerid']=$this->out_arr['authorization']['f_dealerid'];
            $map['f_prostatus']=1;

            $top['f_proname']='receive';
            $top['f_dealerid']=$this->out_arr['authorization']['f_dealerid'];
            $top['f_prostatus']=1;

            $p['f_proname']='contract';
            $p['f_dealerid']=$this->out_arr['authorization']['f_dealerid'];
            $p['f_prostatus']=1;

            $o['f_proname']='contract';
            $o['f_dealerid']=$this->out_arr['authorization']['f_dealerid'];
            $o['f_prostatus']=2;
            $c = array("LEFT JOIN t_files ON t_files.f_id = t_business_progress.f_fileid");

            $this->out_arr['remit'] = M('business_progress')->field('t_business_progress.*,t_files.f_filename,t_files.f_filepath,t_files.f_strat,t_files.f_uptime')->JOIN($c)->where($map)->order("t_business_progress.f_protime  desc")->find();
            $this->out_arr['receive'] = M('business_progress')->field('t_business_progress.*,t_files.f_filename,t_files.f_filepath,t_files.f_strat,t_files.f_uptime')->JOIN($c)->where($top)->order("t_business_progress.f_protime  desc")->find();
            $this->out_arr['contract'] = M('business_progress')->field('t_business_progress.*,t_files.f_filename,t_files.f_filepath,t_files.f_strat,t_files.f_uptime')->JOIN($c)->where($p)->order("t_business_progress.f_protime  desc")->find();
            $this->out_arr['secondContract'] = M('business_progress')->field('t_business_progress.*,t_files.f_filename,t_files.f_filepath,t_files.f_strat,t_files.f_uptime')->JOIN($c)->where($o)->order("t_business_progress.f_protime  desc")->find();
            if(isset($this->out_arr['contract'])){
                $this->out_arr['linkOne'] =__ROOT__.'/Public/upfile/'.$this->out_arr['contract']['f_filepath'].$this->out_arr['contract']['f_filename'];
            }

            if(isset($this->out_arr['secondContract'])){
                $this->out_arr['linkTwo'] =__ROOT__.'/Public/upfile/'.$this->out_arr['secondContract']['f_filepath'].$this->out_arr['secondContract']['f_filename'];
            }


            if (isset($this->out_arr['detail']['f_taskid'])) {
                $taskid = $this->out_arr['detail']['f_taskid'];  //任务id
                //通过taskid 查找t_task表来找companyid,再通过companyid 查找 company_set查找相关资料
                $this->out_arr['business_licence']='';
                $this->out_arr['san_license']='';
                $companyInfo = A("Api/Jhttp")->getCompanyInfo($this->out_arr['detail']['f_companyid']);
                $companyInfo_arr = json_decode($companyInfo,true);
                $com_fiels=$companyInfo_arr['list'];
                if($com_fiels){
                    if($com_fiels["taxRegCertificate"]!=null){
                        $this->out_arr['business_licence']=M("files")->where("f_id=".$com_fiels["taxRegCertificate"])->find();
                    }
                    if($com_fiels["hygieneLicense"]!=null){
                        $this->out_arr['san_license']=M("files")->where("f_id=".$com_fiels["hygieneLicense"])->find();
                    }
                }

//                $companyInfo = M('task')->field("f_companyid")->find();
//                $companySet = M('company_set')->where("company_id=".$companyInfo['f_companyid'])->find();
//                if($companySet['business_licence']){
//                    $this->out_arr['linkThree'] = M('files')->WHERE("f_id=".$companySet['business_licence'])->find(); //营业执照
//                }
////                if($companySet['tax_registration']){
////                    $this->out_arr['linkFour'] = M('files')->WHERE("f_id=".$companySet['tax_registration'])->find(); //税务登记证
////                }


                //查找新增任务时添加的附件
                $match = M("taskmtattach")->where("f_taskid=".$taskid)->find();  //查找field id,用于后面查找附件路径
                $match['f_fileid7'] = empty($match['f_fileid7'])?0:$match['f_fileid7'];  //防出错,给个默认值

                $this->out_arr['file1'] = M('files')->WHERE("f_id=".$match['f_fileid1'])->find();
                $this->out_arr['file2'] = M('files')->WHERE("f_id=".$match['f_fileld2'])->find();
                $this->out_arr['file3'] = M('files')->WHERE("f_id=".$match['f_fileid3'])->find();
                $this->out_arr['file4'] = M('files')->WHERE("f_id=".$match['f_fileid4'])->find();
                $this->out_arr['file5'] = M('files')->WHERE("f_id=".$match['f_fileid5'])->find();
                $this->out_arr['file6'] = M('files')->WHERE("f_id=".$match['f_fileid6'])->find();
                $this->out_arr['file8'] = M('files')->WHERE("f_id=".$match['f_fileid8'])->find();
//                $this->out_arr['file7'] = M('files')->WHERE("f_id=".$match['f_fileid7'])->find();
                $this->out_arr['filepath']=__ROOT__.'/Public/upfile/';
            }

            if (isset($this->out_arr['authorization'])) {
                $this->out_arr['result']="000000";                 
            }else{
                $this->out_arr['result']="100000"; 
            }
        }

        $this->pushConf();
        // return $this->out_arr;
    }

    public function delDealerPic() {
        $this->getConf();//取数据
        
        $id = isset($this->in_arr['id'])?$this->in_arr['id']:0;
        if($id==0){
            $this->out_arr['result'] = '100000';
        }else{
            $map['f_prostatus']  = 0;
            $map['f_fileid']  = 0;
            $map['f_protime']  = time();
            
            M("business_progress")->where('f_id='.$id)->save($map); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    public function uploadContract() {
        $this->getConf();//取数据
        
        $dealerId = isset($this->in_arr['dealerId'])?$this->in_arr['dealerId']:0;
        $profile1 = isset($this->in_arr['profile1'])?$this->in_arr['profile1']:0;
        $contractId = isset($this->in_arr['contractId'])?$this->in_arr['contractId']:0;
        if($dealerId==0){
            $this->out_arr['result'] = '100000';
        }else{
            if ($contractId == 0) {
                $map['f_dealerid']  = $dealerId;
                $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
                $map['f_taskid']  = $result['f_taskid'];
                $map['f_proname']  = 'contract';
                $map['f_prostatus']  = 1;
                $map['f_fileid']  = $profile1;
                $map['f_protime']  = time();
                $this->out_arr['rid'] = M("business_progress")->add($map); 
            }else{
                $p['f_userid']  = session('id');
                $p['f_prostatus']  = 1;
                $p['f_fileid']  = $profile1;
                $p['f_protime']  = time();
                $isExist = M('business_progress')->where('f_id='.$contractId)->save($p);
                $this->out_arr['rid'] = $contractId;
            }

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }


    /**
     * 企业设置上传资料入库
     * type 1 营业执照
     * type 2 税收登记证书
     */
    public function companySet_upload() {
        $this->getConf();//取数据
        $companyId = isset($this->in_arr['companyId'])?$this->in_arr['companyId']:0; //公司id
        $profile = isset($this->in_arr['profile'])?$this->in_arr['profile']:0; //上传文件的id
        $type = $this->in_arr['type'];
        if($companyId==0){
            $this->out_arr['result'] = '100000';
        }else{
            if ( $type == 1 ) {  //营业执照
                $map['business_licence'] = $profile;
            }else if($type == 2 ){  //税收登记证书
                $map['tax_registration'] = $profile;
            }else if($type == 3 ){  //组织机构代码证
                $map['org_regist'] = $profile;
            }else if($type == 4 ){  //公司标志
                $map['core_logo'] = $profile;
            }else if($type == 5 ){  //生产许可证
                $map['prod_licence'] = $profile;
            }else if($type == 6 ){  //食品流通许可证
                $map['food_per'] = $profile;
            }else if($type == 7 ){  //卫生许可证
                $map['san_license'] = $profile;
            }

            $map['upload_time']  = time();
            $map['company_id']  = $companyId;
            $result = M('company_set')->where('company_id='.$companyId)->find();
            if( $result ){  //如果已经存在则是保存
                $this->out_arr['rid'] = M("company_set")->where('company_id='.$companyId)->save($map);
            }else{
                $this->out_arr['rid'] = M("company_set")->add($map);
            }

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

   //新的企业资料上传
    public function companySet_upload_2() {
        $this->getConf();//取数据
        $companyId = isset($this->in_arr['companyId'])?$this->in_arr['companyId']:0; //公司id
        if($companyId==0){
            $this->out_arr['result'] = '100000';
        }else{
            //营业执照
                $taxRegCertificate = $this->in_arr['profile1'];
            //公司标志
                $companyLogo =$this->in_arr['profile4'];
            //生产许可证
                $productionLicense =$this->in_arr['profile5'];
            //食品流通许可证
                $foodDistribLicense= $this->in_arr['profile6'];
             //卫生许可证
                $hygieneLicense=$this->in_arr['profile7'];
                $companyId = cookie("companyId");
                $url = "&taxRegCertificate=".$taxRegCertificate."&companyLogo=".$companyLogo."&productionLicense=".$productionLicense."&foodDistribLicense=".$foodDistribLicense."&hygieneLicense=".$hygieneLicense;
                $re=A("Api/Jhttp")->companyUpdate($companyId,$url);
                $arr = json_decode($re, true);
                $errorCode = $arr['resCode'];
                if ($errorCode == '000000') {
                    $this->out_arr['error_code'] = '000000';
                    $this->out_arr['error_text'] = '';
                } else {
                    $this->out_arr['error_code'] = 'modiCompanyInfo_sys_error';
                    $this->out_arr['error_text'] = A('Jhttpcode')->searchCode($errorCode);
                }
        }
        $this->pushConf();//输出数据
    }


    public function uploadRemit() {
        $this->getConf();//取数据
        
        $dealerId = isset($this->in_arr['dealerId'])?$this->in_arr['dealerId']:0;
        $profile1 = isset($this->in_arr['profile1'])?$this->in_arr['profile1']:0;
        $contractId = isset($this->in_arr['contractId'])?$this->in_arr['contractId']:0;
        if($dealerId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $s['f_dealerid']  = $dealerId;
            $s['f_proname']  = 'remit';
            $s['f_prostatus']  = 0;
            $isExist = M('business_progress')->where($s)->find();

            // if (isset($isExist)) {
            //     $p['f_dealerid']  = $dealerId;
            //     $p['f_prostatus']  = 1;
            //     $p['f_fileid']  = $profile1;
            //     $p['f_protime']  = time();
            //     $re = M('business_progress')->where('f_id='.$isExist['f_id'])->save($p);
            // }else{
                $map['f_dealerid']  = $dealerId;
                $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
                $map['f_taskid']  = $result['f_taskid'];
                $map['f_proname']  = 'remit';
                $map['f_prostatus']  = 1;
                $map['f_fileid']  = $profile1;
                $map['f_protime']  = time();
                $this->out_arr['rid'] = M("business_progress")->add($map); 
            // }

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    public function uploadReceive() {
        $this->getConf();//取数据
        
        $dealerId = isset($this->in_arr['dealerId'])?$this->in_arr['dealerId']:0;
        $profile1 = isset($this->in_arr['profile1'])?$this->in_arr['profile1']:0;
        $contractId = isset($this->in_arr['contractId'])?$this->in_arr['contractId']:0;

        if($dealerId==0){
            $this->out_arr['result'] = '100000';
        }else{

            // $s['f_dealerid']  = $dealerId;
            // $s['f_proname']  = 'receive';
            // $s['f_prostatus']  = 0;
            // $isExist = M('business_progress')->where($s)->find();

            // if (isset($isExist)) {
            //     $p['f_dealerid']  = $dealerId;
            //     $p['f_userid']  = session('id');
            //     $p['f_prostatus']  = 1;
            //     $p['f_fileid']  = $profile1;
            //     $p['f_protime']  = time();
            //     $re = M('business_progress')->where('f_id='.$isExist['f_id'])->save($p);
            // }else{
                $map['f_dealerid']  = $dealerId;
                $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
                $map['f_taskid']  = $result['f_taskid'];
                $map['f_proname']  = 'receive';
                $map['f_prostatus']  = 1;
                $map['f_fileid']  = $profile1;
                $map['f_protime']  = time();
                $this->out_arr['rid'] = M("business_progress")->add($map); 
            // }

            $c['f_dealerid']  = $dealerId;
            $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $c['f_taskid']  = $result['f_taskid'];
            $c['f_proname']  = 'commissionsquare';
            $c['f_prostatus']  = 0;
            $c['f_protime']  = time();
            M("business_progress")->add($c); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }


    public function moneyCheck() {
        $this->getConf();//取数据
        
        $dealerId = isset($this->in_arr['dealerId'])?$this->in_arr['dealerId']:0;
        if($dealerId==0){
            $this->out_arr['result'] = '100000';
        }else{
            $map['f_dealerid']= $dealerId;
            $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $map['f_taskid']  = $result['f_taskid'];
            $map['f_userid']  = session('id');
            $map['f_proname']  = 'remit';
            $map['f_prostatus']  = 2;
            $map['f_protime']  = time();
            $this->out_arr['rid'] = M("business_progress")->add($map); 

            $c['f_dealerid']  = $dealerId;
            $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $c['f_taskid']  = $result['f_taskid'];
            $c['f_proname']  = 'dispatch';
            $c['f_prostatus']  = 0;
            $c['f_protime']  = time();
            M("business_progress")->add($c);

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    // public function dispatchCheck() {
    //     $this->getConf();//取数据
        
    //     $f_id = isset($this->in_arr['f_id'])?$this->in_arr['f_id']:0;
    //     $profile1 = isset($this->in_arr['profile1'])?$this->in_arr['profile1']:0;
    //     $f_dealerid = isset($this->in_arr['f_dealerid'])?$this->in_arr['f_dealerid']:0;

    //     if($f_id==0){
    //         $this->out_arr['result'] = '100000';
    //     }else{

    //         $map['f_userid']  = session('id');
    //         $map['f_prostatus']  = 1;
    //         $map['f_fileid']  = $profile1;
    //         $map['f_protime']  = time();
    //         $this->out_arr['rid'] = M("business_progress")->where('f_id='.$f_id)->save($map); 

    //         $o['f_dealerid']= $f_dealerid;
    //         $result = M('dealerbaseinfo')->where('f_dealerid='.$f_dealerid)->find();
    //         $o['f_taskid']  = $result['f_taskid'];
    //         $o['f_userid']  = session('id');
    //         $o['f_proname']  = 'receive';
    //         $o['f_prostatus']  = 0;
    //         $o['f_protime']  = time();
    //         M("business_progress")->add($o); 


    //         $this->out_arr['result'] = '000000';
    //     }
    //     $this->pushConf();//输出数据
    // }

    public function squareCheck() {
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;
        $moneyid = isset($this->in_arr['moneyid'])?$this->in_arr['moneyid']:0;
        $f_dealerid = isset($this->in_arr['f_dealerid'])?$this->in_arr['f_dealerid']:0;
        if($dealerid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $result = M('dealerbaseinfo')->where('f_dealerid='.$f_dealerid)->find();
            $map['f_dealerid']= $f_dealerid;
            $map['f_taskid']  = $result['f_taskid'];
            $map['f_userid']  = session('id');
            $map['f_proname']  = 'commissionsquare';
            $map['f_prostatus']  = 1;
            $map['f_protime']  = time();
            $this->out_arr['rid'] = M("business_progress")->add($map); 

            $o['f_dealerid']= $f_dealerid;
            // $result = M('dealerbaseinfo')->where('f_dealerid='.$f_dealerid)->find();
            $o['f_taskid']  = $result['f_taskid'];
            $o['f_proname']  = 'Settlement';
            $o['f_prostatus']  = 0;
            $o['f_protime']  = time();
            M("business_progress")->add($o); 

            $content = M("dealerbaseinfo")->where('f_dealerid='.$f_dealerid)->find();
//            A("Mobileweb/Events")->is_ip($map['f_userid'],$map['f_taskid']);//控制
            D("Shopsheet")->add_shopsheet('task',$content['f_userid'],1,1,$moneyid*10,$content['f_taskid'],1,0,0);

            //分红
            $this->allocation_gold($content['f_userid'],$moneyid*10);


            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    public function settlementCheck() {
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;
        $f_dealerid = isset($this->in_arr['f_dealerid'])?$this->in_arr['f_dealerid']:0;
        if($dealerid==0){
            $this->out_arr['result'] = '100000';
        }else{

            $map['f_userid']  = session('id');
            $map['f_prostatus']  = 1;
            $map['f_protime']  = time();
            $this->out_arr['rid'] = M("business_progress")->where('f_id='.$dealerid)->save($map); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    public function comContract() {
        $this->getConf();//取数据

        $dealerId = isset($this->in_arr['dealerId'])?$this->in_arr['dealerId']:0;
        $profile1 = isset($this->in_arr['profile1'])?$this->in_arr['profile1']:0;
        if($dealerId==0){
            $this->out_arr['result'] = '100000_1';
        }else{

            $map['f_dealerid']  = $dealerId;
            $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $map['f_taskid']  = $result['f_taskid'];
            $map['f_userid']  = cookie('userId');
            $map['f_proname']  = 'contract';
            $map['f_prostatus']  = 2;
            $map['f_fileid']  = $profile1;
            $map['f_protime']  = time();
            $this->out_arr['rid'] = M("business_progress")->add($map); 

            $o['f_dealerid']= $dealerId;
            $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $o['f_taskid']  = $result['f_taskid'];
            $o['f_proname']  = 'remit';
            $o['f_prostatus']  = 0;
            $o['f_protime']  = time();
            $result2=M("business_progress")->add($o);
//            echo $result2;
            if($result2){
                //向business_progress表中插入的数据成功
                //将经销商信息提交到java的用户中心
                $result1=M("dealerbaseinfo")->where("f_dealerid=".$dealerId)->find(); //返回数组
                if(count($result1)>0){
                    //判断经销商信息是否存在
                    $dealerCompanyName=$result1["f_companynameone"];
                    $phone=explode("|",$result1["f_phoneone"]);

                    $dealerPhone=$phone[0];
                    $dealerpassword=123456; //经销商进入的默认密码(存在用户中心))
                    $truename=$result1["f_contactsname"];
                    $dealertasid=$result1["f_taskid"];
                    $flatType = isset($this->in_arr['flattype']) ? $this->in_arr['flattype'] : 2;
                    $tasklist=M("task")->where("f_tid=".$dealertasid)->select();
                    if($tasklist){
                        $facId=$tasklist[0]["f_companyid"];
                        $re3=A("Jhttp")->addFacAgeNew($facId,$dealerCompanyName,$truename,$dealerPhone);
                        $arr = json_decode($re3,true);
                        if($arr["resCode"]=="000000"){
                            $this->out_arr['result'] = '000000';
                            //添加厂商与经销关系成功
//                                    //经销商第一个人开通企业设置权限
//                                    $map["f_company_id"]=$newdealerId;
//                                    $map["f_access"]="a1,a2,a3,a4,b1,b2,b3,c1,c2,c3,c4,d1,d2,d3,e1";
//                                    $map["f_name"]="超级管理员";
//                                    $re6=M("role")->add($map);
//                                    $re67= A('Jhttp')->userlogin($newdealerId, $dealerPhone);
//                                    $arr67 = json_decode($re67, true);
//                                    $userid=$arr67['list']['user']['userId'];
//                                    if($re6!=0){
//                                        $data["f_user_id"]=$userid;
//                                        $data["f_role_id"]=$re6;
//                                        $data["f_company_id"]=$newdealerId;
//                                        $re7=M("user_role")->add($data);
//                                        if($re7!=0){
//                                            $this->out_arr["result"]="000000";
//                                        }else{
//                                            $this->out_arr["result"]="100000_7";
//                                        }
//                                    }
//                                    $this->out_arr['result'] = '000000';
                        }
                    }
                    //    command=addFacAgeNew&facId=90&ageName=童翔宇测试企业07&trueName=童07&invitationCode=&phone=18992865555&flatType=2&password=e10adc3949ba59abbe56e057f20f883e
//                    $re=A('Jhttp')->addFacAgeNew();

//                    -----------------------------------------------
//                    echo $dealertasid."==</br>";
//                    $re=A('Jhttp')->getCompanyName($dealerCompanyName);
//                    $arr = json_decode($re,true);
//                    $errorCode = $arr["resCode"];
//                    $companylist=$arr['list'];
//                    if($errorCode=="000000"){// 企业存在,获取经销商id
////                        $newDealerId="";
//                        foreach($companylist as $key=>$value){
//                            if($value["companyName"]==$dealerCompanyName){
//                                $newDealerId=$value["companyId"];
//                                break;
//                            }
//                        }
//                        $tasklist=M("task")->where("f_tid=".$dealertasid)->select();
////                        echo var_dump($tasklist);
//                        if($tasklist){
//                            //任务存在
//                            $companyid=$tasklist[0]["f_companyid"];
////                            echo $companyid."</br>";
////                            echo $newDealerId."</br>";
////                            $re3=A("Jhttp")->addFacAge($companyid,$newDealerId);
//                            $re3=A("Jhttp")->addFacAgeNew($companyid,$newDealerId);
////                            echo "haha";
////                            dump($re3);
//                            $arr3 = json_decode($re3,true);
////                            echo "****".var_dump($arr3)."****";
//                            $resCode3 = $arr3["resCode"];
////                            echo $resCode3;
//                            if($resCode3=="000000"){
//                                //添加厂商与经销关系成功
//                                $this->out_arr['result'] = '000000';
//                            }else{
////                                echo "===".$resCode3."==";
//                                if($resCode3=="100059"){
//                                    //厂家与经销商关系已经建立
//                                    $this->out_arr['result'] = '000000';
//                                }else{
//                                    //添加厂商与经销关系失败
//                                    $this->out_arr['result'] = '100000_3';
//                                }
//
//                            }
//                        }
//                    }else{
//                        //企业不存在，向用户中心添加经销商用户信息
////                        echo "用户中心经销商信息不存在,添加信息</br>";
////                        echo $dealerCompanyName."</br>";
////                        echo $dealerPhone."</br>";
////                        echo $dealerpassword."</br>";
//                        $re2=A('Jhttp')->companyAdd($dealerPhone,$dealerpassword,$dealerCompanyName,$flatType,$truename);
//                        $arr2 = json_decode($re2,true);
//                        $resCode2 = $arr2["resCode"];
//                        if($resCode2=="000000"){//经销商信息添加成功
//                            $newdealerId=$arr2["comanyId"];//新的经销商id==用户中心
//                            $tasklist=M("task")->where("f_tid=".$dealertasid)->select();
//                            if($tasklist){//任务存在
//                                $companyid=$tasklist[0]["f_companyid"];
////                                echo $companyid;
//                                $re4=A("Jhttp")->addFacAge($companyid,$newdealerId);
//                                $arr4 = json_decode($re4,true);
//                                $resCode4 = $arr4["resCode"];
//                                if($resCode4=="000000"){
//                                     //添加厂商与经销关系成功
//                                    //经销商第一个人开通企业设置权限
//                                    $map["f_company_id"]=$newdealerId;
//                                    $map["f_access"]="a1,a2,a3,a4,b1,b2,b3,c1,c2,c3,c4,d1,d2,d3,e1";
//                                    $map["f_name"]="超级管理员";
//                                    $re6=M("role")->add($map);
//                                    $re67= A('Jhttp')->userlogin($newdealerId, $dealerPhone);
//                                    $arr67 = json_decode($re67, true);
//                                    $userid=$arr67['list']['user']['userId'];
//                                    if($re6!=0){
//                                        $data["f_user_id"]=$userid;
//                                        $data["f_role_id"]=$re6;
//                                        $data["f_company_id"]=$newdealerId;
//                                        $re7=M("user_role")->add($data);
//                                        if($re7!=0){
//                                            $this->out_arr["result"]="000000";
//                                        }else{
//                                            $this->out_arr["result"]="100000_7";
//                                        }
//                                    }
////                                    $this->out_arr['result'] = '000000';
//                                }else{
//                                    //添加厂商与经销关系失败
//                                    $this->out_arr['result'] = '100000_4';
//                                }
//                            }
//                        }else{
//                            //经销商信息添加失败
//                            $this->out_arr['result'] = '100000_5';
//                        }
//                    }
//                    -------------------
                }else{
                    //经销商信息不存在
                    $this->out_arr['result'] = '100000_6';
                }
            }else{
                //向business_progress表插入的数据失败
                $this->out_arr['result'] = '100000_2';
            }
        }
        $this->pushConf();//输出数据
    }

    public function comDispath() {
        $this->getConf();//取数据
        
        $dealerId = isset($this->in_arr['dealerId'])?$this->in_arr['dealerId']:0;
        $profile1 = isset($this->in_arr['profile1'])?$this->in_arr['profile1']:0;
        if($dealerId==0){
            $this->out_arr['result'] = '100000';
        }else{

            $map['f_dealerid']  = $dealerId;
            $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $map['f_taskid']  = $result['f_taskid'];
            $map['f_userid']  = cookie('userId');
            $map['f_proname']  = 'dispatch';
            $map['f_prostatus']  = 1;
            $map['f_fileid']  = $profile1;
            $map['f_protime']  = time();
            $this->out_arr['rid'] = M("business_progress")->add($map); 


            $result = M('dealerbaseinfo')->where('f_dealerid='.$dealerId)->find();
            $o['f_dealerid']= $dealerId;
            $o['f_taskid']  = $result['f_taskid'];
            $o['f_proname']  = 'receive';
            $o['f_prostatus']  = 0;
            $o['f_protime']  = time();
            M("business_progress")->add($o);
                
            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    function getUserDetail($userid){
        $re = A("Api/Jhttp")->getUserinfo2($userid);
        $arr = json_decode($re,true);
        
        return $arr["list"];
    }

    function getCompanyDetail($companyid){
        $re = A("Api/Jhttp")->getCompanyInfo($companyid);
        $arr = json_decode($re,true);

        return $arr["list"];
    }

    function getCompanyDetail2(){
        $this->getConf();//取数据
        $companyid=$this->in_arr['companyId'];
        $re = A("Api/Jhttp")->getCompanyInfo($companyid);
        $arr = json_decode($re,true);
        if($arr["resCode"]=="000000"){
            $this->out_arr["code"]="success";
            $this->out_arr["list"]=$arr["list"];
        }else{
            $this->out_arr["code"]="fail";

        }
          $this->pushConf();//输出数据
    }

    /**
     * 审核确认
     */
    public function getConfirm() {
        $this->getConf();//取数据

        $data['f_dealerid'] = $this->in_arr['dealerId'];

        $dealerResult = M("dealerbaseinfo")->field("f_taskid,f_userid")->where("f_dealerid=".$this->in_arr['dealerId'])->find(); 

        $condition["f_luserid"] = $dealerResult["f_userid"];
        $condition["f_ltaskid"] = $dealerResult["f_taskid"];
        $updateCondition["f_lstatus"] = 2;
        M("receive_link")->where($condition)->save($updateCondition); 

        $update['f_dealer_strats'] = '3';
        
        M("dealerbaseinfo")->where($data)->save($update); 

        $j = array("LEFT JOIN t_task ON t_task.f_tid = t_dealerbaseinfo.f_taskid");
        $result = M('dealerbaseinfo')->JOIN($j)->where('f_dealerid='.$data['f_dealerid'])->find();
        $userDetail = $this->getUserDetail($result['f_userid']);
        $companyDetail = $this->getCompanyDetail($result['f_companyid']);
        $time = date("Y/m/d",time());
        $date= explode("/", $time);
        $year=date("Y");
        $month=date("m");
        $day=date("d");
        $number = $year.$month.$day.rand(1000,9999);

        $m['f_authnumber']=$number;
        $m['f_dealerid']=$result['f_dealerid'];
        $m['f_userid']=session("id");
        $m['f_datetime']=time();
        M('authorization')->add($m);

        $p['f_dealerid']=$this->in_arr['dealerId'];
        $p['f_taskid']=$result['f_taskid'];
        $p['f_userid']=session("id");
        $p['f_proname']='bid';
        $p['f_prostatus']=1;
        $p['f_protime']=time();
        M('business_progress')->add($p);

        $c['f_dealerid']=$this->in_arr['dealerId'];
        $c['f_taskid']=$result['f_taskid'];
        $c['f_proname']='contract';
        $c['f_prostatus']=0;
        $c['f_protime']=time();
        M('business_progress')->add($c);

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    /**
     * 经销商驳回
     */
    public function rejectDealer() {
        $this->getConf();//取数据

        $data['f_dealerid'] = $this->in_arr['dealerId'];

        $update['f_dealer_strats'] = 4;
        
        M("dealerbaseinfo")->where($data)->save($update);
//        echo M("dealerbaseinfo")->getLastSql();
//        exit;

        $dealerResult = M("dealerbaseinfo")->field("f_taskid,f_userid")->where("f_dealerid=".$this->in_arr['dealerId'])->find();
        $data1["f_userid"] = $dealerResult["f_userid"];
        $data1["f_taskid"] = $dealerResult["f_taskid"];
        $data1['f_dealer_strats'] = array("neq",'4');
        $re_count = M("dealerbaseinfo")->where($data1)->count();

        if (0 == (int)$re_count) {
            $condition["f_luserid"] = $dealerResult["f_userid"];
            $condition["f_ltaskid"] = $dealerResult["f_taskid"];
            $updateCondition["f_lstatus"] = 3;
            M("receive_link")->where($condition)->save($updateCondition);
        }

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    public function getDealerListNo() {
        $this->getConf();//取数据
        $map['f_taskid'] = $this->in_arr['taskid'];
        $map['f_dealer_strats'] = $this->in_arr['state'];
        if(isset($this->in_arr['userid'])){
            $map['f_userid'] = $this->in_arr['userid'];
        }
        $t = M('dealerbaseinfo');
        // $model = new \Think\Model();
        // $subQuery = $t->group('f_companynameone')->where($map)->buildSql();
        // $total = $model->table($subQuery.' a')->where($map)->count();//总记录数
        $total = $t->where($map)->count('f_dealerid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }
    
    
    public function getDealerList(){
        $this->getConf();//取数据
        
        $taskid= $this->in_arr['taskid'];
        $map['f_taskid'] = $taskid;
        $map['f_dealer_strats'] = $this->in_arr['state'];
        if(isset($this->in_arr['userid'])){
            $map['f_userid'] = $this->in_arr['userid'];
        }
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $t = M('dealerbaseinfo');
        // $model = new \Think\Model();
        // $subQuery = $t->group('f_companynameone')->where($map)->buildSql();
        // $total = $model->table($subQuery.' a')->where($map)->count();//总记录数
        $total = $t->where($map)->count('f_dealerid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        
        $f="t_dealerbaseinfo.*";
        $j=array("LEFT JOIN t_dealerqualifyinfo ON t_dealerqualifyinfo.f_dealerid = t_dealerbaseinfo.f_dealerid");
        
        $this->out_arr['list'] = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('t_dealerbaseinfo.f_dealerid desc')->select();
        // var_dump($this->out_arr['list']);exit();
        foreach ($this->out_arr['list'] as $key => $value) {
            if($value['f_uptime']=="" || $value['f_uptime']==null){
                $this->out_arr['list'][$key]['f_uptime'] = "";
            }else{
                $this->out_arr['list'][$key]['f_uptime'] = date("Y-m-d",$value['f_uptime']);
            }
            $this->out_arr['list'][$key]['f_companynameone'] = trim($value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\t","",$value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\r\n","",$value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\r","",$value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\n","",$value['f_companynameone']);

            $this->out_arr['list'][$key]['f_contactsname'] = trim($value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\t","",$value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\r\n","",$value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\r","",$value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\n","",$value['f_contactsname']);

            $this->out_arr['list'][$key]['f_address1'] = trim($value['f_address1']);  
            $this->out_arr['list'][$key]['f_address1'] = ereg_replace("\t","",$value['f_address1']);  
            $this->out_arr['list'][$key]['f_address1'] = ereg_replace("\r\n","",$value['f_address1']);  
            $this->out_arr['list'][$key]['f_address1'] = ereg_replace("\r","",$value['f_address1']);  
            $this->out_arr['list'][$key]['f_address1'] = ereg_replace("\n","",$value['f_address1']);

            $this->out_arr['list'][$key]['f_titleone'] = trim($value['f_titleone']);  
            $this->out_arr['list'][$key]['f_titleone'] = ereg_replace("\t","",$value['f_titleone']);  
            $this->out_arr['list'][$key]['f_titleone'] = ereg_replace("\r\n","",$value['f_titleone']);  
            $this->out_arr['list'][$key]['f_titleone'] = ereg_replace("\r","",$value['f_titleone']);  
            $this->out_arr['list'][$key]['f_titleone'] = ereg_replace("\n","",$value['f_titleone']);

            $this->out_arr['list'][$key]['f_phoneone'] = trim($value['f_phoneone']);  
            $this->out_arr['list'][$key]['f_phoneone'] = ereg_replace("\t","",$value['f_phoneone']);  
            $this->out_arr['list'][$key]['f_phoneone'] = ereg_replace("\r\n","",$value['f_phoneone']);  
            $this->out_arr['list'][$key]['f_phoneone'] = ereg_replace("\r","",$value['f_phoneone']);  
            $this->out_arr['list'][$key]['f_phoneone'] = ereg_replace("\n","",$value['f_phoneone']);

            $this->out_arr['list'][$key]['f_website1'] = trim($value['f_website1']);  
            $this->out_arr['list'][$key]['f_website1'] = ereg_replace("\t","",$value['f_website1']);  
            $this->out_arr['list'][$key]['f_website1'] = ereg_replace("\r\n","",$value['f_website1']);  
            $this->out_arr['list'][$key]['f_website1'] = ereg_replace("\r","",$value['f_website1']);  
            $this->out_arr['list'][$key]['f_website1'] = ereg_replace("\n","",$value['f_website1']);

            $this->out_arr['list'][$key]['f_famousbrandname'] = trim($value['f_famousbrandname']);  
            $this->out_arr['list'][$key]['f_famousbrandname'] = ereg_replace("\t","",$value['f_famousbrandname']);  
            $this->out_arr['list'][$key]['f_famousbrandname'] = ereg_replace("\r\n","",$value['f_famousbrandname']);  
            $this->out_arr['list'][$key]['f_famousbrandname'] = ereg_replace("\r","",$value['f_famousbrandname']);  
            $this->out_arr['list'][$key]['f_famousbrandname'] = ereg_replace("\n","",$value['f_famousbrandname']);

            $this->out_arr['list'][$key]['f_advantage'] = trim($value['f_advantage']);  
            $this->out_arr['list'][$key]['f_advantage'] = ereg_replace("\t","",$value['f_advantage']);  
            $this->out_arr['list'][$key]['f_advantage'] = ereg_replace("\r\n","",$value['f_advantage']);  
            $this->out_arr['list'][$key]['f_advantage'] = ereg_replace("\r","",$value['f_advantage']);  
            $this->out_arr['list'][$key]['f_advantage'] = ereg_replace("\n","",$value['f_advantage']);

            $this->out_arr['list'][$key]['trueName'] = trim($value['trueName']);  
            $this->out_arr['list'][$key]['trueName'] = ereg_replace("\t","",$value['trueName']);  
            $this->out_arr['list'][$key]['trueName'] = ereg_replace("\r\n","",$value['trueName']);  
            $this->out_arr['list'][$key]['trueName'] = ereg_replace("\r","",$value['trueName']);  
            $this->out_arr['list'][$key]['trueName'] = ereg_replace("\n","",$value['trueName']);

            $this->out_arr['list'][$key]["waitReview"]=M('dealerbaseinfo')->where("f_dealer_strats=0 AND f_taskid=".$taskid)->count('f_dealerid');
            $this->out_arr['list'][$key]["alreadyReview"]=M('dealerbaseinfo')->where("f_dealer_strats=1 AND f_taskid=".$taskid)->count('f_dealerid');
            $this->out_arr['list'][$key]["noReviewManage"]=M('dealerbaseinfo')->where("f_dealer_strats=4 AND f_taskid=".$taskid)->count('f_dealerid');
            $this->out_arr['list'][$key]["submitCompany"]=M('dealerbaseinfo')->where("f_dealer_strats=3 AND f_taskid=".$taskid)->count('f_dealerid');
            $this->out_arr['list'][$key]["noReviewFactory"]=M('dealerbaseinfo')->where("f_dealer_strats=2 AND f_taskid=".$taskid)->count('f_dealerid');

            $userDetails = A('Api/Jhttp')->getUserinfo2($value['f_userid']);
            $arr=json_decode($userDetails,true);
            $this->out_arr['list'][$key]['trueName'] = $arr['list']['trueName'];
        }
        $this->pushConf();//输出数据
    }

   //加载所有招商赚录入未审核经销商信息
    public function getAllDealerListNo() {
        $this->getConf();//取数据
        $map['f_dealer_strats']=0;
        $map['f_status']=3;
        $map['f_tasktypeid']=3;
        $j=array("LEFT JOIN t_task ON t_dealerbaseinfo.f_taskid = t_task.f_tid");
        $t = M('dealerbaseinfo');
        $total = $t->where($map)->join($j)->count('f_dealerid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }
    //加载所有招商赚录入未审核经销商信息
    public function getAllDealerList(){
        $this->getConf();//取数据
        $map['f_dealer_strats']=0;
        $map['f_status']=3;
        $map['f_tasktypeid']=3;
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $t = M('dealerbaseinfo');
        $j=array("LEFT JOIN t_task ON t_dealerbaseinfo.f_taskid = t_task.f_tid");
        $total = $t->where($map)->count('f_dealerid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        
        $f="f_dealerid,f_tid,f_userid,f_companynameone,f_title,f_contactsname,f_dealer_strats,f_companyid,f_uptime";
        
        $this->out_arr['list'] = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('t_dealerbaseinfo.f_dealerid desc')->select();
        // var_dump($this->out_arr);exit();
        foreach ($this->out_arr['list'] as $key => $value) {
            $this->out_arr['list'][$key]['f_companynameone'] = trim($value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\t","",$value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\r\n","",$value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\r","",$value['f_companynameone']);  
            $this->out_arr['list'][$key]['f_companynameone'] = ereg_replace("\n","",$value['f_companynameone']);

            $this->out_arr['list'][$key]['f_contactsname'] = trim($value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\t","",$value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\r\n","",$value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\r","",$value['f_contactsname']);  
            $this->out_arr['list'][$key]['f_contactsname'] = ereg_replace("\n","",$value['f_contactsname']);

            $userDetails = A('Api/Jhttp')->getUserinfo2($value['f_userid']);
            $arr=json_decode($userDetails,true);
            $this->out_arr['list'][$key]['nickName'] = $arr['list']['nickName']; 

            $companyDetails = A('Api/Jhttp')->getCompanyInfo($value['f_companyid']);
            $companyArr=json_decode($companyDetails,true);
            $this->out_arr['list'][$key]['companyName'] = $companyArr['list']['companyName']; 
        }
        $this->pushConf();//输出数据
    }

    //加载所有随手推荐录入未审核信息
    public function getAllRecommendDealerListNo() {
        $this->getConf();//取数据
        $map['f_tasktypeid']=5;
        $map['f_status']=3;
        $map['f_utask_status']=1;
        $j=array("LEFT JOIN t_taskdraw ON t_task.f_tid = t_taskdraw.f_taskid");
        $t = M('task');
        $total = $t->where($map)->join($j)->count('f_indexid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }
    //加载所有随手推荐录入未审核信息
    public function getAllRecommendDealerList(){
        $this->getConf();//取数据
        $map['f_tasktypeid']=5;
        $map['f_status']=3;
        $map['f_utask_status']=1;
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $t = M('task');
        $j=array("LEFT JOIN t_taskdraw ON t_task.f_tid = t_taskdraw.f_taskid");
        $j1=array("LEFT JOIN t_recommenddealerinfo ON t_task.f_tid = t_recommenddealerinfo.f_taskid");
        $total = $t->where($map)->join($j)->count('f_indexid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        $f="";
        $this->out_arr['list'] = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->join($j1)->order('t_taskdraw.f_indexid desc')->select();
//        var_dump($this->out_arr);exit();
        foreach ($this->out_arr['list'] as $key => $value) {
            $userDetails = A('Api/Jhttp')->getUserinfo2($value['f_userid']);
            $arr=json_decode($userDetails,true);
            $this->out_arr['list'][$key]['nickName'] = $arr['list']['nickName']; 

            $companyDetails = A('Api/Jhttp')->getCompanyInfo($value['f_companyid']);
            $companyArr=json_decode($companyDetails,true);
            $this->out_arr['list'][$key]['companyName'] = $companyArr['list']['companyName']; 
        }
        $this->pushConf();//输出数据
    }

    //加载所有试用通过审核信息
    public function getAllExpressListNo() {
        $this->getConf();//取数据
        $map['f_lstatus']=2;
        $j=array("LEFT JOIN t_task ON t_receive_link.f_ltaskid = t_task.f_tid");
        $t = M('receive_link');

        $total = $t->where($map)->join($j)->count('f_lid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

    //加载所有试用通过审核信息
    public function getAllExpressList(){
        $this->getConf();//取数据
        $map['f_lstatus']=2;
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $t = M('receive_link');
        $j=array("LEFT JOIN t_task ON t_receive_link.f_ltaskid = t_task.f_tid","LEFT JOIN t_receive ON t_receive_link.f_lreceiveid = t_receive.f_rid");
        $f="t_receive_link.*,t_task.f_title,t_receive.*";
        $total = $t->where($map)->join($j)->count('f_lid');
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->field($f)->join($j)->select();
        foreach ($this->out_arr['list'] as $key => $value) {
            $userDetails = A('Api/Jhttp')->getUserinfo2($value['f_luserid']);
            $arr=json_decode($userDetails,true);
            $this->out_arr['list'][$key]['nickName'] = $arr['list']['nickName']; 
        }
// var_dump($this->out_arr['list']);exit();
        $this->pushConf();//输出数据
    }

    public function adExpressConfirm(){
        $this->getConf();//取数据
        $ExpressId = $this->in_arr['ExpressId'];
        $title = $this->in_arr['title'];

        $data["f_lid"] = $ExpressId;
        $update["f_express"] = $title;
        $update["f_expresstime"] = time();

        M("receive_link")->where($data)->save($update); 
        
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据

    }

    //随手赚任务列表
    public function  get_track_earn(){
        $this->getConf();//取数据
        $companyid = $this->in_arr['companyid'];
        $tid=$this->in_arr['taskid'];
        $page=$this->in_arr['page'];
        $utask_status = $this->in_arr['utask_status'];

         if($companyid!=0){
            $map['t_task.f_companyid'] = $companyid;
         }
         if($page==0 || $page==""){
            $page = 1;
         }
         $map['t_task.f_status']  = array('neq',0);
         $map['t_task.f_tid']=$tid;
            //根据任务标题分组出参与的用户

         //查看认领的任务userid
         $Model=new \Think\Model();
         if($utask_status==3){
             $total=$Model->query("SELECT COUNT(1) AS num FROM (SELECT * FROM t_taskdraw t WHERE  t.f_taskid=".$tid." AND  t.f_utask_status in (3,5) GROUP BY t.f_userid) AS temp");
         }else{
             $total=$Model->query("SELECT COUNT(1) AS num FROM (SELECT * FROM t_taskdraw t WHERE  t.f_taskid=".$tid." AND  t.f_utask_status=".$utask_status."  GROUP BY t.f_userid) AS temp");
         }

         $total =$total[0]['num'];//总记录数
         $pageSize = 20; //每页显示数
         $totalPage = ceil($total/$pageSize); //总页数
          //构造数组
         $this->out_arr['page'] = $page;
         $this->out_arr['total'] = $total;
         $this->out_arr['pageSize'] = $pageSize;
         $this->out_arr['totalPage'] = $totalPage;

         $rec=M("tasksmallinfo")->where("f_taskid=".$tid)->select();
//         $total23=$Model->query("SELECT COUNT(1) AS num FROM (SELECT * FROM t_taskdraw t WHERE  t.f_taskid=".$tid." AND  t.f_utask_status=3  GROUP BY t.f_userid) AS temp");
        //总金币数
        $totalcoin=$rec[0]["f_totalcopies"]*$rec[0]["f_eachcoin"]*10;
        $this->out_arr['totalcoin']=$totalcoin;

        //认领的金币数
//        $totalgivcoin=$rec[0]["f_eachcoin"]*10*$total23[0]['num'];
        //认领的金币数
        $totalgivcoin=M("shopsheet")->where("f_taskid =".$tid." and f_shopingtype=1")->sum("f_amount");
        $this->out_arr['totalgivcoin']=$totalgivcoin;

         
         $Model1=new \Think\Model();
       
         //分页
        //  "SELECT * FROM (SELECT * FROM t_taskdraw t WHERE  t.f_taskid=".$tid." AND  t.f_utask_status=1  GROUP BY t.f_userid) AS temp  ORDER BY temp.f_drawdate  DESC"
         if($utask_status==3){
             $subQuery=M('taskdraw')->where("f_taskid=".$tid." AND  f_utask_status in (3,5)")->group("f_userid")->buildSql();
         }else{
             $subQuery=M('taskdraw')->where("f_taskid=".$tid." AND  f_utask_status=".$utask_status)->group("f_userid")->buildSql();
         }

         //echo M('taskdraw')->getLastSql();
         //exit;
         $list = $Model1->table($subQuery.' a')->order("a.f_drawdate desc")->page($page.','.$pageSize)->select();//总记录数
         //echo $Model1->getLastSql();
         //exit;
         foreach ($list as $key => $val) {
            $userid=$val['f_userid'];
            $titleId=$val['f_taskid'];
            $drawdate=$val['f_drawdate'];
            $taskStatus=$val['f_utask_status'];
            $userlist=A('Jhttp')->getUserinfo2($userid);
            $arr=json_decode($userlist,true);
         if($arr['resCode']=='000000'){
            $truename = $arr['list']['trueName']; 
            $mobile=$arr['list']['mobile'];  
          }   
          //任务类型
          $t = M('task')->field("f_tasktypeid,f_typename")->join("t_tasktype t on t_task.f_tasktypeid=t.f_typeid")->where("t_task.f_tid=".$tid."")->select();
          
          $this->out_arr["list"][$key]["userid"]=$userid;
          $this->out_arr["list"][$key]["truename"]=$truename==""?$mobile:$truename;
          $this->out_arr["list"][$key]["submitdate"]=$drawdate;
          $this->out_arr["list"][$key]["submitdate"]=$drawdate;
          $this->out_arr["list"][$key]["taskStatus"]=$taskStatus;
          $this->out_arr["list"][$key]["titleId"]=$titleId;
          $this->out_arr["list"][$key]["typename"]=$t[0]['f_typename'];
         }
         $this->out_arr['list'];
         $this->pushConf();//输出数据
    
    }




    //督查赚任务做任务的用户列表
     public  function  get_track_auditlist(){
         $this->getConf();//取数据
         $companyid = $this->in_arr['companyid'];
         $tid=$this->in_arr['taskid'];
         $page=$this->in_arr['page'];
         $utask_status = $this->in_arr['utask_status'];
         if($companyid!=0){
             $map['t_task.f_companyid'] = $companyid;
         }
         if($page==0 || $page==""){
             $page = 1;
         }
         $map['t_task.f_status']  = array('neq',0);
         $map['t_task.f_tid']=$tid;
         $Model=new \Think\Model();
         $total=$Model->query("SELECT COUNT(1) AS num FROM (SELECT * FROM t_taskdraw t WHERE  t.f_taskid=".$tid." AND  t.f_utask_status=".$utask_status."  GROUP BY t.f_userid) AS temp");
         $total =$total[0]['num'];//总记录数
         $pageSize = 20; //每页显示数
         $totalPage = ceil($total/$pageSize); //总页数
         //构造数组
         $this->out_arr['page'] = $page;
         $this->out_arr['total'] = $total;
         $this->out_arr['pageSize'] = $pageSize;
         $this->out_arr['totalPage'] = $totalPage;
         $Model1=new \Think\Model();
         $subQuery=M('taskdraw')->where("f_taskid=".$tid." AND  f_utask_status=".$utask_status)->group("f_userid")->buildSql();
         $list = $Model1->table($subQuery.' a')->order("a.f_drawdate desc")->page($page.','.$pageSize)->select();//总记录数
         foreach ($list as $key => $val) {
             $userid=$val['f_userid'];
             $titleId=$val['f_taskid'];
             $drawdate=$val['f_drawdate'];
             $taskStatus=$val['f_utask_status'];
             $superAddressID=$val['f_superaddressid'];
             $userlist=A('Jhttp')->getUserinfo2($userid);
             $arr=json_decode($userlist,true);
             if($arr['resCode']=='000000'){
                 $truename = $arr['list']['trueName'];
                 $mobile=$arr['list']['mobile'];
             }
             $rec=M("tasksuperaddress")->where("f_super_id=".$superAddressID)->select();
             if($rec){
                 $this->out_arr["list"][$key]["superAddressID"]=$superAddressID;
                 $this->out_arr["list"][$key]["networkname"]=$rec[0]["f_network_name"];
             }
             $this->out_arr["list"][$key]["userid"]=$userid;
             $this->out_arr["list"][$key]["truename"]=$truename==""?$mobile:$truename;
             $this->out_arr["list"][$key]["submitdate"]=$drawdate;
             $this->out_arr["list"][$key]["submitdate"]=$drawdate;
             $this->out_arr["list"][$key]["taskStatus"]=$taskStatus;
             $this->out_arr["list"][$key]["titleId"]=$titleId;


         }
         $this->out_arr['list'];
         $this->pushConf();//输出数据
     }
    //答案显示
     public  function  trackearn_answer(){
         $this->getConf();//取数据
         $tid=$this->in_arr['tid'];
         $submituserid=$this->in_arr['submituserid'];
         $auditaddressid=$this->in_arr['auditaddressid'];
         if($auditaddressid=="undefined"){
             $auditaddressid=null;
          }else{
             $auditaddressid=$auditaddressid;
         }
         $trueCount=0;
         $falseCount=0;
         //查找该用户该任务下的报告详情
         $re=M("task")->where("f_tid=".$tid)->select();
         $tasktypeid=$re[0]["f_tasktypeid"];
         if($tasktypeid==4){
             $answerid=M('surveyanswer')->field("f_answerid")->where('f_taskid='.$tid.' and f_submituserid='.$submituserid)->select();
             //答题和调研
             $list=M('surveyanswerdetail')->join("t_surveytaskdetail  t2  ON t_surveyanswerdetail.f_serial=t2.f_serial")->where('t2.f_taskid='.$tid.' and  t_surveyanswerdetail.f_answerid='.$answerid[0]['f_answerid'])->select();
             foreach($list as $k=>$v){
                 if($v['f_type']==4){
                     if(!empty($v["f_answer"])){
                         //图片
                         $answer=explode(",",$v["f_answer"]);
                         foreach($answer as $j=>$vo){
                             $r=M("files")->where("f_id=".$vo)->select();
                             $answer1[$j]["path"]=__ROOT__."/Public/upfile/".$r[0]["f_filepath"].$r[0]["f_filename"];
                             $answer1[$j]["id"]=$vo;
                         }
                         $list[$k]["f_answer"]=$answer1;
                     }

                 }

                 if($v['f_type']==3){
                     $list[$k]["f_answer"]= trim($v["f_answer"]);
                     $list[$k]["f_answer"]=str_replace(array("\r\n", "\r", "\n","\s"), "", $v["f_answer"]);
                     $list[$k]["f_answer"]=preg_replace("/\n{2,}/", "",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]=preg_replace("/\r{2,}/", "",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]=preg_replace("/\s{2,}/", "",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]=str_replace("\"","&quot;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace("&","&amp;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace("<","&lt;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace(">","&gt;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace(">","&gt;",$list[$k]["f_answer"]);
                 }

                 //答题类展现正确答案，并汇总答题类答对个数和答错个数

             }

         }else if($tasktypeid==6||$tasktypeid==7){
              //答题类
             if($auditaddressid){
                 $list=M('surveyuserchoices')->join("t_surveytaskdetail  t2  ON t_surveyuserchoices.f_serial=t2.f_serial")->where('t2.f_taskid='.$tid.' and  t_surveyuserchoices.f_userid='.$submituserid.' and  t_surveyuserchoices.f_taskid='.$tid.' and t_surveyuserchoices.f_netserial='.$auditaddressid)->select();
             }else{
                 $list=M('surveyuserchoices')->join("t_surveytaskdetail  t2  ON t_surveyuserchoices.f_serial=t2.f_serial")->where('t2.f_taskid='.$tid.' and  t_surveyuserchoices.f_userid='.$submituserid.' and  t_surveyuserchoices.f_taskid='.$tid)->select();
             }
             foreach($list as $k=>$v){
                 if($v['f_type']==4){
                     //图片
                     $answer=explode(",",$v["f_answer"]);
                     foreach($answer as $j=>$vo){
                         $r=M("files")->where("f_id=".$vo)->find();
                         $answer1[$j]["path"]=__ROOT__."/Public/upfile/".$r["f_filepath"].$r["f_filename"];
                         $answer1[$j]["id"]=$vo;
                     }
                     $list[$k]["f_answer"]=$answer1;
                 }

                 if($v['f_type']==3){
                     $list[$k]["f_answer"]= trim($v["f_answer"]);
                     $list[$k]["f_answer"]=str_replace(array("\r\n", "\r", "\n","\s"), "", $v["f_answer"]);
                     $list[$k]["f_answer"]=preg_replace("/\n{2,}/", "",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]=preg_replace("/\r{2,}/", "",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]=preg_replace("/\s{2,}/", "",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]=str_replace("\"","&quot;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace("&","&amp;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace("<","&lt;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace(">","&gt;",$list[$k]["f_answer"]);
                     $list[$k]["f_answer"]= str_replace(">","&gt;",$list[$k]["f_answer"]);
                 }
                 //答题类展现正确答案，并汇总答题类答对个数和答错个数
                 //答题类
                 //计算用户答题情况
                 if($v["f_trueanswer"]==$v["f_answer"]){
                     $istrue="正确";
                     $trueCount++;

                 }else{
                     $istrue="错误";
                     $falseCount++;

                 }
                 $list[$k]["isfalse"]=$istrue;

             }

         }else{
             //推荐
             $re3=M("recommenddealerinfo")->where("f_userid=".$submituserid." and  f_taskid=".$tid)->select();
             if(count($re3)>0){
                 //经销商姓名
                 $this->out_arr["dealername"]=$re3[0]["f_dealername"];
                 //经销商手机
                 $this->out_arr["dealerphone"]=$re3[0]["f_dealerphone"];
                 //经销商公司名
                 $this->out_arr["dealercompanyname"]=$re3[0]["f_dealercompanyname"];
                 //经销商行业
                 $this->out_arr["dealerindustry"]=$re3[0]["f_dealerindustry"];
                 //经销商地址
                 $this->out_arr["dealeraddress"]=$re3[0]["f_dealeraddress"];
                 //经销商电话
                 $this->out_arr["dealertel"]=$re3[0]["f_dealertel"];
                 //经销商传真
                 $this->out_arr["dealerfax"]=$re3[0]["f_dealerfax"];
             }

         }

//         echo $falseCount;
//         echo $trueCount;
//         var_dump($list);
//         exit;
         $this->out_arr["count"]=count($list);
         $this->out_arr['tasktypeid']=$tasktypeid;
         $this->out_arr['trueCount']=$trueCount;
         $this->out_arr['falseCount']=$falseCount;
         $this->out_arr['list']=$list;
         $this->pushConf();//输出数据
    }
   
   //审核答案
    public  function  trackearn_shenhe(){
       $this->getConf();
       //$checklist=$this->in_arr['checklist'];
       $tid=$this->in_arr['tid'];
       $obj=M('taskdraw');
       $idarray=  explode(',',$this->in_arr['checklist']);

        //操作记录入库
        $log['f_rejectuserid'] = cookie("userId");   //操作人id
        $log['f_reason'] = "智慧推广随手赚业务员".$this->in_arr['checklist']."审核通过";  //操作说明
        $log['f_taskid'] = $this->in_arr['tid'];  //任务id
        $log['f_datetime'] = time();
        M('taskreject')->add($log);

//       pt($idarray);exit;
       //exit;
       //echo count($idarray);
       //$checklist1=split($checklist, ',');
       for($i=0;$i<count($idarray);$i++){
           $array=explode("-",$idarray[$i]);
           if(count($array)==1){
               $map['f_userid'] = $idarray[$i];
           }else{
               $map['f_userid'] = $array[0];
               $map['f_superAddressID']=$array[1];
           }

           $map['f_taskid'] = $tid;
           $map['f_utask_status'] =1;
           //pt($map);
           $reV=$obj->where($map)->setField('f_utask_status',3);
           
           //$reV=$obj->where('f_userid='.$idarray[$i].' and f_taskid='.$tid.'and f_utask_status=1')->setField('f_utask_status','3');
          //echo $obj->getLastSql();
          //exit;
           //echo $reV;
           if($reV==0){
               
               $this->out_arr['error_code']='false';
           }else{
               $re_taskinfo = M('tasksmallinfo')->where("f_taskid=".$map['f_taskid'])->find();
               //echo M('tasksmallinfo')->getLastSql();
               //exit;
//               A("Mobileweb/Events")->is_ip($map['f_userid'],$map['f_taskid']);//控制
               D('Shopsheet')->add_shopsheet('task',$map['f_userid'],1,1,$re_taskinfo['f_eachcoin']*10,$map['f_taskid'],2,0);
               D('Shopsheet')->add_shopsheet('task',$map['f_userid'],1,2,$re_taskinfo['f_eachscore'],$map['f_taskid'],2,0);
               //分红
               $this->allocation_gold($map['f_userid'],$re_taskinfo['f_eachcoin']*10);
               $this->out_arr['error_code']='true';
           }    
       }
       $this->pushConf();//输出数据
    }


    //随手赚审核驳回

    public  function  trackearn_back(){
        $this->getConf();
        //$checklist=$this->in_arr['checklist'];
        $tid=$this->in_arr['tid'];
        $obj=M('taskdraw');
        $idarray=  explode(',',$this->in_arr['checklist']);
        $reason=$this->in_arr['reason'];

        //操作记录入库
        $log['f_rejectuserid'] = cookie("userId");   //操作人id
        $log['f_reason'] = "智慧推广随手赚业务员".$this->in_arr['checklist']."驳回通过";  //操作说明
        $log['f_taskid'] = $this->in_arr['tid'];;  //任务id
        $log['f_datetime'] = time();
        M('taskreject')->add($log);

//       pt($idarray);exit;
        //exit;
        //echo count($idarray);
        //$checklist1=split($checklist, ',');
        for($i=0;$i<count($idarray);$i++){
            $array=explode("-",$idarray[$i]);
            if(count($array)==1){
                $map['f_userid'] = $idarray[$i];
            }else{
                $map['f_userid'] = $array[0];
                $map['f_superAddressID']=$array[1];
            }
            $map['f_userid'] = $idarray[$i];
            $map['f_taskid'] = $tid;
            $map['f_utask_status'] =1;
            //pt($map);
            $data=array('f_utask_status'=>5,'f_reason'=>$reason);
            $reV=$obj->where($map)->setField($data);

            //$reV=$obj->where('f_userid='.$idarray[$i].' and f_taskid='.$tid.'and f_utask_status=1')->setField('f_utask_status','3');
            //echo $obj->getLastSql();
            //exit;
            //echo $reV;
            if($reV==0){

                $this->out_arr['error_code']='false';
            }else{
                $re_taskinfo = M('tasksmallinfo')->where("f_taskid=".$map['f_taskid'])->find();
                //echo M('tasksmallinfo')->getLastSql();
                //exit;
//                A("Mobileweb/Events")->is_ip($map['f_userid'],$map['f_taskid']);//控制
                D('Shopsheet')->add_shopsheet('task',$map['f_userid'],1,1,0,$map['f_taskid'],2,0);
                D('Shopsheet')->add_shopsheet('task',$map['f_userid'],1,2,0,$map['f_taskid'],2,0);
                $this->out_arr['error_code']='true';
            }
        }
        $this->pushConf();//输出数据
    }
    
    //业务员列员
    public function getSalesListNo() {
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        $tabType = $this->in_arr['tabType'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
            $queryStart=1;
            $queryEnd=$pageSize;
        }else{
            $queryStart=($page-1)*$pageSize+1;
            $queryEnd=$page*$pageSize;
        }

        switch($tabType){
            case '0'://全部业务员
               $re = A('Jhttp')->getUsersInfo($this->in_arr['companyid'],$queryStart,$queryEnd,0);
               $arr = json_decode($re,true);
               break;
            case '1'://实名认证的业务员
               $re = A('Jhttp')->getUsersInfo($this->in_arr['companyid'],$queryStart,$queryEnd,1);
               $arr = json_decode($re,true);
               break;
            case '2'://银行卡绑定业务员
                $f['f_status']=0;
                $arr['list']=M('useraccount')->field("f_userid as userId")->where($f)->group("f_userid")->select();
                $arr['count'] = count($arr['list']);
                $arr['resCode']='000000';
                foreach ( $arr['list'] as $i=>$val ) {
                    foreach($val as $k=>$v)
                    {
                        $arr['list'][$i]['userId'] = $v;
                        unset($arr['list'][$i][$k]);
                    }
                }
               break;
            default:
               break;
        }

        if($arr['resCode']=='000000'){
            $total = $arr['count'];
        }else{
            $total = 0;
        }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }
    
    
    public function getSalesList(){
        //true
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        $tabType = $this->in_arr['tabType'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
            $queryStart=1;
            $queryEnd=$pageSize;
        }else{
            $queryStart=($page-1)*$pageSize+1;
            $queryEnd=$page*$pageSize;
        }

        switch($tabType){
            case '0'://全部业务员
               $re = A('Jhttp')->getUsersInfo($this->in_arr['companyid'],$queryStart,$queryEnd,0);
               $arr = json_decode($re,true);
               break;
            case '1'://实名认证的业务员
               $re = A('Jhttp')->getUsersInfo($this->in_arr['companyid'],$queryStart,$queryEnd,1);
               $arr = json_decode($re,true);
               break;
            case '2'://银行卡绑定业务员
                $f['f_status']=0;
                $arr['list']=M('useraccount')->field("f_userid as userId")->where($f)->group("f_userid")->limit($queryStart-1,$queryEnd)->select();
                $arr['count'] = count($arr['list']);
                $arr['resCode']='000000';
                foreach ( $arr['list'] as $i=>$val ) {
                    foreach($val as $k=>$v)
                    {
                        $arr['list'][$i]['userId'] = $v;
                        unset($arr['list'][$i][$k]);
                    }
                }
               break;
            default:
               break;
        }

        if($arr['resCode']=='000000'){
            $total = $arr['count'];
        }else{
            $total = 0;
        }
        
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        //查金币，银票
        foreach ($arr['list'] as $key => $val) {
            $re_g = M('userbalance')->where('f_userid='.$val['userId'])->find();
            $re_d = M('taskdraw')->where('f_userid='.$val['userId'])->count('distinct(f_taskid)');
            $arr['list'][$key]['goldcoin'] = $re_g['f_goldcoin'];
            $arr['list'][$key]['credit'] = $re_g['f_credit'];
            $arr['list'][$key]['taskdrawsum'] = $re_d;
            // $arr['list'][$key]['total'] = $total;
            if ($tabType == 2) {
                $userDetails = A('Api/Jhttp')->getUserinfo2($val['userId']);
                $result=json_decode($userDetails,true);
                $arr['list'][$key]['nickName'] = $result['list']['nickName']; 
                $arr['list'][$key]['trueName'] = $result['list']['trueName']; 
                $arr['list'][$key]['mobile'] = $result['list']['mobile']; 
            }
        }

        $this->out_arr['list'] = $arr['list'];

        if ($tabType == 0 || $tabType == '0') {
            session('allSalesResult',$this->out_arr['list']);
        }
        if ($tabType == 1 || $tabType == '1') {
            session('realSalesResult',$this->out_arr['list']);
        }
        if ($tabType == 2 || $tabType == '2') {
            session('cardSalesResult',$this->out_arr['list']);
        }        
        // pt($this->out_arr['list']);
        $this->pushConf();//输出数据

    }
    
    public function getFSalesList(){
        //false
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        $tabType = $this->in_arr['tabType'];
        if($page==0 || $page=="" || $page==1){
             $page = 1;
        }

        if ($tabType == 1) {
            $map['f_truename']  = array('neq','');
            $total = D('memberlibary')->where($map)->count("f_indexid");//总记录数.
        }else if ($tabType == 2){

            if ($this->in_arr['searchterm'] != '0') {
                $w['f_area']  = array('like',"%".trim($this->in_arr['searchterm'])."%");
            }
            if ($this->in_arr['talkType'] != -1 && $this->in_arr['talkType'] != '-1') {
                $w['f_status']  = array('eq',$this->in_arr['talkType']);
            }
            if (!empty($this->in_arr['searchindustrytype'])) {
                $w['f_industrytype']  = array('eq',trim($this->in_arr['searchindustrytype']));
            }
            $total = D('memberlibary')->where($w)->count("f_indexid");//总记录数
        }else{
            $total = D('memberlibary')->count("f_indexid");//总记录数
        }
        
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        if ($tabType == 1) {
            $map['f_truename']  = array('neq','');
            $this->out_arr['list'] = M("memberlibary")->page($page.','.$pageSize)->where($map)->order('f_creatdate desc')->select();
        }else if ($tabType == 2){
            if ($this->in_arr['searchterm'] != '0') {
                $w['f_area']  = array('like',"%".trim($this->in_arr['searchterm'])."%");
            }
            if ($this->in_arr['talkType'] != -1 && $this->in_arr['talkType'] != '-1') {
                $w['f_status']  = array('eq',$this->in_arr['talkType']);
            }
            if (!empty($this->in_arr['searchindustrytype'])) {
                $w['f_industrytype']  = array('eq',trim($this->in_arr['searchindustrytype']));
            }
            $this->out_arr['list'] = D('memberlibary')->page($page.','.$pageSize)->where($w)->order('f_creatdate desc')->select();//总记录数
        }else{
            $this->out_arr['list'] = M("memberlibary")->page($page.','.$pageSize)->order('f_creatdate desc')->select();
        }

        $this->pushConf();//输出数据
    }
    
    public function getFSalesListNo() {
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        $tabType = $this->in_arr['tabType'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        if ($tabType == 1) {
            $map['f_truename']  = array('neq','');
            $total = D('memberlibary')->where($map)->count("f_indexid");//总记录数
        }else if ($tabType == 2){
            if ($this->in_arr['searchterm'] != '0') {
                $w['f_area']  = array('like',"%".trim($this->in_arr['searchterm'])."%");
            }
            if ($this->in_arr['talkType'] != -1 && $this->in_arr['talkType'] != '-1') {
                $w['f_status']  = array('eq',$this->in_arr['talkType']);
            }
            if (!empty($this->in_arr['searchindustrytype'])) {
                $w['f_industrytype']  = array('eq',trim($this->in_arr['searchindustrytype']));
            }
            $total = D('memberlibary')->where($w)->count("f_indexid");//总记录数
        }else{
            $total = D('memberlibary')->count("f_indexid");//总记录数
        }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

    //取用户数据分页
    public function getUserList(){
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
             $page = 1;
        }

        $total = D('sysuser')->count("id");//总记录数
        
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $f="t_sysuser.*,t_sysaccess.id as accessid,accessname,accessvalue";
        $j = "LEFT JOIN t_sysaccess ON t_sysaccess.id=t_sysuser.accessid";
        $this->out_arr['list'] = M("sysuser")->field($f)->page($page.','.$pageSize)->join($j)->select();

        $this->pushConf();//输出数据
    }
    
    public function getUserListNo() {
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $total = D('sysuser')->count("id");//总记录数

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

    //取角色数据分页
    public function getRolesList(){
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
             $page = 1;
        }

        $total = D('sysaccess')->count("id");//总记录数
        
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->out_arr['list'] = M("sysaccess")->page($page.','.$pageSize)->select();

        $this->pushConf();//输出数据
    }
    
    public function getRolesListNo() {
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $total = D('sysaccess')->count("id");//总记录数

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

     //取权限数据分页
    public function getAccessList(){
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
             $page = 1;
        }

        $total = D('sysaccessfield')->count("f_id");//总记录数
        
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->out_arr['list'] = M("sysaccessfield")->page($page.','.$pageSize)->order('f_id asc')->select();

        $this->pushConf();//输出数据
    }
    
    public function getAccessListNo() {
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $total = D('sysaccessfield')->count("f_id");//总记录数

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }   

    //企业列表
    public function getCompanyListNo() {
        $this->getConf();//取数据
        $map['f_taskid'] = $this->in_arr['taskid'];
        if(isset($this->in_arr['userid'])){
            $map['f_userid'] = $this->in_arr['userid'];
        }
        $t = M('dealerbaseinfo');
        $model = new \Think\Model();
        $subQuery = $t->group('f_companynameone')->where($map)->buildSql();
        $total = $model->table($subQuery.' a')->where($map)->count();//总记录数
        
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }  
    
    public function getCompanyList(){
        $this->getConf();//取数据
        
        $map['f_taskid'] = $this->in_arr['taskid'];
        if(isset($this->in_arr['userid'])){
            $map['f_userid'] = $this->in_arr['userid'];
        }
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $t = M('dealerbaseinfo');
        $model = new \Think\Model();
        $subQuery = $t->group('f_companynameone')->where($map)->buildSql();
        $total = $model->table($subQuery.' a')->where($map)->count();//总记录数
        //echo $t->getLastsql();
        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        
        $f="";
        $j=array("LEFT JOIN t_dealerqualifyinfo ON t_dealerqualifyinfo.f_dealerid = t_dealerbaseinfo.f_dealerid");
        
        $this->out_arr['list'] = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('t_dealerbaseinfo.f_dealerid desc')->group('f_companynameone')->select();
        
        $this->pushConf();//输出数据
    }

    //是否有合同
    public function isContract(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;

        if($dealerid==0){
            $this->out_arr['result'] = '100000';
        }else{

            $map['f_proname']= 'contract';
            $map['f_prostatus']= 1;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['contractOne'] = M("business_progress")->where($map)->find(); 

            $map['f_proname']= 'contract';
            $map['f_prostatus']= 2;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['contractTwo'] = M("business_progress")->where($map)->find(); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    //判断是否打款
    public function isRemit(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;

        if($dealerid==0){
            $this->out_arr['result'] = '100000';
        }else{

            $map['f_proname']= 'remit';
            $map['f_prostatus']= 1;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['remitOne'] = M("business_progress")->where($map)->find(); 

            $map['f_proname']= 'remit';
            $map['f_prostatus']= 2;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['remitTwo'] = M("business_progress")->where($map)->find(); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    //判断是否发货
    public function isDispatch(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;

        if($dealerid==0){
            $this->out_arr['result'] = '100000';
        }else{

            $map['f_proname']= 'dispatch';
            $map['f_prostatus']= 0;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['dispatchOne'] = M("business_progress")->where($map)->find(); 

            $map['f_proname']= 'dispatch';
            $map['f_prostatus']= 1;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['dispatchTwo'] = M("business_progress")->where($map)->find(); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    //判断是否收货
    public function isReceive(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;

        if($dealerid==0){
            $this->out_arr['result'] = '100000';
        }else{

            $map['f_proname']= 'receive';
            $map['f_prostatus']= 1;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['receive'] = M("business_progress")->where($map)->find(); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    //判断是否结算
    public function isSettlement(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['dealerid'])?$this->in_arr['dealerid']:0;

        if($dealerid==0){
            $this->out_arr['result'] = '100000';
        }else{

            $map['f_proname']= 'Settlement';
            $map['f_prostatus']= 1;
            $map['f_dealerid']= $dealerid;
            $this->out_arr['Settlement'] = M("business_progress")->where($map)->find(); 

            $this->out_arr['result'] = '000000';
        }
        $this->pushConf();//输出数据
    }

    //判断是否佣金结算
    public function isCommissionsquare(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['f_dealerid'])?$this->in_arr['f_dealerid']:0;
        $map['f_dealerid'] = $dealerid;
        $map['f_proname'] = 'commissionsquare';
        $map['f_prostatus'] = 1;
        $result = M('business_progress')->where($map)->find();
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    //判断是否已经到账确认过
    public function ismoneyCheck(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['f_dealerid'])?$this->in_arr['f_dealerid']:0;
        $map['f_dealerid'] = $dealerid;
        $map['f_proname'] = 'remit';
        $map['f_prostatus'] = 2;
        $result = M('business_progress')->where($map)->find();
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    //判断是否已经货款结算过
    public function issettlementCheck(){
        $this->getConf();//取数据
        
        $dealerid = isset($this->in_arr['f_dealerid'])?$this->in_arr['f_dealerid']:0;
        $map['f_dealerid'] = $dealerid;
        $map['f_proname'] = 'Settlement';
        $map['f_prostatus'] = 1;
        $result = M('business_progress')->where($map)->find();
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function getAllCompanyListNo() {
        $this->getConf();//取数据
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        $state = $this->in_arr['state'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
            $queryStart=0;
            $queryEnd=$pageSize;
        }else{
            $queryStart=($page-1)*$pageSize;
            $queryEnd=$page*$pageSize;
        }

        $re = A('Jhttp')->getAllCompanyInfo(0,0,$state);
        $arr = json_decode($re,true);
        $total = $arr['count'];
        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }
    
    
    public function getAllCompanyList(){
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        $state = $this->in_arr['state'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
            $queryStart=0;
            $queryEnd=$pageSize;
        }else{
            $queryStart=($page-1)*$pageSize;
            $queryEnd=$page*$pageSize;
        }
        $re = A('Jhttp')->getAllCompanyInfo(0,0,$state);
        $arr = json_decode($re,true);
        $total = $arr['count'];

        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $res = A('Jhttp')->getAllCompanyInfo($queryStart,$queryEnd,$state);
        $arrs = json_decode($res,true);
        if ($arrs['resCode']=="000000") {
            $this->out_arr['list'] = $arrs['list'];
        }else{
            $this->out_arr['list'] = "";
            $this->out_arr['resCode'] = $arrs['resCode'];
        }
        //pt($this->out_arr);
        
        $this->pushConf();//输出数据
    }   

    //招商进程列表
    public function getDealerProListNo() {
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $tabType = $this->in_arr['tabType'];
        $order = $this->in_arr['order'];

        $t = M('business_progress');

//         if (isset($order) && !empty($order)) {
//             $w['f_title']  = array('like',"%".trim($order)."%");
//             $total = D('memberlibary')->where($w)->count("f_indexid");//总记录数
// $f="";
// $j=array("LEFT JOIN t_business_progress ON t_business_progress.f_taskid = t_task.f_tid");

// $this->out_arr['list'] = D('task')->field($f)->where($w)->page($page.','.$pageSize)->join($j)->order('t_dealerbaseinfo.f_dealerid desc')->group('f_companynameone')->select();
//             var_dump(111);exit();
//         }else{
            switch($tabType){
                case '0'://全部
                    $total = $t->count("distinct f_dealerid");//总记录数
                   break;
                case '1'://有授权书
                    $map['f_proname']  = 'bid';
                    $map['f_prostatus']  = 1;
                    $total = $t->where($map)->count();//总记录数
                   break;
                case '2'://有合同
                    $map['f_proname']  = 'contract';
                    // $map['f_prostatus']  = array('neq',0);
                    $total = $t->where($map)->count();//总记录数
                   break;
               case '3'://已打款
                    $map['f_proname']  = 'remit';
                    $map['f_prostatus']  = array('neq',0);
                    $total = $t->where($map)->count();//总记录数
                   break;
               case '4'://已发货
                    $map['f_proname']  = 'dispatch';
                    // $map['f_prostatus']  = 1;
                    $total = $t->where($map)->count();//总记录数
                   break;
               case '5'://已收货
                    $map['f_proname']  = 'receive';
                    // $map['f_prostatus']  = 1;
                    $total = $t->where($map)->count();//总记录数
                   break;
               case '6'://佣金结算
                    $map['f_proname']  = 'commissionsquare';
                    // $map['f_prostatus']  = 1;
                    $total = $t->where($map)->count();//总记录数
                   break;
               case '7'://货款结算
                    $map['f_proname']  = 'Settlement';
                    $total = $t->where($map)->count();//总记录数
                   break;
                default:
                   break;
            }
        // }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }
    
    
    public function getDealerProList(){
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $tabType = $this->in_arr['tabType'];

        $t = M('business_progress');

        switch($tabType){
            case '0'://全部
                $total = $t->count("distinct f_dealerid");//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_business_progress.f_taskid");
                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->page($page.','.$pageSize)->join($j)->group('t_business_progress.f_dealerid')->order('t_business_progress.f_id desc')->select();
                }
                // var_dump($this->out_arr['list']);exit();
                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];

                    $contract1 = M("business_progress")->where($mmm)->find();

                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();

                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }
                }
                // var_dump($this->out_arr['list']);exit();
               break;
            case '1'://有授权书
                $map['f_proname']  = 'bid';
                $map['f_prostatus']  = 1;
                $total = $t->where($map)->count();//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_business_progress.f_taskid");

                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->select();
                }
                
                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];
                    $contract1 = M("business_progress")->where($mmm)->find();

                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();

                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }
                }
               break;
            case '2'://有合同
                $map['f_proname']  = 'contract';
                // $map['f_prostatus']  = array('neq',0);
                $total = $t->where($map)->count();//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_business_progress.f_taskid");

                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->select();
                }

                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];
                    $contract1 = M("business_progress")->where($mmm)->find();
                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();

                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }

                }
                // exit();
               break;
           case '3'://已打款
                $map['f_proname']  = 'remit';
                $map['f_prostatus']  = array('neq',0);
                $total = $t->where($map)->count();//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_business_progress.f_taskid");

                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->select();
                }

                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];
                    $contract1 = M("business_progress")->where($mmm)->find();

                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();

                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }
                }
               break;
           case '4'://已发货
                $map['f_proname']  = 'dispatch';
                // $map['f_prostatus']  = 1;
                $total = $t->where($map)->count();//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_business_progress.f_taskid");

                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->select();
                }

                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];
                    $contract1 = M("business_progress")->where($mmm)->find();

                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();

                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }
                }
               break;
           case '5'://已收货
                $map['f_proname']  = 'receive';
                // $map['f_prostatus']  = 1;
                $total = $t->where($map)->count();//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_business_progress.f_taskid");

                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->select();
                }

                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];
                    $contract1 = M("business_progress")->where($mmm)->find();

                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();

                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }
                }
               break;
           case '6'://佣金结算
                $map['f_proname']  = 'commissionsquare';
                $total = $t->where($map)->count();//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_dealerbaseinfo.f_taskid");

                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->select();
                }

                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];
                    $contract1 = M("business_progress")->where($mmm)->find();

                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();

                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }
                }
                // var_dump($this->out_arr['list']);
               break;
           case '7'://货款结算
                $map['f_proname']  = 'Settlement';
                $total = $t->where($map)->count();//总记录数
                $j=array("LEFT JOIN t_dealerbaseinfo ON t_dealerbaseinfo.f_dealerid = t_business_progress.f_dealerid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_business_progress.f_taskid");

                if ($this->in_arr['order'] == 'f_companynameone') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_dealerid desc')->select();
                }else if ($this->in_arr['order'] == 'f_prostatus') {
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->order('t_business_progress.f_proname asc,t_business_progress.f_prostatus asc')->select();
                }else{
                    $this->out_arr['list'] = $t->where($map)->page($page.','.$pageSize)->join($j)->select();
                }

                foreach ($this->out_arr['list'] as $key => $value) {
                    $this->out_arr['list'][$key]['user'] = $this->getUserDetail($value['f_userid']);
                    if ($this->out_arr['list'][$key]['user'] == '') {
                        $this->out_arr['list'][$key]['user'] = array('trueName'=>'');
                    }
                    if (isset($this->out_arr['list'][$key]['user']) && $this->out_arr['list'][$key]['user']['trueName'] == null) {
                        $this->out_arr['list'][$key]['user']['trueName'] = '';
                    }
                    $this->out_arr['list'][$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

                    $mmm['f_proname']  = 'contract';
                    $mmm['f_prostatus']  = 1;
                    $mmm['f_dealerid']  =$value['f_dealerid'];
                    $contract1 = M("business_progress")->where($mmm)->find();

                    $mmm1['f_proname']  = 'contract';
                    $mmm1['f_prostatus']  = 2;
                    $mmm1['f_dealerid']  =$value['f_dealerid'];
                    $contract2 = M("business_progress")->where($mmm1)->find();
                    if (null == $contact1 && null!=$contact2) {
                       $this->out_arr['list'][$key]['f_xxx'] = 1;
                    }
                }
               break;
            default:
               break;
        }
        
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['tabType'] = $tabType;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        foreach ($this->out_arr['list'] as $key => $value) {
            $this->out_arr['list'][$key]['taskname'] = array('f_title' =>'');
            if (isset($value['f_taskid'])) {
                $title = M('task')->field('f_title')->where('f_tid='.$value['f_taskid'])->find();
                if (!empty($title)) {
                    $this->out_arr['list'][$key]['taskname'] = $title;
                }
            }
        }
// var_dump($this->out_arr['list']);exit();
        $this->pushConf();//输出数据
    }

    //推广赚列表显示
   function  get_track_make(){
        $this->getConf();//取数据 
        $tid=$this->in_arr['taskid'];
        $page=$this->in_arr['page'];
        $t = M('share');
        if($page==0 || $page==""){
            $page = 1;
         }
         $j=array("LEFT JOIN t_share ON t_share.f_taskid=t_task.f_tid");
         $Model=new \Think\Model();
         $total=$Model->query("SELECT COUNT(1) AS total FROM (SELECT * FROM t_share t WHERE t.f_taskid=".$tid." GROUP BY t.f_userid) AS temp");
         $total =$total[0]['total'];//总记录数
         $pageSize = 20; //每页显示数
         $totalPage = ceil($total/$pageSize); //总页数
          //构造数组
         $this->out_arr['page'] = $page;
         $this->out_arr['total'] = $total;
         $this->out_arr['pageSize'] = $pageSize;
         $this->out_arr['totalPage'] = $totalPage;
         //根据tid查找用户
         $userid=$t->field("f_userid")->where("t_share.f_taskid=".$tid."")->group('t_share.f_userid')->page($page.','.$pageSize)->select();
         foreach ($userid as $key => $val) {
             $userid=$val['f_userid'];
             $userlist=A('Jhttp')->getUserinfo2($userid);
                $arr=json_decode($userlist,true);
                if($arr['resCode']=='000000'){
                    $truename = $arr['list']['trueName']; 
                    $mobile=$arr['list']['mobile'];
                }
             $map["f_taskid"]=$tid;
             $map["f_userid"]=$userid;
             $map["f_platform"]=array('neq',"");
             $list = M("share")->field("COUNT(*) num,f_platform")->where($map)->group("f_platform")->select();
             $this->out_arr["list"][$key]["userid"]=$userid;
             $this->out_arr["list"][$key]["truename"]=$truename==""?$mobile:$truename;
             $this->out_arr["list"][$key]["numlist"]=$list==null?0:$list;   
         } 
         $this->out_arr['list']; 
         $this->pushConf();//输出数据 
   }
   
   function  get_track_makeTotal(){
        $this->getConf();//取数据 
        $tid=$this->in_arr['taskid'];
        $list=M('share')->field("count(*) num,f_platform")->where("f_taskid = ".$tid." and f_platform  <> '' ")->group("f_platform")->select();
        $this->out_arr['listtotal']=$list; 
        $this->pushConf();//输出数据 
   }
   
   function gettasktitle(){
        $this->getConf();//取数据
        $tasktypeid = $this->in_arr['tasktypeid'];
        $companyid = $this->in_arr['companyid'];
        $in_Id = A('Fun')->getTaskTypeId($tasktypeid);
        $t = M('task');
        if($tasktypeid!=0){
            $map['f_tasktypeid'] = array('in',$in_Id);
         }
         if($companyid!=0){
            $map['f_companyid'] = $companyid;
         }
         $map['f_status']  = array('in','1,3');

        if($tasktypeid==1){
            $f ="t_task.f_tid,t_task.f_title,t_tasktype.f_typeid,t_tasktype.f_typename,t_task.f_status,t_task.f_begindate,t_task.f_enddate";
            $j = array("LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid");
        }elseif($tasktypeid==2 || $tasktypeid==4 || $tasktypeid==5 || $tasktypeid==6){
            $f ="t_task.f_tid,t_task.f_title,t_tasktype.f_typeid,t_tasktype.f_typename,t_task.f_status,t_task.f_begindate,t_task.f_enddate";
            $j = array("LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid");
        }else{
            $f ="t_task.f_tid,t_task.f_title,t_tasktype.f_typeid,t_tasktype.f_typename,t_task.f_status,t_task.f_begindate,t_task.f_enddate,t_taskmtbaseinfo.f_mtbrand,t_taskmtbaseinfo.f_mtgoods";
            $j = array("LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid");
        }

        $this->out_arr['list'] = $t->field($f)->where($map)->join($j)->order('f_creatdate desc')->select();

        $this->pushConf();//输出数据
   }
   
   //厂家获取经销商数据
   function  get_business_dealer(){
       $this->getConf();
       $taskid=$this->in_arr["taskid"];
       $dealer_status=$this->in_arr["dealer_status"];
       $type=$this->in_arr["type"];
       $dealer_name=$this->in_arr["dealer_name"];
//       echo $dealer_name;
//       exit;
       $page=$this->in_arr["page"];
       if($page==0 || $page==""){
            $page = 1;
       }
       
       if($type==3||$type==2){
           $pageSize =20; //每页显示数
           $pageStart = ($page-1)*$pageSize;

           $map['f_taskid']=$taskid;
           $map['f_dealer_strats']=$dealer_status;
           $list=M('dealerbaseinfo')->limit($pageStart,$pageSize)->where($map)->select();
//           $list=M('dealerbaseinfo')->join("left join t_dealerqualifyinfo  t2 on t_dealerbaseinfo.f_dealerid=t2.f_dealerid")->limit($pageStart,$pageSize)->where($map)->select();
           //分页
           $total =M('dealerbaseinfo')->where($map)->count();//总记录数
//           $total =M('dealerbaseinfo')->join("left join t_dealerqualifyinfo  t2 on t_dealerbaseinfo.f_dealerid=t2.f_dealerid")->where($map)->count();//总记录数

           $totalPage = ceil($total/$pageSize); //总页数
              //构造数组
           $this->out_arr['page'] = $page;
           $this->out_arr['total'] = $total;
           $this->out_arr['pageSize'] = $pageSize;
           $this->out_arr['totalPage'] = $totalPage;
           $this->out_arr['list']=$list;
       }
       if($type==1){
           if(!empty($dealer_name)){
               $map['f_companynameone']=array("like","%".$dealer_name."%");
           }
           $map['f_taskid']=$taskid;
           $map['f_dealer_strats']=$dealer_status;
           $pageSize =6; //每页显示数
//           $list1=M('dealerbaseinfo')->join("t_dealerqualifyinfo  t2 on t_dealerbaseinfo.f_dealerid=t2.f_dealerid")->where($map)->page($page.','.$pageSize)->select();
           $list1=M('dealerbaseinfo')->where($map)->page($page.','.$pageSize)->select();
           foreach ($list1 as $key => $val) {
                 $unReadMessage_dealerid = $val['f_dealerid']; //经销商id
                 $dealerquali=M('dealerqualifyinfo')->where("f_dealerid=".$val['f_dealerid'])->select();
                 $this->out_arr["list"][$key]["f_companynameone"]=$val["f_companynameone"];
                 $this->out_arr["list"][$key]["f_dealerid"]=$val["f_dealerid"];
                 $this->out_arr["list"][$key]["f_userid"]=$val["f_userid"];
                 if($dealerquali){
                     $this->out_arr["list"][$key]["dealerlist"]=$dealerquali[0];
                 }else{
                     $this->out_arr["list"][$key]["dealerlist"]="";
                 }
                 $unReadMessage = A('Api')->getTalkNum($unReadMessage_dealerid); //获取未读信息数
                 $userid=$val['f_userid'];
                 $userlist=A('Jhttp')->getUserinfo2($userid); //查找用户信息
                    $arr=json_decode($userlist,true);
                    if($arr['resCode']=='000000'){
                        $truename = $arr['list']['trueName'];
                        $mobile=$arr['list']['mobile'];
                        $idcard=$arr['list']['idCard'];
                    }
                //经销商的进度管理
//               bid：中标，contract：合同，remit：打款，dispatch：发货，receive：收货，commissionsquare：佣金结算，Settlement：货款结算
                 //判断是否完成中标
                 //标签数组
                 $arr=[];
//                 $re2=M("business_progress")->where("f_proname='bid' and f_prostatus=1  and f_dealerid=".$unReadMessage_dealerid." and f_taskid=".$taskid)->select();
//                 if($re2){
//                     array_push($arr,"合同签订中");
//                 }else{
                     array_push($arr,"合同签订中");
////                 }
                 //合同是否签订
                 $re3=M("business_progress")->where("f_proname='contract'  and f_prostatus=2 and f_dealerid=".$unReadMessage_dealerid." and f_taskid=".$taskid)->select();
                 if($re3){
                     array_push($arr,"等待打款");
                 }
                 //打款确认
                 $re4=M("business_progress")->where("f_proname='remit'  and f_prostatus=2 and f_dealerid=".$unReadMessage_dealerid." and f_taskid=".$taskid)->select();
                 if($re4){
                   array_push($arr,"等待发货");
                  }

                   //发货确认
                   $re5=M("business_progress")->where("f_proname='dispatch'  and f_prostatus=1 and f_dealerid=".$unReadMessage_dealerid." and f_taskid=".$taskid)->select();
                   if($re5){
                       array_push($arr,"等待收货");
                   }

                   //收货确认
                   $re5=M("business_progress")->where("f_proname='receive'  and f_prostatus=1 and f_dealerid=".$unReadMessage_dealerid." and f_taskid=".$taskid)->select();
                   if($re5){
                       array_push($arr,"等待结算");
                   }

                   //结算确认
                   $re5=M("business_progress")->where("f_proname='Settlement'  and f_prostatus=1 and f_dealerid=".$unReadMessage_dealerid." and f_taskid=".$taskid)->select();
                   if($re5){
                       array_push($arr,"招商完成");
                   }

                 $this->out_arr["list"][$key]["progress_desc"]=end($arr);
                 $this->out_arr["list"][$key]["unReadMessage"]=$unReadMessage;  //未读信息数
                 $this->out_arr["list"][$key]["userid"]=$userid;
                 $this->out_arr["list"][$key]["idcard"]=$idcard;
                 $this->out_arr["list"][$key]["truename"]=$truename==""?$mobile:$truename;
                 $this->out_arr['list'][$key]['mobile']=$mobile;

           }
           //分页
//           $total =M('dealerbaseinfo')->join("t_dealerqualifyinfo  t2 on t_dealerbaseinfo.f_dealerid=t2.f_dealerid")->where($map)->count();//总记录数
           $total =M('dealerbaseinfo')->where($map)->count();//总记录数
           $totalPage = ceil($total/$pageSize); //总页数
          //构造数组
           $this->out_arr['page'] = $page;
           $this->out_arr['total'] = $total;
           $this->out_arr['pageSize'] = $pageSize;
           $this->out_arr['totalPage'] = $totalPage;
           if($list1){
               $this->out_arr['list'];
           }else{
               $this->out_arr['list']="";
           }

       }
       
       $this->pushConf();
        
   }
   
   //获取业务员信息
   function  getUser(){
     $this->getConf(); 
     $re = A('Jhttp')->getUserinfo2($this->in_arr['userid']);
     $arr = json_decode($re,true);
     $this->out_arr["list"]=$arr['list'];
     $this->pushConf();

   }
   
   //经销商详情
   function getdetaldealer2(){
       $this->getConf();
       $dealerid=$this->in_arr["dealerid"];
       //echo  $dealerid;
       $map['f_dealerid']=$dealerid;
       $re2=M('dealerbaseinfo')->where($map)->find();
       if($re2){
           $re2_qualify=M("dealerqualifyinfo")->where($map)->select();
           if($re2_qualify){
               $this->out_arr["dealerqualify"]=$re2_qualify[0];
           }else{
               $this->out_arr["dealerqualify"]="";
           }
       }
       $this->out_arr['dealerinfo']=$re2;
       $this->pushConf();  
   }
   
   //经销商中标操作
   function  dealerselected(){
       $this->getConf();
       $obj=M('dealerbaseinfo');
       $idarray=explode(',',I('post.checklist'));

//       dump($this->in_arr);return;
       //操作记录入库
       $log['f_userid'] = cookie("userId");   //操作人id
       $log['f_action'] = "f_dealerid".$this->in_arr['checklist']."中标";  //操作说明
       $log['f_taskid'] = $this->in_arr['taskId'];  //任务id
       $log['f_datetime'] = time();
       M('action_log')->add($log);


       for($i=0;$i<count($idarray);$i++){
           $map['f_dealerid'] = $idarray[$i];
           $map['f_dealer_strats'] =3;
           //驳回还是中标的状态 $this->in_arr["strats"]
           $reV=$obj->where($map)->setField('f_dealer_strats',$this->in_arr["strats"]);
           if($reV==0){
               $this->out_arr['error_code']='false';
           }else{
//               $re_taskinfo = M('tasksmallinfo')->where("f_taskid=".$map['f_taskid'])->find();
//             
//               D('Shopsheet')->add_shopsheet('task',$map['f_userid'],1,1,$re_taskinfo['f_eachcoin']*10,$map['f_taskid'],2,0);
//               D('Shopsheet')->add_shopsheet('task',$map['f_userid'],1,2,$re_taskinfo['f_eachscore'],$map['f_taskid'],2,0);
               $this->out_arr['error_code']='true';
           }    
       }

       $this->pushConf();
   }
   
   
   //招商目标与实际目标的统计 与招商回款统计  经销商情况的统计
     function  InvTargetstatistics(){
         $this->getConf();
         $taskid=$this->in_arr['taskid'];

         $rc4=M("business_progress")->query("SELECT  count(*)  acthuokuannum  FROM  (SELECT  *  FROM  t_business_progress t WHERE t.f_taskid=".$taskid." AND t.f_proname='remit'  AND t.f_prostatus=2  GROUP BY t.f_dealerid ORDER BY t.f_protime DESC ) b");
         $acthuokuannum=$rc4[0]["acthuokuannum"]!=""?$rc4[0]["acthuokuannum"]:0;


         //签订合同经销商数量  经销商与厂家同时签订合同
         $rc=M("business_progress")->query("SELECT  count(*)  contsignednum  FROM  (SELECT  *  FROM  t_business_progress t WHERE t.f_taskid=".$taskid." AND t.f_proname='contract'  AND t.f_prostatus=2  GROUP BY t.f_dealerid ORDER BY t.f_protime DESC ) b");
         $contsignednum=$rc[0]["contsignednum"]!=""?$rc[0]["contsignednum"]:0;
         //预计回款=签订合同数*总首批款
         //首批款
         $firstnum=M("taskmtbaseinfo")->field("f_unitfirstAmount")->where("f_taskid=".$taskid)->select();
//         echo var_dump($firstnum);
         $expectedmoney1=$contsignednum*$firstnum[0]["f_unitfirstamount"];
//         echo $firstnum[0]["f_unitfirstamount"]."===";
//         echo $expectedmoney1;
//         exit;

         //实际回款=经销商签订合同并打款数量
         $actualpayment=$acthuokuannum*$firstnum[0]["f_unitfirstamount"];

         $expectedmoney=$expectedmoney1!=""?$expectedmoney1:0;
         //实际打款金额合计
         $actualtotalpay=0;
         $re=M('taskmtareaqty')->where("f_taskid =".$taskid)->sum("f_qty");
         $re2=M('taskmtbaseinfo')->where('f_taskid ='.$taskid)->find();
//         提交给厂家的
         $re3=M('dealerbaseinfo')->where('f_taskid ='.$taskid.' and  f_dealer_strats = 3')->count();
//         已中标的
         $re4=M('dealerbaseinfo')->where('f_taskid ='.$taskid.' and f_dealer_strats = 1')->count();
         //厂家驳回的
         $re6=M('dealerbaseinfo')->where('f_taskid ='.$taskid.' and f_dealer_strats = 2')->count();
         //取招商数量前五的区域
         $re5=M('taskmtareaqty')->where('f_taskid ='.$taskid)->order('f_qty')->limit(5)->select();
         $Invtarget=$re!=""?$re:0;
         $collecttarget=($re2['f_unittotalamount']!=0?$re2['f_unittotalamount']:0)*$Invtarget;
         $collecttarget=($firstnum[0]["f_unitfirstamount"]!=0?$firstnum[0]["f_unitfirstamount"]:0)*$Invtarget;
         $Redealnum=$re3!=0?$re3:0;  //提交给厂家的经销商数量
         $Authdealnum=$re4!=0?$re4:0;  //已中标的经销商数量
         $backdealnum=$re6!=0?$re6:0;  //厂家驳回的经销商数量

//         echo $Redealnum.",".$Authdealnum.",".$contsignednum;
         $this->out_arr['Invtarget']=$Invtarget;  //招商目标
         $this->out_arr['Actinvestment']=$contsignednum; //实际招商(签订合同的经销商数量)
         $this->out_arr['payarr']=array($collecttarget,$actualpayment);
         $this->out_arr['collecttarget']=$collecttarget;//回款目标
         $this->out_arr['actualpayment']=$actualpayment;//经销商签订合同并打款合计（实际回款）
         $this->out_arr['redealnum']=($Redealnum+$Authdealnum+$backdealnum);//上报经销商数量
         $this->out_arr['authdealnum']=($Authdealnum); //授权经销商数量
         $this->out_arr['contsignednum']=$contsignednum;//签订合同经销商数量
         $this->out_arr['expectedmoney']=$expectedmoney;//预计回款=签订合同数*总首批款
         $this->out_arr['actualtotalpay']=$actualpayment; //打款金额合计
         $this->out_arr['Invareasort']=$re5;//招商区域取前五
         $this->pushConf();
     }
   
     //推广赚与随手赚报表呈现
     function  promReport(){
         $this->getConf();
         $taskid=$this->in_arr['taskid']; 
         $type=$this->in_arr['type'];
         $re=M("tasksmallinfo")->where("f_taskid=".$taskid)->select();
         //发布任务数量
         $targetcopies=$re[0]['f_totalcopies'];
         //单份任务金币
         $eachcoin=$re[0]['f_eachcoin']*10;
         //总奖励金币
         $totalcopies=$targetcopies*$eachcoin;
         //推广
         $this->out_arr["targetcopies"]=$targetcopies;  //发布任务数量
         $this->out_arr['eachcoin']=$eachcoin; //单份任务金币
         $this->out_arr['totalcopies']=$totalcopies;  //总奖励金币
         if($type==1){
            //参与数量
//             SELECT SUM(f_amount) FROM `t_shopsheet` WHERE f_shopingtype=1 AND f_taskid=736
            $propartnum=M("shopsheet")->where("f_taskid =".$taskid." and f_shopingtype=1 and f_amount!=0")->count();
            //已发奖励金币
            $projiangnum=$propartnum*$eachcoin;
            $this->out_arr['propartnum']=$propartnum!=0?$propartnum:0; //推广参与数量
            $this->out_arr['projiangnum']=$projiangnum; //推广已发奖励金币
            $this->out_arr['prochart']=array($targetcopies,$propartnum!=0?$propartnum:0); //推广
         }else if($type==2){
            //参与任务数量
            $pushjoinnum=M("taskdraw")->where("f_taskid =".$taskid." and  f_utask_status=2")->count();
            //完成任务数量
            $compltenum=M("shopsheet")->where("f_taskid =".$taskid." and f_shopingtype=1 and f_amount!=0")->count();
            //已发奖励金币
            $issued=M("shopsheet")->where("f_taskid =".$taskid." and f_shopingtype=1")->sum("f_amount");
//             echo M("shopsheet")->getLastSql();
             $pushjoinnum=$pushjoinnum+$compltenum;
            $this->out_arr['pushjoinnum']=$pushjoinnum!=0?$pushjoinnum:0; //随手参与任务数量
            $this->out_arr['compltenum']=$compltenum!=0?$compltenum:0; //完成任务数量
            $this->out_arr['issued']=$issued;  //已发奖励金币
            $this->out_arr["pushchart"]=array($targetcopies,$pushjoinnum!=0?$pushjoinnum:0,$compltenum!=0?$compltenum:0);//随手 
         }
         $this->pushConf();
     }
    function delteanswer(){
        $this->getConf();
        $indexid=$this->in_arr['indexid']; 
        $re=M("surveytaskdetail")->where("F_STDINDEX=".$indexid)->delete();
        if($re ==0){
            $this->out_arr['error_code']='false';
        }
        $this->out_arr['error_code']='true';
          $this->pushConf();
    }
    
    
   

    /******** 权限控制        用户->角色->权限 ***************/   
    /**
     * 添加角色
     * 表中对应的字段名
     */
    function role_add(){    	    	
    	$this->getConf();    	
    	$data = $this->in_arr;
    	$this->out_arr['code'] = M('role')->add($data); 
    	$this->pushConf();    	
    }
    
    // 编辑角色权限
    function  role_edit(){
       $this->getConf();    
       $id = $this->in_arr['id'];
       $access=$this->in_arr['access'];
       $this->out_arr['code']=M('role')->where('f_id='.$id)->setField('f_access',$access);
       $this->pushConf(); 
    }
    
    /**
     * 删除角色
     * f_id(角色的id)
     */
    function role_del(){
    	$this->getConf();
        $companyid=cookie("companyId");
    	$id = $this->in_arr['f_id'];
        $re=M('user_role')->where("f_company_id=".$companyid)->select();
        if(count($re)>0){
            foreach($re as $k=>$value){
                $rolearay=explode(",",$value["f_role_id"]);
//                echo $id;
//                echo var_dump($rolearay);
//                echo in_array($id,$rolearay);
                if(in_array($id,$rolearay)){
//                    echo "还有";
                    $ishave="true";
                }else{
                    $ishave="false";
                }
            }

            if($ishave=="true"){
                $this->out_arr['code']="false";
            }else{
                $re=M("role")->where("f_id=".$id)->select();
                if(count($re)>0){
                    if($re[0]["f_name"]=="全部"){
                        $this->out_arr["code"]="isSuper";
                    }else{
                        $this->out_arr["code"]=M("role")->where("f_id=".$id)->delete();
                    }

                }else{
                    $this->out_arr['code']=0;
                }
            }
        }else{
            $this->out_arr['code']="false";
        }
    	$this->pushConf();
    }    
    
    /**
     * 角色列表
     * page(第几页)
     */
    function role_list(){
    	$this->getConf();
        $data=array("f_company_id=".$this->in_arr['companyid']);
        $total = M('role')->where($data)->count();//总记录数

        $total = intval($total)-1;
        $pageSize = 10; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $page = $this->in_arr['page'];
        if( $page == '' ){
        	$page = 0;
        }
        if( $page == 0 ){
            $pageSize = 11;
        }else{
            $pageSize = 10;
        }

        $list = M('role')->where($data)->page($page.','.$pageSize)->select();
//        echo M('role')->getLastSql();exit;
//        dump($list);exit;

//        if( $page == 0 ){
//           $list = array_slice($list,1,5);  //默认不显示注册时成为管理员的那个角色,避免第一个用户的权限被修改,测试要求的
//        }

//        dump($list);exit;
        //echo M('role')->getLastSql();
        //构造数组
        $this->out_arr['list']=$list;
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;    
    	$this->pushConf();
    }
    
    /**
     * 用户权限添加(调用用户模块组接口) 接口中的level
     * user_id(用户的id)  role_id(角色的id)
     */
    function power_add(){
    	$this->getConf();    	
    	$data = $this->in_arr;	    	
    	
    	$this->out_arr = M('user')->add($data);     	
    	//$this->pushConf();  
    }

    /**
     * 添加到mysql数据库中，不调用接口
     * user_id(用户的id)  role_id(角色的id)
     */
    function power_add_local(){    	
        $this->getConf();       
        $data = $this->in_arr;

        M()->startTrans();
       	$result1 = M('user_role')->where('f_user_id='.$this->in_arr['f_user_id'])->delete();
        $result2 = M('user_role')->add($data);
        if( $result2 ){  //如果没有的话会删除失败，所以这里会经常出现第一次授权失败的情况
        	M()->commit();
        	$this->out_arr = 1;
        }else{
        	M()->rollback();
        	$this->out_arr = 0;
        }




        $this->pushConf();  
    }
    
    /**
     * 获取node列表 
     */
    function node_list(){
    	$this->getConf();    	
    	 
    	$this->out_arr['first'] = M('node')->where("`f_pid`=0")->select();
    	foreach( $this->out_arr['first'] as $key=>$vo ){
    		$this->out_arr['first'][$key]['child'] = M('node')->where("f_pid=".$vo['f_id'])->select();
    	}
        
    	return $this->out_arr;
    }

    /**
     * 下载APP
     */
  	function downApp(){
        $this->getConf();
        $map['f_udid'] = $this->in_arr['udid'];
        $map['f_ip'] = $this->getIP();
        $map['f_time'] = time();

        $re = M('downapp')->where("f_ip='".$map['f_ip']."'")->find();
        if(!$re){
            M('downapp')->add($map);
        }
        $link = "http://wisdom.51lick.com/Public/upfile/app/wisdom".$map['f_udid'].".apk";
        Header("HTTP/1.1 303 See Other");
        //header("Loaction:http://wisdom.51lick.com/Public/upfile/app/wisdom".$map['f_udid'].".apk");
        Header("Location:".$link);
    }

    // 定义一个函数getIP()
    function getIP(){
        global $ip;
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else $ip = "Unknow";
        return $ip;
    }
    
    //用户数表
    public function userCountReport(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        $shareSumSql = "SELECT COUNT('f_sid') AS sum , FROM_UNIXTIME(f_datetime,'%Y-%m-%d') AS createdtime FROM t_share  WHERE f_datetime>='".strtotime($startTime)."' AND f_datetime<='".strtotime($endTime)."'  GROUP BY FROM_UNIXTIME(f_datetime,'%Y-%m-%d')";
        $this->out_arr["shareCount"] = M("share")->query($shareSumSql);

        //False
        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $userSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_indexid') AS aaa , f_creatdate AS createdtime FROM t_memberlibary  WHERE UNIX_TIMESTAMP(f_creatdate)<='".$sumTime."'  GROUP BY f_creatdate) aa ";
            $a = M("memberlibary")->query($userSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["userCount"][$i] = $a;
        }

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //用户数表
    public function userReports(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        // $startTime = date('Y-m-d',strtotime($endTime));
        $endTime = date('Y-m',strtotime($endTime)+86400);

        $map['f_month']=array(array('egt',$startTime),array('lt',$endTime),"and");
        $this->out_arr['re']=M('usercount')->where($map)->select();

        $this->out_arr['f_month'] = array_column($this->out_arr['re'], 'f_month');
        $this->out_arr['f_regcount'] = array_column($this->out_arr['re'], 'f_regcount');
        $this->out_arr['f_dayactivecount'] = array_column($this->out_arr['re'], 'f_dayactivecount');
        $this->out_arr['f_weekactivecount'] = array_column($this->out_arr['re'], 'f_weekactivecount');
        $this->out_arr['f_monthactivecount'] = array_column($this->out_arr['re'], 'f_monthactivecount');
        $this->out_arr['f_monthretentionrate'] = array_column($this->out_arr['re'], 'f_monthretentionrate');
        $this->out_arr['f_dayopenaverage'] = array_column($this->out_arr['re'], 'f_dayopenaverage');
        $this->out_arr['f_onceuserduration'] = array_column($this->out_arr['re'], 'f_onceuserduration');
        $this->out_arr['f_onceaccesspagenumber'] = array_column($this->out_arr['re'], 'f_onceaccesspagenumber');
        
        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //用户数表
    public function userChars(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m',strtotime($endTime)+86400);

        $map['f_month']=array(array('egt',$startTime),array('lt',$endTime),"and");
        $this->out_arr['re']=M('usercount')->where($map)->select();
        $this->out_arr['f_month'] = array_column($this->out_arr['re'], 'f_month');
        $this->out_arr['f_regcount'] = array_column($this->out_arr['re'], 'f_regcount');
        $this->out_arr['f_dayactivecount'] = array_column($this->out_arr['re'], 'f_dayactivecount');
        $this->out_arr['f_weekactivecount'] = array_column($this->out_arr['re'], 'f_weekactivecount');
        $this->out_arr['f_monthactivecount'] = array_column($this->out_arr['re'], 'f_monthactivecount');
        $this->out_arr['f_monthretentionrate'] = array_column($this->out_arr['re'], 'f_monthretentionrate');
        $this->out_arr['f_dayopenaverage'] = array_column($this->out_arr['re'], 'f_dayopenaverage');
        $this->out_arr['f_onceuserduration'] = array_column($this->out_arr['re'], 'f_onceuserduration');
        $this->out_arr['f_onceaccesspagenumber'] = array_column($this->out_arr['re'], 'f_onceaccesspagenumber');

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //实名认证数表
    public function certifiedCountReport(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $certifiedSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_indexid') AS aaa , f_creatdate AS createdtime FROM t_memberlibary  WHERE UNIX_TIMESTAMP(f_creatdate)<='".$sumTime."' AND  f_truename IS NOT NULL AND f_truename <> '' GROUP BY f_creatdate) aa ";
            $a = M("memberlibary")->query($certifiedSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["certifiedCount"][$i] = $a;
        }
        
        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //登录数表
    public function loginResultReport(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $loginSumSql = "SELECT SUM(aaa) AS total FROM (SELECT MAX(logintime) AS time ,COUNT(f_userid) AS aaa FROM (SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_logintime<='".$sumTime."' GROUP BY f_userid,FROM_UNIXTIME(f_logintime,'%Y-%m-%d') ) AS t GROUP BY t.logintime) aa ";
            $a = M("login_log")->query($loginSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["loginResult"][$i] = $a;
        }
        
        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //任务数表
    public function taskResultReport(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $taskSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_tid') AS aaa , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS createdtime FROM t_task  WHERE f_creatdate<='".$sumTime."'  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d')) aa ";
            $a = M("task")->query($taskSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["taskResult"][$i] = $a;
        }
        
        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //日任务接单数表
    public function allTaskReceiveResultReport(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        $map["f_creatdate"]=array('gt',strtotime($startTime));
        $map["f_creatdate"]=array('lt',strtotime($endTime));
        $allTask = M("task")->field("f_tid")->where($map)->select();
        $allTaskTid = array_column($allTask, 'f_tid');
        $allTaskStr = '';
        foreach($allTaskTid as $k=>$v) {
            if ($k == 0) {
                $allTaskStr .= $v;
            }else{
                $allTaskStr .= ',' . $v;
            }
        }
        $allTaskReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$allTaskStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["allTaskReceiveResult"] =  M("taskdraw")->query($allTaskReceiveSql);
        foreach ($this->out_arr["allTaskReceiveResult"] as $key => $value) {
            $this->out_arr["allTaskReceiveResult"][$key]['sum'] = $value['sum']+$this->out_arr["shareCount"][$key]['sum'];
        }
        
        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //日任务完成单数表
    public function allTaskEndResultReport(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        $map["f_creatdate"]=array('gt',strtotime($startTime));
        $map["f_creatdate"]=array('lt',strtotime($endTime));
        $allTask = M("task")->field("f_tid")->where($map)->select();
        $allTaskTid = array_column($allTask, 'f_tid');
        $allTaskStr = '';
        foreach($allTaskTid as $k=>$v) {
            if ($k == 0) {
                $allTaskStr .= $v;
            }else{
                $allTaskStr .= ',' . $v;
            }
        }
        $allTaskEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$allTaskStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["allTaskEndResult"] =  M("taskdraw")->query($allTaskEndSql);
        foreach ($this->out_arr["allTaskEndResult"] as $key => $value) {
            $this->out_arr["allTaskEndResult"][$key]['sum'] = $value['sum']+$this->out_arr["shareCount"][$key]['sum'];
        }
        
        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }
        
    //活跃度报表
    public function liveness(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        $shareSumSql = "SELECT COUNT('f_sid') AS sum , FROM_UNIXTIME(f_datetime,'%Y-%m-%d') AS createdtime FROM t_share  WHERE f_datetime>='".strtotime($startTime)."' AND f_datetime<='".strtotime($endTime)."'  GROUP BY FROM_UNIXTIME(f_datetime,'%Y-%m-%d')";
        $this->out_arr["shareCount"] = M("share")->query($shareSumSql);

        //False
        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $userSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_indexid') AS aaa , f_creatdate AS createdtime FROM t_memberlibary  WHERE UNIX_TIMESTAMP(f_creatdate)<='".$sumTime."'  GROUP BY f_creatdate) aa ";
            $a = M("memberlibary")->query($userSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["userCount"][$i] = $a;
        }

        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $certifiedSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_indexid') AS aaa , f_creatdate AS createdtime FROM t_memberlibary  WHERE UNIX_TIMESTAMP(f_creatdate)<='".$sumTime."' AND  f_truename IS NOT NULL AND f_truename <> '' GROUP BY f_creatdate) aa ";
            $a = M("memberlibary")->query($certifiedSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["certifiedCount"][$i] = $a;
        }

        // $loginSql= "SELECT SUM(aaa) AS total FROM (SELECT MAX(logintime) AS time ,COUNT(f_userid) AS aaa FROM (SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d %H:%i:%S')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_logintime>='".strtotime($startTime)."' AND f_logintime<='".strtotime($endTime)."' GROUP BY f_userid,FROM_UNIXTIME(f_logintime,'%Y-%m-%d %H:%i:%S') ) AS t GROUP BY t.logintime) aa  ";
        // var_dump($loginSql);exit();
        // $this->out_arr["loginResult"] = M("login_log")->query($loginSql);
        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $loginSumSql = "SELECT SUM(aaa) AS total FROM (SELECT MAX(logintime) AS time ,COUNT(f_userid) AS aaa FROM (SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_logintime<='".$sumTime."' GROUP BY f_userid,FROM_UNIXTIME(f_logintime,'%Y-%m-%d') ) AS t GROUP BY t.logintime) aa ";
            // var_dump($loginSumSql);exit();
            $a = M("login_log")->query($loginSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["loginResult"][$i] = $a;
        }

        // $taskSql = "SELECT COUNT('f_tid') AS tasksum , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS createdtime FROM t_task  WHERE f_creatdate>='".strtotime($startTime)."' AND f_creatdate<='".strtotime($endTime)."'  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') ";
        // $this->out_arr["taskResult"] = M("task")->query($taskSql);

        for ($i=0; $i <$count ; $i++) { 
            if ($i==0) {
                $sumTime = strtotime($startTime)+86400;
            }else{
                $sumTime += 86400;
            }
            $taskSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_tid') AS aaa , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS createdtime FROM t_task  WHERE f_creatdate<='".$sumTime."'  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d')) aa ";
            $a = M("task")->query($taskSumSql);
            foreach ($a as $k => $v) {
                $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
            }
            $this->out_arr["taskResult"][$i] = $a;
        }

        $map["f_creatdate"]=array('gt',strtotime($startTime));
        $map["f_creatdate"]=array('lt',strtotime($endTime));
        $allTask = M("task")->field("f_tid")->where($map)->select();
        $allTaskTid = array_column($allTask, 'f_tid');
        $allTaskStr = '';
        foreach($allTaskTid as $k=>$v) {
            if ($k == 0) {
                $allTaskStr .= $v;
            }else{
                $allTaskStr .= ',' . $v;
            }
        }
        $allTaskReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$allTaskStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["allTaskReceiveResult"] =  M("taskdraw")->query($allTaskReceiveSql);
        foreach ($this->out_arr["allTaskReceiveResult"] as $key => $value) {
            $this->out_arr["allTaskReceiveResult"][$key]['sum'] = $value['sum']+$this->out_arr["shareCount"][$key]['sum'];
        }

        $allTaskEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$allTaskStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["allTaskEndResult"] =  M("taskdraw")->query($allTaskEndSql);
        foreach ($this->out_arr["allTaskEndResult"] as $key => $value) {
            $this->out_arr["allTaskEndResult"][$key]['sum'] = $value['sum']+$this->out_arr["shareCount"][$key]['sum'];
        }

        $pushTaskSql = "SELECT COUNT('f_tid') AS pushtaskSum , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS pushtaskcreatedtime FROM t_task  WHERE f_creatdate>='".strtotime($startTime)."' AND f_creatdate<='".strtotime($endTime)."' AND f_tasktypeid=1  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') ";
        $this->out_arr["pushTaskResult"] = M("task")->query($pushTaskSql);
        $p["f_creatdate"]=array('gt',strtotime($startTime));
        $p["f_creatdate"]=array('lt',strtotime($endTime));
        $p["f_tasktypeid"]=1;
        $pushTask = M("task")->field("f_tid")->where($p)->select();
        $pushTid = array_column($pushTask, 'f_tid');
        $pushStr = '';
        foreach($pushTid as $k=>$v) {
            if ($k == 0) {
                $pushStr .= $v;
            }else{
                $pushStr .= ',' . $v;
            }
        }
        $pushReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$pushStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["pushReceiveResult"] =  M("taskdraw")->query($pushReceiveSql);
        $pushEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$pushStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["pushEndResult"] =  M("taskdraw")->query($pushEndSql);


        $widelyTaskSql = "SELECT COUNT('f_tid') AS widelytaskSum , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS widelytaskcreatedtime FROM t_task  WHERE f_creatdate>='".strtotime($startTime)."' AND f_creatdate<='".strtotime($endTime)."' AND f_tasktypeid in(2,4,5,6)  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') ";
        $this->out_arr["widelyTaskResult"] = M("task")->query($widelyTaskSql);
        $w["f_creatdate"]=array('gt',strtotime($startTime));
        $w["f_creatdate"]=array('lt',strtotime($endTime));
        $w['f_tasktypeid']  = array('in','2,4,5,6');
        $widelyTask = M("task")->field("f_tid")->where($w)->select();
        $widelyTid = array_column($widelyTask, 'f_tid');
        $widelyStr = '';
        foreach($widelyTid as $k=>$v) {
            if ($k == 0) {
                $widelyStr .= $v;
            }else{
                $widelyStr .= ',' . $v;
            }
        }
        $widelyReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$widelyStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["widelyReceiveResult"] =  M("taskdraw")->query($widelyReceiveSql);
        $widelyEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$widelyStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["widelyEndResult"] =  M("taskdraw")->query($pushEndSql);


        $businessTaskSql = "SELECT COUNT('f_tid') AS businesstaskSum , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS businesstaskcreatedtime FROM t_task  WHERE f_creatdate>='".strtotime($startTime)."' AND f_creatdate<='".strtotime($endTime)."' AND f_tasktypeid=3  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') ";
        $this->out_arr["businessTaskResult"] = M("task")->query($businessTaskSql);
        $b["f_creatdate"]=array('gt',strtotime($startTime));
        $b["f_creatdate"]=array('lt',strtotime($endTime));
        $b["f_tasktypeid"]=3;
        $businessTask = M("task")->field("f_tid")->where($b)->select();
        $businessTid = array_column($businessTask, 'f_tid');
        $businessStr = '';
        foreach($businessTid as $k=>$v) {
            if ($k == 0) {
                $businessStr .= $v;
            }else{
                $businessStr .= ',' . $v;
            }
        }
        $businessReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$businessStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["businessReceiveResult"] =  M("taskdraw")->query($businessReceiveSql);
        $businessEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$businessStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
        $this->out_arr["businessEndResult"] =  M("taskdraw")->query($businessEndSql);

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据

        // var_dump($this->pushConf());
        // exit();
    }
    
    //任务报表
    public function checkTask(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $type = $this->in_arr['type'];

        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        if ($type == "0") {
            for ($i=0; $i <$count ; $i++) { 
                if ($i==0) {
                    $sumTime = strtotime($startTime)+86400;
                }else{
                    $sumTime += 86400;
                }
                $taskSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_tid') AS aaa , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS createdtime FROM t_task  WHERE f_creatdate<='".$sumTime."'  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d')) aa ";
                $a = M("task")->query($taskSumSql);
                foreach ($a as $k => $v) {
                    $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
                }
                $this->out_arr["totalSum"][$i] = $a;
            }
        }

        if ($type=="1") {
            $pushTaskSql = "SELECT COUNT('f_tid') AS sum , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS time FROM t_task  WHERE f_creatdate>='".strtotime($startTime)."' AND f_creatdate<='".strtotime($endTime)."' AND f_tasktypeid=1  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') ";
            $this->out_arr["taskSum"] = M("task")->query($pushTaskSql);

            for ($i=0; $i <$count ; $i++) { 
                if ($i==0) {
                    $sumTime = strtotime($startTime)+86400;
                }else{
                    $sumTime += 86400;
                }
                $pushSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_tid') AS aaa , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS time FROM t_task  WHERE f_creatdate<='".$sumTime."' AND f_tasktypeid=1  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d')) aa ";
                $a = M("task")->query($pushSumSql);
                foreach ($a as $k => $v) {
                    $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
                }
                $this->out_arr["totalSum"][$i] = $a;
            }

        }

        if ($type=="2") {
            $widelyTaskSql = "SELECT COUNT('f_tid') AS sum , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS time FROM t_task  WHERE f_creatdate>='".strtotime($startTime)."' AND f_creatdate<='".strtotime($endTime)."' AND f_tasktypeid in(2,4,5,6)  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') ";
            $this->out_arr["taskSum"] = M("task")->query($widelyTaskSql);

            for ($i=0; $i <$count ; $i++) { 
                if ($i==0) {
                    $sumTime = strtotime($startTime)+86400;
                }else{
                    $sumTime += 86400;
                }
                $pushSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_tid') AS aaa , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS time FROM t_task  WHERE f_creatdate<='".$sumTime."' AND f_tasktypeid in(2,4,5,6)  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d')) aa ";
                $a = M("task")->query($pushSumSql);
                foreach ($a as $k => $v) {
                    $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
                }
                $this->out_arr["totalSum"][$i] = $a;
            }
        }

        if ($type=="3") {
            $businessTaskSql = "SELECT COUNT('f_tid') AS sum , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS time FROM t_task  WHERE f_creatdate>='".strtotime($startTime)."' AND f_creatdate<='".strtotime($endTime)."' AND f_tasktypeid=3  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') ";
            $this->out_arr["taskSum"] = M("task")->query($businessTaskSql);

            for ($i=0; $i <$count ; $i++) { 
                if ($i==0) {
                    $sumTime = strtotime($startTime)+86400;
                }else{
                    $sumTime += 86400;
                }
                $pushSumSql = "SELECT SUM(aaa) AS total FROM (SELECT COUNT('f_tid') AS aaa , FROM_UNIXTIME(f_creatdate,'%Y-%m-%d') AS time FROM t_task  WHERE f_creatdate<='".$sumTime."' AND f_tasktypeid=3  GROUP BY FROM_UNIXTIME(f_creatdate,'%Y-%m-%d')) aa ";
                $a = M("task")->query($pushSumSql);
                foreach ($a as $k => $v) {
                    $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
                }
                $this->out_arr["totalSum"][$i] = $a;
            }
        }


        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //任务接单报表
    public function checkReceiveTask(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $type = $this->in_arr['type'];
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;

        $shareSumSql = "SELECT COUNT('f_sid') AS sum , FROM_UNIXTIME(f_datetime,'%Y-%m-%d') AS time FROM t_share  WHERE f_datetime>='".strtotime($startTime)."' AND f_datetime<='".strtotime($endTime)."'  GROUP BY FROM_UNIXTIME(f_datetime,'%Y-%m-%d')";
        $this->out_arr["shareCount"] = M("share")->query($shareSumSql);

        if ($type=="0") {
            $map["f_creatdate"]=array('gt',strtotime($startTime));
            $map["f_creatdate"]=array('lt',strtotime($endTime));
            $allTask = M("task")->field("f_tid")->where($map)->select();
            $allTaskTid = array_column($allTask, 'f_tid');
            $allTaskStr = '';
            foreach($allTaskTid as $k=>$v) {
                if ($k == 0) {
                    $allTaskStr .= $v;
                }else{
                    $allTaskStr .= ',' . $v;
                }
            }
            $allTaskReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$allTaskStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
            $this->out_arr["receiveResult"] =  M("taskdraw")->query($allTaskReceiveSql);
            foreach ($this->out_arr["receiveResult"] as $key => $value) {
                $this->out_arr["receiveResult"][$key]['sum'] = $value['sum']+$this->out_arr["shareCount"][$key]['sum'];
            }
        }

        if ($type=="1") {
            $this->out_arr["receiveResult"] =  $this->out_arr["shareCount"];
        }

        if ($type=="2") {
            $w["f_creatdate"]=array('gt',strtotime($startTime));
            $w["f_creatdate"]=array('lt',strtotime($endTime));
            $w['f_tasktypeid']  = array('in','2,4,5,6');
            $widelyTask = M("task")->field("f_tid")->where($w)->select();
            $widelyTid = array_column($widelyTask, 'f_tid');
            $widelyStr = '';
            foreach($widelyTid as $k=>$v) {
                if ($k == 0) {
                    $widelyStr .= $v;
                }else{
                    $widelyStr .= ',' . $v;
                }
            }
            $widelyReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$widelyStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
            $this->out_arr["receiveResult"] =  M("taskdraw")->query($widelyReceiveSql);
        }

        if ($type=="3") {
            $b["f_creatdate"]=array('gt',strtotime($startTime));
            $b["f_creatdate"]=array('lt',strtotime($endTime));
            $b["f_tasktypeid"]=3;
            $businessTask = M("task")->field("f_tid")->where($b)->select();
            $businessTid = array_column($businessTask, 'f_tid');
            $businessStr = '';
            foreach($businessTid as $k=>$v) {
                if ($k == 0) {
                    $businessStr .= $v;
                }else{
                    $businessStr .= ',' . $v;
                }
            }
            $businessReceiveSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$businessStr.")  GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
            $this->out_arr["receiveResult"] =  M("taskdraw")->query($businessReceiveSql);
        }

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //任务完成报表
    public function checkEndTask(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $type = $this->in_arr['type'];

        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;
        
        $shareSumSql = "SELECT COUNT('f_sid') AS sum , FROM_UNIXTIME(f_datetime,'%Y-%m-%d') AS time FROM t_share  WHERE f_datetime>='".strtotime($startTime)."' AND f_datetime<='".strtotime($endTime)."'  GROUP BY FROM_UNIXTIME(f_datetime,'%Y-%m-%d')";
        $this->out_arr["shareCount"] = M("share")->query($shareSumSql);

        if ($type=="0") {
            $map["f_creatdate"]=array('gt',strtotime($startTime));
            $map["f_creatdate"]=array('lt',strtotime($endTime));
            $allTask = M("task")->field("f_tid")->where($map)->select();
            $allTaskTid = array_column($allTask, 'f_tid');
            $allTaskStr = '';
            foreach($allTaskTid as $k=>$v) {
                if ($k == 0) {
                    $allTaskStr .= $v;
                }else{
                    $allTaskStr .= ',' . $v;
                }
            }
            $allTaskEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$allTaskStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
            $this->out_arr["EndResult"] =  M("taskdraw")->query($allTaskEndSql);
            foreach ($this->out_arr["EndResult"] as $key => $value) {
                $this->out_arr["EndResult"][$key]['sum'] = $value['sum']+$this->out_arr["shareCount"][$key]['sum'];
            }
        }

        if ($type=="1") {
            $this->out_arr["EndResult"] =  $this->out_arr["shareCount"];
        }

        if ($type=="2") {
            $w["f_creatdate"]=array('gt',strtotime($startTime));
            $w["f_creatdate"]=array('lt',strtotime($endTime));
            $w['f_tasktypeid']  = array('in','2,4,5,6');
            $widelyTask = M("task")->field("f_tid")->where($w)->select();
            $widelyTid = array_column($widelyTask, 'f_tid');
            $widelyStr = '';
            foreach($widelyTid as $k=>$v) {
                if ($k == 0) {
                    $widelyStr .= $v;
                }else{
                    $widelyStr .= ',' . $v;
                }
            }
            $widelyEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$widelyStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
            $this->out_arr["EndResult"] =  M("taskdraw")->query($widelyEndSql);
        }

        if ($type=="3") {
            $b["f_creatdate"]=array('gt',strtotime($startTime));
            $b["f_creatdate"]=array('lt',strtotime($endTime));
            $b["f_tasktypeid"]=3;
            $businessTask = M("task")->field("f_tid")->where($b)->select();
            $businessTid = array_column($businessTask, 'f_tid');
            $businessStr = '';
            foreach($businessTid as $k=>$v) {
                if ($k == 0) {
                    $businessStr .= $v;
                }else{
                    $businessStr .= ',' . $v;
                }
            }
            $businessEndSql = "SELECT COUNT('f_indexid') AS sum , FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') AS time FROM t_taskdraw  WHERE f_drawdate>='".strtotime($startTime)."' AND f_drawdate<='".strtotime($endTime)."' AND f_taskid in(".$businessStr.") AND f_utask_status=3 GROUP BY FROM_UNIXTIME(f_drawdate,'%Y-%m-%d') ";
            $this->out_arr["EndResult"] =  M("taskdraw")->query($businessEndSql);
        }

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //获得修改的产品分类
    function addShopClass(){
        $this->getConf();//取数据
        
        $map['f_classname'] = $this->in_arr['title'];
        $map['f_classpid'] = $this->in_arr['checkValue'];

        M('shopclass')->add($map);

        $this->out_arr['result'] = '000000';
        $this->pushConf();//输出数据
    }

    //获得修改的产品分类
    function getModiClass(){
        $this->getConf();//取数据
        
        $classid = isset($this->in_arr['classid'])?$this->in_arr['classid']:0;

        if($classid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $this->out_arr['list'] = M('shopclass')->where('f_id='.$classid)->find();
            $this->out_arr['result'] = '000000';
        }
        
        return $this->out_arr;
    }

    //修改产品分类
    function modShopClass(){
        $this->getConf();//取数据
        
        $map['f_classname'] = $this->in_arr['title'];
        $map['f_classpid'] = $this->in_arr['checkValue'];
        $classid = $this->in_arr['classid'];

        M('shopclass')->where('f_id='.$classid)->save($map);
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    //删除产品分类
    function delshopclass(){
        $this->getConf();//取数据
        
        $map['f_status'] = 0;
        $classid = $this->in_arr['classid'];

        M('shopclass')->where('f_id='.$classid)->save($map);
        M('shopclass')->where('f_classpid='.$classid)->save($map);
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    function getAllClass(){

        $map['f_status'] = 1;

        $result = M('shopclass')->where($map)->select();
        $this->out_arr['list'] = $result;
        if (!empty($this->out_arr['list'])) {
            $this->out_arr['result'] = '000000';
        }else{
            $this->out_arr['result'] = '100000';
        }

        $this->pushConf();
    }

    //添加产品
    function addShopList(){

        $this->getConf();//取数据
        $map['f_lotterystatus'] = $this->in_arr['lotterystatus'];
        $map['f_shopname'] = $this->in_arr['title'];
        $map['f_cid'] = $this->in_arr['shopClassSelect'];
        $map['f_fileid'] = $this->in_arr['fileid'];
        $map['f_description'] = $this->in_arr['shopDescription'];
        $map['f_shopsum'] = $this->in_arr['shopNum'];
        $map['f_price'] = $this->in_arr['shopPrice'];
        $map['f_note'] = $this->in_arr['editor1'];
        $map['f_activename'] = $this->in_arr['checkValue'];
        $map['f_createtime'] = time();

        $id = M('shoplist')->add($map);
        $this->out_arr['result'] = '100000';

        //如果是兑换产品则产生奖号
        $lottery_re = $this->create_lottery_no($id,$this->in_arr['shopNum']);

        $this->pushConf();
    }

    function getShopList(){
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
             $page = 1;
        }

        $tabType = $this->in_arr['tabType'];
        if ($tabType == 0) {
            $total = D('shoplist')->count("f_sid");//总记录数
        }else{
            $q['f_cid'] = $tabType;
            $total = D('shoplist')->where($q)->count("f_sid");//总记录数
        }
        
        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        $f = "t_shoplist.f_sid,f_fileid,f_shopname,f_cid,f_description,f_shopsum,f_price,f_activename,t_shoplist.f_status,f_createtime,t_shopclass.f_classname,t_shopclass.f_id";
        $j = array("LEFT JOIN t_shopclass ON t_shopclass.f_id = t_shoplist.f_cid");

        if ($tabType == 0) {
            $this->out_arr['list'] = M("shoplist")->field($f)->page($page.','.$pageSize)->join($j)->order('f_createtime desc')->select();
        }else{
            $this->out_arr['list'] = M("shoplist")->field($f)->page($page.','.$pageSize)->where($q)->join($j)->order('f_createtime desc')->select();
        }
        $this->pushConf();//输出数据
    }

    public function getShopListNo() {
        $this->getConf();//取数据
        
        $pageSize = 18; //每页显示数
        
        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $tabType = $this->in_arr['tabType'];
        if ($tabType == 0) {
            $total = D('shoplist')->count("f_sid");//总记录数
        }else{
            $q['f_cid'] = $tabType;
            $total = D('shoplist')->where($q)->count("f_sid");//总记录数
        }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }


    //经销商数据列表
    function getDealer_List(){
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $map = array();

        $area=$this->in_arr['area'];
        if(!empty($area)){
            $map['t_dealerlibrary.f_area'] = array("like","%".$area."%");
        }
        $industrytype=$this->in_arr['industrytype'];
        if(!empty($industrytype)){
            $map['f_industrytype'] = $industrytype;
        }
        $dealername=$this->in_arr['dealername'];
        if(!empty($dealername)){
            $map['f_dealername'] = array("like","%".$dealername."%");
        }
        $status=$this->in_arr['status'];
        if(!empty($status)){
            $map['f_status'] = $status;
        }

        $total = D('dealerlibrary')->where($map)->count("f_indexid");//总记录数

        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        //$this->out_arr['map'] = $map;
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $list = M("dealerlibrary")->where($map)->page($page.','.$pageSize)->order('f_indexid desc')->select();
        $pageSizeNum = 3000;
        $f = "t_dealerlibrary.f_indexid,t_dealerlibrary.f_area,t_dealerlibrary.f_industrytype,t_dealerlibrary.f_dealername,t_dealerlibrary.f_channeltype,t_dealerlibrary.f_chargeperson,t_dealerlibrary.f_moblie,t_dealerlibrary.f_telPhone,t_dealerlibrary.f_fax,t_dealerlibrary.f_communadd,t_dealerlibrary.f_goodsreceiptadd,t_dealerlibrary.f_managementlife,t_dealerlibrary.f_annualturnover,t_dealerlibrary.f_logisticsqty,t_dealerlibrary.f_employeeqty,t_dealerlibrary.f_mainproduct,t_dealerlibrary.f_warehousearea,t_dealerlibrary.f_coverageqty,t_dealerlibrary.f_customerqty,t_dealerlibrary.f_dotqty,t_dealerlibrary.f_creatdate,t_dealerlibrary.f_status,t_dealerlibrary.f_note,t_dealerlibrary.f_ctime,t_dealerlibrary.f_uid,t_dealerlibrary_cause.f_desctiption";
        $j = array("LEFT JOIN t_dealerlibrary_cause ON t_dealerlibrary_cause.f_indexid = t_dealerlibrary.f_indexid");
        $list1 = M("dealerlibrary")->field($f)->where($map)->page($page.','.$pageSizeNum)->join($j)->order('t_dealerlibrary.f_indexid desc')->select();

        foreach ($list as $key => $value) {
            if (isset($value['f_area']) && !empty($value['f_area'])) {
                $list[$key]['f_area'] = trim($list[$key]['f_area']);  
                $list[$key]['f_area'] = ereg_replace("\t","",$list[$key]['f_area']);  
                $list[$key]['f_area'] = ereg_replace("\r\n","",$list[$key]['f_area']);  
                $list[$key]['f_area'] = ereg_replace("\r","",$list[$key]['f_area']);  
                $list[$key]['f_area'] = ereg_replace("\n","",$list[$key]['f_area']);
            }
            if (isset($value['f_industrytype']) && !empty($value['f_industrytype'])) {
                $list[$key]['f_industrytype'] = trim($list[$key]['f_industrytype']);  
                $list[$key]['f_industrytype'] = ereg_replace("\t","",$list[$key]['f_industrytype']);  
                $list[$key]['f_industrytype'] = ereg_replace("\r\n","",$list[$key]['f_industrytype']);  
                $list[$key]['f_industrytype'] = ereg_replace("\r","",$list[$key]['f_industrytype']);  
                $list[$key]['f_industrytype'] = ereg_replace("\n","",$list[$key]['f_industrytype']);
            }
            if (isset($value['f_dealername']) && !empty($value['f_dealername'])) {
                $list[$key]['f_dealername'] = trim($list[$key]['f_dealername']);  
                $list[$key]['f_dealername'] = ereg_replace("\t","",$list[$key]['f_dealername']);  
                $list[$key]['f_dealername'] = ereg_replace("\r\n","",$list[$key]['f_dealername']);  
                $list[$key]['f_dealername'] = ereg_replace("\r","",$list[$key]['f_dealername']);  
                $list[$key]['f_dealername'] = ereg_replace("\n","",$list[$key]['f_dealername']);
            }
            if (isset($value['f_channeltype']) && !empty($value['f_channeltype'])) {
                $list[$key]['f_channeltype'] = trim($list[$key]['f_channeltype']);  
                $list[$key]['f_channeltype'] = ereg_replace("\t","",$list[$key]['f_channeltype']);  
                $list[$key]['f_channeltype'] = ereg_replace("\r\n","",$list[$key]['f_channeltype']);  
                $list[$key]['f_channeltype'] = ereg_replace("\r","",$list[$key]['f_channeltype']);  
                $list[$key]['f_channeltype'] = ereg_replace("\n","",$list[$key]['f_channeltype']);
            }
            if (isset($value['f_chargeperson']) && !empty($value['f_chargeperson'])) {
                $list[$key]['f_chargeperson'] = trim($list[$key]['f_chargeperson']);  
                $list[$key]['f_chargeperson'] = ereg_replace("\t","",$list[$key]['f_chargeperson']);  
                $list[$key]['f_chargeperson'] = ereg_replace("\r\n","",$list[$key]['f_chargeperson']);  
                $list[$key]['f_chargeperson'] = ereg_replace("\r","",$list[$key]['f_chargeperson']);  
                $list[$key]['f_chargeperson'] = ereg_replace("\n","",$list[$key]['f_chargeperson']);
            }
            if (isset($value['f_communadd']) && !empty($value['f_communadd'])) {
                $list[$key]['f_communadd'] = trim($list[$key]['f_communadd']);  
                $list[$key]['f_communadd'] = ereg_replace("\t","",$list[$key]['f_communadd']);  
                $list[$key]['f_communadd'] = ereg_replace("\r\n","",$list[$key]['f_communadd']);  
                $list[$key]['f_communadd'] = ereg_replace("\r","",$list[$key]['f_communadd']);  
                $list[$key]['f_communadd'] = ereg_replace("\n","",$list[$key]['f_communadd']);
            }
            if (isset($value['f_goodsreceiptadd']) && !empty($value['f_goodsreceiptadd'])) {
                $list[$key]['f_goodsreceiptadd'] = trim($list[$key]['f_goodsreceiptadd']);  
                $list[$key]['f_goodsreceiptadd'] = ereg_replace("\t","",$list[$key]['f_goodsreceiptadd']);  
                $list[$key]['f_goodsreceiptadd'] = ereg_replace("\r\n","",$list[$key]['f_goodsreceiptadd']);  
                $list[$key]['f_goodsreceiptadd'] = ereg_replace("\r","",$list[$key]['f_goodsreceiptadd']);  
                $list[$key]['f_goodsreceiptadd'] = ereg_replace("\n","",$list[$key]['f_goodsreceiptadd']);
            }
            if (isset($value['f_mainproduct']) && !empty($value['f_mainproduct'])) {
                $list[$key]['f_mainproduct'] = trim($list[$key]['f_mainproduct']);  
                $list[$key]['f_mainproduct'] = ereg_replace("\t","",$list[$key]['f_mainproduct']);  
                $list[$key]['f_mainproduct'] = ereg_replace("\r\n","",$list[$key]['f_mainproduct']);  
                $list[$key]['f_mainproduct'] = ereg_replace("\r","",$list[$key]['f_mainproduct']);  
                $list[$key]['f_mainproduct'] = ereg_replace("\n","",$list[$key]['f_mainproduct']);
            }
            if (isset($value['f_note']) && !empty($value['f_note'])) {
                $list[$key]['f_note'] = trim($list[$key]['f_note']);  
                $list[$key]['f_note'] = ereg_replace("\t","",$list[$key]['f_note']);  
                $list[$key]['f_note'] = ereg_replace("\r\n","",$list[$key]['f_note']);  
                $list[$key]['f_note'] = ereg_replace("\r","",$list[$key]['f_note']);  
                $list[$key]['f_note'] = ereg_replace("\n","",$list[$key]['f_note']);
            }
        }

        foreach ($list1 as $key => $value) {
            if ($value['f_status'] == 0 || $value['f_status'] == '0') {
                $list1[$key]['f_status'] = '未联系';
            }else if($value['f_status'] == 1 || $value['f_status'] == '1') {
                $list1[$key]['f_status'] = '已接通';
            }else if($value['f_status'] == 2 || $value['f_status'] == '2') {
                $list1[$key]['f_status'] = '关机';
            }else if($value['f_status'] == 3 || $value['f_status'] == '3') {
                $list1[$key]['f_status'] = '不愿回访';
            }else if($value['f_status'] == 4 || $value['f_status'] == '4') {
                $list1[$key]['f_status'] = '空号';
            }else if($value['f_status'] == 5 || $value['f_status'] == '5') {
                $list1[$key]['f_status'] = '没人接';
            }else if($value['f_status'] == 6 || $value['f_status'] == '6') {
                $list1[$key]['f_status'] = '同事';
            }

            if (isset($value['f_area']) && !empty($value['f_area'])) {
                $list1[$key]['f_area'] = trim($list1[$key]['f_area']);  
                $list1[$key]['f_area'] = ereg_replace("\t","",$list1[$key]['f_area']);  
                $list1[$key]['f_area'] = ereg_replace("\r\n","",$list1[$key]['f_area']);  
                $list1[$key]['f_area'] = ereg_replace("\r","",$list1[$key]['f_area']);  
                $list1[$key]['f_area'] = ereg_replace("\n","",$list1[$key]['f_area']);
            }
            if (isset($value['f_industrytype']) && !empty($value['f_industrytype'])) {
                $list1[$key]['f_industrytype'] = trim($list1[$key]['f_industrytype']);  
                $list1[$key]['f_industrytype'] = ereg_replace("\t","",$list1[$key]['f_industrytype']);  
                $list1[$key]['f_industrytype'] = ereg_replace("\r\n","",$list1[$key]['f_industrytype']);  
                $list1[$key]['f_industrytype'] = ereg_replace("\r","",$list1[$key]['f_industrytype']);  
                $list1[$key]['f_industrytype'] = ereg_replace("\n","",$list1[$key]['f_industrytype']);
            }
            if (isset($value['f_dealername']) && !empty($value['f_dealername'])) {
                $list1[$key]['f_dealername'] = trim($list1[$key]['f_dealername']);  
                $list1[$key]['f_dealername'] = ereg_replace("\t","",$list1[$key]['f_dealername']);  
                $list1[$key]['f_dealername'] = ereg_replace("\r\n","",$list1[$key]['f_dealername']);  
                $list1[$key]['f_dealername'] = ereg_replace("\r","",$list1[$key]['f_dealername']);  
                $list1[$key]['f_dealername'] = ereg_replace("\n","",$list1[$key]['f_dealername']);
            }
            if (isset($value['f_channeltype']) && !empty($value['f_channeltype'])) {
                $list1[$key]['f_channeltype'] = trim($list1[$key]['f_channeltype']);  
                $list1[$key]['f_channeltype'] = ereg_replace("\t","",$list1[$key]['f_channeltype']);  
                $list1[$key]['f_channeltype'] = ereg_replace("\r\n","",$list1[$key]['f_channeltype']);  
                $list1[$key]['f_channeltype'] = ereg_replace("\r","",$list1[$key]['f_channeltype']);  
                $list1[$key]['f_channeltype'] = ereg_replace("\n","",$list1[$key]['f_channeltype']);
            }
            if (isset($value['f_chargeperson']) && !empty($value['f_chargeperson'])) {
                $list1[$key]['f_chargeperson'] = trim($list1[$key]['f_chargeperson']);  
                $list1[$key]['f_chargeperson'] = ereg_replace("\t","",$list1[$key]['f_chargeperson']);  
                $list1[$key]['f_chargeperson'] = ereg_replace("\r\n","",$list1[$key]['f_chargeperson']);  
                $list1[$key]['f_chargeperson'] = ereg_replace("\r","",$list1[$key]['f_chargeperson']);  
                $list1[$key]['f_chargeperson'] = ereg_replace("\n","",$list1[$key]['f_chargeperson']);
            }
            if (isset($value['f_communadd']) && !empty($value['f_communadd'])) {
                $list1[$key]['f_communadd'] = trim($list1[$key]['f_communadd']);  
                $list1[$key]['f_communadd'] = ereg_replace("\t","",$list1[$key]['f_communadd']);  
                $list1[$key]['f_communadd'] = ereg_replace("\r\n","",$list1[$key]['f_communadd']);  
                $list1[$key]['f_communadd'] = ereg_replace("\r","",$list1[$key]['f_communadd']);  
                $list1[$key]['f_communadd'] = ereg_replace("\n","",$list1[$key]['f_communadd']);
            }
            if (isset($value['f_goodsreceiptadd']) && !empty($value['f_goodsreceiptadd'])) {
                $list1[$key]['f_goodsreceiptadd'] = trim($list1[$key]['f_goodsreceiptadd']);  
                $list1[$key]['f_goodsreceiptadd'] = ereg_replace("\t","",$list1[$key]['f_goodsreceiptadd']);  
                $list1[$key]['f_goodsreceiptadd'] = ereg_replace("\r\n","",$list1[$key]['f_goodsreceiptadd']);  
                $list1[$key]['f_goodsreceiptadd'] = ereg_replace("\r","",$list1[$key]['f_goodsreceiptadd']);  
                $list1[$key]['f_goodsreceiptadd'] = ereg_replace("\n","",$list1[$key]['f_goodsreceiptadd']);
            }
            if (isset($value['f_mainproduct']) && !empty($value['f_mainproduct'])) {
                $list1[$key]['f_mainproduct'] = trim($list1[$key]['f_mainproduct']);  
                $list1[$key]['f_mainproduct'] = ereg_replace("\t","",$list1[$key]['f_mainproduct']);  
                $list1[$key]['f_mainproduct'] = ereg_replace("\r\n","",$list1[$key]['f_mainproduct']);  
                $list1[$key]['f_mainproduct'] = ereg_replace("\r","",$list1[$key]['f_mainproduct']);  
                $list1[$key]['f_mainproduct'] = ereg_replace("\n","",$list1[$key]['f_mainproduct']);
            }
            if (isset($value['f_note']) && !empty($value['f_note'])) {
                $list1[$key]['f_note'] = trim($list1[$key]['f_note']);  
                $list1[$key]['f_note'] = ereg_replace("\t","",$list1[$key]['f_note']);  
                $list1[$key]['f_note'] = ereg_replace("\r\n","",$list1[$key]['f_note']);  
                $list1[$key]['f_note'] = ereg_replace("\r","",$list1[$key]['f_note']);  
                $list1[$key]['f_note'] = ereg_replace("\n","",$list1[$key]['f_note']);
            }
            if (isset($value['f_desctiption']) && !empty($value['f_desctiption'])) {
                $list1[$key]['f_desctiption'] = trim($list1[$key]['f_desctiption']);  
                $list1[$key]['f_desctiption'] = ereg_replace("\t","",$list1[$key]['f_desctiption']);  
                $list1[$key]['f_desctiption'] = ereg_replace("\r\n","",$list1[$key]['f_desctiption']);  
                $list1[$key]['f_desctiption'] = ereg_replace("\r","",$list1[$key]['f_desctiption']);  
                $list1[$key]['f_desctiption'] = ereg_replace("\n","",$list1[$key]['f_desctiption']);
            }

        }

        // var_dump($list1);exit();
        session('dealerList',$list1);
        $this->out_arr['list'] = $list;
        $this->pushConf();//输出数据
    }


    public function getDealer_ListNo() {
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $map = array();

        $area=$this->in_arr['area'];
        if(!empty($area)){
            $map['f_area'] = array("like","%".$area."%");
        }
        $industrytype=$this->in_arr['industrytype'];
        if(!empty($industrytype)){
            $map['f_industrytype'] = $industrytype;
        }
        $dealername=$this->in_arr['dealername'];
        if(!empty($dealername)){
            $map['f_dealername'] = array("like","%".$dealername."%");
        }
        $status=$this->in_arr['status'];
        if(!empty($status)){
            $map['f_status'] = $status;
        }

        $total = D('dealerlibrary')->where($map)->count("f_indexid");//总记录数

        $totalPage = ceil($total/$pageSize); //总页数
        //$this->out_arr['map'] = $map;
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

    //获得修改的产品
    function getModiShop(){
        $this->getConf();//取数据
        
        $shopid = isset($this->in_arr['shopid'])?$this->in_arr['shopid']:0;

        if($shopid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $j = array("LEFT JOIN t_shopclass ON t_shopclass.f_id = t_shoplist.f_cid","LEFT JOIN t_files ON t_files.f_id = t_shoplist.f_fileid");

            $this->out_arr['list'] = M('shoplist')->field('t_shoplist.*,t_shopclass.f_classname,t_shopclass.f_id,t_files.f_filename,t_files.f_filepath,t_files.f_id as fileid')->join($j)->where('f_sid='.$shopid)->find();
            $this->out_arr['result'] = '000000';
        }
        
        return $this->out_arr;
    }

    //修改产品确认
    function updateShop(){
        $this->getConf();//取数据

        $f_sid = $this->in_arr['f_sid'];
        $map['f_lotterystatus'] = $this->in_arr['lotterystatus'];
        $map['f_shopname'] = $this->in_arr['title'];
        $map['f_cid'] = $this->in_arr['shopClassSelect'];
        $map['f_fileid'] = $this->in_arr['fileid'];
        $map['f_description'] = $this->in_arr['shopDescription'];
        $map['f_shopsum'] = $this->in_arr['shopNum'];
        $map['f_price'] = $this->in_arr['shopPrice'];
        $map['f_note'] = $this->in_arr['editor1'];
        $map['f_activename'] = $this->in_arr['checkValue'];
        $map['f_createtime'] = time();
// var_dump($map);
// var_dump($f_sid);
// exit();
        M('shoplist')->where('f_sid='.$f_sid)->save($map);
        $this->out_arr['result'] = '000000';

        //如果是兑换产品则产生奖号
        $lottery_re = $this->create_lottery_no($this->in_arr['f_sid'],$this->in_arr['shopNum']);
        
        $this->pushConf();//输出数据
    }
    //对奖公式:  (纳斯达克*100)/shopsum得出余数，再加上1000000
    //产生奖号
    function create_lottery_no($sid=0,$shopsum=0){
//        $a = 4635.99*100;
//        $b = $a - ((int)($a / $shopsum) * $shopsum) + 1000000;
//        echo $b;
        $count = M("award_serial")->where("f_shopid=".$sid)->count();
        if($count>0){
            return 0;
        }else{
            $start_sum = 1000000;
            for($i=0;$i<$shopsum;$i++){
                $sum[] = array("f_serial"=>$start_sum+$i,"f_shopid"=>$sid);
            }
            M("award_serial")->addAll($sum);
            return 1;
        }
    }


    //产品下架
    function delShop(){
        $this->getConf();//取数据
        
        $map['f_status'] = 0;
        $shopid = $this->in_arr['shopid'];

        M('shoplist')->where('f_sid='.$shopid)->save($map);
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }


    //产品上架
    function resetShop(){
        $this->getConf();//取数据
        
        $map['f_status'] = 1;
        $shopid = $this->in_arr['shopid'];

        M('shoplist')->where('f_sid='.$shopid)->save($map);
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    //兑换开奖
    function openLottery(){
        $this->getConf();//取数据
        $shopid = $this->in_arr['shopid'];
        //取份数,并记录参数和奖号
        $re = M("shoplist")->field("f_shopsum")->where("f_sid=".$shopid)->find();
        $param = $this->in_arr['param'];
        $param = (int)($param*100);
        $lotteryno = $param-((int)($param/$re["f_shopsum"])*$re["f_shopsum"])+1000000;//算奖号
        $map['f_lottery'] = $lotteryno;
        $map['f_nsdk'] = $param;
        M("shoplist")->where("f_sid=".$shopid)->save($map);
        //产生中奖
        $map_l["f_award_no"] = $lotteryno;
        $map_u["f_islottery"] = 1;
        M("own_award")->where($map_l)->save($map_u);
        $this->out_arr['result'] = '000000';
        $this->pushConf();//输出数据
    }

    public function getReturnTitle(){
        $this->getConf();//取数据

        $map['f_tid']=$this->in_arr['f_tid'];
        $re = M('task')->where($map)->find();

        $this->out_arr['f_title'] = $re['f_title'];
        $this->out_arr['f_tid'] = $re['f_tid'];
        $this->pushConf();
    }

    function  changeStatutask(){
    	$this->getConf();//取数据
		$map["f_tid"] =$this->in_arr["taskid"];
		$where['f_status']=$this->in_arr["status"];
        $re=M("task")-> where($map)->save($where);
		if($re==1){
			$this->out_arr["error_code"]="success";
		}else{
			$this->out_arr["error_code"]="fail";
        }
         $this->pushConf();//输出数据
    }

    function  cpush_auit(){
        $this->getConf();//取数据
        $map['f_totalcopies'] =$this->in_arr['pro_taskBrand'];
        $map['f_eachcoin'] =$this->in_arr['pro_taskProduct'];
        $map['f_eachscore'] =$this->in_arr['eachscore'] == "" ? 3 :$this->in_arr['eachscore'];
        $map['f_drawcopies'] = 0;
        $map['f_taskrequirements'] =html_entity_decode(stripslashes($this->in_arr['editor7']));
        $map['f_total_commisson']=$this->in_arr['total_commisson'];

        $indexid = $this->in_arr['indexid'];
        
        if ($indexid != 0) {    //编辑
            $re = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($map);
            $this->out_arr["audit_smallid"]=$indexid;
        } else { //新增
            $re = M("tasksmallinfo")->add($map);
            $this->out_arr["audit_smallid"]=$re;
        }
          $this->out_arr['error_code'] = 'success';
          $this->out_arr['error_text'] = '';
          $this->pushConf();//输出数据
    }

     function  check_auit(){
        $this->getConf();//取数据
        $map['f_taskid'] =$this->in_arr['taskid'];
        $map['f_totalcopies'] =$this->in_arr['pro_taskBrand'];
        $map['f_eachcoin'] =$this->in_arr['pro_taskProduct'];
        $map['f_eachscore'] =$this->in_arr['eachscore'] == "" ? 3 :$this->in_arr['eachscore'];
        $map['f_drawcopies'] = 0;
        $map['f_taskrequirements'] =html_entity_decode(stripslashes($this->in_arr['editor7']));
        $map['f_total_commisson']=$this->in_arr['total_commisson'];

        $indexid = $this->in_arr['indexid'];
        if ($indexid != 0) {    //编辑
            $re = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($map);
        } else { //新增
            $re = M("tasksmallinfo")->add($map);
        }
          $this->out_arr['error_code'] = 'success';
          $this->out_arr['error_text'] = '';
          $this->pushConf();//输出数据
    }

    function  check_auit_save(){
        $this->getConf();//取数据
        $taskid =$this->in_arr['taskid'];
        $map['f_taskid'] =$taskid;
        $map['f_totalcopies'] =$this->in_arr['pro_taskBrand'];
        $map['f_eachcoin'] =$this->in_arr['pro_taskProduct'];
        $map['f_eachscore'] =$this->in_arr['eachscore'] == "" ? 3 :$this->in_arr['eachscore'];
        $map['f_drawcopies'] = 0;
        $map['f_taskrequirements'] =html_entity_decode(stripslashes($this->in_arr['editor7']));
        $map['f_total_commisson']=$this->in_arr['total_commisson'];

        $indexid = $this->in_arr['indexid'];

        $where["f_tid"] = $taskid;
        $save['f_status'] = $this->in_arr["status"];
        if ($indexid != 0) {    //编辑
            $re = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($map);
            M("task")-> where($where)->save($save);
        } else { //新增
            $re = M("tasksmallinfo")->add($map);
            M("task")-> where($where)->save($save);
        }
          $this->out_arr['error_code'] = 'success';
          $this->out_arr['error_text'] = '';
          $this->pushConf();//输出数据
    }

    function getShopRecordList(){
        $this->getConf();//取数据

        $tabType = $this->in_arr['tabType'];

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $q['f_strats'] = $tabType;
        $q['f_label'] = 'shop';
        $total = D('shopsheet')->where($q)->count("f_indexid");//总记录数

        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数

        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $j = array("LEFT JOIN t_shoplist ON t_shoplist.f_sid = t_shopsheet.f_shopid");
        $this->out_arr['list'] = M('shopsheet')->field('t_shopsheet.*,t_shoplist.f_shopname')->where($q)->join($j)->select();
        foreach ($this->out_arr['list'] as $key => $value) {
            $re = A('Jhttp')->getUserinfo2($value['f_userid']);
            $arr=json_decode($re,true);
            $this->out_arr['list'][$key]['userName'] = $arr['list'];
        }
        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    public function getShopRecordListNo() {
        $this->getConf();//取数据
        $tabType = $this->in_arr['tabType'];

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $q['f_strats'] = $tabType;
        $q['f_label'] = 'shop';
        $total = D('shopsheet')->where($q)->count("f_indexid");//总记录数

        $pageSize = 18; //每页显示数
        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;

        $this->pushConf();//输出数据
    }

    public function getNoteConfirm() {
        $this->getConf();//取数据
        $phoneidlist = $this->in_arr['phoneidlist'];

        $map['f_strats'] = 1;
        $checkedlist = explode("|", $this->in_arr['checkedlist']);
        //echo count($taskids);
        for($i=0;$i<count($checkedlist);$i++){
            M('shopsheet')->where('f_indexid='.$checkedlist[$i])->save($map);
        }

        $this->out_arr['result'] = '000000';
        $this->pushConf();//输出数据
    }

    //删除角色
    public function delAdminAccess() {
            $this->getConf();//取数据
            
            $ids = explode("|", $this->in_arr['ids']);
            for($i=0;$i<count($ids);$i++){
                M('sysaccess')->where('id='.$ids[$i])->delete();

            }
            $this->out_arr['result'] = '000000';
            $this->pushConf();//输出数据
        }

    //删除用户
    public function delAdminUser() {
            $this->getConf();//取数据
            
            $ids = explode("|", $this->in_arr['ids']);
            $map['strat']=0;
            for($i=0;$i<count($ids);$i++){
                M('sysuser')->where('id='.$ids[$i])->save($map);

            }
            $this->out_arr['result'] = '000000';
            
            $this->pushConf();//输出数据

    }

      //角色增加
    public function addAdmin(){
        $this->getConf();//取数据
        
        $map['accessname'] = $this->in_arr['accessname'];
        $map['accessvalue'] = $this->in_arr['accessvalue'];
        
        M('sysaccess')->add($map);
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    //用户增加
    public function addAdminUser(){
        $this->getConf();//取数据

        $map['username'] = $this->in_arr['username'];
        $map['password'] = md5($this->in_arr['password']);
        $map['realname'] = $this->in_arr['realname'];
        $map['accessid'] = $this->in_arr['accessid'];
        $map['strat'] = 1;
        $map['plattype'] = '1|1';
        $re=M('sysuser')->add($map);
        
        $this->pushConf();//输出数据
    }


  //获得修改角色数据
    function modiAccessClass(){
        $this->getConf();//取数据
        
        $accessid = isset($this->in_arr['accessid'])?$this->in_arr['accessid']:0;

        if($accessid==0){
            $this->out_arr['result'] = '100000';
        }else{
            $re = M('sysaccess')->where('id='.$accessid)->find();
            $this->out_arr['result'] = '000000';
        }
        
        $re['accessvalue']=explode("{||}",$re['accessvalue']);
        foreach ($re['accessvalue'] as $key => $value) {
            $arr1=explode("|",$value);
            $re['accessvalue'][$key] = $arr1;
        }
        foreach ($re['accessvalue'] as $key => $value) {
            if (isset($value[1]) && !empty($value[1])) {
                $re['accessvalue'][$key][1] = explode(",",$re['accessvalue'][$key][1]);
            }
        }

        foreach ($re['accessvalue'] as $key => $value) {
            $re['accessvalue'][$key]['access'] = M('sysaccessfield')->where('f_fieldval='.$re['accessvalue'][$key][0])->find(); 
        }
        $this->out_arr['list'] = $re;
        return $this->out_arr;
    }


    //获得修改用户数据
    function modiUserData(){
        $this->getConf();//取数据
        
        $id = isset($this->in_arr['id'])?$this->in_arr['id']:0;

        if($id==0){
            $this->out_arr['result'] = '100000';
        }else{
            $re = M('sysuser')->where('id='.$id)->find();
            $this->out_arr['result'] = '000000';
        }
        $this->out_arr['list'] = $re;
        return $this->out_arr;
    }

    //修改角色
    function modiAdmin(){
        $this->getConf();//取数据
        
        $id = $this->in_arr['id'];
        $map['accessname'] = $this->in_arr['accessname'];
        $map['accessvalue'] = $this->in_arr['accessvalue'];

        M('sysaccess')->where('id='.$id)->save($map);
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    
    //修改用户
    function modiAdminUser(){
        $this->getConf();//取数据
        
        $newPassword = $this->in_arr['newPassword'];
        $id = $this->in_arr['userid'];
        $map['username'] = $this->in_arr['username'];
        if (isset($newPassword)) {
            $map['password'] = md5($newPassword);
        }
        $map['realname'] = $this->in_arr['realname'];
        $map['accessid'] = $this->in_arr['accessid'];

        M('sysuser')->where('id='.$id)->save($map);
        $this->out_arr['result'] = '000000';
        
        $this->pushConf();//输出数据
    }

    //确认用户旧密码是否正确
    function confirmPassword(){
        $this->getConf();//取数据
        
        $oldPassword = $this->in_arr['oldPassword'];
        $id = $this->in_arr['userid'];
        $result = M('sysuser')->where('id='.$id)->find();
        if ($result['password'] == md5($oldPassword)) {
            $this->out_arr['result'] = '000000';
        }else{
            $this->out_arr['result'] = '100000';
        }
        
        $this->pushConf();//输出数据
    }

    //授权用户
    public function accessAdminUser() {
            $this->getConf();//取数据
            
            $ids = explode("|", $this->in_arr['ids']);
            $map['strat']=1;
            for($i=0;$i<count($ids);$i++){
                M('sysuser')->where('id='.$ids[$i])->save($map);

            }
            $this->out_arr['result'] = '000000';
            
            $this->pushConf();//输出数据
    }
    public function reportDetail(){
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];

        $re = A('Jhttp')->getUsersByTime($startTime,$endTime,0);
        $arr=json_decode($re,true);
        $this->out_arr['userCount'] = $arr['list'];

        $result = A('Jhttp')->getUsersByTime($startTime,$endTime,1);
        $arrResult=json_decode($result,true);
        $this->out_arr['certifiedCount'] = $arrResult['list'];
        // var_dump($this->out_arr['userCount']);
        // var_dump($this->out_arr['certifiedCount']);

        $this->out_arr['result'] = '000000';

        $this->pushConf();//输出数据
    }

    //每日推广赚每日分享次数及有效获得金币数统计
    function getShareNum(){
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $start = ($page-1)*18;

        $startTime=$this->in_arr['startTime'];
        $endTime=$this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $sql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."' AND t_task.`f_tasktypeid`=1)  AS  t GROUP BY t.title,t.optiondate LIMIT ".$start.",18 ";
            $this->out_arr["list"] =  M("shopsheet")->query($sql);

            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."' AND t_task.`f_tasktypeid`=1)  AS  t GROUP BY t.title,t.optiondate ";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }else{
            $sql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."'  AND t_task.f_title LIKE '%".$taskTitle."%' AND t_task.`f_tasktypeid`=1)  AS  t GROUP BY t.title,t.optiondate LIMIT ".$start.",18";
            $this->out_arr["list"] =  M("shopsheet")->query($sql);

            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."'  AND t_task.f_title LIKE '%".$taskTitle."%' AND t_task.`f_tasktypeid`=1)  AS  t GROUP BY t.title,t.optiondate ";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }

        session("pushResult",$result);

        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['start'] = $start;
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->pushConf();//输出数据
    }


    public function getShareNumNo() {
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $startTime=$this->in_arr['startTime'];
        $endTime=$this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."' AND t_task.`f_tasktypeid`=1)  AS  t GROUP BY t.title,t.optiondate ";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }else{
            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."'  AND t_task.f_title LIKE '%".$taskTitle."%' AND t_task.`f_tasktypeid`=1)  AS  t GROUP BY t.title,t.optiondate ";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

    //每日随手赚每日分享次数及有效获得金币数统计
    function getWidelyShareNum(){
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }
        $start = ($page-1)*18;

        $startTime=$this->in_arr['startTime'];
        $endTime=$this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $sql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."' AND t_task.`f_tasktypeid` IN(2,4,5,6))  AS  t GROUP BY t.title,t.optiondate LIMIT ".$start.",18";
            $this->out_arr["list"] =  M("shopsheet")->query($sql);

            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."' AND t_task.`f_tasktypeid` IN(2,4,5,6))  AS  t GROUP BY t.title,t.optiondate";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }else{
            $sql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."'  AND t_task.f_title LIKE '%".$taskTitle."%' AND t_task.`f_tasktypeid` IN(2,4,5,6))  AS  t GROUP BY t.title,t.optiondate LIMIT ".$start.",18";
            $this->out_arr["list"] =  M("shopsheet")->query($sql);

            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."'  AND t_task.f_title LIKE '%".$taskTitle."%' AND t_task.`f_tasktypeid` IN(2,4,5,6))  AS  t GROUP BY t.title,t.optiondate ";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }

        session("wideResult",$result);

        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->pushConf();//输出数据
    }


    public function getWidelyShareNumNo() {
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $start = ($page-1)*18;
        $startTime=$this->in_arr['startTime'];
        $endTime=$this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."' AND t_task.`f_tasktypeid` IN(2,4,5,6))  AS  t GROUP BY t.title,t.optiondate";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }else{
            $allSql = "SELECT MAX(t.title) AS taskTitle,ROUND(MAX(t.eachcoin*10)) AS taskCoin, MAX(t.optiondate) AS  ctime,COUNT(t.userid) AS shareNum,ROUND(SUM(t.amount),0) AS earnCoin FROM (SELECT t_shopsheet.f_userid AS userid,t_shopsheet.f_taskid AS askid,t_task.f_title AS title,t_shopsheet.f_amount AS amount,FROM_UNIXTIME(t_shopsheet.`f_optiondate`,'%Y-%m-%d') AS  optiondate,t_tasksmallinfo.f_eachcoin AS eachcoin FROM t_shopsheet LEFT JOIN t_task  ON  t_shopsheet.`f_taskid` = t_task.`f_tid` INNER JOIN t_tasksmallinfo ON t_shopsheet.`f_taskid` = t_tasksmallinfo.f_taskid  WHERE  f_shopingtype = 1 AND t_shopsheet.`f_optiondate`>='".strtotime($startTime)."' AND t_shopsheet.`f_optiondate` <='".strtotime($endTime)."'  AND t_task.f_title LIKE '%".$taskTitle."%' AND t_task.`f_tasktypeid` IN(2,4,5,6))  AS  t GROUP BY t.title,t.optiondate ";
            $result =  M("shopsheet")->query($allSql);
            $total = count($result);
        }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

    //全部任务日分享次数统计
    function getAllTaskShare(){
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }
        $start = ($page-1)*18;

        $startTime=$this->in_arr['startTime'];
        $endTime=$this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $sql = "SELECT * FROM  (SELECT MAX(t.FTITLE) AS FTITLE,COUNT(t.USERID) AS sharecount,MAX(FDATETIME) AS FDATETIME  FROM (SELECT t2.`f_title` AS FTITLE,t1.`f_userid` AS USERID,FROM_UNIXTIME(t1.`f_datetime`, '%Y-%m-%d') AS FDATETIME FROM t_share t1,t_task t2 WHERE t1.`f_taskid` = t2.`f_tid` AND t2.`f_tasktypeid` <> 3 ) t WHERE t.USERID <>717 GROUP BY t.FTITLE,t.FDATETIME) AS t1 WHERE t1.FDATETIME>='".$startTime."' AND t1.FDATETIME<='".$endTime."' LIMIT ".$start.",18 ";
            $this->out_arr["list"] =  M("share")->query($sql);

            $allSql = "SELECT * FROM  (SELECT MAX(t.FTITLE) AS FTITLE,COUNT(t.USERID) AS sharecount,MAX(FDATETIME) AS FDATETIME  FROM (SELECT t2.`f_title` AS FTITLE,t1.`f_userid` AS USERID,FROM_UNIXTIME(t1.`f_datetime`, '%Y-%m-%d') AS FDATETIME FROM t_share t1,t_task t2 WHERE t1.`f_taskid` = t2.`f_tid` AND t2.`f_tasktypeid` <> 3 ) t WHERE t.USERID <>717 GROUP BY t.FTITLE,t.FDATETIME) AS t1 WHERE t1.FDATETIME>='".$startTime."' AND t1.FDATETIME<='".$endTime."' ";
            $result =  M("share")->query($allSql);
            $total = count($result);
        }else{
            $sql = "SELECT * FROM  (SELECT MAX(t.FTITLE) AS FTITLE,COUNT(t.USERID) AS sharecount,MAX(FDATETIME) AS FDATETIME  FROM (SELECT t2.`f_title` AS FTITLE,t1.`f_userid` AS USERID,FROM_UNIXTIME(t1.`f_datetime`, '%Y-%m-%d') AS FDATETIME FROM t_share t1,t_task t2 WHERE t1.`f_taskid` = t2.`f_tid` AND t2.`f_tasktypeid` <> 3 ) t WHERE t.USERID <>717 GROUP BY t.FTITLE,t.FDATETIME) AS t1 WHERE t1.FDATETIME>='".$startTime."' AND t1.FDATETIME<='".$endTime."' AND t1.FTITLE LIKE '%".$taskTitle."%' LIMIT ".$start.",18";
            $this->out_arr["list"] =  M("share")->query($sql);

            $allSql = "SELECT * FROM  (SELECT MAX(t.FTITLE) AS FTITLE,COUNT(t.USERID) AS sharecount,MAX(FDATETIME) AS FDATETIME  FROM (SELECT t2.`f_title` AS FTITLE,t1.`f_userid` AS USERID,FROM_UNIXTIME(t1.`f_datetime`, '%Y-%m-%d') AS FDATETIME FROM t_share t1,t_task t2 WHERE t1.`f_taskid` = t2.`f_tid` AND t2.`f_tasktypeid` <> 3 ) t WHERE t.USERID <>717 GROUP BY t.FTITLE,t.FDATETIME) AS t1 WHERE t1.FDATETIME>='".$startTime."' AND t1.FDATETIME<='".$endTime."' AND t1.FTITLE LIKE '%".$taskTitle."%'";
            $result =  M("share")->query($allSql);
            $total = count($result);
        }

        session("taskShareResult",$result);

        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->pushConf();//输出数据
    }


    public function getAllTaskShareNo() {
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        $start = ($page-1)*18;
        $startTime=$this->in_arr['startTime'];
        $endTime=$this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $allSql = "SELECT * FROM  (SELECT MAX(t.FTITLE) AS FTITLE,COUNT(t.USERID) AS sharecount,MAX(FDATETIME) AS FDATETIME  FROM (SELECT t2.`f_title` AS FTITLE,t1.`f_userid` AS USERID,FROM_UNIXTIME(t1.`f_datetime`, '%Y-%m-%d') AS FDATETIME FROM t_share t1,t_task t2 WHERE t1.`f_taskid` = t2.`f_tid` AND t2.`f_tasktypeid` <> 3 ) t WHERE t.USERID <>717 GROUP BY t.FTITLE,t.FDATETIME) AS t1 WHERE t1.FDATETIME>='".$startTime."' AND t1.FDATETIME<='".$endTime."' ";
            $result =  M("share")->query($allSql);
            $total = count($result);
        }else{
            $allSql = "SELECT * FROM  (SELECT MAX(t.FTITLE) AS FTITLE,COUNT(t.USERID) AS sharecount,MAX(FDATETIME) AS FDATETIME  FROM (SELECT t2.`f_title` AS FTITLE,t1.`f_userid` AS USERID,FROM_UNIXTIME(t1.`f_datetime`, '%Y-%m-%d') AS FDATETIME FROM t_share t1,t_task t2 WHERE t1.`f_taskid` = t2.`f_tid` AND t2.`f_tasktypeid` <> 3 ) t WHERE t.USERID <>717 GROUP BY t.FTITLE,t.FDATETIME) AS t1 WHERE t1.FDATETIME>='".$startTime."' AND t1.FDATETIME<='".$endTime."' AND t1.FTITLE LIKE '%".$taskTitle."%'";
            $result =  M("share")->query($allSql);
            $total = count($result);
        }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;

        $this->pushConf();//输出数据
    }

    //-随手赚完成情况统计
    function getWidelyFinish(){
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }
        $start = ($page-1)*18;

        // $startTime=$this->in_arr['startTime'];
        // $endTime=$this->in_arr['endTime'];
        // $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $sql = "SELECT t11.ftitle,t11.ftotalcopies,ROUND(t11.feachcoin*10,0) AS feachcoin,t11.drawqty,t12.drawqty AS finshqty,t12.drawqty*ROUND(t11.feachcoin*10,0) AS ftotalcoin FROM (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,MAX(ftotalcopies) AS ftotalcopies ,MAX(feachcoin) AS feachcoin,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid ,t_tasksmallinfo.`f_totalcopies` AS ftotalcopies,t_tasksmallinfo.`f_eachcoin`  AS feachcoin FROM `t_taskdraw`,`t_task`,t_tasksmallinfo WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND  t_task.`f_tid`=t_tasksmallinfo.`f_taskid` AND t_task.`f_tasktypeid` = 4 ) AS t GROUP BY ftitle ) AS t11 INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid FROM `t_taskdraw`,`t_task` WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND t_task.`f_tasktypeid` = 4 AND t_taskdraw.`f_utask_status` = 3  ) AS t GROUP BY ftitle ) AS t12 ON t11.ftid = t12.ftid INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle,COUNT(fuserid) AS askqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid,t_surveyanswer.`F_SUBMITUSERID` AS fuserid FROM `t_surveyanswer`,t_task WHERE t_task.`f_tid` = t_surveyanswer.`F_TASKID`) AS t GROUP BY ftitle) AS t13 ON t11.ftid = t13.ftid LIMIT ".$start.",18";
            $this->out_arr["list"] =  M("taskdraw")->query($sql);

            $allSql = "SELECT t11.ftitle,t11.ftotalcopies,ROUND(t11.feachcoin*10,0) AS feachcoin,t11.drawqty,t12.drawqty AS finshqty,t12.drawqty*ROUND(t11.feachcoin*10,0) AS ftotalcoin FROM (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,MAX(ftotalcopies) AS ftotalcopies ,MAX(feachcoin) AS feachcoin,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid ,t_tasksmallinfo.`f_totalcopies` AS ftotalcopies,t_tasksmallinfo.`f_eachcoin`  AS feachcoin FROM `t_taskdraw`,`t_task`,t_tasksmallinfo WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND  t_task.`f_tid`=t_tasksmallinfo.`f_taskid` AND t_task.`f_tasktypeid` = 4 ) AS t GROUP BY ftitle ) AS t11 INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid FROM `t_taskdraw`,`t_task` WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND t_task.`f_tasktypeid` = 4 AND t_taskdraw.`f_utask_status` = 3  ) AS t GROUP BY ftitle ) AS t12 ON t11.ftid = t12.ftid INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle,COUNT(fuserid) AS askqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid,t_surveyanswer.`F_SUBMITUSERID` AS fuserid FROM `t_surveyanswer`,t_task WHERE t_task.`f_tid` = t_surveyanswer.`F_TASKID`) AS t GROUP BY ftitle) AS t13 ON t11.ftid = t13.ftid";
            $result =  M("taskdraw")->query($allSql);
            $total = count($result);
        }else{
            $sql = "SELECT t11.ftitle,t11.ftotalcopies,ROUND(t11.feachcoin*10,0) AS feachcoin,t11.drawqty,t12.drawqty AS finshqty,t12.drawqty*ROUND(t11.feachcoin*10,0) AS ftotalcoin FROM (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,MAX(ftotalcopies) AS ftotalcopies ,MAX(feachcoin) AS feachcoin,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid ,t_tasksmallinfo.`f_totalcopies` AS ftotalcopies,t_tasksmallinfo.`f_eachcoin`  AS feachcoin FROM `t_taskdraw`,`t_task`,t_tasksmallinfo WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND  t_task.`f_tid`=t_tasksmallinfo.`f_taskid` AND t_task.`f_tasktypeid` = 4 AND t_task.`f_title` LIKE '%".$taskTitle."%' ) AS t GROUP BY ftitle ) AS t11 INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid FROM `t_taskdraw`,`t_task` WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND t_task.`f_tasktypeid` = 4 AND t_taskdraw.`f_utask_status` = 3  ) AS t GROUP BY ftitle ) AS t12 ON t11.ftid = t12.ftid INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle,COUNT(fuserid) AS askqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid,t_surveyanswer.`F_SUBMITUSERID` AS fuserid FROM `t_surveyanswer`,t_task WHERE t_task.`f_tid` = t_surveyanswer.`F_TASKID`) AS t GROUP BY ftitle) AS t13 ON t11.ftid = t13.ftid LIMIT ".$start.",18";
            $this->out_arr["list"] =  M("taskdraw")->query($sql);

            $allSql = "SELECT t11.ftitle,t11.ftotalcopies,ROUND(t11.feachcoin*10,0) AS feachcoin,t11.drawqty,t12.drawqty AS finshqty,t12.drawqty*ROUND(t11.feachcoin*10,0) AS ftotalcoin FROM (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,MAX(ftotalcopies) AS ftotalcopies ,MAX(feachcoin) AS feachcoin,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid ,t_tasksmallinfo.`f_totalcopies` AS ftotalcopies,t_tasksmallinfo.`f_eachcoin`  AS feachcoin FROM `t_taskdraw`,`t_task`,t_tasksmallinfo WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND  t_task.`f_tid`=t_tasksmallinfo.`f_taskid` AND t_task.`f_tasktypeid` = 4 AND t_task.`f_title` LIKE '%".$taskTitle."%' ) AS t GROUP BY ftitle ) AS t11 INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid FROM `t_taskdraw`,`t_task` WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND t_task.`f_tasktypeid` = 4 AND t_taskdraw.`f_utask_status` = 3  ) AS t GROUP BY ftitle ) AS t12 ON t11.ftid = t12.ftid INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle,COUNT(fuserid) AS askqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid,t_surveyanswer.`F_SUBMITUSERID` AS fuserid FROM `t_surveyanswer`,t_task WHERE t_task.`f_tid` = t_surveyanswer.`F_TASKID`) AS t GROUP BY ftitle) AS t13 ON t11.ftid = t13.ftid";
            $result =  M("taskdraw")->query($allSql);
            $total = count($result);
        }

        session("wideFinishResult",$result);

        $totalPage = ceil($total/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $total;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->pushConf();//输出数据
    }


    public function getWidelyFinishNo() {
        $this->getConf();//取数据

        $pageSize = 18; //每页显示数

        $page = $this->in_arr['page'];
        if($page==0 || $page=="" || $page==1){
            $page = 1;
        }

        // $startTime=$this->in_arr['startTime'];
        // $endTime=$this->in_arr['endTime'];
        // $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $taskTitle=$this->in_arr['taskTitle'];
        if(empty($taskTitle)){
            $allSql = "SELECT t11.ftitle,t11.ftotalcopies,ROUND(t11.feachcoin*10,0) AS feachcoin,t11.drawqty,t12.drawqty AS finshqty,t12.drawqty*ROUND(t11.feachcoin*10,0) AS ftotalcoin FROM (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,MAX(ftotalcopies) AS ftotalcopies ,MAX(feachcoin) AS feachcoin,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid ,t_tasksmallinfo.`f_totalcopies` AS ftotalcopies,t_tasksmallinfo.`f_eachcoin`  AS feachcoin FROM `t_taskdraw`,`t_task`,t_tasksmallinfo WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND  t_task.`f_tid`=t_tasksmallinfo.`f_taskid` AND t_task.`f_tasktypeid` = 4 ) AS t GROUP BY ftitle ) AS t11 INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid FROM `t_taskdraw`,`t_task` WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND t_task.`f_tasktypeid` = 4 AND t_taskdraw.`f_utask_status` = 3  ) AS t GROUP BY ftitle ) AS t12 ON t11.ftid = t12.ftid INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle,COUNT(fuserid) AS askqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid,t_surveyanswer.`F_SUBMITUSERID` AS fuserid FROM `t_surveyanswer`,t_task WHERE t_task.`f_tid` = t_surveyanswer.`F_TASKID`) AS t GROUP BY ftitle) AS t13 ON t11.ftid = t13.ftid";
            $result =  M("task")->query($allSql);
            $total = count($result);
        }else{
            $allSql = "SELECT t11.ftitle,t11.ftotalcopies,ROUND(t11.feachcoin*10,0) AS feachcoin,t11.drawqty,t12.drawqty AS finshqty,t12.drawqty*ROUND(t11.feachcoin*10,0) AS ftotalcoin FROM (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,MAX(ftotalcopies) AS ftotalcopies ,MAX(feachcoin) AS feachcoin,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid ,t_tasksmallinfo.`f_totalcopies` AS ftotalcopies,t_tasksmallinfo.`f_eachcoin`  AS feachcoin FROM `t_taskdraw`,`t_task`,t_tasksmallinfo WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND  t_task.`f_tid`=t_tasksmallinfo.`f_taskid` AND t_task.`f_tasktypeid` = 4 AND t_task.`f_title` LIKE '%".$taskTitle."%' ) AS t GROUP BY ftitle ) AS t11 INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle ,COUNT(fuserid)  AS drawqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid, t_taskdraw.`f_userid` AS fuserid FROM `t_taskdraw`,`t_task` WHERE t_taskdraw.`f_taskid` = t_task.`f_tid`  AND t_task.`f_tasktypeid` = 4 AND t_taskdraw.`f_utask_status` = 3  ) AS t GROUP BY ftitle ) AS t12 ON t11.ftid = t12.ftid INNER JOIN (SELECT MAX(ftid) AS ftid ,MAX(ftitle) AS ftitle,COUNT(fuserid) AS askqty FROM (SELECT DISTINCT  t_task.`f_title` AS  ftitle, t_task.`f_tid` AS ftid,t_surveyanswer.`F_SUBMITUSERID` AS fuserid FROM `t_surveyanswer`,t_task WHERE t_task.`f_tid` = t_surveyanswer.`F_TASKID`) AS t GROUP BY ftitle) AS t13 ON t11.ftid = t13.ftid";
            $result =  M("task")->query($allSql);
            $total = count($result);
        }

        $totalPage = ceil($total/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }

    public function linkReport() {
        $this->getConf();//取数据

        $startTime=$this->in_arr['startTime'];
        $endTime=$this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $userId = session('id');
        $re=array();

        //全部数据
        $sql0 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."'  AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $total=  M('dealerlibrary')->query($sql0);
        $re['total']=$total[0]['sum'];

        $sql = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='0' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $NoContact = M('dealerlibrary')->query($sql);
        $re['noContact'] = substr(($NoContact[0]['sum']/$total[0]['sum'])*100, 0,6).'%';
        $re['noContactNum'] = $NoContact[0]['sum'];

        $sql1 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='1' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $contact = M('dealerlibrary')->query($sql1);
        $re['contact'] = substr(($contact[0]['sum']/$total[0]['sum'])*100, 0,6).'%';
        $re['contactNum'] = $contact[0]['sum'];

        $sql2 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='2' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $shut = M('dealerlibrary')->query($sql2);
        $re['shut'] = substr(($shut[0]['sum']/$total[0]['sum'])*100, 0,6).'%';
        $re['shutNum'] = $shut[0]['sum'];

        $sql3 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='3' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $reject = M('dealerlibrary')->query($sql3);
        $re['reject'] = substr(($reject[0]['sum']/$total[0]['sum'])*100, 0,6).'%';
        $re['rejectNum'] = $reject[0]['sum'];

        $sql4 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='4' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dead = M('dealerlibrary')->query($sql4);
        $re['dead'] = substr(($dead[0]['sum']/$total[0]['sum'])*100, 0,6).'%';
        $re['deadNum'] = $dead[0]['sum'];

        $sql5 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='5' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $noAnswer = M('dealerlibrary')->query($sql5);
        $re['noAnswer'] = substr(($noAnswer[0]['sum']/$total[0]['sum'])*100, 0,6).'%';
        $re['noAnswerNum'] = $noAnswer[0]['sum'];

        $sql6 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='6' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $friend = M('dealerlibrary')->query($sql6);
        $re['friend'] = substr(($friend[0]['sum']/$total[0]['sum'])*100, 0,6).'%';
        $re['friendNum'] = $friend[0]['sum'];

        //处理后的数据
        $sql0 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."'  AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealTotal=  M('dealerlibrary')->query($sql0);
        $re['dealTotal']=$dealTotal[0]['sum'];

        $sql = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='0' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealNoContact = M('dealerlibrary')->query($sql);

        $sql1 = "SELECT COUNT(*) as sum FROM t_dealerlibrary  WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='1' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealContact = M('dealerlibrary')->query($sql1);

        $sql2 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='2' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealShut = M('dealerlibrary')->query($sql2);

        $sql3 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='3' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealReject = M('dealerlibrary')->query($sql3);

        $sql4 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='4' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealDead = M('dealerlibrary')->query($sql4);

        $sql5 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='5' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealNoAnswer = M('dealerlibrary')->query($sql5);

        $sql6 = "SELECT COUNT(*) as sum FROM t_dealerlibrary WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='6' AND t_dealerlibrary.`f_uid`='".$userId."' ";
        $dealFriend = M('dealerlibrary')->query($sql6);

        $re['dealNoContact'] = substr(($dealNoContact[0]['sum']/$dealTotal[0]['sum'])*100, 0,6).'%';
        $re['dealContact'] = substr(($dealContact[0]['sum']/$dealTotal[0]['sum'])*100, 0,6).'%';
        $re['dealShut'] = substr(($dealShut[0]['sum']/$dealTotal[0]['sum'])*100, 0,6).'%';
        $re['dealReject'] = substr(($dealReject[0]['sum']/$dealTotal[0]['sum'])*100, 0,6).'%';
        $re['dealDead'] = substr(($dealDead[0]['sum']/$dealTotal[0]['sum'])*100, 0,6).'%';
        $re['dealNoAnswer'] = substr(($dealNoAnswer[0]['sum']/$dealTotal[0]['sum'])*100, 0,6).'%';
        $re['dealFriend'] = substr(($dealFriend[0]['sum']/$dealTotal[0]['sum'])*100, 0,6).'%';

        $re['dealNoContactNum'] = $dealNoContact[0]['sum'];
        $re['dealContactNum'] = $dealContact[0]['sum'];
        $re['dealShutNum'] = $dealShut[0]['sum'];
        $re['dealRejectNum'] = $dealReject[0]['sum'];
        $re['dealDeadNum'] = $dealDead[0]['sum'];
        $re['dealNoAnswerNum'] = $dealNoAnswer[0]['sum'];
        $re['dealFriendNum'] = $dealFriend[0]['sum'];
// var_dump($re);exit();
        $this->out_arr['list'] = $re;

        $this->pushConf();//输出数据
    }


    public function getDealDetail() {
        $this->getConf();//取数据
        
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $type = $this->in_arr['type'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $userId = session('id');

        if ($type == 1 || $type =='1') {
            $sql11 = "SELECT t_dealerlibrary_cause.* FROM t_dealerlibrary LEFT JOIN t_dealerlibrary_cause ON t_dealerlibrary_cause.`f_indexid`=t_dealerlibrary.`f_indexid` WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND t_dealerlibrary.`f_status`='1' AND t_dealerlibrary.`f_uid`='".$userId."' ";
            $contact1 = M('dealerlibrary')->query($sql11);
            $this->out_arr['contactList'] = $contact1;
        }else{
            $sql11 = "SELECT t_dealerlibrary_cause.* FROM t_dealerlibrary LEFT JOIN t_dealerlibrary_cause ON t_dealerlibrary_cause.`f_indexid`=t_dealerlibrary.`f_indexid` WHERE UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)>'".strtotime($startTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<'".strtotime($endTime)."' AND UNIX_TIMESTAMP(t_dealerlibrary.`f_ctime`)<>UNIX_TIMESTAMP(t_dealerlibrary.`f_creatdate`) AND t_dealerlibrary.`f_status`='1' AND t_dealerlibrary.`f_uid`='".$userId."' ";
            $dealContact1 = M('dealerlibrary')->query($sql11);
            $this->out_arr['contactList'] = $dealContact1;
        }
        $total = count($this->out_arr['contactList']);

        $isUninstall = 0;
        $noUninstall = 0;

        $ditch1 = 0;
        $ditch2 = 0;
        $ditch3 = 0;
        $ditch4 = 0;
        $ditch5 = 0;
        $ditch6 = 0;
        $ditch7 = 0;
        $ditch8 = 0;

        $industry1 = 0;
        $industry2 = 0;
        $industry3 = 0;
        $industry4 = 0;
        $industry5 = 0;
        $industry6 = 0;
        $industry7 = 0;
        $industry8 = 0;
        $industry9 = 0;
        $industry10 = 0;
        $industry11 = 0;
        $industry12 = 0;
        $industry13 = 0;
        $industry14 = 0;
        $industry15 = 0;
        $industry16 = 0;
        $industry17 = 0;
        $industry18 = 0;
        $industry19 = 0;
        $industry20 = 0;
        $industry21 = 0;
        $industry22 = 0;
        $industry23 = 0;
        $industry24 = 0;
        $industry25 = 0;
        $industry26 = 0;
        $industry27 = 0;
        $industry28 = 0;
        $industry29 = 0;
        $industry30 = 0;
        $industry31 = 0;
        $industry32 = 0;
        $industry33 = 0;
        $industry34 = 0;

        $job1 = 0;
        $job2 = 0;
        $job3 = 0;

        $isTask = 0;
        $noTask = 0;

        $area1 = 0;
        $area2 = 0;
        $area3 = 0;
        $area4 = 0;
        $area5 = 0;
        $area6 = 0;
        $area7 = 0;
        $area8 = 0;
        $area9 = 0;
        $area10 = 0;
        $area11 = 0;
        $area12 = 0;
        $area13 = 0;
        $area14 = 0;
        $area15 = 0;
        $area16 = 0;
        $area17 = 0;
        $area18 = 0;
        $area19 = 0;
        $area20 = 0;
        $area21 = 0;
        $area22 = 0;
        $area23 = 0;
        $area24 = 0;
        $area25 = 0;
        $area26 = 0;
        $area27 = 0;
        $area28 = 0;
        $area29 = 0;
        $area30 = 0;
        $area31 = 0;
        $area32 = 0;
        $area33 = 0;
        $area34 = 0;
        $area35 = 0;

        if (!empty($this->out_arr['contactList'])) {
            foreach ($this->out_arr['contactList'] as $key => $value) {
                if (isset($value['f_id'])) {
                    if ($value['f_uninstall'] == 1 || $value['f_uninstall'] == '1') {
                        $isUninstall++;
                    }else{
                        $noUninstall++;
                    }

                    if ($value['f_ditch'] == 1 || $value['f_ditch'] == '1') {
                        $ditch1++;
                    }else if ($value['f_ditch'] == 2 || $value['f_ditch'] == '2'){
                        $ditch2++;
                    }else if ($value['f_ditch'] == 3 || $value['f_ditch'] == '3'){
                        $ditch3++;
                    }else if ($value['f_ditch'] == 4 || $value['f_ditch'] == '4'){
                        $ditch4++;
                    }else if ($value['f_ditch'] == 5 || $value['f_ditch'] == '5'){
                        $ditch5++;
                    }else if ($value['f_ditch'] == 6 || $value['f_ditch'] == '6'){
                        $ditch6++;
                    }else if ($value['f_ditch'] == 7 || $value['f_ditch'] == '7'){
                        $ditch7++;
                    }else if ($value['f_ditch'] == 8 || $value['f_ditch'] == '8'){
                        $ditch8++;
                    }

                    if ($value['f_industry'] == 1 || $value['f_industry'] == '1') {
                        $industry1++;
                    }else if ($value['f_industry'] == 2 || $value['f_industry'] == '2'){
                        $industry2++;
                    }else if ($value['f_industry'] == 3 || $value['f_industry'] == '3'){
                        $industry3++;
                    }else if ($value['f_industry'] == 4 || $value['f_industry'] == '4'){
                        $industry4++;
                    }else if ($value['f_industry'] == 5 || $value['f_industry'] == '5'){
                        $industry5++;
                    }else if ($value['f_industry'] == 6 || $value['f_industry'] == '6'){
                        $industry6++;
                    }else if ($value['f_industry'] == 7 || $value['f_industry'] == '7'){
                        $industry7++;
                    }else if ($value['f_industry'] == 8 || $value['f_industry'] == '8'){
                        $industry8++;
                    }else if ($value['f_industry'] == 9 || $value['f_industry'] == '9'){
                        $industry9++;
                    }else if ($value['f_industry'] == 10 || $value['f_industry'] == '10'){
                        $industry10++;
                    }else if ($value['f_industry'] == 11 || $value['f_industry'] == '11'){
                        $industry11++;
                    }else if ($value['f_industry'] == 12 || $value['f_industry'] == '12'){
                        $industry12++;
                    }else if ($value['f_industry'] == 13 || $value['f_industry'] == '13'){
                        $industry13++;
                    }else if ($value['f_industry'] == 14 || $value['f_industry'] == '14'){
                        $industry14++;
                    }else if ($value['f_industry'] == 15 || $value['f_industry'] == '15'){
                        $industry15++;
                    }else if ($value['f_industry'] == 16 || $value['f_industry'] == '16'){
                        $industry16++;
                    }else if ($value['f_industry'] == 17 || $value['f_industry'] == '17'){
                        $industry17++;
                    }else if ($value['f_industry'] == 18 || $value['f_industry'] == '18'){
                        $industry18++;
                    }else if ($value['f_industry'] == 19 || $value['f_industry'] == '19'){
                        $industry19++;
                    }else if ($value['f_industry'] == 20 || $value['f_industry'] == '20'){
                        $industry20++;
                    }else if ($value['f_industry'] == 21 || $value['f_industry'] == '21'){
                        $industry21++;
                    }else if ($value['f_industry'] == 22 || $value['f_industry'] == '22'){
                        $industry22++;
                    }else if ($value['f_industry'] == 23 || $value['f_industry'] == '23'){
                        $industry23++;
                    }else if ($value['f_industry'] == 24 || $value['f_industry'] == '24'){
                        $industry24++;
                    }else if ($value['f_industry'] == 25 || $value['f_industry'] == '25'){
                        $industry25++;
                    }else if ($value['f_industry'] == 26 || $value['f_industry'] == '26'){
                        $industry26++;
                    }else if ($value['f_industry'] == 27 || $value['f_industry'] == '27'){
                        $industry27++;
                    }else if ($value['f_industry'] == 28 || $value['f_industry'] == '28'){
                        $industry28++;
                    }else if ($value['f_industry'] == 29 || $value['f_industry'] == '29'){
                        $industry29++;
                    }else if ($value['f_industry'] == 30 || $value['f_industry'] == '30'){
                        $industry30++;
                    }else if ($value['f_industry'] == 31 || $value['f_industry'] == '31'){
                        $industry31++;
                    }else if ($value['f_industry'] == 32 || $value['f_industry'] == '32'){
                        $industry32++;
                    }else if ($value['f_industry'] == 33 || $value['f_industry'] == '33'){
                        $industry34++;
                    }else if ($value['f_industry'] == 0 || $value['f_industry'] == '0'){
                        $industry33++;
                    }


                    if ($value['f_job'] == 1 || $value['f_job'] == '1') {
                        $job1++;
                    }else if ($value['f_job'] == 2 || $value['f_job'] == '2'){
                        $job2++;
                    }else if ($value['f_job'] == 3 || $value['f_job'] == '3'){
                        $job3++;
                    }

                    if ($value['f_task'] == 1 || $value['f_task'] == '1') {
                        $isTask++;
                    }else{
                        $noTask++;
                    }

                    if ($value['f_area'] == 1 || $value['f_area'] == '1') {
                        $area1++;
                    }else if ($value['f_area'] == 2 || $value['f_area'] == '2'){
                        $area2++;
                    }else if ($value['f_area'] == 3 || $value['f_area'] == '3'){
                        $area3++;
                    }else if ($value['f_area'] == 4 || $value['f_area'] == '4'){
                        $area4++;
                    }else if ($value['f_area'] == 5 || $value['f_area'] == '5'){
                        $area5++;
                    }else if ($value['f_area'] == 6 || $value['f_area'] == '6'){
                        $area6++;
                    }else if ($value['f_area'] == 7 || $value['f_area'] == '7'){
                        $area7++;
                    }else if ($value['f_area'] == 8 || $value['f_area'] == '8'){
                        $area8++;
                    }else if ($value['f_area'] == 9 || $value['f_area'] == '9'){
                        $area9++;
                    }else if ($value['f_area'] == 10 || $value['f_area'] == '10'){
                        $area10++;
                    }else if ($value['f_area'] == 11 || $value['f_area'] == '11'){
                        $area11++;
                    }else if ($value['f_area'] == 12 || $value['f_area'] == '12'){
                        $area12++;
                    }else if ($value['f_area'] == 13 || $value['f_area'] == '13'){
                        $area13++;
                    }else if ($value['f_area'] == 14 || $value['f_area'] == '14'){
                        $area14++;
                    }else if ($value['f_area'] == 15 || $value['f_area'] == '15'){
                        $area15++;
                    }else if ($value['f_area'] == 16 || $value['f_area'] == '16'){
                        $area16++;
                    }else if ($value['f_area'] == 17 || $value['f_area'] == '17'){
                        $area17++;
                    }else if ($value['f_area'] == 18 || $value['f_area'] == '18'){
                        $area18++;
                    }else if ($value['f_area'] == 19 || $value['f_area'] == '19'){
                        $area19++;
                    }else if ($value['f_area'] == 20 || $value['f_area'] == '20'){
                        $area20++;
                    }else if ($value['f_area'] == 21 || $value['f_area'] == '21'){
                        $area21++;
                    }else if ($value['f_area'] == 22 || $value['f_area'] == '22'){
                        $area22++;
                    }else if ($value['f_area'] == 23 || $value['f_area'] == '23'){
                        $area23++;
                    }else if ($value['f_area'] == 24 || $value['f_area'] == '24'){
                        $area24++;
                    }else if ($value['f_area'] == 25 || $value['f_area'] == '25'){
                        $area25++;
                    }else if ($value['f_area'] == 26 || $value['f_area'] == '26'){
                        $area26++;
                    }else if ($value['f_area'] == 27 || $value['f_area'] == '27'){
                        $area27++;
                    }else if ($value['f_area'] == 28 || $value['f_area'] == '28'){
                        $area28++;
                    }else if ($value['f_area'] == 29 || $value['f_area'] == '29'){
                        $area29++;
                    }else if ($value['f_area'] == 30 || $value['f_area'] == '30'){
                        $area30++;
                    }else if ($value['f_area'] == 31 || $value['f_area'] == '31'){
                        $area31++;
                    }else if ($value['f_area'] == 32 || $value['f_area'] == '32'){
                        $area32++;
                    }else if ($value['f_area'] == 33 || $value['f_area'] == '33'){
                        $area33++;
                    }else if ($value['f_area'] == 34 || $value['f_area'] == '34'){
                        $area34++;
                    }else if ($value['f_area'] == 0 || $value['f_area'] == '0'){
                        $area35++;
                    }

                }
            }
        }


        $this->out_arr['isUninstall'] = $isUninstall;
        $this->out_arr['noUninstall'] = $noUninstall;
        $this->out_arr['isUninstallNum'] = substr(($isUninstall/$total)*100, 0,6).'%';
        $this->out_arr['noUninstallNum'] = (100-substr(($isUninstall/$total)*100, 0,6)).'%';

        $this->out_arr['ditch1'] = $ditch1;
        $this->out_arr['ditchNum1'] = substr(($ditch1/$total)*100, 0,6).'%';
        $this->out_arr['ditch2'] = $ditch2;
        $this->out_arr['ditchNum2'] = substr(($ditch2/$total)*100, 0,6).'%';
        $this->out_arr['ditch3'] = $ditch3;
        $this->out_arr['ditchNum3'] = substr(($ditch3/$total)*100, 0,6).'%';
        $this->out_arr['ditch4'] = $ditch4;
        $this->out_arr['ditchNum4'] = substr(($ditch4/$total)*100, 0,6).'%';
        $this->out_arr['ditch5'] = $ditch5;
        $this->out_arr['ditchNum5'] = substr(($ditch5/$total)*100, 0,6).'%';
        $this->out_arr['ditch6'] = $ditch6;
        $this->out_arr['ditchNum6'] = substr(($ditch6/$total)*100, 0,6).'%';
        $this->out_arr['ditch7'] = $ditch7;
        $this->out_arr['ditchNum7'] = substr(($ditch7/$total)*100, 0,6).'%';
        $this->out_arr['ditch8'] = $ditch8;
        $this->out_arr['ditchNum8'] = substr(($ditch8/$total)*100, 0,6).'%';

        $this->out_arr['industry1'] = $industry1;
        $this->out_arr['industryNum1'] = substr(($industry1/$total)*100, 0,6).'%';
        $this->out_arr['industry2'] = $industry2;
        $this->out_arr['industryNum2'] = substr(($industry2/$total)*100, 0,6).'%';
        $this->out_arr['industry3'] = $industry3;
        $this->out_arr['industryNum3'] = substr(($industry3/$total)*100, 0,6).'%';
        $this->out_arr['industry4'] = $industry4;
        $this->out_arr['industryNum4'] = substr(($industry4/$total)*100, 0,6).'%';
        $this->out_arr['industry5'] = $industry5;
        $this->out_arr['industryNum5'] = substr(($industry5/$total)*100, 0,6).'%';
        $this->out_arr['industry6'] = $industry6;
        $this->out_arr['industryNum6'] = substr(($industry6/$total)*100, 0,6).'%';
        $this->out_arr['industry7'] = $industry7;
        $this->out_arr['industryNum7'] = substr(($industry7/$total)*100, 0,6).'%';
        $this->out_arr['industry8'] = $industry8;
        $this->out_arr['industryNum8'] = substr(($industry8/$total)*100, 0,6).'%';
        $this->out_arr['industry9'] = $industry9;
        $this->out_arr['industryNum9'] = substr(($industry9/$total)*100, 0,6).'%';
        $this->out_arr['industry10'] = $industry10;
        $this->out_arr['industryNum10'] = substr(($industry10/$total)*100, 0,6).'%';
        $this->out_arr['industry11'] = $industry11;
        $this->out_arr['industryNum11'] = substr(($industry11/$total)*100, 0,6).'%';
        $this->out_arr['industry12'] = $industry12;
        $this->out_arr['industryNum12'] = substr(($industry12/$total)*100, 0,6).'%';
        $this->out_arr['industry13'] = $industry13;
        $this->out_arr['industryNum13'] = substr(($industry13/$total)*100, 0,6).'%';
        $this->out_arr['industry14'] = $industry14;
        $this->out_arr['industryNum14'] = substr(($industry14/$total)*100, 0,6).'%';
        $this->out_arr['industry15'] = $industry15;
        $this->out_arr['industryNum15'] = substr(($industry15/$total)*100, 0,6).'%';
        $this->out_arr['industry16'] = $industry16;
        $this->out_arr['industryNum16'] = substr(($industry16/$total)*100, 0,6).'%';
        $this->out_arr['industry17'] = $industry17;
        $this->out_arr['industryNum17'] = substr(($industry17/$total)*100, 0,6).'%';
        $this->out_arr['industry18'] = $industry18;
        $this->out_arr['industryNum18'] = substr(($industry18/$total)*100, 0,6).'%';
        $this->out_arr['industry19'] = $industry19;
        $this->out_arr['industryNum19'] = substr(($industry19/$total)*100, 0,6).'%';
        $this->out_arr['industry20'] = $industry20;
        $this->out_arr['industryNum20'] = substr(($industry20/$total)*100, 0,6).'%';
        $this->out_arr['industry21'] = $industry21;
        $this->out_arr['industryNum21'] = substr(($industry21/$total)*100, 0,6).'%';
        $this->out_arr['industry22'] = $industry22;
        $this->out_arr['industryNum22'] = substr(($industry22/$total)*100, 0,6).'%';
        $this->out_arr['industry23'] = $industry23;
        $this->out_arr['industryNum23'] = substr(($industry23/$total)*100, 0,6).'%';
        $this->out_arr['industry24'] = $industry24;
        $this->out_arr['industryNum24'] = substr(($industry24/$total)*100, 0,6).'%';
        $this->out_arr['industry25'] = $industry25;
        $this->out_arr['industryNum25'] = substr(($industry25/$total)*100, 0,6).'%';
        $this->out_arr['industry26'] = $industry26;
        $this->out_arr['industryNum26'] = substr(($industry26/$total)*100, 0,6).'%';
        $this->out_arr['industry27'] = $industry27;
        $this->out_arr['industryNum27'] = substr(($industry27/$total)*100, 0,6).'%';
        $this->out_arr['industry28'] = $industry28;
        $this->out_arr['industryNum28'] = substr(($industry28/$total)*100, 0,6).'%';
        $this->out_arr['industry29'] = $industry29;
        $this->out_arr['industryNum29'] = substr(($industry29/$total)*100, 0,6).'%';
        $this->out_arr['industry30'] = $industry30;
        $this->out_arr['industryNum30'] = substr(($industry30/$total)*100, 0,6).'%';
        $this->out_arr['industry31'] = $industry31;
        $this->out_arr['industryNum31'] = substr(($industry31/$total)*100, 0,6).'%';
        $this->out_arr['industry32'] = $industry32;
        $this->out_arr['industryNum32'] = substr(($industry32/$total)*100, 0,6).'%';
        $this->out_arr['industry33'] = $industry33;
        $this->out_arr['industryNum33'] = substr(($industry33/$total)*100, 0,6).'%';
        $this->out_arr['industry34'] = $industry34;
        $this->out_arr['industryNum34'] = substr(($industry34/$total)*100, 0,6).'%';

        $this->out_arr['job1'] = $job1;
        $this->out_arr['jobNum1'] = substr(($job1/$total)*100, 0,6).'%';
        $this->out_arr['job2'] = $job2;
        $this->out_arr['jobNum2'] = substr(($job2/$total)*100, 0,6).'%';
        $this->out_arr['job3'] = $job3;
        $this->out_arr['jobNum3'] = substr(($job3/$total)*100, 0,6).'%';

        $this->out_arr['isTask'] = $isTask;
        $this->out_arr['noTask'] = $noTask;
        $this->out_arr['isTaskNum'] = substr(($isTask/$total)*100, 0,6).'%';
        $this->out_arr['noTaskNum'] = (100-substr(($isTask/$total)*100, 0,6)).'%';

        $this->out_arr['area1'] = $area1;
        $this->out_arr['areaNum1'] = substr(($area1/$total)*100, 0,6).'%';
        $this->out_arr['area2'] = $area2;
        $this->out_arr['areaNum2'] = substr(($area2/$total)*100, 0,6).'%';
        $this->out_arr['area3'] = $area3;
        $this->out_arr['areaNum3'] = substr(($area3/$total)*100, 0,6).'%';
        $this->out_arr['area4'] = $area4;
        $this->out_arr['areaNum4'] = substr(($area4/$total)*100, 0,6).'%';
        $this->out_arr['area5'] = $area5;
        $this->out_arr['areaNum5'] = substr(($area5/$total)*100, 0,6).'%';
        $this->out_arr['area6'] = $area6;
        $this->out_arr['areaNum6'] = substr(($area6/$total)*100, 0,6).'%';
        $this->out_arr['area7'] = $area7;
        $this->out_arr['areaNum7'] = substr(($area7/$total)*100, 0,6).'%';
        $this->out_arr['area8'] = $area8;
        $this->out_arr['areaNum8'] = substr(($area8/$total)*100, 0,6).'%';
        $this->out_arr['area9'] = $area9;
        $this->out_arr['areaNum9'] = substr(($area9/$total)*100, 0,6).'%';
        $this->out_arr['area10'] = $area10;
        $this->out_arr['areaNum10'] = substr(($area10/$total)*100, 0,6).'%';
        $this->out_arr['area11'] = $area11;
        $this->out_arr['areaNum11'] = substr(($area11/$total)*100, 0,6).'%';
        $this->out_arr['area12'] = $area12;
        $this->out_arr['areaNum12'] = substr(($area12/$total)*100, 0,6).'%';
        $this->out_arr['area13'] = $area13;
        $this->out_arr['areaNum13'] = substr(($area13/$total)*100, 0,6).'%';
        $this->out_arr['area14'] = $area14;
        $this->out_arr['areaNum14'] = substr(($area14/$total)*100, 0,6).'%';
        $this->out_arr['area15'] = $area15;
        $this->out_arr['areaNum15'] = substr(($area15/$total)*100, 0,6).'%';
        $this->out_arr['area16'] = $area16;
        $this->out_arr['areaNum16'] = substr(($area16/$total)*100, 0,6).'%';
        $this->out_arr['area17'] = $area17;
        $this->out_arr['areaNum17'] = substr(($area17/$total)*100, 0,6).'%';
        $this->out_arr['area18'] = $area18;
        $this->out_arr['areaNum18'] = substr(($area18/$total)*100, 0,6).'%';
        $this->out_arr['area19'] = $area19;
        $this->out_arr['areaNum19'] = substr(($area19/$total)*100, 0,6).'%';
        $this->out_arr['area20'] = $area20;
        $this->out_arr['areaNum20'] = substr(($area20/$total)*100, 0,6).'%';
        $this->out_arr['area21'] = $area21;
        $this->out_arr['areaNum21'] = substr(($area21/$total)*100, 0,6).'%';
        $this->out_arr['area22'] = $area22;
        $this->out_arr['areaNum22'] = substr(($area22/$total)*100, 0,6).'%';
        $this->out_arr['area23'] = $area23;
        $this->out_arr['areaNum23'] = substr(($area23/$total)*100, 0,6).'%';
        $this->out_arr['area24'] = $area24;
        $this->out_arr['areaNum24'] = substr(($area24/$total)*100, 0,6).'%';
        $this->out_arr['area25'] = $area25;
        $this->out_arr['areaNum25'] = substr(($area25/$total)*100, 0,6).'%';
        $this->out_arr['area26'] = $area26;
        $this->out_arr['areaNum26'] = substr(($area26/$total)*100, 0,6).'%';
        $this->out_arr['area27'] = $area27;
        $this->out_arr['areaNum27'] = substr(($area27/$total)*100, 0,6).'%';
        $this->out_arr['area28'] = $area28;
        $this->out_arr['areaNum28'] = substr(($area28/$total)*100, 0,6).'%';
        $this->out_arr['area29'] = $area29;
        $this->out_arr['areaNum29'] = substr(($area29/$total)*100, 0,6).'%';
        $this->out_arr['area30'] = $area30;
        $this->out_arr['areaNum30'] = substr(($area30/$total)*100, 0,6).'%';
        $this->out_arr['area31'] = $area31;
        $this->out_arr['areaNum31'] = substr(($area31/$total)*100, 0,6).'%';
        $this->out_arr['area32'] = $area32;
        $this->out_arr['areaNum32'] = substr(($area32/$total)*100, 0,6).'%';
        $this->out_arr['area33'] = $area33;
        $this->out_arr['areaNum33'] = substr(($area33/$total)*100, 0,6).'%';
        $this->out_arr['area34'] = $area34;
        $this->out_arr['areaNum34'] = substr(($area34/$total)*100, 0,6).'%';
        $this->out_arr['area35'] = $area35;
        $this->out_arr['areaNum35'] = substr(($area35/$total)*100, 0,6).'%';

// var_dump($this->out_arr['ditchNum2']);
// var_dump($this->out_arr['ditchNum8']);
// exit();
        $this->out_arr['result'] = '000000';

        return $this->out_arr;
    }

    //用户行为列表
    public function getBehaviorList(){
        $this->getConf();//取数据
        @ini_set('memory_limit', '1024M');
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $pageSize = 18; //每页显示数
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;
        // var_dump($count);exit();
        $t = M('login_log');
        $type  = $this->in_arr['type'];

        if ($type == 0 || $type == '0') {
            $loginSql= "SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_logintime>='".strtotime($startTime)."' AND f_logintime<='".strtotime($endTime)."' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid  ";
            $loginSum= "SELECT MAX(logintime) AS TIME ,COUNT( f_userid) AS count FROM (SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_logintime>='".strtotime($startTime)."' AND f_logintime<='".strtotime($endTime)."' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid ) AS t GROUP BY t.logintime";

            $loginUserId = $t->query($loginSql);
            $this->out_arr['list']["loginUserSum"] = $t->query($loginSum);
            $this->out_arr['list']["startTime"] = strtotime($startTime);
            $this->out_arr['list']["endTime"] = strtotime($endTime);

            $re = A('Jhttp')->getUsersByTime($startTime,date('Y-m-d',strtotime($endTime)-86400),0);
            $arr=json_decode($re,true);
            $this->out_arr['list']["loginUserSum"]['regCount'] = $arr['list'];
            // var_dump($this->out_arr['list']["loginUserSum"]['regCount']);exit();
        }else if ($type == 1 || $type == '1') {
            for ($i=0; $i <$count ; $i++) { 
                if ($i==0) {
                    $sumTime = strtotime($startTime)+86400;
                }else{
                    $sumTime += 86400;
                }
                $loginSumSql = "SELECT SUM(aaa) AS total FROM (SELECT MAX(logintime) AS time ,COUNT(f_userid) AS aaa FROM (SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_logintime<='".$sumTime."' GROUP BY f_userid,FROM_UNIXTIME(f_logintime,'%Y-%m-%d') ) AS t GROUP BY t.logintime) aa ";
                $a = $t->query($loginSumSql);
                foreach ($a as $k => $v) {
                    $a[$k]["time"] = date("Y-m-d",$i*86400+strtotime($startTime));
                }
                $this->out_arr['list']["loginResult"][$i] = $a;
            }

            $re = A('Jhttp')->getUsersByTime($startTime,date('Y-m-d',strtotime($endTime)-86400),0);
            $arr=json_decode($re,true);
            $this->out_arr['list']["loginResult"]['regCount'] = $arr['list'];
        }

        $totalPage = ceil($count/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $count;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;

        $this->pushConf();//输出数据
    }

    //用户行为分页
    public function getBehaviorPage() {
        $this->getConf();//取数据
        
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $pageSize = 18; //每页显示数
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;
        
        $pageSize = 18; //每页显示数
        $totalPage = ceil($count/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }  

    public function checkReg()
    {
        $this->getConf();//取数据
        $count = $this->in_arr['count'];
        $regTime = intval($this->in_arr['regTime']);
        $regEndTime = $regTime+86400;
        @ini_set('memory_limit', '1024M');
        $list['zero'] = 0;
        $list['A'] = 0;
        $list['B'] = 0;
        $list['C'] = 0;
        $list['D'] = 0;
        $list['E'] = 0;
        $list['F'] = 0;
        $list['G'] = 0;
        $list['H'] = 0;
        $list['I'] = 0;
        $list['J'] = 0;
        $list['K'] = 0;
        $list['L'] = 0;

        $where['f_uptime'] = array(array('egt',$regTime),array('elt',$regEndTime),'and');
        // $where['f_uptime'] = array('elt',$regEndTime);
 
        $result = M("regapp")->where($where)->select();
        $udid = array_column($result,'f_udid');
        // var_dump($udid);exit();
        foreach ($udid as $key => $value) {
            switch ($value) {
                case '0':
                    $list['zero'] = $list['zero'] +1;
                    break;
                case 'A':
                    $list['A'] = $list['A'] +1;
                    break;
                case 'B':
                    $list['B'] = $list['B'] +1;
                    break;
                case 'C':
                    $list['C'] = $list['C'] +1;
                    break;
                case 'D':
                    $list['D'] = $list['D'] +1;
                    break;
                case 'E':
                    $list['E'] = $list['E'] +1;
                    break;
                case 'F':
                    $list['F'] = $list['F'] +1;
                    break;
                case 'G':
                    $list['G'] = $list['G'] +1;
                    break;
                case 'H':
                    $list['H'] = $list['H'] +1;
                    break;
                case 'I':
                    $list['I'] = $list['I'] +1;
                    break;
                case 'J':
                    $list['J'] = $list['J'] +1;
                    break;
                case 'K':
                    $list['K'] = $list['K'] +1;
                    break;
                case 'L':
                    $list['L'] = $list['L'] +1;
                    break;
                default:
                    break;
            }
        }

        $list['other'] = $count-$list['zero']-$list['A']-$list['B']-$list['C']-$list['D']-$list['E']-$list['F']-$list['G']-$list['H']-$list['I']-$list['J']-$list['K']-$list['L'];

        return $list;
    }

    public function checkAllReg()
    {
        $this->getConf();//取数据
        $count = $this->in_arr['count'];
        $regTime = intval($this->in_arr['regTime']);
        $regEndTime = $regTime+86400;

        $list['zero'] = 0;
        $list['A'] = 0;
        $list['B'] = 0;
        $list['C'] = 0;
        $list['D'] = 0;
        $list['E'] = 0;
        $list['F'] = 0;
        $list['G'] = 0;
        $list['H'] = 0;
        $list['I'] = 0;
        $list['J'] = 0;
        $list['K'] = 0;
        $list['L'] = 0;
        @ini_set('memory_limit', '1024M');
        // $where['f_uptime'] = array(array('egt',$regTime),array('elt',$regEndTime),'and');
        $where['f_uptime'] = array('elt',$regEndTime);
 
        $result = M("regapp")->where($where)->select();
        $udid = array_column($result,'f_udid');
        // var_dump($udid);exit();
        foreach ($udid as $key => $value) {
            switch ($value) {
                case '0':
                    $list['zero'] = $list['zero'] +1;
                    break;
                case 'A':
                    $list['A'] = $list['A'] +1;
                    break;
                case 'B':
                    $list['B'] = $list['B'] +1;
                    break;
                case 'C':
                    $list['C'] = $list['C'] +1;
                    break;
                case 'D':
                    $list['D'] = $list['D'] +1;
                    break;
                case 'E':
                    $list['E'] = $list['E'] +1;
                    break;
                case 'F':
                    $list['F'] = $list['F'] +1;
                    break;
                case 'G':
                    $list['G'] = $list['G'] +1;
                    break;
                case 'H':
                    $list['H'] = $list['H'] +1;
                    break;
                case 'I':
                    $list['I'] = $list['I'] +1;
                    break;
                case 'J':
                    $list['J'] = $list['J'] +1;
                    break;
                case 'K':
                    $list['K'] = $list['K'] +1;
                    break;
                case 'L':
                    $list['L'] = $list['L'] +1;
                    break;
                default:
                    break;
            }
        }

        $list['other'] = $count-$list['zero']-$list['A']-$list['B']-$list['C']-$list['D']-$list['E']-$list['F']-$list['G']-$list['H']-$list['I']-$list['J']-$list['K']-$list['L'];

        return $list;
    }

    public function checkAllBehavior()
    {
        $this->getConf();//取数据
        $startTime = $this->in_arr['startTime'];
        $count = $this->in_arr['count'];

        $list['zero'] = 0;
        $list['A'] = 0;
        $list['B'] = 0;
        $list['C'] = 0;
        $list['D'] = 0;
        $list['E'] = 0;
        $list['F'] = 0;
        $list['G'] = 0;
        $list['H'] = 0;
        $list['I'] = 0;
        $list['J'] = 0;
        $list['K'] = 0;
        $list['L'] = 0;

        @ini_set('memory_limit', '1024M');
        $loginSql= "SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_udid FROM t_login_log WHERE  f_logintime<='".$startTime."' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid ";
        $loginUserId = M('login_log')->query($loginSql);
        $udid = array_column($loginUserId,'f_udid');

        // var_dump($udid);exit();
        // var_dump($udid);exit();
        foreach ($udid as $key => $value) {
            switch ($value) {
                case '0':
                    $list['zero'] = $list['zero'] +1;
                    break;
                case 'A':
                    $list['A'] = $list['A'] +1;
                    break;
                case 'B':
                    $list['B'] = $list['B'] +1;
                    break;
                case 'C':
                    $list['C'] = $list['C'] +1;
                    break;
                case 'D':
                    $list['D'] = $list['D'] +1;
                    break;
                case 'E':
                    $list['E'] = $list['E'] +1;
                    break;
                case 'F':
                    $list['F'] = $list['F'] +1;
                    break;
                case 'G':
                    $list['G'] = $list['G'] +1;
                    break;
                case 'H':
                    $list['H'] = $list['H'] +1;
                    break;
                case 'I':
                    $list['I'] = $list['I'] +1;
                    break;
                case 'J':
                    $list['J'] = $list['J'] +1;
                    break;
                case 'K':
                    $list['K'] = $list['K'] +1;
                    break;
                case 'L':
                    $list['L'] = $list['L'] +1;
                    break;
                default:
                    break;
            }
        }

        $list['other'] = $count-$list['zero']-$list['A']-$list['B']-$list['C']-$list['D']-$list['E']-$list['F']-$list['G']-$list['H']-$list['I']-$list['J']-$list['K']-$list['L'];
// var_dump($list);exit();
        return $list;
    }

    public function checkBehavior()
    {
        $this->getConf();//取数据
        $searchTime = $this->in_arr['searchTime'];
        $startTime = $this->in_arr['startTime'];
        $endTime = $startTime+86400;
        $count = $this->in_arr['count'];

        $list['list']['zero'] = 0;
        $list['list']['A'] = 0;
        $list['list']['B'] = 0;
        $list['list']['C'] = 0;
        $list['list']['D'] = 0;
        $list['list']['E'] = 0;
        $list['list']['F'] = 0;
        $list['list']['G'] = 0;
        $list['list']['H'] = 0;
        $list['list']['I'] = 0;
        $list['list']['J'] = 0;
        $list['list']['K'] = 0;
        $list['list']['L'] = 0;

        $regTime = date("Y-m-d",$startTime);

        @ini_set('memory_limit', '1024M');
        $zerosum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='0' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $zerosumResult = M('login_log')->query($zerosum);
        $f_regtime = array_column($zerosumResult,'f_regtime');
        $list['zerosum'] = array_count_values($f_regtime);
// var_dump($list['zerosum']);exit();

        $Asum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='A' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $AsumResult = M('login_log')->query($Asum);
        $f_regtime = array_column($AsumResult,'f_regtime');
        $list['Asum'] = array_count_values($f_regtime);
// var_dump($list['Asum']);exit();

        $Bsum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='B' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $BsumResult = M('login_log')->query($Bsum);
        $f_regtime = array_column($BsumResult,'f_regtime');
        $list['Bsum'] = array_count_values($f_regtime);
// var_dump($list['Bsum']);exit();

        $Csum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='C' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $CsumResult = M('login_log')->query($Csum);
        $f_regtime = array_column($CsumResult,'f_regtime');
        $list['Csum'] = array_count_values($f_regtime);
// var_dump($list['Csum']);exit();

        $Dsum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='D' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $DsumResult = M('login_log')->query($Dsum);
        $f_regtime = array_column($DsumResult,'f_regtime');
        $list['Dsum'] = array_count_values($f_regtime);
// var_dump($list['Dsum']);exit();

        $Esum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='E' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $EsumResult = M('login_log')->query($Esum);
        $f_regtime = array_column($EsumResult,'f_regtime');
        $list['Esum'] = array_count_values($f_regtime);
// var_dump($list['Esum']);exit();
        
        $Fsum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='F' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $FsumResult = M('login_log')->query($Fsum);
        $f_regtime = array_column($FsumResult,'f_regtime');
        $list['Fsum'] = array_count_values($f_regtime);
// var_dump($list['Fsum']);exit();
        
        $Gsum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='G' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $GsumResult = M('login_log')->query($Gsum);
        $f_regtime = array_column($GsumResult,'f_regtime');
        $list['Gsum'] = array_count_values($f_regtime);
// var_dump($list['Gsum']);exit();
        
        $Hsum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='H' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $HsumResult = M('login_log')->query($Hsum);
        $f_regtime = array_column($HsumResult,'f_regtime');
        $list['Hsum'] = array_count_values($f_regtime);
// var_dump($list['Hsum']);exit();
        
        $Isum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='I' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $IsumResult = M('login_log')->query($Isum);
        $f_regtime = array_column($IsumResult,'f_regtime');
        $list['Isum'] = array_count_values($f_regtime);
// var_dump($list['Isum']);exit();
        
        $Jsum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='J' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $JsumResult = M('login_log')->query($Jsum);
        $f_regtime = array_column($JsumResult,'f_regtime');
        $list['Jsum'] = array_count_values($f_regtime);
// var_dump($list['Jsum']);exit();
        
        $Ksum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='K' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $KsumResult = M('login_log')->query($Ksum);
        $f_regtime = array_column($KsumResult,'f_regtime');
        $list['Ksum'] = array_count_values($f_regtime);
// var_dump($list['Ksum']);exit();

        $Lsum ="SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_regtime FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' AND UNIX_TIMESTAMP(f_regtime)>='".$searchTime."' AND UNIX_TIMESTAMP(f_regtime)<='".strtotime($regTime)."' AND f_udid='L' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid";
        $LsumResult = M('login_log')->query($Lsum);
        $f_regtime = array_column($LsumResult,'f_regtime');
        $list['Lsum'] = array_count_values($f_regtime);


        $loginSql= "SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid,f_udid FROM t_login_log WHERE f_logintime>='".$startTime."' AND f_logintime<='".$endTime."' GROUP BY FROM_UNIXTIME(f_logintime,'%Y-%m-%d'),f_userid ";
        $loginUserId = M('login_log')->query($loginSql);
        $udid = array_column($loginUserId,'f_udid');
        // var_dump($udid);exit();
        foreach ($udid as $key => $value) {
            switch ($value) {
                case '0':
                    $list['list']['zero'] = $list['list']['zero'] +1;
                    break;
                case 'A':
                    $list['list']['A'] = $list['list']['A'] +1;
                    break;
                case 'B':
                    $list['list']['B'] = $list['list']['B'] +1;
                    break;
                case 'C':
                    $list['list']['C'] = $list['list']['C'] +1;
                    break;
                case 'D':
                    $list['list']['D'] = $list['list']['D'] +1;
                    break;
                case 'E':
                    $list['list']['E'] = $list['list']['E'] +1;
                    break;
                case 'F':
                    $list['list']['F'] = $list['list']['F'] +1;
                    break;
                case 'G':
                    $list['list']['G'] = $list['list']['G'] +1;
                    break;
                case 'H':
                    $list['list']['H'] = $list['list']['H'] +1;
                    break;
                case 'I':
                    $list['list']['I'] = $list['list']['I'] +1;
                    break;
                case 'J':
                    $list['list']['J'] = $list['list']['J'] +1;
                    break;
                case 'K':
                    $list['list']['K'] = $list['list']['K'] +1;
                    break;
                case 'L':
                    $list['list']['L'] = $list['list']['L'] +1;
                    break;
                default:
                    break;
            }
        }

        $list['list']['other'] = $count-$list['list']['zero']-$list['list']['A']-$list['list']['B']-$list['list']['C']-$list['list']['D']-$list['list']['E']-$list['list']['F']-$list['list']['G']-$list['list']['H']-$list['list']['I']-$list['list']['J']-$list['list']['K']-$list['list']['L'];
        // $list['startTime'] = $startTime;
        // $list['endTime'] = $endTime;
// var_dump($list);exit();
        return $list;
    }
    
    //用户红包数分析
    public function getRedPacketList(){
        $this->getConf();//取数据

        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $pageSize = 18; //每页显示数
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;
        // var_dump($count);exit();

        for ($i=0; $i <$count ; $i++) {
            if ($i==0) {
                $sumTime = strtotime($endTime)-86400;
            }else{
                $sumTime -= 86400;
            }
            $time=date('Y-m-d',$sumTime);
            $newuserclaim[$i]['thistime']=$time;
            $newTime = strtotime($time);
            // var_dump($newTime);exit();

            $map['f_datetime']=array(array('egt',$newTime),array('lt',$newTime+86400),"and");
            $re=M('newuserclaim')->where($map)->count();
            $re_1=count(M('newuserclaim')->where($map)->group('f_userid')->select());
            $newuserclaim[$i]['thisinvite']=$re;
            $newuserclaim[$i]['thistransmit']=$re_1;

        }
        // var_dump($newuserclaim);exit();
        $totalPage = ceil($count/$pageSize); //总页数
        //构造数组
        $this->out_arr['page'] = $page;
        $this->out_arr['total'] = $count;
        $this->out_arr['pageSize'] = $pageSize;
        $this->out_arr['totalPage'] = $totalPage;
        $this->out_arr['list'] = $newuserclaim;

        $this->pushConf();//输出数据
    }

     //用户红包数分页
    public function getRedPacketPage() {
        $this->getConf();//取数据
        
        $page = $this->in_arr['page'];
        if($page==0 || $page==""){
            $page = 1;
        }
        $pageSize = 18; //每页显示数
        $startTime = $this->in_arr['startTime'];
        $endTime = $this->in_arr['endTime'];
        $endTime = date('Y-m-d',strtotime($endTime)+86400);
        $count = (strtotime($endTime) - strtotime($startTime))/86400 ;
        
        $totalPage = ceil($count/$pageSize); //总页数
        $this->out_arr['totalPage'] = $totalPage;
        $this->pushConf();//输出数据
    }  

    //获得用户信息
    public function getUserinfo()
    {
        $this->getConf();//取数据

        $mobile = $this->in_arr['mobile'];
        $userDetails = A('Api/Jhttp')->getUserinfo($mobile);
        $arr=json_decode($userDetails,true);
        $this->out_arr['list']= $arr['list']; 

        $this->pushConf();//输出数据
    }

    //检查是否领取过红包
    public function checkFavorable()
    {
        $this->getConf();//取数据

        $mobile = $this->in_arr['mobile'];
        $userid = $this->in_arr['userid'];

        $data["f_userid"]= $userid;
        $data["f_newmobile"]= $mobile;

        $result =M("newuserclaim")->where($data)->find();
        // var_dump($result);
        $this->out_arr['list']= $result;

        $this->pushConf();//输出数据
    }

    //添加红包
    public function add_newuserclaim()
    {
        $claim = M("newuserclaim");
        $userid = I("post.userid");
        $mobile = I("post.mobile");

        //判断mobile是否已经存在
        $re = A("Jhttp")->getUserinfo($mobile);
        $arr = json_decode($re,true);
        $errorCode = $arr['resCode'];
        if($errorCode=="000000"){
            echo "-1";
        }else{
            //判断红包是否存在
//            $s_map["f_userid"]=$userid;
            $s_map["f_newmobile"]=$mobile;
            $re_claim_count = $claim->where($s_map)->count();
//            echo $claim->getLastSql();
            if($re_claim_count){
                echo "-2";
            }else{
                $data["f_userid"]= $userid;
                $data["f_newmobile"]= $mobile;
                $data["f_datetime"]= time();
                $data["f_eachcoin"]= 2;
                $data["f_neweachcoin"]= 5;
                $result =$claim->add($data);
                echo $result;
            }
        }
    }

    //完成任务后分配金币
    //规则：,dividend_one(1分红),dividend_two(2分红)
    //1：上级拿到5%分红；2：上上级拿到1%分红；
    //userid
    public function allocation_gold($userid=0,$gold=0){
        $re = A("Api/Jhttp")->getInviteInfoByUserId($userid);
        $arr = json_decode($re,true);
        $errorCode = $arr['resCode'];
        if($errorCode=="000000"){
            $inviterId=$arr["inviterId"];
            $higherInviterId=$arr["higherInviterId"];
            if((int)$inviterId!=0){
                $gold_one = (float)$gold*0.05;
//                D('Shopsheet')->add_shopsheet('events', $inviterId, 1, 1, $gold_one, 0, 1, 0, 0);
                D('Shopsheet')->add_shopsheet('dividend_one', $inviterId, 1, 1, $gold_one, 0, 1, 0, 0);
            }
            if((int)$higherInviterId!=0){
                $gold_two = (float)$gold*0.01;
//                D('Shopsheet')->add_shopsheet('events', $higherInviterId, 1, 1, $gold_two, 0, 1, 0, 0);
                D('Shopsheet')->add_shopsheet('dividend_two', $higherInviterId, 1, 1, $gold_two, 0, 1, 0, 0);
            }
        }
    }

}


