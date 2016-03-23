<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <style>
        html,body{
            margin:0px;
            padding:0px;
        }
        body{
            border:none;
        }

        .content{
            width:370px;
            height:500px;
            background: url("/wisdom/Public/Home/Default/images/bs_taskbanner.png") 0 0 no-repeat;
            z-index:1000;
            position: relative;
        }

        .title{
            position: absolute;
            top: 201px;
            width: 280px;
            height: 20px;
            left: 30px;
            font-size: 16px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #fff;
        }

        .goid_coin{
            color: #fff;
            position: absolute;
            left: 30px;
            top: 222px;
            /* font-weight: bold; */
            font-size: 12px;
        }
        p span:first-child{
            width: 80px;
            height: 20px;
            border-right: 1px solid #fff;
            padding-right: 18px;
        }
        .pro_Descrip {
            position: absolute;
            top: 345px;
            width: 230px;
            height: 20px;
            left: 85px;
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #636363;
        }
        .cc{
            background-color:rgba(0,0,0,.83);
            /*opacity: 0.8;*/
        }
    </style>
</head>
<body>
<div class="cc">
    <div class="content">
        <img src="<?php echo ($imgsrc); ?>"  height="50px" width="50px" style="  margin-left: 21px;height: 100px;width: 300px;margin-top: 85px;">
        <div>
            <span class="title"><?php echo ($tasktitle); ?></span>
            <p class="goid_coin">
                <span class="">金币：<?php echo ($coin); ?></span>
                <span style="padding-left: 15px;">关注：8888</span>
            </p>
        </div>
    </div>
</div>


</body>
</html>