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

if(isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year']))
{
	$datenator->set_year($_GET['year']);
	$datenator->set_month($_GET['month']);
	$datenator->set_day($_GET['day']);
}

$tpl->assign('dayview_html', $datenator->print_day_view());
$tpl->assign('little_cal', $datenator->make_calendar('250',false));

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('day.tpl');

/*
 * $Id$
**/
?>