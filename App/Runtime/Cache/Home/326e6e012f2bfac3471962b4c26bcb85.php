<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <!--<script src="/wisdom/Public/static/js/tealeaf.js"></script>-->
        <script src="/wisdom/Public/static/js/jquery.JPlaceholder.js"></script>
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

                <!--<div class="search">-->
                    <!--<div class='input_input'><input type="text" name="search_text" id="search_text"></div>-->
                    <!--<div class="input_icon"><span class="fa fa-search fa-lg"></span></div>-->
                <!--</div>-->

                <div class="personal_info">
                    <div  style="width:100%;"><div class="pro_img"><img style="height: 35px;" src="/wisdom/Public/Home/Default/images/user2.jpg"></div><div><?php echo empty(cookie("trueName"))?cookie("mobile"):cookie("trueName"); ?><b class="caret"></b></div></div>
                    <div class="personal_info_set">
                       <ul>
<!--                        <li>帮助</li>-->
                       
                        <?php if( !in_array("e1",$access_array) ){ echo "<!--"; } ?><li onclick="location.href = APP+'/Admin/Group/index'">企业设置</li>
                                                                               <?php if( !in_array("e1",$access_array) ){ echo "-->"; } ?></li>
                        <li onclick="location.href = APP+'/Home/Business/index'">返回首页
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
            $(".personal_info").mouseover(function(event) {
                $(".personal_info_set").show();
            });
            $(".personal_info").mouseout(function(event){
                $(".personal_info_set").hide();
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
            <li id="0" class="org_box org_box_select"><span class="org_bot_cor"></span>任务列表</li>
            <li id="1" class="org_box"><span ></span>我的任务</li>
            <li id="2" class="org_box"><span ></span>任务执行全貌</li>
        </ul>
    </div>
    <div class="approval_center">
        <!-- 任务列表-->
     <div id="a0">
         <div class="approval_head" style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;">
             <span style="display: inline-block;">首页&nbsp;>&nbsp;任务>&nbsp;任务列表</span>
             <div class="column">
                 <span style="float: left;">筛选：</span>
                 <!-- 员工部门-->
                 <div class="personmsg">
                     <ul>
                         <li>
                             <label>任务主题&nbsp;</label>
                             <input type="text" />
                             <!--<select id="reimbursementType" style="width:140px;">-->
                                 <!--<option value="1"> 我发起的流程 </option>-->
                                 <!--<option value="2"> 待我审批的流程 </option>-->
                                 <!--<option value="3"> 我已审批的流程 </option>-->
                             <!--</select>-->
                         </li>
                         <li>
                             <label>任务状态&nbsp;</label>
                             <select id="reimbursementStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="1"> 未提交 </option>
                                 <option value="2"> 待处理 </option>
                                 <option value="3"> 审核通过 </option>
                                 <option value="4"> 审核不通过 </option>
                                 <option value="5"> 已撤销 </option>
                             </select>
                         </li>
                         <li>
                             <span>&nbsp;&nbsp;&nbsp;任务周期&nbsp;</span>
                             <input id="startDate1" class="laydate-icon" value="" placeholder="起始时间" style="width: 85px;padding-left: 8px;height:25px;">
                             <span>&nbsp;至&nbsp;</span>
                             <input id="endDate1" class="laydate-icon" value="" placeholder="终止时间" style="width: 85px;padding-left: 8px;height: 25px;">
                         </li>
                     </ul>
                 </div>
                 <input type="hidden" id="hidRType" value="1">
                 <input type="hidden" id="hidSDate1" value="">
                 <input type="hidden" id="hidEDate1" value="">
                 <input type="hidden" id="hidRStatus" value="">
                 <!-- 按钮-->
                 <p style="height: 25px;float: right">
                     <input id="searchButton" class="bntns" type="button" value="搜索" onclick="getApprovalList(2, 1, 1);">
                     <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClearReimbursement();">
                     <!--<input id="exprotButton" class="bntns bntns1" type="button" onclick="location='approvalAdd.html'" value="新增">-->
                 </p>
             </div>
         </div>
         <!--列表-->
         <div class="approval_list">
             <p style="height: 25px;margin: 0 0 12px;float: right;">
                 <input id="" class="bntns1" type="button" onclick="tip()" value="下达">
                 <input id="" class="bntns1" type="button" onclick="doCancel()" value="作废">
                 <input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="addTask()" value="新增">

             </p>
             <div class="title">
                 <ul>
                     <li style="width: 5%;">选择</li>
                     <li style="width: 15%;">任务编号</li>
                     <li style="width: 20%;">任务主题</li>
                     <li style="width: 10%;">开始日期</li>
                     <li style="width: 10%;">结束日期</li>
                     <li style="width: 10%;">下达日期</li>
                     <li style="width: 15%;">参与人员</li>
                     <li style="width: 10%;">任务状态</li>
                     <li style="width: 5%;">附件</li>
                 </ul>
             </div>
             <div class="contentList">
                <div id="reimbursementContentList">
                    <?php for($i=0;$i<9;$i++){?>
                 <ul>
                     <li style="width: 5%;"><input type="checkbox"></li>
                     <li style="width: 15%;">TASK01222222222</li>
                     <li style="width: 20%;cursor: pointer;" onclick="showTaskDetail();" title="关于XXXXXX小宝招商的任务"><a>关于XXXXXX小宝招商的任务</a></li>
                     <li style="width: 10%;">2015-9-8</li>
                     <li style="width: 10%;">2015-9-9</li>
                     <li style="width: 10%;">2015-6-6</li>
                     <li style="width: 15%;">小花，小的</li>
                     <li style="width: 10%;">起草中</li>
                     <li style="width: 5%;cursor: pointer;"><a onclick="showFJ()">有</a></li>
                 </ul>
                    <?php }?>
                </div>
             </div>
            <div id="pagebar1" class="pagebar" style="margin-top:20px;"></div>
            <input type="hidden" id="page1" value="1">
         </div>
     </div>
        <!-- 我的任务-->
        <div id="a1" style="display: none;">
            <div class="approval_head" style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;">
                <span style="display: inline-block;">首页&nbsp;>&nbsp;任务>&nbsp;任务列表</span>
                <div class="column">
                    <span style="float: left;">筛选：</span>
                    <!-- 员工部门-->
                    <div class="personmsg">
                        <ul>
                            <li>
                                <label>任务主题&nbsp;</label>
                                <input type="text" />
                            </li>
                            <li>
                                <label>任务状态&nbsp;</label>
                                <select id="reimbursementStatus" style="width:110px;">
                                    <option value=""> --请选择-- </option>
                                    <option value="1"> 未提交 </option>
                                    <option value="2"> 待处理 </option>
                                    <option value="3"> 审核通过 </option>
                                    <option value="4"> 审核不通过 </option>
                                    <option value="5"> 已撤销 </option>
                                </select>
                            </li>
                            <li>
                                <span>&nbsp;&nbsp;&nbsp;任务周期&nbsp;</span>
                                <input id="startDate1" class="laydate-icon" value="" placeholder="起始时间" style="width: 85px;padding-left: 8px;height:25px;">
                                <span>&nbsp;至&nbsp;</span>
                                <input id="endDate1" class="laydate-icon" value="" placeholder="终止时间" style="width: 85px;padding-left: 8px;height: 25px;">
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" id="hidRType" value="1">
                    <input type="hidden" id="hidSDate1" value="">
                    <input type="hidden" id="hidEDate1" value="">
                    <input type="hidden" id="hidRStatus" value="">
                    <!-- 按钮-->
                    <p style="height: 25px;float: right">
                        <input id="searchButton" class="bntns" type="button" value="搜索" onclick="getApprovalList(2, 1, 1);">
                        <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClearReimbursement();">
                        <!--<input id="exprotButton" class="bntns bntns1" type="button" onclick="location='approvalAdd.html'" value="新增">-->
                    </p>
                </div>
            </div>
            <!--列表-->
            <div class="approval_list">
                <p style="height: 25px;margin: 0 0 12px;float: right;">
                    <input id="" class="bntns1" type="button" onclick="doTaskDetail()" value="执行">
                    <input id="" class="bntns1" type="button" onclick="doMove()" value="转移">
                    <!--<input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="addTask()" value="新增">-->

                </p>
                <div class="title">
                    <ul>
                        <li style="width: 5%;">选择</li>
                        <li style="width: 15%;">任务编号</li>
                        <li style="width: 20%;">任务主题</li>
                        <li style="width: 15%;">要求开始日期</li>
                        <li style="width: 15%;">要求结束日期</li>
                        <li style="width: 10%;">任务状态</li>
                        <li style="width: 10%;">任务进度</li>
                        <li style="width: 10%;">附件</li>
                    </ul>
                </div>
                <div class="contentList">
                    <div id="reimbursementContentList">
                        <?php for($i=0;$i<9;$i++){?>
                        <ul>
                            <li style="width: 5%;"><input type="checkbox"></li>
                            <li style="width: 15%;">TASK01222222222</li>
                            <li style="width: 20%;cursor: pointer;" onclick="doTaskDetail();" title="关于XXXXXX小宝招商的任务"><a>关于XXXXXX小宝招商的任务</a></li>
                            <li style="width: 15%;">2015-9-8</li>
                            <li style="width: 15%;">2015-9-9</li>
                            <li style="width: 10%;">执行中</li>
                            <li style="width: 10%;">10%</li>
                            <li style="width: 10%;cursor: pointer;"><a onclick="showFJ()">有</a></li>
                        </ul>
                        <?php }?>
                    </div>
                </div>
                <div id="pagebar1" class="pagebar" style="margin-top:20px;"></div>
                <input type="hidden" id="page1" value="1">
            </div>
        </div>
        <!-- 任务执行全貌-->
        <div id="a2" style="display: none;">
            <div class="approval_head"> <!-- style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;"=========暂时隐藏，二期开发========= -->
                <span style="display: inline-block;">首页&nbsp;>&nbsp;任务>&nbsp;任务执行全貌</span>
                <div class="column">
                    <span style="float: left;">筛选：</span>
                    <!-- 员工部门-->
                    <div class="personmsg">
                        <ul>
                            <li>
                                <label>分类&nbsp;</label>
                                <select id="businessTripType" style="width:140px;">
                                 <option value="1"> 我发起的流程 </option>
                                 <option value="2"> 待我审批的流程 </option>
                                 <option value="3"> 我已审批的流程 </option>
                                </select>
                            </li>
                            <li>
                                <span>&nbsp;&nbsp;&nbsp;申请日期&nbsp;</span>
                                <input id="startDate3" class="laydate-icon" value="" placeholder="起始时间" style="width: 85px;padding-left: 8px;height:25px;">
                                <span>&nbsp;至&nbsp;</span>
                                <input id="endDate3" class="laydate-icon" value="" placeholder="终止时间" style="width: 85px;padding-left: 8px;height: 25px;">
                            </li>
                            <li>
                                <label>状态&nbsp;</label>
                                <select id="businessTripStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="1"> 未提交 </option>
                                 <option value="2"> 待处理 </option>
                                 <option value="3"> 审核通过 </option>
                                 <option value="4"> 审核不通过 </option>
                                 <option value="5"> 已撤销 </option>
                                </select>
                            </li>

                        </ul>
                    </div>
                    <input type="hidden" id="hidBTType" value="1">
                    <input type="hidden" id="hidSDate3" value="">
                    <input type="hidden" id="hidEDate3" value="">
                    <input type="hidden" id="hidBTStatus" value="">
                    <!-- 按钮-->
                    <p style="height: 25px;float: right">
                        <input id="searchButton" class="bntns" type="button" value="搜索" onclick="getApprovalList(4, 1, 1);">
                        <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClearBusinessTrip();">
                        <!--<input id="exprotButton" class="bntns bntns1" type="button" onclick="location='approvalAdd.html'" value="新增">-->
                    </p>
                </div>
            </div>
            <!--列表-->
            <div class="approval_list">
                <!-- 按钮=============暂时隐藏，二期开发===========-->
                <!--<p style="height: 25px;margin: 0 0 12px;float: right;">-->
                    <!--<input id="" class="bntns1" type="button" value="导入">-->
                    <!--<input id="" class="bntns1" type="button" value="导出">-->
                    <!--<input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="addTravel()" value="新增">-->
                    <!--<input id="" style="background: #f47469;" class="bntns1" type="button" value="删除">-->
                <!--</p>-->
                <div class="title">
                    <ul>
                        <li style="width: 19%;">编号</li>
                        <li style="width: 15%;">主题</li>
                        <li style="width: 30%;">申请内容</li>
                        <li style="width: 8%;">申请人</li>
                        <li style="width: 8%;">下级审批人</li>
                        <li style="width: 10%;">状态</li>
                        <li style="width: 10%;">申请日期</li>
                        <!--<li style="width: 10%;">置顶</li>-->
                        <!--<li style="width: 5%;">附件</li>-->
                        <!--<li style="width: 10%;">操作</li>-->
                    </ul>
                </div>
                <div class="contentList">
                    <div id="businessTripContentList">
                    <?php if(!empty($businessTrip_list["processList"])): if(is_array($businessTrip_list["processList"])): $i = 0; $__LIST__ = $businessTrip_list["processList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$businessTrip): $mod = ($i % 2 );++$i;?><ul>
                         <li style="width: 19%;"><?php echo ($businessTrip["processNo"]); ?></li>
                         <li style="width: 15%;cursor: pointer;" onclick="showTravelDetail('<?php echo ($businessTrip["processId"]); ?>');" title="<?php echo ($businessTrip["title"]); ?>"><a><?php echo ($businessTrip["title"]); ?></a></li>
                         <li style="width: 30%;" title="<?php echo ($businessTrip["formContent"]); ?>"><?php echo ($businessTrip["formContent"]); ?>&nbsp;</li>
                         <li style="width: 8%;"><?php echo ($businessTrip["applicantName"]); ?>&nbsp;</li>
                         <li style="width: 8%;"><?php echo ($businessTrip["currentHandlerPerson"]); ?>&nbsp;</li>
                         <li style="width: 10%;">
                            <?php  switch ($businessTrip['status']) { case 1: echo "未提交"; break; case 2: echo "待处理"; break; case 3: echo "审核通过"; break; case 4: echo "审核不通过"; break; case 5: echo "撤销"; break; default: echo "未提交"; break; }?>
                         </li>
                         <li style="width: 10%;"><?php echo date("Y-m-d", strtotime($businessTrip['createTime']));?></li>
                     </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                    <?php if(empty($businessTrip_list["processList"])): ?><ul class="topnone">
                            <li style="width: 100%;color:#f47469;">无数据!</li>
                        </ul><?php endif; ?>
                 </div>
                 <div id="pagebar3" class="pagebar" style="margin-top:20px;"></div>
                 <input type="hidden" id="page3" value="1">
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
    $('#bigmenu li').click(function(){
        // $("#business_success_page").empty();
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


    //新增任务
    function addTask(){
        layer.open({
            type:2,
            title :['新增任务','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '698px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addTask'
        });
    }

    //任务详情
    function showTaskDetail(){
        layer.open({
            type:2,
            title :['任务详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['840px', '505px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/showTask'
        });
    }
    //提示框
    function tip(){
        layer.open({
            type:2,
            title :['提示','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['390px', '200px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/showTip1'
        });
    }
    //作废
    function doCancel(){
        layer.open({
            type:2,
            title :['作废','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['880px', '300px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/cancel'
        });
    }
    //附件
    function showFJ(){
        layer.open({
            type:2,
            title :['附件列表','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['730px', '390px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/showFJ'
        });
    }
    //任务执行详情
    function doTaskDetail(){
        layer.open({
            type:2,
            title :['任务执行详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '589px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/doTask'
        });
    }
    //转移
    function doMove(){
        layer.open({
            type:2,
            title :['转移','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['880px', '360px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/move'
        });
    }
    $(function() {
        Cookie.eraseCookie("bigMenuIndex");
        Cookie.eraseCookie("smallMenuIndex");
        Cookie.createCookie("bigMenuIndex", 0);
        Cookie.createCookie("smallMenuIndex", 0);



    })
</script>
</body>
</html>