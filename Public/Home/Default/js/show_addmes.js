/**
 * Created by Administrator on 2015/11/20.
 */


if(Cookie.readCookie("LYX_clicknum")>=1){
    //console.log("---");
    perfectmsg();
}


//提示完善企业信息页面
function  perfectmsg(){
    var state=$("#state").val();
    var ifsuper=$("#ifsuper").val();

    if(state==5||state==2){

        if(ifsuper==1){
            layer.confirm("<span><i class='fa fa-exclamation-circle fa-fw fa-lg'  style='color:rgb(221, 24, 40);'></i>请先按确定完善企业资料，否则影响智慧招商、智慧推广、智慧分销栏目的功能使用。</span>", {
                title :['提示信息','color:rgb(80, 99, 144)'],
                shift: 4, //动画类型
                btn: ['确定','取消'] //按钮
            }, function(index){
                location.href=APP+"/Admin/Companyset/index";
            }, function(index){
                layer.close(index);
            });

        }else if(ifsuper==0){
            layer.msg("联系管理员完善企业资料");
        }
    }
}
