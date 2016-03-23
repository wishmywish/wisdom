<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧推广::任务管理</title>
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
    <div id="rev_menu_left" class="class_menu_left">
        <ul id="bigmenu">
            <li id="1" class="org_box  org_box_select"><span class="org_bot_cor"></span>随手赚</li>
            <!--<div id="draggle">-->
                <!--<p>题目类型</p>-->
                <!--<span id="singe_drag"><i class="fa fa-dot-circle-o fa-fw"></i> 单选题</span>-->
                <!--<span id="double_drag"><i class="fa fa-check-square-o fa-fw"></i> 多选题</span>-->
                <!--<span id="pic_drag"><i class="fa fa-file-text-o fa-fw"></i> 文本题</span>-->
                <!--<span id="text_drag"><i class="fa fa-picture-o fa-fw"></i> 图片题</span>-->
            <!--</div>-->
        </ul>
    </div>
    <input type="hidden" id="typetaskid" value="<?php echo ((isset($reModi["one"]["f_tasktypeid"]) && ($reModi["one"]["f_tasktypeid"] !== ""))?($reModi["one"]["f_tasktypeid"]):0); ?>"/>
    <input type="hidden" id="index_proid" value="<?php echo ((isset($reModi["pro"]["f_indexid"]) && ($reModi["pro"]["f_indexid"] !== ""))?($reModi["pro"]["f_indexid"]):0); ?>"/>
    <input type="hidden" id="index_conid" value="<?php echo ((isset($reModi["detail"]["f_indexid"]) && ($reModi["detail"]["f_indexid"] !== ""))?($reModi["detail"]["f_indexid"]):0); ?>"/>
    <div class="index_right_bus">
        <!--随手赚-->

        <div id="nav1">
            <span > 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务&nbsp>&nbsp新增&nbsp>&nbsp 随手赚&nbsp>&nbsp问答</span>
        </div>
        <div id="a1" style="display: block">
            <div  class='taskAdd_conter' style="margin-top:25px">
    <form  action='' method="post"  id='taskAddForm_make'>
        <div class="taskAdd_conventionData">
            <div class="taskAdd_title">
                <span class="taskAdd_title_name">任务详情</span>
            </div>
            <div class="taskAdd_conventDataList" style="min-height:500px;float: left;width: 50%;">
                <ul>
                    <li class="taskAdd_conventionDataLi"  style="margin-left:15px;">任务图标</li>
                    <li style="margin:0px 10px;">
                        <input style="margin-left:-10px;"  id="openImgBtn1"  name="openImgBtn1"  type="button"   value="上传图片"  class="pass-portrait-fileBtn" onclick="$('#profileImg').click()"/>
                    <li style="display: none;"><input  id="profileImg" class="pass-portrait-file"  type="file"  name="upfile"   accept="image/jpeg,image/gif,image/png"/></li>
                    <input type="hidden" id="profile1" name="profile1" value="<?php echo ($reModi["one"]["f_fileid"]); ?>"/>
                    </li>

                    <li>
                        <div class="line_input_pro"  id="line_input_pro" <?php if($reModi['one']['f_name'] != '' ): ?>style="display:block;"<?php endif; ?>>
                        <div class="show_img1" id='show_proimg1'>
                            <?php if ($reModi['one']['f_name']) {?>
                            <!--  {$reModi['one']['f_name']['f_filepath']}<?php echo ($reModi["one"]["f_name"]["f_filename"]); ?> -->
                            <div id="showPi1">
                                <img src="/wisdom/Public/upfile/<?php  echo $reModi[one][f_name][f_filepath],$reModi[one][f_name][f_filename];?>" width="100" height="100">
                            </div>
                            <?php }?>
                        </div>

            </li><br>
            <span class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 70px;color: #F47469;">*必须填，建议上传正方形图片，否则展示会变形</span>
            <!--<div class="show_progress_no" id='show_progress_no_pro'></div>-->
            <!--<div class="progress_up" id='progress_up_pro'><div class="bar" id='pro_bar'></div></div> -->
            </ul>

            <ul class="taskAdd_conventionDataUl" style="margin-left: 0;">
                <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务标题</li>
                <li>
                    <input type="text" id="taskTitle"  name="taskTitle"  value="<?php echo ($reModi["one"]["f_title"]); ?>" class="taskAdd_conventionDataInput" style="width: 332px;" placeholder="请输入任务标题">
                    <br>  <p style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*必须填，不能超过20个字符</p>
                </li>
            </ul>
            <ul class="taskAdd_conventionDataUl" style="margin-left: 0">
                <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务描述</li>
                <li>
                    <textarea  value="" name="pro_taskDescription"  id="pro_taskDescription" style="width:340px;height:100px;"></textarea>
                    <br>  <p style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*必须填，任务被分享到微信平台时的子标题，不要超过40个字符</p>

                </li>
            </ul>
            <ul class="taskAdd_conventionDataUl" style="margin-left: 0">
                <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务时间</li>
                <li><input id="startTime"  name="startTime"  value="<?php echo ($reModi["one"]["f_begindate"]); ?>" class="taskAdd_conventionDataInput laydate-icon"  style="width:125px;" placeholder="起始时间"/>
                    <span style="padding:0px 7px">至</span>
                    <input  id="endTime"  name="endTime" placeholder="终止时间"  value="<?php echo ($reModi["one"]["f_enddate"]); ?>" class="taskAdd_conventionDataInput  laydate-icon" style="width:125px;"/>
                    <br><span  class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*必须填，最长不超过180天</span></li>
            </ul>
            <ul class="taskAdd_conventionDataUl" style="margin-left: 0">
                <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务联系</li>
                <li><input type="text" id="pro_linkman"  name="pro_linkman"  value="<?php echo ($reModi["one"]["f_linkman"]); ?>" class="taskAdd_conventionDataInput"   placeholder="企业联系人姓名" style="width: 333px;">
                    <br><span  class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*必须填</span>
                </li>
            </ul>

            <ul class="taskAdd_conventionDataUl" style="margin-left: 0;">
                <li class="taskAdd_conventionDataLi" style="margin-left:15px">联系电话</li>
                <li><input type="text" id="pro_linkphone"  name="pro_linkphone"  value="<?php echo ((isset($reModi["one"]["f_linkphone"]) && ($reModi["one"]["f_linkphone"] !== ""))?($reModi["one"]["f_linkphone"]):$mobile); ?>" class="taskAdd_conventionDataInput" style="width: 333px;"  placeholder="企业联系人电话" >
                    <br><span  class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*必须填</span>
                </li>
            </ul>

            <ul class="taskAdd_conventionDataUl" style="margin-left: 0;">
                <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务总数</li>
                <li><input type="text" id="pro_taskBrand"  name="pro_taskBrand" value="<?php echo ($reModi["pro"]["f_totalcopies"]); ?>"  class="taskAdd_conventionDataInput" style="width: 333px;" oninput="calcu();">
                    <br><span  class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*必须填，一共有多少任务发放给用户</span></li>
            </ul>

            <ul class="taskAdd_conventionDataUl" style="margin-left: 15px;">
                <li class="taskAdd_conventionDataLi" style="width: 50px;">单次奖励金币</li>
                <li><input type="text" id="pro_taskProduct"  name="pro_taskProduct" value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>"  class="taskAdd_conventionDataInput" style="width: 333px;" oninput="calcu();">
                    <br><span  class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*必须填，单用户完成一次任务所得奖励，10金币=1元，单位：元</span></li>
            </ul>
            <ul class="taskAdd_conventionDataUl" style="margin-left:18px">
                <li class="taskAdd_conventionDataLi">平台佣金</li>
                <li><input type="text" id="pro_saleCommission"  name="pro_saleCommission" value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>"  class="taskAdd_conventionDataInput" style= "width: 333px;"  disabled="true">
                    <br><span  class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*自动计算，小宝招商平台获得总佣金，单位：元</span></li>
            </ul>

            <ul class="taskAdd_conventionDataUl" style="margin-left:17px">
                <li class="taskAdd_conventionDataLi" style="width: 50px;">平台总佣金</li>
                <li><input type="text" id="pro_totalFee"  name="pro_totalFee" value=""  class="taskAdd_conventionDataInput"  disabled="true" style="  width: 333px;" >
                    <br><span  class="business_taskAdd_spanText" style="display:inline-block;margin: 5px 0 0 0;color: #F47469;">*自动计算，完成任务的用户获得的总佣金，单位：元</span></li>
            </ul>

            <!--<ul class="taskAdd_conventionDataUl">
                <li class="taskAdd_conventionDataLi" style="margin-left:15px">热门标签</li>
                <li><input type="text" id="pro_industry"  name="pro_industry"  value="" class="taskAdd_conventionDataInput"><span  class="business_taskAdd_spanText">*多个标签可用“，”隔开</span></li>
            </ul>-->

            <ul style="margin-left: 20px;">
                <li>任务正文</li>
                <li>
                    <div class="editor" style="min-height:400px;width:100%;float:left;">
                        <script type="text/plain" id="editor" style="width:340px;min-height:300px;" name="editor"></script>
                    </div>
                </li>
            </ul>
                </div>
            <div class="mobileView">
                <div class="mobileViewbg">
                    <div class="mobileViewcn">
                        <div class="stime">2016-03-06</div>
                        <p class="tasktitle">业务人员的基本工作情况调研</p>
                        <div class="imgView">
                            <img src="" alt="">
                        </div>
                        <p class="taskkind">调研</p>
                    </div>
                </div>
                <div class="mobileViewbg">
                    <div class="mobileViewcn">

                    </div>
                </div>
            </div>
            <input type="hidden" id="companyID" value="<?php echo ($companyID); ?>">
            <input type="hidden" id="taskid" value="<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>">
            <div class="next_btn">
                <span  onclick="widely_next()">下一步</span>
            </div>
        </div>
    </form>
</div>
<style>
    .mobileView .mobileViewbg{
        width:370px;
        height:610px;
        background: url("/wisdom/Public/Home/Default/images/phone.png") 60px 10px/310px 600px padding-box no-repeat;
        z-index:1000;
        position: relative;
    }
    .mobileView .mobileViewbg .mobileViewcn{
        width:370px;
        height:610px;
        background: url("/wisdom/Public/Home/Default/images/phone-cn.png") 80px 87px/270px 445px padding-box no-repeat;
        z-index:1000;
        position: relative;
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
        </div>
 
        <div id="a2" style="display: none">
            <!--调研类与答题类模板-->
            <div  class="taskAdd_template_questionList" id="quest"  style="display:none">
                <?php if ($reModi['detail']) { ?>
                <?php if(is_array($reModi["detail"])): $k = 0; $__LIST__ = $reModi["detail"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="taskAdd_template_questionList1" style="margin: 20px 0px auto;min-height: 500px;" id='question_list_<?php echo ($k-1); ?>'>
                        <div class="taskAdd_template_question" id='quest_<?php echo ($k-1); ?>'>
                            问：<input type="text" name='conventionDataInput'  class="taskAdd_conventionDataInput" style="width:500px" value="<?php echo ($vo["f_problemtatile"]); ?>"/>
                            <?php if(($k-1) == "0"): ?><button type="button" class="taskAdd_btn" value="" onclick="addQuestion(<?php echo ($reModi["detailCount"]); ?>)">+</button><?php endif; ?>
                            <?php if(($k-1) != "0"): ?><span style="color:#14bce1;cursor:pointer;margin-left:20px;" onclick="taskAdd_template_questionList_delete(<?php echo ($k-1); ?>,<?php echo ($vo["f_stdindex"]); ?>)">删除</span><?php endif; ?>
                        </div>
                        <div  class="taskAdd_template_answer">
                            答：<select class="template_answer_selected" name="template_answer" id="template_answer_selected_<?php echo ($k-1); ?>"  onchange="changeoption(this.value,<?php echo ($k-1); ?>)">
                            <option  value="0" <?php if(($vo["f_type"]) == "0"): ?>selected<?php endif; ?>>请选择</option>
                            <option  value="1" <?php if(($vo["f_type"]) == "1"): ?>selected<?php endif; ?>>单选</option>
                            <option  value="2" <?php if(($vo["f_type"]) == "2"): ?>selected<?php endif; ?>>多选</option>
                            <option  value="3" <?php if(($vo["f_type"]) == "3"): ?>selected<?php endif; ?>>文本</option>
                            <option  value="4" <?php if(($vo["f_type"]) == "4"): ?>selected<?php endif; ?>>图片</option>
                        </select>
                            <?php if ($vo['f_type']==1 || $vo['f_type']==2) {?>
                            <?php if(is_array($vo["answer"])): $m = 0; $__LIST__ = $vo["answer"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($m % 2 );++$m;?><input type="text" class="taskAdd_conventionDataInput  taskAdd_template_answerInput" value="<?php echo ($answer); ?>">
                                <input type="checkbox" style="display:inline-block;margin-left:7px;"  name="answer" value="<?php echo ($m-1); ?>" class="answer_<?php echo ($m-1); ?>_<?php echo ($k-1); ?>"
                                <?php  if (in_array(($m-1),explode(",",$vo['f_trueanswer']))&&$vo['f_trueanswer']!=""){echo "checked";} ?>/>
                                <?php if(($key) != "0"): ?><input type="button" class="taskAdd_answer_input" onclick="delte_input(<?php echo ($k-1); ?>,<?php echo ($m-1); ?>)" id="delte_input_<?php echo ($k-1); echo ($m-1); ?>" value="删除"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            <button type="button" class="taskAdd_btn question_btn_add" id="template_question_btn<?php echo ($k-1); ?>" value="<?php echo ($k-1); ?>" onclick="addAnswer(<?php echo ($k-1); ?>,<?php echo ($m-1); ?>)">+</button>
                            <?php }?>
                        </div>
                        <input type="hidden" id="f_stdindex<?php echo ($k-1); ?>" name="f_stdindex" value="<?php echo ($vo["f_stdindex"]); ?>">
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php }else{ ?>
                <div class="taskAdd_template_questionList1" id='question_list_0'>
                    <div class="taskAdd_template_question" style="margin-left: -3px;">
                        问：<input type="text" name='conventionDataInput'  class="taskAdd_conventionDataInput" style="width:500px"/>
                        <button type="button" class="taskAdd_btn" id="template_question_btn" value="">+</button>
                    </div>
                    <div  class="taskAdd_template_answer">
                        答：<select class="template_answer_selected" name="template_answer" id="template_answer_selected_0"  onchange="changeoption(this.value,0)">
                        <option  value="0">请选择</option>
                        <option  value="1">单选</option>
                        <option  value="2">多选</option>
                        <option  value="3">文本</option>
                        <option  value="4">图片</option>
                    </select>
                    </div>
                </div>
                <?php }?>
            </div>
           <div class="next_btn">
               <span  onclick="widely_pre()" style="margin-right: 25px;">上一步</span>
               <span  onclick="pro_submit()">申请上线</span>
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

    $("#tasktypeid").empty();
    $("#tasktypeid").append("<option value='0'>选择任务类型</option><option value='4'>调研类</option><option value='5'>推荐类</option><option value='6'>答题类</option>");
    getTasktype();
    // Cookie.createCookie("now_taskid",<?php echo ($taskid); ?>);
    //  console.log($reModi.detail);
    //alert(a);
    //实例化编译器
    var ue=UM.getEditor('editor',{
        toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
        UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
        autoClearinitialContent: true,
        elementPathEnabled: false,
        autoFloatEnabled: false,
        // textarea: 'content'
    });
    //通过getContent和setContent方法可以设置和读取编译器的内容
    //读取配置
    // var lang=ue.getOpt('lang');默认返回：zh-cn

    //加载三级联动
    //
    //     _init_area();
    //     getArea(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);
    //     getPro(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);

    UM.getEditor('editor').setContent('<?php echo ($reModi["pro"]["f_taskrequirements"]); ?>',true);
</script>

<script type="text/javascript">


    //点击下一步
    function  widely_next(){
        $("#a1").hide();

        $("#a2").show();
        $("#quest").show();
    }

    function  widely_pre(){
//        $("#draggle").hide();
        $("#a1").show();
        $("#a2").hide();
    }

</script>
<script>

    $("#pro_taskDescription").text("<?php echo ($reModi["one"]["f_description"]); ?>");
    $("#taskDescription").text("<?php echo ($reModi["one"]["f_description"]); ?>");
    $('#bigmenu li').click(function(){
        var lilen = $('#bigmenu li').length;
        $('#bigmenu li').removeClass('org_box org_box_select');
        $('#bigmenu li span').removeClass('org_bot_cor');
        $('#bigmenu li').attr('class','org_box');
        $(this).attr('class','org_box  org_box_select');
        $(this).children('span').attr('class','org_bot_cor');
        for(var i=0;i<lilen;i++){
            $('#a'+i).hide();
            if($(this).index()===i){
                $('#a'+i).show();
            }
        }
    });

    $(function(){

        //   getTasktype();
        //上传图片
        $("#profileImg").wrap("<form id='up_prologo' action='<?php echo U('Api/Upfile/upF/type/2/size/51200/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
//        $("#convenfileImg").wrap("<form id='up_convenlogo' action='<?php echo U('Api/Upfile/upF/type/2/size/51200/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
        var start = {
            elem: '#startTime',
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
            elem: '#endTime',
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
    });
    var i=0;
    //随手赚 任务模块问题的加载
    $('#template_question_btn').click(function(){
        var list="";
        //console.log(i);
        list+="<div class='taskAdd_template_questionList1'  id='question_list_"+(i+1)+"'>";
        list+="<div class='taskAdd_template_question' style='margin-top:10px'>";
        list+="问：<input type='text' name='conventionDataInput'  class='taskAdd_conventionDataInput' style='width:500px'/>";
        list+="<span style='color:#14bce1;cursor:pointer;margin-left:20px;'  onclick='taskAdd_template_questionList_delete("+(i+1)+",0)'>删除</span>";
        list+="</div>";
        list+="<div  class='taskAdd_template_answer'>";
        list+="答：<select class='template_answer_selected' name='template_answer_selected' id='template_answer_selected_"+(i+1)+"' onchange='changeoption(this.value,"+(i+1)+")'>";
        list+="<option  value='0' selected>请选择</option>";
        list+="<option  value='1'>单选</option>";
        list+="<option  value='2'>多选</option>";
        list+="<option  value='3'>文本</option>";
        list+="<option  value='4'>图片</option>";
        list+="</select>";
        list+="</div>";
        list+="</div>";
        $('.taskAdd_template_questionList').append(list);
        i++;

    });

    function changeoption(optionValue,i){
        $('#template_answer_selected_'+i+'').nextAll('input').remove();
        $('#template_answer_selected_'+i+'').next('button').remove();
        var k = 0;
//            console.log(optionValue);
        if (optionValue == '2' || optionValue == '1') {
            var list = "";
            var listInput= "<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput' />";
            var listbtn = "<button type='button' class='taskAdd_btn'  id='template_question_btn"+i+"'>+</button>";
            var checkbox = "<input type='checkbox' class='answer_"+i+"_0'  value='0' name='answer' style='display:inline-block;margin-left:7px'/>";
            //调研
            if($('#tasktypeid').val()==4){
                list=listInput+listbtn;
                //答题
            }else{
                list=listInput+checkbox+listbtn;
            }
            $('#template_answer_selected_'+i+'').after(list);
            $('#template_question_btn'+i+'').click(function () {
                var list = "";
                var btn="";
                var input="<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput'/>";
//
                var check="<input type='checkbox' class='answer_"+i+"_"+(k+1)+"'  value='"+(k+1)+"'  name='answer' style='display:inline-block;margin-left:7px'/>";
//
                if($("#typetaskid")==0){
                    btn="<input type='button' class='taskAdd_answer_input' onclick='delte_input("+k+","+i+")' id='delte_input_"+i+k+"' value='删除'/>";
                }else{
                    btn="<input type='button' class='taskAdd_answer_input' onclick='delte_input("+(k+1)+","+i+")' id='delte_input_"+(k+1)+i+"' value='删除'/>";
                }

                //调研
                if($('#tasktypeid').val()==4) {
                    list=input+btn;
                }
                //答题
                else{
                    list=input+check+btn;
                }

                $('#template_question_btn'+i+'').before(list);
                k++;
            });
        }

    }

    function addAnswer(i,k){
        k++;
        var list="";
        var checkboxs = "<input type='checkbox' class='answer_"+i+"_"+k+"'  value='' name='answer' style='display:inline-block;margin-left:7px'/>";
        var inputs="<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput'/>";
        var del="<input type='button' class='taskAdd_answer_input' onclick='delte_input("+k+","+i+")' id='delte_input_"+k+i+"' value='删除'/>";
        //调研
        if($('#tasktypeid').val()==4){
            list=inputs+del;

        }
        //答题
        else{
            list=inputs+checkboxs+del;
        }

        $('#template_question_btn'+i+'').before(list);
        $("#delte_input_"+k+i).next().remove();
        $("#delte_input_"+k+i).after("<button type='button' class='taskAdd_btn question_btn_add' id='template_question_btn"+i+"' value='"+i+"' onclick='addAnswer("+i+","+k+")'>+</button>");
    }

    function addQuestion(k){
        var a = $("#detailCount").val();
        $("#detailCount").attr("value",(parseInt(a)+parseInt(1)));

        var count = $("#detailCount").val();
        var list="";
        list+="<div class='taskAdd_template_questionList1'  id='question_list_"+(count-1)+"'>";
        list+="<div class='taskAdd_template_question' style='margin-top:10px'>";
        list+="问：<input type='text' name='conventionDataInput'  class='taskAdd_conventionDataInput' style='width:500px'/>";
        list+="<span style='color:#14bce1;cursor:pointer;margin-left:20px;'  onclick='taskAdd_template_questionList_delete("+(count-1)+",0)'>删除</span>";
        list+="</div>";
        list+="<div  class='taskAdd_template_answer'>";
        list+="答：<select class='template_answer_selected' name='template_answer_selected' id='template_answer_selected_"+(count-1)+"' onchange='changeoption(this.value,"+(count-1)+")'>";
        list+="<option  value='0' selected>请选择</option>";
        list+="<option  value='1'>单选</option>";
        list+="<option  value='2'>多选</option>";
        list+="<option  value='3'>文本</option>";
        list+="<option  value='4'>图片</option>";
        list+="</select>";
        list+="</div>";
        list+="</div>";
        $('.taskAdd_template_questionList').append(list);
        k++;
    }

    //推广赚中任务模块多选中iuput的删除
    function  delte_input(k,i){
        //答题
            $('.answer_'+i+"_"+k).prev().remove();
            $('.answer_'+i+"_"+k).remove();
//                if($("#typetaskid")==0){
            $('#delte_input_'+k+i).remove();
//                }else{
//                    $('#delte_input_'+k+i).remove();
//                }


    }

    //删除推广任务模块

    function  taskAdd_template_questionList_delete(i,indexid){
        $('#question_list_'+i+'').remove();
//           console.log(indexid+"==");
        if(indexid!==0){
            $.post(APP+"/Api/Web/delteanswer/","indexid="+indexid,function(rel){
//                 console.log(rel.error_code+"====");
            },"json");
        }
    }



</script>
</body>
</html>