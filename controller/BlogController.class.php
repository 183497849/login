<?php
	class BlogController{
		function add(){
			if(!isset($_SESSION['me'])||$_SESSION['me']['id']<=0){
				header('Location:index.php?c=UserCenter&a=login');
				echo "请登录";
				die();
			}
			include "./view/blog/add.html";	
		}

		function doAdd(){
			$content=$_POST['content'];
			$user_id=$_SESSION['me']['id'];
			$upload = L("Upload");
			$filename = $upload->run('photo');
			$blogModle=new BlogModel();
			//$image = $filename;
			$status=$blogModle->addBlog($user_id,$content,$filename);
			if($status){
				header('Location:index.php?c=Blog&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			}
		}

		function lists(){
			$blogModel = new BlogModel();
			$userModel = new UserModel();

			$p = isset($_GET['p']) ? $_GET['p'] : 1;
			$pageNum = 10;
			$offset = ($p-1)*$pageNum;
			$count = $blogModel->getBlogCount();
			$allPage = ceil($count/$pageNum);

			$data = $blogModel->getBlogLists($offset,$pageNum);
			foreach ($data as $key => $value) {
				$user_info = $userModel->getUserInfoById($value['user_id']);
				$data[$key]['user_name'] = $user_info['name'];	
			}
			include "./view/blog/lists.html";
		}	
		
		function info(){
			$id=$_GET['id'];
			$blogModle=new BlogModel();
			$data=$blogModle->getInfo($id);
			$a=$data['content'];
			$image = $data['image'];
			include "./view/user/info.html";
		}

			public function image(){
			include "./view/blog/image.html";
		}

		public function doImage(){
			$upload = L("Upload");
			$filename = $upload->run('photo');
			echo $filename;
			//echo $upload->returnSize();
		}
	}