<?php
	class BlogModel{
		public $mysqli;
		public function __construct(){
			$this->mysqli = new mysqli("localhost","root","","zhitunew");
			$this->mysqli->query('set names utf8');
		}

		function addBlog($user_id,$content,$image){
			$sql = "insert into blog(content,user_id,image) value ('{$content}', {$user_id},'{$image}')";
			$res = $this->mysqli->query($sql);
			return $res;
		}

		// function getBlogLists(){	
		// 	$sql = "select * from blog";
		// 	$res = $this->mysqli->query($sql);
		// 	$data = $res->fetch_all(MYSQL_ASSOC);
		// 	return $data;
		// }

		function getBlogLists($offset,$limit=20){
			$sql="select * from blog limit {$offset},{$limit}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data;
		}

		function getInfo($id){
			$sql = "select * from blog where id = {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
		function getBlogCount(){
			$sql = "select count(*) as num from blog";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0]['num'];
		}
	}