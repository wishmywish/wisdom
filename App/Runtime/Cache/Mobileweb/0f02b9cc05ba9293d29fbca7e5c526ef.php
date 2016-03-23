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
            var IMG = "/wisdom/Public/MODULE_NAME/DEFAULT_THEME/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/MODULE_NAME/DEFAULT_THEME";
        </script>

        <link rel="stylesheet" type="text/css" href="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/css/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
    </head>

</head>
 <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/js/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/base64.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/md5.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/sha1.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/config.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/js/fun.js"></script>


<!--ueditor编译器源码文件-->
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>

 <body>
    <?php if(($re) != ""): if(is_array($re)): $k = 0; $__LIST__ = $re;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div data-role="page" id="page<?php echo ($k); ?>">
                <div  class="heads">
                    <h1>随手赚</h1>
                </div>
                <div data-role="content">
                    <div class="head_top">
                        <p><?php echo ($vo["f_problemtatile"]); ?></p>
                    </div>
                    <div class="head_nav">
                        <div class="ui-grid-b">
                            <div class="ui-block-a">
                                <a class="ui-btns a4" data-icon="arrow-l" data-ajax="false" data-role="button" onclick="lastProblem(<?php echo ($k); ?>,<?php echo ($vo["f_type"]); ?>)")> </a>
                            </div>
                            <div class="ui-block-b nav_cent">
                                <span class="sp5"><?php echo ($k); ?></span>
                                <span>/<?php echo ($count); ?></span>
                            </div>
                            <div class="ui-block-c">
                                <a class="ui-btns a5" data-icon="arrow-r" data-ajax="false" data-role="button" onclick="nextProblem(<?php echo ($k); ?>,<?php echo ($vo["f_type"]); ?>,<?php echo ($count); ?>)"> </a>
                            </div>
                        </div>
                    </div>
                    <div class="head_con">
                        <p><?php echo ($vo["f_problemtatile"]); ?></p>
                    </div>
                    <div class="head_con2">
                        <?php if(is_array($vo["f_options"])): $ky = 0; $__LIST__ = $vo["f_options"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voy): $mod = ($ky % 2 );++$ky; if ($vo['f_type']==1||$vo['f_type']=='1') { ?>
                                <p>
                                    <input type="radio" class="inps" name="inps<?php echo ($k); ?>" value="<?php echo ($ky-1); ?>" id="ss<?php echo ($ky-1); ?>"/>
                                    <span class="sp6"><?php echo ($voy); ?></span>
                                </p>
                            <?php }else if ($vo['f_type']==2||$vo['f_type']=='2') { ?>
                                <p>
                                    <input type="checkbox" class="inps" name="inps<?php echo ($k); ?>" value="<?php echo ($ky-1); ?>" />
                                    <span class="sp6"><?php echo ($voy); ?></span>
                                </p>
                            <?php } endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div>
                        <input type="hidden" id="trueAnswer<?php echo ($k); ?>" value="<?php echo ($vo["f_trueanswer"]); ?>">
                    </div>
                    <div class="head_con4">
                        <button onclick="done(<?php echo ($count); ?>)">提交</button>
                    </div>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
         <div>
             <input type="hidden" id="userid" value="<?php echo ($userid); ?>">
             <input type="hidden" id="taskid" value="<?php echo ($taskid); ?>">
         </div><?php endif; ?>
</body>
 <script type="text/javascript">
        $(".head_con4").hide();
        function nextProblem(k,f_type,count){
            var inpschecked=$("input[name='inps"+k+"']:checked");
            var tureanswer=$("#trueAnswer"+k+"").val();
            var data=tureanswer.split(",");

            for (var i = 1; i <= count; i++) {
                var answer="";
                if(inpschecked.length==1){
                    answer=inpschecked.val();
                }else{
                    inpschecked.each(function(){
                        if (answer ==""){
                            answer += $(this).val();
                        }else{
                            answer += "," + $(this).val();
                        }
                    });
                }
            }
            

            for (var i = 0; i < data.length; i++) {
                data[i]++;
            };
            var trueanswerall=data.join(",");
            if($("input[name='inps"+(k+1)+"']:checked").length == 0){
                if(f_type==1){
                    if(inpschecked.length == 0){
                        layer.msg("请勾选选项", {'icon': 8});
                        return false;
                    }else{
                        layer.msg("第"+trueanswerall+"个选项是正确的");
                        setTimeout('nextProblemTime('+k+','+count+')',3000);
                    }

                }else if(f_type==2){
                    if(inpschecked.length < 2){
                        layer.msg("答案至少两个");
                         return false;
                    }else{
                        layer.msg("第"+trueanswerall+"个选项是正确的");
                        setTimeout('nextProblemTime('+k+','+count+')',3000);
                    }
                }else if(f_type==3){
                    layer.msg("文本问答未完善！");
                    setTimeout('nextProblemTime('+k+','+count+')',3000);
                }else if(f_type==4){
                    layer.msg("图片问答未完善！");
                    setTimeout('nextProblemTime('+k+','+count+')',3000);
                }
            }else{
                location.href=APP+"/Mobileweb/Events/slides?userid="+$("#userid").val()+"&taskid="+$("#taskid").val()+"#page"+(++k);
                if (k==count) {
                   $(".head_con4").show();
                }

                if (k>count) {
                    layer.msg("当前页是最后页");
                }
            }
        }

        function nextProblemTime(k,count,tureanswer){

            // $.mobile.changePage (APP+"/Mobileweb/Events/slides?userid="+$("#userid").val()+"&taskid="+$("#taskid").val()+"#page"+(++k), 'pop', true, true);

            var tureanswer=$("#trueAnswer"+k+"").val();
            var trueAnswer_arr=tureanswer.split(",");
            var input = $("input[name='inps"+k+"']");
            for(var j =0;j < trueAnswer_arr.length;j++){
                for(var i =0;i < input.length;i++){
                    if (i == trueAnswer_arr[j]) {
                        input[i].id='TrueAnswer'+k+j;
                    }
                }
                $("#TrueAnswer"+k+j+"").parent().parent().append('<i class="fa fa-check" style="color:red; position: absolute; top:0; left:0;"></i>');
            }

            $("input[name='inps"+k+"']").attr("onclick","return false;");
            location.href=APP+"/Mobileweb/Events/slides?userid="+$("#userid").val()+"&taskid="+$("#taskid").val()+"#page"+(++k);

            //$.mobile.changePage("#page"+(++k),{transition:"pop"});
            // $.mobile.changePage("#page"+(++k), 'pop', true, true);
            // location.hash="#page"+(++k);
            // console.log("#page"+(k+1));
            // location.href="#page"+(++k);

            if (k>count) {
                $(".head_con4").show();
                layer.msg("当前页是最后页");
            }

        }

        function lastProblem(k,f_type){
            $(".head_con4").hide();
            location.hash="#page"+(--k);
            if (k<1) {
                layer.msg("当前页是第一页");
            }
        }

        function done(count){
            var taskid=$("#taskid").val();
            var userid=$("#userid").val();
            var serial="";
            var answer="";
            var allAnswer="";
            for (var i = 1; i <= count; i++) {
                var inpschecked=$("input[name='inps"+i+"']:checked");
                if(inpschecked.length==1){
                    answer=inpschecked.val();
                    if(allAnswer==""){
                        allAnswer=answer;
                        serial=i;
                    }else{
                        allAnswer+="|"+answer;
                        serial+="|"+i;
                    }
                }else{
                    answer ="";
                    inpschecked.each(function(){
                        if (answer ==""){
                            answer += $(this).val();
                        }else{
                            answer += "," + $(this).val();
                        }
                    });
                    if(allAnswer==""){
                        allAnswer=answer;
                        serial=i;
                    }else{
                        allAnswer+="|"+answer;
                        serial+="|"+i;
                    }
                }
            }

            $.post(APP+"/Mobileweb/Events/doneSure",
            "taskid="+taskid+"&allAnswer="+allAnswer+"&serial="+serial+"&userid="+userid,
            function(data){
                layer.msg("点击右上方按钮结束！");
            },"json");
            
        }
    </script>
</html>