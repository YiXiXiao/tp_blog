<?php
	class ArticleAction extends CommonAction{
		public function index(){
			$id=$_GET['id']+0;
			$article=new ArticleModel();
			$oneArticle=$article->getOneArticle($id);
			
			if(empty($oneArticle)){
				$this->error('找不到该条文章信息!');
			}
			
			$this->header();
			$this->footer();
			
			$this->assign('oneArticle',$oneArticle);
			
			$content='';
			
			//更新浏览数量
			$article->execute("update wq_article set click=click+1 where id=".$oneArticle['id']);
			
			//面包屑导航
			$nav=new NavModel();
			$allNav=$nav->getAllNav2();
			$oneNav=$nav->getOneNav($oneArticle['reid']);
			
			$breadNav=$nav->getFamily($allNav,$oneNav['id']);
			$breadNav=array_reverse($breadNav);
			$this->assign('breadNav',$breadNav);
			
			$topNav=$breadNav['0'];
			$this->assign('topNav',$topNav);
			
			//处理左侧分类
			if($oneNav['reid']=='0'){
				$leftNav=$nav->getAllNav();
			}else{
				$leftNav=$nav->getLevelNav($oneNav['reid']);
			}
			$this->assign('leftNav',$leftNav);
			
			//上一篇下一篇文章
			$pre=$article->getPreOrNext($oneArticle['id'],-1);
			if(empty($pre)){
				$pre='没有了';
			}else{
				$pre="<a href='__APP__/Article/index/id/".$pre['id']."'>".$pre['title']."</a>";
			}
			$this->assign('pre',$pre);
			
			$next=$article->getPreOrNext($oneArticle['id'],1);
			if(empty($next)){
				$next='没有了';
			}else{
				$next="<a href='__APP__/Article/index/id/".$next['id']."'>".$next['title']."</a>";
			}
			$this->assign('next',$next);
			
			$file_tpl=str_replace('.html','',$oneNav['articletpl']);
			$this->display("Public:$file_tpl");
				
		}
	}
?>