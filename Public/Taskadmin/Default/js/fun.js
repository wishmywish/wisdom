;!function(){

    //上传图标
//    $('#upfile').change(function(){
//        //alert($(this).val());
//        $('#uplogo').ajaxSubmit({
//            dataType:  'json', //数据格式为json 
//            beforeSend: function() { //开始上传 
//                $('.show_img').empty(); //清空显示的图片 
//                $('.progress_up').show(); //显示进度条 
//                $('.show_progress_no').show();
//                var percentVal = '0%'; //开始进度为0% 
//                $('.bar').width(percentVal); //进度条的宽度 
//                $('.show_progress_no').html(percentVal); //显示进度为0%
//                $('#btn_up').html("上传中..."); //上传按钮显示上传中
//            }, 
//            uploadProgress: function(event, position, total, percentComplete) { 
//                var percentVal = percentComplete + '%'; //获得进度
//                $('.bar').width(percentVal); //上传进度条宽度变宽 
//                $('.show_progress_no').html(percentVal); //显示上传进度百分比
//            },
//            success: function(data) { //成功 
//                //获得后台返回的json数据，显示文件名，大小，以及删除按钮
//                //files.html("<b>"+data.name+"("+data.size+"k)</b>  <span class='delimg' rel='"+data.pic+"'>删除</span>"); 
//                //显示上传后的图片
//                var img = UPFILE+"/"+data.upfile.savepath+data.upfile.savename;
//                $('.show_img').html("<a href='"+img+" target='_blank'><img src='"+img+"' width=50 height=50></a>");
//                $('#fileid').val(data.fileid);
//                //console.log(data);
//                $('#btn_up').html("上传图标"); //上传按钮还原
//            }, 
//            error:function(xhr){ //上传失败
//                $('#btn_up').html("上传失败");
//                $('.bar').width('0');
//                //files.html(xhr.responseText); //返回失败信息 
//            }
//        });
//    });
    //上传文件
//    $('#upfile_pack').change(function(){
//        //alert($(this).val());
//        $('#upfile_up').ajaxSubmit({
//            dataType:  'json', //数据格式为json 
//            beforeSend: function() { //开始上传 
//                //$('.show_img').empty(); //清空显示的图片 
//                $('.progress_up_pack').show(); //显示进度条 
//                $('.show_progress_no_pack').show();
//                var percentVal = '0%'; //开始进度为0% 
//                $('.bar_pack').width(percentVal); //进度条的宽度 
//                $('.show_progress_no_pack').html(percentVal); //显示进度为0%
//                $('#btn_up_pack').html("上传中..."); //上传按钮显示上传中
//            }, 
//            uploadProgress: function(event, position, total, percentComplete) { 
//                var percentVal = percentComplete + '%'; //获得进度
//                $('.bar_pack').width(percentVal); //上传进度条宽度变宽 
//                $('.show_progress_no_pack').html(percentVal); //显示上传进度百分比
//            },
//            success: function(data) { //成功 
//                //获得后台返回的json数据，显示文件名，大小，以及删除按钮
//                //$('.show_img_pack').html("<b>"+data.name+"("+data.size+"k)</b>  <span class='delimg' rel='"+data.pic+"'>删除</span>"); 
//                //显示上传后的图片
//                //var img = UPFILE+"/"+data.upfile.savepath+data.upfile.savename;
//                //$('.show_img_pack').html("<a href='"+img+" target='_blank'><img src='"+img+"' width=50 height=50></a>");
//                $('#fileid_pack').val(data.fileid);
//                //console.log(data);
//                $('#btn_up_pack').html("上传文件"); //上传按钮还原
//            }, 
//            error:function(xhr){ //上传失败
//                $('#btn_up_pack').html("上传失败");
//                $('.bar_pack').width('0');
//                //files.html(xhr.responseText); //返回失败信息 
//            }
//        });
//    });

    //上传任务图标
    $('#upfile').change(function(){
        //alert(1);
        $("#showPic").hide();
        ajaxSub('#uplogo','#progress_up','#show_progress_no','#bar','#show_img','#btn_up','#fileid','img');
    });
    
    //上传任务banner
    $('#upfile_ban').change(function(){
        $("#showBan").hide();
        ajaxSub('#uplogo_ban','#progress_up_ban','#show_progress_no_ban','#bar_ban','#show_img_ban','#btn_ban','#fileid_ban','img');
    });
    
    //上传包装
    $('#upfile_pack').change(function(){
        ajaxSub('#upfile_up','#progress_up_pack','#show_progress_no_pack','#bar_pack','#show_img_pack','#btn_up_pack','#fileid_pack','file');
    });
    
    //宣传资料
    $('#upfile_propaganda').change(function(){
        ajaxSub('#upfile_up_propaganda','#progress_up_propaganda','#show_progress_no_propaganda','#bar_propaganda','#show_img_propaganda','#btn_up_propaganda','#fileid_propaganda','file');
    });
    
    //合格证书
    $('#upfile_certificate').change(function(){
        ajaxSub('#upfile_up_certificate','#progress_up_certificate','#show_progress_no_certificate','#bar_certificate','#show_img_certificate','#btn_up_certificate','#fileid_certificate','file');
    });
    
    //销售政策
    $('#upfile_policy').change(function(){
        ajaxSub('#upfile_up_policy','#progress_up_policy','#show_progress_no_policy','#bar_policy','#show_img_policy','#btn_up_policy','#fileid_policy','file');
    });
    
    //产品价格
    $('#upfile_price').change(function(){
        ajaxSub('#upfile_up_price','#progress_up_price','#show_progress_no_price','#bar_price','#show_img_price','#btn_up_price','#fileid_price','file');
    });

    //智慧招商服务合同结算清协议
    $('#upfile_contract').change(function(){
        ajaxSub('#upfile_up_contract','#progress_up_contract','#show_progress_no_contract','#bar_contract','#show_img_contract','#btn_up_contract','#fileid_contract','file');
    });
    
    //其他
    $('#upfile_other').change(function(){
        ajaxSub('#upfile_up_other','#progress_up_other','#show_progress_no_other','#bar_other','#show_img_other','#btn_up_other','#fileid_other','file');
    });

    //其他
    $('#upfile_weishen').change(function(){
        ajaxSub('#upfile_up_weishen','#progress_up_weishen','#show_progress_no_weishen','#bar_weishen','#show_img_weishen','#btn_up_weishen','#fileid_weishen','file');
    });

}();

function ajaxSub(submitkey,progresskey,progressnokey,barkey,showkey,btnkey,hiddenkey,filetype){
   // alert(2);
    $(submitkey).ajaxSubmit({
        dataType:  'json', //数据格式为json 
        beforeSend: function() { //开始上传 
            //$('.show_img').empty(); //清空显示的图片 
            $(progresskey).show(); //显示进度条 
            $(progressnokey).show();
            var percentVal = '0%'; //开始进度为0% 
            $(barkey).width(percentVal); //进度条的宽度 
            $(progressnokey).html(percentVal); //显示进度为0%
            $(btnkey).html("上传中..."); //上传按钮显示上传中
        }, 
        uploadProgress: function(event, position, total, percentComplete) { 
            var percentVal = percentComplete + '%'; //获得进度
            $(barkey).width(percentVal); //上传进度条宽度变宽 
            $(progressnokey).html(percentVal); //显示上传进度百分比
        },
        success: function(data) { //成功
            console.log(data);
            if(data.error_no==='999999'){
                $(btnkey).html("上传失败");
                $(barkey).width('0');
                $(progressnokey).html('0%'); //显示上传进度百分比
            }else if(data.error_no==='654321'){
                $(btnkey).html("文件格式不符合要求,上传失败");
                $(barkey).width('0');
                $(progressnokey).html('0%'); //显示上传进度百分比
            }else if(data.error_no==='123456'){
                $(btnkey).html("文件过大,上传失败");
                $(barkey).width('0');
                $(progressnokey).html('0%'); //显示上传进度百分比
            }else{
                if(filetype==='file'){

                }else if(filetype==='img'){
                    //显示上传后的图片
                    var img = UPFILE+"/"+data.upfile.savepath+data.upfile.savename;
                    $(showkey).html("<a href='"+img+" target='_blank'><img src='"+img+"' width='50' height='50'></a>");
                }
                //获得后台返回的json数据，显示文件名，大小，以及删除按钮
                //$('.show_img_pack').html("<b>"+data.name+"("+data.size+"k)</b>  <span class='delimg' rel='"+data.pic+"'>删除</span>"); 

                $(hiddenkey).val(data.fileid);
                //console.log(data);
                $(btnkey).html("上传"); //上传按钮还原
            }
        }, 
        error:function(xhr){ //上传失败
            $(btnkey).html("上传失败");
            $(barkey).width('0');
            //files.html(xhr.responseText); //返回失败信息 
        }
    });
}

//删除任务
$('#del').on('click',function(){
    isauthority('100','c');
    if(accessVal) {
        layer.confirm('您确认要删除该记录吗？', {
            btn: ['确定', '取消'], //按钮
            shade: false, //不显示遮罩
            icon: 3,
            title: '删除提示'
        }, function (index) {

            layer.close(index);

            var taskid_arr = "";
            $("input[name='taskid']:checked").each(function () {
                if (taskid_arr === "") {
                    taskid_arr += $(this).val();
                } else {
                    taskid_arr += "|" + $(this).val();
                }
            });
            if (taskid_arr === "") {
                layer.msg("请选择要删除的记录", {'icon': 8});
                return false;
            } else {
                $.post(APP + "/Api/Web/delTask", "taskids=" + taskid_arr, function (v) {
                    // console.log(v);
                    // console.log(v.result);
                    if (v.result === '000000') {
                        //alert($('#del').val());
                        plist($('#del').val());
                    } else {
                        layer.msg('删除失败', {'icon': 8});
                        return false;
                    }
                }, 'json');
            }


        }, function (index) {
            layer.close(index);
            return false;
        });
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
    
    
});

//任务延时
$('#delayed').on('click',function(){
    isauthority('100','f');
    if(accessVal){
        var taskid = $("input[name='taskid']:checked");

        if (taskid.length === 0) {
            layer.msg("请选择要修改的记录", {'icon': 8});
            return false;
        } else if (taskid.length > 1) {
            layer.msg("只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        }else{
            index = layer.open({
                title: '任务延时',
                type: 2,
                area: ['600px', '400px'],
                content: APP + '/Taskadmin/Task/taskDelay?taskid=' + taskid.val()
            });
        }
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
});

//任务延时确定
$('#delayBtn').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskid = $("#taskid").val();
    var newenddate = $("#newenddate").val();
    $.post(APP+"/Api/web/getDelayConfirm",
    "taskid="+taskid+"&newenddate="+newenddate,
    function(data){
        parent.location.reload();
        parent.layer.close(index);
    },"json");
});

//更新排序
$('#update').on('click',function(){
    isauthority('100','g');
    if(accessVal){
        var taskid = $("input[name='taskid']:checked");
        if (taskid.length === 0) {
            layer.msg("请选择要修改的记录", {'icon': 8});
            return false;
        } else if (taskid.length > 1) {
            layer.msg("只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        }else{
            $.post(APP+"/Api/web/getUpdateConfirm",
            "taskid="+taskid.val(),
            function(data){
                layer.msg("更新成功", {'icon': 9});
                // location.reload();
            },"json");
        }
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
});

//修改记录
$('#modi').on('click',function(){
    isauthority('100','b');
    if(accessVal) {
        var taskid = $("input[name='taskid']:checked");
        var id = "business" + taskid.val();
        var tasktypeid = $("#" + id + "").val();

        var status = "status" + taskid.val();
        var statusid = $("#" + status + "").val();

        var user = "user" + taskid.val();
        var userId = $("#" + user + "").val();
        if (taskid.length === 0) {
            layer.msg("请选择要修改的记录", {'icon': 8});
            return false;
        } else if (taskid.length > 1) {
            layer.msg("修改只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        //} else if (userId != 0 && statusid != 6 && statusid != '6' && statusid != 5 && statusid != '5' && statusid != 2 && statusid != '2') {
        //    layer.msg("只有待提交,待审核或者驳回的任务才能修改", {'icon': 8});
        //    return false;
        //} else if (userId == 0 && statusid != 6 && statusid != '6' && statusid != 5 && statusid != '5') {
        //    layer.msg("只有待提交或者驳回的任务才能修改", {'icon': 8});
        //    return false;
        } else {
            var v = $("#modi").val();
            var index;
            switch (tasktypeid) {
                case "3":
                    index = layer.open({
                        title: '修改任务',
                        type: 2,
                        area: ['1000px', '600px'],
                        content: APP + '/Taskadmin/Task/add_business?taskid=' + taskid.val() + "&tasktypeid=3"
                    });
                    break;
                case "1":
                    index = layer.open({
                        title: '修改任务',
                        type: 2,
                        area: ['1000px', '600px'],
                        content: APP + '/Taskadmin/Task/add_push?taskid=' + taskid.val() + "&tasktypeid=1"
                    });
                    break;
                case "2":
                    index = layer.open({
                        title: '修改任务',
                        type: 2,
                        area: ['1000px', '600px'],
                        content: APP + '/Taskadmin/Task/add_widely?taskid=' + taskid.val() + "&tasktypeid=2"
                    });
                    break;
                case "7":
                    index = layer.open({
                        title: '修改任务',
                        type: 2,
                        area: ['1000px', '600px'],
                        content: APP + '/Taskadmin/Task/add_check?taskid=' + taskid.val() + "&tasktypeid=7"
                    });
                    break;
                default:
                    index = layer.open({
                        title: '修改任务',
                        type: 2,
                        area: ['1000px', '600px'],
                        content: APP + '/Taskadmin/Task/add_widely?taskid=' + taskid.val() + '&tasktypeid=' + tasktypeid
                    });
                    break;
            }

        }
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
});

//驳回任务
$('#reject').on('click',function(){
    isauthority("100",'e');
    if(accessVal) {
        var taskid = $("input[name='taskid']:checked");
        var status = "status" + taskid.val();
        var statusid = $("#" + status + "").val();

        if (taskid.length === 0) {
            layer.msg("请选择要修改的记录", {'icon': 8});
            return false;
        } else if (taskid.length > 1) {
            layer.msg("驳回只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        } else if (statusid !== 2 && statusid !== '2' && statusid !== 7 && statusid !== '7' ) {
            layer.msg("只有待审核的任务才能驳回", {'icon': 8});
            return false;
        } else {
            var v = taskid[0].value;
            var index;
            index = layer.open({
                title: '驳回任务',
                type: 2,
                area: ['600px', '400px'],
                content: APP + '/Taskadmin/Task/reject?taskid=' + v
            });


        }
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
});

//确定驳回
$('#rejectBtn').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskid = $("#taskid").val();
    var reason = $("#reason").val();

    if(reason==""){
        layer.msg('请填写理由', {icon: 8});
        return false;
    }

    if (reason !="") {
        var loadi = layer.load(0);
    };

    $.post(APP+"/Api/web/getRejectTask",
    "taskid="+taskid+"&reason="+reason,
    function(data){
        layer.close(loadi);
        parent.location.reload();
        parent.layer.close(index);
    },"json");

});

//客服审核
$('#review').on('click',function(){
    isauthority("100",'d');
    if(accessVal) {
        var taskid = $("input[name='taskid']:checked");
        var status = "status" + taskid.val();
        var statusid = $("#" + status + "").val();

        if (taskid.length === 0) {
            layer.msg("请选择要修改的记录", {'icon': 8});
            return false;
        } else if (taskid.length > 1) {
            layer.msg("客服审核只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        } else if (statusid !== 2 && statusid !== '2') {
            layer.msg("只有待客服审核的任务才能客服审核", {'icon': 8});
            return false;
        } else {
            var v = taskid[0].value;
            var index;
            index = layer.open({
                title: '客服审核',
                type: 2,
                area: ['600px', '400px'],
                content: APP + '/Taskadmin/Task/review?taskid=' + v
            });

        }
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
});

//客服审核通过
$('#okReviewBtn').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskid = $("#taskid").val();
    var reason = $("#reason").val();

    if(reason==""){
        layer.msg('请填写理由', {icon: 8});
        return false;
    }

    if (reason !="") {
        var loadi = layer.load(0);
    };

    $.post(APP+"/Api/web/reviewTask",
    "taskid="+taskid+"&reason="+reason,
    function(data){
        layer.close(loadi);
        parent.location.reload();
        parent.layer.close(index);
    },"json");

});

//客服审核不通过
$('#noReviewBtn').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskid = $("#taskid").val();
    var reason = $("#reason").val();

    if(reason==""){
        layer.msg('请填写理由', {icon: 8});
        return false;
    }

    if (reason !="") {
        var loadi = layer.load(0);
    };

    $.post(APP+"/Api/web/reviewTaskNo",
    "taskid="+taskid+"&reason="+reason,
    function(data){
        layer.close(loadi);
        parent.location.reload();
        parent.layer.close(index);
    },"json");

});

//财务审核
$('#cw_review').on('click',function(){
    isauthority("100",'h');
    if(accessVal) {
        var taskid = $("input[name='taskid']:checked");
        var status = "status" + taskid.val();
        var statusid = $("#" + status + "").val();

        if (taskid.length === 0) {
            layer.msg("请选择要修改的记录", {'icon': 8});
            return false;
        } else if (taskid.length > 1) {
            layer.msg("财务审核只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        } else if (statusid !== 7 && statusid !== '7') {
            layer.msg("只有待财务审核的任务才能财务审核", {'icon': 8});
            return false;
        } else {
            var v = taskid[0].value;
            var index;
            index = layer.open({
                title: '财务审核',
                type: 2,
                area: ['600px', '400px'],
                content: APP + '/Taskadmin/Task/cwReview?taskid=' + v
            });

        }
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
});

//财务审核通过
$('#cwReviewBtn').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskid = $("#taskid").val();
    var reason = $("#reason").val();

    if(reason==""){
        layer.msg('请填写理由', {icon: 8});
        return false;
    }

    if (reason !="") {
        var loadi = layer.load(0);
    };

    $.post(APP+"/Api/web/cwReviewTask",
    "taskid="+taskid+"&reason="+reason,
    function(data){
        layer.close(loadi);
        parent.location.reload();
        parent.layer.close(index);
    },"json");

});

//财务审核不通过
$('#noCwReviewBtn').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskid = $("#taskid").val();
    var reason = $("#reason").val();

    if(reason==""){
        layer.msg('请填写理由', {icon: 8});
        return false;
    }

    if (reason !="") {
        var loadi = layer.load(0);
    };
    
    $.post(APP+"/Api/web/cwReviewTaskNo",
    "taskid="+taskid+"&reason="+reason,
    function(data){
        layer.close(loadi);
        parent.location.reload();
        parent.layer.close(index);
    },"json");

});


//任务下架
$('#undercarriage').on('click',function(){
    // isauthority('100','i');
    // if(accessVal) {
    var taskid = $("input[name='taskid']:checked");
    var status = "status" + taskid.val();
    var statusid = $("#" + status + "").val();
    if (taskid.length==0) {
        layer.msg("请选择要下架的记录", {'icon': 8});
        return false;
    }else if (taskid.length > 1) {
            layer.msg("下架只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
    }else if (statusid == 11 && statusid == '11') {
            layer.msg("该任务已经下架", {'icon': 8});
            return false;
    } else {
        var v = taskid[0].value;
        var index;
        index = layer.open({
            title: '任务下架',
            type: 2,
            area: ['600px', '400px'],
            content: APP + '/Taskadmin/Task/underCarriage?taskid=' + v
        });
    }

    // }else{
        // layer.msg("你无权使用此功能，如需帮助联系管理员");
        // return false;
    // }
});



//任务下架确认
$('#underCarriageBtn').on('click',function(){
    // isauthority('100','i');
    // if(accessVal) {
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskid = $("#taskid").val();
    console.log(taskid);
    var undercarriage_reason = $("#undercarriage_reason").val();

    if(undercarriage_reason==""){
        layer.msg('请填写理由', {icon: 8});
        return false;
    }

    if (undercarriage_reason !="") {
        var loadi = layer.load(0);
    };

    $.post(APP+"/Api/web/undercarriageTask",
    "taskid="+taskid+"&undercarriage_reason="+undercarriage_reason,
    function(data){
        layer.close(loadi);
        parent.location.reload();
        parent.layer.close(index);
    },"json");

    // }else{
        // layer.msg("你无权使用此功能，如需帮助联系管理员");
        // return false;
    // }
});

//设置首页
$('#setHome').on('click',function(){
    // isauthority('100','j');
    // if(accessVal) {
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        var taskid=$("input[name='taskid']:checked");
        var homeCount=$("#homeCount").val();
        if (parseInt(taskid.length)+parseInt(homeCount)>10) {
            layer.msg('首页任务超过10条，请重选', {'icon': 8});
            return false;
        }else{
            var taskid_arr = "";
            taskid.each(function () {
                var status = "status" + $(this).val();
                var statusid = $("#" + status + "").val();
                if (statusid ==3 && statusid =='3'){
                    if (taskid_arr === "") {
                        taskid_arr += $(this).val();
                    } else {
                        taskid_arr += "|" + $(this).val();
                    }
                }
            });

            if (taskid_arr === "") {
                layer.msg("已发布任务才能设置首页显示,请选择", {'icon': 8});
                return false;
            } else {
                $.post(APP + "/Api/Web/setHomeTask", "taskids=" + taskid_arr, function (v) {
                    if (v.result === '000000') {
                        parent.location.reload();
                        parent.layer.close(index);
                    } else {
                        layer.msg('设置首页失败', {'icon': 8});
                    }
                }, 'json');
            }
        }
       
    // }else{
    //     layer.msg("你无权使用此功能，如需帮助联系管理员");
    //     return false;
    // }
});
//取消首页
$('#unSetHome').on('click',function(){
    // isauthority('100','k');
    // if(accessVal) {
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        var taskid=$("input[name='taskid']:checked");
        var taskid_arr = "";
        taskid.each(function () {
            if (taskid_arr === "") {
                taskid_arr += $(this).val();
            } else {
                taskid_arr += "|" + $(this).val();
            }
        });
        if (taskid_arr === "") {
            layer.msg("请选择要取消首页的记录", {'icon': 8});
            return false;
        } else {
            $.post(APP + "/Api/Web/unSetHomeTask", "taskids=" + taskid_arr, function (v) {
                if (v.result === '000000') {
                    parent.location.reload();
                    parent.layer.close(index);
                } else {
                    layer.msg('取消首页失败', {'icon': 8});
                }
            }, 'json');
        }
        
    // }else{
    //     layer.msg("你无权使用此功能，如需帮助联系管理员");
    //     return false;
    // }
});
//任务状态理由
function turnToReject(taskid)
{
    //var tid = obj.children[0].children[0].value ;
    var index;
    // console.log(taskid);
    index = layer.open({
        title: '任务状态理由',
        type: 2,
        skin:'layui-layer-rim',
        area:['560px','400px'],
        fix:true,
        move: false,
        offset:'100px',
        content: APP+'/Taskadmin/Task/showProReject?taskid='+taskid
    });
}

//任务管理加载数据
function plist(tasktypeid){
    getPageList(APP+"/Api/Web/getTaskList?tasktypeid="+tasktypeid+"&companyid=0","page=1","business",APP+"/Api/Web/getToalPage?tasktypeid="+tasktypeid+"&companyid=0");
}

//任务审核加载数据
function plist_dealer(taskid,state){
    getPageList(APP+"/Api/Web/getDealerList?taskid="+taskid+"&state="+state,"page=1","dealer",APP+"/Api/Web/getDealerListNo?taskid="+taskid+"&state="+state);
}

//业务员加载数据
function plist_Sales(companyid,tabType){
    if(!arguments[1]) tabType = 0;
    getPageList(APP+"/Api/Web/getSalesList?companyid="+companyid+"&tabType="+tabType,"page=1","sales",APP+"/Api/Web/getSalesListNo?companyid="+companyid+"&tabType="+tabType);
}

//业务员加载数据
function plist_FSales(tabType,searchterm,talkType,searchindustrytype){
    if(!arguments[0]) tabType = 0;
    if(!arguments[1]) searchterm = 0;
    if(!arguments[2]) talkType = 0;
    getPageList(APP+"/Api/Web/getFSalesList?tabType="+tabType+"&searchterm="+searchterm+"&talkType="+talkType+"&searchindustrytype="+searchindustrytype,"page=1","Fsales",APP+"/Api/Web/getFSalesListNo?tabType="+tabType+"&searchterm="+searchterm+"&talkType="+talkType+"&searchindustrytype="+searchindustrytype);
}

//企业加载数据
function plist_Company(){
    getPageList(APP+"/Api/Web/getCompanyList","page=1","company",APP+"/Api/Web/getCompanyListNo");
}

//所有企业加载数据
function plist_AllCompany(state){
    getPageList(APP+"/Api/Web/getAllCompanyList?state="+state,"page=1","allcompany",APP+"/Api/Web/getAllCompanyListNo?state="+state);
}

//已发布任务加载数据
function plist_publish(){
    getPageList(APP+"/Api/Web/getPublishTask","page=1","pubTask",APP+"/Api/Web/getPublishPage",'page2');
}

//活动与广告加载数据
function plist_Activity(tabType){
    getPageList(APP+"/Api/Web/getActivity?tabType="+tabType,"page=1","activity",APP+"/Api/Web/getActivityPage?tabType="+tabType);
    $("#ad_del").attr("value",tabType);
    $("#ad_modi").attr("value",tabType);
}

//提现数据
function plist_Withdraw(label,strats){
    getPageList(APP+"/Taskadmin/Fun/getWithdrawList?label="+label+"&strats="+strats,"page=1","withdraw",APP+"/Taskadmin/Fun/getWithdrawListNo?label="+label+"&strats="+strats);
}

//招商进程数据
function plist_dealerPro(tabType,order){
    if(!arguments[0]) tabType = 0;
    if(!arguments[1]) order = '';
    getPageList(APP+"/Api/Web/getDealerProList?tabType="+tabType+"&order="+order,"page=1","dealerpro",APP+"/Api/Web/getDealerProListNo?tabType="+tabType+"&order="+order);
}

//产品数据
function plist_shop(tabType){
    if(!arguments[0]) tabType = 0;
    getPageList(APP+"/Api/Web/getShopList?tabType="+tabType,"page=1","shops",APP+"/Api/Web/getShopListNo?tabType="+tabType);
}

//产品消费数据
function plist_shopRecord(tabType){
    if(!arguments[0]) tabType = 0;
    getPageList(APP+"/Api/Web/getShopRecordList?tabType="+tabType,"page=1","ShopRecord",APP+"/Api/Web/getShopRecordListNo?tabType="+tabType);
}

//用户权限
function plist_user(){
    getPageList(APP+"/Api/Web/getUserList","page=1","users",APP+"/Api/Web/getUserListNo");
}

//角色权限
function plist_access(){
    getPageList(APP+"/Api/Web/getRolesList","page=1","roles",APP+"/Api/Web/getRolesListNo");
}

//权限管理
function plist_manage(){
    getPageList(APP+"/Api/Web/getAccessList","page=1","access",APP+"/Api/Web/getAccessListNo");
}

//经销商searchdealername,searchindustrytype,searcharea,searchstatus
function plist_dealer_list(dealername,industrytype,area,status){
    getPageList(APP+"/Api/Web/getDealer_List?area="+area+"&industrytype="+industrytype+"&dealername="+dealername+"&status="+status,"page=1","dealer_list",APP+"/Api/Web/getDealer_ListNo?area="+area+"&industrytype="+industrytype+"&dealername="+dealername+"&status="+status);
}

//每日推广赚每日分享次数及有效获得金币数统计
function plist_shareNum(startTime,endTime,taskTitle){
    getPageList(APP+"/Api/Web/getShareNum?startTime="+startTime+"&endTime="+endTime+"&taskTitle="+taskTitle,"page=1","shareNum",APP+"/Api/Web/getShareNumNo?startTime="+startTime+"&endTime="+endTime+"&taskTitle="+taskTitle);
}

//每日随手赚每日分享次数及有效获得金币数统计
function plist_widelyShareNum(startTime,endTime,taskTitle){
    getPageList(APP+"/Api/Web/getWidelyShareNum?startTime="+startTime+"&endTime="+endTime+"&taskTitle="+taskTitle,"page=1","widelyShareNum",APP+"/Api/Web/getWidelyShareNumNo?startTime="+startTime+"&endTime="+endTime+"&taskTitle="+taskTitle);
}

//全部任务日分享次数统计
function plist_allTaskShare(startTime,endTime,taskTitle){
    getPageList(APP+"/Api/Web/getAllTaskShare?startTime="+startTime+"&endTime="+endTime+"&taskTitle="+taskTitle,"page=1","allTaskShare",APP+"/Api/Web/getAllTaskShareNo?startTime="+startTime+"&endTime="+endTime+"&taskTitle="+taskTitle);
}

//随手赚完成情况统计
function plist_widelyFinish(taskTitle){
    getPageList(APP+"/Api/Web/getWidelyFinish?taskTitle="+taskTitle,"page=1","widelyFinish",APP+"/Api/Web/getWidelyFinishNo?taskTitle="+taskTitle);
}

//用户行为分析
function plist_Behavior(startTime,endTime,type){
    getPageList(APP+"/Api/Web/getBehaviorList?startTime="+startTime+"&endTime="+endTime+"&type="+type,"page=1","behavior",APP+"/Api/Web/getBehaviorPage?startTime="+startTime+"&endTime="+endTime+"&type="+type);
}

//用户行为分析
function plist_Behavior_all(startTime,endTime,type){
    getPageList(APP+"/Api/Web/getBehaviorList?startTime="+startTime+"&endTime="+endTime+"&type="+type,"page=1","allBehavior",APP+"/Api/Web/getBehaviorPage?startTime="+startTime+"&endTime="+endTime+"&type="+type);
}

//用户红包数分析
function plist_redPacket(startTime,endTime){
    getPageList(APP+"/Api/Web/getRedPacketList?startTime="+startTime+"&endTime="+endTime,"page=1","redpacket",APP+"/Api/Web/getRedPacketPage?startTime="+startTime+"&endTime="+endTime);
}

//加载所有招商赚录入未审核经销商信息
function plist_AllDealer(){
    getPageList(APP+"/Api/Web/getAllDealerList","page=1","alldealer",APP+"/Api/Web/getAllDealerListNo");
}

//加载所有随手推荐录入未审核信息
function plist_AllRecommendDealer(){
    getPageList(APP+"/Api/Web/getAllRecommendDealerList","page=1","allRecommenddealer",APP+"/Api/Web/getAllRecommendDealerListNo");
}

//加载所有试用通过审核信息
function plist_Express(){
    getPageList(APP+"/Api/Web/getAllExpressList","page=1","allExpress",APP+"/Api/Web/getAllExpressListNo");
}

//添加任务，根据分类显示
$('#add').on('click',function(){
    //layer.msg(layer.path);
    isauthority('100','a');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var v = $(this).attr('value');
        switch (v) {
            case '0':
                layer.open({
                    title: '新增任务',
                    type: 2,
                    area: ['1000px', '600px'],
                    content: APP + '/Taskadmin/Task/add_business'
                });
                break;
            case '1':
                layer.open({
                    title: '新增任务',
                    type: 2,
                    area: ['1000px', '600px'],
                    content: APP + '/Taskadmin/Task/add_push'
                });
                break;
            case '2':
                layer.open({
                    title: '新增任务',
                    type: 2,
                    area: ['1000px', '600px'],
                    content: APP + '/Taskadmin/Task/add_widely'
                });
                break;
            case '7':
                layer.open({
                    title: '新增任务',
                    type: 2,
                    area: ['1000px', '600px'],
                    content: APP + '/Taskadmin/Task/add_check'
                });
                break;
            default:
                layer.open({
                    title: '新增任务',
                    type: 2,
                    area: ['1000px', '600px'],
                    content: APP + '/Taskadmin/Task/add_business'
                });
                break;
        }
    }
});

function getBigTrade(id){
    if(!arguments[0]) id = "0";
    $.getJSON(APP+"/Taskadmin/Fun/getBigTrade",function(val){
        $('#big').empty();
        var list = "<option value='0'>选择行业大类</option>";
        $.each(val,function(i,v){
            var iflist = function(){
                return v.f_tradeid == id ? "selected" : "";
            };

            list += "<option value='"+v.f_tradeid+"' "+iflist()+" >"+v.f_tradename+"</option>";
        });
        $('#big').append(list);
    });
}

$('#big').on('change',function(){
    $('#tradeid').empty();
    var list = "<option value='0'>选择行业小类</option>";
    if($(this).val()!==0){
        $.getJSON(APP+"/Taskadmin/Fun/getSmallTrade/tradeID/"+$(this).val(),function(val){
            $.each(val,function(i,v){
                list += "<option value='"+v.f_tradeid+"'>"+v.f_tradename+"</option>";
            });
            $('#tradeid').append(list);
        });
    }else{
        $('#tradeid').append(list);
    }
});

//随手赚任务类型
function getTasktype(){
    $.getJSON(APP+"/Taskadmin/Fun/getTasktype",function(val){
        $('#tasktypeid').empty();
        var list = "<option value='0'>选择任务类型</option>";
        $.each(val,function(i,v){
            list += "<option value='"+v.f_typeid+"'>"+v.f_typename+"</option>";
        });
        $('#tasktypeid').append(list);
    });
}

//活动广告TAB调整
$('#tabli_Ad').on('click','li',function(){
    //layer.msg($(this).attr('value'));
    $('#tabli_Ad li').removeClass('selected');
    $(this).attr('class','selected');
    $('#add').attr('value',$(this).attr('value'));
    $('#del').attr('value',$(this).attr('value'));
    $('#modi').attr('value',$(this).attr('value'));
    //加截相应分类数据
    //plist($(this).attr('value'));
});

//提现
$('#tabli_withdraw').on('click','li',function(){
    //layer.msg($(this).attr('value'));
    $('#tabli_withdraw li').removeClass('selected');
    $(this).attr('class','selected');
    $('#pay').attr('value',$(this).attr('value'));
    //$('#del').attr('value',$(this).attr('value'));
    //$('#modi').attr('value',$(this).attr('value'));
    //加截相应分类数据
    plist_Withdraw('withdraw',$(this).attr('value'));
});


//任务管理TAB调整
$('#tabli').on('click','li',function(){
    //layer.msg($(this).attr('value'));
    $('#tabli li').removeClass('selected');
    $(this).attr('class','selected');
    if ($(this).attr('value')==3) {
        $('#setHome').show();
        $('#unSetHome').show();
    }else{
        $('#setHome').hide();
        $('#unSetHome').hide();
    }
    $('#review').attr('value',$(this).attr('value'));
    $('#add').attr('value',$(this).attr('value'));
    $('#del').attr('value',$(this).attr('value'));
    $('#modi').attr('value',$(this).attr('value'));
    //加截相应分类数据
    plist($(this).attr('value'));
});

//任务审核TAB调整
$('#tabli_bid').on('click','li',function(){
    //layer.msg($(this).attr('value'));
    $('#tabli_bid li').removeClass('selected');
    $(this).attr('class','selected');
    $('#bid').attr('value',$(this).attr('value'));
    //加截相应分类数据
    //plist($(this).attr('value'));
});

//权限管理TAB调整
$('#tabli_admin').on('click','li',function(){
    $('#tabli_admin li').removeClass('selected');
    $(this).attr('class','selected');
    $('#access_admin').attr('value',$(this).attr('value'));
    $('#add_admin').attr('value',$(this).attr('value'));
    $('#del_admin').attr('value',$(this).attr('value'));
    $('#modi_admin').attr('value',$(this).attr('value'));
    if($(this).attr('value')==0){
        $(".action").show();
        $("#access_admin").show();
        user_title();
        //加截相应分类数据
        plist_user();
        
    }else if($(this).attr('value')==1){
         $(".action").show();
        access_title();
        //加截相应分类数据
        plist_access();
        $("#access_admin").hide();
    }else{
        powermanage();
        //加截相应分类数据
        plist_manage();
        $(".action").hide();
    }
});

//角色权限
function access_title(){
    $("#list").empty();
    var list="";
    list += "<ul><li style='width:10%;'><input id='allcheck' type='checkbox' value='0'>全选</li>";
    list += "<li style='width:25%;'>角色</li>";
    list += "<li style='width:65%;'>权限值</li></ul>";
    $("#list").append(list);
}
//用户权限
function user_title(){
    $("#list").empty();
    var list="";
    list += "<ul><li style='width:10%;'><input id='allcheck' type='checkbox' value='0'>全选</li>";
    list += "<li style='width:25%;'>用户名</li>";
    list += "<li style='width:25%;'>真实名字</li>";
    list += "<li style='width:20%;'>角色</li>";
    list += "<li style='width:20%;'>状态</li></ul>";
    $("#list").append(list);
}

//权限管理
function powermanage(){
    $("#list").empty();
    var list="";
    list += "<ul><li style='width:10%;'><input id='allcheck' type='checkbox' value='0'>全选</li>";
    list += "<li style='width:30%;'>权限名称</li>";
    list += "<li style='width:30%;'>父级ID</li>";
    list += "<li style='width:30%;'>权限值</li>";
    $("#list").append(list);
}

//加添区域及数量
$('#add_area').click(function(){
    var s_province = $('#s_province').val();
    var s_city = $('#s_city').val()==="地级市"?"":$('#s_city').val();
    var s_county = $('#s_county').val()==="市、县级市"?"":$('#s_county').val();
    var business_sum = parseInt($('#business_sum').val()===""?0:$('#business_sum').val());
    var business_total = parseInt($("#business_total").val());
    if(s_province==="省份"){
        layer.msg('请选择招商省份',{icon:8});
        return false;
    }

    if(business_sum==="" || business_sum<=0){
        layer.msg('招商数量必需填写',{icon:8});
        $('#business_sum').focus();
        return false;
    }
    
    var area = s_province;
    if(s_city!==""){
        area = area+"|"+s_city;
        if(s_county!==""){
            area = area+"|"+s_county;
        }
    }
    
    
    //添加区域
    var data = "{'command':'addArea','area':area,'qty':business_sum,'taskid':Cookie.readCookie('now_taskid')}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.error_code==="success"){
            getArea(v.taskid);
        }
        $('#s_province').val("省份");
        $('#s_city').val('地级市');
        $('#s_county').val('市、县级市');
        $("#business_total").val(business_sum+business_total);
        // business_sum.val('');
    },'json');
});

//获取区域及数量
function getArea(taskid){
    var data = "{'command':'getArea','taskid':taskid}";
    var list = "";
    var sum = 0;
    $('#area_list').empty();
    $.getJSON(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.list!==""){
            $.each(v.list,function(i,val){
                list += "<ul style='width:50%;'>";
                list += "<li style='width:70%;'>"+val.f_area+"</li>";
                list += "<li style='width:10%;text-align:center;'>"+val.f_qty +"</li>";
                list += "<li style='width:20%;text-align:center;color:#ff0000;cursor: pointer;' onclick=delarea("+val.f_indexid+")>删除</li>";
                list += "</ul>";
                sum += parseInt(val.f_qty);
            });
            $('#plan_count').html(v.count);
            Cookie.createCookie('business_count',v.count);
            $('#area_list').append(list);
            $('#area_stats').val(1);//改变状态
            $("#business_total").val(sum);
        }else{
            $('#area_stats').val(0);//改变状态
            $("#business_total").val(0);
        }
    });
}

//删除区域及数量
function delarea(id){
    var data = "{'command':'deteArea','areaId':id}";
    $.getJSON(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.error_code==="success"){
            getArea(Cookie.readCookie('now_taskid'));
        }else{
            layer.msg('删除失败', {icon: 8});
            return false;
        }
    });
}

//加添招商产品明细
$('#add_pro').click(function(){
    var goodsname = $('#goodsname');
    var modle = $('#modle');
    var unit = $('#unit');
    var agencyprice = $('#agencyprice');
    var sellingprice = $('#sellingprice');
    var saleprice = $('#saleprice');
    
    //添加招商产品明细
    var data = "{'command':'addPro','goodsname':goodsname.val(),'modle':modle.val(),'unit':unit.val(),'agencyprice':agencyprice.val(),'sellingprice':sellingprice.val(),'saleprice':saleprice.val(),'taskid':Cookie.readCookie('now_taskid')}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.error_code==="success"){
            getPro(v.taskid);
        }
        goodsname.val('');
        modle.val('');
        unit.val('');
        agencyprice.val('');
        sellingprice.val('');
        saleprice.val('');
    },'json');
});

//获取招商产品明细
function getPro(taskid){
    var data = "{'command':'getPro','taskid':taskid}";
    var list = "";
    $('#pro_list').empty();
    $.getJSON(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.list!==""){
            $.each(v.list,function(i,val){
                list += "<ul style='width:100%;'>";
                list += "<li style='width:30%;'>"+val.f_goodsname+"</li>";
                list += "<li style='width:20%;'>"+val.f_modle+"</li>";
                list += "<li style='width:10%;text-align:center;'>"+val.f_unit+"</li>";
                list += "<li style='width:10%;text-align:center;'>"+val.f_agencyprice+"</li>";
                list += "<li style='width:10%;text-align:center;'>"+val.f_sellingprice+"</li>";
                list += "<li style='width:10%;text-align:center;'>"+val.f_saleprice+"</li>";
                list += "<li style='width:10%;text-align:center;color:#ff0000;cursor: pointer;' onclick=delpro("+val.f_indexid+")>删除</li>";
                list += "</ul>";
            });
            $('#pro_list').append(list);
            $('#pro_stats').val(1);//改变状态
        }else{
            $('#pro_stats').val(0);//改变状态
        }
    });
}

//删除产品明细
function delpro(id){
    var data = "{'command':'detePro','proId':id}";
    $.getJSON(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.error_code==="success"){
            getPro(Cookie.readCookie('now_taskid'));
        }else{
            layer.msg('删除失败', {icon: 8});
            return false;
        }
    });
}


//招商第一步：创建任务
var businessCount1=$('#task_one_count').val();
$('#task_one').click(function(){
    if($('#companyId').val()===""){
        layer.msg('请选择发布企业，没有请先开户', {icon: 8});
        return false;
    }
    if($('#tradeid').val()===0){
        layer.msg('请选择行业', {icon: 8});
        return false;
    }
    if($('#title').val()===""){
        layer.msg('任务标题不能为空', {icon: 8});
        $('#title').focus();
        return false;
    }
    if($('#startdate').val()===""){
        layer.msg('任务开始时间必填', {icon: 8});
        return false;
    }
    if($('#enddate').val()===""){
        layer.msg('任务结束时间必填', {icon: 8});
        return false;
    }
    if($('#linkman').val()===""){
        layer.msg('招商联系人不能为空', {icon: 8});
        $('#linkman').focus();
        return false;
    }
    if($('#linkphone').val()===""){
        layer.msg('招商联系人的电话不能为空', {icon: 8});
        $('#linkphone').focus();
        return false;
    }
    var taskid = $('#taskid').val();
    ++businessCount1;
    if (businessCount1==1 || businessCount1=="1") {
    var data = "{'command':'bTask','taskid':taskid,'creatuserid':'0','tasktypeid':'3','companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'taskDescription':$('#pro_taskDescription').val(),'linkphone':$('#linkphone').val(),'tradeid':$('#tradeid').val()}";
        $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            if(val.error_code==="success"){
                Cookie.createCookie('now_taskid',val.taskid);
                Cookie.createCookie('now_indexid',val.indexid);
                $('#one').hide();
                $('#two').show();
                $('#tip_one').attr('class','span_tip_ccc');
                $('#tip_two').attr('class','span_tip_red');
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },'json');
    }else{
        var data1 = "{'command':'bTask','taskid':Cookie.readCookie('now_taskid'),'creatuserid':'0','tasktypeid':'3','companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'taskDescription':$('#pro_taskDescription').val(),'linkphone':$('#linkphone').val(),'tradeid':$('#tradeid').val()}";
        $.post(APP+"/Api/Api/inport",eval('('+data1+')'),function(val){
            $('#one').hide();
            $('#two').show();
            $('#tip_one').attr('class','span_tip_ccc');
            $('#tip_two').attr('class','span_tip_red');
        },'json');
    }
});
//招商第二步：招商基本信息
var businessCount2=$('#task_two_count').val();
$('#task_two').click(function(){
    var area_stats =  parseInt($('#area_stats').val());
    var pro_stats = parseInt($('#pro_stats').val());
    var business_total = parseInt($('#business_total').val());

    if(area_stats===0){
        layer.msg('请添加招商情况',{icon:8});
        return false;
    }else{
        if(business_total<10){
        layer.msg('招商数量不能小于10家',{icon:8});
        return false;
        }
    }

    var tryout=$("input[name='tryout']:checked").val();
    if (1==tryout||"1"==tryout) {
        var tryoutNumber = $('#tryoutNumber').val();
        if (0==tryoutNumber||"0"==tryoutNumber||""==tryoutNumber) {
            layer.msg('试用样品份数',{icon:8});
            return false;
        }
        var testPayment=$("input[name='testPayment']:checked").val();
        if (1==testPayment||"1"==testPayment) {
            var paymentMoney = $('#paymentMoney').val();
            if (0==paymentMoney||"0"==paymentMoney||""==paymentMoney) {
            layer.msg('试用样品单价',{icon:8});
            return false;
        }
        }else{
            var paymentMoney=0;
        }
    }else{
        var tryoutNumber = 0;
        var testPayment= 0;
        var paymentMoney = 0;
    }

    // var indexid = $('#indexid').val();
    var payment = $('#payment').val()===""?0:$('#payment').val();
    var bond = $('#bond').val()===""?0:$('#bond').val();
    var franchise = $('#franchise').val()===""?0:$('#franchise').val();
    var otherprice = $('#otherprice').val()===""?0:$('#otherprice').val();
    var pricesum = $('#pricesum_txt').html();                 //招商首批款
    Cookie.createCookie('pricesum',pricesum);
    var business_count=$('#plan_count').html();
    Cookie.createCookie('business_count',business_count);
    var agents_commission = $('#agents_commission').val();
    var shuiw_commission = $('#shuiw_commission').val();
    var shangw_commission = $('#shangw_commission').val();
    var tuig_commission = $('#tuig_commission').val();
    var piny_commission = $('#piny_commission').val();
    var commission = $('#pins_commission').html();
    var totalcommission = $('#totalcommission').html();       //单个招商佣金*招商总数，总佣金
    Cookie.createCookie('totalcommission',totalcommission);

    ++businessCount2;
    if (businessCount2==1 || businessCount2=="1") {
        var data = "{'command':'bTask1','indexid':Cookie.readCookie('now_indexid'),'taskid':Cookie.readCookie('now_taskid'),'payment':payment,'bond':bond,'franchise':franchise,'otherprice':otherprice,'pricesum':pricesum,'agents_commission':agents_commission,'shuiw_commission':shuiw_commission,'shangw_commission':shangw_commission,'tuig_commission':tuig_commission,'piny_commission':piny_commission,'commission':commission,'totalcommission':totalcommission,'tryout':tryout,'tryoutNumber':tryoutNumber,'testPayment':testPayment,'paymentMoney':paymentMoney}";
        $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            if(val.error_code==="success"){
                Cookie.createCookie('now_taskid',val.taskid);
                Cookie.createCookie('now_indexid',val.indexid);
                $('#two').hide();
                $('#three').show();
                $('#tip_two').attr('class','span_tip_ccc');
                $('#tip_three').attr('class','span_tip_red');
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },'json');
    }else{
       var data1 = "{'command':'bTask1','indexid':Cookie.readCookie('now_indexid'),'taskid':Cookie.readCookie('now_taskid'),'payment':payment,'bond':bond,'franchise':franchise,'otherprice':otherprice,'pricesum':pricesum,'agents_commission':agents_commission,'shuiw_commission':shuiw_commission,'shangw_commission':shangw_commission,'tuig_commission':tuig_commission,'piny_commission':piny_commission,'commission':commission,'totalcommission':totalcommission,'tryout':tryout,'tryoutNumber':tryoutNumber,'testPayment':testPayment,'paymentMoney':paymentMoney}";
        $.post(APP+"/Api/Api/inport",eval('('+data1+')'),function(val){
                $('#two').hide();
                $('#three').show();
                $('#tip_two').attr('class','span_tip_ccc');
                $('#tip_three').attr('class','span_tip_red');
        },'json');
    }
});

//招商返回第一步
$('#return_one').click(function(){
            $('#one').show();
            $('#two').hide();
            $('#tip_one').attr('class','span_tip_red');
            $('#tip_two').attr('class','span_tip_ccc');
});

//招商第三步：区域及产品
var businessCount3=$('#task_three_count').val();
$('#task_three').click(function(){
    var brandlocation = 0;
    var slogan = 0;
    var sellingpoint = 0;
    var targetgroup = 0;
    var distributorsrequir = 0;
    var retailoutlets = 0;
    var channelpolicy = 0;
    var editor = UM.getEditor('editor').getContent();
    if(editor==""){
        layer.msg('招商产品详情描述', {icon: 8});
        return false;
    }
    var editor2 = UM.getEditor('editor2').getContent();
    if(editor2==""){
        layer.msg('招商政策详情描述', {icon: 8});
        return false;
    }
    var editor3 = UM.getEditor('editor3').getContent();
    if(editor3==""){
        layer.msg('招商企业介绍', {icon: 8});
        return false;
    }

    var tindexid = $('#tindexid');
    ++businessCount3;
    if (businessCount3==1 || businessCount3=="1") {
        var data = "{'command':'bTask2','tindexid':tindexid.val(),'taskid':Cookie.readCookie('now_taskid'),'brandlocation':brandlocation,'slogan':slogan,'sellingpoint':sellingpoint,'targetgroup':targetgroup,'distributorsrequir':distributorsrequir,'retailoutlets':retailoutlets,'channelpolicy':channelpolicy,'note':editor,'product':editor2,'company_note':editor3}";
        $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            if(val.error_code==="success"){
                Cookie.createCookie('now_taskid',val.taskid);
                Cookie.createCookie('now_tindexid',val.tindexid);
                $('#three').hide();
                $('#four').show();
                $('#tip_three').attr('class','span_tip_ccc');
                $('#tip_four').attr('class','span_tip_red');

            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },'json');
    }else{
         var data1 = "{'command':'bTask2','tindexid':Cookie.readCookie('now_tindexid'),'taskid':Cookie.readCookie('now_taskid'),'brandlocation':brandlocation,'slogan':slogan,'sellingpoint':sellingpoint,'targetgroup':targetgroup,'distributorsrequir':distributorsrequir,'retailoutlets':retailoutlets,'channelpolicy':channelpolicy,'note':editor,'product':editor2,'company_note':editor3}";
        $.post(APP+"/Api/Api/inport",eval('('+data1+')'),function(val){
            $('#three').hide();
            $('#four').show();
            $('#tip_three').attr('class','span_tip_ccc');
            $('#tip_four').attr('class','span_tip_red');
        },'json');
    }
});

//招商返回第二步
$('#return_two').click(function(){
        $('#two').show();
        $('#three').hide();
        $('#tip_two').attr('class','span_tip_red');
        $('#tip_three').attr('class','span_tip_ccc');
});


//招商第四步：
var businessCount4=$('#task_four_count').val();
$('#task_four').click(function(){
    if($('#fileid').val()===""){
        layer.msg('请上传任务图标', {icon: 8});
        return false;
    }
    if($('#fileid_ban').val()===""){
        layer.msg('请上传任务广告', {icon: 8});
        return false;
    }

    var fileid_pack = $('#fileid_pack').val();
    if (fileid_pack==="") {
        layer.msg('请上传商标注册证或授权使用证书图片', {icon: 8});
        $('#fileid_pack').focus();
        return false;
    };
    var fileid_propaganda = $('#fileid_propaganda').val();
    if (fileid_propaganda==="") {
        layer.msg('请上传经销商合同', {icon: 8});
        $('#fileid_propaganda').focus();
        return false;
    };
    var fileid_certificate = $('#fileid_certificate').val();
    if (fileid_certificate==="") {
        layer.msg('请上传产品和宣传资料图片', {icon: 8});
        $('#fileid_certificate').focus();
        return false;
    };
    var fileid_policy = $('#fileid_policy').val();
    if (fileid_policy==="") {
        layer.msg('请上传产品价格表', {icon: 8});
        $('#fileid_policy').focus();
        return false;
    };
    var fileid_price = $('#fileid_price').val();
    if (fileid_price==="") {
        layer.msg('请上传销售市场支持政策', {icon: 8});
        $('#fileid_price').focus();
        return false;
    };

    var fileid_contract = $('#fileid_contract').val();
    if (fileid_contract==="") {
        layer.msg('请上传招商服务合同结算清协议', {icon: 8});
        $('#fileid_contract').focus();
        return false;
    };


    var fileid_other = $('#fileid_other').val()===""?0:$('#fileid_other').val();
    var fileid_weishen  = $('#fileid_weishen').val()===""?0:$('#fileid_weishen').val();

    var findexid =  $('#findexid').val()===""?0:$('#findexid').val();


    ++businessCount4;
    if (businessCount4==1 || businessCount4=="1") {
        var data = "{'command':'bTask3','taskid':Cookie.readCookie('now_taskid'),'findexid':findexid,'file1':fileid_pack,'file2':fileid_propaganda,'file3':fileid_certificate,'file4':fileid_policy,'file5':fileid_price,'file8':fileid_contract,'file6':fileid_other,'file7':fileid_weishen,'fileid':$('#fileid').val(),'fileid_ban':$('#fileid_ban').val()}";
        $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            if(val.error_code==="success"){
                Cookie.createCookie('now_taskid',val.taskid);
                Cookie.createCookie('now_findexid',val.findexid);
                $('#four').hide();
                $('#five').show();
                $('#tip_four').attr('class','span_tip_ccc');
                $('#tip_five').attr('class','span_tip_red');
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },'json');
    }else{
        var data1 = "{'command':'bTask3','taskid':Cookie.readCookie('now_taskid'),'findexid':Cookie.readCookie('now_findexid'),'file1':fileid_pack,'file2':fileid_propaganda,'file3':fileid_certificate,'file4':fileid_policy,'file5':fileid_price,'file8':fileid_contract,'file6':fileid_other,'file7':fileid_weishen,'fileid':$('#fileid').val(),'fileid_ban':$('#fileid_ban').val()}";
        $.post(APP+"/Api/Api/inport",eval('('+data1+')'),function(val){
            if(val.error_code==="success"){
                $('#four').hide();
                $('#five').show();
                $('#tip_four').attr('class','span_tip_ccc');
                $('#tip_five').attr('class','span_tip_red');
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },'json');
    }
    
    
});

//招商返回第三步
$('#return_three').click(function(){
            $('#three').show();
            $('#four').hide();
            $('#tip_three').attr('class','span_tip_red');
            $('#tip_four').attr('class','span_tip_ccc');
});

//招商第五步：
$('#task_five_comfirm').click(function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var fieldkey = "level|credit|supervisionUser";
    var faithMoney=$("#faithMoney").val()
    if (faithMoney<30000) {
        var companyLevel=1;
    }else if(faithMoney<100000){
        var companyLevel=2;
    }else{
        var companyLevel=3;
    }
    // 招商首批款*招商总数+总诚信金<单个招商佣金*招商总数
    if (parseInt(Cookie.readCookie('pricesum')*Cookie.readCookie('business_count'))+parseInt(faithMoney)<parseInt(Cookie.readCookie('totalcommission'))) {
        // alert((pricesum_txt*business_count+faithMoney)<totalcommission);
        layer.msg('招商首批款+总诚信的金额不能小于招商佣金，请重新核对。', {icon: 8});
        $('#faithMoney').focus();
        return false;
    }
    var fieldval =companyLevel +"|"+faithMoney+"|"+$("#supervisionUser:checked").val();;
    $.post(APP+"/Api/Api/inport","command=modiCompanyInfo&companyid="+$("#companyId").val()+"&fieldkey="+fieldkey+"&fieldval="+fieldval+"&submit=submit"+"&taskid="+Cookie.readCookie('now_taskid'),function(data){
        if( data.error_code == "success" ){
            parent.location.reload();
            parent.layer.close(index);
        }else{
            layer.msg("企业设置失败");
        }
    },"json");

});


//招商第五步：
$('#task_five_save').click(function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var fieldkey = "level|credit|supervisionUser";
    var faithMoney=$("#faithMoney").val()  //总诚信金
    if (faithMoney<30000) {
        var companyLevel=1;
    }else if(faithMoney<100000){
        var companyLevel=2;
    }else{
        var companyLevel=3;
    }
    // 招商首批款*招商总数+总诚信金<单个招商佣金*招商总数
    if (parseInt(Cookie.readCookie('pricesum')*Cookie.readCookie('business_count'))+parseInt(faithMoney)<parseInt(Cookie.readCookie('totalcommission'))) {
        layer.msg('招商首批款+总诚信的金额不能小于招商佣金，请重新核对。', {icon: 8});
        $('#faithMoney').focus();
        return false;
    }
    var fieldval =companyLevel +"|"+faithMoney+"|"+$("#supervisionUser:checked").val();;
    $.post(APP+"/Api/Api/inport","command=modiCompanyInfo&companyid="+$("#companyId").val()+"&fieldkey="+fieldkey+"&fieldval="+fieldval,function(data){
        if( data.error_code == "success" ){
            parent.location.reload();
            parent.layer.close(index);
        }else{
            layer.msg("企业设置失败");
        }
    },"json");
});

//招商返回第四步
$('#return_four').click(function(){
            $('#four').show();
            $('#five').hide();
            $('#tip_four').attr('class','span_tip_red');
            $('#tip_five').attr('class','span_tip_ccc');
});


//================================================随手赚任务添加====================================================
//随手赚第一步：创建任务
$('#btn_widely_one').click(function(){
    if($('#fileid').val()===""){
        layer.msg('请上传任务图标', {icon: 8});
        return false;
    }
    if($('#companyId').val()===""){
        layer.msg('请选择发布企业，没有请先开户', {icon: 8});
        return false;
    }
    if($('#title').val()===""){
        layer.msg('任务标题不能为空', {icon: 8});
        $('#title').focus();
        return false;
    }
    if($('#startdate').val()===""){
        layer.msg('任务开始时间必填', {icon: 8});
        return false;
    }
    if($('#enddate').val()===""){
        layer.msg('任务结束时间必填', {icon: 8});
        return false;
    }
    if($('#linkman').val()===""){
        layer.msg('招商联系人不能为空', {icon: 8});
        $('#linkman').focus();
        return false;
    }
    if($('#linkphone').val()===""){
        layer.msg('招商联系人的电话不能为空', {icon: 8});
        $('#linkphone').focus();
        return false;
    }
    options=$("#tasktypeid option:selected");  //获取选中的项
    if(options.val()==0){
        layer.msg('请选择任务类型', {icon: 8});
        return false;
    }

     if($('#pro_taskDescription').val()===""){
        layer.msg('请输入任务描述', {icon: 8});
        $('#pro_taskDescription').focus();
        return false;
    } 

    layer.msg('创建任务成功，继续下一步');
    $('#widely_one').hide();
    $('#widely_two').show();
    $('#tip_one').attr('class','span_tip_ccc');
    $('#tip_two').attr('class','span_tip_red');

});

//随手赚返回第一步
$('#return_widely_one').click(function(){
    layer.msg('返回第一步成功');
    $('#widely_one').show();
    $('#widely_two').hide();
    $('#tip_one').attr('class','span_tip_red');
    $('#tip_two').attr('class','span_tip_ccc');

});


//随手赚第二步：基本信息
var widelyCount=$('#btn_widely_two_count').val();
$('#btn_widely_two').click(function(){

        if($('#conven_taskBrand').val()===""||0){
            layer.msg('请输入任务总数', {icon: 8});
            $('#conven_taskBrand').focus();
            return false;
        }
        if($('#conven_taskBrand').val()<100){
            layer.msg('任务总数至少为100份', {icon: 8});
            $('#conven_taskBrand').focus();
            return false;
        }
         if($('#conven_taskProduct').val()===""||0){
            layer.msg('请输入单次奖励的金币', {icon: 8});
            $('#conven_taskProduct').focus();
            return false;
        }
        //  if($('#conven_industry').val()===""||0){
        //     layer.msg('热门标签', {icon: 8});
        //     $('#conven_industry').focus();
        //     return false;
        // }
        var editor2 = UM.getEditor('editor2').getContent();
         if(editor2===""){
            layer.msg('请输入任务需求', {icon: 8});
            $("#editor2").focus();
            return false;
        }    

        var taskId = $("#taskId").val();
        if (taskId == undefined) {
            var taskId = 0;
        };

        var indexid = $("#indexid").val();
        if (indexid == undefined || indexid == '' || indexid== null) {
            var indexid = 0;
        };

        var taskDegree = $("input[name='taskDegree']:checked").val();
        if(taskDegree==undefined){
            var taskDegree = 0;
        }  
        console.log(indexid);
        ++widelyCount;
        if(widelyCount==1 || widelyCount=="1"){
            var data = "{'command':'cPush1','fuck':'0','taskid':taskId,'indexid':indexid,'creatuserid':'0','tasktypeid':$('#tasktypeid').val(),'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'pro_taskBrand':$('#conven_taskBrand').val(),'pro_taskProduct':$('#conven_taskProduct').val(),'pro_saleCommission':$('#conven_saleCommission').val(),'pro_totalFee':$('#conven_totalFee').val(),'harder':taskDegree,'pro_industry':$('#conven_industry').val(),'taskDescription':$('#pro_taskDescription').val(),'editor2':editor2}";    
            $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
                console.log(val);
                if(val.error_code==="success"){
                    if(taskId==0){
                        layer.msg('添加任务基本信息成功，继续下一步');
                    }else{
                        layer.msg('修改任务基本信息成功，继续下一步');
                    }
                    Cookie.createCookie('now_taskid',val.taskid,1);
                    // Cookie.createCookie('fuck',val.taskid,1);
                    $("#taskid3").attr("value",val.taskid);
                    if(options.val()!=5){
                        $('#widely_two').hide();
                        $('#widely_three').show();
                        $('#tip_two').attr('class','span_tip_ccc');
                        $('#tip_three').attr('class','span_tip_red');
                    }else{
                        $('#widely_two').hide();
                        $('#widely_four').show();
                        $('#tip_two').attr('class','span_tip_ccc');
                        $('#tip_four').attr('class','span_tip_red');
                    }
                }else{
                    layer.msg(val.error_text, {icon: 8});
                }
            },'json');
        }else{
            var data1 = "{'command':'cPush1','fuck':'1','taskid':Cookie.readCookie('now_taskid'),'indexid':'0','creatuserid':'0','tasktypeid':$('#tasktypeid').val(),'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'pro_taskBrand':$('#conven_taskBrand').val(),'pro_taskProduct':$('#conven_taskProduct').val(),'pro_saleCommission':$('#conven_saleCommission').val(),'pro_totalFee':$('#conven_totalFee').val(),'harder':taskDegree,'pro_industry':$('#conven_industry').val(),'taskDescription':$('#pro_taskDescription').val(),'editor2':editor2}";
                                    // alert(widelyCount);
            $.post(APP+"/Api/Api/inport",eval('('+data1+')'),function(val){
                if(options.val()!=5){
                        $('#widely_two').hide();
                        $('#widely_three').show();
                        $('#tip_two').attr('class','span_tip_ccc');
                        $('#tip_three').attr('class','span_tip_red');
                    }else{
                        $('#widely_two').hide();
                        $('#widely_four').show();
                        $('#tip_two').attr('class','span_tip_ccc');
                        $('#tip_four').attr('class','span_tip_red');
                    }
            },'json');
        }
});

//随手赚返回第二步
$('#return_widely_two').click(function(){
    layer.msg('返回第二步成功');
    $('#widely_two').show();
    $('#widely_three').hide();
    $('#tip_two').attr('class','span_tip_red');
    $('#tip_three').attr('class','span_tip_ccc');
});

//随手赚返回第二步_1
$('#return_widely_two_1').click(function(){
    layer.msg('返回第二步成功');
    $('#widely_two').show();
    $('#widely_four').hide();
    $('#tip_two').attr('class','span_tip_red');
    $('#tip_four').attr('class','span_tip_ccc');
});

//随手赚第三步:任务模板

$('#task_two_conven').click(function(val){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var taskId = $("#taskId").val();
    if (taskId == undefined) {
        var taskId = 0;
    };

    var length=$("#quest > div").length;
    var list="";
    for(var i=0;i<length;i++){
        var indexid = $("#f_stdindex"+i).val();
        if (indexid == undefined) {
            var indexid = 0;
        };

        console.log(indexid);
        var question=$("#question_list_"+i+ " input[name=conventionDataInput]").val();
        var selected=$("#template_answer_selected_"+i).val();
        var length2=$("#template_answer_selected_"+i+" ~  input[type=text]").length;

        var trueanswer="";
        if(options.val()==6){
            var trueanswerchecked=$("input[name='trueAnswer"+i+"']:checked");
            if(selected==1||selected=="1"){
               if (trueanswerchecked.length === 0) {
                    layer.msg("请选择单选的正确答案", {'icon': 8});
                    return false;
                }else if (trueanswerchecked.length > 1) {
                    layer.msg("单选的答案只能一个，你选择了" + trueanswerchecked.length + "个", {'icon': 8});
                    return false;
                }else{
                    trueanswer=trueanswerchecked.val();
                }
            }else if(selected==2||selected=="2"){
                if(trueanswerchecked.length < 2){
                    layer.msg("多选的答案至少两个，你选择了" + trueanswerchecked.length + "个", {'icon': 8});
                    return false;
                }else{
                    trueanswerchecked.each(function(){
                        if (trueanswer === "") {
                            trueanswer += $(this).val();
                        } else {
                            trueanswer += "," + $(this).val();
                        }
                    });
                }
            }
        }
        var answer="";
        for(var j=0;j<length2;j++){
            answer+=$("#template_answer_selected_"+i+" ~  input[type=text]").eq(j).val().trim()+"|";
        }
        answer=answer.substring(0,answer.length-1);
        var list = "{'command':'cPush2','taskid':$('#taskid3').val(),'indexid':indexid,'f_serial':i+1,'f_problemtatile':question,'f_type':selected,'f_options':answer,'f_trueanswer':trueanswer}";
        $.ajaxSetup({
            async:false
        });

        $.post(APP+"/Api/Api/inport",eval('('+list+')'),function(val){
             if(val.error_code==="success"){
                if(taskId===0){
                    layer.msg('创建任务成功',{icon:9});
                }
                else{
                    layer.msg('编辑任务成功',{icon:9});
                }

            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },"json");
          
    }

    layer.confirm('一旦提交，任务将进入待审核，不允许编辑该任务！是否立即提交？', {
        btn: ['确定','取消'], //按钮
        shade: false, //不显示遮罩
        icon: 3, 
        title:'添加提示'
    },function(index){

        var taskId = $("#taskId").val();
        if (taskId == undefined) {
            var taskId = 0;
        };

        var editor2 = UM.getEditor('editor2').getContent();
        // var editor3 = UM.getEditor('editor3').getContent();
        // var f_indexId = $("#f_stdindex").val();
        // if (f_indexId == undefined) {
            // var f_indexId = 0;
        // };
        
        var f_indexId = $("#indexid").val();
        if (f_indexId == undefined || f_indexId == '' || f_indexId== null) {
            var f_indexId = 0;
        };
        console.log(f_indexId);


        var taskDegree = $("input[name='taskDegree']:checked").val();
        if(taskDegree==undefined){
            var taskDegree = 0;
        }

        var data = "{'command':'cPush1','fuck':'1','status':'2','taskid':$('#taskid3').val(),'indexid':f_indexId,'creatuserid':'0','tasktypeid':$('#tasktypeid').val(),'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'pro_taskBrand':$('#conven_taskBrand').val(),'pro_taskProduct':$('#conven_taskProduct').val(),'pro_saleCommission':$('#conven_saleCommission').val(),'pro_totalFee':$('#conven_totalFee').val(),'harder':taskDegree,'pro_industry':$('#conven_industry').val(),'taskDescription':$('#pro_taskDescription').val(),'editor2':editor2}";
         $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            if(val.error_code==="success"){
                 parent.location.reload();
                 parent.layer.close(index);
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
         },'json');

    },function(index){
        parent.location.reload();
        parent.layer.close(index);
    });  

});

//随手赚第四步:任务推荐

$('#task_four_conven').click(function(val){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var editor4 = UM.getEditor('editor4').getContent();
    if(editor4===""){
            layer.msg('请输入任务推荐', {icon: 8});
            $("#editor4").focus();
            return false;
        }

    layer.confirm('一旦提交，任务将进入待审核，不允许编辑该任务！是否立即提交？', {
        btn: ['确定','取消'], //按钮
        shade: false, //不显示遮罩
        icon: 3, 
        title:'添加提示'
    },function(index){

        var taskId = $("#taskId").val();
        if (taskId == undefined) {
            var taskId = 0;
        };

        var editor2 = UM.getEditor('editor2').getContent();
        var editor4 = UM.getEditor('editor4').getContent();
     
        var f_indexId = $("#indexid").val();
        if (f_indexId == undefined || f_indexId == '' || f_indexId== null) {
            var f_indexId = 0;
        };
        console.log(f_indexId);
        
        var taskDegree = $("input[name='taskDegree']:checked").val();
        if(taskDegree==undefined){
            var taskDegree = 0;
        }

        var data = "{'command':'cPush1','fuck':'1','status':'2','taskid':$('#taskid3').val(),'indexid':f_indexId,'creatuserid':'0','tasktypeid':$('#tasktypeid').val(),'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'pro_taskBrand':$('#conven_taskBrand').val(),'pro_taskProduct':$('#conven_taskProduct').val(),'pro_saleCommission':$('#conven_saleCommission').val(),'pro_totalFee':$('#conven_totalFee').val(),'harder':taskDegree,'pro_industry':$('#conven_industry').val(),'taskDescription':$('#pro_taskDescription').val(),'editor2':editor2,'editor4':editor4}";
         $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            if(val.error_code==="success"){
                 parent.location.reload();
                 parent.layer.close(index);
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
         },'json');

    },function(index){
        parent.location.reload();
        parent.layer.close(index);
    });  

});

//随手业务计算佣金
function calcu2(){
      var totalprice1=0;     
      var taskbrand=$('#conven_taskProduct').val()===""?0:$('#conven_taskBrand').val();
      var taskproduct=$('#conven_taskProduct').val()===""?0:$('#conven_taskProduct').val();
      $('#conven_saleCommission').val(taskproduct);
      totalprice1=2*Number(taskproduct)*Number(taskbrand);
      $('#conven_saleCommission').html(taskproduct);
      $('#conven_totalFee').val(Math.round(totalprice1*100)/100);
      console.log(taskbrand+","+taskproduct+","+totalprice1);
      
    }
//================================================稽查赚任务添加====================================================
//稽查赚第一步：创建任务
var checkCount1=$('#btn_check_one_count').val();
$('#btn_check_one').click(function(){
    if($('#fileid').val()===""){
        layer.msg('请上传任务图标', {icon: 8});
        return false;
    }
    if($('#companyId').val()===""){
        layer.msg('请选择发布企业，没有请先开户', {icon: 8});
        return false;
    }
    if($('#title').val()===""){
        layer.msg('任务标题不能为空', {icon: 8});
        $('#title').focus();
        return false;
    }
    if($('#startdate').val()===""){
        layer.msg('任务开始时间必填', {icon: 8});
        return false;
    }
    if($('#enddate').val()===""){
        layer.msg('任务结束时间必填', {icon: 8});
        return false;
    }
    if($('#linkman').val()===""){
        layer.msg('稽查联系人不能为空', {icon: 8});
        $('#linkman').focus();
        return false;
    }
    if($('#linkphone').val()===""){
        layer.msg('稽查联系人的电话不能为空', {icon: 8});
        $('#linkphone').focus();
        return false;
    }

    if($('#pro_taskDescription').val()===""){
        layer.msg('请输入任务描述', {icon: 8});
        $('#pro_taskDescription').focus();
        return false;
    } 

    var editor7 = UM.getEditor('editor7').getContent();
         if(editor7===""){
            layer.msg('请输入任务需求', {icon: 8});
            $("#editor7").focus();
            return false;
        }

    var taskId = $("#taskId").val();
    if (taskId == undefined) {
        var taskId = 0;
    };

    var indexid = $("#indexid").val();
    if (indexid == undefined || indexid == '' || indexid== null) {
        var indexid = 0;
    };

    ++checkCount1;
        if(checkCount1==1 || checkCount1=="1"){
            var data = "{'command':'cCheck','taskid':taskId,'indexid':indexid,'creatuserid':'0','tasktypeid':7,'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'taskDescription':$('#pro_taskDescription').val(),'editor7':editor7}";
            $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
                console.log(val);
                if(val.error_code==="success"){
                    Cookie.createCookie('now_taskid',val.taskid,1);
                        $('#check_one').hide();
                        $('#check_two').show();
                        $('#tip_one').attr('class','span_tip_ccc');
                        $('#tip_two').attr('class','span_tip_red');
                }else{
                    layer.msg(val.error_text, {icon: 8});
                }
            },'json');
        }else{
            var data1 = "{'command':'cCheck','taskid':Cookie.readCookie('now_taskid'),'indexid':Cookie.readCookie('now_indexid'),'creatuserid':'0','tasktypeid':7,'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'taskDescription':$('#pro_taskDescription').val(),'editor7':editor7}";
            $.post(APP+"/Api/Api/inport",eval('('+data1+')'),function(val){
                    $('#check_one').hide();
                    $('#check_two').show();
                    $('#tip_one').attr('class','span_tip_ccc');
                    $('#tip_two').attr('class','span_tip_red');
            },'json');
        }
});

//稽查赚返回第一步
$('#return_check_one').click(function(){
    layer.msg('返回第一步成功');
    $('#check_one').show();
    $('#check_two').hide();
    $('#tip_one').attr('class','span_tip_red');
    $('#tip_two').attr('class','span_tip_ccc');
});


//稽查赚第二步：基本信息
$('#btn_check_two').click(function(){
    var length=$("#quest > div").length;
    var list="";
    for(var i=0;i<length;i++){
        var indexid = $("#f_stdindex"+i).val();
        if (indexid == undefined) {
            var indexid = 0;
        };

        var question=$("#question_list_"+i+ " input[name=conventionDataInput]").val();
        var selected=$("#template_answer_selected_"+i).val();
        var length2=$("#template_answer_selected_"+i+" ~  input[type=text]").length;

        var trueanswer="";
        var trueanswerchecked=$("input[name='trueAnswer"+i+"']:checked");
        if(selected==1||selected=="1"){
           if (trueanswerchecked.length === 0) {
                layer.msg("请选择单选的正确答案", {'icon': 8});
                return false;
            }else if (trueanswerchecked.length > 1) {
                layer.msg("单选的答案只能一个，你选择了" + trueanswerchecked.length + "个", {'icon': 8});
                return false;
            }else{
                trueanswer=trueanswerchecked.val();
            }
        }else if(selected==2||selected=="2"){
            if(trueanswerchecked.length < 2){
                layer.msg("多选的答案至少两个，你选择了" + trueanswerchecked.length + "个", {'icon': 8});
                return false;
            }else{
                trueanswerchecked.each(function(){
                    if (trueanswer === "") {
                        trueanswer += $(this).val();
                    } else {
                        trueanswer += "," + $(this).val();
                    }
                });
            }
        }
        var answer="";
        for(var j=0;j<length2;j++){
            answer+=$("#template_answer_selected_"+i+" ~  input[type=text]").eq(j).val().trim()+"|";
        }
        answer=answer.substring(0,answer.length-1);
        var list = "{'command':'cPush2','taskid':Cookie.readCookie('now_taskid'),'indexid':indexid,'f_serial':i+1,'f_problemtatile':question,'f_type':selected,'f_options':answer,'f_trueanswer':trueanswer}";
        $.ajaxSetup({
            async:false
        });

        $.post(APP+"/Api/Api/inport",eval('('+list+')'));
    }
    $('#check_two').hide();
    $('#check_three').show();
    $('#check_two').attr('class','span_tip_ccc');
    $('#check_three').attr('class','span_tip_red');

});

//稽查赚返回第二步
$('#return_check_two').click(function(){
    layer.msg('返回第二步成功');
    $('#check_two').show();
    $('#check_three').hide();
    $('#tip_two').attr('class','span_tip_red');
    $('#tip_three').attr('class','span_tip_ccc');
});


//稽查赚第三步:任务模板
$('#task_check_conven').click(function(val){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var audit_smallid=$("#audit_smallid").val();
    //单次奖励金币
    var conven_taskProduct3=$("#conven_taskProduct3").val();
    //平台单次服务佣金
    var conven_saleCommission3=$("#conven_saleCommission3").val();
    //任务总数
    var conven_taskBrand3=$("#conven_taskBrand3").val();
    //总佣金
    var conven_totalFee3=$("#conven_totalFee3").val();
    var editor7 = UM.getEditor('editor7').getContent();
    layer.confirm('请确保数据无误，一旦提交，任务将进入待审核，不允许编辑该任务！是否立即提交？', {
        btn: ['确定','取消'], //按钮
        shade: false, //不显示遮罩
        icon: 3,
        title:'添加提示'
    },function(index){
        var data="{'taskid':Cookie.readCookie('now_taskid'),'indexid':audit_smallid,'editor7':editor7,'pro_taskProduct':conven_taskProduct3,'pro_taskBrand':conven_taskBrand3,'total_commisson':conven_totalFee3}";
        $.post(APP+"/Api/Web/check_auit",eval('('+data+')'),function(val){
            if(val.error_code=="success"){
                var data = "{'status':'2','taskid':Cookie.readCookie('now_taskid')}";
                $.post(APP+"/Api/Web/changeStatutask",eval('('+data+')'),function(val){
                    if(val.error_code=="success"){
                        parent.location.reload();
                        parent.layer.close(index);
                    }else{
                        layer.msg("提交失败", {icon: 8});
                    }
                },'json');

            }else{
                layer.msg("提交失败");
                return false;
            }
        },"json");

    },function(index){
        parent.location.reload();
        parent.layer.close(index);

    });
});
//稽查赚第三步:任务模板
$('#task_check_save').click(function(val){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var audit_smallid=$("#audit_smallid").val();
    var taskid=Cookie.readCookie('now_taskid');
    //单次奖励金币
    var conven_taskProduct3=$("#conven_taskProduct3").val();
    //平台单次服务佣金
    var conven_saleCommission3=$("#conven_saleCommission3").val();
    //任务总数
    var conven_taskBrand3=$("#conven_taskBrand3").val();
    //总佣金
    var conven_totalFee3=$("#conven_totalFee3").val();
    var editor7 = UM.getEditor('editor7').getContent();
    var data="{'taskid':Cookie.readCookie('now_taskid'),'indexid':audit_smallid,'editor7':editor7,'pro_taskProduct':conven_taskProduct3,'pro_taskBrand':conven_taskBrand3,'total_commisson':conven_totalFee3,'status':6}";
    $.post(APP+"/Api/Web/check_auit_save",eval('('+data+')'),function(val){
        if(val.error_code=="success"){
            parent.location.reload();
            parent.layer.close(index);
        }else{
            layer.msg("提交失败");
            return false;
        }
    },"json");

});
//================================================推广赚任务添加====================================================
//推广赚第一步：创建任务
$('#btn_push_one').click(function(){
    if($('#fileid').val()===""){
        layer.msg('请上传任务图标', {icon: 8});
        return false;
    }
    if($('#companyId').val()===""){
        layer.msg('请选择发布企业，没有请先开户', {icon: 8});
        return false;
    }
    if($('#title').val()===""){
        layer.msg('任务标题不能为空', {icon: 8});
        $('#title').focus();
        return false;
    }
    if($('#startdate').val()===""){
        layer.msg('任务开始时间必填', {icon: 8});
        return false;
    }
    if($('#enddate').val()===""){
        layer.msg('任务结束时间必填', {icon: 8});
        return false;
    }
    if($('#linkman').val()===""){
        layer.msg('招商联系人不能为空', {icon: 8});
        $('#linkman').focus();
        return false;
    }
    if($('#linkphone').val()===""){
        layer.msg('招商联系人的电话不能为空', {icon: 8});
        $('#linkphone').focus();
        return false;
    }
    if($('#pro_taskDescription').val()===""){
        layer.msg('请输入任务描述', {icon: 8});
        $('#pro_taskDescription').focus();
        return false;
    }

    layer.msg('创建任务成功，继续下一步');
    $('#push_one').hide();
    $('#push_two').show();
    $('#tip_one').attr('class','span_tip_ccc');
    $('#tip_two').attr('class','span_tip_red');

});

//推广赚上一步
$('#return_push_one').click(function(){
    layer.msg('返回上一步成功');
    $('#push_one').show();
    $('#push_two').hide();
    $('#tip_one').attr('class','span_tip_red');
    $('#tip_two').attr('class','span_tip_ccc');

});


//推广赚第二步：基本信息
$('#btn_push_two').click(function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引

    if($('#pro_taskBrand').val()===""||0){
        layer.msg('请输入任务总数', {icon: 8});
        $('#pro_linkphone').focus();
        return false;
    }
    if($('#pro_taskBrand').val()<100){
        layer.msg('任务总数至少为100份', {icon: 8});
        $('#pro_linkphone').focus();
        return false;
    }
     if($('#pro_taskProduct').val()===""||0){
        layer.msg('请输入单次奖励的金币', {icon: 8});
        $('#pro_taskProduct').focus();
        return false;
    }
    var editor1 = UM.getEditor('editor1').getContent();
     if(editor1===""){
        layer.msg('请输入任务需求', {icon: 8});
        $("#editor1").focus();
        return false;
    }

    var taskId = $("#taskId").val();
    if (taskId == undefined) {
        var taskId = 0;
    };

    var indexid = $("#indexid").val();
    if (indexid == undefined) {
        var indexid = 0;
    };
    layer.confirm('一旦提交，任务将进入待审核，不允许编辑该任务！是否立即提交？', {
        btn: ['确定','取消'], //按钮
        shade: false, //不显示遮罩
        icon: 3, 
        title:'添加提示'
    },function(index){

        var data = "{'command':'cPush','status':'2','taskid':taskId,'indexid':indexid,'creatuserid':'0','tasktypeid':1,'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'pro_taskBrand':$('#pro_taskBrand').val(),'pro_taskProduct':$('#pro_taskProduct').val(),'pro_saleCommission':$('#pro_saleCommission').val(),'pro_totalFee':$('#pro_totalFee').val(),'pro_industry':$('#pro_industry').val(),'taskDescription':$('#pro_taskDescription').val(),'mtbrand':$('#mtbrand').val(),'harder':'0','editor':editor1}";
        $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            if(val.auth_code==="conf_success"){
                Cookie.createCookie('now_taskid',val.taskid,1);
                parent.location.reload();
                parent.layer.close(index);
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },'json');


    },function(index){
        
        var data = "{'command':'cPush','taskid':taskId,'indexid':indexid,'creatuserid':'0','tasktypeid':1,'fileid':$('#fileid').val(),'fileid_ban':0,'companyId':$('#companyId').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'linkphone':$('#linkphone').val(),'pro_taskBrand':$('#pro_taskBrand').val(),'pro_taskProduct':$('#pro_taskProduct').val(),'pro_saleCommission':$('#pro_saleCommission').val(),'pro_totalFee':$('#pro_totalFee').val(),'pro_industry':$('#pro_industry').val(),'taskDescription':$('#pro_taskDescription').val(),'mtbrand':$('#mtbrand').val(),'harder':'0','editor':editor1}";
        $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
            console.log(val);
            if(val.auth_code==="conf_success"){
                Cookie.createCookie('now_taskid',val.taskid,1);
                parent.location.reload();
                parent.layer.close(index);
            }else{
                layer.msg(val.error_text, {icon: 8});
            }
        },'json');
        
    });
});




//推广业务计算佣金
function calcu(){
      var totalprice1=0;     
      var taskbrand=$('#pro_taskProduct').val()===""?0:$('#pro_taskBrand').val();
      var taskproduct=$('#pro_taskProduct').val()===""?0:$('#pro_taskProduct').val();
      $('#pro_saleCommission').val(taskproduct);
      totalprice1=2*Number(taskproduct)*Number(taskbrand);
      $('#pro_saleCommission').html(taskproduct);
      $('#pro_totalFee').val(Math.round(totalprice1*100)/100);
      console.log(taskbrand+","+taskproduct+","+totalprice1);
      
}


//-----------------------------------------------------------------------------------任务审核-----------------------------------------------
$('#bid').click(function(){
    isauthority('200','a');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var taskid = $("input[name='indexId']:checked");

        if(taskid.length===0){
            layer.msg("请选择要审核的记录",{'icon':8});
            return false;
        }else{
            var pubTask = $("input[name='pubTaskId']:checked");
            var pubTaskId = pubTask[0].value;
            for (var i = taskid.length - 1; i >= 0; i--) {
                var dealerId = taskid[i].value;
                $.post(APP+"/Api/web/getConfirm",
                "dealerId="+dealerId,
                function(data){
                     $('.listinfo2').empty();
                     plist_dealer(pubTaskId);
                },"json");
            };

        }
    }
});

$('#rejectdealer').click(function(){
    // isauthority('200','b');
    // if(accessVal===false){
    //     layer.msg("你无权使用此功能，如需帮助联系管理员");
    //     return false;
    // }else {
        var taskid = $("input[name='indexId']:checked");

        var status = "status" + taskid.val();
        var statusid = $("#" + status + "").val();

        if(taskid.length===0){
            layer.msg("请选择要驳回的记录",{'icon':8});
            return false;
        }else if (taskid.length > 1) {
            layer.msg("驳回只能选择一条记录，你选择了" + taskid.length + "条", {'icon': 8});
            return false;
        } else if (statusid === 1 || statusid === '1') {
            layer.msg("已中标的经销商不允许驳回", {'icon': 8});
            return false;
        }else{
            var pubTask = $("input[name='pubTaskId']:checked");
            var pubTaskId = pubTask[0].value;
            var dealerId = taskid.val();
            $.post(APP+"/Api/web/rejectDealer",
            "dealerId="+dealerId,
            function(data){
                 $('.listinfo2').empty();
                 plist_dealer(pubTaskId);
            },"json");
        }
    // }
});
//-----------------------------------------------------------------------------------业务员管理-----------------------------------------------
function showDetail()
{
    var taskid = $("input[name='pubTaskId']:checked");

    if(taskid.length===0){
        layer.msg("请选择要查看的任务",{'icon':8});
        return false;
    }else if(taskid.length>1){
        layer.msg("要查看的任务只能选择一条，你选择了"+taskid.length+"条",{'icon':8});
        return false;
    }else{
        var dealerId = taskid[0].value ;

        var index;

        index = layer.open({
            title: '任务详情',
            type: 2,
            area: ['1000px', '600px'],
            content: APP+'/Taskadmin/Review/showDetail?dealerId='+dealerId
        });
        
    }
}

function turnToDetail(dealerid)
{
    //var tid = obj.children[0].children[0].value ;
    var index;

    index = layer.open({
        title: '详细信息',
        type: 2,
        area: ['1000px', '600px'],
        content: APP+'/Taskadmin/Review/detail?dealerid='+dealerid
    });
}

function dealDetail(type,startTime,endTime)
{
    var index;

    index = layer.open({
        title: '详细信息',
        type: 2,
        area: ['1000px', '600px'],
        content: APP+'/Taskadmin/Dealer/detail?startTime='+startTime+"&endTime="+endTime+"&type="+type
    });
}

function showdtask(userid){
    index = layer.open({
        title: '任务认领列表',
        type: 2,
        area: ['1000px', '600px'],
        content: APP+'/Taskadmin/Sales/showdtask?userid='+userid
    });
}

//任务预览
function preview(taskid){
    index = layer.open({
        title: '任务预览',
        type: 2,
        area: ['1200px', '600px'],
        content: APP+'/Taskadmin/Task/preview?taskid='+taskid
    });
}

function taskType(userid,taskType){
    if(!arguments[1]) taskType = 0;

    $.post(APP+"/Api/web/taskType",
        "userid="+userid+"&taskType="+taskType,
        function(data){
            var result = eval('('+data+')');  
            var list = result.list;  
            var taskType = result.taskType; 

            if (taskType == 0) {
                $('#approval,#progress,#complete,#lose').removeClass("selected");
                $('#sum').addClass("selected");
            };
            if (taskType == 1) {
                $('#sum,#progress,#complete,#lose').removeClass("selected");
                $('#approval').addClass("selected");
            };
            if (taskType == 2) {
                $('#sum,#approval,#complete,#lose').removeClass("selected");
                $('#progress').addClass("selected");
            };
            if (taskType == 3) {
                $('#sum,#progress,#approval,#lose').removeClass("selected");
                $('#complete').addClass("selected");
            };
            if (taskType == 4) {
                $('#sum,#progress,#complete,#approval').removeClass("selected");
                $('#lose').addClass("selected");
            };

            $('.taskInfo').empty();
            if (list) {
                var context = "";
                for(var i=0;i<list.length;i++)  
                {  
                    context += "<div class='info'>";
                    context += "<br>";
                    context += "<span>&nbsp;&nbsp;&nbsp;&nbsp;任务名称： "+list[i].f_title+"</span><br><br>";
                    context += "<span style='padding-left:12px;'>任务联系人： "+list[i].f_linkman+"</span><br><br>";
                    context += "<span style='padding-left:12px;'>联系电话： "+list[i].f_linkphone+"</span><br><br>";
                    context += "<span style='padding-left:12px;'>任务类型： "+list[i].f_tasktype.f_typename+"</span><br><br>";
                    context += "</div>";

                }  
                $('.taskInfo').append(context);
            };
    });
}


function showManDetail(userid){
    index = layer.open({
        title: '业务员详情',
        type: 2,
        area: ['1000px', '600px'],
        content: APP+'/Taskadmin/Sales/showManDetail?userid='+userid
    });
}

//业务员导入
$('#salesAdd').on('click',function(){
    // isauthority('300','i');
    // //alert(accessVal);
    // if(accessVal===false){
    //     layer.msg("你无权使用此功能，如需帮助联系管理员");
    //     return false;
    // }else {
        index = layer.open({
            title: '业务员导入',
            type: 2,
            area: ['600px', '400px'],
            content: APP+'/Taskadmin/Sales/addSales'
        });
    // }
});

$("#importBtn").on('click',function(){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        console.log(index);
        parent.location.reload();
        parent.layer.close(index);
});
//-----------------------------------------------------------------------------------活动与广告-----------------------------------------------
$('#ad_add').on('click',function(){
    isauthority('500','a');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        index = layer.open({
            title: '添加活动或广告',
            type: 2,
            area: ['1000px', '600px'],
            content: APP+'/Taskadmin/Ad/addActivity'
        });
    }
});

//删除活动
$('#ad_del').on('click',function(){
    isauthority('500','b');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {

        layer.confirm('您确认要删除该记录吗？', {
            btn: ['确定','取消'], //按钮
            shade: false, //不显示遮罩
            icon: 3, 
            title:'删除提示'
        },function(index){
            
            layer.close(index);
            
            var taskid_arr = "";
            $("input[name='activityId']:checked").each(function(){
                if(taskid_arr===""){
                    taskid_arr += $(this).val();
                }else{
                    taskid_arr += "|"+$(this).val();
                }
            });
            if(taskid_arr===""){
                layer.msg("请选择要删除的记录",{'icon':8});
                return false;
            }else{
                $.post(APP+"/Api/Web/delActivity","activityIds="+taskid_arr,function(v){
                    if(v.result==='000000'){
                        plist_Activity($('#ad_del').val());
                        if ($('#ad_del').val() == 1) {
                            $('#activities').removeClass("selected");
                            $('#messages').addClass("selected");
                        }else{
                            $('#messages').removeClass("selected");
                            $('#activities').addClass("selected");
                        };
                    }else{
                        layer.msg('删除失败',{'icon':8});
                        return false;
                    }
                },'json');
            }
            
        },function(index){
            layer.close(index);
            return false;
        });
        
    }
});

//修改活动
$('#ad_modi').on('click',function(){
    isauthority('500','c');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var taskid = $("input[name='activityId']:checked");
        if(taskid.length===0){
            layer.msg("请选择要修改的记录",{'icon':8});
            return false;
        }else if(taskid.length>1){
            layer.msg("修改只能选择一条记录，你选择了"+taskid.length+"条",{'icon':8});
            return false;
        }else{
            var v = $("#ad_modi").val();
            if (v == 1) {
                var titles = '修改广告';
            }else{
                var titles = '修改活动';
            };
            var index;

            index = layer.open({
                title: titles,
                type: 2,
                area: ['1000px', '600px'],
                content: APP+'/Taskadmin/ad/updateAd?activityId='+taskid.val()
            });

            
        }
    }
});



//-----------------------------------------------------------------------------------企业管理-----------------------------------------------
$('#companyBid').click(function(){
    isauthority('400','a');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var taskid = $("input[name='companyId']:checked");
        var status = "status"+taskid.val();
        var statusid = $("#"+status+"").val();

        if(taskid.length===0){
            layer.msg("请选择要审核的记录",{'icon':8});
            return false;
        }else if(statusid!=4 && statusid!='4'){
            layer.msg("只有待审核的任务才能审核",{'icon':8});
            return false;
        }else{

            for (var i = taskid.length - 1; i >= 0; i--) {
                var companyId = taskid[i].value;
                $.post(APP+"/Api/Web/checkCompany",
                "companyId="+companyId+"&state=1",
                function(data){
                   location.reload();
                },"json");
            };

        }
    }
});

function showCompanyDetail(companyId,state){
    index = layer.open({
        title: '企业详情',
        type: 2,
        area: ['1000px', '600px'],
        content: APP+'/Taskadmin/Company/showCompanyDetail?companyId='+companyId+"&state="+state
    });
}


function showUseretail(userId){
    index = layer.open({
        title: '用户详情',
        type: 2,
        area: ['600px', '400px'],
        content: APP+'/Taskadmin/Index/showUserDetail?userId='+userId
    });
}

$('#companyReject').click(function(){
    isauthority('400','b');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var taskid = $("input[name='companyId']:checked");
        var status = "status"+taskid.val();
        var statusid = $("#"+status+"").val();
        
        if(taskid.length===0){
            layer.msg("请选择要驳回的记录",{'icon':8});
            return false;
        }else if(statusid!=4 && statusid!='4'){
            layer.msg("只有待审核的任务才能驳回",{'icon':8});
            return false;
        }else{

            for (var i = taskid.length - 1; i >= 0; i--) {
                var companyId = taskid[i].value;
                $.post(APP+"/Api/Web/checkCompany",
                "companyId="+companyId+"&state=0",
                function(data){
                   location.reload();
                },"json");
            };

        }
    }
});
//停用企业
$('#companyDelete').click(function(){
    // isauthority('400','d');
    // if(accessVal===false){
        // layer.msg("你无权使用此功能，如需帮助联系管理员");
        // return false;
    // }else {
        var taskid = $("input[name='companyId']:checked");
        if(taskid.length===0){
            layer.msg("请选择要删除的记录",{'icon':8});
            return false;
        }else{
            for (var i = taskid.length - 1; i >= 0; i--) {
                var companyId = taskid[i].value;
                $.post(APP+"/Api/Web/checkCompany",
                "companyId="+companyId+"&state=3",
                function(data){
                   location.reload();
                },"json");
            };

        }
    // }
});
//恢复企业
$('#companyReinstate').click(function(){
    // isauthority('400','e');
    // if(accessVal===false){
    //     layer.msg("你无权使用此功能，如需帮助联系管理员");
    //     return false;
    // }else {
        var taskid = $("input[name='companyId']:checked");
        var status = "status"+taskid.val();
        var statusid = $("#"+status+"").val();
        if(taskid.length===0){
            layer.msg("请选择要恢复的记录",{'icon':8});
            return false;
        }else if(statusid!=3 && statusid!='3'){
            layer.msg("只有已停用的任务才能恢复",{'icon':8});
            return false;
        }else{
            for (var i = taskid.length - 1; i >= 0; i--) {
                var companyId = taskid[i].value;
                $.post(APP+"/Api/Web/checkCompany",
                "companyId="+companyId+"&state=4",
                function(data){
                   location.reload();
                },"json");
            };

        }
    // }
});

//企业导入
$('#companyAdd').on('click',function(){
    isauthority('400','c');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {

        index = layer.open({
            title: '企业导入',
            type: 2,
            area: ['600px', '400px'],
            content: APP+'/Taskadmin/Company/addCompany'
        });
    }
});

//查看经销商进程
$("#check").click(function(){
    isauthority('800','a');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var dealer = $("input[name='dealerId']:checked");
        if(dealer.length===0){
            layer.msg("请选择要查看的记录",{'icon':8});
            return false;
        }else if(dealer.length>1){
            layer.msg("修改只能选择一条记录，你选择了"+dealer.length+"条",{'icon':8});
            return false;
        }else{
            var dealerId = dealer[0].value;
            index = layer.open({
                title: '进度详情',
                type: 2,
                area: ['1000px', '600px'],
                content: APP+'/Taskadmin/DealerPro/showProDetail?dealerid='+dealerId
            });
        }
    }
});

//到账确认
$("#moneyCheck").click(function(){
    isauthority('800','b');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var dealer = $("input[name='dealerId']:checked");
        var status = "status"+dealer.val();
        var statusid = $("#"+status+"").val();
        var name = "name"+dealer.val();
        var nameid = $("#"+name+"").val();

        if(dealer.length===0){
            layer.msg("请选择要查看的记录",{'icon':8});
            return false;
        }else{
            $.post(APP+"/Api/Web/ismoneyCheck",
                "f_dealerid="+dealer.val(),
                function(data){
                    if (data == 1) {
                        layer.msg("该经销商已经到账确认过，请勿重复到账确认",{'icon':8});
                        return false;
                    }else{
                        $.post(APP+"/Api/Web/moneyCheck",
                        "dealerId="+dealer.val(),
                        function(data){
                           location.reload();
                        },"json");
                    };
                },"json");
        }
    }
});

$("#comDispatch").click(function(){
    var index = parent.layer.getFrameIndex(window.name); 
    var f_id = $("#f_id").val();
    var profile1 = $("#fileid").val();
    var f_dealerid = $("#f_dealerid").val();
    $.post(APP+"/Api/Web/dispatchCheck",
    "f_id="+f_id+"&profile1="+profile1+"&f_dealerid="+f_dealerid,
    function(data){
        parent.location.reload();
        parent.layer.close(index);
    },"json");
});

//佣金结算
$("#squareCheck").click(function(){
    isauthority('800','c');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {

        var dealer = $("input[name='dealerId']:checked");
        var status = "status"+dealer.val();
        var statusid = $("#"+status+"").val();
        var name = "name"+dealer.val();
        var nameid = $("#"+name+"").val();
        var money = "money"+dealer.val();
        var moneyid = $("#"+money+"").val();
        var moneyall =moneyid*10;
        var fid = "fid"+dealer.val();
        var id = $("#"+fid+"").val();

        if(dealer.length===0){
            layer.msg("请选择要查看的记录",{'icon':8});
            return false;
        }else{
            $.post(APP+"/Api/Web/isCommissionsquare",
                    "f_dealerid="+dealer.val(),
                    function(data){
                        // console.log(data);
                        if (data == 1) {
                            layer.msg("该经销商已经佣金结算过，请勿重复佣金结算",{'icon':8});
                            return false;
                        }else{
                            layer.confirm("佣金金额为"+moneyall+",是否确认？", {
                                btn: ['确定','取消'], //按钮
                                shade: false, //不显示遮罩
                                icon: 3, 
                                title:'添加提示'
                                },function(index){
                                    $.post(APP+"/Api/Web/squareCheck",
                                    "dealerid="+id+"&moneyid="+moneyall+"&f_dealerid="+dealer.val(),
                                    function(data){
                                           location.reload();
                                    },"json");

                                },function(index){
                                    location.reload();
                                });
                        };
                    },"json");

        }
    }
});

//货款结算
$("#settlementCheck").click(function(){
        isauthority('800','d');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var dealer = $("input[name='dealerId']:checked");
        var status = "status"+dealer.val();
        var statusid = $("#"+status+"").val();
        var name = "name"+dealer.val();
        var nameid = $("#"+name+"").val();
        var fid = "fid"+dealer.val();
        var id = $("#"+fid+"").val();

        if(dealer.length===0){
            layer.msg("请选择要查看的记录",{'icon':8});
            return false;
        }else if(statusid=='Settlement' && nameid=='1'){
            layer.msg("该经销商已经货款结算过，请勿重复货款结算",{'icon':8});
            return false;
        }else{
             $.post(APP+"/Api/Web/issettlementCheck",
                "f_dealerid="+dealer.val(),
                function(data){
                    if (data == 1) {
                        layer.msg("该经销商已经货款结算过，请勿重复货款结算",{'icon':8});
                        return false;
                    }else{
                        $.post(APP+"/Api/Web/settlementCheck",
                        "dealerid="+id+"&f_dealerid="+dealer.val(),
                        function(data){
                               location.reload();
                        },"json");
                    };
                },"json");

        }
    }
});

//返回首页
$("#home_back").click(function(){
    location.href=APP+'/Taskadmin/Index/main';
});


//个人设置
$("#user_setting").click(function(){
    index = layer.open({
        title: '个人设置',
        type: 2,
        area: ['650px', '450px'],
        content: APP+'/Taskadmin/Fun/user_setting'
    });
});

//退出登录
$("#user_out").click(function(){
    $.get(APP+"/Taskadmin/Fun/user_out",function(v){
        if(v==='1'){
            layer.msg("退出成功，正在跳转...");
            setTimeout(function(){location.href=APP+"/Taskadmin/Index/index";}, 2000);
        }
    });
});

//子级退出跳转
function sublevel_out(){
    $.get(APP+"/Taskadmin/Fun/jsislogin",function(v){
        if(v==='0'){
            layer.msg("非法操作，请重新登录...");
            setTimeout(function(){parent.location.href=APP+"/Taskadmin/Index/index";}, 2000);
        }
    });
}

//父级退出跳转
function parent_out(){
    $.get(APP+"/Taskadmin/Fun/jsislogin",function(v){
        if(v==='0'){
            layer.msg("非法操作，请重新登录...");
            setTimeout(function(){location.href=APP+"/Taskadmin/Index/index";}, 2000);
        }
    });
}

//判断功能权限
function isauthority(classaccess,actionaccess){
    $.ajaxSetup({
        async : false
    });
    $.get(APP+"/Api/Fun/isJsAccess","classaccess="+classaccess+"&actionaccess="+actionaccess,function(v){
        if(v==='0' || v===0){
            accessVal = false;
        }else{
            accessVal = true;
        }
        //return v;
    });
}

//添加分类
$("#addShopClass").click(function(){
    //     isauthority('900','a');
    // //alert(accessVal);
    // if(accessVal===false){
    //     layer.msg("你无权使用此功能，如需帮助联系管理员");
    //     return false;
    // }else {
        index = layer.open({
            title: '添加产品分类',
            type: 2,
            area: ['600px', '450px'],
            content: APP+'/Taskadmin/Shop/addShopClass'
        });
    // }
});

//添加分类确定
$("#addClassBtn").click(function(){
    isauthority('900','a');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var index = parent.layer.getFrameIndex(window.name); 
        var title = $("#title").val();
        var checkValue=$("#shopClassSelect").val(); //获取Select选择的Value 
        if(title===""){
            layer.msg('请输入分类名称', {icon: 8});
            $("#title").focus();
            return false;
        }
        $.post(APP+"/Api/Web/addShopClass",
        "title="+title+"&checkValue="+checkValue,
        function(data){
            parent.location.reload();
            parent.layer.close(index);
        },"json");
    }
});

//修改分类
function modishopclass(id){
    isauthority('900','f');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var index;
        index = layer.open({
            title: '修改产品分类',
            type: 2,
            area: ['600px', '450px'],
            content: APP+'/Taskadmin/Shop/modShopClass?classid='+id
        });
    }
}

//修改分类确定
$("#modiClassBtn").click(function(){
    var index = parent.layer.getFrameIndex(window.name); 
    var title = $("#title").val();
    var classid = $("#classid").val();
    var checkValue=$("#shopClassSelect").val(); //获取Select选择的Value 
    if(title===""){
        layer.msg('请输入分类名称', {icon: 8});
        $("#title").focus();
        return false;
    }
    $.post(APP+"/Api/Web/modShopClass",
    "title="+title+"&checkValue="+checkValue+"&classid="+classid,
    function(data){
        parent.location.reload();
        parent.layer.close(index);
    },"json");
});

//删除产品分类
function delshopclass(id){
    isauthority('900','g');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var classid = $("#classid").val();
        $.post(APP+"/Api/Web/delshopclass",
        "classid="+id,
        function(data){
            parent.location.reload();
            parent.layer.close(index);
        },"json");
    }
}

//添加产品
$("#addShop").click(function(){
        isauthority('900','b');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        $.post(APP+"/Api/Web/getAllClass",
        function(data){
            // console.log(data);
            if (data.result == '000000') {
                index = layer.open({
                title: '添加产品',
                type: 2,
                area: ['1000px', '600px'],
                content: APP+'/Taskadmin/Shop/addShop'
                });
            }else{
                layer.msg('请先添加分类', {icon: 8});
                return false;
            };
        },"json");

    }
});

//添加产品确定
$("#addShopBtn").click(function(){
    var index = parent.layer.getFrameIndex(window.name); 
    var title = $("#title").val();
    var shopClassSelect=$("#shopClassSelect").val(); //获取Select选择的Value 
    var checkValue=$("input[name='activity']:checked").val(); //获取Select选择的Value 
    var fileid=$("#fileid").val(); //获取Select选择的Value 
    var f_sid=$("#f_sid").val(); //获取Select选择的Value 
    if(shopClassSelect==="-1"||shopClassSelect===-1){
        layer.msg('请选择所属分类', {icon: 8});
        $("#shopClassSelect").focus();
        return false;
    }
    if(title===""){
        layer.msg('请输入产品名称', {icon: 8});
        $("#title").focus();
        return false;
    }
    if(fileid===""){
        layer.msg('请上传产品图片', {icon: 8});
        $("#fileid").focus();
        return false;
    }
    if($('#shopDescription').val()===""){
        layer.msg('请输入产品简介', {icon: 8});
        $("#shopDescription").focus();
        return false;
    }
    if($('#shopNum').val()===""||$('#shopNum').val()===0||isNaN($('#shopNum').val())||$('#shopNum').val()<=0||!(/^\d+$/.test($('#shopNum').val())) ){
        layer.msg('请输入正确的产品总数,只允许输入整数!', {icon: 8});
        $('#shopNum').focus();
        return false;
    }
    //||isNaN($('#shopPrice').val())||$('#shopPrice').val()<=0||!(/^\d+$/.test($('#shopPrice').val()))
    if($('#shopPrice').val()===""||$('#shopPrice').val()===0 ){
        layer.msg('请输入正确的产品单价!', {icon: 8});
        $('#shopPrice').focus();
        return false;
    }
    var editor1 = UM.getEditor('editor1').getContent();
    if(editor1===""){
        layer.msg('请输入产品详情描述', {icon: 8});
        $("#editor1").focus();
        return false;
    }
    var lotterystatus = $("#lotterystatus");
    if(lotterystatus.is(':checked')){
        lotterystatus = 1;
    }else{
        lotterystatus = 0;
    }

    if (f_sid) {
        $.post(APP+"/Api/Web/updateShop",
            "lotterystatus="+lotterystatus+"&title="+title+"&f_sid="+f_sid+"&shopClassSelect="+shopClassSelect+"&fileid="+fileid+"&shopDescription="+$('#shopDescription').val()+"&shopNum="+$('#shopNum').val()+"&shopPrice="+$('#shopPrice').val()+"&checkValue="+checkValue+"&editor1="+editor1,
        function(data){
            parent.location.reload();
            parent.layer.close(index);
        },"json");
    }else{
        $.post(APP+"/Api/Web/addShopList",
            "lotterystatus="+lotterystatus+"&title="+title+"&shopClassSelect="+shopClassSelect+"&fileid="+fileid+"&shopDescription="+$('#shopDescription').val()+"&shopNum="+$('#shopNum').val()+"&shopPrice="+$('#shopPrice').val()+"&checkValue="+checkValue+"&editor1="+editor1,
        function(data){
            parent.location.reload();
            parent.layer.close(index);
        },"json");
    };

});

//修改产品
$('#modiShop').on('click',function(){
        isauthority('900','c');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var shopid = $("input[name='shopid']:checked");
        if(shopid.length===0){
            layer.msg("请选择要修改的记录",{'icon':8});
            return false;
        }else if(shopid.length>1){
            layer.msg("修改只能选择一条记录，你选择了"+shopid.length+"条",{'icon':8});
            return false;
        }else{
            var index;

            index = layer.open({
                title: '修改产品',
                type: 2,
                area: ['1000px', '600px'],
                content: APP+'/Taskadmin/Shop/addShop?shopid='+shopid.val()
            });

            
        }
    }
});

//产品下架
$('#delShop').on('click',function(){
        isauthority('900','d');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var shopid = $("input[name='shopid']:checked");
        if(shopid.length===0){
            layer.msg("请选择要修改的记录",{'icon':8});
            return false;
        }else if(shopid.length>1){
            layer.msg("修改只能选择一条记录，你选择了"+shopid.length+"条",{'icon':8});
            return false;
        }else{
            $.post(APP+"/Api/Web/delShop",
            "shopid="+shopid.val(),
            function(data){
                parent.location.reload();
                parent.layer.close(index);
            },"json");
        }
    }
});

//产品上架
$('#resetShop').on('click',function(){
        isauthority('900','e');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var shopid = $("input[name='shopid']:checked");
        if(shopid.length===0){
            layer.msg("请选择要修改的记录",{'icon':8});
            return false;
        }else if(shopid.length>1){
            layer.msg("修改只能选择一条记录，你选择了"+shopid.length+"条",{'icon':8});
            return false;
        }else{
            $.post(APP+"/Api/Web/resetShop",
            "shopid="+shopid.val(),
            function(data){
                parent.location.reload();
                parent.layer.close(index);
            },"json");
        }
    }
});

//兑换开奖页面
$("#openLottery").on("click",function(){
    isauthority('900','f');
    //alert(accessVal);
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var shopid = $("input[name='shopid']:checked");
        if(shopid.length===0){
            layer.msg("请选择要开奖的产品",{'icon':8});
            return false;
        }else if(shopid.length>1){
            layer.msg("开奖只能选择一条记录，你选择了"+shopid.length+"条",{'icon':8});
            return false;
        }else{
            layer.open({
                title: '开奖',
                type: 2,
                area: ['200px', '300px'],
                content: APP + '/Taskadmin/Shop/open?shopid='+shopid.val()
            });
        }
    }
});

//兑换开奖
$("#openL").on("click",function(){
    var shopid = $("#shopid").val();
    var param = $("#param").val();
    var p = "shopid="+shopid+"&param="+param;
    $.post(APP+"/Api/Web/openLottery",p,function(v){
        if(v.result==="000000"){
            layer.msg("开奖成功");
            location.reload();
        }
    });
});

//消费记录管理
$('#tabli_ShopRecord').on('click','li',function(){
    //layer.msg($(this).attr('value'));
    $('#tabli_ShopRecord li').removeClass('selected');
    $(this).attr('class','selected');
    $('#pay').attr('value',$(this).attr('value'));
    //$('#del').attr('value',$(this).attr('value'));
    //$('#modi').attr('value',$(this).attr('value'));
    //加截相应分类数据
    plist_shopRecord($(this).attr('value'));
});

//-----------------------------------------------------------------------------------权限部署-----------------------------------------------
//删除用户或角色
$('#del_admin').on('click',function(){
    isauthority('1400','c');
    if(accessVal) {
        layer.confirm('您确认要删除该记录吗？', {
            btn: ['确定', '取消'], //按钮
            shade: false, //不显示遮罩
            icon: 3,
            title: '删除提示'
        }, function (index) {

            var id_arr = "";
            $("input[name='accessid']:checked").each(function () {
                if (id_arr === "") {
                    id_arr += $(this).val();
                } else {
                    id_arr += "|" + $(this).val();
                }
            });

            if (id_arr === "") {
                layer.msg("请选择要删除的记录", {'icon': 8});
                return false;
            } else {

                var v = $('#del_admin').val();
                switch (v) {
                    case 0:
                         $.post(APP + "/Api/Web/delAdminUser", "ids=" + id_arr, function (f) {
                            console.log(f);
                                if (f.result === '000000') {
                                    location.reload();
                                    plist_user();
                                } else { 
                                    layer.msg('删除失败', {'icon': 8});
                                    return false;
                                }
                            }, 'json');
                        break;
                    case 1:
                         $.post(APP + "/Api/Web/delAdminAccess", "ids=" + id_arr, function (f) {
                                if (f.result === '000000') {
                                    location.reload();
                                    plist_access();
                                } else {
                                    layer.msg('删除失败', {'icon': 8});
                                    return false;
                                }
                            }, 'json');
                        break;
                    default:
                        $.post(APP + "/Api/Web/delAdminUser", "ids=" + id_arr, function (f) {
                                if (f.result === '000000') {
                                    location.reload();
                                    plist_user();
                                } else {
                                    layer.msg('删除失败', {'icon': 8});
                                    return false;
                                }
                            }, 'json');
                        break;
                }
               
            }


        }, function (index) {
            layer.close(index);
            return false;
        });
    }else{
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }
});


//添加用户或角色
$('#add_admin').on('click',function(){
    isauthority('1400','a');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var v = $(this).attr('value');
        switch (v) {
            case '0':
                layer.open({
                    title: '新增用户',
                    type: 2,
                    area: ['650px', '450px'],
                    content: APP + '/Taskadmin/power/add_user'
                });
                break;
            case '1':
                layer.open({
                    title: '新增角色',
                    type: 2,
                    area: ['1000px', '800px'],
                    content: APP + '/Taskadmin/power/add_access'
                });
                break;
            default:
                layer.open({
                    title: '新增用户',
                    type: 2,
                    area: ['650px', '450px'],
                    content: APP + '/Taskadmin/power/add_user'
                });
                break;
        }
        
    }
});

//添加用户或角色
$('#ad_express').on('click',function(){
    // isauthority('1500','a');
    // if(accessVal===false){
        // layer.msg("你无权使用此功能，如需帮助联系管理员");
        // return false;
    // }else {
        var accessid = $("input[name='express']:checked");
        if(accessid.length===0){
            layer.msg("请选择要修改的记录",{'icon':8});
            return false;
        }else if(accessid.length>1){
            layer.msg("修改只能选择一条记录，你选择了"+accessid.length+"条",{'icon':8});
            return false;
        }else{
            layer.open({
                title: '填写快递单号',
                type: 2,
                area: ['450px', '250px'],
                content: APP + '/Taskadmin/TryOut/ad_express?id='+accessid.val()
            });
        }
    // }
});

var accessCount =0;
function getAccessVallue(i,arr,count){
    var task_arr1 ="";

    if($("input[name='task"+i+"']:checked").val()!= undefined)
    {
        $("input[name='power1"+i+"']:checked").each(function () 
        {
            if (task_arr1 === "") {
                task_arr1 += $(this).val();
            } else {
                task_arr1 += "," + $(this).val();
            }
        });

        if(task_arr1=="")
        {
            arr[accessCount]=$("input[name='task"+i+"']:checked").val();
        }else{
            arr[accessCount]=$("input[name='task"+i+"']:checked").val()+"|"+task_arr1;
        }
        accessCount++;
    }
    return arr;
}

//添加角色确认
$('#btn_add_access').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var accessvalue="";
    var accessname=$("#accessName").val();
    var num=$("#num").val();
    var arr=new Array();
    var arr1=new Array();
    accessCount=0;

    if(accessname==""){
        layer.msg('请填写角色名', {icon: 8});
        return false;
    }


    for(var i=1;i<=num;i++)  
    {  
        getAccessModiValue(i,arr);
    }  

    for(var i=1;i<=num;i++)  
    {  
        judgeAccessId(i,arr1);
    }  

    if(arr1.length>0){
        layer.msg('请先勾选大类', {icon: 8});
        return false;
    }

    accessvalue=arr.join("{||}");
     if (accessvalue=="") {
        layer.msg('请勾选权限', {icon: 8});
        return false;
    }
    
    $.post(APP+"/Api/Web/addAdmin",
    "accessname="+accessname+"&accessvalue="+accessvalue,
    function(data){
        parent.location.reload();
        parent.layer.close(index);
    },"json");

});

//添加用户确认
$('#btn_add_user').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var username=$("#username").val();
    var password=$("#password").val();
    var realname=$("#realname").val();
    var accessid=$("#user_accessname").val();

    if(username==""){
        layer.msg('请填写用户昵称', {icon: 8});
        $("#username").focus();
        return false;
    }
    if(password==""){
        layer.msg('请填写用户密码', {icon: 8});
        $("#username").focus();
        return false;
    }
    if(realname==""){
        layer.msg('请填写真实姓名', {icon: 8});
        $("#realname").focus();
        return false;
    }

    if(accessid==="-1"||accessid===-1){
        layer.msg('请选择用户所属角色', {icon: 8});
        $("#user_accessname").focus();
        return false;
    }

    $.post(APP+"/Api/Web/addAdminUser",
    "username="+username+"&password="+password+"&realname="+realname+"&accessid="+accessid,
    function(data){
        parent.location.reload();
        parent.layer.close(index);
    },"json");
    

});

//修改用户确认
$('#btn_modi_user').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var userid=$("#userid").val();
    var username=$("#username").val();
    var realname=$("#realname").val();
    var accessid=$("#user_accessname").val();

    if(username==""){
        layer.msg('请填写用户昵称', {icon: 8});
        $("#username").focus();
        return false;
    }
    if(realname==""){
        layer.msg('请填写真实姓名', {icon: 8});
        $("#realname").focus();
        return false;
    }
    if(accessid==="-1"||accessid===-1){
        layer.msg('请选择用户所属角色', {icon: 8});
        $("#user_accessname").focus();
        return false;
    }

    if($("#oldPassword").val()==""){
        $.post(APP+"/Api/Web/modiAdminUser",
            "username="+username+"&realname="+realname+"&accessid="+accessid+"&userid="+userid,
            function(data){
                parent.location.reload();
                parent.layer.close(index);
        },"json");
    }else{
        if($("#newPassword").val()==""){
            layer.msg('请填写新密码', {icon: 8});
            $("#newPassword").focus();
            return false;
        }else{
            $.post(APP + "/Api/Web/confirmPassword", "oldPassword=" + $("#oldPassword").val()+"&userid="+userid, function (v) {
                if (v.result === '000000') {
                    $.post(APP+"/Api/Web/modiAdminUser",
                        "username="+username+"&realname="+realname+"&accessid="+accessid+"&userid="+userid+"&newPassword="+$("#newPassword").val(),
                        function(data){
                            parent.location.reload();
                            parent.layer.close(index);
                    },"json");
                } else {
                    layer.msg('旧密码不正确，请重新输入！', {'icon': 8});
                    return false;
                }
            }, 'json');


        }
    }
});


//修改用户或角色
$('#modi_admin').on('click',function(){
    isauthority('1400','b');
    if(accessVal===false){
        layer.msg("你无权使用此功能，如需帮助联系管理员");
        return false;
    }else {
        var accessid = $("input[name='accessid']:checked");
        if(accessid.length===0){
            layer.msg("请选择要修改的记录",{'icon':8});
            return false;
        }else if(accessid.length>1){
            layer.msg("修改只能选择一条记录，你选择了"+accessid.length+"条",{'icon':8});
            return false;
        }else{
            var v = $(this).attr('value');
            switch (v) {
                case '0':
                    layer.open({
                        title: '修改用户',
                        type: 2,
                        area: ['650px', '450px'],
                        content: APP + '/Taskadmin/power/modi_user?id='+accessid.val()
                    });
                    break;
                case '1':
                    layer.open({
                        title: '修改角色',
                        type: 2,
                        area: ['1000px', '800px'],
                        content: APP+'/Taskadmin/power/modi_access?accessid='+accessid.val()
                    });
                    break;
                default:
                    layer.open({
                        title: '修改用户',
                        type: 2,
                        area: ['650px', '450px'],
                        content: APP + '/Taskadmin/power/modi_user?id='+accessid.val()
                    });
                    break;
            }

        }
    }
});



function getAccessModiValue(i,arr){
    var task_arr ="";

    if($("input[id='"+i+"']:checked").val()!= undefined)
    {
        $("input[name='"+i+"']:checked").each(function () 
        {
            if (task_arr === "") {
                task_arr += $(this).val();
            } else {
                task_arr += "," + $(this).val();
            }
        });

        if(task_arr=="")
        {
            arr[accessCount]=$("input[id='"+i+"']:checked").val();
        }else{
            arr[accessCount]=$("input[id='"+i+"']:checked").val()+"|"+task_arr;
        }
        accessCount++
    }
    return arr;
}

var iCount=0;
function judgeAccessId(i,arr1){
    var task_arr1 ="";
    $("input[name='"+i+"']:checked").each(function (){
        if ($("input[id='"+i+"']:checked").val()== undefined) {
           task_arr1++;
           arr1[iCount]=task_arr1;
        }
        iCount++;
    });
    return arr1;
}

//修改角色确认
$('#btn_modi_access').on('click',function(){
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var id=$("#id").val();
    var accessvalue="";
    var accessname=$("#accessName").val();
    var num=$("#num").val();
    var arr=new Array();
    var arr1=new Array();
    accessCount=0;

    for(var i=1;i<=num;i++)  
    {  
        getAccessModiValue(i,arr);
    }  

    for(var i=1;i<=num;i++)  
    {  
        judgeAccessId(i,arr1);
    }  

    if(arr1.length>0){
        layer.msg('请先勾选大类', {icon: 8});
        return false;
    }

    accessvalue=arr.join("{||}");
    
    // $("input[name='power']:checked").each(function () {
    //     if (task_arr === "") {
    //         task_arr += $(this).val();
    //     } else {
    //         task_arr += "," + $(this).val();
    //     }
    // });

    // arr=task_arr.split(",");
    // for (var i = 0; i <arr.length; i++) {
    //     if(arr[i]%100==0){
    //         if(arr[i-1]!=null){
    //             accessvalue+="{||}"+arr[i];
    //             if (arr[i+1]!=null&&arr[i+1]%100!=0) {
    //                 accessvalue+="|";
    //             }
    //         }else{
    //             if(arr[i+1]%100==0){
    //                 accessvalue+=arr[i]
    //             }else{
    //                 accessvalue+=arr[i]+"|";
    //             }
    //         }
    //     }else{
    //         if(arr[i+1]==null||arr[i+1]%100==0){
    //             accessvalue+=arr[i];
    //         }
    //         else{
    //             accessvalue+=arr[i]+","; 
    //         }
    //     }
    // }
    
    $.post(APP+"/Api/Web/modiAdmin",
    "accessname="+accessname+"&accessvalue="+accessvalue+"&id="+id,
    function(data){
        parent.location.reload();
        parent.layer.close(index);
    },"json");
});

//授权用户
$('#access_admin').on('click',function(){
    isauthority('1400','d')
    if(accessVal) {
        var id_arr = "";
        $("input[name='accessid']:checked").each(function () {
            if (id_arr === "") {
                id_arr += $(this).val();
            } else {
                id_arr += "|" + $(this).val();
            }
        });

        if (id_arr === "") {
            layer.msg("请选择要授权的记录", {'icon': 8});
            return false;
        } else {
             $.post(APP + "/Api/Web/accessAdminUser", "ids=" + id_arr, function (v) {
                    if (v.result === '000000') {
                        plist_user(0);
                    } else {
                        layer.msg('授权失败', {'icon': 8});
                        return false;
                    }
                }, 'json');
        }

    }else{
    layer.msg("你无权使用此功能，如需帮助联系管理员");
       return false;
    }
});

function checkBehavior(searchTime,startTime,count)
{
    layer.open({
        title: '登录数详情',
        type: 2,
        area: ['650px', '450px'],
        content: APP + '/Taskadmin/BehaviorAnalysis/checkBehavior?startTime='+startTime+"&count="+count+"&searchTime="+searchTime
    });
}

function checkAllBehavior(startTime,count)
{
    layer.open({
        title: '登录数详情',
        type: 2,
        area: ['650px', '450px'],
        content: APP + '/Taskadmin/BehaviorAnalysis/checkAllBehavior?startTime='+startTime+"&count="+count
    });
}

function checkReg(regTime,count)
{
    layer.open({
        title: '注册数详情',
        type: 2,
        area: ['650px', '450px'],
        content: APP + '/Taskadmin/BehaviorAnalysis/checkReg?regTime='+regTime+"&count="+count
    });
}

function checkAllReg(regTime,count)
{
    layer.open({
        title: '注册数详情',
        type: 2,
        area: ['650px', '450px'],
        content: APP + '/Taskadmin/BehaviorAnalysis/checkAllReg?regTime='+regTime+"&count="+count
    });
}