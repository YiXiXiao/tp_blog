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
	width:400px;
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
		$("select[name='indextpl_select']").change(function (){
			$("input[name='indextpl']").val($(this).val());
		});
		$("select[name='listtpl_select']").change(function (){
			$("input[name='listtpl']").val($(this).val());
		});
		$("select[name='articletpl_select']").change(function (){
			$("input[name='articletpl']").val($(this).val());
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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[分类管理]-[<a href="__URL__/addShow">添加分类</a>]</td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="60">&nbsp;</td>
                <td width="80"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="<?php echo ($Public); ?>/images/22.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="__URL__/index">分类列表</a></div></td>
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
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">分类名称：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><input type="text" name="name" class="text"/><font style="color:red;">(*分类名称必填)</font></div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">关&nbsp;键&nbsp;词：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><input style="width:200px;" type="text" name="keywords" class="text"/></div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">父级栏目：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
           		 <select style="border:1px solid #ccc;width:100px;" name="reid">
					<option value="0">顶级栏目</option>
					<?php if(is_array($navList)): $i = 0; $__LIST__ = $navList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo["id"]); ?>"><?php echo str_repeat('&nbsp;',2*$vo['level']);?><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><font style="color:red;">(*需要选择父级栏目)</font>
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">栏目模型：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
            	<select style="border:1px solid #ccc;width:100px;" name="model">
					<option value="1" selected="selected">文章模型</option>
					<option value="2">商品模型</option>
				</select>
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">菜单导航：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
            	<input type="radio" name="menu" value="0" checked="checked"/> 否
            	<input type="radio" name="menu" value="1"/> 是
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">栏目类型：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
            	<input type="radio" name="attr" value="0"/> 频道封面
            	<input type="radio" name="attr" value="1" checked="checked"/> 栏目列表
            	<input type="radio" name="attr" value="2"/> 外部链接
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">链接地址：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
				<input type="text" name="linkurl" value="" style="width:150px;"/>
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">封面模板：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
				<input type="text" name="indextpl" value="index_article.html" style="width:150px;"/>
				<select name="indextpl_select" style="width:150px;">
					<option value="">请选择封面模板</option>
					<?php if(is_array($files_tpl)): $i = 0; $__LIST__ = $files_tpl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">列表模板：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
				<input type="text" name="listtpl" value="list_article.html" style="width:150px;"/>
				<select name="listtpl_select" style="width:150px;">
					<option value="">请选择列表模板</option>
					<?php if(is_array($files_tpl)): $i = 0; $__LIST__ = $files_tpl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div></td>
          </tr>
          
         <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">内容模板：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left">
				<input type="text" name="articletpl" value="article_article.html" style="width:150px;"/>
				<select name="articletpl_select" style="width:150px;">
					<option value="">请选择内容模板</option>
					<?php if(is_array($files_tpl)): $i = 0; $__LIST__ = $files_tpl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">栏目排序：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><input style="width:45px;" type="text" name="sort" class="text" value="<?php echo ($sort); ?>"/></div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">栏目描述：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><textarea name="intro" style="width:600px;height:80px;"></textarea></div></td>
          </tr>
          
          <tr id="single">
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">栏目内容：</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><textarea name="body" id="body"></textarea></div></td>
          </tr>
          
          <tr>
           	<td width="8%" bgcolor="#FFFFFF"><div align="right"><span class="STYLE1">&nbsp;</span></div></td>
            <td bgcolor="#FFFFFF"><div align="left"><input type="submit" name="send" value="新增栏目" class="submit" onclick=""/> [ <a href="__URL__/index">返回列表</a> ]</div></td>
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

<script type="text/javascript" src="__ROOT__/ueditor/editor_config.js"></script>
<script type="text/javascript" src="__ROOT__/ueditor/editor_all_min.js"></script>
<script type="text/javascript">
var edit = new UE.ui.Editor({initialContent:'',initialFrameWidth:900});
edit.render("body");
</script>

</body>
</html>