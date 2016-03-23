<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>任务详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <style>
        html,body{
            background-color:#FFFFFF;
        }

        .mui-content{
            background-color:#FFFFFF;
        }
    </style>
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
        var IMG = "/wisdom/Public/Mobileweb/Default/images";
        var STATIC = "/wisdom/Public/static";
        var UPFILE = "/wisdom/Public/upfile";
        var THEME = "/wisdom/Public/Mobileweb/Default";
    </script>
    <!--标准mui.css-->
    <script type="text/javascript" src="http://wisdom.51lick.com//Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

    <!--微信相关配置-->
    <script type="text/javascript">
        wx.config({
            // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            debug:true,
            // 必填，公众号的唯一标识
            appId:"<?php echo ($appid); ?>",
            // 必填，生成签名的时间戳
            timestamp:"<?php echo ($timstamp); ?>",
            // 必填，生成签名的随机串
            nonceStr:"<?php echo ($noncestr); ?>",
            // 必填，签名，见附录1
            signature:"<?php echo ($signature); ?>",
            // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            jsApiList:["showOptionMenu","onMenuShareAppMessage","onMenuShareTimeline","onMenuShareQQ","onMenuShareQZone","onMenuShareWeibo"]
        });


        wx.ready(function(){
            //监听获取“分享给朋友”按钮点击状态及自定义分享内容接口
            wx.onMenuShareAppMessage({
                title: '<?php echo ($taskinfo["info"]["f_title"]); ?>', // 分享标题
                desc: '', // 分享描述
                link: '<?php echo ($taskinfo["taskinfoshareurl"]); ?>', // 分享链接
                imgUrl: '<?php echo ($imgpath); ?>', // 分享图标
                type: 'link', // 分享类型,music、video或link，不填默认为link
                dataUrl: '<?php echo ($taskinfo["taskinfoshareurl"]); ?>', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    $.post("<?php echo U('Api/Info/conf');?>","command=share&userid=<?php echo ($userid); ?>&taskid=<?php echo ($taskid); ?>&platform=Wechat",function(val){},"json");
                },
                cancel: function () {
                    alert("分享失败");
                }
            });

//            获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
            wx.onMenuShareTimeline({
                title: '<?php echo ($taskinfo["info"]["f_title"]); ?>', // 分享标题
                link: '<?php echo ($taskinfo["taskinfoshareurl"]); ?>', // 分享链接
                imgUrl: '<?php echo ($imgpath); ?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    $.post("<?php echo U('Api/Info/conf');?>","command=share&userid=<?php echo ($userid); ?>&taskid=<?php echo ($taskid); ?>&platform=WechatFavorite",function(val){},"json");
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

//            获取“分享到QQ”按钮点击状态及自定义分享内容接口

            wx.onMenuShareQQ({
                title: '<?php echo ($taskinfo["info"]["f_title"]); ?>', // 分享标题
                desc: '', // 分享描述
                link: '<?php echo ($taskinfo["taskinfoshareurl"]); ?>', // 分享链接
                imgUrl: '<?php echo ($imgpath); ?>', // 分享图标
                success: function () {
                    $.post("<?php echo U('Api/Info/conf');?>","command=share&userid=<?php echo ($userid); ?>&taskid=<?php echo ($taskid); ?>&platform=QQ",function(val){},"json");
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

//            获取“分享到QQ空间”按钮点击状态及自定义分享内容接口
            wx.onMenuShareQZone({
                title: '<?php echo ($taskinfo["info"]["f_title"]); ?>', // 分享标题
                desc: '', // 分享描述
                link: '<?php echo ($taskinfo["taskinfoshareurl"]); ?>', // 分享链接
                imgUrl: '<?php echo ($imgpath); ?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    $.post("<?php echo U('Api/Info/conf');?>","command=share&userid=<?php echo ($userid); ?>&taskid=<?php echo ($taskid); ?>&platform=QZone",function(val){},"json");
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

//            获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口

            wx.onMenuShareWeibo({
                title: '<?php echo ($taskinfo["info"]["f_title"]); ?>', // 分享标题
                desc: '', // 分享描述
                link: '<?php echo ($taskinfo["taskinfoshareurl"]); ?>', // 分享链接
                imgUrl: '<?php echo ($imgpath); ?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    $.post("<?php echo U('Api/Info/conf');?>","command=share&userid=<?php echo ($userid); ?>&taskid=<?php echo ($taskid); ?>&platform=TencentWeibo",function(val){},"json");
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.showOptionMenu();
        });




        wx.error(function (res) {
            //打印错误消息。及把 debug:false,设置为debug:ture就可以直接在网页上看到弹出的错误提示
            alert(res.errMsg);
        });

    </script>




    <link rel="stylesheet" href="/wisdom/Public/Mobileweb/Default/css/mui.min.css">
    <!--App自定义的css-->
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/app.css"/>
    <link href="/wisdom/Public/Mobileweb/Default/css/css.css" rel="stylesheet" type="text/css">
</head>
<body>
<input  type="hidden"  id="tasktypeid" value="<?php echo ($tasktypeid); ?>"/>
<input  type="hidden"  id="taskid" value="<?php echo ($taskid); ?>"/>
<!--<?php  echo $userid."gh"?>-->
<div class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" style="color:#FFFFFF"></a>
    <h1 class="mui-title"  id="title" style="color:#FFFFFF">
        <?php if($taskinfo["type_label"] == 'business'): ?>招商赚详情
            <?php elseif($taskinfo["type_label"] == 'widely'): ?>
            随手赚详情
            <?php elseif($taskinfo["type_label"] == 'push'): ?>
            推广赚详情<?php endif; ?>
    </h1>
    <?php if($taskinfo["type_label"] == 'widely'): ?><a class="mui-pull-right mui-icon mui-icon-redo" style="color:#FFFFFF;padding-top:10px;padding-right:20px;font-weight:bold"  id="wideshare"></a><?php endif; ?>

</div>
<div class="mui-content" style="padding-bottom:450px;padding-top:45px;">
    <?php if($taskinfo["type_label"] == 'widely'): ?><div style="padding-top:10px">
            <button  style="display:inline-block;color:#FFFFFF;background-color:#fe6700;margin-bottom:10px;float:right;margin-right:20px;border:none"  id="taskpreview">任务预览</button>
        </div><?php endif; ?>
    <div id="segmentedControl" class="mui-segmented-control" style="border-bottom:1px solid #C7C7CC;border-top:none;border-left:none;border-right:none;border-radius:0px;">
        <a class="mui-control-item  mui-active" href="#item2mobile" style="border-left:1px solid #C7C7CC">图文详情</a>
        <?php if($taskinfo["type_label"] == 'business'): ?><a class="mui-control-item" href="#item1mobile" style="border-left:1px solid #C7C7CC;">产品参数</a><?php endif; ?>
    </div>

    <div class="mui-content-padded" style="padding-top:10px;">
        <div id="item1mobile" class="mui-control-content" >
            <?php if($taskinfo["type_label"] == 'business'): ?><div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_product"]); ?></div><?php endif; ?>
        </div>
        <div id="item2mobile" class="mui-control-content mui-active">
            <?php if($taskinfo["type_label"] == 'business'): ?><div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_note"]); ?></div>
                <?php elseif($taskinfo["type_label"] == 'widely'): ?>
                <div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_taskrequirements"]); ?></div>
                <?php elseif($taskinfo["type_label"] == 'push'): ?>
                <div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_taskrequirements"]); ?></div><?php endif; ?>
        </div>
    </div>
</div>

<!--href="/index.php/Mobileweb/Events/erweima"-->
<nav class="mui-bar mui-bar-tab">
    <a id="defaultTab" class="mui-tab-item"  href="/index.php/Mobileweb/Events/erweima">
        <?php if($taskinfo["type_label"] == 'business'): ?><span class="mui-tab-label" id="bus">立即参与</span>
            <?php elseif($taskinfo["type_label"] == 'widely'): ?>
            <span class="mui-tab-label" id="wid">立即参与</span>
            <?php elseif($taskinfo["type_label"] == 'push'): ?>
            <span class="mui-tab-label"  id="push">我要分享</span><?php endif; ?>
    </a>
</nav>


<script src="/wisdom/Public/Mobileweb/Default/js/mui.min.js">
    mui.back();
</script>
<!--<script src="/wisdom/Public/Mobileweb/Default/js/mui.zoom.js"></script>-->
<!--<script src="/wisdom/Public/Mobileweb/Default/js/mui.previewimage.js"></script>-->
<script type="text/javascript">
    document.getElementById('defaultTab').addEventListener('tap', function() {
        alert($(this).children("span").attr("id"));
        var textid=$(this).children("span").attr("id");
        if(textid=="bus"){
            //招商赚
            location.href=APP+"/Mobileweb/Events/erweima";
        }else if(textid=="wid"){
            //随手赚
            var tasktypeid=$("#tasktypeid").val();
            var taskid=$("#taskid").val();
            if(tasktypeid==4){
                //调研类
                location.href=APP+"/Mobileweb/Events/surveyClass_wei?userid=<?php echo ($userid); ?>&taskid="+taskid;
            }else  if(tasktypeid==5){
                //推荐类
                location.href=APP+"/Mobileweb/Events/spreadClass_wei?userid=<?php echo ($userid); ?>&taskid="+taskid;
            }else  if(tasktypeid==6){
                //答题类
                location.href=APP+"/Mobileweb/Events/answerClass_wei?userid=<?php echo ($userid); ?>&taskid="+taskid;
            }
        }else if(textid=="push"){
            //推广赚
            alert("点击右上方,进行分享");
        }

    });

    document.getElementById("wideshare").addEventListener("tap",function(){
           alert("点击右上方菜单,进行分享");
    });

    //任务预览
    document.getElementById("taskpreview").addEventListener("tap",function(){
        var tasktypeid=$("#tasktypeid").val();
        var taskid=$("#taskid").val();
        if(tasktypeid==4){
            //调研类
            location.href=APP+"/Mobileweb/Events/problemPreview_wei?userid=<?php echo ($userid); ?>&taskid="+taskid;
        }else  if(tasktypeid==5){
            //推荐类
            location.href=APP+"/Mobileweb/Events/spreadPreview_wei?userid=<?php echo ($userid); ?>&taskid="+taskid;
        }else  if(tasktypeid==6){
            //答题类
            location.href=APP+"/Mobileweb/Events/problemPreview_wei?userid=<?php echo ($userid); ?>&taskid="+taskid;
        }
    });

</script>
</body>

</html>