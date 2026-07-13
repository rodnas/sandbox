<?php
class View
	{
	public $Model; //Definiáljuk a $Model változót, késõbb az index.php-ben ez a változó meg fogja kapni a Model objektumot.

	public function ShowData()
		{ //Ez a metódus megjeleníti a Model objektum $text változóját.
		echo $this->Model->text; //Mivel az osztályon belül régebben definiáltuk az osztályváltozókat, ezért a $this-> operátorral könnyen el tudjuk érni a Model objektumot, azon belül is a $text változót.
		
		}
		
	}
?>