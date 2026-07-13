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

class User
{
	var $userId;
	var $userName;
	var $realName;
	var $userLevel;
	var $password;

	var $isAuthed;

	function User()
	{
		global $DB_INSTALL_IN_PROGRESS;
		if(!$DB_INSTALL_IN_PROGRESS)
		{
			$udata = $this->readUserData(false, $check_auth = true);
		
			if($this->isAuthed) {
				/* He's logged */
				$this->setUserId($udata->fields['user_id']);
				$this->setUserName($udata->fields['user_name']);
				$this->setUserLevel($udata->fields['user_level']);
			} else {
				/* We're having a guest here */
				$this->setUserId(0); // 0 = guest
				$this->setUserName(translate('Guest'));
			}
		}
	}

	function setUserName($username)
	{
		$this->userName = $username;
	}

	function getUserName()
	{
		return $this->userName;
	}

	function setUserId($userid)
	{
		$this->userId = $userid;
	}

	function getUserId()
	{
		return $this->userId;
	}

	function setUserLevel($ulevel)
	{
		$this->userLevel=$ulevel;
	}

	function getUserLevel()
	{
		return $this->userLevel;
	}

	function setAccessLevel($level)
	{
		if($this->getUserLevel() != $level) 
		{
			die('<b>Datenator::</b> You don\'t have right permissions to access this file.');
		}
	}

	function readUserData($user_info, $check_auth=false) 
	{
		global $datenator;
		$readUserData=true;

		if(!$user_info && $check_auth) //halutaan tsekata authi, ja jos on haetaan myös userin tiedot.
		{
			if(isset($_COOKIE[''.$datenator->getConfig('cookie_prefix').'auth']) && isset($_COOKIE[''.$datenator->getConfig('cookie_prefix').'pass'])) 
			{
				// authi oli, joten haettavaksi user_id:ksi laiteaan cookiesta löytynyt ID.
				$user_info = $_COOKIE[''.$datenator->getConfig('cookie_prefix').'auth'];
			}
			else
			{
				// authia ei ollut
				$readUserData=false;
				$check_auth = false;
				$this->isAuthed=false;
			}
		}
		if($readUserData) {

			$sql = "SELECT * FROM ".$datenator->getConfig('db_tableprefix')."users WHERE ";

			if(is_numeric($user_info)) 
			{
				$sql .= "user_id = '".$user_info."'";
			} else {
				$sql .= "user_name = '".$user_info."'";
			}

			$user_data = $datenator->db->Execute($sql);

			if($user_data) 
			{
				if($user_data->recordCount()>0)
				{
					if($check_auth) 
					{
						if($user_data->fields['user_pw'] == $_COOKIE[''.$datenator->getConfig('cookie_prefix').'pass']) {
							$this->isAuthed = true;
						} else {
							$this->isAuthed = false;
						}
					} 
					return $user_data;
				} else {
					return false;
				}

			} else {
				$this->DBErrorMSG($datenator->db->ErrorMSG());
			}
		}
	}

	function authedToViewCal()
	{
		global $datenator;
		if(isset($_COOKIE[$datenator->getConfig('cookie_prefix').'authed_to_view'])) 
		{
			if($_COOKIE[$datenator->getConfig('cookie_prefix').'authed_to_view']==$datenator->getSetting('cal_password')) {
				return true;
			} else {
				return false;
			}
		} elseif($this->isAuthed) {
			return true;
		} else {
			return false;
		}
	}
}

/*
 * $Id$
**/
?>