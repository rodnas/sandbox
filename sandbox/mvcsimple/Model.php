<?php
class Model
	{
	public $text; //Definiáljuk a $text változót, késõbb ebben fog tárolódni a "Hello World!" karakterlánc.
	
	public function setHelloWorldText()
		{ //Ez a metódus értéket ad az osztály $text változójának.
		$this->text = "Hello World!"; // A $this-> operátorral érhetjük el az osztályváltozókat.
	
		}
	}
?>