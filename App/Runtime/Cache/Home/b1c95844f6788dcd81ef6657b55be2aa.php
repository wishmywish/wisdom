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
    <div id="rev_menu_left" class="class_menu_left" style="margin-right: 20px;">
        <ul id="bigmenu">
            <li id="0" class="org_box org_box_select" onclick="getApprovalList(2, 1, 1);"><span class="org_bot_cor"></span>报销</li>
            <li id="1" class="org_box" onclick="getApprovalList(3, 1, 1);"><span ></span>请假</li>
            <li id="2" class="org_box" onclick="getApprovalList(4, 1, 1);"><span ></span>出差</li>
            <li id="3" class="org_box" onclick="getApprovalList(1, 1, 1);"><span ></span>费用</li>
            <li id="4" class="org_box" onclick="getApprovalList(5, 1, 1);"><span ></span>加班</li>
        </ul>
    </div>
    <div class="approval_center">
        <!-- 报销-->
     <div id="a0">
         <div class="approval_head"> <!--style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;"========暂时隐藏，二期做-->
         <!-- 
             <span style="display: inline-block;">首页&nbsp;>&nbsp;工作审批>&nbsp;报销</span>
          -->
          <span style="display: inline-block;">工作审批>&nbsp;报销</span>
             <div class="column">
                 <span style="float: left;">筛选：</span>
                 <!-- 员工部门-->
                 <div class="personmsg">
                     <ul>
                         <li>
                             <label>分类&nbsp;</label>
                             <select id="reimbursementType" style="width:140px;">
                                 <option value="1"> 我发起的流程 </option>
                                 <option value="2"> 待我审批的流程 </option>
                                 <option value="3"> 我已审批的流程 </option>
                             </select>
                         </li>
                         <li>
                             <span>&nbsp;&nbsp;&nbsp;申请日期&nbsp;</span>
                             <input id="startDate1" class="laydate-icon" value="" placeholder="起始时间" style="width: 85px;padding-left: 8px;height:25px;">
                             <span>&nbsp;至&nbsp;</span>
                             <input id="endDate1" class="laydate-icon" value="" placeholder="终止时间" style="width: 85px;padding-left: 8px;height: 25px;">
                         </li>
                         <li>
                             <label>状态&nbsp;</label>
<!--  
                             <select id="reimbursementStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="1"> 未提交 </option>
                                 <option value="2"> 待处理 </option>
                                 <option value="3"> 审核通过 </option>
                                 <option value="4"> 审核不通过 </option>
                                 <option value="5"> 已撤销 </option>
                             </select>
                             审批中，审批同意，审批不同意，撤销
                             -->
                             <select id="reimbursementStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="2"> 审批中 </option>
                                 <option value="3"> 审批同意 </option>
                                 <option value="4"> 审批不同意 </option>
                                 <option value="5"> 撤销 </option>
                             </select>
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
             <!-- 按钮=============暂时隐藏，二期开发===========-->
             <!--<p style="height: 25px;margin: 0 0 12px;float: right;">-->
                 <!--<input id="" class="bntns1" type="button" value="导入">-->
                 <!--<input id="" class="bntns1" type="button" value="导出">-->
                 <!--<input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="addApply()" value="新增">-->
                 <!--<input id="" style="background: #f47469;" class="bntns1" type="button" value="删除">-->
             <!--</p>-->
             <div class="title">
                 <ul>
                     <li style="width: 19%;">编号</li>
                     <li style="width: 15%;">主题</li>
                     <li style="width: 25%;">申请内容</li>
                     <li style="width: 8%;">申请人</li>
                     <li style="width: 8%;">下级审批人</li>
                     <li style="width: 10%;">状态</li>
                     <li style="width: 15%;">申请日期</li>
                     <!--<li style="width: 10%;">置顶</li>-->
                     <!--<li style="width: 5%;">附件</li>-->
                     <!--<li style="width: 10%;">操作</li>-->
                 </ul>
             </div>
             <div class="contentList">
                <div id="reimbursementContentList">
                <?php if(!empty($reimbursement_list["processList"])): if(is_array($reimbursement_list["processList"])): $i = 0; $__LIST__ = $reimbursement_list["processList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reimbursement): $mod = ($i % 2 );++$i;?><ul>
                     <li style="width: 19%;"><?php echo ($reimbursement["processNo"]); ?></li>
                     <li style="width: 15%;cursor: pointer;color: #014f97" onclick="showApplyDetail('<?php echo ($reimbursement["processId"]); ?>');" title="<?php echo ($reimbursement["title"]); ?>"><a><?php echo ($reimbursement["title"]); ?></a></li>
                     <li style="width: 25%;" title="<?php echo ($reimbursement["formContent"]); ?>"><?php echo ($reimbursement["formContent"]); ?>&nbsp;</li>
                     <li style="width: 8%;"><?php echo ($reimbursement["applicantName"]); ?>&nbsp;</li>
                     <li style="width: 8%;"><?php echo ($reimbursement["currentHandlerPerson"]); ?>&nbsp;</li>
                     <li style="width: 10%;">
                        <?php
 switch ($reimbursement['status']) { case '2': echo "审批中"; break; case '3': echo "审批同意"; break; case '4': echo "审批不同意"; break; case '5': echo "撤销"; break; default: echo "审批中"; break; } ?>
                     </li>
                     <li style="width: 15%;"><?php echo $reimbursement['createTime'];?></li>
                 </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <?php if(empty($reimbursement_list["processList"])): ?><ul class="topnone">
                        <li style="width: 100%;color:#f47469;">无数据!</li>
                    </ul><?php endif; ?>
                </div>
             </div>
            <div id="pagebar1" class="pagebar" style="margin-top:20px;"></div>
            <input type="hidden" id="page1" value="1">
         </div>
     </div>
        <!-- 请假-->
        <div id="a1" style="display: none;">
            <div class="approval_head"> <!--  style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;"=============暂时隐藏，二期开发===========-->
                <span style="display: inline-block;">工作审批>&nbsp;请假</span>

                <div class="column">
                    <span style="float: left;">筛选：</span>
                    <!-- 员工部门-->
                    <div class="personmsg">
                        <ul>
                            <li>
                                <label>分类&nbsp;</label>
                                <select id="leaveType" style="width:140px;">
                                 <option value="1"> 我发起的流程 </option>
                                 <option value="2"> 待我审批的流程 </option>
                                 <option value="3"> 我已审批的流程 </option>
                                </select>
                            </li>
                            <li>
                                <span>&nbsp;&nbsp;&nbsp;申请日期&nbsp;</span>
                                <input id="startDate2" class="laydate-icon" value="" placeholder="起始时间" style="width: 85px;padding-left: 8px;height:25px;">
                                <span>&nbsp;至&nbsp;</span>
                                <input id="endDate2" class="laydate-icon" value="" placeholder="终止时间" style="width: 85px;padding-left: 8px;height: 25px;">
                            </li>
                            <li>
                            
                                <label>状态&nbsp;</label>
                               <!-- 
                                <select id="leaveStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="1"> 未提交 </option>
                                 <option value="2"> 待处理 </option>
                                 <option value="3"> 审核通过 </option>
                                 <option value="4"> 审核不通过 </option>
                                 <option value="5"> 已撤销 </option>
                                </select>
                                审批中，审批同意，审批不同意，撤销
                             -->
                             <select id="leaveStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="2"> 审批中 </option>
                                 <option value="3"> 审批同意 </option>
                                 <option value="4"> 审批不同意 </option>
                                 <option value="5"> 撤销 </option>
                             </select>
                            </li>

                        </ul>
                    </div>
                    <input type="hidden" id="hidLType" value="1">
                    <input type="hidden" id="hidSDate2" value="">
                    <input type="hidden" id="hidEDate2" value="">
                    <input type="hidden" id="hidLStatus" value="">
                    <!-- 按钮-->
                    <p style="height: 25px;float: right">
                        <input id="searchButton" class="bntns" type="button" value="搜索" onclick="getApprovalList(3, 1, 1);">
                        <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClearLeave();">
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
                    <!--<input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="addLeave()" value="新增">-->
                    <!--<input id="" style="background: #f47469;" class="bntns1" type="button" value="删除">-->
                <!--</p>-->
                <div class="title">
                    <ul>
                        <li style="width: 19%;">编号</li>
                        <li style="width: 15%;">主题</li>
                        <li style="width: 25%;">申请内容</li>
                        <li style="width: 8%;">申请人</li>
                        <li style="width: 8%;">下级审批人</li>
                        <li style="width: 10%;">状态</li>
                        <li style="width: 15%;">申请日期</li>
                        <!--<li style="width: 10%;">置顶</li>-->
                        <!--<li style="width: 5%;">附件</li>-->
                        <!--<li style="width: 10%;">操作</li>-->
                    </ul>
                </div>
                <div class="contentList">
                    <div id="leaveContentList">
                    <?php if(!empty($leave_list["processList"])): if(is_array($leave_list["processList"])): $i = 0; $__LIST__ = $leave_list["processList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$leave): $mod = ($i % 2 );++$i;?><ul>
                     <li style="width: 19%;"><?php echo ($leave["processNo"]); ?></li>
                     <li style="width: 15%;cursor: pointer;color: #014f97;" onclick="showLeaveDetail('<?php echo ($leave["processId"]); ?>');" title="<?php echo ($leave["title"]); ?>"><a><?php echo ($leave["title"]); ?></a></li>
                     <li style="width: 25%;" title="<?php echo ($leave["formContent"]); ?>"><?php echo ($leave["formContent"]); ?>&nbsp;</li>
                     <li style="width: 8%;"><?php echo ($leave["applicantName"]); ?>&nbsp;</li>
                     <li style="width: 8%;"><?php echo ($leave["currentHandlerPerson"]); ?>&nbsp;</li>
                     <li style="width: 10%;">
                        <?php  switch ($leave['status']) { case '2': echo "审批中"; break; case '3': echo "审批同意"; break; case '4': echo "审批不同意"; break; case '5': echo "撤销"; break; default: echo "审批中"; break; }?>
                     </li>
                     <li style="width: 15%;"><?php echo $leave['createTime'];?></li>
                 </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <?php if(empty($leave_list["processList"])): ?><ul class="topnone">
                        <li style="width: 100%;color:#f47469;">无数据!</li>
                    </ul><?php endif; ?>
                </div>
             </div>
             <div id="pagebar2" class="pagebar" style="margin-top:20px;"></div>
             <input type="hidden" id="page2" value="1">
            </div>
        </div>
        <!-- 出差-->
        <div id="a2" style="display: none;">
            <div class="approval_head"> <!-- style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;"=========暂时隐藏，二期开发========= -->
                <span style="display: inline-block;">工作审批>&nbsp;出差</span>
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
                                <!--  
                                <select id="businessTripStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="1"> 未提交 </option>
                                 <option value="2"> 待处理 </option>
                                 <option value="3"> 审核通过 </option>
                                 <option value="4"> 审核不通过 </option>
                                 <option value="5"> 已撤销 </option>
                                </select>
                                审批中，审批同意，审批不同意，撤销
                             -->
                             <select id="businessTripStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="2"> 审批中 </option>
                                 <option value="3"> 审批同意 </option>
                                 <option value="4"> 审批不同意 </option>
                                 <option value="5"> 撤销 </option>
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
                        <li style="width: 25%;">申请内容</li>
                        <li style="width: 8%;">申请人</li>
                        <li style="width: 8%;">下级审批人</li>
                        <li style="width: 10%;">状态</li>
                        <li style="width: 15%;">申请日期</li>
                        <!--<li style="width: 10%;">置顶</li>-->
                        <!--<li style="width: 5%;">附件</li>-->
                        <!--<li style="width: 10%;">操作</li>-->
                    </ul>
                </div>
                <div class="contentList">
                    <div id="businessTripContentList">
                    <?php if(!empty($businessTrip_list["processList"])): if(is_array($businessTrip_list["processList"])): $i = 0; $__LIST__ = $businessTrip_list["processList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$businessTrip): $mod = ($i % 2 );++$i;?><ul>
                         <li style="width: 19%;"><?php echo ($businessTrip["processNo"]); ?></li>
                         <li style="width: 15%;cursor: pointer;color: #014f97;" onclick="showTravelDetail('<?php echo ($businessTrip["processId"]); ?>');" title="<?php echo ($businessTrip["title"]); ?>"><a><?php echo ($businessTrip["title"]); ?></a></li>
                         <li style="width: 25%;" title="<?php echo ($businessTrip["formContent"]); ?>"><?php echo ($businessTrip["formContent"]); ?>&nbsp;</li>
                         <li style="width: 8%;"><?php echo ($businessTrip["applicantName"]); ?>&nbsp;</li>
                         <li style="width: 8%;"><?php echo ($businessTrip["currentHandlerPerson"]); ?>&nbsp;</li>
                         <li style="width: 10%;">
                            <?php  switch ($businessTrip['status']) { case '2': echo "审批中"; break; case '3': echo "审批同意"; break; case '4': echo "审批不同意"; break; case '5': echo "撤销"; break; default: echo "审批中"; break; }?>
                         </li>
                         <li style="width: 15%;"><?php echo $businessTrip['createTime'];?></li>
                     </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if(empty($businessTrip_list["processList"])): ?><ul class="topnone">
                            <li style="width: 100%;color:#f47469;">无数据!</li>
                        </ul><?php endif; ?>
                    </div>
                 </div>
                 <div id="pagebar3" class="pagebar" style="margin-top:20px;"></div>
                 <input type="hidden" id="page3" value="1">
            </div>
        </div>
        <!-- 费用-->
        <div id="a3" style="display: none;">
            <div class="approval_head"><!--  style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;"=============暂时隐藏，二期开发===========-->
                <span style="display: inline-block;">工作审批>&nbsp;费用</span>
                <div class="column">
                    <span style="float: left;">筛选：</span>
                    <!-- 员工部门-->
                    <div class="personmsg">
                        <ul>
                            <li>
                                <label>分类&nbsp;</label>
                                <select id="costType" style="width:140px;">
                                 <option value="1"> 我发起的流程 </option>
                                 <option value="2"> 待我审批的流程 </option>
                                 <option value="3"> 我已审批的流程 </option>
                                </select>
                            </li>
                            <li>
                                <span>&nbsp;&nbsp;&nbsp;申请日期&nbsp;</span>
                                <input id="startDate4" class="laydate-icon" value="" placeholder="起始时间" style="width: 85px;padding-left: 8px;height:25px;">
                                <span>&nbsp;至&nbsp;</span>
                                <input id="endDate4" class="laydate-icon" value="" placeholder="终止时间" style="width: 85px;padding-left: 8px;height: 25px;">
                            </li>
                            <li>
                                <label>状态&nbsp;</label>
                                <!--
                                <select id="costStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="1"> 未提交 </option>
                                 <option value="2"> 待处理 </option>
                                 <option value="3"> 审核通过 </option>
                                 <option value="4"> 审核不通过 </option>
                                 <option value="5"> 已撤销 </option>
                                </select>
                                审批中，审批同意，审批不同意，撤销
                             -->
                             <select id="costStatus" style="width:110px;">
                                 <option value=""> --请选择-- </option>
                                 <option value="2"> 审批中 </option>
                                 <option value="3"> 审批同意 </option>
                                 <option value="4"> 审批不同意 </option>
                                 <option value="5"> 撤销 </option>
                             </select>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" id="hidCType" value="1">
                    <input type="hidden" id="hidSDate4" value="">
                    <input type="hidden" id="hidEDate4" value="">
                    <input type="hidden" id="hidCStatus" value="">
                    <!-- 按钮-->
                    <p style="height: 25px;float: right">
                        <input id="searchButton" class="bntns" type="button" value="搜索" onclick="getApprovalList(1, 1, 1);">
                        <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClearCost();">
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
                    <!--<input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="addFee()" value="新增">-->
                    <!--<input id="" style="background: #f47469;" class="bntns1" type="button" value="删除">-->
                <!--</p>-->
                <div class="title">
                    <ul>
                        <li style="width: 19%;">编号</li>
                        <li style="width: 15%;">主题</li>
                        <li style="width: 25%;">申请内容</li>
                        <li style="width: 8%;">申请人</li>
                        <li style="width: 8%;">下级审批人</li>
                        <li style="width: 10%;">状态</li>
                        <li style="width: 15%;">申请日期</li>
                        <!--<li style="width: 10%;">置顶</li>-->
                        <!--<li style="width: 5%;">附件</li>-->
                        <!--<li style="width: 10%;">操作</li>-->
                    </ul>
                </div>
                <div class="contentList">
                    <div id="costContentList">
                    <?php if(!empty($cost_list["processList"])): if(is_array($cost_list["processList"])): $i = 0; $__LIST__ = $cost_list["processList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cost): $mod = ($i % 2 );++$i;?><ul>
                         <li style="width: 19%;"><?php echo ($cost["processNo"]); ?></li>
                         <li style="width: 15%;cursor: pointer;color: #014f97;" onclick="showFeeDetail('<?php echo ($cost["processId"]); ?>');" title="<?php echo ($cost["title"]); ?>"><a><?php echo ($cost["title"]); ?></a></li>
                         <li style="width: 25%;" title="<?php echo ($cost["formContent"]); ?>"><?php echo ($cost["formContent"]); ?>&nbsp;</li>
                         <li style="width: 8%;"><?php echo ($cost["applicantName"]); ?>&nbsp;</li>
                         <li style="width: 8%;"><?php echo ($cost["currentHandlerPerson"]); ?>&nbsp;</li>
                         <li style="width: 10%;">
                            <?php  switch ($cost['status']) { case '2': echo "审批中"; break; case '3': echo "审批同意"; break; case '4': echo "审批不同意"; break; case '5': echo "撤销"; break; default: echo "审批中"; break; }?>
                         </li>
                         <li style="width: 15%;"><?php echo $cost['createTime'];?></li>
                     </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if(empty($cost_list["processList"])): ?><ul class="topnone">
                            <li style="width: 100%;color:#f47469;">无数据!</li>
                        </ul><?php endif; ?>
                    </div>
                 </div>
                 <div id="pagebar4" class="pagebar" style="margin-top:20px;"></div>
                <input type="hidden" id="page4" value="1">
            </div>
        </div>
        <!-- 加班-->
        <div id="a4" style="display: none;">
            <div class="approval_head"> <!--  style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;"=============暂时隐藏，二期开发===========-->
                <span style="display: inline-block;">工作审批>&nbsp;加班</span>

                <div class="column">
                    <span style="float: left;">筛选：</span>
                    <!-- 员工部门-->
                    <div class="personmsg">
                        <ul>
                            <li>
                                <label>分类&nbsp;</label>
                                <select id="overWorkType" style="width:140px;">
                                    <option value="1"> 我发起的流程 </option>
                                    <option value="2"> 待我审批的流程 </option>
                                    <option value="3"> 我已审批的流程 </option>
                                </select>
                            </li>
                            <li>
                                <span>&nbsp;&nbsp;&nbsp;申请日期&nbsp;</span>
                                <input id="startDate5" class="laydate-icon" value="" placeholder="起始时间" style="width: 85px;padding-left: 8px;height:25px;">
                                <span>&nbsp;至&nbsp;</span>
                                <input id="endDate5" class="laydate-icon" value="" placeholder="终止时间" style="width: 85px;padding-left: 8px;height: 25px;">
                            </li>
                            <li>

                                <label>状态&nbsp;</label>
                                <!--
                                 <select id="leaveStatus" style="width:110px;">
                                  <option value=""> --请选择-- </option>
                                  <option value="1"> 未提交 </option>
                                  <option value="2"> 待处理 </option>
                                  <option value="3"> 审核通过 </option>
                                  <option value="4"> 审核不通过 </option>
                                  <option value="5"> 已撤销 </option>
                                 </select>
                                 审批中，审批同意，审批不同意，撤销
                              -->
                                <select id="overWorkStatus" style="width:110px;">
                                    <option value=""> --请选择-- </option>
                                    <option value="2"> 审批中 </option>
                                    <option value="3"> 审批同意 </option>
                                    <option value="4"> 审批不同意 </option>
                                    <option value="5"> 撤销 </option>
                                </select>
                            </li>

                        </ul>
                    </div>
                    <input type="hidden" id="hidOWType" value="1">
                    <input type="hidden" id="hidSDate5" value="">
                    <input type="hidden" id="hidEDate5" value="">
                    <input type="hidden" id="hidOWStatus" value="">
                    <!-- 按钮-->
                    <p style="height: 25px;float: right">
                        <input id="searchButton" class="bntns" type="button" value="搜索" onclick="getApprovalList(5, 1, 1);">
                        <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClearOverWork();">
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
                <!--<input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="addLeave()" value="新增">-->
                <!--<input id="" style="background: #f47469;" class="bntns1" type="button" value="删除">-->
                <!--</p>-->
                <div class="title">
                    <ul>
                        <li style="width: 19%;">编号</li>
                        <li style="width: 15%;">主题</li>
                        <li style="width: 25%;">申请内容</li>
                        <li style="width: 8%;">申请人</li>
                        <li style="width: 8%;">下级审批人</li>
                        <li style="width: 10%;">状态</li>
                        <li style="width: 15%;">申请日期</li>
                        <!--<li style="width: 10%;">置顶</li>-->
                        <!--<li style="width: 5%;">附件</li>-->
                        <!--<li style="width: 10%;">操作</li>-->
                    </ul>
                </div>
                <div class="contentList">
                    <div id="overWorkContentList">
                        <?php if(!empty($overWork_list["processList"])): if(is_array($overWork_list["processList"])): $i = 0; $__LIST__ = $overWork_list["processList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$overWork): $mod = ($i % 2 );++$i;?><ul>
                                    <li style="width: 19%;"><?php echo ($overWork["processNo"]); ?></li>
                                    <li style="width: 15%;cursor: pointer;color: #014f97;" onclick="showOverWorkDetail('<?php echo ($overWork["processId"]); ?>');" title="<?php echo ($overWork["title"]); ?>"><a><?php echo ($overWork["title"]); ?></a></li>
                                    <li style="width: 25%;" title="<?php echo ($overWork["formContent"]); ?>"><?php echo ($overWork["formContent"]); ?>&nbsp;</li>
                                    <li style="width: 8%;"><?php echo ($overWork["applicantName"]); ?>&nbsp;</li>
                                    <li style="width: 8%;"><?php echo ($overWork["currentHandlerPerson"]); ?>&nbsp;</li>
                                    <li style="width: 10%;">
                                        <?php
 switch ($overWork['status']) { case '2': echo "审批中"; break; case '3': echo "审批同意"; break; case '4': echo "审批不同意"; break; case '5': echo "撤销"; break; default: echo "审批中"; break; }?>
                                    </li>
                                    <li style="width: 15%;"><?php echo $overWork['createTime'];?></li>
                                </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        <?php if(empty($overWork_list["processList"])): ?><ul class="topnone">
                                <li style="width: 100%;color:#f47469;">无数据!</li>
                            </ul><?php endif; ?>
                    </div>
                </div>
                <div id="pagebar5" class="pagebar" style="margin-top:20px;"></div>
                <input type="hidden" id="page5" value="1">
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

    $(function(){
        Cookie.eraseCookie("bigMenuIndex");
        Cookie.eraseCookie("smallMenuIndex");
        Cookie.createCookie("bigMenuIndex",0);
        Cookie.createCookie("smallMenuIndex",4);

        var start1 = {
            elem: '#startDate1',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end1.min = datas; //开始日选好后，重置结束日的最小日期
                end1.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end1 = {
            elem: '#endDate1',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start1.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        var start2 = {
            elem: '#startDate2',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end2.min = datas; //开始日选好后，重置结束日的最小日期
                end2.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end2 = {
            elem: '#endDate2',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start2.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        var start3 = {
            elem: '#startDate3',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end3.min = datas; //开始日选好后，重置结束日的最小日期
                end3.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end3 = {
            elem: '#endDate3',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start3.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        var start4 = {
            elem: '#startDate4',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end4.min = datas; //开始日选好后，重置结束日的最小日期
                end4.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end4 = {
            elem: '#endDate4',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start4.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        var start5 = {
            elem: '#startDate5',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end5.min = datas; //开始日选好后，重置结束日的最小日期
                end5.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end5 = {
            elem: '#endDate5',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start5.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        laydate(start1);
        laydate(end1);
        laydate(start2);
        laydate(end2);
        laydate(start3);
        laydate(end3);
        laydate(start4);
        laydate(end4);
        laydate(start5);
        laydate(end5);

        // 报销
        createPageBar1('<?php echo ($reimbursement_list["total"]); ?>', '<?php echo ($reimbursement_list["pageSize"]); ?>', '<?php echo ($reimbursement_list["page"]); ?>', '<?php echo ($reimbursement_list["totalPage"]); ?>');
        $(document).on('click','#pagebar1 span a', function() {
            $("#page1").val($(this).attr("rel"));
            getApprovalList(2, $(this).attr("rel"), 0)
        });

        // 请假
        createPageBar2('<?php echo ($leave_list["total"]); ?>', '<?php echo ($leave_list["pageSize"]); ?>', '<?php echo ($leave_list["page"]); ?>', '<?php echo ($leave_list["totalPage"]); ?>');
        $(document).on('click','#pagebar2 span a', function() {
            $("#page2").val($(this).attr("rel"));
            getApprovalList(3, $(this).attr("rel"), 0)
        });

        // 出差
        createPageBar3('<?php echo ($businessTrip_list["total"]); ?>', '<?php echo ($businessTrip_list["pageSize"]); ?>', '<?php echo ($businessTrip_list["page"]); ?>', '<?php echo ($businessTrip_list["totalPage"]); ?>');
        $(document).on('click','#pagebar3 span a', function() {
            $("#page3").val($(this).attr("rel"));
            getApprovalList(4, $(this).attr("rel"), 0)
        });

        // 费用
        createPageBar4('<?php echo ($cost_list["total"]); ?>', '<?php echo ($cost_list["pageSize"]); ?>', '<?php echo ($cost_list["page"]); ?>', '<?php echo ($cost_list["totalPage"]); ?>');
        $(document).on('click','#pagebar4 span a', function() {
            $("#page4").val($(this).attr("rel"));
            getApprovalList(1, $(this).attr("rel"), 0)
        });

        // 加班
        createPageBar5('<?php echo ($overWork_list["total"]); ?>', '<?php echo ($overWork_list["pageSize"]); ?>', '<?php echo ($overWork_list["page"]); ?>', '<?php echo ($overWork_list["totalPage"]); ?>');
        $(document).on('click','#pagebar5 span a', function() {
            $("#page5").val($(this).attr("rel"));
            getApprovalList(5, $(this).attr("rel"), 0)
        });
    });

    //新增报销
    function addApply(){
        layer.open({
            type:2,
            title :['新增报销','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '505px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addApply'
        });
    }

    //报销详细信息
    function showApplyDetail(processId){
        var page = $("#page1").val();
        layer.open({
            type:2,
            title:['报销详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area:['700px', '600px'],
            shadeClose:false,
            content:APP+'/Home/Office/showApplyDetail?processId='+processId+'&page='+page
        });
    }

    //新增请假
    function addLeave(){
        layer.open({
            type:2,
            title :['新增请假','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '505px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addLeave'
        });
    }

    //请假详细信息
    function showLeaveDetail(processId){
        var page = $("#page2").val();
        layer.open({
            type:2,
            title:['请假详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area:['700px', '600px'],
            shadeClose:false,
            content:APP+'/Home/Office/showLeaveDetail?processId='+processId+'&page='+page
            // content: "<?php echo U('Office/showLeaveDetail');?>"
        });
    }

    //新增出差
    function addTravel(){
        layer.open({
            type:2,
            title :['新增出差','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '505px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addTravel'
        });
    }

    //出差详细信息
    function showTravelDetail(processId){
        var page = $("#page3").val();
        layer.open({
            type:2,
            title:['出差详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area:['700px', '600px'],
            shadeClose:false,
            content:APP+'/Home/Office/showTravelDetail?processId='+processId+'&page='+page
            // content: "<?php echo U('Office/showTravelDetail');?>"
        });
    }

    //新增费用
    function addFee(){
        layer.open({
            type:2,
            title :['新增费用','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '505px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addFee'
        });
    }

    //费用详细信息
    function showFeeDetail(processId){
        var page = $("#page4").val();
        layer.open({
            type:2,
            title:['费用详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area:['700px', '600px'],
            shadeClose:false,
            content:APP+'/Home/Office/showFeeDetail?processId='+processId+'&page='+page
            // content: "<?php echo U('Office/showFeeDetail');?>"
        });
    }

    //新增加班
    function addOverWork(){
        layer.open({
            type:2,
            title :['新增加班','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '505px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addOverWork'
        });
    }

    //加班详细信息
    function showOverWorkDetail(processId){
        var page = $("#page5").val();
        layer.open({
            type:2,
            title:['加班详情','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area:['700px', '600px'],
            shadeClose:false,
            content:APP+'/Home/Office/showOverWorkDetail?processId='+processId+'&page='+page
            // content: "<?php echo U('Office/showLeaveDetail');?>"
        });
    }

    // 清空报销检索条件
    function doClearReimbursement() {
        $("#reimbursementType").val("1");
        $("#startDate1").val("");
        $("#endDate1").val("");
        $("#reimbursementStatus").val("");
    }

    // 清空请假检索条件
    function doClearLeave() {
        $("#leaveType").val("1");
        $("#startDate2").val("");
        $("#endDate2").val("");
        $("#leaveStatus").val("");
    }

    // 清空出差检索条件
    function doClearBusinessTrip() {
        $("#businessTripType").val("1");
        $("#startDate3").val("");
        $("#endDate3").val("");
        $("#businessTripStatus").val("");
    }

    // 清空费用检索条件
    function doClearCost() {
        $("#costType").val("1");
        $("#startDate4").val("");
        $("#endDate4").val("");
        $("#costStatus").val("");
    }

    // 清空加班检索条件
    function doClearOverWork() {
        $("#overWorkType").val("1");
        $("#startDate5").val("");
        $("#endDate5").val("");
        $("#overWorkStatus").val("");
    }

    // 创建翻页条
    function createPageBar1(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        $("#page1").val(page);
        getPageBar1("pagebar1");
    }

    // 创建翻页条
    function createPageBar2(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        $("#page2").val(page);
        getPageBar1("pagebar2");
    }

    // 创建翻页条
    function createPageBar3(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        $("#page3").val(page);
        getPageBar1("pagebar3");
    }

    // 创建翻页条
    function createPageBar4(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        $("#page4").val(page);
        getPageBar1("pagebar4");
    }

    // 创建翻页条
    function createPageBar5(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        $("#page5").val(page);
        getPageBar1("pagebar5");
    }

    // 获取列表数据
    function getApprovalList(busiType, page, searchFlag) {
        var loadIdx = layer.load(0);
        var type = 1;
        var startDate = "";
        var endDate = "";
        var status = "";

        if(busiType == 2) {
            if(searchFlag == 1) {
                var hidRType = $("#reimbursementType").val();
                var hidSDate1 = $("#startDate1").val();
                var hidEDate1 = $("#endDate1").val();
                var hidRStatus = $("#reimbursementStatus").val();

                $("#hidRType").val(hidRType);
                $("#hidSDate1").val(hidSDate1);
                $("#hidEDate1").val(hidEDate1);
                $("#hidRStatus").val(hidRStatus);
            }
            type = $("#hidRType").val();
            startDate = $("#hidSDate1").val();
            endDate = $("#hidEDate1").val();
            status = $("#hidRStatus").val();
        } else if(busiType == 3) {
            if(searchFlag == 1) {
                var hidLType = $("#leaveType").val();
                var hidSDate2 = $("#startDate2").val();
                var hidEDate2 = $("#endDate2").val();
                var hidLStatus = $("#leaveStatus").val();

                $("#hidLType").val(hidLType);
                $("#hidSDate2").val(hidSDate2);
                $("#hidEDate2").val(hidEDate2);
                $("#hidLStatus").val(hidLStatus);
            }
            type = $("#hidLType").val();
            startDate = $("#hidSDate2").val();
            endDate = $("#hidEDate2").val();
            status = $("#hidLStatus").val();
        } else if(busiType == 4) {
            if(searchFlag == 1) {
                var hidBTType = $("#businessTripType").val();
                var hidSDate3 = $("#startDate3").val();
                var hidEDate3 = $("#endDate3").val();
                var hidBTStatus = $("#businessTripStatus").val();

                $("#hidBTType").val(hidBTType);
                $("#hidSDate3").val(hidSDate3);
                $("#hidEDate3").val(hidEDate3);
                $("#hidBTStatus").val(hidBTStatus);
            }
            type = $("#hidBTType").val();
            startDate = $("#hidSDate3").val();
            endDate = $("#hidEDate3").val();
            status = $("#hidBTStatus").val();
        } else if(busiType == 1) {
            if(searchFlag == 1) {
                var hidCType = $("#costType").val();
                var hidSDate4 = $("#startDate4").val();
                var hidEDate4 = $("#endDate4").val();
                var hidCStatus = $("#costStatus").val();

                $("#hidCType").val(hidCType);
                $("#hidSDate4").val(hidSDate4);
                $("#hidEDate4").val(hidEDate4);
                $("#hidCStatus").val(hidCStatus);
            }
            type = $("#hidCType").val();
            startDate = $("#hidSDate4").val();
            endDate = $("#hidEDate4").val();
            status = $("#hidCStatus").val();
        } else if(busiType == 5) {
            if(searchFlag == 1) {
                var hidOWType = $("#overWorkType").val();
                var hidSDate5 = $("#startDate5").val();
                var hidEDate5 = $("#endDate5").val();
                var hidOWStatus = $("#overWorkStatus").val();

                $("#hidOWType").val(hidOWType);
                $("#hidSDate5").val(hidSDate5);
                $("#hidEDate5").val(hidEDate5);
                $("#hidOWStatus").val(hidOWStatus);
            }
            type = $("#hidOWType").val();
            startDate = $("#hidSDate5").val();
            endDate = $("#hidEDate5").val();
            status = $("#hidOWStatus").val();
        }
        
        switch (busiType) {
            case 1:
                $("#costContentList").empty();
                break;
            case 2:
                $("#reimbursementContentList").empty();
                break;
            case 3:
                $("#leaveContentList").empty();
                break;
            case 4:
                $("#businessTripContentList").empty();
                break;
            case 5:
                $("#overWorkContentList").empty();
                break;
            default:
                $("#reimbursementContentList").empty();
                break;
        }

        $.post("<?php echo U('Office/getApprovalList');?>", {"busiType":busiType, "page":page, "type":type, "startDate":startDate, "endDate":endDate, "status":status}, function(data) {
            if (!("processList" in data)) {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
                return;
            }
            var content = "";
            // 设定用户列表
            $.each(data.processList, function(k, v) {
                content += '<ul>';
                content += '<li style="width: 19%;">' + v.processNo + '</li>';

                var detailFunction = "";
                switch (busiType) {
                    case 1:
                        detailFunction = "showFeeDetail";
                        break;
                    case 2:
                        detailFunction = "showApplyDetail";
                        break;
                    case 3:
                        detailFunction = "showLeaveDetail";
                        break;
                    case 4:
                        detailFunction = "showTravelDetail";
                        break;
                    case 5:
                        detailFunction = "showOverWorkDetail";
                        break;
                    default:
                        detailFunction = "showApplyDetail";
                        break;
                }

                content += '<li style="width: 15%;cursor: pointer;color:#014f97;" onclick="' + detailFunction + '(\'' + v.processId + '\')" title="' + v.title + '"><a>' + v.title + '</a></li>';
                content += '<li style="width: 25%;" title="' + v.formContent + '">' + v.formContent + '&nbsp;</li>';
                content += '<li style="width: 8%;">' + v.applicantName + '&nbsp;</li>';
                content += '<li style="width: 8%;">' + v.currentHandlerPerson + '&nbsp;</li>';
                content += '<li style="width: 10%;">';

                switch (v.status) {
                    case '2':
                        content += "审批中";
                        break;
                    case '3':
                        content += "审批同意";
                        break;
                    case '4':
                        content += "审批不同意";
                        break;
                    case '5':
                        content += "撤销";
                        break;
                    default:
                        content += "审批中";
                        break;
                }
                content += '</li>';
                content += '<li style="width: 15%;">' + v.createTime + '</li>';
                content += '</ul>';
            });
            if (content == "") {
                content = '<ul class="topnone">';
                content += '<li style="width:98.4%;color:#f47469;">无数据!</li>';
                content += '</ul>';
            }

            switch (busiType) {
                case 1:
                    $("#costContentList").append(content);
                    createPageBar4(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                case 2:
                    $("#reimbursementContentList").append(content);
                    createPageBar1(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                case 3:
                    $("#leaveContentList").append(content);
                    createPageBar2(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                case 4:
                    $("#businessTripContentList").append(content);
                    createPageBar3(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                case 5:
                    $("#overWorkContentList").append(content);
                    createPageBar5(data.total, data.pageSize, data.page, data.totalPage);
                    break;
                default:
                    $("#reimbursementContentList").append(content);
                    createPageBar1(data.total, data.pageSize, data.page, data.totalPage);
                    break;
            }
            layer.close(loadIdx);
        }, 'json');  
    }

    //格式化日期,
    function formatDate(date,format){
        var paddNum = function(num){
          num += "";
          return num.replace(/^(\d)$/,"0$1");
        }
        //指定格式字符
        var cfg = {
           yyyy : date.getFullYear() //年 : 4位
          ,yy : date.getFullYear().toString().substring(2)//年 : 2位
          ,M  : date.getMonth() + 1  //月 : 如果1位的时候不补0
          ,MM : paddNum(date.getMonth() + 1) //月 : 如果1位的时候补0
          ,d  : date.getDate()   //日 : 如果1位的时候不补0
          ,dd : paddNum(date.getDate())//日 : 如果1位的时候补0
          ,hh : date.getHours()  //时
          ,mm : date.getMinutes() //分
          ,ss : date.getSeconds() //秒
        }
        format || (format = "yyyy-MM-dd hh:mm:ss");
        return format.replace(/([a-z])(\1)*/ig,function(m){return cfg[m];});
    } 
</script>
</body>
</html>