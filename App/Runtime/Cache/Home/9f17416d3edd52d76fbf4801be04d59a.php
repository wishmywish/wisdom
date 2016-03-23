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
    height: 270px;
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
.btn {
    width: 50px;
    height: 30px;
    margin-top: 10px;
    cursor: pointer;
}
.menuTree {
    float: left;
    /*overflow-y: scroll;*/
    width: 240px;
    height: 268px;
    border: 1px #A0A0A4 outset;
    margin-right: 30px;
}
.menuTree .ui-easytree {
    height: 260px;
}
.multipleSelect {
    width: 200px;
    height: 270px;
    border: 1px #A0A0A4 outset;
    padding: 5px;
}
.selectBtnDiv {
    float: left;
    width: 70px;
    text-align: center;
    padding-top: 60px;
}
</style>
</head>
<body>
    <div class="main">
        <div id="menuTree" class="menuTree"></div>
        <div>
            <div style="float:left;">
                <select multiple="multiple" id="select1" class="multipleSelect"></select>
            </div>
            <div class="selectBtnDiv">
                <span id="add">
                    <input type="button" class="btn" value=">"/></span>
                <span id="add_all">
                    <input type="button" class="btn" value=">>"/></span>
                <span id="remove">
                    <input type="button" class="btn" value="<"/>
                </span>
                <span id="remove_all">
                    <input type="button" class="btn" value="<<"/>
                </span>
            </div>
            <div style="float:left;">
                <select multiple="multiple" id="select2" class="multipleSelect"></select>
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
            // 用户选择交换JQuery
            // 移到右边
            $('#add').click(function() {
                // 获取选中的选项，删除并追加给对方
                $('#select1 option:selected').appendTo('#select2');
            });

            // 移到左边
            $('#remove').click(function() {
                $('#select2 option:selected').appendTo('#select1');
            });

            // 全部移到右边
            $('#add_all').click(function() {
                // 获取全部的选项,删除并追加给对方
                $('#select1 option').appendTo('#select2');
            });

            // 全部移到左边
            $('#remove_all').click(function() {
                $('#select2 option').appendTo('#select1');
            });

            // 左侧双击选项
            $('#select1').dblclick(function() {
                // 获取全部的选项,删除并追加给对方
                $("option:selected",this).appendTo('#select2');
            });

            // 右侧双击选项
            $('#select2').dblclick(function(){
               $("option:selected",this).appendTo('#select1');
            });

            // 生成树形菜单
            $('#menuTree').easytree({
                data: <?php echo ($dept_list); ?>,
                disableIcons: true
            });

            // 初始化右侧选择数据
            initSelect2();
        });

        /*初始化右侧选择数据*/
        function initSelect2() {
            var userNames = '<?php echo ($userNames); ?>';
            var userIds = '<?php echo ($userIds); ?>';
            if (userIds == "" || userNames == "") {
                return;
            }
            var ids = userIds.split(",");
            var names = userNames.split(",");
            for (var i = 0; i < ids.length; i++) {
                var opt = '<option value="' + ids[i] + '">' + names[i] + '</option>';
                $("#select2").append(opt);
            }
        }

        /*点击左侧部门列表时，根据部门ID获取用户列表*/
        function getUserListByDeptId(deptId) {
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
                    var opt = '<option value="' + v.id + '">' + v.name + '</option>';
                    $("#select1").append(opt);
                });
                // 删除已选择用户列表中存在的用户
                $("#select2 option").each(function(k, v) {
                    $("#select1 option[value='" + $(v).val() + "']").remove();
                });
                layer.close(loadIdx);
            }, 'json');
        }

        /*点击确定按钮*/
        function doSubmit() {
            var userNames = "";
            var userIds = "";
            $("#select2 option").each(function(k, v) {
                if (userIds.length > 0) {
                    userNames += ",";
                    userIds += ",";
                }
                userNames += $(v).text();
                userIds += $(v).val();
            });
            // 将用户名设定到父画面
            parent.$("#userNames").val(userNames);
            
            parent.$("#userNames").attr("title",userNames);
            // 将用户名设定到父画面
            parent.$("#userList").html(userNames);
            // 将用户ID设定到父画面
            parent.$("#userIds").val(userIds);
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }

        /*点击关闭按钮*/
        function doReset() {
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }
    </script>
</body>
</html>