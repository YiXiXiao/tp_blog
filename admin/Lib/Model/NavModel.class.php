<?php
	class NavModel extends Model {
		//自动填充 
		protected $_auto=array(
			array('date','getCTime','1','callback')
		);
		//自动验证
		protected $_validate=array(	
			array('name','require','请填写栏目名称!'),
			array('name','2,20','栏目名称长度不符合要求!',0,'length'),
			array('keywords','0,100','关键词描述过长!',2,'length'),
			array('intro','0,250','栏目简介过长!',2,'length'),
		);
		
		//获取栏目新增时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}		
		//获取所有栏目
		public function getAllNav(){
			return $this->select();
		}
		//根据栏目模型选取栏目
		public function getAllNavByModel($model){
			if(isset($model)){
				return $this->where("model=$model")->select();
			}else{
				return $this->select();
			}
		}
		//获得栏目家谱树
		public function getNavTree($navlist,$id=0,$level=0){
			$tree=array();
			if(!empty($navlist)){
				foreach($navlist as $value){
					if($value['reid']==$id){
						$value['level']=$level;
						array_push($tree,$value);
						$tree=array_merge($tree,$this->getNavTree($navlist,$value['id'],$level+1));
					}
				}
			}
			return $tree;
		}
		//根据id查找栏目是否存在
		public function getOneNav($id){
			$id=$id+0;
			if(!is_numeric($id)){
				return false;
			}
			return $this->where("id=$id")->find();	
		}
		//根据栏目reid查找其上级家谱树
		public function getFamily($navlist,$id=0,$level=0){
			$tree=array();
			foreach($navlist as $value){
				if($value['id']==$id && $id>0){
					$value['level']=$level;
					array_push($tree,$value);
					$tree=array_merge($tree,$this->getFamily($navlist,$value['reid'],$level+1));
				}
			}
			return $tree;
		}
		//根据栏目id查询其所有的子孙栏目
		public function getSonsById($navlist,$id,$level=0){
			$tree=array();	
			foreach($navlist as $value){			
				if($value['reid']==$id){
					$value['level']=$level;
					array_push($tree,$value);
					$tree=array_merge($tree,$this->getSonsById($navlist,$value['id'],$level+1));
				}
			}		
			return $tree;
		}		
		//根据id查找一栏目的子栏目
		public function getSons($id){
			return $this->where("reid=$id")->select();
		}		
	}
?>























