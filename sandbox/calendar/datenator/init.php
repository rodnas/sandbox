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

define('INCLUDE_DIR', 'includes/');
define('ADODB_ASSOC_CASE', 0);

define('DATENATOR_DEBUG', 'SMARTY');

if(!defined('LOGIN_ANONYMOUS')) {
	define('LOGIN_ANONYMOUS', false);
}


require(INCLUDE_DIR.'adodb/adodb.inc.php');
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;


require(INCLUDE_DIR.'functions.php');
require(INCLUDE_DIR.'user.php');

require(INCLUDE_DIR.'translate.php');

$datenator = new Datenator;

$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;


require(INCLUDE_DIR.'smarty_set.php');

$datenator->user = new User;

define('LANGUAGE_DIR', $datenator->getConfig('language_dir'));
define('THEMES_DIR', $datenator->getConfig('themes_dir'));


if(defined('IN_ADMIN')) {
	if(defined('GUEST_ADD')) 
	{
		if(isset($_GET['edit']) && !$datenator->user->isAuthed) 
		{
			die('<b>Datenator::</b> You don\'t have right permissions to access this file.');
		} elseif(!$datenator->getSetting('allow_guestadd') && !$datenator->user->isAuthed) {
			die('<b>Datenator::</b> You don\'t have right permissions to access this file.');
		}
	
	} 
	else 
	{
		if(!$datenator->user->isAuthed)
		{
			$datenator->redirectTo('login.php');
		}	
	}
} else {
	if($datenator->getSetting('cal_has_pw')) 
	{
		if(!$datenator->user->authedToViewCal()) {
			if(!LOGIN_ANONYMOUS) {
				$datenator->redirectTo('login_anonymous.php');
			}
		}
	}
}

/*
 * $Id$
**/
?>
