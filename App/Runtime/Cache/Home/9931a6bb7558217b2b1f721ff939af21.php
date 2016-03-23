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
        .main ul{margin-top: 20px;width: 100%;margin-left: 30px;}
        .main span{text-align: right;display: inline-block;margin-right: 7px;float: left;line-height: 25px;width: 60px;}
        .main select{width: 100px;height: 29px;}
        .main ul input{height: 20px;}
        .main ul li{ float: left;}
        .fj p{ margin: 0 0 5px;text-decoration: underline;}
        .buts{margin: 25px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .fi-list{  line-height: 25px;  margin-left: 10px;  overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap;  width: 115px;  }
        .fj-but {  background: #d3edfb none repeat scroll 0 0;  border: 1px solid #eaeaea;  border-radius: 4px;  color: #898989;  float: left; margin-left: 15px; height: 25px;  line-height: 25px; position: relative;  width: 40px;  }
    </style>
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
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
           <span>回复内容</span>
           <textarea style="float:left;height: 134px; width: 410px;" id="content"></textarea>
           <p style="float: right;margin: 123px 0 0 10px;color: red;">不超过（500字）</p>
       </li>
    </ul>
    <div style="margin: 0 34%;float: left;">
        <button class="buts" onclick="doSave();">提交</button>
        <button class="buts" style="background: #eaeaea; color: #595857;" onclick="reset();">取消</button>
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

    function doSave() {
        // 消息内容check
        var contentObj = $("#content");
        if (getValLen(contentObj) == 0) {
            layer.msg("回复内容不能为空",{icon: 8});
            contentObj.focus();
            return false;
        } else if (getValLen(contentObj) > 500) {
            layer.msg("回复内容最多为500字",{icon: 8});
            contentObj.focus();
            return false;
        }

        var mesId = '<?php echo ($mesId); ?>';
        var commentId = '<?php echo ($commentId); ?>';
        var replyToUserId = '<?php echo ($replyToUserId); ?>';
        var content = $("#content").val();

        // 添加回复
        $.post("<?php echo U('Office/addReply');?>", {"replyToUserId":replyToUserId, "replyContent":content, "commentId":commentId, "mesId":mesId}, function(data) {
            if(data.error_code == "success") {
                layer.msg("添加成功",{icon: 8});
                parent.getMessageList();
                var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                parent.layer.close(index);
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
        }, 'json');
    }

    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }
</script>
</body>
</html>