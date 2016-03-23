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
        .content table{float: left;width: 563px;border: 1px solid #e2e0e0;border-collapse: collapse;text-align: left;margin: 20px 0 10px 0;}
        .content table  tr  td{border: 1px solid #e2e0e0;line-height: 20px;}
        .content table  tr  th{border: 1px solid #CFCDCD;background: #ddd;padding-left: 10px;font-size: 12px;font-weight: bold;text-align: left;}
        .foot{width:100%;float: left;text-align: center;margin: 15px 0 0 0;}
        .search{border:1px;height: 25px;width: 50px;background: #14bce1;color: #fff;cursor: pointer;}
        .sub{border:1px;height: 25px;width: 50px;background: #14bce1;color: #fff;cursor: pointer;margin-right: 10px;}
        .reset{border:1px;height: 25px;width: 50px;background: #eaeaea;color: #000;cursor: pointer;}
        .tfoot{  width: 563px;
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
    <input type="text" style=""/>
    <i class="fa fa-search fa-lg" style=""></i>
    <input class="search" type="button" value="搜索"/>
</div>
<div class="content">
    <table border="0" cellpadding="0" cellspacing="0" id="contractList">
        <tr style="height: 25px;">

            <!--<th width="5" height="25"></th>-->
            <th width="133" height="25">合同编号</th>
            <th width="250" height="25">客户名称</th>
            <th width="90" height="25">签约金额</th>
            <th style="text-align: center;" width="90" height="25">签约日期</th>

        </tr>
        <?php if(is_array($contractList)): foreach($contractList as $key=>$vo): ?><tr style="height: 25px;">
            <td>
                <input type="radio" name="more" value="<?php echo ($vo['contractId']); ?>" id="contract<?php echo ($vo[contractId]); ?>" <?php if($vo[contractId] == $_GET[contractId]): ?>checked<?php endif; ?> >
                <label for="contract<?php echo ($vo[contractId]); ?>" class="contractCode"><?php echo ($vo[contractCode]); ?></label>
            </td>
            <td style="padding-left: 10px;"><?php echo ($vo[ASignerName]); ?></td>
            <td style="padding-left: 10px;" class="money"><?php echo ($vo[money]); ?></td>
            <td style="text-align: center;"><?php echo ($vo[signDate]); ?></td>
        </tr><?php endforeach; endif; ?>
    </table>
    <div class="tfoot">
        <a href="javaScript:void(0);">首页</a>
        <a href="javaScript:void(0);">上一页</a>
        <a href="javaScript:void(0);">下一页</a>
        <a href="javaScript:void(0);">末页</a>
    </div>
</div>
<!--<div id="pagebar1" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA"></div>-->
<div class="foot">
    <input class="sub" type="button" onclick="do_submit()" value="确认">
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
    var selected_contractId = '<?php echo ($_GET[contractId]); ?>'; //选中的contractId,初始化值

    //选中合同
    $("#contractList").on("click","input[name=more]",function(){
        selected_contractId = $(this).val();
    });

    //确定提交,并给父窗口赋值
    function do_submit(){
        var selected_contractCode = $("#contract"+selected_contractId).siblings(".contractCode").text();
        var selected_money = $("#contract"+selected_contractId).parent().siblings(".money").text();

        //父窗口赋值
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.$("#contract").val(selected_contractCode);
        parent.$("#contract").attr("title",selected_contractCode);
        parent.$("#contract").attr("contract_id",selected_contractId);
        parent.$("#contractMoney").val(selected_money);
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

        $.post("<?php echo U('Office/getcontractList_ajax');?>", {"page":1, "pageSize":pageSize, "cusId":cusId, "contractSubject":keywords}, function(data) {

            totalPage = Math.ceil(parseInt(data.count)/pageSize);
            currentPage = 1;

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                loadcontractList(data);
            }

        }, 'json');
    });
    //首页
    $("#first_page").on("click",function(){

        if( currentPage == 1 ){
            return false;
        }

        var keywords = $("#keywords").val();


        $.post("<?php echo U('Office/getcontractList_ajax');?>", {"page":1, "pageSize":pageSize, "cusId":cusId, "contractSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage = 1;
                loadcontractList(data);
            }

        }, 'json');

    });
    //末页
    $("#last_page").on("click",function(){

        if( currentPage == totalPage ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/getcontractList_ajax');?>", {"page":totalPage, "pageSize":pageSize, "cusId":cusId, "contractSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage = totalPage;
                loadcontractList(data);
            }

        }, 'json');

    });
    //上一页
    $("#prev_page").on("click",function(){
        if( (currentPage-1)<= 0 ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/getcontractList_ajax');?>", {"page":currentPage-1, "pageSize":pageSize, "cusId":cusId, "contractSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage--;
                loadcontractList(data);
            }

        }, 'json');
    });
    //下一页
    $("#next_page").on("click",function(){

        if( (currentPage+1) > totalPage ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/getcontractList_ajax');?>", {"page":currentPage+1, "pageSize":pageSize, "cusId":cusId, "contractSubject":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage++;
                loadcontractList(data);
            }

        }, 'json');
    });


    /**
     * 加载联系人信息(公共部分)
     * @param data ajax返回的data数据
     */
    function loadcontractList(data){

        var html  = '<tr style="height: 25px;">';
        html +=     '<th width="117" height="25">名称</th>';
        html += ' </tr>';
        for( i in data.contractList ){

            var checked = ''; //是否选中
            if( data.contractList[i].contractId == selected_contractId ){  //如果是选中的商机id,则选中状态
                checked = 'checked';
            }

            html += '<tr style="height: 25px;">';
            html +=     '<td>';
            html +=         '<input type="radio" name="more" '+ checked +' value="'+ data.contractList[i].contractId + '" id="contract'+ data.contractList[i].contractId +'" >';
            html +=         '<label for="contract'+ data.contractList[i].contractId +'">' + data.contractList[i].contractSubject + '</label>';
            html +=     '</td>';
            html += '</tr>';
        }

        $("#contractList").html(html);
    }



</script>
</html>