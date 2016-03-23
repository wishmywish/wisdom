<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

    <style>
        /*清除默认样式*/
        body,h1,ul,li,p,img,div,dl,dd,dt,span,a{ margin: 0; padding: 0; list-style: none;}
        /*公共的样式*/
        a{ text-decoration: none; color: #646464; margin-left: 20px;}
        body{ font-family: '宋体'; color: #646464; font-size: 14px;}
        .fl{ float: left;}
        .rg{float:right;}
        /*禁止对文本框进行拉伸操作*/
        textarea {
            resize: none;
        }
        /*主体*/
        .main{overflow: hidden; margin: 20px 80px; }
        .main dl{ width: 100%;}
        .main dl dt{width: 60px; height: 60px; border-radius: 30px; background: #ccc; }
        .main dl dd{ line-height: 60px; margin-left: 10px;}
        .main ul{ margin-top:20px; width: 100%;}
        .main ul li{ float: left; margin-right: 25px;}
        .c_name{font-weight: 100;height: 20px;margin-right: 55px;text-align: center;width: 125px;}
        .main span{color: red;}
        .titname{  text-align: right;width: 70px;margin-right: 7px;float: left;}
        .main input{height:25px;width:200px;}
        .main select{float: right;height:28px;width:200px;}
        .submit{margin: 30px 5px;border:1px;height: 25px;width: 70px;background: #14bce1;color: #fff;cursor: pointer;}
        .reset{background-color: #eaeaea;margin: 30px 5px;border:1px;height: 25px;width: 70px;cursor: pointer;color: #000;}

        #show_img img{width: 60px;height: 60px;margin-left: -20px;}
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
    <ul class="fl">
        <li><label class="titname"><span>*</span>客户名称</label><input type="text" id="cusName" style="" value="<?php echo ($customerDetail["cusName"]); ?>" /></li>
    </ul>
    <ul class="fl">
        <li><label class="titname"><span>*</span>地址</label><input type="text" id="cusAddress" style="width: 290px;" value="<?php echo ($customerDetail["cusAddress"]); ?>"/></li>
    </ul>
    <ul class="fl">
        <li><label class="titname"><span>*</span>电话</label><input type="text" id="phone" style="" value="<?php echo ($customerDetail["cusPhone"]); ?>"/></li>
    </ul>
    <ul class="fl">
        <li><label class="titname">传真</label><input type="text" id="cusFax" style="" value="<?php echo ($customerDetail["cusFax"]); ?>"/></li>
    </ul>
    <ul class="fl">
        <li><label class="titname">网址</label><input type="text" id="cusUrl" style="width: 290px;" value="<?php echo ($customerDetail["cusUrl"]); ?>"/></li>
    </ul>
    <ul class="fl">
        <li style="position: relative"><label class="titname"><span>*</span>行业</label><input type="text" id="cusTrade" name="cusTrade" value="<?php echo ($customerDetail["tradeName"]); ?>" readOnly/>
            <span class="fa fa-search fa-lg" style="position: absolute;right: 10px;top: 10px;color: #ccc;" onclick="selectcusTrades()"></span>
        </li>
    </ul>
    <ul class="fl">
        <li style="position: relative"><label class="titname">区域</label><input type="text" id="cusArea" name="cusArea" value="<?php echo ($customerDetail["areaName"]); ?>" readOnly/>
            <span class="fa fa-search fa-lg" style="position: absolute;right: 10px;top: 10px;color: #ccc;" onclick="selectcusAreas()"></span>
        </li>
    </ul>
    <ul class="fl">
        <li><label class="titname">规模</label>
            <select name="scale" id="cusScope">
           		<option value="">--请选择--</option>
                <?php if(is_array($getDictByCondition28_list)): $i = 0; $__LIST__ = $getDictByCondition28_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo['dictId'] == $customerDetail['cusScopeId']){ echo "selected='selected'";} ?> value=<?php echo ($vo["dictId"]); ?>><?php echo ($vo["dictName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
    </ul>
    <ul class="fl">
        <li><label class="titname">性质</label>
            <select name="quality" id="cusProperty">
                <option value="0">--请选择--</option>
                <?php if(is_array($getDictByCondition29_list)): $i = 0; $__LIST__ = $getDictByCondition29_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo['dictId'] == $customerDetail['cusPropertyId']){ echo "selected='selected'";} ?> value=<?php echo ($vo["dictId"]); ?>><?php echo ($vo["dictName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
    </ul>
    <ul class="fl">
        <li><label class="titname">来源</label>
            <select name="source" id="cusOrigin">
                <option value="0">--请选择--</option>
                <?php if(is_array($getDictByCondition30_list)): $i = 0; $__LIST__ = $getDictByCondition30_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo['dictId'] == $customerDetail['cusOriginId']){ echo "selected='selected'";} ?> value=<?php echo ($vo["dictId"]); ?>><?php echo ($vo["dictName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
    </ul>
    <ul class="fl">
        <li><label class="titname">备注</label> <textarea placeholder="输入文字不超过500字" style="float: right;height: 100px;width: 290px;" id="cusDesc"><?php echo ($customerDetail["cusDesc"]); ?></textarea></li>
    </ul>
 <input type="hidden" id="hidcusTrade" name="hidcusTrade" value="<?php echo ($customerDetail["tradeId"]); ?>" >
 <input type="hidden" id="hidcusArea" name="hidcusArea" value="<?php echo ($customerDetail["areaId"]); ?>" >
 <input type="hidden" id="cusId" name="cusId" value="<?php echo ($customerDetail["cusId"]); ?>" >
</div>
<div style="text-align: center;"><button class="submit" id="s_submit" onclick="saveClient()" >提交</button>
    <button class="reset" onclick="reset()">取消</button>
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

    function  reset(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }
    
    function selectcusAreas() {
        var cusArea = $("#cusArea").val();
        var hidcusArea = $("#hidcusArea").val();
        layer.open({
            type:2,
            title :['选择区域','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['350px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectcusAreas');?>" + "?cusArea=" + cusArea + "&hidcusArea=" + hidcusArea,
        });
     
    }
    
    function selectcusTrades() {
        var cusTrade = $("#cusTrade").val();
        var hidcusTrade = $("#hidcusTrade").val();
        layer.open({
            type:2,
            title :['选择行业','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['350px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectcusTrades');?>" + "?cusTrade=" + cusTrade + "&hidcusTrade=" + hidcusTrade,
        });
    }
    
    function saveClient() {
    	var loadIdx = layer.load(0);
        var cusNameobj = $(".main #cusName");
        if (getValLen(cusNameobj) == 0) {
            layer.msg("客户名称不能为空",{icon: 8});
            cusNameobj.focus();
            layer.close(loadIdx);
            return false;
        } else if (getValLen(cusNameobj) > 64) {
            layer.msg("客户名称最多为64字",{icon: 8});
            cusNameobj.focus();
            layer.close(loadIdx);
            return false;
        }

        var cusAddressobj = $(".main #cusAddress");
        if (getValLen(cusAddressobj) == 0) {
            layer.msg("客户地址不能为空",{icon: 8});
            cusAddressobj.focus();
            layer.close(loadIdx);
            return false;
        } else if (getValLen(cusAddressobj) > 128) {
            layer.msg("客户地址最多为128字",{icon: 8});
            cusAddressobj.focus();
            layer.close(loadIdx);
            return false;
        }

        var phoneObj = $(".main #phone");
        if (getValLen(phoneObj) == 0) {
            layer.msg("客户电话不能为空",{icon: 8});
            phoneObj.focus();
            layer.close(loadIdx);
            return false;
        } else if (!$("#phone").val().match(/^((\+?86)|(\(\+86\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/) && !$("#phone").val().match(/^((\+?0)|(\(\+0\)))?(13[012356789][0-9]{8}|15[012356789][0-9]{8}|18[02356789][0-9]{8}|147[0-9]{8}|1349[0-9]{7})$/) && !$("#phone").val().match(/^(((0\d{3})?\d{7}|(0\d{2})?\d{8}))(\d{2,4})?$/) && !$("#phone").val().match(/^([0-9]{3,4}-)?[0-9]{7,8}$/) ) {
            layer.msg("客户电话格式不正确",{icon: 8});
            phoneObj.focus();
            layer.close(loadIdx);
            return false;
        }
       
        var cusTradeObj = $(".main #cusTrade");
        if (getValLen(cusTradeObj) == 0) {
            layer.msg("客户行业不能为空",{icon: 8});
            cusTradeObj.focus();
            layer.close(loadIdx);
            return false;
        } 
        
//        var cusAreaObj = $(".main #cusArea");
//        if (getValLen(cusAreaObj) == 0) {
//            layer.msg("客户区域不能为空",{icon: 8});
//            cusAreaObj.focus();
//            layer.close(loadIdx);
//            return false;
//        }
        
        var cusFaxObj = $(".main #cusFax");
        if (getValLen(cusFaxObj) > 32) {
            layer.msg("客户传真最多为32字",{icon: 8});
            cusFaxObj.focus();
            layer.close(loadIdx);
            return false;
        }
        
        var cusUrlObj = $(".main #cusUrl");
        if (getValLen(cusUrlObj) > 128) {
            layer.msg("客户网址最多为128字",{icon: 8});
            cusUrlobj.focus();
            layer.close(loadIdx);
            return false;
        }
        
        var cusDescObj = $(".main #cusDesc");
        if (getValLen(cusDescObj) > 500) {
            layer.msg("备注最多为500字",{icon: 8});
            cusDescObj.focus();
            layer.close(loadIdx);
            return false;
        }

		$("#hidcusTrade").val();
        $("#hidcusArea").val();
        
		var phone = $("#phone").val();
        var tradeId =$("#hidcusTrade").val();
        var areaId =$("#hidcusArea").val();
        var cusFax = $("#cusFax").val();
        var cusUrl = $("#cusUrl").val();
        var cusScope = $("#cusScope").val();
        var cusProperty = $("#cusProperty").val();
        var cusOrigin = $("#cusOrigin").val();
        var cusDesc = $("#cusDesc").val();
        var cusId = $("#cusId").val();
        
        var data="cusName="+cusNameobj.val()+"&phone="+phone+"&cusFax="+cusFax+"&cusUrl="+cusUrl+"&cusAddress="+cusAddressobj.val()+"&areaId="+areaId+"&tradeId="+tradeId+"&cusScope="+cusScope+"&cusProperty="+cusProperty+"&cusOrigin="+cusOrigin+"&cusDesc="+cusDesc+"&cusId="+cusId;
        $.post("<?php echo U('Office/addCustomer');?>", data, function(data) {
            layer.close(loadIdx);
        	if(data.error_code == "success") {
                parent.doSearchCustomer();
                layer.msg("发送成功");
                var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                parent.layer.close(index);
            } else {
                  layer.msg(data.error_text,{icon: 8});
            }
		}, 'json');
    }
    
    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }
    
</script>
</body>
</html>