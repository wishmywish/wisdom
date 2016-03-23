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
                <div  class="heads">
                    <h1>答题</h1>
                </div>
                <div data-role="content">
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
                    <div class="head_con" >
                        <p title="<?php echo ($vo["f_problemtatile"]); ?>" style="font-size: 14px"><?php echo ($vo["f_problemtatile"]); ?></p>
                    </div>
                    <div class="head_con2">
                        <?php if(is_array($vo["f_options"])): $ky = 0; $__LIST__ = $vo["f_options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voy): $mod = ($ky % 2 );++$ky; if(($vo['f_type'] == 1) OR ($vo['f_type'] == '1')): ?><div style=" margin: 0 1.3em; overflow: hidden; margin-bottom: 0.6em;">
                                    <input type="radio" class="inps" name="inps<?php echo ($k); ?>" value="<?php echo ($ky-1); ?>" id="ss<?php echo ($ky-1); ?>" 
                                    <?php if($ky-1 == 0): ?>checked<?php endif; ?>
                                    />
                                    <div  style="margin-left: 0.5em; margin-top: -2px;float: left;vertical-align:middle;  display:table-cell;"><?php echo ($voy); ?></div>
                                </div>
                            <?php elseif(($vo['f_type'] == 2) OR ($vo['f_type'] == '2')): ?>
                                <div style="margin: 0 1.3em; overflow: hidden; margin-bottom: 0.6em;">
                                    <input type="checkbox" class="inps" name="inps<?php echo ($k); ?>" value="<?php echo ($ky-1); ?>" />
                                    <div  style="margin-left: 0.5em; margin-top: -2px;float: left;vertical-align:middle;  display:table-cell;"><?php echo ($voy); ?></div>
                                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div>
                        <input type="hidden" id="trueAnswer<?php echo ($k); ?>" value="<?php echo ($vo["f_trueanswer"]); ?>">
                    </div>
                    <div class="head_con4">
                        <button id="submit" onclick="done(<?php echo ($count); ?>)">提交</button>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
         <div>
             <input type="hidden" id="countPage" value="<?php echo ($count); ?>">
             <input type="hidden" id="userid" value="<?php echo ($userid); ?>">
             <input type="hidden" id="taskid" value="<?php echo ($taskid); ?>">
             <input type="hidden" id="mobilesystem" value="<?php echo ($mobilesystem); ?>">
             <input type="hidden" id="answerOver" onclick="window.demo.done()">
         </div><?php endif; ?>
</body>
 <script type="text/javascript">
        if($("#countPage").val()>2){
            $(".head_con4").hide();
        }else if($("#countPage").val()==2 && $("#currentPage").val()==1){
            document.getElementById('submit').style.height=0;
            document.getElementById('submit').style.width=0;
            document.getElementById('submit').style.color="#fff";
            document.getElementById('submit').style.backgroundColor="#fff";
            document.getElementById('submit').style.borderColor="#fff";
        }

        function nextProblem(k,count){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
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
            

            if ((k+1)>count) {
                layer.msg("当前页是最后页");
                return false;
            }else{
                if ((k+1)==count) {
                    setTimeout('$(".head_con4").show()', 1000 );
                }
                $.post(APP+"/Mobileweb/Events/userChoices",
                "taskid="+taskid+"&answerInput="+answerInput+"&serial="+k+"&userid="+userid,
                function(re){
                    if(1==re||"1"==re){
                        location.href=APP+"/Mobileweb/Events/answerClass?userid="+$("#userid").val()+"&taskid="+$("#taskid").val()+"#page"+(++k);
                    }
                },'json');
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

        function mobileSystem(){
           function connectWebViewJavascriptBridge(callback) {
                if (window.WebViewJavascriptBridge) {
                    callback(WebViewJavascriptBridge)
                } else {
                    document.addEventListener('WebViewJavascriptBridgeReady', function() {
                        callback(WebViewJavascriptBridge)
                    }, false)
                }
            }
            connectWebViewJavascriptBridge(function(bridge) {
                bridge.init(function(message, responseCallback) {
                });

                var data = 'finish';
                bridge.send(data);
            });
        }

        function done(count){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
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
            $.post(APP+"/Mobileweb/Events/userChoices","taskid="+taskid+"&userid="+userid+"&serial="+count+"&answerInput="+answerInput+"&submit=submit",
            function(data){
                layer.open({
                    title: '答案对比',
                    type: 2,
                    area: ['100%', '100%'],
                    content: APP + '/Mobileweb/Events/answerCompare?taskid='+taskid+'&userid='+userid+'&goldCount='+data+'&mobilesystem='+$("#mobilesystem").val(),
                    cancel: function(index){
                        layer.close(index);
                            document.getElementById("answerOver").click();
                            mobileSystem();
                    }   
                });
                    setTimeout('document.getElementById("answerOver").click()',7000);
                    setTimeout('mobileSystem()',7000);
            },"json");
        }
    </script>
</html>