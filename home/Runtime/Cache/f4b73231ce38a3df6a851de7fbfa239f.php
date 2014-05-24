<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜篮子查询网</title>
<!-- paste this code into your webpage -->
<link href="__PUBLIC__/tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<link rel='stylesheet' href='__PUBLIC__/css/index.css' type='text/css'/>

<script type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="__PUBLIC__/tablecloth/tablecloth.js"></script>
<script type="text/javascript" src='__PUBLIC__/js/jquery.js'></script>
<script type="text/javascript" src="__PUBLIC__/js/search.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/searchSuggest.js"></script>
<script type="text/javascript">
  var url='__URL__';
  var _public='__PUBLIC__';
</script>

<!-- end -->

</head>
<body>
<div class="whole_page2">
  <div class="C_top">
  <div class="C_logo"><a href="/vegbasket" title="菜篮子查询网">菜篮子查询网</a></div>
  <div class="C_search">
  <form action="__URL__/../Search/index" method="get" name="DJmyform" id="DJmyform">
    <div class="C_searchTxt" id="searchSuggest">
      <input type="text" name="keyword" id="suggest_input" autocomplete="off" class="C" value="请输入产品名称或产品编号查询" onfocus="if(this.value=='请输入产品名称或产品编号查询') this.value='';" onblur="if(this.value=='') this.value='请输入产品名称或产品编号查询';" onkeydown="if(event.keyCode==13)refreshtable()" autofocus x-webkit-speech/>
    </div>
    <div class="C_searchBtn">
      <input name="" type="button" id="DJSearchSubmit" value="搜索" class="btn" onclick="refreshtable()" />
    </div>
    </form>
    <ul id="suggest_ul">
    </ul>
    <div class="search_key">热门查询:&nbsp;
     <?php if(is_array($listsearch)): $i = 0; $__LIST__ = $listsearch;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ls): $mod = ($i % 2 );++$i;?><a href='javascript:void(0);' onclick="hotsearch('<?php echo ($ls["product_name"]); ?>')"><?php echo ($ls["product_name"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>
</div>

<div id="nav2_">
  <nav class="breadcrumb">
     <input id="sdate" class="Wdate" name="date" type="text" value=<?php echo ($date); ?> readonly="true" onfocus="WdatePicker({skin:'whyGreen',onpicked:function(dp){refreshtable();}})" />
     <!-- window.location.href='__URL__/../Index/index?date='+this.value; -->
      <select id="city" class="cities" name="cities" title="城市" onchange="refreshtable()">
      	  <!-- <option value=<?php echo ($city); ?>>城市:</option> -->
      	  <option selected="selected"><?php echo ($city); ?></option>
        <?php if(is_array($listcity)): $i = 0; $__LIST__ = $listcity;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lc): $mod = ($i % 2 );++$i;?><option><?php echo ($lc["city_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
      <!-- <div id="s_city"><?php echo ($city); ?></div> -->
      <!-- <input type="hidden" name="city" value=<?php echo ($city); ?>/> -->
      <div class="category_">
      <span  title="分类">分类:</span>
        <select  class="select_cate" name="categorys" title="分类" onchange="refreshtable()" autocomplete="on">

            <option selected="selected"><?php echo ($category); ?></option>
          <?php if(is_array($listcate)): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option ><?php echo ($v["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <!-- <div id="s_category"><?php echo ($category); ?></div> -->
        <!-- <input type="hidden" name="category" value=<?php echo ($category); ?>/> -->
      </div>
  </nav>  
</div>


<div>
<div id="container">
  <div id="tb_content">
    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
    
<h2 id="result_title">您搜索的关键字是：<span id="kw"><?php echo ($keyword); ?></span>,共有<?php echo ($count); ?>条记录</h2>
    <table cellspacing="0" cellpadding="0">
      <tr>
        <th>日期</th>
        <th>市场</th>
        <th>产品</th>
        <th>类别</th>
        <th>价格</th>
        <th>发布者</th>
        <th>数据来源</th>
      </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><a href="" target="_blank"><?php echo ($vo["pdate"]); ?></a></td>
      <td><?php echo ($vo["market_name"]); ?></td>
      <td><a href="__URL__/../Product/index/pname/<?php echo ($vo["product_name"]); ?>/mname/<?php echo ($vo["market_name"]); ?>" target="_blank"><?php echo ($vo["product_name"]); ?></a></td>
      <td><?php echo ($vo["category_name"]); ?></td>
      <td><?php echo ($vo["product_price"]); ?></td>
      <td><?php echo ($vo["publisher"]); ?></td>
      <td><?php echo ($vo["datasource"]); ?></td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div class="result page" id="page"><?php echo ($page); ?></div>
    <!-- <div>P:<?php echo ($parameter); ?></div> -->
    
  </div>
</div>
</div>

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