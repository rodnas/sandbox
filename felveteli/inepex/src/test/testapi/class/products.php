<?php
    class Product{

        // Connection
        private $conn;

        // Table
        private $db_table = "product";

        // Columns
        public $id;
        public $name;
        public $short_description;
        public $price;
        public $when_add;
        public $when_modify;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getProducts(){
            $sqlQuery = "SELECT id, name, short_description, price, when_add, when_modify FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createProduct(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        short_description = :short_description, 
                        price = :price, 
                        when_add = :when_add, 
                        when_modify = :when_modify";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->short_description=htmlspecialchars(strip_tags($this->short_description));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->when_add=htmlspecialchars(strip_tags($this->when_add));
            $this->when_modify=htmlspecialchars(strip_tags($this->when_modify));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":short_description", $this->short_description);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":when_add", $this->when_add);
            $stmt->bindParam(":when_modify", $this->when_modify);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleProduct(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        short_description, 
                        price, 
                        when_add, 
                        when_modify
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->short_description = $dataRow['short_description'];
            $this->price = $dataRow['price'];
            $this->when_add = $dataRow['when_add'];
            $this->when_modify = $dataRow['when_modify'];
        }        

        // UPDATE
        public function updateProduct(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        short_description = :short_description, 
                        price = :price, 
                        when_add = :when_add, 
                        when_modify = :when_modify
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->short_description=htmlspecialchars(strip_tags($this->short_description));
            $this->price=htmlspecialchars(strip_tags($this->price));
            $this->when_add=htmlspecialchars(strip_tags($this->when_add));
            $this->when_modify=htmlspecialchars(strip_tags($this->when_modify));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":short_description", $this->short_description);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":when_add", $this->when_add);
            $stmt->bindParam(":when_modify", $this->when_modify);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteProduct(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

