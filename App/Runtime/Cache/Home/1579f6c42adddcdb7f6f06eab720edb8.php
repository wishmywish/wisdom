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
        .main table{float: left;width: 610px;border: 1px solid #e2e0e0;border-collapse: collapse;text-align: center;}
        .main table tr td{border: 1px solid #a9a9a9;line-height: 20px;}
        .main table tr th{border: 1px solid #a9a9a9;font-weight: normal;}
        .main ul{margin: 20px 0 0 33px;width: 100%;}
        .main span{width: 100px;text-align: right;display: inline-block;margin-right: 7px;float: left;line-height: 25px;}
        .main select{width: 100px;height: 29px;}
        .main ul input{width: 80px;height: 25px;}
        .main ul li{ float: left;}
        .fj p{ margin: 0 0 5px;text-decoration: underline;}
        .buts{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .fi-list{  line-height: 25px; overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap;  width: 115px; padding-right: 5px; }
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
                    <span>任务编号</span>
                    <input type="text" style="width: 200px;border: none;" value="Task2015020202020">
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>任务主题</span>
                    <input type="text" style="width: 200px;  background: #eeeeee;">
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>关联客户</span>
                    <input style="width: 204px;height:30px;float: left;  background: #eeeeee;" type="search"  class="link">
                    <!--<span class="fa fa-search fa-lg" style="position: absolute;left: 234px;top: 118px;color: #898989;"></span>-->
                    <span>关联商机</span>
                    <input style="width: 204px;height:30px;float: left;  background: #eeeeee;"  type="search"  class="link">
                    <!--<span class="fa fa-search fa-lg" style="position: absolute;left: 541px;top: 118px;color: #898989;"></span>-->
                </li>

            </ul>
            <ul class="fl">
               <li>
                   <span>任务描述</span>
                   <textarea style="float:left;height: 130px; width: 606px;  background: #eeeeee;" ></textarea>
                   <!--<p style="float: right;margin: 120px 0 0 5px;color: red;">不超过（500字）</p>-->
               </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>参与人员</span>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr style="height: 25px;">
                            <th width="197" height="25">参与人员</th>
                            <th width="150">开始时间</th>
                            <th width="150">结束时间</th>
                            <th width="550">主要工作内容</th>
                        </tr>
                        <?PHP for($i=0;$i<6;$i++){?>
                        <tr style="height: 50px;  background: #eeeeee;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?PHP }?>
                    </table>
                </li>
            </ul>
            <ul class="fl">
                <li>
                   <span style="margin-left: 105px;">任务开始时间：</span>
                    <input style="width: 100px;border: none;" type="text" value="2015-09-04">
                    </li>
                <li>
                    <span>任务结束时间：</span>
                    <input style="width: 100px;border: none;" type="text" value="2015-09-04">
                    </li>
                <li>
                    <span>任务总计天数：</span>
                    <input style="width: 100px;border: none;" type="text" value="2015-09-04">
                </li>
            </ul>

            <ul class="fl" style="margin-bottom: 30px;">
                <!--<div class="fj-but">-->
                    <!--<li  style="position: relative;float: left;top: 7px;left: 7px;" class="fa fa-paperclip fa-fw fa-lg"></li>-->
                <!--</div>-->
                <span>附件</span>
                <?PHP for($i=0;$i<5;$i++){?>
                <li class="fi-list">报销金额报销金额报销金额.jpg</li> <!--此处新增一个附件，显示一个附件名称，附件数量5个-->
                <?PHP }?>
            </ul>
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