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
        </ul>
    </div>
    <input type="hidden" id="typetaskid" value="<?php echo ((isset($reModi["one"]["f_tasktypeid"]) && ($reModi["one"]["f_tasktypeid"] !== ""))?($reModi["one"]["f_tasktypeid"]):0); ?>"/>
    <input type="hidden" id="index_proid" value="<?php echo ((isset($reModi["pro"]["f_indexid"]) && ($reModi["pro"]["f_indexid"] !== ""))?($reModi["pro"]["f_indexid"]):0); ?>"/>
    <input type="hidden" id="index_conid" value="<?php echo ((isset($reModi["detail"]["f_indexid"]) && ($reModi["detail"]["f_indexid"] !== ""))?($reModi["detail"]["f_indexid"]):0); ?>"/>
    <div class="index_right_bus">
        <!--随手赚-->
    <div id="a1">
        <div id="nav1">
            <span > 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务&nbsp>&nbsp编辑&nbsp>&nbsp 随手赚</span>
        </div>

        <div  class='taskAdd_conter' style="margin-top:20px">
            <div class="taskAdd_conventionData">
                <div  class="business_taskAdd_step" >
                    <ul>
                        <li  class="step_one  business_taskAdd_step_selected" style="width:50%">创建任务</li>
                        <li  class="step_two" style="width:50%">任务模板</li>
                    </ul>
                </div>
                <!--                       <div class="taskAdd_title">
                                          <span class="taskAdd_title_name">任务详情</span>
                                       </div> -->
                <div id="taskAdd_conventionData_step1"   class="taskAdd_conventDataList" style="min-height:500px;">
                    <!--
                                                <ul>
                                                    <li style="margin-left:15px"> 发布任务的图标</li>
                                                    <li ><img src="" style="width:100px;height:100px;"></img></li>
                                                    <li style="margin-top:70px">
                                                        <input  id="openImgBtn2"  name="openImgBtn2"  type="button"  value="上传图片"  class="pass-portrait-fileBtn" />
                                                        <input  id="fileImg2" class="pass-portrait-file"  type="file"  name="file"  accept="image/jpeg,image/gif,image/png"/>
                                                    </li>
                                                </ul>-->
                    <ul>
                        <li style="margin-left:15px">发布任务的图标</li>

                        <li style="margin:0 10px;">
                            <input  id="openImgBtn2"  name="openImgBtn2"  type="button"   value="上传图片"  class="pass-portrait-fileBtn" onclick="$('#convenfileImg').click()"/>
                        <li style="display: none;"><input  id="convenfileImg" class="pass-portrait-file"  type="file"  name="upfile"   accept="image/jpeg,image/gif,image/png"/></li>
                        <input type="hidden" id="convenfile1" name="convenfile1" value="<?php echo ($reModi["one"]["f_fileid"]); ?>"/>
                        </li>
                        <li>
                            <div class="line_input_pro"  id="line_input_conven" <?php if($reModi['one']['f_name'] != '' ): ?>style="display:block;"<?php endif; ?> >
                            <div class="show_img1" id='show_convenimg1'>
                                <?php if ($reModi['one']['f_name']) {?>
                                <!--  {$reModi['one']['f_name']['f_filepath']}<?php echo ($reModi["one"]["f_name"]["f_filename"]); ?> -->
                                <div id="showPic2">
                                    <img src="/wisdom/Public/upfile/<?php  echo $reModi[one][f_name][f_filepath],$reModi[one][f_name][f_filename];?>" width="100" height="100">
                                </div>
                                <?php }?>
                            </div>
                </div>
                </li>
                <li> <span class="business_taskAdd_spanText" style="display:inline-block">*1:1比例--像素，大小50K以内</span>
                    <!--<div class="show_progress_no" id='show_progress_no_conven'></div>-->
                    <!--<div class="progress_up" id='progress_up_conven'><div class="bar" id='conven_bar'></div>-->
                </li>
                </ul>
                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务标题</li>
                    <li><input type="text" id="taskTitle2"  name="taskTitle"  value="<?php echo ($reModi["one"]["f_title"]); ?>" class="taskAdd_conventionDataInput"></li>
                </ul>

                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务时间</li>
                    <li><input type="text" id="startTime2"  name="startTime2"  value="<?php echo ($reModi["one"]["f_begindate"]); ?>" class="taskAdd_conventionDataInput  laydate-icon"style="width:144px;" placeholder="起始时间"/>
                        <span style="padding:0px 7px">至</span>
                        <input type="text" id="endTime2"  name="endTime2" placeholder="终止时间" value="<?php echo ($reModi["one"]["f_enddate"]); ?>" class="taskAdd_conventionDataInput  laydate-icon" style="width:144px;"/> <span  class="business_taskAdd_spanText">*最多不超过180天</span></li>
                </ul>
                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务联系</li>
                    <li><input type="text" id="conven_linkman"  name="conven_linkman"  value="<?php echo ($reModi["one"]["f_linkman"]); ?>" class="taskAdd_conventionDataInput"   placeholder="业务联系人" ></li>
                </ul>

                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:15px">联系电话</li>
                    <li><input type="text" id="conven_linkphone"  name="conven_linkphone"  value="<?php echo ((isset($reModi["one"]["f_linkphone"]) && ($reModi["one"]["f_linkphone"] !== ""))?($reModi["one"]["f_linkphone"]):$mobile); ?>" class="taskAdd_conventionDataInput"   placeholder="企业联系人电话" ></li>
                </ul>

                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:15px">所属类别</li>
                    <li class="taskAdd_conventionDataLi">
                        <select id="tasktypeid" style="border:1px #EAEAEA solid;">
                            <option value="0">请选择任务类型</option>
                        </select>
                    </li>
                </ul>

                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:15px">任务总数</li>
                    <li><input type="text" id="conven_taskBrand"  name="conven_taskBrand"  value="<?php echo ((isset($reModi["pro"]["f_totalcopies"]) && ($reModi["pro"]["f_totalcopies"] !== ""))?($reModi["pro"]["f_totalcopies"]):0); ?>" class="taskAdd_conventionDataInput" oninput="calcu2();"><span  class="business_taskAdd_spanText">份</span></li>
                </ul>

                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:-10px">单次奖励金币</li>
                    <li><input type="text" id="conven_taskProduct"  name="conven_taskProduct"  value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>" class="taskAdd_conventionDataInput" oninput="calcu2();"><span  class="business_taskAdd_spanText">元(1元=10金币)&nbsp&nbsp 系统自动配奖励积分3积分</span></li>
                </ul>


                <ul class="taskAdd_conventionDataUl" style="margin-left:12px">
                    <li class="taskAdd_conventionDataLi">平台单次服务佣金</li>
                    <li><input type="text" id="conven_saleCommission"  name="conven_saleCommission"  value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>" class="taskAdd_conventionDataInput" placeholder="自动计算" disabled="true"><span  class="business_taskAdd_spanText">元</span></li>
                </ul>

                <ul class="taskAdd_conventionDataUl" style="margin-left:72px">
                    <li class="taskAdd_conventionDataLi">总佣金</li>
                    <li><input type="text" id="conven_totalFee"  name="conven_totalFee"  value="" class="taskAdd_conventionDataInput" placeholder="自动算出，四舍五入" disabled="true"><span  class="business_taskAdd_spanText">元</span></li>
                </ul>


                <ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:-10px"><label  for="taskDegree" >任务难易程度</label></li>
                    <li style="margin-top:10px" >
                        <input type="radio" id="radio" name="taskDegree"  value="1"  /><span  style="margin-right:10px">简单</span>
                        <input type="radio" id="radio"  name="taskDegree"  value="2" /><span  style="margin-right:10px">中等</span>
                        <input type="radio" id="radio"  name="taskDegree"   value="3" /><span style="margin-right:10px">挑战</span>
                    </li>
                </ul>



                <!--<ul class="taskAdd_conventionDataUl">
                    <li class="taskAdd_conventionDataLi" style="margin-left:15px">热门标签</li>
                    <li><input type="text" id="conven_industry"  name="conven_industry"  value="" class="taskAdd_conventionDataInput"><span  class="business_taskAdd_spanText">*多个标签可用“，”隔开</span></li>
                </ul>-->
                <ul class="taskAdd_conventionDataUl">
                    <li style="margin-left:15px" >任务描述</li>
                    <li>
                        <textarea  value="" name="taskDescription"  id="taskDescription" style="width:550px;height:100px;color: #595758;"></textarea>
                    </li>
                </ul>
                <ul >
                    <li style="margin-left:58px" >任务需求</li>
                    <li>
                        <div class="editor" style="min-height:400px;width:100%;float:left;">
                            <script type="text/plain" id="editor1" style="width:550px;min-height:400px;color:#595758;" name="editor1"></script>
                        </div>
                    </li>
                </ul>
                <input type="hidden" id="companyID1" value="<?php echo ($companyID); ?>">
                <input type="hidden" id="taskid" value="<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>">

                <div class="taskAdd_footer" style="margin-top:20px;">
                    <ul>
                        <li style="background-color:#15BCE0;color:#fff; margin-left: 280px;margin-top: 0px;" id="task_one_conven"  >下一步</li>
                    </ul>
                </div>
            </div>
            <input type="hidden" id="btn_widely_two_count" value="">
            <div id="taskAdd_conventionData_step2"  style="display:none ">
                <input type="hidden" id="taskId" name="taskId" value="<?php echo ($reModi["one"]["f_tid"]); ?>">
                <input type="hidden" id="indexid" name="indexid" value="<?php echo ($reModi["pro"]["f_indexid"]); ?>">
                <input type="hidden" id="detailCount" value="<?php echo ($reModi["detailCount"]); ?>" />
                <div class="taskAdd_title"  style="margin-top:20px;">
                    <!--                          <label class="taskAdd_title_name" style="float:left" for="taskTemplate">任务模板</label>-->
                    <ul  style="float:left;margin-left:30px;margin-top:20px">
                        <li  id="conven_bar_radio"><input type="radio"  name="taskTemplate"  value="6"  id="taskTemplate1" /><span  style="margin-right:10px">答题</span>
                            <input type="radio"  name="taskTemplate"   value="5"  id="taskTemplate2" /><span  style="margin-right:10px">推荐</span>
                            <input type="radio" name="taskTemplate"  value="4"  id="taskTemplate3" /><span style="margin-right:10px">调研</span>
                        </li>
                    </ul>
                </div>

                <!--调研类与答题类模板-->
                <div  class="taskAdd_template_questionList" id="quest"  style="display:none">
                    <?php if ($reModi['detail']) { ?>
                    <?php if(is_array($reModi["detail"])): $k = 0; $__LIST__ = $reModi["detail"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="taskAdd_template_questionList1" id='question_list_<?php echo ($k-1); ?>'>
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
                        <div class="taskAdd_template_question" style="margin-left: -160px;">
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
                <!--推荐模板样式-->
                <div id="recomdtemp" style="margin-top:50px;margin-left:-320px;display:none">
                    <script type="text/plain" id="editor2" style="width:550px;min-height:450px;color:#595758;" name="editor2"></script>
                </div>
                <!--                     <input type="hidden" id="taskid2" value="<?php echo ((isset($taskid) && ($taskid !== ""))?($taskid):0); ?>">-->
                <div class="taskAdd_footer">
                    <ul>
                        <li style="background-color:#15BCE0;color:#fff;margin-left:200px" id="task_two_to_one2">上一步</li>
                        <li style="background-color:#15BCE0;color:#fff;" id="task_two_conven">提交</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div></div>
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
        $("#tasktypeid").empty();
        $("#tasktypeid").append("<option value='0'>选择任务类型</option><option value='4'>调研类</option><option value='5'>推荐类</option><option value='6'>答题类</option>");
        var aa = $("#conven_taskProduct").val() * 2 * $("#conven_taskBrand").val();
        $("#conven_totalFee").val(aa);
        $("#tasktypeid").find($("#tasktypeid"));
        //单选框
        var radio = document.getElementsByName('taskDegree');
        var str1 = "<?php echo ((isset($reModi["one"]["f_harder "]) && ($reModi["one"]["f_harder "] !== ""))?($reModi["one"]["f_harder "]): 0); ?>";
        for (var i = 0; i < radio.length; i++) {
            if (radio[i].value == str1) {
                radio[i].checked = "true";
            }
        }
        //下拉框
        var sel = document.getElementById('tasktypeid');
        var str = "<?php echo ((isset($reModi["one"]["f_tasktypeid"]) && ($reModi["one"]["f_tasktypeid"] !== ""))?($reModi["one"]["f_tasktypeid"]):0); ?>";
        for (var i = 0; i < sel.options.length; i++) {
            if (sel.options[i].value == str) {
                sel.options[i].selected = "true";
            }
        }
        $("#quest_0").css("margin-left", "-160px");

    });
    //实例化编译器
    var ue=UM.getEditor('editor1',{
        toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
        UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
        autoClearinitialContent: true,
        elementPathEnabled: false,
        autoFloatEnabled: false,
        // textarea: 'content'
    });
    UM.getEditor('editor1').setContent('<?php echo ($reModi["pro"]["f_taskrequirements"]); ?>',true);
</script>

<!--推荐类详情-->
<script type="text/javascript">
    //实例化编译器
    var ue=UM.getEditor('editor2',{
        toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
        UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
        autoClearinitialContent: true,
        elementPathEnabled: false,
        autoFloatEnabled: false,
        // textarea: 'content'
    });
    UM.getEditor('editor2').setContent('<?php echo ($reModi["pro"]["f_recommend"]); ?>',true);
</script>
<script>
    $("#taskDescription").text("<?php echo ($reModi["one"]["f_description"]); ?>");
    $(function(){
        $("#convenfileImg").wrap("<form id='up_convenlogo' action='<?php echo U('Api/Upfile/upF/type/2/size/51200/exts/jpg,gif,png');?>' method='post' enctype='multipart/form-data'></form>");
        var start2 = {
            elem: '#startTime2',
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
        var end2 = {
            elem: '#endTime2',
            format: 'YYYY-MM-DD',
            min: laydate.now(),
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };

        laydate(start2);
        laydate(end2);
    });
    var i=0;
    //推广赚 任务模块问题的加载
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
        //调研
        if($('#tasktypeid').val()==4){
            if($("#typetaskid")==0){
                $('#delte_input_'+i+k).prev().remove();
                $('#delte_input_'+i+k).remove();
            }else{
                $('#delte_input_'+k+i).prev().remove();
                $('#delte_input_'+k+i).remove();
            }

        }
        //答题
        else{
            $('.answer_'+i+"_"+k).prev().remove();
            $('.answer_'+i+"_"+k).remove();
//                if($("#typetaskid")==0){
            $('#delte_input_'+k+i).remove();
//                }else{
//                    $('#delte_input_'+k+i).remove();
//                }

        }
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