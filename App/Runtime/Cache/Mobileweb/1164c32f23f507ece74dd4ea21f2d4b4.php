<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, STHeiTi, Arial, sans-serif;

        }
        body {
            background-image:url(/wisdom/Public/Mobileweb/Default/images/wechat_gguide.png);
            background-repeat:no-repeat;
            background-size: 100% 100%;
        }

        .click_btn{
            padding: 0;
            position: absolute;
            width: 100%;
            top: 79.2%;
            background: #3B7462;
        }
        .click_btn span{
            position: absolute;
            width: 70%;
            height: 35px;
            margin: 0 15%;
        }

        .click_btn .phoneNum{
            width: 70%;
            margin: 0 15% 3%;
            position: relative;
        }
        .phoneNum input{
            position: absolute;
            top: 10%;
            height: 60%;
            width: 85%;
            text-align: center;
            font-size: 22px;
            background: #FDE7C1;
            border: none;
            /*margin: 0 15%;*/
            outline: none;
            left: 8%;
            display: inline-block;
            /* border: 1px solid; */
        }

        ::-webkit-input-placeholder { /* WebKit browsers */
            color: #000;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color: #000;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
            color: #000;
        }
        :-ms-input-placeholder { /* Internet Explorer 10+ */
            color: #000;
        }

    </style>
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/layer/skin/layer.css" />
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
    </script>
</head>

<body>
<div data-role="page">
    <div role="main" class="ui-content" style="padding: 0">
        <div class="click_btn">
            <div class="phoneNum" >
                <img src="/wisdom/Public/Mobileweb/Default/images/game_btn.png" style="width: 100%">
                <input type="text" placeholder="输入手机号码"  id="phone">
            </div>
            <div class="phoneNum" >
                <img src="/wisdom/Public/Mobileweb/Default/images/g_03.png" style="width: 100%"  onclick="impartice()">
            </div>
        </div>
        <!--<input  type="hidden" id="info" value="<?php echo $info;?>"/>-->
    </div><!-- /content -->
</div>

<script>
    var restr=$("#info").val();
    function impartice(){
        var phone=$("#phone").val();
        if(phone==""){
            layer.msg("请填写你的手机号码");
            return false;
        }

        if(!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test(phone)){
            layer.msg("请检查你输入的手机号码");
            return false;
        }
        setTimeout(function(){
            location.href=APP+"/Mobileweb/Hbgame/app_game?phone="+phone+"&info="+restr;
        },2000);

    }

</script>
</body>

</html>