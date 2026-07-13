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

$datenator->user->setAccessLevel(0);

if(isset($_POST['search_user']))
{
	$user = $datenator->user->readUserData($_POST['username']);
	if($user->recordCount()>0) {
		header('Location: edituser.php?id='.$user->fields['user_id'].'');
	} else {
		header('Location: manage_users.php?error=true');
	}
}

if(isset($_POST['add_user'])) 
{
	if(!empty($_POST['name']) && !empty($_POST['newuser_pw'])) 
	{
		if($_POST['newuser_pw'] == $_POST['newuser_pw_conf']) 
		{
			$sql = "INSERT INTO ".$datenator->getConfig('db_tablepre')."users 
			(user_name,user_pw,user_level) values
			('".$_POST['name']."', '".md5($_POST['newuser_pw'])."', '".$_POST['level']."')";

			$datenator->db->Execute($sql);
			header('Location: manage_users.php?a=1');
		} else {
			header('Location: manage_users.php?a=2');
		}
	} else {
		header('Location: manage_users.php?a=3');
	}
}


// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('manage_users.tpl');

/*
 * $Id$
**/
?>