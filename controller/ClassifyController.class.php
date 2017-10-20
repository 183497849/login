<?php
	class ClassifyController{
		public function __construct() {
		}

		public function add(){
			if (!isset($_SESSION['me']) || $_SESSION['me']['id'] <=0) {
				header('Location:index.php?c=UserCenter&a=login');
			}
			$classifyController = new ClassifyModel();
			$classify = $classifyController->getLists();
			include "./view/classify/add.html";
		}
		public function doAdd() {
			var_dump($_POST);
		}
	}