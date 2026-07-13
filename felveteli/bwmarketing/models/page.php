<?php
if (!defined('SERVER_ROOT'))
	exit('No direct script access allowed');
class Page_Model {
	public $db;
		
	public function __construct() {
		$this->db = new PDO(DATABASETYPE.':host='.DATABASESERVER.';dbname='.DATABASESELECT, DATABASEUSER, DATABASEPASSWORD);
		$setNames=$this->db->prepare(DATABASESETNAMES);
		$setNames->execute();
	}
	
	public function addScore($name,$birthWhen,$email,$score) {
		$sql = "
			INSERT INTO score
			(name,birthWhen,email,score) VALUES
			('".$name."','".$birthWhen."','".$email."','".$score."')
			";
		$home=$this->db->prepare($sql);
		$result=$home->execute();
		return $result;
	}

	public function getScoreList() {		
		$sql = "
			SELECT *
			FROM score
			ORDER BY name ASC
			";
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetchAll();
		return $result;
	}

	public function getScoreMin() {		
		$sql = "
			SELECT MIN(score) AS scoreMin
			FROM score
			ORDER BY name ASC
			";
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetch();
		return $result;
	}

	public function getScoreMax() {		
		$sql = "
			SELECT MAX(score) AS scoreMax
			FROM score
			ORDER BY name ASC
			";
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetch();
		return $result;
	}

	public function getScoreAvg() {		
		$sql = "
			SELECT CAST(AVG(score) AS decimal(7,5)) as scoreAvg
			FROM score
			ORDER BY name ASC
			";
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetch();
		return $result;
	}

}
