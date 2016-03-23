<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧推广::首页</title>
        <style>
            /*列出所有图标*/
            /*菜单红条*/
            .menu_line_red{background:url(/wisdom/Public/Home/Default/images/bg.png) repeat-x -0px -10px;}
            /*菜单蓝条*/
            .menu_line_blue{background:url(/wisdom/Public/Home/Default/images/bg.png) repeat-x -0px -15px;}
        </style>
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/Home/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Home/Default";
            var bigMenuIndex = 0; //大类LI下标
            var smallMenuIndex = 0;//小类LI下标
        </script>
        <script src="/wisdom/Public/static/js/tealeaf.js"></script>
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
        <!--cookie插件-->
        <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>

        <script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
        
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Home/Default/css/home.css" />
        
        <!--自动补全插件-->
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/jquery.bigautocomplete.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.min.css" />
        <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>

    </head>
    <body>
        <div class="head">
            <div class="head_center">

                <div class="logo"><img style="height: 30px;margin-top: 8px;" src="/wisdom/Public/upfile/logo/logo.png" ></div>

                <div class="company_name"><?PHP echo cookie("companyName")?></div>
                <div style="width:100px;float:left;padding-left:20px;">
                    <?php if($state == 4): ?><span style="color:#ffffff">(待审核)</span><?php endif; ?>

                    <?php if($state == 1): ?><!--银-->
                       <?php if($level == 1): ?><img src="/wisdom/Public/Home/Default/images/ptqy.png" style="height:45px;width:150px;"/>
                           <!--金-->
                           <?php elseif($level == 2): ?>
                           <img src="/wisdom/Public/Home/Default/images/gold.png" style="height:45px;width:150px;"/>
                           <!--钻石-->
                           <?php else: ?>
                           <img src="/wisdom/Public/Home/Default/images/zhushi.png" style="height:45px;width:150px;"/><?php endif; endif; ?>
                </div>

                <!--<div class="search">-->
                    <!--<div class='input_input'><input type="text" name="search_text" id="search_text"></div>-->
                    <!--<div class="input_icon"><span class="fa fa-search fa-lg"></span></div>-->
                <!--</div>-->
                <?php if( !in_array("e1",$access_array) ){ echo "<!--"; } ?>
                <span style="position: absolute;right: 520px;" onclick="location.href = APP+'/Admin/Group/index'">企业资料维护</span>
                <?php if( !in_array("e1",$access_array) ){ echo "-->"; } ?>
                <div class="personal_info">
                    <div  style="width:100%;">
                        <div class="pro_img"><img style="height: 35px;" src="<?php echo ($headlogo); ?>"></div>

                        <div style="height: 50px;">
                            <!--<?php echo empty(cookie("trueName"))?cookie("mobile"):cookie("trueName"); ?>-->
                            <!--<?php echo ($userInfo_arr['list']['trueName']); ?>-->
                            <?php if(empty($userInfo_arr['list']['trueName']) == true): echo ($userInfo_arr['list']['mobile']); else: echo ($userInfo_arr['list']['trueName']); endif; ?>
                            <i style="width: 30px;" id="personal_info" class="fa fa-chevron-circle-down"></i>
                            <b class="caret"></b>
                        </div>
                    </div>

                    <div class="personal_info_set">
                       <ul>
<!--                        <li>帮助</li>-->
                           <!--<?php if( !in_array("e1",$access_array) ){ echo "&lt;!&ndash;"; } ?>-->
                           <!--<li onclick="location.href = APP+'/Admin/Group/index'">企业资料维护</li>-->
                           <!--<?php if( !in_array("e1",$access_array) ){ echo "&ndash;&gt;"; } ?>-->
                        <li onclick="location.href = APP+'/Home/Office/index'">返回首页</li>

                        <li id="back_system">退出</li>
                       </ul>
                    </div>
                 
                </div>

<!--                <div class="back_system"  id="back_system">退出</div>-->
            </div>
        </div>
        <script>
            $("#back_system").click(function(){
                var loadi=layer.load(0);
                $.get("<?php echo U('Api/outLogin');?>",function(){
                    Cookie.eraseCookie("bigMenuIndex");
                    Cookie.eraseCookie("smallMenuIndex");
                    layer.close(loadi);
                    layer.msg("成功退出系统",{icon:9})
                    location.href=APP+"/Home/Index/index";
                }); 
            });
            $("#personal_info").mouseover(function(event) {
                $(".personal_info_set").show();
                $(".personal_info_set").mouseout(function(event){
                    $(".personal_info_set").hide();
                });
            });

            $("#personal_info").hover(function(){
                $(".personal_info_set").slideDown("slow","swing");
                $(".personal_info_set").mouseover(function(){
                    $(".personal_info_set").show();
                });
                $(".personal_info_set").mouseout(function(){
                    $(".personal_info_set").hide();
                });
            },function(){
                $(".personal_info_set").slideDown();
            });


        </script>
<div class="menu">
    <div class="menu_big">
        <div class="menu_big_list">
            <ul id="menu_big_list_button">
                <?php if(is_array($bigclass)): $i = 0; $__LIST__ = $bigclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li value="<?php echo ($vo["f_sys_column_url"]); ?>" id="<?php echo ($vo["f_sys_column_cid"]); ?>" contextmenu="<?php echo ($vo["f_sys_column_urltype"]); ?>"><?php echo ($vo["f_sys_column_name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="menu_small">
        <div class="menu_small_list">
            <ul id="menu_small_list_button">
                <?php if(is_array($smallclass)): $i = 0; $__LIST__ = $smallclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><li value="<?php echo ($vos["f_sys_column_url"]); ?>" dir="<?php echo ($vos["f_sys_column_target"]); ?>" id="<?php echo ($vos["f_sys_column_cid"]); ?>" contextmenu="<?php echo ($vos["f_sys_column_urltype"]); ?>"><?php echo ($vos["f_sys_column_name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="menu_bg_line">
            <ul id="menu_small_tab_line">
                <?php if(is_array($smallclass)): $i = 0; $__LIST__ = $smallclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><li></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>
<!--<div style="width: 100%;height: 2px;clear:both;"></div>-->
<script>
    //默认加载
    $(function(){
        if(Cookie.readCookie('bigMenuIndex')===null){
            Cookie.createCookie('bigMenuIndex',0,1);
            Cookie.createCookie('smallMenuIndex',0,1);
        }
        //alert(Cookie.readCookie('bigMenuIndex'));
        $('#menu_big_list_button li').eq(Cookie.readCookie('bigMenuIndex')).attr('class','selected');
        $('#menu_small_list_button li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','selected');
        $('#menu_small_tab_line li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','menu_tab_bg_line');
    });
    
    $('#menu_small_list_button li').mouseover(function(){
        var ind = parseInt($(this).index());
       
        if(ind!==parseInt(Cookie.readCookie('smallMenuIndex'))){
            $('#menu_small_tab_line li').eq(ind).attr('class','menu_tab_bg_line');
            $('#menu_small_tab_line li').eq(Cookie.readCookie('smallMenuIndex')).removeClass('menu_tab_bg_line');
            
            $('#menu_small_list_button li').eq(ind).attr('class','selected');
            $('#menu_small_list_button li').eq(Cookie.readCookie('smallMenuIndex')).removeClass('selected');
        }
    });
    $('#menu_small_list_button li').mouseout(function(){
        var ind = $(this).index();
        $('#menu_small_tab_line li').eq(ind).removeClass('menu_tab_bg_line');
        $('#menu_small_tab_line li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','menu_tab_bg_line');
        
        $('#menu_small_list_button li').eq(ind).removeClass('selected');
        $('#menu_small_list_button li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','selected');
    });
    
    //点击大类
    $('#menu_big_list_button').on('click','li',function(){
        var url_0 = $(this).attr('value');
        var key = $(this).attr('contextmenu');
        Cookie.createCookie('bigMenuIndex',$(this).index(),1);
        Cookie.createCookie('smallMenuIndex',0,1);
        $('#menu_big_list_button li').removeClass('selected');
        $(this).attr('class','selected');
        if(key==='1'){
            location.href = APP+"/"+url_0;
        }else{
            location.href = url_0;
        }
    });
    
    //点击小类
    $('#menu_small_list_button').on('click','li',function(){
        var url_0 = $(this).attr('value');
        var key = $(this).attr('contextmenu');
        var target_1 = $(this).attr('dir');
        //alert(target_1);
        Cookie.createCookie('smallMenuIndex',$(this).index(),1);
        $('#menu_small_list_button li').removeClass('selected');
        $(this).attr('class','selected');
        if(key==='1'){
            location.href = APP+"/"+url_0;
        }else if(key==='2'){
            if(target_1==="oms"){
                //alert($('#oms').attr('src'));
                //target_1.location.href = url_0;
                $('#oms').attr('src',url_0);
            }else{
                location.href = url_0;
            }
        }
    });

    
</script>
    <div class="index">
        <div class="index_left">
        <!--个人信息-->
        <div class="index_left_pro" style="height: 87px">

            <div class="pro_img">
                <img style="height: 50px;width: 50px;" src="<?php echo ($headlogo); ?>">
            </div>
            <div class="pro_info">
                <span style="line-height: 25px; font-size: 16px; font-weight: bold;">
                    <!--<?php echo empty(cookie("nickName"))?session("mobile"):cookie("nickName"); ?>-->
                     <?php if(empty($userInfo_arr['list']['nickName']) == true): echo ($userInfo_arr['list']['mobile']); else: echo ($userInfo_arr['list']['nickName']); endif; ?>
                </span>
            </div>
        </div>
        <!--快捷导航-->
       <div class="index_left_url_bus">
             <div class="left_url">推广赚任务标题：</div>
             <div class="business_left_url" id="title_protaskname">
             </div>
        </div>
        <div class="index_left_other_bus">
            <!--<div class="left_url">任务描述:</div>-->
            <!--<div class="business_left_url" id="descepit_protaskname"></div>-->
            <div class="left_url">推广目标数：<span id="protargetnum"></span></div>
            <div class="left_url">参与数量：<span id="projoinnum"></span></div>
            <div class="left_url">单份任务金币：<span id="procoinnum"></span></div>
            <div class="left_url">总奖励金币：<span id="protoatalcoin"></span></div>
            <div class="left_url">已发奖励金币：<span id="proissuedcoin"></span></div>
            <div class="business_left_url" style="padding-bottom:20px"></div>
        </div>
        
         <div class="index_left_url_bus">
             <div class="left_url">随手赚任务标题：</div>
             <div class="business_left_url" id="title_pushtaskname">
             </div>
        </div>
        <div class="index_left_other_bus">
            <!--<div class="left_url">任务描述:</div>-->
            <!--<div class="business_left_url" id="descepit_pushtaskname"></div>-->
            <div class="left_url">发布任务数量：<span id="pushreleanum"></span></div>
            <div class="left_url">参与任务数量：<span id="pushjoinnum"></span></div>
            <div class="left_url">完成任务数量：<span id="pushcompletenum"></span></div>
            <div class="left_url">单份任务金币：<span id="pushonecoin"></span></div>
            <div class="left_url">总奖励金币：<span id="pushtoatalcoin"></span></div>
            <div class="left_url" style="padding-bottom:25px">已发奖励金币：<span id="pushissuedcoin"></span></div>
        </div>
     </div>
    <div class="index_right_bus">
       <div style="width:100%;min-height:30px;border-bottom:1px #fafafa solid;padding-bottom:20px">
           <div  style="float:left;min-height:30px;">
               <span style="margin-left:20px">推广赚任务标题</span>
               <select name="protaskname" id="protaskname" style="color: #595758;width:300px;height:30px;margin-left:7px;border:1px #EAEAEA solid"  onchange='tasknamechange("protaskname",this.value,1)'>
                     
               </select> 
           </div>
           <div style="float:right;min-height:30px;margin-right:10px">
               <span style="margin-left:20px">随手赚任务标题</span>
               <select name="pushtaskname" id="pushtaskname" style="color:#595758;width:300px;height:30px;margin-left:7px;border:1px #EAEAEA solid"  onchange='tasknamechange("pushtaskname",this.value,2)'>
                     
              </select>
           </div>
           
        </div>
        <div class="index_right_table">
            <div class="table_top">
                <span class="table_top_left">本次任务成果</span>
            </div>
            <div  class="table1_center">
                <div  class="table1_center_body" style="margin-top:40px;">
                    <div class="table1_center_body_left">
                        <div  class="body_title">推广赚</div>
                            <div  id="pro_taskAchieve_make" style="height:300px;width:400px;"><img style="margin-top:50px" src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                    </div>
                    <div class="table1_center_body_right" style="margin-right:20px">
                        <div class="body_title">随手赚</div>
                                 <div  id="pro_taskAchieve_earn" style="height:300px;width:400px;"><img style="margin-top:50px" src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="index_right_table">
            <div class="table_top">
               <div class="table_top_left" >本次支出费用</div>
            </div>
            <div  class="table1_center">
                <div  class="table1_center_body" style="margin-top:40px;">
                    <div class="table1_center_body_left" >
                        <div  class="body_title">推广赚</div>
                            <div  id="pro_taskExpend_make" style="height:300px;"><img style="margin-top:45px" src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                    </div>
                    <div class="table1_center_body_right" style="margin-right:20px">
                        <div class="body_title">随手赚</div>
                                 <div  id="pro_taskExpend_earn" style="height:300px;"><img  style="margin-top:45px" src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div  class="index_right_table">
            <div class="table_top">
                <div class="table_top_left">本次区域报告</div>
            </div>
            <div  class="table3_center">
                <div class="table3_center_body">
                    <!--地图表显示-->
                    <div class="table1_center_body_left" style="width:420px;">
                        <div  class="body_title">推广赚</div>
                            <div  id="pro_taskReport_make" style="height:400px;"><img style="margin-top:50px" src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                    </div>
                    <div class="table1_center_body_right" style="width:420px;margin-right:20px;" >
                        <div class="body_title">随手赚</div>
                                 <div  id="pro_taskReport_earn" style="height:400px"><img style="margin-top:50px;margin-left: 20px;" src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                    </div>             
        </div>
            </div>
        </div>
    </div>
    </div>
   
       
  <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/jquery.bigautocomplete.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/skin/layer.css"></script>
<script type="text/javascript" src="/wisdom/Public/static/laypage/laypage.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>
<div style="display: none;"><script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script></div>

 
 
    
        <!--Echarts单文件引入-->
  <script src="/wisdom/Public/static/echarts/build/dist/echarts-all.js"></script>
  <script type="text/javascript" src="/wisdom/Public/Home/Default/js/promotion_chart.js"></script> 
  <script>
      getprotaskname("protaskname",1);
      getprotaskname("pushtaskname",2);
      function getprotaskname(taskname,tasktype){
          var companyid=Cookie.readCookie("LYX_companyId");
          $.ajaxSetup({   
            async : false
        }); 
          $.post(APP+"/Api/Web/gettasktitle","tasktypeid="+tasktype+"&companyid="+companyid,function(rel){
                $("#"+taskname).empty();
                var namelist="";
                var length=rel.list.length;
//                console.log(length);
                if(length!=0){
                      $.each(rel.list,function(i,v){
                    namelist += "<option  id='"+taskname+"_"+v.f_tid+"' rel='"+v.f_title+"|"+v.f_description+"' value="+v.f_tid+">"+v.f_title+"("+v.f_typename+")</option>";
                });
                      $("#"+taskname).append(namelist);
                      $("#title_"+taskname).html(rel['list'][0]['f_title']);
                      $("#descepit_"+taskname).html(rel['list'][0]['f_description']);
                       prochart(rel['list'][0]['f_tid'],tasktype);
                }else{
                    $("#"+taskname).append("<option  value=''>暂无任务</option>");
                }
               
          },"json");
      }
      function tasknamechange(taskname,val,type){  
                prochart(val,type);
                var arr=new Array();
                var rel=$("#"+taskname+" #"+taskname+"_"+val).attr("rel");
                arr=rel.split("|");
                $("#title_"+taskname).html(arr[0]);
                $("#descepit_"+taskname).html(arr[1]);
      }
  </script>
  </body>
</html>