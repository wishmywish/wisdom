<?php
namespace Taskadmin\Controller;
use Think\Controller;

class DealerProController extends Controller {
    function index(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        $access = I('get.access','000000');
        A("Api/Fun")->isAccess($access);//判断菜单权限
        $this->display();
    }
    
    function showProDetail(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        
        $dealerid = isset($_GET['dealerid'])? $_GET['dealerid'] : 0 ;
        $this->assign("dealerid",$dealerid);
        $map["f_dealerid"]=$dealerid;
        $map['f_prostatus']  = array('neq',0);
        $result = M("business_progress")->where($map)->order('f_id asc')->select();
        foreach ($result as $key => $value) {
            if (!empty($this->getUserDetail($value['f_userid']))) {
                $result[$key]['user'] = $this->getUserDetail($value['f_userid']);
            }else{
                $user= M("sysuser")->where("id=".$value['f_userid'])->find();
                $result[$key]['user']= $user['realname'];
            }
            $result[$key]['f_protime'] = date("Y/m/d",$value['f_protime']);

            $mmm['f_proname']  = 'contract';
            $mmm['f_prostatus']  = 1;
            $contract1 = M("business_progress")->where($mmm)->find();

            $mmm1['f_proname']  = 'contract';
            $mmm1['f_prostatus']  = 2;
            $contract2 = M("business_progress")->where($mmm1)->find();

            if (empty($contact1) && !empty($contact2)) {
               $result[$key]['f_xxx'] = 1;
            }
        }
        $this->assign("result",$result);

        $this->display();
    }

    function dispatchCheck(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//检测是否登录
        
        $dealerid = isset($_GET['dealerid'])? $_GET['dealerid'] : 0 ;
        $this->assign("dealerid",$dealerid);
        $map['f_proname'] = 'dispatch';
        $map['f_prostatus'] = 0;
        $map['f_dealerid'] = $dealerid;
        $result = M('business_progress')->where($map)->find();

        $this->assign("result",$result);
        // var_dump($result);
        // var_dump($dealerid);
        // exit();
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