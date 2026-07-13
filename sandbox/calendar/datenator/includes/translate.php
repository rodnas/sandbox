<?php
/* 
 * Copyright (C) 2005 Lauri Itkonen, indom at mbnet fi
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
**/

/**
* Original code in get_translation() by cknudsen, http://webcalendar.sf.net
*/
function get_translation($params = false, $text) 
{
	global $datenator;
	$file = 'languages/'.$datenator->getSetting('language').'.txt';
	if(!file_exists($file)) {
		$file = 'languages/English.txt';
	}
	$fp = fopen ($file, "r");
	while(!feof($fp)) 
	{
		$buffer = fgets($fp, 4096);
		$buffer = trim($buffer);

		if(substr($buffer, 0, 1) == '#' || strlen($buffer) == 0) {
			continue;
		}

		$start = strpos($buffer, '|');
		$abbrev = substr ( $buffer, 0, $start );
		$abbrev = trim ( $abbrev );
		$trans = substr ( $buffer, $start + 1 );
		$trans = trim ( $trans );
		$translations[$abbrev] = $trans;
	}

	fclose($fp);
	$str = trim($text);
	if (!empty($translations[$text])) {
		if(ereg('%s', $translations[$text])) {
			return sprintf($translations[$text], $params['d']);
		} else {
			return $translations[$text];
		}
	} else {
		/**
		* Text not found in language file
		*/
		return '<blink style="color:#FF0000;">'.$text.'</blink>';
	}
}

function translate($text)
{
	return get_translation(false, $text);
}

/*
 * $Id$
**/
?>