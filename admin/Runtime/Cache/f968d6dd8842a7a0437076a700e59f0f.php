<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {
	font-size: 12px;
	color: #FFFFFF;
}
.STYLE3 {
	font-size: 12px;
	color: #033d61;
}
a {
	text-decoration:none;
}
.a_hover {
	cursor:pointer;
	
}
.a_hover a {
	display:block;
	padding:2px 0;
}
</style>
<style type="text/css">
.menu_title SPAN {
	FONT-WEIGHT: bold; LEFT: 3px; COLOR: #ffffff; POSITION: relative; TOP: 2px
}
.menu_title2 SPAN {
	FONT-WEIGHT: bold; LEFT: 3px; COLOR: #FFCC00; POSITION: relative; TOP: 2px
}

</style>

<table width="165" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="28" background="<?php echo ($Public); ?>/images/main_40.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="19%">&nbsp;</td>
        <td width="81%" height="20"><span class="STYLE1">管理菜单</span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="151" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23" background="<?php echo ($Public); ?>/images/main_47.gif" id="imgmenu1" class="menu_title" onMouseOver="this.className='menu_title2';" onClick="showsubmenu(1)" onMouseOut="this.className='menu_title';" style="cursor:hand"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="18%">&nbsp;</td>
                <td width="82%" class="STYLE1">网站配置管理</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td background="<?php echo ($Public); ?>/images/main_51.gif" id="submenu1">
			 <div class="sec_menu" >  
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="16%" height="25"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                    <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/System/index" target="main_right"><span class="STYLE3">基本配置</span></a></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                    <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Manager/personInfo" target="main_right"><span class="STYLE3">用户资料</span></a></td>
                        </tr>
                    </table></td>
                  </tr>
				  <tr>
                    <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                    <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Manager/pass" target="main_right"><span class="STYLE3">修改密码</span></a></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                    <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Manager/modifyName" target="main_right"><span class="STYLE3">修改用户名</span></a></td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="5"><img src="<?php echo ($Public); ?>/images/main_52.gif" width="151" height="5" /></td>
              </tr>
            </table></div></td>
          </tr>
          
        </table></td>
      </tr>
      
      <?php if($super_admin == '1'): ?><tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23" background="<?php echo ($Public); ?>/images/main_47.gif" id="imgmenu2" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(2)" onmouseout="this.className='menu_title';" style="cursor:hand"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="18%">&nbsp;</td>
                  <td width="82%" class="STYLE1">网站分类管理</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td background="<?php echo ($Public); ?>/images/main_51.gif" id="submenu2"><div class="sec_menu" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="16%" height="25"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Nav/index" target="main_right"><span class="STYLE3">分类列表</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td width="16%" height="25"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Nav/addShow" target="main_right"><span class="STYLE3">添加分类</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="5"><img src="<?php echo ($Public); ?>/images/main_52.gif" width="151" height="5" /></td>
                  </tr>
                </table>
            </div></td>
          </tr>
        </table>          </td>
      </tr><?php endif; ?>
      
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23" background="<?php echo ($Public); ?>/images/main_47.gif" id="imgmenu3" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(3)" onmouseout="this.className='menu_title';" style="cursor:hand"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="18%">&nbsp;</td>
                  <td width="82%" class="STYLE1">文档信息管理</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td background="<?php echo ($Public); ?>/images/main_51.gif" id="submenu3"><div class="sec_menu" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="16%" height="25"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Article/index" target="main_right"><span class="STYLE3">文档列表</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Article/addShow" target="main_right"><span class="STYLE3">添加文章</span></a></td>
                              </tr>
                          </table></td>
                        </tr>

                    </table></td>
                  </tr>
                  <tr>
                    <td height="5"><img src="<?php echo ($Public); ?>/images/main_52.gif" width="151" height="5" /></td>
                  </tr>
                </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23" background="<?php echo ($Public); ?>/images/main_47.gif" id="imgmenu4" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(4)" onmouseout="this.className='menu_title';" style="cursor:hand"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="18%">&nbsp;</td>
                  <td width="82%" class="STYLE1">其它信息管理</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td background="<?php echo ($Public); ?>/images/main_51.gif" id="submenu4"><div class="sec_menu" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        
                        <tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Message/index" target="main_right"><span class="STYLE3">留言列表</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        
                        <?php if($super_admin == '1'): ?><tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Manager/index" target="main_right"><span class="STYLE3">管理员列表</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        
                        <tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Manager/addShow" target="main_right"><span class="STYLE3">添加管理员</span></a></td>
                              </tr>
                          </table></td>
                        </tr><?php endif; ?>
                        
                        
                        <tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Caster/index" target="main_right"><span class="STYLE3">幻灯片列表</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        
                        <tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Caster/addShow" target="main_right"><span class="STYLE3">添加幻灯片</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        
                        <tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Advertise/index" target="main_right"><span class="STYLE3">新闻图片管理</span></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        
                        <tr>
                          <td height="23"><div align="center"><img src="<?php echo ($Public); ?>/images/left.gif" width="10" height="10" /></div></td>
                          <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="a_hover" height="20" style="cursor:hand" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="__APP__/Advertise/addShow" target="main_right"><span class="STYLE3">添加新闻图片</span></a></td>
                              </tr>
                          </table></td>
                        </tr>                   

                    </table></td>
                  </tr>
                  <tr>
                    <td height="5"><img src="<?php echo ($Public); ?>/images/main_52.gif" width="151" height="5" /></td>
                  </tr>
                </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td height="18" background="<?php echo ($Public); ?>/images/main_58.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="18" valign="bottom"><div align="center" class="STYLE3">版本：2008V1.0</div></td>
      </tr>
    </table></td>
  </tr>
</table>
<script>




function showsubmenu(sid)
{
whichEl = eval("submenu" + sid);
imgmenu = eval("imgmenu" + sid);
if (whichEl.style.display == "none")
{
eval("submenu" + sid + ".style.display=\"\";");
imgmenu.background="<?php echo ($Public); ?>/images/main_47.gif";
}
else
{
eval("submenu" + sid + ".style.display=\"none\";");
imgmenu.background="<?php echo ($Public); ?>/images/main_48.gif";
}
}

</script>