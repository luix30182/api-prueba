<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../confi/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->nombre) &&
    !empty($data->descripcion) &&
    !empty($data->imageName) &&
    !empty($data->imageContent)
){
 
    $product->nombre = $data->nombre;
    $product->descripcion = $data->descripcion;
    $product->imageName = $data->imageName;
    $product->imageContent = $data->imageContent;
 
    if($product->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Product was created."));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }
}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>