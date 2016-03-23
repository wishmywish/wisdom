<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
    ul li{
        padding: 0px;
        margin: 0px;
        list-style:none;
    }
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
    .taskAdd_template_answer {
        width: 100%;
        min-height: 100px;
        float: left;
        margin-left: -3px;
        margin-top: 20px;
    }
    .taskAdd_template_answerInput {
        width: 160px;
        margin-left: 10px;
        margin-top: 10px;
    }
    .taskAdd_template_answer select {
        width: 60px;
        height: 33px;
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
        float: left;
        margin-top:15px;
        font-weight: normal;
    }

    html, body {
        margin: 0 auto;
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif,微软雅黑,宋体;
        background: #FFF;
        padding: 0;
    }
    #widely_one{
        position: absolute;
        top: 10px;
        background-color: #fff;
    }
    #widely_two{
        position: absolute;
        top: 450px;
        background-color: #fff;
    }
    #widely_three{
        position: absolute;
        top: 1100px;
        background-color: #fff;
        margin-left:-20px;
    }

    input{
        height:25px;
        min-height:25px;
        border:1px #c9c9c9 solid;
        line-height:25px;
        width:200px;
        margin-top:10px;
    }
    .pic{
        margin-left: 50px;
        margin-top:10px;
    }

    .add_business {
        background-color: #fff;
        width:900px;
        color:#000;
        height: 100%;
        margin: 20px 50px;
    }

</style>
<link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>
<body>
<div class="add">
    <div class="add_business">
        <div class="page_next" id="widely_one">
            <div class="big_line">
                <div  class="line_input">
                    <span>任务图标：</span>
                    <?php if ($reModi['tubiao']) {?>
                    <div id="showPic" class="pic">
                        <img src="/wisdom/Public/upfile/<?php echo $reModi[tubiao][f_filepath],$reModi[tubiao][f_filename];?>" width="100" height="100">
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="line">
                <div class="line_input">
                    <span>发布单位：</span> <input type="text" id="companyName" placeholder="录入发布单位" value="<?php echo ($reModi["company"]["companyName"]); ?>" readonly><input type="hidden" id="companyId" name="companyId"  value="<?php echo ($reModi["one"]["f_companyid"]); ?>">
                </div>
            </div>
            <div class="line">
                <div class="line_input">
                    <span>任务标题：</span> <input type="text" id="title" name="title" placeholder="请输入任务标题" value="<?php echo ($reModi["f_title"]); ?>" readonly>
                </div>
            </div>


            <div class="line">
                <div class="line_input">
                    <span>任务时间：</span>
                    <input id="startdate" class="laydate-icon" style="width: 120px;" value="<?php echo ($reModi["f_begindate"]); ?>" disabled>
                    <input id="enddate" class="laydate-icon" style="width: 120px;" value="<?php echo ($reModi["f_enddate"]); ?>" disabled>
                </div>
            </div>
            <div class="line">
                <div class="line_input">
                    <span>任务联系：</span> <input type="text" id="linkman" name="linkman" placeholder="业务联系人" value="<?php echo ($reModi["f_linkman"]); ?>" readonly>
                </div>
            </div>
            <div class="line">
                <div class="line_input">
                    <span>联系电话：</span> <input type="text" id="linkphone" name="linkphone" placeholder="联系电话" value="<?php echo ($reModi["f_linkphone"]); ?>" readonly>
                </div>
            </div>

            <div class="line">
                <div class="line_input">
                    <span>所属类别：</span>
                    <select disabled style="margin-top:10px">
                        <option <?php if(($tasktypeid) == "2"): ?>selected<?php endif; ?>>随手赚</option>
                        <option <?php if(($tasktypeid) == "4"): ?>selected<?php endif; ?>>调研类</option>
                        <option <?php if(($tasktypeid) == "5"): ?>selected<?php endif; ?>>推荐类</option>
                        <option <?php if(($tasktypeid) == "6"): ?>selected<?php endif; ?>>答题类</option>
                    </select>
                </div>
            </div>

            <div class="line" >
                <div class="line_input" style="margin-top:10px">
                    <span>任务详情描述：</span><br>
                    <textarea  value="" name="pro_taskDescription"  id="pro_taskDescription" style="width:550px;height:80px;margin-top:5px" disabled="disabled" readonly="readonly"><?php echo ($reModi["f_description"]); ?></textarea>
                </div>
            </div>

        </div>

        <div class="page_next" id="widely_two"  style="margin-top:10px">
            <input type="hidden" id="taskId" name="taskId" value="<?php echo ($reModi["f_tid"]); ?>">

            <div class="line">
                <div class="line_input">
                    <span>任务总数：</span>
                    <input type="text" id="conven_taskBrand"  name="conven_taskBrand"  value="<?php echo ((isset($reModi["f_totalcopies"]) && ($reModi["f_totalcopies"] !== ""))?($reModi["f_totalcopies"]):0); ?>" class="taskAdd_conventionDataInput" oninput="calcu2();" style="margin-left:59px;" disabled="true">&nbsp 份
                </div>
            </div>

            <div class="line">
                <div class="line_input">
                    <span>单次奖励金币：</span>
                    <input type="text" id="conven_taskProduct"  name="conven_taskProduct"  value="<?php echo ($reModi["f_eachcoin"]); ?>" class="taskAdd_conventionDataInput" oninput="calcu2();" style="margin-left:35px;" disabled="true">&nbsp 元
                </div>
            </div>

            <div class="line">
                <div class="line_input">
                    <span>平台单次服务佣金：</span>
                    <input type="text" id="conven_saleCommission"  name="conven_saleCommission"  value="<?php echo ($reModi["f_eachcoin"]); ?>" class="taskAdd_conventionDataInput" placeholder="自动计算" disabled="true" style="margin-left:11px;">&nbsp 元
                </div>
            </div>

            <div class="line">
                <div class="line_input">
                    <span>总佣金：</span>
                    <input type="text" id="conven_totalFee"  name="conven_totalFee"  value="<?php echo ($total); ?>" class="taskAdd_conventionDataInput" placeholder="自动算出，四舍五入" disabled="true" style="margin-left:71px;">&nbsp 元
                </div>
            </div>

            <div class="line">
                <div class="line_input"><label  for="taskDegree" id="taskOption">任务难易程度：</label></div>
                <div>
                    <input type="radio"  name="taskDegree"  value="1" disabled  style="width:10px;" <?php if(($reModi["f_harder"]) == "1"): ?>checked<?php endif; ?> /><span  style="margin-right:10px">简单</span>
                    <input type="radio"  name="taskDegree"  value="2" disabled  style="width:10px;" <?php if(($reModi["f_harder"]) == "2"): ?>checked<?php endif; ?>/><span  style="margin-right:10px">中等</span>
                    <input type="radio"  name="taskDegree"   value="3" disabled style="width:10px;" <?php if(($reModi["f_harder"]) == "3"): ?>checked<?php endif; ?>/><span style="margin-right:10px">挑战</span>
                </div>
            </div>

            <div class="line" style="height: 450px;margin-top: 10px;">
                <div class="line_input">
                    <span>任务需求：</span><br>
                    <div class="editor" style="height:400px;width: 580px;float: left;margin-top: 10px;">
                        <script type="text/plain" id="editor2" style="width:580px;height:350px;" name="editor2"></script>
                    </div>
                </div>
            </div>

        </div>

        <div class="page_next" id="widely_three" >
            <input type="hidden" id="detailCount" value="<?php echo ($reModi["detailCount"]); ?>" />
                <div  class="taskAdd_template_questionList" id="quest">
                  <?php if ($reModi['detail']) { ?>
                    <?php if(is_array($reModi["detail"])): $k = 0; $__LIST__ = $reModi["detail"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="taskAdd_template_questionList1" id='question_list_<?php echo ($k-1); ?>'>
                            <div class="taskAdd_template_question">
                                问：<input type="text" name='conventionDataInput'  class="taskAdd_conventionDataInput" style="width:500px" value="<?php echo ($vo["f_problemtatile"]); ?>" readonly/>
                            </div>
                            <div  class="taskAdd_template_answer">
                                答：<select class="template_answer_selected" name="template_answer" id="template_answer_selected_<?php echo ($k-1); ?>" disabled>
                                <option  value="0" <?php if(($vo["f_type"]) == "0"): ?>selected<?php endif; ?>>请选择</option>
                                <option  value="1" <?php if(($vo["f_type"]) == "1"): ?>selected<?php endif; ?>>单选</option>
                                <option  value="2" <?php if(($vo["f_type"]) == "2"): ?>selected<?php endif; ?>>多选</option>
                                <option  value="3" <?php if(($vo["f_type"]) == "3"): ?>selected<?php endif; ?>>文本</option>
                                <option  value="4" <?php if(($vo["f_type"]) == "4"): ?>selected<?php endif; ?>>图片</option>
                            </select>
                                <?php if ($vo['f_type']==1 || $vo['f_type']==2) {?>
                                <?php if(is_array($vo["answer"])): $m = 0; $__LIST__ = $vo["answer"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($m % 2 );++$m;?><input type="text" class="taskAdd_conventionDataInput  taskAdd_template_answerInput" value="<?php echo ($answer); ?>" readonly>
                                    <input type="checkbox" style="margin-left:7px;width:0px" disabled  name="answer" value="<?php echo ($m-1); ?>" <?php  if (in_array(($m-1),explode(",",$vo['f_trueanswer']))&&$vo['f_trueanswer']!=""){echo "checked";} ?>/><?php endforeach; endif; else: echo "" ;endif; ?>
                                <?php }?>
                            </div>
                            <input type="hidden" id="f_stdindex<?php echo ($k-1); ?>" name="f_stdindex" value="<?php echo ($vo["f_stdindex"]); ?>">
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php }else{ ?>
                              <?php  if($reModi['f_tasktypeid']==4||$reModi['f_tasktypeid']==6) {?>
                                 <p style="color:red;margin-left:20px">暂无任务模板!</p>
                              <?php }else {?>
                                  <div class="editor" style="height:400px;width: 580px;float:left;margin-top: 10px;margin-left:20px;margin-bottom:50px">
                                      <span style="margin-bottom:10px;display:inline-block">任务模板:</span>
                                     <script type="text/plain" id="editor3" style="width:580px;height:350px;" name="editor3"></script>
                                  </div>
                              <?php }?>
                    <?php }?>

                </div>

        </div>

    </div>
</div>
</body>
<script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/jquery.bigautocomplete.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/skin/layer.css"></script>
<script type="text/javascript" src="/wisdom/Public/static/laypage/laypage.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>
<script language="javascript" type="text/javascript" src="http://www.my97.net/dp/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/autosize.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>
<div style="display: none;"><script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script></div>

 
 
 

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
    UM.getEditor('editor2').setContent('<?php echo ($reModi["f_taskrequirements"]); ?>');
    UM.getEditor('editor2').setDisabled('fullscreen');
</script>

<script type="text/javascript">
    //实例化编译器
    var ue=UM.getEditor('editor3',{
        toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink'],
        UMEDITOR_HOME_URL:"/wisdom/Public/static/um/",
        autoClearinitialContent: true,
        elementPathEnabled: false,
        autoFloatEnabled: false,
        // textarea: 'content'
    });
    UM.getEditor('editor3').setContent('<?php echo ($reModi["f_recommend"]); ?>');
    UM.getEditor('editor3').setDisabled('fullscreen');
</script>
</html>