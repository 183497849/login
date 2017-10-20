<?php
	class ClassifyController{
		public function __construct() {
		}

		public function add(){
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
			}
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getClassifyLists();
			include "./view/classify/add.html";
		}

		public function classifyAdd(){
			$classifyModel = new ClassifyModel();
			$data = $classifyModel->classifyLists();
			include "./view/classify/classifyAdd.html";
		}

		public function doAdd() {
			 // var_dump($_POST);
			 // die();
			$name = $_POST['name'];
			$pid = $_POST['pid'];
			$classifyModel = new ClassifyModel();
			$status = $classifyModel->addClassify($name,$pid);
			if($status){
				header('Refresh:1,Url=index.php?c=classify&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			}
		}

		public function lists(){
			$classifyModel = new ClassifyModel();
			$data= $classifyModel->ClassifyLists();
			include "./view/classify/lists.html";
		}

		public function update(){
			$id = $_GET['id'];
			$classifyModel = new ClassifyModel();
			$font=$classifyModel->getclassifyUpdate($id);

			include"./view/classify/update.html";
		}

		public function doUpdate(){
			$id=$_POST['id'];
			$name=$_POST['name'];
			$pid=$_POST['pid'];
			if (empty($name) || $pid==NULL ) {
				header('Refresh:300,Url=index.php?c=classify&a=lists');
				echo '参数错误发布失败，3秒后跳转到lists';
				die();
			}
			$classifyModel=new ClassifyModel();
			$status=$classifyModel->classifyUpdate($name,$pid,$id);
				if ($status) {
				header('Refresh:1,Url=index.php?c=classify&a=lists');
				echo '修改成功,1秒后跳转到lists';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=classify&a=lsits');
				echo '修改失败,3秒后跳转到lists';
				die();
			}
		}

		public	function delete(){
			$id=$_GET['id'];
			$classifyModel = new ClassifyModel();
			$status = $classifyModel->delete($id);
			if($status){
				header('Refresh:1,Url=index.php?c=classify&a=lists');
				echo '删除成功,1秒后跳转到lists';
				die();
			}
			else {
				header('Refresh:3,Url=index.php?c=classify&a=lsits');
				echo '删除失败,3秒后跳转到lists';
				die();
			}
		}
	}