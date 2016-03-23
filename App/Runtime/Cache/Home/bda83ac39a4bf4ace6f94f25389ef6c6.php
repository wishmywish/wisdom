<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="image/x-icon" href="/favicon.ico" rel="icon">
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <title>智慧招商::任务管理</title>
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
        <div class="index_left">
             <div class='org_box org_box_select'><span class='org_bot_cor'></span>全部任务</div>
        </div>
    <div class="index_right_bus">
        <div class="task_list1">
            <div style='height:20px;width:160px;text-align:left;float:left'> 首页&nbsp>&nbsp 任务管理&nbsp>&nbsp 全部任务
                <div class="task_button_left">
                    <!--<form  id="businessTask">
                        <span>筛选：排序 ： 发布时间  </span>&nbsp
                        <select style="width:80px;height:25px" form="businessTask">
                            <option  selected="selected" value="0">从高到低</option>
                            <option  value="1">从低到高</option>
                        </select>
                    </form>-->
                </div>
            </div>
            
            <div class="task_button">                
                    <!--<a href="<?php echo U('Business/taskAdd');?>" style="color:#fff">新增</a>-->
                     <?php if(in_array("b1",$access_array)){ echo '<div class="task_button_right"> <a href='.$addurl.'  style="color:#fff"> 新增 </a> </div>'; } ?>
             <!--       <?php if(in_array("b1",$access_array)){ echo "<div class='task_button_right'><a href=".U("Business/taskAdd")." style='color:#fff'>新增</a></div>"; } ?>    -->
            </div>
        </div>
        <div  class='task_list2'>
            <div id='task_time_sort_list'>

           </div>
        </div>
        <div id="pagebar" class="pagebar" style="margin-top:20px;border-top:1px dotted #EAEAEA">
             
        </div>
        </div>
    </div>
<input type="hidden"  id="state"  value="<?php echo ($state); ?>"/>
<input type="hidden"  id="ifsuper" value="<?php if(in_array('e1',$access_array)){ echo 1; }else{ echo 0; } ?>"/>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/show_addmes.js"></script>
<script>
      var loadi="";
//      var companyId=Cookie.readCookie("LYX_companyId");

        var companyId = <?php echo $companyId; ?>;
//      console.log(companyId+"公司id");
        var error_list="<ul><li><div style=\'margin:20px;height:160px;line-height:26px;text-align:center;\'><div  style='padding-top:50px;color:#f47469'>暂无数据，请创建任务!!</div></div></li></ul>";

      
      listData1(APP+"/Api/web/getTaskList","tasktypeid=3&companyid="+companyId,"post","json");

       $(function(){   //页面载入时加载内容

            $(document).on('click','#pagebar span a',function(){

                 var rel = $(this).attr("rel");

              listData1(APP+"/Api/web/getTaskList","tasktypeid=3&companyid="+companyId+"&page="+rel,"post","json");
          });
        });
        
   function   listData1(url,data,type,datatype){

         $.ajax({
          type:type,
          url:url,
          data:data,
          dataType:datatype,
          beforeSend:function(){
            loadi=layer.load(0);   
          },
          success:function(reval){
//             console.log("===="+reval.list);
             //总记录数
             total=reval.total;
             //每页显示的条数
             pageSize=reval.pageSize;
             //当前页
             page=reval.page;
             //总页数
             totalPage=reval.totalPage;
//             console.log("总记录数"+total+","+pageSize+","+page+","+totalPage);
             //获取展现招商任务列表
             showBusinesList(reval.list,total);
  
          },
          
           complete:function(){
               layer.close(loadi);    
          }
      }); 
      }
       function showBusinesList(val,total){
           //console.log(val);
           //清空已有的数据
          
            $('#task_time_sort_list').empty();
            if(total>0){
                 //加载数据
                 var list="";
                 var reson="";
                $.each(val,function(i,v){
                 //对判断任务状态
                 //console.log(v.f_status+"=====");
                  var current_status="";
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
                 }else if(v.status="11"){
                     current_status="已下架";
                 }
                    var f_taskid=v.f_tid;
                    reson="<span style='margin-left:50px;cursor:pointer;'><u onclick='showreject("+f_taskid+")'>反馈信息查看</u></span>";
                    var modi="";
                    var createDate1=createDate(v.f_creatdate);

                    if(v.f_status==1 ||v.f_status==5||v.f_status==6||v.f_status==11){
                        var textEdit = "<?php if( in_array('b3',$access_array) ){ echo '编辑'; }else{ echo ''; } ?>";  //权限判断
                        var textDel = "<?php if( in_array('b2',$access_array) ){ echo '删除'; }else{ echo ''; } ?>"; //权限判断
//                      var modi = '<span style=\'float:right;\'><a style=\'color:#00a73d;margin-left:30px\' href=\'#\' onclick=\'business_task_modi('+f_taskid+','+(i+1)+')\'>编辑</a><a style=\'color:red;margin-left:35px\' href=\'#\' onclick=\'business_task_del('+f_taskid+','+(i+1)+',"business_task_list_" ,"task_time_sort_list","pagebar",3)\'>删除</a></span>';
                      var modi = '<span style=\'float:right;\'><a style=\'color:#00a73d;margin-left:30px\' href=\'#\' onclick=\'business_task_modi('+f_taskid+','+(i+1)+')\'>'+textEdit+'</a><a style=\'color:red;margin-left:35px\' href=\'#\' onclick=\'business_task_del('+f_taskid+','+(i+1)+',"business_task_list_" ,"task_time_sort_list","pagebar",3)\'>'+textDel+'</a></span><span style=\'float:right;\'><a style=\'color:#00a73d;margin-left:30px\' href=\'#\' onclick=\'business_task_tijiao('+f_taskid+','+(i+1)+')\'>提交</a>';
                    }
                 //创建任务时间
                // console.log(v.f_creatdate);

               list+='<ul  id=\'business_task_list_'+(i+1)+'\'><li><div style=\'margin:20px;height:160px;line-height:26px\'>  任务编号&nbsp ： '+v.f_surveno+'<span  style=\'float:right\'>发布时间&nbsp ： '+createDate1+'</span></br>'
                       +'任务标题&nbsp ： <span> '+v.f_title+'</span></br>'
//                       +'任务品牌&nbsp ：<p style=\'display:inline-block;width:200px\'>'+v.f_mtbrand+'</p> <span>任务产品&nbsp ： '+v.f_mtgoods+'</span></br>'
                       +'任务首批发货款&nbsp ：<p style=\'display:inline-block;width:155px\'> '+v.f_unitfirstamount+'元</p><span>保证金&nbsp ： '+v.f_unitcashdeposit+'元</span><span  style=\'margin-left:50px;\'>加盟费&nbsp ： '+v.f_unitfranchisefee+'元</span><span  style=\'margin-left:50px;\'>其它&nbsp ： '+v.f_unitotheramount+'元</span><span  style=\'margin-left:50px;color:#12A1C9\'>总首批款&nbsp ： '+v.f_unittotalamount+'元</span></br>'
                       +'所在行业&nbsp ：<p style=\'display:inline-block;width:202px\'> '+v.f_tradename+'</p><span>任务区域详情&nbsp ：<a href=\'#\'  onclick=\'task_areaDetail('+f_taskid+','+(i+1)+')\'>点击查看</a></br>'  //  <span  style=\'margin-left:100px;\'>任务产品详情&nbsp ：<a href=\'#\'  onclick=\'task_productDetail('+f_taskid+','+(i+1)+')\'>点击查看</a>
                       +'任务截止时间&nbsp ：<p style=\'display:inline-block;width:179px\'> '+v.f_enddate+'</p><span  style=\'color:#F08304\'>任务状态&nbsp ： '+current_status+'</span>'+reson+"<span  style=\'margin-left:50px;cursor: pointer\'><u onclick='preview("+f_taskid+")'>任务预览</u></span>"+modi
                       +'</div></li></ul>';
           });
                $('#task_time_sort_list').append(list);
                //获取分页函数
                getPageBar1("pagebar");
            }else{
                $('#pagebar').empty();
                $('#task_time_sort_list').append(error_list);
            }
          
       }
      
       
       //查看招商区域详情
      function task_areaDetail(tid,i){
          loadi=layer.load(0);
          $.post("<?php echo U('Api/Api/inport');?>","command=getArea&taskid="+tid,function(val){
               layer.close(loadi);
               var list="";
                 list="<div class='taskAreadiv' id="+i+">";
                 list+="<ul style='color:#fff'><li style='background-color:#14bce1'>序号</li><li style='width:200px;background-color:#14bce1' >招商区域</li><li  style='background-color:#14bce1'>招商数量</li></ul>";
               $.each(val.list,function(i,n){
                 list+="<ul><li>"+(i+1)+"</li><li style='width:200px'>"+n.f_area+"</li><li>"+n.f_qty+"家</li></ul>";  
               });
                 list+="</div>"; 
               layer.open({
                type:1,
                title:'招商区域详情',
                skin:'layui-layer-rim',
                area: '500px',
                content:list,
               });
//                console.log(val);
          },"json");
      }
      
      //查看任务产品详情
      function task_productDetail(tid,i){
          loadi=layer.load(0);
          $.post("<?php echo U('Api/Api/inport');?>","command=getPro&taskid="+tid,function(val){
              layer.close(loadi);
               var list="";
                 list="<div class='taskAreadiv' id="+i+">";
                 list+="<ul style='color:#fff'><li style='background-color:#14bce1'>序号</li><li style='width:200px;background-color:#14bce1' >产品名称</li><li  style='background-color:#14bce1'>产品规格</li><li  style='background-color:#14bce1'>计量单位</li><li  style='background-color:#14bce1'>经销价</li><li  style='background-color:#14bce1'>分销价</li><li  style='background-color:#14bce1'>零售价</li></ul>";
               $.each(val.list,function(i,n){
                 list+="<ul><li>"+(i+1)+"</li><li style='width:200px'>"+n.f_goodsname+"</li><li>"+n.f_modle+"</li><li>"+n.f_unit+"</li><li>"+n.f_agencyprice+"元</li><li>"+n.f_sellingprice+"元</li><li>"+n.f_saleprice+"元</li></ul>";  
               });
                 list+="</div>"; 
               layer.open({
                type:1,
                title:'招商产品详情',
                skin:'layui-layer-rim',
                area: '1100px',
                content:list,
               });
//                console.log(val);
          },"json");
      }
      //招商任务列表删除
      
      function  business_task_del(taskid,i,ulid,datalistid,pageid,typeid){
//          console.log('#'+ulid+i);
          layer.confirm('你确定要删除此记录吗?',{
              btn:['确定','取消'],
              shade:false,
              icon:3,
              title:'删除提示'   
          },function(index){
              layer.close(index);
              $.post(APP+"/Api/Web/delTask","taskids="+taskid,function(v){
                 if(v.result==='000000'){
                     $('#'+ulid+i).remove();
                     if($('#'+datalistid+' ul').length ===0){
                         $('#'+pageid).empty();
                         $('#'+datalistid).append(error_list);
                     }
                     if(typeid===3){ //招商
                         ReloadData(3,companyId);
                       //重新加载数据列表
                     }else if(typeid===1){ //推广
                        pushTaskList(); 
                     }else if(typeid===2){ //随手
                       widelyList();  
                     }else if(typeid===0){ //推广与随手全部任务
                       promotionList();
                     }
                     
                     
                   }else{
                    layer.msg('删除失败',{'icon':8});
                    return false;
                  }
              },"json");
          },function(index){
              layer.close(index);
              return false;
          });
      }
      
      //招商任务列表对应的编辑
      function  business_task_modi(taskid,i){ 
          layer.confirm('你确定要编辑此记录吗?',{
              btn:['确定','取消'],
              shade:false,
              icon:3,
              title:'编辑提示'
          },function(index){
              layer.close(index);
              location.href=APP+'/Home/Business/taskAdd?taskid='+taskid+'&tasktypeid=3';
            
          },function(index){
              layer.close(index);
              return false;
          });
      }
      
      
      //重新加载招商任务数据
      function  ReloadData(tasktypeid,companyId){
          loadi=layer.load(0);
          $.post(APP+"/Api/web/getTaskList","tasktypeid="+tasktypeid+"&companyid="+companyId,function(reval){
               layer.close(loadi); 
//             console.log("===="+reval.list);
             //总记录数
             total=reval.total;
             //每页显示的条数
             pageSize=reval.pageSize;
             //当前页
             page=reval.page;
             //总页数
             totalPage=reval.totalPage;
//             console.log("总记录数"+total+","+pageSize+","+page+","+totalPage);
             //获取展现招商任务列表
             showBusinesList(reval.list,total);
          },"json");
      }


      //提交任务
    function business_task_tijiao(taskid){
        var status=2; //提交
        var companyid = Cookie.readCookie("LYX_companyId");

        $.post(APP+"/Api/web/changeStatutask","taskid="+taskid+"&companyId="+companyid+"&status="+status,function(data){
            if( data.error_code == "success"){
                layer.alert("提交成功");
                window.location.reload();//刷新当前页面.
            }else{
                layer.alert("提交失败");
            }
        },"json");

    }
      
     
</script>
    </body>
</html>