<?php
function curl_get_contents($url)
{
	$ch = curl_init();
	$timeout = 5;

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	
	$data = curl_exec($ch);
	
	curl_close($ch);
	
	return $data;
}

$url = 'https://www.tidebit.com//api/v2/tickers/btcusd.json';
$btccontents = curl_get_contents($url);
echo $btccontents;
echo '<br>';


$url = 'https://www.tidebit.com//api/v2/tickers/ethusd.json';
$ethcontents = curl_get_contents($url);
echo $ethcontents;

?>