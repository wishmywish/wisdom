<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta charset="utf-8">
<title></title>
<style>

		 html,body{
		 	margin:0 auto;
		 	padding:0px;
		 	font-size:12px;
		 }
			.content{
				margin:10px 20px;
				margin-bottom:10px;
				width:500px;
			}
			ul,li{
				padding:0px;
				margin:0px;
				list-style:none;
			}
			.content ul{
			    float:left;
			 	width:100%;
				min-height:30px;
				border-bottom:1px gainsboro  solid;
			}
			.content:last-child{
			    margin-bottom:20px;
			}
			.content ul li{
				text-align:center;
			    float:left;
				width:25%;
				min-height:30px;
				line-height:30px;
				
			}
		
</style>
</head>
<body>
	<div class="content">
		<?php  if($result) {?>
		<ul>
			<li>操作人</li>
			<li>操作时间</li>
			<li>状态</li>
			<li>理由</li>
		</ul>
		<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><ul>
				<li><?php echo ($v["user"]["realname"]); ?></li>
			    <li><?php echo ($v["f_datetime"]); ?></li>
			    <li>
			    	<?php if($v["f_proname"] == 'reject'): ?><span  style="color:green;">驳回</span>
				    <?php elseif($v["f_proname"] == 'delay'): ?><span style="color:blue;">延时</span>
				    <?php elseif($v["f_proname"] == 'update'): ?><span style="color:lightseagreen;">更新</span>
				    <?php elseif($v["f_proname"] == 'noReview'): ?><span style="color:darkred;">审核不通过</span>
				    <?php elseif($v["f_proname"] == 'cwReview'): ?><span style="color: indigo;">财务审核</span>
				    <?php elseif($v["f_proname"] == 'review'): ?><span  style="color:cornflowerblue;">客服审核</span>	
					<?php else: ?><span>无</span><?php endif; ?>
			    </li>
			    <li><?php echo ($v["f_reason"]); ?></li>
					
		    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
		
		<?php }else{?>
			<p style='color:red;'>暂无数据</p>
	    <?php  }?>
		
	</div>
</body>
</html>