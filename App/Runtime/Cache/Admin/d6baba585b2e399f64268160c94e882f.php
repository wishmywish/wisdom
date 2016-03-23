<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>新建部门</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
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
        <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fg.menu.js"></script>
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
                <ul style="font-size: 14px;height:45px;line-height:25px;">
                   
                    <li style="margin:10px 0;">所属公司：<input type="text" name="company"  id="company" style="height:40px;width:250px; margin-left: 10px;" disabled value="<?php echo ($companyName); ?>"/>
                                                        <!--<input type="hidden"  name="companyid" id="companyid" value="<?php echo ($companyId); ?>"/></li>-->
                                                        <input type="hidden"  name="companyid" id="companyid" value="<?php echo cookie('companyId'); ?>"/></li>
                    <li style="margin:10px 0;">部门名称：<input type="text" name="depart_name"  id="depart_name" style="height:40px;width:250px; margin-left: 10px;"/></li>

                    <li style="margin:10px 0;">所属部门：                    	
                        <select name="departpt"  id="departptId" style="height:40px;width:250px; margin-left: 10px;"/>
                        	<!--<option value="0">一级目录</option>-->
                        	<?php if(is_array($deptListArr_tree)): foreach($deptListArr_tree as $key=>$vo): ?><option value="<?php echo ($vo['departId']); ?>" style="margin-left:<?php echo ($vo['count']*20); ?>px"><?php echo ($vo['deptName']); ?></option><?php endforeach; endif; ?>                        	
                        </select>
                    </li>
                    <!--<li>
                        <div  class="showdept"  style="width:255px;margin-left:80px;border: 1px solid #ccc;display:none;min-height:200px">
                             <div  id="deptList"></div>
                        </div>
                    </li>-->
                    <button  class="button"  onclick="submit()">确定</button><button  class="button"  onclick="reset()">关闭</button>
                    </li>
                </ul>
                
            </div>
           </div>
           
        </div>
        <script>
             function  submit(){
                var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                var companyid=$("#companyid").val();
                var depart_name=$("#depart_name").val();
                var departptId=$("#departptId").val();
                
//              console.log();
//              return;
                if(depart_name==""){
                    layer.msg("请输入部门名称",{icon:8});
                    $("#depart_name").focus();
                    return false;    
                }
                if($("#departpt").val()==""){
                    $(".showdept").hide();
                }
                console.log(companyid+depart_name+departptId);
               // var data="{'command':'addDept','deptName':'depart_name','companyId':'companyid','parentId':'departptId'}";
                $.post(APP+"/Api/Info/conf","command=addDept&deptName="+depart_name+"&companyId="+companyid+"&parentId="+departptId,function(rel){
                    if(rel.error_code=="success"){
                        layer.msg("新增部门成功");

                        setTimeout(function(){
                            parent.location.reload();
                            parent.layer.close(index);
                        }, 2000);

                        $("#depart_name").val("");
                        $("#departpt").val("");
                        $("#departptId").val(0);
                    }else if(rel.error_code == '100110' ){
                        layer.msg("父部门下该部门已存在，创建失败");

                        setTimeout(function(){
                            parent.location.reload();
                            parent.layer.close(index);
                        }, 2000);
                        $("#depart_name").val("");
                        $("#departpt").val("");
                    }else{
                        layer.msg("添加部门失败");
                        $("#depart_name").val("");
                        $("#departpt").val("");
                    }
                    
                },"json");
             }
             function  reset(){
                 var index = parent.layer.getFrameIndex(window.name); //获取窗口索引

//                 parent.location.reload();
                 parent.layer.close(index);

//                  $("#depart_name").val("");
//                  $("#departpt").val("");
             }
             //部门列表展现
             function showlist(){
                 //alert($("#companyid").val());
                 $(".showdept").show(getDeptList(APP+"/Api/Info/conf","command=getDeparts&companyId="+$("#companyid").val(),"get","json"));
             }
             
             //
             function givemsg(deptId,deptName){
                 $("#departptId").val(deptId);
                 $("#departpt").val(deptName);
                 $(".showdept").hide();
                 if(deptName==""){
                     $("#departptId").val(0);
                 }
                  
             }
        </script>
    </body>
    
</html>