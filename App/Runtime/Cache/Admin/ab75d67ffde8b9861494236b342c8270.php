<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title><?php echo ($companyName); ?></title>
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
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
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
        <div class="body_right_menu">
             <div class="button_bg_80"  onclick="location.href = APP+'/Admin/Access/index'">角色管理</div>
            <!--<div class="button_bg_80  button2" style="background-color:#eeeeee;color:#000" onclick="location.href = APP+'/Admin/Access/user_list'">用户管理</div>-->
        </div>
        <div class="body_right_list">
            <div class="body_right_list_button">
                <div class="button_bg_80" style="float: right;margin-right: 5px;" onclick="addrole()">新建角色</div>
            </div>
            <div class="body_right_list_tab1">
                <ul>
                    <li>序号</li>
                    <li style='text-align:center;'>角色名称</li>
                    <li style="padding-left:30px">操作</li>
                </ul>
            </div>
            <div class="body_right_list_tab2" id="role_list" style="min-height:650px;height:650px;margin-bottom: 20px;">

            </div> 
            <div id="pagerolelist" class="page12"></div>
        </div> 
        
    </div>
      <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laypage.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
    <script>
       function addrole(){
        var index=layer.open({
        type: 2,
        title :['新建角色','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
        area: ['600px', '400px'],
        shadeClose: false, //点击遮罩关闭
        content:APP+'/Admin/Access/addrole'
        });
       }
       buslistData1(APP+"/Api/Web/role_list","companyid=<?php echo ($companyId); ?>",'get',"json","pagerolelist");
        $(function(){
            $(document).on('click','#pagerolelist span a',function(){  
               var rel = $(this).attr("rel"); 
              prolist(APP+"/Api/Web/role_list","post","companyid=<?php echo ($companyId); ?>&page="+rel,'get',"json","pagerolelist");
          });
        });
    </script>
    </body>
</html>