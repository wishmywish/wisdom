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
        .main input {height:25px;width:200px;}
        .main select {height:30px;width:208px;}
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
        <li><input type="text" id="customer" style="text-overflow: ellipsis;white-space: nowrap;width: 400px;" value="<?php echo ($_GET['cusName']); ?>" cusId="<?php echo ($_GET['cusId']); ?>" disabled="true" /></li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>联系人</li>
        <li style="position: relative">
            <input type="text" id="linkman" style="padding-right: 30px;" linkman_ids="<?php echo ($bizDetail['cusClientIds']); ?>" title="<?php echo ($bizDetail['cusClientNames']); ?>" value="<?php echo ($bizDetail['cusClientNames']); ?>"  placeholder="从客户联系人中选择"/>
            <span class="fa fa-search fa-lg" style="position: absolute;right: 10px;top: 10px;color: #ccc;"></span>
        </li>
    </ul>
    <ul>
        <li class="fll">来源</li>
        <li>
            <select name="source" id="origin">
                <option value="0">--请选择--</option>
                <?php if(is_array($bizOrigin['list'])): foreach($bizOrigin['list'] as $key=>$vo): ?><option value="<?php echo ($vo[dictId]); ?>" <?php if($vo[dictId] == $bizDetail[bizOrigin]): ?>selected<?php endif; ?> ><?php echo ($vo['dictName']); ?></option><?php endforeach; endif; ?>
            </select>
        </li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>商机主题</li>
        <li><input type="text" id="title" value="<?php echo ($bizDetail['bizSubject']); ?>" style="width: 400px;text-overflow: ellipsis;white-space: nowrap;"/><span>不超过50个字</span></li>
    </ul>
    <ul>
        <li class="fll">客户需求</li>
        <li><textarea style="height: 100px;width: 400px;" id="require"><?php echo ($bizDetail['cusDemand']); ?></textarea><span>不超过500个字</span></li>
    </ul>
    <ul>
        <li class="fll">商机状态</li>
        <li>
            <select name="busiState" id="bus_state">
                <option value="0">--请选择--</option>
                <?php if(is_array($bizState['list'])): foreach($bizState['list'] as $key=>$vo): ?><option value="<?php echo ($vo[dictId]); ?>" <?php if($vo[dictId] == $bizDetail[bizPhase]): ?>selected<?php endif; ?> ><?php echo ($vo['dictName']); ?></option><?php endforeach; endif; ?>
            </select>
        </li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>预计签单日期</li>
        <li> <input type="text" class="laydate-icon" id="signDate" value="<?php echo ($bizDetail['expectedSingDate']); ?>" style="width: 185px;"/></li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>报价</li>
        <li><input type="text" id="price" value="<?php echo ($bizDetail['bizPrice']); ?>" /></li>
    </ul>
    <ul>
        <li class="fll"><span>*</span>预计成交价</li>
        <li> <input type="text" id="maybe_price" value="<?php echo ($bizDetail['expectVolume']); ?>" /></li>
    </ul>
    <ul>
        <li class="fll">备注</li>
        <li><textarea style="height: 100px;width: 400px;color: red;" id="memo" ><?php echo ($bizDetail['remark']); ?></textarea><span>不超过500个字</span></li>
    </ul>

</div>
<div style="text-align: center;"><button class="submit" id="s_submit" onclick="do_save()">提交</button>
    <button class="reset" onclick="reset()">取消</button>
</div>
<input type="hidden" name="cusId" value="<?php echo ($_GET['cusName']); ?>">
<input type="hidden" name="cusName" value="<?php echo ($_GET['cusId']); ?>">

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
    var cusId = $("input[name=cusId]").val(); //客户id
    var cusName = $("input[name=cusName]").val(); //客户名称

    //联系人列表弹窗
    $('#linkman').click(function(){
        var linkman_ids = $("#linkman").attr("linkman_ids");
        console.log(linkman_ids);

        layer.open({
            type:2,
            title :['联系人','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['550px', '420px'],
            shadeClose: true, //点击遮罩关闭
            content: APP+'/Home/Office/selectLinkman?linkman_ids='+linkman_ids
        });
    });

    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

    var date = {
        elem: '#signDate',
        format: 'YYYY-MM-DD',
        min: '1900-01-01 00:00:00', //最小日期
        max: '2099-06-16', //最大日期
        //istime: true,
        istoday: false,
        choose: function(datas){
            return datas;
        }
    };
    laydate(date);


    //商机提交
    function do_save() {
        var customer = $("#customer").val();  //客户名称,自动带过来无需填写的
        var cusId = $("#customer").attr("cusid"); //客户id
        var linkman = $("#linkman").val(); //联系人
        var cusClientIds = $("#linkman").attr("linkman_ids");  //选出来的联系人id字符串,无UI，暂时测试
        var origin = $("#origin").val(); //来源
        var title = $("#title").val(); //主题
        var require = $("#require").val(); //客户需求
        var bus_state = $("#bus_state").val(); //商机状态
        var signDate = $("#signDate").val(); //预计签单日期
        var price = $("#price").val(); //报价
        var maybe_price = $("#maybe_price").val(); //预计成交价
        var memo = $("#memo").val(); //备注

        var linkman_obj = $("#linkman");
        if (getValLen(linkman_obj) == 0) {
            layer.msg("联系人不能为空",{icon: 8});
            linkman_obj.focus();
            return false;
        }

        var title_obj = $("#title");
        if (getValLen(title_obj) == 0) {
            layer.msg("商机主题不能为空",{icon: 8});
            title_obj.focus();
            return false;
        }else if (getValLen(title_obj) > 50) {
            layer.msg("商机主题最多为50字",{icon: 8});
            title_obj.focus();
            return false;
        }

        var require_obj = $("#require");
        if (getValLen(require_obj) > 500) {
            layer.msg("客户需求最多为64字",{icon: 8});
            require_obj.focus();
            return false;
        }

        var signDate_obj = $("#signDate");
        if (getValLen(signDate_obj) == 0) {
            layer.msg("预计签单日期不能为空",{icon: 8});
            signDate_obj.focus();
            return false;
        }

        var price_obj = $("#price");
        if (getValLen(price_obj) == 0) {
            layer.msg("报价不能为空",{icon: 8});
            price_obj.focus();
            return false;
        }

        if( isNaN(price) ){
            layer.msg("报价必须为数字",{icon: 8});
            price_obj.focus();
            return;
        }

        var maybe_price_obj = $("#maybe_price");
        if (getValLen(maybe_price_obj) == 0) {
            layer.msg("预计报价不能为空",{icon: 8});
            maybe_price_obj.focus();
            return false;
        }

        if( isNaN(maybe_price) ){
            layer.msg("预计报价必须为数字",{icon: 8});
            maybe_price_obj.focus();
            return;
        }

        var memo_obj = $("#memo");
        if (getValLen(memo_obj) > 500) {
            layer.msg("备注最多为500字",{icon: 8});
            memo_obj.focus();
            return false;
        }

//        price = parseFloat(price).toFixed(2);
//        maybe_price = parseFloat(maybe_price).toFixed(2);



        var loadIdx = layer.load(0);
        var bizId = <?php echo ($bizDetail[bizId]); ?>;
        $.post("<?php echo U('Office/saveBiz');?>", {"bizId":bizId,"cusId":cusId, "cusClientIds":cusClientIds, "bizOrigin":origin, "bizSubject":title, "cusDemand":require, "bizPhase":bus_state, "expectSignDate":signDate, "bizPrice":price, "expectVolume":maybe_price, "remark":memo}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
                layer.close(loadIdx);
            } else {
                layer.close(loadIdx);
                layer.msg("编辑成功");
                setTimeout('var index = parent.layer.getFrameIndex(window.name);parent.location.reload();parent.layer.close(index);',2000);
            }

        }, 'json');
    }


    //获取值的长度
    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }





</script>
</body>
</html>