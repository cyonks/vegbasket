<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<title>网站后台管理</title>
<link href="__PUBLIC__/admin/adminImages/skin.css" rel="stylesheet" type="text/css">
<script>
function logout(){
	if (confirm('您确定要退出吗')){
		return true;
	}else{
		return false;
	}
}
</script>
</head>
<body leftmargin="0" topmargin="0">
<table width="100%" height="64" border="0" cellpadding="0" cellspacing="0" class="admin_topbg">
  <tr>
    <td width="23%" height="64"><img src="__PUBLIC__/admin/adminImages/logo.gif" width="262" height="64"></td>
    <td width="77%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="74%" height="38" class="admin_txt">你好:<?php echo (session('name')); ?></td>
        <td width="22%"><a href="<?php echo U('Login/outlogin');?>" target="_parent" onClick="return logout();"><img src="__PUBLIC__/admin/adminImages/out.gif" alt="退出系统" width="46" height="20" border="0"></a></td>
        <td width="4%">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="3">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>