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

if(isset($_POST['edit_calendar']))
{
	$defaults = $datenator->get_defaults();
	foreach($defaults as $column => $value) {
		if($column == 'cal_has_pw') 
		{
			if(isset($_POST['cal_has_pw'])) {
				$value='1';
			} else {
				$value='0';
			}
		} elseif($column == 'cal_password') {
			if(isset($_POST['cal_has_pw'])) {
				$value=md5($_POST['cal_password']);
			}
		} elseif($column == 'theme') {
			$value=$datenator->getSetting('theme');
		} else {
			$value = $datenator->prepare_sql($_POST[''.$column.'']);
		}


		$datenator->db->Execute("UPDATE ".$datenator->getConfig('db_tableprefix')."settings SET 
		setting_value = '".$value."' WHERE setting_name = '".$datenator->prepare_sql($column)."'");

		//print "UPDATE ".$datenator->db_tablepre."settings SET 
		//setting_value = ".$value." WHERE setting_name = ".$column."<br>";
	}
	header('Location: preferences.php');
}

$options = array(1 => translate('Yes'), 0 => translate('No'));

$tpl->assign('v', array(
	'e_popup_width' => $datenator->getSetting('event_popup_width'),
	'e_popup_height' => $datenator->getSetting('event_popup_height'),
	'pagetitle' => $datenator->specialchars($datenator->getSetting('pagetitle')),
	'meta_kw' => $datenator->specialchars($datenator->getSetting('meta_keywords')),
	'meta_descr' => $datenator->specialchars($datenator->getSetting('meta_description')),
	'logo' => $datenator->specialchars($datenator->getSetting('calendar_logo'))));


// Get language files, valid: 'lang_smth.php'
$languages = array();
$dir = opendir(LANGUAGE_DIR);

while ($ltied = readdir($dir)) 
{ 
	if(!is_dir($ltied)) {
		$languages[substr($ltied, 0, -4)] = substr($ltied, 0, -4);
	}
}

$tpl->assign('language_selection', $datenator->make_selection('language', $languages, $datenator->getSetting('language')));

$views=array('month' => translate('Month'), 'year' => translate('Year'), 'day' => translate('Day'));
$tpl->assign('preferred_view_selection', $datenator->make_selection('preferred_view',$views,$datenator->getSetting('preferred_view')));

$s_show_weeks = $datenator->getSetting('show_weeks');
$tpl->assign('show_weeks', $options);
$tpl->assign('s_show_weeks', $s_show_weeks);

$firstdays = array(
0 => translate('Sunday'), 
1 => translate('Monday'));

$s_firstday = $datenator->getSetting('first_day');
$tpl->assign('s_first_day', $s_firstday);
$tpl->assign('first_day', $firstdays);


$s_guestadd = $datenator->getSetting('allow_guestadd');
$tpl->assign('s_guestadd', $s_guestadd);
$tpl->assign('guestadd', $options);

$cal_pw_check = array(1 => '');
$tpl->assign('cal_pw_check', $cal_pw_check);
$tpl->assign('cal_has_pw', $datenator->getSetting('cal_has_pw'));

require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('preferences.tpl');

/*
 * $Id$
**/
?>