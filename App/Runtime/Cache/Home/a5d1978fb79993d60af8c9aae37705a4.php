<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>                                                        
<meta http-equiv="Cache-Control" content="no-transform" />
<link rel="alternate" media="handheld" href="#" />
<link href="/wisdom/Public/static/css/font-awesome.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/wisdom/Public/Home/Default/css/dealer.css" />
<title>经销商详情完善</title>
<script>
    var ROOT = "/wisdom";//网站根目录地址,例:/根目录
    var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
    var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
    var IMG = "/wisdom/Public/Home/Default/images";
    var STATIC = "/wisdom/Public/static";
    var UPFILE = "/wisdom/Public/upfile";
    var THEME = "/wisdom/Public/Home/Default";
 </script>

</head>

<style type="text/css">
#center { 
text-align:center;
margin-left:auto; 
margin-right:auto;
}
.m_line{margin-top: 40px;}
</style>
<body>
    <br>
        <div id="center">
        <i class='fa fa-flag' style='    font-size: 40px;color: #77DDFF;'></i><span style="    margin: 50px 0 0 -37px;position: absolute;"><a href="/wisdom/Index.php/Home/Business/proCheck?dealerid=<?php echo ($dealerid); ?>" style="text-decoration:none;color:black;cursor:pointer;">中标</a></span><i class="fa fa-arrow-right" style='    font-size: 20px;    padding-left: 10px;'></i>

        <i class='fa fa-flag' style="font-size: 40px;color:<?php if(($comContract) == ""): ?>gray<?php else: ?>#77DDFF<?php endif; ?>;"></i><span style="    margin: 50px 0 0 -37px;position: absolute;"><a onclick="isContract(<?php echo ($dealerid); ?>);" style="text-decoration:none;color:black;cursor:pointer;">合同</a></span><i class="fa fa-arrow-right" style='    font-size: 20px;    padding-left: 10px;'></i>

        <i class='fa fa-flag' style="font-size: 40px;color: <?php if(($comRemit) == ""): ?>gray<?php else: ?>#77DDFF<?php endif; ?>;"></i><span style="    margin: 50px 0 0 -37px;position: absolute;"><a onclick="isRemit(<?php echo ($dealerid); ?>);" style="text-decoration:none;color:black;cursor:pointer;">打款</a></span><i class="fa fa-arrow-right" style='    font-size: 20px;    padding-left: 10px;'></i>

        <i class='fa fa-flag' style="font-size: 40px;color:  <?php if(($finishDispatch) == ""): ?>gray<?php else: ?>#77DDFF<?php endif; ?>;"></i><span style="    margin: 50px 0 0 -37px;position: absolute;"><a onclick="isDispatch(<?php echo ($dealerid); ?>);" style="text-decoration:none;color:black;cursor:pointer;">发货</a></span><i class="fa fa-arrow-right" style='    font-size: 20px;    padding-left: 10px;'></i>

        <i class='fa fa-flag' style="font-size: 40px;color:  <?php if(($receive) == ""): ?>gray<?php else: ?>#77DDFF<?php endif; ?>;"></i><span style="    margin: 50px 0 0 -37px;position: absolute;"><a onclick="isReceive(<?php echo ($dealerid); ?>);" style="text-decoration:none;color:black;cursor:pointer;">收货</a></span><i class="fa fa-arrow-right" style='    font-size: 20px;    padding-left: 10px;'></i>

        <i class='fa fa-flag' style="font-size: 40px;color:  <?php if(($square) == ""): ?>gray<?php else: ?>#77DDFF<?php endif; ?>;"></i><span style="    margin: 50px 0 0 -37px;position: absolute;"><a onclick="isSettlement(<?php echo ($dealerid); ?>);" style="text-decoration:none;color:black;cursor:pointer;">结算</a></span>

    </div>
    <div>
        <hr class="m_line"></hr>   
    </div>

    <div class="main_right fl">

            <span>授权书发放日期：<?php echo ($time); ?></span>
            <span>授权书编号：<?php echo ($result["f_authnumber"]); ?></span>
            <!--<button >下载</button>-->

          <div class="accredit"   id="eDiv">
              <div  style="padding-left:34px;">
                  <h2 class="acc_h2">企业区域招商授权书</h2>
                    <h3>（企业<input  type="text" id="companyName" value="<?php echo ($companyDetail["companyName"]); ?>" style="border:none; border-bottom:1px solid #000; width:300px;text-align: center;" readonly />授权号：<input  type="text" id="number" value="<?php echo ($result["f_authnumber"]); ?>" style="border:none; border-bottom:1px solid #000; text-align: center;" readonly />）</h3>
                    <p style="text-indent:2em; margin-top:20px;">兹授权姓名:<input  type="text" id="trueName" value="<?php echo ($userDetail["trueName"]); ?>" style="border:none; border-bottom:1px solid #000; width:120px;text-align: center;" readonly />身份证号:<input  type="text" id="idCard" value="<?php echo ($userDetail["idCard"]); ?>" style="border:none; border-bottom:1px solid #000; text-align: center;" readonly />，经本企业安排指定在:<input  type="text" id="mainArea" value="<?php echo ($companyDetail["mainArea"]); ?>" style="border:none; border-bottom:1px solid #000; width:280px;text-align: center;" readonly />区域，协助本公司完成指定系列产品的本区域招商工作，经公司委托与意向客户:<input  type="text" id="companynameone" value="<?php echo ($detail["f_companynameone"]); ?>" style="border:none; border-bottom:1px solid #000; width:300px;text-align: center;" readonly /> 进行招商洽谈与后续招商合同签定工作，本授权书仅用于经销商合作谈判使用，所有涉及公司经销政策、促销支持、市场费用等，均以公司书面确认盖章为准，所授权委托业务员一律不允许接触货款等现金或财务代办事项。</p>
                     <p style="text-indent:2em; margin-top:20px;">
                            本授权有效时间<input  value="30" type="text" style="border:none; border-bottom:1px solid #000; width:26px; text-align:center;" readonly />天，过期失效，特此授权。
                     </p>
                        <p style="text-indent:2em; margin-top:10px;">
                            凭本授权号可以在小宝招商平台（www.51lick.com）查寻本授权书内容。
                        </p>
                        <p style="text-indent:2em; margin:20px 0px; text-align:right;">单位名称：<input  type="text" id="companyname" style="border:none; border-bottom:1px solid #000; width:300px; text-align:center;"  readonly value="<?php echo ($companyDetail["companyName"]); ?>"/>生效时间：<input  type="text" id="year" value="<?php echo ($date[0]); ?>" style="border:none; border-bottom:1px solid #000; width:36px; text-align:center;"  readonly />年<input  type="text" id="month" value="<?php echo ($date[1]); ?>" style="border:none; border-bottom:1px solid #000; width:36px; text-align:center;"  readonly />月<input  type="text" id="day" value="<?php echo ($date[2]); ?>" style="border:none; border-bottom:1px solid #000;text-align:center;"  readonly />日</p>
                         <h2 class="acc_h2">货款第三方监管交易提醒</h2>
                        <p  style="text-indent:2em;">为保证经销商利益，保证货款安全和业务员的成果收益，在与招商企业协商一致下，小宝招商为合作双方设立银行第三方监管交易帐户，该监管账户是经销商与招商企业之间往来货款临时存储并由银行监管资金流向的专门账户，所有货款经经销商及业务员收货并验收无误确认后，方能打入招商企业帐户。未通过第三方监管帐户交易的行为，小宝招商平台对货款安全不负任何责任。</p> 
                        <p class="p1">第三方监管账号信息如下:</p>               
                        <p class="p1">开户行：温州银行杭州分行营业部</p>               
                        <p class="p1">账号：903070120190000063</p>
                        <p class="p1">户名：杭州日思夜享数据科技有限公司</p>               
                </div>
          </div>
    </div> 


</body>

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

 
 
 
<script type="text/javascript">

</script>
</html>