<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://www.citromail.hu/hotdog.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS,"user=rodnas0204");
$data = curl_exec ($ch);
curl_close ($ch);
if ((string) $data!= (string) crypt("phoenix0204",$data))
	{
         //A fiók NEM VALID
	echo "Nem valos fiok<br>";
	}
else
	{
         //A fiók VALID
	echo "Valos fiok<br>";
	}
?>
