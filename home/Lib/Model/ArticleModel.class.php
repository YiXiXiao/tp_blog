<?php
	class ArticleModel extends Model {
		//实际表名
		protected $trueTableName='wq_article';
		
		protected $_auto=array(
			array('pubdate','getCTime','1','callback'),
			array('lastmod','getCTime','1','callback'),
			array('userip','getCIp','1','callback'),
			array('click','100')
		);
		//获取文章创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}
		//获取客户端IP
		public function getCIp(){
			Load('extend');
			return get_client_ip();
		}
		public function getAllArticle(){
			return $this->order('id asc')->select();
		}
		//根据文章id获取一条文章信息
		public function getOneArticle($id){
			return $this->where("id=$id")->find();
		}
		//根据栏目id获取一定数量的文章列表
		public function getArticlesByNav($id,$sum){
			return $this->query("select * from $this->trueTableName where reid=$id order by pubdate desc limit 0,$sum");
		}
		//根据栏目和属性获取一条新闻
		public function getOneArticleByFlag($flag,$id){
			$nav=new NavModel();
			$navIdStr=$nav->getNavIdStr($id);
			
			return $this->query("select * from $this->trueTableName where reid in($navIdStr) and flag like '%$flag%' order by pubdate desc limit 0,1");
		}
		//根据栏目和属性获取多条产品
		public function getArticleByFlag($flag,$id,$limit){
			return $this->query("select * from $this->trueTableName where reid in($id) and flag like '%$flag%' order by pubdate desc limit 0,$limit");
		}
		//随机获取产品
		public function getRandArticleByFlag($id,$limit){
			return $this->query("select * from $this->trueTableName where reid in($id) order by rand() desc limit 0,$limit");
		}		
		//获取最新产品
		public function getNewArticleByFlag($id,$limit){
			return $this->query("select * from $this->trueTableName where reid in($id) order by pubdate desc limit 0,$limit");
		}
		
		//上一篇下一篇文章
		public function getPreOrNext($id,$flag){
			$oneArticle=$this->getOneArticle($id);
			$navId=$oneArticle['reid'];
			
			if($flag>0){
				return $this->where("reid=$navId and id>$id")->order("id asc")->find();
			}else{
				return $this->where("reid=$navId and id<$id")->order("id desc")->find();
			}
		}
		//根据栏目id查询子孙栏目的指定条数的文章
		public function getSonsArticle($id,$limit){
			$nav=new NavModel();
			$navIdStr=$nav->getNavIdStr($id);
			
			return $this->where("reid in ($navIdStr)")->limit("0,$limit")->order("pubdate desc")->select();
		}
		//根据栏目id查询子孙栏目的指定条数的文章（带属性）
		public function getSonsFlagArticle($id,$flag,$limit){
			$nav=new NavModel();
			$navIdStr=$nav->getNavIdStr($id);
			
			return $this->where("reid in ($navIdStr) and flag like '$flag'")->limit("0,$limit")->select();
		}		
		//获取最近更新的10条文章
		public function getRecent($limit=10){
			$model=new Model();
			$sql="select a.id,a.reid,a.title,a.description,a.pubdate,a.keywords,c.name from wq_article as a left join wq_nav as c on a.reid=c.id order by a.lastmod desc limit 0,$limit";
			return $model->query($sql);
		}	
		//获取文档归档
		public function getMonthList(){
			$model=new ArticleModel();
			$sql="select count(*) as num,substring(pubdate,1,7) as pdate from wq_article group by pdate order by pdate desc";
			
			return $model->query($sql);
		}
		//获取文档评论
		public function getComments($id){
			$model=new Model();
			$sql="select uname,face,body,date from wq_comment where islock=0 and aid=$id order by date desc";
			return $model->query($sql);
		}
	}
?>