<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧运营平台::工作管理</title>
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
    <div id="rev_menu_left" class="class_menu_left" style="margin-right: 20px;">
        <ul id="bigmenu">
        <?PHP if($showDiv=="0"){?>
			<li id="0" class="org_box org_box_select"><span class="org_bot_cor"></span>我的日志</li>
            <li id="1" class="org_box"><span ></span>日志审阅</li>
		<?PHP } else{ ?>
			<li id="0" class="org_box"><span></span>我的日志</li>
            <li id="1" class="org_box org_box_select"><span class="org_bot_cor"></span>日志审阅</li>
		<?PHP }?>
        </ul>
    </div>
    <form id="form1" action="<?php echo U('Home/Office/reportReview');?>" method="post" enctype="multipart/form-data">
    <div class="report_center">
    <input type="hidden" id="showDiv" name="showDiv" value="0"> 
    <input type="hidden" id="searchType" name="searchType" value="1"> 
    <input type="hidden" id="currentPage" name="currentPage" value="<?php echo ($currentPage); ?>" />
    <input type="hidden" id="total" name="total" value="<?php echo ($total); ?>" />
    <input type="hidden" id="pageSize" name="pageSize" value="<?php echo ($pageSize); ?>" />
    <input type="hidden" id="totalPage" name="totalPage" value="<?php echo ($totalPage); ?>" />
        <!--我的日志 -->
        <?PHP if($showDiv=="0"){?>
			<div id="a0" >
		<?PHP } else{ ?>
			<div id="a0"   style="display: none;" >
		<?PHP }?>
            <div class="report_head">
                <span style="display: inline-block;">工作日志&nbsp;>&nbsp;我的日志</span>
				<div class="column">
					<span style="float: left;">筛选：</span>
						<!-- 月时间-->
						<div class="divTime">

							<input type="hidden"  id="selectedDate" name="selectedDate" value=<?php echo ($selectedDate); ?>>
							<input class="bntns" type="button" value="本月" onclick="dateMoveClick(501)"> 
							<input class="bntns" type="button" value="<" onclick="dateMoveClick(502)"> 
							<span id="selectedDate_span" name="selectedDate_span"><?php echo ($selectedDate); ?></span>
							<input class="bntns" type="button" value=">" onclick="dateMoveClick(503)">
						</div>
					<!-- 员工部门-->
					<div class="personmsg">
					<!--
						<input type="search" readonly="true" placeholder=<?php echo ($viewUserDetail_deptName); ?> >
						<span class="fa fa-sitemap fa-lg"></span> 
						<input type="search"  readonly="true" placeholder=<?php echo ($viewUserDetail_name); ?>  > 
						<span class="fa fa-group fa-lg"></span>
						-->
					</div>
					<!-- 按钮-->
					<p
						style="float: right;">
						<input id="searchButton0" class="bntns1" type="button" value="搜索"  onclick="searchSubmit(1)"  style="">
						<!--<input id="addButton0" class="bntns1" type="button" value="新增" onclick="addReport()"  style="background: #00a73c;">-->
					</p>
				</div>
			</div>
			<!--列表-->
			<div class="report_list">
				<table width="100%" cellspacing="0" cellpadding="0" border="0"
					class="TabRili">
					<thead>
						<tr>
							<td>星期日</td>
							<td>星期一</td>
							<td>星期二</td>
							<td>星期三</td>
							<td>星期四</td>
							<td>星期五</td>
							<td>星期六</td>
						</tr>
					</thead>
					<tbody>
					  <?php $__FOR_START_11953__=0;$__FOR_END_11953__=6;for($i=$__FOR_START_11953__;$i < $__FOR_END_11953__;$i+=1){ ?><tr>
							<td id="calBox2" class="calBox">
								<div align="left" id="2015-09-01" calbox="calBox2" class="Num"><?php echo ($days[$i*7+1]['day']); ?></div>
								  <ul class="list" style="cursor: pointer;" >
									<li  title=<?php echo ($days[$i*7+1]["value_t"]); ?> onclick='showDetail(<?php echo ($days[$i*7+1]["id"]); ?>)'><?php echo ($days[$i*7+1]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($weeks[$i*7+1]["value_t"]); ?> onclick='showDetail(<?php echo ($weeks[$i*7+1]["id"]); ?>)'><?php echo ($weeks[$i*7+1]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($month[$i*7+1]["value_t"]); ?> onclick='showDetail(<?php echo ($month[$i*7+1]["id"]); ?>)'><?php echo ($month[$i*7+1]["value"]); ?>&nbsp;</li>
								 </ul>
								 <input  type="hidden"  id="reportID" name="id0" value=<?php echo ($days[$i*7+1]["id"]); ?>>
							</td>
							<td id="calBox2" class="calBox">
								  <div align="left" id="2015-09-01" calbox="calBox2" class="Num"><?php echo ($days[$i*7+2]["day"]); ?></div>
								  <ul class="list"  style="cursor: pointer;" >
									<li  title=<?php echo ($days[$i*7+2]["value_t"]); ?> onclick='showDetail(<?php echo ($days[$i*7+2]["id"]); ?>)'><?php echo ($days[$i*7+2]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($weeks[$i*7+2]["value_t"]); ?> onclick='showDetail(<?php echo ($weeks[$i*7+2]["id"]); ?>)'><?php echo ($weeks[$i*7+2]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($month[$i*7+2]["value_t"]); ?> onclick='showDetail(<?php echo ($month[$i*7+2]["id"]); ?>)'><?php echo ($month[$i*7+2]["value"]); ?>&nbsp;</li>
								 </ul>
								 <input  type="hidden"  id="reportID" name="id0" value=<?php echo ($days[$i*7+2]["id"]); ?>>
							</td>
							<td id="calBox2" class="calBox">
								  <div align="left" id="2015-09-01" calbox="calBox2" class="Num"><?php echo ($days[$i*7+3]["day"]); ?></div>
								  <ul class="list"  style="cursor: pointer;" >
									<li  title=<?php echo ($days[$i*7+3]["value_t"]); ?> onclick='showDetail(<?php echo ($days[$i*7+3]["id"]); ?>)'><?php echo ($days[$i*7+3]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($weeks[$i*7+3]["value_t"]); ?> onclick='showDetail(<?php echo ($weeks[$i*7+3]["id"]); ?>)'><?php echo ($weeks[$i*7+3]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($month[$i*7+3]["value_t"]); ?> onclick='showDetail(<?php echo ($month[$i*7+3]["id"]); ?>)'><?php echo ($month[$i*7+3]["value"]); ?>&nbsp;</li>
								 </ul>
								 <input  type="hidden"  id="reportID" name="id0" value=<?php echo ($days[$i*7+3]["id"]); ?>>
							</td>
							<td id="calBox2" class="calBox">
								  <div align="left" id="2015-09-01" calbox="calBox2" class="Num"><?php echo ($days[$i*7+4]["day"]); ?></div>
								  <ul class="list"  style="cursor: pointer;" >
									<li  title=<?php echo ($days[$i*7+4]["value_t"]); ?> onclick='showDetail(<?php echo ($days[$i*7+4]["id"]); ?>)'><?php echo ($days[$i*7+4]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($weeks[$i*7+4]["value_t"]); ?> onclick='showDetail(<?php echo ($weeks[$i*7+4]["id"]); ?>)'><?php echo ($weeks[$i*7+4]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($month[$i*7+4]["value_t"]); ?> onclick='showDetail(<?php echo ($month[$i*7+4]["id"]); ?>)'><?php echo ($month[$i*7+4]["value"]); ?>&nbsp;</li>
								 </ul>
								 <input  type="hidden"  id="reportID" name="id0" value=<?php echo ($days[$i*7+4]["id"]); ?>>
							</td>
							<td id="calBox2" class="calBox">
								  <div align="left" id="2015-09-01" calbox="calBox2" class="Num"><?php echo ($days[$i*7+5]["day"]); ?></div>
								  <ul class="list"  style="cursor: pointer;" >
									<li  title=<?php echo ($days[$i*7+5]["value_t"]); ?> onclick='showDetail(<?php echo ($days[$i*7+5]["id"]); ?>)'><?php echo ($days[$i*7+5]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($weeks[$i*7+5]["value_t"]); ?> onclick='showDetail(<?php echo ($weeks[$i*7+5]["id"]); ?>)'><?php echo ($weeks[$i*7+5]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($month[$i*7+5]["value_t"]); ?> onclick='showDetail(<?php echo ($month[$i*7+5]["id"]); ?>)'><?php echo ($month[$i*7+5]["value"]); ?>&nbsp;</li>
								 </ul>
								 <input  type="hidden"  id="reportID" name="id0" value=<?php echo ($days[$i*7+5]["id"]); ?>>
							</td>
							<td id="calBox2" class="calBox">
								  <div align="left" id="2015-09-01" calbox="calBox2" class="Num"><?php echo ($days[$i*7+6]["day"]); ?></div>
								  <ul class="list"  style="cursor: pointer;" >
									<li  title=<?php echo ($days[$i*7+6]["value_t"]); ?> onclick='showDetail(<?php echo ($days[$i*7+6]["id"]); ?>)'><?php echo ($days[$i*7+6]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($weeks[$i*7+6]["value_t"]); ?> onclick='showDetail(<?php echo ($weeks[$i*7+6]["id"]); ?>)'><?php echo ($weeks[$i*7+6]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($month[$i*7+6]["value_t"]); ?> onclick='showDetail(<?php echo ($month[$i*7+6]["id"]); ?>)'><?php echo ($month[$i*7+6]["value"]); ?>&nbsp;</li>
								 </ul>
								 <input  type="hidden"  id="reportID" name="id0" value=<?php echo ($days[$i*7+6]["id"]); ?>>
							</td>
							<td id="calBox2" class="calBox">
								  <div align="left" id="2015-09-01" calbox="calBox2" class="Num"><?php echo ($days[$i*7+7]["day"]); ?></div>
								  <ul class="list"  style="cursor: pointer;" >
									<li  title=<?php echo ($days[$i*7+7]["value_t"]); ?> onclick='showDetail(<?php echo ($days[$i*7+7]["id"]); ?>)'><?php echo ($days[$i*7+7]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($weeks[$i*7+7]["value_t"]); ?> onclick='showDetail(<?php echo ($weeks[$i*7+7]["id"]); ?>)'><?php echo ($weeks[$i*7+7]["value"]); ?>&nbsp;</li>
									<br>
									<li  title=<?php echo ($month[$i*7+7]["value_t"]); ?> onclick='showDetail(<?php echo ($month[$i*7+7]["id"]); ?>)'><?php echo ($month[$i*7+7]["value"]); ?>&nbsp;</li>
								 </ul>
								 <input  type="hidden"  id="reportID" name="id0" value=<?php echo ($days[$i*7+7]["id"]); ?>>
							</td>
						</tr><?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<!--工作审阅-->
		<?PHP if($showDiv=="1"){?>
			<div id="a1" >
		<?PHP }else{ ?>
			<div id="a1"   style="display: none;" >
		<?PHP }?>
			<div class="report_head">
				<span style="display: inline-block;">工作日志&nbsp;>&nbsp;日志审阅</span>
				<!--<form id="form1" action="<?php echo U('Home/Office/reportReview');?>" method="post" enctype="multipart/form-data">-->
				<div class="column">
					<span style="float: left;">筛选：</span>
					<input type="hidden" id="li_type" name="li_type" value="li_ri"> 
					<ul>
						<li class="selected" id="li_ri">日</li>
						<li id="li_zhou">周</li>
						<li id="li_yue">月</li>
						<li style="border-right: 1px solid #eaeaea;" id="li_qujian">区间</li>
					</ul>
					<div id="timeChoose">
						<!-- 日时间-->
						<div id="dailyTime" class="divTime">
							<input class="bntns" type="button" value="本日" onclick="dateMoveClick('101')"> 
							<input class="bntns" type="button" value="<" onclick="dateMoveClick('102')"> 
								<span id="ri_span" name="ri_span"><?php echo ($ri_date); ?></span>
								<input type="hidden" id="ri_date" name="ri_date" value=<?php echo ($ri_date); ?>> 
							<input class="bntns" type="button" value=">" onclick="dateMoveClick('103')">
						</div>
						<!--周时间-->
						<div id="weekTime" class="divTime" style="display: none">
							<input class="bntns" type="button" value="本周" onclick="dateMoveClick('201')"> 
							<input class="bntns" type="button" value="<" onclick="dateMoveClick('202')"> 
								<span id="zhouF_span" name="zhouF_span"><?php echo ($zhou_dateF); ?></span>- <span id="zhouT_span" name="zhouT_span"><?php echo ($zhou_dateT); ?></span>
								<input type="hidden" id="zhou_dateF" name="zhou_dateF" value=<?php echo ($zhou_dateF); ?>> 
								<input type="hidden" id="zhou_dateT" name="zhou_dateT" value=<?php echo ($zhou_dateT); ?>> 
								 <input class="bntns" type="button" value=">" onclick="dateMoveClick('203')">
						</div>
						<!-- 月时间-->
						<div id="month_time" class="divTime" style="display: none">
							<input class="bntns" type="button" value="本月" onclick="dateMoveClick('301')"> 
							<input class="bntns" type="button" value="<" onclick="dateMoveClick('302')"> 
							<span id="yue_span" name="yue_span"><?php echo ($yue_date); ?></span>
							<input type="hidden" id="yue_date" name="yue_date" value=<?php echo ($yue_date); ?>> 
							<input class="bntns" type="button" value=">" onclick="dateMoveClick('303')">
						</div>
						<!-- 区间时间-->
						<div id="section" class="divTime" style="display: none">
							<input id="startdate"  name="startdate" class="laydate-icon"  style="width: 100px; height: 25px;" value=<?php echo ($startdate); ?> >
							&nbsp;至&nbsp; 
							<input id="enddate"  name="enddate" class="laydate-icon"   style="width: 100px; height: 25px;" value=<?php echo ($enddate); ?> >
						</div>
					</div>
					<!-- 员工部门-->
					<div class="personmsg">
						<input type="search" id="deptNames"  name = "deptNames" style="text-overflow: ellipsis;white-space:nowrap;overflow:hidden;padding-right:5px;" onclick="selectDepts();" readonly="readonly" placeholder="所属部门" value=<?php echo ($deptNames); ?>> <span class="fa fa-sitemap fa-lg" onclick="selectDepts();"></span> 
						<input type="hidden" id="deptIds"  name = "deptIds" value=<?php echo ($deptIds); ?> >  
						<input type="search" id="userNames"  name = "userNames" style="text-overflow: ellipsis;white-space:nowrap;overflow:hidden;padding-right:5px;" onclick="selectUsers();" readonly="readonly"  placeholder="员工" value=<?php echo ($userNames); ?>> <span class="fa fa-group fa-lg" onclick="selectUsers();"></span>
						<input type="hidden" id="userIds"  name = "userIds" value=<?php echo ($userIds); ?> >
					</div>
					<!-- 按钮-->
					<p
						style="float: left; height: 25px; width: 250px; margin: 12px 0 0 760px;">
						<input id="searchButton1" class="bntns1" type="button" value="搜索" onclick="searchSubmit('4')">
						<input id="resetButton1" class="bntns1" type="button" value="清空" onclick="cleanButton('4')">
						<!--<input id="exprotButton" class="bntns1" type="button" value="导出">-->
					</p>
				</div>
				<!--</form>-->
			</div>
			<!--列表-->
			<div class="report_list">
				<div class="title">
					<ul>
						<li style="width: 10%">日志类型</li>
						<li style="width: 15%">日志人</li>
						<li style="width: 45%">内容</li>
						<li style="width: 15%">时间</li>
						<li style="width: 15%">状态</li>
					</ul>
				</div>
				<div class="contentList">
				<?php if(is_array($getCheckWorkReportList_list)): $i = 0; $__LIST__ = $getCheckWorkReportList_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
				        <li style="width: 10%"><?php echo ($vo['type']); ?></li>
                        <li style="width: 15%"><?php echo ($vo['createPerple']); ?></li>
                        <li style="width: 45%;cursor: pointer;" title="<?php echo ($vo['content_title']); ?>" onclick="showReviewDetail(<?php echo ($vo['reportId']); ?>)"><a><?php echo ($vo['content']); ?></a></li>
                        <li style="width: 15%"><?php echo ($vo['title']); ?></li>
                        <li style="width: 15%"><?php echo ($vo['state']); ?></li>
                	</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php if(empty($getCheckWorkReportList_list)): ?><ul><li style="width: 100%;color:#f47469;">无数据!</li></ul><?php endif; ?>
            </div>
            <div id="pagebar" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA">
				</div>
			</div>
		</div>
	</div>
</form>
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

 
 
 
<script>
	//新增日志
	function addReport(){
		layer.open({
			type:2,
			title :['新增日志','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
			area: ['900px', '505px'],
			shadeClose: false, //点击遮罩关闭
			content: APP+'/Home/Office/addReport'
		});
	}

	//我的日志详情
	function showDetail(reportID) {
		if(reportID == "") {
			return false;
		}
		
		layer.open({
			type:2,
			title :['日志详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
			area: ['700px', '400px'],
			shadeClose: false, //点击遮罩关闭
			content: APP+'/Home/Office/showReport?reportID='+reportID
		});
	}

	//日志审阅详情
	function showReviewDetail(reportID) {
		layer.open({
			type:2,
			title :['日志审阅详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
			area: ['700px', '400px'],
			shadeClose: false, //点击遮罩关闭
			content: APP+'/Home/Office/showReportReviewDetail?reportID='+reportID
		});
	}

	function cleanButton(idValue){
		document.getElementById("deptNames").value = "";
		document.getElementById("deptIds").value = "";
		document.getElementById("userNames").value = "";
		document.getElementById("userIds").value = "";
	}
	
	//选择用户
    function selectUsers() {
        var userNames = $("#userNames").val();
        var userIds = $("#userIds").val();
        layer.open({
            type:2,
            title :['选择用户','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '400px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectUsers');?>" + "?userNames=" + userNames + "&userIds=" + userIds,
        });
    }

	//选择部门
    function selectDepts() {
        var deptNames = $("#deptNames").val();
        var deptIds = $("#deptIds").val();
        layer.open({
            type:2,
            title :['选择部门','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['400px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectDepts');?>" + "?deptNames=" + deptNames + "&deptIds=" + deptIds,
        });
    }
    
	//点击前一日按钮
	function dateMoveClick(idValue) {
		//本日
		if (idValue ==101){
			document.getElementById("ri_date").value = new Date().Format("yyyy-MM-dd")
			document.getElementById("ri_span").innerHTML=document.getElementById("ri_date").value
			//alert (document.getElementById("ri_date").value)
		}
		//前一日
		if (idValue ==102){
			var curDate =document.getElementById("ri_date").value;
		    curDate = new Date(Date.parse(curDate.replace(/-/g, "/")));  
		    var preDate = new Date(curDate.getTime() - 24*60*60*1000);  //前一天
		    document.getElementById("ri_date").value = preDate.Format("yyyy-MM-dd")
		    document.getElementById("ri_span").innerHTML=document.getElementById("ri_date").value
		    //alert (document.getElementById("ri_date").value)
		}
		//后一日
		if (idValue ==103){
			var curDate =document.getElementById("ri_date").value;
		    curDate = new Date(Date.parse(curDate.replace(/-/g, "/")));  
		    var nextDate = new Date(curDate.getTime() + 24*60*60*1000);  //后一天
		    document.getElementById("ri_date").value = nextDate.Format("yyyy-MM-dd")
		    document.getElementById("ri_span").innerHTML=document.getElementById("ri_date").value
		    //alert (document.getElementById("ri_date").value)
		}
		
		//本周
		if (idValue ==201){
			var weekDay = new Date().getDay();
			var fromDate = new Date(new Date().getTime() - weekDay*24*60*60*1000);  //后一天
			var toDate = new Date(new Date().getTime() + (6-weekDay)*24*60*60*1000);  //后一天
			document.getElementById("zhou_dateF").value = fromDate.Format("yyyy-MM-dd")
			document.getElementById("zhou_dateT").value = toDate.Format("yyyy-MM-dd")
			document.getElementById("zhouF_span").innerHTML=fromDate.Format("yyyy-MM-dd")
			document.getElementById("zhouT_span").innerHTML=toDate.Format("yyyy-MM-dd")
		}
		//前一周 zhou_dateF
		if (idValue ==202){ 
			var oldFromDate =document.getElementById("zhou_dateF").value;
			var oldToDate =document.getElementById("zhou_dateT").value;
			oldFromDate = new Date(Date.parse(oldFromDate.replace(/-/g, "/")));  
			oldToDate = new Date(Date.parse(oldToDate.replace(/-/g, "/"))); 
			var weekDay = new Date().getDay();
			var fromDate = new Date(oldFromDate.getTime() - 7*24*60*60*1000);  //后一天
			var toDate = new Date(oldToDate.getTime() - 7*24*60*60*1000);  //后一天
			document.getElementById("zhou_dateF").value = fromDate.Format("yyyy-MM-dd")
			document.getElementById("zhou_dateT").value = toDate.Format("yyyy-MM-dd")
			document.getElementById("zhouF_span").innerHTML=fromDate.Format("yyyy-MM-dd")
			document.getElementById("zhouT_span").innerHTML=toDate.Format("yyyy-MM-dd")
		}
		//后一周
		if (idValue ==203){
			var oldFromDate =document.getElementById("zhou_dateF").value;
			var oldToDate =document.getElementById("zhou_dateT").value;
			oldFromDate = new Date(Date.parse(oldFromDate.replace(/-/g, "/")));  
			oldToDate = new Date(Date.parse(oldToDate.replace(/-/g, "/"))); 
			var weekDay = new Date().getDay();
			var fromDate = new Date(oldFromDate.getTime() + 7*24*60*60*1000);  //后一天
			var toDate = new Date(oldToDate.getTime() + 7*24*60*60*1000);  //后一天
			document.getElementById("zhou_dateF").value = fromDate.Format("yyyy-MM-dd")
			document.getElementById("zhou_dateT").value = toDate.Format("yyyy-MM-dd")
			document.getElementById("zhouF_span").innerHTML=fromDate.Format("yyyy-MM-dd")
			document.getElementById("zhouT_span").innerHTML=toDate.Format("yyyy-MM-dd")
		}
		
		//本月
		if (idValue ==301){
			document.getElementById("yue_date").value = new Date().Format("yyyy-MM")
			document.getElementById("yue_span").innerHTML=document.getElementById("yue_date").value
			//alert (document.getElementById("ri_date").value)
		}
		//前一月
		if (idValue ==302){
			strDate = document.getElementById("yue_date").value+"-01"
			now = new Date(strDate.replace(/\-/g,"/"));
			perMonth =new Date( now.setMonth(now.getMonth() - 1));
			//alert (perMonth.Format("yyyy-MM"));
			document.getElementById("yue_date").value = perMonth.Format("yyyy-MM");
			document.getElementById("yue_span").innerHTML=perMonth.Format("yyyy-MM");
		}
		//后一月
		if (idValue ==303){
			strDate = document.getElementById("yue_date").value+"-01"
			now = new Date(strDate.replace(/\-/g,"/"));
			perMonth =new Date( now.setMonth(now.getMonth() + 1));
			//alert (perMonth.Format("yyyy-MM"));
			document.getElementById("yue_date").value = perMonth.Format("yyyy-MM");
			document.getElementById("yue_span").innerHTML=perMonth.Format("yyyy-MM");
		}
		//区间 startdate
		if (idValue ==401){
			var weekDay = new Date().getDay();
			var fromDate = new Date(new Date().getTime() - weekDay*24*60*60*1000);  //后一天
			var toDate = new Date(new Date().getTime() + (6-weekDay)*24*60*60*1000);  //后一天
			document.getElementById("startdate").value=fromDate.Format("yyyy-MM-dd")
			document.getElementById("enddate").value=toDate.Format("yyyy-MM-dd")
		}
		
		//本月
		if (idValue ==301){
			document.getElementById("yue_date").value = new Date().Format("yyyy-MM")
			document.getElementById("yue_span").innerHTML=document.getElementById("yue_date").value
			//alert (document.getElementById("ri_date").value)
		}
		//本月    我的日志
		if (idValue ==501){
			document.getElementById("selectedDate").value = new Date().Format("yyyy-MM");
			document.getElementById("selectedDate_span").innerHTML=document.getElementById("selectedDate").value;
		}
		//前一月  我的日志
		if (idValue ==502){
			strDate = document.getElementById("selectedDate").value+"-01"
			now = new Date(strDate.replace(/\-/g,"/"));
			perMonth =new Date( now.setMonth(now.getMonth() - 1));
			//alert (perMonth.Format("yyyy-MM"));
			document.getElementById("selectedDate").value = perMonth.Format("yyyy-MM");
			document.getElementById("selectedDate_span").innerHTML=perMonth.Format("yyyy-MM");
		}
		//后一月  我的日志
		if (idValue ==503){
			strDate = document.getElementById("selectedDate").value+"-01"
			now = new Date(strDate.replace(/\-/g,"/"));
			perMonth =new Date( now.setMonth(now.getMonth() + 1));
			//alert (perMonth.Format("yyyy-MM"));
			document.getElementById("selectedDate").value = perMonth.Format("yyyy-MM");
			document.getElementById("selectedDate_span").innerHTML=perMonth.Format("yyyy-MM");
		}
	}

	function searchSubmit(searchTypeValue) {
		if(searchTypeValue == '4') {
			document.getElementById("showDiv").value = '1';
		} else {
			document.getElementById("showDiv").value = '0';
		}
		var searchType = document.getElementById('searchType');
		searchType.value = searchTypeValue;
		document.getElementById('form1').submit();
	}

	$(function() {
		Cookie.eraseCookie("bigMenuIndex");
		Cookie.eraseCookie("smallMenuIndex");
		Cookie.createCookie("bigMenuIndex", 0);
		Cookie.createCookie("smallMenuIndex", 3);

		var start = {
			elem : '#startdate',
			format : 'YYYY-MM-DD',
			min : laydate.now(-365*10), //设定最小日期为当前日期
			max : laydate.now(), //最大日期
			//istime: true,
			istoday : false,
			choose : function(datas) {
				end.min = datas; //开始日选好后，重置结束日的最小日期
				end.start = datas //将结束日的初始值设定为开始日
			}
		};
		var end = {
			elem : '#enddate',
			format : 'YYYY-MM-DD',
			min : laydate.now(-365*10),
			max : laydate.now(+10),
			//istime: true,
			istoday : false,
			choose : function(datas) {
				start.max = datas; //结束日选好后，重置开始日的最大日期
			}
		};
		laydate(start);
		laydate(end);
	})

	//    菜单轮换点击事件
	$(".column li").click(function() {
		var index = $(".column li").index($(this));
		$(this).addClass("selected").siblings().removeClass("selected");
		$divList = $("#timeChoose").children("div");
		$divList.hide();
		$divList.eq(index).show();
		if (index == 0) {
			var li_tp = document.getElementById("li_type")
			li_tp.value="li_ri";
			//alert (document.getElementById("li_type").value);
		}
		if (index == 1) {
			var li_tp = document.getElementById("li_type")
			li_tp.value="li_zhou";
			//alert (document.getElementById("li_type").value);
		}
		if (index == 2) {
			var li_tp = document.getElementById("li_type")
			li_tp.value="li_yue";
			//alert (document.getElementById("li_type").value);
		}
		if (index == 3) {
			var li_tp = document.getElementById("li_type")
			li_tp.value="li_qujian";
			//alert (document.getElementById("li_type").value);
		}
	})

	$('#bigmenu li').click(function() {
		//$("#business_success_page").empty();
		var lilen = $('#bigmenu li').length;
		$('#bigmenu li').removeClass('org_box org_box_select');
		$('#bigmenu li span').removeClass('org_bot_cor');
		$('#bigmenu li').attr('class', 'org_box');
		//$(this).children().addClass('org_bot_cor');
		$(this).attr('class', 'org_box  org_box_select');
		$(this).children('span').attr('class', 'org_bot_cor');
		for (var i = 0; i < lilen; i++) {
			$('#a' + i).hide();
			if ($(this).index() == i) {
				$('#a' + i).show();
			}
		}
		if ($(this).index() == 1) {
			var showDiv = document.getElementById("showDiv")
			showDiv.value="1";
		}else{
			var showDiv = document.getElementById("showDiv")
			showDiv.value="0";
		}

		changeLi(document.getElementById("showDiv").value);
	});
	
	var showDiv =  '<?php echo $showDiv;?>';
	var li_typeValue = '<?php echo $li_type;?>';
	var yue_date =  '<?php echo $yue_date;?>';
	if (yue_date==""){
		dateMoveClick(101);
		dateMoveClick(201);
		dateMoveClick(301);
		dateMoveClick(401);
	}
	
    function createPageBar(t,ps,p,tp) {
		total = document.getElementById("total").value;   //总记录数
		pageSize = document.getElementById("pageSize").value;   //每页显示条数
		page = document.getElementById("currentPage").value;  //当前页
		totalPage = document.getElementById("totalPage").value;  //总页数
        getPageBar1("pagebar");
    }
    
    $(document).on('click','#pagebar span a',function(){
        var rel = $(this).attr("rel");
        document.getElementById("currentPage").value=rel;
		//alert(document.getElementById("currentPage").value);
		searchSubmit(9);
    });
	// document.getElementById(showDiv).click();
	document.getElementById(li_typeValue).click();
	//createPageBar('<?php echo ($getNoticeList_total); ?>', '<?php echo ($getNoticeList_pageSize); ?>', '<?php echo ($getNoticeList_page); ?>', '<?php echo ($getNoticeList_totalPage); ?>');
	createPageBar();

	function changeLi(showDiv) {
		if(showDiv == 0) {
			searchSubmit(1);
		} else {
			searchSubmit(4);
		}
	}
</script>
</body>
</html>