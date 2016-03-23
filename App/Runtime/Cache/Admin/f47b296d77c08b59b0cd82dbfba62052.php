<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
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
            .deptcontent{}
            .fl{float: left;}
        </style>
    </head>
    <body>
        <div style="padding:20px;width: 100%;">
            <div  class="deptcontent">
                <ul style="font-size: 14px;height:45px;line-height:25px;">
                   
                    <li style="margin:-10px 0 0 -30px;"> 所属角色：
                       <!-- <input type="text" name="company"  id="company" style="height:40px;width:250px; margin-left: 10px;" disabled value="<?php echo ($companyName); ?>"/> -->
                        <label class="checkbox-inline">
                       <input type="hidden"  name="companyid" id="companyid" value="<?php echo cookie("companyId"); ?>"/>
                            </label>
                        <div style="width: 400px;min-height: 150px;  margin: -25px 0 10px 30px;">
                            <?php if($isturesuper == 'true'): ?><ul class="fl" style="width: 200px;"><input type="checkbox"  value="<?php echo ($istruespuerId); ?>"  checked disabled name="role_name"/>超级管理员</ul>
                                <?php else: ?>
                                <?php if(is_array($role_list)): foreach($role_list as $key=>$vo1): ?><!--<span <?php if($key == 0): ?>style="display:none"<?php endif; ?>>-->
                                    <ul class="fl" style="width: 200px;">
                                        <label class="checkbox-inline">
                                        <input type="checkbox"  value="<?php echo ($vo1['f_id']); ?>" <?php if( in_array($vo1['f_id'],$user_role) ){ echo "checked"; }?>
                                        name="role_name"/><?php echo ($vo1['f_name']); ?>
                                        </label>
                                    </ul>

                                    <!--</span>--><?php endforeach; endif; endif; ?>
                        </div>

                    </li>
                    <div style="width: 100%;text-align: center;margin: 10px 0 20px -50px;">
                        <button  class="button"  onclick="submit()">确定</button>
                        <button  class="button"  onclick="reset()">关闭</button>
                    </div>
                </ul>
                
            </div>
           </div>         
          	
           
        <script>
             function  submit(){
                var role_all = '';
                $("input[name=role_name]:checked").each(function(){
                    var role_name = $(this).val();
                    role_all += ","+ role_name; 
                    console.log(role_name);
                });
               
                //return;
                var f_company_id = $("#companyid").val();	//公司的id
                var f_user_id = <?php echo $userId; ?>;	//用户的id
                var f_role_id = role_all.slice(1);	//赋予的角色id集合               
                
//                if( f_role_id == ""){
//                    layer.msg("请为用户选择角色",{icon:8});
//                   // $("#depart_name").focus();
//                    return false;
//                }
              
                $.post(APP+"/Api/Web/power_add_local","f_user_id="+f_user_id+"&f_role_id="+f_role_id+"&f_company_id="+f_company_id,function(rel){
                	if( rel != 0 ){
                		layer.msg("授权成功");
                        setTimeout(function(){
                            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                            parent.location.reload();
                            parent.layer.close(index);

                        },1000);

                	}else{
                		layer.msg("授权失败");
                	}                         
                },"json");
             }
             function  reset(){
                 var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                 parent.location.reload();
                 parent.layer.close(index);
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