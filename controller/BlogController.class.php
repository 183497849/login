<?php
	class BlogController{
		function add(){
			if(!isset($_SESSION['me'])||$_SESSION['me']['id']<=0){
				header('Location:index.php?c=UserCenter&a=login');
				echo "请登录";
				die();
			}
			$classifyModel = new ClassifyModel();
			$classify = $classifyModel->getClassifyLists();
			include "./view/blog/add.html";	
		}

		function doAdd(){
			$content=$_POST['content'];
			$user_id=$_SESSION['me']['id'];
			$upload = L("Upload");
			$filename = $upload->run('photo');
			$classify = $_POST['classify'];
			$title = $_POST['title'];
			$data = array(
				'user_id' 	=> $user_id,
				'content' 	=> $content,				
				'image' 	=> $filename,
				'classify' 	=> $classify,
				'title' 	=> $title,
				);
			$blogModle=new BlogModel();
			$status=$blogModle->addBlog($data);
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
			$pageNum = 4;
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
		}

		public function update(){
			$id = $_GET['id'];
			$blogModel = new BlogModel();
			$font=$blogModel->getBlogUpdate($id);
			include"./view/blog/update.html";
		}

		public function doupdate(){
			$id=$_POST['id'];
			$content=$_POST['content'];
			$classify=$_POST['classify'];
			$title=$_POST['title'];
			if (empty($content) || empty($classify) ||empty($title)) {
				header('Refresh:3,Url=index.php?c=Blog&a=lists');
				echo '参数错误发布失败，3秒后跳转到lists';
				die();
			}
			$blogModel=new BlogModel();
			$status=$blogModel->blogUpdate($content,$classify,$title,$id);
				if ($status) {
				header('Refresh:1,Url=index.php?c=Blog&a=lists');
				echo '修改成功,1秒后跳转到lists';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=Blog&a=lsits');
				echo '修改失败,3秒后跳转到lists';
				die();
			}
		}
	}