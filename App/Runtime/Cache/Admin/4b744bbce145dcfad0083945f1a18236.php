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
	<div class="c_head">
       <h4>企业设置：</h4>
    <div class="c_nav">
 		<ul class="nav nav-tabs nav-justified">
		  <li role="presentation" class="active" id="one"><a href="#">基本信息</a></li>
		  <li role="presentation"  id="two"><a href="#">上传资料</a></li>
		</ul>
    </div>
	</div>

	<div class="c_content">

        <!--企业设置start-->
		<div id="c0" style="min-height: 500px;">
	    <ul>
			<li>
				<label class="c_name">企业全称</label>
			    <input type="text" id="fullname" value="<?php echo ($cInfo['companyName']); ?>"/>
                <span class="c_spanText">*必填</span>
			</li>
		</ul>

        <ul>
            <li>
                <label class="c_name">法人代表</label>
                <input type="text" id="c_legal" value="<?php echo ($cInfo['companyLegal']); ?>" />
                <span class="c_spanText">*必填</span>
            </li>
        </ul>


        <ul>
            <li>
                <label class="c_name">联系人</label>
                <input type="text" id="c_link" value="<?php echo ($cInfo['contactPerson']); ?>" />
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">固定电话</label>
                <input type="text" id="c_phone"  value="<?php echo ($cInfo['contactMobile']); ?>" />
                <span class="c_spanText">*必填</span>
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">联系手机</label>
                <input type="text" id="c_tel"  value="<?php echo ($cInfo['phone']); ?>" />
                <span class="c_spanText">*必填</span>
            </li>
        </ul>

        <ul>
            <li>
                <label class="c_name">联系邮箱</label>
                <input type="text" id="c_email" value="<?php echo ($cInfo['email']); ?>" />
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">官网地址</label>
                <input type="text" id="c_websit" value="<?php echo ($cInfo['website']); ?>" />
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">公司地址</label>
                <input type="text" id="c_address" value="<?php echo ($cInfo['address']); ?>" />
                <span class="c_spanText">*必填</span>
            </li>
        </ul>

        <ul>
            <li>
                <label class="c_name">注册资金</label>
                <input style="width: 150px;margin-right: 5px;" type="text" id="c_regCapital" value="<?php echo ($cInfo['regCapital']); ?>" />万元
                <span class="c_spanText">*必填</span>
            </li>
        </ul>

		<ul>
			<li>
				<label class="c_name">所处行业</label>
                <select style="width: 180px;height:28px;" id="c_business">
                    <?php if(is_array($industry)): foreach($industry as $key=>$vo): ?><option value="<?php echo ($vo['industryId']); ?>" <?php if($cInfo['industryId'] == $vo['industryId']): ?>selected<?php endif; ?> ><?php echo ($vo['industryName']); ?></option><?php endforeach; endif; ?>
                </select>
			<span class="c_spanText">*必填</span>
			</li>
		</ul>


        <ul>
            <li>
                <label class="c_name">主销产品</label>
                <input type="text" id="c_products" value="<?php echo ($cInfo['mainProduct']); ?>" />
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">主销区域</label>
                <input type="text" id="c_area" value="<?php echo ($cInfo['mainArea']); ?>" />
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">年营业额</label>
                <input style="width: 150px;margin-right: 5px;" type="text" id="c_year" value="<?php echo ($cInfo['turnOver']); ?>" />万元
                <span class="c_spanText">*必填</span>
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">现有经销商人数</label>
                <input type="text" id="c_dealer" value="<?php echo ($cInfo['ageCount']); ?>" placeholder="请输入数字"/>
                <!--<span class="c_spanText">*必须是数字</span>-->
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">现有员工总数</label>
                <input type="text" id="c_staff" value="<?php echo ($cInfo['employeeCount']); ?>" placeholder="请输入数字"/>
                <!--<span class="c_spanText">*必须是数字</span>-->
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">现有销售人员数</label>
                <input type="text" id="c_salesman" value="<?php echo ($cInfo['salesCount']); ?>" placeholder="请输入数字"/>
                <!--<span class="c_spanText">*必须是数字</span>-->
            </li>
        </ul>


        <ul>
            <li>
                <label class="c_name">有无质量管理部门</label>
                <input type="radio" id="quality" name="quality"  value="1" <?php if($cInfo['qualityManagDep'] == 1): ?>checked<?php endif; ?>  /><span  style="margin-right:10px">有</span>
                <input type="radio" id="quality"  name="quality"  value="2" <?php if($cInfo['qualityManagDep'] == 2): ?>checked<?php endif; ?> /><span  style="margin-right:10px">无</span>
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">有无技术研发部门</label>
                <input type="radio" id="technology" name="technology"  value="1" <?php if($cInfo['techDep'] == 1): ?>checked<?php endif; ?> /><span  style="margin-right:10px">有</span>
                <input type="radio" id="technology"  name="technology"  value="2" <?php if($cInfo['techDep'] == 2): ?>checked<?php endif; ?> /><span  style="margin-right:10px">无</span>
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">有无市场策划部门</label>
                <input type="radio" id="market" name="market"  value="1" <?php if($cInfo['markDep'] == 1): ?>checked<?php endif; ?> /><span  style="margin-right:10px">有</span>
                <input type="radio" id="market"  name="market"  value="2" <?php if($cInfo['markDep'] == 2): ?>checked<?php endif; ?> /><span  style="margin-right:10px">无</span>
            </li>
        </ul>
        <ul>
            <li>
                <label class="c_name">有无售后服务部门</label>
                <input type="radio" id="service" name="service"  value="1"  <?php if($cInfo['aftersaleDep'] == 1): ?>checked<?php endif; ?> /><span  style="margin-right:10px">有</span>
                <input type="radio" id="service"  name="service"  value="2" <?php if($cInfo['aftersaleDep'] == 2): ?>checked<?php endif; ?> /><span  style="margin-right:10px">无</span>
            </li>
        </ul>




		<div class="c_footer" style="margin:20px 0 100px 150px;">
                        <ul>
                            <li style="background-color:#15BCE0;color:#fff;" id="c_set_submit">下一步</li>
                       </ul>
                   </div>
		</div>
        <!--企业设置end-->


        <!--上传资料 start-->
		<div id="c1" style="display:none;min-height: 700px;">
            <div class="line_input" style="min-height: 0px;">
                <div class="upfile_pack">
                    <div>营业执照上传资料：<span style="color: red;">*必选(上传文件支持JPG,JPEG,PNG格式的图片文件)</span></div>
                    <br/>
                    <!--<input type="text" style="width: 180px;height:25px;" id="data_name" />-->
                    <button id="btn_up_other" class="btn btn-default" style="float: left;" onclick="$('#business_licence_logo').click();">上传</button>
                    <!--<button class="btn btn-default" id="btnBusiness_licence_" style="margin-left: 30px;" onclick="business_licence_upload();">请确认上传</button>-->

                    <div style="display: none;">
                        <input type="file" id="business_licence_logo" name="upfile" accept="image/jpg,image/gif,image/png,image/jpeg">
                    </div>
                 <input type="hidden" id="fileid_other_1" name="fileid_other" value="<?php echo ((isset($business_licence["f_id"]) && ($business_licence["f_id"] !== ""))?($business_licence["f_id"]):0); ?>">
                </div>
                <div id="c_pic_1" <?php if($business_licence != null): ?>style="display: block;"<?php else: ?>style="display:none"<?php endif; ?> >

                    <div id="pic_1" class="c_pic_up"  style="float: left;">
                        <div class="show_progress_no" id="show_progress_no_other_1"><?php if($business_licence != null): ?>100%<?php else: ?>0%<?php endif; ?></div>
                        <div class="progress_up" id="progress_up_other_1">
                            <div class="bar" id="bar_other_1"  <?php if($business_licence != null): ?>style="width: 100%;"<?php endif; ?> ></div>
                        </div>
                        <div class="show_img" id="show_img_other_1">
                            <?php if($business_licence != null): ?><a target="_blank"  href="/wisdom/Public/upfile/<?php echo ($business_licence["f_filepath"]); echo ($business_licence["f_filename"]); ?>"><img  width="100px" height="100px" src="/wisdom/Public/upfile/<?php echo ($business_licence["f_filepath"]); echo ($business_licence["f_filename"]); ?>"></a><a href="#"  style="padding-left:10px;" onclick="delimg(1)">删除</a><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="line_input"  style="min-height:0px;">-->
                <!--<div class="upfile_pack">-->

                    <!--<div>税务登记证：</div>-->
                    <!--<br/>-->
                    <!--&lt;!&ndash;<input type="text" style="width: 180px;height:25px;" id="data_name_2" />&ndash;&gt;-->
                    <!--<button id="btn_up_other2" class="btn btn-default" onclick="$('#tax_registration_logo').click();">上传</button>-->
                    <!--<button class="btn btn-default" id="btnTax_registration" style="margin-left: 30px;" onclick="tax_registration_upload();">请确认上传</button>-->

                    <!--<div style="display: none;">-->
                        <!--<input type="file" id="tax_registration_logo" name="upfile" accept="image/jpg,image/gif,image/png">-->
                    <!--</div>-->
                    <!--<input type="hidden" id="fileid_other_2" name="fileid_other" value="">-->
                <!--</div>-->
                <!--<div id="c_pic_2" style="display: none;">-->

                    <!--<div id="pic_2" class="c_pic_up"  style="float: left;">-->
                    <!--<div class="show_progress_no" id="show_progress_no_other_2">0%</div>-->
                    <!--<div class="progress_up" id="progress_up_other_2">-->
                        <!--<div class="bar" id="bar_other_2"></div>-->
                    <!--</div>-->
                    <!--<div class="show_img" id="show_img_other_2"></div>-->
                    <!--</div>-->

                <!--</div>-->

            <!--</div>-->

            <!--<br/>-->

            <!--<div class="line_input"  style="min-height:0px;">-->
                <!--<div class="upfile_pack">-->

                    <!--<div>组织机构代码证：</div>-->
                    <!--<br/>-->
                    <!--&lt;!&ndash;<input type="text" style="width: 180px;height:25px;" id="data_name_2" />&ndash;&gt;-->
                    <!--<button id="btn_up_other3" class="btn btn-default" onclick="$('#tax_registration_logo3').click();">上传</button>-->
                    <!--<button class="btn btn-default" id="btnTax_registration3" style="margin-left: 30px;" onclick="tax_registration_upload3();">请确认上传</button>-->

                    <!--<div style="display: none;">-->
                        <!--<input type="file" id="tax_registration_logo3" name="upfile" accept="image/jpg,image/gif,image/png">-->
                    <!--</div>-->
                    <!--<input type="hidden" id="fileid_other_3" name="fileid_other" value="">-->
                <!--</div>-->
                <!--<div id="c_pic_3" style="display: none;">-->

                    <!--<div id="pic_3" class="c_pic_up"  style="float: left;">-->
                        <!--<div class="show_progress_no" id="show_progress_no_other_3">0%</div>-->
                        <!--<div class="progress_up" id="progress_up_other_3">-->
                            <!--<div class="bar" id="bar_other_3"></div>-->
                        <!--</div>-->
                        <!--<div class="show_img" id="show_img_other_3"></div>-->
                    <!--</div>-->

                <!--</div>-->

            <!--</div>-->

            <br/>

            <div class="line_input"  style="min-height:0px;margin-top:40px;">
                <div class="upfile_pack">

                    <div>公司标志(logo)：<span style="color: red;">*必选(上传文件支持JPG,JPEG,PNG格式的图片文件)</span></div>
                    <br/>
                    <!--<input type="text" style="width: 180px;height:25px;" id="data_name_2" />-->
                    <button id="btn_up_other4" class="btn btn-default" onclick="$('#tax_registration_logo4').click();">上传</button>
                    <!--<button class="btn btn-default" id="btnTax_registration4" style="margin-left: 30px;" onclick="tax_registration_upload4();">请确认上传</button>-->

                    <div style="display: none;">
                        <input type="file" id="tax_registration_logo4" name="upfile" accept="image/jpg,image/gif,image/png,image/jpeg">
                    </div>
                    <input type="hidden" id="fileid_other_4" name="fileid_other" value="<?php echo ((isset($core_logo["f_id"]) && ($core_logo["f_id"] !== ""))?($core_logo["f_id"]):0); ?>">
                </div>
                <div id="c_pic_4" <?php if($business_licence != null): ?>style="display: block;"<?php else: ?>style="display:none"<?php endif; ?>>
                    <div id="pic_4" class="c_pic_up"  style="float: left;">
                        <div class="show_progress_no" id="show_progress_no_other_4"><?php if($business_licence != null): ?>100%<?php else: ?>0%<?php endif; ?></div>
                        <div class="progress_up" id="progress_up_other_4">
                            <div class="bar" id="bar_other_4"  <?php if($business_licence != null): ?>style="width: 100%;"<?php endif; ?> ></div>
                        </div>
                        <div class="show_img" id="show_img_other_4">
                            <?php if($core_logo != null): ?><a target="_blank"  href="/wisdom/Public/upfile/<?php echo ($core_logo["f_filepath"]); echo ($core_logo["f_filename"]); ?>"><img  width="100px" height="100px" src="/wisdom/Public/upfile/<?php echo ($core_logo["f_filepath"]); echo ($core_logo["f_filename"]); ?>"></a><a href="#"  style="padding-left:10px;" onclick="delimg(4)">删除</a><?php endif; ?>
                        </div>
                    </div>

                </div>

            </div>

            <br/>

            <div class="line_input" style="min-height:0px;">
                <div class="upfile_pack">

                    <div>生产许可证：<span style="color:blue;">*可选(上传文件支持JPG,JPEG,PNG格式的图片文件)</span></div>
                    <br/>
                    <!--<input type="text" style="width: 180px;height:25px;" id="data_name_2" />-->
                    <button id="btn_up_other5" class="btn btn-default" onclick="$('#tax_registration_logo5').click();">上传</button>
                    <!--<button class="btn btn-default" id="btnTax_registration5" style="margin-left: 30px;" onclick="tax_registration_upload5();">请确认上传</button>-->

                    <div style="display: none;">
                        <input type="file" id="tax_registration_logo5" name="upfile" accept="image/jpg,image/gif,image/png,image/jpeg">
                    </div>
                    <input type="hidden" id="fileid_other_5" name="fileid_other" value="<?php echo ((isset($prod_licence["f_id"]) && ($prod_licence["f_id"] !== ""))?($prod_licence["f_id"]):0); ?>">
                </div>
                <div id="c_pic_5"  <?php if($prod_licence != null): ?>style="display: block;"<?php else: ?>style="display:none"<?php endif; ?> >

                    <div id="pic_5" class="c_pic_up" >
                        <div class="show_progress_no" id="show_progress_no_other_5"><?php if($prod_licence != null): ?>100%<?php else: ?>0%<?php endif; ?></div>
                        <div class="progress_up" id="progress_up_other_5">
                            <div class="bar" id="bar_other_5" <?php if($prod_licence != null): ?>style="width: 100%;"<?php endif; ?>></div>
                        </div>
                        <div class="show_img" id="show_img_other_5">
                            <?php if($prod_licence != null): ?><a  target="_blank"  href="/wisdom/Public/upfile/<?php echo ($prod_licence["f_filepath"]); echo ($prod_licence["f_filename"]); ?>"><img  width="100px" height="100px" src="/wisdom/Public/upfile/<?php echo ($prod_licence["f_filepath"]); echo ($prod_licence["f_filename"]); ?>"></a><a href="#" style="padding-left:10px;" onclick="delimg(5)">删除</a><?php endif; ?>
                        </div>
                    </div>

                </div>

            </div>
            <br/>
            <div class="line_input" style="min-height:0px;">
                <div class="upfile_pack">

                    <div>食品流通许可证：<span style="color: blue;">*可选(上传文件支持JPG,JPEG,PNG格式的图片文件)</span></div>
                    <br/>
                    <!--<input type="text" style="width: 180px;height:25px;" id="data_name_2" />-->
                    <button id="btn_up_other6" class="btn btn-default" onclick="$('#tax_registration_logo6').click();">上传</button>
                    <!--<button class="btn btn-default" id="btnTax_registration6" style="margin-left: 30px;" onclick="tax_registration_upload6();">请确认上传</button>-->

                    <div style="display: none;">
                        <input type="file" id="tax_registration_logo6" name="upfile" accept="image/jpg,image/gif,image/png,image/jpeg">
                    </div>
                    <input type="hidden" id="fileid_other_6" name="fileid_other" value="<?php echo ((isset($food_per["f_id"]) && ($food_per["f_id"] !== ""))?($food_per["f_id"]):0); ?>">
                </div>
                <div id="c_pic_6" <?php if($food_per != null): ?>style="display: block;"<?php else: ?>style="display:none"<?php endif; ?>>

                    <div id="pic_6" class="c_pic_up"  style="float: left;">
                        <div class="show_progress_no" id="show_progress_no_other_6"><?php if($food_per != null): ?>100%<?php else: ?>0%<?php endif; ?></div>
                        <div class="progress_up" id="progress_up_other_6">
                            <div class="bar" id="bar_other_6"  <?php if($food_per != null): ?>style="width: 100%;"<?php endif; ?>></div>
                        </div>
                        <div class="show_img" id="show_img_other_6">
                            <?php if($food_per != null): ?><a target="_blank"   href="/wisdom/Public/upfile/<?php echo ($food_per["f_filepath"]); echo ($food_per["f_filename"]); ?>"><img  width="100px" height="100px" src="/wisdom/Public/upfile/<?php echo ($food_per["f_filepath"]); echo ($food_per["f_filename"]); ?>"></a><a href="#" style="padding-left:10px;" onclick="delimg(6)">删除</a><?php endif; ?>
                        </div>
                    </div>

                </div>

            </div>
            <br/>
            <div class="line_input" style="min-height:0px;margin-bottom:150px;">
                <div class="upfile_pack">

                    <div>卫生许可证：<span style="color:blue;">*可选(上传文件支持JPG,JPEG,PNG格式的图片文件)</span></div>
                    <br/>
                    <!--<input type="text" style="width: 180px;height:25px;" id="data_name_2" />-->
                    <button id="btn_up_other7" class="btn btn-default" onclick="$('#tax_registration_logo7').click();">上传</button>
                    <!--<button class="btn btn-default" id="btnTax_registration7" style="margin-left: 30px;" onclick="tax_registration_upload7();">请确认上传</button>-->

                    <div style="display: none;">
                        <input type="file" id="tax_registration_logo7" name="upfile" accept="image/jpg,image/gif,image/png,image/jpeg">
                    </div>
                    <input type="hidden" id="fileid_other_7" name="fileid_other" value="<?php echo ((isset($$san_license["f_id"]) && ($$san_license["f_id"] !== ""))?($$san_license["f_id"]):0); ?>">
                </div>
                <div id="c_pic_7" <?php if($san_license != null): ?>style="display: block;"<?php else: ?>style="display:none"<?php endif; ?>>

                    <div id="pic_7" class="c_pic_up"  style="float: left;">
                        <div class="show_progress_no" id="show_progress_no_other_7"><?php if($san_license != null): ?>100%<?php else: ?>0%<?php endif; ?></div>
                        <div class="progress_up" id="progress_up_other_7">
                            <div class="bar" id="bar_other_7"  <?php if($san_license != null): ?>style="width: 100%;"<?php endif; ?> ></div>
                        </div>
                        <div class="show_img" id="show_img_other_7">
                            <?php if($san_license != null): ?><a  target="_blank"  href="/wisdom/Public/upfile/<?php echo ($san_license["f_filepath"]); echo ($san_license["f_filename"]); ?>"><img width="100px" height="100px" src="/wisdom/Public/upfile/<?php echo ($san_license["f_filepath"]); echo ($san_license["f_filename"]); ?>"></a><a href="#" style="padding-left:10px;" onclick="delimg(7)">删除</a><?php endif; ?>
                        </div>
                    </div>

                </div>

            </div>
            <br>
            <div class="c_footer">
                <ul>
                    <li style="background-color:#15BCE0;color:#fff;"  onclick="submit_pic()">提交</li>
                </ul>
            </div>
        </div>
		</div>

        <input type="hidden" id="url" value="<?php echo U('Api/Upfile/upF/type/2');?>" />
        <!--上传资料 end-->
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
<script type="text/javascript" src="/wisdom/Public/Admin/Default/js/comset_index.js"></script>
    </body>
</html>