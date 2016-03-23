/**
 * Created by Administrator on 2015/12/22.
 */
//设置全局变量

//稽核赚任务上传图片

$('#profileImg3').change(function(){
    $("#show_proimg3").show();
    $("#showPic3").hide();
    ajaxSub('#up_prologo3','#progress_up_pro3','#show_progress_no_pro3','#pro_bar3','#show_proimg3','#openImgBtn3','#profile3','img','#line_input_pro3');
    $("#show_progress_no_pro3").hide();
    $("#pro_bar3").hide();
});



//督查赚任务详情下一步
$("#task_audit_one").click(function(){
    if($('#profile3').val()=="-2"){
        layer.msg('任务图标比例应为1:1', {icon: 8});
        return false;
    }

    if($('#profile3').val()==""){
        layer.msg('请上传任务图标', {icon: 8});
        return false;
    }
    if($('#taskTitle3').val()==""){
        layer.msg('任务标题不能为空', {icon: 8});
        $('#taskTitle3').focus();
        return false;
    }
    if($('#startTime3').val()==""){
        layer.msg('任务开始时间必填', {icon: 8});
        return false;
    }
    if($('#endTime3').val()==""){
        layer.msg('任务结束时间必填', {icon: 8});
        return false;
    }
    if($('#pro_linkman3').val()==""){
        layer.msg('任务联系人不能为空', {icon: 8});
        $('#pro_linkman3').focus();
        return false;
    }
    if($('#pro_linkphone3').val()==""||!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test($('#pro_linkphone3').val())){
        layer.msg('任务联系人的手机电话不能为空或手机号码错误', {icon: 8});
        $('#pro_linkphone3').focus();
        return false;
    }

    if($('#pro_taskDescription3').val()==""){
        layer.msg('请输入任务描述', {icon: 8});
        $('#pro_taskDescription3').focus();
        return false;
    }
    var patt1 = new RegExp("[`~!@#$^&*()=|{}':;'\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'？]");
    if((patt1).test($('#pro_taskDescription3').val())){
        layer.msg('不能含有特殊字符', {icon: 8});
        $('#pro_taskDescription3').focus();
        return false;
    }

    var taskid = $('#audit_taskid').val();
    var indexid=$("#audit_smallid").val();
    var editor3 = UM.getEditor('editor3').getContent();
    if(editor3===""){
        layer.msg('请输入任务需求', {icon: 8});
        $("#editor3").focus();
        return false;
    }

    //单次奖励金币
    var conven_taskProduct3=$("#conven_taskProduct3").val();
    //平台单次服务佣金
    var conven_saleCommission3=$("#conven_saleCommission3").val();
    //任务总数
    var conven_taskBrand3=$("#conven_taskBrand3").val();
    //总佣金
    var conven_totalFee3=$("#conven_totalFee3").val();
    var companyId=Cookie.readCookie("LYX_companyId");
    console.log(companyId+"==");

    //稽核赚第一步添加数据
    var data = "{'command':'cPush','companyId':companyId,'taskid':taskid,'indexid':indexid,'creatuserid':'0','tasktypeid':7,'fileid':$('#profile3').val(),'fileid_ban':0,'title':$('#taskTitle3').val(),'startdate':$('#startTime3').val(),'enddate':$('#endTime3').val(),'linkman':$('#pro_linkman3').val(),'linkphone':$('#pro_linkphone3').val(),'taskDescription':$('#pro_taskDescription3').val(),'editor':editor3,'pro_taskProduct':conven_taskProduct3,'pro_taskBrand':conven_taskBrand3,'total_commisson':conven_totalFee3}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){  //默认提交，不给予提示
        if(val.error_code==="success"){
        Cookie.createCookie('now_taskid',val.taskid,1);
            layer.msg("成功进入下一步");
            $('#audit_taskid').val(val.taskid);
            $("#audit_smallid").val(val.now_indexid);
            $('.business_taskAdd_step3 li').removeClass('business_taskAdd_audit_selected').prev('.step3_two').addClass('business_taskAdd_audit_selected');
            $("#audit_one").hide();
            $("#audit_two").show();
        }else{
            layer.msg(val.error_text, {icon: 8});
        }
    },'json');
});

//督查赚督查内容下一步
$("#task_audit_two").click(function(){
        var taskid = $('#audit_taskid').val();
        var length=$("#quest3 > div").length;
        for(var i=0;i<length;i++){
            var selected=$("#template3_answer_selected_"+i).val();
            var indexid = $("#audit_f_stdindex"+i).val();
            if (indexid == undefined) {
                var indexid = 0;
            };

            var question=$("#question3_list_"+i+ " input[name=conventionDataInput]").val();

            var length2=$("#template3_answer_selected_"+i+" ~  input[type=text]").length;

            var answer="";

            for(var j=0;j<length2;j++){
                answer+=$("#template3_answer_selected_"+i+" ~  input[type=text]").eq(j).val().trim()+"|";
            }
            answer=answer.substring(0,answer.length-1);
            //console.log(question+"=="+selected+"=="+answer+"==="+(i+1);
            //答案的获取标准答案 在答题类形式才会有
            var list = "{'command':'cPush2','taskid':taskid,'indexid':indexid,'f_serial':i+1,'f_problemtatile':question,'f_type':selected,'f_options':answer}";
            $.ajaxSetup({
                async:false
            });
            $.post(APP+"/Api/Api/inport",eval('('+list+')'),function(val){
                if(val.error_code=="success"||val.error_code=="edit_success") {
                    $('#audit_taskid').val(val.taskid);
                    $("#audit_f_stdindex"+i).val(val.Tanswerindex);
                    $('.business_taskAdd_step3 li').removeClass('business_taskAdd_audit_selected').next('.step3_three').addClass('business_taskAdd_audit_selected');
                    $("#audit_one").hide();
                    $("#audit_two").hide();
                    $("#audit_three").show();
                } else{
                    layer.msg('任务失败',{icon:8});
                    return;
                }
            },"json");

        }

});

//督查赚督查内容上一步
$("#task_audit_two_to_one").click(function(){
    $('.business_taskAdd_step3 li').removeClass('business_taskAdd_audit_selected').prev('.step3_one').addClass('business_taskAdd_audit_selected');
    $("#audit_one").show();
    $("#audit_two").hide();
});
//督查赚督查网点上一步
$("#task_audit_three_to_two").click(function(){
    $('.business_taskAdd_step3 li').removeClass('business_taskAdd_audit_selected').prev('.step3_two').addClass('business_taskAdd_audit_selected');
    $("#audit_one").hide();
    $("#audit_two").show();
    $("#audit_three").hide();
});

//督查赚督查网点保存
function  task_audit_three_save(){
    //数据加载
    var audit_smallid=$("#audit_smallid").val();
    var taskid=$('#audit_taskid').val();
    //单次奖励金币
    var conven_taskProduct3=$("#conven_taskProduct3").val();
    //平台单次服务佣金
    var conven_saleCommission3=$("#conven_saleCommission3").val();
    //任务总数
    var conven_taskBrand3=$("#conven_taskBrand3").val();
    //总佣金
    var conven_totalFee3=$("#conven_totalFee3").val();
    var editor3 = UM.getEditor('editor3').getContent();
    var data="{'taskid':taskid,'indexid':audit_smallid,'editor':editor3,'pro_taskProduct':conven_taskProduct3,'pro_taskBrand':conven_taskBrand3,'total_commisson':conven_totalFee3}";
    $.post(APP+"/Home/Promotion/cpush_auit",eval('('+data+')'),function(val){
        if(val.error_code=="success"){
            layer.msg("保存成功");
            location.href=APP+"/Home/Promotion/task";
        }else{
            layer.msg("保存失败");
        }
    },"json");



}
//督查赚督查网点提交
function  task_audit_three_submit(){
    //数据加载
    var audit_smallid=$("#audit_smallid").val();
    var taskid=$('#audit_taskid').val();
    //单次奖励金币
    var conven_taskProduct3=$("#conven_taskProduct3").val();
    //平台单次服务佣金
    var conven_saleCommission3=$("#conven_saleCommission3").val();
    //任务总数
    var conven_taskBrand3=$("#conven_taskBrand3").val();
    //总佣金
    var conven_totalFee3=$("#conven_totalFee3").val();
    var editor3 = UM.getEditor('editor3').getContent();
    layer.confirm('请确保数据无误，一旦提交，任务将进入待审核，不允许编辑该任务！是否立即提交？', {
        btn: ['确定','取消'], //按钮
        shade: false, //不显示遮罩
        icon: 3,
        title:'添加提示'
    },function(index){
        var data="{'taskid':taskid,'indexid':audit_smallid,'editor':editor3,'pro_taskProduct':conven_taskProduct3,'pro_taskBrand':conven_taskBrand3,'total_commisson':conven_totalFee3}";
        $.post(APP+"/Home/Promotion/cpush_auit",eval('('+data+')'),function(val){
            if(val.error_code=="success"){
                var data = "{'status':'2','taskid':taskid,'companyId':Cookie.readCookie('LYX_companyId')}";
                $.post(APP+"/Api/Web/changeStatutask",eval('('+data+')'),function(val){
                    if(val.error_code=="success"){
                        location.href=APP+"/Home/Promotion/task";
                        parent.layer.close(index);
                    }else{
                        layer.msg("提交失败", {icon: 8});
                    }
                },'json');

            }else{
                layer.msg("提交失败");
            }
        },"json");

    },function(index){
        location.href=APP+"/Home/Promotion/task";
        parent.layer.close(index);

    });
}

//督查赚督查网点添加
function superNetAdd(obj){
    //获取总页数
    var audit_taskid=$("#audit_taskid").val();
    //先查找数据库有效的数据数
    var this_obj_index=$(obj).parents("tr").find("input[name=audit_checkbox]").val();
    //网点名称
    var network_name=$(obj).parents("tr").find("input[name=network_name]").val();
    //网点地址
    var network_address=$(obj).parents("tr").find("input[name=network_address]").val();
    //认领数
    var net_claim_num=$(obj).parents("tr").find("input[name=net_claim_num]").val();
    //经度
    var longitude=$(obj).parents("tr").find("input[name=longitude]").val();
    //纬度
    var latitude=$(obj).parents("tr").find("input[name=latitude]").val();
    //范围
    var range=$(obj).parents("tr").find("input[name=range]").val();
    if(network_name==""){
        layer.msg("请将该条数据填写完整");
        return false;
    }
    if(network_address==""){
        layer.msg("请将该条数据填写完整");
        return false;
    }
    if(net_claim_num==""){
        layer.msg("请将该条数据填写完整");
        return false;
    }
    if(longitude==""){
        layer.msg("请将该条数据填写完整");
        return false;
    }
    if(latitude==""){
        layer.msg("请将该条数据填写完整");
        return false;
    }
    if(range==""){
        layer.msg("请将该条数据填写完整");
        return false;
    }


    var data="{'aduit_id':this_obj_index,'taskid':audit_taskid, 'network_name':network_name,'network_address':network_address,'net_claim_num':net_claim_num,'longitude':longitude,'latitude':latitude,'range':range}";
    $.post(APP+"/Home/Promotion/audit_data_edit",eval('('+data+')'),function(val){
        if(val.error_code=="success"){
                $(obj).parents("tr").find("input[name=network_address]").attr({readonly:'true'});
                $(obj).parents("tr").find("input[name=network_name]").attr("readonly","readonly");
                $(obj).parents("tr").find("input[name=net_claim_num]").attr("readonly","readonly");
                $(obj).parents("tr").find("input[name=range]").attr("readonly","readonly");
                $(obj).parents("tr").find("input[name=audit_checkbox]").val(val.audit_id);
                obj.remove();
                supertemp();
                changepage();
              layer.msg("数据添加成功");
          }else{
              layer.msg("数据添加失败");
          }
    },"json");
}

//计算网点page数
function  getpage(length){
    var page1=length%5;
    if(page1==0){
        page=parseInt(length/5);
    }else{
        page=parseInt(length/5)+1;
    }
    return page;
}

//数据改变时页数
function changepage(){
    var audit_tbody_tr_num=$(".audit_tbody").children("tr").length-1;
    $("#conven_taskBrand3").val(audit_tbody_tr_num);
    $("#audit_tbody_tr_num").text(audit_tbody_tr_num);
    tasktotalandcomm();
    var page=getpage(audit_tbody_tr_num);
    $("#audit_tbody_page").text(page);
    Cookie.createCookie("audit_page",page);
    if(audit_tbody_tr_num>5){
        $(".audit_tbody tr:gt(4)").hide();
    }
}

//督查赚督查网点删除
function superNetDel(){
    var  checked=$('input[name="audit_checkbox"]:checked');
    if(checked.length==0){
        layer.msg("请选择要删除的条数");
        return false;
    }
    var  checklist=[];
    checked.each(function(){
        if($(this).val()==""){
            $(this).removeAttr("checked");
        }else{
            checklist.push($(this).val());
        }
    });
    layer.confirm("你确定要删除吗?",{
            btn:['确定','取消'],
            shade:false
        },function(index){
          layer.close(index);
          $.post(APP+"/Home/Promotion/audit_data_del","checklist="+checklist,function(val){
            if(val.error_code=="success"){
                $(".audit_tbody tr:first-child  + td:last-child").removeAttr("img");
                checked.each(function(){
                    if($(this).val()!==""){
                        $(this).parents("tr").remove();
                    }
                });
                $('input[name="all_audit_checkbox"]:checked').removeAttr('checked');
                var num=$(".audit_tbody").children("tr").length;
                if(num==0){
                    $(".audit_tbody").empty();
                    supertemp();
                    changepage();
                }else{
                    var img="<td class='wh-5'><img src='"+IMG+"/jiahao.png'  onclick='superNetAdd(this)'   height='30px' width='30px'  style='cursor:pointer'></td>";
                    $(".audit_tbody tr:first-child + td:last-child").append(img);
                    changepage();
                    $(".audit_tbody tr").slice(0,4).show();
                    $(".audit_tbody tr:gt(4)").hide();
                }
                layer.msg("删除成功");
            }
        },"json");

        },function(index){
          layer.closeAll(index);
        });

}

//督查赚督查网点导入
function superNetImpt(){
    var audit_taskid=$("#audit_taskid").val();
    layer.open({
        type: 2,
        title:'EXCEL导入',
        skin: 'layui-layer-demo', //样式类名
        closeBtn: 0, //不显示关闭按钮
        shift: 2,
        area:['400','200'],
        move: false,
        shadeClose: true, //开启遮罩关闭
        content:APP+"/Home/Promotion/audit_Import_data?audit_taskid="+audit_taskid
    });
}



function  supertemp(){
    var list="";
    list+="<tr>";
    list+="<td class='wh-5'><input type='checkbox' class='audit_table_input' name='audit_checkbox'  value=''></td>";
    list+="<td class='wh-20'><input type='text' name='network_name'  class='audit_table_input' onmouseover='this.title=this.value' value=''></td>";
    list+="<td class='wh-20'><input type='text' name='network_address' class='audit_table_input' onmouseover='this.title=this.value' value='' onblur='getlngandlat(this)'></td>";
    list+="<td class='wh-10'><input type='text' name='net_claim_num'  class='audit_table_input' onmouseover='this.title=this.value' value=''></td>";
    list+="<td class='wh-10'><input type='text' name='longitude' class='audit_table_input' onmouseover='this.title=this.value' value='' disabled  style='height:40px;'></td>";
    list+="<td class='wh-10'><input type='text' name='latitude' class='audit_table_input' onmouseover='this.title=this.value' value='' disabled  style='height:40px;'></td>";
    list+="<td class='wh-10'><input type='text' class='audit_table_input' onmouseover='this.title=this.value' value='200'  name='range'></td>";
    list+="<td class='wh-5'><img src='"+IMG+"/dingwei.png'  height='30px' width='30px'  style='cursor:pointer' onclick='dingwei(this)'></td>";
    list+="<td class='wh-5'><img src='"+IMG+"/jiahao.png'  onclick='superNetAdd(this)'   height='30px' width='30px'  style='cursor:pointer'></td>";
    list+="</tr>";
    $(".audit_tbody").prepend(list);
}


function dingwei(obj){
    $(obj).parents("tr").siblings().removeClass("dingwei");
    $(obj).parents("tr").addClass("dingwei");
    //网点名称
    var network_name=$(obj).parents("tr").find("input[name=network_name]").val();
    //网点地址
    var network_address=$(obj).parents("tr").find("input[name=network_address]").val();
    //经度
    var longitude=$(obj).parents("tr").find("input[name=longitude]").val();
    var latitude=$(obj).parents("tr").find("input[name=latitude]").val();
    //纬度
    var index=layer.open({
        type: 2,
        title:'网点地址定位',
        skin: 'layui-layer-rim', //加上边框
        area: ['700px', '580px'], //宽高
        content:APP+"/Home/Promotion/audit_dingwei?network_address="+network_address+"&network_name="+network_name+"&longitude="+longitude+"&latitude="+latitude+""
    });
    //可认领数

    //范围
}

//上一页
function audit_pre_page(){
    //计算总共的页数
    var total_page_num=$(".audit_tbody").children("tr").length-1;
    var totalpage=getpage(total_page_num);
    var currentpage=$("#audit_tbody_page").text();
    if(currentpage>1){
        currentpage=parseInt(currentpage)-1;
        $("#audit_tbody_page").text(currentpage);
        current_page_handle(currentpage,totalpage,total_page_num)
    }else if(currentpage<=1){
        layer.msg("已经是第一页");
    }


}

//下一页

function  audit_after_page(){
    var total_page_num=$(".audit_tbody").children("tr").length-1;
    var totalpage=getpage(total_page_num);
    var currentpage=$("#audit_tbody_page").text();
    console.log(currentpage+","+totalpage);
    if(totalpage>currentpage){
        currentpage=parseInt(currentpage)+1;
        $("#audit_tbody_page").text(currentpage);
        current_page_handle(currentpage,totalpage,total_page_num)
    }else if(totalpage<=currentpage){
        layer.msg("已经最后页");
    }

}


//当前页面的显示处理
function  current_page_handle(page,totalpage,total_page_num){
    if(page<=0){
        $(".go_page").val(1);
        page=1;
    }
    if(page>totalpage){
        $(".go_page").val(totalpage);
        page=totalpage;
    }
    var index1=total_page_num+1-5*page-1+1;
    if(index1<0){
        index1=0;
    }
    var index2=total_page_num+1-5*(page-1);
    if(index2<0){
        index2=0;
    }
    $("#audit_tbody_page").text(page);
    $(".audit_tbody tr").hide();
    $(".audit_tbody tr").slice(index1,index2).show();
}

//到那一页
function  audit_go_page(){
    var go_page=$(".go_page").val();
    var total_page_num=$("#audit_tbody_tr_num").text();
    total_page_num=parseInt(total_page_num);
    var total_page=getpage(total_page_num+1);
    current_page_handle(go_page,total_page,total_page_num);
    $(".go_page").val("");

}

//奖励佣金和金币关系 督查赚
function  calcu3(){
    $("#conven_saleCommission3").val($("#conven_taskProduct3").val());
    tasktotalandcomm();
}

//任务总数和总佣金数
function  tasktotalandcomm(){
    var  num=$("#conven_taskProduct3").val()*2*$("#conven_taskBrand3").val();
    $("#conven_totalFee3").val(num);
}


//稽查赚稽查内容模板的新增与编辑================================================================

var j=0;
//推广赚 任务模块问题的加载
$('#template3_question_btn').click(function(){
    var list="";
    list+="<div class='taskAdd_template_questionList'  id='question3_list_"+(j+1)+"'>";
    list+="<div class='taskAdd_template_question' style='margin-top:10px'>";
    list+="问：<input type='text' name='conventionDataInput'  class='taskAdd_conventionDataInput' style='width:500px'/>";
    list+="<span style='color:#14bce1;cursor:pointer;margin-left:20px;'  onclick='taskAdd_template_questionList_delete3("+(j+1)+",0)'>删除</span>";
    list+="</div>";
    list+="<div  class='taskAdd_template_answer' style='margin-left:0px;'>";
    list+="答：<select class='template_answer_selected' name='template_answer_selected' id='template3_answer_selected_"+(j+1)+"' onchange='changeoption3(this.value,"+(j+1)+")'>";
    list+="<option  value='0' selected>请选择</option>";
    list+="<option  value='1'>单选</option>";
    list+="<option  value='2'>多选</option>";
    list+="<option  value='3'>文本</option>";
    list+="<option  value='4'>图片</option>";
    list+="</select>";
    list+="</div>";
    list+="<input type='hidden' id='audit_f_stdindex"+(j+1)+"' name='f_stdindex' value=''>"
    list+="</div>";
    $('.taskAdd_template_questionList3').append(list);
    j++;

});

function changeoption3(optionValue,i){
    $('#template3_answer_selected_'+i+'').nextAll('input').remove();
    $('#template3_answer_selected_'+i+'').next('button').remove();
    var k = 0;
    if (optionValue == '2' || optionValue == '1') {
        var list = "";
        var listInput= "<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput' />";
        var listbtn = "<button type='button' class='taskAdd_btn'  id='template3_question_btn"+i+"'>+</button>";
            list=listInput+listbtn;
        $('#template3_answer_selected_'+i+'').after(list);
        $('#template3_question_btn'+i+'').click(function () {
            var list = "";
            var btn="";
            var input="<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput'/>";
            if($("#typetaskid").val()==0){
                btn="<input type='button' class='taskAdd_answer_input' onclick='delte_input3("+k+","+i+")' id='delte3_input_"+k+i+"' value='删除'/>";
            }else{
                btn="<input type='button' class='taskAdd_answer_input' onclick='delte_input3("+(k+1)+","+i+")' id='delte3_input_"+(k+1)+i+"' value='删除'/>";
            }
                list=input+btn;

            $('#template3_question_btn'+i+'').before(list);
            k++;
        });
    }

}

function addAnswer3(i,k){
    k++;
    var list="";
    var inputs="<input type='text'  class='taskAdd_conventionDataInput  taskAdd_template_answerInput'/>";
    var del="<input type='button' class='taskAdd_answer_input' onclick='delte_input("+k+","+i+")' id='delte3_input_"+k+i+"' value='删除'/>";
    list=inputs+del;
    $('#template3_question_btn'+i+'').before(list);
    $("#delte3_input_"+k+i).next().remove();
    $("#delte3_input_"+k+i).after("<button type='button' class='taskAdd_btn question_btn_add' id='template3_question_btn"+i+"' value='"+i+"' onclick='addAnswer3("+i+","+k+")'>+</button>");
}

function addQuestion3(k){
    var a = $("#detailCount3").val();
    $("#detailCount3").attr("value",(parseInt(a)+parseInt(1)));
    var count = $("#detailCount3").val();
    var list="";
    list+="<div class='taskAdd_template_questionList'  id='question3_list_"+(count-1)+"'>";
    list+="<div class='taskAdd_template_question' style='margin-top:10px'>";
    list+="问：<input type='text' name='conventionDataInput'  class='taskAdd_conventionDataInput' style='width:500px'/>";
    list+="<span style='color:#14bce1;cursor:pointer;margin-left:20px;'  onclick='taskAdd_template_questionList_delete("+(count-1)+",0)'>删除</span>";
    list+="</div>";
    list+="<div  class='taskAdd_template_answer'>";
    list+="答：<select class='template_answer_selected' name='template_answer_selected' id='template3_answer_selected_"+(count-1)+"' onchange='changeoption3(this.value,"+(count-1)+")'>";
    list+="<option  value='0' selected>请选择</option>";
    list+="<option  value='1'>单选</option>";
    list+="<option  value='2'>多选</option>";
    list+="<option  value='3'>文本</option>";
    list+="<option  value='4'>图片</option>";
    list+="</select>";
    list+="</div>";
    list+="<input type='hidden' id='audit_f_stdindex"+(count-1)+"' name='f_stdindex' value=''>"
    list+="</div>";
    $('.taskAdd_template_questionList3').append(list);
    k++;
}

//稽查赚中任务模块多选中iuput的删除
function  delte_input3(k,i){
    if($("#typetaskid")==0){
        $('#delte3_input_'+i+k).prev().remove();
        $('#delte3_input_'+i+k).remove();
    }else{
        $('#delte3_input_'+k+i).prev().remove();
        $('#delte3_input_'+k+i).remove();
    }
}

function getlngandlat(obj){
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint(obj.value, function(point){
        if (point) {
            //经度
            var longitude=$(obj).parents("tr").find("input[name=longitude]").val(point.lng);
            var latitude=$(obj).parents("tr").find("input[name=latitude]").val(point.lat);
        }else{
            alert("您选择地址没有解析到结果!");
        }
    });
}


//删除稽核任务模块

function  taskAdd_template_questionList_delete3(i,indexid){
    $('#question3_list_'+i+'').remove();
    if(indexid!==0){
        $.post(APP+"/Api/Web/delteanswer/","indexid="+indexid,function(rel){
        },"json");
    }
}





