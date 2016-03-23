<?php
namespace Api\Model;
use Think\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/8
 * Time: 19:10
 */
class TokenModel extends Model
{
    protected $tablename = "token";

    /**
     * 通过id查找对应的key
     * @param $clientid
     * @return int
     */
    public function getKey($clientid){
        $re = M("token")->field("f_clientkey")->where("f_clientid='".$clientid."'")->find();
        return $re['f_clientkey'];
    }
}