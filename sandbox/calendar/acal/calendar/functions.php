<?php
ini_set('display_errors', '0');

// Write event function
function acal_addevent($title, $description, $stime, $etime, $allday) {
	
}

// Edit an event
function acal_editevent() {

}

// Remove an event
function acal_rmevent() {

}

// ACal Import allows you to import CSV files exported from Mozilla Calendar.
function acal_import_csv($dir, $csvfile) {
	$row = '1';
	$handle = fopen($csvfile, 'r');
	while (($data = fgetcsv($handle, '1000', ',')) !== FALSE) {
	    if ($row != '1') {
	        $year = substr($data[3], '0', '4');
	        $month = substr($data[3], '4', '2');
	        $day = substr($data[3], '6', '2');
	        $hour = substr($data[3], '9', '2');
	        $minute = substr($data[3], '11', '2');
	        $timestamp = mktime($hour, $minute, 0, $month, $day, $year);
	        
	        // Add filename to array
	        $filenames[] = date('YmdHi', $timestamp) . '.txt';
	        
	        // Put event together and add it to array
	        $title = $data[5];
	        $description = $data[6];
	        if (date('H', $timestamp) != '00') {
	            $time = date('H:i', $timestamp);
	        }
	        else {
	            $time = '';
	        }
	        $class = 'event';
	        $events[] = "$title|-NN-|$description|-NN-|$time|-NN-|$class";
	    }
	    $row++;
	}
	fclose($handle);
	
	$num = '0';
	foreach ($filenames as $filename) {
	    $event = $events[$num];
	    $file = "$dir$filename";
	    $handle = fopen($file, 'w');
	    fwrite($handle, $event);
	    fclose($handle);
	    $num++;
	}
	
	return('<p>Your calendar has been imported.</p>');
}

// This function sorts and then display the calendar events for the day view.
function acal_loadeventsDay($dir, $year, $month, $day) {
	$day = sprintf('%02d' , $day);
	$sieve = '|' . $year . $month . $day . '|';
	$dh  = opendir($dir);
	while (false !== ($filename = readdir($dh))) {
		if (preg_match($sieve, $filename)) {
			$events[] = $filename;
		}
	}
	closedir($dh);
	
	if (isset($events)) {
		sort($events);
		foreach ($events as $event) {
			$data = file_get_contents($dir . $event);
			list($title, $desc, $time, $class) = explode("|-NN-|", $data);
			echo '<div class="day-event"><div class="day-etitle">' . $title . '</div>';
			echo $desc;
			echo '<br /><span>' . $time . '</span></div>';
			echo '<div class="day-ebottom"></div>';
		}
	}
	else {
		echo '<div class="noevents">There are no events for today.</div>';
	}
}

// Authentication function. Checks if username and password are valid.
function login_auth($user, $pass) {
	include 'vault.php';
	$vault = unserialize($vault);
	if (isset($vault[$user]) && $vault[$user] == $pass) {
		$auth = 'true';
	}
	else {
		$auth = 'false';
	}
	return ($auth);
}


// If PHP doesn't have this function create it.
if (!function_exists('file_get_contents')) {
	function file_get_contents($path) {
		$handle = fopen($path, 'r');
		$file = fread($handle, filesize($path));
		fclose($handle);
		return($file);
	}
}
?>