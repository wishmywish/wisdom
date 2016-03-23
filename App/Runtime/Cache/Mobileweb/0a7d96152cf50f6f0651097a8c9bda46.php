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
        padding-left: 15px;
        width: 15%;
    }

    .heads h1{
        line-height: 69px;
        display: inline-block;
        font-size: 20px;
        }
    .oh{
        
        overflow-y: auto;
    }
    .page{
        width: 100%;
        height: 30px;
        line-height: 30px;
        border: 1px solid #ccc;
        text-align: center;
        padding: 0;
        margin: 0;

    }
    .page li{
        float: left;
        text-align: center;
        padding: 0 5px;
    }

    .title{
          width: 100%;
          padding: 10px;
    }
    *{padding: 0; margin: 0}
    .show_pic{
        margin: 5px 2% 22% 2%;
        position: relative;
        width: 16%;
        float: left;
    }
    .pics{
        width: 100%;
        position: absolute;
    }
    .show_pic a{
        position: absolute;
        top: -4%;
        left: 85%;
    }
    .camera a{
        color: #000;
    }
    .foot{
        background: rgba(239, 238, 238, 0.8);
        width: 100%;
        height: 40px;
        bottom: 10px;
        text-align: center;
        position: fixed;
        z-index: 100;
        margin-top: 35px;
    }
    .foot span{
        width: 60px;
        height: 30px;
        line-height: 30px;
        border-radius: 34px 34px 0 0;
        margin-top: -15px;
        background: rgb(245, 241, 241);
        padding: 10px 5px;
        color: #F29800;
    }

    .checkBox{
        margin-left: 5%;
        width: 5%;
        height: 20px;
        float: left;
        margin-top: 1.8%;
    }
    label{
        height: 35px;
        line-height: 35px;
    }
    label input[type=checkbox]:checked ~ span{
        color: #FF6600;
        text-shadow: none;
    }

    label input[type=checkbox] ~ span{
        color: #000;
        text-shadow: none;
    }

    label span {
        margin-left: 3%;
        margin-left: 3%;
        font-size: 12px;
        float: left;
        display: inline-block;
        width: 80%;
    }
    textarea{
        width: 90%;
        height: 270px;
        margin: 0px 3%;
        border: 1px solid rgb(51, 51, 51);
        resize: none;
        padding: 2%;
    }
    .btn{
        line-height: 40px;
        border-radius: 10px;
        border: 1px solid #F60;
        background: #FFF;
        bottom: 3%;
        width: 92%;
        margin: 0 4%;
        color: #F60;
    }
    .btn span{
        letter-spacing: 8px;
        text-shadow: none;
    }
</style>
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
    <?php if(($re) != ""): if(is_array($re)): $k = 0; $__LIST__ = $re;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div data-role="page" id="page<?php echo ($k); ?>">
                <div  class="heads" style="height: 64px;line-height: 64px;padding-top:0px;text-align: center;">
                    <span  class="fa fa-angle-left fa-3x" onclick="goToBack()"></span>
                    <h1>任务详情</h1>
                    <span data-role="none" style="float:right;" onclick="oneKeySort()">完成</span>
                </div>
                <div data-role="content" style="width: 100%;">
                    <div class="head_top">
                        <p title="<?php echo ($vo["f_title"]); ?>" style="font-size: 16px"><?php echo ($vo["f_title"]); ?></p>
                    </div>
                    <div class="head_nav">
                        <div class="ui-grid-b">
                            <div class="ui-block-a">
                                <a class="ui-btns a4" data-icon="arrow-l" data-ajax="false" data-role="button" onclick="lastProblem(<?php echo ($k); ?>)")> </a>
                            </div>
                            <div class="ui-block-b nav_cent">
                                <input type="hidden" id="currentPage" value="<?php echo ($k); ?>">
                                <span class="sp5"><?php echo ($k); ?></span>
                                <span>/<?php echo ($count); ?></span>
                            </div>
                            <div class="ui-block-c">
                                <a class="ui-btns a5" data-icon="arrow-r" data-ajax="false" data-role="button" onclick="nextProblem(<?php echo ($k); ?>,<?php echo ($count); ?>)"> </a>
                            </div>
                        </div>
                    </div>
                    <div class="head_con">
                        <p title="<?php echo ($vo["f_problemtatile"]); ?>" style="font-size: 14px"><?php echo ($vo["f_problemtatile"]); ?></p>
                    </div>
                    <div class="head_con2 oh">
                        <?php if(is_array($vo["f_options"])): $ky = 0; $__LIST__ = $vo["f_options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voy): $mod = ($ky % 2 );++$ky; if(($vo['f_type'] == 1) OR ($vo['f_type'] == '1')): ?><div style=" margin: 0 1.3em; overflow: hidden; margin-bottom: 0.6em;">
                                    <input type="radio" class="inps" name="inps<?php echo ($k); ?>" value="<?php echo ($ky-1); ?>" id="ss<?php echo ($k); echo ($ky-1); ?>"
                                    <?php if($ky-1 == 0): ?>checked<?php endif; ?>
                                    />
                                    <div  style="margin-left: 0.5em; margin-top: -2px; float: left;vertical-align:middle;  display:table-cell;"><?php echo ($voy); ?></div>
                                </div>
                            <?php elseif(($vo['f_type'] == 2) OR ($vo['f_type'] == '2')): ?>
                                <div style=" margin: 0 1.3em; overflow: hidden; margin-bottom: 0.6em;">
                                    <input type="checkbox" class="inps" name="inps<?php echo ($k); ?>" value="<?php echo ($ky-1); ?>" id="ss<?php echo ($k); echo ($ky-1); ?>" />
                                    <div  style="margin-left: 0.5em; margin-top: -2px; float: left;vertical-align:middle;  display:table-cell;"><?php echo ($voy); ?></div>
                                </div>
                            <?php elseif(($vo['f_type'] == 3) OR ($vo['f_type'] == '3')): ?>
                                <p class="title">请对您看到的终端形象及问题进行描述</p>
                                <div style="width: 100%;">
                                    <textarea data-role="none" id="description<?php echo ($k); ?>"></textarea>
                                </div>
                            <?php elseif(($vo['f_type'] == 4) OR ($vo['f_type'] == '4')): ?>
                                <input type="hidden" id="superviseCheckIphone" onclick="clickLink(<?php echo ($k); ?>)">
                                <p class="title">请拍摄门头照片（要求照片清晰可辨）；</p>
                                <img id="pictureShow" style="width: 94%;margin: 0 3%;" src=""/>
                                <div class="pics">
                                </div>

                                <div class="foot">
                                    <span class="fa fa-camera fa-2x fa-fw" onclick="iphoneCamera()"></span>
                                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <input type="hidden" id="type<?php echo ($k); ?>" value="<?php echo ($vo['f_type']); ?>">
                    <div class="head_con4">
                        <button id="submit" onclick="done(<?php echo ($count); ?>)">提交</button>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
         <div>
             <input type="hidden" id="countPage" value="<?php echo ($count); ?>">
             <input type="hidden" id="netserial" value="<?php echo ($netserial); ?>">
             <input type="hidden" id="superid" value="<?php echo ($superid); ?>">
             <input type="hidden" id="mobilesystem" value="<?php echo ($mobilesystem); ?>">
             <input type="hidden" id="userid" value="<?php echo ($userid); ?>">
             <input type="hidden" id="taskid" value="<?php echo ($taskid); ?>">
             <input type="hidden" id="longitude" value="<?php echo ($longitude); ?>">
             <input type="hidden" id="latitude" value="<?php echo ($latitude); ?>">
             <input type="hidden" id="superviseCheck" onclick="window.demo.camera()">
             <input type="hidden" id="superviseCheckIphone" onclick="clickLink()">
         </div><?php endif; ?>
</body>
 <script type="text/javascript">
        if($("#countPage").val()>1){
            $(".head_con4").hide();
        }

        function goToBack(){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            var longitude=$("#longitude").val();
            var latitude=$("#latitude").val();
            location.href=APP+"/Mobileweb/Events/supervise?userid="+userid+"&taskid="+taskid+"&lng="+longitude+"&lat="+latitude;
        }

        function nextProblem(k,count){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            var longitude=$("#longitude").val();
            var latitude=$("#latitude").val();
            var type=$("#type"+k).val();
            var netserial=$("#netserial").val();
            var superid=$("#superid").val();

            if ((k+1)>count) {
                layer.msg("当前页是最后页");
                return false;
            }else{
                if ((k+1)==count) {
                    setTimeout('$(".head_con4").show()', 1000 );
                }
                if (1==type||'1'==type||2==type||'2'==type) {
                    var inpschecked = $("input[name='inps"+k+"']:checked");
                    var answerInput="";
                    if(inpschecked.length==1){
                        answerInput=inpschecked.val();
                    }else{
                        inpschecked.each(function(){
                            if (answerInput ==""){
                                answerInput += $(this).val();
                            }else{
                                answerInput += "," + $(this).val();
                            }
                        });
                    }
                    $.post(APP+"/Mobileweb/Events/superviseNext",
                    "taskid="+taskid+"&answerInput="+answerInput+"&serial="+k+"&userid="+userid+"&netserial="+netserial,
                    function(re){
                        if(1==re||"1"==re){
                           location.href=APP+"/Mobileweb/Events/superviseCheck?userid="+userid+"&taskid="+taskid+"&netserial="+netserial+"&superid="+superid+'&longitude='+longitude+'&latitude='+latitude+"#page"+(++k);
                        }
                    },'json');
                }else if(3==type||'3'==type) {
                    var description=$(("#description"+k)).val();
                     $.post(APP+"/Mobileweb/Events/superviseNext",
                    "taskid="+taskid+"&answerInput="+description+"&serial="+k+"&userid="+userid+"&netserial="+netserial,
                    function(re){
                        if(1==re||"1"==re){
                           location.href=APP+"/Mobileweb/Events/superviseCheck?userid="+userid+"&taskid="+taskid+"&netserial="+netserial+"&superid="+superid+'&longitude='+longitude+'&latitude='+latitude+"#page"+(++k);
                        }
                    },'json');
                }else if(4==type||'4'==type) {
                    // 图片利用手机端的照相机照相并且上传，在答案一栏写入id|id
                    var photoIDs="";
                    $("input[name='pictureShowSmall']").each(function () {
                        if (photoIDs === "") {
                            photoIDs += $(this).val();
                        } else {
                            photoIDs += "|" + $(this).val();
                        }
                    });
                    if (photoIDs=="") {
                        layer.msg("请拍摄门头照片");
                        return false;
                    }
                     $.post(APP+"/Mobileweb/Events/superviseNext",
                    "taskid="+taskid+"&answerInput="+photoIDs+"&serial="+k+"&userid="+userid+"&netserial="+netserial,
                    function(re){
                        if(1==re||"1"==re){
                           location.href=APP+"/Mobileweb/Events/superviseCheck?userid="+userid+"&taskid="+taskid+"&netserial="+netserial+"&superid="+superid+'&longitude='+longitude+'&latitude='+latitude+"#page"+(++k);
                        }
                    },'json');
                }
            }
        }

        function lastProblem(k){
            if ((k-1)<1) {
                layer.msg("当前页是第一页");
                return false;
            }else{
                $(".head_con4").hide();
                location.hash="#page"+(--k);
            }
        }

        function done(count){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            var type=$("#type"+count).val();
            var netserial=$("#netserial").val();
            var superid=$("#superid").val();
            var longitude=$("#longitude").val();
            var latitude=$("#latitude").val();

             if (1==type||'1'==type||2==type||'2'==type) {
                var inpschecked = $("input[name='inps"+count+"']:checked");
                var answerInput="";
                if(inpschecked.length==1){
                    answerInput=inpschecked.val();
                }else{
                    inpschecked.each(function(){
                        if (answerInput ==""){
                            answerInput += $(this).val();
                        }else{
                            answerInput += "," + $(this).val();
                        }
                    });
                }
                $.post(APP+"/Mobileweb/Events/superviseNext",
                "taskid="+taskid+"&answerInput="+answerInput+"&serial="+count+"&userid="+userid+"&netserial="+netserial+"&superid="+superid+"&submit=submit",
                function(re){
                    if(1==re||"1"==re){
                        location.href=APP+"/Mobileweb/Events/supervise?userid="+userid+"&taskid="+taskid+"&lng="+longitude+"&lat="+latitude+"&superid="+superid+"&submit=submit";
                    }
                },'json');
            }else if(3==type||'3'==type) {
                var description=$(("#description"+count)).val();
                 $.post(APP+"/Mobileweb/Events/superviseNext",
                "taskid="+taskid+"&answerInput="+description+"&serial="+count+"&userid="+userid+"&netserial="+netserial+"&superid="+superid+"&submit=submit",
                function(re){
                    if(1==re||"1"==re){
                        location.href=APP+"/Mobileweb/Events/supervise?userid="+userid+"&taskid="+taskid+"&lng="+longitude+"&lat="+latitude+"&superid="+superid+"&submit=submit";
                    }
                },'json');
            }else if(4==type||'4'==type) {
                //图片利用手机端的照相机照相并且上传，在答案一栏写入id|id
                var photoIDs="";
                $("input[name='pictureShowSmall']").each(function () {
                    if (photoIDs === "") {
                        photoIDs += $(this).val();
                    } else {
                        photoIDs += "|" + $(this).val();
                    }
                });
                if (photoIDs=="") {
                    layer.msg("请拍摄门头照片");
                    return false;
                }
                 $.post(APP+"/Mobileweb/Events/superviseNext",
                "taskid="+taskid+"&answerInput="+photoIDs+"&serial="+count+"&userid="+userid+"&netserial="+netserial+"&superid="+superid+"&submit=submit",
                function(re){
                    if(1==re||"1"==re){
                        location.href=APP+"/Mobileweb/Events/supervise?userid="+userid+"&taskid="+taskid+"&lng="+longitude+"&lat="+latitude+"&superid="+superid+"&submit=submit";
                    }
                },'json');
            }
        }

        function connectWebViewJavascriptBridge(callback){
            if (window.WebViewJavascriptBridge)
            {
                callback(WebViewJavascriptBridge)
            }else{
                document.addEventListener('WebViewJavascriptBridgeReady', function(){
                    callback(WebViewJavascriptBridge)
                }, false)
            }
        }

         function iphoneCamera(){
                var  pictureLength=$("input[name='pictureShowSmall']").length;
                if (pictureLength<5) {
                    document.getElementById("superviseCheck").click();
                    document.getElementById("superviseCheckIphone").click();
                }else{
                    layer.msg("门头照片最多五张！");
                    return false;
                }
            }

        function transform(obj){
            var arr = [];
            for(var item in obj){
                arr.push(obj[item]);
            }
            return arr;
        }

        function acceptAndroidCamera(data){
            var rand = Math.ceil(Math.random()*100);
            var obj=eval('('+data+')');
            obj=transform(obj);
            $("#pictureShow").attr("src","http://mapi.51lick.cn/Public/upfile/"+obj[0]);
            var list="";
            list += "<div class='show_pic'>";
            list += "<img id='show_img"+rand+"' src='' onclick='showPicture(this.src)'>";
            list += "<input type='hidden' name='pictureShowSmall' value='"+obj[1]+"'>"
            list += "<a class='fa fa-minus-circle' onclick='clearPicture("+rand+")'></a>";
            list += "</div>";
            $('.pics').append(list);
            $("#show_img"+rand).attr("src","http://mapi.51lick.cn/Public/upfile/"+obj[0]);
        }

        function acceptIphoneCamera(data){
            var rand = Math.ceil(Math.random()*100);
            var obj=eval(data);
            obj=transform(obj);
            $("#pictureShow").attr("src","http://mapi.51lick.cn/Public/upfile/"+obj[0]);
            var list="";
            list += "<div class='show_pic'>";
            list += "<img id='show_img"+rand+"' src='' onclick='showPicture(this.src)'>";
            list += "<input type='hidden' name='pictureShowSmall' value='"+obj[1]+"'>"
            list += "<a class='fa fa-minus-circle' onclick='clearPicture("+rand+")'></a>";
            list += "</div>";
            $('.pics').append(list);
            $("#show_img"+rand).attr("src","http://mapi.51lick.cn/Public/upfile/"+obj[0]);
        }

        function clearPicture(rand){
            $("#pictureShow").attr("src","");
            $("#show_img"+rand).parent("div").css("display","none");
        }

        function showPicture(str){
            $("#pictureShow").attr("src",str);
        }

        function sendCommand(cmd,k){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            var longitude=$("#longitude").val();
            var latitude=$("#latitude").val();
            var netserial=$("#netserial").val();
            var superid=$("#superid").val();
            var url=APP+"/Mobileweb/Events/superviseCheck?userid="+userid+"&taskid="+taskid+"&netserial="+netserial+"&superid="+superid+'&longitude='+longitude+'&latitude='+latitude+"#page"+k+"|wisdom="+cmd;
            document.location = url;
        }
        function clickLink(k){
            sendCommand("iphoneCamera",k);
        }

    </script>
</html>