<?php
class Product{
 
    private $conn;
    private $table_name = "images";
    public $nombre;
    public $descripcion;
    public $imageName;
    public $imageContent;

    public function __construct($db){
        $this->conn = $db;
    }

function read(){
 
    $query = "SELECT nombre, descripcion, imageName, imageContent FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
 
    $stmt->execute();
    
    return $stmt;
}


function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            values('".$this->nombre."','".$this->descripcion."','".$this->imageName."','".$this->imageContent."'"  .")";

    // prepare query
    $stmt = $this->conn->prepare($query);
 echo($query);
    // sanitize
    $this->nombre=htmlspecialchars(strip_tags($this->nombre));
    $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
    $this->imageName=htmlspecialchars(strip_tags($this->imageName));
    $this->imageContent=htmlspecialchars(strip_tags($this->imageContent));
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}