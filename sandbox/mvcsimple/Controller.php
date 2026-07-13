<?php
//echo "Controller<br>";
class Controller
	{
	public $Model, $View; //Definiáljuk a $Model és $View változókat, késõbb az index.php-ben ez a két változó meg fogja kapni a Model és View objektumokat.

	public function HelloWorld()
		{ //Ez a metódus elõször beállítja a Model objektum $text változóját, utána pedig megjleníti az adatokat.
	
		$this->Model->setHelloWorldText(); //Ez meghívja a Model osztály setHelloWorld() metódusát ami értéket ad a $text osztályváltozónak.
	
		$this->View->ShowData(); //Ez meghívja a View osztály ShowData() metódusát ami kiirja a Model osztálytól átvett $text változót.

		}
	
	}
?>