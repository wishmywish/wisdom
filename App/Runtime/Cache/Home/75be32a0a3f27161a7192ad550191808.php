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

        .divide-line {
            position: absolute;
            right: 165px;
            top: 12px;
            width: 0;
            font-size: 0;
            height: 25px;
            border-right: #04c3e0 1px solid;
            }
            .cp_set{
                float: right;
                right: 178px;
                cursor: pointer;
                position: absolute;
                width: 80px;
                height: 30px;
                top: 10px;
                line-height: 30px;
                text-align: center;
            }
            .cp_set:hover{
                background-color: rgba(4, 195, 224,0.5);
                color:#ffff00;
            }
        </style>
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
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
            <div class="head_center" style="position: relative;">

                <div class="logo">
                    <?php if($imgurl != ''): ?><img style="height: 30px;margin-top: 8px;" src="/wisdom/Public/upfile/<?php echo ($imgurl); ?>" ><?php endif; ?>

                </div>

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
                <span class="cp_set" onclick="location.href = APP+'/Admin/Companyset/index'">企业资料维护</span>
                <b class="divide-line"></b>
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
    <!--<div class="index_left">-->
        <!--<div class='org_box org_box_select' onclick="searchSubmit(false);">-->
            <!--<span class='org_bot_cor'></span>-->
            <!--考勤报表-->
        <!--</div>-->
    <!--</div>-->
    <div id="rev_menu_left" class="class_menu_left" style="margin-right: 20px;">
        <ul id="bigmenu">
            <li id="0" class="org_box org_box_select" onclick="searchSubmit(false);"><span class="org_bot_cor"></span>考勤报表</li>
            <li id="1" class="org_box" onclick="getqueryGPSTypeAddList(1);"><span ></span>地址管理</li>
        </ul>
    </div>
    <div class="check_center">
        <!--考勤报表-->
        <div id="a0">
            <div class="check_head">
                <span style="display: inline-block;">签到&nbsp;>&nbsp;考勤报表</span>
                <input type="hidden" id="old_li_type" value="<?php echo ($li_type); ?>" />
                <input type="hidden" id="old_ri_date" value="<?php echo ($ri_date); ?>" />
                <input type="hidden" id="old_zhou_dateF" value="<?php echo ($zhou_dateF); ?>" />
                <input type="hidden" id="old_zhou_dateT" value="<?php echo ($zhou_dateT); ?>" />
                <input type="hidden" id="old_yue_date" value="<?php echo ($yue_date); ?>" />
                <input type="hidden" id="old_startdate" value="<?php echo ($startdate); ?>" />
                <input type="hidden" id="old_enddate" value="<?php echo ($enddate); ?>" />
                <input type="hidden" id="old_deptNames" value="<?php echo ($deptNames); ?>" />
                <input type="hidden" id="old_deptIds" value="<?php echo ($deptIds); ?>" />
                <input type="hidden" id="old_userNames" value="<?php echo ($userNames); ?>" />
                <input type="hidden" id="old_userIds" value="<?php echo ($userIds); ?>" />
                <form id="form1" action="<?php echo U('Home/Office/checking');?>" method="post">
                    <div class="column">
                        <span style="float: left;">筛选：</span>
                        <input type="hidden" id="li_type" name="li_type" value="li_ri" />
                        <input type="hidden" id="currentPage" name="page" value="1" />
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
                                <input type="hidden" id="ri_date" name="ri_date" value="<?php echo ($ri_date); ?>">
                                <input class="bntns" type="button" value=">" onclick="dateMoveClick('103')"></div>
                            <!--周时间-->
                            <div id="weekTime" class="divTime" style="display: none">
                                <input class="bntns" type="button" value="本周" onclick="dateMoveClick('201')">
                                <input class="bntns" type="button" value="<" onclick="dateMoveClick('202')">
                                <span id="zhouF_span" name="zhouF_span"><?php echo ($zhou_dateF); ?></span>
                                -
                                <span id="zhouT_span" name="zhouT_span"><?php echo ($zhou_dateT); ?></span>
                                <input type="hidden" id="zhou_dateF" name="zhou_dateF" value="<?php echo ($zhou_dateF); ?>">
                                <input type="hidden" id="zhou_dateT" name="zhou_dateT" value="<?php echo ($zhou_dateT); ?>">
                                <input class="bntns" type="button" value=">" onclick="dateMoveClick('203')"></div>
                            <!-- 月时间-->
                            <div id="month_time" class="divTime" style="display: none">
                                <input class="bntns" type="button" value="本月" onclick="dateMoveClick('301')">
                                <input class="bntns" type="button" value="<" onclick="dateMoveClick('302')">
                                <span id="yue_span" name="yue_span"><?php echo ($yue_date); ?></span>
                                <input type="hidden" id="yue_date" name="yue_date" value="<?php echo ($yue_date); ?>">
                                <input class="bntns" type="button" value=">" onclick="dateMoveClick('303')"></div>
                            <!-- 区间时间-->
                            <div id="section" class="divTime" style="display: none">
                                <input id="startdate"  name="startdate" class="laydate-icon"  style="width: 100px; height: 25px;" value="<?php echo ($startdate); ?>" >
                                &nbsp;至&nbsp;
                                <input id="enddate"  name="enddate" class="laydate-icon"   style="width: 100px; height: 25px;" value="<?php echo ($enddate); ?>" ></div>
                        </div>
                        <!-- 员工部门-->
                        <div class="personmsg">
                            <input type="search" id="deptNames" readonly="readonly" name = "deptNames" style="text-overflow: ellipsis;white-space:nowrap;overflow:hidden;padding-right:5px;" placeholder="所属部门" value="<?php echo ($deptNames); ?>" >
                            <span class="fa fa-sitemap fa-lg" onclick="selectDepts();"></span>
                            <input type="hidden" id="deptIds"  name = "deptIds"  value="<?php echo ($deptIds); ?>">
                            <input type="search" id="userNames" readonly="readonly" name = "userNames" style="text-overflow: ellipsis;white-space:nowrap;overflow:hidden;padding-right:5px;"  placeholder="员工" value="<?php echo ($userNames); ?>" >
                            <span class="fa fa-group fa-lg" onclick="selectUsers();"></span>
                            <input type="hidden" id="userIds"  name = "userIds"  value="<?php echo ($userIds); ?>"></div>
                        <!-- 按钮-->
                        <p style="float: left;height: 25px;width: 250px;margin: 12px 0 0 677px;">
                            <input id="searchButton1" class="bntns1" type="button" value="搜索" onclick="searchSubmit(true)" />
                            <input id="resetButton1" class="bntns1" type="button" value="清空" onclick="cleanButton()" />
                            <input id="exprotButton" class="bntns1" type="button" value="导出" />
                        </p>
                    </div>
                </form>
            </div>
            <!--列表-->
            <div class="check_list">
                <div class="title">
                    <ul>
                        <li style="width: 15%;">员工</li>
                        <li style="width: 25%;">所属部门</li>
                        <li style="width: 20%;">签到地址</li>
                        <li style="width: 20%;">签到时间</li>
                        <li style="width: 10%;">签到类型</li>
                        <li style="width: 10%;">操作</li>
                    </ul>
                </div>
                <div class="contentList">
                    <?php if(is_array($getWorkSignList_list)): $i = 0; $__LIST__ = $getWorkSignList_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
                            <li style="width: 15%;"><?php echo ($vo['userName']); ?></li>
                            <li style="width: 25%;" title="<?php echo ($vo["deptName"]); ?>"><?php echo ($vo['deptName']); ?></li>
                            <li style="width: 20%;" title="<?php echo ($vo["addressName"]); ?>"><?php echo ($vo['addressName']); ?></li>
                            <li style="width: 20%;"><?php echo ($vo['checkinTime']); ?></li>
                            <li style="width: 10%;">
                                <?php if($vo['checkinType'] == 4): ?>上班
                                    <?php elseif($vo['checkinType'] == 5): ?>
                                    下班<?php endif; ?>
                            </li>
                            <li style="width: 10%;">
                                <img style="width: 18px;cursor: pointer;" src="/wisdom/Public/Home/Default/images/response.png"></li>
                        </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php if(empty($getWorkSignList_list)): ?><ul><li style="width: 100%;color:#f47469;">无数据!</li></ul><?php endif; ?>
                </div>
                <div id="pagebar" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA"></div>
            </div>
        </div>
        <div id="a1" style="display: none;">
            <div class="check_head1">
                <span style="display: inline-block;">签到&nbsp;>&nbsp;地址管理</span>
                <div class="column">
                    <!-- 按钮-->
                    <p style="height: 25px;margin: 0 10px 0 0;float: right;"><input id="" class="bntns bntns1"  type="button" onclick="location='<?php echo U('Office/addressAdd');?>'" value="新增"></p>
                </div>
            </div>
            <!--列表-->
            <div class="check_list">
                <div class="title">
                    <ul>
                        <li style="width: 5%;">序号</li>
                        <li style="width: 20%;">名称</li>
                        <li style="width: 35%;">地址</li>
                        <li style="width: 20%;">允许偏移距离（米）</li>
                        <li style="width: 5%;">状态</li>
                        <!--<li style="width: 15%;">创建时间</li>-->
                        <li style="width: 15%;">操作</li>
                    </ul>
                </div>
                <div id="" class="contentList">
					<div id="queryGPSTypeAddList">
                    <?php if(!empty($queryGPSTypeAddList_list)): if(is_array($queryGPSTypeAddList_list)): $i = 0; $__LIST__ = $queryGPSTypeAddList_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><ul>
                            <li style="width: 5%;"><?php echo ($list["orderNo"]); ?></li>
                            <li style="width: 20%;" title="<?php echo ($list["name"]); ?>"><?php echo ($list["name"]); ?>&nbsp;</li>
                            <li style="width: 35%;" title="<?php echo ($list["address"]); ?>"><?php echo ($list["address"]); ?>&nbsp;</li>
                            <li style="width: 20%;" title="<?php echo ($list["checkDistance"]); ?>"><?php echo ($list["checkDistance"]); ?>&nbsp;</li>
                            <li style="width: 5%;" id="opt_invalid_<?php echo ($list["id"]); ?>"><?php if($list["invalidFlag"] == 1): ?>正常<?php else: ?>作废<?php endif; ?></li>
                            <li style="width: 15%;"></li>
                            <li id="" style="width: 15%;">
                            	<?php if($list["invalidFlag"] == 1): ?><i id="opt_invalid_<?php echo ($list["id"]); ?>_<?php echo ($list["invalidFlag"]); ?>" rel="0" style="color:#00a73c;padding-left: 10px;" class="fa fa-reply" title="作废" onclick="doinvalid('<?php echo ($list["id"]); ?>',2,'<?php echo ($list["invalidFlag"]); ?>');"></i><?php else: ?><i id="opt_invalid_<?php echo ($list["id"]); ?>_<?php echo ($list["invalidFlag"]); ?>" rel="1" style="color:#00a73c;padding-left: 10px;" class="fa fa-reply" title="取消作废"  onclick="doinvalid('<?php echo ($list["id"]); ?>',3,'<?php echo ($list["invalidFlag"]); ?>');"></i><?php endif; ?>
                                <i style="color: #4f88b5;cursor: pointer;padding-left: 10px;" class="fa fa-edit" onclick="editqueryGPSTypeAdd('<?php echo ($list["id"]); ?>');" title="编辑"></i>
                                <i style="color:#de2e2f;padding-left: 10px;cursor: pointer;" class="fa fa-trash" onclick="deleteGPSTypeAddDetail('<?php echo ($list["id"]); ?>');" title="删除"></i>
                              </li>
                            </li>
                        </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if(empty($queryGPSTypeAddList_list)): ?><ul><li style="width: 100%;color:#f47469;">暂无数据，请创建地址!</li></ul><?php endif; ?>
                    </div>
                </div>
                <div id="pagebar1" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA"></div>
                <input type="hidden" id="page1" value="1">
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

 
 
 
<script>
    $(function(){
        Cookie.eraseCookie("bigMenuIndex");
        Cookie.eraseCookie("smallMenuIndex");
        Cookie.createCookie("bigMenuIndex",0);
        Cookie.createCookie("smallMenuIndex",5);
        var start = {
            elem: '#startdate',
            format: 'YYYY-MM-DD',
            min: '2000-01-01', //设定最小日期为当前日期
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end.min = datas; //开始日选好后，重置结束日的最小日期
                end.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end = {
            elem: '#enddate',
            format: 'YYYY-MM-DD',
            min: '2000-01-01',
            max: laydate.now(),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        laydate(start);
        laydate(end);

        createPageBar('<?php echo ($getWorkSignList_total); ?>', '<?php echo ($getWorkSignList_pageSize); ?>', '<?php echo ($getWorkSignList_page); ?>', '<?php echo ($getWorkSignList_totalPage); ?>');

        $(document).on('click','#pagebar span a', function(){
            $("#currentPage").val($(this).attr("rel"));
            $("#li_type").val($("#old_li_type").val());
            $("#ri_date").val($("#old_ri_date").val());
            $("#zhou_dateF").val($("#old_zhou_dateF").val());
            $("#zhou_dateT").val($("#old_zhou_dateT").val());
            $("#yue_date").val($("#old_yue_date").val());
            $("#startdate").val($("#old_startdate").val());
            $("#enddate").val($("#old_enddate").val());
            $("#deptNames").val($("#old_deptNames").val());
            $("#deptIds").val($("#old_deptIds").val());
            $("#userNames").val($("#old_userNames").val());
            $("#userIds").val($("#old_userIds").val());
            searchSubmit(false);
        });
 
        createPageBar1('<?php echo ($queryGPSTypeAddList_total); ?>', '<?php echo ($queryGPSTypeAddList_pageSize); ?>', '<?php echo ($queryGPSTypeAddList_page); ?>', '<?php echo ($queryGPSTypeAddList_totalPage); ?>');
        $(document).on('click','#pagebar1 span a', function() {
            $("#page1").val($(this).attr("rel"));
            getqueryGPSTypeAddList($(this).attr("rel"));
        });
        
        if ("<?php echo ($yue_date); ?>" == "") {
            dateMoveClick(101);
            dateMoveClick(201);
            dateMoveClick(301);
            dateMoveClick(401);
        }
    });

    // 菜单轮换点击事件
    $(".column li").click(function () {
        var index = $(".column li").index($(this));
        $(this).addClass("selected").siblings().removeClass("selected");
        $divList = $("#timeChoose").children("div");
        $divList.hide();
        $divList.eq(index).show();

        if (index == 0) {
            var li_tp = document.getElementById("li_type")
            li_tp.value="li_ri";
        }
        if (index == 1) {
            var li_tp = document.getElementById("li_type")
            li_tp.value="li_zhou";
        }
        if (index == 2) {
            var li_tp = document.getElementById("li_type")
            li_tp.value="li_yue";
        }
        if (index == 3) {
            var li_tp = document.getElementById("li_type")
            li_tp.value="li_qujian";
        }
    });

    var returnFlag = '<?php echo ($return); ?>';
    $('#bigmenu li').removeClass('org_box org_box_select');
    $('#bigmenu li span').removeClass('org_bot_cor');
    $('#bigmenu li').attr('class','org_box');
    $('#bigmenu #'+returnFlag).attr('class','org_box  org_box_select');
    $('#bigmenu #'+returnFlag).children('span').attr('class','org_bot_cor');
    for(var i = 0; i < 2; i++) {
        $('#a'+i).hide();
        if(returnFlag == i){
            $('#a'+i).show();
        }
    }

    function cleanButton(){
        $("#deptNames").val("");
        $("#deptIds").val("");
        $("#userNames").val("");
        $("#userIds").val("");
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
        }
        //前一日
        if (idValue ==102){
            var curDate =document.getElementById("ri_date").value;
            curDate = new Date(Date.parse(curDate.replace(/-/g, "/")));  
            var preDate = new Date(curDate.getTime() - 24*60*60*1000);  //前一天
            document.getElementById("ri_date").value = preDate.Format("yyyy-MM-dd")
            document.getElementById("ri_span").innerHTML=document.getElementById("ri_date").value
        }
        //后一日
        if (idValue ==103){
            var curDate =document.getElementById("ri_date").value;
            curDate = new Date(Date.parse(curDate.replace(/-/g, "/")));  
            var nextDate = new Date(curDate.getTime() + 24*60*60*1000);  //后一天
            document.getElementById("ri_date").value = nextDate.Format("yyyy-MM-dd")
            document.getElementById("ri_span").innerHTML=document.getElementById("ri_date").value
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
        //本月    我的报告
        if (idValue ==501){
            document.getElementById("selectedDate").value = new Date().Format("yyyy-MM")
            document.getElementById("selectedDate_span").innerHTML=document.getElementById("yue_date").value
        }
        //前一月  我的报告
        if (idValue ==502){
            strDate = document.getElementById("selectedDate").value+"-01"
            now = new Date(strDate.replace(/\-/g,"/"));
            perMonth =new Date( now.setMonth(now.getMonth() - 1));
            //alert (perMonth.Format("yyyy-MM"));
            document.getElementById("selectedDate").value = perMonth.Format("yyyy-MM");
            document.getElementById("selectedDate_span").innerHTML=perMonth.Format("yyyy-MM");
        }
        //后一月  我的报告
        if (idValue ==503){
            strDate = document.getElementById("selectedDate").value+"-01"
            now = new Date(strDate.replace(/\-/g,"/"));
            perMonth =new Date( now.setMonth(now.getMonth() + 1));
            //alert (perMonth.Format("yyyy-MM"));
            document.getElementById("selectedDate").value = perMonth.Format("yyyy-MM");
            document.getElementById("selectedDate_span").innerHTML=perMonth.Format("yyyy-MM");
        }
        
    }
    $('#bigmenu li').click(function(){
        //$("#business_success_page").empty();
        var lilen = $('#bigmenu li').length;
        $('#bigmenu li').removeClass('org_box org_box_select');
        $('#bigmenu li span').removeClass('org_bot_cor');
        $('#bigmenu li').attr('class','org_box');
        //$(this).children().addClass('org_bot_cor');
        $(this).attr('class','org_box  org_box_select');
        $(this).children('span').attr('class','org_bot_cor');
        for(var i=0;i<lilen;i++){
            $('#a'+i).hide();
            if($(this).index()==i){
                $('#a'+i).show();
            }
        }
    });
    
    function getqueryGPSTypeAddList(page) {
         var loadIdx = layer.load(0);
         $("#queryGPSTypeAddList").empty();
         $.post("<?php echo U('Office/queryGPSTypeAddList');?>", {"page":page}, function(data) {
        	 if (!("list" in data)) {
                 layer.close(loadIdx);
                 layer.msg(data.error_text,{icon: 8});
                 return;
             }
        	 var content = "";
        		// 设定用户列表
        	  $.each(data.list, function(k, v) {
        		  content += '<ul>';
                  content += '<li style="width: 5%;">'+ v.orderNo +'</li>';
                  content += '<li style="width: 20%;" title="'+ v.name +'">'+ v.name +'&nbsp;</li>';
                  content += '<li style="width: 35%;" title="'+ v.address +'">'+ v.address +'&nbsp;</li>';
                  content += '<li style="width: 20%;" title="'+ v.checkDistance +'">'+ v.checkDistance +'&nbsp;</li>';
                  if (v.invalidFlag == 1) {
                      content += '<li style="width: 5%;" id="opt_invalid_' + v.id + '">正常</i>';
                  } else {
                      content += '<li style="width: 5%;" id="opt_invalid_' + v.id + '">作废</i>';
                  }
                  content += '<li style="width: 15%;"></li>';
                  content += '<li id="" style="width: 15%;">';
                  if (v.invalidFlag == 1) {
                      content += '<i id="opt_invalid_'+ v.id +'_'+ v.invalidFlag +'" rel="0" style="color:#00a73c;padding-left: 10px;" class="fa fa-reply" title="作废" onclick="doinvalid(\''+ v.id +'\',2,\''+ v.invalidFlag +'\');"></i>';
                  } else {
                      content += '<i id="opt_invalid_'+ v.id +'_'+ v.invalidFlag +'" rel="1" style="color:#00a73c;padding-left: 10px;" class="fa fa-reply" title="取消作废"  onclick="doinvalid(\''+ v.id +'\',3,\''+ v.invalidFlag +'\');"></i>';
                  }
                  content += '<i style="color: #4f88b5;cursor: pointer;padding-left: 10px;" class="fa fa-edit" onclick="editqueryGPSTypeAdd(\''+ v.id +'\');" title="编辑"></i>';
                  content += '<i style="color:#de2e2f;padding-left: 10px;cursor: pointer;" class="fa fa-trash" onclick="deleteGPSTypeAddDetail(\''+ v.id +'\');" title="删除"></i>';
                  content += '</li></li>';
                  content += '</ul>';
        	  }); 
        		if (content == "") {
                  content += '<ul>';
                  content += '<li style="width:100%;color:#f47469;">无数据!</li>';
                  content += '</ul>';
        		}
        		$("#queryGPSTypeAddList").append(content);
                createPageBar1(data.total, data.pageSize, data.page, data.totalPage);
                layer.close(loadIdx);
             }, 'json'); 
      }
   
    function searchSubmit(searchFlag) {
        if (searchFlag) {
            $("#currentPage").val("1");
        }
    document.getElementById('form1').submit();
    }

    function createPageBar(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar");
    }
    
    function createPageBar1(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        $("#page1").val(page);
        getPageBar1("pagebar1");
    }
    
    function deleteGPSTypeAddDetail(id) {
        if(!confirm("确定删除该条地址？")){
            return false;
        }
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/deleteGPSTypeAddDetail');?>", {'id':id, 'type':1}, function(data) {
            layer.close(loadIdx);
            if (data.error_code == "success") {
            	layer.msg("删除成功！");
            	getqueryGPSTypeAddList(1);
            } else if (data.error_code == "101012") {
                layer.msg(data.error_text,{icon: 8});
            } else {
                layer.msg("删除失败",{icon: 8});
            }
        }, 'json');
    }
    
    function editqueryGPSTypeAdd(id) {
        var url = APP+'/Home/Office/addressEdit?id='+id;
        window.location.href = url;
    }
    
    function doinvalid(id,type,invalidFlag) {
        var isinvalidFlag = parseInt($("#opt_invalid_" + id + "_" + invalidFlag).attr("rel"));
        var title = (isinvalidFlag == 1) ? '取消作废' : '作废';
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/deleteGPSTypeAddDetail');?>", {'id':id, 'type':type}, function(data) {
            layer.close(loadIdx);
            if (data.error_code == "success") {
                layer.msg("成功！");

                if (isinvalidFlag == 1) {
                    $("#opt_invalid_" + id + "_" + invalidFlag).attr('class', 'fa fa-reply');
                    $("#opt_invalid_" + id + "_" + invalidFlag).attr('rel', '0');
                    $("#opt_invalid_" + id + "_" + invalidFlag).attr('title', '作废');
                    $("#opt_invalid_" + id).html("正常");
                } else {
                    $("#opt_invalid_" + id + "_" + invalidFlag).attr('class', 'fa fa-reply');
                    $("#opt_invalid_" + id + "_" + invalidFlag).attr('rel', '1');
                    $("#opt_invalid_" + id + "_" + invalidFlag).attr('title', '取消作废');
                    $("#opt_invalid_" + id).html("作废");
                }
            } else if (data.error_code == "101015") {
                layer.msg(data.error_text,{icon: 8});
            } else {
                layer.msg(title + "失败",{icon: 8});
            }
        }, 'json');
    }

    $("#<?php echo ($li_type); ?>").click();
</script>
</body>
</html>