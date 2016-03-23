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
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Home/Default/css/home-new.css" />

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
    <div class="index_left">
        <!--个人信息-->
        <div class="index_left_pro" style="height: 131px;">
            <div class="pro_img">
                <img style="height: 50px;width: 50px;" src="<?php echo ($headlogo); ?>">
            </div>
            <div class="pro_info">
                <ul style="text-align: left;">
                    <li style="line-height: 25px;height: 25px; font-size: 16px; font-weight: bold;padding-bottom: 5px;">
                        <!--<?php echo empty(cookie("nickName"))?session("mobile"):cookie("nickName"); ?>-->
                        <?php echo ($userInfo_arr['list']['nickName']); ?>
                    </li>
                    <li style="  margin: 20px 0 0 -65px; line-height: 25px;text-align: left;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($viewUserDetail_deptName); ?>"><span>所属部门：</span><?php echo ($viewUserDetail_deptName); ?></li>
                    <li style="  margin: 0px 0 0 -65px; line-height: 25px;text-align: left;"><span>手机号码：</span><?php echo ($viewUserDetail_mobile); ?></li>
                </ul>
            </div>
        </div>
        <!--快捷导航-->
        <div class="index_left_url">
            <div class="left_url">
                我发起的 <span id="myMessageCount"><a onclick="goLink(1);"><?php echo ($messageCount_myMessageCount); ?></a></span>
            </div>
            <div class="left_url">
                @我的 <span id="atMyMessageCount"><a onclick="goLink(2);"><?php echo ($messageCount_atMyMessageCount); ?></a></span>
            </div>
            <div class="left_url">
                待处理的 <span id="processWait"><a onclick="goLink(3);"><?php echo ($processWait_count); ?></a></span>
            </div>
            <div class="left_url">
                已处理的 <span id="processApproval"><a onclick="goLink(4);"><?php echo ($processApproval_count); ?></a></span>
            </div>
        </div>
        <!--任务记录--------二期开发-------->
        <div class="index_left_count">
            <div class="index_left_count_1" style="float: left;"><p style="margin-top: 10px;">超期任务</p><p style="font-size: 25px;">0</p></div>
            <div class="index_left_count_1" style="float: right;"><p style="margin-top: 10px;">未完成任务</p><p style="font-size: 25px;">0</p></div>
            <div class="index_left_count_2"><p style="padding-top:  10px;">待处理任务</p><p style="font-size: 25px;">0</p></div>
        </div>
        <!--积分榜-->
        <div class="index_left_scoreboard" style="display: block;">
            <div class="index_left_scoreboard_title">
                <div class="index_left_scoreboard_title_ico"><i class="fa fa-trophy fa-fw fa-lg rg"></i></div>
                <div class="index_left_scoreboard_title_name">积分榜</div>
            </div>
            <div class="index_left_scoreboard_list">
                <?php if(!empty($integralRanking_list)): if(is_array($integralRanking_list)): $i = 0; $__LIST__ = $integralRanking_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$irUserList): $mod = ($i % 2 );++$i;?><ul>
                    <li style="width: 45px;font-size: 25px;font-weight: bold;text-align: right;padding-right: 15px;"><?php echo ($i); ?></li>
                    <li style="width: 85px;border-bottom: 1px solid #e6e6e6;padding-left: 15px;"><?php echo ($irUserList["name"]); ?></li>
                    <li style="width: 23px;border-bottom: 1px solid #e6e6e6;color:#f6736b;"><?php echo ($irUserList["integralSum"]); ?></li>
                </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </div>
        </div>
    </div>
    <div class="index_center">
        <!--输入框-->
        <div class="index_from">
            <div class="index_from_button">
                <ul>
                    <li class="active">
                        <span class="fa-stack fa-lg">
                            <i  style="color: #fbfbfb;" class="fa fa-circle-o fa-stack-2x"></i>
                            <i class="fa  fa-comments fa-2x  fa-fw fa-stack-1x "></i>
                        </span>
                        <span>&nbsp;消息</span>
                    </li>
                    <!-- 二期开发-->
                    <!--<li>-->
                        <!--<span class="fa-stack fa-lg">-->
                            <!--<i  style="color: #fff;" class="fa fa-circle-o fa-stack-2x"></i>-->
                            <!--<i class="fa fa-tasks fa-fw fa-2x fa-stack-1x"></i>-->
                        <!--</span>-->
                        <!--<span>&nbsp;任务</span>-->
                    <!--</li>-->
                    <li>
                        <span class="fa-stack fa-lg">
                            <i  style="color: #fbfbfb;" class="fa fa-circle-o fa-stack-2x"></i>
                            <i class="fa fa-edit fa-fw fa-2x fa-stack-1x"></i>
                        </span>
                        <span>&nbsp;日志</span>
                    </li>
                    <li>
                        <span class="fa-stack fa-lg">
                            <i  class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-rmb fa-fw fa-2x fa-stack-1x fa-inverse"></i>
                        </span>
                        <span>&nbsp;报销</span>
                    </li>
                    <li>
                        <span class="fa-stack fa-lg">
                            <i  style="color: #fff;" class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-clock-o fa-fw fa-2x fa-stack-1x"></i>
                        </span>
                        <span>&nbsp;请假</span>
                    </li>
                    <li>
                        <span class="fa-stack fa-lg">
                            <i  style="color: #fbfbfb;" class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-plane fa-fw fa-2x fa-stack-1x"></i>
                        </span>
                        <span>&nbsp;出差</span>
                    </li>
                    <li>
                        <span class="fa-stack fa-lg">
                            <i  class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-usd fa-fw fa-lg fa-stack-1x fa-inverse"></i>
                        </span>
                        <span>&nbsp;费用</span>
                    </li>
                    <li id="jb">
                        <img style="float: left;width: 24px;" src="/wisdom/Public/Home/Default/images/jb0.png" >
                        <!--<span class="fa-stack fa-lg">-->
                            <!--<i  style="color: #fbfbfb;" class="fa fa-circle fa-stack-2x"></i>-->
                            <!--<i class="fa fa-tags fa-fw fa-lg fa-stack-1x"></i>-->
                        <!--</span>-->
                        <span style="line-height: 25px;">&nbsp;加班</span>
                    </li>
                </ul>
            </div>
            <div id="contentList">
                <!-- 消息-->
                <div id="contentList1" class="index_from_text_task" style="display: block">
                    <form id="form1">
                        <div class="index_from_text">
                            <textarea id="content" name="content" placeholder="请输入消息内容"></textarea>
                        </div>
                        <div class="index_bottom_button"  style="margin-bottom: 8px;">
                            <ul>
                                <li style="margin-left: 17px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfileMessage').click();"></li>
                            </ul>
                            <ul style="margin-bottom: 35px;">
                                <span class="showUpFile" id="showUpFile1" ></span>
                            </ul>
                            <p class="upfile_tips">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</p>
                            <ul >
                                <li style="margin-left: 17px;cursor: pointer;margin-top: -36px;" class="fa fa-at fa-fw fa-lg" onclick="selectMessageUsers();"></li>
                            </ul>
                            <ul style="  margin-top: -36px;">
                                <span class="showUpFile" id="messageUserList"></span>
                            </ul>
                            <ul style="margin:-25px 0 0 1px;">
                            <span style="margin-left: 324px;width: 380px;height: 25px;line-height: 25px;display: block;color: #898989">发送到：
                            <input  readonly style="height: 25px;margin-right: 16px;width: 200px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;padding-right:30px;" type="text" placeholder="    请选择部门范围" id="deptNames" name="deptNames" onclick="selectDeptNames();">
                            <span style="position: absolute;margin-left: -43px;margin-top: 6px;" class="fa fa-search fa-lg" onclick="selectDeptNames();"></span>
                            <button class="submit_btn" type="button" onclick="saveMessage();">提交</button>
                            </span>
                            </ul>
                        </div>


                        <!--<div class="index_bottom_button">-->
                            <!--<ul style="">-->
                                <!--<li style="margin-left: 60px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfileMessage').click();"></li>-->
                            <!--</ul>-->
                            <!--<ul style="margin-left: 110px;">-->
                                <!--<span class="showUpFile1" disabled="disabled" id="showUpFile1"></span>-->
                            <!--</ul>-->
                            <!--<p style="color: #f47469;float: right;height: 25px;margin-right: 15px;">*只能上传jpg/png/gif格式的图片</p>-->
                            <!--<ul style="">-->
                                <!--<li style="margin-left: 60px;cursor: pointer;" class="fa fa-at fa-fw fa-lg" onclick="selectMessageUsers();"></li>-->
                            <!--</ul>-->
                            <!--<ul style="margin-left: 109px;margin-top: 47px;">-->
                                <!--<span class="showUpFile1" disabled="disabled" id="messageUserList"></span>-->
                            <!--</ul>-->
                            <!--<ul>-->
                            <!--<span style="margin-left: 324px;width: 380px;height: 25px;line-height: 25px;display: block;color: #898989">发送到：-->
                                <!--<input  style="height: 25px;margin-right: 16px;width: 230px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;" type="text" placeholder="    请选择范围" id="deptNames" name="deptNames" onclick="selectDeptNames();">-->
                                <!--<span style="position: absolute;margin-left: -43px;margin-top: 6px;" class="fa fa-search fa-lg" onclick="selectDeptNames();"></span>-->
                                <!--<button class="submit_btn" type="button" onclick="saveMessage();">提交</button>-->
                            <!--</span>-->
                            <!--</ul>-->
                        <!--</div>-->

                        <input style="width: 560px;height: 100px;overflow:scroll; " type="hidden" id="messageUserIds" name="userIds" value="" />
                        <input type="hidden" id="messageUserNames" name="userNames" value="" />
                        <input type="hidden" id="deptIds" name="deptIds" value="" >
                        <input type="hidden" id="messageOldName" name="oldName" value="" />
                        <input type="hidden" id="messageType" name="type" value="" />
                        <input type="hidden" id="messageSize" name="size" value="" />
                        <input type="hidden" id="messageReturnUrl" name="returnUrl" value="" />
                    </form>
                    <form style="display:none;" id="upfileForm1" action="<?php echo U('Api/Upfile/upF/type/4');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfileMessage" name="upfile" accept="image/*" />
                    </form>
                </div>
                <!--任务--><!-- 二期开发-->
                <!--<div id="contentList2" class="index_from_text_task" style="display: none">-->
                    <!--<div class="index_from_text">-->
                        <!--<textarea name="" placeholder="请输入任务内容"></textarea>-->
                    <!--</div>-->
                    <!--<div style="margin-top: 24px;margin-bottom: 3px;">-->
                        <!--<ul>-->
                            <!--<span>任务执行人</span>-->
                            <!--<input style="width: 83%;padding-left: 15px;line-height: 25px;height:25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="+任务执行人">-->
                        <!--</ul>-->
                        <!--<ul>-->
                            <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;起始时间</span>-->
                            <!--<input id="startDate2" class="laydate-icon" value="" placeholder="起始时间" style="width: 155px;margin-right:28px;padding-left: 15px;height:25px;">-->
                            <!--<span>终止时间</span>-->
                            <!--<input id="endDate2" class="laydate-icon" value="" placeholder="终止时间" style="width: 155px;padding-left: 15px;margin-right: 32px;height: 25px;">-->
                            <!--<input type="checkbox">-->
                            <!--<span style="text-align: center">&nbsp;&nbsp;全天</span>-->
                        <!--</ul>-->
                        <!--<ul>-->
                            <!--<span style="color: #14bce1;" id="options">&nbsp;&nbsp;&nbsp;&nbsp;高级选项&nbsp;&nbsp;<i style="cursor: pointer;" class="fa fa-sort-desc fa-fw fa-2x" onclick="unfold()"></i></span>-->

                        <!--</ul>-->
                        <!--<div id="upflod">-->
                            <!--<ul>-->
                                <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提醒</span>-->
                                <!--<select style="width: 150px;height: 25px;color: #898989;padding-left: 15px;">-->
                                    <!--<option>无</option>-->
                                    <!--<option>有</option>-->
                                <!--</select>-->
                            <!--</ul>-->
                            <!--<ul>-->
                                <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;关联项目</span>-->
                                <!--<input type="search" placeholder=" 请选择范围" class="link">-->
                                <!--<span class="fa fa-search fa-lg" style="position: absolute;margin-left: -43px;margin-top: 8px;color: #898989;"></span>-->
                                <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;关联客户</span>-->
                                <!--<input type="search" placeholder=" 请选择范围" class="link">-->
                                <!--<span class="fa fa-search fa-lg" style="position: absolute;margin-left: -43px;margin-top: 8px;color: #898989;"></span>-->
                                <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;关联商机</span>-->
                                <!--<input type="search" placeholder=" 请选择范围" class="link">-->
                                <!--<span class="fa fa-search fa-lg" style="position: absolute;margin-left: -43px;margin-top: 8px;color: #898989;"></span>-->
                            <!--</ul>-->
                            <!--<ul>-->
                                <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;优先级</span>-->
                                <!--<select style="width: 70px;height: 25px;color: #898989;padding-left: 15px;">-->
                                    <!--<option value="">高</option>-->
                                    <!--<option value="">中</option>-->
                                    <!--<option value="">低</option>-->
                                <!--</select>-->
                                <!--<span style="margin-left: 67px;padding-right: 5px;">工期（天）</span>-->
                                <!--<input style="height: 25px;" type="text">-->
                            <!--</ul>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="index_bottom_button"  style=" border-top: 1px solid #eaeaea;padding-top: 12px;">-->
                        <!--<ul>-->
                            <!--<li style="margin-left: 18px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg"></li>-->
                            <!--&lt;!&ndash;<li class="fa fa-at fa-fw fa-lg"></li>&ndash;&gt;-->
                    <!--<span style="margin-left: 505px;width: 200px;height: 25px;line-height: 25px;display: block;color: #898989">-->
                        <!--<input type="checkbox" style="margin-right: 5px;"><span>短信通知</span>-->
                        <!--&lt;!&ndash;<input  style="height: 23px;margin-right: 16px;width: 230px;" type="search" placeholder="    请选择范围">&ndash;&gt;-->
                        <!--&lt;!&ndash;<span style="position: absolute;margin-left: -43px;margin-top: 6px;" class="fa fa-search fa-lg"></span>&ndash;&gt;-->
                        <!--<button class="submit_btn" type="button">提交</button>-->
                    <!--</span>-->
                        <!--</ul>-->
                    <!--</div>-->
                <!--</div>-->
                <!--日志-->
                <div id="contentList3" class="index_from_text_task" style="display: none">
                    <form id="form3">
                        <div class="index_from_text">
                            <textarea id="reportContent" name="reportContent" placeholder="请输入日志内容"></textarea>
                        </div>
                        <div style="margin: 24px 0 5px;">
                            <ul>
                                <!--<span>任务执行人</span>-->
                                <!--<input style="width: 83%;padding-left: 15px;line-height: 25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="+任务执行人">-->
                                <li style="margin-top:10px" >
                                    <input type="radio" id="dailyRecord" name="reportType" value="1" checked="checked"/><span style="margin-right:10px">日报</span>
                                    <input type="radio" id="weeklyRecord"  name="reportType" value="2" /><span  style="margin-right:10px">周报</span>
                                    <input type="radio" id="monthlyRecord"  name="reportType" value="3" /><span style="margin-right:10px">月报</span>
                                </li>
                            </ul>
                            <ul id="dailydate">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日期</span>
                                <input id="date" name="date" class="laydate-icon" value="" placeholder="请选择日期" style="width: 155px;margin-right:28px;padding-left: 15px;height: 25px;">
                            </ul>
                            <ul style="display: none;" id="monthdate">
                            	<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日期</span>
				                <select style="width: 180px;height:25px;" id="monthSelecter" name="monthSelecter">
				                </select>
                            </ul>
                            <ul style="display: none;" id="weekdate">
                            	<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日期</span>
				                <select style="width: 180px;height:25px;" id="weekSelecter" name = "weekSelecter">
				                </select>
				            </ul>
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;审阅人</span>
                                <input id="userNames" name="recorderName" style="height: 25px;padding-left: 15px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;" type="text" placeholder="+发送到" readonly="readonly" value="<?php echo ($getWorkSet_userNames); ?>"  title="<?php echo ($getWorkSet_userNames); ?>">
                                <span style="padding-left: 15px;color: #898989;cursor: pointer;" class="fa fa-plus-square fa-lg" onclick="selectUsers();"></span>
                            </ul>
                        </div>
                        <div class="index_bottom_button"  style=" border-top: 1px solid #eaeaea;padding-top: 12px;">
                            <ul>
                                <li style="margin-left: 17px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfile3').click();"></li>
                            <span style="  width: 660px;  display: block;">
                            <button class="submit_btn" type="button" onclick="saveReport();">提交</button>
                            </span>
                            </ul>
                            <ul style="margin-bottom: 35px;">
                                <span class="showUpFile" id="showUpFile3"></span>
                            </ul>
                            <p class="upfile_tips">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</p>

                        </div>
                        <input type="hidden" id="userIds" name="recorder" value="<?php echo ($getWorkSet_userIds); ?>" />
                        <input type="hidden" id="upfile3OldName" name="oldName" value="" />
                        <input type="hidden" id="upfile3Type" name="type" value="" />
                        <input type="hidden" id="upfile3Size" name="size" value="" />
                        <input type="hidden" id="upfile3ReturnUrl" name="returnUrl" value="" />
                    </form>
                    <form style="display:none;" id="upfileForm3" action="<?php echo U('Api/Upfile/upF/type/5');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfile3" name="upfile" accept="image/*" />
                    </form>
                </div>
                <!--报销-->
                <div id="contentList4" class="index_from_text_task" style="display: none">
                    <form id="form4">
                        <div class="index_from_text">
                            <textarea id="content" name="content" placeholder="请输入报销内容"></textarea>
                        </div>
                        <div style="margin: 24px 0 5px;">
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;报销类型</span>
                                <input style="width: 27%;padding-left: 15px;line-height: 25px;height:25px;margin-right:52px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="输入类型" name="reimbursementType" id="reimbursementType">
                                <span>报销金额</span>
                                <input style="width:27%;padding-left: 15px;line-height: 25px;height:25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="0.00" name="money" id="money">
                            </ul>
                            <ul style="min-height: 140px;margin-bottom: 15px;" class="userEA">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>
                                <div id="users4" class="show_per-pic">
                                    <?php if(!empty($reimbursementNodeList_userList)): if(is_array($reimbursementNodeList_userList)): $i = 0; $__LIST__ = $reimbursementNodeList_userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rUserList): $mod = ($i % 2 );++$i;?><div class="per-pic">
                                                <img class="per-img" src="<?php echo ($rUserList["headLogo"]); ?>" onclick="selectUser('<?php echo ($rUserList["userId"]); ?>',1,'users4');">
                                                <span id="<?php echo ($rUserList["userId"]); ?>" class="img-name"><?php echo ($rUserList["truename"]); ?></span>
                                                <input class="recorder" name="users4recorder[]" type="hidden" value="<?php echo ($rUserList["userId"]); ?>">
                                                <a style="color: #f47469;" class="icon-pre-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a>
                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    <div class="pers1"  id = "add" onclick="selectUser('',1,'users4');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>
                                </div>
                            </ul>
                        </div>
                        <div class="index_bottom_button"  style=" border-top: 1px solid #eaeaea;padding-top: 12px;">
                            <ul>
                                <li style="margin-left: 17px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfile4').click();"></li>
                            <span style="  width: 660px;  display: block;">
                            <button class="submit_btn" type="button" onclick="saveExpenseAccount();">提交</button>
                            </span>
                            </ul>
                            <ul style="margin-bottom: 35px;"><span class="showUpFile" id="showUpFile4"></span></ul>
                            <p class="upfile_tips">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</p>
                        </div>
                        <input type="hidden" id="upfile4ReturnUrl" name="returnUrl" value="" />
                        <input type="hidden" id="upfile4OldName" name="oldName" value="" />
                        <input type="hidden" id="upfile4Type" name="type" value="" />
                        <input type="hidden" id="upfile4Size" name="size" value="" />
                        <input type="hidden" id="busiType" name="busiType" value="2">
                    </form>
                    <form style="display:none;" id="upfileForm4" action="<?php echo U('Api/Upfile/upF/type/5');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfile4" name="upfile" accept="image/*" />
                    </form>
                </div>
                <!--请假-->
                <div id="contentList5" class="index_from_text_task" style="display: none">
                    <form id="form5">
                        <div class="index_from_text">
                            <textarea id="content" name="content" placeholder="请输入请假内容"></textarea>
                        </div>
                        <div style="margin: 24px 0 5px;">
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;请假类型</span>
                                <select style="width: 193px;color: #898989;padding-left: 15px;line-height: 25px;height:25px;margin-right:25px;font-size: 12px;border: 1px solid #eaeaea;" name="leaveType" id="leaveType">
                                    <option value="0">选择类型</option>
                                    <option value="1">事假</option>
                                    <option value="2">病假</option>
                                    <option value="3">年假</option>
                                    <option value="4">调休</option>
                                    <option value="5">婚假</option>
                                    <option value="6">产假</option>
                                    <option value="7">陪产假</option>
                                    <option value="8">路途假</option>
                                    <option value="9">其它</option>
                                </select>
                                <span>请假时长</span>
                                <input style="width:12%;padding-left: 15px;line-height: 25px;height:25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" name="days" id="days">
                                <li style="margin-top: 4px;width: 120px; float: right;margin-right: 80px;" >
                                    <input type="radio" id="leaveKind" name="durationType" value="1"  checked="checked"/>天
                                    <input type="radio" id="leaveKind" name="durationType" value="2" />小时
                                </li>
                            </ul>
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;起始时间</span>
                                <input id="startDate5" name="beginDate" class="laydate-icon" value="" placeholder="起始时间" style="height: 25px;width: 155px;margin-right:28px;padding-left: 15px;">
                                <span>终止时间</span>
                                <input id="endDate5" name="endDate" class="laydate-icon" value="" placeholder="终止时间" style="height: 25px;width: 155px;padding-left: 15px;margin-right: 32px;">
                                <!-- <input type="checkbox"> -->
                                <!--<span style="text-align: center">&nbsp;&nbsp;全天</span>-->
                            </ul>
                            <ul style="min-height: 140px;margin-bottom: 15px;" class="userLeave">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>
                                <div id="users5" class="show_per-pic">
                                    <?php if(!empty($leaveNodeList_userList)): if(is_array($leaveNodeList_userList)): $i = 0; $__LIST__ = $leaveNodeList_userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lUserList): $mod = ($i % 2 );++$i;?><div class="per-pic">
                                                <img class="per-img" src="<?php echo ($lUserList["headLogo"]); ?>" onclick="selectUser('<?php echo ($lUserList["userId"]); ?>',1,'users5');">
                                                <span id="<?php echo ($lUserList["userId"]); ?>" class="img-name"><?php echo ($lUserList["truename"]); ?></span>
                                                <input class="recorder" name="users5recorder[]" type="hidden" value="<?php echo ($lUserList["userId"]); ?>">
                                                <a style="color: #f47469;" class="icon-pre-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a>
                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    <div class="pers1"  id ="add" onclick="selectUser('',1,'users5');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>
                                </div>
                            </ul>
                        </div>
                        <div class="index_bottom_button"  style=" border-top: 1px solid #eaeaea;padding-top: 12px;">
                            <ul>
                                <li style="margin-left: 17px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfile5').click();"></li>
                            <span style="  width: 660px;  display: block;">
                            <button class="submit_btn" type="button" onclick="saveLeave();">提交</button>
                            </span>
                            </ul>
                            <ul style="margin-bottom: 35px;"><span class="showUpFile" id="showUpFile5"></span></ul>
                            <p class="upfile_tips">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</p>
                        </div>
                        <input type="hidden" id="upfile5ReturnUrl" name="returnUrl" value="" />
                        <input type="hidden" id="upfile5OldName" name="oldName" value="" />
                        <input type="hidden" id="upfile5Type" name="type" value="" />
                        <input type="hidden" id="upfile5Size" name="size" value="" />
                        <input type="hidden" id="busiType" name="busiType" value="3">
                    </form>
                    <form style="display:none;" id="upfileForm5" action="<?php echo U('Api/Upfile/upF/type/5');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfile5" name="upfile" accept="image/*" />
                    </form>
                </div>
                <!--出差-->
                <div id="contentList6" class="index_from_text_task" style="display: none">
                    <form id="form6">
                        <div class="index_from_text">
                            <textarea id="content" name="content" placeholder="请输入出差事件内容"></textarea>
                        </div>
                        <div style="margin: 24px 0 5px;">
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;出差地点</span>
                                <input style="width: 27%;padding-left: 15px;line-height: 25px;height:25px;margin-right:28px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="请输入出差地点" name="address" id="address">

                                <span>出差时长</span>
                                <input style="width:12%;padding-left: 15px;line-height: 25px;height:25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" name="days" id="days">
                                <li style="margin-top: 4px;width: 120px; float: right;margin-right: 80px;" >
                                    <input type="radio" id="leaveKind" name="durationType" value="1"  checked="checked"/>天
                                    <input type="radio" id="leaveKind" name="durationType" value="2" />小时
                                </li>
							</ul>
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;出发时间</span>
                                <input id="startDate6" name="beginDate" class="laydate-icon" value="" placeholder="出发时间" style="height: 25px;width: 155px;margin-right:28px;padding-left: 15px;">

                                <span>返回时间</span>
                                <input id="endDate6" name="endDate" class="laydate-icon" value="" placeholder="返回时间" style="height: 25px;width: 155px;padding-left: 15px;margin-right: 32px;">
                            </ul>
                           <!--<ul>-->
                            	<!--<span>&nbsp;&nbsp;&nbsp;出差时长</span>-->
                                <!--<input style="width:27%;padding-left: 15px;line-height: 25px;height:25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" name="days" id="days">-->
                            	<!--<input type="radio" id="leaveType" name="durationType" value="1"  checked="checked"/>天-->
           						<!--<input type="radio" id="leaveType" name="durationType" value="2" />小时-->
                            <!--</ul>-->
                            <ul style="min-height: 140px;margin-bottom: 15px;" class="userbuss">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>
                                <div id="users6" class="show_per-pic">
                                    <?php if(!empty($travelNodeList_userList)): if(is_array($travelNodeList_userList)): $i = 0; $__LIST__ = $travelNodeList_userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tUserList): $mod = ($i % 2 );++$i;?><div class="per-pic"><img class="per-img" src="<?php echo ($tUserList["headLogo"]); ?>" onclick="selectUser('<?php echo ($tUserList["userId"]); ?>',1,'users6');">
                                            <span id="<?php echo ($tUserList["userId"]); ?>" class="img-name"><?php echo ($tUserList["truename"]); ?></span>
                                                <input class="recorder" name="users6recorder[]" type="hidden" value="<?php echo ($tUserList["userId"]); ?>">
                                                <a style="color: #f47469;" class="icon-pre-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a>
                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    <div class="pers1"  id = "add"  onclick="selectUser('',1,'users6');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>
                                </div>
                            </ul>
                        </div>
                        <div class="index_bottom_button"  style=" border-top: 1px solid #eaeaea;padding-top: 12px;">
                            <ul>
                                <li style="margin-left: 17px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfile6').click();"></li>
                            <span style="  width: 660px;  display: block;">
                            <button class="submit_btn" type="button" onclick="saveBusiness();">提交</button>
                            </span>
                            </ul>
                            <ul style="margin-bottom: 35px;"><span class="showUpFile" id="showUpFile6"></span></ul>
                            <p class="upfile_tips">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</p>
                        </div>
                        <input type="hidden" id="upfile6ReturnUrl" name="returnUrl" value="" />
                        <input type="hidden" id="upfile6OldName" name="oldName" value="" />
                        <input type="hidden" id="upfile6Type" name="type" value="" />
                        <input type="hidden" id="upfile6Size" name="size" value="" />
                        <input type="hidden" id="busiType" name="busiType" value="4">
                    </form>
                    <form style="display:none;" id="upfileForm6" action="<?php echo U('Api/Upfile/upF/type/5');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfile6" name="upfile" accept="image/*" />
                    </form>
                </div>
                <!--费用-->
                <div id="contentList7" class="index_from_text_task" style="display: none">
                    <form id="form7">
                        <div class="index_from_text">
                            <textarea id="content" name="content" placeholder="请输入费用内容"></textarea>
                        </div>
                        <div style="margin: 24px 0 5px;">
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;费用类型</span>
                                <input style="width: 27%;padding-left: 15px;line-height: 25px;height:25px;margin-right:52px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="请输入类型" name="costType" id="costType">

                                <span>申请金额</span>
                                <input style="width:27%;padding-left: 15px;line-height: 25px;height:25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="0.00" name="money" id="money">
                            </ul>
                            <ul style="min-height: 140px;margin-bottom: 15px;" class="userFee">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>
                                <div id="users7" class="show_per-pic">
                                    <?php if(!empty($costNodeList_userList)): if(is_array($costNodeList_userList)): $i = 0; $__LIST__ = $costNodeList_userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cUserList): $mod = ($i % 2 );++$i;?><div class="per-pic"><img class="per-img" src="<?php echo ($cUserList["headLogo"]); ?>" onclick="selectUser('<?php echo ($cUserList["userId"]); ?>',1,'users7');">
                                            <span id="<?php echo ($cUserList["userId"]); ?>" class="img-name"><?php echo ($cUserList["truename"]); ?></span>
                                                <input class="recorder" name="users7recorder[]" type="hidden" value="<?php echo ($cUserList["userId"]); ?>">
                                                <a style="color: #f47469;" class="icon-pre-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a>
                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    <div class="pers1"  id = "add"  onclick="selectUser('',1,'users7');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>
                                </div>
                            </ul>
                        </div>
                        <div class="index_bottom_button"  style=" border-top: 1px solid #eaeaea;padding-top: 12px;">
                            <ul>
                                <li style="margin-left: 17px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfile7').click();"></li>
                            <span style="  width: 660px;  display: block;">
                            <button class="submit_btn" type="button" onclick="saveFee();">提交</button>
                            </span>
                            </ul>
                            <ul style="margin-bottom: 35px;"><span class="showUpFile" id="showUpFile7"></span></ul>
                            <p class="upfile_tips">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</p>
                        </div>
                        <input type="hidden" id="upfile7ReturnUrl" name="returnUrl" value="" />
                        <input type="hidden" id="upfile7OldName" name="oldName" value="" />
                        <input type="hidden" id="upfile7Type" name="type" value="" />
                        <input type="hidden" id="upfile7Size" name="size" value="" />
                        <input type="hidden" id="busiType" name="busiType" value="1">
                    </form>
                    <form style="display:none;" id="upfileForm7" action="<?php echo U('Api/Upfile/upF/type/5');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfile7" name="upfile" accept="image/*" />
                    </form>
                </div>
                <!--加班-->
                <div id="contentList8" class="index_from_text_task" style="display: none">
                    <form id="form8">
                        <div class="index_from_text">
                            <textarea id="content" name="content" placeholder="请输入加班内容"></textarea>
                        </div>
                        <div style="margin: 24px 0 5px;">
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;加班时长</span>
                                <input style="width:12%;padding-left: 15px;line-height: 25px;height:25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" name="days" id="days">
                                <li style="margin-top: 4px;width: 120px; float: right;margin-right: 368px;" >
                                    <input type="radio" id="overWorkKind" name="durationType" value="1"  checked="checked"/>天
                                    <input type="radio" id="overWorkKind" name="durationType" value="2" />小时
                                </li>
                            </ul>
                            <ul>
                                <span>&nbsp;&nbsp;&nbsp;起始时间</span>
                                <input id="startDate8" name="beginDate" class="laydate-icon" value="" placeholder="起始时间" style="height: 25px;width: 155px;margin-right:28px;padding-left: 15px;">
                                <span>终止时间</span>
                                <input id="endDate8" name="endDate" class="laydate-icon" value="" placeholder="终止时间" style="height: 25px;width: 155px;padding-left: 15px;margin-right: 32px;">
                                <!-- <input type="checkbox"> -->
                                <!--<span style="text-align: center">&nbsp;&nbsp;全天</span>-->
                            </ul>
                            <ul style="min-height: 140px;margin-bottom: 15px;" class="userOverWork">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>
                                <div id="users8" class="show_per-pic">
                                    <?php if(!empty($overWorkNodeList_userList)): if(is_array($overWorkNodeList_userList)): $i = 0; $__LIST__ = $overWorkNodeList_userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$owUserList): $mod = ($i % 2 );++$i;?><div class="per-pic">
                                                <img class="per-img" src="<?php echo ($owUserList["headLogo"]); ?>" onclick="selectUser('<?php echo ($owUserList["userId"]); ?>',1,'users8');">
                                                <span id="<?php echo ($owUserList["userId"]); ?>" class="img-name"><?php echo ($owUserList["truename"]); ?></span>
                                                <input class="recorder" name="users8recorder[]" type="hidden" value="<?php echo ($owUserList["userId"]); ?>">
                                                <a style="color: #f47469;" class="icon-pre-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a>
                                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    <div class="pers1"  id ="add" onclick="selectUser('',1,'users8');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>
                                </div>
                            </ul>
                        </div>
                        <div class="index_bottom_button"  style=" border-top: 1px solid #eaeaea;padding-top: 12px;">
                            <ul>
                                <li style="margin-left: 17px;cursor: pointer;" class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfile8').click();"></li>
                            <span style="  width: 660px;  display: block;">
                            <button class="submit_btn" type="button" onclick="saveOverWork();">提交</button>
                            </span>
                            </ul>
                            <ul style="margin-bottom: 35px;"><span class="showUpFile" id="showUpFile8"></span></ul>
                            <p class="upfile_tips">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</p>
                        </div>
                        <input type="hidden" id="upfile8ReturnUrl" name="returnUrl" value="" />
                        <input type="hidden" id="upfile8OldName" name="oldName" value="" />
                        <input type="hidden" id="upfile8Type" name="type" value="" />
                        <input type="hidden" id="upfile8Size" name="size" value="" />
                        <input type="hidden" id="busiType" name="busiType" value="5">
                    </form>
                    <form style="display:none;" id="upfileForm8" action="<?php echo U('Api/Upfile/upF/type/5');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfile8" name="upfile" accept="image/*" />
                    </form>
                </div>
            </div>
        </div>
        <!--列表-->
        <div class="index_list">
            <div class="index_list_button">
                <ul>
                    <li style="margin-left: 28px;position: relative" class="show0" >
                        <a class="active" onclick="getMessageList(1, 1);">全部</a>
                        <span style="background: #f47469;  height: 20px;  width: 20px;border-radius: 50%;  display: none;text-align: center;  position: absolute;top: -11px;left: 18px;" id="showNew">
                            <a style="color: #fff;position: absolute;left: 3px;top: 3px;" id="showNewMessage"></a>
                        </span>
                    </li>
                    <li class="show1"><a onclick="getMessageList(2, 1);">我发起的</a></li>
                    <li class="show2"><a onclick="getMessageList(3, 1);">@我的</a></li>
                    <li class="show3"><a onclick="getApprovalList(2, 1);">待处理</a></li>
                    <li class="show4"><a onclick="getApprovalList(3, 1);">已处理</a></li>
                </ul>
            </div>
            <div class="index_list_list">
                <div id="content_List">
                    <!--全部-->
                    <div class="contentList">
                        <div id="contentListAll">
                        <?php if(!empty($messageListAll_messageList)): if(is_array($messageListAll_messageList)): $i = 0; $__LIST__ = $messageListAll_messageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$all): $mod = ($i % 2 );++$i;?><ul id="message_list_<?php echo ($i-1); ?>">
                            <img src="<?php echo ($all["headLogo"]); ?>" width="50" height="50" />
                            <div class="msgList">
                                <div>
                                    <li>
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($all["userName"]); ?></span>
                                            <span><?php echo ($all["createTime"]); ?>&nbsp;</span>
                                        </div>
                                        <div><span class="msg_content1"><?php echo ($all["mesContent"]); ?></span></div>
                                    </li>
                                </div>
                                <?php if(!empty($all["commentList"])): if(is_array($all["commentList"])): $i = 0; $__LIST__ = $all["commentList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><br/>
                                <div>
                                    <li>
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($comment["userName"]); ?></span>
                                            <span><?php echo ($comment["createTime"]); ?></span>
                                        </div>
                                        <div>
                                            <span class="msg_content2"><?php echo ($comment["commentContent"]); ?></span>
                                            <p><a>
                                                <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                                    <i  class="fa fa-comment fa-stack-1x"></i>
                                                    <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                                </span>
                                                <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage(<?php echo ($all["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($comment["commentUserId"]); ?>);">回复</span>
                                            </a></p>
                                        </div>
                                    </li>
                                    <?php if(!empty($comment["replyList"])): if(is_array($comment["replyList"])): $i = 0; $__LIST__ = $comment["replyList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?><li style="margin-left:55px;">
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($reply["userName"]); ?> <i style="color: #999;">回复</i> <?php echo ($reply["replyToUserName"]); ?></span>
                                            <span><?php echo ($reply["createTime"]); ?></span>
                                        </div>
                                        <div>
                                            <span class="msg_content3"><?php echo ($reply["replyContent"]); ?></span>
                                            <p><a>
                                                <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                                    <i  class="fa fa-comment fa-stack-1x"></i>
                                                    <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                                </span>
                                                <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage(<?php echo ($all["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($reply["replyUserId"]); ?>);">回复</span>
                                            </a></p>
                                        </div>
                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                <br/>
                                <li>
                                    <textarea class="comment" placeholder="我也说一句" id="commentContent1_<?php echo ($all["mesId"]); ?>"></textarea>
                                    <input type="button" style="float: left;width: 70px;height: 25px;cursor: pointer;color: #fff;border: 1px none;background:#14bce1;margin: 0 12px;" value="评论" onclick="addComment(<?php echo ($all["mesId"]); ?>, 1);">
                                </li>
                                <div class="showfujian">
                                    <?php if($all['attachList'] != "") { foreach($all['attachList'] as $value) { echo '<a href="javascript:void();" title="'.$value['displayName'].'" onclick="javascript:doDownload(\''.$value['url'].'\');">'.$value['displayName'].'</a>'; } } ?>
                                </div>
                            </div>
                        </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </div>
                        <div id="pagebar1" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA;float: left;"></div>
                        <input type="hidden" id="page1" value="1">
                        <input type="hidden" id="messageAllCount" value="<?php echo ($messageListAll_messageCount); ?>">
                    </div>
                    <!--我发起的-->
                    <div class="contentList" style="display: none;">
                        <div id="contentListMy">
                        <?php if(!empty($messageListMy_messageList)): if(is_array($messageListMy_messageList)): $i = 0; $__LIST__ = $messageListMy_messageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$my): $mod = ($i % 2 );++$i;?><ul id="message_list_<?php echo ($i-1); ?>">
                            <img src="<?php echo ($my["headLogo"]); ?>" width="50" height="50" />
                            <div class="msgList">
                                <div>
                                    <li>
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($my["userName"]); ?></span>
                                            <span><?php echo ($my["createTime"]); ?>&nbsp;</span>
                                        </div>
                                        <div>
                                            <span class="msg_content1"><?php echo ($my["mesContent"]); ?></span>
                                        </div>
                                    </li>
                                </div>
                                <?php if(!empty($my["commentList"])): if(is_array($my["commentList"])): $i = 0; $__LIST__ = $my["commentList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><br/>
                                <div>
                                    <li>
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($comment["userName"]); ?></span>
                                            <span><?php echo ($comment["createTime"]); ?></span>
                                        </div>
                                        <div>
                                            <span class="msg_content2"><?php echo ($comment["commentContent"]); ?></span>
                                            <p><a>
                                                <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                                    <i  class="fa fa-comment fa-stack-1x"></i>
                                                    <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                                </span>
                                                <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage(<?php echo ($my["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($comment["commentUserId"]); ?>);">回复</span>
                                            </a></p>
                                        </div>
                                    </li>
                                    <?php if(!empty($comment["replyList"])): if(is_array($comment["replyList"])): $i = 0; $__LIST__ = $comment["replyList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?><li style="margin-left:55px;">
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($reply["userName"]); ?> <i style="color: #999;">回复</i> <?php echo ($reply["replyToUserName"]); ?></span>
                                            <span><?php echo ($reply["createTime"]); ?></span>
                                        </div>
                                        <div>
                                            <span class="msg_content3"><?php echo ($reply["replyContent"]); ?></span>
                                            <p><a>
                                                <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                                    <i  class="fa fa-comment fa-stack-1x"></i>
                                                    <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                                </span>
                                                <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage(<?php echo ($my["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($reply["replyUserId"]); ?>);">回复</span>
                                            </a></p>
                                        </div>
                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                <br/>
                                <li>
                                    <textarea class="comment" placeholder="我也说一句" id="commentContent2_<?php echo ($my["mesId"]); ?>"></textarea>
                                    <input type="button" style="float: left;width: 70px;height: 25px;cursor: pointer;color: #fff;border: 1px none;background:#14bce1;margin: 0 12px;" value="评论" onclick="addComment(<?php echo ($my["mesId"]); ?>, 2);">
                                </li>
                                <div class="showfujian">
                                    <?php if($my['attachPaths'] != "") { foreach($my['attachList'] as $value) { echo '<a href="javascript:void();" title="'.$value['displayName'].'" onclick="javascript:doDownload(\''.$value['url'].'\');">'.$value['displayName'].'</a>'; } } ?>
                                </div>
                            </div>
                        </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </div>
                        <div id="pagebar2" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA;float: left;"></div>
                        <input type="hidden" id="page2" value="1">
                    </div>
                    <!--@我的-->
                    <div class="contentList" style="display: none;">
                        <div id="contentListAt">
                        <?php if(!empty($messageListAt_messageList)): if(is_array($messageListAt_messageList)): $i = 0; $__LIST__ = $messageListAt_messageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$at): $mod = ($i % 2 );++$i;?><ul id="message_list_<?php echo ($i-1); ?>">
                            <img src="<?php echo ($at["headLogo"]); ?>" width="50" height="50" />
                            <div class="msgList">
                                <div>
                                    <li>
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($at["userName"]); ?></span>
                                            <span><?php echo ($at["createTime"]); ?>&nbsp;</span>
                                        </div>
                                        <div>
                                            <span class="msg_content1"><?php echo ($at["mesContent"]); ?></span>
                                        </div>
                                    </li>
                                </div>
                                <?php if(!empty($at["commentList"])): if(is_array($at["commentList"])): $i = 0; $__LIST__ = $at["commentList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><br/>
                                <div>
                                    <li>
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($comment["userName"]); ?></span>
                                            <span><?php echo ($comment["createTime"]); ?></span>
                                        </div>
                                        <div>
                                            <span class="msg_content2"><?php echo ($comment["commentContent"]); ?></span>
                                            <p><a>
                                                <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                                    <i  class="fa fa-comment fa-stack-1x"></i>
                                                    <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                                </span>
                                                <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage(<?php echo ($at["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($comment["commentUserId"]); ?>);">回复</span>
                                            </a></p>
                                        </div>
                                    </li>
                                    <?php if(!empty($comment["replyList"])): if(is_array($comment["replyList"])): $i = 0; $__LIST__ = $comment["replyList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?><li style="margin-left:55px;">
                                        <div>
                                            <span style="margin-right: 15px;color: #14bce1;"><?php echo ($reply["userName"]); ?> <i style="color: #999;">回复</i> <?php echo ($reply["replyToUserName"]); ?></span>
                                            <span><?php echo ($reply["createTime"]); ?></span>
                                        </div>
                                        <div>
                                            <span class="msg_content3"><?php echo ($reply["replyContent"]); ?></span>
                                            <p><a>
                                                <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                                    <i  class="fa fa-comment fa-stack-1x"></i>
                                                    <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                                </span>
                                                <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage(<?php echo ($at["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($reply["replyUserId"]); ?>);">回复</span>
                                            </a></p>
                                        </div>
                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                <br/>
                                <li>
                                    <textarea class="comment" placeholder="我也说一句" id="commentContent3_<?php echo ($at["mesId"]); ?>"></textarea>
                                    <input type="button" style="float: left;width: 70px;height: 25px;cursor: pointer;color: #fff;border: 1px none;background:#14bce1;margin: 0 12px;" value="评论" onclick="addComment(<?php echo ($at["mesId"]); ?>, 3);">
                                </li>
                                <div class="showfujian">
                                    <?php if($at['attachPaths'] != "") { foreach($at['attachList'] as $value) { echo '<a href="javascript:void();" title="'.$value['displayName'].'" onclick="javascript:doDownload(\''.$value['url'].'\');">'.$value['displayName'].'</a>'; } } ?>
                                </div>
                            </div>
                        </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </div>
                        <div id="pagebar3" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA;float: left;"></div>
                        <input type="hidden" id="page3" value="1">
                    </div>
                    <!--待处理-->
                    <div class="LCList" style="display: none;">
                        <div class="title">
                           <ul>
                               <li style="width: 30%">主题</li>
                               <li style="width: 40%">申请内容</li>
                               <li style="width: 30%">申请日期</li>
                           </ul>
                        </div>
                        <div class="details">
                            <div id="processListWait">
                            <?php if(!empty($processWait_processList)): if(is_array($processWait_processList)): $i = 0; $__LIST__ = $processWait_processList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wait): $mod = ($i % 2 );++$i;?><ul>
                                <li style="width: 30%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($wait["title"]); ?>"><?php echo ($wait["title"]); ?></li>
                                <li style="width: 40%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><a onclick="showProcessDetail('<?php echo ($wait["processId"]); ?>', <?php echo ($wait["busiType"]); ?>, 4);"><?php echo ($wait["formContent"]); ?></a></li>
                                <li style="width: 30%"><?php echo ($wait["createTime"]); ?></li>
                            </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </div>
                            <div id="pagebar4" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA;float: left;"></div>
                            <input type="hidden" id="page4" value="1">
                        </div>
                    </div>
                    <!--已处理-->
                    <div class="LCList" style="display: none;">
                        <div class="title">
                            <ul>
                                <li style="width: 30%">主题</li>
                                <li style="width: 40%">申请内容</li>
                                <li style="width: 30%">申请日期</li>
                            </ul>
                        </div>
                        <div class="details">
                            <div id="processListApproval">
                            <?php if(!empty($processApproval_processList)): if(is_array($processApproval_processList)): $i = 0; $__LIST__ = $processApproval_processList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$approval): $mod = ($i % 2 );++$i;?><ul>
                                <li style="width: 30%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($approval["title"]); ?>"><a onclick="showProcessDetail('<?php echo ($approval["processId"]); ?>', <?php echo ($approval["busiType"]); ?>, 5);"><?php echo ($approval["title"]); ?></a></li>
                                <li style="width: 40%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($approval["formContent"]); ?>"><?php echo ($approval["formContent"]); ?></li>
                                <li style="width: 30%"><?php echo ($approval["createTime"]); ?></li>
                            </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </div>
                            <div id="pagebar5" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA;float: left;"></div>
                            <input type="hidden" id="page5" value="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="index_right">
        <!--公告-->
        <div class="index_right_scoreboard">
            <div class="index_right_scoreboard_title">
                <div class="index_right_scoreboard_title_ico"><i class="fa fa-bullhorn fa-fw fa-lg rg"></i></div>
                <div class="index_right_scoreboard_title_name">公告通知</div>
            </div>
            <div class="index_right_scoreboard_list">
                <?php if(is_array($getNoticeList_list)): $i = 0; $__LIST__ = $getNoticeList_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul style="width: 185px;padding-left: 5px;height: 25px;" onclick="doNoticeDetail(<?php echo ($vo["messageId"]); ?>);">
                        <!--<li style="width: 15px;font-size: 14px;font-weight: bold;text-align: right;"><?php echo ($i); ?></li>-->
                        <li style="cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($vo["title"]); ?>"><a><?php echo ($vo["title"]); ?></a></li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!--快捷-->
        <div class="index_right_quick" style="display:block;">
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">发起电话会议</div>
            </div>
            <div class="index_right_line_1"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">体验中心</div>
            </div>
            <div class="index_right_line_1"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">帮助视频</div>
            </div>
            <div class="index_right_line_1"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">业务指标设置</div>
            </div>
            <div class="index_right_line_20"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">签到报表</div>
            </div>
            <div class="index_right_line_1"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">考勤报表</div>
            </div>
            <div class="index_right_line_1"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">任务图</div>
            </div>
            <div class="index_right_line_1"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">任务统计表</div>
            </div>
            <div class="index_right_line_1"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">员工使用动态图</div>
            </div>
            <div class="index_right_line_20"></div>
            <div class="index_right_link">
                <div class="index_right_nb_30" style="float: left;"><div class="">图</div></div>
                <div class="index_right_nb_24" style="float: left;">栏目设置</div>
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
<script language="javascript" type="text/javascript" src="http://www.my97.net/dp/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/autosize.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>
<div style="display: none;"><script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script></div>

 
 
 
<script>
    //评论框高度处理
    $(document).ready(function(){
        // 输入框获取焦点事件
        $(".comment").focus(function() {
            $(this).height("70px");
        });
        // 输入框失去焦点事件
        $(".comment").blur(function() {
            if(!$(this).val()){
                $(this).height("25px");
            }
        });
//        $(".index_from").mouseover(function() {
//            $(".index_bottom_button").show();
//        });
//        $(".index_from").mouseout(function() {
//            timer=setTimeout(function(){
//                if($(".showUpFile1,showUpFile").val() == ''){
//                    $(".index_bottom_button").hide();
//                }
//            },10000)
//            });
//        // 消息下面显示事件
//        function reloadFocus1() {
//            // 输入框获取焦点事件
//            $(".index_from_text textarea").focus(function() {
//                $(".index_bottom_button").show();
//            });
//            // 输入框失去焦点事件
//            $(".index_from_text textarea").blur(function() {
//                $(".index_bottom_button").hide();
//            });
//        }
        // 定时刷新消息个数
        
        var id = setInterval(function(){
            newMessageCount();
        }, 30000);
        
    });
    $(function(){
        Cookie.eraseCookie("bigMenuIndex");
        Cookie.eraseCookie("smallMenuIndex");
        Cookie.createCookie("bigMenuIndex",0);
        Cookie.createCookie("smallMenuIndex",0);

        // 全部
        createPageBar1('<?php echo ($messageListAll_total); ?>', '<?php echo ($messageListAll_pageSize); ?>', '<?php echo ($messageListAll_page); ?>', '<?php echo ($messageListAll_totalPage); ?>');
        $(document).on('click','#pagebar1 span a', function() {
            $("#page1").val($(this).attr("rel"));
            getMessageList(1, $(this).attr("rel"));
        });
        // 我发起的
        createPageBar2('<?php echo ($messageListMy_total); ?>', '<?php echo ($messageListMy_pageSize); ?>', '<?php echo ($messageListMy_page); ?>', '<?php echo ($messageListMy_totalPage); ?>');
        $(document).on('click','#pagebar2 span a', function() {
            $("#page2").val($(this).attr("rel"));
            getMessageList(2, $(this).attr("rel"));
        });
        // @我的
        createPageBar3('<?php echo ($messageListAt_total); ?>', '<?php echo ($messageListAt_pageSize); ?>', '<?php echo ($messageListAt_page); ?>', '<?php echo ($messageListAt_totalPage); ?>');
        $(document).on('click','#pagebar3 span a', function() {
            $("#page3").val($(this).attr("rel"));
            getMessageList(3, $(this).attr("rel"));
        });
        // 待处理
        createPageBar4('<?php echo ($processWait_total); ?>', '<?php echo ($processWait_pageSize); ?>', '<?php echo ($processWait_page); ?>', '<?php echo ($processWait_totalPage); ?>');
        $(document).on('click','#pagebar4 span a', function() {
            $("#page4").val($(this).attr("rel"));
            getApprovalList(2, $(this).attr("rel"));
        });
        // 已处理
        createPageBar5('<?php echo ($processApproval_total); ?>', '<?php echo ($processApproval_pageSize); ?>', '<?php echo ($processApproval_page); ?>', '<?php echo ($processApproval_totalPage); ?>');
        $(document).on('click','#pagebar5 span a', function() {
            $("#page5").val($(this).attr("rel"));
            getApprovalList(3, $(this).attr("rel"));
        });

        var start2 = {
            elem: '#startDate2',
            format: 'YYYY-MM-DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end2.min = datas; //开始日选好后，重置结束日的最小日期
                // end2.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end2 = {
            elem: '#endDate2',
            format: 'YYYY-MM-DD hh:mm',
            min: '1899-06-16',
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start2.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };

        function getNow() {
            var d = new Date();
            var vYear = d.getFullYear();
            var vMon = d.getMonth() + 1;
            var vDay = d.getDate();
            var h = d.getHours(); 
            var m = d.getMinutes();

            return vYear+"-"+vMon+"-"+vDay+" "+h+":"+m;
        }

        var start5 = {
            elem: '#startDate5',
            format: 'YYYY-MM-DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期 
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                end5.min = datas; //开始日选好后，重置结束日的最小日期
                end5.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end5 = {
            elem: '#endDate5',
            format: 'YYYY-MM-DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                start5.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        var start6 = {
            elem: '#startDate6',
            format: 'YYYY/MM/DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                 end6.min = datas; //开始日选好后，重置结束日的最小日期
                 end6.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end6 = {
            elem: '#endDate6',
            format: 'YYYY/MM/DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                start6.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        var start8 = {
            elem: '#startDate8',
            format: 'YYYY/MM/DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                 end8.min = datas; //开始日选好后，重置结束日的最小日期
                 end8.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end8 = {
            elem: '#endDate8',
            format: 'YYYY/MM/DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                start8.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        var date = {
            elem: '#date',
            format: 'YYYY-MM-DD',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false
        };

        // laydate(start2);
        // laydate(end2);
        //laydate(start3);
        //laydate(end3);
        laydate(start5);
        laydate(end5);
        laydate(start6);
        laydate(end6);
        laydate(start8);
        laydate(end8);
        laydate(date);
    });
    // 评论框高度事件
    function reloadFocus() {
        // 输入框获取焦点事件
        $(".comment").focus(function() {
            $(this).height("70px");
        });
        // 输入框失去焦点事件
        $(".comment").blur(function() {
            if(!$(this).val()){
                $(this).height("25px");
            }
        });
    }
    // 菜单轮换点击事件1
    $(".index_from_button li").click(function () {
        $("#jb img").attr ("src", "/wisdom/Public/Home/Default/images/jb0.png");
        var index = $(".index_from_button li").index($(this));
        $(this).addClass("active").siblings().removeClass("active");
        $divList = $("#contentList").children("div");
        $divList.hide();
        $divList.eq(index).show();
    });
    //切换加班当前选中图标
    $("#jb").click(function(){
        $("#jb img").attr ("src", "/wisdom/Public/Home/Default/images/jb1.png");
    });
    // 菜单轮换点击事件2
    $(".index_list_button li > a").click(function () {
        var index = $(".index_list_button li > a").index($(this));
        $(this).addClass("active").parent().siblings().find('a').removeClass("active");
//        $(this).siblings().css('color','#000');
//        $(this).css('color','red');
        $divList1 = $("#content_List").children("div");
        $divList1.hide();
        $divList1.eq(index).show();
    });
    function goLink(index) {
        $(".show0 a").removeClass("active").siblings();
        $(".show1 a").removeClass("active").siblings();
        $(".show2 a").removeClass("active").siblings();
        $(".show3 a").removeClass("active").siblings();
        $(".show4 a").removeClass("active").siblings();
        switch(index) {
            case 1:
                $(".show1 a").addClass("active").siblings().removeClass("active");
                break;
            case 2:
                $(".show2 a").addClass("active").siblings().removeClass("active");
                break;
            case 3:
                $(".show3 a").addClass("active").siblings().removeClass("active");
                break;
            case 4:
                $(".show4 a").addClass("active").siblings().removeClass("active");
                break;
        }
        $divList1 = $("#content_List").children("div");
        $divList1.hide();
        $divList1.eq(index).show();
    }
    // 日志不同类型的加载显示
    $("#dailyRecord").click(function(){
        $("#weekdate").hide();
        $("#dailydate").show();
        $("#monthdate").hide();
    });
    $("#monthlyRecord").click(function(){
        $("#weekdate").hide();
        $("#dailydate").hide();
        $("#monthdate").show();
    });
    $("#weeklyRecord").click(function(){
        $("#dailydate").hide();
        $("#weekdate").show();
        $("#monthdate").hide();
    });
    //高级选项展开
    function unfold(){
        $("#upflod").toggle();
    }
    function doNoticeDetail(messageId) {
        layer.open({
            type:2,
            title :['公告通知','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['700px', '600px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/noticeDetail');?>?messageId=" + messageId,
        });
    }
    function selectUsers() {
        var userNames = $("#userNames").val();
        var userIds = $("#userIds").val();
        layer.open({
            type:2,
            title :['发送到','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '400px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectUsers');?>" + "?userNames=" + userNames + "&userIds=" + userIds,
        });
    }
    function selectMessageUsers() {
        var userNames = $("#messageUserNames").val();
        var userIds = $("#messageUserIds").val();

        layer.open({
            type:2,
            title :['选择用户','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectMessageUsers');?>" + "?userNames=" + userNames + "&userIds=" + userIds,
        });
    }
    function selectDeptNames() {
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
    function selectUser(userId, no, objId) {
        var userIdList = document.getElementsByName(objId + 'recorder[]');

        var selected = "";
        for ( var  i = 0; i < userIdList.length; i ++ ){
            if(selected == "") {
                selected = userIdList[i].value;
            } else {
                selected = selected + "," + userIdList[i].value;
            }
        }

        if(userIdList.length < 17) {
            layer.open({
                type:2,
                title :['审批人员','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
                area: ['530px', '520px'],
                shadeClose: true, //点击遮罩关闭
                content: "<?php echo U('Office/selectUser');?>" + "?userId=" + userId + "&no=" + no + "&objId=" + objId + "&selected=" + selected,
            });
        } else {
            layer.msg("审批人员最多17人",{icon: 8});
        }
    }
    function saveMessage() {
        var messageContent = $("#form1 #content");
        var content = $("#form1 #content").val();
        if (getValLen(messageContent) == 0) {
            layer.msg("消息内容不能为空",{icon: 8});
            messageContent.focus();
            return false;
        } else if (getValLen(messageContent) > 500) {
            layer.msg("消息内容最多为500字",{icon: 8});
            messageContent.focus();
            return false;
        }

        // 部门check
        var deptObj = $("#form1 #deptIds");
        var deptIds = $("#form1 #deptIds").val();
        var deptList = deptIds.split(",");
        if (getValLen(deptObj) == 0) {
            layer.msg("请选择发送的部门",{icon: 8});
            return false;
        } else if (deptList.length > 50) {
            layer.msg("部门最多为50个",{icon: 8});
            return false;
        }

        // 附件check
        var attachPaths = $("#form1 #messageReturnUrl").val();
        var attachPathList = attachPaths.split(",");
        if (attachPathList.length > 5) {
            layer.msg("附件最多为5个",{icon: 8});
            return false;
        }

        // 用户check
        var userIds = $("#form1 #messageUserIds").val();
        var userIdList = userIds.split(",");
        if (userIdList.length > 200) {
            layer.msg("用户最多为200个",{icon: 8});
            return false;
        }

        var fileType = $("#form1 #messageType").val();
        var displayName = $("#form1 #messageOldName").val();
        var size = $("#form1 #messageSize").val();
        var url = $("#form1 #messageReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/saveMessage');?>", {"content":content, "deptIds":deptIds, "fileType":fileType, "userIds":userIds, "displayName":displayName, "size":size, "url":url}, function(data) {
            if(data.error_code == "success") {
                layer.msg("发送成功");
                $("#form1 #content").val("");
                $("#form1 #deptIds").val("");
                $("#form1 #deptNames").val("");
                $("#form1 #messageReturnUrl").val("");
                $("#form1 #messageOldName").val("");
                $("#form1 #messageType").val("");
                $("#form1 #messageSize").val("");
                $("#form1 #messageUserIds").val("");
                $("#form1 #messageUserNames").val("");
                $("#form1 #messageUserList").html("");
                $("#showUpFile1").html("");
                // 重新加载统计
                reloadCount();
                refreshMessageList();
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
            layer.close(loadIdx);
        }, 'json');
    }
    function saveReport() {
        var reportContentObj = $("#form3 #reportContent");
        if (getValLen(reportContentObj) == 0) {
            layer.msg("日志内容不能为空",{icon: 8});
            reportContentObj.focus();
            return false;
        } else if (getValLen(reportContentObj) > 1000) {
            layer.msg("日志内容最多为1000字",{icon: 8});
            reportContentObj.focus();
            return false;
        }
/*
        if ($("#form3 #weeklyRecord:checked").length > 0) {
            var startDateObj = $("#form3 #startDate3");
            var endDateObj = $("#form3 #endDate3");
            if (getValLen(startDateObj) == 0) {
                layer.msg("起始时间不能为空",{icon: 8});
                startDateObj.focus();
                return false;
            } else if (getValLen(endDateObj) == 0) {
                layer.msg("终止时间不能为空",{icon: 8});
                endDateObj.focus();
                return false;
            }
        } 
        */
        if ($("#form3 #dailyRecord:checked").length > 0) {
            var dateObj = $("#form3 #date");
            if (getValLen(dateObj) == 0) {
                layer.msg("日期不能为空",{icon: 8});
                dateObj.focus();
                return false;
            }
        }

        var recorderObj = $("#form3 #userIds");
        if (getValLen(recorderObj) == 0) {
            layer.msg("审阅人没有选择！",{icon: 8});
            $("#form3 #userNames").focus();
            return false;
        } else if (getValLen(recorderObj) > 500) {
            layer.msg("审阅人选择过多，最多500字符",{icon: 8});
            $("#form3 #userNames").focus();
            return false;
        }

        var loadIdx = layer.load(0);
        var formData = $("#form3").serializeArray();
        $.post("<?php echo U('Office/saveReport');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("发送成功");
                $("#form3 #reportContent").val("");
                //$("#form3 #startDate3").val("");
                //$("#form3 #endDate3").val("");
                //$("#form3 #date").val("");
                $("#form3 #date").val(new Date().Format("yyyy-MM-dd"));
                $("#showUpFile3").html("");
                $("#upfile3OldName").val("");
                $("#upfile3Type").val("");
                $("#upfile3Size").val("");
                $("#upfile3ReturnUrl").val("");
                // $("#form3 #userNames").val("");

                $.post("<?php echo U('Office/refreshIntegralRanking');?>", {}, function(data) {
                    if(data.error_code == "success") {
                        if (!("list" in data)) {
                            layer.msg(data.error_text,{icon: 8});
                            return;
                        }
                        var content = "";
                        $.each(data.list, function(k, v) {
                            content += '<ul>';
                            content += '<li style="width: 45px;font-size: 25px;font-weight: bold;text-align: right;padding-right: 15px;">' + (k+1) + '</li>';
                            content += '<li style="width: 85px;border-bottom: 1px solid #e6e6e6;padding-left: 15px;">'+ v.name +'</li>';
                            content += '<li style="width: 23px;border-bottom: 1px solid #e6e6e6;color:#f6736b;">'+ v.integralSum +'</li>';
                            content += '</ul>';
                        });
                        $(".index_left_scoreboard_list").html(content);
                    }
                }, 'json');
            } else{
                layer.msg("发送失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }
    function saveExpenseAccount() {
        var eaContentObj = $("#form4 #content");
        if (getValLen(eaContentObj) == 0) {
            layer.msg("报销内容不能为空",{icon: 8});
            eaContentObj.focus();
            return false;
        } else if (getValLen(eaContentObj) > 1000) {
            layer.msg("报销内容最多为1000字",{icon: 8});
            eaContentObj.focus();
            return false;
        }

        var eaTypeObj = $("#form4 #reimbursementType");
        if (getValLen(eaTypeObj) == 0) {
            layer.msg("报销类型不能为空",{icon: 8});
            eaTypeObj.focus();
            return false;
        } else if (getValLen(eaTypeObj) > 64) {
            layer.msg("报销类型最多为64字",{icon: 8});
            eaTypeObj.focus();
            return false;
        }

        var eaMoneyObj = $("#form4 #money");
        var moneyCheck = /^[0-9]*(\.[0-9]{1,2})?$/;
        var money = $.trim(eaMoneyObj.val());
        if (getValLen(eaMoneyObj) == 0) {
            layer.msg("报销金额不能为空",{icon: 8});
            eaMoneyObj.focus();
            return false;
        } else if (getValLen(eaMoneyObj) > 20) {
            layer.msg("报销金额最大长度为20",{icon: 8});
            eaMoneyObj.focus();
            return false;
        } else if(!moneyCheck.test(money)) {
            layer.msg("请输入正确的报销金额",{icon: 8});
            eaMoneyObj.focus();
            return false;
        }

        var userIdList = document.getElementsByName('users4recorder[]');
        var userId = "";
        for ( var  i = 0; i < userIdList.length; i ++ ){
            if(userId == "") {
                userId = userIdList[i].value;
            } else {
                userId = userId + "," + userIdList[i].value;
            }
        }
        if(userId == "") {
            layer.msg("审批人员不能为空",{icon: 8});
            return false;
        }

        var loadIdx = layer.load(0);
        var formData = $("#form4").serializeArray();
        $.post("<?php echo U('Office/saveProcess');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("发送成功");
                $("#form4 #content").val("");
                $("#form4 #reimbursementType").val("");
                $("#form4 #money").val("");
                $("#form4 #upfile4ReturnUrl").val("");
                $("#form4 #upfile4OldName").val("");
                $("#form4 #upfile4Type").val("");
                $("#form4 #upfile4Size").val("");
                $("#form4 .userEA").empty();
                $("#showUpFile4").html("");

                var content = "<span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>";
                content += '<div id="users4" class="show_per-pic">';
                $.each(data.nodeList, function(k, v) {

                    content += '<div class="per-pic">';
                    content += '<img class="per-img" src="' + v.headLogo + '" onclick="selectUser(\''+ v.userId +'\',1,\'users4\');">';
                    content += '<span id ="'+v.userId+'" class="img-name">'+v.truename+'</span><input class="recorder" name="users4recorder[]" type="hidden" value="'+v.userId+'"><a style="color: #f47469;" class="icon-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a></div>';
                });
                content += '<div class="pers1"  id = "add" onclick="selectUser(\'\',1,\'users4\');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>';
                content += '</div>';

                $("#form4 .userEA").append(content);
                // 重新加载统计
                reloadCount();
                refreshApprovalList();
            } else{
                layer.msg("发送失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }
    function saveLeave() {
        var contentObj = $("#form5 #content");
        if (getValLen(contentObj) == 0) {
            layer.msg("请假内容不能为空",{icon: 8});
            contentObj.focus();
            return false;
        } else if (getValLen(contentObj) > 1000) {
            layer.msg("请假内容最多为1000字",{icon: 8});
            contentObj.focus();
            return false;
        }

        var typeObj = $("#form5 #leaveType");
        if (getValLen(typeObj) == 0) {
            layer.msg("请假类型不能为空",{icon: 8});
            typeObj.focus();
            return false;
        } else if ($.trim(typeObj.val()) == 0) {
            layer.msg("请假类型不能为空",{icon: 8});
            typeObj.focus();
            return false;
        }

        var daysObj = $("#form5 #days");
        //var daysCheck = /^[0-9]+.?[0-9]*$/;
        var daysCheck = /^[0-9]+(.[0-9]{1})?$/;
        var days = $.trim(daysObj.val());
        if (getValLen(daysObj) == 0) {
            layer.msg("请假时长不能为空",{icon: 8});
            daysObj.focus();
            return false;
        } else if (getValLen(daysObj) > 4) {
            layer.msg("请假时长最大长度为4",{icon: 8});
            daysObj.focus();
            return false;
        } else if(days == 0) {
            layer.msg("请输入正确的请假时长",{icon: 8});
            daysObj.focus();
            return false;
        } else if(!daysCheck.test(days)) {
            layer.msg("请输入正确的请假时长",{icon: 8});
            daysObj.focus();
            return false;
        }

        var startDateObj = $("#form5 #startDate5");
        var endDateObj = $("#form5 #endDate5");
        if (getValLen(startDateObj) == 0) {
            layer.msg("起始时间不能为空",{icon: 8});
            startDateObj.focus();
            return false;
        } else if (getValLen(endDateObj) == 0) {
            layer.msg("终止时间不能为空",{icon: 8});
            endDateObj.focus();
            return false;
        }

        var userIdList = document.getElementsByName('users5recorder[]');
        var userId = "";
        for ( var  i = 0; i < userIdList.length; i ++ ){
            if(userId == "") {
                userId = userIdList[i].value;
            } else {
                userId = userId + "," + userIdList[i].value;
            }
        }
        if(userId == "") {
            layer.msg("审批人员不能为空",{icon: 8});
            return false;
        }

        var loadIdx = layer.load(0);
        var formData = $("#form5").serializeArray();
        $.post("<?php echo U('Office/saveProcess');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("发送成功");
                $("#form5 #content").val("");
                $("#form5 #leaveType").val("");
                $("#form5 #days").val("");
                $("#form5 #startDate5").val("");
                $("#form5 #endDate5").val("");
                $("#form5 #upfile5ReturnUrl").val("");
                $("#form5 #upfile5OldName").val("");
                $("#form5 #upfile5Type").val("");
                $("#form5 #upfile5Size").val("");
                $("#form5 .userLeave").empty();
                $("#showUpFile5").html("");
                $("input[type=radio]").attr("checked",'0')
                var content = "<span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>";
                content += '<div id="users5" class="show_per-pic">';
                $.each(data.nodeList, function(k, v) {

                    content += '<div class="per-pic">';
                    content += '<img class="per-img" src="'+v.headLogo+'" onclick="selectUser(\''+v.userId+'\', 1, \'users5\');">';
                    content += '<span id ="'+v.userId+'"  class="img-name">'+v.truename+'</span><input class="recorder" name="users5recorder[]" type="hidden" value="'+v.userId+'"><a style="color: #f47469;" class="icon-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a></div>';
                });
                content += '<div class="pers1" id ="add" onclick="selectUser(\'\',1,\'users5\');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>';
                content += '</div>';

                $("#form5 .userLeave").append(content);
                // 重新加载统计
                reloadCount();
                refreshApprovalList();
            } else{
                layer.msg("发送失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }
    function saveBusiness() {
        var contentObj = $("#form6 #content");
        if (getValLen(contentObj) == 0) {
            layer.msg("出差事件内容不能为空",{icon: 8});
            contentObj.focus();
            return false;
        } else if (getValLen(contentObj) > 1000) {
            layer.msg("出差事件内容最多为1000字",{icon: 8});
            contentObj.focus();
            return false;
        }

        var addressObj = $("#form6 #address");
        if (getValLen(addressObj) == 0) {
            layer.msg("出差地点不能为空",{icon: 8});
            addressObj.focus();
            return false;
        } else if (getValLen(addressObj) > 100) {
            layer.msg("出差地点最多为100字",{icon: 8});
            addressObj.focus();
            return false;
        }

        var daysObj = $("#form6 #days");
        //var daysCheck = /^[0-9]+.?[0-9]*$/;
        var daysCheck = /^[0-9]+(.[0-9]{1})?$/;
        var days = $.trim(daysObj.val());
        if (getValLen(daysObj) == 0) {
            layer.msg("出差时长不能为空",{icon: 8});
            daysObj.focus();
            return false;
        } else if (getValLen(daysObj) > 4) {
            layer.msg("出差时长最大长度为4",{icon: 8});
            daysObj.focus();
            return false;
        } else if(days == 0) {
            layer.msg("请输入正确的出差天数",{icon: 8});
            daysObj.focus();
            return false;
        } else if(!daysCheck.test(days)) {
            layer.msg("请输入正确的出差时长",{icon: 8});
            daysObj.focus();
            return false;
        }

        var startDateObj = $("#form6 #startDate6");
        var endDateObj = $("#form6 #endDate6");
        if (getValLen(startDateObj) == 0) {
            layer.msg("出发时间不能为空",{icon: 8});
            startDateObj.focus();
            return false;
        } else if (getValLen(endDateObj) == 0) {
            layer.msg("返回时间不能为空",{icon: 8});
            endDateObj.focus();
            return false;
        }

        var userIdList = document.getElementsByName('users6recorder[]');
        var userId = "";
        for ( var  i = 0; i < userIdList.length; i ++ ){
            if(userId == "") {
                userId = userIdList[i].value;
            } else {
                userId = userId + "," + userIdList[i].value;
            }
        }
        if(userId == "") {
            layer.msg("审批人员不能为空",{icon: 8});
            return false;
        }

        var loadIdx = layer.load(0);
        var formData = $("#form6").serializeArray();
        $.post("<?php echo U('Office/saveProcess');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("发送成功");
                $("#form6 #content").val("");
                $("#form6 #address").val("");
                $("#form6 #days").val("");
                $("#form6 #startDate6").val("");
                $("#form6 #endDate6").val("");
                $("#form6 #upfile6ReturnUrl").val("");
                $("#form6 #upfile6OldName").val("");
                $("#form6 #upfile6Type").val("");
                $("#form6 #upfile6Size").val("");
                $("#form6 .userbuss").empty();
                $("#showUpFile6").html("");
                $("input[type=radio]").attr("checked",'0')
                var content = "<span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>";
                content += '<div id="users6" class="show_per-pic">';
                $.each(data.nodeList, function(k, v) {

                    content += '<div class="per-pic">';
                    content += '<img class="per-img" src="'+v.headLogo+'" onclick="selectUser(\''+v.userId+'\', 1, \'users6\');">';
                    content += '<span id ="'+v.userId+'" class="img-name">'+v.truename+'</span><input class="recorder" name="users6recorder[]" type="hidden" value="'+v.userId+'"><a style="color: #f47469;" class="icon-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a></div>';
                });
                content += '<div class="pers1" id="add" onclick="selectUser(\'\',1,\'users6\');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>';
                content += '</div>';

                $("#form6 .userbuss").append(content);
                // 重新加载统计
                reloadCount();
                refreshApprovalList();
            } else{
                layer.msg("发送失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }
    function saveFee() {
        var feeContentObj = $("#form7 #content");
        if (getValLen(feeContentObj) == 0) {
            layer.msg("费用内容不能为空",{icon: 8});
            feeContentObj.focus();
            return false;
        } else if (getValLen(feeContentObj) > 1000) {
            layer.msg("费用内容最多为1000字",{icon: 8});
            feeContentObj.focus();
            return false;
        }

        var feeTypeObj = $("#form7 #costType");
        if (getValLen(feeTypeObj) == 0) {
            layer.msg("费用类型不能为空",{icon: 8});
            feeTypeObj.focus();
            return false;
        } else if (getValLen(feeTypeObj) > 64) {
            layer.msg("费用类型最多为64字",{icon: 8});
            feeTypeObj.focus();
            return false;
        }

        var feeMoneyObj = $("#form7 #money");
        var moneyCheck = /^[0-9]*(\.[0-9]{1,2})?$/;
        var money = $.trim(feeMoneyObj.val());
        if (getValLen(feeMoneyObj) == 0) {
            layer.msg("申请金额不能为空",{icon: 8});
            feeMoneyObj.focus();
            return false;
        } else if (getValLen(feeMoneyObj) > 20) {
            layer.msg("申请金额最大长度为20",{icon: 8});
            feeMoneyObj.focus();
            return false;
        } else if(!moneyCheck.test(money)) {
            layer.msg("请输入正确的申请金额",{icon: 8});
            feeMoneyObj.focus();
            return false;
        }

        var userIdList = document.getElementsByName('users7recorder[]');
        var userId = "";
        for ( var  i = 0; i < userIdList.length; i ++ ){
            if(userId == "") {
                userId = userIdList[i].value;
            } else {
                userId = userId + "," + userIdList[i].value;
            }
        }
        if(userId == "") {
            layer.msg("审批人员不能为空",{icon: 8});
            return false;
        }

        var loadIdx = layer.load(0);
        var formData = $("#form7").serializeArray();
        $.post("<?php echo U('Office/saveProcess');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("发送成功");
                $("#form7 #content").val("");
                $("#form7 #costType").val("");
                $("#form7 #money").val("");
                $("#form7 #upfile7ReturnUrl").val("");
                $("#form7 #upfile7OldName").val("");
                $("#form7 #upfile7Type").val("");
                $("#form7 #upfile7Size").val("");
                $("#form7 .userFee").empty();
                $("#showUpFile7").html("");

                var content = "<span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>";
                content += '<div id="users7" class="show_per-pic">';
                $.each(data.nodeList, function(k, v) {

                    content += '<div class="per-pic">';
                    content += '<img class="per-img" src="'+v.headLogo+'" onclick="selectUser(\''+v.userId+'\', 1, \'users7\');">';
                    content += '<span id ="'+v.userId+'" class="img-name">'+v.truename+'</span><input class="recorder" name="users7recorder[]" type="hidden" value="'+v.userId+'"><a style="color: #f47469;" class="icon-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a></div>';
                });
                content += '<div class="pers1" id="add" onclick="selectUser(\'\',1,\'users7\');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>';
                content += '</div>';

                $("#form7 .userFee").append(content);
                // 重新加载统计
                reloadCount();
                refreshApprovalList();
            } else{
                layer.msg("发送失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }
    function saveOverWork() {
        var contentObj = $("#form8 #content");
        if (getValLen(contentObj) == 0) {
            layer.msg("加班内容不能为空",{icon: 8});
            contentObj.focus();
            return false;
        } else if (getValLen(contentObj) > 1000) {
            layer.msg("加班内容最多为1000字",{icon: 8});
            contentObj.focus();
            return false;
        }

        var daysObj = $("#form8 #days");
        var daysCheck = /^[0-9]+(.[0-9]{1})?$/;
        var days = $.trim(daysObj.val());
        if (getValLen(daysObj) == 0) {
            layer.msg("加班时长不能为空",{icon: 8});
            daysObj.focus();
            return false;
        } else if (getValLen(daysObj) > 4) {
            layer.msg("加班时长最大长度为4",{icon: 8});
            daysObj.focus();
            return false;
        } else if(days == 0) {
            layer.msg("请输入正确的加班时长",{icon: 8});
            daysObj.focus();
            return false;
        } else if(!daysCheck.test(days)) {
            layer.msg("请输入正确的加班时长",{icon: 8});
            daysObj.focus();
            return false;
        }

        var startDateObj = $("#form8 #startDate8");
        var endDateObj = $("#form8 #endDate8");
        if (getValLen(startDateObj) == 0) {
            layer.msg("起始时间不能为空",{icon: 8});
            startDateObj.focus();
            return false;
        } else if (getValLen(endDateObj) == 0) {
            layer.msg("终止时间不能为空",{icon: 8});
            endDateObj.focus();
            return false;
        }

        var userIdList = document.getElementsByName('users8recorder[]');
        var userId = "";
        for ( var  i = 0; i < userIdList.length; i ++ ){
            if(userId == "") {
                userId = userIdList[i].value;
            } else {
                userId = userId + "," + userIdList[i].value;
            }
        }
        if(userId == "") {
            layer.msg("审批人员不能为空",{icon: 8});
            return false;
        }

        var loadIdx = layer.load(0);
        var formData = $("#form8").serializeArray();
        $.post("<?php echo U('Office/saveProcess');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("发送成功");
                $("#form8 #content").val("");
                $("#form8 #days").val("");
                $("#form8 #startDate8").val("");
                $("#form8 #endDate8").val("");
                $("#form8 #upfile8ReturnUrl").val("");
                $("#form8 #upfile8OldName").val("");
                $("#form8 #upfile8Type").val("");
                $("#form8 #upfile8Size").val("");
                $("#form8 .userOverWork").empty();
                $("#showUpFile8").html("");
                $("input[type=radio]").attr("checked",'0')
                var content = "<span>&nbsp;&nbsp;&nbsp;&nbsp;审批人员</span>";
                content += '<div id="users8" class="show_per-pic">';
                $.each(data.nodeList, function(k, v) {

                    content += '<div class="per-pic">';
                    content += '<img class="per-img" src="'+v.headLogo+'" onclick="selectUser(\''+v.userId+'\', 1, \'users8\');">';
                    content += '<span id ="'+v.userId+'"  class="img-name">'+v.truename+'</span><input class="recorder" name="users8recorder[]" type="hidden" value="'+v.userId+'"><a style="color: #f47469;" class="icon-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a></div>';
                });
                content += '<div class="pers1" id ="add" onclick="selectUser(\'\',1,\'users8\');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>';
                content += '</div>';

                $("#form8 .userOverWork").append(content);
                // 重新加载统计
                reloadCount();
                refreshApprovalList();
            } else{
                layer.msg("发送失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }
    function reloadCount() {
        $.post("<?php echo U('Office/getMessageCount');?>", {}, function(data) {
            if(data.error_code == "success") {
                var myMessage = "<a onclick='goLink(1)'>" + data.myMessageCount + "</a>";
                var atMyMessage = "<a onclick='goLink(2)'>" + data.atMyMessageCount + "</a>";
                $("#myMessageCount").html(myMessage);
                $("#atMyMessageCount").html(atMyMessage);
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
        }, 'json');

        $.post("<?php echo U('Office/getProcessList');?>", {"type":2}, function(data) {
            if(data.error_code == "success") {
                var processWait = "<a onclick='goLink(3)'>" + data.count + "</a>";
                $("#processWait").html(processWait);
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
        }, 'json');

        $.post("<?php echo U('Office/getProcessList');?>", {"type":3}, function(data) {
            if(data.error_code == "success") {
                var processApproval = "<a onclick='goLink(3)'>" + data.count + "</a>";
                $("#processApproval").html(processApproval);
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
        }, 'json');
    }
    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }
    $("#upfileMessage").change(function(){
        var returnUrl = $("#messageReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload1();
            // $("#upfileMessage").val("");
        }
    });
    $("#upfile3").change(function(){
        var returnUrl = $("#upfile3ReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload3();
            // $("#upfile3").val("");
        }
    });
    $("#upfile4").change(function(){
        var returnUrl = $("#upfile4ReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload4();
            // $("#upfile4").val("");
        }
    });
    $("#upfile5").change(function(){
        var returnUrl = $("#upfile5ReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload5();
            // $("#upfile5").val("");
        }
    });
    $("#upfile6").change(function(){
        var returnUrl = $("#upfile6ReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload6();
            // $("#upfile6").val("");
        }
    });
    $("#upfile7").change(function(){
        var returnUrl = $("#upfile7ReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload7();
            // $("#upfile7").val("");
        }
    });
    $("#upfile8").change(function(){
        var returnUrl = $("#upfile8ReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload8();
            // $("#upfile8").val("");
        }
    });
    // 上传文件-消息
    function fileUpload1() {
        var messageReturnUrl = $("#messageReturnUrl").val();
        var messageOldName = $("#messageOldName").val();
        var messageType = $("#messageType").val();
        var messageSize = $("#messageSize").val();
        var showUpFile1 = $("#showUpFile1").html();

        var loadIdx = layer.load(0);
        $("#upfileForm1").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(messageReturnUrl != "") {
                        messageOldName += ",";
                        messageType += ",";
                        messageSize += ",";
                        messageReturnUrl += ",";
                        showUpFile1 += "<span class='"+ showClass +"' id='"+ showId +"'>&emsp;";
                    } else {
                        showUpFile1 = "<span class='"+ showClass +"' id='"+ showId +"'>";
                    }

                    messageOldName += data.upfile.name;
                    messageType += data.upfile.type;
                    messageSize += data.upfile.size;
                    messageReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#messageOldName").val(messageOldName);
                    $("#messageType").val(messageType);
                    $("#messageSize").val(messageSize);
                    $("#messageReturnUrl").val(messageReturnUrl);

                    showUpFile1 += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile1(this);'></i></span> ";
                    $("#showUpFile1").html(showUpFile1);
                }
            },
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    // 删除上传文件-消息
    function removeUpFile1(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var messageOldName = $("#messageOldName").val();
        var messageType = $("#messageType").val();
        var messageSize = $("#messageSize").val();
        var messageReturnUrl = $("#messageReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");
                var returnUrlList = messageReturnUrl.split(',');
                var index = 0;
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        returnUrlList.splice(i, 1);
                        index = i;
                    }
                }
                messageReturnUrl = returnUrlList.join(",");
                $("#messageReturnUrl").val(messageReturnUrl);

                var oldNameList = messageOldName.split(',');
                oldNameList.splice(index, 1);
                messageOldName = oldNameList.join(",");
                $("#messageOldName").val(messageOldName);

                var typeList = messageType.split(',');
                typeList.splice(index, 1);
                messageType = typeList.join(",");
                $("#messageType").val(messageType);

                var sizeList = messageSize.split(',');
                sizeList.splice(index, 1);
                messageSize = sizeList.join(",");
                $("#messageSize").val(messageSize);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
    // 上传文件-日志
    function fileUpload3() {
        var showUpFile3 = $("#showUpFile3").html();
        var upfile3OldName = $("#upfile3OldName").val();
        var upfile3Type = $("#upfile3Type").val();
        var upfile3Size = $("#upfile3Size").val();
        var upfile3ReturnUrl = $("#upfile3ReturnUrl").val();
        var loadIdx = layer.load(0);
        $("#upfileForm3").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(upfile3OldName != "") {
                        upfile3OldName += ",";
                        upfile3Type += ",";
                        upfile3Size += ",";
                        upfile3ReturnUrl += ",";

                        showUpFile3 += "<span class='"+ showClass +"' id='"+ showId +"'>&emsp;";
                    } else {
                        showUpFile3 = "<span class='"+ showClass +"' id='"+ showId +"'>";
                    }

                    upfile3OldName += data.upfile.name;
                    upfile3Type += data.upfile.type;
                    upfile3Size += data.upfile.size;
                    upfile3ReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#upfile3OldName").val(upfile3OldName);
                    $("#upfile3Type").val(upfile3Type);
                    $("#upfile3Size").val(upfile3Size);
                    $("#upfile3ReturnUrl").val(upfile3ReturnUrl);

                    showUpFile3 += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile3(this);'></i></span> ";
                    $("#showUpFile3").html(showUpFile3);
                }
            },
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    // 删除上传文件-日志
    function removeUpFile3(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var upfile3OldName = $("#upfile3OldName").val();
        var upfile3Type = $("#upfile3Type").val();
        var upfile3Size = $("#upfile3Size").val();
        var upfile3ReturnUrl = $("#upfile3ReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");

                var index = 0;
                var returnUrlList = upfile3ReturnUrl.split(',');
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        index = i;
                        returnUrlList.splice(i, 1);
                    }
                }
                upfile3ReturnUrl = returnUrlList.join(",");
                $("#upfile3ReturnUrl").val(upfile3ReturnUrl);

                var oldNameList = upfile3OldName.split(',');
                oldNameList.splice(index, 1);
                upfile3OldName = oldNameList.join(",");
                $("#upfile3OldName").val(upfile3OldName);

                var typeList = upfile3Type.split(',');
                typeList.splice(index, 1);
                upfile3Type = typeList.join(",");
                $("#upfile3Type").val(upfile3Type);

                var sizeList = upfile3Size.split(',');
                sizeList.splice(index, 1);
                upfile3Size = sizeList.join(",");
                $("#upfile3Size").val(upfile3Size);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
    // 上传文件-报销
    function fileUpload4() {
        var upfile4ReturnUrl = $("#upfile4ReturnUrl").val();
        var upfile4OldName = $("#upfile4OldName").val();
        var upfile4Type = $("#upfile4Type").val();
        var upfile4Size = $("#upfile4Size").val();
        var showUpFile4 = $("#showUpFile4").html();
        var loadIdx = layer.load(0);
        $("#upfileForm4").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(upfile4ReturnUrl != "") {
                        upfile4OldName += ",";
                        upfile4Type += ",";
                        upfile4Size += ",";
                        upfile4ReturnUrl += ",";
                        showUpFile4 += "<span class='"+ showClass +"' id='"+ showId +"'>&emsp;";
                    } else {
                        showUpFile4 = "<span class='"+ showClass +"' id='"+ showId +"'>";
                    }

                    upfile4OldName += data.upfile.name;
                    upfile4Type += data.upfile.type;
                    upfile4Size += data.upfile.size;
                    upfile4ReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#upfile4OldName").val(upfile4OldName);
                    $("#upfile4Type").val(upfile4Type);
                    $("#upfile4Size").val(upfile4Size);
                    $("#upfile4ReturnUrl").val(upfile4ReturnUrl);

                    showUpFile4 += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile4(this);'></i></span> ";
                    $("#showUpFile4").html(showUpFile4);
                }
            },
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    // 删除上传文件-报销
    function removeUpFile4(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var upfile4OldName = $("#upfile4OldName").val();
        var upfile4Type = $("#upfile4Type").val();
        var upfile4Size = $("#upfile4Size").val();
        var upfile4ReturnUrl = $("#upfile4ReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");
                var returnUrlList = upfile4ReturnUrl.split(',');
                var index = 0;
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        returnUrlList.splice(i, 1);
                        index = i;
                    }
                }
                upfile4ReturnUrl = returnUrlList.join(",");
                $("#upfile4ReturnUrl").val(upfile4ReturnUrl);

                var oldNameList = upfile4OldName.split(',');
                oldNameList.splice(index, 1);
                upfile4OldName = oldNameList.join(",");
                $("#upfile4OldName").val(upfile4OldName);

                var typeList = upfile4Type.split(',');
                typeList.splice(index, 1);
                upfile4Type = typeList.join(",");
                $("#upfile4Type").val(upfile4Type);

                var sizeList = upfile4Size.split(',');
                sizeList.splice(index, 1);
                upfile4Size = sizeList.join(",");
                $("#upfile4Size").val(upfile4Size);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
    // 上传文件-请假
    function fileUpload5() {
        var upfile5ReturnUrl = $("#upfile5ReturnUrl").val();
        var upfile5OldName = $("#upfile5OldName").val();
        var upfile5Type = $("#upfile5Type").val();
        var upfile5Size = $("#upfile5Size").val();
        var showUpFile5 = $("#showUpFile5").html();
        var loadIdx = layer.load(0);
        $("#upfileForm5").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(upfile5ReturnUrl != "") {
                        upfile5OldName += ",";
                        upfile5Type += ",";
                        upfile5Size += ",";
                        upfile5ReturnUrl += ",";
                        showUpFile5 += "<span class='"+ showClass +"' id='"+ showId +"'>&emsp;";
                    } else {
                        showUpFile5 = "<span class='"+ showClass +"' id='"+ showId +"'>";
                    }

                    upfile5OldName += data.upfile.name;
                    upfile5Type += data.upfile.type;
                    upfile5Size += data.upfile.size;
                    upfile5ReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#upfile5OldName").val(upfile5OldName);
                    $("#upfile5Type").val(upfile5Type);
                    $("#upfile5Size").val(upfile5Size);
                    $("#upfile5ReturnUrl").val(upfile5ReturnUrl);

                    showUpFile5 += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile5(this);'></i></span> ";
                    $("#showUpFile5").html(showUpFile5);
                }
            },
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    // 删除上传文件-请假
    function removeUpFile5(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var upfile5OldName = $("#upfile5OldName").val();
        var upfile5Type = $("#upfile5Type").val();
        var upfile5Size = $("#upfile5Size").val();
        var upfile5ReturnUrl = $("#upfile5ReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");
                var returnUrlList = upfile5ReturnUrl.split(',');
                var index = 0;
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        returnUrlList.splice(i, 1);
                        index = i;
                    }
                }
                upfile5ReturnUrl = returnUrlList.join(",");
                $("#upfile5ReturnUrl").val(upfile5ReturnUrl);

                var oldNameList = upfile5OldName.split(',');
                oldNameList.splice(index, 1);
                upfile5OldName = oldNameList.join(",");
                $("#upfile5OldName").val(upfile5OldName);

                var typeList = upfile5Type.split(',');
                typeList.splice(index, 1);
                upfile5Type = typeList.join(",");
                $("#upfile5Type").val(upfile5Type);

                var sizeList = upfile5Size.split(',');
                sizeList.splice(index, 1);
                upfile5Size = sizeList.join(",");
                $("#upfile5Size").val(upfile5Size);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
    // 上传文件-出差
    function fileUpload6() {
        var upfile6ReturnUrl = $("#upfile6ReturnUrl").val();
        var upfile6OldName = $("#upfile6OldName").val();
        var upfile6Type = $("#upfile6Type").val();
        var upfile6Size = $("#upfile6Size").val();
        var showUpFile6 = $("#showUpFile6").html();
        var loadIdx = layer.load(0);
        $("#upfileForm6").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(upfile6ReturnUrl != "") {
                        upfile6OldName += ",";
                        upfile6Type += ",";
                        upfile6Size += ",";
                        upfile6ReturnUrl += ",";
                        showUpFile6 += "<span class='"+ showClass +"' id='"+ showId +"'>&emsp;";
                    } else {
                        showUpFile6 = "<span class='"+ showClass +"' id='"+ showId +"'>";
                    }

                    upfile6OldName += data.upfile.name;
                    upfile6Type += data.upfile.type;
                    upfile6Size += data.upfile.size;
                    upfile6ReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#upfile6OldName").val(upfile6OldName);
                    $("#upfile6Type").val(upfile6Type);
                    $("#upfile6Size").val(upfile6Size);
                    $("#upfile6ReturnUrl").val(upfile6ReturnUrl);

                    showUpFile6 += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile6(this);'></i></span> ";
                    $("#showUpFile6").html(showUpFile6);
                }
            },
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    // 删除上传文件-出差
    function removeUpFile6(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var upfile6OldName = $("#upfile6OldName").val();
        var upfile6Type = $("#upfile6Type").val();
        var upfile6Size = $("#upfile6Size").val();
        var upfile6ReturnUrl = $("#upfile6ReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");
                var returnUrlList = upfile6ReturnUrl.split(',');
                var index = 0;
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        returnUrlList.splice(i, 1);
                        index = i;
                    }
                }
                upfile6ReturnUrl = returnUrlList.join(",");
                $("#upfile6ReturnUrl").val(upfile6ReturnUrl);

                var oldNameList = upfile6OldName.split(',');
                oldNameList.splice(index, 1);
                upfile6OldName = oldNameList.join(",");
                $("#upfile6OldName").val(upfile6OldName);

                var typeList = upfile6Type.split(',');
                typeList.splice(index, 1);
                upfile6Type = typeList.join(",");
                $("#upfile6Type").val(upfile6Type);

                var sizeList = upfile6Size.split(',');
                sizeList.splice(index, 1);
                upfile6Size = sizeList.join(",");
                $("#upfile6Size").val(upfile6Size);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
    // 上传文件-费用
    function fileUpload7() {
        var upfile7OldName = $("#upfile7OldName").val();
        var upfile7Type = $("#upfile7Type").val();
        var upfile7Size = $("#upfile7Size").val();
        var upfile7ReturnUrl = $("#upfile7ReturnUrl").val();
        var showUpFile7 = $("#showUpFile7").html();
        var loadIdx = layer.load(0);
        $("#upfileForm7").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(upfile7ReturnUrl != "") {
                        upfile7OldName += ",";
                        upfile7Type += ",";
                        upfile7Size += ",";
                        upfile7ReturnUrl += ",";
                        showUpFile7 += "<span class='"+ showClass +"' id='"+ showId +"'>&emsp;";
                    } else {
                        showUpFile7 = "<span class='"+ showClass +"' id='"+ showId +"'>";
                    }

                    upfile7OldName += data.upfile.name;
                    upfile7Type += data.upfile.type;
                    upfile7Size += data.upfile.size;
                    upfile7ReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#upfile7OldName").val(upfile7OldName);
                    $("#upfile7Type").val(upfile7Type);
                    $("#upfile7Size").val(upfile7Size);
                    $("#upfile7ReturnUrl").val(upfile7ReturnUrl);

                    showUpFile7 += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile7(this);'></i></span> ";
                    $("#showUpFile7").html(showUpFile7);
                }
            },
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    // 删除上传文件-费用
    function removeUpFile7(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var upfile7OldName = $("#upfile7OldName").val();
        var upfile7Type = $("#upfile7Type").val();
        var upfile7Size = $("#upfile7Size").val();
        var upfile7ReturnUrl = $("#upfile7ReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");
                var returnUrlList = upfile7ReturnUrl.split(',');
                var index = 0;
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        returnUrlList.splice(i, 1);
                        index = i;
                    }
                }
                upfile7ReturnUrl = returnUrlList.join(",");
                $("#upfile7ReturnUrl").val(upfile7ReturnUrl);

                var oldNameList = upfile7OldName.split(',');
                oldNameList.splice(index, 1);
                upfile7OldName = oldNameList.join(",");
                $("#upfile7OldName").val(upfile7OldName);

                var typeList = upfile7Type.split(',');
                typeList.splice(index, 1);
                upfile7Type = typeList.join(",");
                $("#upfile7Type").val(upfile7Type);

                var sizeList = upfile7Size.split(',');
                sizeList.splice(index, 1);
                upfile7Size = sizeList.join(",");
                $("#upfile7Size").val(upfile7Size);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
    // 上传文件-加班
    function fileUpload8() {
        var upfile8OldName = $("#upfile8OldName").val();
        var upfile8Type = $("#upfile8Type").val();
        var upfile8Size = $("#upfile8Size").val();
        var upfile8ReturnUrl = $("#upfile8ReturnUrl").val();
        var showUpFile8 = $("#showUpFile8").html();
        var loadIdx = layer.load(0);
        $("#upfileForm8").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(upfile8ReturnUrl != "") {
                        upfile8OldName += ",";
                        upfile8Type += ",";
                        upfile8Size += ",";
                        upfile8ReturnUrl += ",";
                        showUpFile8 += "<span class='"+ showClass +"' id='"+ showId +"'>&emsp;";
                    } else {
                        showUpFile8 = "<span class='"+ showClass +"' id='"+ showId +"'>";
                    }

                    upfile8OldName += data.upfile.name;
                    upfile8Type += data.upfile.type;
                    upfile8Size += data.upfile.size;
                    upfile8ReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#upfile8OldName").val(upfile8OldName);
                    $("#upfile8Type").val(upfile8Type);
                    $("#upfile8Size").val(upfile8Size);
                    $("#upfile8ReturnUrl").val(upfile8ReturnUrl);

                    showUpFile8 += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile8(this);'></i></span> ";
                    $("#showUpFile8").html(showUpFile8);
                }
            },
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    // 删除上传文件-加班
    function removeUpFile8(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var upfile8OldName = $("#upfile8OldName").val();
        var upfile8Type = $("#upfile8Type").val();
        var upfile8Size = $("#upfile8Size").val();
        var upfile8ReturnUrl = $("#upfile8ReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");
                var returnUrlList = upfile8ReturnUrl.split(',');
                var index = 0;
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        returnUrlList.splice(i, 1);
                        index = i;
                    }
                }
                upfile8ReturnUrl = returnUrlList.join(",");
                $("#upfile8ReturnUrl").val(upfile8ReturnUrl);

                var oldNameList = upfile8OldName.split(',');
                oldNameList.splice(index, 1);
                upfile8OldName = oldNameList.join(",");
                $("#upfile8OldName").val(upfile8OldName);

                var typeList = upfile8Type.split(',');
                typeList.splice(index, 1);
                upfile8Type = typeList.join(",");
                $("#upfile8Type").val(upfile8Type);

                var sizeList = upfile8Size.split(',');
                sizeList.splice(index, 1);
                upfile8Size = sizeList.join(",");
                $("#upfile8Size").val(upfile8Size);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
    // 删除审阅人
    function deleteRecorderUsers(obj) {
        $(obj).parent().attr("id","delete_recorder");
        $('#delete_recorder').innerHTML = "";
        $('#delete_recorder').remove();
    }
    //回复消息
    function replyMessage(mesId, commentId, replyToUserId){
        layer.open({
            type:2,
            title :['回复消息','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['660px', '290px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/replyIndexMessage?mesId='+mesId+'&commentId='+commentId+'&replyToUserId='+replyToUserId
        });
    }
    //附件下载
    function doDownload(fileUrl) {
        var url = APP+'/Home/Office/downloadAttachFile?fileUrl='+fileUrl;
        window.open(url, '_blank');
    }
    //添加评论
    function addComment(mesId, type) {
        // 评论内容check
        var contentObj = $("#commentContent"+type+"_"+mesId);
        if (getValLen(contentObj) == 0) {
            layer.msg("评论不能为空",{icon: 8});
            contentObj.focus();
            return false;
        } else if (getValLen(contentObj) > 500) {
            layer.msg("评论最多为500字",{icon: 8});
            contentObj.focus();
            return false;
        }

        var commentContent = $("#commentContent"+type+"_"+mesId).val();

        $.post("<?php echo U('Office/addComment');?>", {"commentContent":commentContent, "mesId":mesId}, function(data) {
            if(data.error_code == "success") {
                var page = $("#page"+type).val();
                refreshMessageList();
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
        }, 'json');
    }
    // 流程详细画面
    function showProcessDetail(processId, busiType, type) {
        var page = $("#page".type).val();
        switch(busiType)
        {
            case 1: // 费用
                layer.open({
                    type:2,
                    title:['费用详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
                    area:['700px', '600px'],
                    shadeClose:false,
                    content:APP+'/Home/Office/showIndexFeeDetail?processId='+processId+'&page='+page
                });
                break;
            case 2: // 报销
                layer.open({
                    type:2,
                    title:['报销详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
                area:['700px', '600px'],
                    shadeClose:false,
                    content:APP+'/Home/Office/showIndexApplyDetail?processId='+processId+'&page='+page
                });
                break;
            case 3: // 请假
                layer.open({
                    type:2,
                    title:['请假详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
                    area:['700px', '600px'],
                    shadeClose:false,
                    content:APP+'/Home/Office/showIndexLeaveDetail?processId='+processId+'&page='+page
                });
                break;
            case 4: // 出差
                layer.open({
                    type:2,
                    title:['出差详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
                    area:['700px', '600px'],
                    shadeClose:false,
                    content:APP+'/Home/Office/showIndexTravelDetail?processId='+processId+'&page='+page
                });
                break;
            case 5: // 加班
                layer.open({
                    type:2,
                    title:['加班详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
                    area:['700px', '600px'],
                    shadeClose:false,
                    content:APP+'/Home/Office/showIndexOverWorkDetail?processId='+processId+'&page='+page
                });
                break;
        }
    }
    function createPageBar1(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar1");
    }
    function createPageBar2(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar2");
    }
    function createPageBar3(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar3");
    }
    function createPageBar4(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar4");
    }
    function createPageBar5(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar5");
    }
    // 最新消息个数
    function newMessageCount() {
        var count = $("#messageAllCount").val();
        var diff = 0;

        $.post("<?php echo U('Office/getMessageCount');?>", {}, function(data) {
            if(data.error_code == "success") {
                var newCount = data.allMessageCount;
                if(newCount > count) {
                    diff = newCount - count;
                    if(diff > 0) {
                        $("#showNew").show();
                        $("#showNewMessage").html(diff);
                    }
                }
            }
        }, 'json');
    }
    // 查询消息列表信息
    function getMessageList(type, page) {
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/getMessageList');?>", {"page":page, "type":type}, function(data) {
            if(type == 1) {
                $("#showNewMessage").html(0);
                $("#showNew").hide();
                $("#messageAllCount").val(data.messageCount);
            }
            var content = "";
            switch(type)
            {
                case 1: // 全部
                    $("#contentListAll").empty();
                    break;
                case 2: // 我发起的
                    $("#contentListMy").empty();
                    break;
                case 3: // @我的
                    $("#contentListAt").empty();
                    break;
            }
            if (!("messageList" in data)) {
                content = '<ul class="topnone">';
                content += '<li style="width: 100%;color:#f47469;text-align: center;">暂无数据，请创建消息!</li>';
                content += '</ul>';

                switch(type)
                {
                    case 1: // 全部
                        $("#contentListAll").append(content);
                        createPageBar1(data.total, data.pageSize, data.page, data.totalPage);
                        break;
                    case 2: // 我发起的
                        $("#contentListMy").append(content);
                        createPageBar2(data.total, data.pageSize, data.page, data.totalPage);
                        break;
                    case 3: // @我的
                        $("#contentListAt").append(content);
                        createPageBar3(data.total, data.pageSize, data.page, data.totalPage);
                        break;
                }
                layer.close(loadIdx);
                return;
            }
            // 设定用户列表
            $.each(data.messageList, function(k, v) {
                content += '<ul id="message_list_'+ k +'">';

                var headLogo = v.headLogo;
                var userName = v.userName;
                if(!userName) {
                    userName = "";
                }
                content += '<img src="'+ headLogo +'" width="50" height="50" />';
                content += '<div class="msgList"><div><li><div>';
                content += '<span style="margin-right: 15px;color: #14bec1;">'+ userName +'</span>';
                content += '<span>'+ v.createTime +'&nbsp;';
                content += '</span></div>';
                content += '<div><span class="msg_content1">'+ v.mesContent +'</span></div>';
                content += '</li></div>';

                $.each(v.commentList, function(c, comment) {

                    var userName = comment.userName;
                    if(!userName) {
                        userName = "";
                    }
                    content += '<br/><div><li><div>';
                    content += '<span style="margin-right: 15px;color: #14bce1;">'+ userName +'</span>';
                    content += '<span>'+ comment.createTime +'</span></div>';
                    content += '<div><span class="msg_content2">'+ comment.commentContent +'</span><p><a>';
                    content += '<span style="margin-top: -11px;" class="fa-stack fa-lg">';
                    content += '<i  class="fa fa-comment fa-stack-1x"></i>';
                    content += '<i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i></span>';
                    content += '<span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage('+ v.mesId +', '+ comment.commentId +', '+ comment.commentUserId +');">回复</span>';
                    content += '</a></p></div></li>';

                    $.each(comment.replyList, function(r, reply) {
                        var userName = reply.userName;
                        if(!userName) {
                            userName = "";
                        }
                        var replyToUserName = reply.replyToUserName;
                        if(!replyToUserName) {
                            replyToUserName = "";
                        }
                        content += '<li style="margin-left:55px;">';
                        content += '<div>';
                        content += '<span style="margin-right: 15px;color: #14bce1;">'+ userName +' <i style="color: #999;">回复</i> '+ replyToUserName +'</span>';
                        content += '<span>'+ reply.createTime +'</span></div>';
                        content += '<div><span class="msg_content3">'+ reply.replyContent +'</span><p><a>';
                        content += '<span style="margin-top: -11px;" class="fa-stack fa-lg">';
                        content += '<i  class="fa fa-comment fa-stack-1x"></i>';
                        content += '<i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i></span>';
                        content += '<span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage('+ v.mesId +', '+ comment.commentId +', '+ reply.replyUserId +');">回复</span>';
                        content += '</a></p></div></li>';
                    });
                    content += '</div>';
                });
                content += '<br><li>';
                content += '<textarea class="comment" placeholder="我也说一句" id="commentContent'+ type +'_'+ v.mesId +'"></textarea>';
                content += '<input type="button" style="float: left;width: 70px;height: 25px;cursor: pointer;color: #fff;border: 1px none;background:#14bce1;margin: 0 12px;" value="评论" onclick="addComment('+ v.mesId +',' + type + ');"/>';
                content += '</li>';
                content += '<div class="showfujian">';
                if(v.attachList) {
                    var attachList = v.attachList;
                    for (var m = 0; m < attachList.length; m ++) {
                        content += '<a style="margin-left: 18px;" href="javascript:void();" title="'+ attachList[m]['displayName'] +'" onclick="javascript:doDownload(\''+attachList[m]['url']+'\');">'+ attachList[m]['displayName'] +'</a>';
                    }
                }
                content += '</div></div></ul>';
            });
            if (content == "") {
                content = '<ul class="topnone">';
                content += '<li style="width: 100%;color:#f47469;text-align: center;">暂无数据，请创建消息!</li>';
                content += '</ul>';
            }
            switch(type)
            {
                case 1: // 全部
                    $("#contentListAll").append(content);
                    createPageBar1(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                case 2: // 我发起的
                    $("#contentListMy").append(content);
                    createPageBar2(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                case 3: // @我的
                    $("#contentListAt").append(content);
                    createPageBar3(data.total, data.pageSize, data.page, data.totalPage);
                    break;
            }
            layer.close(loadIdx);
            reloadFocus();
        }, 'json');
    }
    // 刷新消息列表信息
    function refreshMessageList() {
        var page1 = $("#page1").val();
        var page2 = $("#page2").val();
        var page3 = $("#page3").val();

        getMessageList(1, page1);
        getMessageList(2, page2);
        getMessageList(3, page3);
    }
    // 查询流程列表信息
    function getApprovalList(type, page) {
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/getProcessList');?>", {"page":page, "type":type}, function(data) {
            var content = "";
            switch(type)
            {
                case 2: // 待处理
                    $("#processListWait").empty();
                    break;
                case 3: // 已处理
                    $("#processListApproval").empty();
                    break;
            }
            if (!("processList" in data)) {
                content = '<ul class="topnone">';
                content += '<li style="width: 100%;color:#f47469;text-align: center;">暂无数据，请创建消息!</li>';
                content += '</ul>';

                switch(type)
                {
                    case 2: // 待处理
                        $("#processListWait").append(content);
                        createPageBar4(data.total, data.pageSize, data.page, data.totalPage);
                        break;
                    case 3: // 已处理
                        $("#processListApproval").append(content);
                        createPageBar5(data.total, data.pageSize, data.page, data.totalPage);
                        break;
                }
                layer.close(loadIdx);
                return;
            }
            // 设定用户列表
            $.each(data.processList, function(k, v) {
                var key = 4;
                if(type == 3) {
                    key = 5;
                }
                content += '<ul>';
                content += '<li style="width: 30%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="' + v.title + '"><a onclick="showProcessDetail(\'' + v.processId + '\', ' + v.busiType + ', ' + key + ');">' + v.title + '</a></li>';
                content += '<li style="width: 40%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="' + v.formContent + '"> ' + v.formContent + '</li>';
                content += '<li style="width: 30%">' + v.createTime + '</li>';
                content += '</ul>';
            });
            if (content == "") {
                content = '<ul class="topnone">';
                content += '<li style="width: 100%;color:#f47469;text-align: center;">暂无数据!</li>';
                content += '</ul>';
            }
            switch(type)
            {
                case 2: // 我发起的
                    $("#processListWait").append(content);
                    createPageBar4(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                case 3: // @我的
                    $("#processListApproval").append(content);
                    createPageBar5(data.total, data.pageSize, data.page, data.totalPage);
                    break;
            }
            layer.close(loadIdx);
        }, 'json');
    }
 
    var myDate = new Date();
    myDate.getFullYear();    //获取完整的年份(4位,1970-????)
    myDate.getMonth(); 
    var monthSelecter=$("#monthSelecter");
    var nowMonth = getDateMy(301,"","",0);
    monthSelecter.append('<option value="'+getDateMy(302,nowMonth,"",-2)+'">'+getDateMy(302,nowMonth,"",-2)+'</option>');
    monthSelecter.append('<option value="'+getDateMy(302,nowMonth,"",-1)+'">'+getDateMy(302,nowMonth,"",-1)+'</option>');     
    monthSelecter.append('<option selected value="'+nowMonth+'">'+nowMonth+'</option>');     
    monthSelecter.append('<option value="'+getDateMy(302,nowMonth,"",1)+'">'+getDateMy(302,nowMonth,"",1)+'</option>');     
    monthSelecter.append('<option value="'+getDateMy(302,nowMonth,"",2)+'">'+getDateMy(302,nowMonth,"",2)+'</option>');     
    var weekSelecter=$("#weekSelecter");
    var weekBegin = getDateMy(201,"","",0);
    var weekEnd = getDateMy(2011,"","",0);
    weekSelecter.append('<option value="'+getDateMy(202,weekBegin,weekEnd,-2)+'">'+getDateMy(202,weekBegin,weekEnd,-2)+'</option>');
    weekSelecter.append('<option value="'+getDateMy(202,weekBegin,weekEnd,-1)+'">'+getDateMy(202,weekBegin,weekEnd,-1)+'</option>');     
    weekSelecter.append('<option selected value="'+weekBegin+"～"+weekEnd+'">'+weekBegin+"～"+weekEnd+'</option>');     
    weekSelecter.append('<option value="'+getDateMy(202,weekBegin,weekEnd,1)+'">'+getDateMy(202,weekBegin,weekEnd,1)+'</option>');     
    weekSelecter.append('<option value="'+getDateMy(202,weekBegin,weekEnd,2)+'">'+getDateMy(202,weekBegin,weekEnd,2)+'</option>'); 
    //alert(new Date().Format("yyyy-MM-dd"));
  $("#form3 #date").val(new Date().Format("yyyy-MM-dd"));
  
    // 刷新流程列表信息
    function refreshApprovalList() {
        var page4 = $("#page4").val();
        var page5 = $("#page5").val();

        getApprovalList(2, page4);
        getApprovalList(3, page5);
    }
    
	function getDateMy(idValue,inDate,inDate2,subAdd) {
		//本周
		if (idValue ==201){
			var weekDay = new Date().getDay();
			var fromDate = new Date(new Date().getTime() - weekDay*24*60*60*1000); 
			var toDate = new Date(new Date().getTime() + (6-weekDay)*24*60*60*1000);  
			return fromDate.Format("yyyy-MM-dd")
		}
		
		if (idValue ==2011){
			var weekDay = new Date().getDay();
			var fromDate = new Date(new Date().getTime() - weekDay*24*60*60*1000); 
			var toDate = new Date(new Date().getTime() + (6-weekDay)*24*60*60*1000);  
			return toDate.Format("yyyy-MM-dd")
		}
		
		//前一周 zhou_dateF
		if (idValue ==202){ 
			var oldFromDate =inDate;
			var oldToDate =inDate2;
			oldFromDate = new Date(Date.parse(oldFromDate.replace(/-/g, "/")));  
			oldToDate = new Date(Date.parse(oldToDate.replace(/-/g, "/"))); 
			var fromDate = new Date(oldFromDate.getTime() + subAdd*7*24*60*60*1000);  //后一天
			var toDate = new Date(oldToDate.getTime() + subAdd*7*24*60*60*1000);  //后一天
			return fromDate.Format("yyyy-MM-dd")+"～"+toDate.Format("yyyy-MM-dd")
		}
		
		//本月
		if (idValue ==301){
			//document.getElementById("yue_date").value = new Date().Format("yyyy-MM")
			//document.getElementById("yue_span").innerHTML=document.getElementById("yue_date").value
			return  new Date().Format("yyyy-MM");
		}
		//前一月
		if (idValue ==302){
			strDate = inDate+"-01"
			now = new Date(strDate.replace(/\-/g,"/"));
			perMonth =new Date( now.setMonth(now.getMonth() + subAdd));
			//alert (perMonth.Format("yyyy-MM"));
			//document.getElementById("yue_date").value = perMonth.Format("yyyy-MM");
			//document.getElementById("yue_span").innerHTML=perMonth.Format("yyyy-MM");
			return perMonth.Format("yyyy-MM");
		}
	}
	 
</script>
<input type="hidden"  id="state"  value="<?php echo ($state); ?>"/>
<input type="hidden"  id="ifsuper" value="<?php if(in_array('e1',$access_array)){ echo 1; }else{ echo 0; } ?>"/>
</body>
</html>