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

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleProduct();

    if($item->name != null){
        // create array
        $emp_arr = array(
            "id" =>  $item->id,
            "name" => $item->name,
            "short_description" => $item->short_description,
            "price" => $item->price,
            "when_add" => $item->when_add,
            "when_modify" => $item->when_modify
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Product not found.");
    }
?>