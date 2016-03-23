<?php
namespace Taskadmin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        set_theme();
        $this->display();
    }

    function dealer($timeInterval){
        // $re=M('dealerbaseinfo')->distinct(true)->field('f_dealer_strats')->order('f_dealer_strats')->select();
        if (!empty($timeInterval)) {
           $map['f_uptime']=$timeInterval;
           $where['f_uptime']=$timeInterval;
        }
        for ($i=0; $i <5; $i++) {
            $map['f_dealer_strats']=$i;
            $map['f_status']=3;
            $where['f_status']=3;
            $f="f_dealerid";
            $j=array("LEFT JOIN t_task ON t_dealerbaseinfo.f_taskid = t_task.f_tid");
            $re_1[$i]["count"]=M('dealerbaseinfo')->field($f)->join($j)->where($map)->count('f_dealerid');
            $re_1[$i]["allCount"]=M('dealerbaseinfo')->field($f)->join($j)->where($where)->count('f_dealerid');
            if(0==$i){
                $re_1[$i]["color"]="#FF0000";
                $re_1[$i]["text"]="待审核";
            }elseif (1==$i) {
                $re_1[$i]["color"]="#FFFF00";
                $re_1[$i]["text"]="已中标";
            }elseif (2==$i) {
                $re_1[$i]["color"]="#3300FF";
                $re_1[$i]["text"]="厂家驳回";
            }elseif (3==$i) {
                $re_1[$i]["color"]="#33FF00";
                $re_1[$i]["text"]="已推荐";
            }elseif (4==$i) {
                $re_1[$i]["color"]="#33FF00";
                $re_1[$i]["text"]="平台驳回";
            }
        }
        return $re_1;
    }

    function company($timeInterval){
        for ($i=0; $i <6 ; $i++) { 
            $re = A('Api/Jhttp')->getAllCompanyInfo(0,0,$i);
            $arr = json_decode($re,true);
            $re_2[$i]["count"] = $arr['count'];
            $sum+=$arr['count'];
            if(0==$i){
                $re_2[$i]["color"]="#66FFDD";
                $re_2[$i]["text"]="未通过";
            }elseif (1==$i) {
                $re_2[$i]["color"]="#00BFFF";
                $re_2[$i]["text"]="已审核";
            }elseif (2==$i) {
                $re_2[$i]["color"]="#B8860B";
                $re_2[$i]["text"]="未开通招商";
            }elseif (3==$i) {
                $re_2[$i]["color"]="#3300FF";
                $re_2[$i]["text"]="已停用";
            }elseif (4==$i) {
                $re_2[$i]["color"]="#FF0000";
                $re_2[$i]["text"]="待审核";
            }elseif (5==$i) {
                $re_2[$i]["color"]="#33FF00";
                $re_2[$i]["text"]="新注册";
            }
        }
        $re_2['allCount']=$sum;
        return $re_2;
    }

    function task($f_tasktypeid,$timeInterval)
    {
        if (!empty($timeInterval)) {
           $map['f_creatdate']=$timeInterval;
           $where['f_creatdate']=$timeInterval;
        }
        $map['f_tasktypeid']=$f_tasktypeid;
        $where['f_tasktypeid']=$f_tasktypeid;
        $task["allCount"]=M('task')->where($where)->count('f_tid');
        for ($i=0; $i <12 ; $i++) {
            if (8==$i||9==$i||10==$i) {
                continue;
            }else{
                $map['f_status']=$i;
                $f="f_tid";
                $task[$i]["count"]=M('task')->field($f)->where($map)->count('f_tid');
                if(0==$i){
                    $task[$i]["color"]="#3300FF";
                    $task[$i]["text"]="已删除";
                }elseif (1==$i) {
                    $task[$i]["color"]="#FFA500";
                    $task[$i]["text"]="已结束";
                }elseif (2==$i) {
                    $task[$i]["color"]="#FF0000";
                    $task[$i]["text"]="待客服审核";
                }elseif (3==$i) {
                    $task[$i]["color"]="#FFD700";
                    $task[$i]["text"]="已发布";
                }elseif (4==$i) {
                    $task[$i]["color"]="#008B8B";
                    $task[$i]["text"]="已过期";
                }elseif (5==$i) {
                    $task[$i]["color"]="#66FFDD";
                    $task[$i]["text"]="已驳回";
                }elseif (6==$i) {
                    $task[$i]["color"]="#800080";
                    $task[$i]["text"]="待提交";
                }elseif (7==$i) {
                    $task[$i]["color"]="#00BFFF";
                    $task[$i]["text"]="待财务审核";
                }elseif (11==$i) {
                    $task[$i]["color"]="#FFFF00";
                    $task[$i]["text"]="已下架";
                }
            }
        }
        return $task;
    }

    public function main(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//判断是否已经登录
        $dealer=$this->dealer();
        $company=$this->company();
        $f_tasktypeid=I('f_tasktypeid');
        $f_tasktypeid=empty($f_tasktypeid)?array('in','2,4,5,6'):$f_tasktypeid;
        $task=$this->task($f_tasktypeid);

        $this->assign('f_tasktypeid', $f_tasktypeid);
        $this->assign('dealer', $dealer);
        $this->assign('company', $company);
        $this->assign('task', $task);
        $this->display();
    }

    public function today(){
        set_theme();
        A("Taskadmin/Fun")->islogin();//判断是否已经登录
        $curTime=time();               //当前时间
        $curdate=date('Y-m-d',$curTime);
        $curMidnight=strtotime($curdate); //当前时间凌晨
        $timeInterval=array('between',"$curMidnight,$curTime");
        $dealer=$this->dealer($timeInterval);
        $company=$this->company($timeInterval);
        $f_tasktypeid=I('f_tasktypeid');
        $f_tasktypeid=empty($f_tasktypeid)?array('in','2,4,5,6'):$f_tasktypeid;
        $task=$this->task($f_tasktypeid,$timeInterval);
        // var_dump($task);exit();
        $this->assign('f_tasktypeid', $f_tasktypeid);
        $this->assign('dealer', $dealer);
        $this->assign('company', $company);
        $this->assign('task', $task);
        $this->display();
    }

    //获取验证码
    public function verify_c() {
        verify();
    }
    //验证码检查
    public function check_verify_c() {
        $code = I('get.code','');
        check_verify($code);
    }
    
    public function test() {
        set_theme();

//        echo date("Y-m-d H:i:s");
        $this->display();
    }

    public function reg(){
        set_theme();

        $this->display();
    }


    public function getQuDao(){
        
        $start = I('post.start');
        $end = I('post.end');
        $qudao = I('post.qudao');
        $start = str_replace("/","-",$start);
        $end = str_replace("/","-",$end);

        $sql  ='SELECT t.*, FROM_UNIXTIME(t.f_uptime,"%Y-%m-%d %H:%i:%s") FROM `t_regapp` AS t WHERE t.`f_udid`="'.$qudao.'" AND FROM_UNIXTIME(t.f_uptime,"%Y-%m-%d %H:%i:%s")>="'.$start.'" AND FROM_UNIXTIME(t.f_uptime,"%Y-%m-%d %H:%i:%s")<="'.$end.'" ';
        $result = M('regapp')->query($sql);

        if (count($result) > 0 ) {
            $num = count($result);
        }else{
            $num = 0;
        }

        echo $num;
    }

    public function curl_chitousi(){
        header("Content-Type: text/html;charset=utf-8");
        $body = I("post.");
        $word = iconv( "UTF-8", "gb2312//IGNORE" , $body['word']);
        $url = "http://cts.388g.com/fasong.php?w=".$word."&num=".$body['length']."&type=".$body['cang']."&yayuntype=".$body['type'];//发送的URL
        $ch = curl_init($url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close ($ch);
        $result = iconv( "gb2312", "UTF-8//IGNORE" , $result);
        $search = '/<li>(.*?)<\/li>/is';
        preg_match_all($search,$result,$r,PREG_SET_ORDER );
        $tags = strip_tags($r[0][1]);
        $re = str_replace('，','<br>',$tags);
        $re = str_replace('。','<br>',$re);
        //存数据库
        $add_map["f_word"] = $body['word'];
        $add_map["f_shi"] = $re;
        $add_map["f_uptime"] = time();
        $add_map["f_uid"] = $body['uid'];
        if((int)$body['id']==0){
            $re_back["id"] = M("shici")->add($add_map);
        }else{
            M("shici")->where("f_id=".$body['id'])->save($add_map);
            $re_back["id"] = $body['id'];
        }
        $re_back["shi"] = $re;
        echo json_encode($re_back);
//        exit;
//        $matches = array();
//        $preg = '/<div class="form">([\w\W]*?)<\/div>/';
//        preg_match_all($preg, $result, $matches);
////        var_dump($matches);
//        echo $matches[1][0];
    }

    
}