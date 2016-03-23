<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/29
 * Time: 21:23
 */

namespace Api\Controller;
use Think\Controller;

class JhttpcodeController extends Controller {
    private $errorCode = array(
        '999999'=>'后台异常',
        '100001'=>'原密码错误',
        '100002'=>'未知异常',
        '100003'=>'用户不存在',
        '100004'=>'用户手机号或密码为空',
        '100005'=>'用户手机号或公司ID为空',
        '100006'=>'失效的证书',
        '100007'=>'非法的证书',
        '100008'=>'token或公司ID为空',
        '100009'=>'用户id或密码为空',
        '100010'=>'企业不存在',
        '100011'=>'部门不存在',
        '100012'=>'邀请码不存在',
        '100013'=>'用户已存在',
        '100014'=>'用户信息为空',
        '100015'=>'删除失败',
        '100016'=>'查询条件为空',
        '100017'=>'查询条件不明确',
        '100018'=>'企业下不存在用户',
        '100019'=>'企业id或要查询的类型不能为空',
        '100020'=>'企业已存在',
        '100021'=>'企业信息为空',
        '100022'=>'companyId为空',
        '100023'=>'companyName为空',
        '100024'=>'厂商不存在',
        '100025'=>'经销商不存在',
        '100026'=>'厂商id或经销商id不能为空',
        '100027'=>'厂商推送失败',
        '100028'=>'厂商经销商推送失败',
        '100029'=>'经销商不存在',
        '100030'=>'厂商不存在',
        '100031'=>'厂商id或用户id不能为空',
        '100032'=>'部门信息为空',
        '100033'=>'部门id为空',
        '100034'=>'添加部门领导关系失败',
        '100035'=>'部门领导信息为空',
        '100036'=>'对应的部门领导用户不存在',
        '100037'=>'更新部门领导关系失败',
        '100038'=>'部门领导id为空',
        '100039'=>'部门领导删除失败',
        '100040'=>'部门领导id为空',
        '100041'=>'工作经历不存在',
        '100042'=>'该企业下不存在此用户',
        '100043'=>'工作经历为空',
        '100044'=>'教育经历id为空',
        '100045'=>'教育经历不存在',
        '100046'=>'教育经历为空',
        '100047'=>'该区域下不存在子区域',
        '100048'=>'parentId为空',
        '100049'=>'该行业下不存在子行业',
        '100050'=>'该数据字典不存在',
        '100051'=>'查询条件typeid为空',
        '100052'=>'用户id为空',
        '100053'=>'公共技能标签不存在',
        '100054'=>'行业id为空',
        '100055'=>'该行业不存在',
        '200001'=>'密码类型不存在',
        '200002'=>'查询的类型不存在',
        '100098'=>'身份证已被绑定',

        '100105'=>'微信用户不存在',
        '100106'=>'微信id不能为空',
        '100107'=>'微信id或者手机号不能为空',
        '100108'=>'邀请码已用完',
        '100109'=>'该手机号已绑定微信',
        '100110'=>'父部门下该部门已存在，创建失败',
        '100111'=>'该微信已被绑定',
    );

    function searchCode($code){
        return $this->errorCode[$code];
    }
}