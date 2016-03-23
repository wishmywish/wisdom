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

    <body>
        <div class="ostitle">招商APP管理平台登录界面</div>
        <div class="login">
            <div class="formbody">
                <div class="logintitle">管理员登录</div>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="username" class="sr-only">管理员</label>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" id="username" placeholder="管理员">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">密码</label>
                        <div class="col-lg-12">
                            <input type="password" class="form-control" id="password" placeholder="密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code" class="sr-only">验证码</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" id="code" placeholder="验证码">
                        </div>
                        <div class="col-lg-5" style="cursor: pointer;">
                            <img width='110' height='34' id='verify' alt="验证码" src="" title="点击刷新">
                        </div>
                    </div>
                    <button id="login" type="button" class="btn btn-default btn-block" data-loading-text="正在登录..." autocomplete="off">登 录</button>
                </form>
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
            $('#verify').click();
            //默认光标定位
            if($('#username').val()===""){
                $('#username').focus();
            }else{
                $('#password').focus();
            }
        });
        //按回车键提交
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode===13) {
                $('#login').click();
            }
        };
        //验证码
        $('#verify').click(function(){
            $(this).attr("src","<?php echo U('verify_c');?>?"+Math.floor(Math.random()*9999+1));
        });
        //登录
        $('#login').on('click',function(){
            var username = $('#username');
            var password = $('#password');
            var code = $('#code');
            if($.trim(username.val())===""){
                layer.msg('管理员帐号不能为空', {icon: 8});
                $('#username').focus();
                return false;
            }
            if($.trim(password.val())===""){
                layer.msg('密码不能为空', {icon: 8});
                $('#password').focus();
                return false;
            }
            if($.trim(code.val())===""){
                layer.msg('验证码不能为空', {icon: 8});
                $('#code').focus();
                return false;
            }
            var loadi = layer.load(0);
            $.get("<?php echo U('check_verify_c');?>","code="+$('#code').val(),function(v){
                if(v==='1'){
                    var date = "command=platformlogin&username="+$.trim($('#username').val())+"&password="+$.trim($('#password').val());
                    //var date = "{'command':'platformlogin','username':'"+$.trim($('#username').val())+"','password':'"+$.trim($('#password').val())+"'}";
                    //var username = $.trim($('#username').val());
                    //var password = $.trim($('#password').val());
                    $.post("<?php echo U('Api/Info/conf');?>",date,function(re){
                        //console.log(re);
                        layer.close(loadi);
                        if(re.conf_auth==='F'){
                            layer.msg('COMMAND参数错误');
                            return false;
                        }else{
                            if(re.error_code==='success'){
                                layer.msg('登录成功', {icon: 9});
                                location.href = "<?php echo U('main');?>";
                                return false;
                            }else if(re.error_code==='platform_login_error'){
                                layer.msg(re.error_text, {icon: 8});
                                return false;
                            }
                        }
                    },'json');
                }else{
                    layer.close(loadi);
                    layer.msg('验证码出错', {icon: 8});
                    $('#verify').click();
                    $('#code').val('');
                    $('#code').focus();
                }
            });
        });
    </script>
</html>