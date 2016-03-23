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
        .head input[type=text]{height: 22px;padding-left: 25px;width: 162px;position: relative;border: 1px solid #ccc;margin-right: 7px;}
        .head i{color: #ccc; position: absolute;left: 15px;top: 6px;}
        .content{float: left;margin-left: 10px;}
        .content table{float: left;width: 250px;border: 1px solid #e2e0e0;border-collapse: collapse;text-align: left;margin: 20px 0 10px 0;}
        .content table  tr  td{border: 1px solid #e2e0e0;line-height: 20px;}
        .content table  tr  th{border: 1px solid #e2e0e0;background: #ddd;padding-left: 10px;font-size: 12px;font-weight: bold;text-align: left;}
        .foot{width:100%;float: left;text-align: center;margin: -20px 0 0 0;}
        .search{border:1px;height: 25px;width: 50px;background: #14bce1;color: #fff;cursor: pointer;}
        .sub{border:1px;height: 25px;width: 50px;background: #14bce1;color: #fff;cursor: pointer;margin-right: 10px;}
        .reset{border:1px;height: 25px;width: 50px;background: #eaeaea;color: #000;cursor: pointer;}
        .list {
            width: 240px;
            height: 306px;
            float: left;
            border: 1px solid #a4a4a4;

        }
        .list p {
            height: 26px;
            font-weight: bold;
            line-height: 26px;
            padding-left: 10px;
            margin-bottom: 4px;
            background: #ddd;
            margin: 0;
        }
        .list p .spmum {
            width: 190px;
            float: left;
        }
        .list p .spclear {
            width: 40px;
            float: right;
        }
         .list p .spclear a{
             background: rgb(249, 246, 249);
             color: #322E2E;
             border: 1px solid rgb(137, 131, 124);
             border-radius: 4px;
             padding: 2px;
        }


        .list ul{overflow-y:scroll; overflow-x:hidden; width:240px; height:280px; margin: -5px 0 0 -40px;}
        .list ul li{border:none; border-bottom:1px solid #dedede;height:27px; line-height:27px;padding-left:28px; clear:both; float:left; width:240px; background:url(../images/male_list.gif) 8px 8px no-repeat;}
        .list ul li span.tree_name{height:27px;line-height:27px; width:160px; display:block; float:left;overflow:hidden; white-space:nowrap;text-overflow:ellipsis;-o-text-overflow:ellipsis; -moz-binding:url(ellipsis.xml#ellipsis);}
        .list ul li span.tree_del{height:27px; width:25px;line-height:27px;display:block;float:left;overflow:hidden; white-space:nowrap;text-overflow:ellipsis;-o-text-overflow:ellipsis; -moz-binding:url(ellipsis.xml#ellipsis); padding-left:10px;}
        .list ul li span.tree_del a{color: red;}
        .structure {
            width: 270px;
            height: 346px;
            float: left;
            margin-right: 10px;
        }
        .container .structure .content{
            width: 241px;
            height: 311px;
        }
        .container{
            height: 358px;
            position: relative;
            overflow: hidden;}
        .tfoot{  width: 250px;
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


<div class="container">
    <div class="structure">
        <div class="head">
            <input type="text" id="keywords" />
            <i class="fa fa-search fa-lg" style=""></i>
            <input class="search" type="button" value="搜索"/>
        </div>
        <div class="content">

            <table border="0" cellpadding="0" cellspacing="0" id="customerClientList">
                <tr style="height: 25px;">

                    <!--<th width="5" height="25"></th>-->
                    <th width="117" height="25">名称</th>

                </tr>
                <?php if(is_array($customerClientList['list'])): foreach($customerClientList['list'] as $key=>$vo): ?><tr style="height: 25px;">
                    <td>
                        <input type="checkbox" name="lm" onclick="add_linkman(<?php echo ($vo['clientId']); ?>)" id="lm<?php echo ($vo['clientId']); ?>">
                        <label for="lm<?php echo ($vo['clientId']); ?>"><?php echo ($vo['clientName']); ?></label>
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
    </div>
    <div class="list">

            <p><span class="spmum">选择的成员</span><span class="spclear"><a href="javaScript:void(0);" onclick="clear_linkman()">清空</a></span></p>
            <ul id="selected_linkman">

            </ul>

    </div>
    <div class="foot">
        <input class="sub" type="button" onclick="do_submit()" value="确认">
        <input class="reset" type="button" onclick="reset()" value="取消">
    </div>



</div>
<!--<div id="pagebar1" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA"></div>-->

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

    //初始化
    var select_ids = '<?php echo ($_GET["linkman_ids"]); ?>'; //选中的id数组集合
    if( select_ids == '' ){ //打开弹窗时没有选择过联系人
        select_ids = [];
    }else{  //选择过联系人第二次打开,把ids以逗号间隔的格式改为数组格式初始化，并让选择处出现初始值
        var new_select_ids = [];
        new_select_ids = select_ids.split(",");
        var new_arr = [];
        var html = '';

        //页面选择过的联系人初始化
        for( var i in new_select_ids ){
            new_arr[new_select_ids[i]] = parseInt(new_select_ids[i]);
            $("#lm"+new_select_ids[i]).prop("checked","checked");

            html += '<li id="selected'+ new_select_ids[i] +'">';
            html +=      '<span class="tree_name">'+ $("#lm"+new_select_ids[i]).siblings().text() +'</span>';
            html +=      '<span class="tree_del"><a href="javaScript:void(0);" class="fa fa-trash" onclick="del_linkman('+ new_select_ids[i] +')"></a></span>';
            html += '</li>';
        }
        $("#selected_linkman").append(html);
        select_ids = new_arr;
    }

    //删除数组指定下标的键值
    function array_remove(arr,key){
        var new_arr = [];
        for( var i in arr ){
            if( i != key ){
                new_arr[i] = arr[i];
            }
        }

        arr = new_arr;
        return arr;
    }


    //确定提交,并给父窗口赋值
    function do_submit(){

        //重组数组从0开始
        var select_name = []; //选中的联系人姓名数组集合
        var new_select_ids = [];
        var j = 0;
        for( var i in select_ids ){
            new_select_ids[j] = select_ids[i];

            //通过id拼接姓名字符串
            select_name[j] = $("#selected"+select_ids[i]).text();
            j++
        }

        //拼接成id字符串
        select_ids = new_select_ids.join();
        select_name = select_name.join();

        //父窗口赋值
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.$("#linkman").val(select_name);
        parent.$("#linkman").attr("title",select_name);
        parent.$("#linkman").attr("linkman_ids",select_ids);
        parent.layer.close(index);

    }

    //取消
    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }

    //选中联系人
    function add_linkman(lmId){
        var checked = $("#lm"+lmId).prop("checked");
        var lmName = $("#lm"+lmId).siblings().text();

        if( checked == true ){ //选中了
            var html  = '<li id="selected'+ lmId +'">';
                html +=      '<span class="tree_name">'+ lmName +'</span>';
                html +=      '<span class="tree_del"><a href="javaScript:void(0);" class="fa fa-trash" onclick="del_linkman('+ lmId +')"></a></span>';
                html += '</li>';

            select_ids[lmId] = lmId; //添加选择的用户id到id集合
            $("#selected_linkman").append(html);
        }else{  //没选中，删除
            select_ids = array_remove(select_ids,lmId); //从id集合中删除
            $("#selected"+lmId).remove();
        }

    }

    //删除选中联系人
    function del_linkman(lmId){
        $("#selected"+lmId).remove();
        $("#lm"+lmId).prop("checked",false);
        select_ids = array_remove(select_ids,lmId); //从id集合中删除
    }

    //清空选中联系人
    function clear_linkman(){
        $("#selected_linkman").html("");
        $("input[type=checkbox][name=lm]:checked").prop("checked",false);
        select_ids = [];
    }

    //分页
    var currentPage = parseInt('<?php echo ($page[current]); ?>');
    var totalPage = parseInt('<?php echo ($page[total]); ?>');
    var pageSize = parseInt('<?php echo ($page[size]); ?>');
    //搜索
    $(".search").on("click",function(){
        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/searchCusClient_ajax');?>", {"page":1, "pageSize":pageSize, "cusClientName":keywords}, function(data) {

            totalPage = Math.ceil(parseInt(data.count)/pageSize);
            currentPage = 1;

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                loadClientList(data);
            }

        }, 'json');
    });
    //首页
    $("#first_page").on("click",function(){

        if( currentPage == 1 ){
            return false;
        }

        var keywords = $("#keywords").val();


        $.post("<?php echo U('Office/searchCusClient_ajax');?>", {"page":1, "pageSize":pageSize, "cusClientName":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage = 1;
                loadClientList(data);
            }

        }, 'json');

    });
    //末页
    $("#last_page").on("click",function(){

        if( currentPage == totalPage ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/searchCusClient_ajax');?>", {"page":totalPage, "pageSize":pageSize, "cusClientName":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage = totalPage;
                loadClientList(data);
            }

        }, 'json');

    });
    //上一页
    $("#prev_page").on("click",function(){
        if( (currentPage-1)<= 0 ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/searchCusClient_ajax');?>", {"page":currentPage-1, "pageSize":pageSize, "cusClientName":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage--;
                loadClientList(data);
            }

        }, 'json');
    });
    //下一页
    $("#next_page").on("click",function(){

        if( (currentPage+1) > totalPage ){
            return false;
        }

        var keywords = $("#keywords").val();

        $.post("<?php echo U('Office/searchCusClient_ajax');?>", {"page":currentPage+1, "pageSize":pageSize, "cusClientName":keywords}, function(data) {

            if(data.error_code != 'success') {
                layer.msg(data.error_text,{icon: 8});
            } else {
                currentPage++;
                loadClientList(data);
            }

        }, 'json');
    });


    /**
     * 加载联系人信息(公共部分)
     * @param data ajax返回的data数据
     */
    function loadClientList(data){
        var html  = '<tr style="height: 25px;">';
        html +=     '<th width="117" height="25">名称</th>';
        html += '</tr>';
        for( i in data.list ){

            var checked = ''; //是否选中
            if( $.inArray(parseInt(data.list[i].clientId),select_ids) != -1 ){  //不包含在数组中则返回-1
                checked = 'checked';
            }

            html += '<tr style="height: 25px;">';
            html +=     '<td>';
            html +=         '<input type="checkbox" name="lm" '+ checked +' onclick="add_linkman('+ data.list[i].clientId +')" id="lm'+ data.list[i].clientId +'">';
            html +=         '<label for="lm'+ data.list[i].clientId +'">'+ data.list[i].clientName +'</label>';
            html +=     '</td>';
            html += '</tr>';
        }

        $("#customerClientList").html(html);
    }







</script>
</html>