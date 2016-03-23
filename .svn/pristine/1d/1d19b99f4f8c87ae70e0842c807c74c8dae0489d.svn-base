<?php
namespace Taskadmin\Controller;
use Think\Controller;
class TaskController extends Controller {
    
    public function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->assign('access',$access);//传入HTML，功能权限使用
        $homeCount=M('task')->where("f_hometask=1")->count();
        $this->assign("homeCount", $homeCount);
        $this->display();
    }
    
    /**
     * 随手赚
     */
    public function add_widely() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->getModiTask();//取要修改的记录数据
        // var_dump($reModi);exit();
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }
        // var_dump($reModi);exit();
        $tab = A('Api/Fun')->getTypeName('array');
        $this->assign('classtype','2');
        $this->assign("tab", $tab);
        $this->display();
    }
    /**
     * 督查赚
     */
    public function add_check() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->getModiTask();//取要修改的记录数据
        // var_dump($reModi);exit();
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }
        // var_dump($reModi);exit();
        $tab = A('Api/Fun')->getTypeName('array');
        $this->assign('classtype','7');
        $this->assign("tab", $tab);
        $this->display();
    }
    /**
     * 推广赚
     */
    public function add_push() {
        set_theme();
        
        A("Taskadmin/Fun")->islogin();//检测是否登录
        
        $reModi = A('Api/Web')->getModiTask();//取要修改的记录数据
        // var_dump($reModi);exit();
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }
        $tab = A('Api/Fun')->getTypeName('array');
        $this->assign('classtype','1');
        $this->assign("tab", $tab);
        
        
        $this->display();
        
    }
    /**
     * 招商赚
     */
    public function add_business() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $reModi = A('Api/Web')->getModiTask();//取要修改的记录数据
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }
        $taskid=I('taskid')?I('taskid'):0;
        if ($taskid != 0) {
            $re=M('task')->where("f_tid=".$taskid)->find();
            $userDetails = A('Api/Jhttp')->getCompanyInfo($re['f_companyid']);
            
            $arr=json_decode($userDetails,true);
            if (!empty($arr['list']['companyExtList'])) {
                foreach ($arr['list']['companyExtList'] as $key => $value) {
                    if (isset($value['extValue'])) {
                        $arr['list']['companyExtList'][$key]['f_name'] = M("files")->where("f_id=".$value['extValue'])->find();
                    }
                }
            }
            // var_dump($arr);exit();
            if($arr['resCode']=="000000"){
                $this->assign('arr', $arr);
            }
        }

        $tab = A('Api/Fun')->getTypeName('array');
        $this->assign('classtype','3');
        $this->assign("tab", $tab);
        $this->display();
    }

    /**
     * 驳回任务
     */
    public function reject() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $taskid=$_GET['taskid'];

        $this->assign('taskid',$taskid);
        $this->display();
    }

    /**
     * 客服审核
     */
    public function review() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $taskid=$_GET['taskid'];

        $this->assign('taskid',$taskid);
        $this->display();
    }

    /**
     * 财务审核
     */
    public function cwReview() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $taskid=$_GET['taskid'];

        $this->assign('taskid',$taskid);
        $this->display();
    }

    /**
     * 任务延时
     */
    public function taskDelay() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $taskid=$_GET['taskid'];

        $reModi = A('Api/Web')->getDelayTask();//取要修改的记录数据
        // var_dump($reModi);exit();
        if($reModi['result']=="000000"){
            $this->assign('reModi', $reModi);
        }

        $this->assign('taskid',$taskid);
        $this->display();
    }

    /**
     * 下架
     */
    public function underCarriage() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $taskid=$_GET['taskid'];

        $this->assign('taskid',$taskid);
        $this->display();
    }

    /**
     * 预览任务
     */
    public function preview() {
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录

        $taskid=$_GET['taskid'];
        $content = M("task")->field("f_tasktypeid")->where("f_tid=".$taskid)->find();
        $tasktypeid= $content["f_tasktypeid"];

        if($tasktypeid==1){
            $j=array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtdetailedinfo ON t_taskmtdetailedinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtgoodsdetail ON t_taskmtgoodsdetail.f_taskid = t_task.f_tid");
            $reModi = M('task')->where("t_task.f_tid=".$taskid)->join($j)->order('t_task.f_creatdate desc')->find();
            $reModi['tubiao'] = M("files")->where("f_id=".$reModi["f_fileid"])->find();
            $reModi['company'] = $this->getCompanyDetail($reModi["f_companyid"]);
            $reModi['f_taskrequirements'] = trim($reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\t","",$reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\r\n","",$reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\r","",$reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\n","",$reModi['f_taskrequirements']);
        }elseif($tasktypeid==2 || $tasktypeid==4 || $tasktypeid==5 || $tasktypeid==6){
            $j=array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtdetailedinfo ON t_taskmtdetailedinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtgoodsdetail ON t_taskmtgoodsdetail.f_taskid = t_task.f_tid");
            $reModi = M('task')->where("t_task.f_tid=".$taskid)->join($j)->order('t_task.f_creatdate desc')->find();
            $reModi['tubiao'] = M("files")->where("f_id=".$reModi["f_fileid"])->find();
            $reModi['company'] = $this->getCompanyDetail($reModi["f_companyid"]);
            $reModi['detail'] = M('surveytaskdetail')->where('f_taskid='.$taskid)->select();
            foreach ( $reModi['detail'] as $key => $value) {
                $reModi['detail'][$key]['answer']= explode('|', $value['f_options']);
            }
            $reModi['f_taskrequirements'] = trim($reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\t","",$reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\r\n","",$reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\r","",$reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\n","",$reModi['f_taskrequirements']);
        }elseif($tasktypeid==3){
            $j=array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtdetailedinfo ON t_taskmtdetailedinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtattach ON t_taskmtattach.f_taskid = t_task.f_tid");
            $reModi = M('task')->where("t_task.f_tid=".$taskid)->join($j)->order('t_task.f_creatdate desc')->find();
            if ($reModi["f_fileid"]!="") {
                $reModi['tubiao'] = M("files")->where("f_id=".$reModi["f_fileid"])->find();
            }
            $reModi['guanggao'] = M("files")->where("f_id=".$reModi["f_fileid_ban"])->find();

            $reModi['company'] = $this->getCompanyDetail($reModi["f_companyid"]);
            $reModi['area'] = M("taskmtareaqty")->where("f_taskid=".$reModi["f_tid"])->select();

            $content = M("taskmtattach")->where("f_taskid=".$taskid)->find();
            if (isset($content)) {
                $reModi['attachOne'] = M("files")->where("f_id=".$reModi["f_fileid1"])->find();
                $reModi['attachTwo'] = M("files")->where("f_id=".$reModi["f_fileld2"])->find();
                $reModi['attachThree'] = M("files")->where("f_id=".$reModi["f_fileid3"])->find();
                $reModi['attachFour'] = M("files")->where("f_id=".$reModi["f_fileid4"])->find();
                $reModi['attachFive'] = M("files")->where("f_id=".$reModi["f_fileid5"])->find();
                $reModi['attachSix'] = M("files")->where("f_id=".$reModi["f_fileid6"])->find();
                $reModi['attachSeven'] = M("files")->where("f_id=".$reModi["f_fileid7"])->find();
                $reModi['linkOne'] = C("WebUrl").'/Public/upfile/'.$reModi['attachOne']['f_filepath'].$reModi['attachOne']['f_filename'];
                $reModi['linkTwo'] = C("WebUrl").'/Public/upfile/'.$reModi['attachTwo']['f_filepath'].$reModi['attachTwo']['f_filename'];
                $reModi['linkThree'] = C("WebUrl").'/Public/upfile/'.$reModi['attachThree']['f_filepath'].$reModi['attachThree']['f_filename'];
                $reModi['linkFour'] = C("WebUrl").'/Public/upfile/'.$reModi['attachFour']['f_filepath'].$reModi['attachFour']['f_filename'];
                $reModi['linkFive'] = C("WebUrl").'/Public/upfile/'.$reModi['attachFive']['f_filepath'].$reModi['attachFive']['f_filename'];
                $reModi['linkSix'] = C("WebUrl").'/Public/upfile/'.$reModi['attachSix']['f_filepath'].$reModi['attachSix']['f_filename'];
                $reModi['linkSeven'] = C("WebUrl").'/Public/upfile/'.$reModi['attachSeven']['f_filepath'].$reModi['attachSeven']['f_filename'];
            }
            
            $reModi['f_note'] = trim($reModi['f_note']);  
            $reModi['f_note'] = ereg_replace("\t","",$reModi['f_note']);  
            $reModi['f_note'] = ereg_replace("\r\n","",$reModi['f_note']);  
            $reModi['f_note'] = ereg_replace("\r","",$reModi['f_note']);  
            $reModi['f_note'] = ereg_replace("\n","",$reModi['f_note']);
        }elseif($tasktypeid==7){
            $j=array("LEFT JOIN t_tasksmallinfo ON t_tasksmallinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtbaseinfo ON t_taskmtbaseinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtdetailedinfo ON t_taskmtdetailedinfo.f_taskid = t_task.f_tid","LEFT JOIN t_taskmtgoodsdetail ON t_taskmtgoodsdetail.f_taskid = t_task.f_tid");
            $reModi = M('task')->where("t_task.f_tid=".$taskid)->join($j)->order('t_task.f_creatdate desc')->find();
            $reModi['tubiao'] = M("files")->where("f_id=".$reModi["f_fileid"])->find();
            $reModi['company'] = $this->getCompanyDetail($reModi["f_companyid"]);
            $reModi['detail'] = M('surveytaskdetail')->where('f_taskid='.$taskid)->select();
            foreach ( $reModi['detail'] as $key => $value) {
                $reModi['detail'][$key]['answer']= explode('|', $value['f_options']);
            }
            $reModi['f_taskrequirements'] = trim($reModi['f_taskrequirements']);  
            $reModi['f_taskrequirements'] = ereg_replace("\t","",$reModi['f_taskrequirements']);
            $reModi['f_taskrequirements'] = ereg_replace("\r\n","",$reModi['f_taskrequirements']);
            $reModi['f_taskrequirements'] = ereg_replace("\r","",$reModi['f_taskrequirements']);
            $reModi['f_taskrequirements'] = ereg_replace("\n","",$reModi['f_taskrequirements']);
        }

        // var_dump($reModi);
        // exit();
        $this->assign('taskid',$taskid);
        $this->assign('reModi',$reModi);
        $this->assign('tasktypeid',$tasktypeid);

        if ($tasktypeid==3) {
            $this->display("businessPreview");
        }elseif ($tasktypeid==2 || $tasktypeid==4 || $tasktypeid==5 || $tasktypeid==6) {
            $this->display("widelyPreview");
        }elseif ($tasktypeid==1) {
            $this->display("pushPreview");
        }elseif ($tasktypeid==7) {
            $this->display("checkPreview");
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

    function showProReject($taskid){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $taskid = isset($_GET['taskid'])? $_GET['taskid'] : 0 ;
        $this->assign("taskid",$taskid);



        $map["f_taskid"]=$taskid;
        $result = M("taskreject")->where($map)->order('f_indexid asc')->select();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $result[$key]['user'] = M("sysuser")->where("id=".$value["f_rejectuserid"])->find();
                $result[$key]['f_datetime'] = date("Y/m/d H:i:s",$value['f_datetime']);
            }
            $this->assign("reModi","000000");
        }

        $this->assign("result",$result);


        $this->display();
    }

    //督查赚网点定位
    function  check_dingwei(){
        $this->assign("network_address",I("get.network_address"));
        $this->assign("network_name",I("get.network_name"));
        $this->assign("longitude",I("get.longitude"));
        $this->assign("latitude",I("get.latitude"));
        $this->display();
    }

    //稽核赚网点数据添加编辑
    function  audit_data_edit(){
        $in_arr=I("post.");
        $map["f_super_id"]=$in_arr["aduit_id"];
        $map["f_task_id"]=$in_arr["taskid"];
        $map["f_network_name"]=$in_arr["network_name"];
        $map["f_network_address"]=$in_arr["network_address"];
        $map["f_claim_num"]=$in_arr["net_claim_num"];
        $map["f_longitude"]=$in_arr["longitude"];
        $map["f_latitude"]=$in_arr["latitude"];
        $map["f_range"]=$in_arr["range"];
        $map["f_uptime"]=time();

        if($in_arr["aduit_id"]==""){
            $re=M("tasksuperaddress")->add($map);
            if($re>0){
                $result["error_code"]="success";
                $result["audit_id"]=$re;
            }else{
                $result["error_code"]="fail";
            }

        }else{
            $re=M("tasksuperaddress")->where("f_super_id=".$in_arr["aduit_id"])->save($map);
                $result["error_code"]="success";
                $result["audit_id"]=$in_arr["aduit_id"];
        }

        echo json_encode($result);

    }

    //稽核赚网点数据删除
    function  audit_data_del(){
        $in_arr=I("post.");
        $re=M("tasksuperaddress")->delete($in_arr["checklist"]);
        if($re>0){
            $result["error_code"]="success";
            $result["delte_id"]=$in_arr["checklist"];
        }else{
            $result["error_code"]="fail";
        }

        echo json_encode($result);

    }

    function  cpush_auit(){
        $in_arr=I("post.");
        $map['f_totalcopies'] =$in_arr['pro_taskBrand'];
        $map['f_eachcoin'] =$in_arr['pro_taskProduct'];
        $map['f_eachscore'] =$in_arr['eachscore'] == "" ? 3 :$in_arr['eachscore'];
        $map['f_drawcopies'] = 0;
        $map['f_taskrequirements'] =html_entity_decode(stripslashes($in_arr['editor']));
        $map['f_total_commisson']=$in_arr['total_commisson'];

        $indexid = $in_arr['indexid'];
        if ($indexid != 0) {    //编辑
            $re = M("tasksmallinfo")->where('f_indexid=' . $indexid)->save($map);
            $result["audit_smallid"]=$indexid;
        } else { //新增
            $re = M("tasksmallinfo")->add($map);
            $result["audit_smallid"]=$re;
        }
          $result['error_code'] = 'success';
          $result['error_text'] = '';
          echo json_encode($result);
    }


    //网点数据的导入页面显示
    function audit_Import_data(){
         $this->assign("taskid",I("get.audit_taskid"));
         $this->display();
    }

    //网点数据的导入
    function  audit_import_do(){
        header("Content-type:text/html;charset:utf-8");
        //全局变量
        $error_line = [];
        $succ_result=0;
        $error_result=0;
        $taskid=I("post.taskid");
        $file=$_FILES['filename'];
        $max_size="2000000"; //最大文件限制（单位：byte）
        $fname=$file['name'];
        $ftype=strtolower(substr(strrchr($fname,'.'),1));
        $dir=dirname(__FILE__);                       //获取当前脚本的绝对路径
        $dir=str_replace("//","/",$dir)."/";
        //文件格式
        $uploadfile=$file['tmp_name'];
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(is_uploaded_file($uploadfile)){
                if($file['size']>$max_size){
                    echo "<span style='color:red;font-size:12px;'>文件过大</span>";
                    exit;
                }
                if($ftype!='xls' && $ftype!='xlsx' && $ftype!='xlsm' && $ftype!='xltx' && $ftype!='xltm' && $ftype!='xlsb' && $ftype!='xlam'){
                    echo "<span style='color:red;font-size:12px;'>文件格式错误</spa>";
                    exit;
                }
            }else{
                echo "<span style='color:red;font-size:12px;'>文件为空</spa>";
                exit;
            }
        }
        $filename='uploadFile.xls';

        $result=move_uploaded_file($uploadfile,$dir.$filename);//假如上传到当前目录下
        if($result)  //如果上传文件成功，就执行导入excel操作
        {
            require_once dirname(dirname(dirname(__FILE__))).'/Taskadmin/ExcelImport/Classes/PHPExcel.php';
            require_once dirname(dirname(dirname(__FILE__))).'/Taskadmin/ExcelImport/Classes/PHPExcel/IOFactory.php';
            require_once dirname(dirname(dirname(__FILE__))).'/Taskadmin/ExcelImport/Classes/PHPExcel/Reader/Excel5.php';


            $objReader = \PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
            $objPHPExcel = $objReader->load($dir.$filename);

            $sheet = $objPHPExcel->getSheet(0);

            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $arr_result=array();
            $strs=array();
            $list=array();
            $count=0;
            $page=0;
            for($j=2;$j<=$highestRow;$j++)
            {
                unset($arr_result);
                unset($strs);
                for($k='A';$k<= $highestColumn;$k++)
                {
                    //读取单元格
                    $arr_result.= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().',';
                }
                $strs=explode(",",$arr_result);  //单元格中数据拆分
                //数据
                $map["f_network_name"]= $strs[0]; //网点名称
                $map["f_network_address"] = $strs[1]; //网点地址
                $map["f_claim_num"] = $strs[2]; //可认领数
                $map["f_range"] = $strs[3];  //范围
                $url="http://api.map.baidu.com/geocoder/v2/?address=".$strs[1]."&output=json&ak=sjYlqlip1FNoae6Q8GKLjd7k";
                $res=file_get_contents($url);
                $location=json_decode($res,true);
                if($location["status"]==0){
                    //经度
                    $longitude=round($location["result"]["location"]["lng"],6);
                    //纬度
                    $latitude=round($location["result"]["location"]["lat"],6);
                }else{
                    echo "<span style='color:red;font-size:12px;'>第".$j."行自动获取经纬度失败!建议手动添加<br/></span>";
                    $error_result+=1;
                    continue;
                }

                $taskid=$taskid;
                //必填项为空时跳过
                if( empty($strs[0]) || empty($strs[1])|| empty($strs[2])|| empty($strs[3])){
                    echo "<span style='color:red;font-size:12px;'>第".$j."行必填项为空<br/></span>";
                    $error_result+=1;
                    continue;
                }
                //经纬度是否为空
                if(empty($longitude)||empty($latitude)){
                    echo "<span style='color:red;font-size:12px;'>第".$j."行自动获取经纬度失败!建议手动添加<br/></span>";
                    $error_result+=1;
                    continue;
                 }

                $map["f_longitude"]=$longitude;
                $map["f_latitude"]=$latitude;
                $map["f_task_id"]=$taskid;
                $map["f_uptime"]=time();
                //根据网点地址获取经纬度
                 $re=M("tasksuperaddress")->add($map);
                //插入数据到库中
                if($re>0){
                    $succ_result+=1;
                }else{
                    $error_result+=1;
                    $error_line[] = $j; //第几行出错
                }
            }
        }

        $list=M("tasksuperaddress")->where("f_task_id=".$taskid)->order("f_uptime")->select();
        $count=M("tasksuperaddress")->where("f_task_id=".$taskid)->count();
        $page=$count%5;
        if($page==0){
            $page=$count/5;
        }else{
            $page=intval($count/5)+1;
        }
        $this->assign('page',$page);
        $this->assign('count',$count);
        $this->assign('list',json_encode($list));
        $this->assign('error_line',$error_line);
        $this->assign('succ_result',$succ_result);
        $this->assign('error_result',$error_result);
        unlink($dir.$filename); //删除临时生成的文件
        $this->display();
    }

}
