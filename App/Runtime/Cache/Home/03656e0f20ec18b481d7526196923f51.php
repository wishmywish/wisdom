<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
/*清除默认样式*/
body, h1, ul, li, p, img, div, dl, dd, dt, span, a {
    margin: 0;
    padding: 0;
    list-style: none;
}
/*公共的样式*/
body {
    font-family: '宋体';
    color: #646464;
    font-size: 14px;
}
.main {
    overflow: hidden;
    margin: 20px 20px;
    height: 380px;
}
.submitBtn {
    background-color: #409ad6;
    border: 1px solid #409ad6;
    border-radius: 3px;
    padding: 0 20px;
    line-height: 28px;
    cursor: pointer;
    color: #fff;
    margin-left: 20px;
}
.resetBtn {
    background-color: #fff;
    border: 1px solid #e2e2e2;
    border-radius: 3px;
    padding: 0 20px;
    line-height: 28px;
    cursor: pointer;
    color: #000;
}
.menuTree {
    float: left;
    overflow-y: scroll;
    width: 240px;
    height: 350px;
    border: 1px #A0A0A4 outset;
    margin-right: 30px;
}
.menuTree .ui-easytree {
    height: 340px;
}
.multipleSelect {
    width: 200px;
    height: 350px;
    border: 1px #A0A0A4 outset;
    padding: 5px;
}
</style>
</head>
<body>
    <div class="main">
        <div id="menuTree" class="menuTree"></div>
        <div>
            <div style="float:left;">
                <select size="20" id="select1" class="multipleSelect"></select>
            </div>
        </div>
    </div>
    <div style="text-align: center;">
        <button class="submitBtn" onclick="doSubmit();">确定</button>
        <button class="resetBtn" onclick="doReset();">关闭</button>
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

 
 
 
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Home/Default/js/EasyTree/ui.easytree.css" />
    <script type="text/javascript" src="/wisdom/Public/Home/Default/js/EasyTree/jquery.easytree.min.js"></script>
    <script>
        $(function(){
            // 生成树形菜单
            $('#menuTree').easytree({
                data: <?php echo ($dept_list); ?>,
                disableIcons: true
            });
        });

        /*点击左侧部门列表时，根据部门ID获取用户列表*/
        function getUserListByDeptId(deptId) {
            var selectedUser = '<?php echo ($selected); ?>';
            var loadIdx = layer.load(0);
            $("#select1").empty();
            $.post("<?php echo U('Office/getUserList');?>", {"deptId":deptId}, function(data) {
                if (!("list" in data)) {
                    layer.close(loadIdx);
                    layer.msg(data.error_text,{icon: 8});
                    return;
                }
                // 设定用户列表
                $.each(data.list, function(k, v) {
                    var disabled = "";
                    if(selectedUser != '') {
                        var list = selectedUser.split(",");
                        for (i = 0; i < list.length ; i++ ) 
                        {
                            if(list[i] == v.id) {
                                disabled = "disabled";
                            }
                        } 
                    }
                    var opt = '<option rel="' + v.photoId + '" value="' + v.id + '" '+ disabled +'>' + v.name + '</option>';
                    $("#select1").append(opt);
                });
                layer.close(loadIdx);
            }, 'json');
        }

        /*点击确定按钮*/
        function doSubmit() {
            var loadIdx = layer.load(0);
            var processId = '<?php echo ($processId); ?>';
            var processNodeId = '<?php echo ($processNodeId); ?>';
            var comment = '<?php echo ($comment); ?>';
            var operateType = '<?php echo ($operateType); ?>';
            var forwardHandleUserId = $('#select1 option:selected').val();
            
            $.post("<?php echo U('Office/processNodeApproval');?>", {"operateType":operateType, "processId":processId, "processNodeId":processNodeId, "comment":comment, "forwardHandleUserId":forwardHandleUserId}, function(data) {
                if(data.error_code != 'success') {
                    layer.msg(data.error_text,{icon: 8});
                    layer.close(loadIdx);
                } else {
                    var busiType = "<?php echo ($busiType); ?>";
                    var page = "<?php echo ($page); ?>";
                    var type = parent.parent.$("#hidRType").val();
                    var startDate = parent.parent.$("#hidSDate1").val();
                    var endDate = parent.parent.$("#hidEDate1").val();
                    var status = parent.parent.$("#hidRStatus").val();

                    parent.parent.$("#reimbursementContentList").empty();

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

                        parent.parent.$("#reimbursementContentList").append(content);
                        layer.close(loadIdx);
                        
                        parent.doClose();
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    }, 'json');
                }
            }, 'json');
        }

        /*点击关闭按钮*/
        function doReset() {
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