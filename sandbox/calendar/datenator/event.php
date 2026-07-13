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

if(isset($_GET['id'])) 
{
	$event = $datenator->read_event_info($_GET['id']);

	$udata=$datenator->user->readUserData($event->fields['event_authorid']);

	if(!empty($udata))
	{
		$author=$udata->fields['user_name'];
	} else {
		$author=$event->fields['event_author'];
	}

	$tpl->assign('v', array(
		'title' => $event->fields['event_name'],
		'date' => $event->fields['event_day'].'-'.$event->fields['event_month'].'-'.$event->fields['event_year'],
		'time' => $event->fields['event_starttime'].'-'.$event->fields['event_endtime'],
		'location' => $event->fields['event_location'],
		'contact' => $event->fields['event_contact'],
		'contact_email' => $event->fields['event_contactemail'], 
		'link' => $event->fields['event_link'], 
		'description' => $event->fields['event_description'],
		'author' => $author));
}

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$tpl->display('event.tpl');

/*
 * $Id$
**/
?>