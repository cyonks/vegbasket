<?php if (!defined('THINK_PATH')) exit();?>
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