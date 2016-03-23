<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>产品列表管理</title>
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
    <div class="adminB">
    <div class="adminMenu">
    <div class="menutop">招商管理平台</div>
    <div class="menupro">
        <div class="headimg"></div>
    </div>
    <div class="menutitle"><span class="icon-reorder"></span> MAIN NAVIGATION</div>
    <ul class="menuul">
        <li onclick="location.href = APP+'/Taskadmin/Task/index?access=100'"><span class="icon-tasks"></span>&nbsp;&nbsp;&nbsp;&nbsp;任务管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Review/index?access=200'"><span class="icon-group"></span>&nbsp;&nbsp;&nbsp;&nbsp;任务审核</li>
        <li onclick="location.href = APP+'/Taskadmin/Sales/index?access=300'"><span class="icon-group"></span>&nbsp;&nbsp;&nbsp;&nbsp;业务员管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Company/index?access=400'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;企业管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Ad/index?access=500'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;活动与广告</li>
        <li onclick="location.href = APP+'/Taskadmin/Withdraw/index?access=600'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;提现管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Salesreport/index'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;报表中心</li>
        <li onclick="location.href = APP+'/Taskadmin/DealerPro/index?access=800'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;招商进度管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Shop/index?access=900'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;产品列表管理</li>
        <li onclick="location.href = APP+'/Taskadmin/ShopRecord/index?access=1000'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;消费记录管理</li>
        <li onclick="location.href = APP+'/Taskadmin/Power/index?access=1400'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;权限部署</li>
        <li onclick="location.href = APP+'/Taskadmin/Dealer/index?access=1100'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;经销商管理</li>
        <li onclick="location.href = APP+'/Taskadmin/BehaviorAnalysis/index?access=1200'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;用户行为分析</li>
        <li onclick="location.href = APP+'/Taskadmin/UserInfo/index?access=1300'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;用户信息管理</li>
        <!--<li onclick="location.href = APP+'/Taskadmin/Report/index'"><span class="icon-globe"></span>&nbsp;&nbsp;&nbsp;&nbsp;统计报表</li>-->
    </ul>
</div>
    <div class="adminRight">
        <div class="righttop">
    <div class="showright"><span id="home_back" class="fa fa-user" style="cursor: pointer;margin-right: 20px;">返回首页</span> <span id="user_setting" class="fa fa-user">个人设置</span> <span id="user_out" class="fa fa-sign-out">退出登录</span></div>
</div>
        <div class="breadlist">首页 / 产品列表管理</div>
	    <div class="tabli">
	        <ul id="tabli_bid">
	            <li value="1" class='selected'><a href="/wisdom/index.php/Taskadmin/Shop/index" style="text-decoration:none;">全部</a></li>
	        </ul>
<!-- 	        <ul class="">
	            <li id="tabid" value="1"><input name="searchTname" id="searchTname" value="" placeholder="请输入任务名称" style="height: 30px;width: 300px;"><input type="hidden" name="searchTid" id="searchTid" value="0"></li>
	        </ul> -->
	        <ul class="action">
	            <li id="addShopClass" value="1">添加分类</li>
	            <li id="addShop" value="4">添加产品</li>
	            <li id="modiShop" value="5">修改产品</li>
	            <li id="delShop" value="6">产品下架</li>
	            <li id="resetShop" value="7">产品上架</li>
	        </ul>
	    </div>
		<div class="back">
			<div class="taocz_allsort" id="allCategoryHeader" style="margin-left:265px;">
				<div class="taocz_allsort_out" id="allCategoryHeaderBox">
					<b class="a_navbg" style="top: 0px; visibility: hidden;"><s></s></b>

					<?php if(is_array($result)): $k = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><dl flag="<?php echo ($k-1); ?>" id="<?php echo ($k-1); ?>">
							<dt>
								<s class="l_<?php echo ($k-1); ?>"></s>
								<h3>
									<a onclick="plist_shop(<?php echo ($vo["f_id"]); ?>);"><?php echo ($vo["f_classname"]); ?></a>&nbsp;&nbsp;
									<span style="display: none;" id="chaozuo<?php echo ($k-1); ?>">
										<a onclick="modishopclass(<?php echo ($vo["f_id"]); ?>);" style="color:black;"><i class="fa fa-pencil-square-o"></i>修改</a>
										<a onclick="delshopclass(<?php echo ($vo["f_id"]); ?>);" style="color:black;"><i class="fa fa-times"></i>删除</a>
									</span>
								</h3>
								<i class="jiantou"></i>
							</dt>
							<dd style="display: none;" >
								<?php if (!empty($vo['secondClass'])) { ?>
									<div class="new_show_sort2">
										<div class="sort2">
												<?php if(is_array($vo["secondClass"])): $i = 0; $__LIST__ = $vo["secondClass"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sec): $mod = ($i % 2 );++$i;?><a onclick="plist_shop(<?php echo ($sec["f_id"]); ?>);" class="secname"><?php echo ($sec["f_classname"]); ?></a>
													<!-- <input type="hidden" id="secondclassid" name="secondclassid" value="<?php echo ($sec["f_id"]); ?>"> -->
													<span style="display: none;float:right;margin-top: -20px;" class="secchaozuo" id="<?php echo ($k-1); ?>">
														<a onclick="modishopclass(<?php echo ($sec["f_id"]); ?>);" style="color:black;cursor: pointer;"><i class="fa fa-pencil-square-o"></i>修改</a>
														<a onclick="delshopclass(<?php echo ($sec["f_id"]); ?>);" style="color:black;cursor: pointer;"><i class="fa fa-times"></i>删除</a>
													</span><?php endforeach; endif; else: echo "" ;endif; ?>
										</div>
									</div>
								<?php } ?>
							</dd>
						</dl><?php endforeach; endif; else: echo "" ;endif; ?>

					<div class="clear"></div>

				    <div class="allsort_pic"></div>
				</div>
			</div>
			<div class="list" style="width:75%;float: right;display: i;">
		        <ul>
		            <li style='width:5%;'></li>
		            <li style='width:20%;'>商品名称</li>
		            <li style='width:20%;'>所属分类</li>
		            <li style='width:10%;'>产品总数</li>
		            <li style='width:15%;'>产品单价</li>
		            <li style='width:20%;'>参与活动</li>
		            <li style='width:10%;'>状态</li>
		        </ul>
			    <div class='listinfo' style="width:100%;"></div>
			    <div class="page"></div>
			</div>
		</div>
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
	<script type="text/javascript">
	$(function(){
		plist_shop();
		$('#allCategoryHeaderBox dl').each(function()
		{

			$(this).hover
			(
				function()
				{
				//
					$(this).addClass('curr');
					$(this).find('dd').show();
					$("#chaozuo"+$(this).attr("id")+"").show();
					// console.log($(this).find('dd').find('span').attr("id"));
					$(this).find('dd').find('span').show();
					$('#allCategoryHeaderBox .a_navbg').css({'top': ($(this).attr('flag') * 57) + 'px', 'visibility': 'visible'});
				},
				function(){
				//
					$(this).removeClass('curr');
					$(this).find('dd').hide();
					$("#chaozuo"+$(this).attr("id")+"").hide();
					$(this).find('dd').find('span').hide();
					$('#allCategoryHeaderBox .a_navbg').css({'top':  '0px', 'visibility': 'hidden'});
				}
			);
		});

		// $(".secchaozuo").hover(
		// 	function()
		// 		{
		// 			console.log($(".secchaozuo").attr("id"));
		// 	alert($(".secchaozuo").attr("id"));
		// 	}
		// );

	});
	</script>
</html>