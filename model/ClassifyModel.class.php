<?php
	class ClassifyModel{

		public $mysqli;
		function __construct(){
			$this->mysqli = new mysqli("localhost","root","","zhitunew");
			$this->mysqli->query('set names utf8');
		} 

		public function getClassifyLists(){
			$sql = "select * from classify where pid = 0";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			foreach ($data as $key => $value) {
				$sqlChild = "select * from classify where pid = {$value['id']}";
				$resChild = $this->mysqli->query($sqlChild);
				$child = $resChild->fetch_all(MYSQL_ASSOC);
				$data[$key]['child'] = $child;
			 }

			return $data;
		}

		public function classifyLists(){
			$sql = "select * from classify";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
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
			$data=$res->fetch_all(MYSQL_ASSOC);
			$font=$data[0];
			return $font;
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