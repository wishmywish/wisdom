<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController {
	private $in_arr;  //POST,GET参数数组
	private $userID; //userid
	private $companyId; //companyId
   	
	/* 运营管理入口 */
	public function main() {
		$this->init();
		//取得公告列表
		$json_NoticeListdata = $this->getNoticeList ();
		$this->showHtml("getNoticeList",$json_NoticeListdata);
		//取得报告审阅人
		$json_WorkSetdata = $this->getWorkSet();
		$this->showHtml("getWorkSet",$json_WorkSetdata);
		
		$this->display();
	}

	public  function  index()
	{
        $this->display();
		if (cookie('loginstrats') != 1) { //登录不成功，没登录
			$this->redirect("Login/login");  //测试QQ，先注释
		} else {    //登录过，cookie 值还生效
			$this->redirect("Office/index"); //测试QQ，先注释
		}
	}
	/* 取得公告详细入口 */
	public function noticeDetail() {
		$this->init();
		$json_data = $this->viewNotice();
		$this->showHtml("viewNotice",$json_data);
		$this->display();
	}
	
	/* 取得用户列表 */
	public function userList() {
		$this->init();
		$json_data = $this->getUserList();
		echo $json_data;
	}
	
	/* 日报审批人popup画面入口 取得部门树*/
	public function deptList() {
		$this->init();
		$json_data = $this->getNextDeptList();
		$this->showHtml("getNextDeptList",$json_data);
		$this->display();
	}
	
	/* 登陆日报 */
	public function saveReport() {
		//追加日报
		$this->init();
		$json_data = $this->operateWorkReport ();
		//追加审阅人
		
		if ($this->in_arr["recorder"] != ""){
			$this->setWorkSet();
		}
		echo $json_data;
	}
	
	/* 取得全部消息 */
	public function getInfoAll() {
		//$json_data = $this->operateWorkReport ();
		//$this->showHtml("operateWorkReport",$json_data);
		//$this->display();
	}
	
	/* 取得待处理消息 */
	public function getInfoBefore() {
		//$json_data = $this->operateWorkReport ();
		//$this->showHtml("operateWorkReport",$json_data);
		//$this->display();
	}
	
	/* 取得处理后消息 */
	public function getInfoAfter() {
		//$json_data = $this->operateWorkReport ();
		//$this->showHtml("operateWorkReport",$json_data);
		//$this->display();
	}
	
	/* 为HTML返回数据 */
	private function init(){
	   set_theme ();
       $this->in_arr = array_merge($_GET,$_POST);
       $this->userID =cookie("userId");
       $this->companyId =cookie("companyId");
	}
	
	/* 为HTML返回数据 */
	private function showHtml($actionName,$json_data){
		$json_Array = $this->checkApiResult ( $actionName, $json_data );
		$keys = array_keys ( $json_Array );
		for($i = 0; $i < count ( $keys ); $i ++) {
			//echo $actionName.$keys[$i].' value:'.$json_Array[$keys[$i]].'<br>';
			$this->assign ( $actionName.'_' . $keys [$i], $json_Array [$keys [$i]] );
		}
	}
	
	/* 调用API getNextDeptList  返回部门列表*/
	private function  getNextDeptList(){
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getNextDeptList",
				"userId" => "9029",
				"isTopDept"=>"0",
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API getUserList  取得登陆用户所属公司下的员工列表 */
	private function getUserList() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getUserList",
				"userId" => "423",
				"queryStart"=>"1",
				"queryEnd"=>"10000",
				"deptId"=>$this->in_arr["deptId"]
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API getWorkSet 取得审阅人 */
	private function getWorkSet() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getWorkSet",
				"userId" => "423",
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API saveWorkSet  设置审阅人 */
	private function setWorkSet() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "setWorkSet",
				"userId" => "423",
				"recorder" => $this->in_arr["recorder"]
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API getNoticeList  取得公告列表*/
	private function getNoticeList() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getNoticeList",
				"userId" => "423",
				"companyId" => "1",
				"queryStart" => "1",
				"queryEnd" => "6" 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API viewNotice 取得公告明细*/
	private function viewNotice() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "viewNotice",
				"userId" => "423",
				"companyId" => "1",
				"messageId" =>$this->in_arr["messageId"],
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	private function getWorkReportId(){
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getWorkReportId",
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API operateWorkReport */
	private function operateWorkReport() {
		
		$json_data =$this->getWorkReportId();
		$json_Array = json_decode ( $json_data, true );
		$command = "operateWorkReport"; // 请求命令
		$userId = "423"; // 用户ID
		$source = "1"; // 来源 web:1;mobile:2
		$reportId = $json_Array["reportId"]; // 工作报告ID 
		$reportType = $this->in_arr["reportType"];// 工作报告类型 日报:1;周报:2;月报:3
		$startDate = $this->in_arr["startDate"]; // 工作报告开始时间 可以为空
		$endDate = $this->in_arr["endDate"]; // 工作报告结束时间 可以为空
		$subject = ""; // 工作报告标题 可以为空 标题格式(日报：年-月-日  工作日报);周报格式(周报：年-月-日--年-月-日 工作周报);月报格式(月报：年-月 工作月报).
		$oType = "1"; // 操作类型 新增:1;编辑:2.
		$voiceCount = "1"; // 工作报告语音条数 可以为空  最多5条
		$reportState = "2"; // 工作报告提交审核或保存1,保存,2 提交审核
		$reportContent =$this->in_arr["reportContent"];  // 工作报告内容
		$voices=$this->in_arr["voices"]; 
		$url = C ( "OperatehttpUrl" ) . $url;
		if ($reportType == "1"){
			$subject = "日报：".$startDate."  工作日报";
			$startDate = $this->in_arr["date"];
			$endDate = $this->in_arr["date"];
		}elseif($reportType == "2"){
			$subject = "周报：".$startDate."--".$endDate."  工作周报";
		}elseif($reportType == "3"){
			$subject = "月报：".date("Y-m",strtotime($this->in_arr["date"]))."  工作月报";
			$startDate = date("Y-m",strtotime($this->in_arr["date"]))."-01";
			$endDate = date("Y-m",strtotime($this->in_arr["date"]))."-".date("t",strtotime($this->in_arr["date"]));
		}
		
		
		$json_data =$this->getWorkReportId();
		$json_Array = json_decode ( $json_data, true );
		
		$data = array (
				"command" => $command,
				"userId" => $userId,
				"source" => $source,
				"reportId" => $reportId,
				"reportType" => $reportType,
				"startDate" =>$startDate,
				"endDate" =>$endDate,
				"subject" => $subject,
				"oType" => $oType,
				"voiceCount" => $voiceCount,
				"reportState" => $reportState,
				"reportContent" => $reportContent,
				"voices" => $voices 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 判断API返回值*/
	private function checkApiResult($apiName, $apiReturnValue) {
		$json_Array = json_decode ( $apiReturnValue, true );
		$ErrorValue = "";
		if ($json_Array ['conf_auth'] == "F") {
			$ErrorValue = "COMMAND不存在。";
		}
		if ($json_Array ['error_code'] != "success") {
			$ErrorValue = $json_Array ['error_text'];
		}
		$this->assign ( $apiName . '_ErrorMsg', $ErrorValue );
		return $json_Array;
	}
}


