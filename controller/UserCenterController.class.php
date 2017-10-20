<?php
	class UserCenterController{
		public function login(){
			include "./view/usercenter/login.html";
		}
		
		public function doLogin(){
			$name=$_POST['name'];
			$password=$_POST['password'];
			$verifyCode = $_POST['verify']; 
			$userModel=new UserModel();
			if($verifyCode!=$_SESSION['verifyCode']){
				header('Refresh:3,Url=index.php?c=UserCenter&a=login');
				echo '验证码错误，登录不成功';
				die();	
			}
			if (empty($name) || empty($password) || empty($verifyCode)) {
				header('Refresh:300,Url=index.php?c=UserCenter&a=reg');
				echo '注册不成功';
				die();
			}
			$userInfo=$userModel->getUserInfoByName($name);
			if($password==$userInfo['password']){
				unset($userInfo['password']);
				$_SESSION['me'] = $userInfo;
				header('Refresh:3,Url=index.php?c=Blog&a=lists');
				echo '登录成功';
				die();
			}else {
				header('Refresh:3,Url=index.php?c=UserCenter&a=login');
				echo '登录不成功';
				die();
			}
		}

		public function logout () {
			unset($_SESSION['me']);
			header('Refresh:3,Url=index.php?c=Blog&a=lists');
			echo '退出登录成功';
			die();
		}	

		function reg(){
			include "./view/usercenter/reg.html";
		}
		function doReg(){
			$name=$_POST['name'];
			$age=$_POST['age'];
			$password=$_POST['password'];
			// include "./library./Upload.class.php";
			// $upload = new Upload();
			$upload = L("Upload");
			$filename = $upload->run('photo');
			if (empty($name) || empty($password)) {
				header('Refresh:300,Url=index.php?c=UserCenter&a=reg');
				echo '注册不成功';
				die();
			}
			$userModel=new UserModel();
			$userInfo=$userModel->getUserInfoByName($name);
			if(!empty($userInfo)){
				header('Refresh:300,Url=index.php?c=UserCenter&a=reg');
				echo '名字重复，注册不成功';
				die();
			}
			$status=$userModel->addUser($name,$age,$password,$filename);

			if ($status) {
				header('Refresh:1,Url=index.php?c=UserCenter&a=login');
				echo '注册成功，1秒后跳转到login';
				die();
			} else {
				header('Refresh:300,Url=index.php?c=UserCenter&a=reg');
				echo '注册失败，3秒后跳转到reg';
				die();
			}
		}

		public function verifyCOde(){
			header("Content-Type:image/png");
			$img = imagecreate(50,25);//生成一个画布
			$back = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);//背景
			$red = imagecolorallocate($img, 255, 0, 0);

			$str = getRandom(4) ;

			$_SESSION['verifyCode'] = $str;
			imagestring($img, 5, 7, 10, $str, $red);
			imagepng($img);
			imagedestroy($img);
		}
	}