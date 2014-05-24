
function search()
{
	var keyword=document.getElementById("suggest_input").value;
	if(keyword==''||keyword=='请输入产品名称或产品编号查询')
	{
		document.getElementById("result_title").innerHTML="请输入搜索关键字";
		return;
	}
	window.location.href=url+"/index/keyword/"+keyword;
}
//搜索更新
function refreshtable(){

    var keyword=document.getElementById("suggest_input").value;
  	var $date=$('input[name="date"]').val();
  	var $city=$('select[name="cities"]').val();
  	var $category=$('select[name="categorys"]').val();	

	if(keyword==''||keyword=='请输入产品名称或产品编号查询')
	{
		document.getElementById("result_title").innerHTML="请输入搜索关键字";
		window.location.href=url+"/index/date/"+$date+"/city/"+$city+"/category/"+$category;
		return;
	}
  window.location.href=url+"/index/date/"+$date+"/city/"+$city+"/category/"+$category+"/keyword/"+keyword;
}

//点击热门搜索
function hotsearch(pname){
  var t=document.getElementById('suggest_input');
  var f=document.getElementById('DJSearchSubmit');
  t.value=pname;
  f.onclick();
}


	//禁用Enter键表单自动提交
        document.onkeydown = function(event) {
            var target, code, tag;
            if (!event) {
                event = window.event; //针对ie浏览器
                target = event.srcElement;
                code = event.keyCode;
                if (code == 13) {
                    tag = target.tagName;
                    if (tag == "TEXTAREA") { return true; }
                    else { return false; }
                }
            }
            else {
                target = event.target; //针对遵循w3c标准的浏览器，如Firefox
                code = event.keyCode;
                if (code == 13) {
                    tag = target.tagName;
                    if (tag == "INPUT") { return false; }
                    else { return true; } 
                }
            }
        };