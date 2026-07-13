<?php
function latine(string $a) {
   return preg_match("/a-zA-Z0-9/", substr($a,0,1));
}

//használat:
if (preg_match("/^[0-9A-Za-z]+$/","a$k01")) { print "Latin az elsõ karakter"; }
else { print "Nem latin"; }
?>