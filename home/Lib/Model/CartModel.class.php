<?php
	class CartModel extends Model {
		//根据用户名查找用户购买的商品
		public function getMyGoods($username){
			return $this->where("username='$username'")->select();
		}
		
		//获取自己购物的一条信息
		public function getOneCart($username,$id){
			return $this->where("username='$username' and id=$id")->find();
		}
		
		//删除一条购物车
		public function deleteOneCart($username,$id){
			return $this->where("id=$id and username='$username'")->delete();
		}
		
	}
?>