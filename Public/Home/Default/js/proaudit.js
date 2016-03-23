/**
 * Created by Administrator on 2016/1/5.
 */
//稽查赚中的操作
//已审核
$("#hasAudit_audit").on("click",function(){
    var id=$("#audit_list_title_earn").val();
    getauditlist(id,3);
});
//待审核
$("#pendverf_aduit").on("click",function(){
    var id2=$("#audit_list_title_earn").val();
    getauditlist(id2,1);
});


//根据任务标题选择
$('input[name=all_trackAudit_earn_audit]').removeAttr('checked');

function getauditlist(titleID,utask_status){
    var utask_status=arguments[1]?arguments[1]:1;
    if(titleID==0){
        layer.msg("请选择需要查询的任务标题",{icon:8});
        $("#trackAudit_earn_audit").empty();
        $("#trackAudit_earnpagebar_audit").empty();
        Cookie.eraseCookie("trackauditID");
        Cookie.createCookie("trackauditID",0);
        return false;
    }
    Cookie.eraseCookie("trackauditID");
    Cookie.createCookie("trackauditID",titleID);
    Cookie.createCookie("utask_status_audit",utask_status);
    $('input[name=all_trackAudit_earn_audit]').removeAttr('checked');
    listData(APP+"/Api/Web/get_track_auditlist","companyid="+cid+"&taskid="+titleID+"&utask_status="+utask_status,"post","json",7);

}

$(function(){
    $(document).on('click','#trackAudit_earnpagebar_audit span a',function(){
        var tid1=Cookie.readCookie("trackauditID");
        var utask_status=Cookie.readCookie("utask_status_audit");
        var rel = $(this).attr("rel");
        listData(APP+"/Api/Web/get_track_auditlist","companyid="+cid+"&taskid="+tid1+"&page="+rel+"&utask_status="+utask_status,"get","json",7);
    });
});


//督查赚审核通过
$('#readyThrough_audit').on('click',function(){
    var checked=$('input[name="audit_earn_grid"]:checked');
    var tid=Cookie.readCookie("trackauditID");
    var checklist=[];
    var userid=[];
    checked.each(function(){
        checklist.push($(this).val());
        userid.push($(this).attr("data-userid"));
    });
    if(tid==0){
        layer.msg("请选择任务或暂时没任务",{icon:8});
    }else if(checklist=="" || checklist==null){
        layer.msg("请选择审核对象",{icon:8});
    }else{
        layer.confirm('确定审核?',{
            btn:['确定','取消'],
            shade:false
        },function(){
            layer.closeAll();
            $.post(APP+'/Api/Web/trackearn_shenhe','checklist='+checklist+'&tid='+tid,function(val){
                if(val.error_code=='true'){
                    //alert("==============");
                    $('input[name="all_trackAudit_earn_audit"]:checked').removeAttr('checked');
                    $('input[name="audit_earn_grid"]:checked').removeAttr('checked');
                    //rel=$("#trackAudit_earnpagebar_audit span a").attr("rel");
                    layer.msg('审核成功,点击已审核查看',{icon:9});
                    for(var $i=0;$i<userid.length;$i++){
                        $("#audit_earn_grid_"+userid[$i]).parent().siblings().parent().remove();
                    }
                    if($("#trackAudit_earn ul").length==0){
                        getauditlist(tid,1);
                    }
                    if(val.error_code=='false'){
                        layer.msg("已审核",{icon:8});
                        $('input[name="all_trackAudit_earn_audit"]:checked').removeAttr('checked');
                        $('input[name="audit_earn_grid"]:checked').removeAttr('checked');
                    }
                }
            },"json");
        },function(){
            layer.msg('请在核实后再审核',{shift:6});
            $('input[name="all_trackAudit_earn_audit"]:checked').removeAttr('checked');
            $('input[name="audit_earn_grid"]:checked').removeAttr('checked');
        });

    }
});



//督查赚驳回
$("#back_audit").on("click",function(){
    var checked=$('input[name="audit_earn_grid"]:checked');
    var tid=Cookie.readCookie("trackauditID");
    var checklist=[];
    checked.each(function(){
        checklist.push($(this).val());
    });
    if(tid==0){
        layer.msg("请选择任务或暂时没任务",{icon:8});
    }else if(checklist=="" || checklist==null){
        layer.msg("请选择驳回对象",{icon:8});
    }else{
        layer.confirm('确定驳回?',{
            btn:['确定','取消'],
            shade:false
        },function(){
            layer.closeAll();
            index = layer.open({
                title: '驳回理由',
                type: 2,
                area: ['600px', '400px'],
                content: APP + '/Home/Business/reject?checklist='+checklist+'&tid='+tid
            });
//
        },function(){
            layer.msg('请在核实后再驳回',{shift:6});
            $('input[name="all_trackAudit_earn_audit"]:checked').removeAttr('checked');
            $('input[name="audit_earn_grid"]:checked').removeAttr('checked');
        });

    }




});

