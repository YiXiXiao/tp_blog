<?php 
	class NavAction extends CommonAction {
		//显示分类列表
		public function index(){
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			load("extend");
			
			//选取所有分类并排序
			$nav=new NavModel();
			$navList=$nav->getAllNav();
			$navList=$nav->getNavTree($navList);
			foreach($navList as $key=>$value){
				if(mb_strlen($value['intro'],'utf-8')>15){
					$navList[$key]['intro']=mb_substr($value['intro'],0,15,'utf-8').'...';
				}
			}
			$this->assign('navList',$navList);

			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('nav');
		}
		//新增分类界面
		public function addShow(){
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			//选取所有分类并排序
			$nav=new NavModel();
			$navList=$nav->getAllNav();
			$navList=$nav->getNavTree($navList);
			$this->assign('navList',$navList);

			$sort=$nav->count();
			$this->assign('sort',$sort+1);
			
			$files_tpl=$this->getFiles(__ROOT__.'home/Tpl/default/Public');
			$this->assign('files_tpl',$files_tpl);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('nav_add');		
		}
		
		//栏目权限检测
		private function checkNavPermission($id,$info){
			
			$username=$this->checkLogin();
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			
			//检测是否为超级管理员,不是就进行权限判断
			if($oneAdmin['level']!='1'){
				if($id=='0'){
					if($oneAdmin['level']!='1'){
						$this->error('您的权限不足,不能'.$info.'顶级栏目!');
					}
				}else{
					$permissionArr=$admin->getFormatUser($oneAdmin);
					
					if(!in_array($id,$permissionArr)){
						$this->error("您的权限不足,不能".$info."二级栏目");
					}
				}
			}
		}
		
		//新增分类处理操作
		public function add(){
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$username=$this->checkLogin();
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);

			$nav=new NavModel();
			
			//创建数据对象
			if(!$nav->create()){
				$this->error($nav->getError());
			}
			
			if($nav->add()){
				$this->success('新增分类成功!');
			}else{
				$this->error('新增分类失败,请联系管理员!');
			}
		}
		//分类修改显示界面
		public function show(){
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$id=$_GET['id']+0;
			
			//查找分类信息
			$nav=new NavModel();
			$oneNav=$nav->getOneNav($id);
			
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//是否单文档分类,如果是载入编辑器
			if($oneNav['single']=='1'){
				$this->assign('showState','block');
			}else{
				$this->assign('showState','none');
			}
					
			$this->assign('oneNav',$oneNav);
			
			//载入模板文件
			$files_tpl=$this->getFiles(__ROOT__.'home/Tpl/default/Public');
			$this->assign('files_tpl',$files_tpl);
			
			//分类家谱树
			$navList=$nav->getAllNav();
			$navList=$nav->getNavTree($navList);
			$this->assign('navList',$navList);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('nav_edit');		
		}
		//分类修改处理
		public function modify(){
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$id=$_POST['id']+0;
			
			//查找分类信息
			$nav=new NavModel();
			$oneNav=$nav->getOneNav($id);
			
			//修改前的检测
			$nav=new NavModel();
			$reid=$_POST['reid']+0;
			
			//检测是否是修改为旗下子分类的行为
			if($reid!=0){
				$oneNav=$nav->getOneNav($reid);
				if(!empty($oneNav)){
					$navList=$nav->getAllNav();
					$family=$nav->getFamily($navList,$oneNav['reid']);
					
					if(!empty($family)){
						foreach($family as $value){
							if($value['id']==$_POST['id']){
								$this->error('顶级分类不能修改成为其子分类的下级!');
							}
						}
					}			
				}else{
					$this->error('找不到该分类!');
				}		
			}
			
			//分类修改处理
			if(!$nav->create()){
				$this->error($nav->getError());
			}
			
			if($nav->save()){
				$this->success('分类修改成功!');
			}else{
				$this->error('分类修改失败,请联系管理员!');
			}			
		}
		//删除分类操作
		public function delete(){
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$id=$_GET['id']+0;
			
			$nav=new NavModel();
			$oneNav=$nav->getOneNav($id);
			if(!empty($oneNav)){
				$sons=$nav->getSons($id);
				if(!empty($sons)){
					$this->error('不能直接删除顶级分类!');
				}else{
			
					if($nav->where("id=$id")->delete()){
						$this->success('分类删除成功!');
					}else{
						$this->error('分类删除失败,请联系管理员!');
					}
				}
			}else{
				$this->error('找不到该分类!');
			}		
		}	
		
		//分类排序
		public function sortAct(){
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$ids=$_POST['id'];
			$sorts=$_POST['sort'];
			
			$model=new Model();
			
			foreach($sorts as $key=>$value){
				$id=$ids[$key];
				$sort=$sorts[$key];
				
				$model->query("update wq_nav set sort=$sort where id=$id");
			}
			
			$this->success('排序成功!');
		}
		
		//私有函数返回指定目录中的文件(以数组形式返回)
		private function getFiles($dir){

			$fh=opendir($dir);
			
			$arr=array();
			while($file=readdir($fh)){
				if($file!='.'&& $file!='..'&& !is_dir($file)){
					$arr[]=$file;
				}
			}
			fclose($fh);
			return $arr;
		}
	}
?>