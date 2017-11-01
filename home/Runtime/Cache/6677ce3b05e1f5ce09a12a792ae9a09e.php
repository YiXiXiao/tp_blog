<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="zh-CN">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="zh-CN">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="zh-CN">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($web_name); ?>-<?php echo ($description); ?></title>
<meta name="keywords" content="<?php echo ($keywords); ?>"/>
<meta name="description" content="<?php echo ($seo_description); ?>" />
<meta name="baidu-site-verification" content="I71tHi4Tk2" />
<!--[if lt IE 9]>
<script src="<?php echo ($Public); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link rel='stylesheet' id='twentytwelve-style-css'  href='<?php echo ($Public); ?>/css/index.css' type='text/css' media='all' />
<!--[if lt IE 9]>
<link rel='stylesheet' id='twentytwelve-ie-css'  href='<?php echo ($Public); ?>/css/ie.css' type='text/css' media='all' />
<![endif]-->
<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<style type="text/css" id="custom-background-css">
body.custom-background { background-color: #e6e6e6; }
</style>
</head>

<body class="home blog custom-background custom-font-enabled single-author">
<div id="page" class="hfeed site">
	
	<header id="masthead" class="site-header" role="banner">
	<hgroup>
		<h1 class="site-title"><a href="__APP__/" title="<?php echo ($web_name); ?>" rel="home"><?php echo ($web_name); ?></a></h1>
		<h2 class="site-description"><?php echo ($description); ?></h2>
	</hgroup>
	
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<ul class="nav-menu">
			<li><a href="__APP__/">首页</a></li>
			<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="__APP__/Home/category/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a>
				<ul class="sub-menu">
					<?php if(is_array($vo["sons"])): $i = 0; $__LIST__ = $vo["sons"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><li><a href="__APP__/Home/category/id/<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</nav>
</header>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"5","bdPos":"right","bdTop":"162.5"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"32"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
	
	<div id="main" class="wrapper">
	<div id="primary" class="site-content">
		<div id="content" role="main">		
			<?php if(is_array($articleList)): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><article>
				<header class="entry-header">
					<h1 class="entry-title"><a href="__APP__/Home/blog/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>" rel="bookmark"><?php echo ($vo["title"]); ?></a></h1>
				</header>
				
				<div class="entry-content"><?php echo ($vo["description"]); ?></div>
				
				<footer class="entry-meta">
					发布于 <a href="__APP__/Home/tag/t/<?php echo ($vo["pubtime2"]); ?>" title="<?php echo ($vo["pubtime2"]); ?>" rel="bookmark"><time class="entry-date" datetime="<?php echo ($vo["pubdate"]); ?>"><?php echo ($vo["pubtime"]); ?></time></a>。 属于 <a href="__APP__/Home/category/id/<?php echo ($vo["reid"]); ?>" title="查看 <?php echo ($vo["name"]); ?>中的全部文章" rel="category"><?php echo ($vo["name"]); ?></a> 分类，
					被贴了<?php if(is_array($vo["tags"])): $i = 0; $__LIST__ = $vo["tags"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): ++$i;$mod = ($i % 2 )?><?php if($key == '0'): ?>&nbsp;<a href="__APP__/Home/tag/tag/<?php echo ($vo2); ?>" rel="tag"><?php echo ($vo2); ?></a>
					<?php else: ?>
						- <a href="__APP__/Home/tag/tag/<?php echo ($vo2); ?>" rel="tag"><?php echo ($vo2); ?></a><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?> 标签
				</footer>
			</article><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>

	<div id="secondary" class="widget-area" role="complementary">
	<aside id="search-2" class="widget widget_search">
		<form role="search" method="get" id="searchform" action="__APP__/Home/search">
		<div>
			<label class="screen-reader-text" for="s">搜索：</label>
			<input onfocus="if(this.value=='搜索神马的最有爱了'){this.value='';}" onblur="if(this.value==''){this.value='搜索神马的最有爱了';}" type="text" value="搜索神马的最有爱了" name="keywords" id="s" style="color:#aaa;"/>
			<input type="submit" id="searchsubmit" value="搜索" />
		</div>
		</form>
	</aside>		
	<aside id="recent-posts-2" class="widget widget_recent_entries">		
		<h3 class="widget-title">近期文章</h3>		
		<ul>
			<?php if(is_array($rightList)): $i = 0; $__LIST__ = $rightList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><font style="color:#7a7a7a;">[<?php echo ($i); ?>]</font>&nbsp;<a href="__APP__/Home/blog/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["title"]); ?>"><?php echo (msubstr($vo["title"],0,22)); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</aside>
	<aside id="recent-comments-2" class="widget widget_recent_comments">
		<h3 class="widget-title">近期评论</h3>
		<ul id="recentcomments">
			<?php if(is_array($recentCommonet)): $i = 0; $__LIST__ = $recentCommonet;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="recentcomments"><?php echo ($vo["uname"]); ?> 发表在《<a href="__APP__/Home/blog/id/<?php echo ($vo["aid"]); ?>" title="<?php echo ($vo["atitle"]); ?>"><?php echo (msubstr($vo["atitle"],0,13)); ?></a>》</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</aside>
	<aside id="archives-2" class="widget widget_archive">
		<h3 class="widget-title">文章归档</h3>
			<ul>		
				<?php if(is_array($monthList)): $i = 0; $__LIST__ = $monthList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href='__APP__/Home/tag/t/<?php echo ($vo["pdate"]); ?>' title='<?php echo ($vo["pubdate"]); ?>'><?php echo ($vo["pubdate"]); ?></a>&nbsp;<font style="color:#7a7a7a;">(<?php echo ($vo["num"]); ?>)</font></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
	</aside>
	<aside id="categories-2" class="widget widget_categories">
		<h3 class="widget-title">分类目录</h3>
		<ul>
			<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li class="cat-item cat-item-2"><a href="__APP__/Home/category/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</aside>
	<aside id="categories-2" class="widget widget_categories">
		<h3 class="widget-title">热门标签(<font style="font-weight:normal;">字体越大表示标签越热门额</font>^-^)</h3>
		<ul>
			<li class="cat-item cat-item-2">
				<?php if(is_array($hotTag)): $i = 0; $__LIST__ = $hotTag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a href="__APP__/Home/tag/tag/<?php echo ($vo["tagname"]); ?>" title="<?php echo ($vo["tagname"]); ?>" style="font-size:<?php echo ($vo["size"]); ?>px;text-decoration:none;"><?php echo ($vo["tagname"]); ?></a> &nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
			</li>
		</ul>
	</aside>		
</div>

	</div>
		
	<footer id="colophon" role="contentinfo">
	<div class="site-info">
		<span>友情链接：</span>
		<?php if(is_array($linkList)): $i = 0; $__LIST__ = $linkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
</footer>
<footer role="contentinfo" style="margin-top:0;">
	<div class="site-info" style="text-align:center;">
		<span><?php echo ($beian); ?><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000244962'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000244962%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
	</div>
</footer>
	
</div><!-- #page -->
<script type='text/javascript' src='<?php echo ($Public); ?>/js/nav.js'></script>
</body>
</html>