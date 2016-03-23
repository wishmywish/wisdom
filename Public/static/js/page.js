/**
 * AJAX读取数据
 * 参值：url_text:AJAX提交的连接，Type:请求方式get or post ,DType:返回的数据类型json ,outType:返回样式，category
 */
function listData(url_text,inData,Type,DType,outType){
    var loadi = 0;
    $.ajax({
        url:url_text,
        data:inData,
        type:Type,
        dataType:DType,
        async:false,
        beforeSend:function(){
            loadi = layer.load(0);
        },
        success: function(reVal){
            //console.log(reVal.list);
            total = reVal.total; //总记录数
            pageSize = reVal.pageSize; //每页显示条数
            curPage = reVal.page; //当前页
            totalPage = reVal.totalPage; //总页数
            //根据不同内容，输出不同的列表样式
            //console.log(reVal.list);
            if(reVal.list!=null){
                switch(outType){
                    case 'column'://加载栏目
                       //showCategory(reVal.list,curPage);
                       break;
                    case 'company'://加截公司信息
                       //showCompany(reVal.list);
                       break;
                    default:
                       console.log('aa');
                       break;
                }
            }
        },
        complete:function(){
            layer.close(loadi);
            getPageBar1(outType);
            //getpage();
        }
    });
}

//获取分页条 
function getPageBar(){
    var act_type=arguments[0]?arguments[0]:'';  //0可以替换成默认值
    //var SYS_COLUMN_LEVEL=arguments[1]?arguments[1]:'';  //0可以替换成默认值

    //页码大于最大页数 
    if(curPage>totalPage) curPage=totalPage;
    //页码小于1 
    if(curPage<1) curPage=1;

    pageStr = "<span>共"+total+"条</span> <span>每页"+pageSize+"条</span> <span>"+curPage +"/"+totalPage+"</span> "; 
     
    //如果是第一页 
    if(curPage==1){
        pageStr += " <span>首页</span> <span>上一页</span>";
    }else{
        pageStr += " <span><a href='javascript:void(0)' name='"+act_type+"' rel='1'>首页</a></span> <span><a href='javascript:void(0)' name='"+act_type+"' rel='"+(curPage-1)+"'>上一页</a></span>"; 
    }
     
    //如果是最后页 
    if(curPage>=totalPage){
        pageStr += " <span>下一页</span> <span>尾页</span>";
    }else{ 
        pageStr += " <span><a href='javascript:void(0)' name='"+act_type+"' rel='"+(parseInt(curPage)+1)+"'>下一页</a></span> <span><a href='javascript:void(0)' name='"+act_type+"' rel='"+totalPage+"'>尾页</a></span>"; 
    } 
    $(".ToppageDIV").html(pageStr);//顶部
    $(".pageDIV").html(pageStr);//底部
} 


//新分页方式
function getPageList(url_text,cpage,outType,url_text_sum,contName){
    var loadi = layer.load(0);
    if(!arguments[4]) contName = "page";
    $.getJSON(url_text_sum,cpage,function(v){
         //console.log(v);
        laypage({
            cont: $("."+contName+""), //容器。值支持id名、原生dom对象，jquery对象,
            pages: v.totalPage, //总页数
            skip: false, //是否开启跳页
            skin: '#3c8dbc',
            groups: 5, //连续显示分页数
//            first: '首页', //若不显示，设置false即可
//            last: '尾页', //若不显示，设置false即可
//            prev: '<', //若不显示，设置false即可
//            next: '>', //若不显示，设置false即可
//            hash: false, //开启hash
            jump: function(e){ //触发分页后的回调
                $.getJSON(url_text,'page='+e.curr,function(reVal){
                     //console.log(reVal);
                    if(reVal.list!==null){
                        switch(outType){
                            case 'business'://加载招商列表
                               showBusiness(reVal.list);
                               break;
                            case 'dealer'://加截经销商
                               showDealer(reVal.list);
                               break;
                            case 'sales'://加业务员
                               showSales(reVal.list);
                               break;
                           case 'Fsales'://加业务员
                               showFSales(reVal.list);
                               break;
                           case 'allcompany'://加所有企业
                                //console.log(reVal.list);
                               showAllcompany(reVal.list);
                               break;
                           case 'pubTask'://加已经发布的任务
                               showPubTasks(reVal.list);
                               break;
                           case 'activity'://加活动与广告
                               showActivities(reVal.list);
                               break;
                            case 'withdraw'://提现
                                showWithdraw(reVal.list);
                                break;
                            case 'dealerpro'://招商进程
                                showDealerPro(reVal.list,reVal.tabType);
                                break;
                            case 'shops'://商品
                                showShops(reVal.list);
                                break;
                            case 'ShopRecord'://商品消费记录
                                showShopRecord(reVal.list);
                                break;
                            case 'users'://用户
                                showUsers(reVal.list);
                                break;
                            case 'roles'://角色
                                showRoles(reVal.list);
                                break;
                            case 'access'://权限
                                showAccess(reVal.list);
                                break;
                            case 'dealer_list'://经销商
                                showDealerList(reVal.list);
                                break;
                            case 'shareNum'://每日推广赚每日分享次数及有效获得金币数统计
                                showShareNum(reVal.list);
                                break;
                            case 'widelyShareNum'://每日随手赚每日分享次数及有效获得金币数统计
                                showWidelyShareNum(reVal.list);
                                break;
                            case 'allTaskShare'://全部任务日分享次数统计
                                showaAllTaskShare(reVal.list);
                                break;
                            case 'widelyFinish'://全部任务日分享次数统计
                                showWidelyFinish(reVal.list);
                                break;
                            case 'behavior'://用户行为分析
                                showBehavior(reVal.list);
                                break;
                            case 'allBehavior'://用户行为分析
                                showAllBehavior(reVal.list);
                                break;
                            case 'redpacket'://用户红包
                                showRedPacket(reVal.list);
                                break;
                            case 'alldealer'://加载所有招商赚录入未审核经销商信息
                                showAllDealer(reVal.list);
                                break;
                            case 'allExpress'://加载所有试用通过审核信息
                                showAllExpress(reVal.list);
                                break;
                            default:
                               break;
                        }
                        layer.close(loadi);
                    }
                    //console.log(outType);
                });
            }
        });
    });
}

function showBusiness(arr){
    //console.log(list);
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        console.log(v);
        //1:已结束、2:待客服审核、3:已发布、4:已过期、5:已驳回、6:待提交、7:待财务审核,8.客服审核通过，9.审核通过,10.审核未通过，11。已下架
        var stratstxt=function(){
            //alert(v.f_strats);
            var stxt = "";
            if(v.f_status===1 || v.f_status==='1'){
                stxt = "<span style='color:blue;'>已结束</span>";
            }else if(v.f_status===2 || v.f_status==='2'){
                stxt = "<span style='color:red;'>待客服审核</span>";
            }else if(v.f_status===3 || v.f_status==='3'){
                stxt = "<span style='color:green;'>已发布</span>";
            }else if(v.f_status===4 || v.f_status==='4'){
                stxt = "<span style='color:#b58900;'>已过期</span>";
            }else if(v.f_status===5 || v.f_status==='5'){
                stxt = "<span style='color:blue;'>已驳回</span>";
            }else if(v.f_status===6 || v.f_status==='6'){
                stxt = "<span style='color:#7744FF;'>待提交</span>";
            }else if(v.f_status===7 || v.f_status==='7'){
                stxt = "<span style='color:red;'>待财务审核</span>";
            }else if(v.f_status===8 || v.f_status==='8'){
                stxt = "<span style='color:red;'>客服审核通过</span>";
            }else if(v.f_status===9 || v.f_status==='9'){
                stxt = "<span style='color:red;'>审核通过</span>";
            }else if(v.f_status===10 || v.f_status==='10'){
                stxt = "<span style='color:red;'>审核未通过 </span>";
            }else if(v.f_status===11 || v.f_status==='11'){
                stxt = "<span style='color:red;'>已下架 </span>";
            }
            return stxt;
        };
        // var hometxt=function(){
        //     // alert(v.f_hometask);
        //     var htxt = "";
        //     if(v.f_hometask===1 || v.f_hometask==='1'){
        //         htxt = "<span>是</span>";
        //     }else if(v.f_hometask===0 || v.f_hometask==='0'){
        //         htxt = "<span>否</span>";
        //     }
        //     return htxt;
        // };
        list += "<ul>";
        list += "<li style='width:5%;'><input name='taskid' type='checkbox' value='"+v.f_tid+"'><input type='hidden' id='business"+v.f_tid+"' name='business"+v.f_tid+"' value='"+v.f_tasktypeid+"'><input type='hidden' id='status"+v.f_tid+"' name='status"+v.f_tid+"' value='"+v.f_status+"'><input type='hidden' id='user"+v.f_tid+"' name='user"+v.f_tid+"' value='"+v.f_paletid+"'></li>";
        list += "<li style='width:15%;'>"+v.f_surveno+"</li>";
        if(v.f_hometask===1 || v.f_hometask==='1'){
            // list += "<li style='width:2%;'><i class='fa fa-check' style='color:red;'></i></li>";
            list += "<li style='width:20%;cursor:pointer;' title='"+v.f_title+"' onclick=\"preview("+v.f_tid+")\"><i class='fa fa-home' style='color:red;'></i>"+v.f_title+"</li>";
        }else if(v.f_hometask===0 || v.f_hometask==='0'){
            list += "<li style='width:20%;cursor:pointer;' title='"+v.f_title+"' onclick=\"preview("+v.f_tid+")\">"+v.f_title+"</li>";
        }
        list += "<li style='width:10%;'>"+v.f_typename+"</li>";
        // list += "<li style='width:5%;'>"+hometxt()+"</li>";
        list += "<li style='width:10%;'>"+v.f_begindate+"</li>";
        list += "<li style='width:10%;'>"+v.f_enddate+"</li>";
        list += "<li style='width:10%;'>"+v.f_linkman+"</li>";
        list += "<li style='width:10%;'>"+v.f_linkphone+"</li>";
        list += "<li style='width:10%;cursor:pointer;' onclick='turnToReject("+v.f_tid+")'>"+stratstxt()+"</li>";

        list += "</ul>";
    });

    $('.listinfo').append(list);
}

// function showDealer(arr){
//     //console.log(list);
//     $('.listinfo').empty();
//     var list = "";
//     $.each(arr,function(i,v){
//         var phone = function(){
//             var a = v.f_phoneone.split('|');
//             return a[0];
//         };
//         list += "<ul>";
//         list += "<li style='width:5%;'><input name='taskid' type='checkbox' value='"+v.f_dealerid+"'></li>";
//         if (v.f_dealer_strats ==3) {
//             list += "<li style='width:0%;'><i class='fa fa-check' style='color:blue;'></i></li>";
//             list += "<li style='width:15%;'>"+v.f_companynameone+"</li>";
//             list += "<li style='width:20%;'></li>";
//             list += "<li style='width:10%;'>"+v.f_yearturnover+"</li>";
//             list += "<li style='width:10%;'>"+v.f_latticepointqty+"</li>";
//             list += "<li style='width:10%;'>"+v.f_area+"</li>";
//             list += "<li style='width:10%;'></li>";
//             list += "<li style='width:10%;'>"+v.f_contactsname+"</li>";
//             list += "<li style='width:10%;'>"+phone()+"</li>";
//             list += "</ul>";
//         }else{
//             list += "<li style='width:15%;'>"+v.f_companynameone+"</li>";
//             list += "<li style='width:20%;'></li>";
//             list += "<li style='width:10%;'>"+v.f_yearturnover+"</li>";
//             list += "<li style='width:10%;'>"+v.f_latticepointqty+"</li>";
//             list += "<li style='width:10%;'>"+v.f_area+"</li>";
//             list += "<li style='width:10%;'></li>";
//             list += "<li style='width:10%;'>"+v.f_contactsname+"</li>";
//             list += "<li style='width:10%;'>"+phone()+"</li>";
//             list += "</ul>";
//         };
//     });
//     $('.listinfo').append(list);
// }

function showDealer(arr){
    //console.log(arr);
    $('.listinfo2').empty();
    $('#waitReview').empty();
    $('#alreadyReview').empty();
    $('#noReviewManage').empty();
    $('#submitCompany').empty();
    $('#noReviewFactory').empty();
    var list = "";
    $.each(arr,function(i,v){
        var phone = function(){
            var a = v.f_phoneone.split('|');
            return a[0];
        };
        if (0==i) {
            $('#waitReview').append("("+v.waitReview+")");
            $('#alreadyReview').append("("+v.alreadyReview+")");
            $('#noReviewManage').append("("+v.noReviewManage+")");
            $('#submitCompany').append("("+v.submitCompany+")");
            $('#noReviewFactory').append("("+v.noReviewFactory+")");
        }
         //console.log(v);
        list += "<ul>";
        list += "<li style='width:3%;'><input name='indexId' type='checkbox' value='"+v.f_dealerid+"'><input type='hidden' id='status"+v.f_dealerid+"' name='status"+v.f_dealerid+"' value='"+v.f_dealer_strats+"'></li>";
        if (v.f_dealer_strats ==3) {
            list += "<li style='width:2%;'><i class='fa fa-check' style='color:blue;'></i></li>";
            // list += "<li style='width:2%;'><span style='color:blue;'>已推荐</span></li>";
        }else if (v.f_dealer_strats ==1) {
            list += "<li style='width:2%;'><i class='fa fa-check' style='color:red;'></i></li>";
            // list += "<li style='width:2%;'><span style='color:red;'>已中标</span></li>";
        }else if (v.f_dealer_strats ==4) {
            list += "<li style='width:2%;'><i class='fa fa-times' style='color:red;'></i></li>";
            // list += "<li style='width:2%;'><span style='color:red;'>已中标</span></li>";
        }else{
            list += "<li style='width:2%;'></li>";
        }
        list += "<li style='width:15%;'><span>"+(i+1)+"</span></li>";
        list += "<li style='width:15%;'><span>90</span></li>";
        list += "<li style='width:20%;'><span>"+v.trueName+"</span></li>";
        list += "<li style='width:35%;cursor:pointer;' onclick='turnToDetail("+v.f_dealerid+")'>"+v.f_companynameone+"</li>";
        //list += "<li style='width:10%;'><span>"+getDate(v.f_uptime)+"</span></li>";
        list += "<li style='width:10%;'><span>"+v.f_uptime+"</span></li>";
        list += "</ul>";
    });
    $('.listinfo2').append(list);
}

function showAllDealer(arr){
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        var phone = function(){
            var a = v.f_phoneone.split('|');
            return a[0];
        };
        // console.log(v);
        list += "<ul>";
        list += "<li style='width:5%;'><input name='indexId' type='checkbox' value='"+v.f_dealerid+"'><input type='hidden' id='status"+v.f_dealerid+"' name='status"+v.f_dealerid+"' value='"+v.f_dealer_strats+"'></li>";
        list += "<li style='width:20%;cursor:pointer;' >"+v.companyName+"</li>";
        list += "<li style='width:25%;cursor:pointer;' onclick=\"preview("+v.f_tid+")\">"+v.f_title+"</li>";
        list += "<li style='width:10%;cursor:pointer;' onclick='showUseretail("+v.f_userid+")'>"+v.nickName+"</li>";
        list += "<li style='width:20%;cursor:pointer;' onclick='turnToDetail("+v.f_dealerid+")'>"+v.f_companynameone+"</li>";
        list += "<li style='width:10%;'><span>"+getDate(v.f_uptime)+"</span></li>";
        if (v.f_dealer_strats ==0) {
            list += "<li style='width:10%;'><span>未审核</span></li>";
        }
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function showAllExpress(arr){
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        // console.log(v);
        list += "<ul>";
        list += "<li style='width:5%;'><input name='express' type='checkbox' value='"+v.f_lid+"'></li>";
        list += "<li style='width:10%;' >"+v.nickName+"</li>";
        list += "<li style='width:15%;overflow:hidden;' title='"+v.f_title+"'>"+v.f_title+"</li>";
        list += "<li style='width:10%;' >"+v.f_rname+"</li>";
        list += "<li style='width:10%;' >"+v.f_rphone+"</li>";
        list += "<li style='width:5%;' >"+v.f_code+"</li>";
        list += "<li style='width:10%;overflow:hidden;' title='"+v.f_rlocation+"'>"+v.f_rlocation+"</li>";
        list += "<li style='width:10%;overflow:hidden;' title='"+v.f_raddress+"'>"+v.f_raddress+"</li>";
        list += "<li style='width:15%;overflow:hidden;' title='"+v.f_express+"'>"+v.f_express+"</li>";
        list += "<li style='width:10%;'><span>"+getDate(v.f_expresstime)+"</span></li>";
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function showPubTasks(arr){
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        var phone = function(){
            var a = v.f_phoneone.split('|');
            return a[0];
        };

        list += "<ul>";
        list += "<li style='width:100%;cursor:pointer;text-align:left;padding-left:5px;'  class='showDetail' onclick='responseClickEvent(this);' onmouseover='responseMouseEvent(this,1);' onmouseout='responseMouseEvent(this,2)' id='publishTask"+v.f_tid+"' title='"+v.f_title+"'><input name='pubTaskId' style='margin: 14px 15px 0px;line-height: normal;float:left;display:none;' type='checkbox' value='"+v.f_tid+"'>"+v.f_title+"</li><br>";
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function showShops(arr){
    // True
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        var tName = function(){
            return v.f_activename==='0'?'正常价格':"优惠价格";
        };

        var stratstxt=function(){
            var stxt = "";
                if(v.f_status===0 || v.f_status==='0'){
                    stxt = "<span style='color:red;'>已下架</span>";
                }else if(v.f_status===1 || v.f_status==='1'){
                    stxt = "<span style='color:blue;'>正常</span>";
                }
            return stxt;
        };

        var sum = i+1;
        list += "<ul>";
        list += "<li style='width:5%;'><input name='shopid' type='checkbox' value='"+v.f_sid+"'></li>";
        list += "<li style='width:20%;'>"+v.f_shopname+"</li>";
        list += "<li style='width:20%;'>"+v.f_classname+"</li>";
        list += "<li style='width:10%;'>"+v.f_shopsum+"</li>";
        list += "<li style='width:15%;'>"+v.f_price+"</li>";
        list += "<li style='width:20%;'>"+tName()+"</li>";
        list += "<li style='width:10%;'>"+stratstxt()+"</li>";
        list += "</ul>";

    });
    $('.listinfo').append(list);
}

function showSales(arr){
    // True
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        var tName = function(){
            return v.trueName===''?'':"("+v.trueName+")";
        };
        var sum = i+1;
        list += "<ul>";
        list += "<li style='width:5%;'>"+sum+"</li>";
        list += "<li style='width:20%;cursor:pointer;'  onclick='showManDetail("+v.userId+")'>"+v.mobile+"</li>";
        if (v.userCreatetime) {
            list += "<li style='width:15%;'>"+v.nickName+tName()+"</li>";
        }else{
            list += "<li style='width:35%;'>"+v.nickName+tName()+"</li>";
        };
        list += "<li style='width:15%;'>"+v.goldcoin+"</li>";
        list += "<li style='width:15%;'>"+v.credit+"</li>";
        list += "<li style='width:10%;color:red;cursor:pointer;' onclick='showdtask("+v.userId+")'>"+v.taskdrawsum+"</li>";
        if (v.userCreatetime) {
            list += "<li style='width:10%;'>"+v.userCreatetime+"</li>";
            list += "<li style='width:10%;'></li>";
        }
        list += "</ul>";

    });
    $('.listinfo').append(list);

}

function showFSales(arr){
        //False
    $('.listinfo').empty();
    var list = "";

    $.each(arr,function(i,v){
        var tName = function(num){
            return v.f_status==num ?'selected':"";
        };
        var selectChoice = "<select id='talkType"+v.f_indexid+"' onchange='showNote("+v.f_indexid+",this[selectedIndex].value)'><option value='0' "+tName(0)+">未联系</option><option value='1' "+tName(1)+">已接通</option><option value='2' "+tName(2)+">关机</option><option value='3' "+tName(3)+">不愿回访</option><option value='4' "+tName(4)+">空号</option><option value='5' "+tName(5)+">没人接</option><option value='6' "+tName(6)+">同事</option></select>";
        var sum = i+1;
        list += "<ul>";
        list += "<li style='width:5%;'><input name='fsalesid' type='checkbox' value='"+v.f_indexid+"'></li>";
        list += "<li style='width:10%;'>"+v.f_mobile+"</li>";
        list += "<li style='width:20%;'>"+v.f_nickname+"</li>";
        list += "<li style='width:15%;'>"+v.f_truename+"</li>";
        list += "<li style='width:10%;'>"+v.f_area+"</li>";
        list += "<li style='width:15%;'>"+v.f_industrytype+"</li>";
        list += "<li style='width:10%;'>"+v.f_creatdate+"</li>";
        list += "<li style='width:15%;'>"+selectChoice+"</li>";
        list += "</ul>";

    });
    $('.listinfo').append(list);
}

function showActivities(arr){

    //console.log(arr);
    $('.listinfo').empty();
    var list = "";

    $.each(arr,function(i,v){
        var img = UPFILE+"/"+v.f_filepath+v.f_filename;
        var route = v.f_filepath+v.f_filename;
        var tName = function(){
            return v.f_top==='1'?'是':'否';
        };
        list += "<ul style='height:180px;line-height:180px;'>";
        list += "<li style='width:5%;height:180px;line-height:180px;'><input name='activityId' type='checkbox' value='"+v.f_id+"'></li>";
        list += "<li style='width:15%;height:180px;line-height:180px;'>"+v.f_title+"</li>";
        if (route) {
            list += "<li class='thumbImage' style='width:20%;height:180px;line-height:180px;'><img src='"+img+"'></li>";
        }else{
            list += "<li class='thumbImage' style='width:20%;height:180px;line-height:180px;'><img src=''></li>";
        };
        list += "<li style='width:20%;height:180px;line-height:180px;'><a href='"+v.f_url+"' target='_blank'>"+v.f_url+"</a></li>";
        list += "<li style='width:15%;height:180px;line-height:180px;'>"+getDate(v.f_starttime)+"</li>";
        list += "<li style='width:15%;height:180px;line-height:180px;'>"+getDate(v.f_endtime)+"</li>";
        list += "<li style='width:10%;height:180px;line-height:180px;'>"+tName()+"</li>";
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function showWithdraw(arr){
    //console.log(arr);
    $('.listinfo').empty();
    var list = "";
    var accounttype="";
    var status="";
    $.each(arr,function(j,v){
        if(parseInt(v.f_accounttype)===1){accounttype="银行卡"}else{accounttype="支付宝"}
        if(parseInt(v.f_strats)===0){
            status = "等待审核";
            btn = "<li style='width:15%;'>"+getDate(v.f_optiondate)+" <button style='width: 35px;height: 35px;border: 0px;background-color: #0d5ab1;color: #fff;' onclick='ok("+v.f_indexid+");'>完成</button></li>";
        }else if(parseInt(v.f_strats)===1){
            status = "已经打款";
            btn = "<li style='width:15%;'>"+getDate(v.f_optiondate)+"</li>";
        }
        list += "<ul>";
        list += "<li style='width:5%;'><input name='withdrawid' type='checkbox' value='"+v.f_indexid+"'></li>";
        list += "<li style='width:15%;'>"+v.f_truename+"["+v.f_accountname+"]</li>";
        list += "<li style='width:10%;'>"+accounttype+"</li>";
        list += "<li style='width:20%;'>"+v.f_accountname+"</li>";
        list += "<li style='width:20%;'>"+v.f_bankaccount+"</li>";
        list += "<li style='width:10%;'>"+v.f_amount/10+"</li>";
        list += "<li style='width:5%;color:red;'>"+status+"</li>";
        list += btn;
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function ok(id){
    layer.confirm('确定已经打款？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        var param = "id="+id;
        $.get(APP+"/Taskadmin/Fun/ok",param,function(){
            layer.msg("打款成功",{icon:1},function(){
                location.reload();
            });
        })
    }, function(){
        //parent.location.reload();
        //var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        //parent.layer.close(index);
    });
}

function showShopRecord(arr){

    $('.listinfo').empty();
    var list = "";
    var status="";
    $.each(arr,function(j,v){
        console.log(v);
        var tName = function(){
            return v.userName.trueName===''?'':"("+v.userName.trueName+")";
        };
        if(parseInt(v.f_strats)===0){
            status = "等待确认收货";
        }else if(parseInt(v.f_strats)===1){
            status = "已经收货";
        }
        list += "<ul>";
        list += "<li style='width:5%;'><input type='hidden' id='phone"+v.f_indexid+"' name='phone"+v.f_indexid+"' value='"+v.userName.mobile+"'><input name='shoprecordid' type='checkbox' value='"+v.f_indexid+"'></li>";
        list += "<li style='width:25%;'>"+v.f_shopname+"</li>";
        list += "<li style='width:20%;'>"+v.userName.nickName+(tName())+"</li>";
        list += "<li style='width:15%;'>"+v.f_amount+"</li>";
        list += "<li style='width:15%;color:red;'>"+status+"</li>";
        list += "<li style='width:20%;'>"+getDate(v.f_optiondate)+"</li>";
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function showAllcompany(arr){
    $('.listinfo').empty();
    var list = "";
    var status="";
    //console.log(arr.length);
    if(arr.length!==0) {
        $.each(arr, function (j, v) {
            if (parseInt(v.state) === 2) {
                status = "未开通招商";
            } else if (parseInt(v.state) === 1) {
                status = "已审核";
            } else if (parseInt(v.state) === 3) {
                status = "已停用";
            } else if (parseInt(v.state) === 4) {
                status = "待审核";
            } else if (parseInt(v.state) === 0) {
                status = "未通过";
            } else if (parseInt(v.state) === 5) {
                status = "新注册";
            }
            list += "<ul>";
            list += "<li style='width:5%;'><input name='companyId' type='checkbox' value='" + v.companyId + "'><input type='hidden' id='status" + v.companyId + "' name='status" + v.companyId + "' value='" + v.state + "'></li>";
            if (v.level == 1 || v.level == '1') {
                list += "<li style='width:5%;'><img src='../../../Public/Taskadmin/Default/images/silver.png' style='width: 56px;height: 16px;'></li>";
            } else if (v.level == 2 || v.level == '2') {
                list += "<li style='width:5%;'><img src='../../../Public/Taskadmin/Default/images/gold.png' style='width: 56px;height: 16px;'></li>";
            } else if (v.level == 3 || v.level == '3') {
                list += "<li style='width:5%;'><img src='../../../Public/Taskadmin/Default/images/diamond.png' style='width: 56px;height: 16px;'></li>";
            } else {
                list += "<li style='width:5%;'></li>";
            }
            ;
            if (v.credit > 0) {
                list += "<li style='width:5%;'><img src='../../../Public/Taskadmin/Default/images/credit.png' style='width: 56px;height: 16px;'></li>";
            } else {
                list += "<li style='width:5%;'></li>";
            }
            ;
            if (v.supervisionUser == 1 || v.supervisionUser == '1') {
                list += "<li style='width:5%;'><img src='../../../Public/Taskadmin/Default/images/supervisionUser.png' style='width: 56px;height: 16px;'></li>";
            } else {
                list += "<li style='width:5%;'></li>";
            }
            ;
            list += "<li style='width:15%;cursor:pointer;' onclick='showCompanyDetail(" + v.companyId + "," + v.state + ")'>" + v.companyName + "</li>";
            list += "<li style='width:20%;'>" + v.industryName + "</li>";
            list += "<li style='width:10%;'>" + v.turnOver + "</li>";
            list += "<li style='width:10%;'>" + v.ageCount + "</li>";
            list += "<li style='width:5%;'>" + v.employeeCount + "</li>";
            list += "<li style='width:5%;'>" + v.salesCount + "</li>";
            list += "<li style='width:5%;'>" + v.createtime + "</li>";
            list += "<li style='width:10%;color:red;'>" + status + "</li>";
            list += "</ul>";
        });
    }else{
        list += "<ul>";
        list += "<li style='width:100%;color:red;'>暂无数据</li>";
        list += "</ul>";
    }
    $('.listinfo').append(list);
}

function showDealerPro(arr,type){
    // console.log(type);
    $('.listinfo').empty();
    var list = "";
    var status="";
    var money="";
    $.each(arr,function(j,v){
// console.log(v);
        if(v.f_proname=='bid'){
            status = "已中标";
        }else if(v.f_proname=='contract' && v.f_prostatus== 1){
            status = "经销商合同已签订";
        }else if(v.f_proname=='contract' && v.f_prostatus== 2){
            status = "双方合同都已签订";
        }else if(v.f_xxx==1){
            status = "厂家合同已签订";
        }else if(v.f_proname=='remit' && v.f_prostatus== 1){
            status = "经销商已打款";
        }else if(v.f_proname=='remit' && v.f_prostatus== 2){
            status = "平台确认";
        }else if(v.f_proname=='dispatch' && v.f_prostatus== 1){
            status = "已发货";
        }else if(v.f_proname=='receive'&& v.f_prostatus== 1){
            status = "已收货";
        }else if(v.f_proname=='commissionsquare' && v.f_prostatus== 1){
            status = "已经佣金结算";
        }else if(v.f_proname=='Settlement' && v.f_prostatus== 1){
            status = "管理平台已经对首批款进行了结算，并已经确认。";
        }

        if (v.f_unitcommission) {
            money = v.f_unitcommission;
        };
// console.log(v.user);
        list += "<ul>";
        list += "<li style='width:5%;'><input name='dealerId' type='checkbox' value='"+v.f_dealerid+"'><input name='status' id='status"+v.f_dealerid+"' type='hidden' value='"+v.f_proname+"'><input name='name' id='name"+v.f_dealerid+"' type='hidden' value='"+v.f_prostatus+"'><input name='money' id='money"+v.f_dealerid+"' type='hidden' value='"+money+"'><input name='fid' id='fid"+v.f_dealerid+"' type='hidden' value='"+v.f_id+"'><input name='type' id='type' type='hidden' value='"+type+"'></li>";
        list += "<li style='width:20%;'>"+v.taskname.f_title+"</li>";

        list += "<li style='width:35%;cursor:pointer;'  onclick='turnToDetail("+v.f_dealerid+")' >"+v.f_companynameone+"</li>";
        list += "<li style='width:10%;'>"+v.user.trueName+"</li>";
        list += "<li style='width:20%;'>"+status+"</li>";
        // if (v.f_proname=='commissionsquare' && v.f_prostatus== 1) {
        //     list += "<li style='width:5%;'>"+money+"</li>";
        //     list += "<li style='width:15%;'>"+v.f_protime+"</li>";
        // }else{

            list += "<li style='width:10%;'>"+v.f_protime+"</li>";
        // };
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function getDate(tm){
    var tt=new Date(parseInt(tm) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
    return tt;
}
function   formatDate(nowtime)   {
    var now = new Date(nowtime);
    var   year=now.getYear();
    var   month=now.getMonth()+1;
    var   date=now.getDate();
    var   hour=now.getHours();
    var   minute=now.getMinutes();
    var   second=now.getSeconds();
    //return   year+"-"+month+"-"+date+"   "+hour+":"+minute+":"+second;
    return   year+"-"+month+"-"+date;
}

function showUsers(arr){
    //console.log(arr);
    // True
    $('.listinfo').empty();
    var listuser = "";
    $.each(arr,function(i,v){
        var status = function(){
            return v.strat==='0'?'锁定':"正常";
        };
        listuser += "<ul>";
        listuser += "<li style='width:10%;'><input name='accessid' type='checkbox' value='"+v.id+"'></li>";
        listuser += "<li style='width:25%;cursor:pointer;'>"+v.username+"</li>";
        listuser += "<li style='width:25%;'>"+v.realname +"</li>";
        listuser += "<li style='width:20%;'>"+v.accessname +"</li>";
        listuser += "<li style='width:20%;'>"+status()+"</li>";
        listuser += "</ul>";

    });
    $('.listinfo').append(listuser);

}
function showRoles(arr){
    $('.listinfo').empty();
    var listaccess = "";
    var accessname = "";
    var accessname_top = "";
    var accessname_body = "";
    var access_name = "";
    $.each(arr,function(i,v){

        var accessvalue = v.accessvalue;
        var strs = accessvalue.split("{||}");
        for (var i = 0; i <= strs.length; i++) {
             accessname = strs[i];
             if (accessname != undefined) {
                 var accessname1 = accessname.split("|");
                 if (i==0) {
                    accessname_top = accessname1[0];
                    accessname_body = accessname1[1];
                 }else{
                    accessname_top +=","+accessname1[0];
                    accessname_body +="|"+accessname1[1];
                 };

             };
        };

        var accessname_specific = accessname_top.split(",");
        for (var q = 0; q <= accessname_specific.length; q++) {
             if (accessname_specific[q] == '100') {
                access_name = '任务管理';
             }else if(accessname_specific[q] == '200'){
                access_name += '  ||  任务审核';
             }else if(accessname_specific[q] == '300'){
                access_name += '  ||  业务员管理';
             }else if(accessname_specific[q] == '400'){
                access_name += '  ||  企业管理';
             }else if(accessname_specific[q] == '500'){
                access_name += '  ||  活动与广告';
             }else if(accessname_specific[q] == '600'){
                access_name += '  ||   提现管理';
             }else if(accessname_specific[q] == '700'){
                access_name += '  ||  报表中心';
             }else if(accessname_specific[q] == '800'){
                access_name += '  ||  招商进度管理';
             }else if(accessname_specific[q] == '900'){
                access_name += '  ||  产品列表管理';
             }else if(accessname_specific[q] == '1000'){
                access_name += '  ||  消费记录管理';
             }else if(accessname_specific[q] == '1800'){
                access_name += '  ||  试用信息管理';
             }
        };

        listaccess += "<ul>";
        listaccess += "<li style='width:10%;'><input name='accessid' type='checkbox' value='"+v.id+"'></li>";
        listaccess += "<li style='width:25%;'>"+v.accessname+"</li>";
        listaccess += "<li style='width:65%;'>"+access_name +"</li>";
        listaccess += "</ul>";

    });
    $('.listinfo').append(listaccess);

}

function showAccess(arr){
    //console.log(arr);
    // True
    $('.listinfo').empty();
    var listaccess = "";
    $.each(arr,function(i,v){
        // var ids = function(){
        //     return v.id===''?'':"("+v.id+")";
        // };
        // var id = i+1;
        listaccess += "<ul>";
        listaccess += "<li style='width:10%;'><input name='manageid' type='checkbox' value='"+v.fid+"'></li>";
        listaccess += "<li style='width:30%;'>"+v.f_fieldname+"</li>";
        listaccess += "<li style='width:30%;'>"+v.f_fieldpid+"</li>";
        listaccess += "<li style='width:30%;'>"+v.f_fieldval+"</li>";
        listaccess += "</ul>";

    });
    $('.listinfo').append(listaccess);

}

function showShareNum(arr){
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        list += "<ul>";
        list += "<li style='width:35%;'>"+v.tasktitle+"</li>";
        list += "<li style='width:15%;'>"+v.taskcoin+"</li>";
        list += "<li style='width:20%;'>"+v.ctime+"</li>";
        list += "<li style='width:15%;'>"+v.sharenum+"</li>";
        list += "<li style='width:15%;'>"+v.earncoin+"</li>";
        list += "</ul>";

    });
    $('.listinfo').append(list);

}

function showWidelyShareNum(arr){
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        list += "<ul>";
        list += "<li style='width:50%;'>"+v.tasktitle+"</li>";
        list += "<li style='width:15%;'>"+v.taskcoin+"</li>";
        list += "<li style='width:20%;'>"+v.ctime+"</li>";
        list += "<li style='width:15%;'>"+v.earncoin+"</li>";
        list += "</ul>";

    });
    $('.listinfo').append(list);

}

function showWidelyFinish(arr){
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        list += "<ul>";
        list += "<li style='width:25%;'>"+v.ftitle+"</li>";
        list += "<li style='width:15%;'>"+v.ftotalcopies+"</li>";
        list += "<li style='width:20%;'>"+v.feachcoin+"</li>";
        list += "<li style='width:15%;'>"+v.drawqty+"</li>";
        list += "<li style='width:10%;'>"+v.finshqty+"</li>";
        list += "<li style='width:15%;'>"+v.ftotalcoin+"</li>";
        list += "</ul>";

    });
    $('.listinfo').append(list);

}

function showaAllTaskShare(arr){
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v){
        list += "<ul>";
        list += "<li style='width:50%;'>"+v.ftitle+"</li>";
        list += "<li style='width:25%;'>"+v.sharecount+"</li>";
        list += "<li style='width:25%;'>"+v.fdatetime+"</li>";
        list += "</ul>";

    });
    $('.listinfo').append(list);

}

//经销商
function showDealerList(arr){
    console.log(arr);
    $('.listinfo').empty();
    var list = "";
    var selectlist = "";
    $.each(arr,function(i,v) {

        var iflist = function(status){
            return v.f_status == status ? "selected" : "";
        };
        selectlist = "<select id='status_"+ v.f_indexid+"' onchange='setStatus("+v.f_indexid+",this[selectedIndex].value)'><option value='0' "+iflist(0)+">未联系</option><option value='1' "+iflist(1)+">已接通</option><option value='2' "+iflist(2)+">关机</option><option value='3' "+iflist(3)+">不愿回访</option><option value='4' "+iflist(4)+">空号</option><option value='5' "+iflist(5)+">没人接</option><option value='6' "+iflist(6)+">同事</option></select>";
        list += "<ul>";
        list += "<li style='width:5%;'><input id='dealermodiid' name='dealermodiid' type='checkbox' value='"+v.f_indexid+"'></li>";
        list += "<li style='width:20%;'>"+v.f_dealername+"</li>";
        list += "<li style='width:15%;'>"+v.f_industrytype+"</li>";
        list += "<li style='width:10%;'>"+v.f_area+"</li>";
        list += "<li style='width:10%;'>"+ v.f_moblie+"</li>";
        list += "<li style='width:10%;'>"+ v.f_telphone+"</li>";
        list += "<li style='width:10%;'>"+ v.f_chargeperson+"</li>";
        list += "<li style='width:10%;'>"+ v.f_channeltype+"</li>";
        list += "<li style='width:10%;'>"+selectlist+"</li>";
        list += "</ul>";
    });
    $('.listinfo').append(list);
}

function showBehavior(arr){
    console.log(arr.loginUserSum);
    $('.listinfo').empty();
    var list = "";
    var Regx = /^[0-9]*$/;
    $.each(arr.loginUserSum,function(i,v) {
        if (Regx.test(i)) {
            list += "<ul>";
            list += "<li style='width:5%;'><input id='dealermodiid' name='dealermodiid' type='checkbox' value=''></li>";
                list += "<li style='width:30%;cursor:pointer;' onclick='checkReg("+gettime(arr.loginUserSum.regCount[i]['regTime'])+","+arr.loginUserSum.regCount[i]['regCount']+");'>"+arr.loginUserSum.regCount[i]['regCount']+"</li>";
            list += "<li style='width:35%;cursor:pointer;' onclick='checkBehavior("+arr.startTime+","+gettime(v.time)+","+v.count+");'>"+v.count+"</li>";
            list += "<li style='width:30%;'>"+v.time+"</li>";
            list += "</ul>";
        };
    });
    $('.listinfo').append(list);
}


function showAllBehavior(arr){
    console.log(arr.loginResult);
    $('.listinfo').empty();
    var list = "";
    var Regx = /^[0-9]*$/;
    $.each(arr.loginResult,function(i,v) {
        if (Regx.test(i)) {
            list += "<ul>";
            list += "<li style='width:5%;'><input id='dealermodiid' name='dealermodiid' type='checkbox' value=''></li>";
            if (typeof arr.loginResult.regCount[i]=="object") {
                list += "<li style='width:30%;cursor:pointer;' onclick='checkAllReg("+gettime(arr.loginResult.regCount[i]['regTime'])+","+arr.loginResult.regCount[i]['allCount']+");'>"+arr.loginResult.regCount[i]['allCount']+"</li>";
            };
            list += "<li style='width:35%;cursor:pointer;' onclick='checkAllBehavior("+gettime(v[0].time)+","+v[0].total+");'>"+v[0].total+"</li>";
            list += "<li style='width:30%;'>"+v[0].time+"</li>";
            list += "</ul>";
        };
    });
    $('.listinfo').append(list);
}

function gettime(str)
{
    str = str.replace(/-/g,'/'); // 将-替换成/，因为下面这个构造函数只支持/分隔的日期字符串

    var date = new Date(str); // 构造一个日期型数据，值为传入的字符串

    var time = (date.getTime())/ 1000;

    return time;
}

function showRedPacket(arr){
    console.log(arr);
    $('.listinfo').empty();
    var list = "";
    $.each(arr,function(i,v) {
        list += "<ul>";
        list += "<li style='width:5%;'><input id='redpacketid' name='redpacketid' type='checkbox' value=''></li>";
        list += "<li style='width:30%;'>"+v.thisinvite+"</li>";
        list += "<li style='width:35%;'>"+v.thistransmit+"</li>";
        list += "<li style='width:30%;'>"+v.thistime+"</li>";
        list += "</ul>";
    });
    $('.listinfo').append(list);
}