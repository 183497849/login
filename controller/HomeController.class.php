<?php
	class HomeController{
		public function index(){
			$blogModel = new BlogModel();
			$data = $blogModel->getBlogLists(0,30);
			foreach ($data as $key => $value) {	
				$data[$key]['year'] = substr($value['createtime'], 0,4);
				$data[$key]['month'] = substr($value['createtime'], 5,5);
			}
		
			include "./view/home/index.html";
		}

		public function info(){
			$blogModel = new BlogModel();
			$commentModel = new CommentModel();
			$userModel = new UserModel();
			$id = $_GET['id'];
			$info = $blogModel->getInfo($id);
			$info['year'] = substr($info['createtime'], 0,10);
			// var_dump($info);
			// die();
			
			$where = " classify_id = {$info['classify_id']} and id != {$id}";
			$data = $blogModel->getBlogLists(0,30,$where);
			//  var_dump($data);
			// die();

			$commentWhere = "blog_id = {$id}";
			$commentLists = $commentModel->getLists(0, 20,'id asc', $commentWhere);
			//  var_dump($commentLists);
			// die();
			foreach($commentLists as $key=>$comment) {
				$userInfo = $userModel->getUserInfoById($comment['user_id']);
				$commentLists[$key]['author'] = $userInfo;
			}

			$commentCount = $commentModel->getCount($commentWhere);


			include "./view/user/info.html";
		}

		public function doComment(){
			$blog_id = $_POST['blog_id'];
			$content = $_POST['content'];
			$user_id = $_SESSION['me']['id'];
			$pid  = isset($_POST['pid']) ? $_POST['pid'] : 0;
			$commentModel = new CommentModel();
			$status = $commentModel->add($blog_id, $user_id, $pid, $content);
			if ($status) {
				header('Location:index.php?c=Home&a=Info&id='.$blog_id);
				echo '评论成功，1秒后跳转到list';
			}

		}

		public function study(){

			$classify_id = $_GET['classify_id'];
			$where = '1';
			if ($classify_id) {
				$where .= " and classify_id in ({$classify_id})";
			} else {
				$where .= " and classify_id in (4,5,6)";
			}

			$classifyModel = new ClassifyModel();
			$blogModel = new BlogModel();
			$lists = $blogModel->getBlogLists(0,30,$where);
			// var_dump($lists);
			// die();
			foreach ($lists as $key => $value) {
				$lists[$key]['year'] = substr($value['createtime'],0,4);
				$lists[$key]['month'] = substr($value['createtime'], 5, 5);
				$classify = $classifyModel->getInfoById($value['classify_id']);
				$lists[$key]['classify_name'] = $classify['name']; 
			}
			$classify = $classifyModel->getClassifyLists(2);
			// var_dump($classify);
			// die();
			include "./view/home/study.html";
		}

	}