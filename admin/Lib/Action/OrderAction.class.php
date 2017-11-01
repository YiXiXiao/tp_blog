<?php
	class OrderAction extends CommonAction {
		protected $page='';
		
		//显示订单列表
		public function index(){
			
			$this->checkLogin();
			
			//获取所有订单列表（分页）
			$orderList=$this->getPageOrderList();
			//处理订单状态,发货状态的显示问题
			foreach($orderList as $key=>$value){
				$orderList[$key]['state']=$value['state']=='0'? '<span style="color:red;">未发货</span>':'<span style="color:green;">已发货</span>';
				$orderList[$key]['is_delete']=$value['is_delete']=='0'? '<span style="color:green;">正常</span>':'<span style="color:red;">已被取消</span>';
			}
			$this->assign('orderList',$orderList);
			
			
			//获取分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('order');			
		}
		//分页处理
		public function getPageOrderList($pagesize=5){
			
			$order=new OrderModel();
			$orderSum=$order->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($orderSum,$pagesize);
			
			return $order->order('ordertime desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}	
		//给一条订单发货
		public function modifyOrderState(){
			
			$this->checkLogin();
			
			$id=$_GET['id'];
			$order=new OrderModel();
			
			$oneOrder=$order->getOneOrder($id);
			if(!is_array($oneOrder)){
				$this->error('找不到该订单信息');
			}
			
			//将订单state设置为1为已经发货状态
			if($order->modifyOrderState($id)){
				$this->success('发货成功');
			}else{
				$this->error('发货失败,请联系管理员');
			}
		}
		//查看订单详情
		public function showDetail(){
			
			$this->checkLogin();
			
			$id=$_GET['id'];
			$order=new OrderModel();
			
			$oneOrder=$order->getOneOrder($id);
			if(!is_array($oneOrder)){
				$this->error('找不到该订单信息');
			}			
			//处理订单状态的显示,发货状态的显示
			$oneOrder['state']=$oneOrder['state']=='0'? '未发货':'已发货';
			$oneOrder['is_delete']=$oneOrder['is_delete']=='0'? '正常':'已被取消';
			$this->assign('oneOrder',$oneOrder);
			
			//查询该订单下的所购商品
			$ogood=new OgoodModel();
			$ogoodList=$ogood->getGoodsByOrderId($oneOrder['id']);
			
			$total=0;
			
			foreach($ogoodList as $key=>$value){
				$total+=$value['total'];
			}
			
			$this->assign('total',$total);
			$this->assign('ogoodList',$ogoodList);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('order_edit');				
		}
		//删除一条订单
		public function delete(){
			
			$this->checkLogin();
			
			$id=$_GET['id'];
			$order=new OrderModel();
			
			$oneOrder=$order->getOneOrder($id);
			if(!is_array($oneOrder)){
				$this->error('找不到该订单信息');
			}
			
			//将订单删除
			if($order->where("id=$id")->delete()){
				$this->success('订单删除成功');
			}else{
				$this->error('订单删除失败,请联系管理员');
			}		
		}
	
		
	}
?>