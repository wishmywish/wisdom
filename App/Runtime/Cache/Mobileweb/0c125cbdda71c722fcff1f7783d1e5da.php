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
            background-image:url(/wisdom/Public/Mobileweb/Default/images/app_game.png);
            background-repeat:no-repeat;
            background-size: 100% 100%;
        }

        .click_btn{
            padding: 0;
            position: absolute;
            width: 100%;
            top: 85.2%;
        }
        .click_btn span{
            position: absolute;
            width: 70%;
            height: 35px;
            margin: 0 15%;
        }
    </style>

</head>

<body>
<div data-role="page">
    <div role="main" class="ui-content" style="padding: 0">
        <div class="click_btn">
            <span  id="click" onclick="test()"></span>
        </div>
    </div><!-- /content -->
</div>

</body>
<script>
    function load(){
        document.getElementById("click").click();
    }

    function test(){
        alert("test");
    }
</script>
</html>