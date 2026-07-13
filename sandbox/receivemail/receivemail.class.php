<?php
/* Main ReciveMail Class File - Version 1.0
**
** File: recivemail.class.php
** Description: Reciving mail With Attechment
** Version: 1.0
*/

class receiveMail
	{
	var $server='';
	var $username='';
	var $password='';
	
	var $marubox='';					
	
	var $email='';			
	
	/*
	** function reciveMail($username,$password,$EmailAddress,$mailserver='localhost',$servertype='pop',$port='110')
        **
	** This is the constructor for this class
        **
	** Arguments are
	** $username                = User name off the mail box
	** $password                = Password of mailbox
	** $emailAddress            = Email address of that mailbox some time the uname and email address are identical
	** $mailserver              = Ip or name of the POP or IMAP mail server
	** $servertype              = if this server is imap or pop default is pop
	** $port                    = Server port for pop or imap Default is 110 for pop and 143 for imap
	*/
	function receiveMail($username,$password,$EmailAddress,$mailserver='localhost',$servertype='pop',$port='110')
		{
		if($servertype=='imap')
			{
			if($port=='') $port='143'; 
			$strConnect='{'.$mailserver.':'.$port. '}INBOX'; 
			}
		else
			{
			$strConnect='{'.$mailserver.':'.$port. '/pop3}INBOX'; 
			}
		$this->server			=	$strConnect;
		$this->username			=	$username;
		$this->password			=	$password;
		$this->email			=	$EmailAddress;
		}

	/*
	** function connect()  
	** Connect To the Mail Box
	** This function is useful to connect to the mail box 
	*/
	function connect()
		{
		$this->marubox=imap_open($this->server,$this->username,$this->password);
		if ($this->marubox == false)
			{
			$result = 1;
			}
		else
			{
			$result = 0;
			}
		return $result;
		}

	/*
	** function getHeaders($mid)
	** Get Header info
	** This function is use full to Get Header info from particular mail
	**
	** Arguments : 
	** $mid               = Mail Id of a Mailbox
	**
	** Return :
	** Return Associative array with following keys
	** subject	=> Subject of Mail
	** to		=> To Address of that mail
	** toOth	=> Other To address of mail
	** toNameOth	=> To Name of Mail
	** from		=> From address of mail
	** fromName	=> Form Name of Mail
	*/
	function getHeaders($mid)
		{
		$mail_header=imap_header($this->marubox,$mid);
		$sender=$mail_header->from[0];
		$sender_replyto=$mail_header->reply_to[0];
		if(strtolower($sender->mailbox)!='mailer-daemon' && strtolower($sender->mailbox)!='postmaster')
			{
			$text = $mail_header->subject;
			$elements = imap_mime_header_decode($text);
			$mail_header->subject="";
			for ($i=0; $i<count($elements); $i++)
				{
				$mail_header->subject.=$elements[$i]->text;
				}

			$text = strtolower($sender->personal);
			$elements = imap_mime_header_decode($text);
			$sender->personal="";
			for ($i=0; $i<count($elements); $i++)
				{
				$sender->personal.=$elements[$i]->text;
				}

			$text = strtolower($mail_header->toaddress);
			$elements = imap_mime_header_decode($text);
			$mail_header->toaddress="";
			for ($i=0; $i<count($elements); $i++)
				{
				$mail_header->toaddress.=$elements[$i]->text;
				}

			$text = strtolower($mail_header->ccaddress);
			$elements = imap_mime_header_decode($text);
			$mail_header->ccaddress="";
			for ($i=0; $i<count($elements); $i++)
				{
				$mail_header->ccaddress.=$elements[$i]->text;
				}

			$text = $sender_replyto->personal;
			$elements = imap_mime_header_decode($text);
			$sender_replyto->personal="";
			for ($i=0; $i<count($elements); $i++)
				{
				$sender_replyto->personal.=$elements[$i]->text;
				}

			$mail_details=array(
					'from'=>strtolower($sender->mailbox).'@'.$sender->host,
					'fromName'=>$sender->personal,
					'toOth'=>strtolower($sender_replyto->mailbox).'@'.$sender_replyto->host,
					'toNameOth'=>$sender_replyto->personal,
					'subject'=>$mail_header->subject,
					'ccaddress'=>strtolower($mail_header->ccaddress),
					'to'=>strtolower($mail_header->toaddress)
				);
			}
		return $mail_details;
		}

	function get_mime_type(&$structure) //Get Mime type Internal Private Use
		{ 
		$primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER"); 
		
		if($structure->subtype)
			{ 
			return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype; 
			} 
		return "TEXT/PLAIN"; 
		} 

	function get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false) //Get Part Of Message Internal Private Use
		{ 
		if(!$structure)
			{ 
			$structure = imap_fetchstructure($stream, $msg_number); 
			} 
		if($structure)
			{ 
			if($mime_type == $this->get_mime_type($structure))
				{ 
				if(!$part_number) 
					{ 
					$part_number = "1"; 
					} 
				$text = imap_fetchbody($stream, $msg_number, $part_number); 
				if($structure->encoding == 3) 
					{ 
					return imap_base64($text); 
					} 
				else if($structure->encoding == 4) 
					{ 
					return imap_qprint($text); 
					} 
				else
					{ 
					return $text; 
					} 
				} 
			if($structure->type == 1) /* multipart */ 
				{ 
				while(list($index, $sub_structure) = each($structure->parts))
					{ 
					if($part_number)
						{ 
						$prefix = $part_number . '.'; 
						} 
					$data = $this->get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1)); 
					if($data)
						{ 
						return $data; 
						} 
					} 
				} 
			} 
		return false; 
		} 
	
	/*
	** getTotalMails()
	** Get Total Number off Unread Email In Mailbox
	** used to get total unread mail from That mailbox
	**
	** Return : 
	** Int Total Mail
	*/
	function getTotalMails()
		{
		$headers=imap_headers($this->marubox);
		return count($headers);
		}

	/*
	** GetAttech($mid,$path)
	** Get Atteced File from Mail
	** Save attached file from mail to given path of a particular location
	**
	** Arguments :
	** $mid		= mail id
	** $path	= path where to save
	** 
	** Return  :
	** String of filename with coma separated
	** example: logo.gif,nature.jpg,test.xls etc
	*/
	function GetAttech($mid,$path)
		{
		$struckture = imap_fetchstructure($this->marubox,$mid);
		if (!empty($struckture->parts))
			{
			$ar="";
			foreach($struckture->parts as $key => $value)
				{
				$enc=$struckture->parts[$key]->encoding;
				if($struckture->parts[$key]->ifdparameters)
					{
					$name=$struckture->parts[$key]->dparameters[0]->value;
					$text = $name;
					$elements = imap_mime_header_decode($text);
					$name="";
					for ($i=0; $i<count($elements); $i++)
						{
						$name.=$elements[$i]->text;
						}
					$message = imap_fetchbody($this->marubox,$mid,$key+1);
					if ($enc == 0)
						$message = imap_8bit($message);
					if ($enc == 1)
						$message = imap_8bit ($message);
					if ($enc == 2)
						$message = imap_binary ($message);
					if ($enc == 3)
						$message = imap_base64 ($message); 
					if ($enc == 4)
						$message = quoted_printable_decode($message);
					if ($enc == 5)
						$message = $message;
					$dirMake = rmkdir($path, 0755);
					$fp=fopen($path.$name,"w");
					fwrite($fp,$message);
					fclose($fp);
					$ar=$ar.$name.",";
					}
				}
			$ar=substr($ar,0,(strlen($ar)-1));
			}
		return $ar;
		}

	/*
	** getBody($mid)
	** Get Message Body
	** Get The actual mail content from this mail
	**
	** Arguments 
	** $mid		= Mail id
	** Return String
	*/
	function getBody($mid)
		{
		$body = $this->get_part($this->marubox, $mid, "TEXT/HTML");
		if ($body == "")
			$body = $this->get_part($this->marubox, $mid, "TEXT/PLAIN");
		if ($body == "")
			{ 
			return "";
			}
		return $body;
		}

	/*
	** deleteMails($mid)
	** Delete mail from that mail box
	**
	** Arguments :
	** $mid		= mail Id
	*/
	function deleteMails($mid)
		{
		imap_delete($this->marubox,$mid);
		}

	/*
	** close_mailbox()
	** Close The Mail Box
	*/
	function close_mailbox()
		{
		imap_close($this->marubox,CL_EXPUNGE);
		}
	}

/**
 * Makes directory and returns BOOL(TRUE) if exists OR made.
 *
 * @param  $path Path name
 * @return bool
 */
function rmkdir($path, $mode = 0755)
	{
	$path = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path), "/");
	$e = explode("/", ltrim($path, "/"));
	if(substr($path, 0, 1) == "/")
		{
		$e[0] = "/".$e[0];
		}
	$c = count($e);
	$cp = $e[0];
	for($i = 1; $i < $c; $i++)
		{
		if(!is_dir($cp) && !@mkdir($cp, $mode))
			{
			return false;
			}
		$cp .= "/".$e[$i];
		}
	return @mkdir($path, $mode);
	}
?>