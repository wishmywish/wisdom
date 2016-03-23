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
        textarea{font-family: '宋体'; color: #646464; font-size: 14px;border: 1px solid #a9a9a9;padding: 10px;}
        textarea[disabled]{ background: #fafafa;}
        input{border: 1px solid #a9a9a9;}
        input[disabled]{ background: #fafafa;}
        .fl{ float: left;}
        .rg{float:right;}
        /*主体*/
        .main{overflow: hidden;width: 100%; }

        .nav{float: left;
            height: 25px;
            margin: 20px 0 0 57px;
            width: 100%;}
        .nav ul li{display: inline-block;float: left;cursor: pointer;}
        .nav .cur{color: red;}
        .content{display: none;width: 100%;float: left;}
        .content table{float: left;width: 610px;border: 1px solid #e2e0e0;border-collapse: collapse;text-align: center;}
        .content table tr td{border: 1px solid #e2e0e0;line-height: 20px;}
        .content table tr th{border: 1px solid #e2e0e0;font-weight: normal;}
        .cur1{display: block;}
        .list{ margin: 0 0 0 15px;}
        .list ul{ margin-top:20px; width: 100%;}
        .list ul input{width: 80px;height: 25px;}
        .list ul li{ float: left;}
        .list ul  span{width: 100px;text-align: right;display: inline-block;margin-right: 7px;float: left;line-height: 25px;}
        .list ul select{width: 60px;height: 29px;}
        .fj{float: right;}
        .fj p{ margin: 0 0 5px;text-decoration: underline;}
        .fi-list{  line-height: 25px;  overflow: hidden;  text-overflow: ellipsis;  white-space: nowrap;  width: 115px;  padding-right: 10px;}
        .buts{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .buts1{margin-right: 30px;border:1px;height: 25px;width: 70px;background: #eeeeee;color: #000;cursor: pointer;}

        #show_img img{width: 60px;height: 60px;margin-left: -20px;}
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
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
</head>
<body>
<div class="main">
   <div class="nav">
       <ul>
           <li class="cur">汇报<span style="color: initial">&nbsp;|&nbsp;</span></li>
           <li>记录</li>
       </ul>
   </div>
    <div class="list">
        <div class="content cur1">
            <ul class="fl">
                <li>
                    <span>任务编号</span>
                    <input type="text" style="width: 200px;border: none;" value="Task2015020202020">
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>任务主题</span>
                    <input type="text" style="width: 200px;  background: #eeeeee;" value="年会组织策划任务">
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>关联客户</span>
                    <input style="width: 204px;height:30px;float: left;  background: #eeeeee;" type="search"  class="link" value="王XXX">
                    <!--<span class="fa fa-search fa-lg" style="position: absolute;left: 234px;top: 118px;color: #898989;"></span>-->
                    <span>关联商机</span>
                    <input style="width: 204px;height:30px;float: left;  background: #eeeeee;"  type="search"  class="link" value="王XXX">
                    <!--<span class="fa fa-search fa-lg" style="position: absolute;left: 541px;top: 118px;color: #898989;"></span>-->
                </li>

            </ul>
            <ul class="fl">
                <li>
                    <span>任务描述</span>
                    <textarea style="float:left;height: 130px; width: 586px;  background: #eeeeee;" >年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排</textarea>
                    <!--<p style="float: right;margin: 120px 0 0 5px;color: red;">不超过（500字）</p>-->
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>任务要求</span>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr style="height: 25px;">
                            <th width="197" height="25">参与人员</th>
                            <th width="150">开始时间</th>
                            <th width="150">结束时间</th>
                            <th width="550">主要工作内容</th>
                        </tr>
                        <?PHP for($i=0;$i<6;$i++){?>
                        <tr style="height: 50px;  background: #eeeeee;">
                            <td>王青</td>
                            <td>2015-10-09</td>
                            <td>2015-10-29</td>
                            <td>安排好会议现场的灯光</td>
                        </tr>
                        <?PHP }?>
                    </table>
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>任务汇报</span>
                    <textarea style="float:left;height: 130px; width: 586px;" ></textarea>
                    <p style="float: right;margin: 133px 0 0 5px;color: red;">不超过（500字）</p>
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span style="margin-left: 90px;">实际开始时间</span>
                    <input id="startDate" name="startDate" class="laydate-icon" value="" placeholder="开始日期" style="width: 100px;margin-right: 13px;">
                </li>
                <li>
                    <span>实际结束时间</span>
                    <input id="endDate" name="endDate" class="laydate-icon" value="" placeholder="结束日期" style="width: 100px;margin-right: 28px;">
                </li>
                <li>
                    <span style="width: 56px;">完成进度</span>
                    <select name="finish" id="">
                        <option value="0">10%</option>
                        <option value="1">20%</option>
                        <option value="2">30%</option>
                        <option value="3">40%</option>
                        <option value="4">50%</option>
                        <option value="5">60%</option>
                        <option value="6">70%</option>
                        <option value="7">80%</option>
                        <option value="8">90%</option>
                        <option value="9">100%</option>
                    </select>
                </li>
            </ul>

            <ul class="fl" style="margin-bottom: 30px;">
                <!--<div class="fj-but">-->
                <!--<li  style="position: relative;float: left;top: 7px;left: 7px;" class="fa fa-paperclip fa-fw fa-lg"></li>-->
                <!--</div>-->
                <span class="fl">附件</span>
                <?PHP for($i=0;$i<5;$i++){?>
                <li class="fi-list">报销金额报销金额报销金额.jpg</li> <!--此处新增一个附件，显示一个附件名称，附件数量5个-->
                <?PHP }?>
            </ul>
            <div style="text-align: center;width: 100%;float: left;">
                <button class="buts" onclick="tip()">提交</button>
                <button class="buts1" >取消</button>
            </div>

        </div>
        <div class="content">
            <ul class="fl">
                <li>
                    <span>任务编号</span>
                    <input type="text" style="width: 200px;border: none;" value="Task2015020202020">
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>任务主题</span>
                    <input type="text" style="width: 200px;  background: #eeeeee;" value="年会组织策划任务">
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>关联客户</span>
                    <input style="width: 204px;height:30px;float: left;  background: #eeeeee;" type="search"  class="link" value="王XXX">
                    <!--<span class="fa fa-search fa-lg" style="position: absolute;left: 234px;top: 118px;color: #898989;"></span>-->
                    <span>关联商机</span>
                    <input style="width: 204px;height:30px;float: left;  background: #eeeeee;"  type="search"  class="link" value="王XXX">
                    <!--<span class="fa fa-search fa-lg" style="position: absolute;left: 541px;top: 118px;color: #898989;"></span>-->
                </li>

            </ul>
            <ul class="fl">
                <li>
                    <span>任务描述</span>
                    <textarea style="float:left;height: 130px; width: 675px;  background: #eeeeee;" >年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排年会的任务如何进行安排</textarea>
                </li>
            </ul>
            <ul class="fl">
                <li>
                    <span>任务要求</span>
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 695px;">
                        <tr style="height: 25px;">
                            <th width="197" height="25">参与人员</th>
                            <th width="150">开始时间</th>
                            <th width="150">结束时间</th>
                            <th width="550">主要工作内容</th>
                        </tr>
                        <?PHP for($i=0;$i<6;$i++){?>
                        <tr style="height: 50px;  background: #eeeeee;">
                            <td>王青</td>
                            <td>2015-10-09</td>
                            <td>2015-10-29</td>
                            <td>安排好会议现场的灯光</td>
                        </tr>
                        <?PHP }?>
                    </table>
                </li>
            </ul>
            <ul class="fl" style="margin-bottom: 30px;">
                <li>
                    <span>汇报记录</span>
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 695px;">
                        <tr style="height: 25px;">
                            <th width="50" height="25">序号</th>
                            <th width="135">实际开始时间</th>
                            <th width="135">实际结束时间</th>
                            <th width="80">完成进度</th>
                            <th width="275">完成内容</th>
                            <th width="50">附件</th>
                        </tr>
                        <?PHP for($i=0;$i<6;$i++){?>
                        <tr style="height: 50px;  background: #eeeeee;">
                            <td><?php echo $i+1?></td>
                            <td>2015-10-09 10:20</td>
                            <td>2015-10-19 15:20</td>
                            <td>10%</td>
                            <td>确定了场地桌椅的摆放</td>
                            <td>有</td>
                        </tr>
                        <?PHP }?>
                    </table>
                </li>
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
            content: "<?php echo U('Office/selectApplyUser');?>" + "?processId=" + processId + "&processNodeId=" + processNodeId + "&comment=" + comment + "&operateType=3&page=" + page + "&busiType=2",
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
                var busiType = 2;
                var page = "<?php echo ($page); ?>";
                var type = parent.$("#hidRType").val();
                var startDate = parent.$("#hidSDate1").val();
                var endDate = parent.$("#hidEDate1").val();
                var status = parent.$("#hidRStatus").val();

                parent.$("#reimbursementContentList").empty();

                $.post("<?php echo U('Office/getApprovalList');?>", {"busiType":busiType, "page":page, "type":type, "startDate":startDate, "endDate":endDate, "status":status}, function(data) {

                    var content = "";
                    // 设定用户列表
                    $.each(data.processList, function(k, v) {
                        content += '<ul>';
                        content += '<li style="width: 19%;">' + v.processNo + '</li>';

                        content += '<li style="width: 15%;cursor: pointer;" onclick="showApplyDetail(\'' + v.processId + '\')" title="' + v.title + '"><a>' + v.title + '</a></li>';
                        content += '<li style="width: 30%;" title="' + v.formContent + '">' + v.formContent + '&nbsp;</li>';
                        content += '<li style="width: 8%;">' + v.applicantName + '&nbsp;</li>';
                        content += '<li style="width: 8%;">' + v.currentHandlerPerson + '&nbsp;</li>';
                        content += '<li style="width: 10%;">';

                        switch (v.status) {
                            case '1':
                                content += '未提交';
                                break;
                            case '2':
                                content += '待处理';
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

                        var date = new Date(v.createTime);
                        var createTime = formatDate(date ,"yyyy-MM-dd");
                        content += '<li style="width: 10%;">' + createTime + '</li>';
                        content += '</ul>';
                    });
                    if (content == "") {
                        content = '<ul class="topnone">';
                        content += '<li style="width:98.4%;color:#f47469;">无数据!</li>';
                        content += '</ul>';
                    }

                    parent.$("#reimbursementContentList").append(content);
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
</script>
</body>
</html>