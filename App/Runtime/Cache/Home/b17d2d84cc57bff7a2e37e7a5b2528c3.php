<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
    html,body{
        font-size:12px;
        margin:0px;
        padding:0px;
    }
    .table{
        /*border:1px solid #cad9ea;*/
        color:#666;
        width: 60%;
        font-size:14px;
    }

    .table th {
        background-repeat:repeat-x;
        height:30px;
    }

    .table td,.table th{
        border:1px solid #cad9ea;
        padding:0 1em 0;
    }

    .addBusiness {
        background-color: #fff;
        width:900px;
        color:#000;
        height: 100%;
        margin: 20px 50px;
    }
    input{
        height:25px;
        min-height:25px;
        border:1px #c9c9c9 solid;
        line-height:25px;
    }
    .pic{
        margin-left: 50px;
        margin-top:10px;
    }

</style>
<link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>
<body>
<div class="add">
    <div class="addBusiness" >

        <div class="page_next" id="one" style="margin-bottom:20px;">
            <div class="big_line">
                <div  class="line_input">
                    <span>任务图标：</span>
                    <?php if ($reModi['tubiao']) {?>
                    <div id="showPic"  class="pic">
                        <img src="/wisdom/Public/upfile/<?php echo $reModi[tubiao][f_filepath],$reModi[tubiao][f_filename];?>" width="100" height="100">
                    </div>
                    <?php }?>
                </div>
            </div>

            <div class="big_line">
                <div  class="line_input">
                    <span>任务广告：</span>
                    <?php if ($reModi['guanggao']) {?>
                    <div id="showBan" class="pic">

                        <img src="/wisdom/Public/upfile/<?php echo $reModi[guanggao][f_filepath],$reModi[guanggao][f_filename];?>" width="100" height="100">
                    </div>
                    <?php }?>
                </div>
            </div>

            <div class="line" style="margin-top:20px">
                <div class="line_input">
                    <span>发布单位：</span> <input type="text" id="companyName" placeholder="录入发布单位" value="<?php echo ($reModi["company"]["companyName"]); ?>" readonly style="    width: 245px;"><input type="hidden" id="companyId" name="companyId" value="<?php echo ($reModi["one"]["f_companyid"]); ?>">
                </div>
            </div><br>

            <div class="line">
                <div class="line_input">
                    <span>任务标题：</span> <input type="text" id="title" name="title" value="<?php echo ($reModi["f_title"]); ?>" placeholder="请输入任务标题" readonly style="    width: 245px;">
                </div>
            </div><br>

            <div class="line">
                <div class="line_input">
                    <span>任务时间：</span>
                    <input id="startdate" class="laydate-icon" style="width: 120px;" value="<?php echo ($reModi["f_begindate"]); ?>" disabled>
                    <input id="enddate" class="laydate-icon" style="width: 120px;" value="<?php echo ($reModi["f_enddate"]); ?>" disabled>
                </div>
            </div><br>

            <div class="line">
                <div class="line_input">
                    <span>任务联系：</span> <input type="text" id="linkman" name="linkman" placeholder="业务联系人" value="<?php echo ($reModi["f_linkman"]); ?>" readonly style="    width: 245px;">
                </div>
            </div><br>

            <div class="line">
                <div class="line_input">
                    <span>联系电话：</span> <input type="text" id="linkphone" name="linkphone" placeholder="联系电话" value="<?php echo ($reModi["f_linkphone"]); ?>" readonly style="    width: 245px;">
                </div>
            </div><br>

            <div class="line" >
                <div class="line_input">
                    <span>任务详情描述：</span><br>
                    <textarea  value="" name="pro_taskDescription"  id="pro_taskDescription" style="width:550px;height:100px;margin-top:10px" disabled="disabled" readonly="readonly"><?php echo ($reModi["f_description"]); ?></textarea>
                </div>
            </div>
        </div>

        <!--下一步-->
        <div class="page_next" id="two" style=" background-color: #fff;">

            <!--<div class="line">-->
                <!--<div class="line_input">-->
                    <!--<span>任务品牌：</span> <input type="text" id="mtbrand" placeholder="招商品牌" value="<?php echo ($reModi["f_mtbrand"]); ?>" readonly style="width: 245px;">-->
                <!--</div>-->
            <!--</div><br>-->

            <!--<div class="line">-->
                <!--<div class="line_input">-->
                    <!--<span>任务产品：</span> <input type="text" id="mtgoods" placeholder="招商产品，多个用英文逗号分开" value="<?php echo ($reModi["f_mtgoods"]); ?>" readonly style="    width: 245px;">-->
                <!--</div>-->
            <!--</div><br>-->

            <div class="line">
                <div class="line_input">
                    <span>总首批款：</span> <input type="text" id="payment" placeholder="首批发货款" value="<?php echo ($reModi["f_unitfirstamount"]); ?>" style="width: 70px;" oninput="psum();" readonly>
                    <input type="text" id="bond" placeholder="保证金" style="width: 60px;" oninput="psum();" value="<?php echo ($reModi["f_unitcashdeposit"]); ?>" readonly>
                    <input type="text" id="franchise" placeholder="加盟费" style="width: 60px;" oninput="psum();" value="<?php echo ($reModi["f_unitfranchisefee"]); ?>" readonly>
                    <input type="text" id="otherprice" placeholder="其他费用" style="width: 60px;" oninput="psum();" value="<?php echo ($reModi["f_unitotheramount"]); ?>" readonly>
                    <span>合计：<span id="pricesum_txt" style="color:red;"><?php echo ($reModi["f_unittotalamount"]); ?></span>元<input type="hidden" id="pricesum" value="<?php echo ($reModi["two"]["f_unittotalamount"]); ?>"></span>
                </div>
            </div><br>

            <div class="line">
                <div class="line_input">
                    <span>任务佣金：</span> <input type="text" id="agents_commission" placeholder="业务员佣金" style="width: 90px;" oninput="a_comm();" value="<?php echo ($reModi["f_unitcommission"]); ?>" readonly>
                    <span>成功招商一个的总佣金：<span id="commission_txt" style="color:red;"><?php echo ((isset($reModi["f_unitpreownedgold"]) && ($reModi["f_unitpreownedgold"] !== ""))?($reModi["f_unitpreownedgold"]):0); ?></span>元<input type="hidden" id="commission" value="<?php echo ((isset($reModi["f_unitpreownedgold"]) && ($reModi["f_unitpreownedgold"] !== ""))?($reModi["f_unitpreownedgold"]):0); ?>" readonly>，其中业务员佣金(任务佣金)：<span id="agents_commission_txt" style="color:red;"><?php echo ((isset($reModi["f_unitcommission"]) && ($reModi["f_unitcommission"] !== ""))?($reModi["f_unitcommission"]):0); ?></span>元</span>
                </div>
            </div>

        </div>

        <!--下一步-->
        <div >
            <div class="line">
                <div class="line_input"  style="margin-top:10px">
                    <span>招商情况：</span>
                    <table class="table" style="margin-top:10px;border-collapse: collapse;" >
                        <tr>
                            <th>区域</th>
                            <th>数量</th>
                        </tr>

                        <?php if(is_array($reModi["area"])): $i = 0; $__LIST__ = $reModi["area"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($vo["f_area"]); ?></td>
                                <td><?php echo ($vo["f_qty"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
            </div>
        </div><br>

        <!--下一步display:none-->
        <div class="page_next" id="four" style=" background-color: #fff;height:100%;">
            <div class="line" style="height: 450px;">
                <div class="line_input">
                    <span>招商图文详情描述：</span><br>
                    <div class="editor" style="height:400px;width:610px;float: left;margin-top:10px">
                        <script type="text/plain" id="editor" style="width:600px;height:350px;"></script>
                    </div>
                </div>
            </div>

            <div class="line" style="height: 450px;">
                <div class="line_input">
                    <span>招商产品参数详情描述：</span><br>
                    <div class="editor" style="height:400px;width:610px;float: left;margin-top:10px">
                        <script type="text/plain" id="editor2" style="width:600px;height:350px;"></script>
                    </div>
                </div>
            </div>


            <div class="line" style="height: 450px;">
                <div class="line_input">
                    <span>公司简介描述：</span><br>
                    <div class="editor" style="height:400px;width:610px;float: left;margin-top:10px">
                        <script type="text/plain" id="editor3" style="width:600px;height:350px;"></script>
                    </div>
                </div>
            </div>

            <input type="hidden" id="tindexid" name="tindexid" value="<?php echo ((isset($reModi["f_indexid"]) && ($reModi["f_indexid"] !== ""))?($reModi["f_indexid"]):0); ?>">
        </div>

        <!--下一步-->
        <div class="page_next" id="five" style=" background-color: #fff;width:100%;float:left">
            <div class="big_line">
                <div class="line_input">
                    <span>商标注册证或授权使用证书图片：</span><?php if(($reModi["attachOne"]) != ""): ?><a href="<?php echo ($reModi["linkOne"]); ?>" target="_blank">链接</a><?php endif; ?>
                </div>
            </div><br>

            <div class="big_line">
                <div class="line_input">
                    <span>经销商合同：</span><?php if(($reModi["attachTwo"]) != ""): ?><a href="<?php echo ($reModi["linkTwo"]); ?>" target="_blank">链接</a><?php endif; ?>
                </div>
            </div><br>

            <div class="big_line">
                <div class="line_input">
                    <span>产品和宣传资料图片：</span><?php if(($reModi["attachThree"]) != ""): ?><a href="<?php echo ($reModi["linkThree"]); ?>" target="_blank">链接</a><?php endif; ?>
                </div>
            </div><br>

            <div class="big_line">
                <div class="line_input">
                    <span>产品价格表：</span><?php if(($reModi["attachFour"]) != ""): ?><a href="<?php echo ($reModi["linkFour"]); ?>" target="_blank">链接</a><?php endif; ?>
                </div>
            </div><br>

            <div class="big_line">
                <div class="line_input">
                    <span>产品价格表：</span><?php if(($reModi["attachFive"]) != ""): ?><a href="<?php echo ($reModi["linkFive"]); ?>" target="_blank">链接</a><?php endif; ?>
                </div>
            </div><br>

            <div class="big_line">
                <div class="line_input">
                    <span>标志LOGO设计图：</span> <?php if(($reModi["attachSix"]) != ""): ?><a href="<?php echo ($reModi["linkSix"]); ?>" target="_blank">链接</a><?php endif; ?>
                </div>
            </div><br>

            <div class="big_line">
                <div class="line_input">
                    <span>行业许可证：</span> <?php if(($reModi["attachSeven"]) != ""): ?><a href="<?php echo ($reModi["linkSeven"]); ?>" target="_blank">链接</a><?php endif; ?>
                </div>
            </div><br>

            <input type="hidden" id="findexid" name="findexid" value="<?php echo ((isset($reModi["five"]["f_indexid"]) && ($reModi["five"]["f_indexid"] !== ""))?($reModi["five"]["f_indexid"]):0); ?>">
            <div class="line_one"></div>
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

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>
<div style="display: none;"><script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script></div>

 
 
 

<script>
//    sublevel_out();//子窗口退出

    //加截UM
    var um = UM.getEditor('editor',{
        toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink']
        ,UMEDITOR_HOME_URL:"/wisdom/Public/static/um/"
        ,autoClearinitialContent: true
        //,wordCount: false
        ,elementPathEnabled: false
        ,autoFloatEnabled: false
        ,textarea: 'content'
        //,imageUrl: "<?php echo U('Api/Upfile/upfile');?>"
        //,imagePath: "/wisdom/Public/upfile"
    });
    UM.getEditor('editor').setContent('<?php echo ($reModi["f_note"]); ?>');
    UM.getEditor('editor').setDisabled('fullscreen');

var um = UM.getEditor('editor2',{
    toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink']
    ,UMEDITOR_HOME_URL:"/wisdom/Public/static/um/"
    ,autoClearinitialContent: true
    //,wordCount: false
    ,elementPathEnabled: false
    ,autoFloatEnabled: false
    ,textarea: 'content'
    //,imageUrl: "<?php echo U('Api/Upfile/upfile');?>"
    //,imagePath: "/wisdom/Public/upfile"
});
UM.getEditor('editor2').setContent('<?php echo ($reModi["f_product"]); ?>');
UM.getEditor('editor2').setDisabled('fullscreen');

var um = UM.getEditor('editor3',{
    toolbar: ['source bold italic underline insertorderedlist insertunorderedlist forecolor emotion image video fontsize link unlink']
    ,UMEDITOR_HOME_URL:"/wisdom/Public/static/um/"
    ,autoClearinitialContent: true
    //,wordCount: false
    ,elementPathEnabled: false
    ,autoFloatEnabled: false
    ,textarea: 'content'
    //,imageUrl: "<?php echo U('Api/Upfile/upfile');?>"
    //,imagePath: "/wisdom/Public/upfile"
});
UM.getEditor('editor3').setContent('<?php echo ($reModi["f_company_note"]); ?>');
UM.getEditor('editor3').setDisabled('fullscreen');

</script>
</html>