<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>杭州利伊享</title>
        <style>
            /*列出所有图标*/
            /*首页*/
            .home_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -10px -10px;width:35px;height:34px;}
            /*组织架构*/
            .organize_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -50px -10px;width:49px;height:34px;}
            /*企业设置*/
            .companyset_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -100px -10px;width:45px;height:34px;}
            /*系统设置*/
            .systemset_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -150px -10px;width:33px;height:34px;}
            /*返回*/
            .back_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -200px -10px;width:29px;height:34px;}
            /*大按钮*/
            .big_button{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -10px -100px;width:122px;height:71px;}
            /*创建部门*/
            .new_organize_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -250px -10px;width:32px;height:28px;}
            /*创建员工*/
            .new_user_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -300px -10px;width:32px;height:28px;}
            /*权限管理*/
            .new_authority_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -350px -10px;width:32px;height:28px;}
            /*企业信息设置*/
            .new_companyset_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -400px -10px;width:32px;height:28px;}
            /*系统设置*/
            .new_systemset_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -450px -10px;width:32px;height:28px;}
            /*信息删除*/
            .new_info_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -500px -10px;width:32px;height:28px;}

            .service_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -350px -100px;width:16px;height:17px;}
            .phone_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -300px -100px;width:20px;height:14px;}

            .black_search_ico{background:url(/wisdom/Public/Admin/Black/images/bg.png) no-repeat -150px -100px;width:10px;height:10px;}

        </style>
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/Admin/Black/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Admin/Black";
        </script>
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Admin/Black/css/admin.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/bootstrap.min.css" />
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
        <script type="text/javascript" src="/wisdom/Public/Admin/Black/js/fun.js"></script>
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />

    </head>
    <body>
    <div class="header">
        <div class="header_in">
            <h2 class="fl">
                杭州日思夜享数据科技有限公司
            </h2>
            <div class="header_in_right rg">
                <ul>
                   <li><i class="fa fa-volume-up "></i><span>通知</span></li>
                    <li><i  style="margin-right: 10px;">|</i><span>帮助</span><i style="margin-left: 10px;">|</i></li>
                    <li><span>登录/注销</span><i style="margin-left: 5px; margin-right: 0;" class="fa fa-power-off"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navs">
        <h1 class="fl"><a href=""><img src="/wisdom/Public/Admin/Black/images/admin_logo.png"></a></h1>
        <div class="navs_right rg">
            <span class="fl">欢迎</span>
            <span class="fl">104646027</span>
            <span class="fl">
                <img src="/wisdom/Public/Admin/Black/images/touxiang.png">
            </span>
        </div>

    </div>
<div class="body">
    <div class="admin_left fl">
        <ul>
            <li class="current">
                <i class="fa fa-home fa-3x fl"></i>
                <span class="fl">首页</span>
            </li>
            <li>
                <i class="fa fa-home fa-3x fl"></i>
                <span class="fl" style="margin-left: 38px;">通讯录</span>
            </li>
            <li>
                <i class="fa fa-home fa-3x fl"></i>
                <span class="fl" style="margin-left: 34px;">企业设置</span>
            </li>
            <li>
                <i class="fa fa-gear  fa-3x fl"></i>
                <span class="fl" style="margin-left: 32px;">权限设置</span>
            </li>
        </ul>
    </div>
    <div class="admin_right fl">
        <div class="owned">
            <ul class="owned_first fl">
                <li>尊敬的客户:</li>
                <li>您好,欢迎使用招商平台,您现在登录的是管理员界面。赠送给您的使用空间已经添加到您的企业账户中，您只需要按照如下步骤操作，即日可开通使用。</li>
                <li>
                    <span class="fl sp3">1、创建部门</span>
                    <button class="fl btns1">点击立即创建</button>
                </li>
                <li>
                    <span class="fl sp3" style="margin-right: 18px;">2、创建员工账号</span>
                    <button class="fl btns1">点击立即创建</button>
                </li>
                <li>
                    <span class="rg">杭州利伊享数据科技有限公司</span>
                </li>
            </ul>
            <ul class="owned_two fl">
                <li>杭州日思夜享数据科技有限公司</li>
                <li>
                    <p>服务热线</p>
                    <p>0571-8888888</p>
                </li>
                <li>
                    <p>在线咨询</p>
                    <p>QQ1594444</p>
                </li>
                <li>
                    <p style="color: #717071;">copyinght&nbsp;&nbsp;2012-2014</p>
                    <p>
                        <a href="#">APP下载</a>
                        <a href="#">使用说明</a>
                        <a href="#">安全声明</a>
                    </p>
                </li>
            </ul>
        </div>
        <div class="owned">
            <ul class="owned_thirdly fl">
                <li>
                    <a href="#">
                        <img src="/wisdom/Public/Admin/Black/images/admin_icon1.png">
                        <p>创建部门</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/wisdom/Public/Admin/Black/images/admin_icon2.png">
                        <p>创建员工</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/wisdom/Public/Admin/Black/images/admin_icon3.png">
                        <p>权限管理</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/wisdom/Public/Admin/Black/images/admin_icon4.png">
                        <p>企业信息设置</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="owned">
            <ul class="owned_fourthly fl">
                <li>
                    <span class="sp4">账号使用</span>
                    <span>购买数量20个</span>
                </li>
                <li>
                    <p>
                        <span class="sp5"></span>
                    </p>
                </li>
                <li>
                    <span>已使用3个</span>
                    <span class="sp6">已使用3个</span>
                </li>
                <li>软件到期时间</li>
                <li>
                    <span>2020年12月29日</span>
                    <span class="sp7">剩余(99999)天</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="footer">
    <div style="width: 1200px; margin: 0 auto;">
        <div class="footer_left">
            <span>运营支持：杭州日思夜享科技有限公司</span>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <span>技术支持：杭州利伊享数据科技有限公司</span>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <span>Copyright<i class="fa fa-copyright"></i>2015 All rights reserved. &nbsp;&nbsp; 浙ICP备15010709号</span>

        </div>

        <div class="footer_right">
            APP下载&nbsp;&nbsp;使用说明&nbsp;&nbsp;|&nbsp;&nbsp;
            <a>
                <i class="fa fa-qq"></i>
            </a>
            &nbsp;
            <a>
                <i class="fa fa-weixin"></i>
            </a>

        </div>
    </div>

</div>