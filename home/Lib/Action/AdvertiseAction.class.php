<?php
	class AdvertiseAction extends Action {
		//php动态生成js广告调用代码
		public function getAd(){
			header("content-type:text/html;charset=utf-8");
			
			$id=$_GET['id']+0;
			$model=new Model("advertise");
			$oneAd=$model->where("id=$id")->find();
			
			if(empty($oneAd)){
				echo "alert('找不到广告!');";
				exit;
			}
			$linkurl=$oneAd['linkurl'];
			$url=__ROOT__.'/Public/Uploads/'.$oneAd['url'];
			
			echo "document.write(\"<a href='$linkurl'><img src='$url'/></a>\");";
		}
	}
?>