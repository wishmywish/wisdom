<?php
namespace Mobileweb\Controller;
use Think\Controller;
class AuthorityController extends Controller {
    function index(){
        set_theme();

        $dealerid = isset($_GET['dealerid'])? $_GET['dealerid'] : 0 ;
        $this->assign("dealerid",$dealerid);
        $result = M('authorization')->where('f_dealerid='.$dealerid)->find();
        $j = array("LEFT JOIN t_task ON t_task.f_tid = t_dealerbaseinfo.f_taskid");
        $detail = M('dealerbaseinfo')->JOIN($j)->where('f_dealerid='.$dealerid)->find();
        $userDetail = $this->getUserDetail($detail['f_userid']);
        $companyDetail = $this->getCompanyDetail($detail['f_companyid']);
        $time = date("Y/m/d",$result['f_datetime']);
        $date= explode("/", $time);

        $this->assign('result', $result);
        $this->assign('userDetail', $userDetail);
        $this->assign('companyDetail', $companyDetail);
        $this->assign('date', $date);
        
        $this->display();
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

}
