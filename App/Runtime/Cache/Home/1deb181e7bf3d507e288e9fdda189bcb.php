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
        .fl{ float: left;}
        .rg{float:right;}
        /*主体*/
        .main{overflow: hidden; margin: 20px 80px; }
        .main dl{ width: 100%;}
        .main dl dt{width: 60px; height: 60px; border-radius: 30px; background: #ccc; }
        .main dl dd{ line-height: 60px; margin-left: 10px;}
        .main ul{ margin-top:20px; width: 100%;float: left}
        .main ul li{line-height: 25px;float: left;}
        .main ul li span{text-align: right;}
        .fll{text-align: right; width: 100px;margin-right: 7px;}
        .c_name{font-weight: 100;height: 20px;margin-right: 55px;text-align: center;width: 125px;}
        .main span{color: red;}
        /*.titname{  text-align: right;width: 60px;margin-right: 7px;float: left;}*/
        .main input{height:25px;width:200px;}
        .main select {height:30px;width:200px;}
        /*.main select{float: right;height:28px;width:200px;}*/
        .submit{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .reset{background-color: #eaeaea;margin: 30px 5px;border:1px;height: 25px;width: 70px;cursor: pointer;color: #000;}

        #show_img img{width: 60px;height: 60px;margin-left: -20px;}
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
    <ul>
        <li class="fll">客户名称</li>
        <li><input type="text" id="customer" style="width: 290px;" value="<?php echo ($_GET['cusName']); ?>" cusId="<?php echo ($_GET['cusId']); ?>" disabled="true" /></li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>拜访对象</li>
        <li style="position: relative">
            <input type="text" id="linkman"  placeholder="从客户联系人中选择"/>
            <span class="fa fa-search fa-lg" style="position: absolute;right: 10px;top: 10px;color: #ccc;"></span>
        </li>
    </ul>
    <ul>
        <li class="fll">拜访方式</li>
        <li>
            <select name="source" id="visitMethod">
                <option value="">--请选择--</option>
                <option value="1">电话拜访</option>
                <option value="2">上门拜访</option>
                <option value="3">其他</option>
            </select>
        </li>
    </ul>
    <ul>
        <li class="fll">关联商机</li>
        <li style="position: relative">
            <input type="text" id="SJ"  placeholder="从客户商机中选择" readonly />
            <span class="fa fa-search fa-lg" style="position: absolute;right: 10px;top: 10px;color: #ccc;" ></span>
        </li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>拜访主题</li>
        <li><input type="text" id="title" style="width: 500px;text-overflow: ellipsis;white-space: nowrap;color: red;"/><span>不超过50个字</span></li>
    </ul>

    <ul>
        <li class="fll"><span>*</span>拜访日期</li>
        <li> <input type="text" class="laydate-icon" id="visitTimeStart" style="width: 180px;" placeholder="开始日期"/>&nbsp;至&nbsp;<input type="text" class="laydate-icon" id="visitTimeEnd" style="width: 180px;" placeholder="结束日期"/></li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>主要参与人员</li>
        <li style="position: relative">
            <input type="text" id="userNames" style="width: 260px;padding-right: 30px;"  placeholder="从组织架构中选择人员"/>
            <input type="hidden" id="userIds" />
            <span class="fa fa-search fa-lg" style="position: absolute;right: 10px;top: 10px;color: #ccc;"></span>
        </li>
    </ul>
    <ul>
        <li class="fll">拜访内容</li>
        <li><textarea id="content" style="height: 100px;width: 500px;color: red;"></textarea><span>不超过500个字</span></li>
    </ul>

</div>
<div style="text-align: center;">
    <button class="submit" id="s_submit" onclick="do_save()" >提交</button>
    <button class="reset" onclick="reset()">取消</button>
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

    var cusId = $("#customer").attr("cusid");  //客户id

    //拜访计划提交
    function do_save() {
        var customer = $("#customer").val();  //客户名称,自动带过来无需填写的
        var cusId = $("#customer").attr("cusid"); //客户id
        var cusClientIds = $("#linkman").attr("linkman_ids");  //选出来的联系人id字符串
        var linkman = $("#linkman").val(); //拜访对象
        var visitMethod = $("#visitMethod").val(); //拜访方式
        var bizId = $("#SJ").attr("biz_id"); //关联商机id
        var title = $("#title").val(); //主题
        var visitTimeStart = $("#visitTimeStart").val(); //拜访开始日期
        var visitTimeEnd = $("#visitTimeEnd").val(); //拜访结束日期
        var userIds = $("#userIds").val(); //主要参与人员的id集合
        var content = $("#content").val(); //拜访内容

        var linkman_obj = $("#linkman");
        if (getValLen(linkman_obj) == 0) {
            layer.msg("拜访对象不能为空",{icon: 8});
            linkman_obj.focus();
            return false;
        }

        var title_obj = $("#title");
        if (getValLen(title_obj) == 0) {
            layer.msg("拜访主题不能为空",{icon: 8});
            title_obj.focus();
            return false;
        }else if (getValLen(title_obj) > 50) {
            layer.msg("拜访主题最多为50字",{icon: 8});
            title_obj.focus();
            return false;
        }

        var content_obj = $("#content");
        if (getValLen(content_obj) > 500) {
            layer.msg("拜访内容最多为500字",{icon: 8});
            content_obj.focus();
            return false;
        }

        var visitTimeStart_obj = $("#visitTimeStart");
        if (getValLen(visitTimeStart_obj) == 0) {
            layer.msg("拜访开始日期不能为空",{icon: 8});
            visitTimeStart_obj.focus();
            return false;
        }

        var visitTimeEnd_obj = $("#visitTimeEnd");
        if (getValLen(visitTimeEnd_obj) == 0) {
            layer.msg("拜访结束日期不能为空",{icon: 8});
            visitTimeEnd_obj.focus();
            return false;
        }


        var loadIdx = layer.load(0);
        $.post("<?php echo U('Office/saveVisitPlan');?>", {"cusId":cusId, "cusClientIds":cusClientIds, "visitMethod":visitMethod, "bizId":bizId, "visitPlanSubject":title, "startDate":visitTimeStart, "endDate":visitTimeEnd, "articipantIds":userIds, "content":content }, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
                layer.close(loadIdx);
            } else {
                layer.close(loadIdx);
                layer.msg("添加成功");
                setTimeout('var index = parent.layer.getFrameIndex(window.name);parent.location.reload();parent.layer.close(index);',2000);
            }

        }, 'json');
    }


    //获取值的长度
    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }

    /**
     * 选择联系人弹窗
     */
    $('#linkman').click(function(){
        layer.open({
            type:2,
            title :['联系人','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['550px', '420px'],
            shadeClose: true, //点击遮罩关闭
            content: APP+'/Home/Office/selectLinkman'
        });
    });


    /**
     * 关联商机弹窗
     */
    $('#SJ').click(function(){
        var bizId = $(this).attr("biz_id");
        layer.open({
            type:2,
            title :['商机','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['388px', '420px'],
            shadeClose: true, //点击遮罩关闭
            content: APP+'/Home/Office/selectmore?cusId='+cusId+'&bizId='+bizId
        });
    });


    $('#userNames').click(function(){
        layer.open({
            type:2,
            title :['发送到','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '400px'],
            shadeClose: true, //点击遮罩关闭
            content:APP+'/Home/Office/selectUsers'
        });
    });
    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

    //拜访日期开始日期
    var dateStart = {
        elem: '#visitTimeStart',
        format: 'YYYY-MM-DD hh:mm',
        min: '1900-01-01 00:00:00', //最小日期
        max: '2099-06-16', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            return datas;
        }
    };
    laydate(dateStart);

    //拜访日期结束日期
    var dateEnd = {
        elem: '#visitTimeEnd',
        format: 'YYYY-MM-DD hh:mm',
        min: '1900-01-01 00:00:00', //最小日期
        max: '2099-06-16', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            return datas;
        }
    };
    laydate(dateEnd);


</script>
</body>
</html>