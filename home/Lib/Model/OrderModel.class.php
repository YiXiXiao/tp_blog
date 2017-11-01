<?php
	class OrderModel extends Model {
		//实际表名
		protected $trueTableName='wq_order';
		//生成一个唯一的不重复的订单sn
		public function makeOrderSn(){
			$sn='O'.date('Ymd').mt_rand(1000,9999);
			return $this->snExists($sn)? $this->makeOrderSn():$sn;
		}
		//查看数据库中是否存在某条订单sn
		public function snExists($sn){
			return is_array($this->where("sn='$sn'")->find())? true:false;
		}
		//根据用户id获取用户的所有订单
		public function getAllOrders($uid){
			return $this->where("uid=$uid and is_delete=0")->select();
		}
		//根据订单id查找一条订单信息
		public function getOneOrder($id){
			return $this->where("id=$id")->find();
		}
		//根据订单id和用户id查找一条订单信息
		public function getOneOrder2($uid,$id){
			return $this->where("id=$id and uid=$uid")->find();
		}
		//根据用户id和订单id取消一条订单
		public function cancelOneOrder($uid,$id){
			echo $this->execute("update $this->trueTableName set is_delete=1 where id=$id and uid=$uid");
		}
		//根据用户id和订单id删除一条订单
		public function deleteOneOrder($uid,$id){
			return $this->where("id=$id and uid=$uid")->delete();
		}	
		//给一条订单修改为发货
		public function modifyOrderState($id){
			return $this->execute("update $this->trueTableName set state=1 where id=$id");
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>