<?php
class UserController {
		function add() {
			include "./view/user/add.html";
		}

		function doAdd() {
			$name = $_POST['name'];
			$age  = $_POST['age'];
			$password = $_POST['password'];
			if (empty($name) || empty($age) ||empty($password)) {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '参数错误发布失败，3秒后跳转到lists';
				die();
			}
			$userModel = new UserModel();
			$status = $userModel->addUser($name, $age, $password);
			if ($status) {
				header('Refresh:1,Url=index.php?c=User&a=lists');
				echo '发布成功,1秒后跳转到lists';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=User&a=lsits');
				echo '发布失败,3秒后跳转到lists';
				die();
			}
		}

		function lists(){
			$userModel = new UserModel();
			$data= $userModel->getUserLists();
			include "./view/user/lists.html";
		}

		function delete(){
			$id=$_GET['id'];
			$userModel = new UserModel();
			$status = $userModel->delete($id);
			if($status){
				header('Refresh:1,Url=index.php?c=User&a=lists');
				echo '删除成功,1秒后跳转到lists';
				die();
			}
			else {
				header('Refresh:3,Url=index.php?c=User&a=lsits');
				echo '删除失败,3秒后跳转到lists';
				die();
			}
		}

		function update(){
			$id=$_GET['id'];
			$userModel = new UserModel();
			$font=$userModel->getUserUpdate($id);
			include"./view/user/update.html";
		}

		function doupdate(){
			$id=$_POST['id'];
			$name=$_POST['name'];
			$age=$_POST['age'];
			$password=$_POST['password'];
			if (empty($name) || empty($age) ||empty($password)) {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '参数错误发布失败，3秒后跳转到lists';
				die();
			}
			$userModel=new UserModel();
			$status=$userModel->userUpdate($name,$age,$password,$id);
				if ($status) {
				header('Refresh:1,Url=index.php?c=User&a=lists');
				echo '修改成功,1秒后跳转到lists';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=User&a=lsits');
				echo '修改失败,3秒后跳转到lists';
				die();
			}
		}
		public function setSession() {
			session_start();
			$_SESSION['a'] = '1111';
			$_SESSION['b'] = '222';
			
		}
		public function getSession() {
			var_dump($_SESSION);
		
		}
	}
