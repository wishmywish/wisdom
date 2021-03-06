<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧招商::首页</title>
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
        <!--个人信息-->
        <div class="index_left_pro">
            <div class="pro_img">
                <!--<img style="height: 50px;" src="/wisdom/Public/Home/Default/images/user2.jpg">-->
                <img style="height: 50px;width: 50px;" src="<?php echo ($headlogo); ?>">
            </div>
            <div class="pro_info">
                <span style="line-height: 25px; font-size: 16px; font-weight: bold;">
                    <!--<?php echo empty(cookie("nickName"))?session("mobile"):cookie("nickName"); ?>-->
                    <?php if(empty($userInfo_arr['list']['nickName']) == true): echo ($userInfo_arr['list']['mobile']); else: echo ($userInfo_arr['list']['nickName']); endif; ?>
                </span>
            </div>
        </div>
        <!--快捷导航-->
        <div class="index_left_url_bus">
             <div class="left_url">任务标题：</div>
             <div class="business_left_url" id="tasktitle">
             </div>
        </div>
        <div class="index_left_other_bus">
            <div class="left_url">任务品牌：</div>
            <div class="business_left_url" id="taskping"></div>
            <div class="left_url">任务产品：</div>
            <div class="business_left_url" id="taskchan"></div>
            <div class="left_url">开始时间：</div>
            <div class="business_left_url" id="taskcreatetime"></div>
            <div class="left_url">结束时间：</div>
            <div class="business_left_url" id="taskendtime" style=" padding-bottom: 20px;"></div>
        </div>
     </div>
    <div class="index_right_bus">
        <div style="width:100%;height:30px;border-bottom:1px #fafafa solid;padding-bottom:20px">
            <span style="color:#595758;margin-left:20px">任务标题</span>
             <select name="taskname" id="taskname" style="width:300px;height:30px;margin-left:7px;color:#595758;border:1px #EAEAEA solid">

             </select>
            <span style="color: red;">*推广品牌或收集情报，上智慧推广发布随手赚和推广赚任务</span>
        </div>
        <div class="index_right_table">
            <div class="table_top">
                <span class="table_top_left">业绩报告</span>
            </div>
            <div  class="table1_center">
                <div  class="table1_center_body">
                    <div class="table1_center_body_left">
                        <div  class="body_title">招商</div>
                        <div class="body_chart">
                            <div  id="business_gauge" style="height:200px;"><img src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                        </div>
                        <div class="body_percent" id="Invpercent">无</div>
                        <div class="body_foot">
                            <ul>
                                <li>
                                    招商目标：<span id="Invtarget" style="display:inline-block;width:100px;">无</span>
                                </li>
                                <li style="margin-left:0px">
                                    实际招商：<span id="Actinvestment">无</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table1_center_body_right">
                        <div class="body_title">回款</div>
                            <div id="business_chart" style="height:220px;width:400px"><img style="margin-top:10px" src='/wisdom/Public/Home/Default/images/nonedata2.png'/></div>
                        <div class="body_percent"  style="margin-top:10px" id="paypect">无</div>
                        <div class="body_foot">
                            <ul>
                                <li style="margin-left:75px">
                                    回款目标：<span  id="collecttarget" style="display:inline-block;width:100px;">无</sapn>
                                </li>
                                <li style="margin-left:0px">
                                    实际回款：<span  id="actualpayment">无</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="index_right_table">
            <div class="table_top">
               <div class="table_top_left">招商漏斗</div>
            </div>
            <div  class="table1_center">
                <div class="table1_center_body">
                    <!--招商漏斗图显示-->
                    <div class="table2_center_body_left">
                        <div id="business_funel"   style="margin-right:50px"><img style="margin-top:-10px" src='/wisdom/Public/Home/Default/images/nonedata.png'/></div>

                    </div>
                    <div class="table2_center_body_right">
                        <ul>
                            <li>
                                <div class="table2_right_top">授权经销商数</div>
                                <div class="table2_right_foot"  id="authdealnum">无<div>
                            </li>
                            <li>
                                <div class="table2_right_top">签订合同经销商数</div>
                                <div class="table2_right_foot" id="contsignednum">无<div>
                            </li>
                            <li>
                                <div class="table2_right_top">预计回款</div>
                                <div class="table2_right_foot"  id="expectedmoney">无<div>
                            </li>
                            <li>
                                <div class="table2_right_top">实际回款</div>
                                <div class="table2_right_foot"  id="actualtotalpay">无<div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div  class="index_right_table">
            <div class="table_top">
                <div class="table_top_left">经销商分布</div>
            </div>
            <div  class="table3_center">
                <div class="table3_center_body">
                    <!--地图表显示-->
                    <div class="table3_center_body_left" >
                        <div id="map"  style='width:560px;height:470px'><img style="margin-top:70px" src='/wisdom/Public/Home/Default/images/nonedata.png'/></div>
                    </div>
                    <div class="table3_center_body_right"  id="Invquitrank">

                    </div>
        </div>
            </div>
        </div>
    </div>
    </div>
        <!--漏斗插件-->
        <script type="text/javascript" src="/wisdom/Public/static/fusion/js/fusioncharts.js"></script>  <!--公共图表插件-->
        <script type="text/javascript" src="/wisdom/Public/static/fusion/js/themes/fusioncharts.theme.fint.js"></script>
        <script src="/wisdom/Public/static/echarts/build/dist/echarts-all.js"></script>
        <script type="text/javascript" src="/wisdom/Public/Home/Default/js/business_chart.js"></script>
        <script>
//            Cookie.eraseCookie("bigMenuIndex");
//            Cookie.eraseCookie("smallMenuIndex");
//            Cookie.createCookie("bigMenuIndex",0);
//            Cookie.createCookie("smallMenuIndex",0);
//            var companyid=Cookie.readCookie("LYX_companyId");
            var companyid = <?php echo $companyId; ?>;

            $.post(APP+"/Api/Web/gettasktitle","tasktypeid=3&companyid="+companyid,function(rel){
//                console.log(rel);
                $("#taskname").empty();
                var namelist="";
                var length=rel.list.length;
//                console.log(length);
                if(length!=0){
                   $.each(rel.list,function(i,v){
                    namelist += "<option  id='task_"+v.f_tid+"' rel="+v.f_title+"|"+v.f_mtbrand+"|"+v.f_mtgoods+"|"+v.f_begindate+"|"+v.f_enddate+" value="+v.f_tid+">"+v.f_title+"</option>";
                });
                   $("#taskname").append(namelist);
                   loadPay(rel['list'][0]['f_tid']);
                   $("#tasktitle").html(rel['list'][0]['f_title']);
                   $("#taskping").html(rel['list'][0]['f_mtbrand']);
                   $("#taskchan").html(rel['list'][0]['f_mtgoods']);
                   $("#taskcreatetime").html(rel['list'][0]['f_begindate']);
                   $("#taskendtime").html(rel['list'][0]['f_enddate']);
                }else{
                   $("#taskname").append("<option  value=''>暂无任务</option>");
                }

            },"json");
            $("#taskname").change(function(){
                loadPay($(this).val());
                var arr=new Array();
                var rel=$("#taskname  #task_"+$(this).val()).attr("rel");
                arr=rel.split("|");
                $("#tasktitle").html(arr[0]);
                $("#taskping").html(arr[1]);
                $("#taskchan").html(arr[2]);
                $("#taskcreatetime").html(arr[3]);
                $("#taskendtime").html(arr[4]);
            });
        </script>
    </body>
</html>