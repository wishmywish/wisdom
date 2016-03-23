<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧推广::任务管理</title>
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
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Home/Default/css/home-new.css" />

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
        <div id="rev_menu_left" class="class_menu_left">
        <ul id="bigmenu">
            <li id="0" class="org_box org_box_select"><span class="org_bot_cor"></span>全部任务</li>
            <li id="1" class="org_box"><span ></span>推广赚</li>
            <li id="2" class="org_box"><span ></span>随手赚</li>
            <!--<li id="3" class="org_box"><span ></span>督查赚</li>-->
        </ul>
    </div>
    <div class="index_right_bus">
        <!--全部任务-->
        <div id="a0">
            <div style='height:20px;width:160px;text-align:left;float:left'> 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务
                <div class="task_button_left">
<!--                    <form  id="businessTask">
                        <span>筛选：排序 ： 发布时间  </span>&nbsp
                        <select style="width:80px;height:25px" form="businessTask">
                            <option  selected="selected" value="0">从高到低</option>
                            <option  value="1">从低到高</option>      
                        </select>
                    </form>-->
                </div>
            </div>
            <div class="task_button">                
                <?php if(in_array("d1",$access_array)){ echo '<div class="task_button_right"> <a href='.U("Promotion/taskAdd").'  style="color:#fff"> 新增 </a> </div>'; } ?> 
                	
                	 <!--<?php if(in_array("d1",$access_array)){ echo "<div class='task_button_right'> <a href=<?php echo U('');?> style='color:#fff'> 新增 </a> </div>"; } ?>--> 
<!--                <?php if(in_array("d1",$access_array)){ echo "<div class='task_button_right'><a href=<?php echo U('Promotion/taskAdd');?> style='color:#fff'>新增</a></div>"; } ?>    -->
<!--                <div class="task_button_right">
                    <a href="<?php echo U('Promotion/taskAdd');?>" style="color:#fff">新增</a>
                </div>-->
            </div>
            <div  class='promotion_task_list1'>
                <div id='promotionAllTask'></div>
                <div id="proallpage" class="pagebar" style="color:#696969;margin-top:20px;border-top: 1px dotted #eaeaea;"></div>
            </div>
        </div>
        
        <!--推广赚-->
        
         <div id="a1" style="display:none">
             <span style='height:20px;width:160px;text-align:left;float:left'> 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 推广赚</span></br>
            
            
             <div class="task_button_left" >
                    <!--<form  id="businessTask">
                        <span>筛选：排序 ： 发布时间  </span>&nbsp
                        <select style="width:80px;height:25px" form="businessTask">
                            <option  selected="selected" value="0">从高到低</option>
                            <option  value="1">从低到高</option>
                        </select>
                    </form>-->
                </div>
            <div  class='promotion_task_list1'>
                <div id='promotionAllTask2'></div>
                <div id="proallpage2"  class="pagebar" style="margin-top:20px;border-top: 1px dotted #eaeaea;"></div>
                
            </div>
        </div>
        
        
        
        
        <!--随手赚-->
        
         <div id="a2" style="display:none">
             <span style='height:20px;width:160px;text-align:left;float:left'> 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 随手赚</span></br>
            
            
             <div class="task_button_left" >
                    <!--<form  id="businessTask">
                        <span>筛选：排序 ： 发布时间  </span>&nbsp
                        <select style="width:80px;height:25px" form="businessTask">
                            <option  selected="selected" value="0">从高到低</option>
                            <option  value="1">从低到高</option>   
                        </select>
                    </form>-->
                </div>
            <div  class='promotion_task_list1'>
                <div id='promotionAllTask3'></div>
                <div id="proallpage3" class="pagebar" style="margin-top:20px;border-top: 1px dotted #eaeaea;">
                    
                </div>
            </div>
        </div>

        <!--督核赚-->
        <div id="a3" style="display:none">
            <span style='height:20px;width:160px;text-align:left;float:left'> 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 督查赚</span></br>
            <div class="task_button_left" >
            </div>
            <div  class='promotion_task_list1'>
                <div id='promotionAllTask7'></div>
                <div id="proallpage7" class="pagebar" style="margin-top:20px;border-top: 1px dotted #eaeaea;">

                </div>
            </div>
        </div>
        
        
    </div>
<input type="hidden"  id="state"  value="<?php echo ($state); ?>"/>
<input type="hidden"  id="ifsuper" value="<?php if(in_array('e1',$access_array)){ echo 1; }else{ echo 0; } ?>"/>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/show_addmes_pro.js"></script>
<script>           
    //模块间的跳转           
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
//                console.log(i);
                $('#a'+i).show(); 
                //获取数据
                promotionTask(i);
            }
        }
    });
    

  //empty_list
   var empty_list="<ul><li><div style=\'margin:20px;height:120px;line-height:26px;text-align:center;\'><div  style='padding-top:50px;color:#f47469'>暂无数据，请创建任务!!</div></div></li></ul>"
   var loadi="";
//   var companyId=Cookie.readCookie('LYX_companyId');
    var companyId = <?php echo $companyId; ?>;
//    console.log(companyId);

 function  promotionTask(num){
      switch(num){
          case 0: promotionList();break;
          case 1: pushTaskList();break;
          case 2: widelyList();break;
          case 3: auditList();break;
      }
 }
 promotionList();
 //全部任务
 function promotionList(){
     prolist(APP+"/Api/Web/getproList","post","tasktypeid=0&companyid="+companyId,"json","promotionAllTask","proallpage",0);  
      $(function(){
            $(document).on('click','#proallpage span a',function(){  
                 var rel = $(this).attr("rel");
               //  alert(rel);
              prolist(APP+"/Api/Web/getproList","post","tasktypeid=0&companyid="+companyId+"&page="+rel,"json","promotionAllTask","proallpage",0);
          });
        });
 }
 
 //推广赚
 function  pushTaskList(){
     prolist(APP+"/Api/Web/getproList","post","tasktypeid=1&companyid="+companyId,"json","promotionAllTask2","proallpage2",1);
     $(function(){
            $(document).on('click','#proallpage2 span a',function(){
                 
                 var rel = $(this).attr("rel"); 
               //  alert(rel);
              prolist(APP+"/Api/Web/getproList","post","tasktypeid=1&companyid="+companyId+"&page="+rel,"json","promotionAllTask2","proallpage2",1);
          });
        });
  }
  
    
//随手赚
function widelyList(){
    prolist(APP+"/Api/Web/getproList","post","tasktypeid=2&companyid="+companyId,"json","promotionAllTask3","proallpage3",2);
     $(function(){
            $(document).on('click','#proallpage3 span a',function(){
                 
                 var rel = $(this).attr("rel"); 
               //  alert(rel);
              prolist(APP+"/Api/Web/getproList","post","tasktypeid=2&companyid="+companyId+"&page="+rel,"json","promotionAllTask3","proallpage3",2);
          });
        });
 }

//   督核赚
function auditList(){
    prolist(APP+"/Api/Web/getproList","post","tasktypeid=7&companyid="+companyId,"json","promotionAllTask7","proallpage7",7);
    $(function(){
        $(document).on('click','#proallpage7 span a',function(){

            var rel = $(this).attr("rel");
            prolist(APP+"/Api/Web/getproList","post","tasktypeid=7&companyid="+companyId+"&page="+rel,"json","promotionAllTask7","proallpage7",7);
        });
    });
}
 function prolist(url1,type1,data1,dataType1,tasklistid,pageid,id){
     $.ajax({
          type:type1,
          url:url1,
          data:data1,
          dataType:dataType1,
          beforeSend:function(){
            loadi=layer.load(0);   
          },
          success:function(reVal){
             //console.log("===="+reVal.list);
             //总记录数
            total = reVal.total; //总记录数
            pageSize = reVal.pageSize; //每页显示条数
            page = parseInt(reVal.page); //当前页
            totalPage = parseInt(reVal.totalPage); //总页数
            
             //console.log("总记录数"+total+","+pageSize+","+page+","+totalPage);
             //获取展现推广赚任务列表
            //if(id==1){
                promotionAllList(reVal.list,total,tasklistid,pageid,id); 
            //}
                  
         
          },
           complete:function(){
               layer.close(loadi);
               getPageBar1(pageid);  
               
               
          }
      }); 
 };

 
 
  function  promotionAllList(val,total1,tasklistid,pageid,id){
//      console.log(id+"--");
        $("#"+tasklistid).empty();
          if(total1>0){
            var list="";
            var reson="";
            $.each(val,function(i,v){            	
//          	console.log(v);
                 //对判断任务状态
                 var current_status="";
                 var reson="";
                if(v.f_status=="1"){
                     current_status="任务结束";
                 }else if(v.f_status=="2"){
                     current_status="待客服审核";  
                 }else if(v.f_status=="3"){
                     current_status="已发布";  
                 }else if(v.f_status=="4"){
                     current_status="已过期";
                 }else if(v.f_status=="5"){
                     current_status="已驳回";
                 }else if(v.f_status=="6"){
                     current_status="待提交";
                 }else if(v.f_status=="7"){
                     current_status="待财务审核";
                 }else if(v.f_status=="8"){
                     current_status="客服审核通过";
                 }else if(v.f_status=="9"){
                     current_status="财务审核通过";
                 }else if(v.status="10"){
                 	 current_status="审核未通过";
                 }else if(v.status="11") {
                    current_status = "已下架";
                 }
                var f_taskid=v.f_tid;
                reson="<span style='margin-left:50px;cursor:pointer;'><u onclick='showreject("+f_taskid+")'>反馈信息查看</u></span>";
                  //创建任务时间
                 var createDate1=createDate(v.f_creatdate);
                 var tasktypeid=v.f_tasktypeid;
              //   console.log(tasktypeid+'====================');N
                  list+='<ul id=\'pro_task_list_'+(i+1)+'\'><li><div style=\'margin:20px;height:120px;line-height:24px\'> 任务编号&nbsp :'+v.f_surveno+' <span  style=\'float:right\'>发布时间&nbsp :'+createDate1+'</span></br>'
                       +'任务标题&nbsp : '+v.f_title+'</br>'
                       +'任务总数&nbsp ：<p class=\'tasklistp\'>'+v.f_totalcopies+'</p><span style=\'margin-left:20px\'>单次奖励金币&nbsp<p class=\'tasklistp\'> ：'+v.f_eachcoin+'(1元=10金币)</p></span></br>'
                       +'平台单次服务佣金&nbsp :<p class=\'tasklistp\' style=\'width:180px;\'>'+v.f_eachcoin_plat+'</p><span  style=\'color:#12A1C9\'>总佣金&nbsp :'+v.f_plattotal+'\元</span></br>'
                       +'任务截止时间&nbsp ：<p class=\'tasklistp\' style=\'width:195px;\' >'+v.f_enddate+'</p><span  style=\'color:#F08304\'>任务状态&nbsp :'+current_status+'</span>'
                       +reson+"<span  style=\'margin-left:50px;cursor:pointer;\'><u onclick='preview("+f_taskid+")'>任务预览</u></span>";
                 if (v.f_status==1 ||v.f_status==5||v.f_status==6||v.f_status==11) {
                     if(id==0){
                         list+='<?php if( !in_array("d3",$access_array) ){ echo "<!--"; } ?><span style=\'float:right;\'><a style=\'color:#00a73d;margin-left:30px\' href=\'#\' onclick=\'pro_task_modi('+v.f_tid+','+(i+1)+','+tasktypeid+')\'>编辑</a><?php if( !in_array("d3",$access_array) ){ echo "-->"; } if( !in_array("d2",$access_array) ){ echo "<!--"; } ?><a style=\'color:red;margin-left:35px\' href=\'#\' onclick=\'business_task_del('+v.f_tid+','+(i+1)+',"pro_task_list_" ,"promotionAllTask","proallpage",0)\'>删除</a><?php if( !in_array("d2",$access_array) ){ echo "-->"; } ?></span>'
                           +'</div></li></ul>'; 
                     }else if(id==1){
                          list+='<?php if( !in_array("d3",$access_array) ){ echo "<!--"; } ?><span style=\'float:right;\'><a style=\'color:#00a73d;margin-left:30px\' href=\'#\' onclick=\'pro_task_modi('+v.f_tid+','+(i+1)+','+tasktypeid+')\'>编辑</a><?php if( !in_array("d3",$access_array) ){ echo "-->"; } if( !in_array("d2",$access_array) ){ echo "<!--"; } ?><a style=\'color:red;margin-left:35px\' href=\'#\' onclick=\'business_task_del('+v.f_tid+','+(i+1)+',"pro_task_list_" ,"promotionAllTask2","proallpage2",1)\'>删除</a><?php if( !in_array("d2",$access_array) ){ echo "-->"; } ?></span>'
                           +'</div></li></ul>'; 
                     }else if(id==2){
                          list+='<?php if( !in_array("d3",$access_array) ){ echo "<!--"; } ?><span style=\'float:right;\'><a style=\'color:#00a73d;margin-left:30px\' href=\'#\' onclick=\'pro_task_modi('+v.f_tid+','+(i+1)+','+tasktypeid+')\'>编辑</a><?php if( !in_array("d3",$access_array) ){ echo "-->"; } if( !in_array("d2",$access_array) ){ echo "<!--"; } ?><a style=\'color:red;margin-left:35px\' href=\'#\' onclick=\'business_task_del('+v.f_tid+','+(i+1)+',"pro_task_list_" ,"promotionAllTask3","proallpage3",2)\'>删除</a><?php if( !in_array("d2",$access_array) ){ echo "-->"; } ?></span>'
                           +'</div></li></ul>'; 
                     }else{
                         list+='<?php if( !in_array("d3",$access_array) ){ echo "<!--"; } ?><span style=\'float:right;\'><a style=\'color:#00a73d;margin-left:30px\' href=\'#\' onclick=\'pro_task_modi('+v.f_tid+','+(i+1)+','+tasktypeid+')\'>编辑</a><?php if( !in_array("d3",$access_array) ){ echo "-->"; } if( !in_array("d2",$access_array) ){ echo "<!--"; } ?><a style=\'color:red;margin-left:35px\' href=\'#\' onclick=\'business_task_del('+v.f_tid+','+(i+1)+',"pro_task_list_" ,"promotionAllTask3","proallpage3",7)\'>删除</a><?php if( !in_array("d2",$access_array) ){ echo "-->"; } ?></span>'
                         +'</div></li></ul>';
                     }
                 }else{
                          list+='</div></li></ul>'; 
                 };              
            });
             $('#'+tasklistid).append(list);
          }else{
               $('#'+pageid).empty();
               $("#"+tasklistid).append(empty_list);
          }
  }
  
 
 
 
 
</script>
    </body>
</html>