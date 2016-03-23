<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JhttpController
 *
 * @author Administrator
 */
namespace Api\Controller;
use Think\Controller;
class JhttpController extends Controller {


    public function getFacList($userId,$companyId){
//        getFacAgeList&userId=12049&companyId=1393
        $url = C('JhttpUrl');
        $url .= "?command=getFacAgeList&userId=".$userId."&companyId=".$companyId;
        //echo "withdrawal:".$url;
        return $this->in_curl($url);
    }

    /**
     * 设置招商提现密码
     */
    public function withdrawal($jtype,$userid,$password) {
        $url = C('JhttpUrl');
        $url .= "?command=ZSChangePwd&type=".$jtype."&userId=".$userid."&password=".$password;
        //echo "withdrawal:".$url;
        return $this->in_curl($url);
    }
    
    /**
     * 验证招商提现密码
     */
    public function verifywithdrawal($jtype,$userid,$password) {
        $url = C('JhttpUrl');
        $url .= "?command=ZSCheckPwd&type=".$jtype."&userId=".$userid."&password=".$password;
        //echo "verifywithdrawal:".$url;
        return $this->in_curl($url);
    }
    
    /**
     * 取mobile用户信息
     */
    public function getUserinfo($mobile) {
        $url = C('JhttpUrl');
        $url .="?command=getUserInfo&mobile=".$mobile;
        
        return $this->in_curl($url);
    }
    /**
     * 取ID用户信息
     */
    public function getUserinfo2($userid) {
        $url = C('JhttpUrl');
        $url .="?command=getUserInfo&userId=".$userid;

        return $this->in_curl($url);
    }
    
    //?command=getCompanyInfo&companyId=
    /**
     * 取企业信息
     */
    public function getCompanyInfo($companyId) {
        $url = C('JhttpUrl');
        $url .="?command=getCompanyInfo&companyId=".$companyId;
        return $this->in_curl($url);
    }

    /**
     * 取招商平台的企业信息
     */
    public function getAllCompanyInfo($queryStart,$queryEnd,$state) {
        $url = C('JhttpUrl');
        $url .="?command=getCompanysInfo&queryStart=".$queryStart."&queryEnd=".$queryEnd."&state=".$state;
        // echo $url;
        return $this->in_curl($url);
    }

    /**
     * 审核企业
     */
    public function checkCompany($companyId,$state) {
        $url = C('JhttpUrl');
        $url .="?command=companyUpdate&companyId=".$companyId."&state=".$state;
        // echo $url;
        return $this->in_curl($url);
    }

    /**
     * 招商登陆
     * @param string $mobile 手机号
     * @param string $password MD5加密
     * @return type
     */
    public function login($mobile,$password){
        $url = C('JhttpUrl');
        $url .= "?command=ZSUserLogin&mobile=".$mobile."&password=".$password;
        $re = json_decode($this->in_curl($url),true);
        $re['list']['headLogoUrl'] = D('Api/Files')->getFileUrl($re['list']['headLogo']);
        return json_encode($re);
    }
    
    /**
     * 招商修改密码
     * @param string $mobile 手机号
     * @param string $password MD5加密
     * @return type
     */
    public function modiPassword($mobile,$password){
        $url = C('JhttpUrl');
        $url .= "?command=ZSChangePwd&mobile=".$mobile."&password=".$password;
        //echo $url;
        return $this->in_curl($url);
    }
    
    /**
     * 企业登陆
     * @param string $mobile 手机号
     * @param string $password MD5加密
     * @return string 企业列表
     */
    public function companylogin($mobile,$password){
        $url = C('JhttpUrl');
        $url .="?command=checkCompanyLogin&mobile=".$mobile."&password=".md5($password);
        //echo $url;
        return $this->in_curl($url);
    }
    
    /**
     * 获取用户和企业信息
     * @param int $companyId
     * @param string $mobile
     * @return string
     */
    public function userlogin($companyId,$mobile){
        $url = C('JhttpUrl');
        $url .="?command=userLogin&companyId=".$companyId."&mobile=".$mobile;
        return $this->in_curl($url);
    }
    
    /**
     * 招商APP注册
     * @param string $mobile
    companylogin     * @return string
     */
    public function zsreguser($mobile,$password,$companyId=1,$invitationCode=0,$expand=""){
        $url = C('JhttpUrl');
        $url .="?command=userAdd&companyId=".$companyId."&mobile=".$mobile."&password=".$password."&invitationCode=".$invitationCode;
        if($expand!=""){
            $url .= $expand;
        }
        //echo $url;
        return $this->in_curl($url);
    }
    
    /**
     * 效验邀请码
     */
    public function authinvita($invitationCode) {
        $url = C('JhttpUrl');
        $url .="?command=userAdd&invitationCode=".$invitationCode;
        return $this->in_curl($url);
    }


    /**
     * 通过邀请码获取USERID
     */
    public function getInvitationCode($invitationCode) {
        $url = C('JhttpUrl');
        $url .="?command=getInviterIdByInvitationCode&invitationCode=".$invitationCode;
        return $this->in_curl($url);
    }
    
    /**
     * 企业注册
     * ?command=companyAdd&companyName=哎呦喂&phone=222222222&email=121234@aa.com&flatType=2
     */
    public function companyAdd($phone,$password,$companyName,$flatType=2,$trueName="",$state=2,$invitationCode=0,$clientNumber=0,$clientPwd=0){
        $url = C('JhttpUrl');
        $url .="?command=companyAdd&companyName=".$companyName."&phone=".$phone."&password=".md5($password)."&flatType=".$flatType."&trueName=".$trueName."&state=".$state."&invitationCode=".$invitationCode;
        //echo $url;
        if($clientNumber!=0 || $clientNumber!=""){
            $url .= "&clientNumber=".$clientNumber."&clientPwd=".$clientPwd;
        }
        return $this->in_curl($url);
    }


//    command=addFacAgeNew&facId=90&ageName=童翔宇测试企业07&trueName=童07&invitationCode=&phone=18992865555&flatType=2&password=e10adc3949ba59abbe56e057f20f883e

    //经销商与厂家关系的建立
    public  function   addFacAgeNew($facId,$ageName,$trueName,$phone,$invitationCode=0,$flatType=2,$password=123456){
        $url = C('JhttpUrl');
        $url .="?command=addFacAgeNew&facId=".$facId."&ageName=".$ageName."&trueName=".$trueName."&invitationCode=".$invitationCode."&phone=".$phone."&flatType=".$flatType."&password=".md5($password);
        return $this->in_curl($url);
    }

    //phone,website,address,fax,industryId,companyLegal,mainProduct,mainArea,turnOver,ageCount,employeeCount,salesCount,netCount,qualityManagDep,techDep,markDep,aftersaleDep,extName,extValue
    /**
     * 修改企业信息
     * @param int $companyId 企业ID
     * @param array $url_1 要传的URL
     */
    public function companyUpdate($companyid,$url_1){
        $url = C('JhttpUrl');
        $url .="?command=companyUpdate&companyId=".$companyid.$url_1;
        //echo $url;
        return $this->in_curl($url);
    }
    
    
    /**
     * 
     * @param type $command 
     * @param type $companyName
     */
    public function getCompanyName($companyName){
        $url = C('JhttpUrl');
        $url .="?command=getCompanyName&companyName=".$companyName;
        return $this->in_curl($url);
    }
    
	/****
	 *根据手机号取公司列表 
	 *
	 */
	 public function getCompanyByMobile($mobile){
	 	$url = C('JhttpUrl');
        $url .="?command=getCompanyByMobile&mobile=".$mobile;
        return $this->in_curl($url);
	 }
	 
	 /*
	 * 
     * 修改用户信息
     * @param int $userId 用户ID
     * @param array $url_1 要传的URL
     */
    public function modiUserInfo($userId,$url_1="") {
        $url = C('JhttpUrl');
        $url .="?command=userUpdate&userId=".$userId.$url_1;
        //echo $url;
        //exit;
        return $this->in_curl($url);
    }
    
    /**
     * 删除用户信息
     * @param int $userId 用户ID
     * @param int $companyId 公司id
     * @return array
     */
    public function delUserInfo($userId,$companyId) {
    	$url = C('JhttpUrl');    	    	 
    	$url .="?command=userDelete&userId=".$userId."&companyId=".$companyId;
    	//echo $url;
    	//exit;
    	return $this->in_curl($url);
    }

    /**
     * 批量删除用户信息(接口同时已经删除了分销用户)
     * command=usersDelete&userIds=305,306
     * @param string usersId 用户ID集合,以逗号分隔
     * @return array
     */
    public function usersDelete($usersId){
        $url = C('JhttpUrl');
        $url .="?command=usersDelete&userIds=".$usersId;
        return $this->in_curl($url);
    }

    
    
    
    /**queryStart=1&queryEnd=4
     * 获取企业用户信息
     * @param int $companyId 企业ID
     */
    public function getUsersInfo($companyId,$queryStart,$queryEnd,$type) {
        $url = C('JhttpUrl');
        $url .="?command=getUsersInfo&companyId=".$companyId."&queryStart=".$queryStart."&queryEnd=".$queryEnd."&type=".$type;
        //echo $url;
        return $this->in_curl($url);
    }

    /** command=saveOrEditWorkEx&userId=1&companyId=4&companyName=1&userPosition=2222&beginDate=10&endDate=10&jobDescription=adf&orderId=3&id=1
     * 新增和修改工作经历
     *
     */
    public function workInfo($userId,$companyId,$orderId,$companyName,$userPosition,$beginDate,$endDate,$jobDescription,$id=0){
        $url = C('JhttpUrl');
        $modiId = $id==0?"":"&id=".$id;
        $url .="?command=saveOrEditWorkEx&userId=".$userId."&companyId=".$companyId."&orderId=".$orderId."&companyName=".$companyName."&userPosition=".$userPosition."&beginDate=".$beginDate."&endDate=".$endDate."&jobDescription=".$jobDescription.$modiId;
        //echo $url;
        return $this->in_curl($url);
    }

    /**
     * 删除工作经历
     *
     */
    public function delworkInfo($id){
        $url = C('JhttpUrl');
        //$modiId = $id==0?"":"&id=".$id;
        $url .="?command=saveOrEditWorkEx&state=3&id=".$id;
        //echo $url;
        return $this->in_curl($url);
    }

    /** command=saveOrEduEx&userId=1&companyId=3&userSchool=1&userDepartment=10&userEducation=10&beginDate=10&endDate=10&moreDescription=10&orderId=10&id=1
     * 新增和修改教育经历
     *
     */
    public function eduInfo($userId,$companyId,$orderId,$userSchool,$userDepartment,$userEducation,$beginDate,$endDate,$moreDescription,$id=0){
        $url = C('JhttpUrl');
        $modiId = $id==0?"":"&id=".$id;
        $url .="?command=saveOrEduEx&userId=".$userId."&companyId=".$companyId."&orderId=".$orderId."&userSchool=".$userSchool."&userDepartment=".$userDepartment."&userEducation=".$userEducation."&beginDate=".$beginDate."&endDate=".$endDate."&moreDescription=".$moreDescription.$modiId;
        //echo $url;
        return $this->in_curl($url);
    }

    /**
     * 删除教育经历
     *
     */
    public function deleduInfo($id){
        $url = C('JhttpUrl');
        //$modiId = $id==0?"":"&id=".$id;
        $url .="?command=saveOrEduEx&state=3&id=".$id;
        //echo $url;
        return $this->in_curl($url);
    }

    /** command=getWorkEx&userId=1
     * 查询工作经历
     *
     */
    public function getWorkInfo($userId){
        $url = C('JhttpUrl');
        $url .="?command=getWorkEx&userId=".$userId;
        //echo $url;
        return $this->in_curl($url);
    }

    /** command=getEduEx&userId=1
     * 查询教育经历
     *
     */
    public function getEduInfo($userId){
        $url = C('JhttpUrl');
        $url .="?command=getEduEx&userId=".$userId;
        //echo $url;
        return $this->in_curl($url);
    }

    /** command=getArea&parentId=0
     * 查询区域
     *
     */
    public function getArea($parentId=0){
        $url = C('JhttpUrl');
        $url .="?command=getArea&parentId=".$parentId;
        //echo $url;
        return $this->in_curl($url);
    }

    /** command=getIndustry&parentId=0
     * 查询行业
     *
     */
    public function getIndustry($parentId=0){
        $url = C('JhttpUrl');
        $url .="?command=getIndustry&parentId=".$parentId;
        //echo $url;
        return $this->in_curl($url);
    }

    public function getSkillLabel($industryId){
        $url = C('JhttpUrl');
        $url .="?command=getSkillLabel&industryId=".$industryId;
        //echo $url;
        return $this->in_curl($url);
    }
    //command=getSkillLabel&industryId=1
    
    //部门添加
    public  function  addDept($deptName,$companyId,$parentId){
        $url=C('JhttpUrl');
        $url .="?command=departAdd&deptName=".$deptName."&companyId=".$companyId."&parentId=".$parentId;
        return $this->in_curl($url);
    }
    //部门更新
    public  function  updateDept($deptName,$companyId,$parentId,$departId){
        $url=C("JhttpUrl");
        $url .="?command=departUpdate&deptName=".$deptName."&companyId=".$companyId."&parentId=".$parentId."&departId=".$departId;
        return $this->in_curl($url);
    }
    //部门删除
    public  function  delteDept($departId){
        $url=C("JhttpUrl");
        $url .="?command=departDelete&departId=".$departId;
        return $this->in_curl($url);
    }
    
    //获取部门信息
    public function getDeparts($companyId){
        $url=C("JhttpUrl");
        $url .="?command=getDeparts&companyId=".$companyId;
        return $this->in_curl($url);
    }
    //添加部门下的员工基本信息
    public function  addDeptuser($companyId,$departId,$nickName,$trueName,$officePhone,$otherPhone,$email,$userLevel,$mobile,$sex,$password,$fax,$homePhone,$homeAddress,$birthday,$idCard,$headLogo,$invitationCode,$position){
        $url=C("JhttpUrl");
        $url .="?command=userAdd&companyId=".$companyId."&departId=".$departId."&nickName=".$nickName."&trueName=".$trueName."&officePhone=".$officePhone."&otherPhone=".$otherPhone."&email=".$email."&userLevel=".$userLevel."&mobile=".$mobile."&sex=".$sex."&password=".md5($password)."&fax=".$fax."&homePhone=".$homePhone."&homeAddress=".$homeAddress."&birthday=".$birthday."&idCard=".$idCard."&headLogo=".$headLogo."&invitationCode=".$invitationCode."&position=".$position;
        return $this->in_curl($url);
    }
    
   //获取部门下的所有的员工信息
    public  function getUsersByDepart($departId,$queryStart,$queryEnd){
         $url=C("JhttpUrl");
         $url .="?command=getUsersByDepart&departId=".$departId."&queryStart=".$queryStart."&queryEnd=".$queryEnd;
         return $this->in_curl($url);
   }
   
   /**
    * 获取用户列表
    */
   public  function getUsersList($companyId,$queryStart,$queryEnd,$type){
   	$url=C("JhttpUrl");
   	$url .="?command=getUsersInfo&companyId=".$companyId."&queryStart=".$queryStart."&queryEnd=".$queryEnd."&type=".$type;
   	return $this->in_curl($url);
   }

    /**
     * 获取所有用户列表
     * type = 0 为所有的 1为已认证的
     */
    public  function getAllUsersInfo2($companyId,$type=0){
        $url=C("JhttpUrl");
        $url .="?command=getAllUsersInfo&companyId=".$companyId."&type=".$type;
        return $this->in_curl($url);
    }


   
   /**
    * 获取时间段内的用户总数
    */
   public  function getUsersByTime($startTime,$endTime,$type){
    $url=C("JhttpUrl");
    $url .="?command=getUsersByTime&startTime=".$startTime."&endTime=".$endTime."&type=".$type;
    return $this->in_curl($url);
   }
   /**
    * 平台用户修改密码
    */
 
   public function  WebChangePwd($mobile,$password,$companyId){
   	  $url=C("JhttpUrl");
      $url .="?command=WebChangePwd&mobile=".$mobile."&password=".md5($password)."&companyId=".$companyId;
      return $this->in_curl($url);
    }

    /**
     * 取java所有用户信息
     */
    public function getAllUsersInfo($type=0) {
        $url = C('JhttpUrl');
        $url .="?command=getAllUsersInfo&companyId=1&type=".$type;
        
        return $this->in_curl($url);
    }

    /**
     * 取所有行业分类
     */
    public function getAllIndustry(){
        $url = C('JhttpUrl');
        $url .="?command=getAllIndustry";

        return $this->in_curl($url);
    }

    /**
     * 提交数据到JAVA
     * @param string $method 提交方式，默认为GET
     * @return string json
     */
    private function in_curl($url){
        $ch = curl_init($url);
        // echo $url;
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close ($ch);
        //pt($result);
        return $result;
        //$this->jsontoarray($result);
    }

    /**
    * 手机好友添加
    */
 
   public function  addUser2User($userid,$mobile){
      $url=C("JhttpUrl");
      $url .="?command=addUser2User&userId=".$userid."&mobile=".$mobile;
      return $this->in_curl($url);
    }

    /**
    * 获取共同好友数接口
    */
 
   public function  getSameFriendCount($userId1,$userId2){
      $url=C("JhttpUrl");
      $url .="?command=getSameFriendCount&userId1=".$userId1."&userId2=".$userId2;
      return $this->in_curl($url);
    }

    /**
     * 推送分销用户
     * $companyId  公司的id companyid
     * $userId  用户id
     * $phone 是传回去的
     */

    public function  addOmsUser($companyId,$userId){
        $url=C("JhttpUrl");
        $url .="?command=addOmsUser&companyId=".$companyId."&userId=".$userId;

        echo $this->in_curl($url);
    }

    /**
     * 取消分销用户
     * $userId  用户id
     * $phone 是传回去的
     */

    public function  delOmsUser($userId){
        $url=C("JhttpUrl");
        $url .="?command=delOmsUser&userId=".$userId;

        echo $this->in_curl($url);
    }

    /***
     * 厂家id与经销商id的关系添加
     */
    public function addFacAge($companyid,$dealerid) {
        $url=C("JhttpUrl");
        $url .="?command=addFacAge&facId=".$companyid."&ageId=".$dealerid;
        return $this->in_curl($url);

    }


    /***
     * App端通过微信unionId获取用户信息
     * $unionId  微信unionId
     * $type  type=1，招商app登录，type=2 厂商登录
     */
    public function weixinLogin($unionId,$type=1) {

        $url=C("JhttpUrl");
        $url .="?command=weixinLogin&unionId=".$unionId."&type=".$type;
        return $this->in_curl($url);

    }


    /***
     * 用户绑定微信的$unionId
     * $unionId,$mobile,$password,$companyId
     * $unionId 微信返回的unionid
     * $mobile 用户手机号
     * $password 登录密码
     * $companyId 手机app端默认为1，厂商端传公司的id
     */
    public function addWeixin($unionId,$mobile,$password,$companyId=1) {
        //绑定接口
        $url = C('JhttpUrl');
        $url .="?command=addWeixin&unionId=".$unionId."&mobile=".$mobile."&companyId=".$companyId."&password=".$password;

//        return $url;
        return $this->in_curl($url);
    }


    /**
     * 获取邀请ID
     * @param string $userid 用户ID
     * @param string $body 提交的BODY数据
     * @return string json
     */
    public function getInviteInfoByUserId($userid=0){
        //绑定接口
        $url = C('JhttpUrl');
        $url .="?command=getInviteInfoByUserId&userId=".$userid;

//        return $url;
        return $this->in_curl($url);
    }


    /**
     * CURL提交数据到云之讯
     * @param string $option 提交路径
     * @param string $body 提交的BODY数据
     * @return string json
     */
    function in_u($body,$method='post'){

        $url = "http://japi.51lick.cn/uCenter/ucapi/getSameFriend";//发送的URL
        //头信息
        $header = array(
            'Content-Type:application/json;charset=utf-8',
        );
        //CURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        if($method == 'post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$body);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


}
