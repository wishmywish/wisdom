<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
/*清除默认样式*/
body, h1, ul, li, p, img, div, dl, dd, dt, span, a {
    margin: 0;
    padding: 0;
    list-style: none;
}
/*公共的样式*/
a {
    text-decoration: none;
    color: #646464;
    margin-left: 20px;
    cursor: pointer;
}
body {
    font-family: '宋体';
    color: #646464;
    font-size: 14px;
}
.main {
    overflow: hidden;
    margin: 20px 20px;
    height: 440px;
    position: relative;
}
.title {
    text-align: center;
    font-size: 25px;
    font-weight: 700;
}
.subTitle {
    background: #f7f7f7 none repeat scroll 0 0;
    margin: 10px auto;
    padding: 10px 0 0;
    text-align: center;
}
/*.subTitle a{color: #0000ff;}*/

.subTitle  span {
    line-height: 25px;
    padding: 0 5px;
}
.content {
    width: 620px;
    height: 300px;
    overflow: auto;
    padding: 10px;
    border: 1px solid #fbfbfb;
    overflow-y:auto;
    overflow-x:hidden;
}
.content img{ width:600px;} 
.content p,span{line-height: 25px;}
.lc {
    text-align: center;
}
.reset {
    background-color: #fff;
    border: 1px solid #e2e2e2;
    border-radius: 3px;
    padding: 0 20px;
    line-height: 28px;
    cursor: pointer;
    color: #000;
    margin: 20px 0;
}
.FJnotice{
    background: #f7f7f7 none repeat scroll 0 0;
    border: 1px dotted #e1e1e1;
    line-height: 18px;
    margin: 20px;
    padding: 9px 10px;
    text-align: left;
    width: 88%;
}
.FJnotice a{font-size: 12px;text-decoration: underline;color: #de2e2f;margin-left: 5px;}
i{color: #f47469;font-style: normal;cursor: pointer;}
.showBox{width: 100px;height: 317px;border: 1px solid #ccc;display: none; position: absolute;  right: 139px;  top: 100px;  overflow-y: scroll;  padding: 5px;background: #fafafa;opacity: 0.9  }
.showBox li{line-height: 25px;  text-align: left;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
.showBox li:hover{background: #ccc;}

</style>
<script>
    var ROOT = "/wisdom";//网站根目录地址,例:/根目录
    var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
    var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
    var IMG = "/wisdom/Public/Home/Default/images";
    var STATIC = "/wisdom/Public/static";
    var UPFILE = "/wisdom/Public/upfile";
    var THEME = "/wisdom/Public/Home/Default";
    var bigMenuIndex = 0; //大类LI下标
    var smallMenuIndex = 0;//小类LI下标
</script>
<link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
</head>
<body>
    <div class="main">
        <div class="title"><?php echo ($notice['title']); ?></div>
        <div class="subTitle">
            <ul>
                <span>发布人:<?php echo ($notice['trueName']); ?></span>
                <span>发布时间：<?php echo ($notice['createDate']); ?></span>
            </ul>
            <ul>
                <span>浏览人次:<?php echo ($notice['reads']); ?></span>
                <span>访问人数:<i id="visits"><?php echo ($notice['person']); ?></i></span>
                <ol class="showBox">
                    <ul class="">
                       <?php if(is_array($VisitList_list)): $i = 0; $__LIST__ = $VisitList_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$users): $mod = ($i % 2 );++$i;?><li title=<?php echo ($users["visitUserName"]); ?>><?php echo ($users["visitUserName"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </ol>
            </ul>
        </div>
        <div class="content">
            <?php echo ($notice['content']); ?>
        </div>
    </div>
    <?php if(!empty($updFile)): ?><div class="FJnotice">
        <span class="fa fa-paperclip">
            <?php if(is_array($updFile)): $i = 0; $__LIST__ = $updFile;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><a onclick="doDownload('<?php echo ($file["attach_file_url"]); ?>');"><?php echo ($file["attach_file_name"]); ?></a>&emsp;<?php endforeach; endif; else: echo "" ;endif; ?>
        </span>
    </div><?php endif; ?>
    <div class="lc">
        <button class="reset" onclick="doReset();">关闭</button>
    </div>
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/jquery.bigautocomplete.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/skin/layer.css"></script>
<script type="text/javascript" src="/wisdom/Public/static/laypage/laypage.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>
<div style="display: none;"><script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script></div>

 
 
 
    <script>
        /*点击关闭按钮*/
        function doReset() {
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }
        
        function doDownload(fileUrl) {
            var url = APP+'/Home/Office/downloadAttachFile?fileUrl='+fileUrl;
            window.open(url, '_blank');
        }

        $("#visits").hover(function(){
            $(".showBox").slideDown("slow","swing");
            $(".showBox").mouseover(function(){
                $(".showBox").show();
            });
            $(".showBox").mouseout(function(){
                $(".showBox").hide();
            });
        },function(){
            $(".showBox").slideDown();
        });
    </script>
</body>
</html>