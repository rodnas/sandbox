<?php
echo "start<br>";
require_once("Controller.php"); //Beillesztjük a Controller.php-t
require_once("Model.php"); //Beillesztjük a Model.php-t
require_once("View.php"); //Beillesztjük a View.php-t


$Controller = new Controller; //Példányosítjuk a Controller osztályt.
$Model = new Model; //Példányosítjuk a Model osztályt.

$View = new View; //Példányosítjuk a View osztályt.

$Controller->Model = $Model; //A Controller objektum $Model változójának átadjuk a Model objektumot.

$Controller->View = $View; //A Controller objektum $View változójának átadjuk a View objektumot.

$View->Model = $Model; //A View objektum $Model változójának átadjuk a Model objektumot.


$Controller->HelloWorld(); //Meghívjuk a Controller objektum HelloWorld metódusát.
?>