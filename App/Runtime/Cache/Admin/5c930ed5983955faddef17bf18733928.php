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

<style type="text/css">
    .deptDel{display: inline-block;width: 15px;cursor:pointer;}
    .deptDel .deptDel_img{width: 15px;height: 15px;display: none;}
    .companyName{
        padding: 5px;
        margin-left: 10px;}
    a,a:hover,a:focus{
        text-decoration: none;
        blr:expression(this.onFocus=this.blur());
        outline: none;
    }
</style>
<div class="body_right">

		<!--部门操作 start-->	
        <div class="body_right_menu" style="height: 900px;overflow: auto;">
            <div class="button_bg_80" id="add_depart"  onclick="add()">创建部门</div>
            <!--<div class="companyName"><a href="<?php echo U('Group/index');?>"><?php echo ($companyName); ?></a></div>-->
            <div class="" style="width: 220px;margin-top:20px;border-top:1px dotted #eee">
                <?php if(is_array($deptListArr_tree)): foreach($deptListArr_tree as $key=>$vo): ?><div <?php if($key%2 != 0 ): ?>style="background-color: #eee;border-bottom:1px solid #eee;"<?php endif; ?> class="deptName">
                        <span onclick="delDept(<?php echo ($vo['departId']); ?>)"  class="deptDel">
                           <img src="/wisdom/Public/Admin/Default/images/redx_logo.png" alt="" class="deptDel_img">
                        </span>
                        <span style="display: inline-block;width: 20px;cursor: pointer;" onclick="editDepart(<?php echo ($vo['departId']); ?>,'<?php echo ($vo['deptName']); ?>',<?php echo ($vo['parentId']); ?>)" class="deptEdit" >
                           <img src="/wisdom/Public/Admin/Default/images/edit_logo.png" alt="" style="width: 15px;height: 15px;display: none;">
                        </span>
                        <span style="height: 25px;line-height: 30px;overflow: hidden;display: inline-block;cursor: pointer;">

                            <a href="<?php echo U('Group/index',array('departId'=>$vo['departId'] ));?>"  title="<?php echo ($vo['deptName']); ?>">
                                <?php for( $i=0;$i<$vo['count'];$i++ ){ echo "&nbsp;&nbsp;&nbsp;";} ?>
                                <i class="fa fa-caret-right"></i>
                                <?php echo ($vo['deptName']); ?>
                            </a>
                        </span>
                    </div><?php endforeach; endif; ?>
            </div>
        </div>
        <!--部门操作 end-->
        
        
        <!--员工操作 start-->
        <div class="body_right_list">
            <div class="body_right_list_button">
                <!--<div style="float: left;"><input type="text" name="user_search" id="user_search" value="" placeholder="员工姓名或编号" style="width:100px;height:23px;float: left;border: 1px solid #eeeeee;"><div style="cursor: pointer;float: left;width: 23px;height: 23px;border-top: 1px solid #eeeeee;border-bottom: 1px solid #eeeeee;border-right: 1px solid #eeeeee;"><div class="black_search_ico" style="margin-top: 6px;"></div></div></div>-->
                <div class="button_bg_80" style="float: right;"><a href="<?php echo U('Group/exportUser');?>" style="color: #fff;">导出员工</a></div>
                <div class="button_bg_80" style="float: right;margin-right:12px;" onclick="batchImport()">批量导入</div>
                <div class="button_bg_80" style="float: right;margin-right:12px;" onclick="addStaff()">新建员工</div>
            </div>
            <!--<div class="body_right_list_tab">-->
                <!--<ul>-->
                    <!--&lt;!&ndash;<li>在职的员工</li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<li>停用的员工</li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<li>没分配的员工</li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<li>管理员</li>&ndash;&gt;-->
                <!--</ul>-->
            <!--</div>-->
            <div class="body_right_list_action" style="margin-top:20px;border-top:1px dotted #EEEEEE;text-align: left;width: 720px;margin-left: -105px;
            ">
                <!--<div class="select_all"></div>-->
                    <!--<div class="body_right_list_action_button">-->
                        <!--<div class="button_bg_40" style="float: left;margin-right: 5px;">停用</div>-->
                        <!--<div class="button_bg_40" style="float: left;margin-right: 5px;">启用</div>                    -->
                    <!--</div>-->
                <div class="button_bg_40" style="float: left;margin-right:12px; margin-left:214px;margin-top: 4px;" onclick="editDeptUser()">修改</div>
                <div class="button_bg_40" style="float: left;margin-right:12px;margin-top: 4px;" onclick="delDeptUser()">删除</div>
                <div class="button_bg_40" style="float: left;margin-right:12px;margin-top: 4px;" onclick="addPower()">授权</div>
                <div class="button_bg_80" style="float: left;margin-top: 4px;margin-right: 12px;" onclick="addOmsUser()">开通分销用户</div>
                <div class="button_bg_80" style="float: left;margin-top: 4px;" onclick="delOmsUser()">取消分销用户</div>
                <!--<div class="body_right_list_action_search">-->
                    <!--&lt;!&ndash;<select name="user_list_seq" style="float: right;margin-top: 8px;">&ndash;&gt;-->
                        <!--&lt;!&ndash;<option value="1">按名称排列</option>&ndash;&gt;-->
                    <!--&lt;!&ndash;</select>&ndash;&gt;-->
                <!--</div>-->
            </div>

            <?php if(empty($first_dept_user_arr)): ?><!--没有员工显示内容-->
                 <div style="padding: 20px;text-align:center;color: red;height:750px">暂无数据</div>
            <?php else: ?>
                <!-- 员工列表 start -->
                <div class="body_right_list_user">
                    <ul  style="text-align: left;">
                        <li style="width:10%;background-color:#eee"><input type="checkbox" name="select_all" id="select_all"></li>
                        <li style="width:35%;background-color:#eee">所属部门</li>
                        <li style="width:20%;background-color:#eee;">真实姓名</li>
                        <li style="width:20%;background-color:#eee">手机号码</li>
                        <li style="width:15%;background-color:#eee">是否分销用户</li>
                    </ul>
                    <br/>
                    <div style="clear: both;"></div>
                    <?php if(is_array($first_dept_user_arr)): foreach($first_dept_user_arr as $key=>$vo): ?><!--<?php dump($vo); ?>-->
                        <div id="user<?php echo ($vo['userId']); ?>">
                            <ul>
                                <li style="width:10%;"><input type="checkbox" name="checklist" value="<?php echo ($vo['userId']); ?>" companyId = <?php echo ($vo['companyId']); ?> level="<?php echo ($vo['userLever']); ?>" phone="<?php echo ($vo['mobile']); ?>" ></li>
                                <li style="width:35%;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">
                                    <?php if(is_array($deptListArr_tree)): foreach($deptListArr_tree as $key=>$v): if($v[departId] == $vo[departId]): ?><span title="<?php echo ($v['deptName']); ?>"><?php echo ($v['deptName']); ?></span><?php endif; endforeach; endif; ?>
                                </li>
                                <li style="width:20%;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;" title="<?php echo ($vo['trueName']); ?>"><?php echo ($vo['trueName']); ?></li>
                                <li style="width:20%;"><?php echo ($vo['mobile']); ?></li>
                                <li style="width:15%;">
                                    <!--<img src="/wisdom/Public/Admin/Default/images/<?php if($vo[isOmsUser] == 1): ?>right.png<?php else: ?>wrong.png<?php endif; ?>" alt="" width="20px" height="20px">-->
                                    <?php if($vo[isOmsUser] == 1): ?>是<?php else: ?>否<?php endif; ?>
                                </li>
                            </ul>
                        </div>
                        <div style="clear: both;"></div><?php endforeach; endif; ?>
                </div>
                <!-- 员工列表 end -->

                <!-- 分页start -->
                <div style="clear:both;"></div>
                <div id="pagerolelist" class="page_load" style="margin-top:20px;">
                    <span style="margin-top:20px;">共<?php echo ($total); ?>条</span>
                    <span style="margin-top:20px;">每页<?php echo ($pageSize); ?>条</span>
                    <span style="margin-top:20px;"><?php echo ($page+1); ?>/<?php echo ($pageTotal); ?></span>
                    <?php if(($page+1)==1){?>
                    <span style="margin-top:20px;"><a href="#" style="color:#cccccc"><i class='fa fa-fast-backward fa-lg'></i></a></span>
                    <span style="margin-top:20px;"><a href="#" style="color:#cccccc"><i class='fa fa-caret-left fa-lg'></i></a></span>
                    <?php }else{?>
                    <span style="margin-top:20px;"><a href="/wisdom/index.php/Admin/Group/index/departId/<?php echo $departId; ?>/page/0"><i class='fa fa-fast-backward fa-lg'></i></a></span>
                    <span style="margin-top:20px;"><a href="/wisdom/index.php/Admin/Group/index/departId/<?php echo $departId; ?>/page/<?php echo $prePage; ?>"><i class='fa fa-caret-left fa-lg'></i></a></span>
                    <?php }?>
                    <?php  if(($page+1)>=$pageTotal){?>
                    <span style="margin-top:20px;"><a href="#" style="color:#cccccc"><i class='fa fa-caret-right fa-lg'></i></a></span>
                    <span style="margin-top:20px;"><a href="#" style="color:#cccccc"><i class='fa fa-fast-forward fa-lg'></i></a></span>
                    <?php }else{?>
                    <span style="margin-top:20px;">
                        <a href="/wisdom/index.php/Admin/Group/index/departId/<?php echo $departId; ?>/page/<?php echo $nextPage; ?>">
                            <i class='fa fa-caret-right fa-lg'></i>
                        </a>
                    </span>
                    <span style="margin-top:20px;"><a href="/wisdom/index.php/Admin/Group/index/departId/<?php echo $departId; ?>/page/<?php echo $pageTotal-1; ?>"><i class='fa fa-fast-forward fa-lg'></i></a></span>
                    <?php }?>
                </div>
                <!-- 分页end --><?php endif; ?>

        </div>
        <!--员工操作 end-->
        
    </div>
    <script>
    //点击载入对应部门员工信息
   /*  function loadDeptUser(departId){
     	var queryStart = 0;
     	var queryEnd = 4;
 	 // var departId = 1; 	//测试
		 var html = "";
     	$.post(APP+"/Api/Info/conf","command=getUsersByDepart&departId="+departId+"&queryStart="+queryStart+"&queryEnd="+queryEnd,function(result){
     		if( result.error_code == "success" ){
     			for(i in result.list){
     				if( result.list[i].trueName != ''){	//真实姓名不为空时显示
	     				html += '<div class="body_right_list_user">';
	     				html += 	'<ul>';
	     				html += 		'<li style="width: 80px;">'+ result.list[i].trueName +'</li>';
	     				html += 		'<li style="width: 120px;">产品研发部</li>';
	     				html += 		'<li style="width: 100px;">'+ result.list[i].mobile +'</li>';
	     				html += 		'<li style="width: 60px;">启用</li>';
	     				html += 		'<li style="width: 120px;"></li>';
	     				html += 		'<li style="width: 30px;" onclick="editDeptUser('+ result.list[i].userId +')">修改</li>';
	     				html += 		'<li style="width: 30px" onclick="delDeptUser('+result.list[i].userId+','+ result.list[i].companyId+')">删除</li>';
	     				html += 	'</ul>';
	     				html += '</div>';
     				}
     			}

                 //分页
                 // html += '<div style="clear:both;"></div>';
                 // html += '<div id="pagerolelist">';
                 // html +=     '<span>共<?php echo ($total); ?>条</span>';
                 // html +=     '<span>每页<?php echo ($pageSize); ?>条</span>';
                 // html +=     '<span><?php echo ($page+1); ?>/<?php echo ($pageTotal); ?></span>';
                 // html +=     '<span><a href="<?php echo U('Group/index');?>">首页</a></span>';
                 // html +=     '<span><a href="<?php echo U('Group/index',array('departId'=>'+ departId +','page'=>$prePage));?>">上一页</a></span>';
                 // html +=     '<span><a href="<?php echo U('Group/index',array('departId'=>'+ departId +','page'=>$nextPage));?>">下一页</a></span>';
                 // html +=     '<span><a href="<?php echo U('Group/index',array('departId'=>'+ departId +','page'=>$pageTotal-1));?>">尾页</a></span>';
                 // html += '</div>';

     		}

     		$(".body_right_list_user").html(html);
             // $(".page_load").html("");
     	},"json");
     }*/


    //刷新时去除默认勾选项
    $("input[type=checkbox]").each(function(){  //关闭时让不选中,火狐刷新后勾选仍存在，这步是兼容操作
       $(this).removeAttr("checked");
    });



    //鼠标经过显现删除和编辑图标
    $(".deptName").on("mouseover",function(){
        $(this).children(".deptDel").children("img").show();
        $(this).children(".deptEdit").children("img").show();
    }).on("mouseout",function(){
        $(this).children(".deptDel").children("img").hide();
        $(this).children(".deptEdit").children("img").hide();
    });

    //全选
    $("#select_all").click(function(){
        if( $(this).is(":checked") ){
            $("input[name=checklist]").prop("checked","checked");
        }else{
            $("input[name=checklist]").removeProp("checked");
        }
    });

     //创建部门弹窗
       function add(){
          addDept_index=layer.open({
		        type: 2,
		        title :['创建部门','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
		        area: ['480px', '330px'],
		        shadeClose: false, //点击遮罩关闭
		        content:APP+'/Admin/Group/addDept'
		    });


       }

    //关闭弹窗
    function  reset(){
        layer.closeAll(addDept_index);
    }


    //编辑部门弹窗
    function editDepart(departId,departName,parentId){
    	layer.open({
		        type: 2,
		        title :['编辑部门','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
		        area: ['480px', '330px'],
		        shadeClose: false, //点击遮罩关闭
		        content:APP+'/Admin/Group/editDept?departId='+departId+'&departName='+departName+'&parentId='+parentId
		    });

    	console.log(departId);
    }

    //删除部门
    function delDept(departId){
    	$.post(APP+"/Admin/Group/hasChild","departId="+departId,function(result){
    		if( result.text == "success" ){
//    			alert('有子类，请勿删除');
    			layer.msg('有子类，请勿删除');
    		}else{
                //查找部门下是否有员工，有员工是不能删除部门的
                var queryStart = 0;
                var queryEnd = 5;
                $.post(APP+"/Api/Api/inport","command=getUsersByDepart&departId="+departId+"&queryStart="+queryStart+"&queryEnd="+queryEnd,function(result){
//                    console.log(result.error_code);
                    if( result.error_code == "success" ){
//                        alert('部门有员工不能删除');
                        layer.msg('部门有员工不能删除');
                        return false;
                    }else{
//                       var r = confirm("你确定要删除吗？");
//                       if( r == true ){
//                             $.post(APP+"/Api/Info/conf","command=delteDept&departId="+departId,function(result){
//                                if(result.error_code=="success"){
//                                    layer.msg("删除成功");
//                                    setTimeout(function(){
//                                        location.reload();
//                                    }, 2000);
//                                }else{
//                                    layer.msg("删除失败");
//                                }
//
//                            },"json");
//                        }

                        layer.confirm("你确定要删除吗？",function(){
                            $.post(APP+"/Api/Api/inport","command=delteDept&departId="+departId,function(result){
                                if(result.error_code=="success"){
                                    layer.msg("删除成功");
                                    setTimeout(function(){
                                        location.reload();
                                    }, 2000);
                                }else{
                                    layer.msg("删除失败");
                                }

                            },"json");
                        });


                    }
                },"json");

    		}
    	},"json");

    }

    //批量导入员工弹窗
    function batchImport(){
        layer.open({
            type:2,
            title:['批量导入','color:#506390font-size:16px;height:45px;line-height:45px;'],
            area:['600px','400px'],
            shadeClose:false, //点击遮罩关闭
            content:APP+'/Admin/Group/batchImport'
        });
    }


    //新增员工弹窗
       function addStaff(){
           layer.open({
               type:2,
               title :['新增员工','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
               area: ['600px', '500px'],
               shadeClose: false, //点击遮罩关闭
               content: APP+'/Admin/Group/addStaff'
           });
       }

    //编辑员工弹窗
    function editDeptUser(){
//        var checklist = $("input[name=checklist]:checked").val();
        var checklist = [];
        $("input[name=checklist]:checked").each(function(){
//            $(this).val();
            checklist.push($(this).val());
//            console.log($(this).val());
        });

        if( checklist.length > 1 ){
//            alert("不能多选");
            layer.msg("不能多选");
            return;
        }

        if( checklist.length == 0 ){
//            alert("未选中");
            layer.msg("未选中");
            return;
        }

        var userId = checklist[0];

    	layer.open({
    		type:2,
    		title :['编辑员工','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
           	area: ['600px', '500px'],
           	shadeClose: false, //点击遮罩关闭
           	content: APP+'/Admin/Group/editStaff?userId='+userId
    	});

    }

    //删除员工
    function delDeptUser(){
        var userId = "";
        var checklist = [];
        var super_level = 1;

        $("input[name=checklist]:checked").each(function(){
            checklist.push($(this).val());  //员工的userId集合
//            console.log($(this).attr("level")); //员工等级
            if( $(this).attr("level") == 999 ){ //为员工下第一个员工不能删除
//                alert( "手机号"+$(this).attr("phone") + "员工不能删除");
                layer.msg( "手机号"+$(this).attr("phone") + "员工不能删除");
                super_level = 999;
            }
        });

        if( super_level == 999 ){
            return;
        }

        if( checklist.length == 0 ){
//            alert("未选中");
            layer.msg("未选中");
            return;
        }

        var companyId = <?php echo cookie("companyId"); ?>; //公司id

//    	var r = confirm("你确定要删除吗？");
//        if( r == true ){
//            //批量删除用户
//            $.post(APP+"/Api/Info/conf","command=usersDelete&usersId="+checklist+"&companyId="+companyId,function(result){
//                if(result.error_code=="000000"){
//                    layer.msg("删除成功");
//                    setTimeout(function(){
//                        location.reload();
//                    }, 1000);
////                        $("#user"+userId).hide();
//                }else{
//                    layer.msg("删除失败");
//                }
//
//            },"json");



            layer.confirm("你确定要删除吗？",function(){

                //批量删除用户
                $.post(APP+"/Api/Api/inport","command=usersDelete&usersId="+checklist+"&companyId="+companyId,function(result){
                    if(result.error_code=="000000"){
                        layer.msg("删除成功");
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
//                        $("#user"+userId).hide();
                    }else{
                        layer.msg("删除失败");
                    }

                },"json");

            });


//            for( i=0;i<checklist.length;i++ ){
//                userId = checklist[i];
//                //取消分销用户身份
//                $.post(APP+"/Api/Jhttp/delOmsUser",{"userId":userId},function(data){});
//
//                //删除用户
//                $.post(APP+"/Api/Info/conf","command=delUserInfo&userId="+userId+"&companyId="+companyId,function(result){
//                    if(result.error_code=="success"){
//
//                        layer.msg("删除成功");
//                        setTimeout(function(){
//                            location.reload();
//                        }, 1000);
////                        $("#user"+userId).hide();
//                    }else{
//                        layer.msg("删除失败");
//                    }
//
//                },"json");
//            }


//        return;
//    }
//    	console.log(userId);
    }


    //授权
    function addPower(){
        var userId = "";
        var checklist = [];

        $("input[name=checklist]:checked").each(function(){
            checklist.push($(this).val());  //员工的userId集合
        });

        if( checklist.length > 1 ){
//            alert("不能多选");
            layer.msg("不能多选");
            return;
        }

        if( checklist.length == 0 ){
//            alert("未选中");
            layer.msg("未选中");
            return;
        }

        layer.open({
            type: 2,
            title :['用户授权','color:#506390;font-size: 16px;height: 45px;line-height: 45px;'],
            area: ['480px', '330px'],
            shadeClose: false, //点击遮罩关闭
            content:APP+'/Admin/Access/addPower?userId='+checklist[0]
        });
    }


    //推送分销用户
    function addOmsUser(){
        var userId = "";
        var checklist = [];  //员工的userId集合
        var phoneList = [];  //员工手机号集合
        var okPhoneList = []; //推送成功的手机号集合
        var okPhoneString = ''; //提示成功的手机号
        var url = "";
        var companyId = '<?php echo cookie("companyId"); ?>';

        $("input[name=checklist]:checked").each(function(){
            checklist.push($(this).val());  //员工的userId集合
            phoneList.push($(this).attr("phone")); //员工手机号集合
        });

        if( checklist.length == 0 ){
//            alert("未选中");
            layer.msg("未选中");
            return;
        }


        var j = 0;
        var i = 0;
        var last = 0; //标记是否为最后一条
        $.ajaxSetup({
            async: false  //同步
        });
        for( i=0;i<checklist.length;i++ ){
            j=i;

            if( i== (checklist.length-1) ){
                last = 1;
            }

            $.post(APP+"/Api/Jhttp/addOmsUser",{"companyId":companyId,"userId":checklist[i]},function(data){
                if( data.resCode == "000000"  ){ //如果成功把手机号推入数组中，后面提示需要用到
                    okPhoneList.push(phoneList[j]);
                }

//                if( i == checklist.length ){ //执行到最后一条
                if( last == 1 ){

                    if( okPhoneList.length == 0){ //没有手机推送
//                        alert("开通分销用户失败或已开通过");
                        layer.msg("开通分销用户失败或已开通过");
                        setTimeout('location.reload()',2000);
                    }else{
                        okPhoneString = okPhoneList.join(","); //数组轮化为字符串提示
//                        alert("手机号："+okPhoneString+ "推送成功");
                        layer.msg("开通分销用户成功");
//                        setTimeout(location.href = APP+"/Admin/Group/index/page/"+<?php echo $page; ?>,2000);
                        setTimeout('location.reload()',2000);
                    }

                }

            },"json");
        }

    }

    //取消分销用户
    function delOmsUser(){
        var userId = "";
        var checklist = [];  //员工的userId集合
        var phoneList = [];  //员工手机号集合
        var okPhoneList = []; //推送成功的手机号集合
        var okPhoneString = ''; //提示成功的手机号
        var url = "";
        var companyId = '<?php echo cookie("companyId"); ?>';

        $("input[name=checklist]:checked").each(function(){
            checklist.push($(this).val());  //员工的userId集合
            phoneList.push($(this).attr("phone")); //员工手机号集合
        });

        if( checklist.length == 0 ){
//            alert("未选中");
            layer.msg("未选中");
            return;
        }


        var j = 0;
        var i = 0;
        var last = 0; //标记是否为最后一条
        $.ajaxSetup({
            async: false  //同步
        });
        for( i=0;i<checklist.length;i++ ){
            j=i;

            if( i== (checklist.length-1) ){
                last = 1;
            }

            $.post(APP+"/Api/Jhttp/delOmsUser",{"userId":checklist[i]},function(data){
                if( data.resCode == "000000"  ){ //如果成功把手机号推入数组中，后面提示需要用到
                    okPhoneList.push(phoneList[j]);
                }else if( data.resCode == "100090" ){
                    layer.msg("系统管理员不能取消");
                    setTimeout('location.reload()',2000);
                    //                    alert("系统管理员不能取消");
//                    location.href = APP+"/Admin/Group/index/page/"+<?php echo $page; ?>;
                    return false;
                }

//                if( i == checklist.length ){ //执行到最后一条
                if( last == 1 ){

                    if( okPhoneList.length == 0){ //没有手机推送
                        layer.msg("取消分销用户失败或已取消");

//                        setTimeout('location.reload()',2000);
                    }else{
                        okPhoneString = okPhoneList.join(","); //数组轮化为字符串提示
//                        alert("手机号："+okPhoneString+ "取消成功");
//                        alert("取消分销用户成功");
                        layer.msg("取消分销用户成功");
                        setTimeout('location.reload()',2000);
//                        location.href = APP+"/Admin/Group/index/page/"+<?php echo $page; ?>;
                    }

                }

            },"json");
        }

    }

    </script>
    </body>
</html>