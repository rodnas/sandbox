<?php
$curl_params["test_api_url"] = "http://diston-line/test/testapi/api/read.php";
$resource_array = getCurl($curl_params);

$product = $resource_array[0];
define('URLROOT', 'http://diston-line/test/index.php');

define('SITENAME', 'test');

$title = "Termék";

//print_r($resource_array[0]);
include 'view/product/list.php';

function getCurl($curl_params) {
	$header = [
		'accept: application/json'
	];

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $curl_params["test_api_url"],
		CURLOPT_HTTPHEADER => $header,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true

	));
	$response = curl_exec($curl);
	$status_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
	curl_close($curl);

	return array(json_decode($response, true), $curl_params["test_api_url"], $curl_params, $status_code);
}

?>