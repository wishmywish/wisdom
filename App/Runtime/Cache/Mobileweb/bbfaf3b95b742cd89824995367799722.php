<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <head>
        <title><?php echo ($webtitle); ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/Mobileweb/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Mobileweb/Default";
        </script>

        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="/wisdom/Public/Mobileweb/Default/js/jquery.mobile-1.4.5.min.js"></script>
    </head>

<body style="height: 100%;background-color:#e8504a;">
<div data-role="page" style="background-color:#e8504a;">
    <div role="main" class="ui-content" style="padding: 0;background-color:#e8504a;">
        <div class="bg_eve" style="background:#e8504a; margin: 0px; width: 100%;height: 100%;">
            <div id="img" class="even_icon"><img src="/wisdom/Public/Mobileweb/Default/images/1.png"></div>
            <div id="txt" style="text-align: center;width: 80%;margin-left: 10%;">注册即送50金币（5元人民币）</div>
            <div id="forminput" style="width: 60%;text-align: center;margin: 0 auto;height: 120px;display: block;">
                <input type="text" id="newmobile" value="" placeholder="请输入手机号">
                <input type="hidden" id="userid" value="<?php echo ($userid); ?>">
                <input type="text" id="smscode" placeholder="活动验证码" style="width:50%;">
                <button id="getcode" style="width: 45%;float: left;">验证码</button>
                <button id="upmobile" style="width: 45%;float: left;margin-left: 10%;">认领</button>
            </div>
            <div id="down" style="display: none;width: 45%;text-align: center;margin: 0 auto;height: 120px;">
                <!--<div style="width: 40%;float: left;"><img src="/wisdom/Public/upfile/logo/ios.png" /></div>-->
                <div style="width: 100%;"><img src="/wisdom/Public/upfile/logo/app.png" /></div>
            </div>
            <div style="height: 50px;"></div>
            <div style="text-align: center;clear: both;">小宝招商--营销人赚钱神器</div>
            <div style="text-align: center;">用邀请码注册：<span style='color:#fff;'><?php echo ($invitationCode); ?></span></div>
            <div style="text-align: center;clear: both;">会有更多惊喜哦</div>
            <div style="height: 90px;"></div>
        </div>
    </div><!-- /content -->
</div>
</body>
<script>
    window.onload = function() {
        // 任何需要执行的js特效
        $("div").css('text-shadow','0px 0px 0px #333');
    };
    $('#upmobile').click(function(){
        var newmobile = $('#newmobile').val();
        var userid = $('#userid').val();
        var smscode = $('#smscode').val();

        if(!checkTel(newmobile)){
            alert("手机号格式不正确");
            $('#newmobile').focus();
            return false;
        }

        if(smscode===""){
            alert("验证码不能为空");
            $('#smscode').focus();
            return false;
        }

        $.post("<?php echo U('Api/Info/conf');?>","command=codeauth&code="+smscode+"&voicephone="+newmobile,function(v){
            console.log(v);
            if(v.error_code=="success"){
                $.post("<?php echo U('Events/addinfo');?>","newmobile="+newmobile+"&userid="+userid,function(v){
                    if(v==='-1'){
                        //$('img').attr('src','/wisdom/Public/Mobileweb/Default/images/1-07.png');
                        $('#txt').html("您已申领，登录小宝招商邀请每位好友再得20金币");
                        $('#forminput').css('display','none');
                        $('#down').css('display','block');
                    }else if(v==='-2'){
                        //$('img').attr('src','/wisdom/Public/Mobileweb/Default/images/1-07.png');
                        $('#txt').html("您已是注册用户，登录小宝招商邀请每位好友再得20金币");
                        $('#forminput').css('display','none');
                        $('#down').css('display','block');
                    }else{
                        //$('img').attr('src','/wisdom/Public/Mobileweb/Default/images/1-06.png');
                        $('#txt').html("50金币已存入您小宝账户，赶快下载小宝招商领取，邀请每位好友再得20金币");
                        $('#forminput').css('display','none');
                        $('#down').css('display','block');
                    }
                });
            }else{
                alert(v.error_text);
                $('#smscode').focus();
                return false;
            }
        },'json');


    });

    $('#getcode').click(function(){
        var newmobile = $('#newmobile').val();

        if(!checkTel(newmobile)){
            alert("手机号格式不正确");
            $('#newmobile').focus();
            return false;
        }

        $.post("<?php echo U('Api/Info/conf');?>","command=voicecode&voicephone="+newmobile,function(v){
            alert("验证码发送成功");
            //$('#newmobile').focus();
        },'json');
    });

    function checkTel(newmobile){
        //var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;||isPhone.test(value)
        var isMob=/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/;
        //var value=newmobile;
        if(isMob.test(newmobile)){
            return true;
        }
        else{
            return false;
        }
    }
</script>
</html>