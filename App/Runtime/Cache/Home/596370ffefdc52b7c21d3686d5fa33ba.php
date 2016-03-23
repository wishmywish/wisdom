<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧运营平台::工作管理</title>
        <style>
            /*列出所有图标*/
            /*菜单红条*/
            .menu_line_red{background:url(/wisdom/Public/Home/Default/images/bg.png) repeat-x -0px -10px;}
            /*菜单蓝条*/
            .menu_line_blue{background:url(/wisdom/Public/Home/Default/images/bg.png) repeat-x -0px -15px;}

        .divide-line {
            position: absolute;
            right: 165px;
            top: 12px;
            width: 0;
            font-size: 0;
            height: 25px;
            border-right: #04c3e0 1px solid;
            }
            .cp_set{
                float: right;
                right: 178px;
                cursor: pointer;
                position: absolute;
                width: 80px;
                height: 30px;
                top: 10px;
                line-height: 30px;
                text-align: center;
            }
            .cp_set:hover{
                background-color: rgba(4, 195, 224,0.5);
                color:#ffff00;
            }
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
        <script src="/wisdom/Public/static/js/tealeaf.js"></script>
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
        <!--cookie插件-->
        <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>

        <script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
        
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Home/Default/css/home.css" />
        
        <!--自动补全插件-->
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/jquery.bigautocomplete.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.min.css" />
        <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>

    </head>
    <body>
        <div class="head">
            <div class="head_center" style="position: relative;">

                <div class="logo">
                    <?php if($imgurl != ''): ?><img style="height: 30px;margin-top: 8px;" src="/wisdom/Public/upfile/<?php echo ($imgurl); ?>" ><?php endif; ?>

                </div>

                <div class="company_name"><?PHP echo cookie("companyName")?></div>
                <div style="width:100px;float:left;padding-left:20px;">
                    <?php if($state == 4): ?><span style="color:#ffffff">(待审核)</span><?php endif; ?>

                    <?php if($state == 1): ?><!--银-->
                       <?php if($level == 1): ?><img src="/wisdom/Public/Home/Default/images/ptqy.png" style="height:45px;width:150px;"/>
                           <!--金-->
                           <?php elseif($level == 2): ?>
                           <img src="/wisdom/Public/Home/Default/images/gold.png" style="height:45px;width:150px;"/>
                           <!--钻石-->
                           <?php else: ?>
                           <img src="/wisdom/Public/Home/Default/images/zhushi.png" style="height:45px;width:150px;"/><?php endif; endif; ?>
                </div>

                <!--<div class="search">-->
                    <!--<div class='input_input'><input type="text" name="search_text" id="search_text"></div>-->
                    <!--<div class="input_icon"><span class="fa fa-search fa-lg"></span></div>-->
                <!--</div>-->
                <?php if( !in_array("e1",$access_array) ){ echo "<!--"; } ?>
                <span class="cp_set" onclick="location.href = APP+'/Admin/Companyset/index'">企业资料维护</span>
                <b class="divide-line"></b>
                <?php if( !in_array("e1",$access_array) ){ echo "-->"; } ?>
                <div class="personal_info">
                    <div  style="width:100%;">
                        <div class="pro_img"><img style="height: 35px;" src="<?php echo ($headlogo); ?>"></div>

                        <div style="height: 50px;">
                            <!--<?php echo empty(cookie("trueName"))?cookie("mobile"):cookie("trueName"); ?>-->
                            <!--<?php echo ($userInfo_arr['list']['trueName']); ?>-->
                            <?php if(empty($userInfo_arr['list']['trueName']) == true): echo ($userInfo_arr['list']['mobile']); else: echo ($userInfo_arr['list']['trueName']); endif; ?>
                            <i style="width: 30px;" id="personal_info" class="fa fa-chevron-circle-down"></i>
                            <b class="caret"></b>
                        </div>
                    </div>

                    <div class="personal_info_set">
                       <ul>
<!--                        <li>帮助</li>-->
                           <!--<?php if( !in_array("e1",$access_array) ){ echo "&lt;!&ndash;"; } ?>-->
                           <!--<li onclick="location.href = APP+'/Admin/Group/index'">企业资料维护</li>-->
                           <!--<?php if( !in_array("e1",$access_array) ){ echo "&ndash;&gt;"; } ?>-->
                        <li onclick="location.href = APP+'/Home/Office/index'">返回首页</li>

                        <li id="back_system">退出</li>
                       </ul>
                    </div>
                 
                </div>

<!--                <div class="back_system"  id="back_system">退出</div>-->
            </div>
        </div>
        <script>
            $("#back_system").click(function(){
                var loadi=layer.load(0);
                $.get("<?php echo U('Api/outLogin');?>",function(){
                    Cookie.eraseCookie("bigMenuIndex");
                    Cookie.eraseCookie("smallMenuIndex");
                    layer.close(loadi);
                    layer.msg("成功退出系统",{icon:9})
                    location.href=APP+"/Home/Index/index";
                }); 
            });
            $("#personal_info").mouseover(function(event) {
                $(".personal_info_set").show();
                $(".personal_info_set").mouseout(function(event){
                    $(".personal_info_set").hide();
                });
            });

            $("#personal_info").hover(function(){
                $(".personal_info_set").slideDown("slow","swing");
                $(".personal_info_set").mouseover(function(){
                    $(".personal_info_set").show();
                });
                $(".personal_info_set").mouseout(function(){
                    $(".personal_info_set").hide();
                });
            },function(){
                $(".personal_info_set").slideDown();
            });


        </script>
<div class="menu">
    <div class="menu_big">
        <div class="menu_big_list">
            <ul id="menu_big_list_button">
                <?php if(is_array($bigclass)): $i = 0; $__LIST__ = $bigclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li value="<?php echo ($vo["f_sys_column_url"]); ?>" id="<?php echo ($vo["f_sys_column_cid"]); ?>" contextmenu="<?php echo ($vo["f_sys_column_urltype"]); ?>"><?php echo ($vo["f_sys_column_name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="menu_small">
        <div class="menu_small_list">
            <ul id="menu_small_list_button">
                <?php if(is_array($smallclass)): $i = 0; $__LIST__ = $smallclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><li value="<?php echo ($vos["f_sys_column_url"]); ?>" dir="<?php echo ($vos["f_sys_column_target"]); ?>" id="<?php echo ($vos["f_sys_column_cid"]); ?>" contextmenu="<?php echo ($vos["f_sys_column_urltype"]); ?>"><?php echo ($vos["f_sys_column_name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="menu_bg_line">
            <ul id="menu_small_tab_line">
                <?php if(is_array($smallclass)): $i = 0; $__LIST__ = $smallclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><li></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>
<!--<div style="width: 100%;height: 2px;clear:both;"></div>-->
<script>
    //默认加载
    $(function(){
        if(Cookie.readCookie('bigMenuIndex')===null){
            Cookie.createCookie('bigMenuIndex',0,1);
            Cookie.createCookie('smallMenuIndex',0,1);
        }
        //alert(Cookie.readCookie('bigMenuIndex'));
        $('#menu_big_list_button li').eq(Cookie.readCookie('bigMenuIndex')).attr('class','selected');
        $('#menu_small_list_button li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','selected');
        $('#menu_small_tab_line li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','menu_tab_bg_line');
    });
    
    $('#menu_small_list_button li').mouseover(function(){
        var ind = parseInt($(this).index());
       
        if(ind!==parseInt(Cookie.readCookie('smallMenuIndex'))){
            $('#menu_small_tab_line li').eq(ind).attr('class','menu_tab_bg_line');
            $('#menu_small_tab_line li').eq(Cookie.readCookie('smallMenuIndex')).removeClass('menu_tab_bg_line');
            
            $('#menu_small_list_button li').eq(ind).attr('class','selected');
            $('#menu_small_list_button li').eq(Cookie.readCookie('smallMenuIndex')).removeClass('selected');
        }
    });
    $('#menu_small_list_button li').mouseout(function(){
        var ind = $(this).index();
        $('#menu_small_tab_line li').eq(ind).removeClass('menu_tab_bg_line');
        $('#menu_small_tab_line li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','menu_tab_bg_line');
        
        $('#menu_small_list_button li').eq(ind).removeClass('selected');
        $('#menu_small_list_button li').eq(Cookie.readCookie('smallMenuIndex')).attr('class','selected');
    });
    
    //点击大类
    $('#menu_big_list_button').on('click','li',function(){
        var url_0 = $(this).attr('value');
        var key = $(this).attr('contextmenu');
        Cookie.createCookie('bigMenuIndex',$(this).index(),1);
        Cookie.createCookie('smallMenuIndex',0,1);
        $('#menu_big_list_button li').removeClass('selected');
        $(this).attr('class','selected');
        if(key==='1'){
            location.href = APP+"/"+url_0;
        }else{
            location.href = url_0;
        }
    });
    
    //点击小类
    $('#menu_small_list_button').on('click','li',function(){
        var url_0 = $(this).attr('value');
        var key = $(this).attr('contextmenu');
        var target_1 = $(this).attr('dir');
        //alert(target_1);
        Cookie.createCookie('smallMenuIndex',$(this).index(),1);
        $('#menu_small_list_button li').removeClass('selected');
        $(this).attr('class','selected');
        if(key==='1'){
            location.href = APP+"/"+url_0;
        }else if(key==='2'){
            if(target_1==="oms"){
                //alert($('#oms').attr('src'));
                //target_1.location.href = url_0;
                $('#oms').attr('src',url_0);
            }else{
                location.href = url_0;
            }
        }
    });

    
</script>
<div class="index">
    <div class="index_left">
        <div class='org_box org_box_select'>
            <span class='org_bot_cor'></span>
            编辑地址
        </div>
    </div>
    <div class="check_center">
        <!--输入框-->
        <div class="check_head1">
            <span style="display: inline-block;">签到考勤&nbsp;>&nbsp;编辑地址</span>
        </div>
        <p style="margin-bottom: 40px;"><input onclick="location.href='<?php echo U('Office/checking');?>?return=1'" type="button" value="返回" style="float:right;border: 1px; height: 25px;width: 70px;background: #14bce1;color: #fff; cursor: pointer;"></p>
        <!--列表-->
        
        <div class="check_list">
        <form id="form1">
        <input id="id" name="id" style="width: 280px;" type="hidden" value="<?php echo ($GPSTypeAddDetail["list"]["id"]); ?>">
            <div class="titleAdd">编辑地址</div>
            <div class="contentListAdd">
                <div class="lineTop">
                    <span><i style="color: red;">*</i>序号</span>
                    <input id="orderNo" name="orderNo" style="width: 280px;" type="text" value="<?php echo ($GPSTypeAddDetail["list"]["orderNo"]); ?>">
                </div>
                <div class="lineTop">
                    <span><i style="color: red;">*</i>名称</span>
                    <input id="name" name="name" style="width: 280px;" type="text" value="<?php echo ($GPSTypeAddDetail["list"]["name"]); ?>">
                </div>
                <div class="lineTop">
                    <span><i style="color: red;">*</i>上班时间</span>
                    <input id="startDate" name="beginDate" class="laydate-icon" value="" placeholder="上班时间" style="height: 25px;width: 155px;margin-right:28px;padding-left: 15px;">
                </div>
                <div class="lineTop">
                    <span><i style="color: red;">*</i>下班时间</span>
                    <input id="endDate" name="endDate" class="laydate-icon" value="" placeholder="下班时间" style="height: 25px;width: 155px;padding-left: 15px;margin-right: 32px;">
                </div>
                <div class="lineTop">
                    <span><i style="color: red;">*</i>人员范围</span>
                    <input id="userNames" name="userNames" style="width: 280px;" type="text" value="<?php echo ($GPSTypeAddDetail["userNames"]); ?>" readonly="readonly"  onclick="selectUsers();" >
                    <span style="position: absolute;margin-left: -107px;margin-top: 2px;color: #CCCCCC" class="fa fa-search fa-lg" onclick="selectUsers();"></span>
                    <input id="userIds" name="userIds" style="width: 280px;" type="hidden" value="<?php echo ($GPSTypeAddDetail["userIds"]); ?>">
                </div>
                <div class="lineTop">
                   <span>定位信息</span>
                    <select name="countryId" id="countryId" onchange="changeCountry(this.value, '');">
                        <option value=""></option>
                        <?php if(!empty($countryList["list"])): if(is_array($countryList["list"])): $i = 0; $__LIST__ = $countryList["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$countryList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($countryList["countryId"]); ?>" <?php if($GPSTypeAddDetail['list']['countryId'] == $countryList['countryId']): ?>selected="selected"<?php endif; ?>><?php echo ($countryList["countryName"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </select>
                   <select name="provinceId" id="provinceId" onchange="changeProvince(this.value, '');">
                        <option value=""></option>
                    </select>
                    <select name="cityId" id="cityId">
                        <option value=""></option>
                    </select>
                </div>
                <div class="lineTop">
                    <span><i style="color: red;">*</i>详细地址</span>
                    <input id="address" name="address" style="width: 280px;" type="text" value="<?php echo ($GPSTypeAddDetail["list"]["address"]); ?>" >
                    <span style="position: absolute;margin-left: -107px;margin-top: 2px;color: #CCCCCC" class="fa fa-search fa-lg" onclick=""></span>
                </div>
                <div class="lineTop">
                    <span><i style="color: red;">*</i>经纬度</span>
                    <input id="x" name="x" style="width: 136px;" type="text" value="<?php echo ($GPSTypeAddDetail["list"]["x"]); ?>" onclick="showMap()">
                    <input id="y" name="y" style="width: 136px;" type="text" value="<?php echo ($GPSTypeAddDetail["list"]["y"]); ?>" onclick="showMap()">
                </div>
                <div class="lineTop">
                    <span><i style="color: red;">*</i>允许偏移距离(米)</span>
                   <input id="checkDistance" name="checkDistance" style="width: 280px;" type="text" value="<?php echo ($GPSTypeAddDetail["list"]["checkDistance"]); ?>">
                </div>
                <div class="lineTop">
                    <label style="margin-left: 175px;">
                        <?php if($GPSTypeAddDetail['list']['isCheck'] == 1): ?><input id="isCheck" name="isCheck" style="vertical-align: middle;" type="checkbox" checked="checked"  value="<?php echo ($GPSTypeAddDetail["list"]["isCheck"]); ?>"  />超出偏差距离后允许签到<?php else: ?><input id="isCheck" name="isCheck" style="vertical-align: middle;" type="checkbox"  value="<?php echo ($GPSTypeAddDetail["list"]["isCheck"]); ?>"  />超出偏差距离后允许签到<?php endif; ?>
                    </label>
                </div>
			
            </div>
       </form>
            <div class="check_btn" style="float: left;margin: -40px 0 0 -100px;">
                <button class="bntns" onclick="doSubmit();">提交</button>
                <button class="bntns" style="background: #fafafa;color: #595758;" onclick="location.href='<?php echo U('Office/checking');?>?return=1'">取消</button>
            </div>
        </div>
   
    </div>

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
    $(function(){
        function getNow() {
            var d = new Date();
            var vYear = d.getFullYear();
            var vMon = d.getMonth() + 1;
            var vDay = d.getDate();
            var h = d.getHours();
            var m = d.getMinutes();

            return vYear+"-"+vMon+"-"+vDay+" "+h+":"+m;
        }
        var start = {
            elem: '#startDate',
            format: 'YYYY-MM-DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                end.min = datas; //开始日选好后，重置结束日的最小日期
                end.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end = {
            elem: '#endDate',
            format: 'YYYY-MM-DD hh:mm',
            min: '1899-06-16', //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            start: getNow(),
            istime: true,
            istoday: false,
            choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        laydate(start);
        laydate(end);
    });

    //百度地图API功能,显示api
    function showMap() {

        //设置地图的显示的城市，如果选了城市，就是城市，没选就是省，省没选就是中国,默认是中国
        var provinceId = $("#provinceId").val(); //省id
        var province = $("#province"+provinceId).text();  //省
        var cityId = $("#cityId").val();  //城市id
        var city = $("#city"+cityId).text();  //城市

        layer.open({
            type:2,
            title :['经纬度选择','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '520px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/showMap');?>"+"?province="+province+"&city="+city,
        });
    }

    function doSubmit() {
    	 var orderNoObj = $("#orderNo");
         if (getValLen(orderNoObj) == 0) {
             layer.msg("序号不能为空",{icon: 8});
             orderNoObj.focus();
             return false;
         } else if (getValLen(orderNoObj) > 16) {
             layer.msg("序号最多为16字",{icon: 8});
             orderNoObj.focus();
             return false;
         }

         var nameObj = $("#name");
         if (getValLen(nameObj) == 0) {
             layer.msg("名称不能为空",{icon: 8});
             nameObj.focus();
             return false;
         } else if (getValLen(nameObj) > 16) {
             layer.msg("名称最多为16字",{icon: 8});
             nameObj.focus();
             return false;
         }

         var userIdsObj = $("#userIds");
         if (getValLen(userIdsObj) == 0) {
             layer.msg("人员范围不能为空",{icon: 8});
             userIdsObj.focus();
             return false;
         } 
         
         var countryIdObj = $("#countryId");
         if (getValLen(countryIdObj) == 0) {
             layer.msg("国家不能为空",{icon: 8});
             countryIdObj.focus();
             return false;
         } 
         
         var provinceIdObj = $("#provinceId");
         if (getValLen(provinceIdObj) == 0) {
             layer.msg("省份不能为空",{icon: 8});
             provinceIdObj.focus();
             return false;
         } 
         
         var cityIdObj = $("#cityId");
         if (getValLen(cityIdObj) == 0) {
             layer.msg("城市不能为空",{icon: 8});
             cityIdObj.focus();
             return false;
         } 
         
         var addressObj = $("#address");
         if (getValLen(addressObj) == 0) {
             layer.msg("详细地址不能为空",{icon: 8});
             addressObj.focus();
             return false;
         } 
         
         var xObj = $("#x");
         if (getValLen(xObj) == 0) {
             layer.msg("经度不能为空",{icon: 8});
             xObj.focus();
             return false;
         } else if (getValLen(xObj) > 200) {
             layer.msg("经度最多为200字",{icon: 8});
             xObj.focus();
             return false;
         } 
         
         var yObj = $("#y");
         if (getValLen(yObj) == 0) {
             layer.msg("纬度不能为空",{icon: 8});
             yObj.focus();
             return false;
         } 

         var checkDistanceObj = $("#checkDistance");
         if (getValLen(checkDistanceObj) == 0) {
             layer.msg("允许偏移距离不能为空",{icon: 8});
             checkDistanceObj.focus();
             return false;
         } else if (getValLen(checkDistanceObj) > 16) {
             layer.msg("允许偏移距离最多为16字",{icon: 8});
             checkDistanceObj.focus();
             return false;
         }  
         
         // var isCheckObj = $("#isCheck");
         // if (getValLen(isCheckObj) == 0) {
         //     layer.msg("超出偏差距离后允许签到不能为空",{icon: 8});
         //     isCheckObj.focus();
         //     return false;
         // } else if (getValLen(isCheckObj) > 16) {
         //     layer.msg("超出偏差距离后允许签到最多为16字",{icon: 8});
         //     isCheckObj.focus();
         //     return false;
         // }  
         
        var loadIdx = layer.load(0);
        var formData = $("#form1").serializeArray();
        $.post("<?php echo U('Office/saveGPSTypeAdd');?>", formData, function(data) {
            layer.close(loadIdx);
            if(data.error_code == "success") {
                layer.msg("成功", {time: 2*1000});
                location.href="<?php echo U('Office/checking');?>?return=1";
            } else{
                layer.msg("失败，" + data.error_text,{icon: 8});
            }
        }, 'json');
    }

    function getValLen(obj) {
        return $.trim(obj.val()).length;
    }

    function selectUsers() {
        var userNames = $("#userNames").val();
        var userIds = $("#userIds").val();
        layer.open({
            type:2,
            title :['人员范围','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['800px', '400px'],
            shadeClose: true, //点击遮罩关闭
            content: "<?php echo U('Office/selectUsers');?>" + "?userNames=" + userNames + "&userIds=" + userIds,
        });
    }
    function changeCountry(countryID, checkProvinceId) {
        if(countryID == "") {
            $("#provinceId").html("<option value=''></option>");
        } else {
            $.post("<?php echo U('Office/getProvinceList');?>", {'countryId':countryID}, function(data) {
                if(data.error_code == "success") {
                    if (!("list" in data)) {
                        $("#provinceId").html("<option value=''></option>");
                    } else {
                        content = "<option value=''></option>";
                        $.each(data.list, function(k, v) {
                            var selected = "";
                            if(checkProvinceId!= "" && v.provinceId == checkProvinceId) {
                                selected = "selected='selected'";
                            }
                            content += "<option value='"+ v.provinceId +"'"+ selected +" id='province"+ v.provinceId+"' >"+ v.provinceName +"</option>";
                        });
                        $("#provinceId").html(content);
                    }
                } else{
                    $("#provinceId").html("<option value=''></option>");
                }
            }, 'json');
        }
        $("#cityId").html("<option value=''></option>");
    }

    function changeProvince(provinceID, checkCityId) {
        if(provinceID == "") {
            $("#cityId").html("<option value=''></option>");
        } else {
            $.post("<?php echo U('Office/getCityList');?>", {'provinceId':provinceID}, function(data) {
                if(data.error_code == "success") {
                    if (!("list" in data)) {
                        $("#cityId").html("<option value=''></option>");
                    } else {
                        content = "<option value=''></option>";
                        $.each(data.list, function(k, v) {
                            var selected = "";
                            if(checkCityId!= "" && v.cityId == checkCityId) {
                                selected = "selected='selected'";
                            }
                            content += "<option value='"+ v.cityId +"' "+ selected +" id='city"+ v.cityId +"' >"+ v.cityName +"</option>";
                        });
                        $("#cityId").html(content);
                    }
                } else{
                    $("#cityId").html("<option value=''></option>");
                }
            }, 'json');
        }
    }

    var countryId = '<?php echo ($GPSTypeAddDetail["list"]["countryId"]); ?>';
    var provinceId = '<?php echo ($GPSTypeAddDetail["list"]["provinceId"]); ?>';
    var cityId = '<?php echo ($GPSTypeAddDetail["list"]["cityId"]); ?>';
    changeCountry(countryId, provinceId);
    changeProvince(provinceId, cityId);
</script>
</body>
</html>