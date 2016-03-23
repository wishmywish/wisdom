<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <!--<script src="/wisdom/Public/static/js/tealeaf.js"></script>-->
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

                <!--<div class="search">-->
                    <!--<div class='input_input'><input type="text" name="search_text" id="search_text"></div>-->
                    <!--<div class="input_icon"><span class="fa fa-search fa-lg"></span></div>-->
                <!--</div>-->

                <div class="personal_info">
                    <div  style="width:100%;"><div class="pro_img"><img style="height: 35px;" src="/wisdom/Public/Home/Default/images/user2.jpg"></div><div><?php echo empty(cookie("trueName"))?cookie("mobile"):cookie("trueName"); ?><b class="caret"></b></div></div>
                    <div class="personal_info_set">
                       <ul>
<!--                        <li>帮助</li>-->
                       
                        <?php if( !in_array("e1",$access_array) ){ echo "<!--"; } ?><li onclick="location.href = APP+'/Admin/Group/index'">企业设置</li>
                                                                               <?php if( !in_array("e1",$access_array) ){ echo "-->"; } ?></li>
                        <li onclick="location.href = APP+'/Home/Business/index'">返回首页
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
            $(".personal_info").mouseover(function(event) {
                $(".personal_info_set").show();
            });
            $(".personal_info").mouseout(function(event){
                $(".personal_info_set").hide();
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
            消息
        </div>
    </div>
    <div class="message_center">
        <!--输入框-->
        <div class="message_head">
            <span style="display: inline-block;">首页&nbsp;>&nbsp;消息</span>
            <div class="column">
                <span style="float: left;">筛选：</span>
                <!-- 员工部门-->
                <div class="personmsg">
                    <ul>
                        <li>
                            <label>范围&nbsp;</label>
                            <select id="searchBoard">
                                <option value="">--请选择--</option>
                                <?php if(is_array($queryAllmessageBoard_list)): $i = 0; $__LIST__ = $queryAllmessageBoard_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["boardId"]); ?>"><?php echo ($vo["boardName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </li>
                        <li>
                            <label style="height: 25px;">发起时间&nbsp;</label>
                            <!--<input id="searchSubject" type="text" />-->
                            <input id="startdate"  name="startdate" class="laydate-icon"  style="width: 150px; height: 25px;" value=<?php echo ($startdate); ?> >
                            &nbsp;至&nbsp;
                            <input id="enddate"  name="enddate" class="laydate-icon"   style="width: 150px; height: 25px;" value=<?php echo ($enddate); ?> >
                        </li>
                    </ul>
                    <form id="searchForm">
                        <input type="hidden" id="currentPage" name="page" value="<?php echo ($getmessageList_page); ?>" />
                        <input type="hidden" id="hidSearchSubject" name="subject" value="" />
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
                <?php for($i=0;$i<4;$i++){?>
                <ul id="message_list_<?php echo $i?>">
                    <img src="/wisdom/Public/Home/Default/images/touxiang.jpg" width="50" height="50" />
                    <div class="msgList">
                        <?php for($j=0;$j<4;$j++){?>
                        <div>
                            <li>
                                <div>
                                    <span style="margin-right: 15px;">董如赞</span>
                                    <span>2015-01-02 00:00:00&nbsp;<a style="margin-left: 18px;" href="#">附件</a></span>
                                </div>
                                <div>
                                    <span>今天进行了会议确认需求<a>@天天@飞飞@等等</a></span>
                                    <p>
                                        <a>
                                    <span style="margin-top: -11px;" class="fa-stack fa-lg">
                                        <i  class="fa fa-comment fa-stack-1x"></i>
                                        <i class="fa fa-ellipsis-h fa-fw  fa-stack-1x fa-inverse"></i>
                                    </span>
                                            <span style="margin-left: -5px;margin-top: -11px;" onclick="replyMessage();">回复</span>
                                        </a>
                                    </p>
                                </div>

                            </li>
                        </div>
                        <?php }?>
                        <li>
                            <textarea class="comment" placeholder="我也说一句"></textarea>
                            <input type="button" style="float: left;width: 70px;height: 25px;cursor: pointer;color: #fff;border: 1px none;background:#14bce1;margin: 0 12px;" value="评论">
                        </li>
                    </div>
                </ul>
                <?php }?>
            </div>
            <div id="pagebar" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA;float: left;"></div>
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
            Cookie.createCookie("smallMenuIndex",0);
            createPageBar('<?php echo ($getmessageList_total); ?>', '<?php echo ($getmessageList_pageSize); ?>', '<?php echo ($getmessageList_page); ?>', '<?php echo ($getmessageList_totalPage); ?>');
            $(document).on('click','#pagebar span a', function() {
                $("#currentPage").val($(this).attr("rel"));
                getmessageList();
            });
        });

        function doClear() {
            $("#searchSubject").val("");
            $("#searchBoard").val("");
        }

        function doSearch() {
            $("#currentPage").val("1");
            $("#hidSearchSubject").val($("#searchSubject").val());
            $("#hidSearchBoard").val($("#searchBoard").val());
            getmessageList();
        }

        //新增消息
        function addMessage(){
            layer.open({
                type:2,
                title :['新增消息','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
                area: ['900px', '505px'],
                shadeClose: false, //点击遮罩关闭
                content: APP+'/Home/Office/addMessage'
            });
        }

        //回复消息
        function replyMessage(){
            layer.open({
                type:2,
                title :['回复消息','color:#506390;font-size: 16px;height: 45px;line-height: 45px;padding-left:20px;'],
                area: ['900px', '505px'],
                shadeClose: false, //点击遮罩关闭
                content: APP+'/Home/Office/replyMessage'
            });
        }

        function createPageBar(t,ps,p,tp) {
            total = t;                  //总记录数
            pageSize = ps;              //每页显示条数
            page = parseInt(p);         //当前页
            totalPage = parseInt(tp);   //总页数
            getPageBar1("pagebar");
        }
    </script>
    </body>
    </html>