<?php
namespace Home\Controller;
use Think\Controller;
class BusinessController extends CommonController{
    
    //首页---刘显珍
    public function index(){
        $re = A('Api')->getBigC();
        //pt($re);
        //exit;
        foreach ($re as $key => $val) {
            if($val['f_sys_column_cid']=='Business'){
                $syscolumn_id = $val['f_syscolumn_id'];
            }
        }
        //echo $syscolumn_id;
        $sre = A('Api')->getBigC($syscolumn_id);
        //pt($sre);
        $ret=A("Test")->getMenulist();
        //dump($ret);exit;
        $this->assign("ret",$ret);
        //pt($ret);
        //exit;
        $this->assign('bigclass', $re);
        $this->assign('smallclass', $sre);
        $this->display();
    }
    
    
    
     //审核管理----王青
      public function review(){       
        $re = A('Api')->getBigC();
        foreach ($re as $key => $val) {
                if($val['f_sys_column_cid']=='Business'){
                    $syscolumn_id = $val['f_syscolumn_id'];
                }
            }
        $sre = A('Api')->getBigC($syscolumn_id);

         $ret=A("Test")->getMenulist();
         $this->assign("ret",$ret);

        $this->assign('bigclass', $re);
        $this->assign('smallclass', $sre);
        $this->display();
    }
    
    //资质&文档管理--刘显珍
    public function  qualificatdoc(){        
        $re = A('Api')->getBigC();
        foreach ($re as $key => $val) {
                if($val['f_sys_column_cid']=='Business'){
                    $syscolumn_id = $val['f_syscolumn_id'];
                }
            }
        $sre = A('Api')->getBigC($syscolumn_id);
        $this->assign('bigclass', $re);
        $this->assign('smallclass', $sre);
        $ret=A("Test")->getMenulist();
        $this->assign("ret",$ret);
        $this->display();
    }
   
    //任务管理----刘显珍
    public  function  task(){
        $i = intval(cookie("clicknum"));
        $i++;
        cookie("clicknum",$i);

        $re = A('Api')->getBigC();
        foreach ($re as $key => $val) {
                if($val['f_sys_column_cid']=='Business'){
                    $syscolumn_id = $val['f_syscolumn_id'];
                }
            }
        $sre = A('Api')->getBigC($syscolumn_id);

        $ret=A("Test")->getMenulist();
                 $this->assign("ret",$ret);
        $addurl=__ROOT__."/index.php/Home/Business/taskAdd";
        //echo cookie("companyId");
        $this->assign('companyID',  cookie("companyId"));
        $this->assign('bigclass', $re);
        $this->assign('smallclass', $sre);
        $this->assign('addurl', $addurl);
        $this->display();
    }
    
    //任务管理模块增加
    public  function taskAdd(){

        set_theme();
        $re = A('Api')->getBigC();
        foreach ($re as $key => $val) {
            if($val['f_sys_column_cid']=='Business'){
                $syscolumn_id = $val['f_syscolumn_id'];
            }
        }
        $sre = A('Api')->getBigC($syscolumn_id);

        $ret=A("Test")->getMenulist();
                 $this->assign("ret",$ret);

        $taskid = I('get.taskid',0);

        $zhao_total = M("taskmtareaqty")->where("f_taskid=".$taskid)->sum('f_qty');

        $this->assign("zhao_total",$zhao_total);

//        总目标佣金


//        var_dump($total[0]["num"]);

//        dump($_GET);
//        dump($taskid);
        $reModi = A('Api/Web')->getModiTask($taskid);//取要修改的记录数据

        //获取行业列表
        $biglist=M("tradetype")->where("f_parentID=0")->select();
        foreach($biglist as $k=>$val){
              $smalllist[$k]=M("tradetype")->where("f_parentID=".$val["f_tradeid"])->select();
//              $result=M("tradetype")->where("f_parentID=".$val["f_tradeid"])->select();
        }


//        var_dump($biglist);
//        dump($result);
//        var_dump($reModi);
//        exit;

        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }

        $total_yong=$zhao_total*intval($reModi["two"]["f_unitpreownedgold"]);
        $this->assign("total_yong",$total_yong);

        $big=0;
        $small=isset($reModi["two"]["f_tradeid"])?$reModi["two"]["f_tradeid"]:0;
        if($small!=0){
            $big1=M('tradetype')->where("f_tradeID=".$small)->find();
            $big=$big1["f_parentid"];
        }




        //编辑时初始化数据(最后一步),查找相关任务添加的附近
        // 通过 f_taskid 查找表 t_taskmtattach 中的 f_fielid1,f_fields2
        // 再通过 f_fields即  表t_files是的f_id 查找 f_filepath与f_filename 获得下载地址
        $f_fileid1 = ''; //商标注册证或授权使用证书图片
        $f_fileid2 = '';  //经销商合同
        $f_fileid3 = ''; //产品和宣传资料图片
        $f_fileid4 = ''; //产品价格表
        $f_fileid5 = ''; //销售市场支持政策
        $f_fileid6 = ''; //标志LOGO设计图
        $f_fileid7 = ''; //行业许可证图片
        $f_fileid8 = ''; //智慧招商服务合同结清算协议
        $task_action = 'add'; //行为，提交时区分新增还是编辑
        if( $taskid ){
            $map = array("f_taskid"=>$taskid);
            $task_fileid = M('taskmtattach')->where($map)->find(); //查找文件对应的id

            if( $task_fileid ){
                $f_fileid1 = M('files')->where("f_id=".$task_fileid['f_fileid1'])->find();  //查找对应的文件
                $f_fileid2 = M('files')->where("f_id=".$task_fileid['f_fileld2'])->find();  //查找对应的文件
                $f_fileid3 = M('files')->where("f_id=".$task_fileid['f_fileid3'])->find();  //查找对应的文件
                $f_fileid4 = M('files')->where("f_id=".$task_fileid['f_fileid4'])->find();  //查找对应的文件
                $f_fileid5 = M('files')->where("f_id=".$task_fileid['f_fileid5'])->find();  //查找对应的文件
                $f_fileid6 = M('files')->where("f_id=".$task_fileid['f_fileid6'])->find();  //查找对应的文件
                $f_fileid8 = M('files')->where("f_id=".$task_fileid['f_fileid8'])->find();  //查找对应的文件
                $f_fileid7 = M('files')->where("f_id=".$task_fileid['f_fileid7'])->find();  //查找对应的文件  没有则为空
            }

            $task_action = 'edit';

        }

        //判断企业信息是否完善了，状态为5的时候给个提示信息(有权限去完善资料，无权限提示去找管理员完善资料)
        // companyState  企业中的state 1.已审核 2.未开通招商 3.已删除 4.待审核 0.未通过 5 新注册
        $qiye = cookie("companyState");
//        $qiye = 5; //测试用


        $this->assign("task_f1",$f_fileid1);
        $this->assign("task_f2",$f_fileid2);
        $this->assign("task_f3",$f_fileid3);
        $this->assign("task_f4",$f_fileid4);
        $this->assign("task_f5",$f_fileid5);
        $this->assign("task_f6",$f_fileid6);
        $this->assign("task_f7",$f_fileid7);
        $this->assign("task_f8",$f_fileid8);
        $this->assign("task_action",$task_action);

        $this->assign("qiye",$qiye);


        $this->assign("big",isset($big)?$big:0);
        $this->assign("small",$small);
//        echo $big."= big==,";
//        echo $small."=small==";
//        exit;
        $this->assign("biglist",$biglist);
        $this->assign("smalllist",$smalllist);
        $this->assign('companyId',cookie('companyId'));
        $this->assign('companyName',cookie('companyName'));
        $this->assign('mobile',cookie('mobile'));
        $this->assign('bigclass', $re);
        $this->assign('smallclass', $sre);

//        //招商总数
//        $Model=new \Think\Model();
//        $zhao_total=$Model->query("SELECT SUM(f_qty) AS f_qty FROM t_taskmtareaqty t  WHERE  t.f_taskid=".$taskid);
//        echo M("taskmtareaqty")->getLastSql();
//        exit;
////        if($zhao_total){
////            $zhao_total=$zhao_total;
////        }else{
////            $zhao_total=0;
////        }
//
//        $this->assign("zhao_total",$zhao_total);
//
////        总目标佣金
//
//        $total_yong=$zhao_total*$reModi["two"]["f_unitpreownedgold"];
//        $this->assign("total_yong",$total_yong);
        $this->display("taskAdd");
    }
     /**
     * 业务洽谈
     */
    public function talk() {
        set_theme();
        $dealerid=$_GET['dealerid'];//经销商id
//        echo $dealerid;
//        exit;
        $salesmanid=$_GET['salesmanid'];
        $companyid=$_GET['companyid']; //公司的id

        M('talk')->where("f_dealerid=".$dealerid)->setField("f_read_web","1");  //点开对话弹窗即所有消息设置为已读
        $re=A('Api/Api')->getTalkList($dealerid); //获取对话内容
//        pt($re);
//        exit;
        $this->assign('list', $re);
        $this->assign('dealerid',$dealerid);
        $this->assign('salesmanid',$salesmanid);
        $this->assign('companyid',$companyid);
        $this->display();
    }

    public function proCheck() {
        set_theme();

        $dealerid = isset($_GET['dealerid'])? $_GET['dealerid'] : 0 ;
        $type = isset($_GET['type'])? $_GET['type'] : '1' ;
        $this->assign("dealerid",$dealerid);
        $result = M('authorization')->where('f_dealerid='.$dealerid)->find();
        $j = array("LEFT JOIN t_task ON t_task.f_tid = t_dealerbaseinfo.f_taskid");
        $detail = M('dealerbaseinfo')->JOIN($j)->where('f_dealerid='.$dealerid)->find();
        $userDetail = $this->getUserDetail($detail['f_userid']);
        $companyDetail = $this->getCompanyDetail($detail['f_companyid']);
        $time = date("Y/m/d H:i:s",$result['f_datetime']);
        $time1 = isset($result['f_datetime'])?date("Y/m/d",$result['f_datetime']):'1';
        $date= explode("/", $time);

        //经销商合同确认,企业未上传合同
        $p['f_proname'] = 'contract';
        $p['f_prostatus'] = 1;
        $p['f_dealerid'] = $dealerid;
        $j = array("LEFT JOIN t_files ON t_files.f_id = t_business_progress.f_fileid");
        $comContract = M('business_progress')->join($j)->where($p)->order("t_business_progress.f_id  desc")->find();
//        echo M('business_progress')->getLastSql();
//        echo $comContract["f_fileid"]."===".$comContract["f_protime"];
//        exit;
        $deaTime = date("Y/m/d H:i:sa",$comContract["f_protime"]);
        $deaTime1 =isset($comContract['f_protime'])?date("Y/m/d",$comContract['f_protime']):'1';
//        $dealerfilesid1=$comContract["f_fileid"];
//        $dealerfilesid=M("files")->where("f_id=".$dealerfilesid1)->find();
        $this->assign("deaTime",$deaTime);
        $this->assign("deaTime1",$deaTime1);
        $this->assign("dealerfilesid",$comContract);

        $p['f_proname'] = 'contract';
        $p['f_prostatus'] = 2;
        $p['f_dealerid'] = $dealerid;
        $j = array("LEFT JOIN t_files ON t_files.f_id = t_business_progress.f_fileid");
        $comContract = M('business_progress')->join($j)->where($p)->order("t_business_progress.f_id  desc")->find();
//        $comfilesid=M("files")->where("f_id=".$comContract["f_fileid"])->find();
        $comTime = date("Y/m/d H:i:sa",$comContract['f_protime']);
        $comTime1 = isset($comContract['f_protime'])?date("Y/m/d",$comContract['f_protime']):'1';
        $this->assign("comfilesid",$comContract);
// var_dump($comContract);exit();
        $c['f_proname'] = 'remit';  //打款
        $c['f_prostatus'] = 1;
        $c['f_dealerid'] = $dealerid;

        $deaRemit = M('business_progress')->where($c)->order("t_business_progress.f_id  desc")->find();
        $remitTime = date("Y/m/d  H:i:sa",$deaRemit['f_protime']);
        $this->assign("remitTime",$remitTime);
        $this->assign("remitfilesid",$deaRemit["f_fileid"]);

        $o['f_proname'] = 'remit';
        $o['f_prostatus'] = 2;
        $o['f_dealerid'] = $dealerid;
        $comRemit = M('business_progress')->where($o)->find();
        $comRemitTime = isset($comRemit['f_protime'])?date("Y/m/d",$comRemit['f_protime']):'1';
        $this->assign("comRemitTime",$comRemitTime);


        $o['f_proname'] = 'dispatch';
        $o['f_prostatus'] = 0;
        $o['f_dealerid'] = $dealerid;
        $j = array("LEFT JOIN t_files ON t_files.f_id = t_business_progress.f_fileid");
        $dispatch= M('business_progress')->join($j)->where($o)->order("t_business_progress.f_id  desc")->find();
//        $dispatch=M("files")->where("f_id=".$dispatch1["f_fileid"])->find();
        $dispatchTime = date("Y/m/d H:i:sa",$dispatch['f_protime']);
        $dispatchTime1 = isset($dispatch['f_protime'])?date("Y/m/d",$dispatch['f_protime']):'1';

        $s['f_proname'] = 'dispatch'; //发货
        $s['f_prostatus'] = 1;
        $s['f_dealerid'] = $dealerid;
        $j = array("LEFT JOIN t_files ON t_files.f_id = t_business_progress.f_fileid");
        $finishDispatch = M('business_progress')->join($j)->where($s)->order("t_business_progress.f_id  desc")->find();
//        $finishDispatch=M("files")->where("f_id=".$finishDispatch1["f_fileid"])->find();
        $finishDispatchTime = date("Y/m/d h:m:sa",$finishDispatch['f_protime']);
        $finishDispatchTime1 = isset($finishDispatch['f_protime'])?date("Y/m/d",$finishDispatch['f_protime']):'1';
// var_dump($finishDispatch);exit();
        $c['f_proname'] = 'receive';//收货
        $c['f_prostatus'] = 1;
        $c['f_dealerid'] = $dealerid;
        $j = array("LEFT JOIN t_files ON t_files.f_id = t_business_progress.f_fileid");
        $receive = M('business_progress')->join($j)->where($c)->order("t_business_progress.f_id  desc")->find();
//        echo  M('business_progress')->getLastSql();
//        exit;
//        $receive=M("files")->where("f_id=".$receive1["f_fileid"])->find();
        $receiveTime = date("Y/m/d  H:i:sa",$receive["f_protime"]);
        $receiveTime1 = isset($receive['f_protime'])?date("Y/m/d",$receive['f_protime']):'1';
        $this->assign("receivefileid",$receive["f_fileid"]);

        $q['f_proname'] = 'Settlement'; //贷款结算
        $q['f_prostatus'] = 1;
        $q['f_dealerid'] = $dealerid;
        $j = array("LEFT JOIN t_files ON t_files.f_id = t_business_progress.f_fileid");
        $square = M('business_progress')->join($j)->where($q)->order("t_business_progress.f_id  desc")->find();
        $squareTime = date("Y/m/d H:i:sa",$square['f_protime']);
        $squareTime1 = isset($square['f_protime'])?date("Y/m/d",$square['f_protime']):'1';

        $this->assign('detail', $detail);
        $this->assign('deaRemit', $deaRemit);
        $this->assign('comRemit', $comRemit);
        $this->assign('dispatch', $dispatch);
        $this->assign('dispatchTime', $dispatchTime);
        $this->assign('dispatchTime1', $dispatchTime1);
        $this->assign('finishDispatch', $finishDispatch);
        $this->assign('finishDispatchTime', $finishDispatchTime);
        $this->assign('finishDispatchTime1', $finishDispatchTime1);
        $this->assign('result', $result);
        $this->assign('userDetail', $userDetail);
        $this->assign('companyDetail', $companyDetail);
        $this->assign('date', $date);
        $this->assign('time', $time);
        $this->assign('time1', $time1);
        $this->assign('comContract', $comContract);
        $this->assign('comTime', $comTime);
        $this->assign('comTime1', $comTime1);
        $this->assign('receive', $receive);
        $this->assign('receiveTime', $receiveTime);
        $this->assign('receiveTime1', $receiveTime1);

        $this->assign('square', $square);
        $this->assign('squareTime', $squareTime);
        $this->assign('squareTime1', $squareTime1);
// var_dump($type);
        if ($type=='1') {
            $this->display();
        }elseif ($type=='2') {
            $this->display('finishContract');
        }elseif ($type=='3') {
            $this->display('contract');
        }elseif ($type=='4') {
            $this->display('finishRemit');
        }elseif ($type=='5') {
            $this->display('remit');
        }elseif ($type=='6') {
            $this->display('finishDispatch');
        }elseif ($type=='7') {
            $this->display('finishReceive');
        }elseif ($type=='8') {
            $this->display('finishSquare');
        }elseif ($type=='9') {
            $this->display('dispatch');
        }
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


    public  function  dealerContact(){ //经销商合同下载
        $dealerfieldId=I("get.dealerfilesid");
        $re=M("files")->where("f_id=".$dealerfieldId)->find();
        $filename=$re["f_filename"];
        $base_url = dirname(dirname(dirname(dirname(__FILE__)))).'/Public/upfile/'.$re["f_filepath"];
        $file_path=$base_url.$filename;
        header('Content-type: image/jpeg');
        header("Content-Disposition: attachment; filename=$filename");
      //在header确保前面没有任何输出
        @readfile($file_path);
        exit();

//
    }

    //任务驳回  随手调研和推荐

    public  function  reject(){
        set_theme();
        $this->assign("userid",I("checklist"));
        $this->assign("tid",I("tid"));
        $this->display();
    }

//   logo 任务预览
   public  function  show_tasklogo(){
//       imgsrc="+imgsrc+"&tasktitle="+tasktitle+"&pro_Descrip="+pro_Descrip+"&coin="+coin+""
       $this->assign("imgsrc",I("get.imgsrc"));
       $this->assign("tasktitle",I("get.tasktitle"));
       $this->assign("pro_Descrip",I("get.pro_Descrip"));
       $this->assign("coin",I("get.coin"));
       $this->display();

   }
//banner图标预览
   public  function  show_taskbanner(){
//       ?imgsrc="+imgsrc+"&tasktitle="+tasktitle+"&coin="+coin+"";
       $this->assign("imgsrc",I("get.imgsrc"));
       $this->assign("tasktitle",I("get.tasktitle"));
       $this->assign("coin",I("get.coin"));
       $this->display();

   }


    /**
     * ==========================================经销商名称简索===========================================
     */
    public function searchDname()
    {
        $dealerName = I('post.keyword');
        $map["f_companynameone"] = array('like', '%' . $dealerName . '%');
        $re = M("dealerbaseinfo")->group("f_companynameone")->where($map)->select();
        if(count($re)>0){
            foreach ($re as $key => $val) {
                $result[$key]['title'] = $val['f_companynameone'];
            }
            $a["data"]=$result;
            echo json_encode($a);
        }


    }
}
