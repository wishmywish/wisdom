<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/17
 * Time: 11:31
 */

namespace Taskadmin\Controller;
use Think\Controller;


class PushController extends Controller
{
    private $a = 10;
    public function index(){
        set_theme();
        $this->display();
    }

    public function f(){
        set_theme();
        $this->display();
    }
    public function i(){
        set_theme();
        $this->display();
    }
    public function gh(){
        set_theme();
        $this->display();
    }
    public function j(){
        set_theme();
        $this->display();
    }
    public function kl(){
        set_theme();
        $this->display();
    }

    public function pushlist(){
        $loginResult = array();
        $udid = I('get.udid','A');
        $re['downlist'] = M('downapp')->field("FROM_UNIXTIME(f_time,'%Y-%m-%d') as downtime,count(*) as downsum")->where("f_udid='".$udid."'")->group("FROM_UNIXTIME(f_time,'%Y-%m-%d')")->select();
        $re['openlist'] = M('openapp')->field("FROM_UNIXTIME(f_time,'%Y-%m-%d') as opentime,count(*) as opensum")->where("f_udid='".$udid."'")->group("FROM_UNIXTIME(f_time,'%Y-%m-%d')")->select();
        $re['reglist'] = M('regapp')->field("FROM_UNIXTIME(f_uptime,'%Y-%m-%d') as regtime,count(*) as regsum")->where("f_udid='".$udid."'")->group("FROM_UNIXTIME(f_uptime,'%Y-%m-%d')")->select();

        foreach ($re['reglist'] as $key => $value) {
            $sql = "SELECT FROM_UNIXTIME(f_uptime,'%Y-%m-%d') AS regtime,f_mobile FROM `t_regapp` WHERE ( f_udid='".$udid."' AND FROM_UNIXTIME(f_uptime,'%Y-%m-%d')='".$value['regtime']."')";
            $result = M('regapp')->query($sql);

            foreach ($result as $k => $v) {
               $res = A('Api/Jhttp')->getUserinfo($v['f_mobile']);
               $arr = json_decode($res,true);
               if (isset($arr['list'])) {
                   $allUerId[] = $arr['list']['userId'];
               }
            }
        }

        $allUerId = array_unique($allUerId);
        foreach($allUerId as $k=>$v) {
            if ($k == 0) {
                $allUerId1 .= $v;
            }else{
                $allUerId1 .= ',' . $v;
            }
        }

        if (isset($allUerId1)) {
            foreach ($re['reglist'] as $key => $value) {
                $loginSql ="SELECT SUM(aaa) AS total FROM (SELECT MAX(logintime) AS ctime ,COUNT(f_userid) AS aaa FROM (SELECT MAX(FROM_UNIXTIME(f_logintime,'%Y-%m-%d')) AS logintime,MAX(f_userid) AS f_userid FROM t_login_log WHERE f_userid in(".$allUerId1.") AND FROM_UNIXTIME(f_logintime,'%Y-%m-%d')='".$value['regtime']."' GROUP BY f_userid,FROM_UNIXTIME(f_logintime,'%Y-%m-%d') ) AS t GROUP BY t.logintime) aa";
                $loginResult[] = M('login_log')->query($loginSql);
            }
        }
        // var_dump($loginResult);exit();
        $re['livenesslist'] = $loginResult;

        //$reB = M('downapp')->where("f_udid='B'")->group()->select();
        echo json_encode($re);
    }
}