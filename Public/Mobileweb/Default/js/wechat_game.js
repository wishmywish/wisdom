/**
 * Created by Administrator on 2016/1/28.
 */
/**
 * Created by Administrator on 2016/1/26.
 */
//点击开始按钮
var totel = 0;
var s = 30;

function getmoney(){
    //alert("11111111111");
    var array = eval(cc);
    console.log(array);
    var a = parseInt(99*Math.random());
    totel += parseFloat(array[a]);
    $("#money").html(fomatFloat(totel,2)+"元");
}

function  starthb(){
    //alert(times);
    var fri_sum = parseInt($("#fri_sum").val());
    //alert(fri_sum);
    if(fri_sum===0){
        layer.msg("今天好友帮忙次数已用完",{
            offset: 60
        });
    }else {
        if (times == 0) {
            layer.msg("你已经帮好友领了", {
                offset: 60
            });
            //$("#start").attr("onclick","");
        } else {
            times = times - 1;
            if (times < 0) {
                times = 0
            }
            bb_1 = setInterval("bb()", 1000);
            ss = setInterval("aa()", 500);
            //$("#times").html("(剩余"+times+"次)");
            $("#start").attr("onclick", "");
            totel = 0;
            $("#money").html("0元");
        }
    }

}

function aa(){
    if(s>=0){
        $("#bb_time").html(s+"秒");
        var a = parseInt(8*Math.random());
        var b = parseInt(8*Math.random());
        $("#hongbao li").attr("onclick","");
        $("#hongbao li ").attr("class","iconfont  icon-hongbao");
        $("#hongbao li:eq("+a+") ").attr("class"," iconfont  icon-hongbao active");
        $("#hongbao li:eq("+a+")").attr("onclick","getmoney()");
        $("#hongbao li:eq("+b+")").attr("class"," iconfont  icon-hongbao active");
        $("#hongbao li:eq("+b+")").attr("onclick","getmoney()");
    }else{
        clearInterval(ss);
        clearInterval(bb_1);
        $("#hongbao li").attr("onclick","");
        $("#hongbao li ").attr("class","iconfont  icon-hongbao");
        s=30;
        $("#bb_time").html(s+"秒");
        //将每次获得的红包数存入数据库
        my_give_once(totel);
    }
}

function bb(){
    s-=1;
}


function fomatFloat(src,pos){
    return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);
}



//帮别人抢到的红包数
function  my_give_once(money){
    var f_mypcid=$("#b_fmypcid").val();
    var f_hepcid=$("#b_fhelpid").val();
    //alert(f_hepcid);
    var f_goldcoin=money;
    //$.post(APP+"/Mobileweb/Games/conf","command=addgold&f_mypcid="+f_mypcid+"&f_hepcid="+f_hepcid+"&f_goldcoin="+f_goldcoin,function(val){
    //    if(val.error_code=="000000"){
    //        //layer.msg("红包已经存入你的账户");
    //        $("#start").attr("onclick","start()");
    //    }else{
    //        layer.msg(val.error_text);
    //    }
    //},"json");
}



function  my_get(){
    var f_hepcid=$("#b_fhelpid").val();
    location.href=APP+"/Mobileweb/Hbgame/wechat_gguide?f_pcid="+f_hepcid;
}

