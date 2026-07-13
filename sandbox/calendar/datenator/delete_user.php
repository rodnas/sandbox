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

if(isset($_GET['del']) && isset($_GET['from']))
{
	$from = $_GET['from'];
	$userId=$_GET['del'];

	$sql = "DELETE FROM ".$datenator->getConfig('db_tableprefix')."users WHERE user_id = '".$userId."'";
	$datenator->db->Execute($sql);

	if($from == 'admins') {
		header('Location: manage_admins.php');
	} else {
		header('Location: manage_users.php');
	}
}
?>