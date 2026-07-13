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

if(isset($_POST['deluser']))
{
	$sql = "DELETE FROM ".$datenator->getConfig('db_tableprefix')."users WHERE user_id = '".$datenator->prepare_sql($_POST['uid'])."'";
	$datenator->db->Execute($sql);
	header('Location: manage_users.php');
}

if(isset($_POST['edit_user']))
{
	if(!empty($_POST['username']) && !empty($_POST['email'])) {
		$sql = "UPDATE ".$datenator->getConfig('db_tableprefix')."users SET 
		user_name = '".$_POST['username']."',
		user_realname = '".$_POST['realname']."',
		user_email = '".$_POST['email']."'";

		if(!empty($_POST['password']) && !empty($_POST['password_conf']))
		{
			if((strlen($_POST['password']) >= 6) && ($_POST['password']==$_POST['password_conf']))
			{
				$sql.=",user_password='".md5($_POST['password'])."'";
			}
		}

		$sql.=" WHERE user_id = '".$_POST['uid']."'";
		$datenator->db->Execute($sql);
		header('Location: edituser.php?id='.$_POST['uid'].'');
	} else {
		header('Location: edituser.php?error=true');
	}
}

if(isset($_GET['id']))
{
	$uId=$_GET['id'];
	$data = $datenator->user->readUserData($uId);

	$tpl->assign('v', array(
		'user_id' => $data->fields['user_id'],
		'username' => $data->fields['user_name'],
		'realname' => $data->fields['user_realname'],
		'email' => $data->fields['user_email']));
}

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('edituser.tpl');

/*
 * $Id: edituser.php,v 1.4 2005/07/11 16:24:36 indom Exp $
**/
?>