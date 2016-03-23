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
                           <?php if( !in_array("e1",$access_array) ){ echo "<!--"; } ?>
                           <li onclick="location.href = APP+'/Admin/Group/index'">企业资料维护</li>
                           <?php if( !in_array("e1",$access_array) ){ echo "-->"; } ?>
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
        <div class='org_box org_box_select'>
            <span class='org_bot_cor'></span>
            客户详情
        </div>
    </div>
    <div class="cusdetail_center">
        <!--输入框-->
        <div class="cusdetail_head">
            <span style="display: inline-block;">首页&nbsp;>&nbsp;通讯录&nbsp;>&nbsp;客户通讯录&nbsp;>&nbsp;客户详情</span>
            <span style="float: right;margin-right: 15px;" class="bntns1" onclick="goback();">返回</span>
        </div>
        <!--列表-->
        <div class="cusdetail_list">
            <p>客户名称：<?php echo ($customerDetail["cusName"]); ?></p>
            <p>客户地址：<?php echo ($customerDetail["cusAddress"]); ?></p>
            <p>客户电话：<?php echo ($customerDetail["cusPhone"]); ?></p>
            <div class="one">
                <div class="head"><span>联系人</span></div>
                <div class="buttons">
                    <span class="bntns1 add" onclick="addLinkman(<?php echo ($customerDetail["cusId"]); ?>);">新增</span>
                    <span class="bntns1 del" onclick="delLinkman(<?php echo ($customerDetail["cusId"]); ?>);">删除</span>
                </div>
                <div class="form">
                    <table border="0" cellpadding="0" cellspacing="0" id="cusClientList">
                        <tr style="height: 25px;">
                            <th width="67" height="25">选择</th>
                            <th width="155">姓名</th>
                            <th width="48">性别</th>
                            <th width="150">部门</th>
                            <th width="150">职位</th>
                            <th width="150">联系电话</th>
                            <th width="300">电子邮箱</th>
                        </tr>
                        <?php if(!empty($customerClientList["list"])): if(is_array($customerClientList["list"])): $i = 0; $__LIST__ = $customerClientList["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$client): $mod = ($i % 2 );++$i;?><tr style="height: 50px;">
                            <td><input type="checkbox" name="link_checkbox" value="<?php echo ($client["clientId"]); ?>"></td>
                            <td><a onclick="editLinkman(<?php echo ($customerDetail["cusId"]); ?>, <?php echo ($client["clientId"]); ?>);"><?php echo ($client["clientName"]); ?></a></td>
                            <td><?php if($client['clientSex'] == '0') {echo "男";} else {echo "女";} ?></td>
                            <td><?php echo ($client["clientDeptName"]); ?></td>
                            <td><?php echo ($client["clientStation"]); ?></td>
                            <td><?php echo ($client["phone"]); ?></td>
                            <td><?php echo ($client["clientEmail"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                            <!--<div id="pagebar1" class="pagebar" style="margin-top:20px;"></div>--><?php endif; ?>

                    </table>
                </div>
            </div>
            <div class="two" style="display: block;">
                <div class="head"><span>业务跟进</span></div>
                <div class="choose">
                    <ul>
                        <li style="border-left: 1px solid #000" class="active">商机</li>
                        <li>拜访计划</li>
                        <li>拜访记录</li>
                        <li>合同</li>
                        <li>回款</li>
                    </ul>
                </div>
                <div id="line"></div>
                <!--<div class="buttons">-->
                    <!--<span class="bntns1 add" onclick="addBusiOpportunities()">新增</span>-->
                    <!--<span class="bntns1 del">删除</span>-->
                <!--</div>-->
                <div id="formList">
                    <!-- 商机start-->
                    <div id="form_biz" class="form" style="display: block;position: relative;">
                        <div class="buttons">
                            <span class="bntns1 add" onclick="addBusiOpportunities(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>');">新增</span>
                            <span class="bntns1 del" onclick="delBusiOpportunities(<?php echo ($customerDetail["cusId"]); ?>);">删除</span>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" id="table_biz">
                            <tr style="height: 25px;">
                                <th width="67" height="25">选择</th>
                                <th width="230">商机主题</th>
                                <th width="100">来源</th>
                                <th width="150">客户需求</th>
                                <th width="150">预计签单日期</th>
                                <th width="150">预计成交额</th>
                                <th width="200">备注</th>
                            </tr>
                            <?php if(is_array($bizList)): foreach($bizList as $key=>$vo): ?><tr style="height: 50px;width: 100px;">
                                <td><input style="width: 50px;" type="checkbox" name="biz" value="<?php echo ($vo['bizId']); ?>"></td>
                                <td><div style="width: 180px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['bizSubject']); ?>"><a href="javascript:;" onclick="editBusiOpportunities(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>',<?php echo ($vo['bizId']); ?>)"><?php echo ($vo['bizSubject']); ?></a></div></td>
                                <td><div style="width: 100px;padding: 0 5px;"><?php echo ($vo['originStr']); ?></div></td>
                                <td><div style="width: 150px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['cusDemand']); ?>"><?php echo ($vo['cusDemand']); ?></div></td>
                                <td><div style="width: 100px;padding: 0 5px;"><?php echo ($vo['expectedSingDate']); ?></div></td>
                                <td><div style="width:100px;padding: 0 5px;"><?php echo ($vo['expectVolume']); ?></div></td>
                                <td><div style="width: 180px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['remark']); ?>"><?php echo ($vo['remark']); ?></div></td>
                            </tr><?php endforeach; endif; ?>
                        </table>
                        <div id="pagebar_biz" class="pagebar" style="position: absolute;top: 280px;"></div>
                    </div >

                    <!-- 商机end-->
                    <!-- 拜访计划start-->
                    <div id="form_visitPlan" class="form" style="display: none;position: relative;">
                        <div class="buttons">
                            <span class="bntns1 add" onclick="addVisitPlan(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>');">新增</span>
                            <span class="bntns1 del" onclick="delVisitPlan(<?php echo ($customerDetail["cusId"]); ?>);">删除</span>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" id="table_visitPlan">
                            <tr style="height: 25px;">
                                <th width="67" height="25">选择</th>
                                <th width="230">计划主题</th>
                                <th width="150">开始日期</th>
                                <th width="150">结束日期</th>
                                <th width="225">对应商机</th>
                                <th width="225">拜访内容</th>
                                <th width="150">拜访方式</th>
                            </tr>
                            <?php if(is_array($visitPlanList)): foreach($visitPlanList as $key=>$vo): ?><tr style="height: 50px;">
                                    <td><input style="width: 50px;" type="checkbox" name="visitPlan" value="<?php echo ($vo['visitPlanId']); ?>"></td>
                                    <td><div style="width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['visitPlanSubject']); ?>"><a href="javascript:;" onclick="editVisitPlan(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>',<?php echo ($vo['visitPlanId']); ?>)"><?php echo ($vo['visitPlanSubject']); ?></a></div></td>
                                    <td><div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['startDate']); ?>"><?php echo ($vo['startDate']); ?></div></td>
                                    <td><div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['endDate']); ?>"><?php echo ($vo['endDate']); ?></div></td>
                                    <td><div style="width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['bizSubject']); ?>"><?php echo ($vo['bizSubject']); ?></div></td>
                                    <td><div style="width:180px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['content']); ?>"><?php echo ($vo['content']); ?></div></td>
                                    <td>
                                        <div style="width: 80px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;">
                                        <?php if($vo['visitMethod'] == 1): ?>电话拜访
                                        <?php elseif($vo['visitMethod'] == 2): ?>
                                            现场拜访
                                        <?php else: ?>
                                            其它<?php endif; ?>
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                        </table>
                        <div id="pagebar_visitPlan" class="pagebar" style="position: absolute;top: 280px;"></div>
                    </div>
                    <!-- 拜访计划end-->
                    <!-- 拜访记录start-->
                    <div id="form_visitRecord" class="form" style="display: none;position: relative;">
                        <div class="buttons">
                            <span class="bntns1 add" onclick="addVisitRecord(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>');">新增</span>
                            <span class="bntns1 del" onclick="delVisitRecord(<?php echo ($customerDetail["cusId"]); ?>);">删除</span>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" id="table_visitRecord">
                            <tr style="height: 25px;">
                                <th width="67" height="25">选择</th>
                                <th width="230">记录主题</th>
                                <th width="150">拜访日期</th>
                                <th width="150">拜访方式</th>
                                <th width="225">对应商机</th>
                                <th width="225">交流内容</th>
                                <th width="230">跟进策略</th>
                            </tr>
                            <?php if(is_array($visitRecordList)): foreach($visitRecordList as $key=>$vo): ?><tr style="height: 50px;">
                                <td><input style="width: 50px;" type="checkbox" name="visitRecord" value="<?php echo ($vo['visitRecordId']); ?>" ></td>
                                <td><div style="width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['visitRecordSubject']); ?>"><a href="javascript:;" onclick="editVisitRecord(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>',<?php echo ($vo['visitRecordId']); ?>)"><?php echo ($vo['visitRecordSubject']); ?></a></div></td>
                                <td><div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;"><?php echo ($vo['visitRecordDate']); ?></div></td>
                                <td>
                                    <div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;">
                                        <?php if($vo['visitMethod'] == 1): ?>电话拜访
                                            <?php elseif($vo['visitMethod'] == 2): ?>
                                            现场拜访
                                            <?php else: ?>
                                            其它<?php endif; ?>
                                    </div>
                                </td>
                                <td><div style="width: 140px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['bizSubject']); ?>"><?php echo ($vo['bizSubject']); ?></div></td>
                                <td><div style="width: 140px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['exchangesContent']); ?>"><?php echo ($vo['exchangesContent']); ?></div></td>
                                <td><div style="width: 140px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['followTactics']); ?>"><?php echo ($vo['followTactics']); ?></div></td>
                            </tr><?php endforeach; endif; ?>
                        </table>
                        <div id="pagebar_visitRecord" class="pagebar" style="position: absolute;top: 280px;"></div>
                    </div>
                    <!-- 拜访记录end-->
                    <!-- 合同start-->
                    <div id="form_contract" class="form" style="display: none;position: relative;">
                        <div class="buttons">
                            <span class="bntns1 add" onclick="addContract(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>');">新增</span>
                            <span class="bntns1 del" onclick="delContract(<?php echo ($customerDetail["cusId"]); ?>);">删除</span>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" id="table_contract" >
                            <tr style="height: 25px;">
                                <th width="67" height="25">选择</th>
                                <th width="230">合同标题</th>
                                <th width="150">合同编号</th>
                                <th width="150">合同金额</th>
                                <th width="150">签订日期</th>
                                <th width="150">关键条款</th>
                                <th width="150">客户签约人</th>
                            </tr>
                            <?php if(is_array($contractList)): foreach($contractList as $key=>$vo): ?><tr style="height: 50px;">
                                    <td><input style="width: 50px;" type="checkbox" name="contract" value="<?php echo ($vo['contractId']); ?>" ></td>
                                    <td><div style="width: 140px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['contractSubject']); ?>"><a href="javascript:;" onclick="editContract(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>',<?php echo ($vo['contractId']); ?>)"><?php echo ($vo['contractSubject']); ?></a></div></td>
                                    <td><div style="width: 140px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['contractCode']); ?>"><?php echo ($vo['contractCode']); ?></div></td>
                                    <td>
                                        <div style="width: 80px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['money']); ?>"><?php echo ($vo['money']); ?></div>
                                    </td>
                                    <td><div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['signDate']); ?>"><?php echo ($vo['signDate']); ?></div></td>
                                    <td><div style="width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['content']); ?>"><?php echo ($vo['content']); ?></div></td>
                                    <td><div style="width: 160px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['ASignerName']); ?>"><?php echo ($vo['ASignerName']); ?></div></td>
                                </tr><?php endforeach; endif; ?>
                        </table>
                        <div id="pagebar_contract" class="pagebar" style="position: absolute;top: 280px;"></div>
                    </div>
                    <!-- 合同end-->
                    <!-- 回款start-->
                    <div id="form_payBack" class="form" style="display: none;position: relative;">
                        <div class="buttons">
                            <span class="bntns1 add" onclick="addPayBack(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>')">新增</span>
                            <span class="bntns1 del" onclick="delPayBack(<?php echo ($customerDetail["cusId"]); ?>);" >删除</span>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" id="table_payBack" >
                            <tr style="height: 25px;">
                                <th width="67" height="25">选择</th>
                                <th width="230">关联合同</th>
                                <th width="150">回款日期</th>
                                <th width="150">回款金额</th>
                                <th width="150">回款方式</th>
                                <th width="150">是否开票</th>
                                <th width="150">备注</th>
                            </tr>
                            <?php if(is_array($payBackList)): foreach($payBackList as $key=>$vo): ?><tr style="height: 50px;">
                                    <td><input style="width: 50px;" type="checkbox" name="payrecordId" value="<?php echo ($vo['payrecordId']); ?>" ></td>
                                    <td><div style="width: 150px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['contractCode']); ?>"><a href="javascript:;" onclick="editPayBack(<?php echo ($customerDetail["cusId"]); ?>,'<?php echo ($customerDetail["cusName"]); ?>',<?php echo ($vo['payrecordId']); ?>)"><?php echo ($vo['contractCode']); ?></a></div></td>
                                    <td><div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['payDate']); ?>"><?php echo ($vo['payDate']); ?></div></td>
                                    <td><div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo['payMoney']); ?>"><?php echo ($vo['payMoney']); ?></div></td>
                                    <td>
                                        <div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;">
                                        <?php if($vo['payMethod'] == 1): ?>现金
                                            <?php elseif($vo['payMethod'] == 2): ?>
                                            转帐
                                            <?php elseif($vo['payMethod'] == 3): ?>
                                            电汇
                                            <?php elseif($vo['payMethod'] == 4): ?>
                                            支票
                                            <?php else: ?>
                                            --请选择--<?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;">
                                        <?php if($vo['receipt'] == 1): ?>是
                                            <?php elseif($vo['receipt'] == 2): ?>
                                            否
                                            <?php elseif($vo['receipt'] == 3): ?>
                                            无需开票
                                            <?php else: ?>
                                            --请选择--<?php endif; ?>
                                        </div>
                                    </td>
                                    <td><div style="width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;padding: 0 5px;" title="<?php echo ($vo[remark]); ?>"><?php echo ($vo[remark]); ?></div></td>
                                </tr><?php endforeach; endif; ?>
                        </table>
                        <div id="pagebar_payBack" class="pagebar" style="position: absolute;top: 280px;"></div>
                    </div>
                    <!-- 回款end-->
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="currentPage_biz" value="" />
<input type="hidden" id="currentPage_visitPlan" value="" />
<input type="hidden" id="currentPage_visitRecord" value="" />
<input type="hidden" id="currentPage_contract" value="" />
<input type="hidden" id="currentPage_payBack" value="" />

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

    cusId = '<?php echo ($customerDetail["cusId"]); ?>'; //客户id
    cusName = '<?php echo ($customerDetail["cusName"]); ?>'; //客户名称

    //创建商机分页条
    var total_biz = '<?php echo ($page[total_biz]); ?>';
    var pageSize_biz = '<?php echo ($page[pageSize_biz]); ?>';
    var currentPage_biz = '<?php echo ($page[currentPage_biz]); ?>';
    var totalPage_biz = '<?php echo ($page[totalPage_biz]); ?>';

    createPageBar(total_biz,pageSize_biz,currentPage_biz,totalPage_biz,"pagebar_biz");  //创建分页
    $(document).on('click','#pagebar_biz span a', function() { //分页点击ajax加载
        $("#currentPage_biz").val($(this).attr("rel"));
        getBizList();
    });
    //获取商机列表
    function getBizList(){
        var currentPage_biz = $("#currentPage_biz").val(); //当前商机页
        var loadIdx = layer.load(0);
        $("#table_biz").empty();

        $.post("<?php echo U('Office/getBizList_ajax');?>", {"page":currentPage_biz, "pageSize":pageSize_biz, "cusId":cusId }, function(data) {

            if (!("bizList" in data)) {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
                return;
            }
            var header  = '<tr style="height: 25px;">';
                header +=      '<th width="67" height="25">选择</th>';
                header +=      '<th width="230">商机主题</th>';
                header +=      '<th width="100">来源</th>';
                header +=      '<th width="150">客户需求</th>';
                header +=      '<th width="150">预计签单日期</th>';
                header +=      '<th width="150">预计成交额</th>';
                header +=      '<th width="200">备注</th>';
                header += '</tr>';

            var content = '';

            // 设定商机列表
            $.each(data.bizList, function(k, v) {
                content += '<tr style="height: 50px;">';
                content +=   '<td><input type="checkbox" name="biz" value="'+ v.bizId + '"></td>';
                content +=   '<td><a href="javascript:;" onclick="editBusiOpportunities('+ cusId +',\''+ cusName +'\','+ v.bizId +')">'+ v.bizSubject +'</a></td>';
                content +=   '<td>'+ v.originStr +'</td>';
                content +=   '<td>'+ v.cusDemand +'</td>';
                content +=   '<td>'+ v.expectedSingDate +'</td>';
                content +=   '<td>'+ v.expectVolume +'</td>';
                content +=   '<td>'+ v.remark +'</td>';
                content += '</tr>';
            });

            //总的内容
            header += content;

            $("#table_biz").append(header);
            createPageBar(total_biz,pageSize_biz,currentPage_biz,totalPage_biz,"pagebar_biz");
            layer.close(loadIdx);
        }, 'json');

    }


    //创建拜访计划分页条
    var total_visitPlan = '<?php echo ($page[total_visitPlan]); ?>';
    var pageSize_visitPlan = '<?php echo ($page[pageSize_visitPlan]); ?>';
    var currentPage_visitPlan = '<?php echo ($page[currentPage_visitPlan]); ?>';
    var totalPage_visitPlan = '<?php echo ($page[totalPage_visitPlan]); ?>';
    createPageBar(total_visitPlan,pageSize_visitPlan,currentPage_visitPlan,totalPage_visitPlan,"pagebar_visitPlan");  //创建分页
    $(document).on('click','#pagebar_visitPlan span a', function() { //分页点击ajax加载
        $("#currentPage_visitPlan").val($(this).attr("rel"));
        getVisitPlanList();
    });
    //获取拜访计划列表
    function getVisitPlanList(){
        var currentPage_visitPlan = $("#currentPage_visitPlan").val(); //当前商机页
        var loadIdx = layer.load(0);
        $("#table_visitPlan").empty();

        $.post("<?php echo U('Office/getVisitPlanList_ajax');?>", {"page":currentPage_biz, "pageSize":pageSize_biz, "cusId":cusId }, function(data) {

            if (!("visitPlanList" in data)) {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
                return;
            }
            var header  = '<tr style="height: 25px;">';
                header +=      '<th width="67" height="25">选择</th>';
                header +=      '<th width="230">计划主题</th>';
                header +=      '<th width="150">开始日期</th>';
                header +=      '<th width="150">结束日期</th>';
                header +=      '<th width="225">对应商机</th>';
                header +=      '<th width="225">拜访内容</th>';
                header +=      '<th width="150">拜访方式</th>';
                header += '</tr>';

            var content = '';

            // 设定商机列表
            $.each(data.visitPlanList, function(k, v) {
                content += '<tr style="height: 50px;">';
                content +=   '<td><input type="checkbox" name="visitPlan" value="'+ v.visitPlanId +'"></td>';
                content +=   '<td><a href="javascript:;" onclick="editVisitPlan('+ cusId +',\''+ cusName +'\','+ v.visitPlanId +')">'+ v.visitPlanSubject +'</a></td>';
                content +=   '<td>'+ v.startDate +'</td>';
                content +=   '<td>'+ v.endDate +'</td>';
                content +=   '<td>'+ v.bizSubject +'</td>';
                content +=   '<td>'+ v.content +'</td>';
                content +=   '<td>'+ v.visitMethod +'</td>';
                content += '</tr>';
            });

            //总的内容
            header += content;

            $("#table_visitPlan").append(header);
            createPageBar(total_biz,pageSize_biz,currentPage_biz,totalPage_biz,"pagebar_visitPlan");
            layer.close(loadIdx);
        }, 'json');

    }

    //创建拜访记录分页条
    var total_visitRecord = '<?php echo ($page[total_visitRecord]); ?>';
    var pageSize_visitRecord = '<?php echo ($page[pageSize_visitRecord]); ?>';
    var currentPage_visitRecord = '<?php echo ($page[currentPage_visitRecord]); ?>';
    var totalPage_visitRecord = '<?php echo ($page[totalPage_visitRecord]); ?>';
    createPageBar(20,8,2,2,"pagebar_visitRecord");


    //创建合同分页条
    var total_contract = '<?php echo ($page[total_contract]); ?>';
    var pageSize_contract = '<?php echo ($page[pageSize_contract]); ?>';
    var currentPage_contract = '<?php echo ($page[currentPage_contract]); ?>';
    var totalPage_contract = '<?php echo ($page[totalPage_contract]); ?>';
    createPageBar(25,8,2,2,"pagebar_contract");


    //创建回款分页条
    var total_payBack = '<?php echo ($page[total_payBack]); ?>';
    var pageSize_payBack = '<?php echo ($page[pageSize_payBack]); ?>';
    var currentPage_payBack = '<?php echo ($page[currentPage_payBack]); ?>';
    var totalPage_payBack = '<?php echo ($page[totalPage_payBack]); ?>';
    createPageBar(30,8,2,2,"pagebar_payBack");

    //创建分页条
    function createPageBar(t,ps,p,tp,id) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1(id); //id为id名
    }

    // 菜单轮换点击事件
    $(".choose li").click(function () {
        var index = $(".choose li").index($(this));
        $(this).addClass("active").siblings().removeClass("active");
        $divList = $("#formList").children("div");
        $divList.hide();
        $divList.eq(index).show();
        var left=112*index;
        $("#line").css('margin-left',left);
    });

    //新增客户弹窗
    function addLinkman(cusId){
        layer.open({
            type:2,
            title :['新增联系人','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['500px', '450px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addLinkman?cusId='+cusId
        });
    }

    //编辑客户弹窗
    function editLinkman(cusId, clientId){
        layer.open({
            type:2,
            title :['编辑联系人','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['500px', '450px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addLinkman?cusId='+cusId+'&clientId='+clientId
        });
    }

    //新增商机弹窗
    function addBusiOpportunities(cusId,cusName){
        layer.open({
            type:2,
            title :['新增商机','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addBusiOpportunities?cusId='+cusId+'&cusName='+cusName
        });
    }

    /**
     * 编辑商机弹窗
     * @param cusId 客户id
     * @param cusName 客户名称
     * @param bizId 商机id
     */
    function editBusiOpportunities(cusId,cusName,bizId){
        layer.open({
            type:2,
            title :['编辑商机','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/editBusiOpportunities?cusId='+cusId+'&cusName='+cusName+'&bizId='+bizId
        });
    }

    //删除商机
    function delBusiOpportunities(cusId){
        var bizId_string = '';  //要删除的商机id
        $("input[type=checkbox][name=biz]:checked").each(function(){
            bizId_string += ','+ $(this).val();
        });
        bizId_string = bizId_string.substr(1);

        if( bizId_string == '' ){
            layer.msg("请选择要删除的商机");
            return;
        }

        $.post("<?php echo U('Office/deleteBiz');?>", {"bizIds":bizId_string}, function(data) {
            if(data.error_code != "success") {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
            }else{
                layer.msg("删除成功");
                setTimeout('window.location.reload();',2000);

            }
        },"json");
    }

    //新增拜访计划弹窗
    function addVisitPlan(cusId,cusName){
        layer.open({
            type:2,
            title :['新增拜访计划','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addVisitPlan?cusId='+cusId+'&cusName='+cusName
        });
    }

    /**
     * 编辑拜访计划弹窗
     * @param cusId 客户id
     * @param cusName 客户名称
     * @param bizId 商机id
     */
    function editVisitPlan(cusId,cusName,visitPlanId){
        layer.open({
            type:2,
            title :['编辑拜访计划','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/editVisitPlan?cusId='+cusId+'&cusName='+cusName+'&visitPlanId='+visitPlanId
        });
    }


    //删除拜访计划
    function delVisitPlan(cusId){
        var vpId_string = '';  //要删除的拜访计划id
        $("input[type=checkbox][name=visitPlan]:checked").each(function(){
            vpId_string += ','+ $(this).val();
        });
        vpId_string = vpId_string.substr(1);

        if( vpId_string == '' ){
            layer.msg("请选择要删除的拜访计划");
            return;
        }

        $.post("<?php echo U('Office/delVisitPlan');?>", {"visitPlanIds":vpId_string}, function(data) {
            if(data.error_code != "success") {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
            }else{
                layer.msg("删除成功");
                setTimeout('window.location.reload();',2000);

            }
        },"json");
    }

    //新增拜访记录弹窗
    function addVisitRecord(cusId,cusName){
        layer.open({
            type:2,
            title :['新增拜访记录','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '550px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addVisitRecord?cusId='+cusId+'&cusName='+cusName
        });
    }

    /**
     * 编辑拜访记录弹窗
     * @param cusId 客户id
     * @param cusName 客户名称
     * @param bizId 商机id
     */
    function editVisitRecord(cusId,cusName,visitRecordId){
        layer.open({
            type:2,
            title :['编辑拜访记录','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/editVisitRecord?cusId='+cusId+'&cusName='+cusName+'&visitRecordId='+visitRecordId
        });
    }

    //删除拜访记录
    function delVisitRecord(cusId){
        var vrId_string = '';  //要删除的拜访记录id
        $("input[type=checkbox][name=visitRecord]:checked").each(function(){
            vrId_string += ','+ $(this).val();
        });
        vrId_string = vrId_string.substr(1);

        if( vrId_string == '' ){
            layer.msg("请选择要删除的拜访记录");
            return;
        }

        $.post("<?php echo U('Office/delVisitRecord');?>", {"visitRecordIds":vrId_string}, function(data) {
            if(data.error_code != "success") {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
            }else{
                layer.msg("删除成功");
                setTimeout('window.location.reload();',2000);

            }
        },"json");
    }


    //新增合同弹窗
    function addContract(cusId,cusName){
        layer.open({
            type:2,
            title :['新增合同','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addContract?cusId='+cusId+'&cusName='+cusName
        });
    }



    /**
     * 编辑合同弹窗
     * @param cusId 客户id
     * @param cusName 客户名称
     * @param bizId 商机id
     */
    function editContract(cusId,cusName,contractId){
        layer.open({
            type:2,
            title :['编辑合同','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/editContract?cusId='+cusId+'&cusName='+cusName+'&contractId='+contractId
        });
    }

    //删除合同
    function delContract(cusId){
        var contractId_string = '';  //要删除的合同id
        $("input[type=checkbox][name=contract]:checked").each(function(){
            contractId_string += ','+ $(this).val();
        });
        contractId_string = contractId_string.substr(1);

        if( contractId_string == '' ){
            layer.msg("请选择要删除的商机");
            return;
        }

        $.post("<?php echo U('Office/delContract');?>", {"contractId":contractId_string}, function(data) {
            if(data.error_code != "success") {
                layer.msg(data.error_text,{icon: 8});
            }else{
                layer.msg("删除成功");
                setTimeout('window.location.reload();',2000);

            }
        },"json");
    }

    //新增回款弹窗
    function addPayBack(cusId,cusName){
        layer.open({
            type:2,
            title :['新增回款','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addPayBack?cusId='+cusId+'&cusName='+cusName
        });
    }

    /**
     * 编辑回款弹窗
     * @param cusId 客户id
     * @param cusName 客户名称
     * @param bizId 商机id
     */
    function editPayBack(cusId,cusName,payBackId){
        layer.open({
            type:2,
            title :['编辑回款','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['900px', '500px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/editPayBack?cusId='+cusId+'&cusName='+cusName+'&payBackId='+payBackId
        });
    }

    //删除回款
    function delPayBack(cusId){
        var bizId_string = '';  //要删除的商机id
        $("input[type=checkbox][name=biz]:checked").each(function(){
            bizId_string += ','+ $(this).val();
        });
        bizId_string = bizId_string.substr(1);

        if( bizId_string == '' ){
            layer.msg("请选择要删除的商机");
            return;
        }

        $.post("<?php echo U('Office/deleteBiz');?>", {"bizIds":bizId_string}, function(data) {
            if(data.error_code != "success") {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
            }else{
                layer.msg("删除成功");
                setTimeout('window.location.reload();',2000);

            }
        },"json");
    }

    // 删除联系人
    function delLinkman(cusId) {
        var checkbox = document.getElementsByName("link_checkbox");
        var ids = "";

        for (var i = 0; i < checkbox.length; i++) {
            var e = checkbox[i];
            if(e.checked) {
                if(ids == "") {
                    ids = e.value;
                } else {
                    ids = ids + "," + e.value;
                }
            }
        }

        if(ids == "") {
            layer.msg("请选择删除的联系人",{icon: 8});
            return false;
        } else {
            var loadIdx = layer.load(0);
            $("#customerContentList").empty();
            $.post("<?php echo U('Office/deleteCusClient');?>", {"ids":ids}, function(data) {
                if(data.error_code != "success") {
                    layer.close(loadIdx);
                    layer.msg(data.error_text,{icon: 8});
                }

                $.post("<?php echo U('Office/searchCusClient');?>", {"cusId":cusId}, function(data) {
                    if (!("list" in data)) {
                        layer.close(loadIdx);
                        layer.msg(data.error_text,{icon: 8});
                        return;
                    }
                    var content = '<tr style="height: 25px;">';
                    content += '<th width="67" height="25">选择</th>';
                    content += '<th width="155">姓名</th>';
                    content += '<th width="48">性别</th>';
                    content += '<th width="150">部门</th>';
                    content += '<th width="150">职位</th>';
                    content += '<th width="150">联系电话</th>';
                    content += '<th width="300">电子邮箱</th>';
                    content += '</tr>';
                    // 设定用户列表
                    $.each(data.list, function(k, v) {
                        content += '<tr style="height: 50px;">';
                        content += '<td><input type="checkbox" name="link_checkbox" value="' + v.clientId + '"></td>';
                        content += '<td><a onclick="editLinkman('+cusId+','+v.clientId+')">' + v.clientName + '</a></td>';
                        var sex = "男";
                        if(v.clientSex == '1') {
                            sex = "女";
                        }
                        content += '<td>' + sex + '</td>';
                        content += '<td>' + v.clientDeptName + '</td>';

                        var clientStation = v.clientStation;
                        if(!clientStation) {
                            clientStation = "";
                        }
                        var phone = v.phone;
                        if(!phone) {
                            phone = "";
                        }
                        content += '<td>' + clientStation + '</td>';
                        content += '<td>' + phone + '</td>';
                        content += '<td>' + v.clientEmail + '</td>';
                        content += '</tr>';
                    });
                    $("#cusClientList").empty();
                    $("#cusClientList").append(content);
                    layer.close(loadIdx);
                }, 'json');  
            }, 'json');
        }
    }


    function goback() {
        var url = APP+'/Home/Office/contact?return=1';
        window.location.href = url;
    }



</script>

</body>
</html>