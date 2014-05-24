<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html dir="ltr" lang="zh">
<head>
    <meta  http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width" />
    <title>菜篮子价格查询首页</title>
    <link rel='stylesheet' href='__PUBLIC__/css/index.css' type='text/css'/>
    <script type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
    <script type='text/javascript' src='__PUBLIC__/js/swfobject.js'></script>
    <script type="text/javascript" src='__PUBLIC__/js/jquery.js'></script>
    <script type="text/javascript" src='__PUBLIC__/js/index.js'></script>
   <script type="text/javascript">
      var url='__URL__';
      var _public='__PUBLIC__';
   </script>
   <script type="text/javascript" src='__PUBLIC__/js/flash.js'></script>
</head>
<body>
<div id="list"></div>
<div class="whole_page">
	<div class="C_top">
  <div class="C_logo"><a href="/vegbasket" title="菜篮子查询网">菜篮子查询网</a></div>
  <div class="C_search">
  <form action="__URL__/../Search/index" method="get" name="DJmyform" id="DJmyform" target="_blank">
    <div class="C_searchTxt">
      <input type="text" name="SearchKey" id="SearchKey" autocomplete="off" class="C" value="请输入产品名称或产品编号查询" onfocus="if(this.value=='请输入产品名称或产品编号查询') this.value='';" onblur="if(this.value=='') this.value='请输入产品名称或产品编号查询';" onkeydown="if(event.keyCode==13)search()"/>
    </div>
    <div class="C_searchBtn">
      <input name="" type="button" id="DJSearchSubmit" value="搜索" class="btn" onclick="search()" />
    </div>
    </form>
    <div class="search_key">热门查询:&nbsp;      
      <?php if(is_array($listsearch)): $i = 0; $__LIST__ = $listsearch;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ls): $mod = ($i % 2 );++$i;?><a href="__URL__/../Search/index/keyword/<?php echo ($ls["product_name"]); ?>" target="_blank"><?php echo ($ls["product_name"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>

</div>


<!-- 导航栏 -->
<div id="nav_">
  <nav class="breadcrumb">
     <input id="sdate" class="Wdate" name="date" type="text" value=<?php echo ($date); ?> readonly="true" onfocus="WdatePicker({skin:'whyGreen',onpicked:function(dp){refreshtable();}})" />

      <select class="cities" name="cities" title="城市" onchange="refreshtable()">
         <option><?php echo ($select_city); ?></option>
        <?php if(is_array($listcity)): $i = 0; $__LIST__ = $listcity;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lc): $mod = ($i % 2 );++$i;?><option><?php echo ($lc["city_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
      <div class="category_">
      <span  title="分类">分类:</span>
        <select  class="select_cate" name="categorys" title="分类" onchange="refreshtable()">

            <option><?php echo ($select_cate); ?></option>
          <?php if(is_array($listcate)): $i = 0; $__LIST__ = $listcate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option><?php echo ($v["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>


      </div>
      <div class="admin">
        <a href="/vegbasket/index.php/Search" target="_blank">搜索页面</a>&nbsp;&nbsp;
        <a href="/vegbasket/index.php/Admin" target="_blank">后台管理</a>
      </div>    
  </nav>  
</div>

<div class="slid_and_state">
   <!--滚动栏-->
  <div id="slider2" class="inner2 flash">
      <div id="piecemaker"></div>
  </div>
      
   <!--动态新闻-->
   <div class="news">
      <center>
      <h2 id="news_head">最新动态</h2>
      </center>
        <?php if(is_array($listnews)): $i = 0; $__LIST__ = $listnews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ln): $mod = ($i % 2 );++$i;?><li class="news_title">
          <a href="__URL__/../News/newsdetail/newsid/<?php echo ($ln["news_id"]); ?>" target="_blank"><?php echo ($ln["news_title"]); ?></a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="more_news"><a href="__URL__/../News" target="_blank">更多动态</a></div>
   </div>
</div>

<div class="main_content">
  <div class="today">
    <h2 class="h_today">今日推荐</h2>
    <?php if(is_array($list)): $i = 0; $__LIST__ = array_slice($list,0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$to): $mod = ($i % 2 );++$i;?><p><?php echo ($to["product_name"]); ?>：<?php echo ($to["product_price"]); ?>￥/kg</p><?php endforeach; endif; else: echo "" ;endif; ?>

  </div>
  <div class="box_content" id="tb_content">
            <table width="100%" border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
              <th scope="col">日期
              <!--
                  <input id="sdate" class="Wdate" type="text" onClick="WdatePicker()">
              -->
              </th>

              <th scope="col">市场</th>
              <th scope="col">产品</th>
              <th scope="col">类别</th>
              <th scope="col">价格</th>
              <th scope="col">发布者</th>
              <th scope="col">数据来源</th>
            </tr>
            </thead>
            <tbody id="tbody">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" id="tb_body">
              <td><a href="" target="_blank"><?php echo ($vo["pdate"]); ?></a></td>
              <td><?php echo ($vo["market_name"]); ?></td>
              <td><a href="__URL__/../Product/index/pname/<?php echo ($vo["product_name"]); ?>/mname/<?php echo ($vo["market_name"]); ?>" target="_blank"><?php echo ($vo["product_name"]); ?></a></td>
              <td><?php echo ($vo["category_name"]); ?></td>
              <td><?php echo ($vo["product_price"]); ?></td>
              <td><a href="" target="_blank"><?php echo ($vo["publisher"]); ?></a></td>
              <td><?php echo ($vo["datasource"]); ?></td> 
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
      </table>
      <div class="result page" id="page"><?php echo ($page); ?></div>
      <!-- <div>p:<?php echo ($parameter); ?></div> -->
      <!-- <div>p2:<?php echo ($parameter2); ?></div> -->
      <!-- <div>p3:<?php echo ($parameter3); ?></div> -->
      <div class="clear"></div>
  </div>
</div>
</div>

<!-- <footer id="footer1" class="vbk-footer">帮助</footer> -->
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