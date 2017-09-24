<?php
	class BlogController{
		function add(){
			if(!isset($_SESSION['me'])||$_SESSION['me']['id']<=0){
				header('Location:index.php?c=UserCenter&a=login');
				die();
			}
			include "./view/blog/add.html";
			
		}

		function doAdd(){
			$content=$_POST['content'];
			$user_id=$_SESSION['me']['id'];
			$blogModle=new BlogModel();
			$status=$blogModle->addBlog($user_id,$content);
			if($status){
				header('Location:index.php?c=Blog&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			}
		}

		function lists(){
			$blogModel = new BlogModel();
			$userModel = new UserModel();
			$data = $blogModel->getBlogLists();
			foreach ($data as $key => $value) {
				$user_info = $userModel->getUserInfoById($value['user_id']);
				$data[$key]['user_name'] = $user_info['name'];	
			}
			include "./view/blog/lists.html";
		}	
	}