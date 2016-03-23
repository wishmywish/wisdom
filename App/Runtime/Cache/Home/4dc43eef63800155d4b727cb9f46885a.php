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
        <div class='org_box org_box_select'>
            <span class='org_bot_cor'></span>
            新增公告
        </div>
    </div>
    <div class="notice_center">
        <!--输入框-->
        <div class="notice_head">
            <span style="display: inline-block;">公告&nbsp;>&nbsp;新增公告</span>
        </div>
        <p style="margin-bottom: 40px;"><input onclick="location.href='<?php echo U('Office/notice');?>'" type="button" value="返回" style="float:right;border: 1px; height: 25px;width: 70px;background: #14bce1;color: #fff; cursor: pointer;"></p>

        <!--列表-->
        <div class="notice_list">
            <div class="titleAdd">公告详情</div>
            <div class="contentListAdd">
                <form id="form">
                <div class="lineTop">
                    <span>公告主题</span>
                    <input id="subject" name="subject" style="width: 280px;" type="text"></div>
                <div class="lineTop">
                    <span>所属栏目</span>
                    <select id="boardId" name="boardId" style="width: 280px;height: 25px;">
                        <option value="">--请选择--</option>
                        <?php if(is_array($queryAllNoticeBoard_list)): $i = 0; $__LIST__ = $queryAllNoticeBoard_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["boardId"]); ?>"><?php echo ($vo["boardName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="lineTop">
                    <span>下达范围</span>
                    <select id="rangeId" name="rangeId" style="width: 280px;height: 25px;">
                        <option value="1" selected="selected">下达用户</option>
                        <option value="2">下达部门</option>
                    </select>
                </div>
                <div id="to_users" class="lineTop" style="display: block;">
                    <span style="float: left;">下达用户</span>
                    <textarea style="width: 580px;height: 80px;padding: 5px;"id="userNames" readonly="readonly"></textarea><div style="padding-left: 15px;color: #898989;cursor: pointer;" class="fa fa-plus-square fa-lg" onclick="selectUsers();"></div></div>
                <div id="to_depts" class="lineTop" style="display:none; ">
                    <span style="float: left;">下达部门</span>
                    <textarea  style="width: 580px;height: 60px;padding: 5px;" type="text" id="deptNames" readonly="readonly"></textarea><div style="padding-left: 15px;color: #898989;cursor: pointer;" class="fa fa-plus-square fa-lg" onclick="selectDepts();"></div></div>
                <div class="lineTop">
                    <span>公告内容</span>
                    <br>
                    <div class="editor" style="min-height:400px;margin-left:16px;margin-top: -13px;">
                        <script type="text/plain" id="editor" style="width:800px;min-height:400px;" name="content"></script>
                    </div>
                </div>
                <div class="lineTop">
                    <span>是否置顶</span>
                    <input id="top_1" name="isTop" style="height: auto;" type="radio" checked="checked" value="1" />
                    置顶
                    <input id="top_0" name="isTop" style="height: auto;" type="radio" value="0" />非置顶</div>
                    <input type="hidden" id="userIds" name="userIds" value="" />
                    <input type="hidden" id="deptIds" name="deptIds" value="" />
                    <input type="hidden" id="upfileOldName" name="upfileOldName" value="" />
                    <input type="hidden" id="upfileType" name="upfileType" value="" />
                    <input type="hidden" id="upfileSize" name="upfileSize" value="" />
                    <input type="hidden" id="upfileReturnUrl" name="upfileReturnUrl" value="" />
                </form>
                <div class="lineTop">
                    <span>附件</span>
                    <button class="bntns" onclick="$('#upfile').click();">上传附件</button>
                    <form style="display:none;" id="upfileForm" action="<?php echo U('Api/Upfile/upF/type/6');?>" method="post" enctype="multipart/form-data">
                        <input type="file" id="upfile" name="upfile" accept="image/*" />
                    </form>
                </div>
                <div id="showUpFile" class="showUpFile"><span style="display: inline-block;width: 350px;color: #f47469;">*只能上传doc/xls/ppt/txt/jpg/png/gif格式的图片，最多上传5个附件</span><br></div>
            </div>
            <div class="notice_btn">
                <button class="bntns" onclick="doSubmit();">提交</button>
                <button class="bntns" style="background: #fafafa;color: #595758;" onclick="location.href='<?php echo U('Office/notice');?>'">取消</button>
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
<script>
    $(function(){
    });
    // 下达范围不同的加载显示
    $("#rangeId").bind("change",function(){
        if($(this).val()==1){
            $("#to_depts").hide();
            $("#to_users").show();
        }
        else{
            $("#to_users").hide();
            $("#to_depts").show();
        }
    });

    function doSubmit() {
        var subjectObj = $("#subject");
        if (getValLen(subjectObj) == 0) {
            layer.msg("公告主题不能为空",{icon: 8});
            subjectObj.focus();
            return false;
        } else if (getValLen(subjectObj) > 64) {
            layer.msg("公告主题最多为64字",{icon: 8});
            subjectObj.focus();
            return false;
        }

        var boardIdObj = $("#boardId");
        if (getValLen(boardIdObj) == 0) {
            layer.msg("请选择所属栏目",{icon: 8});
            boardIdObj.focus();
            return false;
        }
        var rangeIdObj = $("#rangeId");
        if (getValLen(rangeIdObj) == 0) {
            layer.msg("请选择下达范围",{icon: 8});
            rangeIdObj.focus();
            return false;
        }
        var userIdsObj = $("#userIds");
        if (getValLen(userIdsObj) > 500) {
            layer.msg("下达用户选择过多，最多500字符",{icon: 8});
            userIdsObj.focus();
            return false;
        }

        var deptIdsObj = $("#deptIdsObj");
        if (getValLen(deptIdsObj) > 500) {
            layer.msg("下达部门选择过多，最多500字符",{icon: 8});
            deptIdsObj.focus();
            return false;
        }

        var contentObj = $("#umeditor_textarea_content");
        if (getValLen(contentObj) == 0) {
            layer.msg("公告内容不能为空",{icon: 8});
            contentObj.focus();
            return false;
        }

        var loadIdx = layer.load(0);
        var formData = $("#form").serializeArray();
        $.post("<?php echo U('Office/noticeAdd');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("成功", {time: 2*1000});
                location.href="<?php echo U('Office/notice');?>";
            } else{
                layer.msg("发送失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }

    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }

    function selectUsers() {
        var userNames = $("#userNames").val();
        var userIds = $("#userIds").val();
        layer.open({
            type:2,
            title :['发送到用户','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '400px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectUsers');?>" + "?userNames=" + userNames + "&userIds=" + userIds,
        });
    }

    function selectDepts() {
        var deptNames = $("#deptNames").val();
        var deptIds = $("#deptIds").val();
        layer.open({
            type:2,
            title :['发送到部门','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['400px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectDepts');?>" + "?deptNames=" + deptNames + "&deptIds=" + deptIds,
        });
    }

    $("#upfile").change(function(){
        var returnUrl = $("#upfileReturnUrl").val();
        var list = returnUrl.split(",");

        if(list.length >= 5) {
            layer.msg("最多上传5个附件",{icon: 8});
            return false;
        } else {
            fileUpload();
            // $("#upfile").val("");
        }
    });

    function fileUpload() {
        var showUpFile = $("#showUpFile").html();
        var upfileOldName = $("#upfileOldName").val();
        var upfileType = $("#upfileType").val();
        var upfileSize = $("#upfileSize").val();
        var upfileReturnUrl = $("#upfileReturnUrl").val();
        var loadIdx = layer.load(0);
        $("#upfileForm").ajaxSubmit({
            dataType:  "json", //数据格式为json 
            success: function(data) { //成功
                layer.close(loadIdx);
                if(data.error_no == "999999" || data.error_no == "123456" || data.error_no == "654321") {
                    layer.msg("上传失败 ("+data.error_txt+")",{icon: 8});
                } else {
                    layer.msg("上传成功");
                    var showClass = data.upfile.savepath + data.upfile.savename;
                    var savename = data.upfile.savename;
                    savename = savename.split('.');
                    var showId = savename[0];

                    if(upfileOldName != "") {
                        upfileOldName += ",";
                        upfileType += ",";
                        upfileSize += ",";
                        upfileReturnUrl += ",";
                    }
                    upfileOldName += data.upfile.name;
                    upfileType += data.upfile.type;
                    upfileSize += data.upfile.size;
                    upfileReturnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#upfileOldName").val(upfileOldName);
                    $("#upfileType").val(upfileType);
                    $("#upfileSize").val(upfileSize);
                    $("#upfileReturnUrl").val(upfileReturnUrl);

                    showUpFile += "<li class='"+ showClass +"' id='"+ showId +"'>";
                    showUpFile += data.upfile.name + " <i style='cursor: pointer;color: #f47469;' class='fa fa-remove' onclick='removeUpFile(this);'></i> </li>";

                    $("#showUpFile").html(showUpFile);
                }
            }, 
            error:function(xhr){
                layer.close(loadIdx);
                layer.msg("上传失败",{icon: 8});
            }
        });
    }
    function removeUpFile(obj) {
        var id = $(obj).parent().attr("id");
        var showClass = $(obj).parent().attr("class");
        var upfileOldName = $("#upfileOldName").val();
        var upfileType = $("#upfileType").val();
        var upfileSize = $("#upfileSize").val();
        var upfileReturnUrl = $("#upfileReturnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");

                var index = 0;
                var returnUrlList = upfileReturnUrl.split(',');
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        index = i;
                        returnUrlList.splice(i, 1);
                    }
                }
                upfileReturnUrl = returnUrlList.join(",");
                $("#upfileReturnUrl").val(upfileReturnUrl);

                var oldNameList = upfileOldName.split(',');
                oldNameList.splice(index, 1);
                upfileOldName = oldNameList.join(",");
                $("#upfileOldName").val(upfileOldName);

                var typeList = upfileType.split(',');
                typeList.splice(index, 1);
                upfileType = typeList.join(",");
                $("#upfileType").val(upfileType);

                var sizeList = upfileSize.split(',');
                sizeList.splice(index, 1);
                upfileSize = sizeList.join(",");
                $("#upfileSize").val(upfileSize);

                $('#'+id).remove();
            } else {
                layer.close(loadIdx);
                var message = "删除失败";
                if(data.error_code == "error1") {
                    message = "文件不存在";
                }
                layer.msg(message, {icon: 8});
            }
        }, 'json');
    }
</script>
</body>
</html>