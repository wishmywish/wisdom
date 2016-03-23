/**
 * Created by Administrator on 2016/1/27.
 */
var cate = "";
var linum = -1;
var liindex = 0;
var scidarr = new Array();
var isshiju = false;
$(document).ready(function(){
    var swiper = new Swiper('.swiper-container', {
        //slidesPerView: 3,
        slidesPerView: 'auto',
        spaceBetween: 10
    });
    var myswiper = new Swiper('.myswiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        grabCursor: true,
        onInit: function(swiper){
            var index = 0;
            $(".myswiper-container ul li").each(function(i){
                if($(this).find('i').html()!=undefined){
                    index =i-1;
                }
            });
            swiper.slideTo(index, 500, false);
        }
    });
    var myswiper2 = new Swiper('.myswiper2-container', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        grabCursor: true,
        onInit: function(swiper){
            var index = 0;
            $(".myswiper2-container ul li").each(function(i){
                if($(this).find('i').html()!=undefined){
                    index =i-1;
                }
            });
            swiper.slideTo(index, 500, false);
        }
    });
    cate = getCookie("cate");
    cateChange(cate==""?"all":cate);
    shijulist();
    shijutoyellow();
    if($("#kw").val()=='')
        $("#kw").val(getCookie("kw"));
    $("#closebt").click(function(){
        $("#tips").hide();
    });
    $("#logo a").click(function () {
        setCookie("kw","");
    });

    //提交事件
    $("form").submit(function(e){
        if(kw == '')return false;
        return true;
    });
    $("#topnav ul li a").on('click',function(){
        $("#topnav ul li a").each(function(){
            $(this).removeClass('topnav_a_select');
        });
        $(this).addClass('topnav_a_select');
    });
    //顶部事件
    $("#totop").click(function(){
        timer = setInterval(function(){
            var top = document.body.scrollTop | document.documentElement.scrollTop;
            var speed = top/4;
            document.body.scrollTop = top-speed;
            document.documentElement.scrollTop = top-speed;
            if(top<=0){
                clearInterval(timer);
            }
        },20);
    });
    $("#middlediv a,.shicimore a").attr("target","");

    $("#search2_form").submit(function(e){
        e.preventDefault();
        var url = encodeURI($("#search2_zz").val());
        window.location = '/chaxun/shici/'+url+"%20"+encodeURI($("#kw2").val());
    });
    $("#sj_search2_form").submit(function(e){
        e.preventDefault();
        var url = encodeURI($("#search2_zz").val());
        window.location = '/chaxun/'+$("#sjform_url").val()+'/'+url+"%20"+encodeURI($("#kw2").val());
    });
    //滚动事件
    $(window).scroll(function(){
        var top = document.body.scrollTop | document.documentElement.scrollTop;
        if(top<150){
            $("#totop").hide();
        }else{
            $("#totop").show();
        }
    });
    function kwfilter(){
        var kw = $("#kw").val();
        kw = kw.replace(/ +$/,'');
        kw = kw.replace(/^ +/,'');
        return kw;
    }
    $("#kw").bind("propertychange input focus",function(){
        var text = $("#kw").val();
        var kw = $("#kw").val();
        setCookie("kw",kw);
        if(text != "") {
            $.get('/chaxun/ajax?callback=jsonpReturn',
                {kw:kwfilter(),cate:cate},function(json){
                    if(json['empty'] == 'yes'){
                        $("#tips").hide();
                        return;
                    }
                    $("#tipsul").html("");
                    var i=1;
                    for(var k in json){
                        //诗词
                        if(/^shici[0-9]+/.test(k)){
                            var k2 = k.replace(/^shici[0-9]+/,'');
                            var scid = k2.match(/[0-9]+$/);
                            k2 = k2.replace(/___[0-9]+$/,'');
                            $("#tipsul").html($("#tipsul").html() + '<li id="liid_'+i+'"><a href="/chaxun/list/' +scid+ '.html">《<b>' + k2 + "</b>》(" + json[k] + ')</a></li>');
                            //诗句
                        }else if(/^shiju[0-9]+/.test(k)){
                            var k2 = k.replace(/^shiju[0-9]+/,'');
                            var scid = k2.match(/[0-9]+$/);
                            k2 = k2.replace(/___[0-9]+$/,'');
                            $("#tipsul").html($("#tipsul").html() + '<li id="liid_'+i+'"><a href="/chaxun/list/' +scid+ '.html" title="'+k2+'">' + k2 + "(" + json[k] + ')</a></li>');
                            //作者
                        }else{
                            if(json[k]!=0) {
                                var az = k.split('__');
                                $("#tipsul").html($("#tipsul").html() + '<li id="liid_'+i+'"><a href="/chaxun/zuozhe/' + az[1] + '.html"><b>' + az[0] + "</b>(" + json[k] + ')</a></li>');
                            }
                        }
                        if(i==6)break;
                        i++;
                    }
                    //点击
                    $("#tipstext a").click(function(){
                        var t =$(this).attr("title");
                        setShijuCookie(t);
                    });
                    $("#tips").show();
                },'jsonp');
        }else{
            $("#tips").hide();
        }
    });
});
//改变查询类型函数
function cateChange(str){
    cate = str;
    if(str == "")str = "all";
    setCookie("cate",str);
    $("#all,#zz,#title,#shiju,#first,#end").css("color","grey");
    $("#all,#zz,#title,#shiju,#first,#end").css("background-color","");
    $("#"+str).css("color","white");
    $("#"+str).css("background-color","brown");
    document.getElementById("cate").value = str;
}
function getCookie(c_name) {
    if (document.cookie.length>0)
    {
        c_start=document.cookie.indexOf(c_name + "=")
        if (c_start!=-1)
        {
            c_start=c_start + c_name.length+1
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
        }
    }
    return ""
}
function setCookie(name,value) {
    var Days = 0.1;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name +"="+ escape (value) +";path=/;domain=.shicimingju.com";
}
function showmiyu(i){
    var result= document.getElementById("result-"+i);
    var buttom= document.getElementById("buttom-"+i);
    result.style.display="block";
    buttom.style.display="none";
}
function shijulist(){
    $("#shijulist a,#all_shiju a").click(function(){
        var t =$(this).attr("title");
        setShijuCookie(t);
    });
}
function shijutoyellow(){
    var shiju = getCookie("shiju");
    setShijuCookie("");
    var con  = $("#shicineirong").html();
    if(shiju!=""&&con!=undefined){
        con = con.replace(shiju,"<span id='toyellow' style='background-color: yellow;'>"+shiju+"</span>");
        $("#shicineirong").html(con);
        $("#toyellow").click(function(){
            $("#toyellow").css("background-color","");
        });
    }
}
function setShijuCookie(value){
    document.cookie = "shiju="+ escape (value) + ";expires=5000;path=/;domain=.shicimingju.com";
}
function nav_show(index){

    if($("#navili_id_"+index).is(":visible")==true){
        $("#navili_id_"+index).hide();
    }else{
        $("#topnav_to_div div").hide();
        $("#navili_id_"+index).show();
    }
}
function b_nav_show(index){
    if($("#b_show_nav").html() == $("#navili_id_"+index).html())
        $("#b_show_nav").html("");
    else
        $("#b_show_nav").html($("#navili_id_"+index).html());
}
function nav_more(){
    if($("#nav_more").html()!="收起▲"){
        $("#topnav_hide").show();
        $("#nav_more").html("收起▲");
    }else{
        $("#topnav_hide").hide();
        $("#nav_more").html("更多▼");
    }

}