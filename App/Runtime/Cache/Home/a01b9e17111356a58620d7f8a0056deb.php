<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
        /*清除默认样式*/
        body,h1,ul,li,p,img,div,dl,dd,dt,span,a{ margin: 0; padding: 0; list-style: none;}
        /*公共的样式*/
        a{ text-decoration: none; color: #646464; margin-left: 20px;}
        body{ font-family: '宋体'; color: #646464; font-size: 14px;}
        textarea{font-family: '宋体'; color: #646464; font-size: 14px;border: 1px solid #a9a9a9;}
        input,select{border: 1px solid #a9a9a9;color: #646464;}
        .fl{ float: left;}
        .rg{float:right;}
        /*主体*/
        .main{overflow: hidden;width: 100%; }
        .main ul{margin-top: 20px;width: 100%;}
        .main span{width: 100px;text-align: right;display: inline-block;margin-right: 7px;float: left;line-height: 25px;}
        .main select{width: 100px;height: 29px;}
        .main ul input{width: 80px;height: 25px;}
        .main ul li{ float: left;}
        .fj p{ margin: 0 0 5px;text-decoration: underline;}
        .buts{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .fi-list{  line-height: 25px;  margin-left: 10px;  overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap;  width: 115px;  }
       .fj-but {  background: #d3edfb none repeat scroll 0 0;  border: 1px solid #eaeaea;  border-radius: 4px;  color: #898989;  float: left;  height: 25px;  line-height: 25px;  margin: 0 0 0 55px;  position: relative;  width: 40px;  }

    </style>
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
        var IMG = "/wisdom/Public/Home/Default/images";
        var STATIC = "/wisdom/Public/static";
        var UPFILE = "/wisdom/Public/upfile";
        var THEME = "/wisdom/Public/Home/Default";
        var bigMenuIndex = 0; //大类LI下标
        var smallMenuIndex = 0;//小类LI下标

    </script>
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />

</head>
<body>

<div class="main">
            <ul class="fl">
               <li>
                   <span>费用内容</span>
                   <textarea style="float:left;height: 200px; width: 600px;" ></textarea>
                   <p style="float: right;margin: 190px 0 0 10px;">不超过（500字）</p>
               </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>用款日期</span>
                    <input id="date" name="date" class="laydate-icon" value="" placeholder="请选择日期">
                </li>
                <li>
                    <span>费用类型</span>
                    <select name="" id="">
                        <option value="">办公费</option>
                        <option value="">差旅费</option>
                        <option value="">通信费</option>
                        <option value="">其他</option>
                    </select>
                </li>
                <li>
                    <span>申请金额</span>
                    <input type="text" />
                </li>
            </ul>

            <ul class="fl">
                <div class="fj-but">
                    <li  style="position: relative;float: left;top: 7px;left: 7px;" class="fa fa-paperclip fa-fw fa-lg"></li>
                </div>
                <?PHP for($i=0;$i<5;$i++){?>
                <li class="fi-list">申请金额申请金额报申请金额.jpg</li> <!--此处新增一个附件，显示一个附件名称，附件数量5个-->
                <?PHP }?>
            </ul>
            <ul class="fl">
                <li>
                    <span style="margin-top: 13px;">审批人员</span>
                    <!--此处与首页流程审批人员一样处理-->
                    <div style="width: 600px;float: left;">
                        <?PHP for($i=0;$i<18;$i++){?>
                        <div style="margin-right: 12px;float: left;  width: 50px;">
                            <img style="height: 50px;" src="/wisdom/Public/Home/Default/images/addpers.png">
                            <span style="float: left;text-align: center;width: 50px;">周双盛</span>
                        </div>
                        <?PHP }?>
                    </div>
                </li>
            </ul>

            <div style="margin: 0 34%;float: left;">
                <button class="buts">提交</button>
                <button class="buts" >保存</button>
                <button class="buts" >放弃</button>
            </div>


    </div>
</div>

<script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/jquery.bigautocomplete.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/skin/layer.css"></script>
<script type="text/javascript" src="/wisdom/Public/static/laypage/laypage.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>
<div style="display: none;"><script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script></div>

 
 
 
<script>
    $(function(){
        $(".nav li").click(function(){
            var myindex=$(this).index();
            $(this).addClass("cur").siblings().removeClass("cur");
            $(".list .content").eq(myindex).addClass("cur1").siblings().removeClass("cur1");
        })

    })

    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

</script>
</body>
</html>