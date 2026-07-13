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

class Datenator
{
	var $db;

	var $_settings;
	var $_cfg;

	var $year;
	var $month;
	var $day;

	var $c_year;
	var $c_month;
	var $c_day;

	var $debug;
	var $debugOn;

	function Datenator()
	{	
		global $timer, $tpl;
		global $DB_INSTALL_IN_PROGRESS;
		
		/* Include Config file and get data. */
		$configfile = 'config.php';
		if(file_exists($configfile)) {
			include($configfile);
		}

		$this->db = $this->db_connect();

		/* DB_DEBUG is defined at init.php */
		if(!DATENATOR_DEBUG) {
			$this->db->debug=false;
		} else {
			if(ereg('LOAD', DATENATOR_DEBUG)) {
				require('debugtimes.php');
				$this->debug = &new PHP_dtime;
				$this->debug->start();
				$this->debugOn = true;
			}

			if(ereg('DB', DATENATOR_DEBUG)) {
				$this->db->debug = true;
			}

			if(ereg('SMARTY', DATENATOR_DEBUG)) {
				$tpl->debugging = true;
			}
		}

		/* We are just installing database, so we can't get settings from
		   database because there are no tables yet. */
		if(!$DB_INSTALL_IN_PROGRESS) {
			$this->_settings = $this->getSettings();
		}

		$this->set_year(date('Y'));
		$this->set_month(date('n'));
		$this->set_day(date('j'));

		$this->c_year = $this->get_c_year();
		$this->c_month = $this->get_c_month();
		$this->c_day = $this->get_c_day();
	}

	function displayTemplate($template)
	{
		global $tpl;
		$tpl->display($template);
		if($this->debugOn)
		{
			$this->debug->stop();
			$this->debug->output();
		}
	}

	function redirectTo($file)
	{
		if($this->debugOn) {
			print '<hr>';
			print '(datenator): redirectTo() | '.$file.'';
			print '<hr>';
		} else {
			header('Location: '.$file);
		}
	}

	function db_connect()
	{
		global $DB_INSTALL_IN_PROGRESS;
		$conn = ADONewConnection($this->getConfig('db_driver'));
		if($conn) {
			$dbres = @$conn->Connect($this->getConfig('db_host'), $this->getConfig('db_user'), $this->getConfig('db_password'), $this->getConfig('db_name'));
			if($dbres) {
				return $conn;
			} else {
				if($DB_INSTALL_IN_PROGRESS) {
					return false;
				} else {
					die('Can\'t connect to the database. If you have not installed datenator yet, <a href="install.php">please do it now</a>. <br />If you\'ve installed datenator already, it seems that some of the db settings are not correct. Please double-check <i>config.php</i>.');
				}
			}
		} else {
			die('Can\'t connect to the database. If you have not installed datenator yet, <a href="install.php">please do it now</a>. <br />If you\'ve installed datenator already, it seems that some of the db settings are not correct. Please double-check <i>config.php</i>.');
		}
	}

	function setConfig($cfgName, $value)
	{
		$this->_cfg[$cfgName] = $value;
	}

	function getSetting($stName)
	{
		return $this->_settings[$stName];
	}

	function getConfig($cfgName)
	{
		return $this->_cfg[$cfgName];
	}

	function set_day($day)
	{
		$this->day = $day;
	}

	function get_day()
	{
		return $this->day;
	}

	function set_year($year)
	{
		$this->year = $year;
	}

	function get_year()
	{
		return $this->year;
	}

	function set_month($month)
	{
		$this->month = $month;
	}

	function get_month()
	{
		return $this->month;
	}

	function get_c_year()
	{
		return date('Y');
	}

	function get_c_month()
	{
		return date('n');
	}

	function get_c_day()
	{
		return date('j');
	}

	function get_month_name($m)
	{
		$months = $this->get_translated_months();
		return $months[$m];
	}

	function get_day_name()
	{
		$days=$this->get_translated_days();
		$w=adodb_date('w', adodb_mktime(0, 0, 0, $this->get_month(), $this->day, $this->get_year()));
		return $days[$w];
	}

	function get_c_day_name()
	{
		$days=$this->get_translated_days();
		$w=adodb_date('w', adodb_mktime(0, 0, 0, $this->get_c_month(), $this->get_c_day(), $this->get_c_year()));
		return $days[$w];
	}

	function get_day_suffix($d)
	{
		return adodb_date('S', adodb_mktime(0, 0, 0, $this->get_month(), $d, $this->get_year()));
	}

	function getPageTitle()
	{
		if(trim($this->getSetting('calendar_logo'))=='') {
			return 'lolol';
		} else {
		$calendar_logo = '<img src="images/'.$this->getSetting('calendar_logo').'" alt="'.$this->getSetting('pagetitle').'" />';
		return $calendar_logo;
		}
		//return "calendar title goes here";
	}

	function getCSSFile()
	{
		if(defined('IN_ADMIN')) {
			return 'admin.css';
		} else {
			return 'normal.css';
		}
	}

	function makeLogEntry($user,$eventId,$eventName,$type)
	{
		$userId=$user->getUserId();
		$userName=$user->getUserName();
		$date=time();
		$sql="INSERT INTO ".$this->getConfig('db_tableprefix')."events_log 
		(log_type,log_author,log_authorid,log_date,log_event_id,log_event_name) VALUES
		('".$type."', '".$userName."', '".$userId."', '".$date."', '".$eventId."','".$eventName."')";
		$this->db->Execute($sql);
	}


	/**
	* Returns an associative array containing 
	* default calendar settings.
	*
	* @return array containing default calendar settings
	*/

	function get_defaults() 
	{
		$defaults = array(
			'allow_guestadd'	=> '0', 
			'first_day'				=> '1', 
			'language'				=> 'English', 
			'meta_description' => 'Welcome to my event calendar', 
			'meta_keywords'		=> 'Event, Calendar, Datenator, Planning, Scheduling', 
			'pagetitle'				=> 'Datenator', 
			'show_weeks'			=> '1', 
			'version'					=> '0.3.0',
			'calendar_logo'		=> 'logo_sm.gif',
			'preferred_view'	=> 'month',
			'cal_has_pw'			=> '0',
			'cal_password'		=> '',
			'event_popup_width' => '500',
			'event_popup_height' => '300',
			'theme'							=> 'plain');

		return $defaults;
	}

	/**
	* Translates months and returns them in an array
	*
	* @return array with translated months
	*/

	function get_translated_months()
	{
		$months = array(
			1 => translate('January'), 
			2 => translate('February'), 
			3 => translate('March'), 
			4 => translate('April'),
			5 => translate('May'),
			6 => translate('June'), 
			7 => translate('July'),
			8 => translate('August'),
			9 => translate('September'),
			10 => translate('October'),
			11 => translate('November'),
			12 => translate('December'));

		return $months;
	}

	/**
	* Translates weekdays and returns them in an array
	*
	* @return array with translated days
	*/

	function get_translated_days()
	{
		$days = array(
			0 => translate('Sunday'),
			1 => translate('Monday'), 
			2 => translate('Tuesday'), 
			3 => translate('Wednesday'), 
			4 => translate('Thursday'),
			5 => translate('Friday'),
			6 => translate('Saturday'));

		return $days;
	}

	function get_translated_days_abr()
	{
		$days = array(
			0 => translate('Sun'), 
			1 => translate('Mon'), 
			2 => translate('Tue'), 
			3 => translate('Wed'), 
			4 => translate('Thu'), 
			5 => translate('Fri'), 
			6 => translate('Sat'));

		return $days;
	}

	/**
	* Gets user & calendar settings from database
	*
	* @return array with settings
	*/

	function getSettings() 
	{
		global $ADODB_FETCH_MODE;
		$sets = array();
		$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		$records = $this->db->Execute("select setting_name,setting_value from ".$this->getConfig('db_tableprefix')."settings");

		if($records) {

			while (!$records->EOF) 
			{
				$settings[$records->fields[0]] = $records->fields[1];
				$records->moveNext();
			}

			return $settings;
		} else {
			$this->DBErrorMSG($this->db->ErrorMSG());
		}
	}

	function DBErrorMSG($msg=false)
	{
		if(!$msg) {
			$msg='Can\'t connect to database';
		}
		die('Datenator error: <b>'.$msg.'</b>');
	}


	/**
	* Make values safe to be inserted into sql
	*
	* @param string value
	*
	* @return cleaned value
	*/
	function prepare_sql($value)
	{
		if(!get_magic_quotes_gpc()) {
			if(!is_numeric($value)) {
				$value = mysql_real_escape_string($value);
			}
		}
		return $value;
	}

	/**
	* Makes text clean
	*
	* '&' (ampersand) becomes '&amp;'
	* '"' (double quote) becomes '&quot;'
	* ''' (single quote) becomes '&#039;'
	* '<' (less than) becomes '&lt;'
	* '>' (greater than) becomes '&gt;' 
	*
	* @return encoded text
	*/

	function specialchars($value)
	{
		$value = htmlspecialchars($value);
		return $value;
	}

	/**
	* Reads event info into an array
	*
	* @param event_id: ID of the event we want to look at
	*
	* @return array containing event info
	*/

	function read_event_info($event_id)
	{
		$sql = "SELECT * FROM 
		".$this->getConfig('db_tableprefix')."events,
		".$this->getConfig('db_tableprefix')."events_repeat 
		WHERE 
		".$this->getConfig('db_tableprefix')."events.event_id = ".$this->prepare_sql($event_id)." and  
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_event_id = ".$this->prepare_sql($event_id)."";

		$event_data=$this->db->Execute($sql);

		if($event_data) {
			return $event_data;
		} else {
			$this->DBErrorMSG($this->db->ErrorMSG());
		}
	}

	/**
	* Makes an nice HTML selection and selects option
	* if wanted.
	*
	* @param name of the selection
	* @param array containing stuff we want to put in selection
	* @param selected item
	*
	* @return string containing HTML code of the selection
	*/

	function make_selection($name, $array, $selected = false, $other='') 
	{
		if(!empty($other)) {
			$other = ' '.$other.'';
		}
		$ret = '';
		$ret .= '<select name="'.$name.'"'.$other.'>';
		foreach($array as $key => $value) {
			$ret .= '<option value="'.$key.'"';
			if($selected != false) {
				if($key == $selected) {
					$ret .= ' selected="selected"';
				}
			}
			$ret .= '>'.$value.'</option>';
		}
		$ret .= '</select>';
		return $ret;
	}

	/**
	* Makes month dropdown box
	*
	* @param name of the selection
	* @param selected item
	*
	* @return string containing HTML code of the selection
	*/

	function months_selection($name, $selected = false,$other=false) 
	{
		$months = $this->get_translated_months();

		$ret = $this->make_selection($name, $months, $selected,$other);
		return $ret;
	}

	/**
	*
	*
	*/


	/**
	*
	*
	*/



	/**
	* Login link
	*
	* @return string containing login link
	*/
	function login_link() 
	{
		$ret = '';

		if(!$this->user->isAuthed) {
			$ret .= '<a class="menu" href="login.php" title="'.translate('Log in').'">'.translate('Log in').'</a>';
		} else {
			$ret .= '<a class="menu" href="logout.php" title="'.translate('Log out').'">'.translate('Log out').'</a>';
		}

		return $ret;
	}

	/**
	* Link to next month
	*
	* @return string containing link to next month
	*/
	function next_month() {

		if($this->month == 12) {
			$next_year = $this->year+1;
			$next_month = 1;
		} elseif($this->month == 1) {
			$next_year = $this->year;
			$next_month = $this->month+1;
		} else {
			$next_year = $this->year;
			$next_month = $this->month+1;
		}
		$months = $this->get_translated_months();
		$ret = '<a class="big" href="?jump_Month='.$next_month.'&amp;year='.$next_year.'">'.$months[$next_month].' &raquo;</a>';
		return $ret;
	}

	/**
	* Link to previous month
	*
	* @return string containing link to previous month
	*/
	function previous_month() {

		if($this->month == 12) {
			$prev_year = $this->year;
			$prev_month = $this->month-1;
		} elseif($this->month == 1) {
			$prev_year = $this->year-1;
			$prev_month = 12;
		} else {
			$prev_year = $this->year;
			$prev_month = $this->month-1;
		}
		$months = $this->get_translated_months();
		$ret = '<a class="big" href="?jump_Month='.$prev_month.'&amp;year='.$prev_year.'">&laquo; '.$months[$prev_month].'</a>';
		return $ret;
	}

	/**
	* Link to previous year
	*
	* @return string containing link to previous year
	*/
	function previous_year()
	{
		$new_year=$this->year-1;
		$ret = '<a href="?jump_Year='.$new_year.'">&laquo; '.$new_year.'</a>';
		return $ret;
	}

	/**
	* Link to previous year
	*
	* @return string containing link to previous year
	*/
	function next_year()
	{
		$new_year=$this->year+1;
		$ret = '<a href="?jump_Year='.$new_year.'">'.$new_year.' &raquo;</a>';
		return $ret;
	}

	/**
	* isLeapYear function borrowed from PEAR Date_Calc class
	*/
	function isLeapYear($year='') {
		if (empty($year)) $year = strftime("%Y",time());
		if (strlen($year) != 4) return false;
		if (preg_match('/\D/',$year)) return false;
		return (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0);
	}

	/**
	* gregorianToISO function borrowed from PEAR Date_Calc class
	* (Changes noted)
	*/
	function gregorianToISO($day,$month,$year) {
    $mnth = array (0,31,59,90,120,151,181,212,243,273,304,334);
    $y_isleap = $this->isLeapYear($year);
    $y_1_isleap = $this->isLeapYear($year - 1);
    $day_of_year_number = $day + $mnth[$month - 1];
    if ($y_isleap && $month > 2) {
        $day_of_year_number++;
    }
    // find Jan 1 weekday (monday = 1, sunday = 7)
    $yy = ($year - 1) % 100;
    $c = ($year - 1) - $yy;
    $g = $yy + intval($yy/4);
    $jan1_weekday = 1 + intval((((($c / 100) % 4) * 5) + $g) % 7);
		
		// change: compensate weeks begin on sunday
    if ($jan1_weekday < 7) {
      $jan1_weekday++;
    } elseif($jan1_weekday == 7) {
      $jan1_weekday=1;
    }

    // weekday for year-month-day
    $h = $day_of_year_number + ($jan1_weekday - 1);
    $weekday = 1 + intval(($h - 1) % 7);
    // find if Y M D falls in YearNumber Y-1, WeekNumber 52 or
    if ($day_of_year_number <= (8 - $jan1_weekday) && $jan1_weekday > 4){
        $yearnumber = $year - 1;
        if ($jan1_weekday == 5 || ($jan1_weekday == 6 && $y_1_isleap)) {
            $weeknumber = 53;
        } else {
            $weeknumber = 52;
        }
    } else {
        $yearnumber = $year;
    }
    // find if Y M D falls in YearNumber Y+1, WeekNumber 1
    if ($yearnumber == $year) {
        if ($y_isleap) {
            $i = 366;
        } else {
            $i = 365;
        }
        if (($i - $day_of_year_number) < (4 - $weekday)) {
            $yearnumber++;
            $weeknumber = 1;
        }
    }
    // find if Y M D falls in YearNumber Y, WeekNumber 1 through 53
    if ($yearnumber == $year) {
        $j = $day_of_year_number + (7 - $weekday) + ($jan1_weekday - 1);
        $weeknumber = intval($j / 7);
        if ($jan1_weekday > 4) {
            $weeknumber--;
        }
    }
    // put it all together
    if ($weeknumber < 10)
        $weeknumber = '0'.$weeknumber;
    return "{$yearnumber}-{$weeknumber}-{$weekday}";
	}

	function week_number($day) 
	{
		$isov = $this->gregorianToISO($day, $this->month, $this->year);
		$parts = explode('-', $isov);
		$week_number = $parts[1];

		return sprintf("%02d",$week_number);
	}

	function get_monday_before ( $year, $month, $day ) {
  $weekday = date ( "w", mktime ( 3, 0, 0, $month, $day, $year ) );
  if ( $weekday == 0 )
    return mktime ( 3, 0, 0, $month, $day - 6, $year );
  if ( $weekday == 1 )
    return mktime ( 3, 0, 0, $month, $day, $year );
  return mktime ( 3, 0, 0, $month, $day - ( $weekday - 1 ), $year );
	}

	function print_week_view($day,$month,$year)
	{
		global $event_array;
		$event_array=array();

		$ret='';
		$start=$this->get_monday_before(2005,5,3);
		$first_day=date('j', $start);

		$ret.= '<table border="1" width="90%">';
		$ret.=  '<tr>';
		$ret.=  '<td>Klo</td>';

		$weeks_first_day=$this->_sets['first_day'];
		$days=$this->get_translated_days();
			for($i=0; $i <= $weeks_first_day; $i++) {
				$tempday = array_shift($days);
				array_push($days, $tempday);
			}
		$i=0;

		for($day=$first_day;$day<($first_day+7); $day++) {

				$lol=$this->get_events_Ar($day,false);
			}
			print_r($lol);

		for($d=0; $d<7; $d++) 
		{
			$ret.=  '<td>'.$days[$d].'</td>';
		}
		$ret.=  '</tr>';

		for($u=0; $u<24; $u++)
		{
			if($u < 10) 
			{
				$hour = '0'.$u.':00';
			} else {
				$hour = $u.':00';
			}
		
			$ret.=  '<tr>';
			$ret.=  '<td>'.$hour.'</td>';
		
			for($day=$first_day;$day<($first_day+7); $day++) {
				$ret.= '<td>&nbsp;';
				$ret .= 'Paiva '.$day.' '.$hour.'';
				$lol=$this->get_events_Ar($day,$hour);
				//print_r($lol);
				$ret.=  '</td>';
			}
		}
		$ret.=  '</tr>';
		$ret.=  '</tr>';
		$ret.=  '</table>';
		return $ret;
	}



	function print_year_view()
	{
		$cachemonth=$this->month;
		$ret='';
		$ret .='<br /><table border="0" width="100%">';
		$ret.='<tr>';
		$g=0;
		for($i=1; $i<=12; $i++)
		{
			$g++;
			$this->set_month($i);
			$ret.='<td valign="top" align="center">';
			$ret.=$this->make_calendar('200', $show_events=false);
			$ret.='</td>';

			if($g==4) { 
				$ret.='</tr><tr>';
				$g=0;
			}

		}
		$ret.='<td colspan="4">&nbsp;</td></tr></table>';
		$this->set_month($cachemonth);
			return $ret;
	}
			

	/**
	* Print the whole calendar
	*/
	function make_calendar($width='100%',$show_events=true) 
	{
		global $ret, $text;

		$months = $this->get_translated_months();

		if($show_events == false)
		{
			$month_title_html = '<td colspan="8" class="little_month_title">'.$months[$this->month].'</td></tr><tr>';
			$days = $this->get_translated_days_abr();
			$week_text = '';
			$class_dnumber='little_day_number';
			$class_normal='little_day_normal';
			$class_now='little_day_now';
			$class_empty='little_day_empty';
			$class_table='normal_table';
			$class_wday='month_little_wday';
		} else {
			$month_title_html='';
			$days = $this->get_translated_days();
			$week_text = translate('Week');
			$class_dnumber='day_number';
			$class_normal='day_normal';
			$class_now='day_now';
			$class_empty='day_empty';
			$class_table='b_table';
			$class_wday='month_wday';
		}

		$weeks_first_day = $this->getSetting('first_day');

		$ret = '';
		$ret .= '<table class="'.$class_table.'" width="'.$width.'">';
		$ret .= '<tr>';
		$ret .= $month_title_html;

		$first_day = adodb_date('w', adodb_mktime(0, 0, 0, $this->month, 1, $this->year));

			if($weeks_first_day != 0) {
				$tempday = '';
				for($i=0; $i < $weeks_first_day; $i++) {
					$tempday = array_shift($days);
					array_push($days, $tempday);
				}

				if($first_day < $weeks_first_day) {
					$first_day = $first_day + 7 - $weeks_first_day;
				} else {
					$first_day -= $weeks_first_day;
				}
			}

			if($first_day == 0) {
				$day = 1;
			} else {
				$day = 0;
			}

			$days_in_month = adodb_date('t', adodb_mktime(0, 0, 0, $this->month, 1, $this->year));

			if(!$show_events){
				$ret .= '<td>&nbsp;</td>';
			}

			foreach($days as $dayname) {
				$ret .= '<td class="'.$class_wday.'">'.$dayname.'</td>';
			}

			$ret .= '</tr>';

			$current_year = adodb_date('Y');
			$current_month = adodb_date('n');
			$current_day = adodb_date('j');

			while($day <= $days_in_month) {
				$ret .= '<tr>';
				$week_count = 0;
				for($i = 0; $i < 7; $i++) {

					$week_count++;

					if(!$show_events){
						if($week_count == 1) {
							$week=$this->week_number($day);
							if($week>53){
								$week =1;
							}
							$ret .= '<td class="'.$class_normal.'">'.$week.'</td>';
						} elseif($week_count==7) {
							$week_count=0;
						}
					}

					if($day > 0 && $day <= $days_in_month) {

						if(($day == $current_day) && 
							($this->month == $current_month) && 
							($this->year == $current_year)) 
						{
							$class = $class_now;
						} else {
							$class = $class_normal;
						}

						$ret .= '<td class="'.$class.'">';

						$ret .= '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
						$ret .= '<tr>';
						$ret .= '<td>';

						$ret .= '<a class="'.$class_dnumber.'" href="day.php?day='.$day.'&amp;month='.$this->month.'&amp;year='.$this->year.'">'.$day.'</a>';

						// Show week number if wanted
						if($show_events) {
							if($this->getSetting('show_weeks')) {

								if($week_count == 1) 
								{
									$ret .= ' <span class="weektext">';
									$week = $this->week_number($day);

									if($week > 53) {
										$week = 1;
									}

									$ret .= $week_text.' '.$week.'</span><br />';
								} 
								elseif($week_count == 7) 
								{
									$week_count = 0;
								}
							}
						}

						$ret .= '</td>';
						$ret .= '<td align="right" valign="top">';

						if($show_events) {

							if($this->getSetting('allow_guestadd') || $this->user->isAuthed) {

								$ret .= $this->print_add_button($this->year.'-'.$this->month.'-'.$day);
							} else {
								$ret .= '&nbsp;';
							}
						}

						$ret .= '</td>';
						$ret .= '</tr>';
						$ret .= '<tr>';
						$ret .= '<td colspan="2" valign="top">';
						if($show_events){
							$this->get_events($day);
						}

						$ret .= '</td>';
						$ret .= '</tr>';
						$ret .= '</table>';


 
						$ret .= '</td>';
						$day++;
					} elseif($day == 0) {
						$ret .= '<td class="'.$class_empty.'">&nbsp;</td>';
						$first_day--;
						if($first_day == 0) {
							$day++;
						} 
					} else {
						$ret .= '<td class="'.$class_empty.'">&nbsp;</td>';
					}
				}
				$ret .= '</tr>';
			}
			$ret .= '</table>';

			return $ret;
	}

	function get_hour($time)
	{
		return substr($time,0,2);
	}

	function get_mins($time)
	{
		return substr($time,3);
	}

	/**
	* Print event
	**/

	function print_event($starthour=false)
	{
		global $event;
		$ret = '';
		$style = '';
		if($starthour!=false)
		{
			if($this->get_hour($event->fields['event_starttime'])==$starthour) {
				$print=true;
			} else {
				$print=false;
			}
		} else {
			$print=true;
		}

		if($print){

		switch($event->fields['event_font']) 
		{
			case 'default':$style .= '';
			break;
			default: $style .= 'font-family: '.$event->fields['event_font'].'; ';
			break;
		}

		switch($event->fields['event_fontstyle'])
		{
			case 'bold': $style .= 'font-weight: bold; ';
			break;
			case 'italic': $style .= 'font-style: italic; ';
			break;
			case 'bolditalic': $style .= 'font-weight: bold; font-style: italic; ';
			break;
			default: $style .= '';
			break;
		}

		switch($event->fields['event_fontcolor'])
		{
			case 'default': $style .= '';
			break;
			default: $style .= 'color: '.$event->fields['event_fontcolor'].'; ';
			break;
		}

		switch($event->fields['event_fontsize'])
		{
			case 'default': $style .= '';
			break;
			default: $style .= 'font-size: '.$event->fields['event_fontsize'].'px; ';
			break;
		}

		$ret .= '<a href="#" onclick="popup(\'event.php?id='.$event->fields['event_id'].'\','.$event->fields['event_id'].', '.$this->getSetting('event_popup_width').', '.$this->getSetting('event_popup_height').')" onmouseover="return overlib(\''.$this->replace_whitespaces($event->fields['event_description']).'\', CAPTION,  \''.$event->fields['event_name'].'\', BGCLASS, \'popup_bg\', FGCLASS, \'popup_fg\', TEXTFONTCLASS, \'popup_text\', CAPTIONFONTCLASS, \'popup_cp_text\');" onmouseout="return nd();" style="'.$style.'">'.$this->specialchars($event->fields['event_name']).'</a>';

		if($this->user->isAuthed) {
			$ret .= ' <a class="edit" href="a_event.php?edit='.$event->fields['event_id'].'" title="'.translate('Edit').'"><img border="0" src="images/edit.gif" title="'.translate('Edit').'" alt="'.translate('Edit').'" /></a>';

			$ret .= ' <a class="edit" href="#" onclick="popup(\'delete_event.php?id='.$event->fields['event_id'].'\', '.$event->fields['event_id'].', 500, 300)" title="'.translate('Delete').'"><img border="0" src="images/delete.gif" alt="'.translate('Delete').'" title="'.translate('Delete').'" /></a>';
		}
		$ret .= '<br />';
		return $ret;
		}
	}

	function print_add_button($date,$hour=false)
	{
		$url = 'a_event.php?date='.$date;
		if($hour!=false) {
			$url .= '&amp;hour='.$hour;
		}
		$ret ='';
		$ret.='<a class="add" href="'.$url.'" title="'.translate('Add event to this day').'"><img border="0" src="images/add.gif" title="'.translate('Add event to this day').'" alt="'.translate('Add event to this day').'" /></a>';
		return $ret;
	}


	function print_day_view()
	{
		global $ret;
		$ret='';
		
		for($i=0; $i<24; $i++)
		{
			if($i < 10) 
			{
				$hour = '0'.$i.':00';
			} else {
				$hour = $i.':00';
			}

			$ret.= '<tr>';
			$ret.= '<td class="dayview_hours">'.$hour.' '.$this->print_add_button($this->year.'-'.$this->month.'-'.$this->day).'</td>';
			$ret.= '<td class="dayview_eventlist">&nbsp;';
			$this->get_events($this->get_day(),$hour);
			$ret.='</td>';
			$ret.= '</tr>';
		}
		return $ret;
	}

	function replace_whitespaces($text)
	{
		$text = str_replace("\n", " ", $text);
		$text = str_replace("\r", " ", $text);
		return $text;
	}

	/**
	* Check that event is in range.
	*/

	function is_in_range($day)
	{
		global $event, $ret;

		$startmonth = $event->fields['event_month'];
		$closemonth = $event->fields['repeat_closemonth'];

	  $startyear = $event->fields['event_year'];
		$closeyear = $event->fields['repeat_closeyear'];

		$startday = $event->fields['event_day'];
		$closeday = $event->fields['repeat_closeday'];

		$startdate = adodb_mktime(0, 0, 0, $startmonth, $startday, $startyear);

		$closedate = adodb_mktime(0, 0, 0, $closemonth, $closeday, $closeyear);

		$currentdate = adodb_mktime(0, 0, 0, $this->month, $day, $this->year);

		if(!$event->fields['repeat_useclosedate']) {
			if($startdate <= $currentdate) {
				return true;
			} else {
				return false;
			}
		} else {
			if($startdate <= $currentdate && $closedate >= $currentdate) {
				return true;
			} else {
				return false;
			}
		}
	}

	function get_events($day,$starttime=false) 
	{
		global $ret, $event;

		$sql = "SELECT 
		".$this->getConfig('db_tableprefix')."events.event_id, 
		".$this->getConfig('db_tableprefix')."events.event_type, 
		".$this->getConfig('db_tableprefix')."events.event_year, 
		".$this->getConfig('db_tableprefix')."events.event_month, 
		".$this->getConfig('db_tableprefix')."events.event_day,  
		".$this->getConfig('db_tableprefix')."events.event_name, 
		".$this->getConfig('db_tableprefix')."events.event_description, 
		".$this->getConfig('db_tableprefix')."events.event_font, 
		".$this->getConfig('db_tableprefix')."events.event_fontsize, 
		".$this->getConfig('db_tableprefix')."events.event_fontstyle, 
		".$this->getConfig('db_tableprefix')."events.event_fontcolor, 
		".$this->getConfig('db_tableprefix')."events.event_starttime,

		".$this->getConfig('db_tableprefix')."events_repeat.repeat_event_id, 
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_type, 
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_closeyear, 
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_closemonth, 
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_closeday, 
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_frequency, 
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_days, 
		".$this->getConfig('db_tableprefix')."events_repeat.repeat_useclosedate 

		FROM ".$this->getConfig('db_tableprefix')."events, ".$this->getConfig('db_tableprefix')."events_repeat 
		WHERE ".$this->getConfig('db_tableprefix')."events.event_id = ".$this->getConfig('db_tableprefix')."events_repeat.repeat_event_id";

		$event = $this->db->Execute($sql);

		$starthour=$this->get_hour($starttime);

		while(!$event->EOF) 
		{
			if($event->fields['event_type'] == 'R') 
			{		 
				$startmonth = $event->fields['event_month'];
				$startyear = $event->fields['event_year'];

				/**
				* Monthly repeat type
				*/
				if($event->fields['repeat_type'] == 'm') 
				{
					if($this->is_in_range($day)) {
						$showday = $event->fields['event_day'];
						if($day == $showday) 
						{
							$cem = $startmonth;
							for($g = $cem; $g <= $this->month; $g++) 
							{
								if($cem > $this->month) 
								{
									break;
								} 
								elseif($cem == $this->month) 
								{
									$ret .= $this->print_event($starthour);
									$cem = 0;
								} 
								else 
								{
									$cem += $event->fields['repeat_frequency'];
								}
							}
						}
					}
				} 

				/**
				* Yearly repeat type
				*/
				elseif($event->fields['repeat_type'] == 'y') 
				{
					$showday = $event->fields['event_day'];

					if($this->month == $startmonth && $day == $showday) 
					{
						$cem = $startyear;
						for($g = $cem; $g <= $this->year; $g++) 
						{
							if($cem > $this->year) 
							{
								break;
							} elseif($cem == $this->year) {
								$ret .= $this->print_event($starthour);
								$cem = 0;
							} else {
								$cem += $event->fields['repeat_frequency'];
							}
						}
					}
				} 
				
				/**
				* Weekly repeat type
				*/
				elseif($event->fields['repeat_type'] == 'w') 
				{
	

					if($this->is_in_range($day)) 
					{
						$startday = $event->fields['event_day'];
						$startmonth = $event->fields['event_month'];
						$startyear = $event->fields['event_year'];

						$startweek=adodb_date('W', adodb_mktime(0, 0, 0, $this->month, $event['event_day'], $this->year));

						$cweek = adodb_date('W', adodb_mktime(0, 0, 0, $this->month, $day, $this->year));
						//$cweek = $this->week_number($day);
						//$ret .= $cweek;
						$cweekday = adodb_date('w', adodb_mktime(0, 0, 0, $this->month, $day, $this->year));

						$cem = $startweek;


						$daysar = explode(',', $event['repeat_days']);

						if(in_array($cweekday, $daysar)) 
						{
							for($g = $cem; $g <= $cweek; $g++) 
							{
								if($cem > $cweek) {
									break;
								} 
								elseif($cem == $cweek) 
								{
									$ret .= $this->print_event($starthour);
									$cem = 0;
								} 
								else 
								{
									$cem += $event->fields['repeat_frequency'];
								}
							}
						}
					}
				} 
				/**
				* Daily repeat type
				*/
				elseif($event->fields['repeat_type'] == 'd') 
				{
					
					$startmonth = $event->fields['event_month'];
					if($this->month == $startmonth) {
						$startday = $event->fields['event_day'];
					} else {
						$startday = 1;
					}

					if($this->is_in_range($day)) 
					{
						$cem = $startday;
						for($g = $cem; $g <= $day; $g++) 
						{
							if($cem > $day)
							{
								break;
							} 
							elseif($cem == $day) 
							{
								$ret .= $this->print_event($starthour);
								$cem = 0;
							}
							else 
							{
								$cem += $event->fields['repeat_frequency'];
							}
						}
					}
				/**
				* New repeat type here
				*/
				} // elseif...
			} 
			elseif($event->fields['event_type'] == 'E') 
			{
				$startday = $event->fields['event_day'];
				$startmonth = $event->fields['event_month'];
				$startyear = $event->fields['event_year'];

				if($day == $startday && $this->month == $startmonth && $this->year == $startyear) 
				{
					$ret .= $this->print_event($starthour);
				}
			}
			$event->moveNext();
		}
		return $ret;
	}
}

/*
 * $Id$
**/
?>