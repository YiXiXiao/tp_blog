<?php
	class GoodModel extends Model {
		//实际表名
		protected $trueTableName='wq_good';
		
		protected $_auto=array(
			array('date','getCTime','1','callback'),
			array('click','100')
		);
		//自动验证
		protected $_validate=array(
			array('name','require','请填写商品名称!'),
			array('name','0,50','商品名称不得超过50个字符!',0,'length'),
			array('reid','ckNav','请选择商品所属分类!',1,'callback'),
		);
		//回调函数检测栏目
		public function ckNav($reid){
			if(!is_numeric($reid)||$reid=='0'){
				return false;
			}
			return true;
		}
		//获取文章创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}
		//获取客户端IP
		public function getCIp(){
			Load('extend');
			return get_client_ip();
		}
		public function getAllGood(){
			return $this->order('id asc')->select();
		}
		//根据id获取一条商品信息
		public function getOneGood($id){
			return $this->where("id=$id")->find();
		}
		//根据栏目id获取一定数量的商品列表
		public function getGoodsByNav($id,$sum){
			return $this->query("select * from $this->trueTableName where reid=$id order by date desc limit 0,$sum");
		}
		//生成一个唯一的不重复的商品sn
		public function makeGoodSn(){
			$sn='G-'.date('Y').mt_rand(1000,9999);
			return $this->snExists($sn)? $this->makeGoodSn():$sn;
		}
		//查看数据库中是否存在某条订单sn
		public function snExists($sn){
			return is_array($this->where("sn='$sn'")->find())? true:false;
		}
		//上一篇下一篇文章
		public function getPreOrNext($id,$flag){
			$oneGood=$this->getOneGood($id);
			$navId=$oneGood['reid'];
			
			if($flag>0){
				return $this->where("reid=$navId and id>$id")->order("id asc")->find();
			}else{
				return $this->where("reid=$navId and id<$id")->order("id desc")->find();
			}
		}
		//根据栏目id查询子孙栏目的指定条数的商品
		public function getSonsGood($id,$limit){
			$nav=new NavModel();
			$navIdStr=$nav->getNavIdStr($id);
			
			return $this->where("reid in ($navIdStr)")->limit("0,$limit")->select();
		}	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>