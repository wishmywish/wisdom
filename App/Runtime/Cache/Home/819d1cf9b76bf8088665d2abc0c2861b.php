<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧推广::跟踪审核</title>
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

                <div class="logo"><img style="height: 30px;margin-top: 8px;" src="/wisdom/Public/upfile/logo/logo.png" ></div>

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
    <div id="rev_menu_left" class="class_menu_left">
        <ul id="bigmenu">
            <li id="0" class="org_box org_box_select"><span class="org_bot_cor"></span>推广赚</li>
            <li id="1" class="org_box"><span ></span>随手赚</li>
        </ul>
    </div>
    <div class="rev_main_right">
        <div id="a0">
            <div class="top1">
                 <span>首页</span> > <span>跟踪审核</span> > <span>推广赚</span>
            </div>
            <div class="searchDiv">
                 <ul>
                        <li  style="width:400px;">
                           <span>任务标题</span>
                            <select class="border_mer" style="width:300px;margin-left:7px;border:1px #EAEAEA solid" id="track_list_title_make" onchange="trackmake_choosetype(this.value)">
                            </select> 
                        </li>
                        
                </ul>
                <ul id='trackmake_total' style='color:#f38401;font-weight:bold;float:right;margin-right:18px'></ul>
            </div>
            <div class="table_mer">
                <ul>
                    <li class="title_mer " style="width:8%;">序号</li>
                    <li class="title_mer " style="width:11%;">业务员</li>
                    <li class="title_mer " style="width:12%;">新浪微博</li>
                    <li class="title_mer " style="width:12%;">腾讯微博</li>
                    <li class="title_mer " style="width:12%;">QQ空间</li>
                    <li class="title_mer " style="width:10%;">微信好友</li>
                    <li class="title_mer " style="width:13%;">微信朋友圈</li> 
                    <li class="title_mer " style="width:12%;">微信收藏</li>
                    <li class="title_mer" style="width:10%;">QQ</li>
                </ul>
            </div>
            <div style="min-height: 500px;width:100%">
             <div id="trackAudit_make" style="border-bottom:1px #eaeaea dotted;padding-bottom:12px"></div>
             <div id="trackAudit_makepagebar" class="pagebar">
             
             </div>  
            </div>
        </div>
        <div id="a1" style="display: none;">
            <div class="top1">
                 <span>首页</span> > <span>跟踪审核</span> > <span>随手赚</span>
            </div>

            <!--onchange="trackeran_choosetype(this.value)"-->
            <div class="searchDiv">
                    <ul style="width:100%">
                        <li  style="width:400px;float:left">
                           <span>任务标题</span>
                            <select class="border_mer" style="width:300px;margin-left:7px;border:1px #EAEAEA solid" id="track_list_title_earn"  onchange="trackeran_choosetype(this.value)">
                            </select>
                        </li>
                        <div style="margin-right:10px;">
                        <li  style="width:60px;float:right;padding-right:12px">
                            <!--<span class="btn2" id="readyThrough">审核通过</span>-->                            
                            <?php if(in_array("c1",$access_array)){ echo '<span class="btn2" style="margin-right:0px" id="readyThrough">审核通过</span> '; } ?>
                        </li>
                        <li  style="width:100px;float: right;padding-right:12px;margin-right:10px;">
                            <!--<span class="btn2"  id="hasAudit" >已审核</span>-->
                            <?php if(in_array("c2",$access_array)){ echo '<span class="btn2" style="margin-right:0px" id="hasAudit" >已审核</span> '; } ?>
                        </li>
                        <li  style="width:100px;float: right;margin-right: -18px;">
                            <!--<span class="btn2" id="pendverf" >待审核</span>-->
                            <?php if(in_array("c3",$access_array)){ echo '<span class="btn2" style="margin-right:0px" id="pendverf" >待审核</span>'; } ?>
                        </li>
                            <li  style="width:100px;float: right;margin-right: -18px;">
                                <!--<span class="btn2" id="pendverf" >待审核</span>-->
                                <?php if(in_array("c4",$access_array)){ echo '<span class="btn2" style="margin-right:0px" id="back" >驳回</span>'; } ?>
                            </li>
                        </div>
                    </ul>
                <div  style="float:right;margin-bottom:10px;margin-right:30px">
                    <span>总金币数：<span  style="color:#fe6700;font-size:15px;padding-right:10px;"  id="totalcoin"></span></span>
                    <span>已发金币数：<span  style="color: #f47469;font-size:15px"  id="totalgivcoin"></span></span>
                </div>

<!--                onclick="readyThrough()-->
            </div>
            <div class="table_mer">
                    <ul>
                    <li class="title_mer " style="width:5%"><input style="vertical-align:middle" type="checkbox"  name="all_trackAudit_earn"  onclick="all_checkLine(this,'trackAudit_earn_grid')"/></li>
                    <li class="title_mer " style="width:10%;">序号</li>
                    <li class="title_mer " style="width:15%;">任务类型</li>
                    <li class="title_mer"  style="width:20%">业务员</li>
                    <li class="title_mer"  style="width:15%">提交时间</li>
                    <li class="title_mer"  style="width:15%">任务状态</li>
                    <li class="title_mer " style="width:20%;">任务详情查看</li>
                    </ul>
                 
            </div>
           
            <div id="trackAudit_earn" style="border-bottom:1px #eaeaea dotted;padding-bottom:12px">
            
            </div>
              
            <div id="trackAudit_earnpagebar" class="pagebar" >
             
            </div>
        </div>
      
        </div>
    </div>
</div>
</div>
<script>

//已审核
    $("#hasAudit").on("click",function(){
        var id=$("#track_list_title_earn").val();
//        console.log(id);
        trackeran_choosetype(id,3);
    });
    //待审核
    $("#pendverf").on("click",function(){
        var id2=$("#track_list_title_earn").val();
//        console.log(id2);
        trackeran_choosetype(id2,1);
    });
    $('#bigmenu li').click(function(){
        var lilen = $('#bigmenu li').length;
        $('#bigmenu li').removeClass('org_box org_box_select');
        $('#bigmenu li span').removeClass('org_bot_cor');
        $('#bigmenu li').attr('class','org_box'); 
        $(this).attr('class','org_box  org_box_select');
        $(this).children('span').attr('class','org_bot_cor');
        for(var i=0;i<lilen;i++){
            $('#a'+i).hide();
            if($(this).index()===i){
                $('#a'+i).show();
    
            }
        }
    });
               
 
    //跟踪审核 随手赚
    var cid=Cookie.readCookie("LYX_companyId");
    
    gettrackMaketitle(cid,1,"track_list_title_make");
    //根据任务标题选择
     $('input[name=all_trackAudit_earn]').removeAttr('checked');
     $.post(APP+"/Api/Web/gettasktitle","companyid="+cid+"&tasktypeid=2",function(val){
         var list="";
         $("#track_list_title_earn").empty();
         if(val.list!=0){
//           var list="<option  value='0' selected >选择任务标题</option>";
          
            $.each(val.list,function(i,v){
             list += "<option value='"+v.f_tid+"'  data-tasktype='"+v.f_typeid+"'>"+v.f_title+"("+v.f_typename+")</option>";
            });
           $("#track_list_title_earn").append(list);

             trackeran_choosetype($("#track_list_title_earn >option:eq(0)").val());

         }
         if(val.list==0){
             
             var list="<option  value='0' selected >暂无可选任务</option>";
             $("#track_list_title_earn").append(list);
         }
     },"json");           
                     
  
   function trackeran_choosetype(titleID,utask_status){
      var utask_status=arguments[1]?arguments[1]:1;
      if(titleID==0){
          layer.msg("请选择需要查询的任务标题",{icon:8});
          $("#trackAudit_earn").empty();
          $("#trackAudit_earnpagebar").empty();
          Cookie.eraseCookie("trackearnID");
          Cookie.createCookie("trackearnID",0);
          return false;
      }
      Cookie.eraseCookie("trackearnID");
      Cookie.createCookie("trackearnID",titleID);
       Cookie.createCookie("utask_status",utask_status);
      $('input[name=all_trackAudit_earn]').removeAttr('checked');
      listData(APP+"/Api/Web/get_track_earn","companyid="+cid+"&taskid="+titleID+"&utask_status="+utask_status,"post","json",2);

 }

$(function(){
    $(document).on('click','#trackAudit_earnpagebar span a',function(){
        var tid1=Cookie.readCookie("trackearnID");
        var utask_status=Cookie.readCookie("utask_status");
        //alert(tid1+"=2");
        var rel = $(this).attr("rel");
        listData(APP+"/Api/Web/get_track_earn","companyid="+cid+"&taskid="+tid1+"&page="+rel+"&utask_status="+utask_status,"get","json",2);
    });
});

function   check_trackearn_surevylist(tid,submituserid){
              $.post(APP+"/Api/Web/trackearn_answer","tid="+tid+"&submituserid="+submituserid,function(val){
                  var content="";
                  var arr=new Array();
                  var arr1=new Array();
                  content+="<br/><div style='margin:20px 20px 20px 20px;min-height:500px;'>";
                  if(val.tasktypeid==5){
                      content+="<div style='width:100%'>经销商姓名:"+val.dealername+"</div>";
                      content+="<div style='width:100%'>经销商手机:"+val.dealerphone+"</div>";
                      content+="<div style='width:100%'>经销商公司名:"+val.dealercompanyname+"</div>";
                      content+="<div style='width:100%'>经销商行业:"+val.dealerindustry+"</div>";
                      content+="<div style='width:100%'>经销商地址:"+val.dealeraddress+"</div>";
                      content+="<div style='width:100%'>经销商电话:"+val.dealertel+"</div>";
                      content+="<div style='width:100%'>经销商传真:"+val.dealerfax+"</div>";
                  }else{
                      var tasktype=val.tasktypeid;
                      var count=val.count;
                      $.each(val.list,function(i,n){
                          var answer=n.f_answer;
                          var option=n.f_options;
                          content+="</br><div style='width:100%;float:left;margin-bottom:20px' class='quest_"+i+"' ><span>问 :</span><span>"+n.f_problemtatile+"</span>";
                          if(n.f_type=="1"){ //拆分选项  单选
                              content+="<span>(单选)</span></br><span>答：</span>";
                              arr=option.split('|');
                              for(var i=0;i<arr.length;i++){
                                  if((answer)==i){
                                      content+="<input type='checkbox' checked  disabled/><span style='color:red'>"+arr[i]+"</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                  }else{
                                      content+="<input type='checkbox' disabled/>"+arr[i]+"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                  }

                              }
                              if(tasktype==6){
                                  content+="<p>用户答题结果:"+ n.isfalse+"</p>";
                                  content+="<p>此题正确答案:</p>";
                                  for(var i=0;i<arr.length;i++){
                                      if((n.f_trueanswer)==i){
                                          content+="<input type='checkbox' checked  disabled  style='margin-left:25px;'/><span style='color:green'>"+arr[i]+"</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                      }else{
                                          content+="<input type='checkbox' disabled  style='margin-left:25px;'/>"+arr[i]+"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                      }

                                  }
                              }
                              content+="</br></div>";

                          }else if(n.f_type=="2"){  //多选
                              //多选
                              content+="<span>(多选)</span></br><span>答：</span>";
                              arr_option=option.split('|');  //选项
                              arr_answer=answer.split(','); //答案

                              for(var i=0;i<arr_option.length;i++){ //选项
                                  html = "<input type='checkbox' disabled/>"+arr_option[i]+"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                  for(var j=0;j<arr_answer.length;j++){ //答案
                                      if((arr_answer[j]) == i){  //匹配时输出
                                          html = "<input type='checkbox' checked  disabled/><span style='color:red'>"+arr_option[i]+"</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                      }
                                  }
                                  content+= html;
                              }
                              if(tasktype==6){
                                  content+="<p>用户答题结果:"+ n.isfalse+"</p>";
                                  content+="<p>此题正确答案:</p>";
                                  true_answer=(n.f_trueanswer).split(",");
                                  for(var i=0;i<arr_option.length;i++){ //选项
                                      html1 = "<input type='checkbox' disabled style='margin-left:25px;'/>"+arr_option[i]+"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                      for(var j=0;j<true_answer.length;j++){ //答案
                                          if((true_answer[j]) == i){  //匹配时输出
                                              html1 = "<input type='checkbox' checked  disabled  style='margin-left:25px;'/><span style='color:green'>"+arr_option[i]+"</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                          }
                                      }
                                      content+= html1;
                                  }
                              }

                              content+="</br></div>";
                          }else if(n.f_type=="3"){ //文本
                              content+="<span>(文本)</span></br><span>答："+answer+"</span>";
                              content+="</br></div>";
                          }else if(n.f_type=="4"){
                              content+="<span>(图片)</span></br><span >答：</span>";
                              content+="<div class='img'  style='height:100px;'><ul>";
                              $.each(answer,function(i,v){
                                  content+="<li style='float:left;margin:0px 10px'><img  style='height:100px;width:100px;'  src='"+v.path+"'/></li>";
                              });
                              content+="</ul></div>";
                              content+="</br></div>";
                          }
//                      else if(n.f_type=="4"));
////                             content+="</ul></div>";
//                      }
                      });
                      if(tasktype==6){
                          content+="<p>一共答题数为"+count+"个,该用户答对<span style='color:red'>"+val.trueCount+"</span>数,答错<span style='color:red'>"+val.falseCount+"</span>数</p>";
                      }
                  }

                   content+="</div>";
                   layer.open({
                                type:1,
                                title:'报告详情',
                                skin:'layui-layer-rim',
                                area:['600px','500px'],
                                content:content

                     });
              },'json');
          }    

    //随手赚驳回
    $("#back").on("click",function(){
        if($("#track_list_title_earn").find("option:selected").attr("data-tasktype")==6){
            layer.msg("答题类不需要进行驳回操作");
            return false;
        }


        var checked=$('input[name="trackAudit_earn_grid"]:checked');
//                console.log(checked);
        var tid=Cookie.readCookie("trackearnID");
        //alert(tid);
        var checklist=[];
        // var checked1=[];
        checked.each(function(){
            //alert($(this).val());
            checklist.push($(this).val());
        });
        if(tid==0){
            layer.msg("请选择任务或暂时没任务",{icon:8});
            //return false;
        }else if(checklist=="" || checklist==null){
            layer.msg("请选择驳回对象",{icon:8});
        }else{
            layer.confirm('确定驳回?',{
                btn:['确定','取消'],
                shade:false
            },function(){
                layer.closeAll();
                index = layer.open({
                    title: '驳回理由',
                    type: 2,
                    area: ['600px', '400px'],
                    content: APP + '/Home/Business/reject?checklist='+checklist+'&tid='+tid
                });
//


            },function(){
                layer.msg('请在核实后再驳回',{shift:6});
                $('input[name="all_trackAudit_earn"]:checked').removeAttr('checked');
                $('input[name="trackAudit_earn_grid"]:checked').removeAttr('checked');
            });

        }




    });







            //随手审核通过
    $('#readyThrough').on('click',function(){
//                console.log("审核通过");return;
                if($("#track_list_title_earn").find("option:selected").attr("data-tasktype")==6){
                    layer.msg("答题类不需要审核通过");
                    return false;
                }
                var checked=$('input[name="trackAudit_earn_grid"]:checked');
//                console.log(checked);
                var tid=Cookie.readCookie("trackearnID");
                //alert(tid);
                var checklist=[];
               // var checked1=[];
                checked.each(function(){
                    //alert($(this).val());
                    checklist.push($(this).val());
                });
                if(tid==0){
                    layer.msg("请选择任务或暂时没任务",{icon:8});
                    //return false;
                }else if(checklist=="" || checklist==null){
                    layer.msg("请选择审核对象",{icon:8});
                }else{
                    layer.confirm('确定审核?',{
                        btn:['确定','取消'],
                        shade:false
                    },function(){
                        layer.closeAll();
                        $.post(APP+'/Api/Web/trackearn_shenhe','checklist='+checklist+'&tid='+tid,function(val){
                            if(val.error_code=='true'){
                                //alert("==============");
                                $('input[name="all_trackAudit_earn"]:checked').removeAttr('checked');
                                $('input[name="trackAudit_earn_grid"]:checked').removeAttr('checked');
                                rel=$("#trackAudit_earnpagebar span a").attr("rel");
                                layer.msg('审核成功,点击已审核查看',{icon:9});
                                 for(var $i=0;$i<checklist.length;$i++){
                                    $("#trackAudit_earn_grid_"+checklist[$i]).parent().siblings().parent().remove();
                                }
                                if($("#trackAudit_earn ul").length==0){
                                     trackeran_choosetype(tid,1);
                            }
                            if(val.error_code=='false'){
                                layer.msg("已审核",{icon:8});
                                $('input[name="all_trackAudit_earn"]:checked').removeAttr('checked');
                                $('input[name="trackAudit_earn_grid"]:checked').removeAttr('checked');
                            }
                        }
                    },"json");
                    },function(){
                       layer.msg('请在核实后再审核',{shift:6});
                       $('input[name="all_trackAudit_earn"]:checked').removeAttr('checked');
                       $('input[name="trackAudit_earn_grid"]:checked').removeAttr('checked');
                    });     
                    
                }    
            });



$(function(){
    $(document).on('click','#trackAudit_makepagebar span a',function(){
        var tid2=Cookie.readCookie("trackmakeID");
        //alert(tid1+"=2");
        var rel = $(this).attr("rel");
        // alert(rel);
        listData(APP+"/Api/Web/get_track_make","taskid="+tid2+"&page="+rel,"get","json",1);
    });
});



 //推广赚
  function   trackmake_choosetype(titleID){
       if(titleID==0){
          layer.msg("请选择需要查询的任务标题",{icon:8});
          $("#trackAudit_make").empty();
          $("#trackAudit_makepagebar").empty();
          $("#trackmake_total").empty(); 
          return false;
      }
      Cookie.eraseCookie("trackmakeID");
      Cookie.createCookie("trackmakeID",titleID);
       //$('input[name=all_trackAudit_earn]').removeAttr('checked');
       listData(APP+"/Api/Web/get_track_make","taskid="+titleID+"","post","json",1);

        var tid3=Cookie.readCookie("trackmakeID");
        $("#trackmake_total").empty();
        $.post(APP+"/Api/Web/get_track_makeTotal","taskid="+tid3,function(rel){
          var wechat=0; var  WechatFavorite=0;var WechatMoments=0; var QZone=0;
          var QQ=0;var SinaWeibo=0; var TencentWeibo=0; 
           var list2="";
//           console.log(rel+"===");
//           console.log(rel.listtotal.length+"&&&&");
           var n=rel.listtotal;
          for(var i in n){ 
             if(n[i]['f_platform']==="Wechat"){
                 wechat=n[i]['num'];
              }
              if(n[i]['f_platform']==="WechatFavorite"){
                  WechatFavorite=n[i]['num'];
               }
              if(n[i]['f_platform']==="WechatMoments"){
                WechatMoments=n[i]['num'];
             }
              if(n[i]['f_platform']==="QZone"){
                QZone=n[i]['num'];
            }
             if(n[i]['f_platform']==="QQ"){
                 QQ=n[i]['num'];
            }
             if(n[i]['f_platform']==="SinaWeibo"){
                 SinaWeibo=n[i]['num'];
            }
             if(n[i]['f_platform']==="TencentWeibo"){
                 TencentWeibo=n[i]['num'];
             }
                 
        }

           list2+="<li><img id='SinaWeibo' src='/wisdom/Public/Home/Default/images/SinaWeibo1.png' style='margin-right:5px;'/> <span >"+SinaWeibo+"</span></li>";
           list2+="<li><img id='TencentWeibo' src='/wisdom/Public/Home/Default/images/TencentWeibo1.png' style='margin-right:5px'/> <span >"+TencentWeibo+"</span></li>";
           list2+="<li><img id='QZone' src='/wisdom/Public/Home/Default/images/QZone1.png' style='margin-right:5px;'/> <span>"+QZone+"</span></li>";
           list2+="<li><img id='wechat' src='/wisdom/Public/Home/Default/images/wechat1.png' style='margin-right:5px;'/> <span>"+wechat+"</span ></li>";
           list2+="<li><img id='WechatFavorite' src='/wisdom/Public/Home/Default/images/WechatFavorite1.png' style='margin-right:5px;'/><span>"+WechatMoments+"</span></li>";
            list2+="<li><img id='WechatMoments'  src='/wisdom/Public/Home/Default/images/WechatMoments1.png' style='margin-right:5px;'/><span >"+WechatFavorite+"</span></li>";
            list2+="<li><img id='QQ' src='/wisdom/Public/Home/Default/images/QQ_2.png' style='margin-right:5px;'/><span >"+QQ+"</span></li>";

         $("#trackmake_total").append(list2);
            if(SinaWeibo!=0){
                $("#SinaWeibo").attr("src","/wisdom/Public/Home/Default/images/SinaWeibo.png");
            }
            if(TencentWeibo!=0){
                $("#TencentWeibo").attr("src","/wisdom/Public/Home/Default/images/TencentWeibo.png");
            }
            if(QZone!=0){
                $("#QZone").attr("src","/wisdom/Public/Home/Default/images/QZone.png");
            }
            if(wechat!=0){
                $("#wechat").attr("src","/wisdom/Public/Home/Default/images/wechat.png");
            }
            if(WechatFavorite!=0){
                $("#WechatFavorite").attr("src","/wisdom/Public/Home/Default/images/WechatFavorite.png");
            }
            if(WechatMoments!=0){
                $("#WechatMoments").attr("src","/wisdom/Public/Home/Default/images/WechatMoments.png");
            }
            if(QQ!=0){
                $("#QQ").attr("src","/wisdom/Public/Home/Default/images/QQ_1.png");
            }
  },"json");
  }
</script>
</body>
</html>