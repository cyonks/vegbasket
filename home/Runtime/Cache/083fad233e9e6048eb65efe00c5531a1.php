<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>添加价格</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/admin.css">
	<script type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
	<script type="text/javascript">

	function getmarket()
	{
		var $city=$('select[name="city"]').val();
		$.getJSON('__URL__/getmarket',{city:$city},function(json){
		if(json.status==1){
			// $mess.slideDown(3000,function(){
			// $mess.css('display','block');
			// }).html(json.data[0]['title']);
			var s="";
			for(var i=0;i<json.data.length;i++)
			{
				s+="<option>"+json.data[i]['market_name']+"</option>";
			}
			var old_select = document.getElementById('marketid'); 
			old_select.innerHTML =s; // 将原来的table内容更换
		}else{
				var old_select = document.getElementById('marketid'); 
				old_select.innerHTML ="<option>没有该城市数据</option>"; 
			}
		});
	}

	function getproduct()
	{
		var $category=$('select[name="cname"]').val();
		$.getJSON('__URL__/getproduct',{category:$category},function(json){
		if(json.status==1){
			// $mess.slideDown(3000,function(){
			// $mess.css('display','block');
			// }).html(json.data[0]['title']);
			var s="";
			for(var i=0;i<json.data.length;i++)
			{
				s+="<option>"+json.data[i]['product_name']+"</option>";
			}
			var old_select = document.getElementById('productid'); 
			old_select.innerHTML =s; // 将原来的table内容更换
		}else{
				var old_select = document.getElementById('productid'); 
				old_select.innerHTML ="<option>没有该城市数据</option>"; 
			}
		});
	}
	</script>
</head>
<body>
	<div class="formdiv">
	  <form class="inform" action="__URL__/AddPrice" method="post">
		<p>
			<input type="date" name="date" value="<?php echo ($today); ?>"/>

		</p>
		<p>
			<!-- <input  style="width:15%" type="text" name="city" placeholder="城市"/> -->
			<select name="city" style="width:15%" onchange="getmarket()">
				<?php if(is_array($citylist)): $i = 0; $__LIST__ = $citylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?><option>
						<?php echo ($cl["city_name"]); ?>
					</option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<!-- <input style="width:75%" type="text"  name="mname" placeholder="市场"/> -->
			<select name="mname" id="marketid" style="width:75%">
				<?php if(is_array($marketlist)): $i = 0; $__LIST__ = $marketlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ml): $mod = ($i % 2 );++$i;?><option>
						<?php echo ($ml["market_name"]); ?>
					</option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>		
		</p>

		
		<p>
			<!-- <input style="width:45%" type="text" name="cname" placeholder="分类"/> -->

			<select name="cname" style="width:45%" onchange="getproduct()">
				<?php if(is_array($categorylist)): $i = 0; $__LIST__ = $categorylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clt): $mod = ($i % 2 );++$i;?><option>
						<?php echo ($clt["category_name"]); ?>
					</option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			<!-- <input style="width:45%" type="text" name="pname" placeholder="名称"/> -->
			<select name="pname" style="width:45%" id="productid">
				<?php if(is_array($productlist)): $i = 0; $__LIST__ = $productlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pl): $mod = ($i % 2 );++$i;?><option>
						<?php echo ($pl["product_name"]); ?>
					</option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</p>
		<p>
			<input style="width:15%" type="number" name="price" placeholder="价格"/>
			<input style="width:75%" type="text" name="datasource" placeholder="数据来源"/>
		</p>
	   
		<input class="submit" type="submit" value="提交"/>
	   </form>
	   <div><?php echo ($test); ?></div>
	</div>
</body>
</html>