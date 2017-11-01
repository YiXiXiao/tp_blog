<?php
	class OgoodModel extends Model {
		//根据订单id查找下面得所有商品
		public function getGoodsByOrderId($id){
			return $this->where("reid=$id")->select();
		}
	}
?>