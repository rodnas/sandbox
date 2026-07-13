<?php
if (!defined('SERVER_ROOT'))
	exit('No direct script access allowed');
/**
 * This file handles the retrieval and serving of news articles
 */
class Page_Controller {
	/**
	 * This is the default function that will be called by router.php
	 */
	private $_pageModel;
	public function __construct() {
		include_once('models/view.php');
		$this->_pageModel = new Page_Model;
	}

	public function main($pageID,$requestArr) {
		$this->_pageModel = new Page_Model;
		
		switch($pageID) {
			case "fooldal":
				$this->mainPage($pageID,'index');
				break;
			case "news":
				$this->news($pageID,$requestArr,'news');
				break;
		}
		
	}
	
	function mainPage($pageID,$template) {
		$content = array();
		$content['items'] = $this->_pageModel->getContentList();
		$content['newsIMG'] = ROOT.'files/news/img/';
		$view = new View_Model($template);
		$view->assign('content' , $content);
	}
	
	function news($pageID,$requestArr,$template) {
		$content = array();
		$content['menuRoot']='/';
		if (ISSET($requestArr[REQUESTARR+1])) {
			$params = explode('-',$requestArr[REQUESTARR+1]);
			$itemID = $params[0];
			$filter = 'id='.$itemID;
			$content['item'] = $this->_pageModel->getOneRecord('dw_news',$filter);
			$content['newsIMG'] = ROOT.'files/news/img/';
		}
		$view = new View_Model($template);
		$view->assign('content' , $content);
	}
	
}
