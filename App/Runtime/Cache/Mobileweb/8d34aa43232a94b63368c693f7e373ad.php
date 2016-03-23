<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, STHeiTi, Arial, sans-serif;

        }
        body {
            background-image:url(/wisdom/Public/Mobileweb/Default/images/city.gif);
            background-repeat:no-repeat;
            background-size: 100% 100%;
        }

        .time{
            padding: 0;
            position: absolute;
            width: 100%;
            top: 56.2%;
            height: 4%;
        }
        .time span{
           position: absolute;
            font-size: 1em;
            display: block;
            float: left;
            width: 27px;
            height: 27px;
            text-align: center;
            /* background: #fff; */
            line-height: 25px;
            color: #7f7f80;
        }
    </style>

</head>

<body>
<div data-role="page">
    <div role="main" class="ui-content" style="padding: 0">
        <div class="time">
            <span style="left: 20%" id="DD"></span>
            <span style="left: 32%" id="HH"></span>
            <span style="left: 43%" id="MM"></span>
            <!--<span style="left: 63%" id="SS">20</span>-->
        </div>
        <input type="hidden"  value="<?php echo ($nowtime); ?>"  id="nowtime">
    </div><!-- /content -->
</div>

</body>
<script>
//    function getQueryString(name) {
//        var reg =new RegExp("(^|&)"+ name +"=([^&]*)(&|$)", "i");
//        var r = window.location.search.substr(1).match(reg);
//        if (r !=null) return unescape(r[2]); returnnull;
//    }

    var strcurrentDate = document.getElementById("nowtime").value;

    var currentDate = new Date(strcurrentDate).getTime();
    var strEndTime = "2016/02/08 00:00:00";

    var EndTime=new Date(strEndTime).getTime();
    var days=parseInt(parseInt(EndTime) - parseInt(currentDate));
    EndTimeMsg = parseInt(days / 1000);//精确到秒
    function show() {
        h = Math.floor(EndTimeMsg / 60 / 60);
        m = Math.floor((EndTimeMsg - h * 60 * 60) / 60);
        s = Math.floor((EndTimeMsg - h * 60 * 60 - m * 60));
        document.getElementById("DD").innerHTML = parseInt(h/24);
        document.getElementById("HH").innerHTML = h-(parseInt(h/24)*24);
        document.getElementById("MM").innerHTML = m;

//        document.getElementById("SS").innerHTML = s;
        EndTimeMsg--;
        if (EndTimeMsg < 0)
        {
            document.getElementById("DD").innerHTML = "00";
            document.getElementById("HH").innerHTML = "00";
            document.getElementById("MM").innerHTML = "00";
//            document.getElementById("SS").innerHTML = "00";
        }

    }
    setInterval("show()", 1000)
</script>
</html>