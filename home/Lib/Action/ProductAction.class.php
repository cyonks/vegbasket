<?php

class ProductAction extends Action{
	/**
	 *产品信息页面
	 */
	public function index(){
		$product=M('product');
		$priceinfo=M('priceinfo');

		//获取市场
		$market_name=$_REQUEST['mname'];//"广州城区菜篮子平均零售价格";
		//获取产品名称
		$product_name=$_REQUEST['pname'];//"本地菜心";
		
		$market_name=iconv("GB2312","UTF-8",$market_name);
		$product_name=iconv("GB2312","UTF-8",$product_name);

		$map['product_name']=array('eq',$product_name);
		$productinfo=$product->where($map)->select();
		//获取某市场该产品近10天的价格列表
		$map['market_name']=array('eq',$market_name);
		$pro_pricelist=$priceinfo->where($map)->order('pdate desc')->limit(10)->select();

		$this->list=$pro_pricelist;
		$this->product=$productinfo;
		$this->display();

	}
}

?>