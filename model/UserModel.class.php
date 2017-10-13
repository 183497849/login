<?php
	class UserModel{
		public $mysqli;
		public function __construct(){
			$this->mysqli = new mysqli("localhost","root","","zhitunew");
		}
		public function addUser($name,$age,$password){
			$sql="insert into user (name,age,password) value ('{$name}','{$age}','{$password}')";
			$res=$this->mysqli->query($sql);
			return $res;
		}
		
		function getUserLists(){
			$sql="select * from user";
			$res=$this->mysqli->query($sql);
			$data=$res->fetch_all(MYSQL_ASSOC);
			return $data;
		}

		function delete($id){
			$sql="delete from user where id= {$id}";
			$res=$this->mysqli->query($sql);
			return $res;
		}

		function getUserUpdate($id){
			$sql="select * from user where id={$id}";
			$res=$this->mysqli->query($sql);
			$data=$res->fetch_all(MYSQL_ASSOC);
			$font=$data[0];
			return $font;
		}
		
		function userUpdate($name,$age,$password,$id){
			$sql="update user set name='{$name}',age={$age},password='{$password}' where id={$id}";
			$res=$this->mysqli->query($sql);
			return $res;
		}

		function getUserInfoByName($name) {
			$sql = "select * from user where name = '{$name}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
		function getUserInfoById($id) {
			$sql = "select * from user where id = {$id}";
			
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
		
	 }