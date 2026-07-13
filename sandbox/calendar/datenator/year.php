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

if(isset($_GET['jump_Year']))
{
	$datenator->set_year($_GET['jump_Year']);
}

$tpl->assign('next_year', $datenator->next_year());
$tpl->assign('previous_year', $datenator->previous_year());
$tpl->assign('year_view_html', $datenator->print_year_view());

// Display page
require(INCLUDE_DIR.'smarty_global.php');
$datenator->displayTemplate('year.tpl');

/*
 * $Id$
**/
?>