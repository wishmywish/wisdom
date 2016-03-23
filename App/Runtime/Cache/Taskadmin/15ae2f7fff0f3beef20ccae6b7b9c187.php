<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>招商APP管理平台</title>
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

<script type="text/javascript" src="/wisdom/Public/static/js/justgage-1.1.0.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/justgage-1.1.0.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/raphael-2.1.4.min.js"></script>
<style type="text/css">
body{
    margin: 0;
    padding: 0;
    background-color: #fff;
}
.container {
    float: left;
    margin: 10px;
}

  .gauge {
    width: 160px;
    height:160px;
    line-height:160px;
    border:1px  solid  gray;
    float: left;
    cursor:pointer;
}
  .title{
    font-size: 20px;
    font-weight:bold;
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
                <div class="breadlist">首页 / 招商APP管理平台</div>
                <input type="hidden" id="f_tasktypeid" value="<?php echo ($f_tasktypeid); ?>">
                <div class="container" style="width: 680px;">
                    <div class="title">上报经销商数据统计</div>
                    <div id="gd1" class="gauge" onclick="location.href = APP+'/Taskadmin/Review/index?access=200'"></div>
                    <div id="gd2" class="gauge" onclick="location.href = APP+'/Taskadmin/Review/index?access=200'"></div>
                    <div id="gd3" class="gauge" onclick="location.href = APP+'/Taskadmin/Review/index?access=200'"></div>
                    <div id="gd4" class="gauge" onclick="location.href = APP+'/Taskadmin/Review/index?access=200'"></div>
                </div>
                <div class="container" style="width: 1300px;">
                    <div class="title">注册企业数据统计</div>
                    <div id="gc1" class="gauge" onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"></div>
                    <div id="gc2" class="gauge" onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"></div>
                    <div id="gc3" class="gauge" onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"></div>
                    <div id="gc4" class="gauge" onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"></div>
                    <div id="gc5" class="gauge" onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"></div>
                    <div id="gc6" class="gauge" onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"></div>
                </div>
                <div class="container" style="width:1500px;">
                    <div class="title">任务数据分类统计</div>
                    <div class="tabli">
                        <ul id="tabli_task">
                            <li value="0" id="push" onclick="location.href = APP+'/Taskadmin/Index/main?f_tasktypeid=1'">推广赚</li>
                            <li value="1" id="widely" class='selected' onclick="location.href = APP+'/Taskadmin/Index/main'">随手赚</li>
                            <li value="2" id="business" onclick="location.href = APP+'/Taskadmin/Index/main?f_tasktypeid=3'">招商赚</li>
                         </ul>
                    </div>
                    <div id="gt1" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt2" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt3" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt4" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt5" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt6" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt7" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt8" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
                    <div id="gt12" class="gauge" onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"></div>
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
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            var gd1 = new JustGage({
              id: "gd1",
              title: "<?php echo ($dealer["0"]["text"]); ?>",
              value : "<?php echo ($dealer["0"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($dealer["0"]["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              // customSectors: [{
              //   color : "<?php echo ($dealer["0"]["color"]); ?>",
              // }],
              counter: true
            });
            var gd2 = new JustGage({
              id: "gd2",
              title: "<?php echo ($dealer["1"]["text"]); ?>",
              value : 192,
              min: 0,
              max: <?php echo ($dealer["1"]["allCount"]); ?>,
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gd3 = new JustGage({
              id: "gd3",
              title: "<?php echo ($dealer["2"]["text"]); ?>",
              value : <?php echo ($dealer["2"]["count"]); ?>,
              min: 0,
              max: <?php echo ($dealer["2"]["allCount"]); ?>,
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gd4 = new JustGage({
              id: "gd4",
              title: "<?php echo ($dealer["3"]["text"]); ?>",
              value : <?php echo ($dealer["3"]["count"]); ?>,
              min: 0,
              max: <?php echo ($dealer["3"]["allCount"]); ?>,
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gc1 = new JustGage({
              id: "gc1",
              title: "<?php echo ($company["0"]["text"]); ?>",
              value : "<?php echo ($company["0"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($company["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              // customSectors: [{
              //   color : "<?php echo ($dealer["0"]["color"]); ?>",
              // }],
              counter: true
            });
            var gc2 = new JustGage({
              id: "gc2",
              title: "<?php echo ($company["1"]["text"]); ?>",
              value : "<?php echo ($company["1"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($company["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gc3 = new JustGage({
              id: "gc3",
              title: "<?php echo ($company["2"]["text"]); ?>",
              value : "<?php echo ($company["2"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($company["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gc4 = new JustGage({
              id: "gc4",
              title: "<?php echo ($company["3"]["text"]); ?>",
              value : "<?php echo ($company["3"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($company["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gc5 = new JustGage({
              id: "gc5",
              title: "<?php echo ($company["4"]["text"]); ?>",
              value : "<?php echo ($company["4"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($company["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gc6 = new JustGage({
              id: "gc6",
              title: "<?php echo ($company["5"]["text"]); ?>",
              value : "<?php echo ($company["5"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($company["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt1 = new JustGage({
              id: "gt1",
              title: "<?php echo ($task["0"]["text"]); ?>",
              value : "<?php echo ($task["0"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt2 = new JustGage({
              id: "gt2",
              title: "<?php echo ($task["1"]["text"]); ?>",
              value : "<?php echo ($task["1"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt3 = new JustGage({
              id: "gt3",
              title: "<?php echo ($task["2"]["text"]); ?>",
              value : "<?php echo ($task["2"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt4 = new JustGage({
              id: "gt4",
              title: "<?php echo ($task["3"]["text"]); ?>",
              value : "<?php echo ($task["3"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt5 = new JustGage({
              id: "gt5",
              title: "<?php echo ($task["4"]["text"]); ?>",
              value : "<?php echo ($task["4"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt6 = new JustGage({
              id: "gt6",
              title: "<?php echo ($task["5"]["text"]); ?>",
              value : "<?php echo ($task["5"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt7 = new JustGage({
              id: "gt7",
              title: "<?php echo ($task["6"]["text"]); ?>",
              value : "<?php echo ($task["6"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt8 = new JustGage({
              id: "gt8",
              title: "<?php echo ($task["7"]["text"]); ?>",
              value : "<?php echo ($task["7"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
            var gt12 = new JustGage({
              id: "gt12",
              title: "<?php echo ($task["11"]["text"]); ?>",
              value : "<?php echo ($task["11"]["count"]); ?>",
              min: 0,
              max: "<?php echo ($task["allCount"]); ?>",
              decimals: 0,
              gaugeWidthScale: 0.6,
              counter: true
            });
      });

       $(function(){
            if(1==$('#f_tasktypeid').val()||"1"==$('#f_tasktypeid').val()){
                $('#widely').removeClass('selected');
                $('#push').attr('class','selected');
            }else if(3==$('#f_tasktypeid').val()||"3"==$('#f_tasktypeid').val()){
                $('#widely').removeClass('selected');
                $('#business').attr('class','selected');
            }
        });
    </script>
</html>