<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("rodnas@uw.hu","test targy",$msg);
mail("rodnas0204@gmail.com","test targy",$msg);

$to = "rodnas@uw.hu,rodnas0204@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: info@kenyelembutorhaz.hu" . "\r\n" .
"CC: alext@freemail.hu";

mail($to,$subject,$txt,$headers);
?> 