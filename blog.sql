-- phpMyAdmin SQL Dump
-- version 2.7.0-pl1
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2014 年 01 月 23 日 03:12
-- 服务器版本: 5.0.96
-- PHP 版本: 5.2.17
-- 
-- 数据库: `a0113125915`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_admin`
-- 

CREATE TABLE `wq_admin` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `username` varchar(20) NOT NULL COMMENT '//用户名',
  `password` varchar(32) NOT NULL COMMENT '//密码',
  `level` tinyint(2) NOT NULL COMMENT '//管理等级',
  `permission` varchar(500) NOT NULL,
  `lastdate` datetime NOT NULL,
  `lastip` varchar(16) NOT NULL,
  `date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- 
-- 导出表中的数据 `wq_admin`
-- 

INSERT INTO `wq_admin` VALUES (11, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, '1,2,3,4,5,6,7,8,9,10,998,997,996,995,994,999', '2014-01-22 13:21:07', '127.0.0.1', '2013-09-07 15:20:27');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_advertise`
-- 

CREATE TABLE `wq_advertise` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `name` varchar(50) NOT NULL COMMENT '//名称',
  `linkurl` varchar(250) NOT NULL COMMENT '//链接地址',
  `url` varchar(250) NOT NULL COMMENT '//图片地址',
  `state` tinyint(1) unsigned NOT NULL default '1' COMMENT '//状态',
  `date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `wq_advertise`
-- 

INSERT INTO `wq_advertise` VALUES (3, '首页侧栏广告1', 'http://baidu.com', 'new1.jpg', 1, '2013-12-18 17:31:09');
INSERT INTO `wq_advertise` VALUES (4, '首页侧栏广告2', 'http://baidu.com', 'new2.jpg', 1, '2013-12-18 17:31:27');
INSERT INTO `wq_advertise` VALUES (5, '首页侧栏广告3', 'http://baidu.com', 'new3.jpg', 1, '2013-12-18 17:31:44');
INSERT INTO `wq_advertise` VALUES (6, '首页侧栏广告4', 'http://baidu.com', '20131218145739922.jpg', 1, '2013-12-18 17:31:56');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_article`
-- 

CREATE TABLE `wq_article` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `title` varchar(50) NOT NULL COMMENT '//文章标题',
  `seo_title` varchar(50) NOT NULL,
  `seo_desc` varchar(255) NOT NULL,
  `thumb` varchar(100) NOT NULL COMMENT '//缩略图',
  `description` varchar(1000) NOT NULL COMMENT '//描述',
  `body` text NOT NULL COMMENT '//主要内容',
  `reid` mediumint(8) unsigned NOT NULL COMMENT '//所属栏目',
  `flag` varchar(20) NOT NULL COMMENT '//自定义属性',
  `click` mediumint(8) unsigned NOT NULL COMMENT '//点击量',
  `writer` varchar(20) NOT NULL COMMENT '//作者',
  `source` varchar(20) NOT NULL COMMENT '//来源',
  `goodpost` mediumint(8) unsigned NOT NULL COMMENT '//好评',
  `badpost` mediumint(8) unsigned NOT NULL COMMENT '//差评',
  `keywords` varchar(20) NOT NULL COMMENT '//关键词',
  `pubdate` datetime NOT NULL COMMENT '//发布时间',
  `lastmod` datetime NOT NULL COMMENT '//最后修改时间',
  `userip` varchar(15) NOT NULL COMMENT '//发布人ip',
  `rbac` tinyint(3) unsigned NOT NULL default '0' COMMENT '//浏览权限',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- 导出表中的数据 `wq_article`
-- 

INSERT INTO `wq_article` VALUES (1, 'Thinkphp框架在大png图片生成缩略图时的小bug', '', '', '', '<p>今天,一朋友跟我说他在上传大png图片时,生成缩略图有问题,如果是小png图片或是其它格式的图片却是正常的,<br /></p><p>顿觉很奇怪,于是下班后在家里试了下,确实程序会报错：</p>', '<p>今天,一朋友跟我说他在上传大png图片时,生成缩略图有问题,如果是小png图片或是其它格式的图片却是正常的,<br /></p><div>顿觉很奇怪,于是下班后在家里试了下,确实程序会报错：<br /><br /><img style="width:900px;height:49px;float:none;" src="/ueditor/php/upload/20140112/13895335525892.jpg" title="psb.jpg" border="0" height="49" hspace="0" vspace="0" width="900" /></div><div><br /></div><div>提示代码199行 有错 </div><div><br /></div><div>如是就根据提示 定位到了 199行 &nbsp;$srcImg = $createFun($image);</div><div><br /></div><div>$createFun是&#39;imagecreatefrompng&#39;,</div><div><br /></div><div>上述代码 也就是 &nbsp; $srcImg =imagecreatefrompng($image);时 出现了错误 </div><div><br /></div><div>报错 的大致意思是(查了下google翻译)说是：在分配19k的内存时 ,8M的内存 已经用完了 ,好奇怪</div><div><br /></div><div>难道是imagecreatefrompng()函数的问题 ,</div><div><br /></div><div><p>如是立马写了下 测试程序 demo.php</p><pre class="brush:php;toolbar:false;">header(''Content-Type:image/png'');\r\n$url="images/cover.png";\r\n$img=imagecreatefrompng($url);\r\nimagepng($img);\r\nimagedestroy($img);</pre><p>意思是从images目录下 加载 cover.png图片 然后 在浏览器中输出,</p><p>结果出现错误,说是图像本身有错,无法显示 <br /></p></div><div><br /><img src="/ueditor/php/upload/20140112/13895336111903.jpg" title="psbjing.jpg" /></div><div><br /></div><div>然后 我有试了张png小图 ,</div><div>结果显示正常 ,<br /><br /> <img src="/ueditor/php/upload/20140112/13895336285701.jpg" title="psingkb.jpg" /></div><div><br /></div><div>那原因 就很明显了,就是png加载大的png图片时会出现错误,并不是thinkphp框架的问题(本测试用的是thinkphp2.1版本)</div><div><br /></div><div>如是就在百度上 搜imagecreatefrompng加载 大图出错</div><div><br /></div><div>imagecreatefrompng() 在失败时返回一个空字符串，并且输出一条错误信息，不幸地在浏览器中显示为断链接。</div><div><br /></div><div>说是 加载失败会返回空 但是为何失败 </div><div>却没有说 </div><div><br /></div><div>继续往下看 好像解释了为何加载出错的原因 ,但是一大推英文 又看不懂 </div><div><br /></div><div>大致意思好像是说 ：</div><div><br /></div><div>imagecreatefrompng在加载大png图片是 会变态 的消耗内存,</div><div><br /></div><div>结果也不知道是哪位朋友还提供了问题的 解决方案 </div><div><br /></div><div>The approach I used to solve the problem is:</div><div><br /></div><div>1-The following value works for me:</div><div>$required_memory = Round($width * $height * $size[&#39;bits&#39;]);</div><div><br /></div><div>2-Use somthing like:</div><div>$new_limit=memory_get_usage() + $required_memory;</div><div>ini_set(&quot;memory_limit&quot;, $new_limit);</div><div><br /></div><div>4-ini_restore (&quot;memory_limit&quot;);</div><div><br /></div><div>php.ini 默认的内存 是8M </div><div><br /></div><div>加载png图片时 需要的 内存 是 &nbsp;Round($width * $height * $size[&#39;bits&#39;]);</div><div><br /></div><div>我计算了下加载cover.png 时需要的内存 ：4900*3600*8=141120000,</div><div><br /></div><div>141M尼玛这么大 难怪 会 加载不了呢</div><div><br /></div><div>照着这个方法 试了下 果然 解决了问题,</div><div><br /></div><div>在thinkphp框架的 Image.class.php代码$srcImg = $createFun($image);的前面 加上 <br /><br /><pre class="brush:php;toolbar:false;">//考虑png大图内存不足的问题\r\n  \r\n$imgArr=getimagesize($image); \r\n$required_memory = $imgArr[0] * $imgArr[1] * $imgArr[''bits''];\r\n$new_limit=memory_get_usage() + $required_memory+200000000;\r\nini_set("memory_limit", $new_limit);</pre></div><div>让程序根据加载图片的大小,自动设置需要的内存,结束之后 </div><div>在thumb函数的结尾 在设置为默认的8M</div><div><pre class="brush:php;toolbar:false;">ini_restore ("memory_limit")</pre>至此,问题解决,也算是Thinkphp框架的一个小bug</div><p><br /></p>', 7, '', 135, 'zfs', '张仿松php博客', 100, 100, 'ThinkPHP,框架', '2014-01-12 22:30:01', '2014-01-13 22:04:16', '127.0.0.1', 0);
INSERT INTO `wq_article` VALUES (2, 'PHP单例模式浅析', '', '', '', '<div><span style="font-size:16px">首先我们要明确单例模式这个概念，那么什么是单例模式呢?</span></div><div><span style="font-size:16px">单例模式顾名思义，就是只有一个实例。</span></div><div><span style="font-size:16px">作为对象的创建模式， 单例模式确保某一个类只有一个实例，而且自行实例化并向整个系统提供这个实例，</span></div><div><span style="font-size:16px">这个类我们称之为单例类。</span></div>', '<div id="blogDetailDiv" style="font-size:14px;color:#000000;"><div class="blog_details_20120222"><div><div><span style="font-size:16px">首先我们要明确单例模式这个概念，那么什么是单例模式呢?</span></div><div><span style="font-size:16px">单例模式顾名思义，就是只有一个实例。</span></div><div><span style="font-size:16px">作为对象的创建模式， 单例模式确保某一个类只有一个实例，而且自行实例化并向整个系统提供这个实例，</span></div><div><span style="font-size:16px">这个类我们称之为单例类。</span></div><div><br /></div><div><span style="font-size:16px">单例模式的要点有三个：</span></div><div><span style="font-size:16px"> &nbsp; &nbsp;它们必须拥有一个构造函数，并且必须被标记为private</span></div><div><span style="font-size:16px"> &nbsp; &nbsp;它们拥有一个保存类的实例的静态成员变量</span></div><div><span style="font-size:16px"> &nbsp; &nbsp;它们拥有一个访问这个实例的公共的静态方法</span></div><div><br /></div><div><span style="font-size:16px">和普通类不同的是，单例类不能在其他类中直接实例化。单例类只能被其自身实例化。要获得这样的一种结果， __construct()方法必须被标记为private。如果试图用private构造函数构造一个类，就会得到一个可访问性级别的错误。</span></div><div><span style="font-size:16px">要让单例类起作用，就必须使其为其他类提供一个实例，用它调用各种方法。单例类不会创建实例副本，而是会向单例类内部存储的实例返回一个引用。结果是单例类不会重复占用内存和系统资源，从而让应用程序的其它部分更好地使用这些资源。作为这一模式的一部分，必须创建一个空的私有__clone()方法，以防止对象被复制或克隆。</span></div><div><p><span style="font-size:16px">返回实例引用的这个方法通常被命名为getInstance()。这个方法必须是静态的，而且如果它还没有实例化，就必须进行实例化。getInstance() 方法通过使用 instanceof 操作符和self 关键字，可以检测到类是否已经被实例化。</span></p><pre class="brush:html;toolbar:false;">header("Content-type:text/html;charset=utf-8");\r\n//单例测试类\r\nclass Test {\r\n    private $unique;\r\n    static private $instance;//静态属性保存该类实例\r\n      \r\n    private function __construct(){//构造方法私有(防止外界调用)\r\n        $this-&gt;unique=rand(0,20000);\r\n    }\r\n    static public function getInstance(){//静态方法提供对外接口(获取实例)\r\n        if(!self::$instance instanceof self){\r\n            self::$instance=new self();\r\n        }\r\n        return self::$instance;\r\n    }\r\n    private function __clone(){}//私有克隆方法,防止外界直接克隆该实例\r\n     \r\n}\r\n$test=Test::getInstance();\r\n$test2=Test::getInstance();\r\n     \r\nprint_r($test); \r\nprint_r($test2);\r\n     \r\nif($test===$test2){\r\n    echo ''相等!'';\r\n}else{\r\n    echo ''不相等!'';\r\n}</pre><p>结果：<br /></p><span style="font-size:16px"></span><span style="font-size:16px"></span><p><img src="/ueditor/php/upload/20140112/13895353281735.jpg" style="float:none;" title="psb.jpgngjan.jpg" /></p><span style="font-size:16px"> </span></div></div></div></div>', 1, '', 150, 'zfs', '张仿松php博客', 100, 100, 'PHP,单例模式', '2014-01-12 22:34:29', '2014-01-13 22:04:39', '127.0.0.1', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_book`
-- 

CREATE TABLE `wq_book` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `name` varchar(20) NOT NULL COMMENT '//留言用户',
  `age` varchar(10) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL default '0' COMMENT '//性别',
  `phone` varchar(15) NOT NULL COMMENT '//联系电话',
  `mobile` varchar(11) NOT NULL,
  `qq` varchar(15) NOT NULL COMMENT '//qq',
  `email` varchar(50) NOT NULL COMMENT '//邮件',
  `address` varchar(150) NOT NULL,
  `theme` varchar(150) NOT NULL COMMENT '//留言主题',
  `content` text NOT NULL COMMENT '//内容',
  `is_show` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否屏蔽',
  `is_answer` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否回复',
  `date` datetime NOT NULL COMMENT '//时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- 导出表中的数据 `wq_book`
-- 

INSERT INTO `wq_book` VALUES (1, '买家', '', 0, '15036005541', '', '', '123456789@qq.com', '河南省郑州市金水区升龙国际', '你好 你们的产品怎么卖的?', '你好 你们的产品怎么卖的?', 1, 1, '2013-12-11 15:01:57');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_cart`
-- 

CREATE TABLE `wq_cart` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//临时购物id',
  `resn` varchar(20) NOT NULL COMMENT '//商品sn',
  `reid` mediumint(8) unsigned NOT NULL COMMENT '//商品id',
  `uid` mediumint(8) unsigned NOT NULL default '0' COMMENT '//购买者id',
  `username` varchar(32) NOT NULL COMMENT '//临时购物人',
  `name` varchar(50) NOT NULL COMMENT '//商品名',
  `market_price` decimal(9,3) NOT NULL COMMENT '//进货价',
  `shop_price` decimal(9,3) NOT NULL COMMENT '//价格',
  `color` varchar(100) NOT NULL COMMENT '//颜色',
  `size` varchar(250) NOT NULL COMMENT '//尺码',
  `num` mediumint(8) unsigned NOT NULL COMMENT '//数量',
  `date` datetime NOT NULL COMMENT '//购买日期',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- 导出表中的数据 `wq_cart`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `wq_caster`
-- 

CREATE TABLE `wq_caster` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `title` varchar(50) NOT NULL COMMENT '//幻灯标题',
  `url` varchar(50) NOT NULL COMMENT '//图片路径',
  `state` tinyint(1) unsigned NOT NULL default '1' COMMENT '//审核状态',
  `date` datetime NOT NULL COMMENT '//上传日期',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- 
-- 导出表中的数据 `wq_caster`
-- 

INSERT INTO `wq_caster` VALUES (14, '首页幻灯11', 'slider1.jpg', 1, '2013-12-19 16:23:28');
INSERT INTO `wq_caster` VALUES (15, '首页幻灯22', 'slider2.jpg', 1, '2013-12-19 16:23:37');
INSERT INTO `wq_caster` VALUES (16, '首页幻灯33', 'slider3.jpg', 1, '2013-12-19 16:24:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_comment`
-- 

CREATE TABLE `wq_comment` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//评论id',
  `body` varchar(500) NOT NULL COMMENT '//评论内容',
  `aid` mediumint(8) unsigned NOT NULL COMMENT '//所属文章id',
  `atitle` varchar(50) NOT NULL COMMENT '//所属文章标题',
  `reid` mediumint(8) unsigned NOT NULL default '0' COMMENT '//是否为回复评论',
  `uname` varchar(20) NOT NULL COMMENT '//评论者姓名',
  `email` varchar(150) NOT NULL COMMENT '//评论者邮件',
  `face` varchar(150) NOT NULL COMMENT '//评论者头像',
  `site` varchar(150) NOT NULL COMMENT '//评论者网址',
  `islock` tinyint(3) unsigned NOT NULL default '0' COMMENT '//是否锁定',
  `date` datetime NOT NULL COMMENT '//评论时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- 导出表中的数据 `wq_comment`
-- 

INSERT INTO `wq_comment` VALUES (1, '这问题也遇到过,原来是这原因啊 学习了 !', 1, 'Thinkphp框架在大png图片生成缩略图时的小bug', 0, '爱好者', '714787417@qq.com', 'face3.png', 'http://zfsphp.com', 0, '2014-01-12 21:57:36');
INSERT INTO `wq_comment` VALUES (2, '这个一般面试的时候会问到!', 2, 'PHP单例模式浅析', 0, 'php', '22415150@qq.com', 'face3.png', 'http://zfsphp.com', 0, '2014-01-12 22:24:01');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_good`
-- 

CREATE TABLE `wq_good` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `sn` varchar(20) NOT NULL COMMENT '//商品唯一编号',
  `name` varchar(50) NOT NULL COMMENT '//名称',
  `thumb` varchar(250) NOT NULL COMMENT '//缩略图',
  `flag` varchar(100) NOT NULL COMMENT '//商品自定义属性',
  `keywords` varchar(20) NOT NULL COMMENT '//关键词',
  `color` varchar(100) NOT NULL COMMENT '//颜色',
  `size` varchar(250) NOT NULL COMMENT '//尺码',
  `description` varchar(250) NOT NULL COMMENT '//简介',
  `body` text NOT NULL COMMENT '//主要内容',
  `market_price` decimal(9,3) NOT NULL COMMENT '//市场价',
  `vip_price` decimal(9,3) NOT NULL COMMENT '//会员价',
  `shop_price` decimal(9,3) NOT NULL COMMENT '//本店价',
  `click` mediumint(8) unsigned NOT NULL COMMENT '//点击量',
  `reid` mediumint(8) unsigned NOT NULL COMMENT '//所属栏目',
  `photo` text NOT NULL COMMENT '//商品图集',
  `num` mediumint(8) unsigned NOT NULL COMMENT '//库存数量',
  `date` datetime NOT NULL COMMENT '//发布日期',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `wq_good`
-- 

INSERT INTO `wq_good` VALUES (5, 'G-20134528', '金苹果嘉和礼月饼', 'thumb_20080911120529154.jpg', '', '', '', '', '金苹果嘉和礼月饼', '<p style="text-align:center;"><img src="/ueditor/php/upload/20131209/13865827493440.jpg" title="20080911120529154.jpg" /><br /></p><p style="text-align:center;">金苹果嘉和礼月饼<br /></p>', 0.000, 0.000, 0.000, 120, 3, '', 0, '2013-12-09 17:42:06');
INSERT INTO `wq_good` VALUES (6, 'G-20139717', '翠沁斋苏式月饼 素食清真 百果苏月360g/筒', 'thumb_20080911120529154.jpg', '', '', '', '', '翠沁斋苏式月饼 素食清真 百果苏月360g/筒', '<p style="text-align:center;"><img src="/ueditor/php/upload/20131209/13865828079202.jpg" title="20080911120529154.jpg" /><br /></p><p style="text-align:center;">翠沁斋苏式月饼 素食清真 百果苏月360g/筒<br /></p>', 0.000, 0.000, 0.000, 100, 3, '', 0, '2013-12-09 17:42:59');
INSERT INTO `wq_good` VALUES (4, 'G-20133387', '知味观花开富贵月饼礼盒', 'thumb_201235478954212.jpeg', '', '', '', '', '知味观花开富贵月饼礼盒', '<p style="text-align:center;"><img src="/ueditor/php/upload/20131209/13865827817472.jpg" title="024_112559_RRTvPSD4.jpg" /></p><p style="text-align:center;">知味观花开富贵月饼礼盒<br /></p>', 0.000, 0.000, 0.000, 101, 3, '', 0, '2013-12-09 17:27:50');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_group`
-- 

CREATE TABLE `wq_group` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `group_id` tinyint(2) unsigned NOT NULL COMMENT '//分组id',
  `group_name` varchar(10) NOT NULL COMMENT '//分组名',
  `group_desc` varchar(250) NOT NULL COMMENT '//分组描述',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `wq_group`
-- 

INSERT INTO `wq_group` VALUES (1, 1, '普通会员', '可以享有基本的网上购物功能');
INSERT INTO `wq_group` VALUES (2, 2, '初级会员', '可以享有9.5折优惠');
INSERT INTO `wq_group` VALUES (3, 3, '中级会员', '可以享有9折优惠');
INSERT INTO `wq_group` VALUES (4, 4, '高级会员', '可以享有8.5折优惠');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_level`
-- 

CREATE TABLE `wq_level` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `level` tinyint(2) unsigned NOT NULL COMMENT '//等级',
  `permission` varchar(100) NOT NULL COMMENT '//等级标示',
  `name` varchar(10) NOT NULL COMMENT '//等级名称',
  `desc` varchar(200) NOT NULL COMMENT '//等级描述',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `wq_level`
-- 

INSERT INTO `wq_level` VALUES (1, 1, '1,2,3,4,5,6', '超级管理员', '超级管理员');
INSERT INTO `wq_level` VALUES (2, 2, '1,2', '普通管理员', '普通管理员');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_link`
-- 

CREATE TABLE `wq_link` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `name` varchar(10) NOT NULL COMMENT '//链接名称',
  `kind` tinyint(1) unsigned NOT NULL default '0' COMMENT '//链接类型',
  `imgurl` varchar(100) NOT NULL COMMENT '//友链图片地址',
  `url` varchar(100) NOT NULL COMMENT '//链接地址',
  `state` tinyint(1) unsigned NOT NULL COMMENT '//审核状态',
  `sort` mediumint(8) unsigned NOT NULL default '0' COMMENT '//排序',
  `date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `wq_link`
-- 

INSERT INTO `wq_link` VALUES (1, 'PHP中文网', 0, '', 'http://www.php100.com/', 1, 0, '2014-01-08 22:37:23');
INSERT INTO `wq_link` VALUES (2, 'PHPChina', 0, '', 'http://www.phpchina.com/', 1, 0, '2014-01-08 22:38:12');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_nav`
-- 

CREATE TABLE `wq_nav` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `name` varchar(20) NOT NULL COMMENT '//栏目名称',
  `keywords` varchar(100) NOT NULL COMMENT '//栏目关键词描述',
  `intro` varchar(250) NOT NULL COMMENT '//栏目简介',
  `body` text NOT NULL COMMENT '//栏目内容',
  `reid` mediumint(8) unsigned NOT NULL default '0' COMMENT '//父级栏目',
  `sort` mediumint(8) unsigned NOT NULL COMMENT '//排序',
  `model` tinyint(1) unsigned NOT NULL default '1' COMMENT '//栏目模型',
  `menu` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否导航菜单',
  `linkurl` varchar(500) NOT NULL COMMENT '//外部链接地址',
  `attr` tinyint(1) unsigned NOT NULL default '1' COMMENT '//栏目属性',
  `indextpl` varchar(100) NOT NULL COMMENT '//封面模板',
  `listtpl` varchar(100) NOT NULL COMMENT '//列表模板',
  `articletpl` varchar(100) NOT NULL COMMENT '//内容模板',
  `date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- 导出表中的数据 `wq_nav`
-- 

INSERT INTO `wq_nav` VALUES (1, 'PHP教程', 'PHP教程,PHP实例教程,PHP代码', 'PHP教程栏目主要放一些php语法以及php语言方面的博文!', '', 0, 1, 1, 1, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:01:46');
INSERT INTO `wq_nav` VALUES (2, '框架开发', 'PHP框架,PHP主流框架,ThinkPHP框架,Yii框架', '框架开发主要放一些php流行框架的一些使用方法与思路的博文!', '', 0, 2, 1, 1, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:03:06');
INSERT INTO `wq_nav` VALUES (3, '开源系统', '74CMS二次开发,DedeCMS二次开发,Ecshop二次开发', '开源系统主要放当前php主流的开源程序74CMS,DedeCMS,Ecshop二次开发博文!', '', 0, 3, 1, 1, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:04:08');
INSERT INTO `wq_nav` VALUES (4, '资源共享', '资源共享,PHP代码资源', '资源共享主要放一些PHP开发资料,源码等!', '', 0, 4, 1, 1, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:06:15');
INSERT INTO `wq_nav` VALUES (5, 'Web前端', 'Web前端,Javascript,CSS,HTML5', 'Web前端主要放一些web前端Javascript,CSS,HTML5开发的博文!', '', 0, 5, 1, 1, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:08:16');
INSERT INTO `wq_nav` VALUES (6, '模板引擎', '模板引擎,PHP模板引擎,Smarty,Template_lite', '模板引擎主要放置一些PHP主流模板引擎如,Smarty,Template_lite的使用博文!', '', 0, 6, 1, 1, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:09:42');
INSERT INTO `wq_nav` VALUES (7, 'ThinkPHP框架', 'ThinkPHP,框架,ThinkPHP框架', 'ThinkPHP框架相关技术博文!', '', 2, 7, 1, 0, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:13:03');
INSERT INTO `wq_nav` VALUES (8, 'Yii框架', 'Yii,框架,Yii框架', 'Yii框架相关技术博文!', '', 2, 8, 1, 0, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:13:41');
INSERT INTO `wq_nav` VALUES (9, '织梦CMS', '织梦CMS,dedecms模板,dedecms标签,dedecms二次开发', '织梦CMS,dedecms模板,dedecms标签,dedecms二次开发相关技术文章!', '', 3, 9, 1, 0, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:15:51');
INSERT INTO `wq_nav` VALUES (10, 'Ecshop商城系统', 'Ecshop商城系统,Ecshop,ecshop模板,ecshop二次开发', 'Ecshop,ecshop模板,ecshop标签,ecshop二次开发相关技术文章!', '', 3, 10, 1, 0, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:17:06');
INSERT INTO `wq_nav` VALUES (11, '74CMS招聘系统', '74CMS,74CMS招聘系统,74CMS模板,74CMS标签,74CMS二次开发', '74CMS,74CMS模板,74CMS标签,74CMS二次开发相关技术文章', '', 3, 11, 1, 0, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-08 21:18:13');
INSERT INTO `wq_nav` VALUES (12, '关于博客', '关于博客,张仿松PHP博客,博客网站', '关于张仿松PHP博客,个人网站的介绍!', '<p> &nbsp; &nbsp; &nbsp; 记录一些工作中常见php问题的解决方案,内容多数为原创,少部分整理自网络!如需转载,请注明出处,谢谢!</p><p> &nbsp; &nbsp; &nbsp; 该博客程序是博主基于ThinkPHP开源框架,仿WordPress官方发布的twentytwelve主题制作的,如有喜欢这套轻型博客程序的可以私密我,博主可以免费奉送源码额!</p><p><br /></p><p> &nbsp; &nbsp; &nbsp; 关于友链,希望可以交换原创性较多的个人博客网站,营销推广类勿扰!</p><p> &nbsp; &nbsp; &nbsp; 交换友链的可以联系QQ：845573796<br /></p><p><br /></p>', 0, 12, 1, 1, '', 0, 'about.html', 'list_article.html', 'article_article.html', '2014-01-09 20:49:23');
INSERT INTO `wq_nav` VALUES (13, 'Smarty模板引擎', 'Smarty模板引擎,Smarty,模板引擎', 'Smarty是一个使用PHP写出来的模板引擎，是目前业界最著名的PHP模板引擎之一，它成功分离了应用程序的逻辑与表现。', '', 6, 13, 1, 0, '', 1, 'index_article.html', 'list_article.html', 'article_article.html', '2014-01-21 23:31:51');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_ogood`
-- 

CREATE TABLE `wq_ogood` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `resn` varchar(20) NOT NULL COMMENT '//订单sn',
  `reid` mediumint(8) unsigned NOT NULL COMMENT '//订单id',
  `goodid` mediumint(8) unsigned NOT NULL COMMENT '//商品id',
  `name` varchar(50) NOT NULL COMMENT '//商品名',
  `market_price` decimal(9,3) NOT NULL COMMENT '//进货价',
  `shop_price` decimal(9,3) NOT NULL COMMENT '//商品单价',
  `num` mediumint(8) unsigned NOT NULL COMMENT '//购买数量',
  `total` decimal(9,3) NOT NULL COMMENT '//金额小计',
  `is_delete` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否删除',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- 导出表中的数据 `wq_ogood`
-- 

INSERT INTO `wq_ogood` VALUES (1, 'O2013032810460494479', 2, 4, '测试第一篇有图片的商品', 0.000, 9.000, 1, 9.000, 0);
INSERT INTO `wq_ogood` VALUES (2, 'O2013032810460494479', 2, 3, '测试第一篇有图片的商品', 0.000, 9.000, 1, 9.000, 0);
INSERT INTO `wq_ogood` VALUES (3, 'O2013032810460494479', 2, 2, '测试第二篇没有图片的商品', 0.000, 20.000, 1, 20.000, 0);
INSERT INTO `wq_ogood` VALUES (4, 'O2013032810460494479', 2, 1, '测试第一篇没有图片的商品', 0.000, 10.000, 1, 10.000, 0);
INSERT INTO `wq_ogood` VALUES (5, 'O2013032812000820811', 3, 1, '测试第一篇没有图片的商品', 0.000, 10.000, 2, 20.000, 0);
INSERT INTO `wq_ogood` VALUES (6, 'O2013040310395557416', 9, 2, '测试第二篇没有图片的商品', 0.000, 20.000, 3, 60.000, 0);
INSERT INTO `wq_ogood` VALUES (7, 'O2013040517030843660', 10, 9, '商品测试文章第5篇', 0.000, 12.000, 1, 12.000, 0);
INSERT INTO `wq_ogood` VALUES (8, 'O2013040517030843660', 10, 6, '商品测试文章第2篇', 0.000, 12.000, 1, 12.000, 0);
INSERT INTO `wq_ogood` VALUES (9, 'O2013040517030843660', 10, 10, '商品测试文章第6篇', 0.000, 12.000, 2, 24.000, 0);
INSERT INTO `wq_ogood` VALUES (10, 'O2013040517055288242', 11, 1, '测试第一篇没有图片的商品', 0.000, 15.000, 2, 30.000, 0);
INSERT INTO `wq_ogood` VALUES (11, 'O2013040517192881379', 12, 1, '测试第一篇没有图片的商品', 12.000, 15.000, 2, 30.000, 0);
INSERT INTO `wq_ogood` VALUES (12, 'O201311201829', 13, 1, '女鞋', 180.000, 120.000, 1, 120.000, 0);
INSERT INTO `wq_ogood` VALUES (13, 'O201311201829', 13, 1, '女鞋', 180.000, 120.000, 2, 240.000, 0);
INSERT INTO `wq_ogood` VALUES (14, 'O201311204035', 14, 3, '老北京布鞋男鞋', 216.000, 180.000, 2, 360.000, 0);
INSERT INTO `wq_ogood` VALUES (15, 'O201311204035', 14, 3, '老北京布鞋男鞋', 216.000, 180.000, 3, 540.000, 0);
INSERT INTO `wq_ogood` VALUES (16, 'O201311204035', 14, 2, '女鞋', 264.000, 120.000, 1, 120.000, 0);
INSERT INTO `wq_ogood` VALUES (17, 'O201311204035', 14, 1, '女鞋', 180.000, 120.000, 3, 360.000, 0);
INSERT INTO `wq_ogood` VALUES (18, 'O201311214633', 15, 2, '女鞋', 264.000, 120.000, 2, 240.000, 0);
INSERT INTO `wq_ogood` VALUES (19, 'O201311217770', 16, 2, '女鞋', 264.000, 120.000, 1, 120.000, 0);
INSERT INTO `wq_ogood` VALUES (20, 'O201311217770', 16, 1, '女鞋', 180.000, 120.000, 2, 240.000, 0);
INSERT INTO `wq_ogood` VALUES (21, 'O201311217770', 16, 1, '女鞋', 180.000, 120.000, 1, 120.000, 0);
INSERT INTO `wq_ogood` VALUES (22, 'O201311295416', 17, 1, '女鞋', 180.000, 120.000, 10, 1200.000, 0);
INSERT INTO `wq_ogood` VALUES (23, 'O201311295416', 17, 3, '老北京布鞋男鞋', 216.000, 180.000, 1, 180.000, 0);
INSERT INTO `wq_ogood` VALUES (24, 'O201311295416', 17, 3, '老北京布鞋男鞋', 216.000, 180.000, 2, 360.000, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_order`
-- 

CREATE TABLE `wq_order` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `sn` varchar(20) NOT NULL COMMENT '//订单号',
  `uid` mediumint(8) unsigned NOT NULL COMMENT '//订单人',
  `zone` varchar(50) NOT NULL COMMENT '//配送区域',
  `reciver` varchar(20) NOT NULL COMMENT '//收货人',
  `address` varchar(50) NOT NULL COMMENT '//收货地址',
  `phone` varchar(15) NOT NULL COMMENT '//电话',
  `building` varchar(20) NOT NULL COMMENT '//标志性建筑',
  `email` varchar(50) NOT NULL COMMENT '//邮件',
  `code` varchar(6) NOT NULL COMMENT '//邮编',
  `mobile` varchar(15) NOT NULL COMMENT '//手机号',
  `besttime` datetime NOT NULL COMMENT '//最佳送货时间',
  `state` tinyint(1) unsigned NOT NULL default '0' COMMENT '//发货状态',
  `is_delete` tinyint(1) unsigned NOT NULL default '0' COMMENT '//是否取消订单',
  `paystyle` tinyint(1) unsigned NOT NULL COMMENT '//支付方式',
  `ordertime` datetime NOT NULL COMMENT '//下单时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- 导出表中的数据 `wq_order`
-- 

INSERT INTO `wq_order` VALUES (3, 'O2013032812000820811', 1, '', '张放松', '河南郑州市金水区', '12345678910', '', '845573796@qq.com', '450000', '15036005541', '0000-00-00 00:00:00', 1, 0, 0, '2013-03-28 12:00:08');
INSERT INTO `wq_order` VALUES (9, 'O2013040310395557416', 1, '', '张放松', '河南郑州市金水区', '12345678910', '', '845573796@qq.com', '450000', '15036005541', '0000-00-00 00:00:00', 0, 1, 0, '2013-04-03 10:39:55');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_permission`
-- 

CREATE TABLE `wq_permission` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `name` varchar(10) NOT NULL COMMENT '//权限标示名',
  `info` varchar(200) NOT NULL COMMENT '//权限标示简介',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `wq_permission`
-- 

INSERT INTO `wq_permission` VALUES (1, '普通管理', '普通管理');
INSERT INTO `wq_permission` VALUES (2, '资讯管理', '资讯管理');
INSERT INTO `wq_permission` VALUES (3, '商品管理', '商品管理');
INSERT INTO `wq_permission` VALUES (4, '系统管理', '系统管理');
INSERT INTO `wq_permission` VALUES (5, '管理员管理', '管理员管理');
INSERT INTO `wq_permission` VALUES (6, '会员管理', '会员管理');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_rebook`
-- 

CREATE TABLE `wq_rebook` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `reid` mediumint(8) unsigned NOT NULL COMMENT '//所属id',
  `name` varchar(20) NOT NULL COMMENT '//回复人',
  `content` text NOT NULL COMMENT '//回复内容',
  `date` datetime NOT NULL COMMENT '//回复时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `wq_rebook`
-- 

INSERT INTO `wq_rebook` VALUES (2, 2, 'muyuu', '应该是12月月末吧 具体时间一官网发布的时间为准!', '2013-12-19 15:45:56');
INSERT INTO `wq_rebook` VALUES (1, 1, 'muyuu', '可以网上 在线购买的 ', '2013-12-19 15:46:22');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_system`
-- 

CREATE TABLE `wq_system` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `webname` varchar(50) NOT NULL COMMENT '//站点名称',
  `keywords` varchar(100) NOT NULL COMMENT '//关键词',
  `seo_description` varchar(255) NOT NULL,
  `description` text NOT NULL COMMENT '//描述',
  `beian` varchar(250) NOT NULL COMMENT '//备案号',
  `tel` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gsdz` varchar(500) NOT NULL,
  `cfrx` varchar(500) NOT NULL,
  `gsln` varchar(500) NOT NULL,
  `gsyj` varchar(500) NOT NULL,
  `video` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `wq_system`
-- 

INSERT INTO `wq_system` VALUES (1, '张仿松PHP博客', '个人博客,个人PHP网站,74CMS二次开发,DedeCMS二次开发,Ecshop二次开发', '张仿松PHP博客是一个关注PHP网站建设,PHP开源系统DedeCMS,Ecshop商城,74CMS招聘系统二次开发的技术博客,提供一个互联网从业者的学习成果和工作经验总结。', 'PHP开源系统DedeCMS,Ecshop商城,74CMS招聘系统二次开发', 'zfsphp.com is designed by ZFS All Rights Reserved,Theme is designed by The WordPress Team ! ', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_tag`
-- 

CREATE TABLE `wq_tag` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `tagname` varchar(20) NOT NULL COMMENT '//标签名称',
  `counts` mediumint(8) unsigned NOT NULL default '1' COMMENT '//点击量',
  `date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- 导出表中的数据 `wq_tag`
-- 

INSERT INTO `wq_tag` VALUES (1, 'ThinkPHP', 11, '2014-01-12 21:33:59');
INSERT INTO `wq_tag` VALUES (2, '框架', 9, '2014-01-12 21:33:59');
INSERT INTO `wq_tag` VALUES (3, 'PHP', 13, '2014-01-12 22:02:44');
INSERT INTO `wq_tag` VALUES (4, '单例模式', 11, '2014-01-12 22:02:44');
INSERT INTO `wq_tag` VALUES (5, '易宝', 9, '2014-01-12 22:55:50');
INSERT INTO `wq_tag` VALUES (6, '网上支付', 9, '2014-01-12 22:55:50');
INSERT INTO `wq_tag` VALUES (7, '接口', 12, '2014-01-12 22:55:50');
INSERT INTO `wq_tag` VALUES (8, '图形函数', 11, '2014-01-13 21:32:57');
INSERT INTO `wq_tag` VALUES (9, '74CMS', 165, '2014-01-16 00:22:45');
INSERT INTO `wq_tag` VALUES (10, '二次开发', 12, '2014-01-16 00:22:45');
INSERT INTO `wq_tag` VALUES (11, 'Ecshop', 7, '2014-01-17 22:57:34');
INSERT INTO `wq_tag` VALUES (12, '系统变量', 10, '2014-01-17 22:57:34');
INSERT INTO `wq_tag` VALUES (13, 'Smarty3', 3, '2014-01-21 23:39:43');
INSERT INTO `wq_tag` VALUES (14, '模板引擎', 3, '2014-01-21 23:39:43');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_user`
-- 

CREATE TABLE `wq_user` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `username` varchar(20) NOT NULL COMMENT '//用户名',
  `password` char(32) NOT NULL COMMENT '//密码',
  `email` varchar(50) NOT NULL COMMENT '//邮箱',
  `sex` tinyint(1) unsigned NOT NULL COMMENT '//性别',
  `realname` varchar(20) NOT NULL COMMENT '//真实姓名',
  `mobile` varchar(15) NOT NULL COMMENT '//手机',
  `qq` varchar(15) NOT NULL COMMENT '//QQ',
  `address` varchar(100) NOT NULL COMMENT '//收货地址',
  `company` varchar(100) NOT NULL COMMENT '//所在单位',
  `code` varchar(6) NOT NULL COMMENT '//邮编',
  `phone` varchar(15) NOT NULL COMMENT '//电话号码',
  `fax` varchar(15) NOT NULL COMMENT '//传真',
  `loginnum` mediumint(8) unsigned NOT NULL default '1' COMMENT '//登陆次数',
  `face` varchar(50) NOT NULL COMMENT '//头像',
  `idcard` varchar(18) NOT NULL COMMENT '//身份证号码',
  `group` tinyint(2) unsigned NOT NULL default '1' COMMENT '//会员分组',
  `score` mediumint(8) unsigned NOT NULL default '100' COMMENT '//积分',
  `lasttime` datetime NOT NULL COMMENT '//最后登录时间',
  `lastip` varchar(15) NOT NULL COMMENT '//最后登录ip',
  `date` datetime NOT NULL COMMENT '//注册时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- 导出表中的数据 `wq_user`
-- 

INSERT INTO `wq_user` VALUES (1, '风影院', '202cb962ac59075b964b07152d234b70', '845573796@qq.com', 0, '张放松', '15036005541', '845573796', '河南郑州市金水区', '', '450000', '12345678910', '123456', 1, '', '', 1, 100, '2013-03-25 10:12:41', '127.0.0.1', '2013-03-25 10:12:41');

-- --------------------------------------------------------

-- 
-- 表的结构 `wq_vote`
-- 

CREATE TABLE `wq_vote` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//id',
  `title` varchar(20) NOT NULL COMMENT '//标题',
  `info` varchar(200) NOT NULL COMMENT '//简介',
  `reid` mediumint(8) unsigned NOT NULL COMMENT '//父级id',
  `count` mediumint(8) unsigned NOT NULL COMMENT '//票数',
  `state` tinyint(1) unsigned NOT NULL default '1' COMMENT '//前台显示状态',
  `date` datetime NOT NULL COMMENT '//添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- 导出表中的数据 `wq_vote`
-- 

INSERT INTO `wq_vote` VALUES (1, '您最喜欢的旅游地区是哪里？', '您最喜欢的旅游地区是哪里？', 0, 0, 1, '2012-01-26 12:18:28');
INSERT INTO `wq_vote` VALUES (4, '江苏扬州', '江苏扬州是个美丽的地方！', 1, 17, 0, '2012-01-26 13:10:41');
INSERT INTO `wq_vote` VALUES (5, '浙江杭州', '浙江杭州是个美丽的地方！', 1, 25, 0, '2012-01-26 13:11:15');
INSERT INTO `wq_vote` VALUES (6, '浙江宁波', '浙江宁波是个好地方！', 1, 2, 0, '2012-01-26 14:36:57');
INSERT INTO `wq_vote` VALUES (8, '河南洛阳', '河南洛阳', 1, 17, 0, '2012-01-26 14:42:38');
INSERT INTO `wq_vote` VALUES (9, '你是怎么知道本站的?', '你是怎么知道本站的?描述', 0, 0, 1, '2013-03-29 10:44:03');
