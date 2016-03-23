<?php
namespace Mobileweb\Controller;
use Think\Controller;

class GamesController extends Controller{

    public $in_arr,$out_arr;
    public function conf()
    {
        header("Content-Type: text/html;charset=utf-8");
        //接收数据
        if (IS_POST) {//post接收
            $this->in_arr = I('post.');
//            $this->in_arr = base64_decode(I('post.param'));
            $this->info();
        } elseif (IS_GET) {//post接收
            $this->in_arr = I('get.');
//            $this->in_arr = base64_decode(I('get.param'));
            $this->info();
        } else {//异常接收
            $this->out_arr['error_code'] = '900000';
            $this->out_arr['error_text'] = "异常接收";
            echo A('Api/Fun')->JSON($this->out_arr);
            exit;
        }
    }

    //处理初始数据
    private function info(){
//        var_dump($this->in_arr);
//        exit;
        if($this->in_arr['command']==""){
            $this->out_arr['error_code'] = '900001';
            $this->out_arr['error_text'] = "COMMAND异常";
            echo A('Api/Fun')->JSON($this->out_arr);
            exit;
        }else{
            switch ($this->in_arr['command']){
                case 'reguser':
                    $this->out_arr['req_command'] = $this->in_arr['command'];
                    $this->out_arr['resq_time'] = date("Y-m-d H:i:s",time());
                    $this->reguser();
                    break;
                case 'modiuser':
                    $this->out_arr['req_command'] = $this->in_arr['command'];
                    $this->out_arr['resq_time'] = date("Y-m-d H:i:s",time());
                    $this->modiuser();
                    break;
                case 'searchuser':
                    $this->out_arr['req_command'] = $this->in_arr['command'];
                    $this->out_arr['resq_time'] = date("Y-m-d H:i:s",time());
                    $this->searchuser();
                    break;
                case 'addgold':
                    $this->out_arr['req_command'] = $this->in_arr['command'];
                    $this->out_arr['resq_time'] = date("Y-m-d H:i:s",time());
                    $this->addgold();
                    break;
                case 'mylist':
                    $this->out_arr['req_command'] = $this->in_arr['command'];
                    $this->out_arr['resq_time'] = date("Y-m-d H:i:s",time());
                    $this->mylist();
                    break;
                case 'buyshop':
                    $this->out_arr['req_command'] = $this->in_arr['command'];
                    $this->out_arr['resq_time'] = date("Y-m-d H:i:s",time());
                    $this->buyshop();
                    break;

            }
            echo A('Api/Fun')->JSON($this->out_arr);
        }
    }
    //添加用户
    private function reguser(){
        if(empty($this->in_arr['f_wechatid'])){
            $this->out_arr['error_code'] = '100001';
            $this->out_arr['error_text'] = "参数出错";
        }else{
            //查微信ID是否存在
            $re = M("playcity")->where("f_wechatid='".$this->in_arr['f_wechatid']."'")->find();
//            echo M("playcity")->getLastSql();
            if(!$re){
                unset($this->in_arr['command']);
                $this->in_arr['f_regdate'] = time();
                $id = M("playcity")->add($this->in_arr);
                $this->out_arr['error_code'] = '000000';
                $this->out_arr['error_text'] = "成功";
                $this->out_arr['f_pcid'] = $id;
            }else{
                $this->out_arr['error_code'] = '000000';
                $this->out_arr['error_text'] = "成功";
            }
        }
    }

    //修改用户
    private function modiuser(){
        if(empty($this->in_arr['f_pcid'])){
            $this->out_arr['error_code'] = '100001';
            $this->out_arr['error_text'] = "参数出错";
        }else{
            $f_pcid = $this->in_arr['f_pcid'];
            unset($this->in_arr['f_pcid']);
            unset($this->in_arr['command']);
            M("playcity")->where("f_pcid=".$f_pcid)->save($this->in_arr);
            $this->out_arr['error_code'] = '000000';
            $this->out_arr['error_text'] = "成功";
        }
    }

    //查询用户是否存在
    private function searchuser(){
        unset($this->in_arr['command']);
        $re = M("playcity")->where("f_wechatid='".$this->in_arr['f_wechatid']."'")->find();
        if($re){
            $this->out_arr['error_code'] = '000000';
            $this->out_arr['error_text'] = "成功";
            $this->out_arr['list'] = $re;
        }else{
            $this->out_arr['error_code'] = '100002';
            $this->out_arr['error_text'] = "用户不存在";
        }
    }

    //添加钱
    private function addgold(){
        unset($this->in_arr['command']);
        if($this->in_arr['f_mypcid']==0){
            $this->out_arr['error_code'] = '100001';
            $this->out_arr['error_text'] = "参数出错";
        }else{
            $this->in_arr['f_date']=time();

            $id = M("playcitydetail")->add($this->in_arr);
//            $this->out_arr['sql'] = M("playcitydetail")->getLastSql();
            //更新红包数目f_mypcid="+f_mypcid+"&f_hepcid="+f_hepcid+"&f_goldcoin="+f_goldcoin

//            $count=M("playcitydetail")->where("f_mypcid =".$this->in_arr["f_mypcid"])->sum("f_goldcoin");
//            $re=M("playcity")->where("f_pcid=".$this->in_arr["f_mypcid"])->setField('f_totalglodcoin',$count);
              $re=M("playcity")->where("f_pcid=".$this->in_arr["f_mypcid"])->setInc("f_totalglodcoin",$this->in_arr["f_goldcoin"]);
            if($id){
                $this->out_arr['error_code'] = '000000';
                $this->out_arr['error_text'] = "成功";
            }else{
                $this->out_arr['error_code'] = '100003';
                $this->out_arr['error_text'] = "业务处理失败";
            }

        }

    }

    //查看我的页面
    private function mylist(){
        //取我的钱
        $this->out_arr['own_info'] = M("playcity")->where("f_mobile='".$this->in_arr['mobile']."'")->find();
        //取产品列表
        $shop_map["f_status"] = 1;
        $shop_map["f_lotterystatus"] = 1;
        $shop_j = array("LEFT JOIN files ON t_files.f_id = t_shop_list.f_fileid");
        $out_arr['shop_list'] = M("shoplist")->where($shop_map)->join($shop_j)->select();
        //我的购买记录
        $buy_map["f_userid"] = $in_arr['userid'];
        $j = array("LEFT JOIN t_shoplist as s ON s.f_sid = t_own_award.f_shopid");
        $f = "s.f_sid,s.f_shopname,MAX(t_own_award.f_shopid)";
        $shop_re = M("own_award")->field($f)->join($j)->where($buy_map)->group('t_own_award.f_shopid')->select();
//        echo M("own_award")->getLastSql();
//        $this->out_arr['buy_list'] = M("own_award")->field($f)->join($j)->where($buy_map)->select();
        foreach($shop_re as $key=>$v){
            $buy_map["f_userid"] = $in_arr['userid'];
            $buy_map["f_shopid"] = $v['f_sid'];
            $shop_re[$key]["award_no_list"] = M("own_award")->field("f_award_no")->where($buy_map)->select();
        }
        $out_arr['buy_list'] = $shop_re;

        $this->out_arr['error_code'] = '000000';
        $this->out_arr['error_text'] = "成功";
    }

    //购买奖号
    private function buyshop(){
        $shopid = empty($this->in_arr["shopid"])?0:$this->in_arr["shopid"];
        $userid = empty($this->in_arr["userid"])?0:$this->in_arr["userid"];
        $mobile = empty($this->in_arr["mobile"])?0:$this->in_arr["mobile"];
        $buysum = empty($this->in_arr["buysum"])?0:$this->in_arr["buysum"];
        $buyprice = empty($this->in_arr["buyprice"])?0:$this->in_arr["buyprice"];
        //查看购买的够不够
        $play_map["f_mobile"] = $mobile;
        $play_re = M("playcity")->where($play_map)->find();
        if(!$play_re){
            $this->out_arr['error_code'] = '300000';
            $this->out_arr['error_text'] = "您还没有参与游戏！";
        }else{
            $totel_price = $buysum*$buyprice;
            if($play_re["f_totalglodcoin"]<$totel_price){
                $this->out_arr['error_code'] = '400000';
                $this->out_arr['error_text'] = "您的红包不足！";
            }else{
                //随机取奖号，并标记；注：已经标记的不显示
                $re = $this->getAwardNo($shopid,$buysum,$userid,$buyprice,$mobile);
                if($re==0){
                    $this->out_arr['error_code'] = '200001';
                    $this->out_arr['error_text'] = "商品已经没有了";
                }elseif($re=='-1') {
                    $this->out_arr['error_code'] = '200002';
                    $this->out_arr['error_text'] = "数量不够了";
                }elseif($re=='-2') {
                    $this->out_arr['error_code'] = '200003';
                    $this->out_arr['error_text'] = "购买失败";
                }else {
                    $this->out_arr['error_code'] = '000000';
                    $this->out_arr['error_text'] = "成功";
                }
            }
        }
    }

    //随机取奖号，并标记；注：已经标记的不显示
    private function getAwardNo($shopid,$buysum,$userid,$buyprice,$mobile){
        $award_map["f_shopid"] = $shopid;
        $award_map["f_status"] = 0;
        $award_f = "f_serial";
        $award_re = M("award_serial")->field($award_f)->where($award_map)->select();
        $award_count = count($award_re);//可用奖号的个数，用于产生随机数
        if($award_count==0){
            //已经卖完了
            return 0;
        }elseif($award_count<$buysum){
            //数量不够
            return "-1";
        }else{
            //正常购买
            $rand_no = rand(0,$award_count-1);//产生随机下标
            $own_serial = $award_re[$rand_no]["f_serial"];
            $award_map["f_serial"] = $own_serial;
            $update_map["f_status"] = 1;
            $sum = M("award_serial")->where($award_map)->save($update_map);
            if($sum<=0){
                self::getAwardNo($shopid,$buysum,$userid,$buyprice,$mobile);
            }else{
                //添加购买记录
                $own_map["f_shopid"] = $shopid;
                $own_map["f_userid"] = $userid;
                $own_map["f_award_no"] = $own_serial;
                $own_map["f_buytime"] = time();
                $id = M("own_award")->add($own_map);
                if($id<=0){
                    //购买失败
                    $award_up_map["f_serial"] = $own_serial;
                    $update_map_1["f_status"] = 0;
                    //返还已选的奖号
                    M("award_serial")->where($award_up_map)->save($update_map_1);
                    return "-2";
                }else{
                    //记购买数量
                    $shop_map["f_sid"] = $shopid;
                    M("shoplist")->where($shop_map)->setInc('f_buysum',$buysum);
                    //扣钱
                    $totel_p = $buysum*$buyprice;
                    $playc_map["f_mobile"] = $mobile;
                    $playc_map["f_status"] = 1;
                    M("playcity")->where($playc_map)->setDec('f_totalglodcoin',$totel_p);
                    return $own_serial;
                }

            }
        }
    }

}