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

	public function getContentList() {		
		//prepare query
		$sql = "SELECT * FROM dw_news WHERE active = 1";
		//execute query
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetchAll();
		return $result;
	}
	
	public function getOneRecord($tableName,$filter) {		
		//prepare query
		$sql = "SELECT * FROM ".$tableName." WHERE active=1 AND ".$filter."
			";
		//execute query
		$home=$this->db->prepare($sql);
		$home->execute();
		$result = $home->fetch();
		return $result;
	}

}
