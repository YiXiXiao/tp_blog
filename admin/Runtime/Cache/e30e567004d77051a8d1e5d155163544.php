<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>网站信息管理系统</title>
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
.STYLE1 {
	font-size: 12px;
	color: #FFFFFF;
}
.STYLE2 {font-size: 9px}
.STYLE3 {
	color: #033d61;
	font-size: 12px;
}
.STYLE3 a {
	text-decoration:none;
	color:#033D61;
}
tr#nav_img .nav_a {
	cursor:pointer;
}
</style></head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr id="nav_img">
    <td height="70" background="<?php echo ($Public); ?>/images/main_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="270" height="24" background="<?php echo ($Public); ?>/images/main_03.gif">&nbsp;</td>
            <td width="505" background="<?php echo ($Public); ?>/images/main_04.gif">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="21"><img src="<?php echo ($Public); ?>/images/main_07.gif" width="21" height="24"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="38"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="270" height="38" background="<?php echo ($Public); ?>/images/main_09.gif">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="77%" height="25" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50" height="19"><div align="center"><a href="__ROOT__/index.php" target="_blank"><img class="nav_a" src="<?php echo ($Public); ?>/images/main_12.gif" width="49" height="19"></a></div></td>
                    <td width="50"><div align="center"><a href="javascript:history.go(-1);"><img class="nav_a" src="<?php echo ($Public); ?>/images/main_14.gif" width="48" height="19"></a></div></td>
                    <td width="50"><div align="center"><a href="javascript:history.go(1);"><img class="nav_a" src="<?php echo ($Public); ?>/images/main_16.gif" width="48" height="19"></a></div></td>
                    <td width="50"><div align="center"><a href="javascript:location.reload();"><img class="nav_a" src="<?php echo ($Public); ?>/images/main_18.gif" width="48" height="19"></a></div></td>
                    <td width="50"><div align="center"><a href="__APP__/Index/logout" target="_parent"><img class="nav_a" src="<?php echo ($Public); ?>/images/main_20.gif" width="48" height="19"></a></div></td>
                    <td width="26"><div align="center"><img src="<?php echo ($Public); ?>/images/main_21.gif" width="26" height="19"></div></td>
                    <td width="100"><div align="center">&nbsp;</div></td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
                <td width="220" valign="bottom"  nowrap="nowrap"><div align="right"><span class="STYLE1"><span class="STYLE2">■</span> 今天是：<?php echo ($current_time); ?></span></div></td>
              </tr>
            </table></td>
            <td width="21"><img src="<?php echo ($Public); ?>/images/main_11.gif" width="21" height="38"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="8" style=" line-height:8px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="270" background="<?php echo ($Public); ?>/images/main_29.gif" style=" line-height:8px;">&nbsp;</td>
            <td width="505" background="<?php echo ($Public); ?>/images/main_30.gif" style=" line-height:8px;">&nbsp;</td>
            <td style=" line-height:8px;">&nbsp;</td>
            <td width="21" style=" line-height:8px;"><img src="<?php echo ($Public); ?>/images/main_31.gif" width="21" height="8"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="28" background="<?php echo ($Public); ?>/images/main_36.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="177" height="28" background="<?php echo ($Public); ?>/images/main_32.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%"  height="22">&nbsp;</td>
            <td width="59%" valign="bottom"><div align="left" class="STYLE1"><?php echo ($username); ?></div></td>
            <td width="21%">&nbsp;</td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="65" height="28"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="23" valign="bottom"><table width="58" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr> 
                    <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"> <div align="center" class="STYLE3"><a href="__APP__/System/index" target="main_right">配置管理</a></div></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            
            <?php if($super_admin == '1'): ?><td width="3"><img src="<?php echo ($Public); ?>/images/main_34.gif" width="3" height="28"></td>
            <td width="63"><table width="58" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"><div align="center" class="STYLE3"><a href="__APP__/Nav/index" target="main_right">分类管理</a></div></td>
              </tr>
            </table></td><?php endif; ?>
            
            <td width="3"><img src="<?php echo ($Public); ?>/images/main_34.gif" width="3" height="28"></td>
            <td width="63"><table width="58" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"><div align="center" class="STYLE3"><a href="__APP__/Article/index" target="main_right">文档管理</a></div></td>
              </tr>
            </table></td>
            
            <?php if($super_admin == '1'): ?><td width="3"><img src="<?php echo ($Public); ?>/images/main_34.gif" width="3" height="28"></td>
            <td width="63"><table width="70" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"><div align="center" class="STYLE3"><a href="__APP__/Manager/index" target="main_right">管理员管理</a></div></td>
              </tr>
            </table></td><?php endif; ?>
            
            <td width="3"><img src="<?php echo ($Public); ?>/images/main_34.gif" width="3" height="28"></td>
            <td width="63"><table width="58" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"><div align="center" class="STYLE3"><a href="__APP__/Caster/index" target="main_right">幻灯管理</a></div></td>
              </tr>
            </table></td>
            
            <td width="3"><img src="<?php echo ($Public); ?>/images/main_34.gif" width="3" height="28"></td>
            <td width="83"><table width="83" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"><div align="center" class="STYLE3"><a href="__APP__/Advertise/index" target="main_right">新闻图片管理</a></div></td>
              </tr>
            </table></td>
            
            <td width="3"><img src="<?php echo ($Public); ?>/images/main_34.gif" width="3" height="28"></td>
            <td width="63"><table width="58" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"><div align="center" class="STYLE3"><a href="__APP__/Link/index" target="main_right">友情链接</a></div></td>
              </tr>
            </table></td>
            
            <td width="3"><img src="<?php echo ($Public); ?>/images/main_34.gif" width="3" height="28"></td>
            <td width="63"><table width="58" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage='url(<?php echo ($Public); ?>/images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#a6d0e7'; "onmouseout="this.style.backgroundImage='url()';this.style.borderStyle='none'"><div align="center" class="STYLE3"><a href="__APP__/Message/index" target="main_right">留言管理</a></div></td>
              </tr>
            </table></td>
            
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="21"><img src="<?php echo ($Public); ?>/images/main_37.gif" width="21" height="28"></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>