<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
<!--    <link rel="stylesheet" type="text/css"  href="css/style.css">-->
<style>
    /*清除默认样式*/
body,h1,ul,li,p,img,div,dl,dd,dt,span,a{ margin: 0; padding: 0; list-style: none;}
/*公共的样式*/
a{ text-decoration: none; color: #646464; margin-left: 20px;}
body{ font-family: '宋体'; color: #646464; font-size: 14px;}
.fl{ float: left;}
.rg{float:right;}
/*主体*/
.main{overflow: hidden; margin: 20px 80px; }
.main dl{ width: 100%;}
.main dl dt{width: 60px; height: 60px; border-radius: 30px; background: #ccc; margin-left: 30px;}
.main dl dd{ line-height: 60px;}
.main ul{ margin-top:20px; width: 100%;}
.main ul li{ float: left; margin-right: 25px;}
.c_name{font-weight: 100;height: 20px;margin-right: 55px;text-align: center;width: 125px;}
.main span{ padding-right:3px;text-align: right;}
.submit{background-color: #409ad6;border: 1px solid #409ad6; border-radius: 3px;padding: 0 20px;line-height: 28px;cursor: pointer;color: #fff; margin-left: 20px;}
.reset{background-color: #fff;border: 1px solid #e2e2e2; border-radius: 3px;padding: 0 20px;line-height: 28px;cursor: pointer;color: #000; margin-left: 20px;}
#nickname{height:25px;width:200px; margin-left: 18px;}
#realname{height:25px;width:200px; margin-left: 18px;}
#bithdate{height:30px;margin-left: 18px;}
#phone{height:25px;width:200px; margin-left: 18px;}
#position{height:25px;width:200px; margin-left: 18px;}
#s_depart{width: 170px;height:30px; margin-left: 18px;}
#s_email{height:25px;width:200px; margin-left: 18px;}
#addr{height:25px;width:200px; margin-left: 18px;}
.tip_text{width: 80px;display: inline-block;}
.red{color: red;}
#sex{margin-left: 20px;}
.up_btn{width: 70px;height: 25px;background: #409ad6;color: #fff;line-height: 25px;display: block;text-align: center;border: 1px solid #409ad6;}
#show_img img{width: 60px;height: 60px;margin-left: -20px;}
</style>
 <script>
    var ROOT = "/wisdom";//网站根目录地址,例:/根目录
    var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
    var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
    var IMG = "/wisdom/Public/Admin/Default/images";
    var STATIC = "/wisdom/Public/static";
    var UPFILE = "/wisdom/Public/upfile";
    var THEME = "/wisdom/Public/Admin/Default";
    var bigMenuIndex = 0; //大类LI下标
    var smallMenuIndex = 0;//小类LI下标
</script>
</head>
<body>
	
<div class="main">    
    <dl class="fl" >
        <dt class="fl" id="show_img"></dt>
        <dd class="fl" style="margin-top: 30px;"><a class="up_btn" href="#" id="btn_up"  onclick="$('#upfile').click()">上传头像</a></dd>
        <div style="display: none;">
            <input type="file" id="upfile" name="upfile" accept="image/jpeg,image/gif,image/png">
        </div>
        <input type="hidden" id="fileid" name="fileid" value="">
    </dl>

    <ul class="fl"> 
        <li>
            <span class="tip_text">呢称</span>
            <input type="text" id="nickname" />
        </li>
    </ul>
    <ul class="fl">
        <li><span class="tip_text"><span class="red">*</span>真实姓名</span> <input type="text" id="realname" /></li>
    </ul>
    <ul class="fl">
        <li>
            <span class="tip_text">性别</span>
            <input type="radio" id="sex" name="sex"  value="1"  checked/><span  style="margin-right:10px;color: #000">男</span>
            <input type="radio" id="sex"  name="sex"  value="0" /><span  style="margin-right:10px;color: #000;">女</span>
        </li>
    </ul>
     <ul class="fl">
        <li><span class="tip_text">生日</span> <input id="bithdate" class="laydate-icon" placeholder="请选择" /></li>
    </ul>
    <!--<ul class="fl">-->
        <!--<li><span>*</span>身份证号 <input type="text" id="IDcard" style="height:25px;width:200px; margin-left: 18px;"/></li>-->
    <!--</ul>-->
    <ul class="fl">
        <li>
        	<span class="tip_text"><span class='red'>*</span>所属部门 </span>
            <select id="s_depart"/>            	
            	<?php if(is_array($deptListArr_tree)): foreach($deptListArr_tree as $key=>$vo): ?><option value="<?php echo ($vo['departId']); ?>" style="margin-left:<?php echo ($vo['count']*20); ?>px"><?php echo ($vo['deptName']); ?></option><?php endforeach; endif; ?>                        	
            </select>        
        </li>
    </ul>
    <ul class="fl">
        <li><span class="tip_text">职位</span> <input type="text" id="position" /></li>
    </ul>
    <ul class="fl">
        <li><span class="tip_text"><span class="red">*</span>手机</span> <input type="text" id="phone" /></li>
    </ul>
    <ul class="fl">
        <li>
            <span class="tip_text">邮箱</span>
            <input type="text" id="s_email" />
         </li>
    </ul>
    <ul class="fl">
        <li><span class='tip_text'>家庭住址</span> <input type="text" id="addr" /></li>
    </ul> 
    <span style="display:inline-block;float:right;margin-top:-25px;color: red;">&nbsp;*初始密码123456</span>
</div>
      <div style="margin: 30px;text-align: center;"><button class="submit" id="s_submit">确定</button>
                     <button class="reset" onclick="reset()">关闭</button>
      </div>
      
      <input type="hidden" id="companyId" name="companyId" value="<?php echo ($companyId); ?>" />
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laypage.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>   
    <script>
        $(function(){                          
            $("#upfile").wrap("<form id='uplogo' action='<?php echo U('Api/Upfile/upF/type/2');?>' method='post' enctype='multipart/form-data'></form>");
            var date = {
                        elem: '#bithdate',
                        format: 'YYYY-MM-DD',
            //            min: laydate.now(), //设定最小日期为当前日期
                        min: '1900-01-01 00:00:00', //最小日期
                        max: '2099-06-16', //最大日期
                        //istime: true,
                        istoday: false,
                        choose: function(datas){
                            return datas;
            //                 end.min = datas; //开始日选好后，重置结束日的最小日期
            //                 end.start = datas //将结束日的初始值设定为开始日
                        }
                    };

                    laydate(date);
        })

        function  reset(){
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
            parent.layer.close(index);
        }
        
    </script>
</body>
</html>