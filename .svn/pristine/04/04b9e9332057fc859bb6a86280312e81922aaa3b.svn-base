/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadPay(taskid){
/* global FusionCharts, echarts */
   var myChart2= echarts.init(document.getElementById('business_chart')); 
   var myChart1 = echarts.init(document.getElementById('business_gauge'));
   var myChart3 = echarts.init(document.getElementById('map'));
   var Invpercent=0;
   var payarr="";
   var invquit="";
   var redealnum;
   var authdealnum;
   var contsignednum;
   myChart2.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   myChart1.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   myChart3.showLoading({
     text: '正在努力的读取数据中...'    //loading话术
     });
   $.ajaxSetup({   
            async : false
        }); 
   $.post(APP+"/Api/Web/InvTargetstatistics","taskid="+taskid,function(v){
           Invpercent=Math.round(v.Actinvestment/v.Invtarget*100);
           $("#Invpercent").html(Invpercent+"%");
           $("#Invtarget").html(v.Invtarget);
           $("#Actinvestment").html(v.Actinvestment);
           
           payarr=v.payarr;
           $("#collecttarget").html(v.collecttarget);
           $("#paypect").html(Math.round(v.actualpayment/v.collecttarget*100)+"%");
           $("#actualpayment").html(v.actualpayment);
           $("#authdealnum").html(v.authdealnum);
           $("#contsignednum").html(v.contsignednum);
           $("#expectedmoney").html(v.expectedmoney);
           $("#actualtotalpay").html(v.actualtotalpay);
           invquit+="<table border='1' style='border-collapse: collapse;width:100%' class='map_table'><thead><tr><th>序号</th><th>区域</th><th>数量</th></tr></thead><tbody>";
           //展示招商排名前五的区域
           $.each(v.Invareasort,function(i,v){
                invquit+="<tr><td>"+(i+1)+"</td><td>"+v.f_area+"</td><td>"+v.f_qty+"</td></tr>";
           });
           invquit+"</tbody></table>";
           $("#Invquitrank").html(invquit);
           redealnum=v.redealnum;
           authdealnum=v.authdealnum;
           contsignednum=v.contsignednum;
     },"json");
   myChart2.hideLoading();  
   myChart1.hideLoading();
   myChart3.hideLoading();
   //招商柱状图
   var  option = {
   
    tooltip : {
        trigger: 'axis'
    },
 
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['回款目标','实际回款']
        }
    ],
    yAxis : [
        {
            type : 'value',
            axisLabel: {
                formatter: function (v) {
                    return (v/10000) +'万'
                }
            }
        }
        
    ],
    series : [
        {
            name:'金额',
            type:'bar',
            data:payarr,
        },
     
    ]
};
// 为echarts对象加载数据 
    myChart2.setOption(option);
        
 //招商仪表盘图
   var option1 = {
      series : [
        {
            name:'招商',
            type:'gauge',
            startAngle: 180,
            endAngle: 0,
            center : ['50%', '90%'],    // 默认全局居中
            radius :150,
            axisLine: {            // 坐标轴线
                lineStyle: {   
                    color:[
                       [0.5,'#b63b00'],
                       [0.75,'#c69714'],
                       [1,'#558800']
                     ],// 属性lineStyle控制线条样式
                    width: 150
                }
            },
            axisTick: {            // 坐标轴小标记
                splitNumber:5,   // 每份split细分多少段
                length :8        // 属性length控制线长
            }, 
            axisLabel:{
              show:true,
              textStyle:{
                 color:'white'
              }
           },
            pointer: {
                width:20,
                length: '80%',
                color: 'rgba(255, 255, 255, 0.8)'
            },
            splitLine:{
               show:true,
               length:10,
               lineStyle:{
                  color:[
                       [0.2,'black'],
                       [0.8,'black'],
                       [1,'black']
                     ],
                  width:2,
                  type:'solid'
               }
            },
            detail : {
                show : true,
                offsetCenter: [0, -40], 
                //formatter: null,// x, y，单位px
                formatter:'{value}%',
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontSize : 40,
                    color:'black'
                }
            },
            data:[{value:Invpercent}]
        }
    ]
};      // 为echarts对象加载数据 
     myChart1.setOption(option1);    
     if(redealnum==0&&authdealnum==0&&contsignednum==0){  ///wisdom/Public/Home/Default/images/nonedata.png'
         $("#business_funel").html("<img src='"+IMG+"/nonedata.png'/>");
     }else{
         business_funnel(redealnum,authdealnum,contsignednum);
     }
     
    var option3 = {
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
                name: '经销商',
                type: 'map',
                mapType: 'china',
                itemStyle: {
                    normal: {label: {show: true,
                            textStyle: {
                                color: '#595758',
                            }

                        },
                        areaStyle: {color:'#97d6f5'},
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
    // 为echarts对象加载数据 
    myChart3.setOption(option3);  
     
  
}

function  business_funnel(redealnum,authdealnum,contsignednum){
      //招商漏斗图       
 FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "funnel",
        "renderAt": "business_funel",
        "width": "400",
        "height": "300",
        "dataFormat": "json",
        "dataSource": {
          "chart": {
                "decimals": "0",
                "is2D": "1",
                "streamlinedData": "0",
                "showLegend": "1",
                "showLabels": "1",
                "theme": "fint",
                "bgColor":"#fafafa",
                "baseFontColor":"#595758",
                "useSameSlantAngle": "1"
           },
          "data": [
              {
                 "label": "上报经销商数量",
                 "value": redealnum
              },
              {
                 "label": "授权经销商数量",
                 "value": authdealnum
              },
              {
                 "label": "签订合同经销商数量",
                 "value": contsignednum
              }
           ]
        }
    });

    revenueChart.render();
});
}