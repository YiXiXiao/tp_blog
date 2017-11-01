<?php
	class HomeAction extends CommonAction{
		protected $page='';
		
		//首页
		public function index(){
			$this->header();
			$this->footer();
			
			//页面右侧
			$this->right();
			
			//10条最近更新博客
			$article=new ArticleModel();
			$articleList=$article->getRecent();
			//处理标签
			foreach($articleList as $key=>$value){
				$articleList[$key]['tags']=empty($value['keywords'])? $value['keywords']:explode(',',$value['keywords']);
				$articleList[$key]['pubtime']=date('Y 年  m 月  d 日',strtotime($value['pubdate']));
				$articleList[$key]['pubtime2']=date('Y-m-d',strtotime($value['pubdate']));
			}
			$this->assign('articleList',$articleList);
			
			$this->display("Public:index");
		}
		
		//栏目页
		public function category(){
			//参数检查
			$id=$_GET['id']+0;
			$nav=new NavModel();
			$oneNav=$nav->getOneNav($id);
			if(empty($oneNav)){
				$this->error('找不到该栏目');
			}
			$this->assign('oneNav',$oneNav);
			
			$this->header();
			$this->footer();
			
			$this->right();
	
			if($oneNav['attr']=='2'){//外部链接
				if($oneNav['linkurl']=='' || $oneNav['linkurl']=='http://'){
					$this->error('请设置外部链接地址!');
				}
				header("location:".$oneNav['linkurl']);
			}elseif($oneNav['attr']=='1'){
				if(empty($oneNav['listtpl'])){
					$this->error('找不到列表模板文件!');
				}				
				$this->listtpl($oneNav);
			}else{
				if(empty($oneNav['indextpl'])){
					$this->error('找不到频道封面模板文件!');
				}				
				$this->indextpl($oneNav);
			}
		}
		
		//处理频道封面
		private function indextpl($oneNav){
			//载入封面模板
			$file_tpl=str_replace('.html','',$oneNav['indextpl']);
			$this->display("Public:$file_tpl");
		}
		
		//处理栏目列表页面
		private function listtpl($oneNav){
			//博客列表
			$articleList=$this->getPageList($oneNav,10);
			$this->assign('articleList',$this->formatTag($articleList));
			
			//分页输出
			$this->assign('page',$this->page->show());
			
			$file_tpl=str_replace('.html','',$oneNav['listtpl']);
			$this->display("Public:$file_tpl");
		}
		
		//分页
		private function getPageList($oneNav,$limit){
			$nav=new NavModel();
			$navIdStr=$nav->getNavIdStr($oneNav['id']);
			import("ORG.Util.Page");
			if(!isset($limit)){
				$limit=10;
			}
			
			if($oneNav['model']=='1'){		
				$article=new ArticleModel();
				$articleSum=$article->where("reid in ($navIdStr)")->count();
				
				$this->page=new Page($articleSum,$limit);
				$sql="select a.id,a.reid,a.title,a.description,a.pubdate,a.keywords,c.name from wq_article as a left join wq_nav as c on a.reid=c.id where a.reid in ($navIdStr) order by a.lastmod desc limit ".$this->page->firstRow.",".$this->page->listRows;			
				return $article->query($sql);
			}
		}
		
		//博文内容页
		public function blog(){
			$id=$_GET['id']+0;
			$article=new ArticleModel();
			$oneArticle=$article->getOneArticle($id);
			
			if(empty($oneArticle)){
				$this->error('找不到该条博文信息!');
			}
			
			$this->header();
			$this->footer();
			
			$this->right();
			
			$oneArticle['tags']=empty($oneArticle['keywords'])? $oneArticle['keywords']:explode(',',$oneArticle['keywords']);
			$oneArticle['pubtime']=date('Y 年  m 月  d 日',strtotime($oneArticle['pubdate']));
			$oneArticle['pubtime2']=date('Y-m-d',strtotime($oneArticle['pubdate']));
			
			//获取博文评论
			$oneArticle['comment']=$article->getComments($id);	
			
			if(is_array($oneArticle['comment']) && !empty($oneArticle['comment'])){
				$this->assign('count',count($oneArticle['comment']));
			}
			$this->assign('oneArticle',$oneArticle);
			
			//更新浏览数量
			$article->execute("update wq_article set click=click+1 where id=".$oneArticle['id']);
			
			$nav=new NavModel();
			$oneNav=$nav->getOneNav($oneArticle['reid']);
			$this->assign('oneNav',$oneNav);
			
			//上一篇下一篇文章
			$pre=$article->getPreOrNext($oneArticle['id'],-1);
			if(empty($pre)){
				$pre='没有了';
			}else{
				$pre="<a href='__APP__/Index/blog/id/".$pre['id']."'>".$pre['title']."</a>";
			}
			$this->assign('pre',$pre);
			
			$next=$article->getPreOrNext($oneArticle['id'],1);
			if(empty($next)){
				$next='没有了';
			}else{
				$next="<a href='__APP__/Index/blog/id/".$next['id']."'>".$next['title']."</a>";
			}
			$this->assign('next',$next);
			
			$file_tpl=str_replace('.html','',$oneNav['articletpl']);
			$this->display("Public:$file_tpl");
		}
		
		//发布博文评论
		public function comment(){
			
			$id=$_POST['id']+0;
			$article=new ArticleModel();
			$oneArticle=$article->getOneArticle($id);
			
			if(empty($oneArticle)){
				$this->error('找不到该条博文信息!');
			}
			
			$data=array(
				'body'=>htmlspecialchars($_POST['body']),
				'aid'=>$id,
				'atitle'=>$oneArticle['title'],
				'uname'=>htmlspecialchars($_POST['uname']),
				'email'=>htmlspecialchars($_POST['email']),
				'face'=>'face'.mt_rand(1,4).'.png',
				'site'=>htmlspecialchars($_POST['site']),
				'date'=>date('Y-m-d H:i:s')
			);

			$comment=new CommentModel();
			
			if($comment->data($data)->add()){
				$this->success('评论成功!');
			}else{
				$this->error('评论失败!');
			}
		}
		
		//博文搜索
		public function search(){
			$this->header();
			$this->footer();
			
			$this->right();
			
			$keywords=htmlspecialchars(trim($_GET['keywords']));
			
			//博客列表
			$articleList=$this->searchPage($keywords,10);
			$this->assign('articleList',$this->formatTag($articleList));
			
			$keywords=$keywords=='搜索神马的最有爱了'? '全部':$keywords;
			$this->assign('keywords',$keywords);			
			
			//分页输出
			$this->assign('page',$this->page->show());
			
			$this->display("Public:search");
		}
		
		//搜索函数
		private function searchPage($keywords,$limit=10){
			import("ORG.Util.Page");
			
			$keywords=$keywords=='搜索神马的最有爱了'? '':$keywords;
			
			$article=new ArticleModel();
			$articleSum=$article->where("title like '%$keywords%'")->count();

			$this->page=new Page($articleSum,$limit);

			$sql="select a.id,a.reid,a.title,a.description,a.pubdate,a.keywords,c.name from wq_article as a left join wq_nav as c on a.reid=c.id where a.title like '%$keywords%' order by a.lastmod desc limit ".$this->page->firstRow.",".$this->page->listRows;			
			return $article->query($sql);
		}
		
		//标签搜索根据文档属性查找相应的文档
		public function tag(){
			$this->header();
			$this->footer();
			
			$this->right();
			
			$tagAarray=array_map("htmlspecialchars",$_GET);
			
			//博客列表
			$articleList=$this->tagPage($tagAarray,10);
			$this->assign('articleList',$this->formatTag($articleList));
			
			//分页输出
			$this->assign('page',$this->page->show());
			
			$this->display("Public:tag");
		}
		
		//属性搜索
		private function tagPage($tagAarray,$limit=10){
			import("ORG.Util.Page");
			
			$tagAarray['tag']=iconv('gbk','utf-8',$tagAarray['tag']);
			
			$where="where 1";
			$where=isset($tagAarray['tag'])? $where." and a.keywords like '%".$tagAarray['tag']."%'":$where;
			$where=isset($tagAarray['t'])? $where." and a.pubdate like '".$tagAarray['t']."%'":$where;

			//更新Tag点击数
			if(isset($tagAarray['tag']) && !empty($tagAarray['tag'])){
				$model=new Model();
				$model->execute("update wq_tag set counts=counts+1 where tagname='".$tagAarray['tag']."'");
				
				$this->assign('tag',$tagAarray['tag']);
			}
			
			if(isset($tagAarray['t']) && !empty($tagAarray['t'])){				
				$this->assign('tag',$tagAarray['t']);
			}
			
			$article=new ArticleModel();
			$res=$article->query("select count(*) as total from wq_article as a $where");
			$articleSum=$res[0]['total'];
			
			$this->page=new Page($articleSum,$limit);		
			$sql="select a.id,a.reid,a.title,a.description,a.pubdate,a.keywords,c.name from wq_article as a left join wq_nav as c on a.reid=c.id $where order by a.lastmod desc limit ".$this->page->firstRow.",".$this->page->listRows;			
			
			return $article->query($sql);
		}
		
		//格式化标签处理函数
		private function formatTag($articleList){
			foreach($articleList as $key=>$value){
				$articleList[$key]['tags']=empty($value['keywords'])? $value['keywords']:explode(',',$value['keywords']);
				$articleList[$key]['pubtime']=date('Y 年  m 月  d 日',strtotime($value['pubdate']));
				$articleList[$key]['pubtime2']=date('Y-m-d',strtotime($value['pubdate']));
			}
			
			return $articleList;
		}
		
	}
?>
 