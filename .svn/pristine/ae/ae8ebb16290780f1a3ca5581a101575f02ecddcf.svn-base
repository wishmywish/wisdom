
function is_conf(conf_auth,auth_code){
    if(conf_auth==='F'){
        return '0';
    }else{
        if(auth_code==='conf_success'){
            return '1';
        }
    }
}


//招商业务计算佣金
function psum(){
    var pricesum = 0;
    var payment = $('#payment').val()===""?0:$('#payment').val();
    var bond = $('#bond').val()===""?0:$('#bond').val();
    var franchise = $('#franchise').val()===""?0:$('#franchise').val();
    var otherprice = $('#otherprice').val()===""?0:$('#otherprice').val();
    var plan_count = $('#plan_count').html()?$('#plan_count').html():0;
    pricesum = Number(payment)+Number(bond)+Number(franchise)+Number(otherprice);
    $('#pricesum_txt').html(Math.round(pricesum*100)/100);
    pricesum = pricesum+40000;
    //$('#pricesum_txt').html(Math.round(pricesum*100)/100);
    $('#pricesum').val(pricesum);

    $('#commission').val(Math.round(pricesum*0.25*100*0.5)/100);
    //业务员佣金
    $('#agents_commission').val(Math.round(pricesum*0.25*0.5*100*0.5)/100);

    //税务处理
    $('#shuiw_commission').val(Math.round(pricesum*0.25*0.5*100*0.1)/100);
    //商务人员处理
    $('#shangw_commission').val(Math.round(pricesum*0.25*0.5*100*0.1)/100);
    //推广人员佣金
    $('#tuig_commission').val(Math.round(pricesum*0.25*0.5*100*0.1)/100);
    //平台运营费用
    $('#piny_commission').val(Math.round(pricesum*0.25*0.5*100*0.2)/100);
    
    $('#pins_commission').html(Math.round(pricesum*0.25*0.5*100)/100);
    //佣金合计
    $('#commission_txt').html(Math.round(pricesum*0.25*0.5*100)/100);

    $('#totalcommission').html(Math.round(plan_count*pricesum*0.25*0.5*100)/100);

    $('.single_total_money').html(Math.round(pricesum*0.25*100*0.5)/100);
    $('#agents_commission_txt').html(Math.round(pricesum*0.25*0.5*100*0.5)/100);
}



//企业招商业务计算佣金
function psum_q(){
    var pricesum = 0;
    var payment = $('#payment').val()===""?0:$('#payment').val();
    var bond = $('#bond').val()===""?0:$('#bond').val();
    var franchise = $('#franchise').val()===""?0:$('#franchise').val();
    var otherprice = $('#otherprice').val()===""?0:$('#otherprice').val();
    pricesum = Number(payment)+Number(bond)+Number(franchise)+Number(otherprice);
    $('#pricesum_txt').html(Math.round(pricesum*100)/100);
    pricesum = pricesum+40000;
    //$('#pricesum_txt').html(Math.round(pricesum*100)/100);
    $('#commission').val(Math.round(pricesum*0.25*100*0.5)/100);
    //业务员佣金
    $('#agents_commission').val(Math.round(pricesum*0.25*0.5*100*0.5)/100);

    //税务处理
    $('#shuiw_commission').val(Math.round(pricesum*0.25*0.5*100*0.1)/100);
    //商务人员处理
    $('#shangw_commission').val(Math.round(pricesum*0.25*0.5*100*0.1)/100);
    //推广人员佣金
    $('#tuig_commission').val(Math.round(pricesum*0.25*0.5*100*0.1)/100);
    //平台运营费用
    $('#piny_commission').val(Math.round(pricesum*0.25*0.5*100*0.2)/100);

    $('#pins_commission').val(Math.round(pricesum*0.25*0.5*100*0.5)/100);
    //佣金合计
    $('#commission_txt').val(Math.round(pricesum*0.25*100*0.5)/100);
    $('.single_total_money').html(Math.round(pricesum*0.25*100*0.5)/100);
    $('#agents_commission_txt').html(Math.round(pricesum*0.25*0.5*100*0.5)/100);
    //总目标佣金
    var sale_money = parseInt($(".single_total_money").text()); //单个总佣金
    var area_totoal_num =  parseInt($("#area_stats_num").val()); //区域总数
    var total_area_money = sale_money*area_totoal_num;  //总目标佣金
    $(".total_money_want").text(total_area_money);

}





function a_comm(){
    var agents_commission = $('#agents_commission').val()===""?0:$('#agents_commission').val();
    $('#commission').val(agents_commission*2);
    //$('#agents_commission').val(agents_commission);
    $('#commission_txt').html(agents_commission*2);
    $('#agents_commission_txt').html(agents_commission);
}

//招商平台佣金
function a_comm1(){
    var commission_txt = $('#commission_txt').val();
    //业务员佣金
    $('#agents_commission').val(commission_txt*0.5);
    //税务处理
    $('#shuiw_commission').val(commission_txt*0.1);

    //商务人员佣金
    $('#shangw_commission').val(commission_txt*0.1);

    //推广人员佣金
    $('#tuig_commission').val(commission_txt*0.1);
   //平台运营费用
    $('#piny_commission').val(commission_txt*0.2);
    $('.single_total_money').text(commission_txt);
    //总目标佣金
    var sale_money = parseInt(commission_txt); //单个总佣金
    var area_totoal_num =  parseInt($("#area_stats_num").val()); //区域总数
    var total_area_money = sale_money*area_totoal_num;  //总目标佣金
    $(".total_money_want").text(total_area_money);
}

//获取短信验证码
var wait=60;
var num = 1;  
function time(o) 
{  
    var phone = $("#login_mobile").val();
    if(phone===""){
        layer.msg("手机号不能为空",{icon:8});
        return false;
    }else if(!(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test(phone)){
        layer.msg("手机格式不正确",{icon:8});
        return false;
    }else {
        if (wait == 0) 
        {  
            o.removeAttribute("disabled");            
            o.value="获取验证码";  
            wait = 60;  
            num = 1;  
        } else {  
            o.setAttribute("disabled", true);  
            o.value="" + wait + "秒后重新获取";  
            wait--;  
            num--;  
            if (num == 0)
            {
                $.getJSON(APP + "/Api/Api/inport", "command=smsCode&voicephone=" + phone, function (val) {
                    if (val.error_code === "success") 
                    {
                        layer.msg("验证码已发送");
                    } else {
                        layer.msg("验证码发送失败，请重新确认");
                    }
                });
            };

 
            setTimeout(function() {  
                time(o)  
            },  
            1000) 
        }  
    }
}  