<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>招商任务管理::新增</title>
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
<style type="text/css">
    .business_taskAdd_contener .line_input {
        width: 400px;
        min-height: 110px;
        text-align: center;
        margin-left: 60px;
        display: none;
        float: right;
        margin-top: -33px;
    }
    .line_input1 {
        width: 100%;
        min-height: 50px;
        line-height: 50px;
    }
    .line_input1.height {
        /*height: 100px;*/
    }
    .line_input1.height.aaa {
        margin-top: 40px;
    }
    .line_input88{
        width: 100%;
        min-height: 50px;
        line-height: 50px;
    }

    .fll{
        float: left;}
    .flr{
        float: right;}
    #show_img_ban img{width: 300px;height: 100px;}
    .faith_guarantee {
    width: 99.6%;
    margin-top: 20px;
    float: left;
}
    .faith_guarantee_content{
        padding:5px;
        border-bottom:1px #fafafa solid;
        border-left:1px  #fafafa solid;
        border-right:1px #fafafa solid;
        margin-bottom:20px;

    }
    .business_taskAdd_contener .mobileView {
        width: 400px;
        min-height: 600px;
        float: right;
        margin-right: 60px;
    }
     .mobileView .mobileViewbg{
         width: 370px;
         height: 536px;
         background: url("/wisdom/Public/Home/Default/images/phone.png") 60px 10px/260px 522px padding-box no-repeat;
         z-index: 1;
         position: relative;
     }
    .mobileView .mobileViewbg .mobileViewcn{
        width: 370px;
        height: 610px;
        background: url("/wisdom/Public/Home/Default/images/bus_pic1.png") 70px 75px/240px 395px padding-box no-repeat;
        z-index: 1;
        position: relative;
    }
    .mobileView .mobileViewbg .mobileViewcn1{
        width:370px;
        height:610px;
        background: url("/wisdom/Public/Home/Default/images/bus_pic2.png") 70px 75px/240px 395px padding-box no-repeat;
        z-index:1;
        position: relative;
    }
    .mobileViewcn1 .tasktitle{
        position: absolute;
        left: 90px;
        top: 140px;
        color: #5A5A5A;
        font-weight: bold;
        width: 250px;
        font-family: 微软雅黑;
        /* border: 1px solid; */
        height: 30px;
        line-height: 30px;
    }
    .mobileViewcn .gold-coin{
        position: absolute;
        left: 140px;
        top: 247px;
        /* font-size: 20px; */
        background: #EE7C00;
        border: 1px solid #fff;
        border-radius: 91px;
        z-index: 2;
        /* font-size: smaller; */
        color: #fff;
        width: 30px;
        /* line-height: 20px; */
        height: 22px;
        padding: 6px 5px 13px 10px;

    }
    .mobileViewcn1 .gold-coin{
        position: absolute;
        left: 150px;
        top: 182px;
        font-size: 20px;
        color: #F60;
    }
    .mobileViewcn1 .endTime{
        position: absolute;
        left: 150px;
        top: 228px;
        font-size: 12px;
    }
    .mobileViewcn1 .hard{
        position: absolute;
        left: 150px;
        top: 246px;
    }
    .mobileViewcn1 .margin{
        position: absolute;
        right: 65px;
        top: 246px;
    }
    .mobileViewcn1 .desc{
        position: absolute;
        right: 24px;
        top: 268px;
        width: 260px;
        height: 225px;
        line-height: 18px;
        word-wrap:break-word;
        word-break:break-all;
        overflow: hidden;
        overflow-y: auto;

    }
    .mobileViewcn .stime{
        position: absolute;
        left: 108px;
        top: 200px;
        color: #ccc;
    }
    .mobileViewcn .tasktitle{
        position: absolute;
        left: 176px;
        top: 220px;
        color: #5A5A5A;
        font-weight: bold;
        width: 150px;
        font-family: serif;
    }
    .mobileViewcn .imgView{
        width: 70px;
        height: 63px;
        border: 1px solid;
        position: absolute;
        left: 94px;
        top: 218px;
    }
    .mobileViewcn .taskkind{
        position: absolute;
        top: 273px;
        right: 54px;
        color: #F08403;
    }

</style>
<div class="index">
    <div class="index_left">
        <div class='org_box  org_box_select'><span class='org_bot_cor'></span>全部任务</div>
    </div>
    <div class="index_right_bus">
        <div class="task_list1">
            <div style='height:20px;width:200px;text-align:left;float:left'  id="business_task_title_top"></div>
        </div>

        <div  class='taskAdd_conter'>
            <div  class="business_taskAdd_step">
                <ul>
                    <li  class="step_one  business_taskAdd_step_selected">基本信息</li>
                    <li  class="step_two">招商区域</li>
                    <li  class="step_three">招商详情</li>
                    <li  class="step_four">上传资料</li>
                    <li  class="step_five">诚信保证</li>
                </ul>
            </div>
            <!--创建任务-->

            <div  class="business_taskAdd_contener">
                <!--创建任务-->
                <div  id="business_taskAdd_step_contener0">

                    <div style="float: left;width: 50%">
                        <div class="line_input1" style="margin-top:20px">
                            <span> <span style="color: red;padding-right:5px;">*</span>发布单位</span><input
                                style="margin-left:23px;width: 243px;" type="text" id="companyName" placeholder="录入发布单位"
                                disabled value="<?php echo ($companyName); ?>"/>
                            <input type="hidden" id="companyId1" name="companyId" value="<?php echo ($companyId); ?>"/>
                            <!--<span  class="business_taskAdd_spanText">*输入时自动检索，没有请先开户</span>-->
                        </div>
                        <div class="line_input1">
                            <span><span style="color: red;padding-right:5px;">*</span>所属行业</span>
                            <select id="biglist" val="<?php echo ($big); ?>" style="margin-left:20px">
                                <option>选择行业大类</option>
                                <?php if(is_array($biglist)): foreach($biglist as $key=>$vo): ?><option value="<?php echo ($vo[f_tradeid]); ?>"
                                    <?php if($big == $vo[f_tradeid]): ?>selected<?php endif; ?>
                                    ><?php echo ($vo[f_tradename]); ?></option><?php endforeach; endif; ?>
                            </select>

                            <select id="tradeid" value="<?php echo ($small); ?>" style="margin-left:10px;">
                                <?php if ($small) {?>
                                <?php if(is_array($smalllist)): $i = 0; $__LIST__ = $smalllist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo1[0][f_tradeid]); ?>"
                                    <?php if($small == $vo1[0][f_tradeid]): ?>selected<?php endif; ?>
                                    ><?php echo ($vo1[0][f_tradename]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                <?php }else{?>
                                <option>选择行业小类</option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="line_input1">
                            <span> <span style="color: red;padding-right:5px;">*</span>任务标题</span>
                            <input style="margin-left:20px;width: 243px;" type="text" id="title" name="title"
                                   value="<?php echo ($reModi["one"]["f_title"]); ?>" placeholder="请输入任务标题">
                            <!--<span class="business_taskAdd_spanText"> *任务标题,显示在客户端</span>-->
                        </div>
                        <div class="line_input1" style="line-height: 25px;margin-top: 8px;">
                            <span> <span style="color: red;padding-right:5px;">*</span>任务时间</span>
                            <input style="margin-left: 20px;width: 83px;" id="startdate" class="laydate-icon"
                                   placeholder="起始时间" value="<?php echo ($reModi["one"]["f_begindate"]); ?>"/><span
                                style="display: inline-block;padding:0px 7px ">至</span>
                            <input id="enddate" style="width: 83px;" class="laydate-icon" placeholder="终止时间"
                                   value="<?php echo ($reModi["one"]["f_enddate"]); ?>"/>
                            <br>
                            <span class="business_taskAdd_spanText"
                                  style="margin-left: 80px;color: #ccc;">最多不超过180天</span>

                        </div>
                        <div class="line_input1">
                            <span> <span style="color: red;padding-right:5px;">*</span>任务联系人</span> <input
                                style="margin-left:9px;width: 243px;" type="text" id="linkman" name="linkman"
                                placeholder="企业联系人姓名" value="<?php echo ($reModi["one"]["f_linkman"]); ?>">
                        </div>
                        <div class="line_input1">
                            <span> <span style="color: red;padding-right:5px;">*</span>咨询电话</span> <input
                                style="margin-left: 20px;width: 243px;" type="text" id="linkphone" name="linkphone"
                                placeholder="企业联系人电话" value="<?php echo ((isset($reModi["one"]["f_linkphone"]) && ($reModi["one"]["f_linkphone"] !== ""))?($reModi["one"]["f_linkphone"]):$mobile); ?>">
                        </div>
                        <div class="line_input1" style="margin-top:10px;line-height: 25px;">
                            <span style="display: inline-block;float:left"> <span style="color: red;padding-right:5px;">*</span>任务logo</span>
                            <button id="btn_up" onclick="$('#upfile').click()" class="business_taskAdd_button"
                                    style="margin-left:20px">上传图片
                            </button>
                            <div style="display: none;">
                                <input type="file" id="upfile" name="upfile" accept="image/jpeg,image/gif,image/png">
                            </div>
                            <input type="hidden" id="fileid" name="fileid" value="<?php echo ($reModi["one"]["f_fileid"]); ?>">
                            <?php if ($reModi['one']['f_name']) {?>
                            <div class="show_img" id='show_img'>
                                <div id="showPic">
                                    <img src="/wisdom/Public/upfile/<?php  echo $reModi[one][f_name][f_filepath],$reModi[one][f_name][f_filename];?>"
                                         width="100" height="100">
                                </div>
                                <?php }else{?>
                                <div class="show_img" id='show_img' style="display:none">
                                    <?php }?>
                                </div>
                                <br>
                                <span style="display:inline-block;  margin-left: 80px;color: #ccc"
                                      class="business_taskAdd_spanText">建议使用方形、大小不要超过50KB的jpg/png图片</span>
                            </div>

                                <!--<div class="line_input "  id="line_input_one" style="margin-top: -70px;display:block;">-->
                                <!--&lt;!&ndash;<div class="show_progress_no" id='show_progress_no'></div>&ndash;&gt;-->
                                <!--&lt;!&ndash;<div class="progress_up" id='progress_up'><div class="bar" id='bar'></div></div>&ndash;&gt;-->
                                <!--<div class="show_img" id='show_img'>-->
                                <!--<?php if ($reModi['one']['f_name']) {?>-->
                                <!--<div id="showPic">-->
                                <!--<img src="/wisdom/Public/upfile/$reModi.one][f_name][f_filepath],$reModi[one][f_name][f_filename];?>" width="100" height="100">-->
                                <!--</div>-->
                                <!--<?php }?>-->
                                <!--</div>-->
                                <!--</div>-->

                        <div class="line_input1" style="margin-top:10px;line-height: 25px;">
                                <span style="display: inline-block;float:left"> <span
                                        style="color: red;padding-right:5px;">*</span>banner广告</span>
                            <button id="btn_ban" onclick="$('#upfile_ban').click()" class="business_taskAdd_button"
                                    style="margin-left:7px">上传图片
                            </button>

                            <div style="display: none;">
                                <input type="file" id="upfile_ban" name="upfile"
                                       accept="image/jpeg,image/gif,image/png">
                            </div>
                            <input type="hidden" id="fileid_ban" name="fileid_ban"
                                   value="<?php echo ($reModi["one"]["f_fileid_ban"]); ?>">

                            <?php if ($reModi['one']['f_ban']) {?>
                            <div class="show_img" id='show_img_ban'>
                                <div id="showBan">
                                    <img src="/wisdom/Public/upfile/<?php  echo $reModi[one][f_ban][f_filepath],$reModi[one][f_ban][f_filename];?>">
                                </div>
                                <?php }else{?>
                                <div class="show_img" id='show_img_ban' style="display:none;">
                                    <?php }?>
                                </div>
                                <br>
                                    <span style="display:inline-block;  margin-left: 80px;color: #ccc;"
                                          class="business_taskAdd_spanText">建议使用长宽为3：1、大小不超过200K的jpg/png图片</span>
                            </div>

                            <div style="width:100%;float:left;min-height:100px; ">
                                <!--<?php if($reModi.two.f_tryout == 0 ): ?>checked<?php endif; ?>-->
                                <div style="padding: 20px 0 0 0;">
                                    <sapn><span style="color: red;padding-right:5px;">*</span> 支持试用：</sapn>
                                        <span><input type="radio" style="font-size:15px;margin-right:7px;" <?php  if($reModi["two"]["f_tryout"]==0){ echo "checked";}?>name="whprovidetrial"  onclick="whprovidertrial(0)"  value="0">否</span>
                                        <span><input type="radio" style="font-size:15px;margin-right:7px;margin-left: 20px;" <?php  if($reModi["two"]["f_tryout"]==1){ echo "checked";}?>name="whprovidetrial"  onclick="whprovidertrial(1)"  value="1">是</span>
                                        <span style="padding-left:20px;">试用样品份数：</span>
                                        <input type="text" style="width:100px;border:1px #cccccc solid;height:30px;margin-left:26px;padding-left:5px;" id="trialnum" value="<?php echo ((isset($reModi["two"]["f_tryoutnumber"]) && ($reModi["two"]["f_tryoutnumber"] !== ""))?($reModi["two"]["f_tryoutnumber"]):0); ?>">
                                </div>
                                <div style="margin: 14px 0 0 0; <?php  if($reModi['two']['f_tryout']==0){ echo "display:none";}else{ echo "display:block"; }?>" id="whpaid">
                                    试用是否付费：<span><input type="radio" style="font-size:15px;margin-right:7px" <?php  if($reModi["two"]["f_payment"]==0){ echo "checked";}?>name="whpaid"  onclick="whpaid(0)"  value="0">否</span>
                                    <span><input type="radio" style="font-size:15px;margin-right:7px; margin-left: 20px;" <?php  if($reModi["two"]["f_payment"]==1){ echo "checked";}?>name="whpaid"  onclick="whpaid(1)"  value="1">是</span>
                                    <span style="padding-left:20px">试用样品单价(元)：</span> <input type="text" style="width:100px;border:1px #cccccc solid;height:30px;margin-left:7px;padding-left:5px;" id="trialprice" value="<?php echo ((isset($reModi["two"]["f_paymentmoney"]) && ($reModi["two"]["f_paymentmoney"] !== ""))?($reModi["two"]["f_paymentmoney"]):0); ?>">
                                </div>
                            <div class="line_input1" style="margin-top:10px">
                                                               <span style="padding-left:7px;float: left;">招商描述
                                                                   <!--<span style="color: red;">（更好的让你的产品在众多招商列表中脱颖而出，吸引用户参与，限30字内。）</span>-->
                                                               </span>
                                <textarea value="" name="pro_taskDescription" id="pro_taskDescription"
                                          style="width:350px;height:100px;color:#595758;font-size:15px;margin-left:20px;float:left;margin-top:20px;border:1px #cacaca solid"><?php echo ($reModi["one"]["f_description"]); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!--<div style="float: right;border: 1px solid;min-height: 500px;width: 40%;">-->
                        <div class="mobileView">
                            <div class="mobileViewbg">
                                <div class="mobileViewcn">
                                    <div class="stime" id="stime1"><?php echo ($reModi["one"]["f_begindate"]); ?></div>
                                    <p class="tasktitle"  id="tasktitle1"><?php echo ($reModi["one"]["f_title"]); ?></p>
                                    <div class="gold-coin">+<span class="span_coin"><?php echo ($gold_coin); ?></span><br>金币</div>
                                    <div class="imgView">
                                        <img src="/wisdom/Public/upfile/<?php  echo $reModi[one][f_name][f_filepath],$reModi[one][f_name][f_filename];?>" alt=""  id="imgView1"  width="70"  height="63" />
                                    </div>
                                    <p class="taskkind">
                                        <?php if($tasktype == 4): ?>调研
                                            <?php elseif($tasktype == 5): ?>
                                            推荐
                                            <?php elseif($tasktype == 6): ?>
                                            答题
                                            <?php else: ?>
                                            督察<?php endif; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="mobileViewbg">
                                <div class="mobileViewcn1">
                                    <p class="tasktitle" id="tasktitle2"><?php echo ($reModi["one"]["f_title"]); ?></p>
                                    <p class="gold-coin"><span  class="span_coin"><?php echo ($gold_coin); ?></span></p>
                                    <p class="endTime" id="stime2"><?php echo ($reModi["one"]["f_enddate"]); ?></p>
                                    <p class="hard" id="hard" >
                                        <?php if($reModi['one']['f_harder']==1){echo "简单";}?>
                                        <?php if($reModi['one']['f_harder']==2){echo "中等";}?>
                                        <?php if($reModi['one']['f_harder']==3){echo "挑战";}?>

                                    </p>
                                    <p class="margin"><?php echo ($reModi["pro"]["f_totalcopies"]); ?></p>
                                    <div class="desc" id="desc">
                                        <?php echo ($reModi["pro"]["f_taskrequirements"]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--</div>-->

                                <input type="hidden" id="tasktypeid" name="tasktypeid" value="3">
                                <input type="hidden" id="taskid" name="taskid" value="<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>">
                                <button  class="business_taskAdd_button   business_taskAdd_button_next" id="task_one" style="margin-top:30px;margin-left:300px" >下一步</button>
                </div>
            </div>
        </div>

                <!--基本信息-->
                        <div  id="business_taskAdd_step_contener1" style="display: none" >
                            <!--<div class="line_input1" style="padding-top:20px">-->
                                <!--<span>任务品牌</span><input style="margin-left:7px" type="text" id="mtbrand" placeholder="任务品牌" value="<?php echo ($reModi["two"]["f_mtbrand"]); ?>">-->
                            <!--</div>-->


                            <!--<div class="line_input1">-->
                                <!--<span>产品名称</span><input style="margin-left:7px" type="text" id="mtgoods" placeholder="招商产品，多个用英文逗号分开"  value="<?php echo ($reModi["two"]["f_mtgoods"]); ?>">-->
                            <!--</div>-->
                            <!--试用说明-->
                            <!--<div style="width:100%;float:left;min-height:100px; padding-left: 10px;">-->
                                <!--&lt;!&ndash;<?php if($reModi.two.f_tryout == 0 ): ?>checked<?php endif; ?>&ndash;&gt;-->
                                <!--<div style="padding: 20px 0 0 0;">-->
                                   <!--是否提供试用：<span><input type="radio" style="font-size:15px;margin-right:7px;" <?php  if($reModi["two"]["f_tryout"]==0){ echo "checked";}?>  name="whprovidetrial"  onclick="whprovidertrial(0)"  value="0">否</span>-->
                                                <!--<span><input type="radio" style="font-size:15px;margin-right:7px;margin-left: 20px;" <?php  if($reModi["two"]["f_tryout"]==1){ echo "checked";}?> name="whprovidetrial"  onclick="whprovidertrial(1)"  value="1">是</span>-->
                                   <!--<span  style="padding-left:20px;">试用样品份数：</span><input type="text"  style="width:100px;border:1px #cccccc solid;height:30px;margin-left:26px;padding-left:5px;"  id="trialnum" value="<?php echo ((isset($reModi["two"]["f_tryoutnumber"]) && ($reModi["two"]["f_tryoutnumber"] !== ""))?($reModi["two"]["f_tryoutnumber"]):0); ?>">-->
                               <!--</div>-->
                                <!--<div style="margin: 14px 0 0 0; <?php  if($reModi['two']['f_tryout']==0){ echo "display:none";}else{ echo "display:block"; }?>" id="whpaid">-->
                                   <!--试用是否付费：<span><input type="radio" style="font-size:15px;margin-right:7px" <?php  if($reModi["two"]["f_payment"]==0){ echo "checked";}?> name="whpaid"  onclick="whpaid(0)"  value="0">否</span>-->
                                                <!--<span><input type="radio" style="font-size:15px;margin-right:7px; margin-left: 20px;" <?php  if($reModi["two"]["f_payment"]==1){ echo "checked";}?> name="whpaid"  onclick="whpaid(1)"  value="1">是</span>-->
                                   <!--<span style="padding-left:20px">试用样品单价(元)：</span> <input type="text"  style="width:100px;border:1px #cccccc solid;height:30px;margin-left:7px;padding-left:5px;"  id="trialprice" value="<?php echo ((isset($reModi["two"]["f_paymentmoney"]) && ($reModi["two"]["f_paymentmoney"] !== ""))?($reModi["two"]["f_paymentmoney"]):0); ?>">-->
                               <!--</div>-->
                            <!--</div>-->

                            <!--招商区域-->
                            <div style="width:100%;float:left;margin-top:10px;min-height:400px;border-top:1px #cccccc solid">
                                <div class="line_input2" style="padding-top:10px">
                                    <span>招商区域及数量</span>
                                    <select id="s_province" name="s_province" style="margin-left:7px;">

                                    </select>
                                    <select id="s_city"  name="s_province" style="margin-left:7px;">

                                    </select>
                                    <select id="s_county"  name="s_county" style="margin-left:7px;">

                                    </select>
                                    <input type="text" id="business_sum" placeholder="招商数量" style="width:60px;margin-left:9px;">
                                    <button id="add_area" class="btn" style="margin-top:9px;margin-left:12px;width: 60px;font-size: 12px;font-weight: normal;line-height: 25px;">确认添加</button>
                                    <span style="color: red;float: left;margin-right: 20px;">*请输入至少以省级为单位和数量，按“确认添加”后，招商区域和数量自动添加入招商列表。可添加多个，也可以点击列表中的“删除”，删除不需要的招商区域及数量。</span>
                                    <input type="hidden" id="area_stats" value="0">
                                    <input type="hidden" id="area_stats_num" value="0">
                                </div>

                                <div  class="line_input2" id="business_situation_list" style="margin-top:10px"  >
                                    <div class="business_taskAdd_step  step"  id="business_situation_list_top" style="display:none">
                                        <ul>
                                            <li>招商区域</li>
                                            <li>招商数量</li>
                                            <li>操作</li>
                                        </ul>
                                    </div>
                                    <div class="business_taskAdd_step step " style="background-color: #fff" id="business_situation_list_conter" >

                                    </div>
                                </div>
                            </div>
                            <!--佣金-->
                            <div class="line_input1" style="margin-top:20px;border-top:1px #cacaca solid">
                                <span>每单总首批款<span style="padding-left: 7px;">=</span></span>
                                首批发货款<input style="margin-left:7px;width: 80px;border-left: medium none;border-right: medium none;border-top: medium none;" type="text" id="payment" value="<?php echo ((isset($reModi["two"]["f_unitfirstamount"]) && ($reModi["two"]["f_unitfirstamount"] !== ""))?($reModi["two"]["f_unitfirstamount"]):0); ?>"  oninput="psum_q();">
                                <span style="padding:0 7px;">+</span> 保证金<input type="text" id="bond"  value="<?php echo ((isset($reModi["two"]["f_unitcashdeposit"]) && ($reModi["two"]["f_unitcashdeposit"] !== ""))?($reModi["two"]["f_unitcashdeposit"]):0); ?>" style="border-left: medium none;border-right: medium none;border-top: medium none;width: 70px;margin-left:7px" oninput="psum_q();">
                                <span style="padding:0 7px;">+</span> 加盟费<input type="text" id="franchise"  value="<?php echo ((isset($reModi["two"]["f_unitfranchisefee"]) && ($reModi["two"]["f_unitfranchisefee"] !== ""))?($reModi["two"]["f_unitfranchisefee"]):0); ?>"  style="border-left: medium none;border-right: medium none;border-top: medium none;width: 70px;margin-left:7px" oninput="psum_q();">
                                <span style="padding:0 7px;">+</span>其他费用<input type="text" id="otherprice"  style="border-left: medium none;border-right: medium none;border-top: medium none;width: 70px;margin-left:7px" value="<?php echo ((isset($reModi["two"]["f_unitotheramount"]) && ($reModi["two"]["f_unitotheramount"] !== ""))?($reModi["two"]["f_unitotheramount"]):0); ?>" oninput="psum_q();">
                                <span style="padding:0 7px">合计：<span id="pricesum_txt" style="color:red;"><?php echo ((isset($reModi["two"]["f_unittotalamount"]) && ($reModi["two"]["f_unittotalamount"] !== ""))?($reModi["two"]["f_unittotalamount"]):0); ?></span>元
                            </div>


                            <div class="line_input1">
                                <span>每单任务总佣金<span style="padding-left: 7px;">=</span></span>
                                业务员佣金<input style="margin-left:7px;width: 80px;color:red;" disabled type="text" id="agents_commission" value="<?php echo ((isset($reModi["two"]["f_unitcommission"]) && ($reModi["two"]["f_unitcommission"] !== ""))?($reModi["two"]["f_unitcommission"]):0); ?>">
                                <span style="padding:0 7px;">+</span>税务处理<input type="text" id="shuiw_commission"  value="<?php echo ((isset($reModi["two"]["f_shuiw_commission"]) && ($reModi["two"]["f_shuiw_commission"] !== ""))?($reModi["two"]["f_shuiw_commission"]):0); ?>" style="width: 70px;margin-left:7px;color:red;" disabled>
                                <span style="padding:0 7px;">+</span> 商务人员佣金<input type="text" id="shangw_commission"  value="<?php echo ((isset($reModi["two"]["f_shangw_commission"]) && ($reModi["two"]["f_shangw_commission"] !== ""))?($reModi["two"]["f_shangw_commission"]):0); ?>" style="width: 70px;margin-left:7px;color:red;" disabled>
                                <span style="padding:0 7px;">+</span> 推广人员佣金<input type="text" id="tuig_commission"  value="<?php echo ((isset($reModi["two"]["f_tuig_commission"]) && ($reModi["two"]["f_tuig_commission"] !== ""))?($reModi["two"]["f_tuig_commission"]):0); ?>" style="width: 70px;margin-left:7px;color:red;" disabled>
                                <span style="padding:0 7px;">+</span> <br><span style="margin-left: 100px;">平台运营费用</span><input type="text" id="piny_commission"  value="<?php echo ((isset($reModi["two"]["f_piny_commission"]) && ($reModi["two"]["f_piny_commission"] !== ""))?($reModi["two"]["f_piny_commission"]):0); ?>" style="width: 70px;margin-left:7px;color:red;" disabled>
                                合计：<input style="margin-left:7px;width: 80px;"  type="text" id="commission_txt" placeholder="每单任务总佣金"   oninput="a_comm1();"  value="<?php echo ((isset($reModi["two"]["f_unitpreownedgold"]) && ($reModi["two"]["f_unitpreownedgold"] !== ""))?($reModi["two"]["f_unitpreownedgold"]):0); ?>">
                                <p style="line-height:12px;margin-bottom: 12px;margin-top:20px;">您单个招商成功后的佣金是：（<span class="single_total_money"><?php echo ((isset($reModi["two"]["f_unitpreownedgold"]) && ($reModi["two"]["f_unitpreownedgold"] !== ""))?($reModi["two"]["f_unitpreownedgold"]):0); ?></span>） 元，计划招商：（<span class="all_area_name"><?php echo ((isset($zhao_total) && ($zhao_total !== ""))?($zhao_total):0); ?></span>）家，总目标佣金：（<span class="total_money_want"><?php echo ((isset($total_yong) && ($total_yong !== ""))?($total_yong):0); ?></span>）元<br/></p>
                                <p style="color: red;line-height: 12px;margin-bottom: 12px;">注：招商佣金计算公式：招商佣金=(40000+每单首批总款项)/2*25%；该金额为平台建议佣金，可自行根据实际情况进行更改。</p>
                                <p style="color: red;line-height: 12px;margin-bottom: 12px;">说明：成功完成一个招商的佣金，更高佣金奖励能够激励更多业务精英参与</p>
                            </div>


                            <input type="hidden" id="indexid" name="indexid" value="<?php echo ((isset($reModi["two"]["f_indexid"]) && ($reModi["two"]["f_indexid"] !== ""))?($reModi["two"]["f_indexid"]):0); ?>">
                            <button  class="business_taskAdd_button" id="task_two_to_one" style="margin-left:300px;margin-top:20px">上一步</button>
                            <button  class="business_taskAdd_button   business_taskAdd_button_next" id="task_two" style="margin-top:20px">下一步</button>
                        </div>



                        <!--任务详情-->
                        <div  id="business_taskAdd_step_contener3"  style="display: none">

                            <div class="line_input2">
                                <span style="display:inline-block;margin-top:10px">招商产品详情描述</span>
                                <span style="color: red;line-height: 20px;display: flex;margin-top: -35px;margin-left: 120px;" class="business_taskAdd_spanText">*1. 建议按照以下顺序制作详情资料（产品展示、产品卖点、产品广告、品牌故事）</span>
                                <span style="color: red;line-height: 20px;display: flex;margin-left: 120px;margin-bottom: 10px;" class="business_taskAdd_spanText">*2. 采用图片的形式展示效果更佳，插入图片宽度不超过720像素，不要手动缩小</span>
                            </div>

                            <div class="editor" style="min-height:400px;float:left;margin-left:10px">
                                <script type="text/plain" id="editor" style="width:800px;min-height:400px;" name="editor"></script>
                            </div>

                            <div class="line_input2" style="float:left;">
                                <span style="display:inline-block;margin-top:10px">招商政策详情描述：</span>
                                <span style="color: red;line-height: 20px;display: flex;margin-top: -35px;margin-left: 120px;" class="business_taskAdd_spanText">*1. 建议按照以下顺序制作详情资料（参与方式、招商要求、政策支持、产品价格）</span>
                                <span style="color: red;line-height: 20px;display: flex;margin-left: 120px;margin-bottom: 10px;" class="business_taskAdd_spanText">*2. 采用图片的形式展示效果更佳，插入图片宽度不超过720像素，不要手动缩小</span>
                            </div>

                            <div class="editor" style="min-height:400px;float:left;margin-left:10px">
                                <script type="text/plain" id="editor2" style="width:800px;min-height:400px;" name="editor2"></script>
                            </div>


                            <div class="line_input2" style="float:left;">
                                <span style="display:inline-block;margin-top:10px">招商企业介绍：</span>
                                <span style="color: red;line-height: 20px;display: flex;margin-top: -35px;margin-left: 120px;" class="business_taskAdd_spanText">*1. 建议按照以下顺序制作详情资料（参与方式、招商要求、政策支持、产品价格）</span>
                                <span style="color: red;line-height: 20px;display: flex;margin-left: 120px;margin-bottom: 10px;" class="business_taskAdd_spanText">*2. 采用图片的形式展示效果更佳，插入图片宽度不超过720像素，不要手动缩小</span>
                            </div>

                            <div class="editor" style="min-height:400px;float:left;margin-left:10px">
                                <script type="text/plain" id="editor3" style="width:800px;min-height:400px;" name="editor3"></script>
                            </div>


                            <input type="hidden" id="tindexid" name="tindexid" value="<?php echo ((isset($reModi["four"]["f_indexid"]) && ($reModi["four"]["f_indexid"] !== ""))?($reModi["four"]["f_indexid"]):0); ?>">
                            <button  class="business_taskAdd_button" id="task_four_to_three" style="margin-left:300px;">上一步</button>
                            <button  class="business_taskAdd_button   business_taskAdd_button_next" id="task_four" >下一步</button>

                        </div>



                        <!--上传附件-->
                        <div  id="business_taskAdd_step_contener4" style="display:none" >

                            <!--<div class="line_input1" style="margin-top:20px" >-->

                                <!--<span style="display: inline-block;float:left"> <span style="color: red;padding-right:5px;">*</span>任务logo</span><button  id="btn_up" onclick="$('#upfile').click()" class="business_taskAdd_button" style="margin-left:128px" >上传图片</button>-->

                                <!--<div style="display: none;">-->
                                    <!--<input type="file" id="upfile" name="upfile" accept="image/jpeg,image/gif,image/png">-->
                                <!--</div>-->
                                <!--<input type="hidden" id="fileid" name="fileid" value="<?php echo ($reModi["one"]["f_fileid"]); ?>">-->

                                   <!--<?php if ($reModi['one']['f_name']) {?>-->
                                <!--<div class="show_img" id='show_img'>-->
                                    <!--<div id="showPic">-->
                                        <!--<img src="/wisdom/Public/upfile/<?php  echo $reModi[one][f_name][f_filepath],$reModi[one][f_name][f_filename];?>" width="100" height="100">-->
                                        <!--<a class="show_phone" onclick='getimg(1)'>预览</a>-->
                                    <!--</div>-->
                                    <!--<?php }else{?>-->
                                    <!--<div class="show_img" id='show_img' style="display:none">-->
                                        <!--<?php }?>-->
                                    <!--</div>-->
                                    <!--<span style="display:inline-block" class="business_taskAdd_spanText">*为了保证手机端的显示效果，请使用长宽比例为1:1，大小不超过50k的jpg/png图片</span>-->
                                <!--</div>-->



                                <!--<div class="line_input1" style="margin-top:20px;position: relative;">-->

                                    <!--<span style="display: inline-block;float:left"> <span style="color: red;padding-right:5px;">*</span>banner广告</span><button  id="btn_ban" onclick="$('#upfile_ban').click()" class="business_taskAdd_button" style="left: 186px;position:absolute;top: 12px;" >上传图片</button>-->

                                    <!--<div style="display: none;">-->
                                        <!--<input type="file" id="upfile_ban" name="upfile" accept="image/jpeg,image/gif,image/png">-->
                                    <!--</div>-->
                                    <!--<input type="hidden" id="fileid_ban" name="fileid_ban"  value="<?php echo ($reModi["one"]["f_fileid_ban"]); ?>">-->

                                    <!--<?php if ($reModi['one']['f_ban']) {?>-->
                                    <!--<div class="show_img" id='show_img_ban' style="  width: 345px;float: left;left: -90px;  margin-bottom: 30px;">-->
                                        <!--<div id="showBan">-->
                                            <!--<img src="/wisdom/Public/upfile/<?php  echo $reModi[one][f_ban][f_filepath],$reModi[one][f_ban][f_filename];?>">-->
                                            <!--<a class="show_phone1" onclick='getimg(2)'>预览</a>-->
                                        <!--</div>-->
                                        <!--<?php }else{?>-->
                                        <!--<div class="show_img" id='show_img_ban' style="display:none;  width: 345px;float: left;left: -90px;  margin-bottom: 30px;">-->
                                            <!--<?php }?>-->
                                        <!--</div>-->
                                        <!--<span style="display:inline-block;position: absolute;left: 266px;" class="business_taskAdd_spanText">*为了保证手机端的显示效果，请使用长宽比例为3:1，大小不超过200k的jpg/png图片</span>-->

                                    <!--</div>-->


                                    <div class="line_input1 height" style="margin-top:20px">

                                <span style="display:inline-block;width:180px;"> <span style="color: red;padding-right:5px;">*</span>商标注册证或授权使用证书图片</span><button  id="btn_up_pack" onclick="$('#upfile_pack').click()" class="business_taskAdd_button" style="margin-left:7px" >上传文件</button><span class="business_taskAdd_spanText">必须提供  格式:rar,英文名</span>

                                <div style="display: none;">
                                    <input type="file" id="upfile_pack" name="upfile" accept=".rar"/>
                                </div>

                                <input type="hidden" id="fileid_pack" name="fileid_pack" value="<?php echo ($reModi["five"]["f_fileid1"]); ?>">
                                <div  id="show_progress_no_pack" style="float: right;"></div>
                                <div class="progress_up" id="progress_up_pack" style="float: right;width:200px;margin-top:0px">
                                    <div class="bar" id="bar_pack" <?php if($task_f1 != null): ?>style="display: block;width: 100%;"<?php endif; ?> ></div>
                            </div>
                            <!--<div class="show_img" id="show_img_pack"></div>-->

                         </div>





                            <!--<div class="line_input" id="line_input_three" style="margin-top: -90px;" >-->
                            <!--<div class="show_progress_no" id="show_progress_no_pack"></div>-->
                            <!--<div class="progress_up" id="progress_up_pack"><div class="bar" id="bar_pack"></div></div>-->
                            <!--&lt;!&ndash;<div class="show_img" id="show_img_pack"></div>&ndash;&gt;-->
                            <!--</div>-->


                            <div class="line_input1 height">

                                <span style="display:inline-block;width: 168px;"> <span style="color: red;padding-right:5px;">*</span>经销商合同</span><button  id="btn_up_propaganda" onclick="$('#upfile_propaganda').click()" class="business_taskAdd_button" style="margin-left:19px" >上传文件</button><span class="business_taskAdd_spanText">必须提供 格式：doc,docx,pdf,英文名</span>

                                <div style="display: none;">
                                    <input type="file" id="upfile_propaganda" name="upfile" accept=".doc,.docx,.pdf">
                                </div>
                                <input type="hidden" id="fileid_propaganda" name="fileid_propaganda" value="<?php echo ($reModi["five"]["f_fileld2"]); ?>">
                                <div  id="show_progress_no_propaganda" style="float: right;"></div>
                                <div class="progress_up" id="progress_up_propaganda" style="float: right;width:200px;margin-top:0px">
                                    <div class="bar" id='bar_propaganda'  <?php if($task_f2 != null): ?>style="display: block;width: 100%;"<?php endif; ?>  ></div>
                            </div>

                            </div>

                            <!--<div class="line_input" id="line_input_four" style="margin-top: -90px;">-->
                            <!--<div class="show_progress_no" id="show_progress_no_propaganda"></div>-->
                            <!--<div class="progress_up" id="progress_up_propaganda"><div class="bar" id='bar_propaganda'></div></div>-->
                            <!--&lt;!&ndash;<div class="show_img" id='show_img_propaganda'></div>&ndash;&gt;-->
                            <!--</div>-->


                            <div class="line_input1 height">

                                <span style="display:inline-block;width: 168px;"> <span style="color: red;padding-right:5px;">*</span>产品和宣传资料图片</span><button  id="btn_up_certificate" onclick="$('#upfile_certificate').click()" class="business_taskAdd_button" style="margin-left:19px" >上传文件</button><span class="business_taskAdd_spanText">必须提供 格式：rar,英文名</span>

                                <div style="display: none;">
                                    <input type="file" id="upfile_certificate" name="upfile" accept=".rar">
                                </div>
                                <input type="hidden" id="fileid_certificate" name="fileid_certificate" value="<?php echo ($reModi["five"]["f_fileid3"]); ?>">
                                <div id="show_progress_no_certificate" style="float: right;"></div>
                                <div class="progress_up" id="progress_up_certificate" style="float: right;width:200px;margin-top:0px">
                                    <div class="bar" id='bar_certificate'   <?php if($task_f3 != null): ?>style="display: block;width: 100%;"<?php endif; ?>  ></div>
                            </div>
                         </div>
                            <!--<div class="line_input"  id="line_input_five" style="margin-top: -90px;">-->
                            <!--<div class="show_progress_no" id="show_progress_no_certificate">0%</div>-->
                            <!--<div class="progress_up" id="progress_up_certificate"><div class="bar" id='bar_certificate'></div></div>-->
                            <!--&lt;!&ndash;<div class="show_img" id='show_img_certificate'></div>&ndash;&gt;-->
                            <!--</div>-->



                            <div class="line_input1 height">

                                <span style="display:inline-block;width: 168px;"> <span style="color: red;padding-right:5px;">*</span>产品价格表</span><button  id="btn_up_policy" onclick="$('#upfile_policy').click()" class="business_taskAdd_button" style="margin-left:19px" >上传文件</button><span class="business_taskAdd_spanText">必须提供(含出厂价、批发价、零售价)  格式：doc,docx,pdf,xls,xlsx,英文名</span>

                                <div style="display: none;">
                                    <input type="file" id="upfile_policy" name="upfile" accept=".doc,.docx,.xls,.xlsx,.pdf">
                                </div>
                                <input type="hidden" id="fileid_policy" name="fileid_policy" value="<?php echo ($reModi["five"]["f_fileid4"]); ?>">
                                <div id="show_progress_no_policy" style="float: right;"></div>
                                <div class="progress_up" id="progress_up_policy" style="float: right;width:200px;margin-top:0px">
                                    <div class="bar" id='bar_policy'   <?php if($task_f4 != null): ?>style="display: block;width: 100%;"<?php endif; ?>  ></div>
                            </div>

                          </div>
                            <!-- -->
                            <!--<div class="line_input" id="line_input_six" style="margin-top: -90px;">-->
                            <!--<div class="show_progress_no" id="show_progress_no_policy" >0%</div>-->
                            <!--<div class="progress_up" id="progress_up_policy"><div class="bar" id='bar_policy'></div></div>-->
                            <!--&lt;!&ndash;<div class="show_img" id='show_img_policy'></div>&ndash;&gt;-->
                            <!--</div>-->



                            <div class="line_input1 height">

                                <span style="display:inline-block;width: 168px;"><span style="color: red;padding-right:5px;">*</span>销售市场支持政策</span><button  id="btn_up_price" onclick="$('#upfile_price').click()" class="business_taskAdd_button" style="margin-left:19px" >上传文件</button><span class="business_taskAdd_spanText">必须提供 格式：doc,docx,pdf,xls,xlsx,英文名</span>

                                <div style="display: none;">
                                    <input type="file" id="upfile_price" name="upfile" accept=".doc,.docx,.xls,.xlsx,.pdf">
                                </div>
                                <input type="hidden" id="fileid_price" name="fileid_price" value="<?php echo ($reModi["five"]["f_fileid5"]); ?>">
                                <div  id="show_progress_no_price" style="float: right;"></div>
                                <div class="progress_up" id="progress_up_price" style="float: right;width:200px;margin-top:0px">
                                    <div class="bar" id='bar_price'   <?php if($task_f5 != null): ?>style="display: block;width: 100%;"<?php endif; ?>  ></div>
                            </div>
                               </div>


                            <!--<div class="line_input"  id="line_input_seven" style="margin-top: -100px;">-->
                            <!--<div class="show_progress_no" id="show_progress_no_price">0%</div>-->
                            <!--<div class="progress_up" id="progress_up_price"><div class="bar" id='bar_price'></div></div>-->
                            <!--&lt;!&ndash;<div class="show_img" id='show_img_price'></div>&ndash;&gt;-->
                           <!--</div>-->
                                <div class="line_input1 height">

                                    <span style="display:inline-block;width: 168px;"><span style="color: red;padding-right:5px;">*</span>智慧招商服务合同结清算协议</span><button  id="btn_up_price2" onclick="$('#upfile_price2').click()" class="business_taskAdd_button" style="margin-left:19px" >上传文件</button><span class="business_taskAdd_spanText">必须提供 格式：doc,docx,pdf英文名</span>

                                    <div style="display: none;">
                                        <input type="file" id="upfile_price2" name="upfile" accept=".doc,.docx,.rar,.pdf">
                                    </div>
                                    <input type="hidden" id="fileid_price2" name="fileid_price" value="<?php echo ($reModi["five"]["f_fileid8"]); ?>">
                                    <div  id="show_progress_no_price2" style="float: right;"></div>
                                    <div class="progress_up" id="progress_up_price2" style="float: right;width:200px;margin-top:0px">
                                        <div class="bar" id='bar_price2'   <?php if($task_f8 != null): ?>style="display: block;width: 100%;"<?php endif; ?>  ></div>
                                </div>
                             </div>

                                <!--<div class="line_input"  id="line_input_seven2" style="margin-top: -100px;">-->
                                <!--<div class="show_progress_no" id="show_progress_no_price2">0%</div>-->
                                <!--<div class="progress_up" id="progress_up_price2"><div class="bar" id='bar_price2'></div></div>-->
                                <!--&lt;!&ndash;<div class="show_img" id='show_img_price2'></div>&ndash;&gt;-->
                                <!--</div>-->


                            <div class="line_input1 height" >

                                <span style="display:inline-block;width: 168px;padding-left:10px;">标志LOGO设计图</span><button  id="btn_up_other" onclick="$('#upfile_other').click()" class="business_taskAdd_button" style="margin-left:9px" >上传文件</button><span class="business_taskAdd_spanText">建议提供  格式：ai,cdr,英文名</span>

                                <div style="display: none;">
                                    <input type="file" id="upfile_other" name="upfile" accept=".ai,.cdr">
                                </div>
                                <input type="hidden" id="fileid_other" name="fileid_other" value="<?php echo ($reModi["five"]["f_fileid6"]); ?>">
                                <div  id="show_progress_no_other" style="float: right;"></div>
                                <div class="progress_up" id="progress_up_other"  style="float: right;width:200px;margin-top:0px">
                                    <div class="bar" id='bar_other'   <?php if($task_f6 != null): ?>style="display: block;width: 100%;"<?php endif; ?> ></div>
                            </div>

                                </div>
                            <div class="line_input1 height" >

                                <span style="display:inline-block;width: 168px;padding-left:10px;">行业许可证图片</span><button  id="btn_up_other12" onclick="$('#upfile_other12').click()" class="business_taskAdd_button" style="margin-left:9px" >上传文件</button><span class="business_taskAdd_spanText">建议提供 格式：gif,jpg,png,英文名  <span  style="color:red">**若为特殊行业，请上传特殊行业的许可证</span></span>

                                <div style="display: none;">
                                    <input type="file" id="upfile_other12" name="upfile" accept="image/jpg,image/gif,image/png">
                                </div>
                                <input type="hidden" id="fileid_other12" name="fileid_other" value="<?php echo ($reModi["five"]["f_fileid7"]); ?>">
                                <div  id="show_progress_no_other12" style="float: right;"></div>
                                <div class="progress_up" id="progress_up_other12"  style="float: right;width:200px;margin-top:0px">
                                    <div class="bar" id='bar_other12'  <?php if($task_f7 != null): ?>style="display: block;width: 100%;"<?php endif; ?> ></div>
                            </div>

                            </div>

                            <input type="hidden" id="findexid" name="findexid" value="<?php echo ((isset($reModi["five"]["f_indexid"]) && ($reModi["five"]["f_indexid"] !== ""))?($reModi["five"]["f_indexid"]):0); ?>">
                            <div style="clear: both;"></div>
                            <br/>
                            <button  class="business_taskAdd_button" id="task_five_to_four" style="margin-left:300px;">上一步</button>
                            <button  class="business_taskAdd_button   business_taskAdd_button_next" id="task_five" >下一步</button>
                        </div>

                        <!--诚信保证金-->
                        <div id="business_taskAdd_step_contener5"  style="display:none">
                            <div  class="faith_guarantee">
                                 <div class="faith_guarantee_content">
                                     <h2 style="text-align:center">货款第三方监管交易提醒</h2>
                                     <div style="line-height:25px;padding:10px;font-size:14px;">
                                         <p style="padding-left:25px;">为保证经销商利益，保证货款安全和业务的成果收益，在与招商企业协商一致下，小宝招商为合作双方设立银行第三方监管交易账户，该监管</p>
                                         <p>账户，该监管账户是经销商与招商企业之间往来货款临时存储并由银行监管资金流向的专门账户，所有货款经经销商及业务员收货并验收无误确定后, 方能打入招商企业账户。未通过第三方监管账户交易的行为，小宝招商平台对货款安全不负任何责任。 </p>
                                          <p></p>
                                     </div>
                                     <div  style="line-height:35px;padding-left:10px;font-size:14px;">
                                       <p>第三方监管账户信息如下：</p>
                                       <p>开户行：温州银行杭州城北小微企业专营支行</p>
                                       <p>账号：903070120190000063</p>
                                       <p>户名：杭州日思夜享数据科技有限公司</p>
                                    </div>

                                 </div>
                            </div>
                            <?php echo $supervisonUser;?>
                            <div class="tips" style="background-color: #fff;text-align: left;line-height:25px;">
                                1、是否使用诚信金、货款进入监管账户 <input type="radio"  value="1" name="jianguan"  <?php if($supervisionUser == 1): ?>checked<?php endif; ?>>是 <input type="radio"  style="padding-left:20px;" value="0" name="jianguan"  <?php if($supervisionUser == 0): ?>checked<?php endif; ?>>否<br/>
                                2、您需要交纳的总诚信金为： <input type="text" name="bao_money" style="width: 80px;" value="<?php echo ((isset($credit) && ($credit !== ""))?($credit):0); ?>"> 元（交3万以上可以进入优先发布并带有信用标记，获得更多营销人员和客户的信任）<br/>
                                3、提交后，请及时交纳诚信金，经小宝客服审核通过，即进入公开发布。<br/>
                                <span style="color:red;">注：黄金客户不低于3万，钻石客户不低于10万，其余均为普通客户，诚信金越高，越优先发布，排列靠前，获得客户更多关注和信任。</span>
                            </div>
                            <div style="padding-top:80px;clear: both;">
                                <button  class="business_taskAdd_button" id="task_six_to_five" style="width:90px;margin-left:300px">上一步</button>
                                <button  class="business_taskAdd_button   business_taskAdd_button_next" id="task_six_save" action="<?php echo ($task_action); ?>" >保存</button>
                                <button  class="business_taskAdd_button   business_taskAdd_button_next" id="task_six" qiyePower='<?php if(in_array("e1",$access_array)){ echo 1; }else{ echo 0; } ?>' qiye="<?php echo ($qiye); ?>" action="<?php echo ($task_action); ?>" >提交</button>
                            </div>

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

 
 
 
    <script type="text/javascript">
        //实例化编译器
//        var ue=UM.getEditor('editor',{
//            toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
//            UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
//            autoClearinitialContent: true,
//            elementPathEnabled: false,
//            autoFloatEnabled: false,
//            // textarea: 'content'
//        });
        //通过getContent和setContent方法可以设置和读取编译器的内容
        //读取配置
        // var lang=ue.getOpt('lang');默认返回：zh-cn


//        var ue=UM.getEditor('editor2',{
//            toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
//            UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
//            autoClearinitialContent: true,
//            elementPathEnabled: false,
//            autoFloatEnabled: false,
//            // textarea: 'content'
//        });
        //加载三级联动

        _init_area();
        getArea(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);
        getPro(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);
        //         console.log($('#taskid').val()+"===========");
    </script>
    <script>
        function  whprovidertrial(num){
             if(num==1){
                 $("#whpaid").show();
                 $("#trialnum").removeAttr("disabled");
             }else{
                 $("#trialnum").attr("disabled","true");
                 $("#whpaid").hide();
             }
             $("#trialnum").val(0);
             $("#trialprice").val(0);
        }

        function  whpaid(num){
            if(num==0){
                $("#trialprice").attr("disabled","true");
            }else{
                $("#trialprice").removeAttr("disabled");
            }
            $("#trialprice").val(0);
        }

        $(function(){

//            //总目标佣金
//            var sale_money = parseInt($(".single_total_money").text());
//            //区域总数
//            var area_totoal_num =parseInt($(".all_area_name").html());
//            //总目标佣金
//            var total_area_money = sale_money*area_totoal_num;
//            console.log(sale_money+"=="+area_totoal_num+"=="+total_area_money);
//            console.log($(".all_area_name").html());
//            console.log($(".all_area_name").text());
//            $(".total_money_want").text(total_area_money);

            // getBigTrade();
            //上传图片
            $("#upfile").wrap("<form id='uplogo' action='<?php echo U('Api/Upfile/upF/type/2/size/51256/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_ban").wrap("<form id='uplogo_ban' action='<?php echo U('Api/Upfile/upF/type/2/size/204900/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_pack").wrap("<form id='upfile_up' action='<?php echo U('Api/Upfile/upF/type/2/exts/rar');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_propaganda").wrap("<form id='upfile_up_propaganda' action='<?php echo U('Api/Upfile/upF/type/2/exts/doc,docx');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_certificate").wrap("<form id='upfile_up_certificate' action='<?php echo U('Api/Upfile/upF/type/2/exts/rar');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_policy").wrap("<form id='upfile_up_policy' action='<?php echo U('Api/Upfile/upF/type/2/exts/doc,docx,xls,xlsx,pdf');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_price").wrap("<form id='upfile_up_price' action='<?php echo U('Api/Upfile/upF/type/2/exts/doc,docx,xls,xlsx,pdf');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_price2").wrap("<form id='upfile_up_price2' action='<?php echo U('Api/Upfile/upF/type/2/exts/doc,docx,rar,pdf');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_other").wrap("<form id='upfile_up_other' action='<?php echo U('Api/Upfile/upF/type/2/exts/ai,cdr');?>' method='post' enctype='multipart/form-data'></form>");
            $("#upfile_other12").wrap("<form id='upfile_up_other12' action='<?php echo U('Api/Upfile/upF/type/2/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
            //公司自动补全
//             $("#companyName").bigAutocomplete({width:200,
//                 url:"<?php echo U('Taskadmin/Fun/searchCname');?>",
//                 callback:function(data){
//                    $('#companyId1').val(data.result);
//                }
//            });

            var start = {
                elem: '#startdate',
                format: 'YYYY-MM-DD',
                min: laydate.now(), //设定最小日期为当前日期
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
                min: laydate.now(),
                max: laydate.now(+180),
                //istime: true,
                istoday: false,
                choose: function(datas){
                    start.max = datas; //结束日选好后，重置开始日的最大日期
                }
            };
            laydate(start);
            laydate(end);

            //标题路径改变
            if($('#taskid').val()==="0"&&$('#indexid').val()==="0"&&$('#tindexid').val()==="0"&&$('#findexid').val()==="0"){
                $('#business_task_title_top').append("<span>首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务&nbsp>&nbsp 新增</span>");
                UM.getEditor('editor').setContent('<html><body>'+
                        ' <ol  style="font-family: Arial, Helvetica, sans-serif, 微软雅黑, 宋体;font-size: 12px;color: red;line-height: 20px;;">'+
                        ' <li>1.产品展示'+
                        '<ul style="margin-left: 15px;"><li>1.1产品信息</li>'+
                        '<li>1.2产品包装</li>'+
                        '<li>1.3产品定位</li> '+
                        '<li>1.4目标用户群体</li></ul>'+
                        '</li>'+
                        '<li>2.产品卖点'+
                        '<ul style="margin-left: 15px;"><li>2.1产品优势</li></ul>' +
                        '</li>'+
                        '<li>3.产品广告'+
                        '<ul style="margin-left: 15px;"><li>3.1产品宣传语</li></ul>'+
                        '</li>'+
                        '<li>4.品牌故事'+
                        '<ul style="margin-left: 15px;"><li>4.1公司介绍/品牌介绍</li></ul>'+
                        '</li>'+
                        '</ol>'+
                        '</body></html>',true);
                UM.getEditor('editor2').setContent('<html><body>'+
                        ' <ol  style="font-family: Arial, Helvetica, sans-serif, 微软雅黑, 宋体;font-size: 12px;color: red;line-height: 20px;;">'+
                        ' <li>1.参与方式'+
                        '<ul style="margin-left: 15px;"><li>1.1通过微信或QQ分享给6个朋友，可以获得更多佣金</li></ul>'+
                        '</li>'+
                        '<li>2.招商要求'+
                        '<ul style="margin-left: 15px;"><li>2.1招商说明</li><li>2.2招商区域及数量</li></ul>' +
                        '</li>'+
                        '<li>3.政策支持'+
                        '<ul style="margin-left: 15px;"><li>3.1渠道政策</li><li>3.2广宣政策</li></ul>'+
                        '</li>'+
                        '<li>4.产品价格'+
                        '</li>'+
                        '</ol>'+
                        '</body></html>',true);
                UM.getEditor('editor3').setContent('<html><body>'+
                        ' <ol  style="font-family: Arial, Helvetica, sans-serif, 微软雅黑, 宋体;font-size: 12px;color: red;line-height: 20px;;">'+
                        ' <li>1.企业简介'+
                        '</li>'+
                        '<li>2.企业文化'+
                        '</li>'+
                        '<li>3.企业服务'+
                        '</li>'+
                        '</ol>'+
                        '</body></html>',true);
            }else{
                $('#business_task_title_top').append("<span>首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务&nbsp>&nbsp 编辑</span>");
                UM.getEditor('editor').setContent('<?php echo ($reModi["four"]["f_note"]); ?>',true);
                UM.getEditor('editor2').setContent('<?php echo ($reModi["four"]["f_product"]); ?>',true);
                UM.getEditor('editor3').setContent('<?php echo ($reModi["four"]["f_company_note"]); ?>',true);
            }
        });



    </script>


    </body>
    </html>