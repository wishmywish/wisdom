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
                <?php if( !in_array("e1",$access_array) ){ echo "<!--"; } ?>
                <span style="position: absolute;right: 520px;" onclick="location.href = APP+'/Admin/Group/index'">企业资料维护</span>
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
        <div class='org_box org_box_select' onclick="getMessageList();">
            <span class='org_bot_cor'></span>
            消息
        </div>
    </div>
    <div class="message_center">
        <!--输入框-->
        <div class="message_head">
            <span style="display: inline-block;">消息</span>
            <div class="column">
                <span style="float: left;">筛选：</span>
                <!-- 员工部门-->
                <div class="personmsg">
                    <ul>
                        <li>
                            <label>范围&nbsp;</label>
                            <select id="searchBoard">
                                <!-- <option value="">--请选择--</option>
                                <?php if(is_array($queryAllmessageBoard_list)): $i = 0; $__LIST__ = $queryAllmessageBoard_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["boardId"]); ?>"><?php echo ($vo["boardName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> -->
                                <option value="1">全部</option>
                                <option value="2">我发起的</option>
                                <option value="3">@我的</option>
                            </select>
                        </li>
                        <li>
                            <label style="height: 25px;">发起时间&nbsp;</label>
                            <!--<input id="searchSubject" type="text" />-->
                            <input id="startDate" class="laydate-icon" value="" placeholder="起始时间" style="width: 125px;padding-left: 8px;height:25px;">
                            &nbsp;至&nbsp;
                            <input id="endDate" class="laydate-icon" value="" placeholder="终止时间" style="width: 125px;padding-left: 8px;height: 25px;">
                        </li>
                    </ul>
                    <form id="searchForm">
                    <input type="hidden" id="currentPage" name="page" value="" />
                    <input type="hidden" id="hidStartDate" name="startDate" value="" />
                    <input type="hidden" id="hidEndDate" name="endDate" value="" />
                    <input type="hidden" id="hidSearchBoard" name="boardId" value="" />
                    </form>
                </div>
                <!-- 按钮-->
                <p style="height: 25px;float: right;margin-right: 8px;">
                    <input id="searchButton" class="bntns" type="button" value="搜索" onclick="doSearch();" />
                    <input id="resetButton" class="bntns" type="button" value="清空" onclick="doClear();" />
                </p>
            </div>
            <div class="addbtn">
                <p> <input class="bntns1" type="button" value="新增" onclick="addMessage();"/> </p>
            </div>
        </div>
        <!--列表-->
        <div class="message_list">
            <div id="contentList" class="contentList">
                <?php if(!empty($message_list["messageList"])): if(is_array($message_list["messageList"])): $i = 0; $__LIST__ = $message_list["messageList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?><ul id="message_list_<?php echo ($i-1); ?>">
                        <img src="<?php echo ($message["headLogo"]); ?>" width="50" height="50" />
                        <div class="msgList">
                            <div>
                                <li>
                                    <div>
                                        <span style="margin-right: 15px;color: #14bce1;"><?php echo ($message["userName"]); ?></span>
                                        <span><?php echo ($message["createTime"]); ?>&nbsp;</span>
                                    </div>
                                    <div><span class="msg_content1"><?php echo ($message["mesContent"]); ?></span></div>
                                </li>
                            </div>
                            <?php if(!empty($message["commentList"])): if(is_array($message["commentList"])): $i = 0; $__LIST__ = $message["commentList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><br/>
                            <div>
                                <li>
                                    <div>
                                        <span style="margin-right: 15px;color: #14bce1;"><?php echo ($comment["userName"]); ?></span>
                                        <span><?php echo ($comment["createTime"]); ?></span>
                                    </div>
                                    <div>
                                        <span class="msg_content2"><?php echo ($comment["commentContent"]); ?></span>
                                        <p><a>
                                            <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                                <i  class="fa fa-comment fa-stack-1x"></i>
                                                <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                            </span>
                                            <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage(<?php echo ($message["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($comment["commentUserId"]); ?>);">回复</span>
                                        </a></p>
                                    </div>
                                </li>
                                <?php if(!empty($comment["replyList"])): if(is_array($comment["replyList"])): $i = 0; $__LIST__ = $comment["replyList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?><li style="margin-left:55px;">
                                    <div>
                                        <span style="margin-right: 15px;color: #14bce1;"><?php echo ($reply["userName"]); ?> <i style="color: #999;">回复</i> <?php echo ($reply["replyToUserName"]); ?></span>
                                        <span><?php echo ($reply["createTime"]); ?></span>
                                    </div>
                                    <div>
                                        <span class="msg_content3"><?php echo ($reply["replyContent"]); ?></span>
                                        <p><a>
                                            <span style="margin-top: -13px;" class="fa-stack fa-lg">
                                                <i  class="fa fa-comment fa-stack-1x"></i>
                                                <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                            </span>
                                            <span style="margin-left: -5px;margin-top: -13px;" onclick="replyMessage(<?php echo ($message["mesId"]); ?>, <?php echo ($comment["commentId"]); ?>, <?php echo ($reply["replyUserId"]); ?>);">回复</span>
                                        </a></p>
                                    </div>
                                </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            <br/>
                            <li>
                                <textarea class="comment" placeholder="我也说一句" id="commentContent_<?php echo ($message["mesId"]); ?>"></textarea>
                                <input type="button" style="float: left;width: 70px;height: 25px;cursor: pointer;color: #fff;border: 1px none;background:#14bce1;margin: 0 12px;" value="评论" onclick="addComment(<?php echo ($message["mesId"]); ?>);">
                            </li>
                            <div class="showfujian">
                                <?php if($message['attachList'] != "") { foreach($message['attachList'] as $value) { echo '<a style="margin-left: 18px;" href="javascript:void();"  title="'.$value['displayName'].'"onclick="javascript:doDownload(\''.$value['url'].'\');">'.$value['displayName'].'</a>'; } } ?>
                            </div>
                        </div>
                    </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <?php if(empty($message_list["messageList"])): ?><ul class="topnone"><li style="width: 100%;color:#f47469;">暂无数据!</li></ul><?php endif; ?>
            </div>
            <div id="pagebar" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA;float: left;"></div>
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
    //评论框高度处理
    $(document).ready(function(){
        // 输入框获取焦点事件
        $(".comment").focus(function() {
            $(this).height("70px");
        });
        // 输入框失去焦点事件
        $(".comment").blur(function() {
            if(!$(this).val()){
                $(this).height("25px");
            }
        });
    });
    $(function(){
        Cookie.eraseCookie("bigMenuIndex");
        Cookie.eraseCookie("smallMenuIndex");
        Cookie.createCookie("bigMenuIndex",0);
        Cookie.createCookie("smallMenuIndex",6);

        createPageBar('<?php echo ($message_list["total"]); ?>', '<?php echo ($message_list["pageSize"]); ?>', '<?php echo ($message_list["page"]); ?>', '<?php echo ($message_list["totalPage"]); ?>');
        $(document).on('click','#pagebar span a', function() {
            $("#currentPage").val($(this).attr("rel"));
            getMessageList();
        });

        var start = {
            elem: '#startDate',
            format: 'YYYY-MM-DD',
            min: '1800-01-01',
            max: '2099-06-16', //最大日期
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
            min: '1800-01-01',
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

    // 点击清空按钮
    function doClear() {
        $("#searchBoard").val("1");
        $("#startDate").val("");
        $("#endDate").val("");
    }

    // 点击检索按钮
    function doSearch() {
        $("#currentPage").val("1");
        $("#hidStartDate").val($("#startDate").val());
        $("#hidEndDate").val($("#endDate").val());
        $("#hidSearchBoard").val($("#searchBoard").val());
        getMessageList();
    }

    // 重新生成事件
    function reloadFocus() {
        // 输入框获取焦点事件
        $(".comment").focus(function() {
            $(this).height("70px");
        });
        // 输入框失去焦点事件
        $(".comment").blur(function() {
            if(!$(this).val()){
                $(this).height("25px");
            }
        });
    }

    // 查询数据
    function getMessageList() {
        var loadIdx = layer.load(0);
        var page = $("#currentPage").val();
        var startDate = $("#hidStartDate").val();
        var endDate = $("#hidEndDate").val();
        var type = $("#hidSearchBoard").val();

        $.post("<?php echo U('Office/queryMessageList');?>", {"page":page, "startDate":startDate, "endDate":endDate, "type":type}, function(data) {
            var content = "";
            $("#contentList").empty();
            
            if (!("messageList" in data)) {
                content = '<ul class="topnone">';
                content += '<li style="width: 100%;color:#f47469;">暂无数据!</li>';
                content += '</ul>';

                $("#contentList").append(content);
                createPageBar(data.total, data.pageSize, data.page, data.totalPage);
                layer.close(loadIdx);
                return;
            }
            // 设定用户列表
            $.each(data.messageList, function(k, v) {
                content += '<ul id="message_list_'+ k +'">';
                var headLogo = v.headLogo;
                content += '<img src="'+ headLogo +'" width="50" height="50" />';
                content += '<div class="msgList"><div><li><div>';
                content += '<span style="margin-right: 15px;color: #14bce1;">'+ v.userName +'</span>';
                content += '<span>'+ v.createTime +'&nbsp;';
                content += '</span></div>';
                content += '<div><span class="msg_content1">'+ v.mesContent +'</span></div>';
                content += '</li></div>';

                $.each(v.commentList, function(c, comment) {
                    content += '<br/><div><li><div>';
                    content += '<span style="margin-right: 15px;color: #14bce1;">'+ comment.userName +'</span>';
                    content += '<span>'+ comment.createTime +'</span></div>';
                    content += '<div><span class="msg_content2">'+ comment.commentContent +'</span><p><a>';
                    content += '<span style="margin-top: -11px;" class="fa-stack fa-lg">';
                    content += '<i  class="fa fa-comment fa-stack-1x"></i>';
                    content += '<i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i></span>';
                    content += '<span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage('+ v.mesId +', '+ comment.commentId +', '+ comment.commentUserId +');">回复</span>';
                    content += '</a></p></div></li>';

                    $.each(comment.replyList, function(r, reply) {
                        content += '<li style="margin-left:55px;">';
                        content += '<div>';
                        content += '<span style="margin-right: 15px;color: #14bce1;">'+ reply.userName +' <i style="color: #999;">回复</i> '+ reply.replyToUserName +'</span>';
                        content += '<span>'+ reply.createTime +'</span></div>';
                        content += '<div><span class="msg_content3">'+ reply.replyContent +'</span><p><a>';
                        content += '<span style="margin-top: -11px;" class="fa-stack fa-lg">';
                        content += '<i  class="fa fa-comment fa-stack-1x"></i>';
                        content += '<i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i></span>';
                        content += '<span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage('+ v.mesId +', '+ comment.commentId +', '+ reply.replyUserId +');">回复</span>';
                        content += '</a></p></div></li>';
                    });
                    content += '</div>';
                });
                content += '<br><li>';
                content += '<textarea class="comment" placeholder="我也说一句" id="commentContent_'+ v.mesId +'"></textarea>';
                content += '<input type="button" style="float: left;width: 70px;height: 25px;cursor: pointer;color: #fff;border: 1px none;background:#14bce1;margin: 0 12px;" value="评论" onclick="addComment('+ v.mesId +');"/>';
                content += '</li>';
                content += '<div class="showfujian">';                       
                if(v.attachList) {
                    var attachList = v.attachList;
                    for (var m = 0; m < attachList.length; m ++) {
                        content += '<a style="margin-left: 18px;" href="javascript:void();"  title="'+ attachList[m]['displayName'] +'"onclick="javascript:doDownload(\''+ attachList[m]['url'] +'\');">'+ attachList[m]['displayName'] +'</a>';
                    }
                }
                content += '</div></div></ul>';
            });
            if (content == "") {
                content = '<ul class="topnone">';
                content += '<li style="width: 100%;color:#f47469;">暂无数据!</li>';
                content += '</ul>';
            }
            $("#contentList").append(content);
            createPageBar(data.total, data.pageSize, data.page, data.totalPage);
            layer.close(loadIdx);
            reloadFocus();
        }, 'json');
    }

    //新增消息
    function addMessage(){
        layer.open({
            type:2,
            title :['新增消息','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['900px', '605px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/addMessage'
        });
    }
    
    //回复消息
    function replyMessage(mesId, commentId, replyToUserId){
        layer.open({
            type:2,
            title :['回复消息','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
            area: ['660px', '290px'],
            shadeClose: false, //点击遮罩关闭
            content: APP+'/Home/Office/replyMessage?mesId='+mesId+'&commentId='+commentId+'&replyToUserId='+replyToUserId
        });
    }

    //添加评论
    function addComment(mesId) {
        // 评论内容check
        var contentObj = $("#commentContent_"+mesId);
        if (getValLen(contentObj) == 0) {
            layer.msg("评论不能为空",{icon: 8});
            contentObj.focus();
            return false;
        } else if (getValLen(contentObj) > 500) {
            layer.msg("评论最多为500字",{icon: 8});
            contentObj.focus();
            return false;
        }

        var commentContent = $("#commentContent_"+mesId).val();

        $.post("<?php echo U('Office/addComment');?>", {"commentContent":commentContent, "mesId":mesId}, function(data) {
            if(data.error_code == "success") {
                getMessageList();
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
        }, 'json');
    }

    function doDownload(fileUrl) {
        var url = APP+'/Home/Office/downloadAttachFile?fileUrl='+fileUrl;
        window.open(url, '_blank');
    }

    function createPageBar(t,ps,p,tp) {
        total = t;                  //总记录数
        pageSize = ps;              //每页显示条数
        page = parseInt(p);         //当前页
        totalPage = parseInt(tp);   //总页数
        $("#currentPage").val(page);
        getPageBar1("pagebar");
    }

    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }
</script>
</body>
</html>