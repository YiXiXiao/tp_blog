<?php
	class ListAction extends CommonAction{
		public function index(){
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
		public function indextpl($oneNav){
			
			//处理左侧分类
			$nav=new NavModel();
			$leftNav=$nav->getSons($oneNav['id']);
			if(empty($leftNav)){
				if($oneNav['reid']=='0'){
					$leftNav=$nav->getAllNav();
				}else{
					$leftNav=$nav->getLevelNav($oneNav['reid']);
				}
			}
			$this->assign('leftNav',$leftNav);
			
			//留言左侧
			$guest_leftNav=$nav->getSons(2);
			$this->assign('guest_leftNav',$guest_leftNav);
			
			//最新留言
			$model=new Model('book');
			$left_guest=$model->order("id desc")->where("is_show=1")->limit("0,7")->select();
			$this->assign('left_guest',$left_guest);
			
			//网点服务左侧
			$service_leftNav=$nav->getSons(4);
			$this->assign('service_leftNav',$service_leftNav);
			
			//面包屑导航
			$allNav=$nav->getAllNav2();
			$breadNav=$nav->getFamily($allNav,$oneNav['id']);
			$breadNav=array_reverse($breadNav);
			$this->assign('breadNav',$breadNav);
			
			$topNav=$breadNav['0'];
			$this->assign('topNav',$topNav);
			
			
			//处理图片集
			$imgmodel="/<img([^>]*)\s*src=('|\")([^'\"]+)('|\")\s*title=('|\")([^'\"]+)('|\")\s*\/>/";
			preg_match_all($imgmodel,$oneNav['body'],$imgarr);
			$oneNav['photo']=$imgarr[3];
	
			$this->assign('oneNav',$oneNav);
				
			$file_tpl=str_replace('.html','',$oneNav['indextpl']);
			$this->display("Public:$file_tpl");
		}
		//处理栏目列表
		public function listtpl($oneNav){
			
			//处理左侧分类
			$nav=new NavModel();
			$leftNav=$nav->getSons($oneNav['id']);
			if(empty($leftNav)){
				if($oneNav['reid']=='0'){
					$leftNav=$nav->getAllNav();
				}else{
					$leftNav=$nav->getLevelNav($oneNav['reid']);
				}
			}
			$this->assign('leftNav',$leftNav);

			//面包屑导航
			$allNav=$nav->getAllNav2();
			$breadNav=$nav->getFamily($allNav,$oneNav['id']);
			$breadNav=array_reverse($breadNav);
			$this->assign('breadNav',$breadNav);
			
			$topNav=$breadNav['0'];
			$this->assign('topNav',$topNav);
			
			$articleList=$this->getPageList($oneNav,10);
			$this->assign('articleList',$articleList);
			
			//分页输出
			$this->assign('page',$this->page->show());
			
			//获取栏目下推荐的两条文章
			$article=new ArticleModel();
			$two_news=$article->getSonsFlagArticle($oneNav['id'],'c',2);
			$this->assign('two_news',$two_news);
			
			$file_tpl=str_replace('.html','',$oneNav['listtpl']);
			$this->display("Public:$file_tpl");
		}
		//获取栏目下相应的文档列表
		private function getPageList($oneNav,$limit){
			
			$nav=new NavModel();
			$navIdStr=$nav->getNavIdStr($oneNav['id']);
			import("ORG.Util.Page");
			if(!isset($limit)){
				$limit=20;
			}
			
			if($oneNav['model']=='1'){		
				$article=new ArticleModel();
				$articleSum=$article->where("reid in ($navIdStr)")->count();
				
				$this->page=new Page($articleSum,$limit);			
				return $article->where("reid in ($navIdStr)")->order('pubdate desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();	
			}elseif($oneNav['model']=='2'){
				$good=new GoodModel();
				$gooodSum=$good->where("reid in ($navIdStr)")->count();
				
				$this->page=new Page($gooodSum,$limit);		
				return $good->where("reid in ($navIdStr)")->order('date desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();
			}
		}
	}
?>