<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>网站信息管理系统_用户登录</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #016aa9;
	overflow:hidden;
}
.STYLE1 {
	color: #000000;
	font-size: 12px;
}
</style>
<script type="text/javascript" src="<?php echo ($Public); ?>/js/jquery.js"></script>
<script type="text/javascript">
$(function (){
	$("#submit_btn").click(function (){
		if($("input[name='username']").val()==''){
			alert('请输入用户名!');
			return false;
		}
		if($("input[name='password']").val()==''){
			alert('请输入密码!');
			return false;
		}
		$("#login_fm").submit();
	});
});
</script>
</head>

<body>
<form action="__URL__/LoginAct" method="post" id="login_fm">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="962" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="235" background="<?php echo ($Public); ?>/images/login_03.gif">&nbsp;</td>
      </tr>
      <tr>
        <td height="53"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="394" height="53" background="<?php echo ($Public); ?>/images/login_05.gif">&nbsp;</td>
            <td width="206" background="<?php echo ($Public); ?>/images/login_06.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="25"><div align="right"><span class="STYLE1">用户</span></div></td>
                <td width="57%" height="25"><div align="center">
                  <input type="text" name="username" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td width="27%" height="25">&nbsp;</td>
              </tr>
              <tr>
                <td height="25"><div align="right"><span class="STYLE1">密码</span></div></td>
                <td height="25"><div align="center">
                  <input type="password" name="password" style="width:105px; height:17px; background-color:#292929; border:solid 1px #7dbad7; font-size:12px; color:#6cd0ff">
                </div></td>
                <td height="25"><div align="left"><input type="image" name="send" value="" src="<?php echo ($Public); ?>/images/dl.gif"/></div></td>
              </tr>
            </table></td>
            <td width="362" background="<?php echo ($Public); ?>/images/login_07.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="213" background="<?php echo ($Public); ?>/images/login_08.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>