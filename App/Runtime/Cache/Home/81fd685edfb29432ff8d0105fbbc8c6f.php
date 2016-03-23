<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
        /*清除默认样式*/
        body,h1,ul,li,p,img,div,dl,dd,dt,span,a{ margin: 0; padding: 0; list-style: none;}
        /*公共的样式*/
        a{ text-decoration: none; color: #646464; margin-left: 20px;}
        body{ font-family: '宋体'; color: #646464; font-size: 14px;}
        textarea{font-family: '宋体'; color: #646464; font-size: 14px;border: 1px solid #a9a9a9;}
        input,select{border: 1px solid #a9a9a9;color: #646464;}
        .fl{ float: left;}
        .rg{float:right;}
        /*主体*/
        .main{overflow: hidden;width: 100%; }
        .main ul{margin-top: 20px;width: 100%;margin-left: 45px;}
        .main span{text-align: right;display: inline-block;margin-right: 7px;float: left;line-height: 25px;width: 60px;}
        .main select{width: 100px;height: 29px;}
        .main ul input{height: 20px;}
        .main ul li{ float: left;}
        #fjList{width: 600px;min-height: 60px;margin-left: 57px;}
        #fjList li{width: 500px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
        .fj p{ margin: 0 0 5px;text-decoration: underline;}
        .buts{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .fi-list{  line-height: 25px;  margin-left: 10px;  overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap;  width: 115px;  }
       .fj-but {  background: #d3edfb none repeat scroll 0 0;  border: 1px solid #eaeaea;  border-radius: 4px;  color: #898989;  float: left; margin-left: 15px; height: 25px;  line-height: 25px; position: relative;  width: 40px;  }
        .fj-but li{position: relative;float: left;top: 7px;left: 7px;cursor: pointer;}
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
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
</head>
<body>
<div class="main">
    <ul class="fl">
       <li>
           <span>消息内容</span>
           <textarea style="float:left;height: 200px; width: 600px;" id="content"></textarea>
           <p style="float: right;margin: 190px 0 0 10px;color: red;">不超过（500字）</p>
       </li>
    </ul>
    <ul class="fl">
        <li style="position: relative;">
            <span>发送到</span>
            <input id="deptNames" name="deptNames" style="height: 25px;margin-right: 16px;width: 608px;text-overflow: ellipsis;cursor: pointer;" type="search" placeholder="    请选择范围" readonly="readonly" value="" onclick="selectDeptNames();">
            <span style="position: absolute;top: 0px;left: 605px;" class="fa fa-search fa-lg" onclick="selectDeptNames();"></span>
        </li>
    </ul>
    <!--<ul id="dailydate" >-->
        <!--<span>日期</span>-->
        <!--<input id="date" name="date" class="laydate-icon" value="" placeholder="请选择日期" style="width: 155px;margin-right:28px;padding-left: 15px;height: 25px;">-->
    <!--</ul>-->
    <!--<ul  style="display: none;" id="weekdate">-->
        <!--<span>起始时间</span>-->
        <!--<input id="startDate3" name="startDate" class="laydate-icon" value="" placeholder="起始时间" style="width: 100px;height:25px;margin-right:28px;padding-left: 15px;">-->
        <!--<span>终止时间</span>-->
        <!--<input id="endDate3" name="endDate" class="laydate-icon" value="" placeholder="终止时间" style="width: 100px;height:25px;padding-left: 15px;margin-right: 32px;">-->
    <!--</ul>-->
    <!--<ul>-->
        <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;发送到</span>-->
        <!--<input id="userNames" name="recorderName" style="line-height: 30px;width:100px;padding-left: 15px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;}" type="text" placeholder="+发送到" readonly="readonly" value="<?php echo ($getWorkSet_userNames); ?>"><span style="padding-left: 15px;color: #898989;cursor: pointer;" class="fa fa-plus-square fa-lg" onclick="selectUsers();"></span>-->
    <!--</ul>-->
    <ul class="fl">
        <div class="fj-but">
            <li class="fa fa-paperclip fa-fw fa-lg" onclick="$('#upfile').click();"></li>
        </div>
        <!--此处新增一个附件，显示一个附件名称，附件数量5个-->
        <p style="float: left;margin: 5px 0px 0 10px;color: red;">只能上传jpg/png/gif格式的图片，最多可上传5个附件。</p>
        <div id="fjList"></div>


    </ul>
    <ul class="fl">
        <div class="fj-but">
            <li class="fa fa-at fa-fw fa-lg" onclick="selectUsers();"></li>
        </div>
        <div id="userList" style="float:left;width: 600px;height:80px;padding: 0 10px;overflow-y: auto;"></div>
    </ul>
    <input type="hidden" id="userIds" name="userIds" value="" />
    <input type="hidden" id="userNames" name="userNames" value="" />
    <input type="hidden" id="deptIds" name="deptIds" value="" >  
    <input type="hidden" id="returnUrl" name="returnUrl" value="" />
    <div style="text-align: center;">
        <button class="buts" onclick="doSave();">提交</button>
        <button class="buts" style="background: #eaeaea; color: #595857;" onclick="reset();">取消</button>
    </div>
    <form style="display:none;" id="upfileForm" action="<?php echo U('Api/Upfile/upF/type/4');?>" method="post" enctype="multipart/form-data">
        <input type="file" id="upfile" name="upfile" accept="image/*" />
    </form>
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
    $(function(){
        $(".nav li").click(function(){
            var myindex=$(this).index();
            $(this).addClass("cur").siblings().removeClass("cur");
            $(".list .content").eq(myindex).addClass("cur1").siblings().removeClass("cur1");
        });
    })

    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

    function doSave() {
        var loadIdx = layer.load(0);

        // 消息内容check
        var contentObj = $("#content");
        var content = $("#content").val();
        if (getValLen(contentObj) == 0) {
            layer.msg("消息内容不能为空",{icon: 8});
            contentObj.focus();
            return false;
        } else if (getValLen(contentObj) > 500) {
            layer.msg("消息内容最多为500字",{icon: 8});
            contentObj.focus();
            return false;
        }

        // 部门check
        var deptObj = $("#deptIds");
        var deptIds = $("#deptIds").val();
        var deptList = deptIds.split(",");
        if (getValLen(deptObj) == 0) {
            layer.msg("请选择发送的部门",{icon: 8});
            return false;
        } else if (deptList.length > 50) {
            layer.msg("部门最多为50个",{icon: 8});
            return false;
        }

        // 附件check
        var attachPaths = $("#returnUrl").val();
        var attachPathList = attachPaths.split(",");
        if (attachPathList.length > 5) {
            layer.msg("附件最多为5个",{icon: 8});
            return false;
        }

        // 用户check
        var userIds = $("#userIds").val();
        var userIdList = userIds.split(",");
        if (userIdList.length > 200) {
            layer.msg("用户最多为200个",{icon: 8});
            return false;
        }

        $.post("<?php echo U('Office/saveMessage');?>", {"content":content, "deptIds":deptIds, "attachPaths":attachPaths, "userIds":userIds}, function(data) {
            
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("添加成功",{icon: 8});
                parent.doSearch();
                var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                parent.layer.close(index);
            } else {
                layer.msg(data.error_text,{icon: 8});
            }
        }, 'json');  
    }

    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }

    $("#upfile").change(function(){
        var returnUrl = $("#returnUrl").val();
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
        var returnUrl = $("#returnUrl").val();
        var fjList = $("#fjList").html();
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

                    if(returnUrl != "") {
                        returnUrl += ",";
                    }
                    returnUrl += data.upfile.savepath + data.upfile.savename;
                    $("#returnUrl").val(returnUrl);

                    fjList += '<li class="'+ showClass +'" title="' + data.upfile.name + '" id="'+ showId +'">&emsp;<i style="cursor: pointer;color: #f47469;" class="fa fa-remove" class="" onclick="removeUpFile(this);"></i>' + data.upfile.name + '</li>';
                    $("#fjList").html(fjList);

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
        var returnUrl = $("#returnUrl").val();

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/removeUpFile');?>", {"fileName":showClass}, function(data) {
            if(data.error_code == "success") {
                layer.close(loadIdx);
                layer.msg("删除成功");
                var returnUrlList = returnUrl.split(',');
                for(var i = 0; i < returnUrlList.length; i ++ ) {
                    if(returnUrlList[i] == showClass) {
                        returnUrlList.splice(i, 1);
                    }
                }
                returnUrl = returnUrlList.join(",");
                $("#returnUrl").val(returnUrl);
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

    function selectDeptNames() {
        var deptNames = $("#deptNames").val();
        var deptIds = $("#deptIds").val();
        layer.open({
            type:2,
            title :['选择部门','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['400px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectDepts');?>" + "?deptNames=" + deptNames + "&deptIds=" + deptIds,
        });
    }
    
    //选择用户
    function selectUsers() {
        var userNames = $("#userNames").val();
        var userIds = $("#userIds").val();
        layer.open({
            type:2,
            title :['选择用户','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectUsers');?>" + "?userNames=" + userNames + "&userIds=" + userIds,
        });
    }
</script>
</body>
</html>