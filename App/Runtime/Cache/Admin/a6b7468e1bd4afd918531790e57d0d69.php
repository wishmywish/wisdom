<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
    html, body {
        margin: 0 auto;
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif,微软雅黑,宋体;
        background: #FFF;
        height: 100%;
        width: 100%;
        padding: 15px;
    }
    a{
        text-decoration: none;}
</style>
<body>
<span>成功导入<?php echo ($succ_result); ?>条数据,失败导入<?php echo ($error_result); ?>条数据！</span>

<div style="height: 10px;"></div>
<?php if(is_array($error_line)): foreach($error_line as $key=>$vo): ?><div style="height: 20px;line-height: 20px;" >第<?php echo ($vo); ?>行数据出错(手机已经注册或其它)</div><?php endforeach; endif; ?>

<div style="height: 10px;"></div>
 <div>
     <a class="btn btn-default" href="#" role="button" id="importBtn" style="margin-top: 15px;" onclick="closeClient()">关闭</a>
 </div>
</div>
</body>
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laypage.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>

<script>
    //关闭弹窗
    function closeClient(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引

        parent.location.reload();
        parent.layer.close(index);

    }
</script>
</html>