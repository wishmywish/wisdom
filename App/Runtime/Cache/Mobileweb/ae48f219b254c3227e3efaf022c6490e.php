<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/iconfont.css" />
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, STHeiTi, Arial, sans-serif;

        }
        ul,li{list-style: none;margin:0;padding:0;}
        body {
            background-image:url(/wisdom/Public/Mobileweb/Default/images/bg.jpg);
            background-repeat:no-repeat;
            background-size: 100% 100%;
        }
        .g_head{
            width: 100%;
        }
        .g_head img{
            width: 100%;
        }
        .content{
            width: 85%;
            border: 2px solid #000;
            margin: 1% 5% 8%;
            min-height: 200px;
            background: #fde7c0;
            padding: 2%;
        }
        .content .box{
            /*background-image:url(/wisdom/Public/Mobileweb/Default/images/bb.jpg);*/
            /*!*padding: 20px;*!*/
            /*background-repeat: no-repeat;*/
            width: 99%;
            border: 2px dotted #000;
            min-height: 200px;

        }
        .box .title{
            text-align: center;
            width: 100%;
            height: 5%;
            position: relative;
        }
        .title span{
            display: block;
            /* margin-top: -23px; */
            width: 100%;
            position: absolute;
            top: 60%;
            color: #fff;
        }
        .box .djs{
            text-align: center;
            margin: 8% 0 3% 0;
            width: 100%;
            height: 5%;
            position: relative;
        }
        .box .sort{
            text-align: center;
            margin: 8% 5% 5%;
            width: 90%;
            height: 5%;
            position: relative;
            font-weight: bold;
            border-bottom: 2px solid #000;
        }
        .box .sortList{
            width: 100%;
            font-size: 14px;
            margin: 10% 0;
        }
        .box .sortList li{
            width: 90%;
            margin: 2% 5% 4%;
            border-bottom: 1px solid #000;
        }

        .sort span{
            color: red;
        }
        .box .kl{
            text-align: center;
            margin: 8% 0 3% 0;
            width: 100%;
            height: 5%;
            position: relative;
        }
        .djs span{
            display: block;
            /* margin-top: -23px; */
            width: 100%;
            position: absolute;
            top: 22%;
        }
        .content .box .hb{
            width: 96%;
            margin: 5% 2% 15%;
            height: 25%;
        }
        .content .box .hb li{
            width: 21%;
            background: #C30D23;
            float: left;
            margin: 0 2% 5%;
            text-align: center;
        }
        .box .btn{
            width: 100%;
            position: relative;
            margin-bottom: 5%;
        }
        .btn span{
            display: block;
            width: 100%;
            position: absolute;
        }
        .kl span{
            display: inline-block;
            font-size: 24px;
            font-weight: bold;
            color: #f49c00;
            float: left;
            margin-left: 8%;
        }
        .btn0{
            font-size: 20px;
            margin-left: 43%;
            bottom: 26%;
        }
        .btn1 {
            margin-left: 60%;
            /* float: right; */
            font-size: 12px;
            bottom: 32%;
        }
        .btn2{
            font-size: 16px;
            margin-left: 15%;
            bottom: 10%;
            color: #fff;
        }
        .btn3{
            font-size: 16px;
            margin-left: 75%;
            bottom: 10%;
            color: #fff;
        }
        .yq{
            margin-left: 35%;
            bottom: 28%;
        }
        .yq1{
            font-size: 12px;
            color: #fff;

        }
        .rules{
            width: 100%;
            height: 6%;
            line-height: 35px;
            font-size: 14px;
        }
        .rules a{
            float: right;
            /* padding: 10px 0; */
            text-decoration: underline;
        }
        .br_line{
            width: 106%;
            height: 2%;
            background: #3B7463;
            margin: 2% -3%;
            border: 2px solid;
            border-left:none;
            border-right: none;
        }
        .kl  .hb_kl{
            right: 5%;
            /* float: right; */
            position: absolute;
            font-size: 16px;
            font-weight: normal;
            color: #000;
            top: 23%;
            width: 50%;
            text-align: center;
        }
        .iconfont{
            color: #6C0505;
            font-size: 54px;
        }
        .active{
            font-size: 54px;
            color: yellow;
            width: 100%;
            display: inline-block;
        }

        * {
            -webkit-touch-callout:none;
            -webkit-user-select:none;
            -khtml-user-select:none;
            -moz-user-select:none;
            -ms-user-select:none;
            user-select:none;
        }
    </style>
    <script>
        var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var cc = "<?php echo ($cc); ?>";
        var times=parseInt("<?php echo ($result["times"]); ?>");
    </script>
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/layer/skin/layer.css" />
    <script type="text/javascript" src="/wisdom/Public/Mobileweb/Default/js/wechat_game.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Mobileweb/Default/js/weixinshare.js"></script>
    <script>
        wx.ready(function() {
            wx.hideOptionMenu();
        });
    </script>

</head>

<body>
<div data-role="page">
    <div role="main" class="ui-content" style="padding: 0">
        <div class="g_head"  style="display: none;"><img src="/wisdom/Public/Mobileweb/Default/images/g_head.jpg"></div>
        <div class="content">
            <div class="box">
                <p class="title">
                    <img src="/wisdom/Public/Mobileweb/Default/images/g_01.png" style=" width: 106%;  margin: 0 -3%;">
                    <span><?php echo ($result["f_mynick"]); ?>叫你帮他抢红包</span>
                </p>
                <p class="djs">
                    <img src="/wisdom/Public/Mobileweb/Default/images/g_02.png" style=" width: 30%;">
                    <span id="bb_time">30秒</span>
                </p>
                <ul class="hb"  id="hongbao">
                    <li  class="iconfont  icon-hongbao"></li>
                    <li  class="iconfont  icon-hongbao"></li>
                    <li  class="iconfont  icon-hongbao"></li>
                    <li  class="iconfont  icon-hongbao"></li>
                    <li  class="iconfont  icon-hongbao"></li>
                    <li  class="iconfont  icon-hongbao"></li>
                    <li  class="iconfont  icon-hongbao"></li>
                    <li  class="iconfont  icon-hongbao"></li>
                </ul>
                <p class="btn"  id="start" onclick="start()">
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn.png" style="width: 90%;margin: 0 5%">
                    <span class="btn0">开始</span><span class="btn1"  id="times"></span>

                </p>
                <p class="btn" onclick="my_get();">
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn1.png" style="width: 90%;margin: 0 5%">
                    <span class="btn0 yq">我也要抢</span>
                    <input type="hidden"  id="b_fmypcid"  value="<?php  echo $b_fmypcid;?>">
                    <input type="hidden"  id="b_fhelpid"  value="<?php  echo $b_fhelpid;?>">
                </p>

                <p class="btn">
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn2.png" style="width: 90%;margin: 0 5%">
                    <span class="btn2">我帮他抢的红包</span><span class="btn3" id="money"><?php echo ($result["hongnum"]); ?>元</span>
                </p>
                <p class="rules"><a  href="javascript:void(0)"   onclick="showrule()">？游戏规则</a></p>
            </div>
            <div class="br_line" ></div>
            <div class="box" >
                <p class="title">
                    <img src="/wisdom/Public/Mobileweb/Default/images/g_sort.png" style=" width: 106%;  margin: 0 -3%;">
                    <span>好友助福榜</span>
                </p>
                <ul class="sortList">
                    <?php if(is_array($result["list"])): $i = 0; $__LIST__ = $result["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo["he_nice"]); ?>帮他抢了<span style="float: right;"><?php echo ($vo["f_goldcoin"]); ?>元</span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <p style=" width: 100%;text-align: center;color: #F49C3C;margin-bottom: 4%;">小宝招商 新春送福</p>
    </div><!-- /content -->
</div>


<script>
    function showrule(){
        setTimeout(function(){
            location.href=APP+"/Mobileweb/Hbgame/app_grules";
        },2000);
    }

</script>
</body>

</html>