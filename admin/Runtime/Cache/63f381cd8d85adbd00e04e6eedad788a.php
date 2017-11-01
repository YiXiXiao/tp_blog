<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>管理员管理</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {font-size: 12px}
.STYLE3 {font-size: 12px; font-weight: bold;}
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
</style>

</head>

<body>
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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[管理员管理]-[<a href="__URL__/index">管理员列表</a>]</td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
              	<td width="80">&nbsp;</td>
                <td width="90"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="<?php echo ($Public); ?>/images/22.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="__URL__/addShow">添加管理员</a></div></td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="3%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center">
              <input type="checkbox" name="checkbox" value="checkbox" />
            </div></td>
            <td width="3%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">ID</span></div></td>
            <td width="14%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">管理员名称</span></div></td>
            <td width="14%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">管理员等级</span></div></td>
            <td width="14%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">最后登录时间</span></div></td>
            <td width="15%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">操作</div></td>
          </tr>
          
          <?php if(is_array($adminList)): $i = 0; $__LIST__ = $adminList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center">
              <input type="checkbox" name="checkbox2" value="checkbox" />
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><?php echo ($vo["id"]); ?></span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><?php echo ($vo["username"]); ?></span></div></td>
            <td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><?php echo ($vo["level"]); ?></span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><?php echo ($vo["lastdate"]); ?></span></div></td>

            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE4"><a href="__URL__/show/id/<?php echo ($vo["id"]); ?>"><img src="<?php echo ($Public); ?>/images/edt.gif" width="16" height="16" />编辑</a>&nbsp; &nbsp;<a href="__URL__/delete/id/<?php echo ($vo["id"]); ?>"><img src="<?php echo ($Public); ?>/images/del.gif" width="16" height="16" />删除</a></span></div></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>

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
                  	<div class="page"><?php echo ($page); ?></div>
                  </td>
                  <td width="100"><div align="center"><span class="STYLE1">转到第
                    <input name="textfield" type="text" size="4" style="height:12px; width:20px; border:1px solid #999999;" /> 
                    页 </span></div></td>
                  <td width="40"><img src="<?php echo ($Public); ?>/images/go.gif" width="37" height="15" /></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="16"><img src="<?php echo ($Public); ?>/images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>