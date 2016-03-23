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
    /*overflow-y: scroll;*/
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
<script language="javascript" type="text/javascript" src="http://www.my97.net/dp/My97DatePicker/WdatePicker.js"></script>

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
    var olduserId = $('#select1 option:selected').val();
    var newUserId = "";
    var startUserID ="";
        $(function(){
            // 生成树形菜单
            $('#menuTree').easytree({
                data: <?php echo ($dept_list); ?>,
                disableIcons: true
            });
            // 初始化右侧选择数据
            initSelect1();
        });

        /*初始化右侧选择数据*/
        function initSelect1() {
            var userName = '<?php echo ($userName); ?>';
            var userId = '<?php echo ($userId); ?>';
            var photoId = '<?php echo ($photoId); ?>';
            if (userId == "") {
                return;
            }
            var opt = '<option rel="' + photoId + '" value="' + userId + '"  selected="true"  onclick="doSelect();">' + userName + '</option>';
            olduserId = userId;
        	startUserID = userId;
            $("#select1").append(opt);
        }

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
                    var opt = '<option rel="' + v.photoId + '" value="' + v.id + '" '+ disabled +'onclick="doSelect();">' + v.name + ' </option>';
                    $("#select1").append(opt);
                });
                layer.close(loadIdx);
            }, 'json');
        }

        /*点击人名*/
        function doSelect() {
        	newUserId = $('#select1 option:selected').val();
        	//alert(olduserId+"         "+newUserId);
        	 if( newUserId == olduserId )
             {
        		 $("#select1").find("option[value='"+newUserId+"']").attr("selected",false);
        		 newUserId="";
             }
        	 olduserId = $('#select1 option:selected').val();
        }
        /*点击确定按钮*/
        function doSubmit() {
            var objId = '<?php echo ($objId); ?>';
            var no = '<?php echo ($no); ?>';
            var userName = $('#select1 option:selected').text();
            var userId = $('#select1 option:selected').val();
            var photoId = $('#select1 option:selected').attr("rel");

            if ($.trim(no).length == 0) {
                no = 1;
            }
            
            $.post("<?php echo U('Office/getLogo');?>", {"photoId":photoId}, function(data) {
                var photoURL = data.logo;
                var oid = objId + 'User' + no;
                oid= userId;
   
                if ($.trim(userId).length == 0) {
                	//alert(1);
                	oid = startUserID;
                    parent.$("#" + oid + "").parent("div").remove();
                } else if (startUserID.length > 0) {
                	//alert(2);
                    var userHtml = '<div class="pers1"';
                    if (parent.$("#" + objId + " div").length == 0) {
                        userHtml = '<div class="per-pic"';
                    }

                    // userHtml += ' onclick="selectUser(\'' + userId + '\', \'' + no + '\', \'' + objId + '\');"';
                    userHtml += ">"
                    userHtml += '<img class="per-img" src="' + photoURL + '" onclick="selectUser(\'' + userId + '\', \'' + no + '\', \'' + objId + '\');">';
                    userHtml += '<span id="' + oid + '" class="img-name">' + userName + '</span><input id="' + oid + 'Id" class="recorder" name="' + objId + 'recorder[]" type="hidden" value="' + userId +'" /><a style="color: #f47469;" class="icon-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a></div>';
                    // 将用户名设定到父画面
                    parent.$("#" + startUserID + "").parent("div").prop('outerHTML', userHtml);
                } else {
                    // 移除加号
                    parent.$("#" + objId + " #add").remove();

                    userHtml = '<div class="pers1"';
                    if (parent.$("#" + objId + " div").length == 0) {
                        userHtml = '<div class="per-pic"';
                    }

                    // userHtml += ' onclick="selectUser(\'' + userId + '\', \'' + no + '\', \'' + objId + '\');"';
                    userHtml += ">"
                    userHtml += '<img class="per-img" src="' + photoURL + '" onclick="selectUser(\'' + userId + '\', \'' + no + '\', \'' + objId + '\');">';
                    userHtml += '<span id="' + oid + '" class="img-name">' + userName + '</span><input id="' + oid + 'Id" class="recorder" name="' + objId + 'recorder[]" type="hidden" value="' + userId +'" /><a style="color: #f47469;" class="icon-img-remove" onclick="deleteRecorderUsers(this);" title="删除图片"><i class="fa fa-times-circle-o fa-2x"></i></a></div>';
                    if (parent.$("#" + objId + " div").length < 17) {
                        userHtml += '<div class="pers1"  id="add" onclick="selectUser(\'\', \'' + (parseInt(no) + 1) + '\', \'' + objId + '\');"><img class="per-img" src="/wisdom/Public/Home/Default/images/addpers.png"></div>';
                    }
                    // 将用户名设定到父画面
                    parent.$("#" + objId).append(userHtml);
                }
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            }, 'json');
        }

        /*点击关闭按钮*/
        function doReset() {
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }
    </script>
</body>
</html>