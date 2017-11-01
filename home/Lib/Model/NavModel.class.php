<?php
	class NavModel extends Model {
		protected $_auto=array(
			array('date','getCTime','1','callback')
		);
		//获取栏目新增时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}		
		//获取菜单导航
		public function getAllNav($limit){
			if(!isset($limit)||empty($limit)){
				return $this->where("menu=1")->order("sort asc")->select();
			}else{
				return $this->limit("0,$limit")->where("menu=1")->order("sort asc")->select();
			}
		}
		public function getAllNav2(){
			return $this->order("sort asc")->select();
		}
		//根据栏目模型选取栏目
		public function getAllNavByModel($model){
			return $this->where("model=$model")->select();
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
			return $this->where("id=$id")->find();
		}
		//根据栏目id查找其上级家谱树
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
		public function getSons($id,$limit){
			if(isset($limit)&&$limit!=''){
				return $this->where("reid=$id")->limit("0,$limit")->select();
			}else{
				return $this->where("reid=$id")->select();
			}			
		}	
		//获取头部导航主栏目
		public function getMainNav($limit){
			return $this->where("reid=0")->limit("0,$limit")->select();
		}
		//根据栏目id查询其子孙栏目id
		public function getNavIdStr($id){
			$idArr=array();
			
			//当前栏目
			$oneNav=$this->getOneNav2($id);
			//子孙栏目
			$navSons=$this->getSonsById($this->getAllNav2(),$id);		

			
			if(!empty($navSons)){
				$oneNav=array_merge($navSons,$oneNav);
			}
			
			foreach($oneNav as $value){
				array_push($idArr,$value['id']);
			}
			return implode(',',$idArr);
		}
		//根据id查找栏目是否存在(以二维数组形式返回)
		public function getOneNav2($id){
			$id=$id+0;
			if(!is_numeric($id)){
				return false;
			}
			return $this->where("id=$id")->select();	
		}
		//根据id找到一栏目的同级栏目
		public function getLevelNav($id){
			return $this->where("reid=$id")->select();
		}
		
		//根据栏目的id字符串查找栏目
		public function getSomeNav($idStr){
			return $this->where("id in ($idStr)")->select();
		}
	}
?>