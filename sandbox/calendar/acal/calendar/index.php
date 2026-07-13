<?php
if (!file_exists('version.php')) {
	header("Location: installer/");
}
else {
	include 'data/prefs.php';
	if ($view == 'month') {
		$year = date("Y");
		$month = date("m");
		header("Location: calendar.php?year=$year&month=$month");
	}
	elseif ($view == 'day') {
		$year = date("Y");
		$month = date('m');
		$day = date("d");
		$dayheader = 'Location: day.php?year=' . $year . '&month=' . $month . '&day=' . $day;
		header($dayheader);
	}
	else {
		$year = date("Y");
		$month = date("m");
		header("Location: calendar.php?year=$year&month=$month");
	}
}
?>
If you are seeing this than you don't have PHP installed correctly.