<?php
	class CartAction extends CommonAction {
		//取出购物车中的商品列表
		public function index(){
			$this->header();
			$this->footer();
			
			$cart=new CartModel();
			$cartList=$cart->getMyGoods($_COOKIE['username']);
			
			$total=0;
			foreach($cartList as $key=>$value){
				$cartList[$key]['total']=$value['shop_price']*$value['num'];
				$total+=$cartList[$key]['total'];
			}
			
			$this->assign('cartList',$cartList);
			$this->assign('total',round($total,3));
			
			$this->display('Public:cart');
		}
		
		//购买一条商品信息(添加到购物车)
		public function addCart(){
			
			if(!isset($_POST['id']) || !is_numeric($_POST['id'])){
				$this->error('参数错误!');
			}
			
			load('extend');
			
			$id=$_POST['id']+0;
			$good=new GoodModel();
			$oneGood=$good->getOneGood($id);
			
			if(empty($oneGood) || !is_array($oneGood)){
				$this->error('不存在该商品系信息!');
			}
			$oneGood['size']=explode(',',$oneGood['size']);
			
			
			//购物车信息
			$data=array();
			$data['resn']=$oneGood['sn'];
			$data['reid']=$oneGood['id'];
			$data['name']=$oneGood['name'];
			$data['market_price']=$oneGood['market_price'];
			$data['shop_price']=$oneGood['shop_price'];
			$data['color']=$oneGood['color'];
			
			$data['date']=date('Y-m-d H:i:s');
			
			if(isset($_SESSION['user_id'])&&$_SESSION['user_id']>0){
				$data['uid']=$_SESSION['user_id'];
			}
			if(empty($_COOKIE['username'])){
				$username=get_client_ip().date('YmdHis');
				setcookie('username',$username,time()+3600*24*7);
				$data['username']=$username;
			}else{
				$data['username']=$_COOKIE['username'];
			}
			
			
			$cart=new CartModel();
			

			foreach($oneGood['size'] as $key=>$value){
				if($_POST['num'][$key]<=0 || !is_numeric($_POST['num'][$key])){
					continue;
				}
				
				$data['size']=$value;
				$data['num']=$_POST['num'][$key];
				
				if(!$cart->add($data)){	
					$this->error('商品添加失败,请联系管理员!');
					exit;
				}
			}
			
			$this->redirect('/Cart/index');

		}
		
		//删除一条购物信息
		public function del(){
			if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
				$this->error('参数错误!');
				exit;
			}
			$id=$_GET['id'];
			$username=$_COOKIE['username'];
			
			$cart=new CartModel();
			$oneCart=$cart->getOneCart($username,$id);
			
			if(empty($oneCart)){
				$this->error('不存在该购物信息!');
			}
			
			if(!$cart->where("id=$id and username='$username'")->delete()){
				$this->error('删除失败!');
				exit;
			}
			
			$this->success('删除商品成功!');
			$this->redirect('/Cart/index');
		}
		
		//清空购物车
		public function clear(){
			$username=$_COOKIE['username'];
			
			$cart=new CartModel();
			$oneCart=$cart->where("username='$username'")->find();
			
			if(empty($oneCart)){
				$this->success('购物车是空的,无需再次清空!');
				exit;
			}
			
			if(!$cart->where("username='$username'")->delete()){
				$this->error('清空购物车出现错误!');
				exit;
			}
			
			$this->success('清空购物车成功!');
			$this->redirect('/Cart/index');
		}
		
		//更新购物车商品数量
		public function updateNum(){
			$cart=new CartModel();
			
			$username=$_COOKIE['username'];
			$ids=$_POST['id'];
			$nums=$_POST['num'];
			
			foreach($ids as $key=>$value){
				if($nums[$key]<=0){
					$cart->deleteOneCart($username,$value);
				}else{
					$cart->execute("update wq_cart set num=".$nums[$key]." where username='$username' and id=$value");
				}
			}
			
			$this->success('更新购物车成功!');
			$this->redirect('/Cart/index');
		}
		
		
		//提交订单信息
		public function makeOrder(){
			header("content-type:text/html;charset=utf-8");
			$this->checkLogin();
			
			$cart=new CartModel();
			$cartList=$cart->getMyGoods($_COOKIE['username']);
			
			if(empty($cartList)){
				$this->error('购物车中没有商品!');
				exit;
			}
			
			//总价以及购物列表
			$total=0;
			foreach($cartList as $key=>$value){
				$cartList[$key]['total']=$value['shop_price']*$value['num'];
				$total+=$cartList[$key]['total'];
			}
			
			//个人信息
			$user=new UserModel();
			$oneUser=$user->getOneUserById($_SESSION['user_id']);
			
			//生成订单信息
			$data=array();
			$data['uid']=$oneUser['id'];
			$data['reciver']=$oneUser['username'];
			$data['address']=$oneUser['address'];
			$data['mobile']=$oneUser['mobile'];
			$data['email']=$oneUser['email'];
			$data['phone']=$oneUser['phone'];
			$data['ordertime']=date('Y-m-d H:i:s');
			
			//生成订单
			$order=new OrderModel();
			$data['sn']=$order->makeOrderSn();
			
			$lastId=$order->add($data);
			
			if(!$lastId){
				$this->error('提交订单失败!');
				exit;
			}			
			
			//生成订单对应的商品
			$ogood=new OgoodModel();
			
			$odata=array();
			$odata['resn']=$data['sn'];
			$odata['reid']=$lastId;
			
			foreach($cartList as $value){
				$odata['goodid']=$value['reid'];
				$odata['name']=$value['name'];
				$odata['market_price']=$value['market_price'];
				$odata['shop_price']=$value['shop_price'];
				$odata['num']=$value['num'];
				$odata['total']=$value['total'];
				
				if(!$ogood->add($odata)){
					$this->error('提交订单商品失败!');
					exit;
				}
			}
			
			//成功提交订单后清空购物车
			$cart=new CartModel();
			$cart->where("uid=".$_SESSION['user_id'])->delete();
			
			
			$this->success('订单提交成功!');
		}
		
		//商品列表
		public function good(){
			import("ORG.Util.Page");
			
			$good=new GoodModel();
			$gooodSum=$good->count();
			
			$page=new Page($gooodSum,10);		
			$goodList=$good->order('date desc')->limit($page->firstRow.','.$page->listRows)->select();
			
			foreach($goodList as $key=>$value){
				$goodList[$key]['size']=explode(',',$value['size']);
			}
			
			$this->assign('page',$page->show());
			
			$this->assign('goodList',$goodList);
			
			$this->header();
			$this->footer();
			
			$this->display('User:good');
		}
	}
?>