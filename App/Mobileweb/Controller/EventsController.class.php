<?php

namespace Mobileweb\Controller;
use Think\Controller;

class EventsController extends Controller {
//    微信公共平台appid和appsrect


    function index(){
        set_theme();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $re = $this->getinfo($id);
        }else {
            $re["f_note"] = "";
            $re["f_title"] = "";
        }
        //pt($re);
        $this->assign("note",$re["f_note"]);
        $this->assign("webtitle",$re["f_title"]);
        $this->display();
    }



    function share(){
        set_theme();
        $this->assign("userid",$_GET['userid']);
        $invitationCode = $this->getinvitationCode($_GET['userid']);
        //echo $invitationCode;
        //exit;
        $this->assign('invitationCode', $invitationCode);
        $this->display();
    }

    //商家报名
    function apply(){
        set_theme();
        $this->display();
    }

    //活动
    function activity(){
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
          $this->assign("userid",$_GET['userid']);
          $invitationCode = $this->getinvitationCode($_GET['userid']);
          $this->assign('invitationCode', $invitationCode);
        }
        $this->display();
    }

    //活动2
     function activitys(){
         set_theme();
         $this->display();
      }

    function getinvitationCode($userid){
        $re = A("Api/Jhttp")->getUserinfo2($userid);
        //pt($re);
        $arr = json_decode($re,true);
        return $arr["list"]["invitationCode"];
    }

    //H5随手赚推荐类、答题类与推荐类任务以及预览
    function surveyPage($userid,$taskid){
       $j=array("LEFT JOIN t_task ON t_task.f_tid = t_surveytaskdetail.f_taskid");
       $re=M('surveytaskdetail')->join($j)->where("f_taskid=".$taskid)->select();
       $count=count($re);
       for ($i=0; $i <$count ; $i++) {
           $re[$i]['f_options']=explode('|',$re[$i]['f_options']);
       }
       return $re;
    }

    //H5随手调研类
     function surveyClass(){
         set_theme();
         $userid=I('userid');
         $taskid=I('taskid');
         $re=$this->surveyPage($userid,$taskid);
         $mobilesystem=I('mobilesystem');
         $this->assign('mobilesystem',$mobilesystem);
         $this->assign('count',count($re));
         $this->assign('userid',$userid);
         $this->assign('taskid',$taskid);
         $this->assign('re',$re);
         $this->display();
      }


    //H5随手督查类
    function supervise(){
        set_theme();
        $userid=I('userid');
        $taskid=I('taskid');
        // lat=30.337803&lng=120.112793
        $longitude=I('lng');
        $latitude=I('lat');
        $mobileType=I('mobileType');
        //根据userid与taskid将保存在数据库中的网店取出来 链表查询 在t_taskdraw表中，根据userid与taskid查找数据 
        //没有数据表示还未参与，1：待审核，2：进行中，3：已完成，4：已失效
        //距离由近到远排序
         $submit=I('submit');
         $submit=isset($submit)?$submit:"";
         if("submit"==$submit){    //随手稽核确认
          $map['f_super_id']=I('superid');
          M('tasksuperaddress')->where($map)->setDec('f_claim_num'); // 认领数减1
        }

        $j=array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_tasksuperaddress.f_task_id","LEFT JOIN t_task ON t_task.f_tid = t_tasksuperaddress.f_task_id");
        $re=M('tasksuperaddress')->join($j)->where("f_task_id=".$taskid)->order('f_distance asc')->select();
        for ($i=0; $i <count($re) ; $i++) {
            $where['f_taskid']=$taskid;
            $where['f_userid']=$userid;
            $where['f_superAddressID']=$re[$i]["f_super_id"];
            $re_1=M('taskdraw')->where($where)->find();
            $re[$i]["f_utask_status"]=$re_1["f_utask_status"];
            $re[$i]["f_eachcoin"]=$re[$i]["f_eachcoin"]*10;
        }
         // var_dump($re);exit();
        $this->assign('userid',$userid);
        $this->assign('taskid',$taskid);
        $this->assign('latitude',$latitude);
        $this->assign('longitude',$longitude);
        $this->assign('mobileType',$mobileType);
        $this->assign('re',$re);
        $this->assign('countre',count($re));
        $this->display();
    }
    //H5随手稽核类
    function superviseCheck(){
        set_theme();
        $userid=I('userid');
        $taskid=I('taskid');
        $longitude=I('longitude');
        $latitude=I('latitude');
        $mobileType=I('mobileType');
        $netserial=I('netserial');
        $superid=I('superid');
        $re=$this->surveyPage($userid,$taskid);
        // var_dump($re);exit();
        $this->assign('mobileType',$mobileType);
        $this->assign('superid',$superid);
        $this->assign('netserial',$netserial);
        $this->assign('count',count($re));
        $this->assign('userid',$userid);
        $this->assign('taskid',$taskid);
        $this->assign('latitude',$latitude);
        $this->assign('longitude',$longitude);
        $this->assign('re',$re);
        $this->display();
    }

    //H5随手稽核类增加状态
    function superviseDraw(){
        $map['f_userid']=I('userid');
        $map['f_taskid']=I('taskid');
        $map['f_superAddressID']=I('superid');
        $map['f_utask_status']=2;
        $map['f_drawdate']=time();
        $re=M('taskdraw')->add($map);
        echo $re;
    }

    function superviseDistance(){
      $where['f_task_id']=I('taskid');
      $where['f_super_id']=I('superid');
      // var_dump($where);exit();
      $map['f_distance']=I('distance');
      M('tasksuperaddress')->where($where)->save($map);
      echo 1;
    }
    
    //H5随手赚稽核类下一步
    function superviseNext(){
          set_theme();
          $taskid=I('taskid');
          $userid=I('userid');
          $map['f_taskid']=$taskid;
          $map['f_userid']=$userid;
          $map['f_serial']=I('serial');
          $map['f_netserial']=I('netserial');
          $re=M('surveyuserchoices')->where($map)->find();
          if ($re) {
              $mosu['f_answer']=I('answerInput');
              $mosu['f_ctime']=time();
              M('surveyuserchoices')->where($map)->save($mosu);
          }else{
              $answerInput=I('answerInput');
              $map['f_answer']=isset($answerInput)?$answerInput:"";
              $map['f_ctime']=time();
              M('surveyuserchoices')->add($map);
          }
          $submit=I('submit');
          $submit=isset($submit)?$submit:"";
          if("submit"==$submit){    //随手稽核确认
            $most['f_utask_status']=1;
            $where['f_taskid']=$taskid;
            $where['f_userid']=$userid;
            $where['f_superAddressID']=I('superid');
            $re_1=M('taskdraw')->where($where)->save($most);
            echo 1;
          }else{
            echo 1;
          }
    }

    //H5随手稽核类
    function superviseCheck1(){
        set_theme();
        $this->display();
    }
    //微信 调研类
    function surveyClass_wei(){
        set_theme();
        $userid=I('userid');
        $taskid=I('taskid');
        $re_1=M("taskdraw")->where('f_userid='.$userid." and f_taskid=".$taskid)->find();
        if(empty($re_1)){
            $p['f_utask_status']=2;
            $p['f_taskid']=I('taskid');
            $p['f_userid']=I('userid');
            $p['f_drawdate']=time();
            $re_2=M('taskdraw')->add($p);
        }
        $j=array("LEFT JOIN t_task ON t_task.f_tid = t_surveytaskdetail.f_taskid");
        $re=M('surveytaskdetail')->join($j)->where("f_taskid=".$taskid)->select();
        // var_dump($re);exit();
        $count=count($re);
        for ($i=0; $i <$count ; $i++) {
            $re[$i]['f_options']=explode('|',$re[$i]['f_options']);
        }
        $this->assign('count',$count);
        $this->assign('userid',$userid);
        $this->assign('taskid',$taskid);
        $this->assign('re',$re);
        $this->display();
    }

    //H5随手答题类
    function answerClass(){
         set_theme();
         $userid=I('userid');
         $taskid=I('taskid');
         $re=$this->surveyPage($userid,$taskid);
         $mobilesystem=I('mobilesystem');
         $this->assign('mobilesystem',$mobilesystem);
         $this->assign('count',count($re));
         $this->assign('userid',$userid);
         $this->assign('taskid',$taskid);
         $this->assign('re',$re);
         $this->display();
      }

    //微信答题类
    function answerClass_wei(){
        set_theme();
        $userid=I('userid');
        $taskid=I('taskid');
        $re_1=M("taskdraw")->where('f_userid='.$userid." and f_taskid=".$taskid)->find();
        if(empty($re_1)){
            $p['f_utask_status']=2;
            $p['f_taskid']=I('taskid');
            $p['f_userid']=I('userid');
            $p['f_drawdate']=time();
            $re_2=M('taskdraw')->add($p);
        }

        $j=array("LEFT JOIN t_task ON t_task.f_tid = t_surveytaskdetail.f_taskid");
        $re=M('surveytaskdetail')->join($j)->where("f_taskid=".$taskid)->select();
        $count=count($re);
        for ($i=0; $i <$count ; $i++) {
            $re[$i]['f_options']=explode('|',$re[$i]['f_options']);
        }
        // var_dump($re);exit();
        $this->assign('count',$count);
        $this->assign('userid',$userid);
        $this->assign('taskid',$taskid);
        $this->assign('re',$re);
        $this->display();
    }

      //答题与调研任务预览
      function problemPreview(){
         set_theme();
         $userid=I('userid');
         $taskid=I('taskid');
         $re=$this->surveyPage($userid,$taskid);
         $this->assign('count',count($re));
         $this->assign('userid',$userid);
         $this->assign('taskid',$taskid);
         $this->assign('re',$re);
         $this->display();
      }

// 微信任务预览
    function problemPreview_wei(){
        set_theme();
        $userid=I('userid');
        $taskid=I('taskid');
        $j=array("LEFT JOIN t_task ON t_task.f_tid = t_surveytaskdetail.f_taskid");
        $re=M('surveytaskdetail')->join($j)->where("f_taskid=".$taskid)->select();
        $count=count($re);
        for ($i=0; $i <$count ; $i++) {
            $re[$i]['f_options']=explode('|',$re[$i]['f_options']);
        }
        // var_dump($re);exit();
        $this->assign('count',$count);
        $this->assign('userid',$userid);
        $this->assign('taskid',$taskid);
        $this->assign('type_label',I('type_label'));
        $this->assign('invitationCode',I('invitationCode'));
        $path=C('WebUrl')."index.php/Mobileweb/Events/taskdeatail?taskid=".$taskid."&type_label=".I("type_label")."&userid=".$userid."&invitationCode=".I('invitationCode');
//        echo $path;
//        exit;
//        $path=C('WebUrl')."index.php/Mobileweb/Events/taskshare?userid=".$userid;
        $this->assign("WebUrl",C("WebUrl"));
        $this->assign("path",$path);
//        echo  $path;
//        exit;
        $this->assign('re',$re);
        $this->display();
    }

    //H5随手赚答题类下一步
    function userChoices(){

          set_theme();
          $taskid=I('taskid');
          $userid=I('userid');


          $map['f_taskid']=$taskid;
          $map['f_userid']=$userid;
          $map['f_serial']=I('serial');
          $re=M('surveyuserchoices')->where($map)->find();
          if ($re) {
              $mosu['f_answer']=I('answerInput');
              $mosu['f_ctime']=time();
              M('surveyuserchoices')->where($map)->save($mosu);
          }else{
              $answerInput=I('answerInput');
              $map['f_answer']=isset($answerInput)?$answerInput:"";
              $map['f_ctime']=time();
              M('surveyuserchoices')->add($map);
          }
          $submit=I('submit');
          $submit=isset($submit)?$submit:"";
          if("submit"==$submit){    //随手答题确认
              // $where['f_userid']=$userid;
              // $where['f_taskid']=$taskid;
              // M('taskdraw')->where($where)->setField('f_utask_status',3);    //改变状态
              //IP判断
              $re_ip = $this->is_ip($taskid,$userid);
              if($re_ip==0){
                  echo $re_ip;
              }else{
                  $trueCount=0;
                  $falseCount=0;
                  $re_2=M('surveyuserchoices')->where("f_taskid=".$taskid." and f_userid=".$userid)->order("f_serial asc")->select();
                  $re_3=M('surveytaskdetail')->where("f_taskid=".$taskid)->order("F_SERIAL asc")->select();
                  for ($i=0; $i < count($re_2); $i++) {
                      if ($re_2["$i"]["f_answer"]==$re_3["$i"]["f_trueanswer"]) {
                         $trueCount++;
                      }else{
                         $falseCount++;
                      }
                  }
                  $re_4=M('tasksmallinfo')->where("f_taskid=".$taskid)->find();
                  $goldCount=$re_4['f_eachcoin']*10*$trueCount/$map['f_serial'];
                  $goldCount=round($goldCount*100)/100;
                  D('Api/Shopsheet')->add_shopsheet('task',$userid,1,1,$goldCount,$taskid,2,0);
                  D('Api/Shopsheet')->add_shopsheet('task',$userid,1,2,3,$taskid,2,0);
                  //改变状态
                  $where['f_userid']=$userid;
                  $where['f_taskid']=$taskid;
                  M('taskdraw')->where($where)->setField('f_utask_status',3);

                  A("Api/Web")->allocation_gold($userid,$goldCount);//分红
                  echo (float)$goldCount;
              }

          }else{
            echo 1;
          }
    }
    /**
     * IP黑白名单
     */
    private function is_ip($taskid,$userid){
        //增加IP次数判断
        $re = A("Api/Fun")->getIP();
        if($re=="" || $re==null){
            $re = 0;
        }

//        $map_1["f_ip"]=$re;
        $map_1["f_taskid"]=$taskid;
        $map_1["f_userid"]=$userid;
        $map_1["f_z"] = 1;
        $re_ip = M("ip")->where($map_1)->select();
        if($re_ip){
            return 0;
        }else{
//            $map_4["f_ip"]=$re;
            $map_4["f_userid"]=$userid;
            $map_4["f_taskid"]=$taskid;
            $re_ip_1 = M("ip")->where($map_4)->count();
            if($re_ip_1>0){
//                $map_3["f_ip"]=$re;
                $map_3["f_userid"]=$userid;
                $map_3["f_taskid"]=$taskid;
                $map_2["f_z"] = 1;
                M("ip")->where($map_3)->save($map_2);
                return 0;
            }else{
                $map["f_ip"]=$re;
                $map["f_iptime"]=time();
                $map["f_taskid"]=$taskid;
                $map["f_userid"]=$userid;
                $map["f_z"] = 0;
                M("ip")->add($map);
                return 1;
            }
        }
//        $map["f_ip"]=$re;
//        $map["f_iptime"]=time();
//        $map["f_taskid"]=$taskid;
//        $map["f_userid"]=$userid;
//        $map["f_z"] = 0;
//        M("ip")->add($map);


    }
      //H$随手赚答题类跳出页面
      function answerCompare(){
          $taskid=I('taskid');
          $userid=I('userid');
          $goldCount=I('goldCount');
          $trueCount=0;
          $falseCount=0;
          $map['f_userid']=$userid;
          $map['f_taskid']=$taskid;
          $re=M('surveyuserchoices')->where($map)->order("f_serial asc")->select();
          $re_1=M('surveytaskdetail')->where("f_taskid=".$taskid)->order("F_SERIAL asc")->select();
          for ($i=0; $i < count($re); $i++) { 
               if ($re["$i"]["f_answer"]==$re_1["$i"]["f_trueanswer"]) {
                   $trueCount++;
                }else{
                   $falseCount++;
                }
               $re["$i"]["f_answer"]=explode(",",$re["$i"]["f_answer"]);
               for ($j=0; $j <count($re["$i"]["f_answer"]) ; $j++) { 
                   $re["$i"]["f_answer"]["$j"]++;
               }
               $re["$i"]["f_answer"]=implode(",",$re["$i"]["f_answer"]);

               $re_1["$i"]["f_trueanswer"]=explode(",",$re_1["$i"]["f_trueanswer"]);
               for ($k=0; $k <count($re_1["$i"]["f_trueanswer"]) ; $k++) { 
                   $re_1["$i"]["f_trueanswer"]["$k"]++;
               }
               $re_1["$i"]["f_trueanswer"]=implode(",",$re_1["$i"]["f_trueanswer"]);

               $re["$i"]["f_userchange"]=$re_1["$i"]["f_trueanswer"]; //把问题正确答案与用户选的放到同一个数组中
          }
          $this->assign('re',$re);
          $this->assign('goldCount',$goldCount);
          $this->assign('trueCount',$trueCount);
          $this->assign('falseCount',$falseCount);
          $this->display();
      }

       //H5随手赚调研下一步
      function nextSurvey(){
          set_theme();
          $map['F_TASKID']=I('taskid');
          $map['F_SUBMITUSERID']=I('userid');
          $re=M('surveyanswer')->where($map)->find();
          if($re){
            if (5==$re['F_STATUS']||"5"==$re['F_STATUS']) {
               M('surveyanswer')->where($map)->setField('F_STATUS',4);
            }
            $re_1=$re['f_answerid'];
          }else{
            $map['F_SUBMITDATE']=time();
            $map['F_STATUS']=4;
            $re_1=M('surveyanswer')->add($map);
          }
          $admap['F_SERIAL']=I('serial');
          $admap['F_ANSWERID']=$re_1;
          $re_2=M('surveyanswerdetail')->where($admap)->find();
          if($re_2){
            $moan['F_ANSWER']=I('answerInput');
            M('surveyanswerdetail')->where($admap)->save($moan);
          }else{
            $admap['F_ANSWER']=I('answerInput');
            M('surveyanswerdetail')->add($admap);
          }
          $submit=I('submit');
          if("submit"==$submit){    //随手调研确认
            $data['f_userid']=I('userid');
            $data['f_taskid']=I('taskid');
            // $most['f_utask_status']=1;
            M('taskdraw')->where($data)->setField('f_utask_status',1);
          }
          echo 1;
      }

      //推荐类
    function spreadClass(){
         set_theme();
         $userid=I('userid');
         $taskid=I('taskid');
         $j=array("LEFT JOIN t_task ON t_task.f_tid = t_tasksmallinfo.f_taskid");
         $re=M('tasksmallinfo')->join($j)->where("f_taskid=".$taskid)->find();
         $this->assign('userid',$userid);
         $this->assign('taskid',$taskid);
         $this->assign('re',$re);
         $this->display();
      }

//微信推广
    function spreadClass_wei(){
        set_theme();
        $userid=I('userid');
        $taskid=I('taskid');
        $re_1=M("taskdraw")->where('f_userid='.$userid." and f_taskid=".$taskid)->find();
        if(empty($re_1)){
            $p['f_utask_status']=2;
            $p['f_taskid']=I('taskid');
            $p['f_userid']=I('userid');
            $p['f_drawdate']=time();
            $re_2=M('taskdraw')->add($p);
        }
        $j=array("LEFT JOIN t_task ON t_task.f_tid = t_tasksmallinfo.f_taskid");
        $re=M("tasksmallinfo")->join($j)->where("f_taskid=".$taskid)->find();
        $this->assign('re',$re);
        $this->assign('userid',$userid);
        $this->assign('taskid',$taskid);
        $this->display();
    }

       //H5推荐任务页面预览
    function spreadPreview(){
         set_theme();
         $userid=I('userid');
         $taskid=I('taskid');
         $j=array("LEFT JOIN t_task ON t_task.f_tid = t_tasksmallinfo.f_taskid");
         $re=M("tasksmallinfo")->join($j)->where("f_taskid=".$taskid)->find();
         $this->assign('re',$re);
         $this->assign('userid',$userid);
         $this->assign('taskid',$taskid);
         $this->display();
      }

    //微信推荐任务推荐
    function spreadPreview_wei(){
        set_theme();
        $userid=I('userid');
        $taskid=I('taskid');
        $j=array("LEFT JOIN t_task ON t_task.f_tid = t_tasksmallinfo.f_taskid");
        $re=M("tasksmallinfo")->join($j)->where("f_taskid=".$taskid)->find();
        $this->assign('re',$re);
        $this->assign('userid',$userid);
        $this->assign('taskid',$taskid);
        $this->assign('type_label',I('type_label'));
        $this->assign('invitationCode',I('invitationCode'));
        $path=C('WebUrl')."index.php/Mobileweb/Events/taskdeatail?taskid=".$taskid."&type_label=".I("type_label")."&userid=".$userid."&invitationCode=".I('invitationCode');
//        $path=C('WebUrl')."index.php/Mobileweb/Events/taskshare?userid=".$userid;
        $this->assign("WebUrl",C("WebUrl"));
        $this->assign("path",$path);
//        echo $path;
//        exit;
        $this->display();
    }
    //H5随手推荐提交确定
    function spreadSure(){
      set_theme();
      $userid=I('userid');
      $taskid=I('taskid');
      $map['f_taskid']=$taskid;
      $map['f_userid']=$userid;
      $map['f_dealername']=I('dealerName');
      $map['f_dealerphone']=I('dealerPhone');
      $map['f_dealercompanyname']=I('dealerCompanyName');
      $map['f_dealerindustry']=I('dealerIndustry');
      $map['f_dealeraddress']=I('dealerAddress');
      $map['f_dealertel']=I('dealerTel');
      $map['f_dealerfax']=I('dealerFax');
      $map['f_recommendtime']=time();
      $re=M('recommenddealerinfo')->add($map);
      if($re>0){  //修改认领状态
          $most['f_utask_status']=1;
          M('taskdraw')->where('f_userid='.$userid." and f_taskid=".$taskid)->save($most);
        }
      echo 1;
    }

     function slideFile(){
          set_theme();
          $this->display();
      }
      

    function getinfo($id){
        $re = M("ad")->where("f_id=".$id)->find();
        return $re;
    }

    //微信任务列表分享页面
    function  taskshare(){
        set_theme();
        //第三步：签名  字段noncestr随机字符串, 有效的jsapi_ticket,时间戳timestamp  url(当前页面)
        //对所有字段拼接成字串，用sha1加密
        //签名用的noncestr和timestamp必须与wx.config中的nonceStr和timestamp相同。
        //签名用的url必须是调用JS接口页面的完整URL。
        $in_arr = $_GET;
//        echo $in_arr['userid'];
        $timstamp=time();
        $noncestr=md5(time().mt_rand(0,1000));
        $jsapi_ticket=$this->get_jsapi_ticket();
        $url="jsapi_ticket=".$jsapi_ticket."&noncestr=".$noncestr."&timestamp=".$timstamp."&url=".C('WebUrl')."index.php/Mobileweb/Events/taskshare?userid=".$in_arr['userid'];
//        echo $url;
        $signature=sha1($url);
//        echo $signature;
        $this->assign("userid",$in_arr['userid']);

        //获取邀请码
        $userfo=A("Api/Jhttp")->getUserinfo2($in_arr['userid']);
        $we=json_decode($userfo,true);
        $invitationCode=$we["list"]["invitationCode"];
        $this->assign("invitationCode",$invitationCode);
        $this->assign("appid",C("appid"));
        $this->assign("timstamp",$timstamp);
        $this->assign("noncestr",$noncestr);
        $this->assign("signature",$signature);
        $this->display();
    }

    //微信任务详情页面
    function  taskdeatail(){
        set_theme();
        $in_arr = $_GET;
        $re =A("Mobileweb/Index")->getTaskInfo1();
//        echo  $in_arr['$userid'];
//        exit;
        $timstamp=time();
        $noncestr=md5(time().mt_rand(0,1000));
        $jsapi_ticket=$this->get_jsapi_ticket();
        $url="jsapi_ticket=".$jsapi_ticket."&noncestr=".$noncestr."&timestamp=".$timstamp."&url=".C('WebUrl')."index.php/Mobileweb/Events/taskdeatail?taskid=".$in_arr['taskid']."&type_label=".$in_arr['type_label']."&userid=".$in_arr['userid']."&invitationCode=".$in_arr['invitationCode'];
        //签名
        $signature=sha1($url);
        $this->assign("userid",$in_arr['userid']);

        $this->assign("appid",C("appid"));
        $this->assign("timstamp",$timstamp);
        $this->assign("noncestr",$noncestr);
        $this->assign("signature",$signature);


        $re['f_note'] = trim($re['f_note']);
        $re['f_note'] = ereg_replace("\t", "", $re['f_note']);
        $re['f_note'] = ereg_replace("\r\n", "", $re['f_note']);
        $re['f_note'] = ereg_replace("\r", "", $re['f_note']);
        $re['f_note'] = ereg_replace("\n", "", $re['f_note']);
        $re['f_note'] = trim($re['f_product']);
        $re['f_product'] = ereg_replace("\t", "", $re['f_product']);
        $re['f_product'] = ereg_replace("\r\n", "", $re['f_product']);
        $re['f_product'] = ereg_replace("\r", "", $re['f_product']);
        $re['f_product'] = ereg_replace("\n", "", $re['f_product']);

        $this->assign('taskinfo', $re);



        $this->assign("imgpath",C("WebUrl")."/Public/upfile/".$re['info']['f_filepath'].$re['info']['f_filename']);
        $this->assign("tasktypeid",$re["info"]["f_tasktypeid"]);
        $this->assign("taskid",$re["info"]["f_tid"]);
        $this->assign("type_label",$in_arr["type_label"]);
        $this->assign("invitationCode",$in_arr['invitationCode']);
        if($in_arr["type_label"]=="widely"){
            $task_status=M("taskdraw")->where("f_userid=".$in_arr['userid']." and  f_taskid=".$in_arr['taskid'])->select();

        }
        $this->assign("task_status",isset($task_status[0]["f_utask_status"])?$task_status[0]["f_utask_status"]:0);
        $this->assign('weburl',C('WebUrl'));
        $path=C('WebUrl')."index.php/Mobileweb/Events/taskshare?userid=".$in_arr['userid'];
        $this->assign("path",$path);
        $this->display();
    }

    //微信参与二维码
    function  erweima(){
        set_theme();
        $timstamp=time();
        $noncestr=md5(time().mt_rand(0,1000));
        $jsapi_ticket=$this->get_jsapi_ticket();
        $url="jsapi_ticket=".$jsapi_ticket."&noncestr=".$noncestr."&timestamp=".$timstamp."&url=".C('WebUrl')."index.php/Mobileweb/Events/erweima";
        $signature=sha1($url);
        $this->assign("appid",C("appid"));
        $this->assign("timstamp",$timstamp);
        $this->assign("noncestr",$noncestr);
        $this->assign("signature",$signature);
        $this->display();
    }

    // 第一步：微信分享获取相关信息 $token
    function  get_wei_token(){
        S("access_token",null);
//     S()缓存函数，
        $token=S("access_token");
//     第三方用户唯一凭证
//     第三方用户唯一凭证密钥，即appsecre
        if(!$token){
            $res=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".C("appid")."&secret=".C("secret"));
            $res=json_decode($res,true);
//            pt($res);
            $token=$res["access_token"];
            S("access_token",$token,3600);
        }
//        echo $token;
        return  $token;

    }

    //第二步：jsapi_ticket调用微信js接口的临时票据，提供access_token来获取，开发者必须在自己的服务全局缓存

    function  get_jsapi_ticket(){
       S("wx_ticket",null);
        $ticket="";
        do{
            $ticket=S("wx_ticket");
            if(!empty($ticket)){
                break;
            }
            $token=S("access_token");
            if(empty($token)){
                $this->get_wei_token();
            }
            $url2="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$token."&type=jsapi";
            $res=file_get_contents($url2);
            $res=json_decode($res,true);
            $ticket=$res["ticket"];
            //需要缓存ticket
            S("wx_ticket",$ticket,3600);

        }while(0);

        return $ticket;
      }



    //使用微信服务号进行网页授权获取用户信息

     function   get_wei_userinfo(){
//         公共号的唯一标示
         $appid=C("appid");
//         授权后重定向的回调链接地址，请使用urlencode对链接进行处理
         $redirect_uri=urlencode(C('WebUrl')."index.php/Mobileweb/Events/phonePageBind");
         $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
         //跳转到扫码页
         echo "<script>location.href='".$url."'</script>";
     }


    //进入手机绑紧界面
    //绑定进入taskshare页面未绑定进入填手机号密码验证码，界面
    function  phonePageBind(){
        set_theme();
        S("user_access_token",null);
        //获取授权code
        $code=I("code");
        //获取网页授权access_token
        $url_access_token="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C('appid')."&secret=".C('secret')."&code=".$code."&grant_type=authorization_code";
        $res=file_get_contents($url_access_token);
        $res=json_decode($res,true);
        //缓存存取用户网页授权的access_token
        S($res["user_access_token"],3600);
        $unionid=$res["unionid"];
        //判断微信用户是否跟小宝平台绑定
        //调用java接口判断是否绑定
//        echo $unionid;
        $auth_result = A("Api/Jhttp")->weixinLogin($unionid);
        $auth_array = json_decode($auth_result,true);
        $resCode = $auth_array['resCode'];
        if($resCode =="000000"){  //已经绑定过了
//            echo "<br/>我已经绑定过了";
            $userid=$auth_array["list"]["userId"];
//            echo $userid;
            echo "<script>location.href='".C('WebUrl')."index.php/Mobileweb/Events/taskshare?userid=".$userid."'</script>";
        }else{  //没有绑定跳转到注册页面
//            echo "<br/>我没有绑定过";
//            echo $unionid;
            $this->assign("unionid",$unionid);

            $this->display();
        }

    }

    function tryoutRule(){
      set_theme();
      $taskid=I("taskid");

      $this->display();
    }

 //新手引导
    function task_guide(){
      set_theme();
      $this->display();
    }
 //城会玩
    function city_play(){
      set_theme();
        $this->assign("nowtime",date("Y/m/d H:i:s",time()));
        $this->assign("mobile",I("get.mobile"));
      $this->display();
    }
    //天地汇
    function tiandihui(){
      set_theme();
      $this->display();
    }
    //亿元俱乐部
    function yyClub(){
      set_theme();
      $this->display();
    }


}