<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
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
    <style>
        html,body{
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif,微软雅黑,宋体;
            color:#595758;
        }
        ul,li{list-style: none;}
        a{text-decoration: none;}
        .head{margin-left: 10px;}
        .head input[type=text]{height: 22px;padding-left: 25px;width: 210px;position: relative;border: 1px solid #ccc;margin-right: 7px;}
        .head i{color: #ccc; position: absolute;left: 25px;top: 13px;}
        .content{float: left;margin-left: 10px;}
        .content table{float: left;width: 350px;border: 1px solid #e2e0e0;border-collapse: collapse;text-align: left;margin: 20px 0 10px 0;}
        .content table  tr  td{border: 1px solid #e2e0e0;line-height: 20px;}
        .content table  tr  th{border: 1px solid #e2e0e0;background: #ddd;padding-left: 10px;font-size: 12px;font-weight: bold;text-align: left;}
        .foot{width:100%;float: left;text-align: center;margin: 15px 0 0 0;}
        .search{border:1px;height: 25px;width: 50px;background: #14bce1;color: #fff;cursor: pointer;}
        .sub{border:1px;height: 25px;width: 50px;background: #14bce1;color: #fff;cursor: pointer;margin-right: 10px;}
        .reset{border:1px;height: 25px;width: 50px;background: #eaeaea;color: #000;cursor: pointer;}
        .tfoot{  width: 350px;
            height: 25px;
            background: #ddd;
            float: left;
            margin-top: -10px;
            padding-top: 10px;
            text-align: center;}
        .tfoot a{margin-right: 5px;  color: #240606;}
        .tfoot a:hover{color: red;}
    </style>
</head>
<body>
<div class="head">
    <input type="text" id="keywords"/>
    <i class="fa fa-search fa-lg" style=""></i>
    <input class="search" type="button" value="搜索"/>
</div>
<div class="content">
    <table border="0" cellpadding="0" cellspacing="0" id="visitPlanList">
        <tr style="height: 25px;">
            <th width="117" height="25">名称</th>
        </tr>
        <?php if(is_array($visitPlanList)): foreach($visitPlanList as $key=>$vo): ?><tr style="height: 25px;">
            <td>
                <input type="radio" name="more" bizId="<?php echo ($vo['bizId']); ?>" bizSubject="<?php echo ($vo['bizSubject']); ?>" value="<?php echo ($vo['visitPlanId']); ?>" id="visitPlan<?php echo ($vo[visitPlanId]); ?>" <?php if($vo[visitPlanId] == $_GET[visitPlanId]): ?>checked<?php endif; ?>  />
                <label for="visitPlan<?php echo ($vo[visitPlanId]); ?>"><?php echo ($vo['visitPlanSubject']); ?></label>
            </td>
        </tr><?php endforeach; endif; ?>
    </table>
    <div class="tfoot" id="page">
        <a href="javaScript:void(0);" id="first_page">首页</a>
        <a href="javaScript:void(0);" id="prev_page">上一页</a>
        <a href="javaScript:void(0);" id="next_page">下一页</a>
        <a href="javaScript:void(0);" id="last_page">末页</a>
    </div>
</div>
<!--<div id="pagebar1" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA"></div>-->
<div class="foot">
    <input class="sub" type="button" value="确认" onclick="do_submit()">
    <input class="reset" type="button" onclick="reset()" value="取消">
</div>
</body>
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

    var cusId = '<?php echo ($_GET[cusId]); ?>';  //客户id
    var selected_visitPlanId = '<?php echo ($_GET[visitPlanId]); ?>'; //选中的visitPlanId,初始化值

    //选中拜访计划
    $("#visitPlanList").on("click","input[name=more]",function(){
        selected_visitPlanId = $(this).val();
    });

    //确定提交,并给父窗口赋值
    function do_submit(){
        var selected_visitPlanName = $("#visitPlan"+selected_visitPlanId).siblings().text();
        var selected_bizName = $("#visitPlan"+selected_visitPlanId).attr("bizSubject");  //关联商机名称
        var selected_bizId = $("#visitPlan"+selected_visitPlanId).attr("bizId");  //关联商机id

        //父窗口赋值
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.$("#visitPlan").val(selected_visitPlanName);
        parent.$("#visitPlan").attr("title",selected_visitPlanName);
        parent.$("#visitPlan").attr("visitPlan_id",selected_visitPlanId);

        parent.$("#SJ").val(selected_bizName);
        parent.$("#SJ").attr("biz_id",selected_bizId);
        parent.layer.close(index);

    }

    //取消
    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

    //分页
    var currentPage = parseInt('<?php echo ($page[current]); ?>');
    var totalPage = parseInt('<?php echo ($page[total]); ?>');
    var pageSize = parseInt('<?php echo ($page[size]); ?>');

    //搜索
    $(".search").on("click",function(){
        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/getvisitPlanList_ajax');?>", {"page":1, "pageSize":pageSize, "cusId":cusId, "visitPlanSubject":keywords}, function(data) {

            totalPage = Math.ceil(parseInt(data.count)/pageSize);
            currentPage = 1;

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                loadvisitPlanList(data);
            }

        }, 'json');
    });
    //首页
    $("#first_page").on("click",function(){

        if( currentPage == 1 ){
            return false;
        }

        var keywords = $("#keywords").val();


        $.post("<?php echo U('Office/getvisitPlanList_ajax');?>", {"page":1, "pageSize":pageSize, "cusId":cusId, "visitPlanSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage = 1;
                loadvisitPlanList(data);
            }

        }, 'json');

    });
    //末页
    $("#last_page").on("click",function(){

        if( currentPage == totalPage ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/getvisitPlanList_ajax');?>", {"page":totalPage, "pageSize":pageSize, "cusId":cusId, "visitPlanSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage = totalPage;
                loadvisitPlanList(data);
            }

        }, 'json');

    });
    //上一页
    $("#prev_page").on("click",function(){
        if( (currentPage-1)<= 0 ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/getvisitPlanList_ajax');?>", {"page":currentPage-1, "pageSize":pageSize, "cusId":cusId, "visitPlanSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage--;
                loadvisitPlanList(data);
            }

        }, 'json');
    });
    //下一页
    $("#next_page").on("click",function(){

        if( (currentPage+1) > totalPage ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/getvisitPlanList_ajax');?>", {"page":currentPage+1, "pageSize":pageSize, "cusId":cusId, "visitPlanSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage++;
                loadvisitPlanList(data);
            }

        }, 'json');
    });


    /**
     * 加载联系人信息(公共部分)
     * @param data ajax返回的data数据
     */
    function loadvisitPlanList(data){

        var html  = '<tr style="height: 25px;">';
            html +=     '<th width="117" height="25">名称</th>';
            html += ' </tr>';
        for( i in data.visitPlanList ){

            var checked = ''; //是否选中
            if( data.visitPlanList[i].visitPlanId == selected_visitPlanId ){  //如果是选中的拜访计划id,则选中状态
                checked = 'checked';
            }

            html += '<tr style="height: 25px;">';
            html +=     '<td>';
            html +=         '<input type="radio" name="more" '+ checked +' value="'+ data.visitPlanList[i].visitPlanId + '" id="visitPlan'+ data.visitPlanList[i].visitPlanId +'" >';
            html +=         '<label for="visitPlan'+ data.visitPlanList[i].visitPlanId +'">' + data.visitPlanList[i].visitPlanSubject + '</label>';
            html +=     '</td>';
            html += '</tr>';
        }

        $("#visitPlanList").html(html);
    }



</script>
</html>