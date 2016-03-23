<?php
namespace Mobileweb\Controller;
use Think\Controller;
class IndexController extends Controller {

    //运营注册协议
    public function yyreginfo(){
        set_theme();
        $this->display();
    }

    public function index(){
        set_theme();
        $re = $this->getTaskInfo();
        $this->assign('taskinfo', $re);
        $this->assign('weburl',C('WebUrl'));
        $this->display();
    }

    public function company_info(){
        set_theme();
        $re = $this->getTaskInfo();
        $this->assign('taskinfo', $re);
        $this->assign('weburl',C('WebUrl'));
        $this->display();
    }

    public function sms(){
        set_theme();

        $map['udid'] = 'sms';
        $map['taskid'] = I('taskid');
        $map['time'] = time();
        M('sms')->add($map);

        $re = $this->getTaskInfo();
        $this->assign('taskinfo', $re);
        $this->assign('weburl',C('WebUrl'));
        $this->display();
    } 

    public function infoshare(){
        set_theme();
        $re = $this->getTaskInfo();
        $this->assign('taskinfo', $re);
        $this->assign('weburl',C('WebUrl'));
        $invitationCode = I('get.invitationCode');
        $this->assign('invitationCode', $invitationCode);
        $this->display();
    }
    
    public function invite() {
        set_theme();
        if (IS_POST) 
        {
            $userid = I("post.userid");
            $mobile = I("post.mobile");
            $data["f_userid"]= $userid;
            $data["f_newmobile"]= $mobile;
            $data["f_datetime"]= time();
            $data["f_eachcoin"]= 2;
            $data["f_neweachcoin"]= 5;
            $result =M("newuserclaim")->add($data);
        }else{
            $invitationCode = I('get.invitationCode');
            $this->assign('invitationCode', $invitationCode);
            $re = A("Api/Jhttp")->getInvitationCode($invitationCode);
            $arr = json_decode($re,true);
            $userid = $arr["inviterId"];
            $this->assign('userid', $userid);
        }
        $this->display();
    }
    
    public function help() {
        set_theme();
        $this->display();
    }
    
    public function download() {
        set_theme();
        $this->display();
    }

    public function info(){
        set_theme();
        $re = $this->getTaskInfo();
        $this->assign('taskinfo', $re);
        $this->assign('weburl',C('WebUrl'));
        $invitationCode = I('get.invitationCode');
        $this->assign('invitationCode', $invitationCode);
        $this->display();
    }

    function agreement(){
        set_theme();
        $this->display();
    }

    function standard(){
        set_theme();
        $this->display();
    }

    //手机
    function getTaskInfo() {
    $in_arr = $_GET;
    $map['f_tid']=$in_arr['taskid'];
    $t = M('task');
    if($in_arr['type_label']=="business"){
        $f = "f_tid,f_title,f_tasktypeid,f_mtbrand,f_mtgoods,t_taskmtbaseinfo.f_tradeid,f_unitfirstAmount,f_unitcashdeposit,f_unitfranchisefee,f_unitotheramount,f_unittotalamount,f_unitcommission,f_unitpreownedgold,";
        $f .="f_brandlocation,f_slogan,f_sellingpoint,f_targetgroup,f_pricelocation,f_competitor,f_competitiveedge,f_distributorsrequir,f_distributorsrate,f_retailoutlets,f_marketcost,f_logisticscost,f_channelpolicy,t_taskmtdetailedinfo.f_note,t_taskmtdetailedinfo.f_product,t_taskmtdetailedinfo.f_company_note,f_tradename,f_filename,f_filepath,f_enddate,f_filepath,f_filename";
        $j = array("LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtdetailedinfo ON t_taskmtdetailedinfo.f_taskid = t_task.f_tid","LEFT JOIN t_tradetype ON t_tradetype.f_tradeID = t_taskmtbaseinfo.f_tradeid","LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid_ban");
    }elseif($in_arr['type_label']=="widely"){
        $f = "f_tid,f_title,f_tasktypeid,f_taskrequirements,f_totalcopies,f_eachcoin,f_eachscore,f_drawcopies,f_filepath,f_filename";
        $j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid",'LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid');
    }elseif($in_arr['type_label']=="push"){
        $f = "f_tid,f_title,f_tasktypeid,f_taskrequirements,f_totalcopies,f_eachcoin,f_eachscore,f_drawcopies,f_filepath,f_filename";
        $j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid",'LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid');
    }
    $re['info'] = $t->field($f)->where($map)->join($j)->find();
    //echo $t->getLastSql();

    $re['type_label'] = $in_arr['type_label'];
    $re['f_auditdays'] = 7;
    $url = "?type_label=".$in_arr['type_label']."&taskid=".$map['f_tid']."&invitationCode=";
    $re['taskinfourl'] = C('WebUrl').U('mobileweb/index/index'.$url);
    $re['taskinfoshareurl'] = C('WebUrl').U('mobileweb/index/infoshare').$url;
//        pt($re);
//        exit;
    return $re;
}


 //微信
    function getTaskInfo1() {
        $in_arr = $_GET;
        $map['f_tid']=$in_arr['taskid'];
//        $userid=$in_arr["userid"];
        $invitationCode=$in_arr["invitationCode"];
        //获取邀请码
        $t = M('task');
        if($in_arr['type_label']=="business"){
            $f = "f_tid,f_title,f_tasktypeid,f_mtbrand,f_mtgoods,t_taskmtbaseinfo.f_tradeid,f_unitfirstAmount,f_unitcashdeposit,f_unitfranchisefee,f_unitotheramount,f_unittotalamount,f_unitcommission,f_unitpreownedgold,";
            $f .="f_brandlocation,f_slogan,f_sellingpoint,f_targetgroup,f_pricelocation,f_competitor,f_competitiveedge,f_distributorsrequir,f_distributorsrate,f_retailoutlets,f_marketcost,f_logisticscost,f_channelpolicy,t_taskmtdetailedinfo.f_note,t_taskmtdetailedinfo.f_product,t_taskmtdetailedinfo.f_company_note,f_tradename,f_filename,f_filepath,f_enddate,f_filepath,f_filename";
            $j = array("LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtdetailedinfo ON t_taskmtdetailedinfo.f_taskid = t_task.f_tid","LEFT JOIN t_tradetype ON t_tradetype.f_tradeID = t_taskmtbaseinfo.f_tradeid","LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid");
        }elseif($in_arr['type_label']=="widely"){
            $f = "f_tid,f_title,f_tasktypeid,f_taskrequirements,f_totalcopies,f_eachcoin,f_eachscore,f_drawcopies,f_filepath,f_filename";
            $j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid",'LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid');
        }elseif($in_arr['type_label']=="push"){
            $f = "f_tid,f_title,f_tasktypeid,f_taskrequirements,f_totalcopies,f_eachcoin,f_eachscore,f_drawcopies,f_filepath,f_filename";
            $j = array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid",'LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid');
        }
        $re['info'] = $t->field($f)->where($map)->join($j)->find();
        //echo $t->getLastSql();

        $re['type_label'] = $in_arr['type_label'];
        $re['f_auditdays'] = 7;
        $url = "?type_label=".$in_arr['type_label']."&taskid=".$map['f_tid']."&invitationCode=".$invitationCode;
        $re['taskinfourl'] = C('WebUrl').U('mobileweb/index/index'.$url);
        $re['taskinfoshareurl'] = C('WebUrl').U('mobileweb/index/infoshare').$url;
//        pt($re);
//        exit;
        return $re;
    }

    //取任务详情
//    public function getDateNote(){
//        $t = M("task");
//        $in_arr = $_GET;
//        $F_ID=$in_arr['taskid'];
//        $TYPE_LABEL=$in_arr['type_label'];
//        $USERID=$in_arr['userid'];
//        $t->where('f_tid='.$F_ID)->setInc('f_taskattention');//打开详情选+1关注
//        $map['f_tid']  = $F_ID;
//        if($TYPE_LABEL=="business"){//招商赚
//            $f = array('f_tid','f_title','f_begindate','f_enddate','f_linkman','f_description','t_task.f_status','ROUND(f_unitcommission*10) as f_unitcommission','t_fi.f_filename','t_fi.f_filepath','t_f.f_filename as f_logo','t_f.f_filepath as f_logopath','f_tradeid','f_taskattention','f_utask_status');
//            $j = array('LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files as t_fi ON t_fi.f_id = t_task.f_fileid_ban','LEFT JOIN t_files as t_f ON t_f.f_id = t_task.f_fileid','LEFT JOIN t_taskdraw ON t_taskdraw.f_taskid=t_task.f_tid and t_taskdraw.f_userid='.$USERID);
//        }elseif($TYPE_LABEL=="widely"){//随手赚
//            $f = array('f_tid','f_tasktypeid','f_creatdate','f_surveno','f_title','f_description','t_task.f_status','f_begindate','f_enddate','f_totalcopies','f_drawcopies','ROUND(f_eachcoin*10) as f_eachcoin','f_eachscore','f_harder','f_taskattention','f_utask_status','f_filename as f_logo','f_filepath as f_logopath');
//            $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid','LEFT JOIN t_taskdraw ON t_taskdraw.f_taskid=t_task.f_tid and t_taskdraw.f_userid='.$USERID);
//            //$a['f_auditdays'] = 0;
//        }elseif($TYPE_LABEL=="push"){//推广赚
//            //$map['f_userid']  = $USERID;
//            $f = array('f_tid','f_tasktypeid','f_creatdate','f_surveno','f_title','f_description','t_task.f_status','f_begindate','f_enddate','f_totalcopies','f_drawcopies','ROUND(f_eachcoin*10) as f_eachcoin','f_eachscore','f_harder','f_taskattention','f_filename as f_logo','f_filepath as f_logopath');
//            $j = array('LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid','LEFT JOIN t_files ON t_files.f_id = t_task.f_fileid');
//        }
//        $re = $t->field($f)->where($map)->join($j)->find();
//        if (isset($re['f_description']) && !empty($re['f_description'])) {
//            $re['f_description'] = trim($re['f_description']);
//            $re['f_description'] = ereg_replace("\t","",$re['f_description']);
//            $re['f_description'] = ereg_replace("\r\n","",$re['f_description']);
//            $re['f_description'] = ereg_replace("\r","",$re['f_description']);
//            $re['f_description'] = ereg_replace("\n","",$re['f_description']);
//        }
//        if (isset($re['f_taskrequirements']) && !empty($re['f_taskrequirements'])) {
//            $re['f_taskrequirements'] = trim($re['f_taskrequirements']);
//            $re['f_taskrequirements'] = ereg_replace("\t","",$re['f_taskrequirements']);
//            $re['f_taskrequirements'] = ereg_replace("\r\n","",$re['f_taskrequirements']);
//            $re['f_taskrequirements'] = ereg_replace("\r","",$re['f_taskrequirements']);
//            $re['f_taskrequirements'] = ereg_replace("\n","",$re['f_taskrequirements']);
//        }
//        if (isset($re['f_note']) && !empty($re['f_note'])) {
//            $re['f_note'] = trim($re['f_note']);
//            $re['f_note'] = ereg_replace("\t","",$re['f_note']);
//            $re['f_note'] = ereg_replace("\r\n","",$re['f_note']);
//            $re['f_note'] = ereg_replace("\r","",$re['f_note']);
//            $re['f_note'] = ereg_replace("\n","",$re['f_note']);
//        }
//        //echo $t->getLastsql();
//        $re['f_auditdays'] = 7;
//        $url = "?type_label=".$TYPE_LABEL."&taskid=".$F_ID."&invitationCode=";
//        $re['taskinfourl'] = C('WebUrl').U('mobileweb/index/index'.$url);
//        $re['taskinfoshareurl'] = C('WebUrl').U('mobileweb/index/infoshare').$url;
////        $smsurl = "?type_label=".$TYPE_LABEL."&taskid=".$F_ID."&udid=sms";
////        $re['smsurl'] = C('WebUrl').U('mobileweb/index/sms'.$smsurl);
//        //$re['f_taskattention'] = 0;
//
//        pt($re);
//        exit;
//        return $re;
//    }

 function online_message(){
     set_theme();
     $this->display();
 }
}