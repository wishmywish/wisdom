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
            <div id="draggle">
                <p>题目类型</p>
                <span id="singe_drag"><i class="fa fa-dot-circle-o fa-fw"></i> 单选题</span>
                <span id="double_drag"><i class="fa fa-check-square-o fa-fw"></i> 多选题</span>
                <span id="pic_drag"><i class="fa fa-file-text-o fa-fw"></i> 文本题</span>
                <span id="text_drag"><i class="fa fa-picture-o fa-fw"></i> 图片题</span>
            </div>
        </ul>
    </div>
    <input type="hidden" id="typetaskid" value="<?php echo ((isset($reModi["one"]["f_tasktypeid"]) && ($reModi["one"]["f_tasktypeid"] !== ""))?($reModi["one"]["f_tasktypeid"]):0); ?>"/>
    <input type="hidden" id="index_proid" value="<?php echo ((isset($reModi["pro"]["f_indexid"]) && ($reModi["pro"]["f_indexid"] !== ""))?($reModi["pro"]["f_indexid"]):0); ?>"/>
    <input type="hidden" id="index_conid" value="<?php echo ((isset($reModi["detail"]["f_indexid"]) && ($reModi["detail"]["f_indexid"] !== ""))?($reModi["detail"]["f_indexid"]):0); ?>"/>
    <div class="index_right_bus">
        <!--随手赚-->

        <div id="nav1">
            <span > 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务&nbsp>&nbsp新增&nbsp>&nbsp 随手赚</span>
        </div>
        <div id="a1" style="display: block">
            <div  class='taskAdd_conter' style="margin-top:25px">
    <form  action='' method="post"  id='taskAddForm_make'>
        <div class="taskAdd_conventionData">
            <div class="taskAdd_title">
                <span class="taskAdd_title_name">任务详情</span>
            </div>
            <div class="taskAdd_conventDataList" style="min-height:500px;">
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
            <div class="mobileView">
                ddd
            </div>
            <input type="hidden" id="companyID" value="<?php echo ($companyID); ?>">
            <input type="hidden" id="taskid" value="<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>">
            <div class="next_btn">
                <span  onclick="widely_next()">下一步</span>
            </div>
        </div>
    </form>
</div>
        </div>
        </div>
        <div id="a2" style="display: none">
            <div class="tips-draggle">
                <p>温馨提示:</p>
                <p>1）单击、或拖拽左边的题目到右侧。</p>
                <p>2）编辑完题目之后，再进行逻辑设定。一旦逻辑设定后，再进行题目编辑（题目顺序变动或者删除）的情况下，请注意调整逻辑设定！</p>
                <p>3）在离开本页面之前，请注意保存设计，以避免设计数据丢失。</p>
            </div>
            <div class="draggle">
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
    $(function() {
//        autosize(document.querySelectorAll('textarea'));
        $("#profileImg").wrap("<form id='up_prologo' action='<?php echo U('Api/Upfile/upF/type/2/size/51200/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
        $("#convenfileImg").wrap("<form id='up_convenlogo' action='<?php echo U('Api/Upfile/upF/type/2/size/51200/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
        var num=$(".draggle .draggle_content:last-child").index()+1;
//        $( "#draggle").draggable();

        $("#draggle span").each(function(i){
            var span_id=$("#draggle span").eq(i).attr("id");
            var span_text=$("#draggle span").eq(i).text();
            $("#"+span_id).draggable({
                cursor: "move",
                containment: "document",
                helper:function (){
                    var doc="<span id='doc' style='color: #7A8B73'>"+span_text+"</span>";
                    return  doc;
                },
            });
        });


        $( ".draggle" ).sortable({
            update: function (event, ui) {
                changenum_big();
            }
        });

//            $( ".draggle" ).disableSelection();

        //鼠标拖拽掉时的动作
        $(".draggle").droppable({
            accept:"#draggle span",
            drop:function(event,ui){
                num++;
                showdrag(ui.draggable.context.id,num);
            }
        });




        function  showdrag(draggabelid,num){
            eval(""+draggabelid+"("+num+")");
        }

    });



    function  changenum_big(){
        $(".draggle .draggle_content").each(function(i){
            var obj=$(".draggle .draggle_content").eq(i);
            var data_type=$(obj).attr("data-type");
            var text="";
            if(data_type==1){
                text="多选题";
            }else if(data_type==2){
                text="单选题";
            }else if(data_type==3){
                text="图片题";
            }else if(data_type==4){
                text="文本题";
            }
            obj.find(".num").text("Q"+(i+1)+":("+text+")");
        });

        $(".draggle .draggle_content").hover(
                function () {
                    $(this).find(".title_img").show();
                },
                function () {
                    $(this).find(".title_img").hide();
                }
        );
    }






    //添加单选模板
    function   singe_drag(num){
        var tmp="";
        tmp+="<div  class='draggle_content'  data-type='2'>";
        tmp+="<div class='title'>";
        tmp+="<span class='num'>Q"+num+":(单选题)</span>";
        tmp+=" <textarea   class='title_textare' placeholder='单选题'></textarea>";
        tmp+="<span class='title_img' onclick='drag_del(this)'><i class='fa fa-times-circle-o fa-2x'></i></span>";
        tmp+=" </div>";
        tmp+="  <div class='content'>";
        tmp+="<div  class='content_temp'>";
        tmp+="<textarea class='content_temp_ques' name='quest_text_singe_1'>选项1</textarea>";
        tmp+="<span class='content_add_img' style='color: #45A85D' onclick='add(this,1)'><i class='fa fa-plus fa-1x'></i></span>"
        tmp+="<span class='content_del_img' style='color: #F47469' onclick='del(this)'><i class='fa fa-trash-o fa-1x'></i></span>"
        tmp+="</div>";
        tmp+="</div>";
        tmp+="</div>";
        $(".draggle").append(tmp);
        changenum_big();
    }

    //添加多选题模板
    function   double_drag(num){
        var tmp="";
        tmp+="<div  class='draggle_content'  data-type='1'>";
        tmp+="<div class='title'>";
        tmp+="<span class='num'>Q"+num+":(多选题)</span>";
        tmp+=" <textarea   class='title_textare' placeholder='多选题'></textarea>";
        tmp+="<span class='title_img' onclick='drag_del(this)'><i class='fa fa-times-circle-o fa-2x'></i></span>";
        tmp+=" </div>";
        tmp+="  <div class='content'>";
        tmp+="<div  class='content_temp'>";
        tmp+="<textarea class='content_temp_ques' name='quest_text_double_1'>选项1</textarea>";
        tmp+="<span class='content_add_img' style='color: #45A85D' onclick='add(this,1)'><i class='fa fa-plus fa-1x'></i></span>"
        tmp+="<span class='content_del_img' style='color: #F47469' onclick='del(this)'><i class='fa fa-trash-o fa-1x'></i></span>"
        tmp+="</div>";
        tmp+="</div>";
        tmp+="</div>";
        $(".draggle").append(tmp);
        changenum_big();

    }

    //添加图片模板
    function   pic_drag(num){
        var tmp="";
        tmp+="<div  class='draggle_content'  data-type='3' style='min-height:0px'>";
        tmp+="<div class='title' style='border-radius:5px;'>";
        tmp+="<span class='num'>Q"+num+":(图片题)</span>";
        tmp+="<textarea   class='title_textare' placeholder='图片'></textarea>";
        tmp+="<span class='title_img' onclick='drag_del(this)'><i class='fa fa-times-circle-o fa-2x'></i></span>";
        tmp+"</div>";
        tmp+="</div>";
        $(".draggle").append(tmp);
        changenum_big();
    }

    //添加文本模板
    function   text_drag(num){
        var tmp="";
        tmp+="<div  class='draggle_content'  data-type='4' style='min-height:0px'>";
        tmp+="<div class='title' style='border-radius:5px;'>";
        tmp+="<span class='num'>Q"+num+":(文本题)</span>";
        tmp+="<textarea   class='title_textare' placeholder='文本'></textarea>";
        tmp+="<span class='title_img' onclick='drag_del(this)'><i class='fa fa-times-circle-o fa-2x'></i></span>";
        tmp+"</div>";
        tmp+="</div>";
        $(".draggle").append(tmp);
        changenum_big();
    }


    //添加选择项模板
    function  add(obj,num){
        var obj_small_tmp=$(obj).parent(".content_temp");
        var length=$(obj).parents(".content").children(".content_temp").length;
        add_small_tmp(obj_small_tmp,length,num);

    }

    //添加子选择项模板
    function add_small_tmp(obj,length,num){
        var quest_text="";
        var length=length+1;
        if(num==1){
            quest_text="quest_text_singe_"+length;
        }else if(num==2){
            quest_text="quest_text_double_"+length;
        }
        template(obj,quest_text,length,num);

    }
    //模板
    function template(obj,quest_text,length,num){
        var tmp="";
        tmp+="<div  class='content_temp'>";
        tmp+="<textarea class='content_temp_ques' name='"+quest_text+"'>选项"+length+"</textarea>";
        tmp+="<span class='content_add_img' style='color: #45A85D' onclick='add(this,"+num+")'><i class='fa fa-plus fa-1x'></i></span>"
        tmp+="<span class='content_del_img' style='color: #F47469' onclick='del(this)'><i class='fa fa-trash-o fa-1x'></i></span>"
        tmp+="</div>";
        $(obj).after(tmp);
    };


    //删除选择项模板
    function  del(obj){
        var length=$(obj).parents(".content").children(".content_temp").length;
        if((length-1)==0){
            $(obj).siblings("textarea").text("选择1");
        }else{
            $(obj).parent(".content_temp").remove();
        }
    }

    //问题模板的删除
    function  drag_del(obj){
        $(obj).parents(".draggle_content").remove();
        changenum_big();
        }

    //点击下一步
    function  widely_next(){
        $("#a1").hide();

        $("#a2").show();
        $("#draggle").show();
    }

    function  widely_pre(){
        $("#draggle").hide();
        $("#a1").show();
        $("#a2").hide();
    }

</script>
</body>
</html>