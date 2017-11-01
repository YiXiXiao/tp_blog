<?php 
	class MysqlAction extends CommonAction {
		protected $permission='5';
		protected $db_name='kzl';
		//显示所有的数据表
		public function index(){
			
			$this->checkLogin();
			
			$model=new Model();
			
			$tableList=$model->query("show tables from ".$this->db_name);
			
			foreach($tableList as $key=>$value){
				//表名
				unset($tableList[$key]['Tables_in_'.$this->db_name]);
				$tableList[$key]['name']=$value['Tables_in_'.$this->db_name];
				//记录数
				$countRs=$model->query("select count(*) as num from ".$value['Tables_in_'.$this->db_name]);
				$tableList[$key]['count']=$countRs[0]['num'];
				//表的大小
				$tableStatusRs=$model->query("show table status from $this->db_name like '".$value['Tables_in_'.$this->db_name]."'");
				$tableList[$key]['size']=round($tableStatusRs[0]['Data_length']/1024,2);
				
			}
			
			$this->assign('tableList',$tableList);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('mysql');				
		}
		//备份数据表
		public function bake(){
			header("Content-type:text/html;charset=utf-8");
			
			$this->checkLogin();
			
			$tables=$_POST['tables'];
			
			if(empty($tables)){
				echo "<script type='text/javascript'>alert('请选择要备份的数据表');history.back();</script>";
				exit;
			}
			
			//循环取出数据,将数据信息写入一个字符串
			$sql_str='';
			foreach($tables as $value){
				$sql_str.=$this->getOneTable($value);
			}
			//然后将sql信息写入文件
			$bake_dir='data/';
			if(!file_exists($bake_dir)){
				mk_dir($bake_dir,0777);
			}
			$bake_file='gb_'.date("YmdHis").'_bake.sql';
			
			if(file_put_contents($bake_dir.$bake_file,$sql_str)){
				echo "<script type='text/javascript'>alert('数据库备份成功');</script>";
				$this->redirect('/resShow');
			}else{
				echo "<script type='text/javascript'>alert('数据库备份失败,请联系管理员');history.back();</script>";
				exit;
			}
		}
		//取出一个数据表的具体信息,然后返回
		private function getOneTable($table){
			
			$this->checkLogin();
			
			$model=new Model(str_replace('wq_','',$table));
			
			//数据表结构
			$sql_str='';			
			$sql_str = "DROP TABLE IF EXISTS $table;\n";
			$createtable = $model->query("SHOW CREATE TABLE $table");
			
			$sql_str.= $createtable[0]['Create Table'].";\n\n";	
		
			//数据表数据信息

			$fields=array_slice($model->fields,0,count($model->fields)-2);
			
			
			$info_list=$model->select();
			
			foreach($info_list as $key=>$value){
				$comma = "";
				$sql_str.="insert into $table values(";
				for($i=0;$i<count($fields);$i++){
					$sql_str .= $comma."'".mysql_escape_string($value[$fields[$i]])."'";
					$comma = ",";					
				}
				$sql_str .= ");\n";
			}
			return $sql_str;
		}
		
		//还原数据表显示界面
		public function resShow(){
			header("Content-type:text/html;charset=utf-8");
			
			$this->checkLogin();
			
			$bake_dir='data/';
			
			if(!file_exists($bake_dir)){
				echo "<script type='text/javascript'>alert('备份目录不存在');history.back();</script>";
				exit;
			}			
			
			//取出目录里的文件
			$fileList=array();
			$i=0;
	  		@$dh=opendir($bake_dir);            //打开目录流
		    while(!!$file=@readdir($dh)){
		    	if(is_dir($bake_dir.$file)){
		    		continue;
		    	}
		        if($file!='.' && $file!='..'){
		        	$fileList[$i]['id']=$i+1;
					$fileList[$i]['name']=$file;
					$fileList[$i]['size']=round(filesize($bake_dir.$file)/1024,2);
					$fileList[$i]['mtime']=date('Y-m-d H:i:s',filectime($bake_dir.$file));
					$i++;
		        }
		    }
		    
		    $this->assign('fileList',$fileList);
		    
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('mysql_res');				
		}
		//还原数据库操作
		public function restoreget(){
			header("Content-type:text/html;charset=utf-8");
			
			$this->checkLogin();
			
			$id=$_GET['id'];
			if(!file_exists('data/'.$id)){
				echo "<script type='text/javascript'>alert('备份文件不存在');history.back();</script>";
				exit;
			}
			$sql=file_get_contents('data/'.$id);
			
			$model=new Model();
			$model->execute($sql);
			$this->success('数据库还原成功');
		}
	
		//删除备份sql文件
		public function delete(){
			header("Content-type:text/html;charset=utf-8");
			
			$this->checkLogin();
			
			$id=$_GET['id'];
			
			if(!file_exists('data/'.$id)){
				echo "<script type='text/javascript'>alert('备份文件不存在');history.back();</script>";
				exit;
			}	
			
			if(unlink('data/'.$id)){
				$this->success('数据库删除成功');
			}else{
				$this->error('数据库删除失败');
			}
		}	
		//下载sql备份文件
		public function download(){
			header("Content-type:text/html;charset=utf-8");
			
			$this->checkLogin();
			
			$id=$_GET['id'];
			
			if(!file_exists('data/'.$id)){
				echo "<script type='text/javascript'>alert('文件不存在');history.back();</script>";
				exit;
			}
			header('Content-Disposition:attachment;filename='.$id);
			header('Content-Type: '."sql");
			
			readfile('data/'.$id);		
		}
		//上传SQl处理
		public function restore(){
			header("Content-type:text/html;charset=utf-8");
			
			$this->checkLogin();
			
			if(empty($_FILES['sql']['name'])){
				echo "<script type='text/javascript'>alert('请选择要上传的sql文件');history.back();</script>";
				exit;
			}

			import("ORG.Net.UploadFile");
			$upload = new UploadFile();
			$upload->allowExts  = array('sql');
			$upload->savePath ='./data/Uploads/'; // 设置附件上传目录
			$upload->uploadReplace=true;
			
			if(file_exists($upload->savePath)){
				mk_dir($upload->savePath,0777);
			}

			if(!$upload->upload()) {			
				$this->error($upload->getErrorMsg());		
			}else{		
				$info=$upload->getUploadFileInfo();
			}
			
			$sql=file_get_contents($info[0]['savepath'].$info[0]['savename']);
			
			echo $sql;
			exit;
			
			$model=new Model();
			$model->execute($sql);
			$this->success('数据库导入成功');
		}	
	}
?>