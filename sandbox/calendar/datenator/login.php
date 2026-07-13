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

require('init.php');

// If logged in, redirect to admin panel.
if($datenator->user->isAuthed) { $datenator->redirectTo('admin.php'); }

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$user_data = $datenator->user->readUserData($username);

	if($user_data) {

		if($user_data->fields['user_pw'] == md5($password) && $user_data->fields['user_name'] == $username) 
		{
			setcookie($datenator->getConfig('cookie_prefix').'auth', $user_data->fields['user_id'], time()+(60*60*24*30));
			setcookie($datenator->getConfig('cookie_prefix').'pass', md5($password), time()+(60*60*24*30));
			$datenator->redirectTo('admin.php');
		} else {
			$datenator->redirectTo('login.php?error=true');
		}
	} else {
		$datenator->redirectTo('login.php?error=true');
	}
}

if(isset($_GET['error']))
{
	$tpl->assign('print_login_error',1);
}


// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('login.tpl');

/*
 * $Id$
**/
?>