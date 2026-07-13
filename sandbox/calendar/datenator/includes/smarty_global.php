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

/** THIS FILE ASSIGNS GLOBAL TPL VARS **/

$global_smarty_vars = array(
'META_DESCRIPTION' => $datenator->getSetting('meta_description'),
'META_KEYWORDS' => $datenator->getSetting('meta_keywords'),

'PD_S_YEAR' => $datenator->get_year().'-'.$datenator->get_month().'-00',
'PD_START_YEAR' => $datenator->get_year()-10,
'PD_END_YEAR' => $datenator->get_year()+10,
'PD_MONTHS' => $datenator->months_selection('jump_Month', $datenator->get_month(), 'onchange="document.selectmonth.submit()"'),

'DAY_SUFFIX' => $datenator->get_day_suffix($datenator->get_day()),

'YEAR' => $datenator->get_year(),
'MONTH' => $datenator->get_month(),
'DAY' => $datenator->get_day(),
'MONTH_NAME' => $datenator->get_month_name($datenator->get_month()),
'DAY_NAME' => $datenator->get_day_name(),

'C_YEAR' => $datenator->get_c_year(),
'C_MONTH' => $datenator->get_c_month(),
'C_DAY' => $datenator->get_c_day(),
'C_MONTH_NAME' => $datenator->get_month_name($datenator->get_c_month()),
'C_DAY_NAME' => $datenator->get_c_day_name($datenator->get_c_day()),

'PAGE_TITLE_TEXT'=>$datenator->specialchars($datenator->getSetting('pagetitle')),
'PAGE_TITLE' => $datenator->getPageTitle(),
'VERSION' => $datenator->getSetting('version'),
'CALENDAR_URL' => $datenator->getConfig('calendar_url'),
'CSS_FILE' => $datenator->getCSSFile(),
'THEME_NAME' => $datenator->getSetting('theme'),

'LOGIN_LINK' => $datenator->login_link(),

'C_USER_LEVEL' => $datenator->user->getUserLevel(),
'C_USER_NAME' => $datenator->user->getUserName(),
'C_USER_LOGGED_IN' => $datenator->user->isAuthed
);

$tpl->assign('G', $global_smarty_vars);
$tpl->register_block('lang', 'get_translation');

/** ---- Dropdown menus ---- 
$tpl->assign('s_yeardw', $datenator->get_year().'-'.$datenator->get_month().'-00');
$tpl->assign('starty', $datenator->get_year()-10);
$tpl->assign('endy', $datenator->get_year()+10);
$tpl->assign('months_dw', $datenator->months_selection('jump_Month', $datenator->get_month()));
/** ---- -------------- ---- 

/** ---- Common ---- 

$tpl->assign('day_suffix', $datenator->get_day_suffix($datenator->get_day()));

 // calendar dates
$tpl->assign('year', $datenator->get_year());
$tpl->assign('month', $datenator->get_month());
$tpl->assign('day', $datenator->get_day());
$tpl->assign('month_name', $datenator->get_month_name($datenator->get_month()));
$tpl->assign('day_name', $datenator->get_day_name());

 // current dates
$tpl->assign('c_year', $datenator->get_c_year());
$tpl->assign('c_month', $datenator->get_c_month());
$tpl->assign('c_day', $datenator->get_c_day());
$tpl->assign('c_month_name', $datenator->get_month_name($datenator->get_c_month()));
$tpl->assign('c_day_name', $datenator->get_c_day_name($datenator->get_c_day()));

$tpl->assign('pagetitle', $datenator->specialchars($datenator->_sets['pagetitle'])); // Calendar title
$tpl->assign('version', $datenator->_sets['version']); // Software version
$tpl->assign('login_link', $datenator->login_link()); // Log in link
/** ---- ------ ---- 

/** ---- User ---- 
$tpl->assign('c_user_level', $datenator->get_user_level()); // Current users level
$tpl->assign('c_user_name', $datenator->get_finalusername()); // Current users name
$tpl->assign('c_user_logged_in', $datenator->user_is_authed); // Is current user logged in
/** ---- ---- ---- 

$tpl->assign('CALENDAR_URL', $datenator->calendar_url);
$tpl->assign('THEME_NAME', $datenator->_sets['theme']);

if($datenator->user_is_authed) {
	$tpl->assign('CSS_FILE', 'admin');
} else {
	$tpl->assign('CSS_FILE', 'normal');
}

/** ---- Calendar logo ---- 
if(!empty($datenator->_sets['calendar_logo'])) {
	$calendar_logo = '<img src="images/'.$datenator->_sets['calendar_logo'].'" alt="'.$datenator->_sets['pagetitle'].'" />';
	$tpl->assign('title', $calendar_logo);
} else {
	$tpl->assign('title', $datenator->specialchars($datenator->_sets['pagetitle']));
}
/** ---- ------------ ----- 

/*
 * $Id$
**/
?>