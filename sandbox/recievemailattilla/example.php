<?
/*
** File: example.php
** Description: Received Mail Example
** If no recieved => $receivedMailDIM["recievedMailCount"] = -1;
*/

$receiveMailDIM["username"]	= 'abc@example.com';
$receiveMailDIM["password"]	= 'XXX';
$receiveMailDIM["EmailAddress"]	= 'abc@example.com';
$receiveMailDIM["mailserver"]	= 'mail.example.com';
$receiveMailDIM["servertype"]	= 'pop3';
$receiveMailDIM["port"]		='110';

$receiveMailDIM["attachPath"]	= "./attachment/";

$receivedMailDIM = receivingMail($receiveMailDIM);

if (empty($receivedMailDIM["receivedMailError"]))
	{
	echo "<br>Total Mails:: ".$receivedMailDIM["recievedMailCount"]."<br>";

	for($i=1;$i<=$receivedMailDIM["recievedMailCount"];$i++)
		{
		echo "<br>************************************* Header ******************************************************<BR>";
		echo "Subject:: ".$receivedMailDIM[$i]["subject"]."<br>";
		echo "TO:: ".$receivedMailDIM[$i]["to"]."<br>";
		echo "To Other:: ".$receivedMailDIM[$i]["toOth"]."<br>";
		echo "ToName Other:: ".$receivedMailDIM[$i]["toNameOth"]."<br>";
		echo "CCAddress:: ".$receivedMailDIM[$i]["ccaddress"]."<br>";
		echo "From:: ".$receivedMailDIM[$i]["from"]."<br>";
		echo "FromName:: ".$receivedMailDIM[$i]["fromName"]."<br>";
		echo "*************************************  Body  ******************************************************<BR>";
		echo "Body:: ".$receivedMailDIM[$i]["body"]."<br>";
		echo "********************************* AttacHed Files **************************************************<BR>";
		echo "Attach Path:: ".$receivedMailDIM[$i]["attachPath"]."<br>";
		echo "Attached Files:: ".$receivedMailDIM[$i]["attachedFile"]."<br>";
		echo "************************************ End Mail *****************************************************<BR>";
		echo "<br><br>";
		}

	}
else
	{
	echo "receivedMailError:: ".$receivedMailDIM["receivedMailError"]."<br>";
	}

/*
** if $resultReceivedMailDIM["receivedMailError"] = 1 then mailbox open error
*/
function receivingMail($receiveMailDIM)
	{
	include("receivemail.class.php");

	// Create Object For reciveMail Class
	$objReceivedMail = new receiveMail($receiveMailDIM["username"],$receiveMailDIM["password"],$receiveMailDIM["EmailAddress"],$receiveMailDIM["mailserver"],$receiveMailDIM["servertype"],$receiveMailDIM["port"]);

	//Connect to the Mail Box
	$resultReceivedMailDIM["receivedMailError"]=$objReceivedMail->connect();
	if (empty($resultReceivedMailDIM["receivedMailError"]))
		{
		// Get Total Number of Unread Email in mail box
		$receivedTotalCount=$objReceivedMail->getTotalMails(); //Total Mails in Inbox Return integer value
		$actualMainPath = $receiveMailDIM["attachPath"].date('Ymdhhmmss')."/";
		for($receivedCount=1;$receivedCount<=$receivedTotalCount;$receivedCount++)
			{
			$actualAttachPath = $actualMainPath.$receivedCount."/";
			$head=$objReceivedMail->getHeaders($receivedCount);  // Get Header Info Return Array Of Headers **Key Are (subject,to,toOth,toNameOth,from,fromName)
			$resultReceivedMailDIM[$receivedCount]["subject"]=$head['subject'];
			$resultReceivedMailDIM[$receivedCount]["to"]=$head['to'];
			$resultReceivedMailDIM[$receivedCount]["toOth"]=$head['toOth'];
			$resultReceivedMailDIM[$receivedCount]["toNameOth"]=$head['toNameOth'];
			$resultReceivedMailDIM[$receivedCount]["ccaddress"]=$head['ccaddress'];
			$resultReceivedMailDIM[$receivedCount]["from"]=$head['from'];
			$resultReceivedMailDIM[$receivedCount]["fromName"]=$head['FromName'];
			$resultReceivedMailDIM[$receivedCount]["body"]=$objReceivedMail->getBody($receivedCount);
			$attachFiles=$objReceivedMail->GetAttech($receivedCount,$actualAttachPath); // Get attached File from Mail Return name of file in comma separated string  args. (mailid, Path to store file)
			if (!empty($attachFiles))
				{
				$resultReceivedMailDIM[$receivedCount]["attachPath"]=$actualAttachPath;
				$resultReceivedMailDIM[$receivedCount]["attachedFile"]=htmlentities($attachFiles);
				}
//			$objReceivedMail->deleteMails($receivedCount); // Delete Mail from Mail box
			}
		$resultReceivedMailDIM["recievedMailCount"]=$receivedTotalCount;
		$objReceivedMail->close_mailbox();
		}
	return $resultReceivedMailDIM;
	}
?>