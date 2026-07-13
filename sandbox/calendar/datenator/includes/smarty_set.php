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

require('smarty/libs/Smarty.class.php');
$tpl = new Smarty;
$tpl->template_dir='themes/'.$datenator->getSetting('theme').'/templates';
$tpl->caching = false;
$tpl->cache_lifetime = 3600;


if(ini_get('safe_mode') == 1)
{
	$tpl->use_sub_dirs = false;
} else {
	$tpl->user_sub_dirs = false;
}


/*
 * $Id$
**/
?>