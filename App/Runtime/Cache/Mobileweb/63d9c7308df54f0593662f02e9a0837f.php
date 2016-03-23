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
    .heads span{
        float: left;
        line-height: 70px;
        color: #fff;
        text-shadow: none;
        /* padding-left: 15px; */
        width: 15%;
    }

    .heads h1{
        line-height: 70px;
        display: inline-block;
        font-size: 20px;
    }
    .heads a{
        float: right;
        /* display: inline-block; */
        line-height: 69px;
        font-size: 20px;
        margin-right: 15px;
        color: #fff;
        }

    .list{
        padding: 10px;
        line-height: 22px;
        min-width: 87%;
        height: 125px;
        margin: 0 10px;
    }
    .btn{
        border-radius: 5px;
        border: 1px solid #ff6600;
         /*padding: 4px 20px; */
        color: #ff6600;
        margin-right: 2px;
        margin-top: 5px;
        float: right;
        width: 100px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        cursor:pointer;
        display: block;
    }
    *{padding: 0; margin: 0}

    .show_tips1{
        position: absolute;
        display: none;
        z-index: 3000;
        background-color: #FFF;
        top: 25%;
        left: 7%;
        width: 85%;
        height: 10%;
        line-height: 25px;
        text-align: center;
        border: 1px solid #ccc;
        padding-top: 10px;
        text-shadow: none;
        border-radius: 10px;
    }
    .btns{
        position: absolute;
        background-color: #fff;
        top: 85px;
        height:30px;
        width:100%;
        line-height:40px;
        text-align:center;
        color: #36F;
        border-top: 1px solid #ccc;
        font-size: 14px;
    }
    .btns span:first-child{
        width: 48%;
        border-right: 1px solid #ccc;
        height: 40px;
        display: block;
        float: left;
    }

</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=sG5q8YDA4daHjAwdrmK6tSDB"></script>
</head>
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

<body>
<div data-role="page">
    <div  class="heads" style="height: 64px;line-height: 64px;padding-top:0;text-align: center;">
        <span  class="fa fa-angle-left fa-2x" onclick="goBack()"></span>
        <h1>网店列表</h1>
        <span href="" class="fa fa-filter fa-2x" data-role="none" style="float:right;" onclick="oneKeySort()"></span>
    </div>
    <div class="page" style="width: 100%;" data-role="content">
        <?php if(is_array($re)): $k = 0; $__LIST__ = $re;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><ul class="list" style="border-bottom: 1px solid #ccc;">
              <li><span>网点：<?php echo ($vo["f_network_name"]); ?></span></li>
              <li><span>地址：<?php echo ($vo["f_network_address"]); ?></span></li>
              <li><span style="color: #ff6600;margin-right: 20px;">金币:<?php echo ($vo["f_eachcoin"]); ?></span><span>距离：<span id="distance<?php echo ($k); ?>"></span>米</span></li>
              <li style="width: 100%;"><span style="margin-right: 20px;">余量：<?php echo ($vo["f_claim_num"]); ?></span><span>在距离<span><?php echo ($vo["f_range"]); ?></span>米范围内有效</span></li>
              <?php if($vo["f_claim_num"] != 0): if($vo["f_utask_status"] == 2): ?><span class="btn" id="btn<?php echo ($k); ?>" onclick="do_task(this,<?php echo ($k); ?>)">继续参与</span>
                      <?php elseif($vo["f_utask_status"] == 1): ?><span class="btn" id="btn<?php echo ($k); ?>" style="color:gray">等待审核</span>
                      <?php elseif($vo["f_utask_status"] == 3): ?><span class="btn" id="btn<?php echo ($k); ?>">已结束</span>
                      <?php else: ?><span class="btn" id="btn<?php echo ($k); ?>" onclick="do_task(this,<?php echo ($k); ?>)">立即参与</span><?php endif; ?>
                  <?php else: ?>
                  <?php if($vo["f_utask_status"] == 1): ?><span class="btn" id="btn<?php echo ($k); ?>" style="color:gray">等待审核</span>
                      <?php else: ?><span class="btn" id="btn<?php echo ($k); ?>">已结束</span><?php endif; endif; ?>
          </ul>
          <input type="hidden" id="state<?php echo ($k); ?>" value="<?php echo ($vo["f_utask_status"]); ?>">
          <input type="hidden" id="superid<?php echo ($k); ?>" value="<?php echo ($vo["f_super_id"]); ?>">
          <input type="hidden" id="longitude<?php echo ($k); ?>" value="<?php echo ($vo["f_longitude"]); ?>">
          <input type="hidden" id="latitude<?php echo ($k); ?>" value="<?php echo ($vo["f_latitude"]); ?>">
          <input type="hidden" id="range<?php echo ($k); ?>" value="<?php echo ($vo["f_range"]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="l-map" style="display:none;"></div>
        <!-- <div  class="show_tips1">
            <ul>
                <li><b>申请成功</b></li>
                <li>请在2小时内完成此任务。</li>
                <li>是否立即开始工作？</li>
            </ul>
            <div id="embedding" class="btns">
                <span>稍后</span>
                <span>立即开始</span>
            </div>
        </div> -->


</div>
<input type="hidden" id="userid" value="<?php echo ($userid); ?>">
<input type="hidden" id="taskid" value="<?php echo ($taskid); ?>">
<input type="hidden" id="longitude" value="<?php echo ($longitude); ?>">
<input type="hidden" id="latitude" value="<?php echo ($latitude); ?>">
<input type="hidden" id="countre" value="<?php echo ($countre); ?>">
<input type="hidden" id="supervise" onclick="window.demo.done()">
<input type="hidden" id="superviseIphone" onclick="clickLink()">


</body>
<script type="text/javascript">
        var map = new BMap.Map("l-map");
        // var point = new BMap.Point(120.112793,30.337803);
        var longitude=$("#longitude").val();
        var latitude=$("#latitude").val();
        var point = new BMap.Point(longitude,latitude);
        $("ul").each(function(i){
            i+=1;
            var pointB=new BMap.Point($("#longitude"+i).val(),$("#latitude"+i).val());
            distance = parseInt(map.getDistance(point,pointB));
            $("#distance"+i).text(distance);
            range = $("#range"+i).val();
           
            // if(distance<=range){
            //     $("#btn"+i).css("display","");
            // }else{
            //     $("#btn"+i).css("display","none");
            // }
        });
        function oneKeySort(){
            var map = new BMap.Map("l-map");
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            // var point = new BMap.Point(120.112793,30.337803);
            var longitude=$("#longitude").val();
            var latitude=$("#latitude").val();
            var point = new BMap.Point(longitude,latitude);
            $("ul").each(function(i){
                i+=1;
                var superid=$("#superid"+i).val();
                var pointB=new BMap.Point($("#longitude"+i).val(),$("#latitude"+i).val());
                distance = parseInt(map.getDistance(point,pointB));
                $.post(APP+"/Mobileweb/Events/superviseDistance","taskid="+taskid+"&userid="+userid+"&superid="+superid+"&distance="+distance,
                    function(data){
                        if (1==data||"1"==data) {
                            if (i==$("#countre").val()) {
                                location.href=APP+"/Mobileweb/Events/supervise?userid="+userid+"&taskid="+taskid+"&lng="+longitude+"&lat="+latitude;
                            }
                        }
                    },"json");
            });
        }

        function do_task(obj,k){
            //点击按钮时根据状态判断，如状态为2，则不修改，如没有数据则添加数据到表taskdraw中，还有把数据序号也也加入进去
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            var state=$("#state"+k).val();
            var superid=$("#superid"+k).val();
            if (state=="") {
                $.post(APP+"/Mobileweb/Events/superviseDraw",
                "taskid="+taskid+"&userid="+userid+"&superid="+superid);
            }
            // $(".show_tips1").slideDown();

            // $(document).on('click','.btns span',function(){
            //     if($(this).text()=='稍后'){
            //         $(".show_tips1").slideUp();
            //         $(obj).text("继续参与");
            //     }else{
                    location.href=APP+'/Mobileweb/Events/superviseCheck?userid='+$('#userid').val()+'&taskid='+$('#taskid').val()+'&netserial='+k+'&superid='+superid+'&longitude='+longitude+'&latitude='+latitude;
            //     }
            // });
        }

        function goBack(){
            document.getElementById("supervise").click();
            document.getElementById("superviseIphone").click();
        }


        function sendCommand(cmd){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            var longitude=$("#longitude").val();
            var latitude=$("#latitude").val();
            var url=APP+"/Mobileweb/Events/supervise?userid="+userid+"&taskid="+taskid+"&lng="+longitude+"&lat="+latitude+"|wisdom="+cmd;
            document.location = url;
        }
        function clickLink(){
            sendCommand("goback");
        }

</script>
</html>