<?php
	class CommonAction extends Action {
		//头部处理与文件包含
		public function header(){
			header("content-type:text/html;charset=utf-8");
			$this->assign('Public',APP_PUBLIC_PATH);	
			load('extend');
			
			//网站菜单
			$nav=new NavModel();
			$menu=$nav->getAllNav();
			foreach($menu as $key=>$value){
				$menu[$key]['sons']=$nav->getSons($value['id']);
			}
			$this->assign('menu',$menu);
			
			//网站系统信息
			$sys=$this->getSysInfo();
			$this->assign('web_name',$sys['webname']);
			$this->assign('keywords',$sys['keywords']);
			$this->assign('description',$sys['description']);
			$this->assign('seo_description',$sys['seo_description']);
		}
		//页脚处理与文件包含
		public function footer(){
		
			//系统信息与友链
			$sys=$this->getSysInfo();
			$this->assign('beian',$sys['beian']);
			
			$link=new LinkModel();
			$linkList=$link->getLink(8);
			$this->assign('linkList',$linkList);			
		}
		//处理页面右侧信息
		public function right(){
			//10条最近更新博客
			$article=new ArticleModel();
			$articleList=$article->getRecent();
			$this->assign('rightList',$articleList);
			
			//文章归档
			$monthList=$article->getMonthList();
			foreach($monthList as $key=>$value){
				$monthList[$key]['pubdate']=date("Y年 m月",strtotime($value['pdate']));
			}
			$this->assign('monthList',$monthList);
			
			//热门标签
			$model=new Model();
			$hotTag=$model->query("select tagname,counts from wq_tag order by counts desc limit 0,20");
			//处理字体大小
			foreach($hotTag as $key=>$value){
				$num=floor(($value['counts']+1200)/100);
				$num=$num>30? 30:$num;
				$hotTag[$key]['size']=$num;
			}
			shuffle($hotTag);
			$this->assign('hotTag',$hotTag);
			
			//近期评论
			$recentCommonet=$model->query("select uname,aid,atitle from wq_comment order by date desc limit 0,10");
			$this->assign('recentCommonet',$recentCommonet);
		}
		
		//获取网站信息
		public function getSysInfo(){
			return M('system')->find();
		}
	}	
?>