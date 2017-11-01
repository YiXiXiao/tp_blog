<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>分类管理</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
img {
	border:none;
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
<form method="post" action="__URL__/sortAct">

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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[分类管理]-[<a href="__URL__/index">分类列表</a>]</td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="60">&nbsp;</td>
                <td width="80"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="<?php echo ($Public); ?>/images/22.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="left">&nbsp;<a href="__URL__/addShow">新增分类</a></div></td>
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
    <td>
   
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="<?php echo ($Public); ?>/images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
          
            <td width="3%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">ID</span></div></td>
            <td width="14%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">分类名称</span></div></td>
            <td width="14%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">添加时间</span></div></td>
            <td width="20%" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">分类描述</span></div></td>

            <td width="15%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">操作</div></td>
            <td width="10%" height="22" background="<?php echo ($Public); ?>/images/bg2.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">排序</div></td>
            
          </tr>
          
          <?php if(is_array($navList)): $i = 0; $__LIST__ = $navList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><input type="hidden" name="id[]" value="<?php echo ($vo["id"]); ?>"/>
          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center"><?php echo ($vo["id"]); ?></div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" style="text-align:left;"><span style="text-align:left;padding-left:70px;" class="STYLE1"><?php echo str_repeat('&nbsp;',4*$vo['level']);?><?php echo (msubstr($vo["name"],0,20)); ?></span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><?php echo (msubstr($vo["date"],0,10)); ?></span></div></td>
            <td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><?php echo (msubstr($vo["intro"],0,10)); ?></span></div></td>

            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE4"><a href="__URL__/show/id/<?php echo ($vo["id"]); ?>"><img src="<?php echo ($Public); ?>/images/edt.gif" width="16" height="16" />编辑</a>&nbsp; &nbsp;<a href="__URL__/delete/id/<?php echo ($vo["id"]); ?>"><img src="<?php echo ($Public); ?>/images/del.gif" width="16" height="16" />删除</a></span></div></td>
           	<td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><input style="width:40px;margin:2px 0;text-align:center;" type="text" name="sort[]" class="navsort" value="<?php echo ($vo["sort"]); ?>"/></span></div></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        </table></td>
        <td width="8" background="<?php echo ($Public); ?>/images/tab_15.gif">&nbsp;</td>
      </tr>
    </table>

    </td>
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
                  <td width="100"><div align="center"><span class="STYLE1"><input type="submit" value="排序" name="send" style="cursor:pointer;width:40px;height:25px;line-height:25px;position:relative;top:-3px;width:50px;left:18px;"/></span></div></td>
                  <td width="40">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="16"><img src="<?php echo ($Public); ?>/images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>