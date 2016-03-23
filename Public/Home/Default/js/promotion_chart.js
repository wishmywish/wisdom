/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global echarts */
var proarr="";
var projiangcoin="";
var probalancecoin="";
var pusharr="";
var pushjiangcoin="";
var pushbalancecoin="";
function  prochart(taskid,type){
   //推广赚柱状图
   var myChart1 = echarts.init(document.getElementById('pro_taskAchieve_make'));
   //推广赚饼图
   var myChart2 = echarts.init(document.getElementById('pro_taskExpend_make'));
   //推广赚地图
   var myChart3 = echarts.init(document.getElementById('pro_taskReport_make'));
   //随手赚柱状图
   var myChart4= echarts.init(document. getElementById('pro_taskAchieve_earn')); 
   //随手赚饼图
   var myChart5 = echarts.init(document.getElementById('pro_taskExpend_earn'));
   //随手赚地图
   var myChart6 = echarts.init(document.getElementById('pro_taskReport_earn')); 
   myChart1.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   myChart2.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   myChart3.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   myChart4.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   myChart5.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   myChart6.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   $.ajaxSetup({   
            async : false
       }); 
   $.post(APP+"/Api/Web/promReport","taskid="+taskid+"&type="+type,function(v){
          //proarr
         if(type==1){
             $("#protargetnum").html(v.targetcopies);
             $("#projoinnum").html(v.propartnum);
             $("#procoinnum").html(v.eachcoin);
             $("#protoatalcoin").html(v.totalcopies);
             $("#proissuedcoin").html(v.projiangnum);
              proarr=v.prochart;
              projiangcoin=v.projiangnum;
              probalancecoin=v.totalcopies-v.projiangnum;
         }else if(type==2){
             $("#pushreleanum").html(v.targetcopies);
             $("#pushjoinnum").html(v.pushjoinnum);
             $("#pushcompletenum").html(v.compltenum);
             $("#pushonecoin").html(v.eachcoin);
             $("#pushtoatalcoin").html(v.totalcopies);
             $("#pushissuedcoin").html(v.issued);
              pusharr=v.pushchart;
              pushjiangcoin=v.issued;
              pushbalancecoin=v.totalcopies-v.issued;
         }
   },"json");
    myChart1.hideLoading();  
    myChart2.hideLoading();
    myChart3.hideLoading();  
    myChart4.hideLoading();
    myChart5.hideLoading();  
    myChart6.hideLoading();
   
    //推广数据
    var option1 = {
        tooltip: {
            show: true
        },
        xAxis: [
            {
                type: 'category',
                data: ["目标数量", "参与数量"]
            }
        ],
        yAxis: [
            {
                type: 'value',
                axisLabel: {
                    formatter: function (v) {
                        return (v / 10000) + '万'
                    }
                }
            }
        ],
        series: [
            {
                "type": "bar",
                "data": proarr,
            }
        ]
    };
    // 为echarts对象加载数据 
    myChart1.setOption(option1);

    var option2 = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['已奖励金币量', '账户金币余额']
        },
        series: [
            {
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: [
                    {value: projiangcoin, name: '已奖励金币量'},
                    {value: probalancecoin, name: '账户金币余额'},
                ]
            }
        ]
    };
    // 为echarts对象加载数据 
    myChart2.setOption(option2);


    var option3 = {
        tooltip: {
            trigger: 'item'
        },
        roamController: {
            show: false,
            x: 'right',
            mapTypeControl: {
                'china': false
            }
    },
        series: [
            {
                name: '推广赚',
                type: 'map',
                mapType: 'china',
                itemStyle: {
                    normal: {label: {show: true,
                            textStyle: {
                                color: '#595758',
                            }
                        },
                        areaStyle: {color: '#97d6f5'},
                        borderColor: 'white'
                    },
                    emphasis: {label: {show: true,
                            textStyle: {
                                color: 'red',
                            }
                        }}
                },
                data: [
                    {name: '北京', value: 0},
                    {name: '天津', value: 0},
                    {name: '上海', value: 0},
                    {name: '重庆', value: 0},
                    {name: '河北', value: 0},
                    {name: '河南', value: 0},
                    {name: '云南', value: 0},
                    {name: '辽宁', value: 0},
                    {name: '黑龙江', value: 0},
                    {name: '湖南', value: 0},
                    {name: '安徽', value: 0},
                    {name: '山东', value: 0},
                    {name: '新疆', value: 0},
                    {name: '江苏', value: 0},
                    {name: '浙江', value: 0},
                    {name: '江西', value: 0},
                    {name: '湖北', value: 0},
                    {name: '广西', value: 0},
                    {name: '甘肃', value: 0},
                    {name: '山西', value: 0},
                    {name: '内蒙古', value: 0},
                    {name: '陕西', value: 0},
                    {name: '吉林', value: 0},
                    {name: '福建', value: 0},
                    {name: '贵州', value: 0},
                    {name: '广东', value: 0},
                    {name: '青海', value: 0},
                    {name: '西藏', value: 0},
                    {name: '四川', value: 0},
                    {name: '宁夏', value: 0},
                    {name: '海南', value: 0},
                    {name: '台湾', value: 0},
                    {name: '香港', value: 0},
                    {name: '澳门', value: 0}
                ]
            },
        ]
    };
    myChart3.setOption(option3);

    var option4 = {
        tooltip: {
            show: true
        },
        xAxis: [
            {
                type: 'category',
                data: ["目标数量", "参与数量", "完成数量"],
                axisLabel: {
                    textStyle:{
                        color:"#595758",
                    }
                }
            }
        ],
        yAxis: [
            {
                type: 'value',
                axisLabel: {
                    formatter: function (v) {
                        return (v / 10000) + '万'
                    },
                    textStyle:{
                        color:"#595758",
                    }
                }
            }
        ],
        series: [
            {
                "type": "bar",
                "data": pusharr,
            }
        ]
    };

    // 为echarts对象加载数据 
    myChart4.setOption(option4);

    var option5 = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['已奖励金币量', '账户金币余额']
        },
        series: [
            {
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: [
                    {value: pushjiangcoin, name: '已奖励金币量'},
                    {value: pushbalancecoin, name: '账户金币余额'},
                ]
            }
        ]
    };
    // 为echarts对象加载数据 
    myChart5.setOption(option5);
    var option6 = {
        tooltip: {
            trigger: 'item'
     },
        roamController: {
            show: false,
            x: 'right',
            mapTypeControl: {
                'china': true
            }
    },
        series: [
            {
                name: '随手赚',
                type: 'map',
                mapType: 'china',
                itemStyle: {
                    normal: {label: {show: true,
                            textStyle: {
                                color: '#595758',
                            }

                        },
                        areaStyle: {color: '#97d6f5'},
                        borderColor: 'white',
                    },
                    emphasis: {label: {show: true,
                            textStyle: {
                                color: 'red',
                            }
                        }}
                },
                data: [
                    {name: '北京', value: 0},
                    {name: '天津', value: 0},
                    {name: '上海', value: 0},
                    {name: '重庆', value: 0},
                    {name: '河北', value: 0},
                    {name: '河南', value: 0},
                    {name: '云南', value: 0},
                    {name: '辽宁', value: 0},
                    {name: '黑龙江', value:0},
                    {name: '湖南', value: 0},
                    {name: '安徽', value: 0},
                    {name: '山东', value: 0},
                    {name: '新疆', value: 0},
                    {name: '江苏', value: 0},
                    {name: '浙江', value: 0},
                    {name: '江西', value: 0},
                    {name: '湖北', value: 0},
                    {name: '广西', value: 0},
                    {name: '甘肃', value: 0},
                    {name: '山西', value: 0},
                    {name: '内蒙古', value: 0},
                    {name: '陕西', value: 0},
                    {name: '吉林', value: 0},
                    {name: '福建', value: 0},
                    {name: '贵州', value: 0},
                    {name: '广东', value: 0},
                    {name: '青海', value: 0},
                    {name: '西藏', value: 0},
                    {name: '四川', value: 0},
                    {name: '宁夏', value: 0},
                    {name: '海南', value: 0},
                    {name: '台湾', value: 0},
                    {name: '香港', value: 0},
                    {name: '澳门', value: 0}
                ]
            },
        ]
    };
    // 为echarts对象加载数据 
    myChart6.setOption(option6); 
        
}

