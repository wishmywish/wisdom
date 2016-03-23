<?php if (!defined('THINK_PATH')) exit();?>
<div id="allmap" style="width: 800px;height: 500px;"></div>

<script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/jquery.form.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/jquery.bigautocomplete.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/skin/layer.css"></script>
<script type="text/javascript" src="/wisdom/Public/static/laypage/laypage.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/laydate/laydate.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/js/area.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/fun.js"></script>
<script type="text/javascript" src="/wisdom/Public/Home/Default/js/fun.js"></script>
<!--ueditor编译器配置文件-->

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>

<!--ueditor编译器源码文件-->
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>

<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>
<div style="display: none;"><script src="http://s11.cnzz.com/z_stat.php?id=1256375228&web_id=1256375228" language="JavaScript"></script></div>

 
 
 
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=CBiu8d6o1peWFBWqvzYGA7fy"></script>
<script>
    $(function(){
    });


    //百度地图API功能
    var province = '<?php echo empty($_GET["province"])?0:$_GET["province"]; ?>'; //省名称
    var city = '<?php echo empty($_GET["city"])?0:$_GET["city"]; ?>';  //城市名




    //默认显示中国地图
    center = "中国";
    level = 5;  //级别越小，显示的范围越大


    //如果选了城市
    if( city != 0 ){
        center = city;
        level = 15;  //级别越小，显示的范围越大
    }

    //如果只选了省
    if( city == 0 && province != 0 ){
        center = province;
        level = 10;  //级别越小，显示的范围越大
    }

    //创建地图并显示
//    var map = new BMap.Map("allmap");            // 创建Map实例
//    map.addControl(new BMap.MapTypeControl());
//    map.centerAndZoom(center,level);      // 初始化地图,用城市名设置地图中心点


    //通过地址获取经纬度,再通过经纬度创建标注
    var myGeo = new BMap.Geocoder(); // 创建地址解析器实例
    myGeo.getPoint(center, function(point){
        //创建地图并显示
        var map = new BMap.Map("allmap");            // 创建Map实例
        map.addControl(new BMap.MapTypeControl());
        map.centerAndZoom(point,level);      // 初始化地图,用经纬度设置地图中心点

        //创建标注，红点
        var marker = new BMap.Marker(point);  // 创建标注
        map.addOverlay(marker);               // 将标注添加到地图中
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    });



    //单击获取点击的经纬度
    map.addEventListener("click",function(e){

        //获取地址的数据地址
        var gc = new BMap.Geocoder();
        var pt = e.point; //经纬度集合
        gc.getLocation(pt, function(rs){
            var addComp = rs.addressComponents; //获取到的结果集合
            address = addComp.province +  addComp.city + addComp.district + addComp.street + addComp.streetNumber;  //获取地址名称


            //给父页面传值
            parent.x.value= pt.lng; //经度
            parent.y.value= pt.lat; //纬度
            parent.address.value= address; //地址

            //关闭父页面
            var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
            parent.layer.close(index);

        });



    });


</script>
</body>
</html>