<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>招商APP管理平台::任务审核</title>
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

<style type="text/css">   
.list {
    width: 100%;
    padding-left: 15px;
    padding-right: 15px;
    background-color: #fff;
    height: 100%;
}

body{
    width: 100%;height: 100%; background-color: #fff;
}
.listinfo {   
    padding-top:10px;
    float: left;
    line-height: 40px;
    width:82%;
    text-align: center;
    background-color: #fff;
    border: 1px #ecf0f5 solid;
}   

.tabli{
    /*float: left;*/
    padding-left: 22.5%;
    line-height: 40px;
    width: 100%;
    text-align: center;
    line-height: 40px;
    background-color: #ecf0f5;
    overflow: hidden;
    cursor: pointer;
}

#tabli_bid .selected{
    background-color: #fff;
}

.listinfo1 {   
    float: right;
    line-height: 40px;
    width: 78%;
    text-align: center;
    background-color: #fff;
    border: 0px #ecf0f5 solid;
    overflow: hidden;
} 

.listinfo2 {   
    width: 100%;
    text-align: center;
    overflow: hidden;
} 

.checkBtn{
    float: left;
    /*margin: 470px 0 20px -84%;*/
    width: 82%;
    height: 40px;
    /*position: fixed;*/
    /*z-index: 999;*/
   overflow:hidden;
    margin-left: 20px;
    border: 0px;
    margin-top: 5px;
    margin-bottom: 5px;

}

.page2{
    padding-left:15px;
    margin: -85px 0 0px 2px;
    overflow: hidden;
    width:100%;
    clear: both;
    /*position: fixed;*/
}

ul{
    overflow:hidden;
}

#search{
    background-color: #fff;
    color: #fff;
}

#tabli_bid .action .selected {
     background-color: #3c8dbc; 
}

</style> 
<script language="JavaScript">
    function responseMouseEvent(obj,type)
    {
        if(type==1){
            obj.style.backgroundColor = "#6699CC"
        }else if(type==2){
            obj.style.backgroundColor = "#FFFFFF"
        } 
    }

    function responseClickEvent(obj)
    {
        if(obj.children[0].checked==true)
            { 
                obj.children[0].checked = false;
                obj.style.backgroundColor = "#FFFFFF" 
                obj.onmouseover = function(){responseMouseEvent(obj,1);};
                obj.onmouseout = function(){responseMouseEvent(obj,2);};
                $('.listinfo2').empty();
        }else{
                $("input[name='pubTaskId']:checked").each(function () 
                {
                    var key  = $(this).val();
                    $('input[name=pubTaskId]').attr('checked',false);
                    $(this).parent().css('background-color','white');
                });

                var taskid = $("input[name='pubTaskId']:checked");

                if(taskid.length===0){
                    obj.children[0].checked = true;
                    obj.style.backgroundColor = "#DFD027";
                    obj.onmouseover = null;
                    obj.onmouseout = null;
                }

                // $.post(APP+"/Api/web/getDealerExport",
                // "taskid="+obj.children[0].value);
                Cookie.createCookie('taskid',obj.children[0].value,1);
                plist_dealer(obj.children[0].value,0);
        }
    }

 </script>
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
                <div class="breadlist">首页 / 任务审核</div>
                <div class="tabli">
                    <ul id="tabli_bid">
                        <li value="0" class='selected' onclick="use_plist_dealer(0)">待审核<span id="waitReview"></span></li>
                        <li value="1" onclick="use_plist_dealer(1)">已中标<span id="alreadyReview"></span></li>
                        <li value="2" onclick="use_plist_dealer(2)">已驳回<span id="noReview"></span></li>
                        <li value="3" onclick="use_plist_dealer(3)">已推荐<span id="submitCompany"></span></li>
                        <ul class="action">
                            <li id="bid" value="1">推荐</li>
                            <li id="rejectdealer" value="2">驳回</li>
                            <!-- <span id="dealerExport" value="2"><a href="/wisdom/index.php/Taskadmin/Review/dealerExport" style="text-decoration:none;color:white;background-color:black;">导出</a></span> -->
                        </ul>
                    </ul>
                </div>
                <div class="list" >

                    <div class='listinfo1'>
                        <ul>
                            <li style='width:5%;'>选择</li>
                                <li style='width:15%;'>序号</li>
                                <li style='width:15%;'>分数</li>
                                <li style='width:20%;'>业务员名称</li>
                                <li style='width:35%;'>经销商名称</li>
                                <li style='width:10%;'>时间</li>
                        </ul>
                        <div class='listinfo2'></div>
                        <div class="page"></div>
                    </div>

                    <div style="overflow: hidden;">
                        <ul style="margin-left:20px;width:100%;" id="search">
                            <li id="tabid" value="1" style="width:82%;">
                                <input name="searchTname" id="searchTname" value="" placeholder="请输入任务名称" style="height: 40px;width:100%;color: black;">
                                <input type="hidden" name="searchTid" id="searchTid" value="0">
                            </li>
                        </ul>

                        <div style="clear:both;"></div>
                        <div class='listinfo' style="margin-left:20px;">任务列表</div>
                        <button  id="checkBtn" class="checkBtn"  onClick="showDetail()" >查看任务详情</button>
                        <div class="page2"></div>
                    </div>

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
        
        
        //获取列表信息
        plist_publish();
    });
    
    //查找任务

    $("#searchTname").bigAutocomplete({width:300,
        url:"<?php echo U('Taskadmin/Fun/searchTname');?>",
        callback:function(data){
            console.log(data.result);
            $('#searchTid').val(data.result);
            plist_dealer(data.result);
            $('.listinfo').empty();
                    var html = '';
            $.post(APP+"/Api/Web/getReturnTitle","f_tid="+data.result,function(v){
                    // console.log(v.result);
                    html += "<ul>";
                    html += "<li style='width:100%;cursor:pointer;text-align:left;background-color: rgb(223, 208, 39);text-align:center;' class='showDetail' onclick='responseClickEvent(this);' onmouseover='responseMouseEvent(this,1);' onmouseout='responseMouseEvent(this,2)' id='publishTask"+v.f_tid+"'><input name='pubTaskId' style='margin: 14px 15px 0px;line-height: normal;float:left;display:none;' type='checkbox' checked='checked' value='"+v.f_tid+"'>"+v.f_title+"</li><br>";
                    html += "</ul>";

                    $('.listinfo').append(html);
                },'json');
        }
    });
    
    function use_plist_dealer(state){
         plist_dealer(Cookie.readCookie('taskid'),state);
    }

    </script>
</html>