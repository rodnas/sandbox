<?php
class ProductModel{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getAllProduct()
    {

	$curl_params["test_api_url"] = "http://diston-line/test/testapi/api/read.php";

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

	return json_decode($response,true);
    }

    public function getProductById($id)
    {
	$curl_params["test_api_url"] = "http://diston-line/test/testapi/api/single_read.php/?id=".$id;
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

	return json_decode($response,true);
    }
	
    public function insert()
    {
	$json_content = json_encode($_POST);
	$header = [
		'Content-Type: application/json',
		'accept: application/json'
	];

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://diston-line/test/testapi/api/create.php");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json_content);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($curl);
	$status_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
	curl_close($curl);

	return json_decode($response, true);
    }

    public function update($id)
    {
	$json_content = json_encode($_POST);

	$header = [
		'Content-Type: application/json',
		'accept: application/json'
	];

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://diston-line/test/testapi/api/update.php");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json_content);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($curl);
	$status_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
	curl_close($curl);
	return json_decode($response, true);
    }

    public function delete($id)
    {
	$data = array("id" => $id);
//	$json_content = json_encode($id);

	$json_content = json_encode($data);

	$header = [
		'accept: application/json',
		'Content-Length: ' . strlen($json_content)
	];

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://diston-line/test/testapi/api/delete.php");
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json_content);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($curl);
	$status_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
	curl_close($curl);

	return json_decode($response, true);
    }
}