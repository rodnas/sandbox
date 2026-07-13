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
define('GUEST_ADD', true);
require('init.php');

//===================
// ADD|EDIT QUERIES
//===================
if(isset($_POST['add_event']) || isset($_POST['edit_event'])) 
{

	if(!checkdate($_POST['start_month'], $_POST['start_Day'], $_POST['start_Year']) || 
		!checkdate($_POST['end_month'], $_POST['end_Day'], $_POST['end_Year']))
	{
		$messages[] = translate('Invalid date');
	}

	if(trim($_POST['title']) == '') {
		$messages[] = translate('Invalid event title');
	}

	if($_POST['repeat'] == 'w' && !isset($_POST['weekdays'])) 
	{
		$messages[] = translate('Select repeat days on weekly event');
	}

	/**
	* No error messages so continue
	*/

	if(!isset($messages)) 
	{
		// DEBUG SQL:S??????
		//$datenator->db->debug=true; //debugging...
	
		$start_time = $datenator->prepare_sql($_POST['start_Hour'].':'.$_POST['start_Minute']);
		$end_time = $datenator->prepare_sql($_POST['end_Hour'].':'.$_POST['end_Minute']);

		/**
		* Now lets generate and execute the SQL for events table.
		*/

		if(!isset($_POST['repeat'])) {
			$_POST['repeat'] = 'n';
		}

		if($_POST['repeat'] != 'n') {
			$event_type = 'R';
		} else {
			$event_type = 'E';
		}

		$data['event_name'] = $_POST['title'];
		$data['event_description'] = $_POST['descr'];
		$data['event_type'] = $event_type;
		$data['event_year'] = $_POST['start_Year'];
		$data['event_month'] = $_POST['start_month'];
		$data['event_day'] = $_POST['start_Day'];
		$data['event_starttime'] = $start_time;
		$data['event_endtime'] = $end_time;
		$data['event_location'] = $_POST['location'];
		$data['event_contact'] = $_POST['contact'];
		$data['event_contactemail'] = $_POST['contact_email'];
		$data['event_link'] = $_POST['link'];
		$data['event_font'] = $_POST['font'];
		$data['event_fontsize'] = $_POST['font_size'];
		$data['event_fontstyle'] = $_POST['font_styles'];
		$data['event_fontcolor'] = $_POST['font_color'];
		$data['event_author'] = $datenator->user->getUserName();
		$data['event_authorid'] = $datenator->user->getUserId();

		if(isset($_POST['add_event']))
		{
			$rs=$datenator->db->Execute("select * from ".$datenator->getConfig('db_tableprefix')."events");
			$sql=$datenator->db->GetInsertSQL($rs,$data);
		}
		else
		{
			$rs=$datenator->db->Execute("select * from ".$datenator->getConfig('db_tableprefix')."events");
			$sql=$datenator->db->GetUpdateSQL($rs, $data);
			$sql.= ' WHERE event_id = \''.$_POST['edit_id'].'\'';
		}

		$datenator->db->Execute($sql);


		//$datenator->db->AutoExecute($datenator->db_tablepre.'events', $data, $mode, $where);
		/*$datenator->db->Execute("INSERT INTO dat_events ( event_year, event_month, event_day, event_starttime, event_endtime, event_type, event_name, event_font, event_fontsize, event_fontstyle, event_fontcolor, event_description, event_location, event_contact, event_contactemail, event_link, event_author, event_authorid ) 
			VALUES 
			( ".$data['event_year'].", ".$data['event_month'].", ".$data['event_day'].", '".$data['event_starttime']."', '".$data['event_endtime']."', '".$data['event_type']."', '".$data['event_name']."', '".$data['event_font']."', '".$data['event_fontsize']."', '".$data['event_fontstyle']."', '".$data['event_fontcolor']."', '".$data['event_description']."', '".$data['event_location']."', '".$data['event_contact']."', '".$data['event_contactemail']."', '".$data['event_link']."', '".$data['event_author']."', ".$data['event_authorid']." )");*/

		if(isset($_POST['add_event'])) 
		{
			$id_sql = "SELECT event_id FROM ".$datenator->getConfig('db_tableprefix')."events ORDER BY event_id DESC";
			$query = $datenator->db->SelectLimit($id_sql,1);
			$repeat_event_id = $query->fields['event_id'];
		} else {
			$repeat_event_id = $_POST['edit_id'];
		}

		/**
		* And now for events_repeat table.
		*/

		if(isset($_POST['weekdays'])) 
		{
			$days = '';
			$c = 0;
			foreach($_POST['weekdays'] as $day) 
			{
				$c++;
				if($c != 1) {
					$days .= ',';
				}
				$days .= $day;
			}
		} else {
			$days = '';
		}

		if(!is_numeric($_POST['frequency']) || $_POST['frequency'] <= 0) {
			$_POST['frequency'] = 1;
		}

		if(isset($_POST['useclosedate'])) {
			$uclosedate = 1;
		} else {
			$uclosedate = 0;
		}
		$data=array();
		$data['repeat_event_id'] = $repeat_event_id;
		$data['repeat_type'] = $_POST['repeat'];
		$data['repeat_closeyear'] = $_POST['end_Year'];
		$data['repeat_closemonth'] = $_POST['end_month'];
		$data['repeat_closeday'] = $_POST['end_Day'];
		$data['repeat_frequency'] = $_POST['frequency'];
		$data['repeat_days'] = $days;
		$data['repeat_useclosedate'] = $uclosedate;

		if(isset($_POST['add_event']))
		{
			$rs=$datenator->db->Execute("select * from ".$datenator->getConfig('db_tableprefix')."events_repeat");
			$sql=$datenator->db->GetInsertSQL($rs,$data);
		}
		else
		{
			$rs=$datenator->db->Execute("select * from ".$datenator->getConfig('db_tableprefix')."events_repeat");
			$sql=$datenator->db->GetUpdateSQL($rs, $data);
			$sql.= ' WHERE repeat_event_id = \''.$repeat_event_id.'\'';
		}

		$datenator->db->Execute($sql);

		/*$sql = "INSERT INTO dat_events_repeat 
		( repeat_event_id, repeat_frequency, repeat_closeyear, repeat_closemonth, repeat_closeday, repeat_useclosedate, repeat_type, repeat_days ) 
			VALUES ( ".$data['repeat_event_id'].", ".$data['repeat_frequency'].", ".$data['repeat_closeyear'].", ".$data['repeat_closemonth'].", ".$data['repeat_closeday'].", ".$data['repeat_useclosedate'].", '".$data['repeat_type']."', '".$data['repeat_days']."')";
		$datenator->db->Execute($sql);*/

		//$datenator->db->AutoExecute($datenator->db_tablepre.'events_repeat', $data, $mode, $where_repeat);

		if(isset($_POST['edit_event'])) 
		{
			$datenator->makeLogEntry($datenator->user,$_POST['edit_id'],$_POST['title'],'U');
			header('Location: '.$_SERVER['PHP_SELF'].'?edit='.$_POST['edit_id'].'&edited=1');
		} 
		else 
		{
			$datenator->makeLogEntry($datenator->user,$repeat_event_id,$_POST['title'],'C');
			header('Location: '.$_SERVER['PHP_SELF'].'?added=1');
		}

	} else {
		$tpl->assign('message_type', 'error');
	}
	
	if(!isset($messages)) {
		$messages=array();
	}
	$tpl->assign('messages', $messages);
	$tpl->assign('print_messages', 1);
}

if(isset($_GET['added']) || isset($_GET['edited'])) 
{
	$tpl->assign('print_messages', 1);
	$tpl->assign('message_type', 'success');

	if(isset($_GET['added'])) {
		$messages[] = translate('Event succesfully added');
		$tpl->assign('messages', $messages);
	}

	if(isset($_GET['edited'])) {
		$messages[] = translate('Event succesfully edited');
		$tpl->assign('messages', $messages);
	}
}

//==================
// FILL/CHECK VALUES
//==================

/**
* We are editing an existing event
*/
if(isset($_GET['edit'])) 
{

	$event_info = $datenator->read_event_info($_GET['edit']);

	/**
	* Selected start- and closemonth
	*/
	$s_start_month = $event_info->fields['event_month'];
	$s_close_month = $event_info->fields['repeat_closemonth'];
	
	/**
	* All values that are filled in textinput fields or textareas
	*/
	$tpl->assign('v', 
		array('title' => $datenator->specialchars($event_info->fields['event_name']),
		'description' => $datenator->specialchars($event_info->fields['event_description']),
		'location' => $datenator->specialchars($event_info->fields['event_location']),
		'contact' => $datenator->specialchars($event_info->fields['event_contact']),
		'contactemail' => $datenator->specialchars($event_info->fields['event_contactemail']),
		'link' => $datenator->specialchars($event_info->fields['event_link']),
		'frequency' => $datenator->specialchars($event_info->fields['repeat_frequency'])));

	/**
	* An array of what days will weekly event appear
	*/
	$days_to_repeat = explode(',', $event_info->fields['repeat_days']);

	/**
	* All values that must be checked or selected. Checkboxes, radios and selections
	*/
	$tpl->assign('s', 
		array(
		'useclosedate' => $event_info->fields['repeat_useclosedate'], 
		'startdate' => $event_info->fields['event_year'].'-'.$event_info->fields['event_month'].'-'.$event_info->fields['event_day'], 
		'closedate' => $event_info->fields['repeat_closeyear'].'-'.$event_info->fields['repeat_closemonth'].'-'.$event_info->fields['repeat_closeday'], 
		'starttime' => $event_info->fields['event_starttime'],
		'endtime' => $event_info->fields['event_endtime'],
		'type' => $event_info->fields['repeat_type'],
		'weekday' => $days_to_repeat, 
		'font' => $event_info->fields['event_font'],
		'font_size' => $event_info->fields['event_fontsize'],
		'font_style' => $event_info->fields['event_fontstyle'],
		'font_color' => $event_info->fields['event_fontcolor']));

	/**
	* Change the page title and forms button name the script 
	* wether are we editing or adding event
	*/
	$tpl->assign('f', 
		array(
		'action' => 'edit_event',
		'text' => 'Edit event'));

	/**
	* Event ID
	*/
	$tpl->assign('edit_id', $event_info->fields['event_id']);


/**
* We are adding an event
*/
} else {
	
	/**
	* We are adding event to specified date
	*/
	if(isset($_GET['date'])) 
	{
		$sdate = $_GET['date'];
		$p = explode('-', $_GET['date']);
		$s_start_month = $p[1];
	} else {
		$sdate = '';
		$s_start_month = date('n');
	}

	if(isset($_GET['hour'])) {
		$s_starttime=$_GET['hour'].'-00';
	} else {
		$s_starttime='';
	}

	/**
	* Select defaults
	*/
	$tpl->assign('s', 
		array(
		'starttime' => $s_starttime,
		'useclosedate' => '1',
		'startdate' => $sdate,
		'type' => 'n',
		'weekday' => array(), 
		'font' => 'default',
		'font_size' => 'default',
		'font_style' => 'default',
		'font_color' => 'default'));
	
	$s_close_month = date('n');
	
	/**
	* Change the page title and forms button name the script 
	* wether are we editing or adding event
	*/
	$tpl->assign('f', 
		array(
		'action' => 'add_event',
		'text' => 'Add event'));
	
}

//==================
// DATE/TIME
//==================

/**
* Startmonth selection
*/
$tpl->assign('start_month', $datenator->months_selection('start_month', $s_start_month));


/**
* Event repeat types
*/
$repeat_types = array('n' => translate('None'), 'd' => translate('Daily'), 'w' => translate('Weekly'), 'm' => translate('Monthly'), 'y' => translate('Yearly'));
$tpl->assign('repeat_types', $repeat_types);

/** 
* Use closedate checkbox
*/
$useclosedate = array(1 => translate('Use closedate'));
$tpl->assign('useclosedate', $useclosedate);

/**
* Repeat Closemonth selection
*/
$tpl->assign('close_month', $datenator->months_selection('end_month', $s_close_month));

/**
/* Weekdays to repeat on (on weekly) - checkboxes
*/
$weekdays = $datenator->get_translated_days();
$tpl->assign('weekdays', $weekdays);

//==================
// EVENT STYLING
//==================

/**
* Event font radios
**/
$fonts = array(
	'default' => translate('Default'), 
	'verdana' => 'Verdana', 
	'tahoma' => 'Tahoma', 
	'arial' => 'Arial');

$tpl->assign('font', $fonts);

/**
* Event fontsize radios
*/
$sizes = array(
	'default' => translate('Default'), 
	'10' => '10px', 
	'12' => '12px', 
	'14' => '14px');

$tpl->assign('font_size', $sizes);

/**
* Event style radios
**/
$styles = array(
	'default' => translate('Default'), 
	'bold' => translate('Bold'), 
	'italic' => translate('Italic'), 
	'bolditalic' => translate('BoldItalic'));

$tpl->assign('font_styles', $styles);

/**
* Event font color radios
*/
$colors = array(
	'default' => translate('Default'), 
	'black' => translate('Black'), 
	'red' => translate('Red'), 
	'blue' => translate('Blue'), 
	'green' => translate('Green'), 
	'yellow' => translate('Yellow'), 
	'orange' => translate('Orange'), 
	'brown' => translate('Brown'), 
	'grey' => translate('Grey'), 
	'gold' => translate('Gold'), 
	'silver' => translate('Silver'), 
	'lime' => translate('Lime'), 
	'darkred' => translate('Darkred'), 
	'cyan' => translate('Cyan'), 
	'purple' => translate('Purple'), 
	'pink' => translate('Pink'), 
	'violet' => translate('Violet'));

$tpl->assign('font_color', $colors);

// If not logged in (adding event as a guest, don't show admin panel)
if(!$datenator->user->isAuthed)
{
	$showadminpanel = 0;
} else {
	$showadminpanel = 1;
}
$tpl->assign('show_adm_panel', $showadminpanel);

//==================
// DISPLAY TEMPLATE
//==================

require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('a_event.tpl');

/*
 * $Id: a_event.php,v 1.4 2005/07/11 16:59:30 indom Exp $
**/
?>