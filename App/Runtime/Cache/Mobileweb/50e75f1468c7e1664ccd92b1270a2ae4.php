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
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
    </head>

<style>
    .bg{
        background: #FF6767;
        float: left;
    }
    .pic{
        position: relative;
        width: 100%;
        float: left;
    }
    .pic span{
        text-align: center;
        position: absolute;
        top: 86%;
        display: block;
        width: 70%;
        margin:0% 14%;

    }
    .form{
        width: 100%;

    }
    .form li:first-child{
        border-top: 1px solid rgba(255,255,255,.5);
    }
    .form li{
        width: 80%;
        margin: 0 10%;
        height: 40px;
        float: left;
        line-height: 40px;
        border-bottom: 1px solid rgba(255,255,255,.5);
    }
    .form img{
        width:7% ;
        float: left;
        margin: 3% 0 0% 0%;
        border-right: 1px solid rgba(255,255,255,.5);
        padding-right: 5%;
    }
    ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
        color:    #fff;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        color:    #fff;
        opacity:  1;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
        color:    #fff;
        opacity:  1;
    }
    :-ms-input-placeholder { /* Internet Explorer 10-11 */
        color:    #fff;
    }
    .form input{
        font-size: 12px;
        background: none;
        color: #fff;
        width:50%;
        height: 34px;
        float: left;
        line-height: 34px;
        padding-left: 5%;
    }

    .btn1{
        background-color:#FFE567;
        color:#59301C;
        border:none;
        border-radius:2px;
        width:30%;
        height:34px;
        line-height:10%;
        margin-left: 2%;
    }

    .btn2{
        font-size:15px;
        background-color:#FFE567;
        color:#59301C;
        border:none;
        border-radius:2px;
        width:80%;
        height:30px;
        line-height:10%;
        margin:10%;
        text-align:center;
        font-weight:bold;
    }

    .title{
        font-weight:bold;
        height:40px;
        width:100%;
        background-color:#FFE567;
        font-size:15px;
        color:#59301C;
        line-height:40px;
        text-align:center;
        text-shadow:none;

    }

</style>
</head>
<body>
<div class="mains">
    <div  class="heads_hb bg">
        <img style="  padding-top: 3%;padding-left: 3%;width: 45%;" src="/wisdom/Public/Mobileweb/Default/images/tdh_logo.png">
        <div class="pic">
            <img style="text-align: center;margin-top: -50px;" src="/wisdom/Public/Mobileweb/Default/images/header_bg.png">
        </div>
        <form id="favorable-form" class="wy-form" action="<?php echo U('Index/invite');?>" method="post" >
            <ul class="form">
                <li><img class="img" src="/wisdom/Public/Mobileweb/Default/images/phone.png"><input data-role="none" type="text" placeholder="请输入手机号码" id="mobile" name="mobile" value="" ><!-- <button  data-role="none" class="btn1" id="getCode1">获取验证码</button> --></li>
                <!-- <li><img class="img" src="/wisdom/Public/Mobileweb/Default/images/verify.png"><input data-role="none" type="text" placeholder="请输入验证码" id="code"></li> -->
                <!-- <li><img class="img" src="/wisdom/Public/Mobileweb/Default/images/psw.png"><input data-role="none" type="text" placeholder="设置密码"></li> -->
            </ul>

            <input type="hidden" id="userid" name="userid" value="<?php echo ($userid); ?>">
            <!-- <input type="hidden" id="userid" name="userid" value="520"> -->
        </form>

        <button data-role="none" class="btn2" id="getMoney">点击开始赚钱</button>
    </div>
</div>
<div class="title">
    加入创客工作室超越5大收益
</div>
<img src="/wisdom/Public/Mobileweb/Default/images/di3.jpg"width="100%">
</body>
<script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/Mobileweb/Default/js/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/base64.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/md5.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/sha1.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/config.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/Mobileweb/Default/js/fun.js"></script>


<!--ueditor编译器源码文件-->
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>

<script>

$("#getMoney").click(function(){
    var phone = $("#mobile").val();
    if(phone===""){
        layer.msg("手机号不能为空",{icon:8});
        return false;
    }else if(!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test(phone)){
        layer.msg("手机格式不正确",{icon:8});
        return false;
    }else {
        
        $.post(APP+"/Api/Web/getUserinfo","mobile="+phone,function(data){
            if ("" ==data.list) {
                $("#favorable-form").submit();
                layer.msg("成功加入创客工作室，并领取5元红包，下载APP开始赚钱。");
            }else{
                layer.msg("领取失败，您已是小宝注册用户，邀请好友组建创客工作室，坐享其成。",{icon:8});
                return false;
            };
        },'json');
    }
});

</script>
</html>