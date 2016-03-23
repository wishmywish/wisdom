<?php
namespace Taskadmin\Controller;
use Think\Controller;


class GameController extends Controller
{
    public function index(){
        set_theme();
        $re = M("playcity_set")->where("f_id=1")->find();
        $this->assign("re",$re);
        $this->assign("tj",$this->tj());
        $this->display();
    }

    public function inpost(){
        $arr = I("post.");
        $arr_w["f_id"] = 1;
        $count = M("playcity_set")->where($arr_w)->save($arr);
        return $count;
    }

    private function tj(){
        $tj["p_count"] = M("playcity")->count();
        $tj["gold_sum"] = M("playcity")->sum("f_totalglodcoin");
        return $tj;
    }
}