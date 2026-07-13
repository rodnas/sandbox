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
		
		$contentText = $this->_pageModel->getContent($pageID," AND core_content.core_content_typeID IS NULL","ORDER BY core_content.id ASC");
		$content = $this->makeContent($contentText);

		$content['month'][1]='Január';
		$content['month'][2]='Február';
		$content['month'][3]='Március';
		$content['month'][4]='Április';
		$content['month'][5]='Május';
		$content['month'][6]='Június';
		$content['month'][7]='Július';
		$content['month'][8]='Augusztus';
		$content['month'][9]='Szeptember';
		$content['month'][10]='Október';
		$content['month'][11]='November';
		$content['month'][12]='December';
		$content += array('success' => 0); 
		$content['pageActual']=$pageID;
		switch($pageID) {
			case "fooldal":
				$this->mainPage($content,$pageID,'index');
				break;
			case "markak":
				$this->brand($content,$pageID,$requestArr,'markak');
				break;
		}
		
	}
	
	function mainPage($content,$pageID,$template) {
		$content['menuRoot']='';
		$content['topSlidesUrlIMG'] = ROOT.'content/image/';
		$content['urlModalIMG'] = ROOT.'content/image/modal/';
		$content['topSlider'] = $this->_pageModel->getContent($pageID,' AND core_content.core_content_typeID=1 AND contentName="topSlider"',"ORDER BY core_content.id ASC");
		$content['serviceSlider'] = $this->_pageModel->getContent($pageID,' AND core_content.core_content_typeID=1 AND contentName="serviceSlider"',"ORDER BY core_content.id ASC");
		$content['memberSlider'] = $this->_pageModel->getContent($pageID,' AND core_content.core_content_typeID=1 AND contentName="memberSlider"',"ORDER BY core_content.id ASC");
		$content['partnerSlider'] = $this->_pageModel->getContent($pageID,' AND core_content.core_content_typeID=1 AND contentName="partnerSlider"',"ORDER BY core_content.id ASC");
		$content['newsSlider'] = $this->_pageModel->getContent($pageID,' AND core_content.core_content_typeID=1 AND contentName="newsSlider"',"ORDER BY core_content.id DESC");
		$content['brandsSlider'] = $this->_pageModel->getContent($pageID,' AND core_content.core_content_typeID=1 AND contentName="brandsSlider"',"ORDER BY core_content.id ASC");
		foreach ($content['brandsSlider'] as $key=>$temp) {
			$content['brandsSlider'][$key]['brandsLink'] = $this->generatePermaLink($temp['contentName'],$temp['id']);
		}

		$content = $this->writeUsEmail($content);

		$view = new View_Model($template);
		$view->assign('content' , $content);
	}
	
	function brand($content,$pageID,$requestArr,$template) {
		$content['menuRoot']='/';
		if (ISSET($requestArr[REQUESTARR+1])) {
			$params = explode('-',$requestArr[REQUESTARR+1]);
			$itemID = $params[0];
			$filter = 'id='.$itemID;
			$core_content = $this->_pageModel->getOneRecord('core_content',$filter);
			$content['mainContentLabel']=$core_content['contentLabel'];
			$content['subGalleryUrlIMG'] = ROOT.'content/image/';
			$content['brandGallery'] = $this->_pageModel->getSubContent($pageID,$itemID,' AND core_content.core_content_typeID=2 AND core_content.contentName="brandGallery"','ORDER BY core_content.id ASC');
		}
		$view = new View_Model($template);
		$view->assign('content' , $content);
	}
	
	function emailValidator( $email, $chFail = false ) {
		$msgs = Array(); $msgs[] = 'Received email address: '.$email;
		if( !preg_match( "/^(([^<>()[\]\\\\.,;:\s@\"]+(\.[^<>()[\]\\\\.,;:\s@\"]+)*)|(\"([^\"\\\\\r]|(\\\\[\w\W]))*\"))@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([a-z\-0-9��������������o�]+\.)+[a-z]{2,}))$/i", $email ) )
			{
		        $msgs[] = 'Email address was not recognised as a valid email pattern';
		        return $chFail ? Array( false, $msgs ) : false;
			}
		$msgs[] = 'Email address was recognised as a valid email pattern';
		//get the mx host name
		if( preg_match( "/@\[[\d.]*\]$/", $email ) )
			{
			$mxHost[0] = preg_replace( "/[\w\W]*@\[([\d.]+)\]$/", "$1", $email );
			$msgs[] = 'Email address contained IP address '.$mxHost[0].' - no need for MX lookup';
			}
		else
			{
			//get all mx servers - if no MX records, assume domain is MX (SMTP RFC)
			}
		$msgs[] = 'Could not establish SMTP session with any MX servers';
		return $chFail ? Array( true, $msgs ) : true;
	}

	public function generatePermaLink($fieldText,$fieldId) {

		$title = trim($fieldText);

		// gyakori spec karakterek ' " &
		$title = str_replace('"', '', $title);
		$title = str_replace("'", '', $title);
		$title = str_replace('&', ' n ', $title);

		// karakterek szűrése
		$link = preg_replace('/[^0-9 a-z á é í óöő úüű _ -]/', '', $title);

		// ékezetek
		$search = Array('á', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű', ' ', '_');
		$replace = Array('a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', '-', '-');
		$link = str_replace($search, $replace, $link);
		$result=$fieldId.'-'.$link;
		return $result;
	}

	public function formError($content,$insertData,$preChar='') {
		foreach ($content["error"] as $contentErrorKey=>$contentErrorTemp) {
			foreach ($contentErrorTemp as $errorKey=>$errorTemp) {
				$fieldError = 0;
				switch($errorKey) {
					case "empty":
						if (empty($insertData[$contentErrorKey])) {
							$content['errorForm'] = 1;
							$fieldError = 1;
							$content[$preChar.$contentErrorKey."Error"] = $errorTemp;
						}
						break;
					case "emailValid":
						if (!$this->emailValidator($insertData['email'])) {
							$content['errorForm'] = 1;
							$fieldError = 1;
							$content[$preChar.$contentErrorKey."Error"] = $errorTemp;
						}
						break;
					case "emailExist":
						if ($this->_pageModel->emailExist($insertData['email'])>0) {
							$content['errorForm'] = 1;
							$fieldError = 1;
							$content[$preChar.$contentErrorKey."Error"] = $errorTemp;
						}
						break;
				}
				if ($fieldError == 1) {
					break;
				}
			}
		}
		return $content;
	}

	public function makeContent($contentArray) {
		foreach ($contentArray as $key=>$temp) {
			$wcontent[$temp['contentName'].'_Id']=$temp['id'];
			$wcontent[$temp['contentName'].'_Name']=$temp['contentName'];
			$wcontent[$temp['contentName'].'_Label']=$temp['contentLabel'];
			$wcontent[$temp['contentName'].'_Text']=$temp['contentText'];
			$wcontent[$temp['contentName'].'_Html']=$temp['contentHtml'];
			$wcontent[$temp['contentName'].'_Description']=$temp['description'];
			if (!empty($temp['contentImage'])) {
				$wcontent[$temp['contentName'].'_Image']=ROOT.'content/image/'.$temp['contentImage'];
			}
			if (!empty($temp['contentFile'])) {
				$wcontent[$temp['contentName'].'_File']=ROOT.'content/file/'.$temp['contentFile'];
			}
			if (!empty($temp['contentLink'])) {
				if (strpos($temp['contentLink'],'http://')===0) {
					$wcontent[$temp['contentName'].'_Link']=$temp['contentLink'];
				} else {
					$wcontent[$temp['contentName'].'_Link']=STARTURL.$temp['contentLink'];
				}	
			}
		}
		return $wcontent;
	}

	function writeUsEmail($content) {
		if (isset($_POST['send']) && !empty($_POST['send'])) {
			$toWho = '';
			$name=$_POST['name'];
			$email=$_POST['email'];
			$message=$_POST['message'];
			$subject="whitecollarfashion.hu ".$_POST['subject'];
			
			if (empty($name) || empty($email) || empty($subject) || empty($message)) {
				$content['error'] = $content['emptyFieldError_Label'];
			} else if (!$this->emailValidator($email)) {
				$content['error'] = $content['emailFormatError_Label'];
			} else {
				$toWho = $content['writeUsEmail_Text'];
				if(!empty($toWho)) {
					$toSend = explode(',',$toWho);
				}
				$toWho .= ','.$email;
				$html = $content['writeUsEmailTemplate_Html'];
				$html = str_replace("{#sendWhen#}",date('Y.m.d H:s'),$html);
				$html = str_replace("{#name#}",$name,$html);
				$html = str_replace("{#email#}",$email,$html);
				$html = str_replace("{#subject#}",$subject,$html);
				$html = str_replace("{#message#}",$message,$html);
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: <'.$email.'>' . "\r\n";
				if (mail($toWho,$subject,$html,$headers)) {
					$error = $content['writeUsError_Label'];
				} else {
					$this->_pageModel->addWriteUs($toWho,$name,$email,$message,$subject);
					$content['successType']='writeUs';
					$content['success']=1;
				}
			}
		}
		return $content;
	}
}
