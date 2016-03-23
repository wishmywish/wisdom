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
        <ul id="bigmenu">
            <li id="0" class="org_box org_box_select" onclick="getNoticeList();"><span class="org_bot_cor"></span>公告</li>

            <?php if($viewUserDetail_userLevel == '999'): ?><li id="1" class="org_box" onclick="getNoticeBoardList();"><span ></span>公告栏目</li><?php endif; ?>

        </ul>
    </div>
    <div class="notice_center">
        <!--公告-->
        <div id="a0">
            <div class="notice_head">
                <span style="display: inline-block;">公告&nbsp;>&nbsp;公告</span>
                <div class="column">
                    <span style="float: left;">筛选：</span>
                    <!-- 员工部门-->
                    <div class="personmsg">
                        <ul>
                            <li>
                                <label style="height: 25px;">公告主题&nbsp;</label>
                                <input id="searchSubject" type="text" />
                            </li>
                            <li>
                                <label>所属栏目&nbsp;</label>
                                <select id="searchBoard">
                                    <option value="">--请选择--</option>
                                    <?php if(is_array($queryAllNoticeBoard_list)): $i = 0; $__LIST__ = $queryAllNoticeBoard_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["boardId"]); ?>"><?php echo ($vo["boardName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </li>
                        </ul>
                        <form id="searchForm">
                            <input type="hidden" id="currentPage" name="page" value="<?php echo ($getNoticeList_page); ?>" />
                            <input type="hidden" id="hidSearchSubject" name="subject" value="" />
                            <input type="hidden" id="hidSearchBoard" name="boardId" value="" />
                        </form>
                    </div>
                    <!-- 按钮-->
                    <p style="height: 25px;margin: 12px 0 0 620px;">
                    <input id="searchButton" class="bntns" type="button" value="搜索" onclick="doSearch();" />
                    <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClear();" />
                    <?php if(!empty($queryAllNoticeBoard1_list)): ?><input id="exprotButton" class="bntns bntns1" type="button" onclick="location='<?php echo U('Office/noticeAdd');?>'" value="新增"></p><?php endif; ?>
                </div>
            </div>
            <!--列表-->
            <div class="notice_list">
                <div class="title">
                    <ul>
                        <li style="width: 5%;">序号</li>
                        <li style="width: 15%;">标题</li>
                        <li style="width: 10%;">所属栏目</li>
                        <li style="width: 5%;">浏览数</li>
                        <li style="width: 10%;">发布人</li>
                        <li style="width: 20%;">发布对象</li>
                        <li style="width: 10%;">创建日期</li>
                        <li style="width: 10%;">置顶</li>
                        <li style="width: 5%;">附件</li>
                        <li style="width: 10%;">操作</li>
                    </ul>
                </div>
                <div id="contentList" class="contentList">
                    <?php if(is_array($getNoticeList_list)): $i = 0; $__LIST__ = $getNoticeList_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
                            <li style="width: 5%;"><?php echo ($i); ?></li>
                            <li style="width: 15%;" title="<?php echo ($vo["title"]); ?>"><?php echo ($vo["title"]); ?></li>
                            <li style="width: 10%;"><?php echo ($vo["boardName"]); ?></li>
                            <li style="width: 5%;"><?php echo ($vo["reads"]); ?></li>
                            <li style="width: 10%;"><?php echo ($vo["trueName"]); ?></li>
                            <li style="width: 20%;" title="<?php echo ($vo["releaseUserNames"]); ?>"><?php echo ($vo["releaseUserNames"]); ?></li>
                            <li style="width: 10%;"><?php echo ($vo["createDate"]); ?></li>
                            <li style="width: 10%;" class="top_<?php echo ($vo["messageId"]); ?>"><?php if($vo["isTop"] == 1): ?>置顶<?php else: ?>不置顶<?php endif; ?></li>
                            <li style="width: 5%;"><?php if($vo["isHaveAttach"] == 1): ?>有<?php else: ?>无<?php endif; ?></li>
                            <li id="operate" style="width: 10%;"><?php if($vo["isMaintain"] == 1): ?><i style="color: #4f88b5;" class="fa fa-file-text-o" onclick="doDetail('<?php echo ($vo["messageId"]); ?>');" title="查看"></i><?php else: ?><li id="operate" style="width: 10%;"><i style="color: #4f88b5;" class="fa fa-file-text-o" title="查看" onclick="doDetail('<?php echo ($vo["messageId"]); ?>');"></i><i style="color:#de2e2f;" title="删除" class="fa fa-trash" onclick="doDelete('<?php echo ($vo["messageId"]); ?>');"></i><?php if($vo["isTop"] == 1): ?><i id="opt_top_<?php echo ($vo["messageId"]); ?>" rel="0" style="color:#00a73c;" class="fa fa-reply" title="取消置顶" onclick="doTop('<?php echo ($vo["messageId"]); ?>');"></i><?php else: ?><i id="opt_top_<?php echo ($vo["messageId"]); ?>" rel="1" style="color:#00a73c;" class="fa fa-step-forward fa-rotate-270" title="置顶"  onclick="doTop('<?php echo ($vo["messageId"]); ?>');"></i><?php endif; endif; ?>
                        </li>
                        </ul><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php if(empty($getNoticeList_list)): ?><ul><li style="width: 100%;color:#f47469;">暂无数据，请创建公告!</li></ul><?php endif; ?>
                </div>
                <div id="pagebar" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA"></div>
            </div>
        </div>
        <!--公告栏目-->
        <div id="a1" style="display: none;">
            <div class="notice_head">
                <span style="display: inline-block;">公告&nbsp;>&nbsp;公告栏目</span>
                <div class="column">
                    <!-- 按钮-->
                    <p style="height: 25px;margin: 0 10px 0 0;float: right;"><input id="" class="bntns bntns1" type="button" onclick="location='<?php echo U('Office/noticeColumnAdd');?>'" value="新增"></p>
                </div>
            </div>
            <!--列表-->
            <div class="notice_list">
                <div class="title">
                    <ul>
                        <li style="width: 5%;">序号</li>
                        <li style="width: 25%;">公告栏目</li>
                        <li style="width: 40%;">栏目负责人</li>
                        <li style="width: 5%;">公告数</li>
                        <li style="width: 15%;">创建时间</li>
                        <li style="width: 10%;">操作</li>
                    </ul>
                </div>
                <div id="" class="contentList">
                    <div id="noticeBoardList">
                    <?php if(!empty($noticeBoardList_list)): if(is_array($noticeBoardList_list)): $i = 0; $__LIST__ = $noticeBoardList_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><ul>
                            <li style="width: 5%;"><?php echo ($i); ?></li>
                            <li style="width: 25%;" title="<?php echo ($list["boardName"]); ?>"><?php echo ($list["boardName"]); ?>&nbsp;</li>
                            <li style="width: 40%;" title="<?php echo ($list["maintainerStr"]); ?>"><?php echo ($list["maintainerStr"]); ?>&nbsp;</li>
                            <li style="width: 5%;"><?php echo ($list["noticeCount"]); ?>&nbsp;</li>
                            <li style="width: 15%;"><?php echo ($list["createDate"]); ?>&nbsp;</li>
                            <li style="width: 10%;">
                              <li id="" style="width: 10%;">
                                <i style="color: #4f88b5;cursor: pointer;" class="fa fa-edit" onclick="editNoticeBoard('<?php echo ($list["boardId"]); ?>');" title="编辑"></i>
                                <i style="color:#de2e2f;padding-left: 15px;cursor: pointer;" class="fa fa-trash" onclick="deleteNoticeBoard('<?php echo ($list["boardId"]); ?>');" title="删除"></i>
                              </li>
                            </li>
                        </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    <?php if(empty($noticeBoardList_list)): ?><ul><li style="width: 100%;color:#f47469;">暂无数据，请创建公告!</li></ul><?php endif; ?>
                    </div>
                </div>
                <div id="pagebar1" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA"></div>
                <input type="hidden" id="page1" value="1">
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
    $(function(){
        Cookie.eraseCookie("bigMenuIndex");
        Cookie.eraseCookie("smallMenuIndex");
        Cookie.createCookie("bigMenuIndex",0);
        Cookie.createCookie("smallMenuIndex",2);

        createPageBar('<?php echo ($getNoticeList_total); ?>', '<?php echo ($getNoticeList_pageSize); ?>', '<?php echo ($getNoticeList_page); ?>', '<?php echo ($getNoticeList_totalPage); ?>');
        $(document).on('click','#pagebar span a', function() {
            $("#currentPage").val($(this).attr("rel"));
            getNoticeList();
        });

        createPageBar1('<?php echo ($noticeBoardList_total); ?>', '<?php echo ($noticeBoardList_pageSize); ?>', '<?php echo ($noticeBoardList_page); ?>', '<?php echo ($noticeBoardList_totalPage); ?>');
        $(document).on('click','#pagebar1 span a', function() {
            $("#page1").val($(this).attr("rel"));
            getNoticeBoardList();
        });
        
        
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

    var returnFlag = '<?php echo ($return); ?>';
    $('#bigmenu li').removeClass('org_box org_box_select');
    $('#bigmenu li span').removeClass('org_bot_cor');
    $('#bigmenu li').attr('class','org_box');
    $('#bigmenu #'+returnFlag).attr('class','org_box  org_box_select');
    $('#bigmenu #'+returnFlag).children('span').attr('class','org_bot_cor');
    for(var i = 0; i < 2; i++) {
        $('#a'+i).hide();
        if(returnFlag == i){
            $('#a'+i).show();
        }
    }

    function doClear() {
        $("#searchSubject").val("");
        $("#searchBoard").val("");
    }
    // 公告检索
    function doSearch() {
        $("#currentPage").val("1");
        $("#hidSearchSubject").val($("#searchSubject").val());
        $("#hidSearchBoard").val($("#searchBoard").val());
        getNoticeList();
    }
    // 删除公告
    function doDelete(messageId) {
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/deleteNotice');?>", {'messageId':messageId}, function(data) {
            layer.close(loadIdx);
            if (data.error_code == "success") {
                layer.msg("删除成功！");
                getNoticeList(true);
            } else if (data.error_code == "101012") {
                layer.msg(data.error_text,{icon: 8});
            } else {
                layer.msg("删除失败" ,{icon: 8});
            }
        }, 'json');
    }
    // 公告通知详细
    function doDetail(messageId) {
        layer.open({
            type:2,
            title :['公告通知','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['700px', '600px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/noticeDetail');?>?messageId=" + messageId,
        });
    }
    // 公告置顶
    function doTop(messageId) {
        var isTop = parseInt($("#opt_top_" + messageId).attr("rel"));
        var title = (isTop == 1) ? '置顶' : '不置顶';
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/setTopMessage');?>", {'messageId':messageId, 'isTop':isTop}, function(data) {
            layer.close(loadIdx);
            if (data.error_code == "success") {
                layer.msg(title + "成功！");
                $(".top_" + messageId).text(title);

                if (isTop == 1) {
                    $("#opt_top_" + messageId).attr('class', 'fa fa-reply');
                    $("#opt_top_" + messageId).attr('rel', '0');
                    $("#opt_top_" + messageId).attr('title', '取消置顶');
                } else {
                    $("#opt_top_" + messageId).attr('class', 'fa fa-step-forward fa-rotate-270');
                    $("#opt_top_" + messageId).attr('rel', '1');
                    $("#opt_top_" + messageId).attr('title', '置顶');
                }
            } else if (data.error_code == "101015") {
                layer.msg(data.error_text,{icon: 8});
            } else {
                layer.msg(title + "失败",{icon: 8});
            }
        }, 'json');
    }
    // 获取公告列表
    function getNoticeList(isNoLoad) {
        var loadIdx = isNoLoad ? -1 : layer.load(0);
        var searchData = $("#searchForm").serializeArray();
        $.post("<?php echo U('Office/searchNoteList');?>", searchData, function(data) {
            layer.close(loadIdx);
            content = '';
            if(data.error_code == "success") {
                if (!("list" in data)) {
                    layer.msg(data.error_text,{icon: 8});
                    return;
                }
                // 设定用户列表
                $.each(data.list, function(k, v) {
                    content += '<ul>';
                    content += '<li style="width: 5%;">' + (k + 1) + '</li>';
                    content += '<li style="width: 15%;" title="' + v.title + '">' + v.title + '</li>';
                    content += '<li style="width: 10%;">' + v.boardName + '</li>';
                    content += '<li style="width: 5%;">' + v.reads + '</li>';
                    content += '<li style="width: 10%;">' + v.trueName + '</li>';
                    content += '<li style="width: 20%;" title="' + v.releaseUserNames + '">' + v.releaseUserNames + '</li>';
                    content += '<li style="width: 10%;">' + v.createDate + '</li>';
                    content += '<li style="width: 10%;" class="top_' + v.messageId + '">';
                    content += (v.isTop == 1 ? '置顶' : '不置顶');
                    content += '</li>';
                    content += '<li style="width: 5%;">';
                    content += (v.isHaveAttach == 1 ? '有' : '无');
                    content += '</li>';
                    content += '<li id="operate" style="width: 10%;">';
                    if (v.isMaintain == 1){
                        content += '<i style="color: #4f88b5;" class="fa fa-file-text-o" title="查看" onclick="doDetail(\'' + v.messageId + '\');"></i>';
                    } else{
                    content += '<i style="color: #4f88b5;" class="fa fa-file-text-o" title="查看" onclick="doDetail(\'' + v.messageId + '\');"></i>';
                    content += '<i style="color:#de2e2f;" class="fa fa-trash" title="删除" onclick="doDelete(\'' + v.messageId + '\');"></i>';
                    if (v.isTop == 1) {
                        content += '<i id="opt_top_' + v.messageId + '" rel="0" style="color:#00a73c;" class="fa fa-reply" title="取消置顶" onclick="doTop(\'' + v.messageId + '\');"></i>';
                    } else {
                        content += '<i id="opt_top_' + v.messageId + '" rel="1" style="color:#00a73c;" class="fa fa-step-forward fa-rotate-270" title="置顶"  onclick="doTop(\'' + v.messageId + '\');"></i>';
                    }
                    content += '</li>';
                    }
                    content += '</ul>';
                });
            }
            if (content == '') {
                content = '<ul><li style="width: 100%;color:#f47469;">暂无数据，请创建公告!</li></ul>';
            }
            $("#contentList").html(content);
            $("#currentPage").val(data.page);
            createPageBar(data.total, data.pageSize, data.page, data.totalPage);
        }, 'json');
    }
    // 获取公告栏目列表
    function getNoticeBoardList() {
        var page = $("#page1").val();
        var loadIdx = layer.load(0);
        $("#noticeBoardList").empty();

        $.post("<?php echo U('Office/searchNoticeBoard');?>", {"page":page}, function(data) {
            if (!("list" in data)) {
                layer.close(loadIdx);
                layer.msg(data.error_text,{icon: 8});
                return;
            }
            var content = "";

            // 设定用户列表
            $.each(data.list, function(k, v) {
                content += '<ul>';
                content += '<li style="width: 5%;">'+ (k+1) +'</li>';
                content += '<li style="width: 25%;" title="'+ v.boardName +'">'+ v.boardName +'&nbsp;</li>';
                content += '<li style="width: 40%;" title="'+ v.maintainerStr +'">'+ v.maintainerStr +'&nbsp;</li>';
                content += '<li style="width: 5%;">'+ v.noticeCount +'&nbsp;</li>';
                content += '<li style="width: 15%;">'+ v.createDate +'&nbsp;</li>';
                content += '<li style="width: 10%;">';
                content += '<li id="" style="width: 10%;">';
                content += '<i style="color: #4f88b5;cursor: pointer;" class="fa fa-edit" onclick="editNoticeBoard(\''+ v.boardId +'\');" title="编辑"></i>';
                content += '<i style="color:#de2e2f;padding-left: 15px;cursor: pointer;" class="fa fa-trash" onclick="deleteNoticeBoard(\''+ v.boardId +'\');" title="删除"></i>';
                content += '</li></li>';
                content += '</ul>';
            });
            if (content == "") {
                content = '<ul>';
                content += '<li style="width:100%;color:#f47469;">无数据!</li>';
                content += '</ul>';
            }
           $("#noticeBoardList").append(content);
           createPageBar1(data.total, data.pageSize, data.page, data.totalPage);
           layer.close(loadIdx);
        }, 'json'); 
    }
    // 编辑公告栏目
    function editNoticeBoard(boardId) {
        var url = APP+'/Home/Office/noticeBoardDetail?boardId='+boardId;
        window.location.href = url;
    }
    // 删除公告栏目
    function deleteNoticeBoard(boardId) {
        if(!confirm("确定删除该条公告栏目？")){
            return false;
        }
        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/delNoticeBoard');?>", {'boardId':boardId}, function(data) {
            layer.close(loadIdx);
            if (data.error_code == "success") {
                getNoticeBoardList();
            } else if (data.error_code == "101012") {
                layer.msg(data.error_text,{icon: 8});
            } else {
                layer.msg("删除失败",{icon: 8});
            }
        }, 'json');
    }
    function createPageBar(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar");
    }
    function createPageBar1(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        getPageBar1("pagebar1");
    }
</script>
</body>
</html>