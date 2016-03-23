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
        .main ul{margin-top: 20px;width: 100%;margin-left: 57px;}
        .main span{text-align: right;display: inline-block;margin-right: 7px;float: left;line-height: 25px;}
        .main select{width: 100px;height: 29px;}
        .main ul input{height: 20px;float: left;}
        .main ul li{ float: left;}
        .main table{float: left;width: 510px;background:#eee;border: 1px solid #a9a9a9;border-collapse: collapse;text-align: center;margin: 0 0 30px 0;}
        .main table tr td{border: 1px solid #a9a9a9;line-height: 20px;}
        .main table tr th{border: 1px solid #a9a9a9;font-weight: normal;}
        .fj p{ margin: 0 0 5px;text-decoration: underline;}
        .buts{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .fi-list{  line-height: 25px;  margin-left: 10px;  overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap;  width: 115px;  }
       .fj-but {  background: #d3edfb none repeat scroll 0 0;  border: 1px solid #eaeaea;  border-radius: 4px;  color: #898989;  float: left; margin-left: 18px;  height: 25px;  line-height: 25px; position: relative;  width: 40px;  }

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
           <span>日志内容</span>
           <textarea style="float:left;height: 200px; width: 500px;background: #eeeeee;" disabled="disabled" ><?php echo str_replace("％", '%', $work_report['list']['reportContent']); ?></textarea>
           <!--<p style="float: right;margin: 190px 0 0 10px;color: red;">不超过（500字）</p>-->
       </li>
    </ul>
    <ul class="fl">
        <!--<span>任务执行人</span>-->
        <!--<input style="width: 83%;padding-left: 15px;line-height: 25px;font-size: 12px;border: 1px solid #eaeaea;" type="text" placeholder="+任务执行人">-->
        <li style="margin-bottom:20px;width: 100%;margin-left: 58px;" >
            <input type="radio" id="dailyRecord" name="reportType" value="1" <?php if($work_report['list']['reportType'] == 1) { echo 'checked="checked"';} ?> disabled="disabled" /><span style="margin-right:20px">日报</span>
            <input type="radio" id="weeklyRecord"  name="reportType" value="2" <?php if($work_report['list']['reportType'] == 2) { echo 'checked="checked"';} ?> disabled="disabled" /><span  style="margin-right:20px">周报</span>
            <input type="radio" id="monthlyRecord"  name="reportType" value="3"<?php if($work_report['list']['reportType'] == 3) { echo 'checked="checked"';} ?> disabled="disabled" /><span style="margin-right:20px">月报</span>
        </li>
    </ul>
    <ul id="dailydate" <?php if($work_report['list']['reportType'] == 2) { echo 'style="display: none;"';} ?>>
        <span style="margin-left: 30px;">日期</span>
        <input id="date" name="date" class="laydate-icon" value="<?php echo ($work_report["list"]["startDate"]); ?>" placeholder="请选择日期" disabled="disabled" style="width: 155px;margin-right:28px;padding-left: 15px;height: 25px;background: #eeeeee;">
    </ul>
    <ul id="weekdate" <?php if($work_report['list']['reportType'] != 2) { echo 'style="display: none;"';} ?>>
        <span>起始时间</span>
        <input id="startDate3" name="startDate" class="laydate-icon" value="<?php echo ($work_report["list"]["startDate"]); ?>" placeholder="起始时间" disabled="disabled" style="width: 100px;height:25px;margin-right:28px;padding-left: 15px;background: #eeeeee;">
        <span>终止时间</span>
        <input id="endDate3" name="endDate" class="laydate-icon" value="<?php echo ($work_report["list"]["endDate"]); ?>" placeholder="终止时间" disabled="disabled" style="width: 100px;height:25px;padding-left: 15px;margin-right: 32px;background: #eeeeee;">
    </ul>
    <!--<ul>-->
        <!--<span>&nbsp;&nbsp;&nbsp;&nbsp;发送到</span>-->
        <!--<input id="userNames" name="recorderName" style="line-height: 30px;width:100px;padding-left: 15px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;}" type="text" placeholder="+发送到" readonly="readonly" value="<?php echo ($getWorkSet_userNames); ?>">-->
    <!--</ul>-->
    <ul class="fl">
        <div class="fj-but">
            <li  style="position: relative;float: left;top: 7px;left: 7px;" class="fa fa-paperclip fa-fw fa-lg"></li>
        </div>
        <?php if(!empty($attach_list["list"])): if(is_array($attach_list["list"])): $i = 0; $__LIST__ = $attach_list["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attach): $mod = ($i % 2 );++$i;?><li class="fi-list" title="<?php echo ($attach["displayName"]); ?>"><a href="javascript:void();" onclick="javascript:doDownload('<?php echo ($attach["fileUrl"]); ?>');"><?php echo ($attach["displayName"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </ul>
    <ul class="fl">
        <li>
            <span>批复意见</span>
            <table border="0" cellpadding="0" cellspacing="0">
                <tr style="height: 25px;">
                    <th width="207" height="25">姓名</th>
                    <th width="540">内容</th>
                    <th width="300">时间</th>
                </tr>
                <?php if(!empty($comment_list["list"])): if(is_array($comment_list["list"])): $i = 0; $__LIST__ = $comment_list["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><tr style="height: 50px;">
                    <td><?php echo ($comment["userName"]); ?></td>
                    <td><?php echo ($comment["content"]); ?></td>
                    <td><?php echo ($comment["addTime"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </table>
        </li>
    </ul>
    <!--  
    <?php if(($work_report["list"]["state"]) == "2"): endif; ?>
    -->
    <ul class="fl">
        <li>
            <span>审批意见</span>
            <textarea style="float:left;height: 100px; width: 500px;" id="content"></textarea>
            <p style="float: right;margin: 106px 0 0 -96px;color: red;">不超过（500字）</p>
        </li>
    </ul>
    <input type="hidden" id="reportID" value="<?php echo ($reportID); ?>">
    <div style="text-align: center;width: 100%;float: left;">
        <button class="buts" onclick="doSave();">提交</button>
        <button class="buts" style="background: #eaeaea; color: #595857;" onclick="doCancel();">取消</button>
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
    // 日志不同类型的加载显示
    $("#dailyRecord,#monthlyRecord").click(function(){
        $("#weekdate").hide();
        $("#dailydate").show();
    });
    $("#weeklyRecord").click(function(){
        $("#dailydate").hide();
        $("#weekdate").show();
    });


    function doSave() {
        var contentObj = $("#content");
        var length = $.trim(contentObj.val()).length;
        var content = $("#content").val();
        var reportID = $("#reportID").val();

        if (length == 0) {
            layer.msg("审批意见不能为空",{icon: 8});
            return false;
        } else if (length > 500) {
            layer.msg("审批意见最多为500字",{icon: 8});
            return false;
        }

        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/saveWorkReportComment');?>", {"reportID":reportID, "content":content}, function(data) {

            parent.searchSubmit('4');

            layer.close(loadIdx);
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
            parent.layer.close(index);
        }, 'json');
    }

    function doCancel(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

    function doDownload(fileUrl) {
        var url = APP+'/Home/Office/downloadAttachFile?fileUrl='+fileUrl;
        window.open(url, '_blank');
    }
</script>
</body>
</html>