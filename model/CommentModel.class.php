<?php
	class CommentModel extends Model{
		// public $mysqli;
		// function __construct() {
		// 	$this->mysqli = new mysqli("localhost","root","","zhitunew");
		// 	$this->mysqli->query('set names utf8');
		// }

		public function add($blog_id,$user_id, $pid=0,$content='') {
			$date = date('Y-m-d H:i:s');
			$sql = "insert into comment(blog_id, pid,user_id,content,createtime) values ('{$blog_id}', {$pid}, {$user_id}, '{$content}','{$date}')";
			// var_dump($sql);
			// die();
			return $this->mysqli->query($sql);
		}
		
		public function getLists($offset=0, $limit=20,$order='id asc',$where='1') {
			$sql = "select * from comment where {$where} order by {$order} limit {$offset},{$limit}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			return $data;
		}

		public function getCount ($where='1') {
			$sql = "select count(*) as num from comment where {$where}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			return isset($data[0]['num']) ? $data[0]['num'] : 0;
		}

	}