<?php
namespace Api\Model;
use Think\Model;
class ShopsheetModel extends Model {
    protected $tableName = 'shopsheet';
    
    public function add_shopsheet($label,$userid,$amounttype,$shopingtype,$amount,$taskid,$strats,$useraccountid,$eventsid=0,$shopid=0) {
        $t = M($this->tableName);
        $map['f_label'] = $label;
        $map['f_userid'] = $userid;
        $map['f_amounttype'] = $amounttype;
        $map['f_shopingtype'] = $shopingtype;
        $map['f_amount'] = $amount;
        $map['f_taskid'] = $taskid;
        $map['f_eventsid'] = $eventsid;
        $map['f_strats'] = $strats;
        $map['f_useraccountid'] = $useraccountid;
        $map['f_shopid'] = $shopid;
        $map['f_optiondate'] = time();
        $map['f_runningnum'] = date('Ymd').time().rand(100000,999999);//24位流水号
        //f_goldcoin  f_credit
        $re = $t->add($map);
        
        if($re){
            $r=M('userbalance')->where('f_userid='.$userid)->find();
            if(!count($r)){
                $m['f_userid']=$userid;
                M('userbalance')->add($m);
            }
            if($amounttype==1){//+
                if($shopingtype==1){//金币
                    M('userbalance')->where('f_userid='.$userid)->setInc('f_goldcoin',$amount);
                }elseif($shopingtype==2){//银票
                    M('userbalance')->where('f_userid='.$userid)->setInc('f_credit',$amount);
                }
            }else{//-
                if($shopingtype==1){
                    M('userbalance')->where('f_userid='.$userid)->setDec('f_goldcoin',$amount);
                }elseif($shopingtype==2){
                    M('userbalance')->where('f_userid='.$userid)->setDec('f_credit',$amount);
                }
            }
        }
        return $re;
    }
    
    public function shoplist($shopingtype,$userid) {
        $t = M($this->tableName);
        $map['f_shopingtype'] = $shopingtype;
        $map['t_shopsheet.f_userid'] = $userid;
        $f = array('f_taskid','f_title','t_shopsheet.f_userid','f_amount','f_amounttype','f_useraccountid','f_strats','f_label','f_name','f_optiondate','f_accountname');//,'f_accountname','f_accountname','f_optiondate'    ,"LEFT JOIN t_useraccount ON t_useraccount.f_indexid = t_shopsheet.f_useraccountid"
        $j = array("LEFT JOIN t_shopingtype ON t_shopsheet.f_shopingtype = t_shopingtype.f_indexid","LEFT JOIN t_useraccount ON t_useraccount.f_indexID = t_shopsheet.f_useraccountid","LEFT JOIN t_task ON t_task.f_tid = t_shopsheet.f_taskid");
        $re = $t->where($map)->field($f)->join($j)->order('f_optiondate desc')->select();
        //echo $t->getLastsql();
        return $re;
    }
    
    public function sumsheet($shopingtype,$userid){
        $t = M($this->tableName);
        $map['f_amounttype'] = 1;
        $map['f_shopingtype'] = $shopingtype;
        $map['f_userid'] = $userid;
        $re = $t->where($map)->sum('f_amount');
        if($re==null){
            $re = 0;
        }
        return $re;
    }
    
    public function todaysheet($shopingtype,$userid){
        $t = M($this->tableName);
        $start = strtotime(date('Y-m-d 00:00:00'));
        $end = strtotime(date('Y-m-d 23:59:59'));
        //echo $start."|".$end;
        //$Model = new Model();
        $map['f_amounttype'] = 1;
        $map['f_shopingtype'] = $shopingtype;
        $map['f_userid'] = $userid;
        $map['f_optiondate'] = array(array('egt',$start),array('elt',$end));
        $re = $t->where($map)->sum('f_amount');
        if($re==null){
            $re = 0;
        }
        //echo $t->getLastsql();
        //$re = $Model->query("select sum(f_amount) as f_amount,FROM_UNIXTIME(f_optiondate,'%Y%m%d') as aa from t_shopsheet where FROM_UNIXTIME(f_optiondate,'%Y%m%d')=".date('Ydm',time()));
        return $re;
    }
}
