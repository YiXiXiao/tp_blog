<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>幻灯管理</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {font-size: 12px}
.STYLE3 {font-size: 12px; font-weight:bold;}
.STYLE4 {
	color: #03515d;
	font-size: 12px;
}
a {
	text-decoration:none;
	color:#033D61;
}
div.page {
	height:25px;
	line-height:25px;
	font-size:12px;
}
div.page a {
	border:1px solid #1877ad;
	font-size:12px;
	padding:3px 3px 1px 3px;
	margin:0;
}
td {
	font-size:12px;
}
table.pub_table {
	border-collapse:collapse;
}
table.pub_table tr td {
	height:20px;
	line-height:20px;
	padding:2px 5px;
	border:none;
	border-bottom:1px dashed #ccc;
}
input.text {
	width:400px;
	font-size:12px;
}
input.submit {
	cursor:pointer;
}
td select {
	height:20px;
	line-height:20px;
	width:120px;
	font-size:12px;
}
textarea {
	font-size:12px;
	padding:2px 0 0 5px;
}
</style>
<script type="text/javascript" src="__ROOT__/Public/js/jquery.js"></script>
<script type="text/javascript">
	$(function (){
		$("select[name='kind']").change(function (){
			if($(this).val()=='1'){
				$("#kind").show();
			}else{
				$("#kind").hide();
			}
		});
	});
</script>
</head>

<body>
<form method="post" action="__URL__/add" enctype="multipart/form-data">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" background="<?php echo ($Public); ?>/images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="<?php echo ($Public); ?>/images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="<?php echo ($Public); ?>/images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[幻灯管理]-[<a href="__URL__/addShow">新增幻灯</a>]</td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="60">&nbsp;</td>
                <td width="100"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="<?php echo ($Public); ?>/images/22.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="__URL__/index">幻灯列表</a></div></td>
                  </tr>
                </table></td>
                <td width="60">&nbsp;</td>
                <td width="52">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="16"><img src="<?php echo ($Public); ?>/images/tab_07.gif" width="16" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="<?php echo ($Public); ?>/images/tab_12.gif">&nbsp;</td>
        <td><table class="pub_table" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
         	 <td style="border:none;" colspan="2" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF" class="STYLE1"><div style="padding:0 0 0 150px;" align="left">&nbsp;</div></td>
          </tr>

          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">幻灯标题：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><input type="text" name="title" value="" class="text"/><font style="color:red;"></font></div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">幻灯图片：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><input type="file" name="image" value="" class="text"/></div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">是否显示：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
            	<select name="state">
					<option value="1">显示</option>
					<option value="0">不显示</option>
				</select>
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">&nbsp;</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><input type="submit" name="send" value="新增幻灯" class="submit"/> [ <a href="__URL__/index">返回列表</a> ]</div></td>
          </tr>

        </table></td>
        <td width="8" background="<?php echo ($Public); ?>/images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="<?php echo ($Public); ?>/images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35"><img src="<?php echo ($Public); ?>/images/tab_18.gif" width="12" height="35" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;</td>
            <td><table border="0" align="right" cellpadding="0" cellspacing="0">
                <tr style="height:20px;line-height:20px;">
                  <td colspan="4">
                  	<div class="page">&nbsp;</div>
                  </td>
                  <td width="100"><div align="center"><span class="STYLE1">&nbsp;</span></div></td>
                  <td width="40">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="16">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>

</body>
</html>