<?php
/*
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
*/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/products.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Product($db);

    $stmt = $items->getProducts();
    $itemCount = $stmt->rowCount();
//print_r('<pre>');
//print_r($items);
//die();
    if($itemCount > 0){
        
        $productArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "short_description" => $short_description,
                "price" => $price,
                "when_add" => $when_add,
                "when_modify" => $when_modify
            );

            array_push($productArr, $e);
        }
        echo json_encode($productArr);
    }

    else{
        http_response_code(404);

        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>