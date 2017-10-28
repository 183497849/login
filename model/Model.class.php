<?php
	class Model{
		public $mysqli;
		public function __construct(){
			$this->mysqli = new mysqli("localhost","root","123456","zhitunew");
			$this->mysqli->query('set names utf8');
		}
	}