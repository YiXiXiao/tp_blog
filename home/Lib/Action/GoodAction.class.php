<?php
	class GoodAction extends CommonAction{
		public function index(){
			$id=$_GET['id']+0;
			$good=new GoodModel();
			$oneGood=$good->getOneGood($id);
			
			if(empty($oneGood)){
				$this->error('找不到该条商品信息!');
			}
			
			$this->header();
			$this->footer();
			if(!empty($oneGood['size'])){
				$oneGood['size']=explode(',',$oneGood['size']);
			}
			
			//处理图片集
			$imgmodel="/<img([^>]*)\s*src=('|\")([^'\"]+)('|\")/";
			preg_match_all($imgmodel,$oneGood['photo'],$imgarr);
			
			$oneGood['photo']=$imgarr[3];
			
			$this->assign('oneGood',$oneGood);
			
			//更新浏览数量
			$good->execute("update wq_good set click=click+1 where id=".$oneGood['id']);
			
			//面包屑导航
			$nav=new NavModel();
			$allNav=$nav->getAllNav2();
			$oneNav=$nav->getOneNav($oneGood['reid']);
			
			$this->assign('oneNav',$oneNav);
			
			$breadNav=$nav->getFamily($allNav,$oneNav['id']);
			$breadNav=array_reverse($breadNav);
			$this->assign('breadNav',$breadNav);
			
			//处理左侧分类
			if($oneNav['reid']=='0'){
				$leftNav=$nav->getAllNav();
			}else{
				$leftNav=$nav->getLevelNav($oneNav['reid']);
			}
			$this->assign('leftNav',$leftNav);
			
			//上一篇下一篇商品
			$pre=$good->getPreOrNext($oneGood['id'],-1);
			if(empty($pre)){
				$pre='没有了';
			}else{
				$pre="<a href='__APP__/Good/index/id/".$pre['id']."'>".$pre['title']."</a>";
			}
			$this->assign('pre',$pre);
			
			$next=$good->getPreOrNext($oneGood['id'],1);
			if(empty($next)){
				$next='没有了';
			}else{
				$next="<a href='__APP__/Good/index/id/".$next['id']."'>".$next['title']."</a>";
			}
			$this->assign('next',$next);
			
			$file_tpl=str_replace('.html','',$oneNav['articletpl']);
			$this->display("Public:$file_tpl");
				

		}
	}
?>