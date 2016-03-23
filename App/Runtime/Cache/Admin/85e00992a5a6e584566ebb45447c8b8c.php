<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>添加角色</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/Admin/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Admin/Default";
            var bigMenuIndex = 0; //大类LI下标
            var smallMenuIndex = 0;//小类LI下标
        </script>
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
        <!--cookie插件-->
        <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
        <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fun.js"></script>
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/layer/skin/layer.css" />
        <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
        <style>
            html,sssbody{
                margin:0px auto;
            }
            ul li{
                list-style:none;
            }
            .deptcontent input:before{
                border: 1px solid #ccc;
            }
            .deptcontent input:after{
                border: 1px solid  #409ad6;
            }
            .deptcontent ul{font-size: 14px;height:45px;line-height:25px;}
            .deptcontent ul li{margin:10px -20px;}
            .button{
                background-color: #409ad6;
                border: 1px #409ad6 solid;
                color:#fff;
                cursor: pointer;
                height:35px; 
                width: 100px;
                text-align: center;
                margin-top:20px;
                margin-left:70px;
            }
            .button:hover{
                background-color:  #00A73D;
            }
        </style>
    </head>
    <body>
        <div style="padding:20px;">
            <div  class="deptcontent">
                <ul>
                    <li>所属公司：<input type="text" name="company"  id="company" style="height:40px;width:250px; margin-left: 10px;" disabled value="<?php echo ($companyName); ?>"/>
                        <input type="hidden"  name="companyid" id="companyid" value="<?php echo ($companyId); ?>"/></li>
                    <li>角色名称：<input type="text" name="role_name"  id="role_name" style="height:40px;width:250px; margin-left: 10px;"/></li>
                    <li>
                        权限设置：
                        <div  class="showdept"  style="width:410px;margin:-23px 0 0 80px;border: 1px solid #ccc;min-height:150px">
                            <div  id="deptList" style="margin:10px">
                                <?php if(is_array($nodelist)): $i = 0; $__LIST__ = $nodelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div  style="width:100%">
                                    <span style="color:#409ad6"><?php echo ($vo["f_proname"]); ?></span>:<input type="hidden"  value="<?php echo ($vo["f_id"]); ?>"/>
                                    <?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
                                        <input  type="checkbox"  value="<?php echo ($list["f_value"]); ?>"/><?php echo ($list["f_proname"]); ?>
                                        </label><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                    </li>
                    <div style="text-align: center;width: 420px;">
                        <button  class="button" style="margin-bottom:20px" onclick="submit()">确定</button><button  class="button" style="margin-bottom:20px" onclick="reset()">关闭</button>
                    </div>
                    </li>
                </ul>
                
            </div>
           </div>
           
        </div>
        <script>
             function  submit(){
                var companyid=$("#companyid").val();
                var role_name=$("#role_name").val();
                var checkbox=$("#deptList input[type=checkbox]:checked");
                var checklist="";
                checkbox.each(function(){
                    checklist+=$(this).val()+",";
                });
                checklist=checklist.substring(0,checklist.length-1);
                if(role_name==""){
                    layer.msg("角色名称",{icon:8});
                    $("#depart_name").focus();
                    return false;    
                }
                console.log(checklist.length+"===");
                if(checklist.length==0){
                    layer.msg("选择权限设置",{icon:8});
                     return false;   
                }
                $.post(APP+"/Api/Web/role_add","f_name="+role_name+"&f_company_id="+companyid+"&f_access="+checklist,function(rel){
                        if(rel.code>0){
                            layer.msg("角色添加成功");
                            buslistData1(APP+"/Api/Web/role_list","companyid=<?php echo ($companyId); ?>",'get',"json","pagerolelist");
                            $("#role_name").val("");
                            $("#deptList input[type=checkbox]:checked").attr("checked",false);
                            setTimeout(function(){
                                var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                                parent.location.reload();
                                parent.layer.close(index);

                            },1000);

                        }
                },"json");
             }



             function  reset(){
                 var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                 parent.layer.close(index);
             }
        </script>
    </body>
    
</html>