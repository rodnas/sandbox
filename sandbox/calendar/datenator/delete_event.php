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

if(isset($_POST['delete']))
{
	$eventData=$datenator->read_event_info($_POST['delete_id']);
	$sql = "DELETE FROM ".$datenator->getConfig('db_tableprefix')."events WHERE event_id = '".$_POST['delete_id']."'";
	$datenator->db->Execute($sql);
	$sql = "DELETE FROM ".$datenator->getConfig('db_tableprefix')."events_repeat WHERE repeat_event_id = '".$_POST['delete_id']."'";
	$datenator->db->Execute($sql);
	$datenator->makeLogEntry($datenator->user,$eventData->fields['event_id'],$eventData->fields['event_name'],'D');

	$datenator->redirectTo('delete_event.php?deleted=true');
}

if(isset($_GET['id'])) {
	$tpl->assign('event_is_deleted', 0);
	$event_data = $datenator->read_event_info($_GET['id']);
	$tpl->assign('event', array(
		'id' => $event_data->fields['event_id'],
		'name' => $event_data->fields['event_name']));
} elseif(isset($_GET['deleted'])) {
	$tpl->assign('event_is_deleted', 1);
}

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$tpl->display('delete_event.tpl');

/*
 * $Id$
**/
?>