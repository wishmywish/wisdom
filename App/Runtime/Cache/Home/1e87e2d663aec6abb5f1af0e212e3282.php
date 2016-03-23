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
            height:700px;
            background: url("/wisdom/Public/Home/Default/images/bs_tasklogo.png") 0 0 no-repeat;
            z-index:1000;
            position: relative;
        }

        .title{
            margin-left: 116px;
            top: 235px;
            width: 200px;
            position: absolute;
            height: 35px;
            font-size: 16px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            word-break: break-all;
        }

        .goid_coin{
            color: rgb(248, 98, 6);
            position: absolute;
            left: 155px;
            top: 265px;
            font-weight: bold;
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
        <img src="<?php echo ($imgsrc); ?>"  height="50px" width="50px" style="margin-left:36px;height:76px;width:76px;margin-top:230px;">
        <div>
            <span class="title"><?php echo ($tasktitle); ?></span>
            <p class="goid_coin"><?php echo ($coin); ?></p>
        </div>
        <div class="pro_Descrip">
           <?php echo ($pro_Descrip); ?>
        </div>
    </div>
</div>


</body>
</html>