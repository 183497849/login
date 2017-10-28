<?php
	class ClassifyModel extends Model{

		// public $mysqli;
		// function __construct(){
		// 	$this->mysqli = new mysqli("localhost","root","","zhitunew");
		// 	$this->mysqli->query('set names utf8');
		// } 

		public function getClassifyLists($pid=0){
			$sql = "select * from classify where pid = {$pid}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			foreach ($data as $key => $value) {
				$sqlChild = "select * from classify where pid = {$value['id']}";
				$resChild = $this->mysqli->query($sqlChild);
				$child = $resChild->fetch_all(MYSQLI_ASSOC);
				$data[$key]['child'] = $child;
			 }
			 // var_dump($data);
			 // die();
			return $data;
		}

		public function classifyLists(){
			$sql = "select * from classify";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			return $data;
		}
		public function addClassify($name,$pid){
			$sql = "insert into classify(name,pid) value ('{$name}','{$pid}')";	
			$res = $this->mysqli->query($sql);
			return $res;
		}

		public function getclassifyUpdate($id){
			$sql="select * from classify where id={$id}";
			$res=$this->mysqli->query($sql);
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$font=$data[0];
			return $font;
		}

		public function getInfoById($id) {
			$sql = "select * from classify where id = {$id}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQLI_ASSOC);
			return isset($data[0]) ? $data[0] : array();
		}
		function classifyUpdate($name,$pid,$id){
			$sql="update classify set name='{$name}',pid='{$pid}' where id={$id}";
			$res=$this->mysqli->query($sql);
			return $res;
		}

		function delete($id){
			$sql="delete from classify where id= {$id}";
			$res=$this->mysqli->query($sql);
			return $res;
		}
	}