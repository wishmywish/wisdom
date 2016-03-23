<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/2
 * Time: 10:03
 */

namespace Mobileweb\Controller;
use Think\Controller;

class CangtouController  extends  Controller
{

    //藏头诗游戏

    function  cangTouOpoem(){
        $time=time();
        $redirect_url="index.php/Mobileweb/Cangtou/cangTouUserInfo?no=".$time;
        A("Wechat")->obtain_user_information($redirect_url);
    }

    //获取藏头诗用户信息
    function cangTouUserInfo(){
        $inarr = I("get.");
        if(isset($inarr["code"])){
            $re = $this->cangTou($inarr["code"]);
        }
        $url = C("WebUrl")."index.php/Mobileweb/Cangtou/cangts?f_uid=".$re;
        header("Location:".$url);

    }

    function  cangTou($code){
        S("access_token1",null);
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C("appid")."&secret=".C('secret')."&code=".$code."&grant_type=authorization_code";
        //获取access_token 与基础
        $access_json=file_get_contents($url);
        $access_arr=json_decode($access_json,true);
        $access_token=$access_arr["access_token"];
        $openid=$access_arr["openid"];
        S("access_token1",$access_token,3600);
        $res=A("Wechat")->get_user_info($openid,$access_token);
        $re_arr=json_decode($res,true);
        if(!empty($re_arr["unionid"])&&!empty($re_arr["nickname"])){
            $re=$this->searchUserByCang($re_arr["unionid"],$re_arr["nickname"]);
            return $re;
        }else{
            $url = C("WebUrl")."index.php/Mobileweb/Cangtou/cangTouOpoem";
            header("Location:".$url);
        }
    }



    //藏头诗
    function cangts(){
        set_theme();
        $f_uid=I("get.f_uid");

        //获取用户信息
        $list=$this->getuseraboutlist($f_uid);
        //当前页面需要用jssdk
        //签名url
        $url=C('WebUrl')."index.php/Mobileweb/Cangtou/cangts?f_uid=".$f_uid;
        //签名获取相关 "timestamp" "nonceStr"  "signature"
        $data=A("Wechat")->get_jsapi_shal($url);
//        pt($data);

        $shareurl=C('WebUrl')."index.php/Mobileweb/Cangtou/cangshare?f_uid=".$f_uid;
        $shareimg=C('WebUrl')."Public/Mobileweb/Default/images/hb.jpg";
        //分享地址
        $this->assign("shareurl",$shareurl);
        $this->assign("shareimg",$shareimg);
        $this->assign("list",$list);
        $this->assign("data",$data);
        $this->display();
    }

    //藏头诗分享授权{
    function  cangshare(){
        $f_uid=I("get.f_uid");
        $redirect_url="index.php/Mobileweb/Cangtou/cangts_share?f_uid=".$f_uid;
        A("Wechat")->obtain_user_information($redirect_url);
    }

    //藏头诗分享页面
    function cangts_share(){
        set_theme();
        $code=I("code");
        S("access_token",null);
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".C("appid")."&secret=".C('secret')."&code=".$code."&grant_type=authorization_code";
        //获取access_token 与基础
        $access_json=file_get_contents($url);
        $access_arr=json_decode($access_json,true);
        $access_token=$access_arr["access_token"];
        $openid=$access_arr["openid"];
        S("access_token",$access_token,3600);
        $res=A("Wechat")->get_user_info($openid,$access_token);
        $res_arr=json_decode($res,true);
        //给谁抢红包的pid
        $myf_uid=I("get.f_uid");
        //根基$myf_uid查找藏头诗内容和昵称
        $mylist=$this->getuseraboutlist($myf_uid);
        //判断该授权用户信息
        if($res_arr['unionid']!="" && $res_arr['nickname']!=""){
            $b_reid=$this->searchUserByCang($res_arr["unionid"],$res_arr["nickname"]);
            $b_list=$this->getuseraboutlist($b_reid);
            if($mylist["f_wechatnick"]==$b_list["f_wechatnick"]){
//                echo "---";
                $url = C('WebUrl')."index.php/Mobileweb/Cangtou/cangts?f_uid=".$myf_uid;
                header("Location:".$url);
            }else{
                $this->assign("givenick",A("Hbgame")->userTextDecode($mylist["f_wechatnick"]));
                $this->assign("giveshi",$mylist["f_shi"]);
                $this->assign("giveid",$mylist["f_uid"]);
                $this->assign("bid",$b_reid);
                $this->display();
            }

        }

    }

    //获取用户相关的藏头诗
    function  getuseraboutlist($f_uid){
           $j = "LEFT JOIN t_shici as t ON t.f_uid=t_shici_user.f_uid";
           $f = "t_shici_user.f_uid as f_uid,t_shici_user.f_uptime,t_shici_user.f_wechatid,t_shici_user.f_wechatnick,t_shici_user.f_uptime,t.f_id,t.f_word,t.f_shi,t.f_uptime as u_f_uptime";
           $map["t_shici_user.f_uid"]=$f_uid;
           $re=M("shici_user")->field($f)->where($map)->join($j)->find();
           return $re;
    }

    //获取用户信息
    function  searchUserByCang($unicode,$nickname){
        $re = M("shici_user")->where("f_wechatid='".$unicode."'")->find();
        if($re){
            //如果存在返回id 不存在添加数据并返回id
            return $re["f_uid"];
        }else{
            $map["f_wechatid"]=$unicode;
            $map["f_wechatnick"]=A("Hbgame")->userTextEncode($nickname);
            $map["f_uptime"]=time();
            $re=M("shici_user")->add($map);
            return $re;
        }
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