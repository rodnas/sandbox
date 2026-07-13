<?php
if (!defined('SERVER_ROOT'))
	exit('No direct script access allowed');
/**
 * The News Model does the back-end heavy lifting for the News Controller
 */
class Page_Model {
	/**
	 * Holds instance of database connection
	 */
	public $db;
		
	public function __construct() {
		$this->db = new PDO(DATABASETYPE.':host='.DATABASESERVER.';dbname='.DATABASESELECT, DATABASEUSER, DATABASEPASSWORD);
		$setNames=$this->db->prepare(DATABASESETNAMES);
		$setNames->execute();
	}
	
	/**
	 * Fetches article based on supplied name
	 * 
	 * @param string $author
	 * 
	 * @return array $article
	 */

	public function getContent($pageID,$filter="",$order="") {		
		//prepare query
		$sql = "
			SELECT 
				core_content.id,
				core_content.contentName,	
				core_content.contentLabel,
				core_content.contentText,
				core_content.contentHtml,
				core_content.contentImage,
				core_content.contentModalImage,
				core_content.contentFile,
				core_content.contentLink,
				core_content.description,
				core_content.sequenceOrder,
				core_content.insertWhen
			FROM core_content
			LEFT JOIN core_page ON core_page.id = core_content.core_pageID
			WHERE (core_page.name='".$pageID."' OR core_page.id = 1)".$filter."
				AND core_content.core_languageID='HU' AND core_content.core_statusID=1
			".$order."
			";
//echo $sql.'<br>';
		//execute query
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetchAll();
		return $result;
	}
	
	public function getSubContent($pageID,$subID,$filter="",$order="") {		
		//prepare query
		$sql = "
			SELECT 
				core_content.id,
				core_content.contentName,	
				core_content.contentLabel,
				core_content.contentText,
				core_content.contentHtml,
				core_content.contentImage,
				core_content.contentModalImage,
				core_content.contentFile,
				core_content.contentLink,
				core_content.description,
				core_content.sequenceOrder,
				core_content.insertWhen
			FROM core_content
			LEFT JOIN core_page ON core_page.id = core_content.core_pageID
			WHERE (core_page.name='".$pageID."' OR core_page.id = 1) AND core_content.core_contentID=".$subID.$filter."
				AND core_content.core_languageID='HU' AND core_content.core_statusID=1
			".$order."
			";
//echo $sql.'<br>';
		//execute query
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetchAll();
		return $result;
	}

	public function getList($tableName) {		


		$sql = "
			SELECT *
			FROM ".$tableName." 
			WHERE core_statusID=1
			";
		//execute query
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetchAll();
		return $result;
	}

	public function getOneRecord($tableName,$filter) {		
		//prepare query
		$sql = "
			SELECT *
			FROM ".$tableName." 
			WHERE core_statusID=1 AND ".$filter."
			";
//echo $sql.'<br>';
		//execute query
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetch();
		return $result;
	}

	public function updateRecord($table,$fields,$data,$key) {
		$sql = "UPDATE ".$table." SET ";
		$fieldsArray = explode(",",$fields);
		foreach ($fieldsArray as $fieldKey=>$fieldTemp) {
			switch(trim($fieldTemp)) {
				case "modifyWhen":
					$sql .= trim($fieldTemp)."='".date('Y-m-d H:i:s',TIME())."', ";
					break;
				case "password":
					if (isset($data[trim($fieldTemp)])  && !empty($data[trim($fieldTemp)])) {
						$sql .= trim($fieldTemp)."='".md5($data[trim($fieldTemp)])."', ";
					}
					break;
				default:
					if (isset($data[trim($fieldTemp)])) {
						$sql .= trim($fieldTemp)."='".$data[trim($fieldTemp)]."', ";
					}
			}
		}
		$sql = substr($sql,0,strlen($sql)-2);
		$sql .= " WHERE ".$key;
//echo $sql.'<br>';
		//execute query
		$home=$this->db->prepare($sql);
		$result=$home->execute();
		return $result;
	}

	public function insertRecord($table,$fields,$data) {
		$fieldsArray = explode(",",$fields);
		$fieldList = "";
		$valueList = "";
		foreach ($fieldsArray as $fieldKey=>$fieldTemp) {
			switch(trim($fieldTemp)) {
				case "insertWhen":
					$fieldList .= trim($fieldTemp).", ";
					$valueList .="'".date('Y-m-d H:i:s',TIME())."', ";
					break;
				case "regWhen":
					$fieldList .= trim($fieldTemp).", ";
					$valueList .="'".date('Y-m-d H:i:s',TIME())."', ";
					break;
				case "password":
					if (isset($data[trim($fieldTemp)])) {
						$fieldList .= trim($fieldTemp).", ";
						$valueList .="'".md5(trim($data[trim($fieldTemp)]))."', ";
					}
					break;
				default:
					if (isset($data[trim($fieldTemp)])) {
						$fieldList .= trim($fieldTemp).", ";
						$valueList .= "'".$data[trim($fieldTemp)]."', ";
					}
			}
		}
		$fieldList = substr($fieldList,0,strlen($fieldList)-2);
		$valueList = substr($valueList,0,strlen($valueList)-2);
		$sql = "INSERT INTO ".$table." (".$fieldList.") VALUES (".$valueList.")";
//echo $sql."<br>";		
		//execute query
		$home=$this->db->prepare($sql);
		$result=$home->execute();
		return $result;
	}
	
	public function lastInsertID() {
		return mysql_insert_id();
	}

	public function addWriteUs($toWho,$name,$email,$message,$subject) {
		//prepare query
		$sql = "
			INSERT INTO writeus
			(toWho,name,email,subject,message) VALUES
			('".$toWho."','".$name."','".$email."','".$subject."','".$message."')
			";
		//execute query
		$home=$this->db->prepare($sql);
		$result=$home->execute();
		return $result;
	}

}
