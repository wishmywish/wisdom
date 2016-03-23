<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>[title]</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            //var 
            //var UPFILE = "/wisdom/Public/upfile";
            var IMG = "/wisdom/Public/Taskadmin/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Taskadmin/Default";
            var accessVal = true;
        </script>
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/jquery.bigautocomplete.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/laypage/skin/laypage.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/layer/skin/layer.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/laydate/need/laydate.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/laydate/skins/default/laydate.css" />
<!--        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />-->
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Taskadmin/Default/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
<!--        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.min.css" />-->

<style type="text/css">
.taskAdd_template_questionList {
  width: 100%;
  min-height: 200px;
}
.taskAdd_template_questionList1 {
  margin: 0 0 0 20px;
  min-height: 100px;
}
.taskAdd_template_question {
  width: 80%;
  min-height: 40px;
  line-height: 40px;
  float: left;
}
.taskAdd_conventionDataInput {
  width: 300px;
  min-height: 30px;
  border: 1px #CACACA solid;
}
.taskAdd_btn {
  width: 30px;
  height: 30px;
  background-color: #14bce1;
  color: #fff;
  margin-left: 15px;
  border: 1px #14bce1 solid;
  font-weight: bold;
  font-size: 20px;
  cursor: pointer;
  margin-top: 10px;
}
.taskAdd_template_answer {
  width: 100%;
  min-height: 100px;
  float: left;
  margin-left: -3px;
  margin-top: 20px;
}
.taskAdd_template_answerInput {
  width: 120px;
  margin-left: 10px;
  margin-top: 10px;
}
.taskAdd_template_answer select {
  width: 100px;
  height: 33px;
}
.taskAdd_answer_input {
  border: none;
  color: red;
  font-size: 12px;
  background-color: #fff;
  margin-left: 10px;
  margin-top: 10px;
  line-height: 30px;
  cursor: pointer;
}
.taskAdd_conventDataList ul {
  float: left;
  margin-top: 10px;
  min-height: 30px;
}
.taskAdd_conventDataList li {
  margin-right: 20px;
  float: left;
}
#taskOption{
  display: inline-block;
  max-width: 100%;
  float: left;
  margin-top: 5px;
  font-weight: normal;
}
.line_note1{
  margin-right: 20px;
}
</style>
    <body>
        <div class="add_menu">
    <ul class="add_tab">
        <?php if(is_array($tab)): $i = 0; $__LIST__ = $tab;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($classtype == $vo["f_typeid"] ): ?><li value="<?php echo ($vo["f_typeid"]); ?>" class="selected"><?php echo ($vo["f_typename"]); ?></li>
            <?php else: ?>
                <li value="<?php echo ($vo["f_typeid"]); ?>"><a href="<?php echo U($vo['f_note']);?>"><?php echo ($vo["f_typename"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

        <div class="add">
            <div class="add_business">
                <div class="page_strat">
                    <div id="tip_one" class="span_tip_red">创建任务</div>
                    <div id="tip_two" class="span_tip_ccc">任务详情</div>
                    <div id="tip_three" class="span_tip_ccc">任务模板</div>
                    <div id="tip_four" class="span_tip_ccc">任务推荐</div>
                </div>
                <div class="page_next" id="widely_one">
                    <div class="big_line">
                        <div  class="line_input">
                            <div class="upfile">
                                <span>任务图标：</span> <button id="btn_up" class="btn btn-default" onclick="$('#upfile').click();">上传</button>
                                <div style="display: none;">
                                    <input type="file" id="upfile" name="upfile" accept="image/jpeg,image/gif,image/png">
                                </div>
                                <input type="hidden" id="fileid" name="fileid" value="<?php echo ($reModi["one"]["f_fileid"]); ?>">
                                
                            </div>
                            <div class="show_progress_no" id='show_progress_no'>0%</div>
                            <div class="progress_up" id='progress_up'><div class="bar" id='bar'></div></div>
                            <div class="show_img" id='show_img'></div>
                            <?php if ($reModi['one']['f_name']) {?>
                            <!--  {$reModi['one']['f_name']['f_filepath']}<?php echo ($reModi["one"]["f_name"]["f_filename"]); ?> -->
                            <div id="showPic">
                                <img src="/wisdom/Public/upfile/<?php echo ($reModi["one"]["f_name"]["f_filepath"]); echo ($reModi["one"]["f_name"]["f_filename"]); ?>" width="50" height="50">
                            </div>
                            <?php }?>
                        </div>
                        <div class="line_note">*1：1像素比例，大小50K以内</div>
                    </div>
                    <div class="line">
                        <div class="line_input">
                            <span>发布单位：</span> <input type="text" id="companyName" placeholder="录入发布单位" value="<?php echo ($reModi["one"]["companyName"]); ?>"><input type="hidden" id="companyId" name="companyId"  value="<?php echo ($reModi["one"]["f_companyid"]); ?>">
                        </div>
                        <div class="line_note">*输入时自动检索，没用请先开户</div>
                    </div>
                    <div class="line">
                        <div class="line_input">
                            <span>任务标题：</span> <input type="text" id="title" name="title" placeholder="请输入任务标题" value="<?php echo ($reModi["one"]["f_title"]); ?>">
                        </div>
                        <div class="line_note">*任务的标题，显示在客户端</div>
                    </div>
                    
                    
                    <div class="line">
                        <div class="line_input">
                            <span>任务时间：</span> 
                            <input id="startdate" class="laydate-icon" style="width: 120px;" value="<?php echo ($reModi["one"]["f_begindate"]); ?>">
                            <input id="enddate" class="laydate-icon" style="width: 120px;" value="<?php echo ($reModi["one"]["f_enddate"]); ?>">
                        </div>
                        <div class="line_note">*最多不超过180天</div>
                    </div>
                    <div class="line">
                        <div class="line_input">
                            <span>任务联系：</span> <input type="text" id="linkman" name="linkman" placeholder="业务联系人" value="<?php echo ($reModi["one"]["f_linkman"]); ?>">
                        </div>
                        <div class="line_note">*企业联系人</div>
                    </div>
                    <div class="line">
                        <div class="line_input">
                            <span>联系电话：</span> <input type="text" id="linkphone" name="linkphone" placeholder="联系电话" value="<?php echo ($reModi["one"]["f_linkphone"]); ?>">
                        </div>
                        <div class="line_note">*企业联系人的电话</div>
                    </div>

                    <div class="line">
                        <div class="line_input">
                            <span>所属类别：</span>
                            <select id="tasktypeid">
                                <option value="0" <?php if(($reModi["one"]["f_tasktypeid"]) == ""): ?>selected<?php endif; ?>>请选择任务类型</option>
                                <option value="4" <?php if(($reModi["one"]["f_tasktypeid"]) == "4"): ?>selected<?php endif; ?>>调研类</option>
                                <option value="5" <?php if(($reModi["one"]["f_tasktypeid"]) == "5"): ?>selected<?php endif; ?>>推荐类</option>
                                <option value="6" <?php if(($reModi["one"]["f_tasktypeid"]) == "6"): ?>selected<?php endif; ?>>答题类</option>
                            </select>
                        </div>
                        <div class="line_note">*随手赚的类型：调研，推荐，答题</div>
                    </div>
                    
                    <div class="line" >
                        <div class="line_input">
                            <span>任务详情描述：</span>
                            <textarea  value="" name="pro_taskDescription"  id="pro_taskDescription" style="width:550px;height:100px;"><?php echo ($reModi["one"]["f_description"]); ?></textarea>
                        </div>
                    </div>

                    <div class="next_btn" style="margin-bottom: 115px;"><a class="btn btn-default" href="#" role="button" id="btn_widely_one" style="margin-top: 115px;">下一步</a></div>
                    <div class="line_one"></div>
                </div>
                

                <div class="page_next" id="widely_two" style='display: none;'>
                    <input type="hidden" id="taskId" name="taskId" value="<?php echo ($reModi["one"]["f_tid"]); ?>">
                    <input type="hidden" id="indexid" name="indexid" value="<?php echo ($reModi["pro"]["f_indexid"]); ?>">

                    <div class="line">
                        <div class="line_input">
                            <span>任务总数：</span>
                            <input type="text" id="conven_taskBrand"  name="conven_taskBrand"  value="<?php echo ((isset($reModi["pro"]["f_totalcopies"]) && ($reModi["pro"]["f_totalcopies"] !== ""))?($reModi["pro"]["f_totalcopies"]):0); ?>" class="taskAdd_conventionDataInput" oninput="calcu2();" style="margin-left:59px;">&nbsp 份
                        </div>
                        <div class="line_note">*</div>
                    </div>

                    <div class="line">
                        <div class="line_input">
                            <span>单次奖励金币：</span>
                            <input type="text" id="conven_taskProduct"  name="conven_taskProduct"  value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>" class="taskAdd_conventionDataInput" oninput="calcu2();" style="margin-left:35px;">&nbsp 元
                        </div>
                        <div class="line_note">*(1元=10金币)&nbsp&nbsp 系统自动配奖励积分3积分</div>
                    </div>

                    <div class="line">
                        <div class="line_input">
                        <span>平台单次服务佣金：</span>
                        <input type="text" id="conven_saleCommission"  name="conven_saleCommission"  value="<?php echo ($reModi["pro"]["f_eachcoin"]); ?>" class="taskAdd_conventionDataInput" placeholder="自动计算" disabled="true" style="margin-left:11px;">&nbsp 元
                        </div>
                        <div class="line_note">*自动计算</div>
                    </div>

                    <div class="line">
                        <div class="line_input">
                        <span>总佣金：</span>
                        <input type="text" id="conven_totalFee"  name="conven_totalFee"  value="" class="taskAdd_conventionDataInput" placeholder="自动算出，四舍五入" disabled="true" style="margin-left:71px;">&nbsp 元
                        </div>
                        <div class="line_note">*</div>
                    </div>

                     <ul class="taskAdd_conventionDataUl">
                         <li class="taskAdd_conventionDataLi"><label  for="taskDegree" id="taskOption">任务难易程度：</label></li>
                         <li style="  margin: 5px 0 5px 125px;">
                             <input type="radio"  name="taskDegree"  value="1" <?php if(($reModi["one"]["f_harder"]) == "1"): ?>checked<?php endif; ?> /><span  style="margin-right:10px">简单</span>
                             <input type="radio"  name="taskDegree"  value="2" <?php if(($reModi["one"]["f_harder"]) == "2"): ?>checked<?php endif; ?>/><span  style="margin-right:10px">中等</span>
                             <input type="radio"  name="taskDegree"   value="3" <?php if(($reModi["one"]["f_harder"]) == "3"): ?>checked<?php endif; ?>/><span style="margin-right:10px">挑战</span>
                         </li>
                    </ul>

                    <div class="line">
                        <div class="line_input">
                        <span>热门标签：</span>
                        <input type="text" id="conven_industry"  name="conven_industry"  value="" class="taskAdd_conventionDataInput" style="margin-left:57px;">
                        </div>
                        <div class="line_note">*多个标签可用“，”隔开</div>
                    </div>

                    <div class="line" style="height: 450px;">
                        <div class="line_input">
                            <span>任务需求：</span>
                            <div class="editor" style="height: 100%;width: 580px;float: left;">
                                <script type="text/plain" id="editor2" style="width:580px;height:350px;" name="editor2"></script>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="btn_widely_two_count" value="">
                    <input type="hidden" id="taskid3" value="">
                    <div class="next_btn">
                      <a class="btn btn-default" href="#" role="button" id="return_widely_one">上一步</a>
                      <a class="btn btn-default" href="#" role="button" id="btn_widely_two">下一步</a>
                    </div>
                    <div class="line_one"></div>
                </div>
                

                <div class="page_next" id="widely_three" style='display: none;'>
                    <input type="hidden" id="detailCount" value="<?php echo ($reModi["detailCount"]); ?>" />
                    <div id="modi_quest">
                    <div  class="taskAdd_template_questionList" id="quest">

                        <?php if ($reModi['detail']) { ?>
                          <?php if(is_array($reModi["detail"])): $k = 0; $__LIST__ = $reModi["detail"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="taskAdd_template_questionList1" id='question_list_<?php echo ($k-1); ?>'>
                                <div class="taskAdd_template_question">
                                    问：<input type="text" name='conventionDataInput'  class="taskAdd_conventionDataInput" style="width:500px" value="<?php echo ($vo["f_problemtatile"]); ?>"/>
                                        <?php if(($k-1) == "0"): ?><button type="button" class="taskAdd_btn" value="" onclick="addQuestion(<?php echo ($reModi["detailCount"]); ?>)">+</button><?php endif; ?>
                                    <?php if(($k-1) != "0"): ?><span style="color:#14bce1;cursor:pointer;margin-left:20px;" onclick="taskAdd_template_questionList_delete(<?php echo ($k-1); ?>,<?php echo ($vo["f_stdindex"]); ?>)">删除</span><?php endif; ?>
                                </div>
                                <div  class="taskAdd_template_answer">
                                    答：<select class="template_answer_selected" name="template_answer" id="template_answer_selected_<?php echo ($k-1); ?>"  onchange="changeoption(this.value,<?php echo ($k-1); ?>)">
                                          <option  value="0" <?php if(($vo["f_type"]) == "0"): ?>selected<?php endif; ?>>请选择</option>
                                          <option  value="1" <?php if(($vo["f_type"]) == "1"): ?>selected<?php endif; ?>>单选</option>
                                          <option  value="2" <?php if(($vo["f_type"]) == "2"): ?>selected<?php endif; ?>>多选</option>
                                          <option  value="3" <?php if(($vo["f_type"]) == "3"): ?>selected<?php endif; ?>>文本</option>
                                          <option  value="4" <?php if(($vo["f_type"]) == "4"): ?>selected<?php endif; ?>>图片</option>
                                        </select>
                                        <?php if ($vo['f_type']==1 || $vo['f_type']==2) {?>
                                          <?php if(is_array($vo["answer"])): $ky = 0; $__LIST__ = $vo["answer"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($ky % 2 );++$ky;?><input type="text" class="taskAdd_conventionDataInput  taskAdd_template_answerInput" value="<?php echo ($answer); ?>">
                                            <input type="checkbox" name='trueAnswer<?php echo ($k-1); ?>' value="<?php echo ($ky-1); ?>" 
                                              <?php if (in_array(($ky-1),explode(",",$vo['f_trueanswer']))&&$vo['f_trueanswer']!="") { ?>
                                              <?php echo "checked"; ?>
                                              <?php } ?>
                                            >
                                            <?php if(($key) != "0"): ?><input type="button" class="taskAdd_answer_input" onclick="delte_input(0,<?php echo ($k-1); ?>)" id="delte_input_<?php echo ($k-1); ?>0" value="删除"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                          <button type="button" class="taskAdd_btn question_btn_add" id="template_question_btn<?php echo ($k-1); ?>" value="<?php echo ($k-1); ?>" onclick="addAnswer(<?php echo ($k-1); ?>)">+</button>
                                        <?php }?>
                                 </div> 
                                 <input type="hidden" id="f_stdindex<?php echo ($k-1); ?>" name="f_stdindex" value="<?php echo ($vo["f_stdindex"]); ?>">
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php }else{ ?>
                          <div class="taskAdd_template_questionList1" id='question_list_0'>
                              <div class="taskAdd_template_question">
                                  问：<input type="text" name='conventionDataInput'  class="taskAdd_conventionDataInput" style="width:500px"/>
                                      <button type="button" class="taskAdd_btn" id="template_question_btn" value="">+</button>
                              </div>
                              <div  class="taskAdd_template_answer">
                                  答：<select class="template_answer_selected" name="template_answer" id="template_answer_selected_0"  onchange="changeoption(this.value,0)">
                                        <option  value="0">请选择</option>
                                        <option  value="1">单选</option>
                                        <option  value="2">多选</option>
                                        <option  value="3">文本</option>
                                        <option  value="4">图片</option>
                                      </select>
                               </div> 
                          </div>
                        <?php }?>

                    </div>
                    </div>
                    <!-- <input type="hidden" id="taskid2" value="<?php echo ((isset($taskid) && ($taskid !== ""))?($taskid):0); ?>"> -->
                    <div class="next_btn">
                      <a class="btn btn-default" href="#" role="button" id="return_widely_two">上一步</a>
                      <a class="btn btn-default" href="#" role="button" id="task_two_conven">完成</a>
                    </div>
                    <div class="line_one"></div>
                 </div>
                 <div class="page_next" id="widely_four" style='display: none;'>
                    <div class="recommend" style="height: 450px;">
                        <div class="recommend_input">
                            <span>任务推荐：</span><br>
                            <div class="editor" style="height: 100%;width: 580px;float: left;">
                                <script type="text/plain" id="editor4" style="width:580px;height:350px;" name="editor4"></script>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="f_stdindex" name="f_stdindex" value="<?php echo ($reModi["detail"]["f_stdindex"]); ?>">
                    <div class="next_btn">
                      <a class="btn btn-default" href="#" role="button" id="return_widely_two_1">上一步</a>
                      <a class="btn btn-default" href="#" role="button" id="task_four_conven">完成</a>
                    </div>
                    <div class="line_one"></div>
            </div>
        </div>
    </body>
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/jquery.bigautocomplete.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laypage/laypage.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Taskadmin/Default/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/js/page.js"></script>

    <!--ueditor编译器源码文件-->
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>

    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>

    <script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script>
    <script>
        
        $(function(){
            sublevel_out();//子窗口退出
            // getTasktype();
            $("#upfile").wrap("<form id='uplogo' action='<?php echo U('Api/Upfile/upF/type/2/size/51200');?>' method='post' enctype='multipart/form-data'></form>");
            //$("#upfile_ban").wrap("<form id='uplogo_ban' action='<?php echo U('Api/Upfile/upF/type/2');?>' method='post' enctype='multipart/form-data'></form>");
            
            //公司自动补全
            $("#companyName").bigAutocomplete({width:300,
                url:"<?php echo U('Taskadmin/Fun/searchCname');?>",
                callback:function(data){
                    $('#companyId').val(data.result);
                }
            });
            

            
        var start = {
            elem: '#startdate',
            format: 'YYYY-MM-DD',
            min: laydate.now(), //设定最小日期为当前日期
            max: '2099-06-16', //最大日期
            //istime: true,
            istoday: false,
            choose: function(datas){
                 end.min = datas; //开始日选好后，重置结束日的最小日期
                 end.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end = {
            elem: '#enddate',
            format: 'YYYY-MM-DD',
            min: laydate.now(),
            max: laydate.now(+180),
            //istime: true,
            istoday: false,
            choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        laydate(start);
        laydate(end);
        });

        var i=0; 
       //推广赚 任务模块问题的加载
       $('#template_question_btn').click(function(){
           var list="";
                      console.log(i);
           list+="<div class='taskAdd_template_questionList1'  id='question_list_"+(i+1)+"'>";
           list+="<div class='taskAdd_template_question' style='margin-top:10px'>";
           list+="问：<input type='text' name='conventionDataInput'  class='taskAdd_conventionDataInput' style='width:500px'/>";
           list+="<span style='color:#14bce1;cursor:pointer;margin-left:20px;'  onclick='taskAdd_template_questionList_delete("+(i+1)+")'>删除</span>";
           list+="</div>";
           list+="<div  class='taskAdd_template_answer'>";
           list+="答：<select class='template_answer_selected' name='template_answer_selected' id='template_answer_selected_"+(i+1)+"' onchange='changeoption(this.value,"+(i+1)+")'>";
           list+="<option  value='0' selected>请选择</option>";                
           list+="<option  value='1'>单选</option>";                
           list+="<option  value='2'>多选</option>";   
           list+="<option  value='3'>文本</option>";                         
           list+="<option  value='4'>图片</option>";                        
           list+="</select>";    
           
           list+="</div>";
           list+="</div>";
           $('.taskAdd_template_questionList').append(list);
           i++;
           
       });

        function changeoption(optionValue,i){
            var j=1;
            $('#template_answer_selected_'+i+'').nextAll('input').remove();
            $('#template_answer_selected_'+i+'').next('button').remove();
             $('.line_note'+i+'').empty();
             if(optionValue==='2'||optionValue==='1'){
               var list="";
               list+="<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput' />";
               list+="<input type='checkbox' name='trueAnswer"+i+"'  value='0'>";
               list+="<button type='button' class='taskAdd_btn'  id='template_question_btn"+i+"'>+</button> ";
               list+="<div class='line_note"+i+"'>&nbsp;&nbsp;&nbsp;&nbsp;*请勾选正确答案,如无，则可不选</div>";
               $('#template_answer_selected_'+i+'').after(list);
               $('#template_question_btn'+i+'').click(function(){
                    var k=0;
                    var list="";
                    list+="<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput'/><input type='checkbox' name='trueAnswer"+i+"' value='"+j+"'}><input type='button' class='taskAdd_answer_input' onclick='delte_input("+k+","+i+")' id='delte_input_"+i+k+"' value='删除'/>";
                    $('#template_question_btn'+i+'').before(list);
                    k++;
                    j++;
                });
            }
        }

        function addAnswer(i){
            var k=0;
            var list="";
            list+="<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput'/><input type='button' class='taskAdd_answer_input' onclick='delte_input("+k+","+i+")' id='delte_input_"+i+k+"' value='删除'/>";

            $('#template_question_btn'+i+'').before(list);
          }

        function addQuestion(k){
          var a = $("#detailCount").val();
          $("#detailCount").attr("value",(parseInt(a)+parseInt(1)));

           var count = $("#detailCount").val();
           var list="";
           list+="<div class='taskAdd_template_questionList1'  id='question_list_"+(count-1)+"'>";
           list+="<div class='taskAdd_template_question' style='margin-top:10px'>";
           list+="问：<input type='text' name='conventionDataInput'  class='taskAdd_conventionDataInput' style='width:500px'/>";
           list+="<span style='color:#14bce1;cursor:pointer;margin-left:20px;'  onclick='taskAdd_template_questionList_delete("+(count-1)+")'>删除</span>";
           list+="</div>";
           list+="<div  class='taskAdd_template_answer'>";
           list+="答：<select class='template_answer_selected' name='template_answer_selected' id='template_answer_selected_"+(count-1)+"' onchange='changeoption(this.value,"+(count-1)+")'>";
           list+="<option  value='0' selected>请选择</option>";
           list+="<option  value='1'>单选</option>";
           list+="<option  value='2'>多选</option>";
           list+="<option  value='3'>文本</option>";
           list+="<option  value='4'>图片</option>";
           list+="</select>";    
           list+="</div>";
           list+="</div>";
           $('.taskAdd_template_questionList').append(list);
           k++;
        }

        //推广赚中任务模块多选中iuput的删除
        function  delte_input(k,i){
            $('#delte_input_'+i+k+'').prev().remove();
            $('#delte_input_'+i+k+'').prev().remove();
            $('#delte_input_'+i+k+'').remove();
                   
        }
        
       //删除推广任务模块
       function  taskAdd_template_questionList_delete(i,indexid){
           $('#question_list_'+i+'').remove();
           console.log(indexid+"==");
           if(indexid!==0){
                $.post(APP+"/Api/Web/delteanswer/","indexid="+indexid,function(rel){
                 console.log(rel.error_code+"====");
                 },"json");
           } 
       }
    </script>
   <script type="text/javascript">
     //实例化编译器
     var ue=UM.getEditor('editor2',{
         toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
         UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
         autoClearinitialContent: true,
         elementPathEnabled: false,
         autoFloatEnabled: false,
        // textarea: 'content'
     });
     //通过getContent和setContent方法可以设置和读取编译器的内容
     //读取配置
     // var lang=ue.getOpt('lang');默认返回：zh-cn
     
     //加载三级联动
     
//     _init_area();
//     getArea(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);
//     getPro(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);
     
     UM.getEditor('editor2').setContent('<?php echo ($reModi["pro"]["f_taskrequirements"]); ?>');

     var ue=UM.getEditor('editor4',{
         toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
         UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
         autoClearinitialContent: true,
         elementPathEnabled: false,
         autoFloatEnabled: false,
        // textarea: 'content'
     });
     //通过getContent和setContent方法可以设置和读取编译器的内容
     //读取配置
     // var lang=ue.getOpt('lang');默认返回：zh-cn
     
     //加载三级联动
     
//     _init_area();
//     getArea(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);
//     getPro(<?php echo ((isset($reModi["one"]["f_tid"]) && ($reModi["one"]["f_tid"] !== ""))?($reModi["one"]["f_tid"]):0); ?>);
     
     UM.getEditor('editor4').setContent('<?php echo ($reModi["pro"]["f_recommend"]); ?>');
  </script>
</html>