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
        textarea[disabled]{ background: #fafafa;}
        input{border: 1px solid #a9a9a9;}
        input[disabled]{ background: #fafafa;}
        .fl{ float: left;}
        .rg{float:right;}
        /*主体*/
        .main{overflow: hidden;width: 100%; }
        .nav{float: left;  height: 25px;  margin: 20px 0 0 45px; width: 100%;}
        .nav ul li{display: inline-block;float: left;cursor: pointer;}
        .nav .cur{color: red;}
        .content{display: none;width: 100%;float: left;}
        .content table{float: left;width: 600px;border: 1px solid #e2e0e0;border-collapse: collapse;text-align: center;margin: 20px 0 60px 0;table-layout: fixed;}
        .content table  tr  td{border: 1px solid #e2e0e0;line-height: 20px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
        .content table  tr  th{border: 1px solid #e2e0e0;font-weight: normal;}
        .cur1{display: block;}
        .list{ margin: 0 0 0 45px;}
        .list ul{ margin-top:20px; width: 100%;}
        .list ul input{width: 65px;margin: 0 -2px;  background: #fafafa;height: 25px;}
        .list ul li{ float: left; margin-right: 7px;width: 600px;}
        .list ul li span{width: 100px;text-align: right;display: inline-block;margin-right: 7px;}
        .fj{float: right;width: 500px;margin-top: -18px;}
        .fj p{ margin: 0 0 0 -5px;text-decoration: underline;}
        .buts{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
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
   <div class="nav">
       <ul>
           <li class="cur">审批<span style="color: initial">&nbsp;|&nbsp;</span></li>
           <li>流程</li>
       </ul>
   </div>
    <div class="list">
        <div class="content cur1" style="margin-bottom:20px;">
           <ul class="fl">
               <li>
                   <span>请假内容</span>
                   <textarea style="float: right;height: 100px; width: 480px;" disabled="disabled"><?php echo ($leave_detail["formInfo"]["content"]); ?></textarea>
               </li>
           </ul>
            <ul class="fl">
                <li>
                    <span>请假类型</span>
                    <input type="text" disabled="disabled" value="<?php  switch ($leave_detail['formInfo']['leaveType']) { case '1': echo "事假"; break; case '2': echo "病假"; break; case '3': echo "年假"; break; case '4': echo "调休"; break; case '5': echo "婚假"; break; case '6': echo "产假"; break; case '7': echo "陪产假"; break; case '8': echo "路途假"; break; case '9': echo "其它"; break; default: echo "事假"; break; } ?>"/>
                </li>

            </ul>
            <ul class="fl">
                <li>
                    <span>起始时间</span>
                    <input id="startDate" value="<?php echo ($leave_detail["formInfo"]["beginDate"]); ?>" placeholder="起始时间" style="height: 25px;width: 110px;">
                    <span style="width: 80px;">终止时间</span>
                    <input id="endDate"  value="<?php echo ($leave_detail["formInfo"]["endDate"]); ?>" placeholder="终止时间" style="height: 25px;width: 110px;">
                    <span style="margin-left: 20px;width: 120px;text-align: left;">请假时长：<?php echo ($leave_detail["formInfo"]["duration"]); ?></span>
                </li>
            </ul>

            <ul class="fl">
                <li>
                    <span>附件</span>
                    <div class="fj">
                    <?php  if($leave_detail['attachList']) { foreach($leave_detail['attachList'] as $value) { echo '<p><a href="javascript:void();" onclick="javascript:doDownload(\''.$value['url'].'\');">'.$value['displayName'].'</a></p><br>'; } } ?>
                    </div>
                </li>
            </ul>

            <?php if($leave_detail['processStatus'] == '2' and $leave_detail['curProcessNodeOrder'] > '1'): ?><ul class="fl">
                <li>
                    <span>上一级审批人</span>&nbsp;<?php echo ($leave_detail["previousProcessNode"]["handlerUserName"]); ?>
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>上一级审批意见</span>
                    <textarea style="float: right;height: 60px;width: 480px;" disabled="disabled"><?php echo ($leave_detail["previousProcessNode"]["comment"]); ?></textarea>
                </li>
            </ul><?php endif; ?>
            <?php if($leave_detail['curHandlerUId'] == $userId) {?>
            <ul class="fl">
                <li>
                    <span>审批意见</span>
                    <textarea style="float: right;height: 100px;width: 480px;" id="comment"></textarea>
                    <p style="margin-left: 85%;margin-top: 95px;color: red;">不超过500字</p>
                </li>
            </ul>
            <?php }?>
            <input type="hidden" id="processId" value="<?php echo $leave_detail['processId'];?>">
            <div style="text-align: center;">
                <?php if($leave_detail['curHandlerUId'] == $userId) {?>
                <button class="buts" onclick="doSubmit(1);">同意</button>
                <button class="buts" onclick="doSubmit(2);">拒绝</button>
                <button class="buts" onclick="doSelectUser();">转批</button>
                <?php }?>
                <?php if($leave_detail['createUserId'] == $userId && ($leave_detail['processStatus'] == '1' || $leave_detail['processStatus'] == '2')) {?>
                <button class="buts" onclick="doSubmit(4);">撤销</button>
                <?php }?>
            </div>
        </div>
        <div class="content">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr style="height: 25px;">
                    <th width="50" height="25">序号</th>
                    <th width="100">审批人</th>
                    <th width="100">操作</th>
                    <th width="200">审批意见</th>
                    <th width="150">审批时间</th>
                </tr>
                <?php if(!empty($leave_detail["processNodeList"])): if(is_array($leave_detail["processNodeList"])): $i = 0; $__LIST__ = $leave_detail["processNodeList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nodeList): $mod = ($i % 2 );++$i; if($nodeList['processNodeStatus'] == '2') {?>
                <input type="hidden" id="processNodeId" value="<?php echo $nodeList['processNodeId'];?>">
                <?php }?>
                <tr style="height: 50px;">
                    <td><?php echo ($i); ?></td>
                    <td><?php echo ($nodeList["handlerUserName"]); ?></td>
                    <td><?php  if ($nodeList['personType']=="1" and $nodeList['processNodeOrder']=="0") { echo "发起申请"; }else{ switch ($nodeList['processNodeStatus']) { case '1': echo "待审批"; break; case '2': echo "审批中"; break; case '3': echo "审批通过"; break; case '4': echo "审批不通过"; break; case '5': echo "转发"; break; case '6': echo "撤销"; break; default: echo "待审批"; break; } } ?></td>
                    <td><font title="<?php echo ($nodeList["comment"]); ?>"><?php echo mb_substr($nodeList['comment'],0, 26,'utf-8');?></font></td>
                    <td><?php echo ($nodeList["createTime"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </table>
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
    $(function(){
        $(".nav li").click(function(){
            var myindex=$(this).index();
            $(this).addClass("cur").siblings().removeClass("cur");
            $(".list .content").eq(myindex).addClass("cur1").siblings().removeClass("cur1");
        })

    })

    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

    // 同意、拒绝、撤销
    function doSubmit(operateType) {
        var commentObj = $("#comment");
        var length = $.trim(commentObj.val()).length;

        if(operateType != 4) {
            if (length == 0) {
                layer.msg("审批意见不能为空",{icon: 8});
                return false;
            } 
        }
        if (length > 500) {
            layer.msg("审批意见最多为500字",{icon: 8});
            return false;
        }

        processNodeApproval(operateType);
    }

    // 转批选择用户
    function doSelectUser() {

        var processId = $("#processId").val();
        var processNodeId = $("#processNodeId").val();
        var comment = $("#comment").val();
        var page = "<?php echo ($page); ?>";

        var commentObj = $("#comment");
        var length = $.trim(commentObj.val()).length;

        if (length == 0) {
            layer.msg("审批意见不能为空",{icon: 8});
            return false;
        } else if (length > 600) {
            layer.msg("审批意见最多为600字",{icon: 8});
            return false;
        }

        layer.open({
            type:2,
            title :['转批人员','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['530px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectLeaveUser');?>" + "?processId=" + processId + "&processNodeId=" + processNodeId + "&comment=" + comment + "&operateType=3&page=" + page + "&busiType=3",
        });
    }

    // 流程节点审批
    function processNodeApproval(operateType) {
        var loadIdx = layer.load(0);
        var comment = $("#comment").val();
        var processId = $("#processId").val();
        var processNodeId = $("#processNodeId").val();

        $.post("<?php echo U('Office/processNodeApproval');?>", {"operateType":operateType, "processId":processId, "processNodeId":processNodeId, "comment":comment}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
                layer.close(loadIdx);
            } else {
                var busiType = 3;
                var page = "<?php echo ($page); ?>";
                var type = parent.$("#hidLType").val();
                var startDate = parent.$("#hidSDate2").val();
                var endDate = parent.$("#hidEDate2").val();
                var status = parent.$("#hidLStatus").val();

                parent.$("#leaveContentList").empty();

                $.post("<?php echo U('Office/getApprovalList');?>", {"busiType":busiType, "page":page, "type":type, "startDate":startDate, "endDate":endDate, "status":status}, function(data) {

                    var content = "";
                    // 设定用户列表
                    $.each(data.processList, function(k, v) {
                        content += '<ul>';
                        content += '<li style="width: 19%;">' + v.processNo + '</li>';

                        content += '<li style="width: 15%;cursor: pointer;" onclick="showLeaveDetail(\'' + v.processId + '\')" title="' + v.title + '"><a>' + v.title + '</a></li>';
                        content += '<li style="width: 25%;" title="' + v.formContent + '">' + v.formContent + '&nbsp;</li>';
                        content += '<li style="width: 8%;">' + v.applicantName + '&nbsp;</li>';
                        content += '<li style="width: 8%;">' + v.currentHandlerPerson + '&nbsp;</li>';
                        content += '<li style="width: 10%;">';

                        switch (v.status) {
                            case '1':
                                content += '未提交';
                                break;
                            case '2':
                                content += '审批中';
                                break;
                            case '3':
                                content += '审核通过';
                                break;
                            case '4':
                                content += '审核不通过';
                                break;
                            case '5':
                                content += '撤销';
                                break;
                            default:
                                content += '未提交';
                                break;
                        }
                        content += '</li>';
                        content += '<li style="width: 15%;">' + v.createTime + '</li>';
                        content += '</ul>';
                    });
                    if (content == "") {
                        content = '<ul class="topnone">';
                        content += '<li style="width:98.4%;color:#f47469;">无数据!</li>';
                        content += '</ul>';
                    }

                    parent.$("#leaveContentList").append(content);
                    layer.close(loadIdx);
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                }, 'json');
            }
        }, 'json');
    }

    function doClose() {
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }

    //格式化日期,
    function formatDate(date,format){
        var paddNum = function(num){
          num += "";
          return num.replace(/^(\d)$/,"0$1");
        }
        //指定格式字符
        var cfg = {
           yyyy : date.getFullYear() //年 : 4位
          ,yy : date.getFullYear().toString().substring(2)//年 : 2位
          ,M  : date.getMonth() + 1  //月 : 如果1位的时候不补0
          ,MM : paddNum(date.getMonth() + 1) //月 : 如果1位的时候补0
          ,d  : date.getDate()   //日 : 如果1位的时候不补0
          ,dd : paddNum(date.getDate())//日 : 如果1位的时候补0
          ,hh : date.getHours()  //时
          ,mm : date.getMinutes() //分
          ,ss : date.getSeconds() //秒
        }
        format || (format = "yyyy-MM-dd hh:mm:ss");
        return format.replace(/([a-z])(\1)*/ig,function(m){return cfg[m];});
    } 
    function doDownload(fileUrl) {
        var url = APP+'/Home/Office/downloadAttachFile?fileUrl='+fileUrl;
        window.open(url, '_blank');
    }
</script>
</body>
</html>