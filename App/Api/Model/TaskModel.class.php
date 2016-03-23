<?php
/**
 * 数据库对接 of SqlModel
 *
 * @author LuoQQ
 */
namespace Api\Model;
use Think\Model;
class TaskModel extends Model {
    protected $tableName = 'task';
    //protected $trueTableName = 'my_user';
    
    
    
    public function getTaskNo($field,$companyid=0){
        $t = M($this->tableName);
        if($companyid!=0){
            $map['f_companyid']  = $companyid;
        }
        $map['f_status']  = array('neq',0);
        $map['f_tasktypeid']  = array('in',$field);
        $re = $t->where($map)->count();
        //echo $t->getLastsql();
        return $re;
    }
    
    public function getPublishTaskNo(){
        $t = M($this->tableName);

        $map['f_status']  = array('eq',3);
        $map['f_tasktypeid']  = array('eq',3);
        $re = $t->where($map)->count();
        //echo $t->getLastsql();
        return $re;
    }

    public function gettaskstratssum($userid) {
        $map['approval'] = M('taskdraw')->where('f_userid='.$userid." and f_utask_status=1")->count();
        $map['progress'] = M('taskdraw')->where('f_userid='.$userid." and f_utask_status=2")->count();
        $map['complete'] = M('taskdraw')->where('f_userid='.$userid." and f_utask_status=3")->count();
        $map['lose'] = M('taskdraw')->where('f_userid='.$userid." and f_utask_status=4")->count();
        $map['sum'] = M('taskdraw')->where('f_userid='.$userid)->count();
        
        return $map;
    }
    
    public function upWidely($userid,$taskid,$serial,$answer) {
        $map['F_TASKID'] = $taskid;
        $map['F_SUBMITUSERID'] = $userid;
        $map['F_STATUS'] = 4;
        $map['F_SUBMITDATE'] = time();
        
        $re = M('surveyanswer')->add($map);
        
        if($re>0){
            $serial_arr = explode('|', $serial);
            $answer_arr = explode('|', $answer);
            for($i=0;$i<count($serial_arr);$i++){
                $dataList[] = array('F_ANSWERID'=>$re,'F_SERIAL'=>$serial_arr[$i],'F_ANSWER'=>$answer_arr[$i]);
            }
            $re = M('surveyanswerdetail')->addAll($dataList);
            
            //修改认领状态
            $m['f_utask_status']=1;
            M('taskdraw')->where('f_taskid='.$taskid.' and f_userid='.$userid)->save($m);
        }
        
        
        return $re;
        
    }
    
    /**
     * 取数据库记录
     * @param string $field 格式：a,b,c
     * @param int $listsum 格式：2
     * @return array 返回记录数组
     */
    public function getDateList($field,$page=1,$pageSize=10,$tasktypeid=1,$userid=0,$strats=0){
        $t = M($this->tableName);
        $taskTypeId = (int)$tasktypeid;
        // var_dump($userid);
        // var_dump($area);
        // exit();
        $map['f_tasktypeid']  = array('in',$field);

        $q['f_status']  = 3;
        $re = $t->where($q)->select();
        foreach ($re as $key => $value) {
            $now=time();
            $enddate = strtotime($value['f_enddate']);
            if($now>$enddate){
                $map_2['f_status']  = 1;
                M('task')->where('f_tid='.$value['f_tid'])->save($map_2);
            }
        }
        
        if($userid!=0){
            $map_1['f_userid']  = $userid;
            if($strats!=0){
                $map_1['f_utask_status']  = $strats;//0全部状态显示(默认)，1为待审核，2为进行中，3为已完成，4为已失效
            }
            $f_1 = array("t_taskdraw.f_taskid","f_userid","f_drawdate","f_utask_status","f_title","f_description","f_tasktypeid","f_enddate","f_status",'f_totalcopies','f_drawcopies','ROUND(f_eachcoin*10) as f_eachcoin','f_eachscore','ROUND(f_unitcommission*10) as f_unitcommission');
            $j_1 = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_taskdraw.f_taskid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_taskdraw.f_taskid","LEFT JOIN t_task ON t_task.f_tid = t_taskdraw.f_taskid");
            $re = M('taskdraw')->field($f_1)->where($map_1)->join($j_1)->order('f_drawdate desc')->select();
        }else{
            $ttid = (int)$tasktypeid;

            //$map['f_status']  = array(array('neq',0),array('neq',4));
            $map['f_status']  = array('in','1,3');//显示已发布与已完成的
            $map['f_begindate'] = array("ELT",date("Y-m-d"));//比对任务开始时间
            if($ttid==1){//推广
                $f = array('f_tid','f_tasktypeid','f_creatdate','f_surveno','f_title','f_description','f_begindate','f_enddate','f_totalcopies','f_drawcopies','ROUND(f_eachcoin*10) as f_eachcoin','f_eachscore','f_harder','f_filename','f_filepath','f_taskattention','count(t_share.f_sid) as sharesum','f_status');
                $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid','LEFT JOIN t_share ON t_share.f_taskid = t_task.f_tid');
                $re = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->group('f_tid')->order('f_status desc,f_creatdate desc')->select();
            }elseif($ttid==2 || $ttid==4 || $ttid==5 || $ttid==6|| $ttid==7){//随手
                    $f = array('f_tid','f_tasktypeid','f_typename','f_creatdate','f_surveno','f_title','f_description','f_begindate','f_enddate','f_totalcopies','f_drawcopies','ROUND(f_eachcoin*10) as f_eachcoin','f_eachscore','f_harder','f_filename','f_filepath','f_taskattention','f_status');
                    $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid','LEFT JOIN t_tasktype ON t_tasktype.f_typeid = t_task.f_tasktypeid');
                    $re = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('f_status desc,f_creatdate desc')->select();
            }elseif($ttid==3){//招商
                $f = array('f_tid','f_companyid','f_creatuserid','f_tasktypeid','f_creatdate','f_surveno','f_title','f_description','f_begindate','f_enddate','f_linkman','f_linkphone','f_filename','f_filepath','ROUND(f_unitcommission*10) as f_unitcommission','f_taskattention','f_status');
                $j = array('LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid','LEFT JOIN t_taskmtareaqty ON t_taskmtareaqty.f_taskid = t_task.f_tid','LEFT JOIN t_tradetype ON t_tradetype.f_tradeID = t_taskmtbaseinfo.f_tradeid');
                $re = $t->field($f)->where($map)->page($page.','.$pageSize)->join($j)->order('f_status desc,f_creatdate desc')->select();
            }

            // echo $t->getLastsql();
        }
        //$re['f_taskattention'] = 0;
        //echo $t->getLastsql();
        return $re;
    }
    
//    public function getHomeDateList($hometask) {
//        $t = M($this->tableName);
//        $map['f_hometask']  = $hometask;
//        //,'f_filename','f_filepath'
//        $f = array('f_tid','f_companyid','f_creatuserid','f_tasktypeid','f_creatdate','f_surveno','f_title','f_description','f_begindate','f_enddate','f_linkman','f_linkphone','f_totalcopies','f_drawcopies','f_eachcoin','f_eachscore');
//        $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid');
//        $re = $t->field($f)->where($map)->join($j)->find();
//        //echo $t->getLastsql();
//        return $re;
//    }
    
    public function getHomeDateList($hometask) {
        $t = M($this->tableName);
        $map['f_hometask']  = $hometask;
        $map['f_status'] = 3;
        //,'f_filename','f_filepath'
        $f = array('f_tid','f_title','f_filename','f_filepath','f_companyid');
        $j = array('LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid_ban');
        $re = $t->field($f)->where($map)->join($j)->order('f_creatdate desc')->select();
        //echo $t->getLastsql();
        return $re;
    }
    
    //取任务详情
    public function getDateNote($F_ID,$TYPE_LABEL,$USERID=0){
        $t = M($this->tableName);
        $t->where('f_tid='.$F_ID)->setInc('f_taskattention');//打开详情选+1关注
        $map['f_tid']  = $F_ID;
        if($TYPE_LABEL=="business"){//招商赚
            $f = array('f_companyid','f_tid','f_title','f_begindate','f_enddate','f_linkman','f_description','t_task.f_status','ROUND(f_unitcommission*10) as f_unitcommission','t_fi.f_filename','t_fi.f_filepath','t_f.f_filename as f_logo','t_f.f_filepath as f_logopath','f_tradeid','f_taskattention','f_utask_status');
            $j = array('LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files as t_fi ON t_fi.f_id = t_task.f_fileid_ban','LEFT JOIN t_files as t_f ON t_f.f_id = t_task.f_fileid','LEFT JOIN t_taskdraw ON t_taskdraw.f_taskid=t_task.f_tid and t_taskdraw.f_userid='.$USERID);
        }elseif($TYPE_LABEL=="widely"){//随手赚
            $f = array('f_companyid','f_tid','f_tasktypeid','f_creatdate','f_surveno','f_title','f_description','t_task.f_status','f_begindate','f_enddate','f_totalcopies','f_drawcopies','ROUND(f_eachcoin*10) as f_eachcoin','f_eachscore','f_harder','f_taskattention','f_utask_status','f_filename as f_logo','f_filepath as f_logopath');
            $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid','LEFT JOIN t_taskdraw ON t_taskdraw.f_taskid=t_task.f_tid and t_taskdraw.f_userid='.$USERID);
            //$a['f_auditdays'] = 0;
        }elseif($TYPE_LABEL=="push"){//推广赚
            //$map['f_userid']  = $USERID;
            $f = array('f_companyid','f_tid','f_tasktypeid','f_creatdate','f_surveno','f_title','f_description','t_task.f_status','f_begindate','f_enddate','f_totalcopies','f_drawcopies','ROUND(f_eachcoin*10) as f_eachcoin','f_eachscore','f_harder','f_taskattention','f_filename as f_logo','f_filepath as f_logopath');
            $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid');
        }
        $re = $t->field($f)->where($map)->join($j)->find();
        if (isset($re['f_description']) && !empty($re['f_description'])) {
            $re['f_description'] = trim($re['f_description']);  
            $re['f_description'] = ereg_replace("\t","",$re['f_description']);  
            $re['f_description'] = ereg_replace("\r\n","",$re['f_description']);  
            $re['f_description'] = ereg_replace("\r","",$re['f_description']);  
            $re['f_description'] = ereg_replace("\n","",$re['f_description']);
        }
        if (isset($re['f_taskrequirements']) && !empty($re['f_taskrequirements'])) {
            $re['f_taskrequirements'] = trim($re['f_taskrequirements']);  
            $re['f_taskrequirements'] = ereg_replace("\t","",$re['f_taskrequirements']);  
            $re['f_taskrequirements'] = ereg_replace("\r\n","",$re['f_taskrequirements']);  
            $re['f_taskrequirements'] = ereg_replace("\r","",$re['f_taskrequirements']);  
            $re['f_taskrequirements'] = ereg_replace("\n","",$re['f_taskrequirements']);
        }
        if (isset($re['f_note']) && !empty($re['f_note'])) {
            $re['f_note'] = trim($re['f_note']);  
            $re['f_note'] = ereg_replace("\t","",$re['f_note']);  
            $re['f_note'] = ereg_replace("\r\n","",$re['f_note']);  
            $re['f_note'] = ereg_replace("\r","",$re['f_note']);  
            $re['f_note'] = ereg_replace("\n","",$re['f_note']);
        }
        //echo $t->getLastsql();
        $re['f_auditdays'] = 7;
        $url = "?type_label=".$TYPE_LABEL."&taskid=".$F_ID."&invitationCode=";
        $re['taskinfourl'] = C('WebUrl').U('mobileweb/index/index'.$url);
        $re['taskinfoshareurl'] = C('WebUrl').U('mobileweb/index/infoshare').$url;
        if ($TYPE_LABEL=="business") {
            $re['infoUrl'] = C('WebUrl').U('mobileweb/index/info'.$url);
        }

//        $smsurl = "?type_label=".$TYPE_LABEL."&taskid=".$F_ID."&udid=sms";
//        $re['smsurl'] = C('WebUrl').U('mobileweb/index/sms'.$smsurl);
        //$re['f_taskattention'] = 0;
        return $re;
    }
    
    
    //随手赚问题和答案
    //->field('F_PROBLEMTATILE,F_TYPE,F_OPTIONS')
    public function getDateQ($F_ID){
        $t = M('surveytaskdetail');
        $re = $t->where('F_TASKID='.$F_ID)->select();
        return $re;
    }
    
    
    //============================创建任务==============================================
    public function add_one($paletid,$status,$tasktypeid,$creatuserid,$fileid,$fileid_ban,$companyId,$title,$startdate,$enddate,$linkman,$linkphone,$taskid,$harder,$description){
        $t = M($this->tableName);

        //echo $taskid;
        //exit;
        if($taskid==0){ //增加
            $map['f_creatuserid']=$creatuserid;
            $map['f_paletid']=$paletid;
            $map['f_companyid']=$companyId;
            $map['f_tasktypeid']=$tasktypeid;
            $map['f_creatdate']=time();
            //订单号的规则：年月日(时间戳10)+类型(1)+随机数(7)
            $map['f_surveno']=time().$tasktypeid.rand(1000000, 9999999);
            $map['f_title']=$title;
            $map['f_fileid']=$fileid;
            $map['f_fileid_ban']=$fileid_ban;
            $map['f_begindate']=$startdate;
            $map['f_enddate']=$enddate;
            $map['f_linkman']=$linkman;
            $map['f_linkphone']=$linkphone;
            $map['f_status']=$status;
            $map['f_harder']=$harder;
            $map['f_description']=$description;

            //新增入库
            $result = $t->add($map);

            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_taskid'] = $result;  //任务id
            $log['f_datetime'] = time();
            if( $tasktypeid == 3) {  //招商赚
                $log['f_action'] = "招商任务新增第一步";  //操作说明
            }else if( $tasktypeid == 1 ){
                $log['f_action'] = "推广赚新增";
            }else if( $tasktypeid == 7 ){
                $log['f_action'] = "督查赚新增";
            }else {
                $log['f_action'] = "随手赚新增第一步";
            }
            M('action_log')->add($log);

            return $result;
        }else{  //编辑
            $map['f_creatuserid']=$creatuserid;
            $map['f_paletid']=$paletid;
            $map['f_companyid']=$companyId;
            $map['f_tasktypeid']=$tasktypeid;
            //$map['f_creatdate']=time();
            //订单号的规则：年月日(时间戳10)+类型(1)+随机数(7)
            //$map['f_surveno']=time().$tasktypeid.rand(1000000, 9999999);
            $map['f_title']=$title;
            $map['f_fileid']=$fileid;
            $map['f_fileid_ban']=$fileid_ban;
            $map['f_begindate']=$startdate;
            $map['f_enddate']=$enddate;
            $map['f_linkman']=$linkman;
            $map['f_linkphone']=$linkphone;
            $map['f_harder']=$harder;
            $map['f_status']=$status;
            $map['f_description']=$description;

            //编辑入库
            $t->where('f_tid='.$taskid)->save($map);

            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            if( $tasktypeid == 3) {  //招商赚
                $log['f_action'] = "招商任务编辑第一步";  //操作说明
            }else if($tasktypeid == 1 ){
                $log['f_action'] = "推广赚编辑";
            }else{
                $log['f_action'] = "随手赚编辑第一步";
            }
            M('action_log')->add($log);

            //$map['f_status']=2;
            return $taskid;
        }
    }

    //============================创建任务==============================================
    public function add_bone($paletid,$status,$tasktypeid,$creatuserid,$companyId,$title,$startdate,$enddate,$linkman,$linkphone,$taskid,$harder,$description){
        $t = M($this->tableName);
        if($taskid==0){ //增加
            $map['f_creatuserid']=$creatuserid;
            $map['f_paletid']=$paletid;
            $map['f_companyid']=$companyId;
            $map['f_tasktypeid']=$tasktypeid;
            $map['f_creatdate']=time();
            //订单号的规则：年月日(时间戳10)+类型(1)+随机数(7)
            $map['f_surveno']=time().$tasktypeid.rand(1000000, 9999999);
            $map['f_title']=$title;
            $map['f_begindate']=$startdate;
            $map['f_enddate']=$enddate;
            $map['f_linkman']=$linkman;
            $map['f_linkphone']=$linkphone;
            $map['f_status']=$status;
            $map['f_harder']=$harder;
            $map['f_description']=$description;

            //新增入库
            $result = $t->add($map);

            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_taskid'] = $result;  //任务id
            $log['f_datetime'] = time();
            $log['f_action'] = "招商任务新增第一步";  //操作说明
            M('action_log')->add($log);

            return $result;
        }else{  //编辑
            $map['f_creatuserid']=$creatuserid;
            $map['f_paletid']=$paletid;
            $map['f_companyid']=$companyId;
            $map['f_title']=$title;
            $map['f_begindate']=$startdate;
            $map['f_enddate']=$enddate;
            $map['f_linkman']=$linkman;
            $map['f_linkphone']=$linkphone;
            $map['f_harder']=$harder;
            $map['f_status']=$status;
            $map['f_description']=$description;

            //编辑入库
            return $t->where('f_tid='.$taskid)->save($map);

            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            $log['f_action'] = "招商任务编辑第一步";  //操作说明
            M('action_log')->add($log);
        }
    }
    
    //============================添加任务基本信息==============================================
    public function add_two($taskid,$mtbrand,$mtgoods,$tradeid,$payment,$bond,$franchise,$otherprice,$pricesum,$commission,$agents_commission,$indexid,$shuiw_commission,$shangw_commission,$tuig_commission,$piny_commission,$whprovidetrial,$trialnum,$whpaid,$trialprice) {
        $t = M('taskmtbaseinfo');
        $map['f_taskid'] = $taskid;
        $map['f_mtbrand'] = $mtbrand;
        $map['f_mtgoods'] = $mtgoods;
        $map['f_tradeid'] = $tradeid;
        $map['f_unitfirstAmount'] = $payment;
        $map['f_unitcashdeposit'] = $bond;
        $map['f_unitfranchisefee'] = $franchise;
        $map['f_unitotheramount'] = $otherprice;
        $map['f_unittotalamount'] = $pricesum;
        $map['f_unitcommission'] = $agents_commission;
        $map['f_unitpreownedgold'] = $commission;
        $map['f_shuiw_commission']=$shuiw_commission;
        $map['f_shangw_commission']=$shangw_commission;
        $map['f_tuig_commission']=$tuig_commission;
        $map['f_piny_commission']=$piny_commission;
        $map['f_tryout']= $whprovidetrial;
        $map['f_tryoutnumber']= $trialnum;
        $map['f_payment']= $whpaid;
        $map['f_paymentmoney']= $trialprice;
        if($indexid!=0){  //编辑
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['action'] = "招商任务编辑第二步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            cookie('business_indexid', $indexid);
            return $t->where('f_indexid='.$indexid)->save($map);
        }else{ //新增
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务新增第二步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            $re = $t->add($map);
            cookie('business_indexid', $re);
            return $re;
        }
    }

    public function add_btwo($taskid,$indexid,$payment,$bond,$franchise,$otherprice,$pricesum,$agents_commission,$shuiw_commission,$shangw_commission,$tuig_commission,$piny_commission,$commission,$totalcommission,$tryout,$tryoutNumber,$testPayment,$paymentMoney) {
        $t = M('taskmtbaseinfo');
        $map['f_unitfirstAmount'] = $payment;
        $map['f_unitcashdeposit'] = $bond;
        $map['f_unitfranchisefee'] = $franchise;
        $map['f_unitotheramount'] = $otherprice;
        $map['f_unittotalamount'] = $pricesum;
        $map['f_unitcommission'] = $agents_commission;
        $map['f_unitpreownedgold'] = $commission;
        $map['f_shuiw_commission']=$shuiw_commission;
        $map['f_shangw_commission']=$shangw_commission;
        $map['f_tuig_commission']=$tuig_commission;
        $map['f_piny_commission']=$piny_commission;
        $map['f_totalcommission']=$totalcommission;
        $map['f_tryout']=$tryout;
        $map['f_tryoutnumber']=$tryoutNumber;
        $map['f_payment']=$testPayment;
        $map['f_paymentmoney']=$paymentMoney;
        // var_dump($indexid);
        if($indexid!=0){  //编辑
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['action'] = "招商任务编辑第二步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            return $t->where('f_indexid='.$indexid)->save($map);
            
        }else{ //新增
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务新增第二步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            $re = $t->where('f_taskid='.$taskid)->select();

            if (count($re)) {
                $t->where('f_taskid='.$taskid)->save($map);
            }
            return $re['f_indexid'];
        }
    }
    //============================添加区域及数量==============================================
    public function addArea($area,$qty,$taskid) {
        $t = M('taskmtareaqty');
        $map['f_taskid'] = $taskid;
        $map['f_area'] = $area;
        $map['f_qty'] = $qty;

        //操作记录入库
        $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
        $log['f_action'] = "招商任务新增区域";  //操作说明
        $log['f_taskid'] = $taskid;  //任务id
        $log['f_datetime'] = time();
        M('action_log')->add($log);

        return $t->add($map);
    }
    //============================获取区域及数量==============================================
    public function getArea($taskid) {
        $t = M('taskmtareaqty');
        return $t->where('f_taskid='.$taskid)->select();
    }
    //============================删除区域及数量==============================================
    public function deteArea($areaId){
        //操作记录入库
        $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");  //操作人id
        $log['f_action'] = "招商任务删除区域";  //操作说明
        $log['f_taskid'] = $_COOKIE['now_taskid'];  //任务id
        $log['f_datetime'] = time();
        M('action_log')->add($log);

        $t=M('taskmtareaqty');
        return $t->where('f_indexid='.$areaId)->delete();
    }
    
    //============================添加区域及数量==============================================
    public function addPro($goodsname,$modle,$unit,$agencyprice,$sellingprice,$saleprice,$taskid) {
        $t = M('taskmtgoodsdetail');
        $map['f_taskid'] = $taskid;
        $map['f_goodsname'] = $goodsname;
        $map['f_modle'] = $modle;
        $map['f_unit'] = $unit;
        $map['f_agencyprice'] = $agencyprice;
        $map['f_sellingprice'] = $sellingprice;
        $map['f_saleprice'] = $saleprice;
        return $t->add($map);
    }
    //============================获取区域及数量==============================================
    public function getPro($taskid) {
        $t = M('taskmtgoodsdetail');
        return $t->where('f_taskid='.$taskid)->select();
    }

    
    //============================删除区域及数量==============================================
     
    public function detePro($proId){
        $t = M('taskmtgoodsdetail');
        return $t->where('f_indexid='.$proId)->delete();
    }
    
    //============================添加附件==================================================
    public function addFiles($taskid,$file1,$file2,$file3,$file4,$file5,$file6,$file7,$file8,$indexid){
        $t=M('taskmtattach');
        $map['f_fileid1'] = $file1;
        $map['f_fileld2'] = $file2;
        $map['f_fileid3'] = $file3;
        $map['f_fileid4'] = $file4;
        $map['f_fileid5'] = $file5;
        $map['f_fileid6'] = $file6;
        $map['f_fileid7'] = $file7;
        $map['f_fileid8'] = $file8;
        $map['f_taskid'] = $taskid;
        if($indexid!=0){
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务编辑完成";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            return $t->where('f_indexid='.$indexid)->save($map);
        }else{
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务新增完成";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            return $t->add($map);
        }
    }

    public function addbfour($taskid,$file1,$file2,$file3,$file4,$file5,$file6,$file7,$file8,$indexid){
        $t=M('taskmtattach');
        $map['f_fileid1'] = $file1;
        $map['f_fileld2'] = $file2;
        $map['f_fileid3'] = $file3;
        $map['f_fileid4'] = $file4;
        $map['f_fileid5'] = $file5;
        $map['f_fileid6'] = $file6;
        $map['f_fileid7'] = $file7;
        $map['f_fileid8'] = $file8;
        $map['f_taskid'] = $taskid;

        if($indexid!=0){
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务编辑完成";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            return $t->where('f_indexid='.$indexid)->save($map);
        }else{
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务新增完成";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            return $t->add($map);
        }
    }





    //============================获取任务详情==============================================
    public function add_four($taskid,$brandlocation,$slogan,$sellingpoint,$targetgroup,$distributorsrequir,$retailoutlets,$channelpolicy,$note,$product,$tindexid,$company_note) {
        $t = M('taskmtdetailedinfo');
        $map['f_taskid'] = $taskid;
        $map['f_brandlocation'] = $brandlocation;
        $map['f_slogan'] = $slogan;
        $map['f_sellingpoint'] = $sellingpoint;
        $map['f_targetgroup'] = $targetgroup;
        $map['f_distributorsrequir'] = $distributorsrequir;
        $map['f_retailoutlets'] = $retailoutlets;
        $map['f_channelpolicy'] = $channelpolicy;
        $map['f_note'] = $note;
        $map['f_product']=$product;
        $map['f_company_note']=$company_note;

        if($tindexid=="0"){
            $re=$t->add($map);

            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务新增第四步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();

            M('action_log')->add($log);

            cookie('business_four_indexid', $re);
            return $re;
        }else{
            cookie('business_four_indexid', $tindexid);

            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");  //操作人id
            $log['f_action'] = "招商任务编辑第四步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            return $t->where('f_indexid='.$tindexid)->save($map);
        }
    }

public function add_bthree($taskid,$brandlocation,$slogan,$sellingpoint,$targetgroup,$distributorsrequir,$retailoutlets,$channelpolicy,$note,$product,$tindexid,$company_note) {
        $t = M('taskmtdetailedinfo');
        $map['f_taskid'] = $taskid;
        $map['f_brandlocation'] = $brandlocation;
        $map['f_slogan'] = $slogan;
        $map['f_sellingpoint'] = $sellingpoint;
        $map['f_targetgroup'] = $targetgroup;
        $map['f_distributorsrequir'] = $distributorsrequir;
        $map['f_retailoutlets'] = $retailoutlets;
        $map['f_channelpolicy'] = $channelpolicy;
        $map['f_note'] = $note;
        $map['f_product']=$product;
        $map['f_company_note']=$company_note;

        if($tindexid=="0"){
            $re=$t->add($map);

            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");   //操作人id
            $log['f_action'] = "招商任务新增第四步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();

            M('action_log')->add($log);

            return $re;
        }else{
            //操作记录入库
            $log['f_userid'] = cookie("userId")==''?session("id"):cookie("userId");  //操作人id
            $log['f_action'] = "招商任务编辑第四步";  //操作说明
            $log['f_taskid'] = $taskid;  //任务id
            $log['f_datetime'] = time();
            M('action_log')->add($log);

            return $t->where('f_indexid='.$tindexid)->save($map);
        }
    }
}

