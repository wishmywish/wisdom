/**
 * Created by Administrator on 2016/1/26.
 */
//点击开始按钮
var totel = 0;
var oncetotal=0;
var s = 30;
//剩余的次数
//var times=3;

function getmoney(){
    //alert("11111111111");
    var array = eval(cc);
    var a = parseInt(99*Math.random());
    totel += parseFloat(array[a]);
    $("#money").html(fomatFloat(totel,2)+"元");
}

function  starthb(){
        if(times==0){
            //alert("今天次数已用完");
            layer.msg("今天次数已用完",{
                offset: 60
                //,shift: 6
            });
            //$("#start").attr("onclick","");
        }else{
            times=times-1;
            bb_1 = setInterval("bb()", 1000);
            ss = setInterval("aa()", 500);
            $("#times").html("(剩余"+times+"次)");
            $("#start").attr("onclick","");
            totel=0;
            $("#money").html("0元");
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



//自己抢到的红包数
function  my_give_once(money){
    var f_mypcid=$("#f_mypcid").val();
    var f_hepcid=0;
    var f_goldcoin=money;
    if(money===0){
        layer.msg("不要灰心，再接再厉！",{
            offset: 0,
            shift: 6
        });
    }
    $.post(APP+"/Mobileweb/Games/conf","command=addgold&f_mypcid="+f_mypcid+"&f_hepcid="+f_hepcid+"&f_goldcoin="+f_goldcoin,function(val){
        if(val.error_code=="000000"){
            //layer.msg("红包已经存入你的账户");
            $("#start").attr("onclick","starthb()");
        }else{
            layer.msg(val.error_text,{
                offset: 0,
                shift: 6
            });
        }
    },"json");
}



function  friend_help(){
   layer.msg("点击右上角发送给朋友或朋友圈");
}

