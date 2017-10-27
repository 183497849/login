<?php
	class BlogModel{
		public $mysqli;
		public function __construct(){
			$this->mysqli = new mysqli("localhost","root","","zhitunew");
			$this->mysqli->query('set names utf8');
		}

		function addBlog($data){
			$time = date('Y-m-d H:i:s');
			//$sql = "insert into blog(user_id,content,image,classify,title） value ('{$data['user_id']}','{$data['content']}', '{$data['image']}','{$data['classify']}','{$data['title']}',)";
			$sql = "insert into blog(user_id,content,image,title,classify,createtime) value ('{$data['user_id']}','{$data['content']}', '{$data['image']}','{$data['title']}', '{$data['classify']}','{$time}')";
			// var_dump($sql);
			// die();
			$res = $this->mysqli->query($sql);
			return $res;
		}

		function getBlogLists($offset,$limit=20,$where='1'){
			$sql="select * from blog where {$where} limit {$offset},{$limit}";
			// var_dump($sql);
			// die();
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

		function getBlogclassify(){
			$sql = "select * from classify";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}

		function getBlogUpdate($id){
			$sql="select * from blog where id={$id}";
			$res=$this->mysqli->query($sql);
			$data=$res->fetch_all(MYSQL_ASSOC);
			$font=$data[0];
			return $font;
		}

		function blogUpdate($content,$classify,$title,$id){
			$sql="update blog set content='{$content}',classify='{$classify}',title='{$title}' where id={$id}";
			$res=$this->mysqli->query($sql);
			return $res;
		}
	}
