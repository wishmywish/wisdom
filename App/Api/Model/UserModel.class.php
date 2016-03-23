<?php
/**
 * Description of UserModel
 *
 * @author Administrator
 */
namespace Api\Model;
use Think\Model;
class UserModel extends Model {
    protected $tableName = 'sysuser';
    
    public function userinfo($username,$password) {
        $user = M($this->tableName);
        $map['username'] = $username;
        $map['password'] = md5($password);
        $map['strat'] = 1;
        $re = $user->field('t_sysuser.id,t_sysuser.username,t_sysuser.password,t_sysuser.strat,t_sysuser.realname,t_sysuser.plattype,t_sysuser.accessid,t_sysuser.accesslist,t_sysaccess.accessname,t_sysaccess.accessvalue')->where($map)->join('LEFT JOIN t_sysaccess on t_sysaccess.id=t_sysuser.accessid')->find();

        //echo $user->getLastsql();
        if(count($re)>0){
            //记录SESSION，给WEB端使用
            session('id',$re['id']);
            session('username',$re['username']);
            session('realname',$re['realname']);
            session('plattype',$re['plattype']);
            session('accessid',$re['accessid']);
            session('accessname',$re['accessname']);
            session('accessvalue',$re['accessvalue']);
            return $re;
        }else{
            return 0;
        }

    }
}
