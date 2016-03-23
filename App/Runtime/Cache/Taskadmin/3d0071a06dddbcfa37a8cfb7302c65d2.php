<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>经销商管理</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            //var 
            //var UPFILE = "/wisdom/Public/upfile";
            var IMG = "/wisdom/Public/Taskadmin/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Taskadmin/Default";
            var accessVal = true;
        </script>
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/jquery.bigautocomplete.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/laypage/skin/laypage.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/layer/skin/layer.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/laydate/need/laydate.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/laydate/skins/default/laydate.css" />
<!--        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />-->
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Taskadmin/Default/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
<!--        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.min.css" />-->

<body>
<div class="adminB">
    <div class="adminMenu">
    <div class="menutop">招商管理平台</div>
    <div class="menupro">
        <div class="headimg"></div>
    </div>
    <div class="menutitle"><span class="icon-reorder"></span> MAIN NAVIGATION</div>
    <ul class="menuul">
        <li onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"><span class="icon-tasks"></span>&nbsp;&nbsp;&nbsp;&nbsp;任务管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Review/index?access=200'"><span class="icon-group"></span>&nbsp;&nbsp;&nbsp;&nbsp;任务审核</li>
        <li onclick="location.href = APP+'/Taskadmin/Sales/index?access=300'"><span class="icon-group"></span>&nbsp;&nbsp;&nbsp;&nbsp;业务员管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;企业管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Ad/index?access=500'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;活动与广告</li>
        <li onclick="location.href = APP+'/Taskadmin/Withdraw/index?access=600'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;提现管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Salesreport/index'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;报表中心</li>
        <li onclick="location.href = APP+'/Taskadmin/DealerPro/index?access=800'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;招商进度管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Shop/index?access=900'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;产品列表管理</li>
        <li onclick="location.href = APP+'/Taskadmin/ShopRecord/index?access=1000'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;消费记录管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Power/index?access=1400'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;权限部署</li>
        <li onclick="location.href = APP+'/Taskadmin/Dealer/index?access=1100'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;经销商管理</li>
        <li onclick="location.href = APP+'/Taskadmin/BehaviorAnalysis/index?access=1200'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;用户行为分析</li>
        <li onclick="location.href = APP+'/Taskadmin/UserInfo/index?access=1300'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;用户信息管理</li>
        <!--<li onclick="location.href = APP+'/Taskadmin/Report/index'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;统计报表</li>-->
    </ul>
</div>
    <div class="adminRight">
        <div class="righttop">
    <div class="showright"><span id="home_back" class="fa fa-user" style="cursor: pointer;margin-right: 20px;">返回首页</span> <span id="user_setting" class="fa fa-user">个人设置</span> <span id="user_out" class="fa fa-sign-out">退出登录</span></div>
</div>
        <div class="breadlist">首页 / 经销商管理</div>
        <div class="tabli">

            <ul id="tabli_bid">
                <li value="0" class="selected">经销商列表</li>
                <li value="1" class='' id="messages" ><a href="/wisdom/index.php/Taskadmin/Dealer/linkReport" style="text-decoration:none;color:black;">联系报表</a></li>
            </ul>
            <ul class="">
                <div class="field" id="searchform">
                  <input type="text" id="searchdealername" placeholder="请输入公司名" style="width:140px;height: 30px;line-height: 30px;"/>
                  <!-- <input type="text" id="searchindustrytype" placeholder="请输入行业" style="width:140px;height: 30px;line-height: 30px;"/> -->
                  <select id="searchindustrytype" style="width:140px;height: 30px;line-height: 30px;">
                      <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo1[f_industrytype]); ?>"><?php echo ($vo1[f_industrytype]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
<!--                   <select id="searchindustrytype">
                    <option value="1"></option>
                  </select> -->
                  <input type="text" id="searcharea" placeholder="请输入区域" style="width:140px;height: 30px;line-height: 30px;"/>
                  <!-- <input type="text" id="searchstatus" placeholder="请输入状态" /> -->
                  <select id="searchstatus" style="width:120px;height: 30px;">
                      <option value="0">未联系</option>
                      <option value="1">已接通</option>
                      <option value="2">关机</option>
                      <option value="3">不愿回访</option>
                      <option value="4">空号</option>
                      <option value="5">没人接</option>
                      <option value="6">同事</option>
                  </select>
                  <button type="button" id="searchdealer" style="width:60px;height: 30px;line-height: 30px;border: 0px;background:#3c8dbc;color: #fff;">搜索</button>
                  <button type="button" id="modi" style="width:60px;height: 30px;line-height: 30px;border: 0px;background:#3c8dbc;color: #fff;">编辑</button>
                  <button type="button" id="searchdealer" style="width:60px;height: 30px;line-height: 30px;border: 0px;background:#3c8dbc;color: #fff;"><a href="/wisdom/index.php/Taskadmin/Dealer/explodeAll" style="text-decoration:none;color:white;">导出</a></button>
                 <!--  <span id="explodeAll" value="0"><a href="/wisdom/index.php/Taskadmin/Report/explodeAll" style="text-decoration:none;color:white;width:60px;height: 30px;line-height: 30px;border: 0px;background:#3c8dbc;color: #fff;font-size:15px;">导出</a></span> -->
                </div>
            </ul>

            <!--<ul class="action">-->
                <!--<li id="companyBid" value="1">审核</li>-->
                <!--<li id="companyReject" value="2">驳回</li>-->
                <!--<li id="companyAdd" value="3">导入企业</li>-->
            <!--</ul>-->
        </div>

        <div class="list">
            <ul>
                <li style='width:5%;'><input id="allcheck" type='checkbox' value='0'></li>
                <li style='width:20%;'>公司全称</li>
                <li style='width:15%;'>所处行业</li>
                <li style='width:10%;'>所在区域</li>
                <li style='width:10%;'>手机号</li>
                <li style='width:10%;'>电话</li>
                <li style='width:10%;'>负责人</li>
                <li style='width:10%;'>渠道</li>
                <li style='width:10%;'>状态</li>
            </ul>
            <div class='listinfo'>
                <ul>
                    <li style='width:100%;'>暂无数据</li>
                </ul>
            </div>
            <div class="page"></div>
        </div>

    </div>
</div>
</body>
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/jquery.bigautocomplete.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laypage/laypage.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Taskadmin/Default/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/page.js"></script>

    <!--ueditor编译器源码文件-->
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>

    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>

    <script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script>
<script>
    $(function(){
        var searchdealername="",searchindustrytype="",searcharea="",searchstatus="";
        //获取列表信息
        plist_dealer_list(searchdealername,searchindustrytype,searcharea,searchstatus);
        $("#searchdealer").click(function(){
            searchdealername = $("#searchdealername").val();
            searchindustrytype = $("#searchindustrytype").val();
            searcharea = $("#searcharea").val();
            searchstatus = $("#searchstatus").val();
            //console.log(searchdealername+searchindustrytype+searcharea+searchstatus);

            plist_dealer_list(searchdealername,searchindustrytype,searcharea,searchstatus);
        });
    });


    $("#modi").click(function(){
        var taskid = $("input[name='dealermodiid']:checked");
        if (taskid.length === 0) {
            layer.msg("请选择要修改的记录", {'icon': 8});
            return false;
        } else if (taskid.length > 1) {
            layer.msg("修改只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        } else {
            layer.open({
                title: '修改信息',
                type: 2,
                area: ['1000px', '600px'],
                content: APP + '/Taskadmin/Dealer/modi?id=' + taskid.val()
            });
        }
    });


    function setStatus(id,selectId){
        if(selectId!==0 || selectId!=='0'){
            layer.confirm('变更记录状态', {icon: 3}, function(ind){
                $.getJSON("<?php echo U('Fun/modidearlestatus');?>","id="+id+"&selectId="+selectId);//改变状态
                layer.close(ind);
                if(selectId===1 || selectId==='1'){
                    //alert(selectId);
                    index = layer.open({
                        title: '填写说明',
                        type: 2,
                        area: ['650px', '640px'],
                        content: APP+'/Taskadmin/Dealer/addShowNote?selectId='+selectId+ '&id='+id
                    });
                }

            });
        }

    }
</script>
</html>