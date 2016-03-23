<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>管理后台</title>
        <style>
            /*列出所有图标*/
            /*首页*/
            .home_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -10px -10px;width:35px;height:34px;}
            /*组织架构*/
            .organize_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -50px -10px;width:49px;height:34px;}
            /*企业设置*/
            .companyset_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -100px -10px;width:45px;height:34px;}
            /*系统设置*/
            .systemset_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -150px -10px;width:33px;height:34px;}
            /*返回*/
            .back_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -200px -10px;width:29px;height:34px;}
            /*大按钮*/
            .big_button{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -10px -100px;width:122px;height:71px;}
            /*创建部门*/
            .new_organize_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -250px -10px;width:32px;height:28px;}
            /*创建员工*/
            .new_user_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -300px -10px;width:32px;height:28px;}
            /*权限管理*/
            .new_authority_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -350px -10px;width:32px;height:28px;}
            /*企业信息设置*/
            .new_companyset_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -400px -10px;width:32px;height:28px;}
            /*系统设置*/
            .new_systemset_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -450px -10px;width:32px;height:28px;}
            /*信息删除*/
            .new_info_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -500px -10px;width:32px;height:28px;}
            
            .service_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -350px -100px;width:16px;height:17px;}
            .phone_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -300px -100px;width:20px;height:14px;}
            
            .black_search_ico{background:url(/wisdom/Public/Admin/Default/images/bg.png) no-repeat -150px -100px;width:10px;height:10px;}
            
        </style>
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/Admin/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Admin/Default";
        </script>
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Admin/Default/css/admin.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/bootstrap.min.css" />
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
        <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fun.js"></script>
        <script>
            $(window).resize(function(){
                var mainheight_1 = window.innerHeight-50;
                var mainheight_2 = document.body.scrollHeight-50;
                var mainheight = mainheight_1<=mainheight_2 ? mainheight_2 : mainheight_1;
                $(".menu").height(mainheight);
                $(".body_right").height(mainheight);
            });
        </script>
    </head>
    <body>
        <div class="page_top">
            <div class="page_top_title">
                <div class="page_top_company"><?php  echo cookie("companyName")?></div>
                <div class="page_top_menu">
                    <!--<span><a href="#">通知</a></span><span style="margin-left: 20px;">帮助</span>-->
                </div>
                <div class="page_top_info">
                    <!--<a href="<?php echo U('Home/Business/index');?>" style="color: #fff;">-->
                    <a href="javascript:;" style="color: #fff;" onclick="returnHome()">
                    返回首页
                    </a>
                </div>
            </div>
        </div>
        <div class="body_frame">
<div class="menu">
    <ul style="margin-top: 30px;">
<!--        <li>
            <div class="home_ico"></div>
            <div style="height: 20px;line-height: 20px;width: 60px;text-align: center;">首页</div>
        </li>
        <li>
            <div class="organize_ico"></div>
            <div style="height: 20px;line-height: 20px;width: 60px;text-align: center;">组织架构</div>
        </li>-->
        <li  onclick="location.href = APP+'/Admin/Companyset/index'">
            <div class="systemset_ico"></div>
            <div style="height: 20px;line-height: 20px;width: 60px;text-align: center;">企业设置</div>
        </li>
        <li onclick="location.href = APP+'/Admin/Group/index'">
            <div class="companyset_ico"></div>
            <div style="height: 20px;line-height: 20px;width: 60px;text-align: center;">通讯录</div>
        </li>
        <li  onclick="location.href = APP+'/Admin/Access/index'">
            <div class="systemset_ico"></div>
            <div style="height: 20px;line-height: 20px;width: 60px;text-align: center;">权限设置</div>
        </li>
        <!--
        <li>
            <div class="back_ico"></div>
            <div style="height: 20px;line-height: 20px;width: 60px;text-align: center;">返回</div>
        </li>-->
    </ul>
</div>

        <div class="body_right">
            <div class="body_right_home">
                <p>尊敬的用户：</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您好，欢迎使用招商平台，您现在登录的是管理员平台。</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;功能已经开通，请使用以下的功能来完成平台的设置。如果您在使用中有什么问题，可以联系客服，谢谢。</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1、创建部门(<a onclick="add()">点击创建部门</a>)</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、创建员工帐号(<a>点击创建员工帐号</a>)</p>
                <p style="text-align: right;">杭州利依享数据科技有限公司&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <div class="body_right_button_list">
                    <div class="big_button body_right_button_jj"  onclick="add()">
                        <div style="height: 12px;"></div>
                        <div class="new_organize_ico"></div>
                        <div class="body_right_button_wz" >创建部门</div>
                    </div>
                    <div class="big_button body_right_button_jj">
                        <div style="height: 12px;"></div>
                        <div class="new_user_ico"></div>
                        <div class="body_right_button_wz">创建员工</div>
                    </div>
                    <div class="big_button body_right_button_jj">
                        <div style="height: 12px;"></div>
                        <div class="new_authority_ico"></div>
                        <div class="body_right_button_wz">权限管理</div>
                    </div>
<!--                    <div class="big_button body_right_button_jj">
                        <div style="height: 12px;"></div>
                        <div class="new_companyset_ico"></div>
                        <div class="body_right_button_wz">企业信息设置</div>
                    </div>
-->                  
<!--                   <div class="big_button body_right_button_jj">
                        <div style="height: 12px;"></div>
                        <div class="new_systemset_ico"></div>
                        <div class="body_right_button_wz">系统设置</div>
                    </div>-->
<!--
                    <div class="big_button body_right_button_jj">
                        <div style="height: 12px;"></div>
                        <div class="new_info_ico"></div>
                        <div class="body_right_button_wz">信息删除</div>
                    </div>-->
                </div>
            </div>
            
            <div class="body_right_right">
                <div class="right_statistics">
                    <div class="statistics_line">
                        <div class="statistics_wz_1">帐号使用<span style="font-weight:normal;margin-left: 16px;color:#D0D0D0;">购买数据20个</span></div>
                        <div class="statistics_wz_line"></div>
                        <div class="statistics_wz_2">已经使用2个<span style="margin-left: 16px;color:#0086c9;">剩余18个</span></div>
                    </div>
                    
                    <div class="statistics_line">
                        <div class="statistics_wz_1">存储空间<span style="font-weight:normal;margin-left: 16px;color:#D0D0D0;">购买2.00GB</span></div>
                        <div class="statistics_wz_line"></div>
                        <div class="statistics_wz_2">已经使用9.00MB<span style="margin-left: 16px;color:#0086c9;">剩余1.99GB</span></div>
                    </div>
                    
                    <div class="statistics_line">
                        <div class="statistics_wz_1">名片数量<span style="font-weight:normal;margin-left: 16px;color:#D0D0D0;">购买数据500张</span></div>
                        <div class="statistics_wz_line"></div>
                        <div class="statistics_wz_2">已经使用2张<span style="margin-left: 16px;color:#0086c9;">剩余488张</span></div>
                    </div>
                    <div class="statistics_line">
                        <div class="statistics_wz_1">软件到期时间</div>
                        <div class="statistics_wz_2">9999年12月31日<span style="margin-left: 16px;color:#0086c9;">剩余100000天</span></div>
                    </div>
                </div>
                
                <div class="company_info" style="color:#9fa0a0;">
                    <div class="company_info_on">杭州利依享数据科技有限公司</div>
                    <div class="company_info_on_ico">
                        <div style="width:75px;">
                            <div class="service_ico" style="float:left;"></div>
                            <span>服务热线</span>
                        </div>
                        <div style="width:100px;clear: both;">0571-88888888</div>
                    </div>
                    <div class="company_info_on_ico">
                        <div style="width:75px;">
                            <div class="phone_ico" style="float:left;"></div>
                            <span>在线咨询</span>
                        </div>
                        <div style="width:100px;clear: both;">QQ:888888888</div>
                    </div>
                    <div class="company_info_on_ico" style="height: 49px;border-top: 1px solid #eeeeee;">
                        copyright 2015<br>APP下载 使用说明 安全声明
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        
       function add(){
           layer.open({
        type: 1,
        title :'创建部门',
        area: ['600px', '360px'],
        shadeClose: true, //点击遮罩关闭
        content: '\<\div style="padding:20px;">\n\
                        <div>\n\
                             <ul>\n\
                               <li>公司名称：<input type="text" name="comp_name"/><li>\n\
                               <li>部门名称：<input type="text" name="depart_name"/><li>\n\
                               \n\
                               <li>所属部门：<input type="text" name="depart"/></li>\n\
                             </ul>\n\
                        </div>\n\
                  \<\/div>'
    });
       }
        
        
        
    if(window.innerHeight<document.body.scrollHeight){
        $('.body_right').css('height',document.body.scrollHeight-50);
        $('.menu').css('height',document.body.scrollHeight-50);
    }else
    {
        $('.body_right').css('height',window.innerHeight-50);
        $('.menu').css('height',window.innerHeight-50);
    }
    </script>
    </body>
</html>