//更新index页面的价格列表

function refreshtable(){
  var $date=$('input[name="date"]').val();
  var $city=$('select[name="cities"]').val();
  var $category=$('select[name="categorys"]').val();

  window.location.href=url+"/index/date/"+$date+"/city/"+$city+"/category/"+$category;

}

//跳转到搜索页面
function search()
{
    var keyword=document.getElementById("SearchKey").value;
    if(keyword==''||keyword=='请输入产品名称或产品编号查询')
    {
      keyword=null;
    }
    window.open(url+"/../Search/index/keyword/"+keyword);
}

//禁用Enter键表单自动提交
// document.onkeydown = function(event) {
//     var target, code, tag;
//     if (!event) {
//         event = window.event; //针对ie浏览器
//         target = event.srcElement;
//         code = event.keyCode;
//         if (code == 13) {
//             tag = target.tagName;
//             if (tag == "TEXTAREA") { return true; }
//             else { return false; }
//         }
//     }
//     else {
//         target = event.target; //针对遵循w3c标准的浏览器，如Firefox
//         code = event.keyCode;
//         if (code == 13) {
//             tag = target.tagName;
//             if (tag == "INPUT") { return false; }
//             else { return true; } 
//         }
//     }
// };
