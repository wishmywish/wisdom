<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>业务员管理</title>
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
/*@import url(http://fonts.googleapis.com/css?family=Montserrat+Alternates);*/

.field {
  display:flex;
  position:realtive;
  margin:0 5em;
  width:50%;
  flex-direction:row;
/*  box-shadow:
   1px 1px 0 rgb(22, 160, 133),
   2px 2px 0 rgb(22, 160, 133),
   3px 3px 0 rgb(22, 160, 133),
   4px 4px 0 rgb(22, 160, 133),
   5px 5px 0 rgb(22, 160, 133),
   6px 6px 0 rgb(22, 160, 133),
   7px 7px 0 rgb(22, 160, 133)
  ;*/
}

.field>input[type=text],
.field>button {
  display:block;
  font:1.2em 'Montserrat Alternates';
}

.field>input[type=text] {
  flex:1;
  padding:0.6em;
  border:0.2em solid #3c8dbc;
}

.field>button {
  padding:0.6em 0.8em;
  border:0px;
  background-color:#3c8dbc;
  color:white;
}
</style>
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
                <div class="breadlist">首页 / 业务员管理</div>

                <div class="tabli">
                    <ul id="tabli_bid">
                        <li value="1" class='<?php if(($classtype) == "1"): ?>selected<?php endif; ?>'><a href="<?php echo U('Taskadmin/Sales/index',array('access'=>300));?>" style="color:black;text-decoration: none;">全部</a><span id="all"></span></li>
                        <li value="2" class='<?php if(($classtype) == "2"): ?>selected<?php endif; ?>'><a href="<?php echo U('Taskadmin/Sales/realName');?>" style="color:black;text-decoration: none;">已实名认证</a><span id="name"></span></li>
                    </ul>
                    <ul class="">
                        <div class="field" id="searchform">

                          <select id='talkType'>
                              <option value="0">未联系</option>
                              <option value="1">已接通</option>
                              <option value="2">关机</option>
                              <option value="3">不愿回访</option>
                              <option value="4">空号</option>
                              <option value="5">没人接</option>
                              <option value="6">同事</option>
                          </select> &nbsp;
                          <!-- <input type="text" id="searchindustrytype" placeholder="请输入行业" />&nbsp; -->

                          <select id="searchindustrytype">
                              <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($vo1[f_industrytype]); ?>"><?php echo ($vo1[f_industrytype]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                          </select>&nbsp;

                          <input type="text" id="searchterm" placeholder="请输入区域"/>
                          <button type="button" id="search">搜索!</button> &nbsp;&nbsp;
                          <button type="button" id="modi" style="width:60px;height: 40px;line-height: 30px;border: 0px;background:#3c8dbc;color: #fff;">编辑</button>
                        </div>
                    </ul>
                </div>

                <div class="list">
                    <ul>
                        <li style='width:5%;'><input id="allcheck" type='checkbox' value='0'></li>
                        <li style='width:10%;'>手机号</li>
                        <li style='width:20%;'>昵称</li>
                        <li style='width:15%;'>姓名</li>
                        <li style='width:10%;'>区域</li>
                        <li style='width:15%;'>行业</li>
                        <li style='width:10%;'>注册时间</li>
                        <li style='width:15%;'>电话联系情况</li>
                    </ul>
                    <div class='listinfo'>
                        <ul>
                            <li style='width:100%;'>暂无业务员数据</li>
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
        plist_FSales();

        $("#search").click(function(){
            var searchterm = $("#searchterm").val();
            var talkType = $("#talkType").val();
            var searchindustrytype = $("#searchindustrytype").val();
            // if(searchterm===""){
            //     if (talkType==-1 || talkType=='-1') {
            //         plist_FSales();
            //     }else{
            //         plist_FSales(2,0,talkType);
            //     };
                
            // }else{
            //     if (talkType==-1 || talkType=='-1') {
            //         plist_FSales(2,searchterm,-1);
            //     }else{
            //         plist_FSales(2,searchterm,talkType);
            //     };
            // }
            plist_FSales(2,searchterm,talkType,searchindustrytype);
        });

        $("#modi").click(function(){
            var taskid = $("input[name='fsalesid']:checked");
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
                    area: ['600px', '350px'],
                    content: APP + '/Taskadmin/Sales/modi?id=' + taskid.val()
                });
            }
        });

        function showNote(saleId,count)
        {
            if(count!==0 || count!=='0'){
                layer.confirm('变更记录状态', {icon: 3}, function(ind){
                    $.getJSON("<?php echo U('Fun/modisalestatus');?>","saleId="+saleId+"&selectId="+count);//改变状态
                    layer.close(ind);
                    if(count===1 || count==='1'){
                        //alert(selectId);
                        index = layer.open({
                            title: '填写说明',
                            type: 2,
                            area: ['650px', '640px'],
                            content: APP+'/Taskadmin/Sales/addShowNote?selectid='+count+ '&saleId='+saleId
                        });
                    }

                });
            }
        }
    </script>
</html>