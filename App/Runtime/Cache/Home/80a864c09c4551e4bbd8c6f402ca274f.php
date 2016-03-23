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
    overflow-y: scroll;
    width: 350px;
    height: 350px;
    border: 1px #A0A0A4 outset;
}
</style>
</head>
<body>
    <div class="main">
        <div id="menuTree" class="menuTree"></div>
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
                checkIcons: true,
                checkFunction: "doCheck(this);",
            });

            // 初始化右侧选择数据
            initCheck();
        });

        /*初始化右侧选择数据*/
        function initCheck() {
            var deptIds = '<?php echo ($deptIds); ?>';
            if (deptIds == "") {
                return;
            }
            var ids = deptIds.split(",");

            for (var i = 0; i < ids.length; i++) {
                $(".easyChk[value='" + ids[i] + "']").attr("checked", "checked");
            }
        }

        /*点击确定按钮*/
        function doSubmit() {
            var deptIds = "";
            var deptNames = "";
            $(".easyChk:checked").each(function(k, v) {
                var childChk = $("[id^='" + v.id + "']");
//                if (childChk.length == 1) {  //去除上级部门，只取下级所属部门
                    if (deptIds.length > 0) {
                        deptIds += ",";
                        deptNames += ",";
                    }
                    deptIds += $(v).val();
                    deptNames += $(v).attr("rel");
//                }
            });

            // 将部门名设定到父画面
            parent.$("#deptNames").val(deptNames);
            parent.$("#deptNames").attr("title",deptNames);
            // 将部门ID设定到父画面
            parent.$("#deptIds").val(deptIds);
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }

        /*点击关闭按钮*/
        function doReset() {
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }

        function doCheck(obj) {
            $("[id^='" + obj.id + "_']").prop("checked", $(obj).is(":checked"));
        }
    </script>
</body>
</html>