<?php
/**
 * 权限控制
 *
 * @author
 */
namespace Admin\Controller;
use Think\Controller;
class AccessController extends CommonController {
    //put your code here
    function index(){
        set_theme();
        $companyId=cookie("companyId");
        $this->assign("companyId", $companyId);
        $this->display();
    }
    
    //查看角色权限
    function  show_nodelist(){
        set_theme();
        $id=$_GET["roleid"];
        $access=M('role')->field('f_access,f_name')->where('f_id='.$id)->select();
        //echo  M('role')->getLastSql();
        $list=explode(",",$access[0]['f_access']);
//        var_dump($list);exit;
        //exit;
        $data=A('Api/Web')->node_list();
        $this->assign("id",$id);
        $this->assign("rolename",$access[0]['f_name']);
        $this->assign("list2", $list);
        $this->assign("nodelist", $data['first']);
        $this->display();
    }
    
    /**
     * 用户授权列表(调用java接口)
     * 
     */
    function user_list(){
    	set_theme();    
    	$company_id = cookie("companyId");
    	
    	//分页
    	$page = I('page');
    	if( $page == '' ){
    		$page = 0;
    	}
    	
    	$pageSize = 10;
    	$page_start = $page*$pageSize;
    	$page_end = ($page+1)*$pageSize-1;
    	$count_json = A('Api/Jhttp')->getUsersList( $company_id,0,0,"0");	  //获取用户总记录数    json格式
    	$count_array= json_decode($count_json,true);	  //获取用户总记录数  数组格式
		$total = $count_array['count'];	//总记录数
		$pageTotal =  $totalPage = ceil($total/$pageSize); //总页数		
		
		$prePage = $page -1;
		$nextPage = $page + 1;
		if( $prePage <= 0 ){
			$prePage = 0;
		}
		
		if( $nextPage >= $pageTotal ){
			$nextPage = $pageTotal-1;
		}		
    	
    	//用户列表
    	$data = A('Api/Jhttp')->getUsersList( $company_id,$page_start,$page_end,"0");	  //获取用户    
    	$data_array = json_decode($data,"true");
    	$user_list = $data_array['list'];    	
    	
    	$this->assign("page_start",$page_start);
    	$this->assign("nextPage",$nextPage);
    	$this->assign("prePage",$prePage);
    	$this->assign("page",$page);
    	$this->assign("pageTotal",$pageTotal);
    	$this->assign("total",$total);
		$this->assign ("pageSize", $pageSize );
    	$this->assign("user_list",$user_list);
    	$this->display();
    }
    
    /* 用户授权角色 */
    function addPower(){
		$userId = I("userId");
		$map = array(
				"f_company_id" => cookie("companyId")
				);
		//查找公司的角色
    	$role_list = M('role')->where($map)->select();

		//查找用户权限
		$result = M('user_role')->where("f_user_id=".$userId)->find();
		$user_role = explode(",", $result['f_role_id']);
		//判断授权用户是不是超级管理员
		//可以进入企业设置页面的userid
		$spueruserid=cookie("userId");
		if($userId==$spueruserid){
			$isturesuper="true";
			$result2=M("user_role")->where("f_user_id=".$userId)->select();
			$istruespuerId=$result2[0]["f_role_id"];
		}else{
			$isturesuper="false";
		}
		$this->assign("istruespuerId",$istruespuerId);
		$this->assign("isturesuper",$isturesuper);
		$this->assign("user_role",$user_role);
		$this->assign("userId",$userId);
    	$this->assign("role_list",$role_list);
    	$this->display();
    }
    
    //新建角色
     function addrole(){
        set_theme();
        $companyId=cookie("companyId");
        $companyName=cookie("companyName");
        $data=A('Api/Web')->node_list();
        $this->assign("nodelist", $data['first']);
        $this->assign("companyId", $companyId);
        $this->assign("companyName", $companyName);
        $this->display();
    } 
}
