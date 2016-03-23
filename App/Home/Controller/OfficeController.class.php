<?php

namespace Home\Controller;

use Think\Controller;

class OfficeController extends CommonController {
	private $in_arr; // POST,GET参数数组
	private $userID; // userid
	private $companyId; // companyId
	private $pageSize = 10; //每页显示数
	
	// 删除公告
	public function deleteNotice() {
		$this->init ();
		$json_data = $this->delNotice ();
		//$this->showHtml ( "delNotice", $json_data );
		echo $json_data;
	}
	
	// 删除签到地址
	public function deleteGPSTypeAddDetail() {
		$this->init ();
		$json_data = $this->delGPSTypeAddDetail ();
		echo $json_data;
	}

	public function delNoticeBoard() {
		$this->init ();
		$json_data = $this->deleteNoticeBoard ();
		echo $json_data;
	}
	
	/* 取得编辑地址详细入口  编辑地址详细画面*/
	public function addressEdit() {
		$this->init ();
	
		$json_data = $this->queryGPSTypeAddDetail ();
		$arr_data = json_decode($json_data, true);
		$this->assign("GPSTypeAddDetail", $json_data);

		$countryList = $this->getCountryList();
		$this->assign("countryList", $countryList);
		$this->display ();
	}
	
	// 删除公告
	public function  setTopMessage() {
		$this->init ();
		$json_data = $this->topMessage ();
		//$this->showHtml ( "delNotice", $json_data );
		echo $json_data;
	}
	
	// 企业通讯录新增客户
	public function addClient() {
		$this->init ();
		// 客户详情
		$customerDetail = $this->viewCustomer();
		$this->assign("customerDetail", $customerDetail);
		$json_data = $this->getDictByCondition (28);
		$this->showHtml ( "getDictByCondition28", $json_data );
		$json_data = $this->getDictByCondition (29);
		$this->showHtml ( "getDictByCondition29", $json_data );
		$json_data = $this->getDictByCondition (30);
		$this->showHtml ( "getDictByCondition30", $json_data );
		$this->display ();
	}

	// 企业通讯录客户详情
	public function customerDetails() {
		$this->init ();

		// 客户详情
		$customerDetail = $this->viewCustomer();
        $cusId = $customerDetail['cusId'];//客户id
		$this->assign("customerDetail", $customerDetail);

		// 联系人列表
		$customerClientList = $this->searchCusClient(1,5);
		$this->assign("customerClientList", $customerClientList);
        $page['total_client'] = $customerClientList['count'];
        $page['pageSize_client'] = 5;
        $page['currentPage_client'] = 1;
        $page['totalPage_client'] = ceil($page['total_client']/$page['pageSize_client']);

        //商机列表
        $bizList = $this->getBizList($cusId);
        $this->assign("bizList",$bizList['bizList']);
        $page['total_biz'] = $bizList['count'];
        $page['pageSize_biz'] = 5;
        $page['currentPage_biz'] = 1;
        $page['totalPage_biz'] = ceil($page['total_biz']/$page['pageSize_biz']);


        //拜访计划列表
        $visitPlanList = $this->getVisitPlanList($cusId);
        $this->assign("visitPlanList",$visitPlanList['visitPlanList']);
        $page['total_visitPlan'] = $visitPlanList['count'];
        $page['pageSize_visitPlan'] = 5;
        $page['currentPage_visitPlan'] = 1;
        $page['totalPage_visitPlan'] = ceil($page['total_visitPlan']/$page['pageSize_visitPlan']);


        //拜访记录列表
        $visitRecordList = $this->getVisitRecordList($cusId);
        $this->assign("visitRecordList",$visitRecordList['visitRecordList']);
        $page['total_visitRecord'] = $visitRecordList['count'];
        $page['pageSize_visitRecord'] = 5;
        $page['currentPage_visitRecord'] = 1;
        $page['totalPage_visitRecord'] = ceil($page['total_visitRecord']/$page['pageSize_visitRecord']);


        //合同列表
        $contractList = $this->getContractList($cusId);
        $this->assign("contractList",$contractList['list']);
        $page['total_contract'] = $contractList['count'];
        $page['pageSize_contract'] = 5;
        $page['currentPage_contract'] = 1;
        $page['totalPage_contract'] = ceil($page['total_contract']/$page['pageSize_contract']);

        //回款列表
        $payBackList = $this->getPayRecordList($cusId);
        $this->assign("payBackList",$payBackList['list']);
        $page['total_payBack'] = $payBackList['count'];
        $page['pageSize_payBack'] = 5;
        $page['currentPage_payBack'] = 1;
        $page['totalPage_payBack'] = ceil($page['total_payBack']/$page['pageSize_payBack']);

        $this->assign("page",$page);
		$this->display ();
	}

    //添加商机 选择联系人列表
    public function selectLinkman(){

        // 联系人列表
        $pageSize = 8;
        $customerClientList = $this->searchCusClient(1,$pageSize);
        $this->assign("customerClientList", $customerClientList);
        //分页
        $totalRecord = intval($customerClientList['count']);  //总记录数
        $page['current'] = 1; //当前页
        $page['size'] = $pageSize; //每页显示记录数
        $page['total'] = ceil($totalRecord/$page['size']); //总页数
        $this->assign("page",$page);

        $this->display();
    }

    //选择联系人列表  单选
    public function selectLinkman_one(){

        // 联系人列表
        $pageSize = 8;
        $customerClientList = $this->searchCusClient(1,$pageSize);
        $this->assign("customerClientList", $customerClientList);
        //分页
        $totalRecord = intval($customerClientList['count']);  //总记录数
        $page['current'] = 1; //当前页
        $page['size'] = $pageSize; //每页显示记录数
        $page['total'] = ceil($totalRecord/$page['size']); //总页数
        $this->assign("page",$page);

        $this->display();
    }

	// 添加编辑客户联系人
	public function addLinkman(){
		$this->init ();
		// 客户详情
		$customerDetail = $this->viewCustomer();
		$this->assign("customerDetail", $customerDetail);
		// 联系人详情
		$linkDetail = $this->viewCusClient();
		$this->assign("linkDetail", $linkDetail);
		$this->display ();
	}

	/* 运营管理入口 */
	public function index() {
		$this->init ();
		// 取得公告列表
		$json_NoticeListdata = $this->getNoticeList (1,"1","10");
		$this->showHtml ( "getNoticeList", $json_NoticeListdata );
		// 取得报告审阅人
		$json_WorkSetdata = $this->getWorkSet ();
		$this->showHtml ( "getWorkSet", $json_WorkSetdata );
		// 预先定义的流程节点处理人
		// 报销
		$reimbursementNodeList = $this->getDefineProcessNodeList("2");
		$this->showHtml ( "reimbursementNodeList", $reimbursementNodeList );
		// 请假
		$leaveNodeList = $this->getDefineProcessNodeList("3");
		$this->showHtml ( "leaveNodeList", $leaveNodeList );
		// 出差
		$travelNodeList = $this->getDefineProcessNodeList("4");
		$this->showHtml ( "travelNodeList", $travelNodeList );
		// 费用
		$costNodeList = $this->getDefineProcessNodeList("1");
		$this->showHtml ( "costNodeList", $costNodeList );
		// 加班
		$overWorkNodeList = $this->getDefineProcessNodeList("5");
		$this->showHtml ( "overWorkNodeList", $overWorkNodeList );

		// 消息统计
		$messageCount = $this->getMessageCount();
		$this->showHtml ( "messageCount", $messageCount );
		// 待处理的流程
		$processCountWait = $this->getProcessList(2, 1);
		$this->showHtml ( "processWait", $processCountWait );
		// 已处理的流程
		$processCountApproval = $this->getProcessList(3, 1);
		$this->showHtml ( "processApproval", $processCountApproval );
		// 全部消息
		$messageListAll = $this->getMessageList(1, 1);
		$this->showHtml ( "messageListAll", $messageListAll );
		// 我发起的
		$messageListMy = $this->getMessageList(1, 2);
		$this->showHtml ( "messageListMy", $messageListMy );
		// @我的
		$messageListAt = $this->getMessageList(1, 3);
		$this->showHtml ( "messageListAt", $messageListAt );
		// 积分榜
		$integralRanking = $this->getIntegralRanking();
		$this->showHtml ( "integralRanking", $integralRanking );

		$this->display ();
	}
	
	// 新增公告入口 新增公告画面
	public function noticeAdd() {
		$this->init ();
		if (IS_AJAX) {
			// 追加日报
			echo $this->saveNotice();
		} else {
			$this->showHtml ("queryAllNoticeBoard", $this->queryAllNoticeBoard(1));
			$this->display ();
		}
	}

	// 区域保存入口
	public function saveArea() {
		$this->init ();
		$areaId = $this->in_arr["areaId"];

		if($areaId) {
			// 修改区域
			echo $this->modifyPatrolArea();
		} else {
			// 追加区域
			echo $this->addTabPatrolArea();
		}
	}

	// 消息
	public function addMessage(){
		$this->init();
		$this->display();
	}
	
	// 新增公告入口 新增公告栏目画面
	public function noticeColumnAdd(){
		$this->init();
		$this->display();
	}

	// 新增地址入口
	public function addressAdd(){
		$this->init();
		$countryList = $this->getCountryList();
		$this->assign("countryList", $countryList);
		$this->display();
	}

    //显示百度地图
    public function showMap(){
        $this->display();
    }

	// 回复公告入口 回复公告画面
	public function noticeCommentAdd() {
		$this->init ();
		//取得回复状态
		$json_data = $this->getNoticeCommentType ();
		$this->showHtml ( "getNoticeCommentType", $json_data );
		$this->display ();
	}
	
	/* 取得公告详细入口  公告详细画面*/
	public function noticeDetail() {
		$this->init ();
		$json_data = $this->viewNotice ();
		$arr_data = json_decode($json_data, true);
		// $arr_data['content'] = html_entity_decode($arr_data['content']);
		$arr_data['content'] = htmlspecialchars_decode($arr_data['content']);
		$arr_data['content'] = str_replace("&nbsp;", " ", $arr_data['content']);
		$this->assign("notice", $arr_data);
		$json_file_list = json_decode($this->getAttachList(), true);
  		
  		$updFile = array();
  		if ($json_file_list && $json_file_list['list']) {
  			foreach ($json_file_list['list'] as $key => $file) {
  				$displayName = $json_file_list['list'][$key]['displayName'];
  				$fileUrl = $json_file_list['list'][$key]['fileUrl'];
	  			// $fileUrl = ltrim($json_file_list['list'][$key]['fileUrl'], "file="); 
	  			// $fileUrl = base64_decode($fileUrl);
	  			// $fileUrl = __ROOT__.'/Public/upfile/'. $fileUrl;

	  			$updFile[$key]['attach_file_name'] = $displayName;
	  			$updFile[$key]['attach_file_url'] = $fileUrl;
  			}
  		}
  		
  		$json_data = $this->getVisitList ();
  		$arr_data = json_decode($json_data, true);
  		$this->showHtml ("VisitList", $json_data);
		$this->assign("updFile", $updFile);
		$this->display ();
	}

	/* 取得公告栏目详细入口  公告栏目详细画面*/
	public function noticeBoardDetail() {
		$this->init ();

		$json_data = $this->viewNoticeBoard ();
		$arr_data = json_decode($json_data, true);

		$this->assign("noticeBoard", $arr_data);
		$this->display ();
	}
	
	/* 取得用户列表  AJAX*/
	public function userList() {
		$this->init ();
		$json_data = $this->getUserList ();
		echo $json_data;
	}
	
	/* 日报审批人popup画面入口 取得部门树 */
	public function deptList() {
		$this->init ();
		$json_data = $this->getAllDeptList ();
		$this->showHtml ( "getAllDeptList", $json_data );
		$this->display ();
	}
	
	/* 新增日报  日报保存AJAX*/
	public function saveReport() {
		$this->init ();
		// 追加审阅人
		if ($this->in_arr ["recorder"] != "") {
			$this->setWorkSet ();
		}
		// 追加日报
		$json_data = $this->operateWorkReport ();
		echo $json_data;
	}

	/* 新增费用、报销、请假、出差 保存AJAX*/
	public function saveProcess() {
		$this->init ();
		// 追加日报
		$json_data = $this->createProcess ();
		echo $json_data;
	}

	/* 新增消息 保存AJAX*/
	public function saveMessage() {
		$this->init ();
		// 追加消息
		$json_data = $this->sendMessage ();
		echo $json_data;
	}
  
	// 报告审阅入口文件
	public function reportReview() {
		$this->init ();

		if ($this->in_arr ["selectedDate"] == null or $this->in_arr ["selectedDate"]=="")
		{
			$selectedDate = date("Y-m");
		}else {
			$selectedDate = $this->in_arr ["selectedDate"];
		}

		$this->assign ( 'selectedDate',$selectedDate);
		//$type:日报:1;周报:2;月报:3  通过API取得日报
		$json_data=$this->queryWorkReport($selectedDate."-01",date("Y-m-d",strtotime("+1months",strtotime($selectedDate))),"1");

		//将JSON转化为数组
		$json_Array = json_decode ( $this->dejson($json_data ), true );

		//$type:日报:1;周报:2;月报:3  通过API取得周报
		$monthDateEnd = date("Y-m-d",strtotime("+1months",strtotime($selectedDate)));
		$monthDateEnd = date("Y-m-d",strtotime("-1 day",strtotime($monthDateEnd)));
		$json_data_weeks = $this->queryWorkReport($selectedDate."-01",$monthDateEnd,"2");
		//将JSON转化为数组
		$json_weeks_Array = json_decode ( $this->dejson($json_data_weeks), true);

		//$type:日报:1;周报:2;月报:3  通过API取得月报

		$json_data_month = $this->queryWorkReport($selectedDate."-01",$monthDateEnd,"3");
		//将JSON转化为数组
		$json_month_Array = json_decode ( $this->dejson($json_data_month), true);

		//循环日报
		$count  =  count($json_Array["list"]);
		$count_weeks = count($json_weeks_Array["list"]);
		$count_month = count($json_month_Array["list"]);
		$reportDate="";
		//当月1号是星期几
		$weekDay = date('w',strtotime($selectedDate."-01"));
		$d = strtotime($selectedDate."-01");
		$days;
		$weeks;
		$month;
		for  ($i=1;  $i<=date('t',$d);  $i++)  {
			$days_value = array("day" => $i,"value" => "","id"=>"");
			$days[$i+$weekDay] = $days_value;
			$weeks[$i+$weekDay] = $days_value;

			if($i == date('t',$d)) {
				if($count_month > 0) {
					$reportDay = date("d",strtotime($reportDate));
					$str = "";
					$content = str_replace("\r\n"," ",$json_month_Array["list"][0]["content"]);
					$content = str_replace("&nbsp;", ' ', $content);
					$content = str_replace("％", '%', $content);
					$valueLength = $this->utf8_strlen($content);
					if($valueLength > 10) {
						$str = "...";
					}
					$days_value = array("day" => intval($reportDay, 10),"value" => (mb_substr($content,0,10, 'utf-8').$str),"id"=>$json_month_Array["list"][0]["reportId"],"value_t" =>str_replace(" ", '', $content));
					$month[$i+$weekDay] = $days_value;
				}
			} else {
				$month[$i+$weekDay] = $days_value;
			}
		}
		
		for  ($i=0;  $i<$count;  $i++)  {
			$reportDate = str_replace("工作日报","",$json_Array["list"][$i]["title"]);
			$reportDate = str_replace("日报：","",$reportDate);
			$reportDate = str_replace(" ","",$reportDate);
			$reportDate = str_replace("&nbsp;","",$reportDate);

			if ($this->checkDateIsValid($reportDate)){
				//取得日报的日期（只取日）
				$reportDay = date("d",strtotime($reportDate));
				$str = "";
				$content =str_replace("\r\n"," ",$json_Array["list"][$i]["content"]);
				$content = str_replace("&nbsp;", ' ', $content);
				$content = str_replace("％", '%', $content);
				$valueLength = $this->utf8_strlen($content);
				if($valueLength > 10) {
					$str = "...";
				}
				$days_value = array("day" => intval($reportDay, 10),"value" => (mb_substr($content,0,10, 'utf-8').$str),"id"=>$json_Array["list"][$i]["reportId"],"value_t" =>str_replace(" ", '', 	$content));
				$days[$reportDay+$weekDay] = $days_value;
			}
		}

		for($i = 0; $i < $count_weeks; $i++) {
			$weeksDate = str_replace("工作周报", "", $json_weeks_Array["list"][$i]["title"]);
			$weeksDate = str_replace("周报：", "", $weeksDate);
			$weeksDate = str_replace(" ", "", $weeksDate);
			$weeksDate = str_replace("&nbsp;","",$weeksDate);
			$weeksDateList = explode("--", $weeksDate);

			$reportDate = $weeksDateList[1];
			if ($this->checkDateIsValid($reportDate)){
				//取得周报的日期（只取日）
				$reportDay = date("d",strtotime($reportDate));
				$str = "";
				$content = str_replace("\r\n"," ",$json_weeks_Array["list"][$i]["content"]);
				$content = str_replace("&nbsp;", ' ', $content);
				$content = str_replace("％", '%', $content);
				$valueLength = $this->utf8_strlen($content);
				if($valueLength > 10) {
					$str = "...";
				}
				$days_value = array("day" => intval($reportDay, 10),"value" => (mb_substr($content,0,10, 'utf-8').$str),"id"=>$json_weeks_Array["list"][$i]["reportId"],"value_t" =>str_replace(" ", '', $content));
				$weeks[$reportDay+$weekDay] = $days_value;
			}
		}

		if ($this->in_arr ["li_type"]=="li_ri") {
			$startDate = $this->in_arr ["ri_date"];
			$endDate = $this->in_arr ["ri_date"];
		}else if($this->in_arr ["li_type"]=="li_zhou"){
			$startDate = $this->in_arr ["zhou_dateF"];
			$endDate = $this->in_arr ["zhou_dateT"];
		}else if($this->in_arr ["li_type"]=="li_yue"){
			$startDate = $this->in_arr ["yue_date"]."-01";
			$endDate = $this->in_arr ["yue_date"]."-" . date ( "t", strtotime ( $startDate) );
		}else{
			$startDate = $this->in_arr ["startdate"];
			$endDate = $this->in_arr ["endDate"];
		}
		
		//处理审阅日报数据
		if ($startDate == null){
			$startDate = $selectedDate = date("Y-m-d");
			$endDate = $selectedDate = date("Y-m-d");
		}
		
		$pageSize = 10;  //每页显示条数。
		
		$this->assign ( 'pageSize', $pageSize);
		$this->assign ( 'total',"0");
		$this->assign ( 'totalPage',"0");
		if ($this->in_arr ["currentPage"]=="" or $this->in_arr ["currentPage"] == null){
			$this->in_arr ["currentPage"] = 1;
		}
		$this->assign ( "currentPage",$this->in_arr ["currentPage"] );
		
		if ($this->in_arr ["deptNames"]== null){
		} else {
			$this->assign ( 'deptNames', $this->in_arr ["deptNames"]);
		}
		
		if ($this->in_arr ["deptIds"]== null){
		} else {
			$this->assign ( 'deptIds', $this->in_arr ["deptIds"]);
		}
		
		if ($this->in_arr ["userNames"]== null){		
		} else {
			$this->assign ( 'userNames', $this->in_arr ["userNames"]);
		}
		
		if ($this->in_arr ["userIds"]== null){
		} else {
			$this->assign ( 'userIds', $this->in_arr ["userIds"]);
		}
		
		$userIds = $this->in_arr ["userIds"];
		$deptIds = $this->in_arr ["deptIds"];
		$json_data_WorkReportList = $this->getCheckWorkReportList($startDate,$endDate,$pageSize*($this->in_arr ["currentPage"]-1),$this->in_arr ["currentPage"]*$pageSize,$userIds,$deptIds);
			
		$json_Array = $this->checkApiResult ( "getCheckWorkReportList", $json_data_WorkReportList );
		$keys = array_keys ( $json_Array );
		
		for($i = 0; $i < count ( $keys ); $i ++) {
			if ($keys [$i] == "count"){
				$this->assign ( 'total',$json_Array["count"]);
				$this->assign ( 'totalPage',ceil($json_Array["count"]/$pageSize));
			}
			if ($keys [$i] == "list"){
				while(list($key,$value)=each($json_Array["list"]))
				{
					if ($json_Array["list"][$key]['type']==null){$json_Array["list"][$key]['type']="　";}
					if ($json_Array["list"][$key]['state']==null){$json_Array["list"][$key]['state']="　";}
					if ($json_Array["list"][$key]['viewTime']==null){$json_Array["list"][$key]['viewTime']="　";}
					if ($json_Array["list"][$key]['createPerple']==null){$json_Array["list"][$key]['createPerple']="　";}
					if ($json_Array["list"][$key]['title']==null){$json_Array["list"][$key]['title']="　";}
					if ($json_Array["list"][$key]['content']==null){$json_Array["list"][$key]['content']="　";}
					if($json_Array["list"][$key]['type']=='1'){
						$json_Array["list"][$key]['type'] = "日报";
						$json_Array["list"][$key]['title'] = mb_substr($json_Array["list"][$key]['title'],3,10, 'utf-8');
					}else if($json_Array["list"][$key]['type']=='2'){
						$json_Array["list"][$key]['type'] = "周报";
						$json_Array["list"][$key]['title'] = mb_substr($json_Array["list"][$key]['title'],15,10, 'utf-8');
					}else{
						$json_Array["list"][$key]['type'] = "月报";
						$json_Array["list"][$key]['title'] = mb_substr($json_Array["list"][$key]['title'],3,7, 'utf-8');
					}
					if($json_Array["list"][$key]['state']=='3'){
						$json_Array["list"][$key]['state'] = "已审阅";
					}else{
						$json_Array["list"][$key]['state'] = "未审阅";
					}
					$json_Array["list"][$key]['title']=mb_substr($json_Array["list"][$key]['title'],0,30, 'utf-8');//substr($json_Array["list"][$key]['title'],0,30);
					$json_Array["list"][$key]['createPerple']=mb_substr($json_Array["list"][$key]['createPerple'],0,10, 'utf-8');//substr($json_Array["list"][$key]['createPerple'],0,30);
					$json_Array["list"][$key]['content_title']= $json_Array["list"][$key]['content'];
					$str = "";
					$content = str_replace("\r\n"," ", $json_Array["list"][$key]['content']);
					$content = str_replace("&nbsp;", ' ', $content);
					$content = str_replace("％", '%', $content);
					$valueLength = $this->utf8_strlen($content);
					if($valueLength > 15) {
						$str = "...";
					}
					$json_Array["list"][$key]['content']= mb_substr($content,0,15, 'utf-8').$str;
				}
			}
			$this->assign ( 'getCheckWorkReportList_' . $keys [$i], $json_Array [$keys [$i]] );
		}
		$this->assign ( 'days', $days);
		$this->assign ( 'weeks', $weeks);
		$this->assign ( 'month', $month);
		$this->setReportData ();
		$this->display ();
	}

	public function utf8_strlen($string = null) {
		// 将字符串分解为单元
		$string = str_replace("&lt;", "1", $string);
		$string = str_replace("&gt;", "2", $string);
		preg_match_all("/./us", $string, $match);
		// 返回单元个数
		return count($match[0]);
	}
	
	/* 考勤一览画面入口  考勤列表画面*/
	public function setReportData() {
		 //审阅报告：1；我的报告：0
	    if ($this->in_arr ["showDiv"]=="0"   or $this->in_arr ["showDiv"]==null){
	    	$this->assign ( 'showDiv', "0");
	    }else{
	    	$this->assign ( 'showDiv', "1");
	    }
	   //审阅日报 日 周 月 区间 设置
	    if ($this->in_arr ["li_type"]== null){
	    	$this->assign ( 'li_type', "li_ri");
	    }else 
	    {
	    	$this->assign ( 'li_type', $this->in_arr ["li_type"]);
	    }
	    //审阅日报 日设置
        if ($this->in_arr ["ri_date"] == null){
        	//$this->assign ( 'ri_date', "2015-09-15");
        }else {
        	$this->assign ( 'ri_date',$this->in_arr ["ri_date"]);
        }
        //审阅日报 月设置
        if ($this->in_arr ["yue_date"] == null){
        	//$this->assign ( 'yue_date', "2015-09");
        }else {
        	$this->assign ( 'yue_date',$this->in_arr ["yue_date"]);
        }
        //审阅日报 周设置
        if ($this->in_arr ["zhou_dateF"] == null){
        	//$this->assign ( 'zhou_dateF', "2015-09-15");
        	//$this->assign ( 'zhou_dateT', "2015-09-15");
        }else {
        	$this->assign ( 'zhou_dateF',$this->in_arr ["zhou_dateF"]);
        	$this->assign ( 'zhou_dateT',$this->in_arr ["zhou_dateT"]);
        }
        //审阅日报 区间设置
        if ($this->in_arr ["startdate"] == null){
        	//$this->assign ( 'startdate', "2015-09-15");
        	//$this->assign ( 'enddate', "2015-09-15");
        }else {
        	$this->assign ( 'startdate',$this->in_arr ["startdate"]);
        	$this->assign ( 'enddate',$this->in_arr ["enddate"]);
        }
	}
	
	/* 考勤一览画面入口  考勤列表画面*/
	public function checking($return = 0) {
		$this->init ();
		$json_data = $this->getWorkSignList(1);
		$this->showHtml ("getWorkSignList", $json_data);
		$json_data = $this->queryGPSTypeAddList(1);
		$this->showHtml ("queryGPSTypeAddList", $json_data);
		$this->assign("li_type", $this->in_arr["li_type"]);
		$this->assign("ri_date", $this->in_arr["ri_date"]);
		$this->assign("zhou_dateF", $this->in_arr["zhou_dateF"]);
		$this->assign("zhou_dateT", $this->in_arr["zhou_dateT"]);
		$this->assign("yue_date", $this->in_arr["yue_date"]);
		$this->assign("startdate", $this->in_arr["startdate"]);
		$this->assign("enddate", $this->in_arr["enddate"]);
		$this->assign("deptNames", $this->in_arr["deptNames"]);
		$this->assign("deptIds", $this->in_arr["deptIds"]);
		$this->assign("userNames", $this->in_arr["userNames"]);
		$this->assign("userIds", $this->in_arr["userIds"]);
		$this->assign("return", $return);

		$this->display ();
	}
	
	// 公告入口文件
	public function notice($return = 0) {
		$this->init ();
		// 追加日报
		$json_data = $this->getNoticeList(1);
		$this->showHtml ( "getNoticeList", $json_data );
		$json_data = $this->queryAllNoticeBoard(2);
		$this->showHtml ( "queryAllNoticeBoard", $json_data );
		$json_data = $this->queryAllNoticeBoard(1);
		$this->showHtml ( "queryAllNoticeBoard1", $json_data );
		$json_data = $this->searchNoticeBoard(1);
		$this->showHtml ( "noticeBoardList", $json_data );
		$this->assign("return", $return);
		$this->display ();
	}

	// 工作审批入口文件
	public function approval() {
		$this->init ();
		// 报销列表
		$reimbursement_list = $this->getApprovalList(2, 1);
		// 请假列表
		$leave_list = $this->getApprovalList(3, 1);
		// 出差列表
		$businessTrip_list = $this->getApprovalList(4, 1);
		// 费用列表
		$cost_list = $this->getApprovalList(1, 1);
		// 加班列表
		$overWork_list = $this->getApprovalList(5, 1);

		$this->assign ("reimbursement_list", $reimbursement_list);
		$this->assign ("leave_list", $leave_list);
		$this->assign ("businessTrip_list", $businessTrip_list);
		$this->assign ("cost_list", $cost_list);
		$this->assign ("overWork_list", $overWork_list);
		$this->display ();
	}

	// 消息入口文件
	public function message() {
		$this->init ();
		$message_list = $this->queryMessageList(1);
		$this->assign ("message_list", $message_list);
		$this->display ();
	}

	// 编辑区域管理入口文件
	public function editArea() {
		$this->init ();
		$area_data = $this->getPatrolArea();
		$this->assign ("area_data", $area_data);
		$this->assign ("areaId", $this->in_arr ["areaId"]);
		$this->display ();
	}
	// 通讯录入口文件
	public function contact() {
		$this->init ();
		$dept_list = $this->formatDeptList(true);
		$area_dept_list = $this->formatAreaContactList();
		// $user_list = $this->getUserList(1);
		$user_list = array("page"=>0, "total"=>0, "pageSize"=>$this->pageSize, "totalPage"=>0);
		$area_list = array();
		$customer_list = $this->getCustomerList(1);
		$this->assign ("dept_list", $dept_list);
		$this->assign ("area_dept_list", $area_dept_list);
		$this->assign ("user_list", $user_list);
		$this->assign ("area_list", $area_list);
		$this->assign ("customer_list", $customer_list);
		$this->assign ("return", $this->in_arr ["return"]);

		$this->display ();
	}

	public function reAreaContactList() {
		$this->init ();
		$area_dept_list = $this->formatAreaContactList();
		echo $area_dept_list;
	}

	public function showUserDetail($uid) {
		$userDetail = $this->viewUserDetail($uid);
		$this->assign("userDetail", json_decode($userDetail, true));
		$this->display ();
	}

	/* 取得全部消息 */
	public function getInfoAll() {
		// $json_data = $this->operateWorkReport ();
		// $this->showHtml("operateWorkReport",$json_data);
		// $this->display();
	}
	
	/* 取得待处理消息 */
	public function getInfoBefore() {
		// $json_data = $this->operateWorkReport ();
		// $this->showHtml("operateWorkReport",$json_data);
		// $this->display();
	}
	
	/* 取得处理后消息 */
	public function getInfoAfter() {
		// $json_data = $this->operateWorkReport ();
		// $this->showHtml("operateWorkReport",$json_data);
		// $this->display();
	}
	
	/* 初期化 */
	private function init() {
		set_theme ();
		$re = A ( 'Api' )->getBigC ();
		// pt($re);
		// exit;
		foreach ( $re as $key => $val ) {
			if ($val ['f_sys_column_cid'] == 'Office') {
				$syscolumn_id = $val ['f_syscolumn_id'];
				$sre = A ( 'Api' )->getBigC ( $syscolumn_id );
			}
		}
		
		$this->assign ( 'bigclass', $re );
		$this->assign ( 'smallclass', $sre );
		// $this->display();
		
		$this->in_arr = array_merge ( $_GET, $_POST );
		$this->userID = cookie ( "userId" );
		$this->companyId = cookie ( "companyId" );
		
		//取得用户基本信息
		$json_data = $this->viewUserDetail();
		$this->showHtml ( "viewUserDetail", $json_data );
		
		//token 验证
		//time 请求时间、appVersion 版本号、clientId、reqToken
		$dateTime=date("ymdhis",time());
		$appVersion="";
		$clientId="17804ac281e6ddda";
		$clientKey="fe969a7846a4b7a1";
		$reqToken = md5($clientKey.$appVersion.$dateTime);
		//items={"item2": {"provinceId": "63","countryId": "1","county": "龙岗区","cityId": "358","cusAddress": "","y": "-122.406417","x": "37.785834"},"item3": {"provinceId": "1","countryId": "1","county": "余杭区","cityId": "1","cusAddress": "","y": "30.282442","x": "119.987244"},"item1": {"provinceId": "36","countryId": "1","county": "朝阳区","cityId": "65","cusAddress": "","y": "119.964266","x": "30.268779"},"itemCount": "3"}
		//connection.setRequestProperty("Authorization","{\"time\":\"20151010\",\"reqToken\":\"a2ecd5e6654a0d003d516e6c31ba86ad\",\"appVersion\":\"20150101\",\"clientId\":\"a0b923820dcc509a\"}");
		$Authorization = '{"time":'.'"'.$dateTime.'","reqToken":"'.$reqToken.'","appVersion":"'.$appVersion.'","clientId":"'.$clientId.'"}';
		//echo $Authorization;
		//echo "</br>";
	}
	
	/* 为HTML返回数据 */
	private function showHtml($actionName, $json_data) {
		$json_Array = $this->checkApiResult ( $actionName, $json_data );
		$keys = array_keys ( $json_Array );
		for($i = 0; $i < count ( $keys ); $i ++) {
			// echo $actionName.$keys[$i].' value:'.$json_Array[$keys[$i]].'<br>';
			$this->assign ( $actionName . '_' . $keys [$i], $json_Array [$keys [$i]] );
		}
	}
	
	/*
	 * 调用API saveAttach 10.1 新增附件记录接口
	 * tblname 附件所属业务名称 公告附件:bbsMessage; 工作报告附件:workReport;
	 * linkid 附件所属业务ID    公告ID或工作报告ID
	 * oldName 附件名称
	 * type 附件类型
	 * size 附件大小
	 * returnUrl 附件存储路径加密文本
	 */
	private function saveAttach($tblname,$linkid,$oldName,$type,$size,$returnUrl) {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "saveAttach",
				"tblname" => $tblname,
				"linkid" => $linkid,
				"oldName" => $oldName,
				"type" => $type,
				"size" => $size,
				"returnUrl" => "file=".base64_encode($returnUrl)
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用delNotice 1.4删除公告接口 */
	private function delNotice() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "delNotice",
				"userId" =>$this->userID,
				"messageId" =>$this->in_arr ["messageId"] 
		);
		
		$json_data = postData ( $url, $data );
		return $json_data;
	}

	/* 调用deleteNoticeBoard 9.4删除公告栏目接口 */
	private function deleteNoticeBoard() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "deleteNoticeBoard",
				"userId" =>$this->userID,
				"boardId" =>$this->in_arr ["boardId"] 
		);
		
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用topMessage 1.8公告置顶操作接口 */
	private function topMessage() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "topMessage",
				"userId" =>$this->userID,
				"isTop" =>$this->in_arr ["isTop"],
				"messageId" =>$this->in_arr ["messageId"]
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}

	/* 调用API getDefineProcessNodeList 预先定义的流程节点处理人 */
	private function getDefineProcessNodeList($busiType = "1") {

		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "getDefineProcessNodeList",
				"userId" => $this->userID,
				"busiType" => $busiType,
		);
		$json_data = postData ( $url, $data );
		$obj_data = json_decode($this->dejson($json_data ));
		// 获取头像
		if($obj_data->count > 0) {
			foreach($obj_data->userList as $key => $user) {
				$logo = $this->getHeadLogo($user->headLogo);
				$user->headLogo = $logo;
			}
		}
		$json_data = json_encode($obj_data);
		return $json_data;
	}
	
	/* 调用API getAllDeptList 返回部门列表 */
	private function getAllDeptList() {
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "getAllDeptList",
				"companyId" => $this->companyId
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}

	private function getDictByCondition($type) {
		$url = C ( "OperatehttpUrl" ) . $url;
	
		$data = array (
				"command" => "getDictByCondition",
				"companyId" => $this->companyId,
				"type" => $type,
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	private function getAreaList() {
		$url = C ( "OperatehttpUrl" ) . $url;
	
		$data = array (
				"command" => "getAreaList",
				"companyId" => $this->companyId,
				"userId" => $this->userID,
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}


	/* 调用API 18.5根据企业id获取所有区域 */
	private function getAreaListByCompanyId() {
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "getAreaListByCompanyId",
				"companyId" => $this->companyId
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}

	/* 调用API 12.1 获取国家列表接口 */
	public function getCountryList() {
		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
			"command" => "getCountryList"
		);
		$json_data = postData ( $url, $data );

		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}

	/* 调用API 12.2 获取省份列表接口 */
	public function getProvinceList() {
		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
			"command" => "getProvinceList",
			"countryId" => $this->in_arr ["countryId"],
		);

		$json_data = postData ( $url, $data );

		if (IS_AJAX) {
			echo $json_data;
		} else {
			return $json_data;
		}
	}

	/* 调用API 12.3 获取城市列表接口 */
	public function getCityList() {
		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
			"command" => "getCityList",
			"provinceId" => $this->in_arr ["provinceId"],
		);
		
		$json_data = postData ( $url, $data );

		if (IS_AJAX) {
			echo $json_data;
		} else {
			return $json_data;
		}
	}

	/* 添加回复或评论 */
	public function replyMessage() {
		$this->init ();
		$this->assign ("mesId", $this->in_arr ["mesId"]);
		$this->assign ("commentId", $this->in_arr ["commentId"]);
		$this->assign ("replyToUserId", $this->in_arr ["replyToUserId"]);
    	$this->display();
	}

	/* 首页添加回复或评论 */
	public function replyIndexMessage() {
		$this->init ();
		$this->assign ("mesId", $this->in_arr ["mesId"]);
		$this->assign ("commentId", $this->in_arr ["commentId"]);
		$this->assign ("replyToUserId", $this->in_arr ["replyToUserId"]);
    	$this->display();
	}

	/* 首页请假流程详情 */
	public function showIndexLeaveDetail() {
		$this->init ();
		// 请假详情
		$leave_detail = $this->getApprovalDetail();
		$this->assign ("leave_detail", $leave_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 首页出差流程详情 */
	public function showIndexTravelDetail() {
		$this->init ();
		// 出差详情
		$travel_detail = $this->getApprovalDetail();
		$this->assign ("travel_detail", $travel_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 首页加班流程详情 */
	public function showIndexOverWorkDetail() {
		$this->init ();
		// 出差详情
		$overWork_detail = $this->getApprovalDetail();
		$this->assign ("overWork_detail", $overWork_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 首页费用流程详情 */
	public function showIndexFeeDetail() {
		$this->init ();
		// 费用详情
		$fee_detail = $this->getApprovalDetail();
		$this->assign ("fee_detail", $fee_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 首页报销流程详情 */
	public function showIndexApplyDetail() {
		$this->init ();
		// 报销详情
		$apply_detail = $this->getApprovalDetail();
		$this->assign ("apply_detail", $apply_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 请假流程详情 */
	public function showLeaveDetail() {
		$this->init ();
		// 请假详情
		$leave_detail = $this->getApprovalDetail();
		$this->assign ("leave_detail", $leave_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 加班流程详情 */
	public function showOverWorkDetail() {
		$this->init ();
		// 请假详情
		$overWork_detail = $this->getApprovalDetail();
		$this->assign ("overWork_detail", $overWork_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 出差流程详情 */
	public function showTravelDetail() {
		$this->init ();
		// 出差详情
		$travel_detail = $this->getApprovalDetail();
		$this->assign ("travel_detail", $travel_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 费用流程详情 */
	public function showFeeDetail() {
		$this->init ();
		// 费用详情
		$fee_detail = $this->getApprovalDetail();
		$this->assign ("fee_detail", $fee_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 报销流程详情 */
	public function showApplyDetail() {
		$this->init ();
		// 报销详情
		$apply_detail = $this->getApprovalDetail();
		$this->assign ("apply_detail", $apply_detail);
		$this->assign ("userId", $this->userID);
		$this->assign ("page", $this->in_arr ["page"]);
    	$this->display();
	}

	/* 我的日志-工作报告详情 */
	public function showReport() {
		$this->init ();
		// 工作报告详情
		$work_report = $this->viewWorkReport();
		$this->assign ("work_report", $work_report);
		// 获取工作报告附件
		$attach_list = $this->getAttachListReport();
		$this->assign ("attach_list", $attach_list);
		// 获取批复意见
		$comment_list = $this->viewWorkReportComment();
		$this->assign ("comment_list", $comment_list);

    	$this->display();
	}

	/* 日志审阅-工作报告详情 */
	public function showReportReviewDetail() {
		$this->init ();
		// 工作报告详情
		$work_report = $this->viewWorkReport();
		$this->assign ("work_report", $work_report);
		// 获取工作报告审阅人
		$work_set = $this->getWorkSet();
		$this->assign ("work_set", json_decode($work_set, true));
		// 获取工作报告附件
		$attach_list = $this->getAttachListReport();
		$this->assign ("attach_list", $attach_list);
		// 获取批复意见
		$comment_list = $this->viewWorkReportComment();
		$this->assign ("comment_list", $comment_list);

		$this->assign ("reportID", $this->in_arr ["reportID"]);
    	$this->display();
	}

	/* 日志审阅-审批提交 */
	public function saveWorkReportComment() {
		$this->init ();
		// 工作报告查阅接口 set state = 3
		$work_report = $this->checkWorkReport();
		// 工作报告新增评论接口
		$work_report_coment = $this->saveWorkReportComent();

		echo $work_report_coment;
	}

	/* 调用API saveWorkReportComent 工作报告新增评论接口 */
	public function saveWorkReportComent() {
		$this->init ();

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "saveWorkReportComment",
				"userId" => $this->userID,
				"reportId" => $this->in_arr ["reportID"],
				"content" => $this->in_arr ["content"],
		);
		$json_data = postData ( $url, $data );

		// $arr_data = json_decode($json_data, true);
		return $json_data;
	}

	/* 调用API viewWorkReportComment 2.10工作报告评论查看接口 */
	public function viewWorkReportComment() {
		$this->init ();

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "viewWorkReportComment",
				"reportId" => $this->in_arr ["reportID"],
		);
		$json_data = postData ( $url, $data );
		$arr_data = json_decode($json_data, true);
		return $arr_data;
	}

	/* 调用API checkWorkReport 工作报告查阅接口 */
	public function checkWorkReport() {
		$this->init ();

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "checkWorkReport",
				"eid" => $this->userID,
				"wid" => $this->in_arr ["reportID"],
		);
		$json_data = postData ( $url, $data );

		// $arr_data = json_decode($json_data, true);
		return $json_data;
	}

	/* 调用API viewCustomer 返回客户详情 */
	public function viewCustomer() {
		$this->init ();

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "viewCustomer",
				"cusId" => $this->in_arr['cusId'],
		);
		$json_data = postData ( $url, $data );

		$arr_data = json_decode($json_data, true);
		return $arr_data;
	}

	/* 调用API viewCusClient 返回客户联系人详情 */
	public function viewCusClient() {
		$this->init ();

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "viewCusClient",
				"clientId" => $this->in_arr['clientId'],
		);
		$json_data = postData ( $url, $data );

		$arr_data = json_decode($json_data, true);
		return $arr_data;
	}

	/* 调用API viewWorkReport 返回工作报告详情 */
	public function viewWorkReport() {
		$this->init ();

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "viewWorkReport",
				"userId" => $this->userID,
				"reportId" => $this->in_arr ["reportID"],
		);
		$json_data = postData ( $url, $data );

		$arr_data = json_decode($json_data, true);
		return $arr_data;
	}

	/* 调用API viewProcessDetail 返回流程详情 */
	public function getApprovalDetail() {
		$this->init ();

    	$processId = $this->in_arr ["processId"];

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "viewProcessDetail",
				"userId" => $this->userID,
				"processId" => $processId,
		);
		$json_data = postData ( $url, $data );

		$arr_data = json_decode($json_data, true);
		if ($arr_data["busiType"]=="3" || $arr_data["busiType"]=="4" || $arr_data["busiType"]=="5"){
			if($arr_data["formInfo"]["durationType"]=="1")
			{
				$arr_data["formInfo"]["duration"] = $arr_data["formInfo"]["duration"] .'天';
			}else{
				$arr_data["formInfo"]["duration"] = $arr_data["formInfo"]["duration"] .'小时';
			}
		}
		return $arr_data;
	}

	/* 调用API processNodeApproval 流程节点审批接口(同意/拒绝/转发) */
	public function processNodeApproval() {
		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "processNodeApproval",
				"userId" => $this->userID,
				"processId" => $this->in_arr ["processId"],
				"processNodeId" => $this->in_arr ["processNodeId"],
				"operateType" => $this->in_arr ["operateType"],
				"forwardHandleUserId" => $this->in_arr ["forwardHandleUserId"],
				"comment" => $this->in_arr ["comment"],
		);
		$json_data = postData ( $url, $data );

		echo $json_data;
	}

	/* 调用API queryMessageList 查询消息列表 */
	public function getMessageList($page = 1, $type = 1) {

		$this->init ();
		$this->pageSize = 3;

		$queryStart = (($page - 1) * $this->pageSize) + 1;
		$queryEnd = $page * $this->pageSize;

		// 范围
		if($type == "" || $type == 0) {
			$type = 1;
		}

		// 部门ID
		$deptId = "";
		if($type == 1) {
			$deptId = cookie('departId');
		}

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "queryMessageList",
				"userId" => $this->userID,
				"companyId" => $this->companyId,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"type" => $type,
				"deptId" => $deptId,
		);
		$json_data = postData ( $url, $data );
		$obj_data = json_decode($this->dejson($json_data ));
		// 获取头像
		if($obj_data->messageCount > 0) {
			foreach($obj_data->messageList as $key => $message) {
				$logo = $this->getHeadLogo($message->headLogo);
				$message->headLogo = $logo;
			}
		}
		if ($page > 0) {
			$pages = $this->getPages(intval($obj_data->messageCount));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
		}

		$json_data = json_encode($obj_data);
		if (IS_AJAX) {
			echo $json_data;
		} else {
			return $json_data;
		}
	}

	/* 刷新积分榜 */
	public function refreshIntegralRanking() {
		$json_data = $this->getIntegralRanking();
		echo $json_data;
	}

	/* 调用API getIntegralRanking 获取积分榜 */
	public function getIntegralRanking() {
		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "getIntegralRanking",
				"userId" => $this->userID,
				"companyId" => $this->companyId,
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}

	/* 调用API queryMessageList 查询消息列表 */
	public function queryMessageList($page = 1) {

		$this->init ();
		$this->pageSize = 3;

		$queryStart = (($page - 1) * $this->pageSize) + 1;
		$queryEnd = $page * $this->pageSize;

		// 范围
		$type = $this->in_arr ["type"];
		if($type == "" || $type == 0) {
			$type = 1;
		}

		// 部门ID
		$deptId = "";
		if($type == 1) {
			$deptId = cookie('departId');
		}

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "queryMessageList",
				"userId" => $this->userID,
				"companyId" => $this->companyId,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"type" => $type,
				"deptId" => $deptId,
				"startDate" => $this->in_arr ["startDate"],
				"endDate" => $this->in_arr ["endDate"],
		);
		$json_data = postData ( $url, $data );
		$obj_data = json_decode($this->dejson($json_data ));
		// 获取头像
		if($obj_data->messageCount > 0) {
			foreach($obj_data->messageList as $key => $message) {
				$logo = $this->getHeadLogo($message->headLogo);
				$message->headLogo = $logo;
			}
		}
		if ($page > 0) {
			$pages = $this->getPages(intval($obj_data->messageCount));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
		}
		$json_data = json_encode($obj_data);
		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}

	/* 调用API getProcessList 返回流程列表 */
	public function getProcessList($type = 1, $page = 1) {

		$this->init ();

		$queryStart = (($page - 1) * $this->pageSize) + 1;
		$queryEnd = $page * $this->pageSize;

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "getProcessList",
				"userId" => $this->userID,
				"queryStart" => (string)$queryStart,
				"queryEnd" => (string)$queryEnd,
				"type" => (string)$type,
		);

		$json_data = postData ( $url, $data );

		if ($page > 0) {
			$obj_data = json_decode($this->dejson($json_data ));
			$pages = $this->getPages(intval($obj_data->count));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
			$json_data = json_encode($obj_data);
		}

		if (IS_AJAX) {
			echo $json_data;
		} else {
			return $json_data;
		}
	}

	/* 调用API getProcessList 返回流程列表 */
	public function getApprovalList($busiType = 1, $page = 1) {
		$this->init ();

		$queryStart = (($page - 1) * $this->pageSize) + 1;
		$queryEnd = $page * $this->pageSize;

		// 流程列表数据类型
		$type = $this->in_arr ["type"];
		if($type == "" || $type == 0) {
			$type = 1;
		}

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "getProcessList",
				"userId" => $this->userID,
				"queryStart" => (string)$queryStart,
				"queryEnd" => (string)$queryEnd,
				"type" => (string)$type,
				"busiType" => (string)$busiType,
				"status" => $this->in_arr ["status"],
				"startDate" => $this->in_arr ["startDate"],
				"endDate" => $this->in_arr ["endDate"],
		);
		$json_data = postData ( $url, $data );

		if ($page > 0) {
			$obj_data = json_decode($this->dejson($json_data ));
			$pages = $this->getPages(intval($obj_data->count));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
			$json_data = json_encode($obj_data);
		}

		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}
	
	public  function addCustomer() {
		$this->init ();
		$json_data = $this->addOrEditCustomer ();
	
		echo $json_data;
	}

	/* 调用API getPatrolArea 18.4获取区域信息 */
	public function getPatrolArea() {
		$this->init ();

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "getPatrolArea",
				"areaId" => $this->in_arr ["areaId"],
		);

		$json_data = postData ( $url, $data );
		
		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}

	/* 调用API getCustomerList 取得客户列表 */
	public function getCustomerList($page = 0) {
		$this->init ();
		if ($page > 0) {
			$queryStart = (($page - 1) * $this->pageSize) + 1;
			$queryEnd = $page * $this->pageSize;
		} else {
			$queryStart = 1;
			$queryEnd = 100000;
		}

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "searchCustomer",
				"userId" => $this->userID,
				// "searchType" => 1,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"startDate" => $this->in_arr ["startDate"],
				"endDate" => $this->in_arr ["endDate"],
				"cusName" => $this->in_arr ["cusName"],
				"tradeId" => $this->in_arr ["cusTrade"],
				"areaId" => $this->in_arr ["cusArea"],
		);
		$json_data = postData ( $url, $data );
		
		if ($page > 0) {
			$obj_data = json_decode($this->dejson($json_data ));
			$pages = $this->getPages(intval($obj_data->count));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
			$json_data = json_encode($obj_data);
		}

		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}
	
	public  function addOrEditCustomer() {
	
		$url = C ( "OperatehttpUrl" ) . $url;
	
		$data = array (
				"command" => "addOrEditCustomer",
				"userId" => $this->userID,
				"companyId" => $this->companyId,
				"cusId" => $this->in_arr ["cusId"],
				"cusName" => $this->in_arr ["cusName"],
				"cusAddress" => $this->in_arr ["cusAddress"],
				"phone" => $this->in_arr ["phone"],
				"cusFax" => $this->in_arr ["cusFax"],
				"cusUrl" => $this->in_arr ["cusUrl"],
				"tradeId" => $this->in_arr ["tradeId"],
				"areaId" => $this->in_arr ["areaId"],
				"cusScope" => $this->in_arr ["cusScope"],
				"cusProperty" => $this->in_arr ["cusProperty"],
				"cusOrigin" => $this->in_arr ["cusOrigin"],
				"cusDesc" => $this->in_arr ["cusDesc"],

		);
	
		$json_data = postData ( $url, $data );
	
		return $json_data;
	}

	/* 调用API addorEditNoticeBoard 新增/编辑公告栏目接口 */
	public function addorEditNoticeBoard() {

		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;
	
		$data = array (
			"command" 	 => "addorEditNoticeBoard",
			"userId" 	 => $this->userID,
			"boardId" 	 => $this->in_arr ["boardId"],
			"boardName"  => $this->in_arr ["boardName"],
			"maintainer" => $this->in_arr ["maintainer"],
			"boardDesc"  => $this->in_arr ["boardDesc"],
		);
		$json_data = postData ( $url, $data );
		echo $json_data;
	}

	/* 调用API delCusClient 删除选中客户联系人 */
	public function deleteCusClient() {
		$this->init ();
		$ids = $this->in_arr ["ids"];

		$url = C ( "OperatehttpUrl" ) . $url;
	
		// 删除顾客
		$data = array(
			"command" => "delCusClient",
			"clientIds" => $ids,
			"userId" => $this->userID,
			);
		$json_data = postData ( $url, $data );
		echo $json_data;
	}

	/* 调用API deleteCustomer 删除选中客户 */
	public function deleteCustomer() {
		$this->init ();
		$ids = $this->in_arr ["ids"];

		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array(
			"command" => "delCustomer",
			"cusIds" => $ids,
			"userId" => $this->userID,
		);
		$json_data = postData ( $url, $data );
		echo $json_data;
	}

	/* 调用API removePatrolArea 18.3删除区域信息 */
	public function removePatrolArea() {
		$this->init ();
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array(
			"command" => "removePatrolArea",
			"areaId" => $this->in_arr ["areaId"],
			"companyId" => $this->companyId,
		);
		$json_data = postData ( $url, $data );
		echo $json_data;
	}
	
	/* 调用API searchCusClient 取得客户联系人 */
    /**
     * @param int $page  当前页数
     * @param int $pageSize 页面记录数
     * @param string $cusClientName 搜索联系人数
     * @return mixed
     */
	public function searchCusClient($page=1,$pageSize=100000,$cusClientName='') {
		$this->init ();

        if( IS_AJAX ){
            $page = $this->in_arr['page'];
            $pageSize = $this->in_arr['pageSize'];
            $cusClientName = $this->in_arr['cusClientName'];
        }

		$queryStart = ($page-1)*$pageSize+1;
		$queryEnd = $page*$pageSize;

		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "searchCusClient",
				"userId" => $this->userID,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"cusId" => $this->in_arr['cusId'],
                "cusClientName"=> $cusClientName
		);

		$json_data = postData ( $url, $data );

		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}

    /**
     * 搜索联系人 ajax调用
     * @param int $page  当前页数
     * @param int $pageSize 页面记录数
     * @param string $cusClientName 搜索联系人数
     * @return mixed
     */
    public function searchCusClient_ajax() {
        $this->init ();

        $page = $this->in_arr['page'];
        $pageSize = $this->in_arr['pageSize'];
        $cusClientName = $this->in_arr['cusClientName'];

        $queryStart = ($page-1)*$pageSize+1;
        $queryEnd = $page*$pageSize;

        $url = C ( "OperatehttpUrl" ) . $url;
        $data = array (
            "command" => "searchCusClient",
            "userId" => $this->userID,
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
            "cusId" => $this->in_arr['cusId'],
            "cusClientName"=> $cusClientName
        );

        $json_data = postData ( $url, $data );

        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }
    }



	/* 调用API addOrEditCusClient 新增/编辑客户联系人接口 */
	public function addOrEditCusClient() {
		$this->init ();
		if($this->in_arr['clientId']) {
			$clientCreateDate = date("Y-m-d H:i:s");
		} else {
			$clientCreateDate = "";
		}

		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "addOrEditCusClient",
				"clientName" => $this->in_arr['clientName'],
				"userId" => $this->userID,
				"clientId" => $this->in_arr['clientId'],
				"clientCreateDate" => $clientCreateDate,
				"cusId" => $this->in_arr['cusId'],
				"cusName" => $this->in_arr['cusName'],
				"clientPhone" => $this->in_arr['clientPhone'],
				"clientDeptName" => $this->in_arr['clientDeptName'],
				"clientStation" => $this->in_arr['clientStation'],
				"clientEmail" => $this->in_arr['clientEmail'],
				"clientSex" => $this->in_arr['clientSex'],
		);

		$json_data = postData ( $url, $data );
		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}

	/* 调用API getUserList 取得登陆用户所属公司下的员工列表 */
	public function getUserList($page = 0) {
		$this->init ();
		if ($page > 0) {
			$queryStart = (($page - 1) * $this->pageSize) + 1;
			$queryEnd = $page * $this->pageSize;
		} else {
			$queryStart = 1;
			$queryEnd = 100000;
		}

		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getUserList",
				"userId" => $this->userID,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"deptId" => $this->in_arr ["deptId"],
				"userName" => $this->in_arr["name"],
				"mobile" => $this->in_arr["mobile"],
		);
		$json_data = postData ( $url, $data );

		if ($page > 0) {
			$obj_data = json_decode($this->dejson($json_data ));
			$pages = $this->getPages(intval($obj_data->count));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
			$json_data = json_encode($obj_data);
		}

		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}
	
	/* 调用API getWorkSet 取得审阅人 */
	private function getWorkSet() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getWorkSet",
				"userId" => $this->userID 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API saveWorkSet 设置审阅人 */
	private function setWorkSet() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "saveWorkSet",
				"userId" => $this->userID,
				"recorder" => $this->in_arr ["recorder"] 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API getNoticeList 取得公告列表 */
	private function getNoticeList($page=1, $queryStart_Para="",$queryEnd_Para="") {
		$url = C ( "OperatehttpUrl" ) . $url;
		
		if ($this->in_arr["page"]) {
			$page = intval($this->in_arr["page"]);
		} else if (!$page) {
			$page = 1;
		}

		$queryStart = "";
		$queryEnd = "";
		if($queryStart_Para == "") {
			$queryStart = (($page - 1) * $this->pageSize) + 1;
			$queryEnd = $page * $this->pageSize;
		} else{
			$queryStart = $queryStart_Para;
			$queryEnd = $queryEnd_Para;
		}
		$data = array (
				"command" => "getNoticeList",
				"userId" => $this->userID,
				"companyId" => $this->companyId,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"subject" => $this->in_arr ["subject"],
				"boardId" => $this->in_arr ["boardId"]
		);
		$json_data = postData ( $url, $data );
		$obj_data = json_decode($this->dejson($json_data ));
		$pages = $this->getPages(intval($obj_data->count));
		$obj_data->page = $page;
		$obj_data->total = $pages['total'];
		$obj_data->pageSize = $pages['pageSize'];
		$obj_data->totalPage = $pages['totalPage'];
		return json_encode($obj_data);
	}

	/* 调用API getNoticeList 取得公告列表 */
	public function searchNoteList() {
		$this->init();
		echo $this->getNoticeList();
	}
	
	/* 调用API viewNotice 取得公告明细 */
	private function viewNotice() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "viewNotice",
				"userId" => $this->userID,
				"companyId" => $this->companyId,
				"messageId" => $this->in_arr ["messageId"] 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API viewNoticeBoard 取得公告栏目明细 */
	private function viewNoticeBoard() {
		$url = C ( "OperatehttpUrl" ) . $url;

		$data = array (
				"command" => "viewNoticeBoard",
				"userId"  => $this->userID,
				"boardId" => $this->in_arr ["boardId"] 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API getCheckWorkReportList  审阅工作报告列表（不含自己） */
	private function getCheckWorkReportList($startDate,$endDate,$queryStart=0,$queryEnd=999,$userIds="",$deptIds="") {
		/*
		command	请求命令
		userId			用户ID
		queryStart	查询范围下限
		queryEnd	查询范围上限
		title				报告标题
		startDate		报告开始日期
		endDate		报告结束日期
		type				报告类型          日报:1;周报:2;月报:3
		state			报告状态          未审阅:2;已审阅:3
		*/
		
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getCheckWorkReportList",
				"userId" => $this->userID,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"startDate" =>$startDate,
				"endDate" => $endDate,
				"userIds" => $userIds,
				"deptIds" => $deptIds,
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 调用API queryGPSList 3.1获取拜访签到列表 */
	private function queryGPSList() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "queryGPSList",
				"userId" => $this->userID,
				"companyId" => $this->companyId,
				"messageId" => $this->in_arr ["messageId"] 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	// 2.8工作报告查询接口  queryWorkReport
	private function queryWorkReport($startDate,$endDate,$type="") {
		/*
			command	String	Y	V64	请求命令
			userId	String	Y	V16	用户ID
			queryStart	String	Y	V16	查询范围下限
			queryEnd	String	Y	V16	查询范围上限
			title	String	N	V2	报告标题
			startDate	String	N	V16	报告开始日期
			endDate	String	N	V16	报告结束日期
			type	String	N	V2	报告类型
			state	String	N	V2	报告状态
			*/
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "queryWorkReport",
				"userId" => $this->userID,
				"queryStart"	=> "0",
				"queryEnd"	=> "9999",
				"startDate" =>$startDate,
				"endDate" =>$endDate,
				"type" =>$type
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	/*取得日报ID*/
	private function getWorkReportId() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getWorkReportId" 
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	/*getNoticeCommentType 1.9查询公告反馈类型列表接口*/
	private function getNoticeCommentType() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getNoticeCommentType",
				"companyId" => $this->companyId
				
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	
	/*viewUserDetail 4.3 查看用户详情接口*/
	private function viewUserDetail($uid = 0) {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "viewUserDetail",
				"userId" => (empty($uid) ? $this->userID : $uid)
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/*queryAllNoticeBoard 9.5 查询企业下所有的公告栏目接口*/
	private function queryAllNoticeBoard($type) {
		
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
			"command" => "queryAllNoticeBoard",
			"userId" => $this->userID,
		    "type" => $type,
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}

	/*searchNoticeBoard 9.2 查询公告栏目接口*/
	public function searchNoticeBoard($page = 1) {
		$this->init();
		$queryStart = (($page - 1) * $this->pageSize) + 1;
		$queryEnd = $page * $this->pageSize;

		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "searchNoticeBoard",
				"userId" => $this->userID,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
		);
		$json_data = postData ( $url, $data );

		if ($page > 0) {
			$obj_data = json_decode($this->dejson($json_data ));
			$pages = $this->getPages(intval($obj_data->count));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
			$json_data = json_encode($obj_data);
		}

		if (IS_AJAX) {
			echo $json_data;
		} else {
			return $json_data;
		}
	}
	
	/*取得公告ID*/
	private function getNoticeId() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getNoticeId"
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}
	
	/* 3.4查询上下班签到记录 getWorkSignList */
	private function getWorkSignList($page=1) {
		$url = C ( "OperatehttpUrl" ) . $url;
		if ($this->in_arr["page"]) {
			$page = intval($this->in_arr["page"]);
		} else if (!$page) {
			$page = 1;
		}

		$queryStart = (($page - 1) * $this->pageSize) + 1;
		$queryEnd = $page * $this->pageSize;
		$dateType = 1;
		switch ($this->in_arr["li_type"]) {
			case 'li_zhou':
				$dateType = 2;
				$startDate = $this->in_arr ["zhou_dateF"];
				$endDate = $this->in_arr ["zhou_dateT"];
				break;
			case 'li_yue':
				$dateType = 3;
				$startDate = $this->in_arr ["yue_date"];
				$endDate = "";
				break;
			case 'li_qujian':
				$dateType = 4;
				$startDate = $this->in_arr ["startdate"];
				$endDate = $this->in_arr ["enddate"];
				break;
			default:
				$dateType = 1;
				$startDate = $this->in_arr ["ri_date"];
				$endDate = $this->in_arr ["ri_date"];
				break;
		}
		
		$data = array (
				"command" => "getWorkSignList",
				"userId" => $this->userID,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
				"source" => "1",
				"dateType" => $dateType,
				"startDate" => $startDate,
				"endDate" => $endDate,
				"userIds" => $this->in_arr ["userIds"],
				"deptId" => $this->in_arr ["deptId"] 
		);

		$json_data = postData ( $url, $data );
		$obj_data = json_decode($this->dejson($json_data));
		$pages = $this->getPages(intval($obj_data->count));
		$obj_data->page = $page;
		$obj_data->total = $pages['total'];
		$obj_data->pageSize = $pages['pageSize'];
		$obj_data->totalPage = $pages['totalPage'];
		return json_encode($obj_data);
	}
	

	/* 调用API saveNotice 1.1新增公告接口 */
	private function saveNotice() {
	
		$json_data = $this->getNoticeId ();
		$json_Array = json_decode ( $this->dejson($json_data ), true );
		$noticeId = $json_Array ["noticeId"]; 
		$subject  = $this->in_arr ["subject"];
		// $content = htmlentities($this->in_arr ["content"]);
		$content = htmlspecialchars($this->in_arr ["content"]);
		$path = 'http://' . I('server.HTTP_HOST') . U('Home/Office/noticeDetail', array('messageId' => $noticeId));
		$boardId = $this->in_arr ["boardId"];
		$userIds = $this->in_arr ["userIds"];
		$deptIds = $this->in_arr ["deptIds"];
		$isTop = $this->in_arr ["isTop"];
	
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "saveNotice",
				"noticeId" => $noticeId,
				"userId" => $this->userID,
				"subject" => $subject,
				"content" => $content,
				"path" => $path,
				"boardId" => $boardId,
				"userIds" => $userIds,
				"deptIds" => $deptIds,
				"isTop" => $isTop
		);
		$json_data = postData ( $url, $data );


		$oldName = $this->in_arr ["upfileOldName"];
		$type = $this->in_arr ["upfileType"];
		$size = $this->in_arr ["upfileSize"];
		$returnUrl = $this->in_arr ["upfileReturnUrl"];

		if ($oldName != "" && $oldName != null) {
			$oldNameList = explode(",", $oldName);
			$typeList = explode(",", $type);
			$sizeList = explode(",", $size);
			$returnUrlList = explode(",", $returnUrl);

			for($i = 0; $i < count($oldNameList); $i ++) {
				// 新增notice记录接口
				$this->saveAttach("bbsMessage", $noticeId, $oldNameList[$i], $typeList[$i], $sizeList[$i], $returnUrlList[$i]);
			}
			// 修改notice附件标识接口
			$this->updateNoticeAttachFlag(1, $noticeId);	
		}
		return $json_data;
	}
	
	/* 调用API updateNoticeAttachFlag 1.2修改公告附件标识接口*/
	private function updateNoticeAttachFlag($flag,$messageId) {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "updateNoticeAttachFlag",
				"flag" => $flag,
				"messageId" => $messageId,
		);
		$json_data = postData ( $url, $data );
	
		return $json_data;
	}

	/* 调用API addTabPatrolArea 18.1增加区域信息接口*/
	private function addTabPatrolArea() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "addTabPatrolArea",
				"no" => $this->in_arr ["no"],
				"areaName" => $this->in_arr ["areaName"],
				"areaRemakr" => $this->in_arr ["areaRemakr"],
				"parentAreaId" => $this->in_arr ["parentAreaId"],
				"areaActive" => $this->in_arr ["areaActive"],
				"companyId" => $this->companyId,
		);
		$json_data = postData ( $url, $data );
	
		return $json_data;
	}

	/* 调用API modifyPatrolArea 18.2修改区域信息接口*/
	private function modifyPatrolArea() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "modifyPatrolArea",
				"areaId" => $this->in_arr ["areaId"],
				"no" => $this->in_arr ["no"],
				"areaName" => $this->in_arr ["areaName"],
				"areaRemakr" => $this->in_arr ["areaRemakr"],
				"parentAreaId" => $this->in_arr ["parentAreaId"],
				"areaActive" => $this->in_arr ["areaActive"],
				"companyId" => $this->companyId,
		);
		$json_data = postData ( $url, $data );
	
		return $json_data;
	}
	
	/* 调用API updateAttachFlag 2.5修改工作报告附件标识接口*/
	private function updateAttachFlag($flag, $reportId) {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "updateAttachFlag",
				"flag" => $flag,
				"reportId" => $reportId,
		);
		$json_data = postData ( $url, $data );
	
		return $json_data;
	}
	
	/* 调用API operateWorkReport  追加修改日报*/
	private function operateWorkReport() {
		$json_data = $this->getWorkReportId ();
		$json_Array = json_decode ( $this->dejson($json_data ), true );
		$command = "operateWorkReport"; // 请求命令
		$userId = $this->userID; // 用户ID
		$source = "1"; // 来源 web:1;mobile:2
		$reportId = $json_Array ["reportId"]; // 工作报告ID
		$reportType = $this->in_arr ["reportType"]; // 工作报告类型 日报:1;周报:2;月报:3
		$startDate = $this->in_arr ["startDate"]; // 工作报告开始时间 可以为空
		$endDate = $this->in_arr ["endDate"]; // 工作报告结束时间 可以为空
		$subject = ""; // 工作报告标题 可以为空 标题格式(日报：年-月-日 工作日报);周报格式(周报：年-月-日--年-月-日 工作周报);月报格式(月报：年-月 工作月报).
		$oType = "1"; // 操作类型 新增:1;编辑:2.
		$voiceCount = "0"; // 工作报告语音条数 可以为空 最多5条  web端无法使用该接口上传附件
		$reportState = "2"; // 工作报告提交审核或保存1,保存,2 提交审核
		$reportContent = $this->in_arr ["reportContent"]; // 工作报告内容
		$voices = $this->in_arr ["voices"];
		$url = C ( "OperatehttpUrl" ) . $url;
		//echo $this->in_arr ["monthSelecter"];
		if ($reportType == "1") {
			$startDate = $this->in_arr ["date"];
			$endDate = $this->in_arr ["date"];
			$subject = "日报：" . $startDate . "  工作日报";
		} elseif ($reportType == "2") {
			$startDate = substr($this->in_arr ["weekSelecter"],0,10);;
			$endDate = substr($this->in_arr ["weekSelecter"],-10);
			
			$subject = "周报：" . $startDate . "--" . $endDate . "  工作周报";
			
		} elseif ($reportType == "3") {
			$this->in_arr ["date"] = $this->in_arr ["monthSelecter"]."-01";
			$subject = "月报：" . date ( "Y-m", strtotime ( $this->in_arr ["date"] ) ) . "  工作月报";
			$startDate = date ( "Y-m", strtotime ( $this->in_arr ["date"] ) ) . "-01";
			$endDate = date ( "Y-m", strtotime ( $this->in_arr ["date"] ) ) . "-" . date ( "t", strtotime ( $this->in_arr ["date"] ) );
		}
		
		$json_data = $this->getWorkReportId ();
		$json_Array = json_decode ( $this->dejson($json_data ), true );
		$reportContent = str_replace("%", '％', $reportContent);
		
		$data = array (
				"command" => $command,
				"userId" => $userId,
				"source" => $source,
				"reportId" => $reportId,
				"reportType" => $reportType,
				"startDate" => $startDate,
				"endDate" => $endDate,
				"subject" => $subject,
				"oType" => $oType,
				"voiceCount" => $voiceCount,
				"reportState" => $reportState,
				"reportContent" => $reportContent,
		);
		
		//追加附件
		$oldName = $this->in_arr ['oldName'];
		$type = $this->in_arr ['type'];
		$size = $this->in_arr ['size'];
		$returnUrl = $this->in_arr ['returnUrl'];

		if ($oldName != "" && $oldName != null) {
			$oldNameList = explode(",", $oldName);
			$typeList = explode(",", $type);
			$sizeList = explode(",", $size);
			$returnUrlList = explode(",", $returnUrl);

			for($i = 0; $i < count($oldNameList); $i ++) {
				// 新增附件记录接口
				$this->saveAttach("workReport", $reportId, $oldNameList[$i], $typeList[$i], $sizeList[$i], $returnUrlList[$i]);
			}
			// 修改公告附件标识接口
			$this->updateAttachFlag(1, $reportId);	
		}

		$json_data = postData ( $url, $data );
		return $json_data;
	}

	/* 调用API createProcess  创建流程接口*/
	private function createProcess() {
		$command = "createProcess"; // 请求命令
		$userId = $this->userID; // 用户ID
		$companyId = $this->companyId; // 企业ID
		$busiType = $this->in_arr ["busiType"]; // 1.费用;2.报销;3.请假;4.出差;5.加班
		$status = "2"; // 流程状态 1.未提交;2.待处理;3.审核通过;4.审核不通过(流程创建后状态为2)
		$fileType = $this->in_arr ["type"]; // 附件类型
		$displayName = $this->in_arr ["oldName"]; // 附件原始名称
		$size = $this->in_arr ["size"]; // 附件大小
		$url = $this->in_arr ["returnUrl"]; // 附件存储路径加密文本

		$userRecorder = ""; // 审批人员
		if($busiType == 1) {
			$userRecorder = $this->in_arr ["users7recorder"];
		}
		if($busiType == 2) {
			$userRecorder = $this->in_arr ["users4recorder"];
		}
		if($busiType == 3) {
			$userRecorder = $this->in_arr ["users5recorder"];
		}
		if($busiType == 4) {
			$userRecorder = $this->in_arr ["users6recorder"];
		}
		if($busiType == 5) {
			$userRecorder = $this->in_arr ["users8recorder"];
		}

		if($userRecorder == "") {
			$approvalCount = "0"; // 自定义初始审批节点数量
			$processNodes = array(); // 审批节点集合
		} else {
			$approvalCount = (string)count($userRecorder); // 自定义初始审批节点数量
			// 审批节点集合
			foreach($userRecorder as $key => $value) {
				$i = $key + 1;
				$processNodes["node".$i] = array("nodeHandlerPerson" => $value);
			}
		}

		if($url == "") {
			$attachCount = "0"; // 附件个数
			$attachs = array(); // 附件集合
		} else {
			$fileTypeList = explode(',', $fileType);
			$displayNameList = explode(',', $displayName);
			$sizeList = explode(',', $size);
			$urlList = explode(',', $url);
			$attachCount = (string)count($urlList);

			foreach ($urlList as $key => $value) {
				$i = $key + 1;
				$attachs['attach'.$i]['tabName'] = 'process';
				$attachs['attach'.$i]['fileType'] = $fileTypeList[$key];
				$attachs['attach'.$i]['displayName'] = $displayNameList[$key];
				$attachs['attach'.$i]['size'] = $sizeList[$key];
				$attachs['attach'.$i]['url'] = "file=" . base64_encode($value);
			}
		}

		$formInfo = array(); // 表单信息集合

		if($busiType == 1) {
			$formInfo['costType'] = $this->in_arr ["costType"]; // 费用类型
			$formInfo['money'] = $this->in_arr ["money"]; // 金额
		}
		if($busiType == 2) {
			$formInfo['reimbursementType'] = $this->in_arr ["reimbursementType"]; // 报销类型
			$formInfo['money'] = $this->in_arr ["money"]; // 金额
		}
		if($busiType == 3) {
			$formInfo['leaveType'] = $this->in_arr ["leaveType"]; // 请假类型
			$formInfo['days'] = $this->in_arr ["days"]; // 请假/出差天数
			$formInfo['duration'] = $this->in_arr ["days"]; // 请假/出差天数
			$formInfo['beginDate'] = str_replace("/","-", $this->in_arr ["beginDate"]); // 开始日期
			$formInfo['endDate'] = str_replace("/","-", $this->in_arr ["endDate"]);// 结束日期
			$formInfo['durationType'] = $this->in_arr ["durationType"]; // 结束日期
		}
		if($busiType == 4) {
			$formInfo['address'] = $this->in_arr ["address"]; // 出差地点
			$formInfo['duration'] = $this->in_arr ["days"]; // 请假/出差天数
			$formInfo['days'] = $this->in_arr ["days"]; // 请假/出差天数
			$formInfo['beginDate'] = str_replace("/","-", $this->in_arr ["beginDate"]); // 开始日期
			$formInfo['endDate'] = str_replace("/","-", $this->in_arr ["endDate"]);// 结束日期
			$formInfo['durationType'] = $this->in_arr ["durationType"]; // 结束日期
		}
		if($busiType == 5) {
			$formInfo['duration'] = $this->in_arr ["days"]; // 请假/出差天数
			$formInfo['beginDate'] = str_replace("/","-", $this->in_arr ["beginDate"]); // 开始日期
			$formInfo['endDate'] = str_replace("/","-", $this->in_arr ["endDate"]);// 结束日期
			$formInfo['durationType'] = $this->in_arr ["durationType"]; // 结束日期
		}
		$formInfo['content'] = $this->in_arr ["content"]; // 表单内容

		$data = array (
				"command" 		=> $command,
				"userId" 		=> $userId,
				"companyId" 	=> $companyId,
				"busiType" 		=> $busiType,
				"status" 		=> $status,
				"attachPath" 	=> $attachPath,
				"approvalCount" => $approvalCount,
				"processNodes" 	=> $processNodes,
				"formInfo" 		=> $formInfo,
				"attachCount" 	=> $attachCount,
				"attachs" 		=> $attachs,
		);

		$url = C ( "OperatehttpUrl" ) . $url;
		$json_data = postData ( $url, $data );


		// 预先定义的流程节点处理人
		$defineNodeList = $this->getDefineProcessNodeList((string)$busiType);
		$nodeList = json_decode($this->dejson($defineNodeList));

		$obj_data = json_decode($this->dejson($json_data));
		$obj_data->nodeList = $nodeList->userList;
		$json_data = json_encode($obj_data);

		return $json_data;
	}

	/* 调用API getMessageCount  消息统计*/
	public function getMessageCount() {
		$this->init();
		$command = "getMessageCount"; // 请求命令
		$userId = $this->userID; // 用户ID
		$companyId = $this->companyId; // 企业ID
		$deptId = cookie('departId'); // 部门ID

		$data = array (
				"command" 	  => $command,
				"userId" 	  => $userId,
				"companyId"	  => $companyId,
				"deptId" 	  => $deptId,
		);

		$url = C ( "OperatehttpUrl" ) . $url;

		$json_data = postData ( $url, $data );

		if (IS_AJAX) {
			echo $json_data;
		} else {
			return $json_data;
		}
	}
	
	/* 调用API sendMessage  发送消息接口*/
	private function sendMessage() {
		$command = "sendMessage"; // 请求命令
		$userId = $this->userID; // 用户ID
		$companyId = $this->companyId; // 企业ID
		$content = $this->in_arr ["content"]; // 消息内容
		$deptIds = $this->in_arr ["deptIds"]; // 消息发送的部门ID串
		$fileType = $this->in_arr ["fileType"]; // 附件类型
		$displayName = $this->in_arr ["displayName"]; // 附件原始名称
		$size = $this->in_arr ["size"]; // 附件大小
		$url = $this->in_arr ["url"]; // 附件存储路径加密文本
		$userIds = $this->in_arr ["userIds"]; // @的用户ID串

		$attachCount = 0;
		$attachs = array();

		if($url) {
			$fileTypeList = explode(',', $fileType);
			$displayNameList = explode(',', $displayName);
			$sizeList = explode(',', $size);
			$urlList = explode(',', $url);
			$attachCount = count($urlList);

			foreach ($urlList as $key => $value) {
				$i = $key + 1;
				$attachs['attach'.$i]['tabName'] = 'message';
				$attachs['attach'.$i]['fileType'] = $fileTypeList[$key];
				$attachs['attach'.$i]['displayName'] = $displayNameList[$key];
				$attachs['attach'.$i]['size'] = $sizeList[$key];
				$attachs['attach'.$i]['url'] = "file=" . base64_encode($value);
			}
		}

		$data = array (
				"command" 	  => $command,
				"userId" 	  => $userId,
				"companyId"	  => $companyId,
				"content" 	  => $content,
				"deptIds"	  => $deptIds,
				"userIds" 	  => $userIds,
				"attachCount" => $attachCount,
				"attachs"	  => $attachs,
		);

		$url = C ( "OperatehttpUrl" ) . $url;

		$json_data = postData ( $url, $data );

		return $json_data;
	}
	
	/* 1.7获取公告访问信息列表接口 */
	private function getVisitList() {
		$command = "getVisitList"; // 请求命令
		$messageId = $this->in_arr ["messageId"];
		$companyId = $this->companyId; 
		
		$data = array (
				"command" 	  => $command,
				"messageId" 	  => $messageId,
				"companyId"	  => $companyId,
		);
	
		$url = C ( "OperatehttpUrl" ) . $url;
	
		$json_data = postData ( $url, $data );
	
		return $json_data;
	}

	/* 调用API addComment  添加评论接口*/
	public function addComment() {
		$this->init();
		$command = "addComment"; // 请求命令
		$userId = $this->userID; // 用户ID
		$companyId = $this->companyId; // 企业ID
		$commentContent = $this->in_arr ["commentContent"]; // 评论内容
		$mesId = $this->in_arr ["mesId"]; // 消息ID

		$data = array (
				"command" 	  	 => $command,
				"userId" 	  	 => $userId,
				"companyId"	  	 => $companyId,
				"commentContent" => $commentContent,
				"mesId"	  		 => $mesId,
		);

		$url = C ( "OperatehttpUrl" ) . $url;

		$json_data = postData ( $url, $data );

		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}

	/* 调用API addReply  添加回复接口*/
	public function addReply() {
		$this->init();
		$command = "addReply"; // 请求命令
		$userId = $this->userID; // 用户ID
		$companyId = $this->companyId; // 企业ID
		$replyContent = $this->in_arr ["replyContent"]; // 回复内容
		$commentId = $this->in_arr ["commentId"]; // 评论ID
		$mesId = $this->in_arr ["mesId"]; // 消息ID
		$replyToUserId = $this->in_arr ["replyToUserId"]; // 被回复人ID

		$data = array (
				"command" 	  	=> $command,
				"userId" 	  	=> $userId,
				"companyId"	  	=> $companyId,
				"replyContent"  => $replyContent,
				"commentId"	  	=> $commentId,
				"mesId"	  		=> $mesId,
				"replyToUserId" => $replyToUserId,
		);

		$url = C ( "OperatehttpUrl" ) . $url;

		$json_data = postData ( $url, $data );

		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}

	/* 保存签到类型地址信息 */
	public function saveGPSTypeAdd() {
		$this->init();
		$command = "saveGPSTypeAdd"; // 请求命令
		$id=$this->in_arr["id"];//更改签到类型地址信息时此元素必填
		$orderNo = $this->in_arr ["orderNo"]; // 排序字段
		$userId = $this->userID; // 创建者ID
		$deptId = cookie('departId'); // 部门ID
		$name = $this->in_arr ["name"]; // 名称
		$startWorkTime = trim($this->in_arr ["beginDate"]); // 名称
		$endWorkTime = trim($this->in_arr ["endDate"]);
		$userIds = $this->in_arr ["userIds"]; // 用户ID串
		$countryId = $this->in_arr ["countryId"]; // 国家
		$provinceId = $this->in_arr ["provinceId"]; // 省份
		$cityId = $this->in_arr ["cityId"]; // 城市
		$address = $this->in_arr ["address"]; // 地址
		$x = $this->in_arr ["x"]; // 经度
		$y = $this->in_arr ["y"]; // 纬度
		$isCheck = $this->in_arr ["isCheck"]; // 超出偏差距离后允许签到
		if(!$isCheck) {
			$isCheck = '0';
		}
		$checkDistance = $this->in_arr ["checkDistance"]; // 允许偏移距离
		
		
		$data = array (
				"command" 	  	=> $command,
				"id"            => $id,
				"orderNo" 	  	=> $orderNo,
				"userId"	  	=> $userId,
				"deptId"        => $deptId,
				"name"	  	    => $name,
				"startWorkTime"	=> $startWorkTime,
				"endWorkTime"	=> $endWorkTime,
				"userIds"	  	=> $userIds,
				"countryId"     => $countryId,
				"provinceId"    => $provinceId,
				"cityId"        => $cityId,
				"address"       => $address,
				"x"             => $x,
				"y"             => $y,
				"isCheck"       => $isCheck,
				"checkDistance" => $checkDistance,
		);
	
		$url = C ( "OperatehttpUrl" ) . $url;
	
		$json_data = postData ( $url, $data );
	
		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}
	
	/* 获取签到类型地址信息 */
	public function queryGPSTypeAddList($page = 1) {
		$this->init();
		$url = C ( "OperatehttpUrl" ) . $url;
		
		$queryStart = (($page - 1) * $this->pageSize) + 1;
		$queryEnd = $page * $this->pageSize;
		
		$data = array (
				"command" => "queryGPSTypeAddList",
				"companyId" => $this -> companyId,
				"queryStart" => $queryStart,
				"queryEnd" => $queryEnd,
		);

		$json_data = postData ( $url, $data );

		if ($page > 0) {
			$obj_data = json_decode($this->dejson($json_data ));
			$pages = $this->getPages(intval($obj_data->count));
			$obj_data->page = $page;
			$obj_data->total = $pages['total'];
			$obj_data->pageSize = $pages['pageSize'];
			$obj_data->totalPage = $pages['totalPage'];
			$json_data = json_encode($obj_data);
		}

		if (IS_AJAX) {
			echo $json_data;
		} else {
			// $arr_data = json_decode($json_data, true);
			return $json_data;
		}
			
	}
	/* 获取签到类型地址信息详情 */
	public function queryGPSTypeAddDetail() {
		
		$url = C ( "OperatehttpUrl" ) . $url;
		
		$data = array (
				"command" => "queryGPSTypeAddDetail",
				"id" => $this->in_arr ["id"],

		);
	
		$json_data = postData ( $url, $data );
		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}

			
	}
	
	/* 删除签到类型地址信息 */
	public function delGPSTypeAddDetail() {

		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "delGPSTypeAddDetail",
				"id" => $this->in_arr ["id"],
				"type" => $this->in_arr ["type"],
		);
	
		$json_data = postData ( $url, $data );
		if (IS_AJAX) {
			echo $json_data;
		} else {
			$arr_data = json_decode($json_data, true);
			return $arr_data;
		}
	}
	
	/* 判断API返回值 */
	private function checkApiResult($apiName, $apiReturnValue) {
		$json_Array = json_decode ( $this->dejson($apiReturnValue ), true );
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
	
	/* 初始化发送人选择画面 */
	public function selectUsers() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "userNames", I ( "get.userNames" ) );
		$this->assign ( "userIds", I ( "get.userIds" ) );
		$this->display ();
	}

	/* 初始化发送人选择画面 */
	public function selectMessageUsers() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "userNames", I ( "get.userNames" ) );
		$this->assign ( "userIds", I ( "get.userIds" ) );
		$this->display ();
	}

	/* 初始化发送人选择画面 */
	public function selectUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$userDetail = $this->viewUserDetail(I ( "get.userId" ));
		$info = json_decode($userDetail, true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "userId", I ( "get.userId" ));
		$this->assign ( "userName", $info['name']);
		$this->assign ( "photoId", $info['photoId']);
		$this->assign ( "no", I ( "get.no" ) );
		$this->assign ( "objId", I ( "get.objId" ) );
		$this->assign ( "selected", I ( "get.selected" ) );
		$this->display ();
	}

	/* 初始化报销转批人选择画面 */
	public function selectApplyUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化请假转批人选择画面 */
	public function selectLeaveUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化请加班批人选择画面 */
	public function selectOverWorkUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化出差转批人选择画面 */
	public function selectTravelUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化费用转批人选择画面 */
	public function selectFeeUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化首页报销转批人选择画面 */
	public function selectIndexApplyUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化首页请假转批人选择画面 */
	public function selectIndexLeaveUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化首页加班转批人选择画面 */
	public function selectIndexOverWorkUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化首页出差转批人选择画面 */
	public function selectIndexTravelUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化首页费用转批人选择画面 */
	public function selectIndexFeeUser() {
		$this->init();
		$dept_list = $this->formatDeptList(true);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "processId", I ( "get.processId" ));
		$this->assign ( "processNodeId", I ( "get.processNodeId" ) );
		$this->assign ( "comment", I ( "get.comment" ) );
		$this->assign ( "operateType", I ( "get.operateType" ) );
		$this->assign ( "page", I ( "get.page" ) );
		$this->assign ( "busiType", I ( "get.busiType" ) );
		$this->display ();
	}

	/* 初始化发送人选择画面 */
	public function selectDepts() {
		$this->init();
		$dept_list = $this->formatDeptList(false);
		$this->assign ( "dept_list", $dept_list);
		$this->assign ( "deptNames", I ( "get.deptNames" ) );
		$this->assign ( "deptIds", I ( "get.deptIds" ) );
		$this->display ();
	}

	public function selectcusTrades() {
		$this->init();
		$dict_list = $this->formatDictList();
		$this->assign ( "dict_list", $dict_list);
		$this->assign ( "cusTrade", I ( "get.cusTrade" ) );
		$this->assign ( "hidcusTrade", I ( "get.hidcusTrade" ) );
		$this->display ();
	}
	
	public function selectcusAreas() {
		$this->init();
		$area_list = $this->formatAreaList();
		$this->assign ( "area_list", $area_list);
		$this->assign ( "cusArea", I ( "get.cusArea" ) );
		$this->assign ( "hidcusArea", I ( "get.hidcusArea" ) );
		$this->display ();
	}

	// 数组排序
	private function array_sort($arr, $keys, $type = 'desc') {
	    $keysvalue = $new_array = array();
	    foreach ($arr as $k => $v) {
	        $keysvalue[$k] = $v[$keys];
	    }
	    if ($type == 'asc') {
	        asort($keysvalue);
	    } else {
	        arsort($keysvalue);
	    }
	    reset($keysvalue);
	    foreach ($keysvalue as $k => $v) {
	        $new_array[$k] = $arr[$k];
	    }
	    return $new_array;
	}

	// 获取父部门级别
	private function getParentLevel($list = array(), $deptParent = "") {
		$level = "";
		foreach ($list as $k => $v) {
			if($deptParent == $v['deptId']) {
				if($v['deptParent'] == 0) {
					$level = '2';
				} else {
					$level = $this->getParentLevel($list, $v['deptParent']);
					$level = (string)(intval($level) + 1);
				}
			}
		}
		return $level;
	}
	
	private function formatAreaContactList() {
		$json_AreaListData = $this->getAreaListByCompanyId ();
		$json_Array = json_decode ( $this->dejson($json_AreaListData ) , true );
		$area_list = array();
		
		foreach ($json_Array['list'] as $k => $v) {
			if ($v['areaLevelNo'] == '1') {
				$area_list[$k]['deptId'] = $v['areaId'];
				$area_list[$k]['text'] = $v['areaName'];
				$area_list[$k]['parentAreaId'] = $v['parentAreaId'];
				$area_list[$k]['areaLevelNo'] = $v['areaLevelNo'];
				$area_list[$k]['lastFlag'] = 1;
				$area_list[$k]['href'] = 'javascript:getUserListByAreaId(' . $v['areaId'] . ')';
				$area_list[$k]['children'] = array();
			} else {
				$keys = $this->findAreaKey($area_list, $v['parentAreaId'], intval($v['areaLevelNo']));
				$arr = array(
						'deptId' => $v['areaId'],
						'text' => $v['areaName'],
						'lastFlag' => 1,
						'href' => 'javascript:getUserListByAreaId(' . $v['areaId'] . ')',
						'children' => array());

				if (array_key_exists('k4', $keys)) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][$keys['k4']]['children'][] = $arr;
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][$keys['k4']]['lastFlag'] = 0;
				} else if (array_key_exists('k3', $keys)) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][] = $arr;
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['lastFlag'] = 0;
				} else if (array_key_exists('k2', $keys)) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][] = $arr;
					$area_list[$keys['k1']]['children'][$keys['k2']]['lastFlag'] = 0;
				} else if (array_key_exists('k1', $keys)) {
					$area_list[$keys['k1']]['children'][] = $arr;
					$area_list[$keys['k1']]['lastFlag'] = 0;
				}
			}
		}

		return json_encode($area_list);
	}


    /**
     * 格式化部门列表
     * @param $hrefFlag
     * @return string
     */
	private function formatDeptList($hrefFlag = false) {
		$json_DeptListData = $this->getAllDeptList ();
		$json_Array = json_decode ( $this->dejson($json_DeptListData ) , true );
		$dept_list = array();

		// 部门级别为空时，添加部门级别
		foreach ($json_Array['list'] as $k => $v) {
			if($v['deptParent'] == '0') {
				$json_Array['list'][$k]['deptLevel'] = '1';
			} else {
				$parentLevel = $this->getParentLevel($json_Array['list'], $v['deptParent']);
				$json_Array['list'][$k]['deptLevel'] = $parentLevel;
			}
		}

		// 将数组中的部门级别重新排序
		$json_Array['list'] = $this->array_sort($json_Array['list'], "deptLevel", 'asc');

		foreach ($json_Array['list'] as $k => $v) {
			if ($v['deptLevel'] == '1') {
				$dept_list[0]['deptId'] = $v['deptId'];
				$dept_list[0]['text'] = $v['deptName'];
				if ($hrefFlag) {
					$dept_list[0]['href'] = 'javascript:getUserListByDeptId(' . $v['deptId'] . ')';
				}
				$dept_list[0]['children'] = array();
			} else {
				$keys = $this->findDeptKey($dept_list, $v['deptParent'], intval($v['deptLevel']));

				$arr = array(
					'deptId' => $v['deptId'],
					'text' => $v['deptName'], 
					'children' => array());
				if ($hrefFlag) {
					$arr['href'] = 'javascript:getUserListByDeptId(' . $v['deptId'] . ')';
				}
				if (array_key_exists('k4', $keys)) {
					$dept_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][$keys['k4']]['children'][] = $arr;
				} else if (array_key_exists('k3', $keys)) {
					$dept_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][] = $arr;
				} else if (array_key_exists('k2', $keys)) {
					$dept_list[$keys['k1']]['children'][$keys['k2']]['children'][] = $arr;
				} else if (array_key_exists('k1', $keys)) {
					$dept_list[$keys['k1']]['children'][] = $arr;
				}
			}
		}

		return json_encode($dept_list);
	}
	
	private function formatDictList() {
		$json_DictListData = $this->getDictByCondition (1);
		$json_Array = json_decode ( $this->dejson($json_DictListData ) , true );
		$dict_list = array();
		foreach ($json_Array['list'] as $k => $v) {
			if ($v['dictGrade'] == '1') {
				$dict_list[$k]['deptId'] = $v['dictId'];
				$dict_list[$k]['text'] = $v['dictName'];
				$dict_list[$k]['parentId'] = $v['parentId'];
				$area_list[$k]['lastFlag'] = 1;
				$dict_list[$k]['children'] = array();
			} else {
				foreach ($dict_list as $k1 => $v1){
					if($v['parentId'] == $dict_list[$k1]['deptId']){
						$arr = array(
								'deptId' => $v['dictId'],
								'text' => $v['dictName'],
								'paretnId' => $v['parentId'],
								'lastFlag' => 1,
								'children' => array());
						$dict_list[$k1]['children'][] = $arr;
						$dict_list[$k1]['lastFlag'] = 0;
					}
				}
			}
		}
		return json_encode($dict_list);
	}


	private function formatAreaList() {
		$json_AreaListData = $this->getAreaList ();
		$json_Array = json_decode ( $this->dejson($json_AreaListData ) , true );
		$area_list = array();
		foreach ($json_Array['areaList'] as $k => $v) {
			if ($v['areaLevelNo'] == '1') {
				$area_list[$k]['deptId'] = $v['areaId'];
				$area_list[$k]['text'] = $v['areaName'];
				$area_list[$k]['parentAreaId'] = $v['parentAreaId'];
				$area_list[$k]['areaLevelNo'] = $v['areaLevelNo'];
				$area_list[$k]['lastFlag'] = 1;
				$area_list[$k]['children'] = array();
			} else {
				$keys = $this->findAreaKey($area_list, $v['parentAreaId'], intval($v['areaLevelNo']));
				$arr = array(
						'deptId' => $v['areaId'],
						'text' => $v['areaName'],
						'lastFlag' => 1,
						'children' => array());

				if (array_key_exists('k4', $keys)) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][$keys['k4']]['children'][] = $arr;
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][$keys['k4']]['lastFlag'] = 0;
				} else if (array_key_exists('k3', $keys)) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][] = $arr;
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['lastFlag'] = 0;
				} else if (array_key_exists('k2', $keys)) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][] = $arr;
					$area_list[$keys['k1']]['children'][$keys['k2']]['lastFlag'] = 0;
				} else if (array_key_exists('k1', $keys)) {
					$area_list[$keys['k1']]['children'][] = $arr;
					$area_list[$keys['k1']]['lastFlag'] = 0;
				}
				
				/*
				if (intval($v['areaLevelNo'])==5) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][$keys['k4']]['children'][$keys['k5']]['children'][] = $arr;
				} else if (array_key_exists('k4', $keys)) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][$keys['k4']]['children'][] = $arr;
				} else if (intval($v['areaLevelNo'])==4) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][$keys['k3']]['children'][] = $arr;
				} else if (intval($v['areaLevelNo'])==3) {
					$area_list[$keys['k1']]['children'][$keys['k2']]['children'][] = $arr;
				} else if (intval($v['areaLevelNo'])==2) {
					$area_list[$keys['k1']]['children'][] = $arr;
				}
				*/
			}
		}
		
		return json_encode($area_list);
	}
	/**
	 * 校验日期格式是否正确
	 *
	 * @param string $date 日期
	 * @param string $formats 需要检验的格式数组
	 * @return boolean
	 */
	function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d")) {
		$unixTime = strtotime($date);
		if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
			return false;
		}
		//校验日期的有效性，只要满足其中一个格式就OK
		foreach ($formats as $format) {
			if (date($format, $unixTime) == $date) {
				return true;
			}
		}
	
		return false;
	}
	
	private function findDeptKey($dept_list, $dept_id, $level=2) {
		if (!$level) {
			$level = 4;
		}
		$keys = array();
		foreach ($dept_list as $k1 => $v1) {
			$keys['k1'] = $k1;
			if ($v1['deptId'] == $dept_id) {
				return $keys;
			}
			if ($level > 2) {
				foreach ($v1['children'] as $k2 => $v2) {
					$keys['k2'] = $k2;
					if ($v2['deptId'] == $dept_id) {
						return $keys;
					} else if ($level > 3) {
						foreach ($v2['children'] as $k3 => $v3) {
							$keys['k3'] = $k3;
							if ($v3['deptId'] == $dept_id) {
								return $keys;
							} else if ($level > 4) {
								foreach ($v3['children'] as $k4 => $v4) {
									$keys['k4'] = $k4;
									if ($v4['deptId'] == $dept_id) {
										return $keys;
									}
								}
							}
						}
					}
				}
			}
		}
		return $keys;
	}
	
	private function findAreaKey($area_list, $area_id, $level) {

		$keys = array();
		foreach ($area_list as $k1 => $v1) {
			$keys['k1'] = $k1;
			if ($v1['deptId'] == $area_id) {
				return $keys;
			}
			if ($level > 2) {
				foreach ($v1['children'] as $k2 => $v2) {
					$keys['k2'] = $k2;
					if ($v2['deptId'] == $area_id) {
						return $keys;
					} else if ($level > 3) {
						foreach ($v2['children'] as $k3 => $v3) {
							$keys['k3'] = $k3;
							if ($v3['deptId'] == $area_id) {
								return $keys;
							} else if ($level > 4) {
								foreach ($v3['children'] as $k4 => $v4) {
									$keys['k4'] = $k4;
									if ($v4['deptId'] == $area_id) {
										return $keys;
									}
								}
							}
						}
					}
				}
			}
		}
		return $keys;
	}

	private function getPages($total=0) {
        $totalPage = ceil($total / $this->pageSize);	//总页数
        return array(
        		'total' => $total,
        		'pageSize' => $this->pageSize,
        		'totalPage' => $totalPage);
	}
	
	private function dejson($str){
		//$str = str_replace("\\", '\\\\', $str);
		//$str = str_replace("\r\n", "", $str);
		//$str = str_replace("\n", "", $str);
	    $str = str_replace("\n", ' ', 	$str);
		return $str;
	}

	/* 10.2 获取附件记录列表接口 getAttachList */
	private function getAttachList($tblname = 'bbsMessage') {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getAttachList",
				"tblname" => $tblname,
				"linkid" => $this->in_arr ["messageId"]
		);
		$json_data = postData ( $url, $data );
		return $json_data;
	}

	/* 10.2 获取附件记录列表接口 getAttachList */
	private function getAttachListReport() {
		$url = C ( "OperatehttpUrl" ) . $url;
		$data = array (
				"command" => "getAttachList",
				"tblname" => "workReport",
				"linkid" => $this->in_arr ["reportID"]
		);
		$json_data = postData ( $url, $data );
		$arr_data = json_decode($json_data, true);
		return $arr_data;
	}

	// 下载附件
	public function downloadFile() {
		$this->init();
		$data = array();

		$file_name = $this->in_arr ["path"];
		$file_dir = "./Public/upfile/";
		if (!file_exists($file_dir . $file_name)) { //检查文件是否存在
			echo "文件找不到";
			exit;
		} else {
			$file = fopen($file_dir . $file_name,"r"); // 打开文件
			// 输入文件标签
			Header("Content-type: application/octet-stream");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ".filesize($file_dir . $file_name));
			Header("Content-Disposition: attachment; filename=" . $file_name);
			// 输出文件内容
			echo fread($file,filesize($file_dir . $file_name));
			fclose($file);
			exit;
		}
	}

	// 下载附件
	public function downloadAttachFile() {

		$this->init();
		$data = array();

		$fileUrl = $this->in_arr ["fileUrl"];

		if(strstr($fileUrl, "file=")) {
			$fileUrl = str_replace("file=", "", $fileUrl);
			$file_name = base64_decode($fileUrl);
			
			$file_dir = "./Public/upfile/";
			if (!file_exists($file_dir . $file_name)) { //检查文件是否存在
				echo "文件找不到";
				exit;
			} else {
				$file = fopen($file_dir . $file_name,"r"); // 打开文件
				// 输入文件标签
				Header("Content-type: application/octet-stream");
				Header("Accept-Ranges: bytes");
				Header("Accept-Length: ".filesize($file_dir . $file_name));
				Header("Content-Disposition: attachment; filename=" . $file_name);
				// 输出文件内容
				echo fread($file,filesize($file_dir . $file_name));
				fclose($file);
				exit;
			}
		} else {
			echo "文件路径错误";
			exit;
		}
	}

	// 删除附件
	public function removeUpFile() {
        $map = array('error_code'=>'success');
		$this->init();
		$fileName = $this->in_arr ["fileName"];
		$filePath = "./Public/upfile/" . $fileName;

		if (!file_exists($filePath)) { //检查文件是否存在
			$map['error_code'] = 'error1';
			echo json_encode($map);
			exit;
		} else {
			if(unlink($filePath) == false) {
				$map['error_code'] = 'error';
				echo json_encode($map);
				exit;
			}
		}
		echo json_encode($map);
	}
	// ajax 获取头像
	public function getLogo() {
		$this->init();
		$logoId = $this->in_arr ["photoId"];
		$array = array('logo' => $this->getHeadLogo($logoId));
		echo json_encode($array);
	}


    /**
     * 新增商机页面显示
     */
    public function addBusiOpportunities(){
        $this->init();
        //商机来源
        $bizOrigin_json = $this->getDictByCondition(31);
        $bizOrigin = json_decode($bizOrigin_json,true);
        $this->assign("bizOrigin",$bizOrigin);

        //商机状态
        $bizState_json = $this->getDictByCondition(33);
        $bizState = json_decode($bizState_json,true);
        $this->assign("bizState",$bizState);

        $this->display();
    }

    /**
     * 编辑商机页面显示
     */
    public function editBusiOpportunities(){
        $this->init();
        //商机来源
        $bizOrigin_json = $this->getDictByCondition(31);
        $bizOrigin = json_decode($bizOrigin_json,true);
        $this->assign("bizOrigin",$bizOrigin);

        //商机状态
        $bizState_json = $this->getDictByCondition(33);
        $bizState = json_decode($bizState_json,true);
        $this->assign("bizState",$bizState);

        //商机详情
        $bizId = I('bizId');
        $bizDetail = $this->viewBiz($bizId);
        $this->assign("bizDetail",$bizDetail);

        $this->display();
    }


    /**
     * 19.1新建与修改商机接口
     */
    public function saveBiz(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "saveBiz",
            "userId" => $this->userID,
            "companyId" => $this->companyId,
            "bizId" => $this->in_arr['bizId'],
            "cusId" => $this->in_arr['cusId'],
            "cusClientIds" => $this->in_arr['cusClientIds'],
            "bizOrigin" => $this->in_arr['bizOrigin'],
            "bizSubject" => $this->in_arr['bizSubject'],
            "cusDemand" => $this->in_arr['cusDemand'],
            "bizPhase" => $this->in_arr['bizPhase'],
            "expectSignDate" => $this->in_arr['expectSignDate'],
            "bizPrice" => $this->in_arr['bizPrice'],
            "expectVolume" => $this->in_arr['expectVolume'],
            "remark" => $this->in_arr['remark'],
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 19.2查看商机接口
     * @params cusId 客户id
     * @return string || array
     */
    public function viewBiz($bizId){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "viewBiz",
            "userId" => $this->userID,
            "companyId" => $this->companyId,
            "bizId" => $bizId
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 19.3查询商机接口
     * @params cusId 客户id
     * @return string || array
     */
    public function getBizList($cusId,$page=1,$pageSize=5){

        $this->init ();

        $queryStart = (($page - 1) * $pageSize) + 1;
        $queryEnd = $page * $pageSize;

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "getBizList",
            "userId" => $this->userID,
            "cusId" => $cusId,
            "companyId" => $this->companyId,
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 查询商机列表 ajax调用
     * @params int $page  当前页数
     * @params int $pageSize 页面记录数
     * @params string $bizSubject 搜索商机名称
     * @params string $cusId 客户id
     * @return mixed
     */
    public function getBizList_ajax() {
        $this->init ();

        $page = $this->in_arr['page'];
        $pageSize = $this->in_arr['pageSize'];
        $bizName = $this->in_arr['bizName'];

        $queryStart = ($page-1)*$pageSize+1;
        $queryEnd = $page*$pageSize;

        $url = C ( "OperatehttpUrl" );
        $data = array (
            "command" => "getBizList",
            "userId" => $this->userID,
            "companyId" => $this->companyId,
            "cusId" => $this->in_arr['cusId'],
            "bizSubject" => $this->in_arr['bizSubject'],
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );

        $json_data = postData ( $url, $data );

        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }
    }


    /**
     * 19.4删除商机接口
     * @params $bizId_string 商机id集合,以逗号隔开
     * @return string || array
     */
    public function deleteBiz(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "deleteBiz",
            "userId" => $this->userID,
            "bizIds" => $this->in_arr['bizIds'],
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 新增拜访计划页面显示
     */
    public function addVisitPlan(){
        $this->init();

        $this->display();
    }

    //新增拜访计划 关联商机列表
    public function selectmore(){

        //商机列表
        $cusId = I('cusId');
        $bizList = $this->getBizList($cusId,1,8);
        $this->assign("bizList",$bizList['bizList']);

        //分页
        $totalRecord = intval($bizList['count']);  //总记录数
        $page['current'] = 1; //当前页
        $page['size'] = 8; //每页显示记录数
        $page['total'] = ceil($totalRecord/$page['size']); //总页数
        $this->assign("page",$page);

        $this->display();
    }


    //关联合同列表
    public function selectContract(){

        //商机列表
        $cusId = I('cusId');
        $contractList = $this->getContractList($cusId,1,8);
        $this->assign("contractList",$contractList['list']);

        //分页
        $totalRecord = intval($contractList['count']);  //总记录数
        $page['current'] = 1; //当前页
        $page['size'] = 8; //每页显示记录数
        $page['total'] = ceil($totalRecord/$page['size']); //总页数
        $this->assign("page",$page);

        $this->display();
    }

    //新增拜访记录 关联拜访计划列表
    public function selectVisitPlan(){

        //拜访计划列表
        $cusId = I('cusId');
        $visitPlanList = $this->getVisitPlanList($cusId,1,8);
        $this->assign("visitPlanList",$visitPlanList['visitPlanList']);

        //分页
        $totalRecord = intval($visitPlanList['count']);  //总记录数
        $page['current'] = 1; //当前页
        $page['size'] = 8; //每页显示记录数
        $page['total'] = ceil($totalRecord/$page['size']); //总页数
        $this->assign("page",$page);

        $this->display();
    }

    /**
     * 编辑拜访计划页面显示
     */
    public function editVisitPlan(){
        $this->init();

        //拜访计划详情
        $visitPlanId = I('visitPlanId');
        $visitPlanDetail = $this->viewVisitPlan($visitPlanId);
        $this->assign("visitPlanDetail",$visitPlanDetail);

        $this->display();
    }

    /**
     * 20.1新增与编辑拜访计划接口
     */
    public function saveVisitPlan(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "saveVisitPlan",
            "userId" => $this->userID,
            "companyId" => $this->companyId,
            "visitPlanId" => $this->in_arr['visitPlanId'],
            "cusId" => $this->in_arr['cusId'],
            "cusClientIds" => $this->in_arr['cusClientIds'],
            "visitMethod" => $this->in_arr['visitMethod'],
            "bizId" => $this->in_arr['bizId'],
            "visitPlanSubject" => $this->in_arr['visitPlanSubject'],
            "startDate" => $this->in_arr['startDate'],
            "endDate" => $this->in_arr['endDate'],
            "articipantIds" => $this->in_arr['articipantIds'],
            "content" => $this->in_arr['content']
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     *  20.2查询拜访计划列表接口
     * @params cusId 客户id
     * @return string || array
     */
    public function getVisitPlanList($cusId,$page=1,$pageSize=5){

        $this->init ();

        $queryStart = (($page - 1) * $pageSize) + 1;
        $queryEnd = $page * $pageSize;

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "getVisitPlanList",
            "userId" => $this->userID,
            "cusId" => $cusId,
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 查询拜访计划列表接口 ajax调用
     * @params int $page  当前页数
     * @params int $pageSize 页面记录数
     * @params string $bizSubject 搜索拜访计划名称
     * @params string $cusId 客户id
     * @return mixed
     */
    public function getVisitPlanList_ajax() {
        $this->init ();

        $page = $this->in_arr['page'];
        $pageSize = $this->in_arr['pageSize'];

        $queryStart = ($page-1)*$pageSize+1;
        $queryEnd = $page*$pageSize;

        $url = C ( "OperatehttpUrl" );
        $data = array (
            "command" => "getVisitPlanList",
            "userId" => $this->userID,
            "companyId" => $this->companyId,
            "cusId" => $this->in_arr['cusId'],
            "visitPlanSubject" => $this->in_arr['visitPlanSubject'],
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );

        $json_data = postData ( $url, $data );

        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }
    }

    /**
     * 20.3查看拜访计划接口
     * @return mixed
     */
    public function viewVisitPlan(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "viewVisitPlan",
            "visitPlanId" => $this->in_arr['visitPlanId']
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 20.4删除拜访计划接口
     * @params visitPlanIds 拜访计划id集合,以逗号隔开
     * @return string || array
     */
    public function delVisitPlan(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "delVisitPlan",
            "userId" => $this->userID,
            "visitPlanIds" => $this->in_arr['visitPlanIds'],
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 新增拜访记录页面显示
     */
    public function addVisitRecord(){
        $this->init();

        $this->display();
    }


    /**
     * 21.1新增与编辑拜访记录接口
     */
    public function saveVisitRecord(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "saveVisitRecord",
            "userId" => $this->userID,
            "companyId" => $this->companyId,
            "visitRecordId" => $this->in_arr['visitRecordId'],
            "visitPlanId" => $this->in_arr['visitPlanId'],
            "cusId" => $this->in_arr['cusId'],
            "bizId" => $this->in_arr['bizId'],
            "cusClientIds" => $this->in_arr['cusClientIds'],
            "bizId" => $this->in_arr['bizId'],
            "visitMethod" => $this->in_arr['visitMethod'],
            "visitRecordDate" => $this->in_arr['visitRecordDate'],
            "exchangesContent" => $this->in_arr['exchangesContent'],
            "followTactics" => $this->in_arr['followTactics']
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 21.2查询拜访记录列表接口
     * @params cusId 客户id
     * @return string || array
     */
    public function getVisitRecordList($cusId,$page=1,$pageSize=5){

        $this->init ();

        $queryStart = (($page - 1) * $pageSize) + 1;
        $queryEnd = $page * $pageSize;

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "getVisitRecordList",
            "userId" => $this->userID,
            "cusId" => $cusId,
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 查询拜访记录列表接口 ajax调用
     * @return mixed
     */
    public function getVisitRecordList_ajax(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $page = $this->in_arr['page'];
        $pageSize = $this->in_arr['pageSize'];

        $queryStart = ($page-1)*$pageSize+1;
        $queryEnd = $page*$pageSize;

        $url = C ( "OperatehttpUrl" );
        $data = array (
            "command" => "getVisitRecordList",
            "userId" => $this->userID,
            "cusId" => $this->in_arr['cusId'],
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );


        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 编辑拜访计划页面显示
     */
    public function editVisitRecord(){
        $this->init();

        //拜访计划详情
        $visitRecordId = I('visitRecordId');
        $visitRecordDetail = $this->viewVisitRecord($visitRecordId);
        $this->assign("visitRecordDetail",$visitRecordDetail);

        $this->display();
    }


    /**
     * 21.3查看拜访记录接口
     * @return mixed
     */
    public function viewVisitRecord(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "viewVisitRecord",
            "visitRecordId" => $this->in_arr['visitRecordId']
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 21.4删除拜访记录接口
     * @params visitPlanIds 拜访计划id集合,以逗号隔开
     * @return string || array
     */
    public function delVisitRecord(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "delVisitRecord",
            "userId" => $this->userID,
            "visitRecordIds" => $this->in_arr['visitRecordIds'],
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }



    /**
     * 新增合同页面显示
     */
    public function addContract(){
        $this->init();

        $this->display();
    }


    /**
     * 编辑合同页面显示
     */
    public function editContract(){
        $this->init();

        //合同详情
        $contractId = I('contractId');
        $contractDetail = $this->getContractDetail($contractId);
        $this->assign("contractDetail",$contractDetail);

        $this->display();
    }


    /**
     * 22.1 新增合同
     */
    public function insertContract(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "insertContract",
            "employeeId" => $this->userID,
            "companyId" => $this->companyId,
            "contractSubject" => $this->in_arr['contractSubject'],
            "contractCode" => $this->in_arr['contractCode'],
            "crmBiz" => $this->in_arr['crmBiz'],
            "enterpriseId" => $this->in_arr['enterpriseId'],
            "ASigner" => $this->in_arr['ASigner'],
            "signDate" => $this->in_arr['signDate'],
            "startDate" => $this->in_arr['startDate'],
            "endDate" => $this->in_arr['endDate'],
            "money" => $this->in_arr['money'],
            "content" => $this->in_arr['content'] //关键条款
        );


        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 22.2 修改合同
     */
    public function updateContract(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "updateContract",
            "companyId" => $this->companyId,
            "contractId" => $this->in_arr['contractId'],
            "employeeId" => $this->userID,
            "contractSubject" => $this->in_arr['contractSubject'],
            "contractCode" => $this->in_arr['contractCode'],
            "crmBiz" => $this->in_arr['crmBiz'],
            "enterpriseId" => $this->in_arr['enterpriseId'],
            "ASigner" => $this->in_arr['ASigner'],
            "signDate" => $this->in_arr['signDate'],
            "startDate" => $this->in_arr['startDate'],
            "endDate" => $this->in_arr['endDate'],
            "money" => $this->in_arr['money'],
            "content" => $this->in_arr['content'] //关键条款
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 22.3 删除合同
     */
    public function delContract(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "delContract",
            "companyId" => $this->companyId,
            "contractId" => $this->in_arr['contractId']
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 22.4 获取合同详情
     */
    public function getContractDetail(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "getContractDetail",
            "contractId" => $this->in_arr['contractId']
        );


        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 22.4 获取合同列表
     * @params cusId 客户id
     * @return string || array
     */
    public function getContractList($cusId,$page=1,$pageSize=5){

        $this->init ();

        $queryStart = (($page - 1) * $pageSize) + 1;
        $queryEnd = $page * $pageSize;

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "getContractList",
            "companyId" => $this->companyId,
            "enterpriseId" => $cusId,
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 获取合同列表接口 ajax调用
     * @return mixed
     */
    public function getContractList_ajax(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $page = $this->in_arr['page'];
        $pageSize = $this->in_arr['pageSize'];

        $queryStart = ($page-1)*$pageSize+1;
        $queryEnd = $page*$pageSize;

        $url = C ( "OperatehttpUrl" );
        $data = array (
            "command" => "getContractList",
            "companyId" => $this->companyId,
            "enterpriseId" => $this->in_arr['cusId'],
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
            "searchCondition"=>$this->in_arr['searchCondition']
        );


        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 编辑回款页面显示
     */
    public function editPayBack(){
        $this->init();

        //回款详情
        $payBackId = I('payBackId');
        $payBackDetail = $this->getPayRecordDetail($payBackId);
        $this->assign("payBackDetail",$payBackDetail);

        $this->display();
    }


    /**
     * 23.1 新增回款
     */
    public function insertPayRecord(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "insertPayRecord",
            "employeeId" => $this->userID,
            "companyId" => $this->companyId,
            "contractId" => $this->in_arr['contractId'],
            "enterpriseId" => $this->in_arr['enterpriseId'],
            "totalMoney" => $this->in_arr['totalMoney'],
            "payDate" => $this->in_arr['payDate'],
            "payMoney" => $this->in_arr['payMoney'],
            "payMethod" => $this->in_arr['payMethod'],
            "receipt" => $this->in_arr['receipt'],
            "remark" => $this->in_arr['remark']
        );


        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 23.2 修改回款
     */
    public function updatePayRecord(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "updatePayRecord",
            "companyId" => $this->companyId,
            "employeeId" => $this->userID,
            "payrecordId" => $this->in_arr['payrecordId'],
            "contractId" => $this->in_arr['contractId'],
            "totalMoney" => $this->in_arr['totalMoney'],
            "payDate" => $this->in_arr['payDate'],
            "payMoney" => $this->in_arr['payMoney'],
            "payMethod" => $this->in_arr['payMethod'],
            "receipt" => $this->in_arr['receipt'],
            "enterpriseId" => $this->in_arr['enterpriseId'],
            "remark" => $this->in_arr['remark']
        );


        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 23.3 获取回款列表
     * @params cusId 客户id
     * @return string || array
     */
    public function getPayRecordList($cusId,$page=1,$pageSize=5){

        $this->init ();

        $queryStart = (($page - 1) * $pageSize) + 1;
        $queryEnd = $page * $pageSize;

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "getPayRecordList",
            "companyId" => $this->companyId,
            "enterpriseId" => $cusId,
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }

    /**
     * 获取回款列表 ajax调用
     * @return mixed
     */
    public function getPayRecordList_ajax(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $page = $this->in_arr['page'];
        $pageSize = $this->in_arr['pageSize'];

        $queryStart = ($page-1)*$pageSize+1;
        $queryEnd = $page*$pageSize;

        $url = C ( "OperatehttpUrl" );
        $data = array (
            "command" => "getPayRecordList",
            "companyId" => $this->companyId,
            "enterpriseId" => $this->in_arr['cusId'],
            "queryStart" => $queryStart,
            "queryEnd" => $queryEnd,
        );


        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 22.4 获取合同详情
     */
    public function getPayRecordDetail(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "getPayRecordDetail",
            "companyId" => $this->companyId,
            "payrecordId" => $this->in_arr['payBackId']
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }


    /**
     * 22.3 删除合同
     */
    public function delPayRecord(){

        $this->init ();

        $url = C ( "OperatehttpUrl" ) ;

        $data = array (
            "command" => "delPayRecord",
            "companyId" => $this->companyId,
            "payrecordId" => $this->in_arr['payrecordId']
        );

        $json_data = postData ( $url, $data );
        if (IS_AJAX) {
            echo $json_data;
        } else {
            $arr_data = json_decode($json_data, true);
            return $arr_data;
        }

    }









}