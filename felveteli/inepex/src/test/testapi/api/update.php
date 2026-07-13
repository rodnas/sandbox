<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/products.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Product($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // product values
    $item->name = $data->name;
    $item->short_description = $data->short_description;
    $item->price = $data->price;
    $item->when_add = $data->when_add;
    $item->when_modify = date('Y-m-d H:i:s');
    
    if($item->updateProduct()){
        echo json_encode("Product data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>