<?php
if (!defined('SERVER_ROOT'))
	exit('No direct script access allowed');
class Page_Controller {
	private $_pageModel;
	public function __construct() {
		include_once('models/view.php');
		$this->_pageModel = new Page_Model;
	}

	public function main($pageID) {
		$this->_pageModel = new Page_Model;
		
		switch($pageID) {
			case "Bekero":
				$this->inputPage($pageID,'index');
				break;
			case "Tarol":
				$this->storePage($pageID,'index');
				break;
			case "Kiertekel":
				$this->listPage($pageID,'ertekel');
				break;
		}
		
	}
	
	function inputPage($pageID,$template) {
		$view = new View_Model($template);
	}

	function storePage($pageID,$template) {
		if (isset($_POST['Tarol'])) {
			$name = $_POST['Nev'];
			$birthYear = $_POST['Szul_year'];
			$birthMonth = $_POST['Szul_ho'];
			$birthDay = $_POST['Szul_nap'];
			$email = $_POST['Email'];
			$score = $_POST['Atlag'];
			$inputError="";
			if (empty($name)) {
				$inputError = "A név nem lehet üres!<br>";
			}
			if (empty($birthYear) || empty($birthMonth) || empty($birthDay)) {
				$inputError .= "A születési dátum nem lehet üres!<br>";
			}
			if (empty($email)) {
				$inputError .= "Az email nem lehet üres!<br>";
			} else if (!$this->emailValidator($email)) {
				$inputError .= "Az email formátum nem jó!<br>";
			} 
			$comma = explode('.',$score);
			if (empty($score)) {
				$inputError .= "Az átlag nem lehet üres!<br>";
			} else if(!is_numeric($score)) {
				$inputError .= "Az átlag csak szám lehet!<br>";
			} else if(isset($comma[1]) && strlen($comma[1]) > 4) {
				$inputError .= "Az átlag nem megfelelő!<br>";
			}
			if (!empty($inputError)) {
				$content['inputError'] = '<P ALIGN="center">'.$inputError.'</P>';
			} else {
				if ($birthMonth<10) {
					$birthMonth = '0'.$birthMonth;
				}
				if ($birthDay<10) {
					$birthDay = '0'.$birthDay;
				}
				$birthWhen = $birthYear.'.'.$birthMonth.'.'.$birthDay.' 00:00';
				$this->_pageModel->addScore($name,$birthWhen,$email,$score);
				header('Location: ?Feladat=Bekero');
			}
		}
		$view = new View_Model($template);
		$view->assign('content' , $content);
	}

	function listPage($pageID,$template) {
		$content['scoreData'] = $this->_pageModel->getScoreList();
		$scoreMin = $this->_pageModel->getScoreMin();
		$scoreMax = $this->_pageModel->getScoreMax();
		$scoreAvg = $this->_pageModel->getScoreAvg();
		$content['scoreMin'] = $scoreMin['scoreMin'];
		$content['scoreMax'] = $scoreMax['scoreMax'];
		$content['scoreAvg'] = $scoreAvg['scoreAvg'];
		$view = new View_Model($template);
		$view->assign('content' , $content);
	}
	
	function emailValidator( $email, $chFail = false ) {
		$msgs = Array(); $msgs[] = 'Received email address: '.$email;
		if( !preg_match( "/^(([^<>()[\]\\\\.,;:\s@\"]+(\.[^<>()[\]\\\\.,;:\s@\"]+)*)|(\"([^\"\\\\\r]|(\\\\[\w\W]))*\"))@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([a-z\-0-9��������������o�]+\.)+[a-z]{2,}))$/i", $email ) )	{
		        $msgs[] = 'Email address was not recognised as a valid email pattern';
		        return $chFail ? Array( false, $msgs ) : false;
		}
		$msgs[] = 'Email address was recognised as a valid email pattern';
		//get the mx host name
		if( preg_match( "/@\[[\d.]*\]$/", $email ) ) {
			$mxHost[0] = preg_replace( "/[\w\W]*@\[([\d.]+)\]$/", "$1", $email );
			$msgs[] = 'Email address contained IP address '.$mxHost[0].' - no need for MX lookup';
		} else {
			//get all mx servers - if no MX records, assume domain is MX (SMTP RFC)
		}
		$msgs[] = 'Could not establish SMTP session with any MX servers';
		return $chFail ? Array( true, $msgs ) : true;
	}
}
