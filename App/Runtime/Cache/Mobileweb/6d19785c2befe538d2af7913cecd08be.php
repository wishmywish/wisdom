<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <head>
        <title><?php echo ($taskinfo["info"]["f_title"]); ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/Mobileweb/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Mobileweb/Default";
        </script>

        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
    </head>

    <body>
        <div data-role="page">
            <div role="main" class="ui-content">
                <ul class="helplist" style="margin: 5%;color: #a6a6a6">
                    <!--<li id="one">问：小宝招商为什么还有推广赚，随手赚？</li>-->
                    <!--<div id="onea" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;小宝招商，是一款为各行业有资源有能力的营销人提供额外赚钱的神器！前期我们重点针对各行业营销人员提供帮助企业招商为主的APP悬赏任务，完成招商任务获得高额佣金，轻松超过工资所得；同时，为了让营销经验不是太丰富、客户资源不是太广泛的其他人员也有赚钱的机会，小宝招商平台推出了在日常工作中顺带完成的各类随手赚任务，每天都有轻松惊喜收入；人人都可以进行的、一键分享转发到微信朋友圈、新浪微博、QQ空间就可完成的推广赚任务，赚钱的同时还能与朋友分享有趣的话题；大钱小钱大家赚，让韦小宝的通吃精神发扬光大。</div>-->
                    <li id="one">问：在小宝招商能做什么？</li>
                    <div id="onea" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;小宝招商，是营销人获得额外收入的一个赚钱创业平台，可以做招商任务，获得高额佣金；做推广、宣传、调研、推荐、问答、试用等悬赏任务获得金额不等的佣金。企业在小宝官网发布任务，任务自动显示在APP用户端供营销人选择。</div>
                    <li id="two">问：如何参与招商赚？</li>
                    <div id="twoa" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;01.在招商赚任务列表，点击合适的招商任务；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;02.点击“推荐经销商参与”按钮，录入经销商信息（可通讯录导入，也可手动）;<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;03.等待厂家选择中标；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;04.线下洽谈、合同签订、打款发货，与传统开发客户流程一样；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;05.经销商支付货款后，结算佣金；
                    </div>
                    <li id="three">问：我推荐的经销商被厂家直接谈成怎么办？</li>
                    <div id="threea" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;销售员推荐的经销商信息，平台保证对推荐信息保密安全；
                        中标前厂家与平台人员均无法获得信息联系方式，中标后销售员即获得合法授权，授权期间无论厂家直接洽谈或派人协助洽谈，从而完成该客户的合同成交，成果与佣金奖励均归中标人。否则平台将把预缴的诚信金直接扣除发给中标人。
                        同时，客户是销售人员的人脉资源，一个陌生的厂方代表与一个陌生的经销商，很难在缺少信任的基础上建立合作，这一切都离不开推荐者的居间撮合。</div>
                    <li id="four">问：如何参与推广赚？</li>
                    <div id="foura" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;在推广赚任务列表，进入任一任务，点击底部“我要分享”，分享至自媒体朋友圈即可，并选择返回小宝招商即可获得佣金。</div>
                    <li id="five">问：如何参与随手赚？</li>
                    <div id="fivea" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;在随手赚任务列表，选择随手任务，点击“立即参与”，根据提示完成任务即可获得奖励。</div>
                    <li id="six">问：金币、银票有什么用？</li>
                    <div id="sixa" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;任务佣金通过金币发放，10金币=1元人民币，金币可申请提现；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;银票主要和会员等级权益有关，后续会有更多银票特权，敬请期待。</div>
                    <li id="seven">问：会员等级规则</li>
                    <div id="sevena" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;会员等级与金币、银票、任务完成数、会员活跃度都有关。会员等级越高，可享受的会员权益、会员福利也越多。</div>
                    <li id="eight">问：金币如何提现？</li>
                    <div id="eighta" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;账户金币达300个，就可以申请提现，需完成实名认证和银行支付宝帐户绑定。<br>
                        进入“我的”页面，点击“我要提现” 输入提现金额，提交申请即可。一般3个工作日左右到账，由于不同网络支付环境出现延迟或其他情况，请耐心等候。也可通过小宝招商微信公众号（xbzs0571)后台留言，或官网及时联系客服。</div>
                    <li id="nine">问：邀请好友注册有什么好处？</li>
                    <div id="ninea" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;您邀请的好友，按邀请码或邀请链接领取注册，好友自动成为你的一级下线，好友邀请的好友将自动成为你的二级下线，当下线完成任务佣金时，平台额外给你三级奖励。
                        你可获得一级下线任务佣金5%的额外奖励；二级下线任务佣金1%的额外奖励。</div>
                    <li id="ten">问：邀请好友的三种方式？</li>
                    <div id="tena" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;在小宝招商APP，邀请好友成为下级有三种方法：<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;第一，通过首页“邀请好友”活动分享页，好友填写手机号领取、并下载注册即可。<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;第二，通过首页“抢红包”活动分享页，好友填写手机号领取、并下载注册即可。<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;第三，通过好友注册时填写您的“邀请码”注册即可。邀请码可在你分享的任务底下获取。</div>
                    <li id="qes1">问：如何看到我的三级奖励？</li>
                    <div id="qes1a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;在底栏目“我的”的“我的金币”页面，可以看到来自一级或二级下线完成任务时自动给您的额外奖励。</div>
					<li id = "qes2">问：为什么要实名认证？</li>
                    <div id="qes2a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;根据国家相关政策，凡是涉及资金往来的账户，必须进行实名认证。同时也是为了保证您账户里的资金安全。</div>
                    <li id = "qes3">问：如何实名认证？</li>
                    <div id="qes3a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;01.进入“我的”页面，点击头像，进入“设置用户信息”页面；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;02.点击“未认证”进入实名认证页面；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;03.点击“身份证扫描”，进行身份证拍照；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;04.核实扫描信息无误后，点击“完成”结束认证。</div>
                    <li id = "qes4">问：为什么要银行卡支付宝绑定？</li>
                    <div id="qes4a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;在平台上赚到的钱如果要提现，必须通过绑定的银行卡或第三方支付平台完成。</div>
                    <li id = "qes5">问：如何删除银行卡账户？</li>
                    <div id="qes5a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;如果您需要删除已绑定的银行卡账户，只需选择“长按”需要删除的银行卡帐户，系统将会弹出是否删除的页面，点击“是”，即可完成删除。</div>
                    <li id = "qes6">问：忘记提现密码怎么办？</li>
                    <div id="qes6a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;如果忘记提现密码，请通过联系客服QQ（3340388761），我们的客服MM会引导您完成提现密码重置。</div>
                    <li id = "qes7">问：抢红包怎么玩？</li>
                    <div id="qes7a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;抢红包是小宝招商为会员提供的福利，邀请好友按规则注册，好友得到50金币红包，您还能获得20金币，并且好友自动成为您的下线。</div>
                    <li id = "qes8">问：什么是天地汇创客、创客工作室？</li>
                    <div id="qes8a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;天地汇创客是小宝平台以招商为主要任务的核心会员，他们将获得更多招商任务信息与中标机会。<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;天地汇创客工作室是指核心会员联络一批志同道合区域相近的销售人员，组建一个社群组织，依托小宝招商平台，以团队合作的方式获取更多招商任务的机会。</div>
                    <li id = "qes9">问：如何组建创客工作室？</li>
                    <div id="qes9a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;注册成为小宝招商App会员；联系小宝招商微信管理员（微信号：xbzs511），申请即可；组建工作室需要联络20人以上加入。</div>
                    <li id = "qes10">问：创客工作室有哪些好处？</li>
                    <div id="qes10a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;优先获得小宝招商任务，获得任务佣金；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp; 推荐企业入驻平台，获得推荐佣金；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;优先获得企业渠道销售兼职，获得提成佣金；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp; 组织社群活动，获得平台奖励；<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;  创客工作室群发起人还可额外获得平台佣金5%一级奖励，佣金1%二级奖励。<br>
                        &nbsp;&nbsp;&nbsp;&nbsp; 优秀创客工作室有机会成为小宝招商城市合伙人，按完成任务免费获得分子公司股份。
                    </div>
                    <li id = "qes11">问：什么是亿元俱乐部？</li>
                    <div id="qes11a" style="display: none;">&nbsp;&nbsp;&nbsp;&nbsp;亿元俱乐部是小宝招商联合《销售与市场》、新锐策划《圣雄品牌》、资本大鳄《银杏资本》及国内一线营销专家顾问团一起打造的企业黑马产品孵化营。目的帮助企业实现一年单品销售过亿。</div>
                   <li id = "qes12">问：城会玩有什么用？</li>
                    <div id = "qes12a" style="display: none;">
                        <p><span style="font-family:宋体">城会玩是小宝招商为会员提供各种好玩、有趣、有利的游戏活动，不定期开放，敬请期待。</span></p>
                        <p><br/></p>
                   </div>
                </ul>
            </div>
        </div>
    </body>
<script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script>

        //alert($("h4").length);
        $("#one").click(function(){
            //alert($("#onea").is('display'));
            if($("#onea").css('display')==='block'){
                //alert(0);
                $("#onea").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","block");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
				$("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#two").click(function(){
            //alert($("#onea").is('display'));
            if($("#twoa").css('display')==='block'){
                //alert(0);
                $("#twoa").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","block");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
				$("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#three").click(function(){
            //alert($("#onea").is('display'));
            if($("#threea").css('display')==='block'){
                //alert(0);
                $("#threea").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","block");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
				$("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#four").click(function(){
            //alert($("#onea").is('display'));
            if($("#foura").css('display')==='block'){
                //alert(0);
                $("#foura").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","block");
                $("#fivea").css("display","none");
				$("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#five").click(function(){
            //alert($("#onea").is('display'));
            if($("#fivea").css('display')==='block'){
                //alert(0);
                $("#fivea").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","block");
				$("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
		$("#six").click(function(){
            //alert($("#onea").is('display'));
            if($("#sixa").css('display')==='block'){
                //alert(0);
                $("#sixa").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
				$("#sixa").css("display","block");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
		});
        $("#seven").click(function(){
            //alert($("#onea").is('display'));
            if($("#sevena").css('display')==='block'){
                //alert(0);
                $("#sevena").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","block");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#eight").click(function(){
            //alert($("#onea").is('display'));
            if($("#eighta").css('display')==='block'){
                //alert(0);
                $("#eighta").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","block");
                $("#ninea").css("display","none");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#nine").click(function(){
            //alert($("#onea").is('display'));
            if($("#ninea").css('display')==='block'){
                //alert(0);
                $("#ninea").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","block");
                $("#tena").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#ten").click(function(){
            //alert($("#onea").is('display'));
            if($("#tena").css('display')==='block'){
                //alert(0);
                $("#tena").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#ninea").css("display","none");
                $("#tena").css("display","block");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes1").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes1a").css('display')==='block'){
                //alert(0);
                $("#qes1a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","block");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes2").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes2a").css('display')==='block'){
                //alert(0);
                $("#qes2a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","block");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes3").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes3a").css('display')==='block'){
                //alert(0);
                $("#qes3a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","block");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes4").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes4a").css('display')==='block'){
                //alert(0);
                $("#qes4a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","block");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes5").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes5a").css('display')==='block'){
                //alert(0);
                $("#qes5a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","block");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes6").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes6a").css('display')==='block'){
                //alert(0);
                $("#qes6a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","block");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes7").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes7a").css('display')==='block'){
                //alert(0);
                $("#qes7a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","block");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes8").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes8a").css('display')==='block'){
                //alert(0);
                $("#qes8a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","block");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes9").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes9a").css('display')==='block'){
                //alert(0);
                $("#qes9a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","block");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes10").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes10a").css('display')==='block'){
                //alert(0);
                $("#qes10a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","block");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes11").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes11a").css('display')==='block'){
                //alert(0);
                $("#qes11a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","block");
                $("#qes12a").css("display","none");
            }
        });
        $("#qes12").click(function(){
            //alert($("#onea").is('display'));
            if($("#qes12a").css('display')==='block'){
                //alert(0);
                $("#qes12a").css("display","none");
            }else{
                //alert(1);
                $("#onea").css("display","none");
                $("#twoa").css("display","none");
                $("#threea").css("display","none");
                $("#foura").css("display","none");
                $("#fivea").css("display","none");
                $("#sixa").css("display","none");
                $("#sevena").css("display","none");
                $("#eighta").css("display","none");
                $("#qes1a").css("display","none");
                $("#qes2a").css("display","none");
                $("#qes3a").css("display","none");
                $("#qes4a").css("display","none");
                $("#qes5a").css("display","none");
                $("#qes6a").css("display","none");
                $("#qes7a").css("display","none");
                $("#qes8a").css("display","none");
                $("#qes9a").css("display","none");
                $("#qes10a").css("display","none");
                $("#qes11a").css("display","none");
                $("#qes12a").css("display","block");
            }
        });
    </script>
</html>