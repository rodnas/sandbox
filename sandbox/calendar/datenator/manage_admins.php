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

$sql = "SELECT * FROM ".$datenator->getConfig('db_tableprefix')."users WHERE user_level = 0";
$admins = $datenator->db->Execute($sql);
$adminlist=array();
$i=0;
while(!$admins->EOF)
{
	$i++;
	$adminlist[$i]['userName']=$admins->fields['user_name'];
	$adminlist[$i]['userId']=$admins->fields['user_id'];
	$adminlist[$i]['userRealName']=$admins->fields['user_realname'];
	
	if($admins->fields['user_id']==1) {
		$l=translate('Super admin').'*';
	} else {
		$l='<a href="delete_user.php?del='.$admins->fields['user_id'].'&amp;from=admins" onclick="return conf(\'You are deleting user '.$admins->fields['user_name'].'. Are you sure? \');">';
		$l.=translate('Delete admin');
		$l.='</a>';
	}

	$adminlist[$i]['removeLink']=$l;
	$admins->MoveNext();
}

$tpl->assign('admins', $adminlist);

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('manage_admins.tpl');

/*
 * $Id$
**/
?>