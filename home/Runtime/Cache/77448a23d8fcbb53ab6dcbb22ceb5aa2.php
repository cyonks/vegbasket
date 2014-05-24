<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($product[0]['product_name']); ?></title>
	<meta charset="utf-8"/>
	<link rel='stylesheet' href='__PUBLIC__/css/index.css' type='text/css'/>

<!-- 曲线图 -->
<style type="text/css">
#basicGChart { width: 450px; height: 300px }
</style>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/Chart.js"></script>
        <style>
            canvas{
            }
        </style>

</head>
<body>
	<div class="phead">

<!-- 		id:<?php echo ($product[0]["product_id"]); ?><br/> -->
		<h1><?php echo ($product[0]['product_name']); ?></h1>
		<span><?php echo ($list[0]['market_name']); ?></span>
	</div>

	<div class="proinfo">
		<img src="__PUBLIC__/images/pimg/<?php echo ($product[0][product_img]); ?>" onerror="this.src='__PUBLIC__/images/pimg/noimg.jpg'" width="400" height="300" />
		<div class="tablediv">
		   <table class="pinfotb">
			<tr>
				<td class="t">名称：</td>
				<td><?php echo ($product[0]['product_name']); ?></td>
			</tr>
			<tr>
				<td class="t">类别：</td>
				<td><?php echo ($list[0]['category_name']); ?></td>
			</tr>
			<tr>
				<td class="t">描述：</td>
				<td><?php echo ($product[0]['product_desc']); ?></td>
			</tr>
		  </table>
		</div>	  	
  </div>

  <div id="analisy">
	<div id="tb_table">
	 <table cellspacing="0" cellpadding="0">	
	     
		  <tr>
	        <th>日期</th>
	        <th>价格</th>
	        <th>发布者</th>
	        <th>数据来源</th>
	      </tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	      <td><a href="" target="_blank"><?php echo ($vo["pdate"]); ?></a></td>
	      <td><?php echo ($vo["product_price"]); ?></td>
	      <td><?php echo ($vo["publisher"]); ?></td>
	      <td><?php echo ($vo["datasource"]); ?></td> 
	      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<caption align="bottom"><h2>过去十天价格列表</h2></caption>
	 </table>
	</div>

	<div id="canvas_img">
    	<canvas id="canvas" height="450" width="600"></canvas>
		<h2><?php echo ($product[0]['product_name']); ?>最近十天价格走势曲线图</h2>
	</div>
  </div>

    <script>
    	var array1=new Array();
    	var array2=new Array();
    	var d1=<?php echo ($list[9]['product_price']); ?>;
    	var d2=<?php echo ($list[8]['product_price']); ?>;
    	var d3=<?php echo ($list[7]['product_price']); ?>;
    	var d4=<?php echo ($list[6]['product_price']); ?>;
    	var d5=<?php echo ($list[5]['product_price']); ?>;
    	var d6=<?php echo ($list[4]['product_price']); ?>;
    	var d7=<?php echo ($list[3]['product_price']); ?>;
    	var d8=<?php echo ($list[2]['product_price']); ?>;
    	var d9=<?php echo ($list[1]['product_price']); ?>;
    	var d10=<?php echo ($list[0]['product_price']); ?>;
    	array1=[d1,d2,d3,d4,d5,d6,d7,d8,d9,d10];
    	
    	array2=["lastten","lastnine","lasteight","lastseven","lastsix","lastfive","前四","前天","昨天","今天"]; 	
        // var array1=[2,4];
        // var array2=[4,5];
        var lineChartData = {
　　　　　　　// x轴的标示
            labels : array2,
　　　　　　　// 数据，数组中的每一个object代表一条线
            datasets : [
//                 {
// 　　　　　　　　　　　　// 颜色的使用类似于CSS，你也可以使用RGB、HEX或者HSL
// 　　　　　　　　　　　　// rgba颜色中最后一个值代表透明度
// 　　　　　　　　　　　　// 填充颜色
//                     fillColor : "rgba(220,220,220,0.5)",
// 　　　　　　　　　　　　// 线的颜色
//                     strokeColor : "rgba(220,220,220,1)",
// 　　　　　　　　　　　　// 点的填充颜色
//                     pointColor : "rgba(220,220,220,1)",
// 　　　　　　　　　　　　// 点的边线颜色
//                     pointStrokeColor : "#fff",
// 　　　　　　　　　　　　// 与x轴标示对应的数据
//                     data : array1
//                 }
//                 ,
                {
                    fillColor : "rgba(151,187,205,0.5)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    data : array1
                }
            ]
            
        }

    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
    
    </script>
    <!-- <div id="s_footer" class="wa_mode">
       
       <ul id="s_service">
        <li><a href="" target="_blank">企业推广</a></li>
        <li><a href="" target="_blank">诚聘英才</a></li>
        <li><a href="" target="_blank">免责声明</a></li>
        <li><a href="" target="_blank">开放平台</a></li>
        <li><a href="" target="_blank">帮助</a></li>
        <li><a href="" target="_blank">提意见</a></li>
        </ul>
        
        <p id="s_copyright">©2014&nbsp;VBasket&nbsp;-&nbsp;京ICP证050897号</p>
</div> -->
    <div id="s_footer" class="wa_mode">
       
       <ul id="s_service">
        <li><a href="" target="_blank">企业推广</a></li>
        <li><a href="" target="_blank">诚聘英才</a></li>
        <li><a href="" target="_blank">免责声明</a></li>
        <li><a href="" target="_blank">开放平台</a></li>
        <li><a href="" target="_blank">帮助</a></li>
        <li><a href="" target="_blank">提意见</a></li>
        </ul>
        
        <p id="s_copyright">©2014&nbsp;VBasket&nbsp;-&nbsp;京ICP证050897号</p>
</div>
</body>
</html>