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

$sql = "SELECT * FROM ".$datenator->getConfig('db_tableprefix')."events_log ORDER BY log_date DESC";
$log=$datenator->db->Execute($sql);

$ret='';
$ret.= '<table class="b_table" width="98%" align="center">';
$ret.= '<tr>';
$ret.= '<td class="box_subtitle">User</td>';
$ret.= '<td class="box_subtitle">Date</td>';
$ret.= '<td class="box_subtitle">Event</td>';
$ret.= '<td class="box_subtitle">Action</td>';
$ret.= '</tr>';
while(!$log->EOF)
{
	
	$eventData=$datenator->read_event_info($log->fields['log_event_id']);
	if($eventData->recordCount() != 0) {
		$eventName='<a href="event.php?id='.$eventData->fields['event_id'].'">'.$eventData->fields['event_name'].'</a>';
	} else {
		$eventName=$log->fields['log_event_name'];
	}

	$ret.= '<tr>';
	$ret.= '<td class="box_value">'.$log->fields['log_author'].'</td>';
	$ret.= '<td class="box_value">'.adodb_date('l, F j, Y H:i:s',$log->fields['log_date']).'</td>';
	$ret.= '<td class="box_value">'.$eventName.'</td>';
	if( $log->fields['log_type'] == 'C' )
	{
		$action='Event created';
	} elseif( $log->fields['log_type'] == 'D') {
		$action='Event deleted';
	} elseif( $log->fields['log_type'] == 'U') {
		$action='Event updated';
	}
	$ret.= '<td class="box_value">'.$action.'</td>';
	$ret.= '</tr>';
	$log->MoveNext();
}
$ret.= '</table>';

$tpl->assign('activity_log', $ret);

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('activitylog.tpl');

/*
 * $Id$
**/
?>