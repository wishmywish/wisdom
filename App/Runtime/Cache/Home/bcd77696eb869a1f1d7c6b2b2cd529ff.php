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
            <li id="0" class="org_box org_box_select"><span class="org_bot_cor"></span>推广赚</li>
            <li id="1" class="org_box"><span ></span>随手赚</li>
        </ul>
    </div>
        <input type="hidden" id="typetaskid" value="<?php echo ((isset($reModi["one"]["f_tasktypeid"]) && ($reModi["one"]["f_tasktypeid"] !== ""))?($reModi["one"]["f_tasktypeid"]):0); ?>"/>
        <input type="hidden" id="index_proid" value="<?php echo ((isset($reModi["pro"]["f_indexid"]) && ($reModi["pro"]["f_indexid"] !== ""))?($reModi["pro"]["f_indexid"]):0); ?>"/>
        <input type="hidden" id="index_conid" value="<?php echo ((isset($reModi["detail"]["f_indexid"]) && ($reModi["detail"]["f_indexid"] !== ""))?($reModi["detail"]["f_indexid"]):0); ?>"/>
    <div class="index_right_bus">
        <!--推广赚-->
        <div id="a0">
            <div id="nav">
                <span> 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务&nbsp>&nbsp 新增&nbsp>&nbsp 推广赚</span>
            </div>
            <div  class='taskAdd_conter' style="margin-top:25px">
                <form  action='' method="post"  id='taskAddForm_make'>
                    <div class="taskAdd_conventionData">
                        <div class="taskAdd_title">
                            <span class="taskAdd_title_name">任务详情</span>
                        </div>
                        <div class="taskAdd_conventDataList" style="min-height:500px;">
                            <ul>
                                <li style="margin-left:25px;">发布任务的图标</li>
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
                        </li>
                        <li> <span class="business_taskAdd_spanText" style="display:inline-block">*1:1比例--像素，大小50K以内</span>
                            <!--<div class="show_progress_no" id='show_progress_no_pro'></div>-->
                            <!--<div class="progress_up" id='progress_up_pro'><div class="bar" id='pro_bar'></div></div> -->
                        </li>
                        </ul>
                        <ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务标题</li>
                            <li><input type="text" id="taskTitle"  name="taskTitle"  value="<?php echo ($reModi["one"]["f_title"]); ?>" class="taskAdd_conventionDataInput" placeholder="请输入任务标题"></li>
                        </ul>

                        <ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务时间</li>
                            <li><input id="startTime"  name="startTime"  value="<?php echo ($reModi["one"]["f_begindate"]); ?>" class="taskAdd_conventionDataInput laydate-icon"  style="width:144px;" placeholder="起始时间"/>
                                <span style="padding:0px 7px">至</span>
                                <input  id="endTime"  name="endTime" placeholder="终止时间"  value="<?php echo ($reModi["one"]["f_enddate"]); ?>" class="taskAdd_conventionDataInput  laydate-icon" style="width:144px;"/> <span  class="business_taskAdd_spanText">*最多不超过180天</span></li>
                        </ul>
                        <ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务联系</li>
                            <li><input type="text" id="pro_linkman"  name="pro_linkman"  value="<?php echo ($reModi["one"]["f_linkman"]); ?>" class="taskAdd_conventionDataInput"   placeholder="业务联系人" ></li>
                        </ul>

                        <ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:15px">联系电话</li>
                            <li><input type="text" id="pro_linkphone"  name="pro_linkphone"  value="<?php echo ((isset($reModi["one"]["f_linkphone"]) && ($reModi["one"]["f_linkphone"] !== ""))?($reModi["one"]["f_linkphone"]):$mobile); ?>" class="taskAdd_conventionDataInput"   placeholder="企业联系人电话" ></li>
                        </ul>

                        <ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务总数</li>
                            <li><input type="text" id="pro_taskBrand"  name="pro_taskBrand" value="<?php echo ($reModi["pro"]["f_totalcopies"]); ?>"  class="taskAdd_conventionDataInput" oninput="calcu();"><span  class="business_taskAdd_spanText">份</span></li>
                        </ul>

                        <ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:-10px">单次奖励佣金</li>
                            <li><input type="text" id="pro_taskProduct"  name="pro_taskProduct" value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>"  class="taskAdd_conventionDataInput" oninput="calcu();"><span  class="business_taskAdd_spanText">元(1元=10金币)&nbsp&nbsp 系统自动配奖励3个银票</span></li>
                        </ul>
                        <ul class="taskAdd_conventionDataUl" style="margin-left:12px">
                            <li class="taskAdd_conventionDataLi">平台单次服务佣金</li>
                            <li><input type="text" id="pro_saleCommission"  name="pro_saleCommission" value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>"  class="taskAdd_conventionDataInput"  disabled="true"><span  class="business_taskAdd_spanText">元&nbsp*自动计算</span></li>
                        </ul>

                        <ul class="taskAdd_conventionDataUl" style="margin-left:72px">
                            <li class="taskAdd_conventionDataLi">总佣金</li>
                            <li><input type="text" id="pro_totalFee"  name="pro_totalFee" value=""  class="taskAdd_conventionDataInput"  disabled="true" ><span  class="business_taskAdd_spanText">元&nbsp*自动算出，四舍五入</span></li>
                        </ul>

                        <!--<ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:15px">热门标签</li>
                            <li><input type="text" id="pro_industry"  name="pro_industry"  value="" class="taskAdd_conventionDataInput"><span  class="business_taskAdd_spanText">*多个标签可用“，”隔开</span></li>
                        </ul>-->
                        <ul class="taskAdd_conventionDataUl">
                            <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务描述</li>
                            <li>
                                <textarea  value="" name="pro_taskDescription"  id="pro_taskDescription" style="width:550px;height:100px;"></textarea>
                            </li>
                        </ul>
                        <ul >
                            <li style="margin-left:58px" >任务需求</li>
                            <li>
                                <div class="editor" style="min-height:400px;width:100%;float:left;">
                                    <script type="text/plain" id="editor" style="width:550px;min-height:400px;" name="editor"></script>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <input type="hidden" id="companyID" value="<?php echo ($companyID); ?>">
                    <input type="hidden" id="taskid" value="<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>">
                    <div class="taskAdd_footer" style="margin-top:20px;">
                        <ul>
                            <li style="background-color:#15BCE0;color:#fff; margin-left: 280px;" onclick="pro_submit()">提交</li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>

        <!--随手赚-->
</div>

<div id="a1" style="display:none">
        <div id="nav1">
            <span > 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务&nbsp>&nbsp 新增&nbsp>&nbsp 随手赚</span>
        </div>
        <div class="taskAdd_title" style="margin-top: 25px;line-height: 40px;">
            <span class="taskAdd_title_name">选择任务类型</span>
        </div>
        <div class="panel">
            <ul>
                <li class="box"><span  class="fa fa-search fa-3x fa-fw"></span></li>
                <li class="box-title"><input type="radio" name="kind" value="4">&nbsp;&nbsp;&nbsp;调研</li>
            </ul>
            <ul>
                <li class="box"><span  class="fa fa-thumbs-o-up fa-3x fa-fw"></span></li>
                <li class="box-title"><input type="radio" name="kind" value="5">&nbsp;&nbsp;&nbsp;推荐</li>
            </ul>
            <ul>
                <li class="box"><span  class="fa fa-edit fa-3x fa-fw"></span></li>
                <li class="box-title"><input type="radio" name="kind" value="6">&nbsp;&nbsp;&nbsp;答题</li>
            </ul>
            <!--<ul>-->
                <!--<li class="box"><span  class="fa fa-check-square-o fa-3x fa-fw"></span></li>-->
                <!--<li class="box-title"><input type="radio" name="kind" value="7">&nbsp;&nbsp;&nbsp;督查</li>-->
            <!--</ul>-->
            <ul>
                <button class="box-btn" id="btnSubmit">开始创建</button>
            </ul>

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
    $(function(){
        $("#btnSubmit").click(function(){
            var list= $('input:radio[name="kind"]:checked').val();
            if(list==null){
                layer.msg("请选择一个任务类型", {icon: 8});
                return false;
            }
            else{
                if(list==4||list==6||list==5){
                    location.href=APP+"/Home/Promotion/surveyTaskAdd?tasktype="+list;
                }else if(list==7){
                    location.href=APP+"/Home/Promotion/audit_edit?tasktype="+list;
                }
            }
        });
    });

    var ue=UM.getEditor('editor',{
        toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
        UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
        autoClearinitialContent: true,
        elementPathEnabled: false,
        autoFloatEnabled: false,
    });
    UM.getEditor('editor').setContent('<?php echo ($reModi["pro"]["f_taskrequirements"]); ?>',true);
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

        //上传图片
        $("#profileImg").wrap("<form id='up_prologo' action='<?php echo U('Api/Upfile/upF/type/2/size/51200/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
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


</script>
</body>
</html>