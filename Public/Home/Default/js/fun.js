/* global totalPage, act_type, total, pageSize, APP, Cookie */

//获取短信验证码
$(".getCode1").click(function(){
    var phone = $("#login_mobile").val();
    if(phone===""){
        layer.msg("手机号不能为空",{icon:8});
        return false;
    }else if(!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test(phone)){
        layer.msg("手机格式不正确",{icon:8});
        return false;
    }else {
        $.getJSON(APP + "/Api/Api/inport", "command=smsCode&voicephone=" + phone, function (val) {
            //console.log(val);
            if (val.error_code === "success") {
                layer.msg("验证码已发送");
            }else if(val.error_code === "sms_time"){
                layer.msg(val.error_text);
            }else {
                layer.msg("验证码发送失败，请重新确认");
            }
        });
    }
});

//获取短信验证码
$(".getCode2").click(function(){
    var phone = $("#give_mobile").val();
    //console.log(phone+"====");
    if(phone===""){
        layer.msg("手机号不能为空",{icon:8});
        return false;
    }else if(!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test(phone)){
        layer.msg("手机格式不正确",{icon:8});
        return false;
    }else {
        $.getJSON(APP + "/Api/Api/inport", "command=smsCode&voicephone=" + phone, function (val) {
            //console.log(val);
            if (val.error_code === "success") {
                layer.msg("验证码已发送");
            }else if(val.error_code === "sms_time"){
                layer.msg(val.error_text);
            }
            else {
                layer.msg("验证码发送失败，请重新确认");
            }
        });
    }
});


//时间戳转化为时间格式 2015-12-14
function createDate(uData){
	var update = new Date(uData*1000);//时间戳要乘1000
        //console.log("=========");
        var  year   = update.getFullYear();
        var  month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
        var day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
	return  year + '-' + month + '-' + day;
}

//时间戳转化为时间格式 2015-12-14 00:00:00
function createDate2(uData){
    var update = new Date(uData*1000);//时间戳要乘1000
    var  year   = update.getFullYear();
    var  month  = (update.getMonth()+1<10)?('0'+(update.getMonth()+1)):(update.getMonth()+1);
    var day    = (update.getDate()<10)?('0'+update.getDate()):(update.getDate());
    var hour = update.getHours();
    var min = update.getMinutes();
    var sec = update.getSeconds();

    return  year + '-' + month + '-' + day + '  ' + hour + ':' + min + ':' + sec;
}

//加载菜单大类
function getBcolumn(){
    $.get("{:U('Home/Api/getBigColumn')}",function(v){
            //console.log(v);
            
    },'json');
}
//大类菜单样式
//推广业务计算佣金
function calcu(){
      var totalprice1=0;     
      var taskbrand=$('#pro_taskProduct').val()===""?0:$('#pro_taskBrand').val();
      var taskproduct=$('#pro_taskProduct').val()===""?0:$('#pro_taskProduct').val();
      $('#pro_saleCommission').val(taskproduct);
      totalprice1=2*Number(taskproduct)*Number(taskbrand);
      $('#pro_saleCommission').html(taskproduct);
      $('#pro_totalFee').val(Math.round(totalprice1*100)/100);
      //console.log(taskbrand+","+taskproduct+","+totalprice1);
      
    }
    //随手业务计算佣金
function calcu2(){
      var totalprice1=0;     
      var taskbrand=$('#conven_taskProduct').val()===""?0:$('#conven_taskBrand').val();
      var taskproduct=$('#conven_taskProduct').val()===""?0:$('#conven_taskProduct').val();
      $('#conven_saleCommission').val(taskproduct);
      totalprice1=2*Number(taskproduct)*Number(taskbrand);
      $('#conven_saleCommission').html(taskproduct);
      $('#conven_totalFee').val(Math.round(totalprice1*100)/100);
      //console.log(taskbrand+","+taskproduct+","+totalprice1);
      
    }
//checkbox 全选
function all_checkLine(th,obj){
    if(!($(th).is(":checked"))){
        $("[name='"+obj+"']").removeProp('checked');
      
    }else{
        $("[name='"+obj+"']").prop('checked','true');
      
    }
}

//checkbox 中 部分选中
function checkLine(th,obj,id){
    if($('#'+obj+'_'+id).attr('checked')){
        $('#'+obj+'_'+id).removeAttr('checked');//如果已经是true,则取消选择
    }else{
        $('#'+obj+'_'+id).attr('checked','true'); //如果是false.则选中
    }
}


//审核管理三大菜单显示数据
//智能筛选数据
  function  review_menu0(){
     alert(1);
}   
//手动筛选数据
  function   review_menu1(){
     alert(2);
   
  }
//已招标的数据交互
   function  review_menu2(){
     alert(3);
}

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

//智慧招商任务---新增任务上传图片
//;!function(){
//
//    //上传图标
//    $('#upfile').change(function(){
//        //alert($(this).val());
//        $('#uplogo').ajaxSubmit({
//            dataType:  'json', //数据格式为json 
//            beforeSend: function() { //开始上传 
//                $('.show_img').empty(); //清空显示的图片 
//                $('.line_input').show();//显示图片模块
//                $('.progress_up').show(); //显示进度条 
//                $('.show_progress_no').show();
//                var percentVal = '0%'; //开始进度为0% 
//                $('.bar').width(percentVal); //进度条的宽度 
//                $('.show_progress_no').html(percentVal); //显示进度为0%
//                $('#btn_up').html("上传中..."); //上传按钮显示上传中
//            }, 
//            
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
//                console.log("上传成功图片的存储地址："+img);
//                $('.show_img').html("<img src='"+img+"' width=100 height=100>");
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
//
//}();

;!function(){
//招商任务上传任务图标
    $('#upfile').change(function(){
        //alert("haha");return;

        $(".show_img_remit").hide();
        // $('#btnRemit').attr('disabled',false);
        $("#show_img").show();
        $("#showPic").hide();

        //return;

        ajaxSub('#uplogo','#progress_up','#show_progress_no','#bar','#show_img','#btn_up','#fileid','img','#line_input_one');
    });

//经销商上传打款凭证
    $('#upfile1').change(function(){
        var dealerid = $("#dealerId").val();
        $.post(APP+"/Home/Dealer/two_contact_upload","dealerid="+dealerid,function(data){
            $("#tishi").empty("");
            $("#tishi").append("合同尚未确认，打款会产生风险，请谨慎操作");
            // if( data == 1){  //两个全同都已经上传
                $(".show_img_remit").hide();
                // $('#btnRemit').attr('disabled',false);
                $("#show_img").show();
                $("#showPic").hide();

                //return;

                ajaxSub('#uplogo','#progress_up','#show_progress_no','#bar','#show_img1','#btn_up','#fileid','img','#line_input_one');

            // }else{
                // alert("经销商与厂商合同未上传");return;
            // }
        });






    });

//经销商上传收货单
    $('#upfile_ban1').change(function(){

        var dealerid = $("#dealerId").val();
        $.post(APP+"/Home/Dealer/is_settlement","dealerid="+dealerid,function(data){
            $("#tishi").empty("");
            $("#tishi").append("打款尚未确认，发货会产生风险，请谨慎操作。");
            // if( data == 1){  //货款结算完成
                $(".show_img_receive").hide();
                // $('#btnReceive').attr('disabled',false);
                $("#show_img_ban").show();
                $("#showBan").hide();
                ajaxSub('#uplogo_ban','#progress_up_ban','#show_progress_no_ban','#bar_ban','#show_img_ban1','#btn_ban','#fileid_ban','img','#line_input_two');

            // }else{
                // alert("货款未结算");return;
            // }
        });




    });

 //招商上传任务banner
    $('#upfile_ban').change(function(){
        $(".show_img_receive").hide();
        // $('#btnReceive').attr('disabled',false);
        $("#show_img_ban").show();
        $("#showBan").hide();
        ajaxSub('#uplogo_ban','#progress_up_ban','#show_progress_no_ban','#bar_ban','#show_img_ban','#btn_ban','#fileid_ban','img','#line_input_two');
    });
    
//招商产品包装
    $('#upfile_pack').change(function(){
        ajaxSub('#upfile_up','#progress_up_pack','#show_progress_no_pack','#bar_pack','#show_img_pack','#btn_up_pack','#fileid_pack','file','#line_input_three');
    });
    
//招商宣传资料
    $('#upfile_propaganda').change(function(){
        ajaxSub('#upfile_up_propaganda','#progress_up_propaganda','#show_progress_no_propaganda','#bar_propaganda','#show_img_propaganda','#btn_up_propaganda','#fileid_propaganda','file','#line_input_four');
    });
    
//招商合格证书
    $('#upfile_certificate').change(function(){
        ajaxSub('#upfile_up_certificate','#progress_up_certificate','#show_progress_no_certificate','#bar_certificate','#show_img_certificate','#btn_up_certificate','#fileid_certificate','file','#line_input_five');
    });
    
//招商销售政策
    $('#upfile_policy').change(function(){
        ajaxSub('#upfile_up_policy','#progress_up_policy','#show_progress_no_policy','#bar_policy','#show_img_policy','#btn_up_policy','#fileid_policy','file','#line_input_six');
    });
    
//招商产品价格
    $('#upfile_price').change(function(){
        ajaxSub('#upfile_up_price','#progress_up_price','#show_progress_no_price','#bar_price','#show_img_price','#btn_up_price','#fileid_price','file','#line_input_seven');
    });

    //智慧招商服务合同之结清算协议
    $('#upfile_price2').change(function(){
        ajaxSub('#upfile_up_price2','#progress_up_price2','#show_progress_no_price2','#bar_price2','#show_img_price2','#btn_up_price2','#fileid_price2','file','#line_input_seven2');
    });
    
//招商其他
    $('#upfile_other').change(function(){
        ajaxSub('#upfile_up_other','#progress_up_other','#show_progress_no_other','#bar_other','#show_img_other','#btn_up_other','#fileid_other','file','#line_input_eight');
    });

    //招商其他
    $('#upfile_other12').change(function(){
        ajaxSub('#upfile_up_other12','#progress_up_other12','#show_progress_no_other12','#bar_other12','#show_img_other12','#btn_up_other12','#fileid_other12','file12','#line_input_eight12');
    });

   //推广赚图标
       $('#profileImg').change(function(){
         $(".show_img_contract").hide();
         // $('#btnContract').attr('disabled',false);
         $("#show_proimg1").show();
         $("#showPic1").hide();
        ajaxSub('#up_prologo','#progress_up_pro','#show_progress_no_pro','#pro_bar','#show_proimg1','#openImgBtn1','#profile1','img','#line_input_pro');
           $("#show_progress_no_pro").hide();
           $("#pro_bar").hide();
    });
    //厂商上传发货单
    $('#profileImg_company').change(function(){
        $(".show_proimg_company").hide();
        // $('#btnContract').attr('disabled',false);
        $("#show_proimg1").show();
        $("#showPic1").hide();
        ajaxSub('#up_prologo','#progress_up_pro','#show_progress_no_pro','#pro_bar','#show_proimg_company','#openImgBtn1','#profile1','img','#line_input_pro');
        $("#show_progress_no_pro").hide();
        $("#pro_bar").hide();
    });

    //经销商合同上传
    $('#profileImg1').change(function(){
        $(".show_img_contract").hide();
        // $('#btnContract').attr('disabled',false);
        $("#show_proimg1").show();
        $("#showPic1").hide();
        ajaxSub('#up_prologo','#progress_up_pro','#show_progress_no_pro','#pro_bar','#show_proimg2','#openImgBtn1','#profile1','img','#line_input_pro');
        $("#show_progress_no_pro").hide();
        $("#pro_bar").hide();
    });

     //厂家合同上传
    $('#profileImg_contract').change(function(){
        $(".show_img_contract").hide();
        // $('#btnContract').attr('disabled',false);
        $("#show_proimg1").show();
        $("#showPic1").hide();
        ajaxSub('#up_prologo','#progress_up_pro','#show_progress_no_pro','#pro_bar','#show_proimg_contract','#openImgBtn1','#profile1','img','#line_input_pro');
        $("#show_progress_no_pro").hide();
        $("#pro_bar").hide();
    });


//随手赚图标   
       $('#convenfileImg').change(function(){
       	$("#showPic2").hide();
        ajaxSub('#up_convenlogo','#progress_up_conven','#show_progress_no_conven','#conven_bar','#show_convenimg1','#openImgBtn2','#convenfile1','img','#line_input_conven');
           $("#show_progress_no_conven").hide();
           $("#conven_bar").hide();
    });
    
}();

function ajaxSub(submitkey,progresskey,progressnokey,barkey,showkey,btnkey,hiddenkey,filetype,line_input){

    //console.log(filetype);

    $(submitkey).ajaxSubmit({
        dataType:  'json', //数据格式为json 
        beforeSend: function() { //开始上传 
            //$(showkey).empty(); //清空显示的图片 
            $(line_input).show();//显示图片模块
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

            if(data.error_no==='999999'){
                layer.msg("上传失败");
                $(barkey).width('0');
                $(progressnokey).html('0%'); //显示上传进度百分比
            }else if(data.error_no==='654321'){
                layer.msg("文件格式不符合要求,上传失败");
                $(barkey).width('0');
                $(progressnokey).html('0%'); //显示上传进度百分比
            }else if(data.error_no==='123456'){
                layer.msg("文件过大,上传失败");
                $(barkey).width('0');
                $(progressnokey).html('0%'); //显示上传进度百分比
            }else{
                if(filetype==='file'){

                }else if(filetype==='img'){
                    //显示上传后的图片
                    var img = UPFILE+"/"+data.upfile.savepath+data.upfile.savename;
                    //console.log("上传成功图片的存储地址："+img);
                    if(showkey=="#show_img"){
                        $(showkey).html("<img src='"+img+"' width=100 height=100><a onclick='getimg(1)'>预览</a>");
                    }else if(showkey=="#show_img_ban"){
                        $(showkey).html("<img src='"+img+"' width=300 height=100><a  class='show_phone1' onclick='getimg(2)'>预览</a>");
                    }else{
                        $(showkey).html("<img src='"+img+"' width=100 height=100>");
                        if(showkey == "#show_proimg1"){
                            $("#imgView1").attr("src",img);
                        }
                    }


                    //$(showkey).html("<img src='"+img+"'>");

                    //console.log("显示id"+showkey);


                    //获取宽和高 start
                    var img_my = new Image();
                    img_my.src = img;

                    img_my.onload = function(){
                        var imgWidth = parseInt(img_my.width);  //上传图片的宽度
                        var imgHeight = parseInt(img_my.height); //上传图片的高度
                        // 打印
                        if( imgWidth != imgHeight  ){  // 图片比例 1:1
                            if(showkey == "#show_convenimg1"||showkey == "#show_proimg3"){
                                $("#fileid").val("-1");
                                $("#profile1").val("-2");
                                $("#convenfile1").val("-2");
                                layer.msg("图片比例应为1:1");
                            }
                        }

                        if( imgWidth != 3*imgHeight  ){ // 图片比例 3:1
                            //if( showkey == "#show_img_ban"  ){
                            //    $("#fileid_ban").val("-2");
                            //    layer.msg("图片比例应为3:1");
                            //}
                        }
                        //console.log('width:'+img_my.width+',height:'+img_my.height);

                    };
                    //获取宽和高 end





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

//////招商行业分类
//function getBigTrade(){
//    $.getJSON(APP+"/Taskadmin/Fun/getBigTrade",function(val){
//        $('#big').empty();
//        var list = "<option value='0'>选择行业大类</option>";
//        $.each(val,function(i,v){
//            list += "<option value='"+v.f_tradeid+"'>"+v.f_tradename+"</option>";
//        });
//
//    });
//}

//实例说明
function getimg(status){

    if(status==1){
        var imgsrc=$("#show_img").find("img").attr("src");
        var tasktitle=$("#title").val();
        var pro_Descrip=$("#pro_taskDescription").val();
        var coin=$("#agents_commission").val()*10;
        content1=APP+"/Home/Business/show_tasklogo?imgsrc="+imgsrc+"&tasktitle="+tasktitle+"&pro_Descrip="+pro_Descrip+"&coin="+coin+"";
    }
    if(status==2){
        var imgsrc=$("#show_img_ban").find("img").attr("src");
        var tasktitle=$("#title").val();
        var coin=$("#agents_commission").val()*10;
        content1=APP+"/Home/Business/show_taskbanner?imgsrc="+imgsrc+"&tasktitle="+tasktitle+"&coin="+coin+"";
    }

    layer.open({
        type: 2,
        closeBtn: 0,
        title: false,
        shadeClose: true,
        shade: 0.8,
        area: ['370px', '700px'],
        content:content1

    });
}

$('#biglist').on('change',function(){
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

//招商任务新增 第一步 创建任务
$('#task_one').click(function(){

   // if( $('#fileid').val()=== "-1" ){
   //     layer.msg('任务图标比例应为1:1', {icon: 8});
   //     return false;
   // }
   //
   //
   //if($('#fileid').val()===""){
   //     layer.msg('请上传任务图标', {icon: 8});
   //     return false;
   // }
   //
   // if($('#fileid_ban').val()==="-2"){
   //     layer.msg('任务广告比例应为3:1', {icon: 8});
   //     return false;
   // }
   //
   //
   // if($('#fileid_ban').val()===""){
   //     layer.msg('请上传任务广告', {icon: 8});
   //     return false;
   // }
    if($('#companyId1').val()===""){
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
    if($('#pro_taskDescription').val().trim().length > 30){
        layer.msg('招商描述字数不能超过30字', {icon: 8});
        $('#pro_taskDescription').focus();
        return false;
    }
    //
    //var patt1 = new RegExp("[`~!@#$^&*()=|{}':;'\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'？]");
    //if((patt1).test($('#pro_taskDescription').val())){
    //    layer.msg('招商描述不能含有特殊字符', {icon: 8});
    //    $('#pro_taskDescription').focus();
    //    return false;
    //}


    var tradeid = $('#tradeid').val();
    if(tradeid==0){
        layer.msg('请选择行业', {icon: 8});
        return false;
    }

    var indexid=$("#indexid").val();

    var taskid = $('#taskid').val();


    //=============

    var payment = $('#payment').val()===""?0:$('#payment').val();
    var bond = $('#bond').val()===""?0:$('#bond').val();
    var franchise = $('#franchise').val()===""?0:$('#franchise').val();
    var otherprice = $('#otherprice').val()===""?0:$('#otherprice').val();
    var pricesum = $('#pricesum_txt').text();
    var commission = $('#commission_txt').val();
    var agents_commission=$('#agents_commission').val();
    //税务处理
    var shuiw_commission=$('#shuiw_commission').val();

    //商务人员佣金
    var shangw_commission=$('#shangw_commission').val();

    //推广人员佣金
    var tuig_commission=$('#tuig_commission').val();
    //平台运营费用
    var piny_commission=$('#piny_commission').val();

    //是否提供试用
    var whprovidetrial=parseInt($("input[name='whprovidetrial']:checked").val());
    //试用样品份数
    var trialnum=parseInt($("#trialnum").val());
    //试用是否付费
    var whpaid=parseInt($("input[name='whpaid']:checked").val());
    //试用样品单价
    var trialprice=parseInt($("#trialprice").val());
    //console.log(taskid+"创建任务第一步");
    var data = "{'command':'cTask','taskid':taskid,'creatuserid':'0','indexid':indexid,'tasktypeid':$('#tasktypeid').val(),'tradeid':tradeid,'fileid':$('#fileid').val(),'fileid_ban':$('#fileid_ban').val(),'companyId':$('#companyId1').val(),'title':$('#title').val(),'startdate':$('#startdate').val(),'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'taskDescription':$('#pro_taskDescription').val(),'linkphone':$('#linkphone').val(),'payment':payment,'bond':bond,'franchise':franchise,'otherprice':otherprice,'pricesum':pricesum,'commission':commission,'agents_commission':agents_commission,'shuiw_commission':shuiw_commission,'shangw_commission':shangw_commission,'tuig_commission':tuig_commission,'piny_commission':piny_commission,'whprovidetrial':whprovidetrial,'trialnum':trialnum,'whpaid':whpaid,'trialprice':trialprice}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
        if(val.error_code==="success"){
            Cookie.createCookie('now_taskid',val.taskid,1);
            $("#indexid").val(val.two_index);
            if(taskid==0){
                layer.msg('创建任务成功，继续下一步');
            }
            else{
                layer.msg('编辑创建任务成功，继续下一步');
            }
            $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").next(".step_two").addClass("business_taskAdd_step_selected");
            $('#business_taskAdd_step_contener0').hide();
            $('#business_taskAdd_step_contener1').show();
        }else{
            layer.msg(val.error_text, {icon: 8});
        }
    },'json');
});


//招商任务新增 第二步 基本信息

$('#task_two').click(function(){
    var mtbrand = $('#mtbrand');
    var mtgoods = $('#mtgoods');
    var payment = $('#payment').val()===""?0:$('#payment').val();
    var bond = $('#bond').val()===""?0:$('#bond').val();
    var franchise = $('#franchise').val()===""?0:$('#franchise').val();
    var otherprice = $('#otherprice').val()===""?0:$('#otherprice').val();
    var pricesum = $('#pricesum_txt').text();
    var commission = $('#commission_txt').val();
    var tradeid = $('#tradeid').val();
    var indexid = $('#indexid');

    //是否提供试用
    var whprovidetrial=parseInt($("input[name='whprovidetrial']:checked").val());
    //试用样品份数
    var trialnum=parseInt($("#trialnum").val());
    if(whprovidetrial==1||whprovidetrial=="1"){
          if(trialnum<1){
              layer.msg("试用样品数至少为1份");
              $("#trialnum").focus();
              return false;
          }
    }

    //试用是否付费
    var whpaid=parseInt($("input[name='whpaid']:checked").val());
    //试用样品单价
    var trialprice=parseInt($("#trialprice").val());
    if(whpaid==1||whpaid=="1"){
        if(trialprice<0.01){
            layer.msg("试用样品单价至少为0.01元");
            $("#trialprice").focus();
            return false;
        }
    }


    //业务员佣金
    var agents_commission=$('#agents_commission').val();
    //税务处理
    var shuiw_commission=$('#shuiw_commission').val();

    //商务人员佣金
    var shangw_commission=$('#shangw_commission').val();

    //推广人员佣金
    var tuig_commission=$('#tuig_commission').val();
    //平台运营费用
    var piny_commission=$('#piny_commission').val();

    var area_stats =parseInt($('#area_stats').val());
    var area_stats_num = parseInt($('#area_stats_num').val());  //招商数量总数
    var pro_stats =parseInt($('#pro_stats').val());


    //企业星级 0普通企业 1银牌企业 2金牌企业 3钻石企业
    var star_state = Cookie.readCookie("LYX_companyLevel");

    //招商区域及数量中招商数量设置：普通企业：最低1个；黄金企业/钻石企业：最低10个
    if( star_state >1 ){
        if( area_stats_num < 10 ){
            layer.msg("招商总数不能低于10");
            return;
        }
    }else{
        if( area_stats_num < 1 ){
            layer.msg("招商总数不能低于1");
            return;
        }
    }



    if(mtbrand.val()===""){
        layer.msg('招商品牌必填', {icon: 8});
        mtbrand.focus();
        return false;
    }
    var data = "{'command':'iTask','indexid':indexid.val(),'taskid':Cookie.readCookie('now_taskid'),'mtbrand':mtbrand.val(),'mtgoods':mtgoods.val(),'payment':payment,'bond':bond,'franchise':franchise,'otherprice':otherprice,'pricesum':pricesum,'commission':commission,'agents_commission':agents_commission,'tradeid':tradeid,'shuiw_commission':shuiw_commission,'shangw_commission':shangw_commission,'tuig_commission':tuig_commission,'piny_commission':piny_commission,'whprovidetrial':whprovidetrial,'trialnum':trialnum,'whpaid':whpaid,'trialprice':trialprice}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
        if(val.error_code==="success"){
            $('#indexid').val(val.two_index);
//          Cookie.createCookie('now_taskid',val.taskid,1);
            if(indexid.val()==0){
                layer.msg('添加任务基本信息成功，继续下一步');
            }else{
                layer.msg('编辑任务基本信息成功，继续下一步');
            }
            $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").next(".step_three").addClass("business_taskAdd_step_selected");
            $('#business_taskAdd_step_contener0').hide();
            $('#business_taskAdd_step_contener1').hide();
            $('#business_taskAdd_step_contener3').show();
        }else{
            layer.msg(val.error_text, {icon: 8});
        }
    },'json');
    
});

//基本信息中上一步
$("#task_two_to_one").click(function(){
	var taskid=Cookie.readCookie("now_taskid");
	$('#taskid').val(taskid);
	//console.log(taskid+"上一步");
    $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").prev(".step_one").addClass("business_taskAdd_step_selected");
    $('#business_taskAdd_step_contener0').show();    
    $('#business_taskAdd_step_contener1').hide();
});

//招商任务新增 第三步 产品及区域

  //1、添加区域及数量
$('#add_area').click(function(){
    var s_province = $('#s_province').val();
    var s_city = $('#s_city').val()==="地级市"?"":$('#s_city').val();
    var s_county = $('#s_county').val()==="市、县级市"?"":$('#s_county').val();
    var business_sum = $('#business_sum');
    if(s_province==="省份"){
        layer.msg('请选择招商省份',{icon:8});
        return false;
    }
    if(business_sum.val()==="" || business_sum.val()<=0){
        layer.msg('招商数量必需填写',{icon:8});
        business_sum.focus();
        return false;
    }

    //招商数量最少20
    //if( business_sum.val() < 20 ){
    //    layer.msg('招商数量最小20',{icon:8});
    //    business_sum.focus();
    //    return false;
    //}
    
    var area = s_province;
    if(s_city!==""){
        area = area+"|"+s_city;
        if(s_county!==""){
            area = area+"|"+s_county;
        }
    }
    
    //添加区域
    var data = "{'command':'addArea','area':area,'qty':business_sum.val(),'taskid':Cookie.readCookie('now_taskid')}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.error_code==="success"){
            getArea(v.taskid);
        }
    },'json');

    //总目标佣金
    var sale_money = parseInt($('#commission_txt').val()); //单个总佣金
    var area_totoal_num =  parseInt($("#area_stats_num").val()); //区域总数
    var total_area_money = sale_money*area_totoal_num;  //总目标佣金
    $(".total_money_want").text(total_area_money);
});

   //2、获取区域及数量

function getArea(taskid){
    var data = "{'command':'getArea','taskid':taskid}";
    var list = "";
    var area_stats_num = 0;
    $('#business_situation_list_top').show();
    $('#business_situation_list_conter').empty();
    $.getJSON(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.list!==""){
            $.each(v.list,function(i,val){
                list += "<ul>";
                list += "<input type=\"hidden\" value=\""+val.f_indexid+"\"/>";
                list += "<li>"+val.f_area+"</li>";
                list += "<li style=\"color:#F08300\" id='qty_"+val.f_indexid+"'>"+val.f_qty +"</li>";
                list += "<li style=\"color:red;cursor:pointer\"  id='business_situation_delete_"+i+"' onclick=\"business_situation_delete(this,"+val.f_indexid+")\">删除</li>";
                list += "</ul>";

                area_stats_num += parseInt(val.f_qty);

            });
            $('#business_situation_list_conter').append(list);
            $('#area_stats').val(1);//改变状态
            $('#area_stats_num').val(area_stats_num);//招商数量总数

            $(".all_area_name").html(area_stats_num);

        }
    });
}


  //2-1 招商情况信息删除
   //获取招商情况总数量
  
   
   //删除招商情况的数量
  function  business_situation_delete(obj,id){
      //alert("dfnvdsklnvlsbd");

      var area_num = parseInt($("#qty_"+id).html()); //要删除的区域招商数量
      var area_stats_num = parseInt($("#area_stats_num").val())-area_num;
       $("#area_stats_num").val(area_stats_num); $(".all_area_name").html(area_stats_num); //招商数量总数

      var ul=obj.parentNode;
      if(ul){
          ul.remove();
          var dataId="{'command':'deteArea','areaId':id}";
          console.log(id);
          $.post(APP+"/Api/Api/inport",eval('('+dataId+')'),function(data){
                console.log(data);

                   layer.msg("删除成功",{icon:9});
            
          },'json');
          //总目标佣金
          var sale_money = parseInt($('#commission_txt').val()); //单个总佣金
          var area_totoal_num =  parseInt($("#area_stats_num").val()); //区域总数
          var total_area_money = sale_money*area_totoal_num;  //总目标佣金
          $(".total_money_want").text(total_area_money);
      }


  }

  //3、添加招商产品明细
  $('#add_pro').click(function(){
    var goodsname = $('#goodsname');
    var modle = $('#modle');
    var unit = $('#unit');
    var agencyprice = $('#agencyprice');
    var sellingprice = $('#sellingprice');
    var saleprice = $('#saleprice');
    if(goodsname.val()===""){
        layer.msg("请输入产品名称",{icon:8});
    }
    if(modle.val()===""){
        layer.msg("请输入产品规格",{icon:8});
    }
    if(unit.val()===""){
        layer.msg("请输入计量单位",{icon:8});
    }
    if(agencyprice===""){
        layer.msg("请输入经销价",{icon:8});
    }
    if(sellingprice===""){
        layer.msg("请输入分销价",{icon:8});
    }
    if(saleprice===""){
        layer.msg("请输入零销价",{icon:8});
    }
    //添加招商产品明细
    var data = "{'command':'addPro','goodsname':goodsname.val(),'modle':modle.val(),'unit':unit.val(),'agencyprice':agencyprice.val(),'sellingprice':sellingprice.val(),'saleprice':saleprice.val(),'taskid':Cookie.readCookie('now_taskid')}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.error_code==="success"){
            getPro(v.taskid);
        }
    },'json');
});

  //获取招商产品明细
function getPro(taskid){
    var data = "{'command':'getPro','taskid':taskid}";
    var list = "";
    $('#product_descript_list_top').show();
    $('#product_descript_list_conter').empty();
    $.getJSON(APP+"/Api/Api/inport",eval('('+data+')'),function(v){
        if(v.list!==""){
            $.each(v.list,function(i,val){
                list += "<ul>";
                list += "<input type=\"hidden\" value=\""+val.f_indexid+"\"/>";
                list += "<li>"+val.f_goodsname+"</li>";
                list += "<li>"+val.f_modle+"</li>";
                list += "<li>"+val.f_unit+"</li>";
                list += "<li>"+val.f_agencyprice+"</li>";
                list += "<li>"+val.f_sellingprice+"</li>";
                list += "<li>"+val.f_saleprice+"</li>";
                list += "<li style=\"color:#14bce1;cursor:pointer\"  id='business_product_delete_"+i+"'  onclick=\"business_product_delete(this,"+val.f_indexid+")\">删除</li>";
                list += "</ul>";
            });
            $('#product_descript_list_conter').append(list);
            $('#pro_stats').val(1);//改变状态
        }
    });
}

  //3-1删除招商产品明细
  function  business_product_delete(obj,id){
      var ul=obj.parentNode;
      if(ul){
          ul.remove();
          var dataId="{'command':'detePro','proId':id}";
          $.post(APP+"/Api/Api/inport",eval('('+dataId+')'),function(v){
                   layer.msg("删除成功",{icon:8});
            
          },'json');
      }
  }
  
  $('#task_three').click(function(){
    var area_stats =parseInt($('#area_stats').val());
    var area_stats_num = parseInt($('#area_stats_num').val());  //招商数量总数
    var pro_stats =parseInt($('#pro_stats').val());


      //企业星级 0普通企业 1银牌企业 2金牌企业 3钻石企业
      var star_state = Cookie.readCookie("LYX_companyLevel");

      //招商区域及数量中招商数量设置：普通企业：最低1个；黄金企业/钻石企业：最低10个
      if( star_state >1 ){
          if( area_stats_num < 10 ){
              layer.msg("招商总数不能低于10");
              return;
          }
      }else{
          if( area_stats_num < 1 ){
              layer.msg("招商总数不能低于1");
              return;
          }
      }

    
    if(area_stats===0){
        layer.msg('请添加招商情况',{icon:8});
    }else{
        if(pro_stats===0){
            layer.msg('请添加招商产品明细',{icon:8});
        }else{
            if(Cookie.readCookie('now_taskid')!=""){
                layer.msg('编辑产品及区域成功，继续下一步');
            }else{
                layer.msg('添加产品及区域成功，继续下一步');
            }
            
            $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").next(".step_four").addClass("business_taskAdd_step_selected");
            $('#business_taskAdd_step_contener0').hide();
            $('#business_taskAdd_step_contener1').hide();
            //$('#business_taskAdd_step_contener2').hide();
            $('#business_taskAdd_step_contener3').show();
        }
    }
});


//第三步中的上一步
$("#task_three_to_two").click(function(){
    $('#indexid').val(Cookie.readCookie("LYX_business_indexid"));
    $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").prev(".step_two").addClass("business_taskAdd_step_selected");
    $('#business_taskAdd_step_contener0').hide();
    $('#business_taskAdd_step_contener1').show();
    //$('#business_taskAdd_step_contener2').hide();
    $('#business_taskAdd_step_contener3').hide();
});
  
//招商任务新增 第四步  任务详情
$('#task_four').click(function(){
    var brandlocation = $('#brandlocation');
    var slogan = $('#slogan');
    var sellingpoint = $('#sellingpoint');
    var targetgroup = $('#targetgroup');
    var distributorsrequir = $('#distributorsrequir');
    var retailoutlets = $('#retailoutlets');
    var channelpolicy = $('#channelpolicy');
    var editor = UM.getEditor('editor').getContent();
    var editor2 = UM.getEditor('editor2').getContent();
    var editor3 = UM.getEditor('editor3').getContent();
    var tindexid = $('#tindexid');
    
    if(brandlocation.val()===""){
        layer.msg('请输入品牌定位,30个字',{icon:8});
        brandlocation.focus();
        return false;
    }
    if(slogan.val()===""){
        layer.msg('请输入品牌广告语,30个字',{icon:8});
        slogan.focus();
        return false;
    }
    if(sellingpoint.val()===""){
        layer.msg('请输入产品的卖点,30个字',{icon:8});
        sellingpoint.focus();
        return false;
    }
    if(targetgroup.val()===""){
        layer.msg('请输入目标消费者,30个字',{icon:8});
        targetgroup.focus();
        return false;
    }
    if(distributorsrequir.val()===""){
        layer.msg('请输入经销商要求,30个字',{icon:8});
        distributorsrequir.focus();
        return false;
    }
    if(retailoutlets.val()===""){
        layer.msg('请输入主销售网点,30个字',{icon:8});
        retailoutlets.focus();
        return false;
    }
    if(channelpolicy.val()===""){
        layer.msg('请输入主要的推广及宣传,30个字',{icon:8});
        channelpolicy.focus();
        return false;
    }


    
    var data = "{'command':'xTask','tindexid':tindexid.val(),'taskid':Cookie.readCookie('now_taskid'),'brandlocation':brandlocation.val(),'slogan':slogan.val(),'sellingpoint':sellingpoint.val(),'targetgroup':targetgroup.val(),'distributorsrequir':distributorsrequir.val(),'retailoutlets':retailoutlets.val(),'channelpolicy':channelpolicy.val(),'note':editor,'product':editor2,'company_note':editor3}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
        //console.log("haha2");return;

        if(val.error_code==="success"){
            //Cookie.createCookie('task_tindexid',val.taskid,1);
            layer.msg('添加任务详情成功，继续下一步');
            $("#tindexid").val(val.tindexid);
            if(tindexid.val()==0){
                layer.msg('添加任务详细信息成功，继续下一步');
            }else{
                layer.msg('编辑任务详细信息成功，继续下一步');
            }
            $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").next(".step_four").addClass("business_taskAdd_step_selected");
            $('#business_taskAdd_step_contener0').hide();
            $('#business_taskAdd_step_contener1').hide();
            //$('#business_taskAdd_step_contener2').hide();
            $('#business_taskAdd_step_contener3').hide();
            $('#business_taskAdd_step_contener4').show();
        }else{
            layer.msg(val.error_text, {icon: 8});
        }
    },'json');
    

});

//第四步中 上一步
$("#task_four_to_three").click(function(){

    $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").prev(".step_two").addClass("business_taskAdd_step_selected");
    $('#business_taskAdd_step_contener0').hide();
    $('#business_taskAdd_step_contener1').show();
    //$('#business_taskAdd_step_contener2').show();
    $('#business_taskAdd_step_contener3').hide();
    $('#business_taskAdd_step_contener4').hide();
});

//招商任务新增 第五步  上传附件
$('#task_five').click(function(){
    var fileid_pack = $('#fileid_pack').val()===""?0:$('#fileid_pack').val();
    var fileid_propaganda = $('#fileid_propaganda').val()===""?0:$('#fileid_propaganda').val();
    var fileid_certificate = $('#fileid_certificate').val()===""?0:$('#fileid_certificate').val();
    var fileid_policy = $('#fileid_policy').val()===""?0:$('#fileid_policy').val();
    var fileid_price = $('#fileid_price').val()===""?0:$('#fileid_price').val();
    var fileid_price2 = $('#fileid_price2').val()===""?0:$('#fileid_price2').val();
    var fileid_other = $('#fileid_other').val()===""?0:$('#fileid_other').val();
    var fileid_other12 = $('#fileid_other12').val()===""?0:$('#fileid_other12').val();
    var findexid =  $('#findexid').val()===""?0:$('#findexid').val();
    //var indexid=$("#indexid").val();
     //if( $('#fileid').val()=== "-1" ){
     //    layer.msg('任务图标比例应为1:1', {icon: 8});
     //    return false;
     //}


    if($('#fileid').val()===""){
         layer.msg('请上传任务图标', {icon: 8});
         return false;
     }

     //if($('#fileid_ban').val()==="-2"){
     //    layer.msg('任务广告比例应为3:1', {icon: 8});
     //    return false;
     //}


     if($('#fileid_ban').val()===""){
         layer.msg('请上传任务广告', {icon: 8});
         return false;
     }


    if( fileid_pack == 0 ){  //新增时才需要判断
        layer.msg("商标注册证或授权使用证书图片必须提供");
        return false;
    }

    if( fileid_propaganda == 0){
        layer.msg("经销商合同必须提供");
        return false;
    }

    if( fileid_certificate == 0 ){
        layer.msg("产品和宣传资料图片必须提供");
        return false;
    }

    if( fileid_policy == 0 ){
        layer.msg("产品价格表必须提供");
        return false;
    }

    if( fileid_price == 0 ){
        layer.msg("销售市场支持政策必须提供");
        return false;
    }

    if( fileid_price2 == 0 ){
        layer.msg("智慧招商服务合同之结清算协议");
        return false;
    }

    var data = "{'command':'addFiles','companyId':Cookie.readCookie('LYX_companyId'),'taskid':Cookie.readCookie('now_taskid'),'tasktypeid':$('#tasktypeid').val()," +
        "'fileid':$('#fileid').val(),'fileid_ban':$('#fileid_ban').val(),'companyId':$('#companyId1').val(),'title':$('#title').val(),'startdate':$('#startdate').val()," +
        "'enddate':$('#enddate').val(),'linkman':$('#linkman').val(),'taskDescription':$('#pro_taskDescription').val(),'linkphone':$('#linkphone').val()," +
        "'findexid':findexid,'file1':fileid_pack,'file2':fileid_propaganda,'file3':fileid_certificate,'file4':fileid_policy,'file5':fileid_price,'file8':fileid_price2,'file6':fileid_other,'file7':fileid_other12}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
        if(val.error_code==="success") {
            $("#findexid").val(val.findexid_six);
            if(findexid==0){
                layer.msg('添加上传任务附件成功，继续下一步');
            }else{
                layer.msg('编辑上传任务附件成功，继续下一步');
            }
            $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").next(".step_five").addClass("business_taskAdd_step_selected");
            $('#business_taskAdd_step_contener0').hide();
            $('#business_taskAdd_step_contener1').hide();
            //$('#business_taskAdd_step_contener2').hide();
            $('#business_taskAdd_step_contener3').hide();
            $('#business_taskAdd_step_contener4').hide();
            $('#business_taskAdd_step_contener5').show();

        }else{
            layer.msg(val.error_text, {icon: 8});
        }
    },"json");

});

//


//招商任务  第六步到第五步   诚信保证金
$('#task_six_to_five').click(function(){
    $('#findexid').val(Cookie.readCookie("LYX_findexid_six"));
    $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").prev(".step_four").addClass("business_taskAdd_step_selected");
    $('#business_taskAdd_step_contener0').hide();
    $('#business_taskAdd_step_contener1').hide();
    //$('#business_taskAdd_step_contener2').hide();
    $('#business_taskAdd_step_contener3').hide();
    $('#business_taskAdd_step_contener4').show();
    $('#business_taskAdd_step_contener5').hide();
});



//招商任务新增 第六步  诚信保证金  提交
$('#task_six').click(function(){
    //招商总首批款
    var firstmony=$("#pricesum_txt").val()*$("#all_area_name").val();

    //招商总佣金
    var zhaoyong=$("#total_money_want").val();
    //诚信保障金
    var bao_money = $("input[name=bao_money]").val();

    var action = $(this).attr("action"); //获取动作类型 add 是新增,edit 是编辑

    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引


    //是否进入监管账户
    var  jianguan=$("#jianguan").val();


    //判断企业信息是否完善了，状态为5的时候给个提示信息(有权限去完善资料，无权限提示去找管理员完善资料)
    // companyState  企业中的state 1.已审核 2.未开通招商 3.已删除 4.待审核 0.未通过 5 新注册
    var qiye = $(this).attr("qiye");  //企业状态
    var qiyePower = $(this).attr("qiyePower"); //是否有设置企业的权限
    if( qiye == 5 ){
        if( qiyePower == 0 ){
            layer.msg("请联系管理员完善资料");
            //return false;
        }else{
            layer.confirm('请先完善企业资料', {
                btn: ['确定','取消'] //按钮
            }, function(index){
                location.href=APP+"/Admin/Companyset/index";
            }, function(index){
                layer.close(index);
            });
            return false;
        }

    }

    if((firstmony+bao_money)<zhaoyong){
        layer.msg("招商首批款+总诚信金的金额不能小于招商佣金，请重新核对");
        return false;
    }
    var data1="{'bao_money':bao_money,'jianguan':jianguan}";

    $.post(APP+"/Home/Api/credit",eval('('+data1+')'),function(data){
        if(data.resCode=="000000"){
            var data = "{'status':'2','taskid':Cookie.readCookie('now_taskid'),'companyId':Cookie.readCookie('LYX_companyId')}";
            $.post(APP+"/Api/Web/changeStatutask",eval('('+data+')'),function(val){
                if(val.error_code==="success"){
                    location.href=APP+"/Home/Business/task";
                    parent.layer.close(index);
                }else{
                    layer.msg(val.error_text, {icon: 8});
                }
            },'json');
        }else{
            layer.msg(val.error_text, {icon: 8});
        }
    },'json');

});


//招商任务新增 第六步  诚信金  保存
$('#task_six_save').click(function(){
    //招商总首批款
    var firstmony=$("#pricesum_txt").val()*$("#all_area_name").val();

    //招商总佣金
    var zhaoyong=$("#total_money_want").val();
    //诚信保障金
    var bao_money = $("input[name=bao_money]").val();

    //var action = $(this).attr("action"); //获取动作类型 add 是新增,edit 是编辑

    //是否进入监管账户
    var  jianguan=$('input:radio[name="jianguan"]:checked').val();
    console.log(jianguan);
    if((firstmony+bao_money)<zhaoyong){
        layer.msg("招商首批款+总诚信金的金额不能小于招商佣金，请重新核对");
        return false;
    }
    var  data="{'bao_money':bao_money,'jianguan':jianguan}";

    $.post(APP+"/Home/Api/credit",eval('('+data+')'),function(data){
        if(data.resCode=="000000"){
             location.href=APP+"/Home/Business/task";
        }else{
             layer.msg(data.errorMess, {icon: 8});
        }
    },'json');
});


//第五步中上一步
$("#task_five_to_four").click(function(){
    $('#tindexid').val(Cookie.readCookie("LYX_business_four_indexid"));
    $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").prev(".step_three").addClass("business_taskAdd_step_selected");
    $('#business_taskAdd_step_contener0').hide();
    $('#business_taskAdd_step_contener1').hide();
    //$('#business_taskAdd_step_contener2').hide();
    $('#business_taskAdd_step_contener3').show();
    $('#business_taskAdd_step_contener4').hide();
});






//分页bar的添加
 //获取分页条 
function getPageBar1(id){
    //var page;
   // var act_type=arguments[0]?arguments[0]:'';  //0可以替换成默认值
    page = parseInt(page);
    totalPage = parseInt(totalPage);

    //页码大于最大页数
//
//  console.log(page+"=======xxxx");
//  console.log(totalPage+"===");
//  console.log(page > totalPage);
    if(page>totalPage){page=totalPage};
    //页码小于1
    if(page<1) page=1;
  //  console.log(page+"=======");
    pageStr = "<span class='pagespanth pagenoclick'>共"+total+"条</span> <span class='pagespanth  pagenoclick'>每页"+pageSize+"条</span> <span class='pagespantw pagenoclick'>"+page+"/"+totalPage+"</span> ";
     
    //如果是第一页 
    if(page==1){
        pageStr += " <span class='pagespantw' style='color:#cccccc'><i class='fa fa-fast-backward fa-lg'></i></span> <span class='pagespanth ' style='padding-top:10px;font-size:15px;color:#cccccc'><i class='fa fa-caret-left fa-lg'></i></span>";
    }else{
        pageStr += " <span class='pagespantw '><a href='javascript:void(0)'  rel='1'><i  class='fa fa-fast-backward fa-lg'></i></a></span> <span class='pagespanth ' style='padding-top:10px;font-size:15px'><a href='javascript:void(0)'  rel='"+(page-1)+"'><i  class='fa fa-caret-left fa-lg'></i></a></span>";
    }
     
    //如果是最后页 
    if(page>=totalPage){ 
        pageStr += " <span  class='pagespanth' style='padding-top:10px;font-size:15px;color:#cccccc'><i class='fa fa-caret-right fa-lg'></i></span> <span  class='pagespantw ' style='color:#cccccc' ><i class='fa fa-fast-forward fa-lg'></i></span>";
    }else{ 
        pageStr += " <span class='pagespanth ' style='padding-top:10px;font-size:15px'><a  href='javascript:void(0)'  rel='"+(parseInt(page)+1)+"'><i class='fa fa-caret-right fa-lg '></i></a></span> <span  class='pagespanth'><a href='javascript:void(0)'    rel='"+totalPage+"'><i class='fa fa-fast-forward fa-lg'></i></a></span>";
    } 
    $("#"+id).html(pageStr);//底部
    
} 
//推广赚新增数据
function  pro_submit(){
    if($('#profile1').val()=="-2"){
        layer.msg('任务图标比例应为1:1', {icon: 8});
        return false;
    }

      if($('#profile1').val()==""){
        layer.msg('请上传任务图标', {icon: 8});
        return false;
    }
     if($('#taskTitle').val()==""){
        layer.msg('任务标题不能为空', {icon: 8});
        $('#taskTitle').focus();
        return false;
    }
     if($('#startTime').val()==""){
        layer.msg('任务开始时间必填', {icon: 8});
        return false;
    }
    if($('#endTime').val()==""){
        layer.msg('任务结束时间必填', {icon: 8});
        return false;
    }
     if($('#pro_linkman').val()==""){
        layer.msg('任务联系人不能为空', {icon: 8});
        $('#pro_linkman').focus();
        return false;
    }
     if($('#pro_linkphone').val()==""||!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test($('#pro_linkphone').val())){
        layer.msg('任务联系人的手机电话不能为空或手机号码错误', {icon: 8});
        $('#pro_linkphone').focus();
        return false;
    }
    if($('#pro_taskBrand').val()==""||$('#pro_taskBrand').val()==0 ){
        layer.msg('请输入任务总数或任务总数不能为空', {icon: 8});
        $('#pro_linkphone').focus();
        return false;
    }

    if( $('#pro_taskBrand').val() < 100 ){
        layer.msg('任务总数最少一百', {icon: 8});
        $('#pro_linkphone').focus();
        return false;
    }


     if($('#pro_taskProduct').val()==""||$('#pro_taskProduct').val()==0){
        layer.msg('请输入单次奖励的金币或单次奖励的金币不能为0', {icon: 8});
        $('#pro_taskProduct').focus();
        return false;
    }
     if($('#pro_taskDescription').val()==""){
        layer.msg('请输入任务描述', {icon: 8});
        $('#pro_taskDescription').focus();
        return false;
    }

    //var patt1 = new RegExp("[^%&',;=?$\x22]+");
    //if((patt1).test($('#pro_taskDescription').val())){
    //    layer.msg('不能含有特殊字符', {icon: 8});
    //    $('#pro_taskDescription').focus();
    //    return false;
    //}

    var taskid = $('#taskid').val();
    var indexid = $('#index_proid').val();
    var editor = UM.getEditor('editor').getContent();

    Cookie.createCookie('now_taskid',taskid,1);


     if(editor===""){
        layer.msg('请输入任务需求', {icon: 8});
        $("#editor").focus();
        return false;
    }


    //点击提交时，插入或编辑数据到数据库中，状态默认为待提交6，弹窗确定后修改状态为待审核2
    var data = "{'command':'cPush','taskid':taskid,'indexid':indexid,'creatuserid':'0','tasktypeid':1,'fileid':$('#profile1').val(),'fileid_ban':0,'companyId':$('#companyID').val(),'title':$('#taskTitle').val(),'startdate':$('#startTime').val(),'enddate':$('#endTime').val(),'linkman':$('#pro_linkman').val(),'linkphone':$('#pro_linkphone').val(),'pro_taskBrand':$('#pro_taskBrand').val(),'pro_taskProduct':$('#pro_taskProduct').val(),'pro_saleCommission':$('#pro_saleCommission').val(),'pro_totalFee':$('#pro_totalFee').val(),'pro_industry':$('#pro_industry').val(),'taskDescription':$('#pro_taskDescription').val(),'editor':editor}";
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){  //默认提交，不给予提示
        //if(val.error_code==="success"){
            Cookie.createCookie('now_taskid',val.taskid,1);
        //    //console.log(taskid);return;
        //
        //    if(taskid==0){
        //        layer.msg('创建任务成功');
        //
        //    }else{
        //        layer.msg('编辑任务成功');
        //    }
        //    location.href=APP+"/Home/Promotion/task";
        //}else{
        //    layer.msg(val.error_text, {icon: 8});
        //}
    },'json');
     
    layer.confirm('一旦提交，任务将进入待审核，不允许编辑该任务！是否立即提交？', {
        btn: ['确定','取消'], //按钮
        shade: false, //不显示遮罩
        icon: 3, 
        title:'添加提示'
    },function(index){  //弹窗确定后
           var data = "{'status':'2','taskid':Cookie.readCookie('now_taskid'),'companyId':Cookie.readCookie('LYX_companyId')}";
           $.post(APP+"/Api/Web/changeStatutask",eval('('+data+')'),function(val){
               if(val.error_code=="success"){
                   location.href=APP+"/Home/Promotion/task";
                   parent.layer.close(index);
               }else{
                   layer.msg("提交失败", {icon: 8});
               }
           },'json');

    },function(index){  //弹窗取消后
           location.href=APP+"/Home/Promotion/task";
           parent.layer.close(index);
    });

   

}

//随手赚任务新增 第一步 创建任务
$('#task_one_conven').click(function(){

    if($('#convenfile1').val()=="-2"){
        layer.msg('任务图标比例应为1:1', {icon: 8});
        return false;
    }

        if($('#convenfile1').val()==""){
        layer.msg('请上传任务图标', {icon: 8});
        return false;
    }
     if($('#taskTitle2').val()==""){
        layer.msg('任务标题不能为空', {icon: 8});
        $('#taskTitle2').focus();
        return false;
    }
     if($('#startTime2').val()==""){
        layer.msg('任务开始时间必填', {icon: 8});
        return false;
    }
    if($('#endTime2').val()==""){
        layer.msg('任务结束时间必填', {icon: 8});
        return false;
    }
     if($('#conven_linkman').val()==""){
        layer.msg('任务联系人不能为空', {icon: 8});
        $('#conven_linkman').focus();
        return false;
    }
     if($('#conven_linkphone').val()==""||!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test($('#conven_linkphone').val())){
        layer.msg('任务联系人的手机电话不能为空或者手机号码不正确', {icon: 8});
        $('#conven_linkphone').focus();
        return false;
     }
    if($('#conven_taskBrand').val()==""||$('#conven_taskBrand').val()==0){
        layer.msg('请输入任务总数或总数不能为0', {icon: 8});
        $('#conven_taskBrand').focus();
        return false;
    }


    if( $('#conven_taskBrand').val() < 100 ){
        layer.msg('任务总数最小为100', {icon: 8});
        $('#conven_taskBrand').focus();
        return false;
    }



     if($('#conven_taskProduct').val()==""||$('#conven_taskProduct').val()==0){
        layer.msg('请输入单次奖励的金币或奖励金币数不能为0', {icon: 8});
        $('#conven_taskProduct').focus();
        return false;
    }
   // console.log($('#tasktypeid').val()+"==============");
      if($('#tasktypeid').val()=="0"){
        layer.msg('请选择任务类型', {icon: 8});
        $('#tasktypeid').focus();
        return false;
    }
    
     if($('#taskDescription').val()==""){
        layer.msg('请输入任务描述', {icon: 8});
        $("#taskDescription").focus();
        return false;
    }


    //var patt1 = new RegExp("[^%&',;=?$\x22]+");
    //if((patt1).test($('#taskDescription').val())){
    //    layer.msg('描述不能含有特殊字符', {icon: 8});
    //    $('#taskDescription').focus();
    //    return false;
    //}


     var editor = UM.getEditor('editor1').getContent();
     if(editor===""){
        layer.msg('请输入任务需求', {icon: 8});
        $("#editor1").focus();
        return false;
    }
   //console.log($('#tasktypeid').val()+"=="+$('#companyID1').val()+"=="+$('#convenfile1').val()+"=="+$('#taskTitle2').val()+"=="+$('#startTime2').val()+"=="+$('#endTime2').val()+"=="+$('#conven_linkman').val()+"=="+$('#conven_linkphone').val()+"=="+$('#conven_taskBrand').val()+"=="+$('#conven_taskProduct').val()+"=="+$('#conven_saleCommission').val()+"=="+$('#conven_totalFee').val()+"=="+$('input[name=taskDegree]:checked').val()+"=="+$('#conven_industry').val()+"=="+$('#taskDescription').val()+"=="+editor);
   // alert($('#companyId1').val());
//    var taskid = $('#taskid1').val();
//    var indexid = $('#index_proid').val();

    var taskid = $("#taskId").val();
    //console.log(taskid+"====飞北京GV分====");
    //console.log(Cookie.readCookie("now_taskid")+"========="+taskid);
    //return false;
//    if (indexid == undefined) {
//        var taskid = 0;
//    };

    var indexid = $("#index_proid").val();
    //console.log(indexid+"======");
//    if (indexid == undefined) {
//        var indexid = 0;
//    };
    var data = "{'command':'cPush','taskid':taskid,'indexid':indexid,'creatuserid':'0','tasktypeid':$('#tasktypeid').val(),'fileid':$('#convenfile1').val(),'fileid_ban':0,'companyId':$('#companyID1').val(),'title':$('#taskTitle2').val(),'startdate':$('#startTime2').val(),'enddate':$('#endTime2').val(),'linkman':$('#conven_linkman').val(),'linkphone':$('#conven_linkphone').val(),'pro_taskBrand':$('#conven_taskBrand').val(),'pro_taskProduct':$('#conven_taskProduct').val(),'pro_saleCommission':$('#conven_saleCommission').val(),'pro_totalFee':$('#conven_totalFee').val(),'harder':$('input[name=taskDegree]:checked').val(),'taskDescription':$('#taskDescription').val(),'editor':editor}";    
     //console.log(eval('('+data+')')+"===============");
     //return false;
    $.post(APP+"/Api/Api/inport",eval('('+data+')'),function(val){
        //console.log(val);
        if(val.error_code==="success"){
            Cookie.createCookie('now_taskid',val.taskid,1);
            if(taskid==0){
                layer.msg('创建任务成功，继续下一步');
            }
            else{
                layer.msg('编辑创建任务成功，继续下一步');
            }
            $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").next(".step_two").addClass("business_taskAdd_step_selected");
            $('#taskAdd_conventionData_step1').hide();
            var tasktypeid=$('#tasktypeid').val();
            var le=$("#conven_bar_radio input[type=radio]");
            if(tasktypeid===$("#taskTemplate1").val()){ //答题
                $("#taskTemplate1").attr("checked","checked");
                $("#recomdtemp").hide();
                $("#quest").after("<span style='color:#f47469'>*正确答案在后面打勾*</span>");
                $("#quest").show();
            }
            if(tasktypeid===$("#taskTemplate2").val()){//推荐
                $("#taskTemplate2").attr("checked","checked");
                $("#quest").hide();
                $("#recomdtemp").show();
            }
            if(tasktypeid===$("#taskTemplate3").val()){//调研
                $("#taskTemplate3").attr("checked","checked");
                $("#recomdtemp").hide();
                $("#quest").show();
            }
            $("#taskTemplate1").attr("disabled","disabled");
            $("#taskTemplate2").attr("disabled","disabled");
            $("#taskTemplate3").attr("disabled","disabled");
            $('#taskAdd_conventionData_step2').show();
            
            
        }else{
            layer.msg(val.error_text, {icon: 8});
        }
    },'json');
});

//随手赚任务新增 第二步 任务模板

$('#task_two_conven').click(function(val){
    var taskid = $('#taskId').val();
    var tasktype=$('#tasktypeid').val();
    if(tasktype==5){ //推荐
        //推荐类型模板中的内容
        var editorrecommd = UM.getEditor('editor2').getContent();
        if(editorrecommd===""){
            layer.msg('请输入任务需求', {icon: 8});
            $("#editor2").focus();
            return false;
        }
        var list = "{'command':'cpush2Recomd','smalltaskid':Cookie.readCookie('LYX_now_indexid'),'recommd':editorrecommd}";
        $.post(APP+"/Api/Api/inport",eval('('+list+')'),function(val){
               if(val.error_code=="success"){
                   layer.msg('成功');
               }else if(val.error_code=="fail"){
                   layer.msg("失败");
               }
        });

    }else if(tasktype==4||tasktype==6){ //调研和答题

        var length=$("#quest > div").length;
        //var list="";
        //var listarray = eval('('+list+')');
        //  console.log(Cookie.readCookie('now_taskid')+"=======");
        for(var i=0;i<length;i++){
            var selected=$("#template_answer_selected_"+i).val();
            var checklist=[];
            if(tasktype==6) {

                var Stanswer = $("#template_answer_selected_" + i + " ~ input[type=checkbox]");
                Stanswer.each(function (k) {
                    //console.log("==="+k);
                    var m = k;
                    if (this.checked == true) {
                        checklist.push(m);
                    }
                });


                //单选个数判断
                if(selected==1){
                    if(checklist.length>1||checklist.length==0){
                        layer.msg("单选数不能超过1或者不能为0");
                        return ;
                    }
                }
                //多选数
                if(selected==2){
                    if(checklist.length<1||checklist.length==0){
                        layer.msg("多选不能少于1或者不能为0");
                        return;
                    }
                }

            }
                //console.log(checklist.length+"=="+selected);





            var indexid = $("#f_stdindex"+i).val();
            if (indexid == undefined) {
                var indexid = 0;
            };
            //list[i] = new Array();
            var question=$("#question_list_"+i+ " input[name=conventionDataInput]").val();
            //$("#question_list_"+i)

            var length2=$("#template_answer_selected_"+i+" ~  input[type=text]").length;

            var answer="";

            for(var j=0;j<length2;j++){
                answer+=$("#template_answer_selected_"+i+" ~  input[type=text]").eq(j).val().trim()+"|";
            }
            answer=answer.substring(0,answer.length-1);
            //答案的获取标准答案 在答题类形式才会有

                //console.log(question+"=="+selected+"=="+answer+"==="+(i+1)+"==="+checklist);
                var checklist1=checklist.join(",");


//        var indexid = $('#index_conid').val();
            var list = "{'command':'cPush2','taskid':Cookie.readCookie('now_taskid'),'indexid':indexid,'f_serial':i+1,'f_problemtatile':question,'f_type':selected,'f_options':answer,'f_trueanswer':checklist1}";
            $.ajaxSetup({
                async:false
            });
            var loadi=layer.load(0);
            // console.log(list);

            $.post(APP+"/Api/Api/inport",eval('('+list+')'),function(val){
                layer.close(loadi);
//          console.log(val);
//          return ;
                if(val.error_code=="success"){
                    layer.msg('创建任务成功',{icon:9});
//           	 location.href=APP+"/Home/Promotion/task";
                }else if(val.error_code=="edit_success"){
                    layer.msg('编辑任务成功',{icon:9});
//           	 location.href=APP+"/Home/Promotion/task";
                }else if(val.error_code=="small_info_fail"){
                    layer.msg('创建任务失败',{icon:8});
                    return;
                }else{
                    layer.msg('编辑任务失败',{icon:8});
                    return;
                }
            },"json");

        }
    }
     layer.confirm('一旦提交，任务将进入待审核，不允许编辑该任务！是否立即提交？', {
        btn: ['确定','取消'], //按钮
        shade: false, //不显示遮罩
        icon: 3, 
        title:'添加提示'
    },function(index){
         var data = "{'status':'2','taskid':Cookie.readCookie('now_taskid'),'companyId':Cookie.readCookie('LYX_companyId')}";
         //console.log(data);
//      return;
         $.post(APP+"/Api/Web/changeStatutask",eval('('+data+')'),function(val){
             if(val.error_code=="success"){
                 location.href=APP+"/Home/Promotion/task";
                 parent.layer.close(index);
             }else{
                 layer.msg("提交失败", {icon: 8});
             }
         },'json');

    },function(index){
         location.href=APP+"/Home/Promotion/task";
         parent.layer.close(index);

    });  
 
});



//随手赚任务新增 第二步 任务模板里的上一步
$("#task_two_to_one2").click(function(){
    var now_taskid=Cookie.readCookie("LYX_now_taskid");
	var taskid=$("#taskId").val(now_taskid);
	$("#index_proid").val(Cookie.readCookie("LYX_now_indexid"));
	//console.log(taskid+"===上一步==");
    $('.business_taskAdd_step li').removeClass("business_taskAdd_step_selected").prev(".step_one").addClass("business_taskAdd_step_selected");
    $('#taskAdd_conventionData_step1').show();
    $('#taskAdd_conventionData_step2').hide();
});



//资质及文档管理
 
function  qualificatdoc(){
    var companyid=Cookie.readCookie("LYX_companyId");
     var loadi;
     //alert(companyid);
     $.ajax({
               type:"post",
               url:APP+"/Api/Api/inport",
               data:"command=qualific_list&comanyid="+companyid,
               dataType:"json",
               beforeSend:function(){
                   loadi=layer.load(0);
               },
               success:function(val){
                    if(val.error_code=="no_one_data"){
                         //公司的资质没有的处理
                        // alert("无数据");
                         quali_nodate(val.list,companyid);
                        //向数据加载路径
                         for(var i=0;i<$('#business_quali_list1 ul').length;i++){
                             $("#upfile_business_licence"+(i+1)+"_"+companyid).wrap("<form id='uplogo_"+(i+1)+"_"+companyid+"'  action='"+APP+"/Api/Upfile/upF/type/2'  method='post' enctype='multipart/form-data'></form>");
                         }
                       
                    };
                    if(val.error_code=="have_data"){
                         //对于该公司含有资质的情况处理
                         quali_havadate();
                    }
               },
               complete:function(){
                     layer.close(loadi);
               }
           });
}



function   quali_nodate(a,companyid){
   $('#business_quali_list1').empty();
   var list="";
   $.each(a,function(i,v){
       //console.log(i+","+v.f_qualid+","+v.f_qualname);
       list+="<ul id='quali_list_"+v.f_qualid+"_"+companyid+"'>";
       list+="<li  class='quali_list_li_1' style='width:10%'>"+(i+1)+"</li>";
       list+="<li  class='quali_list_li_1' style='width:30%'>"+v.f_qualname+"</li>";
       list+="<li  class='quali_list_li_1' style='width:10%' id='quali_stats_"+v.f_qualid+"'></li>";
       list+="<li  class='quali_list_li_1' style='width:20%' id='quali_tupian_"+v.f_qualid+"'></li>";  
       list+="<li  class='quali_list_li_1' style='width:19%;'  id='business_licence_expriate_time_"+v.f_qualid+"_"+companyid+"'   class='laydate-icon'   onclick='laydate({elem:"+this.id+"})'></li>";
       list+="<li  class='quali_list_li2_1' style='width:10%'><span  onclick=$('#upfile_business_licence"+v.f_qualid+"_"+companyid+"').click()>上传</span><input style='display:none' type='file' id='upfile_business_licence"+v.f_qualid+"_"+companyid+"' onchange='upfile(this.id)'   name='upfile'  accept='image/jpeg,image/gif,image/png'></li>";
       list+="</ul>";
       
      
   });
    
    $('#business_quali_list1').append(list);
    //alert($('#business_quali_list1  ul').length);
    //每点击一次上传，就向后台数据库发送一次数据请求，并返回请求结果
    
}


//列表分页显示
function  listData(url_text,inData,Type,DType,type){
    var load1="";
    //alert(titleID+"=5");
      $.ajax({
         url:url_text,
         data:inData,
         type:Type,
         dataType:DType,
         beforeSend:function(){
            load1=layer.load();
        },
        success:function(reVal){
            total = reVal.total; //总记录数
            pageSize = reVal.pageSize; //每页显示条数
            page = reVal.page; //当前页
            totalPage = reVal.totalPage; //总页数
            //根据不同内容，输出不同的列表样式
            if(reVal.list!=null){
                 if(type==2){
                     $("#totalcoin").text(reVal.totalcoin);
                     $("#totalgivcoin").text(reVal.totalgivcoin);
                      showtrackearnList(reVal.list); 
                 }
                 if(type==1){
                     showtrackmakeList(reVal.list);
                 }
                 if(type==7){
                     showtrackauditList(reVal.list);
                 }
                
            }else{
                if(type==2){
                    $("#totalcoin").text(reVal.totalcoin);
                    $("#totalgivcoin").text(reVal.totalgivcoin);
                   $('#trackAudit_earn').empty();
                    var list="<ul style='text-align:center;color:red'><li>暂无数据！</li></ul>";
                   $('#trackAudit_earn').append(list);
                }
                
                if(type==1){
                     $('#trackAudit_make').empty();
                     var list="<ul style='text-align:center;color:red'><li>暂无数据！</li></ul>";
                     $('#trackAudit_make').append(list);
                }

                if(type==7){
                    $('#trackAudit_earn_audit').empty();
                    var list="<ul style='text-align:center;color:red'><li>暂无数据！</li></ul>";
                    $('#trackAudit_earn_audit').append(list);
                }
                
            }
            
        },
          complete:function(){
             layer.close(load1);
             if(type==2){
                  getPageBar1("trackAudit_earnpagebar");
             }
             if(type==1){
                  getPageBar1("trackAudit_makepagebar");
             }
              if(type==7){
                  getPageBar1("trackAudit_earnpagebar_audit");
              }
        }
    });
  }

//督查赚任务列表
function   showtrackauditList(list1){
    var list2="";
    var statusNote="";
    var status="";
    $('#trackAudit_earn_audit').empty();
    $.each(list1,function(i,n){
        status=n.taskStatus;
        if(status==="1"){
            statusNote="待审核";
        }
        if(status==="3"){
            statusNote="已审核";
        }
        if(status==="2"){
            statusNote="进行中";
        }
        if(status==="4"){
            statusNote="已失效";
        }
        if(status==="0"){
            statusNote="无效数据";
        }
        if(status==="5"){
            statusNote="已驳回";
        }
        id=(i+1);
        list2+="<ul>";
        list2+="<li class='title_mer' style='width:5%'><input style='vertical-align:middle' type='checkbox' role='checkbox' name='audit_earn_grid'  id='audit_earn_grid_"+n.userid+"' value='"+n.userid+"-"+n.superAddressID+"' data-userid='"+n.userid+"'/></li>";
        list2+="<li class='title_mer' style='width:10%'>"+(pageSize*(page-1)+id)+"</li>";
        list2+="<li class='title_mer' style='width:15%;overflow:hidden;white-space: nowrap;text-overflow:ellipsis;' title='"+ n.networkname+"'>"+n.networkname+"</li>";
        list2+="<li class='title_mer' style='width:20%;'>"+(n.truename==""?"***":n.truename)+"</li>";
        list2+="<li class='title_mer' style='width:15%;'>"+createDate(n.submitdate)+"</li>";
        list2+="<li class='title_mer' style='width:15%;color:#f38401'>"+statusNote+"</li>";
        list2+="<li class='title_mer' style='width:20%;'><a  style='color: blue' onclick='check_trackearn_surevylist("+n.titleId+","+n.userid+","+n.superAddressID+")'>点击进入</a></li>";
        list2+="</ul>";

    });
    $('#trackAudit_earn_audit').append(list2);
}
   
function  showtrackearnList(list1){
            var list2="";
            var statusNote="";
            var status="";
            $('#trackAudit_earn').empty();
            //alert(titleID+"=3");
            $.each(list1,function(i,n){
                  status=n.taskStatus;
                   if(status==="1"){
                       statusNote="待审核";
                   } 
                   if(status==="3"){
                       statusNote="已审核";
                   }
                   if(status==="2"){
                       statusNote="进行中";
                   }
                   if(status==="4"){
                       statusNote="已失效";
                   }
                   if(status==="0"){
                        statusNote="无效数据";
                   }
                   if(status==="5"){
                    statusNote="已驳回";
                   }
                   id=(i+1);
                   list2+="<ul>";
                   list2+="<li class='title_mer' style='width:5%'><input style='vertical-align:middle' type='checkbox' role='checkbox' name='trackAudit_earn_grid'  id='trackAudit_earn_grid_"+n.userid+"' value='"+n.userid+"'/></li>";
                   list2+="<li class='title_mer' style='width:10%'>"+(pageSize*(page-1)+id)+"</li>";
                   list2+="<li class='title_mer' style='width:15%;'>"+n.typename+"</li>";
                   list2+="<li class='title_mer' style='width:20%;'>"+(n.truename==""?"***":n.truename)+"</li>";
                   list2+="<li class='title_mer' style='width:15%;'>"+createDate(n.submitdate)+"</li>";
                   list2+="<li class='title_mer' style='width:15%;color:#f38401'>"+statusNote+"</li>";
                   list2+="<li class='title_mer' style='width:20%;'><a  style='color: blue' onclick='check_trackearn_surevylist("+n.titleId+","+n.userid+")'>点击进入</a></li>";
                   list2+="</ul>";
                  
             });
              $('#trackAudit_earn').append(list2);
             
        }
        
        
        
//任务标题
function   gettrackMaketitle(id,tasktype,selectid){
    //var load=layer.load(0);
    $.getJSON(APP+"/Api/Web/gettasktitle","companyid="+id+"&tasktypeid="+tasktype,function(val){
        var list="";
        //console.log(val.list.length+"====fjkgjfk");
        $('#'+selectid).empty();
        //layer.close(load);
        if(val.list.length!=0){
             //var list = "<option value='0' selected>选择任务标题</option>";
             $.each(val.list,function(i,v){
            list += "<option value='"+v.f_tid+"'  data-tasktype='"+v.f_typeid+"'>"+v.f_title+"</option>";
         });
             $('#'+selectid).append(list);
             if(tasktype==1){
                 trackmake_choosetype($("#track_list_title_make >option:eq(0)").val());
             }else if(tasktype==3){
                  if(selectid=="business_Manual_select"){
                      dealerchoose($("#"+selectid+">option:eq(0)").val(),3,'business_manualScreen_list','business_manualScreen_page',3);
                  }else if(selectid=="business_Manual_select2"){
                      //console.log(selectid+"选择项");
                      //已中标
                      dealerchoose($("#"+selectid+">option:eq(0)").val(),1,'business_success_list','business_success_page',1);
                  }else if(selectid=="business_Manual_select3"){
                      //已驳回
                      //console.log(selectid+"选择项");
                      dealerchoose($("#"+selectid+">option:eq(0)").val(),2,'business_reject_list','business_reject_page',2);
                  }


             }
        }else{
             var list="<option  value='0' selected >暂无可选任务</option>";
             $("#"+selectid).append(list);
         }

       });
}

//推广赚情况显示
function   showtrackmakeList(rel){
   // alert(rel+"=============");
    $("#trackAudit_make").empty();
    var list="";
    var wechat=0;
    var  WechatFavorite=0;
    var WechatMoments=0;
    var QZone=0;
    var QQ=0;
    var SinaWeibo=0;
    var TencentWeibo=0;
    $.each(rel,function(i,n){
        var length=n.numlist.length;
       for(var $i=0;$i<length;$i++){
            if(n.numlist[$i]['f_platform']==="Wechat"){
                 wechat=n.numlist[$i]['num'];
            }
            if(n.numlist[$i]['f_platform']==="WechatFavorite"){
                 WechatFavorite=n.numlist[$i]['num'];
            }
            
            if(n.numlist[$i]['f_platform']==="WechatMoments"){
                WechatMoments=n.numlist[$i]['num'];
            }
            
            if(n.numlist[$i]['f_platform']==="QZone"){
                QZone=n.numlist[$i]['num'];
            }
            if(n.numlist[$i]['f_platform']==="QQ"){
                 QQ=n.numlist[$i]['num'];
            }
            if(n.numlist[$i]['f_platform']==="SinaWeibo"){
                 SinaWeibo=n.numlist[$i]['num'];
            }
            
             if(n.numlist[$i]['f_platform']==="TencentWeibo"){
                 TencentWeibo=n.numlist[$i]['num'];
            }
             
       } 
       // console.log(n.numlist[0]['f_platform']);
        list+="<ul>";
        list+="<li class='title_mer' style='width:8%;'>"+(i+1)+"</li>";
        list+="<li class='title_mer' style='width:11%;' value="+n.userid+">"+(n.truename==""?"***":n.truename)+"</li>";
        list+="<li class='title_mer' style='width:12%;'>"+SinaWeibo+"</li>";
        list+="<li class='title_mer' style='width:12%;'>"+TencentWeibo+"</li>";
        list+="<li class='title_mer' style='width:12%;'>"+QZone+"</li>";
        list+="<li class='title_mer' style='width:10%;'>"+wechat+"</li>";
        list+="<li class='title_mer' style='width:13%;'>"+WechatMoments+"</li>";
        list+="<li class='title_mer' style='width:12%;'>"+WechatFavorite+"</li>";
        list+="<li class='title_mer' style='width:10%;'>"+QQ+"</li>";
        list+="</ul>";
        wechat=0;  WechatFavorite=0; WechatMoments=0; QZone=0;
        QQ=0; SinaWeibo=0; TencentWeibo=0;
    });
     $("#trackAudit_make").append(list);
              
}  //招商和推广任务列表删除
      
      function  business_task_del(taskid,i,ulid,datalistid,pageid,typeid){
          //console.log('#'+ulid+i);
          layer.confirm('你确定要删除此记录吗?',{
              btn:['确定','取消'],
              shade:false,
              icon:3,
              title:'删除提示'   
          },function(index){
              layer.close(index);
              $.post(APP+"/Api/Web/delTask","taskids="+taskid,function(v){
                 if(v.result==='000000'){
                     $('#'+ulid+i).remove();
                     if($('#'+datalistid+' ul').length ===0){
                         $('#'+pageid).empty();
                         $('#'+datalistid).append(error_list);
                     }
                     if(typeid==3){ //招商
                         ReloadData(3,companyId);
                       //重新加载数据列表
                     }else if(typeid==1){ //推广
                        pushTaskList(); 
                     }else if(typeid==2){ //随手+
                        widelyList();
                     }else if(typeid==0){ //推广与随手全部任务
                        promotionList();
                     }else if(typeid==7){
                         auditList();
                     }
                     
                     
                   }else{
                    layer.msg('删除失败',{'icon':8});
                    return false;
                  }
              },"json");
          },function(index){
              layer.close(index);
              return false;
          });
      }
    //招商推广任务列表对应的编辑
      function  pro_task_modi(taskid,i,tasktypeid){ 
          //getTasktype();
          layer.confirm('你确定要编辑此记录吗?',{
              btn:['确定','取消'],
              shade:false,
              icon:3,
              title:'编辑提示'
          },function(index){ 
                layer.close(index);
               location.href=APP+'/Home/Promotion/editprotask?taskid='+taskid+'&tasktypeid='+tasktypeid;
          },function(index){
              layer.close(index);
              return false;
          });
      }


//经销商查询数据
/**
 * 厂商上传附件获取
 * 先通过 t_authorization表中的 f_authnumber来查询 f_dealerid
 * 再通过 f_dealerid 查找表 t_dealbaseinfo 中的 f_taskid
 * 再通过 f_taskid 查找表 t_taskmtattach 中的 f_fielid1,f_fields2
 * 再通过 f_fields即  表t_files是的f_id 查找 f_filepath与f_filename 获得下载地址
 *
 * 经销商上传合同获取
 * 先通过 t_authorization表中的 f_authnumber来查询 f_dealerid
 * 再通过 f_dealerid 查找表 t_bussiness 中的 f_proname=contract 和 f_prostatus=1(经销商合同) 的 f_fileid
 *                                                               f_prostatus=2(厂家合同)  的f_fileid
 * 再通过 f_fields即  表t_files是的f_id 查找 f_filepath与f_filename 获得下载地址
 */
$("#checkContent").click(function(){
    var  authorityNum=$('input[name=authorityNum]').val();
    var  login_mobile=$('#login_mobile').val();
    var  login_code=$("input[name=login_code]").val();
    if(authorityNum===""){
        layer.msg('授权书编号不能为空',{icon: 8});
        $('input[name=authorityNum]').focus();
        return false;
    }
    
    if(login_code===""){
       layer.msg("验证码不能为空",{icon:8});
       $("input[name=login_code]").focus();
       return false;
    }

    //先验证输入的验证码是否正确
    $.get(APP+"/Api/Api/inport","command=codeauth&code="+login_code+"&voicephone="+login_mobile,function(val){
       if(val.error_code=="success"){

            $.post(APP+"/Api/Web/isTrue","authorityNum="+authorityNum,function(v){
                // console.log(v);
                if(v.result==='000000'){
                    $("#isShow").show();
                    $("#companyName").val(v.companyDetail.companyName);
                    $("#number").val(v.authorization.f_authnumber);
                    $("#trueName").val(v.userDetail.trueName);
                    $("#idCard").val(v.userDetail.idCard);
                    $("#mainArea").val(v.companyDetail.mainArea);
                    $("#companynameone").val(v.detail.f_companynameone);
                    $("#year").val(v.date[0]);
                    $("#month").val(v.date[1]);
                    $("#day").val(v.date[2]);
                    $("#companyname").val(v.companyDetail.companyName);
                    $("#dealerId").attr("value",v.authorization.f_dealerid);
                    $("#remitId").attr("value",v.remit.f_id);
                    $("#receiveId").attr("value",v.receive.f_id);
                    $("#contractId").attr("value",v.contract.f_id);

                    // $('#btnContract').attr('disabled',true);
                    // $('#btnRemit').attr('disabled',true);
                    // $('#btnReceive').attr('disabled',true);
                    var img1 = UPFILE+"/"+v.remit.f_filepath+v.remit.f_filename;
                    var img2 = UPFILE+"/"+v.receive.f_filepath+v.receive.f_filename;
                    var img3 = UPFILE+"/"+v.contract.f_filepath+v.contract.f_filename;
                    if (v.remit.f_filepath) {
                        $('.show_img_remit').html("<img src='"+img1+"' class='thumbImage'>");
                        // <button class='m_del' onclick='delRemit("+v.remit.f_id+")'>删除</button>
                        $("#fileid").attr("value",v.remit.f_fileid);
                    }
                    if (v.receive.f_filepath) {
                        $('.show_img_receive').html("<img src='"+img2+"' class='thumbImage'>");
                        // <button class='m_del' onclick='delReceive("+v.receive.f_id+")'>删除</button>
                        $("#fileid_ban").attr("value",v.receive.f_fileid);
                    }
                    if (v.contract.f_filepath) {
                        $('.show_img_contract').html("<img src='"+img3+"' class='thumbImage'>");
                        // <button class='m_del' onclick='delContract("+v.contract.f_id+")'>删除</button>
                        $("#profile1").attr("value",v.contract.f_fileid);
                    }
                    if (v.file2) {
                        $("#linkOne").empty();
                        //$("#linkOne").append("<a href="+v.linkOne+" class='rg' target='_blank'>下载</a>");
                        $("#linkOne").append("<a href='"+v.filepath+v.file2.f_filepath+ v.file2.f_filename+"'class='rg' target='_blank'>下载</a>");
                    }
                    //if (v.secondContract) {
                    //    $("#linkTwo").empty();
                    //    $("#linkTwo").append("<a href='"+ v.linkTwo+"'class='rg' target='_blank'>下载</a>");
                    //}

                    if (v.business_licence) {
                        $("#link_three").empty();
                        $("#link_three").append("<a href='"+v.filepath+v.business_licence.f_filepath+v.business_licence.f_filename+"' class='rg' target='_blank'>下载</a>");
                    }

                    if (v.san_license) {
                        $("#link_four").empty();
                        $("#link_four").append("<a href='"+v.filepath+v.san_license.f_filepath+v.san_license.f_filename+"' class='rg' target='_blank'>下载</a>");
                    }

                    //任务附件下载 start

                    if(v.file1){
                        $("#task_file1").empty();
                        $("#task_file1").append("<a href='"+v.filepath+v.file1.f_filepath+ v.file1.f_filename+"'class='rg' target='_blank'>下载</a>");
                    }

                    if(v.file2){
                        $("#task_file2").empty();
                        $("#task_file2").append("<a href='"+v.filepath+v.file2.f_filepath+ v.file2.f_filename+"'class='rg' target='_blank'>下载</a>");
                    }

                    if(v.file3){
                        $("#task_file3").empty();
                        $("#task_file3").append("<a href='"+v.filepath+v.file3.f_filepath+ v.file3.f_filename+"'class='rg' target='_blank'>下载</a>");
                    }

                    if(v.file4){
                        $("#task_file4").empty();
                        $("#task_file4").append("<a href='"+v.filepath+v.file4.f_filepath+ v.file4.f_filename+"'class='rg' target='_blank'>下载</a>");
                    }

                    if(v.file5){
                        $("#task_file5").empty();
                        $("#task_file5").append("<a href='"+v.filepath+v.file5.f_filepath+ v.file5.f_filename+"'class='rg' target='_blank'>下载</a>");
                    }

                    if(v.file8){
                        $("#task_file8").empty();
                        $("#task_file8").append("<a href='"+v.filepath+v.file8.f_filepath+ v.file8.f_filename+"'class='rg' target='_blank'>下载</a>");
                    }

                    //if(v.file7){
                    //    $("#task_file7").empty();
                    //    $("#task_file7").append("<a href='../Business/dealerContact?dealerfilesid="+v.file7.f_id+"'class='rg' target='_blank'>下载</a>");
                    //}

                    //任务附件下载 end


                }else{
                    layer.msg('没有相应数据',{'icon':8});
                    return false;
                }
            },'json');

        }else{
           layer.msg("验证失败,请重新输入验证码");
           $("#login_code").focus().val("");
           return false;
           }
        },"json");
});

// function delRemit(id)
// {
//     $.post(APP+"/Api/Web/delDealerPic","id="+id,function(v){
//         console.log(v);
//         if(v.result==='000000'){
//             $(".show_img_remit").empty();
//             $("#show_img").empty();
//             $('#btnRemit').attr('disabled',false);
//         }
//     },'json');
// }

// function delReceive(id)
// {
//     $.post(APP+"/Api/Web/delDealerPic","id="+id,function(v){
//         if(v.result==='000000'){
//             $(".show_img_receive").empty();
//             $("#show_img_ban").empty();
//             $('#btnReceive').attr('disabled',false);
//         }
//     },'json');
// }

// function delContract(id)
// {
//     $.post(APP+"/Api/Web/delDealerPic","id="+id,function(v){
//         if(v.result==='000000'){
//             $(".show_img_contract").empty();
//             $("#show_proimg1").empty();
//             $("#show_proimg1").empty();
//             // var name = "dela"+id;
//             // console.log(name);
//             // console.log($("#"+name+""));
//             //  var currentBtn = document.getElementById(name);
//             //  currentBtn.style.display = "none";
//             // $("#"+name+"").setAttribute("style","display:none;") ;
//             $('#btnContract').attr('disabled',false);
//         }
//     },'json');
// }

function contractBtn()
{
    var dealerId = $("#dealerId").val();
    var profile1 = $("#profile1").val();
    var contractId = $("#contractId").val();
    //console.log(contractId+"==="+dealerId+"===="+profile1);
    if (profile1) {
        $.post(APP+"/Api/Web/uploadContract","dealerId="+dealerId+"&profile1="+profile1+"&contractId="+contractId,function(v){
        // console.log(v);
            if(v.result==='000000'){
                layer.msg('上传成功',{icon: 9});
                // $('#btnContract').attr('disabled',true);
                // $("#delContract").append("<button class='m_del' onclick='delContract("+v.rid+")' id='dela("+v.rid+")' style=''>删除</button>");
            }
        },'json');
    }else{
        layer.msg('请先上传图片！',{icon: 8});
    };
}

function remitBtn()
{
    var dealerId = $("#dealerId").val();
    var profile1 = $("#fileid").val();
    var contractId = $("#remitId").val();
    //console.log(contractId);
    if (profile1) {
        $.post(APP+"/Api/Web/uploadRemit","dealerId="+dealerId+"&profile1="+profile1+"&contractId="+contractId,function(v){
        // console.log(v);
            if(v.result==='000000'){
                layer.msg('上传成功',{icon: 9});
                // $('#btnRemit').attr('disabled',true);
                // $("#delContract").append("<button class='m_del' onclick='delRemit("+v.rid+")' id='dela("+v.rid+")' style=''>删除</button>");
            }
        },'json');
    }else{
        layer.msg('请先上传图片！',{icon: 8});
    };
}

function receiveBtn()
{
    var dealerId = $("#dealerId").val();
    var profile1 = $("#fileid_ban").val();
    var contractId = $("#receiveId").val();
    //console.log(contractId);
    if (profile1) {
        $.post(APP+"/Api/Web/uploadReceive","dealerId="+dealerId+"&profile1="+profile1+"&contractId="+contractId,function(v){
        // console.log(v);
            if(v.result==='000000'){
                layer.msg('上传成功',{icon: 9});
                // $('#btnReceive').attr('disabled',true);
                // $("#delContract").append("<button class='m_del' onclick='delContract("+v.rid+")' id='dela("+v.rid+")' style=''>删除</button>");
            }
        },'json');
    }else{
        layer.msg('请先上传图片！',{icon: 8});
    };
}

function comContract()
{
    var dealerId = $("#dealerId").val();
    var profile1 = $("#profile1").val();
    if (profile1) {
        $.post(APP+"/Api/Web/comContract","dealerId="+dealerId+"&profile1="+profile1,function(v){
        // console.log(v);
            if(v.result==='000000'){
                layer.msg('上传成功',{icon: 9});
                // $('#comContract').attr('disabled',true);
                location.href=APP+'/Home/Business/proCheck?dealerid='+dealerId+"&type=2";
                // $("#delContract").append("<button class='m_del' onclick='delContract("+v.rid+")' id='dela("+v.rid+")' style=''>删除</button>");
            }else{
                layer.msg("上传失败");
            }
        },'json');
    }else{
        layer.msg('请先上传图片！',{icon: 8});
    };

}

function comDispath()
{
    var dealerId = $("#dealerId").val();
    var profile1 = $("#profile1").val();
    if (profile1) {
        $.post(APP+"/Api/Web/comDispath","dealerId="+dealerId+"&profile1="+profile1,function(v){
        // console.log(v);
            if(v.result==='000000'){
                layer.msg('上传成功',{icon: 9});
                // $('#comContract').attr('disabled',true);
                location.href=APP+'/Home/Business/proCheck?dealerid='+dealerId+"&type=6";
                // $("#delContract").append("<button class='m_del' onclick='delContract("+v.rid+")' id='dela("+v.rid+")' style=''>删除</button>");
            }
        },'json');
    }else{
        layer.msg('请先上传图片！',{icon: 8});
    };

}

//判断是否有合同
function isContract(dealerid)
{
        $.post(APP+"/Api/Web/isContract","dealerid="+dealerid,function(v){
        if(v.contractTwo){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=2";
        }else{
            if (v.contractOne){
                location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=3";
            }else{
                alert("该经销商尚未上传合同，请等待");
                location.reload();
            };
        }
    },'json');
}

//判断是否有合同
function isContract11(dealerid)
{
        $.post(APP+"/Api/Web/isContract","dealerid="+dealerid,function(v){
        if(v.contractTwo){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=2";
        }else{
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=3";
        }
    },'json');
}

//判断是否打款
function isRemit(dealerid)
{
        $.post(APP+"/Api/Web/isRemit","dealerid="+dealerid,function(v){
        if(v.remitTwo){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=4";
        }else{
            if (v.remitOne){
                location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=5";
            }else{
                alert("请确认前面步骤已经完成，再查看打款！");
                location.reload();
            };
        }
    },'json');
}

//判断是否打款
function isRemit11(dealerid)
{
        $.post(APP+"/Api/Web/isRemit","dealerid="+dealerid,function(v){
        if(v.remitTwo){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=4";
        }else{
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=5";
        }
    },'json');
}

//判断是否发货
function isDispatch(dealerid)
{
    $.post(APP+"/Api/Web/isDispatch","dealerid="+dealerid,function(v){
        if(v.dispatchTwo){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=6";
        }else{
            if (v.dispatchOne){
                location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=9";
            }else{
                alert("请确认前面步骤已经完成，再查看发货！");
                location.reload();
            };
        }
    },'json');
}

//判断是否发货
function isDispatch11(dealerid)
{
    $.post(APP+"/Api/Web/isDispatch","dealerid="+dealerid,function(v){
        if(v.dispatchTwo){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=6";
        }else{
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=9";
        }
    },'json');
}

//判断是否收货
function isReceive(dealerid)
{
    $.post(APP+"/Api/Web/isReceive","dealerid="+dealerid,function(v){
        if(v.receive){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=7";
        }else{
                alert("请确认前面步骤已经完成，再查看收货！");
                location.reload();
            };
    },'json');
}

//判断是否收货
function isReceive11(dealerid)
{
    $.post(APP+"/Api/Web/isReceive","dealerid="+dealerid,function(v){
        location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=7";
    },'json');
}

//判断是否结算
function isSettlement(dealerid)
{
    $.post(APP+"/Api/Web/isSettlement","dealerid="+dealerid,function(v){
        if(v.Settlement){
            location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=8";
        }else{
                alert("请确认前面步骤已经完成，再查看结算！");
                location.reload();
            };
    },'json');
}

//判断是否结算
function isSettlement11(dealerid)
{
    $.post(APP+"/Api/Web/isSettlement","dealerid="+dealerid,function(v){
        location.href=APP+'/Home/Business/proCheck?dealerid='+dealerid+"&type=8";
    },'json');
}

   //反馈意见的展现
 function  showreject(taskid){
	        layer.open({
	             type:2,
	             title:'意见反馈',
	             skin:'layui-layer-rim',
	             area:['560px','400px'],
	             fix:true,
	             move: false,
	             offset:'100px',
	             content:APP+'/Home/Api/showProReject?taskid='+taskid
	        });     
 }

 //任务预览
function preview(taskid){
    layer.open({
        title: '任务预览',
        type: 2,
        area: ['1000px', '500px'],
        content: APP+'/Home/Api/preview?taskid='+taskid
    });
}

/**
 * 日期格式化
 * @param string fmt 格式化格式
 * @return string 格式化后的日期
 * @author zhoushuangsheng
 */
Date.prototype.Format = function (fmt) { 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}