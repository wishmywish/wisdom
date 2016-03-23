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
    <div id="rev_menu_left" class="class_menu_left" style="margin-right: 20px;">
        <ul id="bigmenu">
            <li id="0" class="org_box org_box_select" onclick="getUserListByDeptId(0,1);"><span class="org_bot_cor"></span>企业通讯录</li>
            <li id="1" class="org_box" onclick="getCustomerList(1,1);"><span ></span>客户通讯录</li>
            <li id="2" class="org_box" onclick="sendArea();"><span ></span>区域管理</li>
        </ul>
    </div>
    <div class="contact_center">
        <!--企业通讯录 -->
        <div id="a0">
            <div class="contact_head">
                <span style="display: inline-block;">通讯录&nbsp;>&nbsp;企业通讯录</span>
                <div class="column">
                    <!-- 员工部门-->
                    <div class="personmsg">
                        <ul>
                            <li style="margin-left: 280px;">
                                <label>姓名</label>
                                <input type="search" placeholder="可模糊检索" id="searchName" />
                            </li>
                            <li>
                                <label>电话</label>
                                <input type="search" placeholder="可模糊检索" id="searchMobile" />
                            </li>
                        </ul>
                        <input type="hidden" id="hidDeptId" value="" />
                        <input type="hidden" id="hidSearchName" value="" />
                        <input type="hidden" id="hidSearchMobile" value="" />
                    </div>
                    <!-- 按钮-->
                    <p style="height: 25px;float: right;">
                        <input id="searchButton0" class="bntns1" type="button" value="搜索" onclick="doSearch();" />
                        <input id="resetButton0" class="bntns1" type="button" value="清空" onclick="doClear();" />
                    </p>
                </div>
            </div>
            <!--列表-->
            <div class="contact_list">
                <div id="menuTree" class="left_menu" style="width:240px;"></div>
                <div class="right_form">
                    <ul>
                        <li style="height: 25px;line-height: 25px;">部门</li>
                        <li style="height: 25px;line-height: 25px;">姓名</li>
                        <li style="height: 25px;line-height: 25px;">职位</li>
                        <li style="border-right: 1px solid #e2e0e0;height: 25px;line-height: 25px;">联系电话</li>
                    </ul>
                    <div id="user_list_content">
                    <?php if(is_array($user_list["list"])): $i = 0; $__LIST__ = $user_list["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="topnone">
                        <li style="height:50px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" title="<?php echo ($vo["deptName"]); ?>"><?php echo ($vo["deptName"]); ?></li>
                        <li style="height:50px;line-height:50px;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;color:#014f97" onclick="showUserDetail(<?php echo ($vo["id"]); ?>)" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></li>
                        <li style="height:50px;line-height:50px;"><?php echo ($vo["position"]); ?></li>
                        <li style="height:50px;line-height:50px;border-right: 1px solid #e2e0e0"><?php echo ($vo["mobile"]); ?></li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <?php if(empty($user_list)): ?><ul class="topnone">
                            <li style="width: 98.4%;color:#f47469;border-right: 1px solid #e2e0e0">无数据! </li>
                        </ul><?php endif; ?>
                    <div id="pagebar1" class="pagebar" style="margin-top:20px;"></div>
                </div>
            </div>
        </div>
        <!--客户通讯录-->
        <div id="a1" style="display: none;">
            <div class="contact_head" style="border-bottom: 1px solid #eaeaea;padding-bottom: 12px;">
                <span style="display: inline-block;">通讯录&nbsp;>&nbsp;客户通讯录</span>
                <div class="column">
                    <span style="float: left;line-height: 25px;">筛选：</span>
                    <ul style="float: left; width: 720px;">
                        <li>
                            <span>客户名称&nbsp;</span>
                            <input style="width: 80px;height: 25px; " type="search" placeholder="可模糊查询" id="cusName" name="cusName">
                        </li>
                        <li style="">
                            <span>&nbsp;&nbsp;&nbsp;区域&nbsp;</span>
                            <input style="width: 80px;height: 25px; padding-left: 7px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;" type="search" placeholder="请选择" class="link" id="cusArea" name="cusArea" readonly value=<?php echo ($cusArea); ?>>
                            <span class="fa fa-search fa-lg" style="position: absolute;margin-left: -18px;margin-top: 8px;color: #898989;" onclick="selectcusAreas()"></span>
                        </li>
                        <li>
                            <span>&nbsp;&nbsp;&nbsp;行业&nbsp;</span>
                            <input style="width: 80px;height: 25px; padding-left: 7px;text-overflow: ellipsis;white-space:nowrap;overflow:hidden;"  type="search" placeholder="请选择" class="link" id="cusTrade" name="cusTrade" readonly value=<?php echo ($cusTrade); ?>>
                            <span class="fa fa-search fa-lg" style="position: absolute;margin-left: -18px;margin-top: 8px;color: #898989;"  onclick="selectcusTrades()"></span>
                        </li>
                        <li>
                            <span>&nbsp;&nbsp;&nbsp;创建时间&nbsp;</span>
                            <input id="startDate" class="laydate-icon" value="" placeholder="起始时间" style="width: 80px;padding-left: 8px;height:25px;">
                            <span>&nbsp;至&nbsp;</span>
                            <input id="endDate" class="laydate-icon" value="" placeholder="终止时间" style="width: 80px;padding-left: 8px;height: 25px;">
                        </li>
                    </ul>
                    <input type="hidden" id="hidcusId" name="hidcusId" value="">
                    <input type="hidden" id="hidcustomerName" name="hidcustomerName" value="" >
                    <input type="hidden" id="hidcusArea" name="hidcusArea" value="" >
                    <input type="hidden" id="hidcusTrade" name="hidcusTrade" value="" >
                    <input type="hidden" id="hidsDate" name="hidsDate" value="" >
                    <input type="hidden" id="hideDate" name="hideDate" value="" >
                    <!-- 按钮-->
                    <p style="height: 25px;float: right;">
                        <input id="searchButton1" class="bntns2" type="button" value="搜索" onclick="doSearchCustomer();">
                        <input id="resetButton1" class="bntns2" type="button" value="清空" onclick="doClearCustomer();">
                    </p>
                </div>
            </div>
            <!--列表-->
            <div class="contact_list">
                <!-- 按钮-->
                <p style="height: 25px;margin: 0 0 12px;float: right;">
                    <!--<input id="" class="bntns1" type="button" value="导入">-->
                    <!--<input id="" class="bntns1" type="button" value="导出">-->
                    <input id="" style="background: #00a73c;margin-left: 52px;" class="bntns1" type="button" onclick="doAddCustomer();" value="新增">
                    <input id="" style="background: #f47469;" class="bntns1" type="button" onclick="doDeleteCustomer();" value="删除">
                </p>
                <div class="title">
                    <ul>
                        <li style="width: 10%;"><input id="allOrNot" type="checkbox" onclick="checkAllOrNot(this);"></li>
                        <li style="width: 25%;">客户名称</li>
                        <li style="width: 15%;">区域</li>
                        <li style="width: 15%;">行业</li>
                        <li style="width: 10%;">创建人</li>
                        <li style="width: 15%;">创建日期</li>
                        <li style="width: 10%;">操作</li>
                    </ul>
                </div>
                <div class="contentList">
                    <div id="customerContentList">
                    <?php if(!empty($customer_list["list"])): if(is_array($customer_list["list"])): $i = 0; $__LIST__ = $customer_list["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cus): $mod = ($i % 2 );++$i;?><ul>
                        <li style="width: 10%;"><input type="checkbox" name="checkbox" value="<?php echo ($cus["cusId"]); ?>"></li>
                        <li style="width: 25%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;color: #014f97" onclick="customerDetails(<?php echo ($cus["cusId"]); ?>)" title="<?php echo ($cus["cusName"]); ?>"><?php echo ($cus["cusName"]); ?>&nbsp;</li>
                        <li style="width: 15%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($cus["areaName"]); ?>"><?php echo ($cus["areaName"]); ?>&nbsp;</li>
                        <li style="width: 15%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($cus["tradeName"]); ?>"><?php echo ($cus["tradeName"]); ?>&nbsp;</li>
                        <li style="width: 10%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($cus["createUserName"]); ?>"><?php echo ($cus["createUserName"]); ?>&nbsp;</li>
                        <li style="width: 15%;"><?php echo ($cus["createTime"]); ?>&nbsp;</li>
                        <li style="width: 10%;">
                            <li style="width: 10%;">
                                <i style="color: #4f88b5;cursor: pointer;" class="fa fa-edit" title="编辑" onclick="doEditCustomer(<?php echo ($cus["cusId"]); ?>);"></i>
                                <i style="color:#de2e2f;padding-left: 15px;cursor: pointer;" class="fa fa-trash"  onclick="delCustomer(<?php echo ($cus["cusId"]); ?>);" title="删除"></i>
                            </li>
                        </li>
                    </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if(empty($customer_list["list"])): ?><ul class="topnone">
                            <li style="width: 100%;color:#f47469;">无数据! </li>
                        </ul><?php endif; ?>
                    </div>
                </div>
                <div id="pagebar2" class="pagebar" style="margin-top:20px;"></div>
            </div>
        </div>
        <!-- 区域管理-->
        <div id="a2" style="display: none;">
            <div class="contact_head">
                <span style="display: inline-block;">通讯录&nbsp;>&nbsp;区域管理</span>
                <div class="column">
                    <!-- 按钮-->
                    <p style="height: 25px;float: right;">
                        <!--<input id="searchButton0" class="bntns1" type="button" value="搜索" onclick="doSearch();" />-->
                        <input id="" class="bntns1" style="background: #00a73c;" type="button" value="新增" onclick="addArea();" />
                    </p>
                </div>
            </div>
            <!--列表-->
            <div class="contact_list">
                <div id="menuTreeArea" class="left_menu" style="width:240px;"></div>
                <div class="right_form">
                    <ul>
                        <li style="height: 25px;width:10%;line-height: 25px;">区域编号</li>
                        <li style="height: 25px;width:20%;line-height: 25px;">区域名称</li>
                        <li style="height: 25px;width:20%;line-height: 25px;">上级区域</li>
                        <li style="height: 25px;width:23%;line-height: 25px;">备注</li>
                        <li style="height: 25px;width:10%;line-height: 25px;">是否启用</li>
                        <li style="border-right: 1px solid #e2e0e0;height: 25px;width:15%;line-height: 25px;">操作</li>
                    </ul>
                    <div id="areacontactList"></div>
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
<script language="javascript" type="text/javascript" src="http://www.my97.net/dp/My97DatePicker/WdatePicker.js"></script>

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

 
 
 
<link rel="stylesheet" type="text/css" href="/wisdom/Public/Home/Default/js/EasyTree/ui.easytree.css" />
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/EasyTree/jquery.easytree.min.js"></script>
<script>
    $(function(){
        Cookie.eraseCookie("bigMenuIndex");
        Cookie.eraseCookie("smallMenuIndex");
        Cookie.createCookie("bigMenuIndex",0);
        Cookie.createCookie("smallMenuIndex",1);
        
        // 企业通讯录生成树形菜单
        $('#menuTree').easytree({
            data: <?php echo ($dept_list); ?>,
        });
        // 区域管理生成树形菜单
        $('#menuTreeArea').easytree({
            data: <?php echo ($area_dept_list); ?>,
        });

        createPageBar('<?php echo ($user_list["total"]); ?>', '<?php echo ($user_list["pageSize"]); ?>', '<?php echo ($user_list["page"]); ?>', '<?php echo ($user_list["totalPage"]); ?>');
        $(document).on('click','#pagebar1 span a', function() {
            getUserListByDeptId(0, $(this).attr("rel"))
        });

        createPageBar2('<?php echo ($customer_list["total"]); ?>', '<?php echo ($customer_list["pageSize"]); ?>', '<?php echo ($customer_list["page"]); ?>', '<?php echo ($customer_list["totalPage"]); ?>');
        $(document).on('click','#pagebar2 span a', function() {
            getCustomerList(0, $(this).attr("rel"))
        });

        var start = {
            elem: '#startDate',
            format: 'YYYY-MM-DD',
            min: '1699-06-16', //设定最小日期为当前日期
            max: laydate.now(+180), //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                end.min = datas; //开始日选好后，重置结束日的最小日期
                end.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end = {
            elem: '#endDate',
            format: 'YYYY-MM-DD',
            min: '1699-06-16',
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        laydate(start);
        laydate(end);
    });

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

    var ret = '<?php echo ($return); ?>';
    if(ret == 1) {
        $('#bigmenu li').removeClass('org_box org_box_select');
        $('#bigmenu li span').removeClass('org_bot_cor');
        $('#bigmenu li').attr('class','org_box');
        $('#bigmenu #1').attr('class','org_box  org_box_select');
        $('#bigmenu #1').children('span').attr('class','org_bot_cor');
        $('#a0').hide();
        $('#a1').show();
        $('#a2').hide();
    } else if(ret == 2) {
        $('#bigmenu li').removeClass('org_box org_box_select');
        $('#bigmenu li span').removeClass('org_bot_cor');
        $('#bigmenu li').attr('class','org_box');
        $('#bigmenu #2').attr('class','org_box  org_box_select');
        $('#bigmenu #2').children('span').attr('class','org_bot_cor');
        $('#a0').hide();
        $('#a1').hide();
        $('#a2').show();
    }

    function selectcusAreas() {
        var cusArea = $("#cusArea").val();
        var hidcusArea = $("#hidcusArea").val();
        layer.open({
            type:2,
            title :['选择区域','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['400px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectcusAreas');?>" + "?cusArea=" + cusArea + "&hidcusArea=" + hidcusArea,
        });
    }
    
    function selectcusTrades() {
        var cusTrade = $("#cusTrade").val();
        var hidcusTrade = $("#hidcusTrade").val();
        layer.open({
            type:2,
            title :['选择行业','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['400px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectcusTrades');?>" + "?cusTrade=" + cusTrade + "&hidcusTrade=" + hidcusTrade,
        });
    }
    
    //新增客户弹窗
    function doAddCustomer(){
        layer.open({
            type:2,
            title :['新增客户','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['600px', '700px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addClient'
        });
    }

    //编辑客户弹窗
    function doEditCustomer(cusId){
        layer.open({
            type:2,
            title :['编辑客户','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['600px', '700px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addClient?cusId='+cusId
        });
    }

    //员工信息
    function showUserDetail(uid){
        layer.open({
            type:2,
            title:['员工信息','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area:['440px', '420px'],
            shadeClose:false,
            content: "<?php echo U('Office/showUserDetail');?>?uid=" + uid,
        });
    }

    /*点击左侧部门列表时，根据部门ID获取用户列表*/
    function getUserListByDeptId(deptId, page) {
        var loadIdx = layer.load(0);
        if (deptId == 0) {  // 翻页
            deptId = $("#hidDeptId").val();
        } else if (deptId == -1) {  // 点击检索按钮
            page = 1;
            <?php  ?>
            deptId = "";
            $("#hidDeptId").val("");
        } else {    // 点击左侧部门LINK
            page = 1;
            $("#hidDeptId").val(deptId);
            $("#hidSearchName").val("");
            $("#hidSearchMobile").val("");
            $("#searchName").val("");
            $("#searchMobile").val("");
        }

        var name = $("#hidSearchName").val();
        var mobile = $("#hidSearchMobile").val(); 
        $("#user_list_content").empty();
        $.post("<?php echo U('Office/getUserList');?>", {"deptId":deptId, "page":page, "name":name, "mobile":mobile}, function(data) {
            if (!("list" in data)) {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
                return;
            }
            var content = "";
            // 设定用户列表
            $.each(data.list, function(k, v) {
                content += '<ul class="topnone">';
                content += '<li style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="'+v.deptName + '">' + v.deptName + '</li>';
                content += '<li style="cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;color: #014f97" onclick="showUserDetail(' + v.id + ')" title="' + v.name + '">' + v.name + '</li>';
                content += '<li>' + v.position + '</li>';
                content += '<li style="border-right: 1px solid #e2e0e0">' + v.mobile + '</li>';
                content += '</ul>';
            });
            if (content == "") {
                content = '<ul class="topnone">';
                content += '<li style="width:98.4%;color:#f47469;border-right: 1px solid #e2e0e0">无数据! </li>';
                content += '</ul>';
            }
            $("#user_list_content").append(content);
            createPageBar(data.total, data.pageSize, data.page, data.totalPage);
            layer.close(loadIdx);
        }, 'json');  
    }

    /*点击翻页时，获取客户列表*/
    function getCustomerList(type, page) {
    	var loadIdx = layer.load(0);
        if(type == 0) { // 翻页
            $("#allOrNot:checkbox").attr("checked", false);
        } else { // 检索
            page = 1;
         	$("#allOrNot:checkbox").attr("checked", false);
        }
        	 
        var cusId = $("#hidcusId").val();
        var cusName = $("#hidcustomerName").val();
        var cusArea = $("#hidcusArea").val(); 
        var cusTrade = $("#hidcusTrade").val();
        var startDate = $("#hidsDate").val();
        var endDate = $("#hideDate").val();
        $("#customerContentList").empty();

        $.post("<?php echo U('Office/getCustomerList');?>", {"cusId":cusId, "page":page, "cusName":cusName, "cusArea":cusArea, "cusTrade":cusTrade, "startDate":startDate, "endDate":endDate}, function(data) {
           
        	if (!("list" in data)) {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
                return;
            }
            var content = "";
            // 设定用户列表
            $.each(data.list, function(k, v) {
                content += '<ul>';
                content += '<li style="width: 10%;">';
                content += '<input type="checkbox" name="checkbox" value="' + v.cusId + '">';
                content += '</li>';
                content += '<li style="width: 25%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;color: #014f97" onclick="customerDetails(' + v.cusId + ')" title="'+v.cusName+'">';
                content += v.cusName + '&nbsp;</li>';
                content += '<li style="width: 15%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="' + v.areaName + '">' + v.areaName + '&nbsp;</li>';
                content += '<li style="width: 15%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="' + v.tradeName + '">' + v.tradeName + '&nbsp;</li>';
                content += '<li style="width: 10%;cursor: pointer;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="' + v.createUserName + '">' + v.createUserName + '&nbsp;</li>';
                content += '<li style="width: 15%;">' + v.createTime + '</li>';
                content += '<li style="width: 10%;">';
                content += '<li style="width: 10%;">';
                content += '<i style="color: #4f88b5;cursor: pointer;" class="fa fa-edit" onclick="doEditCustomer(' + v.cusId + ');" title="编辑"></i>';
                content += '<i style="color:#de2e2f;padding-left: 15px;cursor: pointer;" class="fa fa-trash" onclick="delCustomer(' + v.cusId + ')" title="删除"></i>';
                content += '</li></li>';
                content += '</ul>';
            });
            if (content == "") {
                content = '<ul>';
                content += '<li style="width:100%;color:#f47469;">无数据! </li>';
                content += '</ul>';
            }
           $("#customerContentList").append(content);
           createPageBar2(data.total, data.pageSize, data.page, data.totalPage);
           layer.close(loadIdx);
        }, 'json'); 
    }

    /*点击左侧部门列表时，根据区域ID获取区域列表*/
    function getUserListByAreaId(areaId) {
        var loadIdx = layer.load(0);

        $("#areacontactList").empty();
        if(areaId != 0) {
            $.post("<?php echo U('Office/getPatrolArea');?>", {"areaId":areaId}, function(data) {
                if (!("list" in data)) {
                    layer.close(loadIdx);
                    layer.msg(data.error_text,{icon: 8});
                    return;
                }
                var content = "";
                var parentAreaName = "";
                if(data.parentAreaName) {
                    parentAreaName = data.parentAreaName;
                }
                // 设定区域列表
                $.each(data, function(k, v) {
                    if(k == 'list') {
                        content += '<ul class="topnone">';
                        content += '<li style="height:50px;width:10%;">'+ v.no +'</li>';
                        content += '<li style="height:50px;width:20%;line-height:50px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"  title="'+ v.areaName +'">'+ v.areaName +'</li>';
                        content += '<li style="height:50px;width:20%;line-height:50px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'+ parentAreaName +'</li>';
                        var areaRemakr = "";
                        if(v.areaRemakr) {
                            areaRemakr = v.areaRemakr;
                        }
                        content += '<li style="height:50px;width:23%;line-height:50px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">'+ areaRemakr +'</li>';
                        var areaActive = "否";
                        if(v.areaActive == 1) {
                            areaActive = "是";
                        }
                        content += '<li style="height:50px;width:10%;line-height:50px;">' + areaActive + '</li>';
                        content += '<li style="height:50px;width:15%;line-height:50px;border-right: 1px solid #e2e0e0">';
                        content += '<i style="color: #4f88b5;cursor: pointer;" class="fa fa-edit" title="编辑" onclick="editArea('+ v.areaId +');"></i>';
                        content += '<i style="color:#de2e2f;padding-left: 15px;cursor: pointer;" class="fa fa-trash"  onclick="deleteArea('+ v.areaId +');" title="删除"></i>';
                        content += '</li></ul>';
                    }
                });
                if (content == "") {
                    content = '<ul class="topnone">';
                    content += '<li style="width:98.4%;color:#f47469;border-right: 1px solid #e2e0e0">无数据! </li>';
                    content += '</ul>';
                }
                $("#areacontactList").append(content);
                layer.close(loadIdx);
            }, 'json');  
        } else {
            layer.close(loadIdx);
        }
    }

    function createPageBar(t,ps,p,tp) {
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

    function doClear() {
        $("#searchName").val("");
        $("#searchMobile").val("");
    }

    // 客户通讯录清空按钮
    function doClearCustomer() {
        $("#cusName").val("");
        $("#cusArea").val("");
        $("#cusTrade").val("");
        $("#startDate").val("");
        $("#endDate").val("");
    }

    function doSearch() {
        $("#hidSearchName").val($("#searchName").val());
        $("#hidSearchMobile").val($("#searchMobile").val());
        getUserListByDeptId(-1);
    }
    
    // 客户通讯录检索
    function doSearchCustomer() {
        $("#hidcustomerName").val($("#cusName").val());
        $("#hidsDate").val($("#startDate").val());
        $("#hideDate").val($("#endDate").val());
        getCustomerList(1);
    }

    // 客户通讯录 全选和反选
    function checkAllOrNot(obj) {
        var checkbox = document.getElementsByName("checkbox");
        if(obj.checked == true) {
            for (var i = 0; i < checkbox.length; i++) {
                var e = checkbox[i];
                e.checked = true;
            }
        } else {
            for (var i = 0; i < checkbox.length; i++) {
                var e = checkbox[i];
                e.checked = false;
            }
        }
    }

    // 删除客户
    function doDeleteCustomer() {
        var checkbox = document.getElementsByName("checkbox");
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
            layer.msg("请选择删除客户",{icon: 8});
            return false;
        }
        delCustomer(ids);
    }

    function delCustomer(ids) {
        var loadIdx = layer.load(0);
        $("#customerContentList").empty();
        $.post("<?php echo U('Office/deleteCustomer');?>", {"ids":ids}, function(data) {
            layer.close(loadIdx);
            if(data.error_code != "success") {
                layer.msg("存在关联信息的客户不能删除。",{icon: 8});
            }
            getCustomerList(0, page);
        }, 'json');  
    }

    function customerDetails(cusId) {
        var url = APP+'/Home/Office/customerDetails?cusId='+cusId;
        window.location.href = url;
    }

    function addArea() {
        var url = APP+'/Home/Office/editArea.html';
        window.location.href = url;
    }

    function editArea(areaId) {
        var url = APP+'/Home/Office/editArea?areaId='+areaId;
        window.location.href = url;
    }

    function deleteArea(areaId) {
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removePatrolArea');?>", {"areaId":areaId}, function(data) {
            layer.close(loadIdx);
            if(data.error_code != "success") {
                layer.msg("删除失败。",{icon: 8});
            } else {
                layer.msg("删除成功。");
                sendArea();
            }
        }, 'json');  
    }
    function sendArea() {
        var url = APP+'/Home/Office/contact?return=2';
        window.location.href = url;
    }
</script>
</body>
</html>