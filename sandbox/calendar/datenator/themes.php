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

define('IN_ADMIN', true);
require('init.php');

if(isset($_GET['activate']))
{
	$sql="UPDATE ".$datenator->getConfig('db_tableprefix')."settings SET 
		setting_value = '".$_GET['activate']."' WHERE setting_name = 'theme'";

	$datenator->db->Execute($sql);
	header('Location: themes.php');
}


$themes = array();
$dir = opendir(THEMES_DIR);

$i=0;
while ($ltied = readdir($dir)) 
{ 
	if(!ereg('\.',$ltied)) {
		$themes[$i]['folder'] = $ltied;
		include(THEMES_DIR.$ltied.'/index.php');
		$themes[$i]['name'] = $template['name'];
		$themes[$i]['author'] = $template['author'];
		$themes[$i]['URL'] = $template['URL'];
		$themes[$i]['info'] = $template['info'];


		if($datenator->getSetting('theme')==$ltied) {
			$themes[$i]['tdStyle']='box_value_selected';
			$l=translate('Activated');
		} else {
			$themes[$i]['tdStyle']='box_value';
			$l='<a href="?activate='.$ltied.'">'.translate('Activate').'</a>';
		}

		$themes[$i]['activateText']=$l;
		$i++;
	}
}

//print'<pre>';
//print_r($themes);
//print'</pre>';

$tpl->assign('themes', $themes);

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('themes.tpl');

/*
 * $Id$
**/
?>