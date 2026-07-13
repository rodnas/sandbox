<?php
// Include some files
include 'functions.php';
include 'data/prefs.php';

// Turn debug mode on if set
if ($debug == 'on') {
	ini_set('display_errors', '1');
}

session_start();
if ($_SESSION['ACalAuthenticate'] != 'inside') {
	if ($protectionType = 'all' || $protectionType = 'admin') {
		$redirectlocation = 'Location: login_mini.php?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day'];
		header($redirectlocation);
	}
}

if (isset($_POST['remove']) && $_POST['remove'] == 'yes' && $_GET['mode'] == 'edit') {
	unlink('data/' . $_GET['file']);
	header('Location: e_edit.php?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day']);
	exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
 <head>
  <title>Calendar Admin</title>
  <link rel="stylesheet" title="Default" type="text/css" href="style.css" />
  <script type="text/javascript" src="icode.js"></script>
  <script src="e_edit.js" type="text/javascript"></script>
 </head>
 <body onload="opener.window.location.reload()">
  <div class="paneltwo">
  <p>[ <a href="calendar.php">View Calendar</a> ]</p>
   <h2>Add Event</h2>
   <form action="e_edit.php?action=add<?php echo '&year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day']; ?>" method="post" name="addevent">
    <input type="hidden" name="year" value="<?php echo $_GET['year']; ?>" />
    <input type="hidden" name="month" value="<?php echo $_GET['month']; ?>" />
    <input type="hidden" name="day" value="<?php echo $_GET['day']; ?>" />
    
    <p>Start Time: <select name="hour">
	<option value="01"<?php
	if (date("h") == 01) {
	?> selected="selected"<?php } ?>>01</option>
	<option value="02"<?php
	if (date("h") == 02) {
	?> selected="selected"<?php } ?>>02</option>
	<option value="03"<?php
	if (date("h") == 03) {
	?> selected="selected"<?php } ?>>03</option>
	<option value="04"<?php
	if (date("h") == 04) {
	?> selected="selected"<?php } ?>>04</option>
	<option value="05"<?php
	if (date("h") == 05) {
	?> selected="selected"<?php } ?>>05</option>
	<option value="06"<?php
	if (date("h") == 06) {
	?> selected="selected"<?php } ?>>06</option>
	<option value="07"<?php
	if (date("h") == 07) {
	?> selected="selected"<?php } ?>>07</option>
	<option value="08"<?php
	if (date("h") == 08) {
	?> selected="selected"<?php } ?>>08</option>
	<option value="09"<?php
	if (date("h") == 09) {
	?> selected="selected"<?php } ?>>09</option>
	<option value="10"<?php
	if (date("h") == 10) {
	?> selected="selected"<?php } ?>>10</option>
	<option value="11"<?php
	if (date("h") == 11) {
	?> selected="selected"<?php } ?>>11</option>
	<option value="12"<?php
	if (date("h") == 12) {
	?> selected="selected"<?php } ?>>12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
	</select>:
	<select name="minute">
	<option value="00">00</option>
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	<option value="32">32</option>
	<option value="33">33</option>
	<option value="34">34</option>
	<option value="35">35</option>
	<option value="36">36</option>
	<option value="37">37</option>
	<option value="38">38</option>
	<option value="39">39</option>
	<option value="40">40</option>
	<option value="41">41</option>
	<option value="42">42</option>
	<option value="43">43</option>
	<option value="44">44</option>
	<option value="45">45</option>
	<option value="46">46</option>
	<option value="47">47</option>
	<option value="48">48</option>
	<option value="49">49</option>
	<option value="50">50</option>
	<option value="51">51</option>
	<option value="52">52</option>
	<option value="53">53</option>
	<option value="54">54</option>
	<option value="55">55</option>
	<option value="56">56</option>
	<option value="57">57</option>
	<option value="58">58</option>
	<option value="59">59</option>
	<option value="60">60</option>
	</select> 
	<select name="xm">
	<option value="am"<?php
	if (date("a") == 'am') {
	?> selected="selected"<?php } ?>>AM</option>
	<option value="pm"<?php
	if (date("a") == 'pm') {
	?> selected="selected"<?php } ?>>PM</option>
	<option value="">GMT</option>
	</select><br /><img src="images/arrow.png" alt="&gt;" />All day: <input type="checkbox" name="class" value="allday" /><br />
	No Start Time: <input type="checkbox" name="nostart" value="yes" />
	</p>
	
	<p>End Time: <select name="end-hour">
	<option value="01"<?php
	if (date("h") == 01) {
	?> selected="selected"<?php } ?>>01</option>
	<option value="02"<?php
	if (date("h") == 02) {
	?> selected="selected"<?php } ?>>02</option>
	<option value="03"<?php
	if (date("h") == 03) {
	?> selected="selected"<?php } ?>>03</option>
	<option value="04"<?php
	if (date("h") == 04) {
	?> selected="selected"<?php } ?>>04</option>
	<option value="05"<?php
	if (date("h") == 05) {
	?> selected="selected"<?php } ?>>05</option>
	<option value="06"<?php
	if (date("h") == 06) {
	?> selected="selected"<?php } ?>>06</option>
	<option value="07"<?php
	if (date("h") == 07) {
	?> selected="selected"<?php } ?>>07</option>
	<option value="08"<?php
	if (date("h") == 08) {
	?> selected="selected"<?php } ?>>08</option>
	<option value="09"<?php
	if (date("h") == 09) {
	?> selected="selected"<?php } ?>>09</option>
	<option value="10"<?php
	if (date("h") == 10) {
	?> selected="selected"<?php } ?>>10</option>
	<option value="11"<?php
	if (date("h") == 11) {
	?> selected="selected"<?php } ?>>11</option>
	<option value="12"<?php
	if (date("h") == 12) {
	?> selected="selected"<?php } ?>>12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
	</select>:
	<select name="end-minute">
	<option value="00">00</option>
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	<option value="32">32</option>
	<option value="33">33</option>
	<option value="34">34</option>
	<option value="35">35</option>
	<option value="36">36</option>
	<option value="37">37</option>
	<option value="38">38</option>
	<option value="39">39</option>
	<option value="40">40</option>
	<option value="41">41</option>
	<option value="42">42</option>
	<option value="43">43</option>
	<option value="44">44</option>
	<option value="45">45</option>
	<option value="46">46</option>
	<option value="47">47</option>
	<option value="48">48</option>
	<option value="49">49</option>
	<option value="50">50</option>
	<option value="51">51</option>
	<option value="52">52</option>
	<option value="53">53</option>
	<option value="54">54</option>
	<option value="55">55</option>
	<option value="56">56</option>
	<option value="57">57</option>
	<option value="58">58</option>
	<option value="59">59</option>
	<option value="60">60</option>
	</select> 
	<select name="end-xm">
	<option value="am"<?php
	if (date("a") == 'am') {
	?> selected="selected"<?php } ?>>AM</option>
	<option value="pm"<?php
	if (date("a") == 'pm') {
	?> selected="selected"<?php } ?>>PM</option>
	<option value="">GMT</option>
	</select><br />
	No End Time: <input type="checkbox" name="noend" value="yes" />
	</p>
	
	<p>This event recurs: <input type="checkbox" name="recur" value="yes" /><br />
	<select name="currence">
	 <option value="daily">Daily</option>
	 <option value="weekly">Weekly</option>
	 <option value="monthly">Monthly</option>
	</select><br />
	This many times: <input type="text" size="2" name="days" />
	</p>
	
	<p>Title: <input type="text" name="title" size="30" /></p>

<div class="toolbar">
<input type="button" value="Link" onclick="javascript:BB_down3(this);" />
 <input type="button" value="Bold" onclick="javascript:BB_down(this,'b');" />
 <input type="button" value="Italic" onclick="javascript:BB_down(this,'i');" />
 <input type="button" value="Image" onclick="javascript:popUp('insert_img.php')" />
</div>

    <p>Description: <br />
     <textarea name="description" cols="35" rows="8"></textarea></p>

    <p><input type="submit" value="Add Event" /></p>
    
<?php
if (isset($_GET['action']) && $_GET['action'] == 'add') {

	//Check for required title field
	if ($_POST['title'] == '') {
		echo '<p style="color: red;">You did not give your event a title.</p>';
		exit;
	}
	
	// Check the type of event. All day or specific time.
	if ($_POST['class'] == 'allday') {
		$time = 'All Day';
	}
 	else {
 		//Set the time
		if ($_POST['nostart'] == 'yes') {
			$time = 'Ends @ ' . $_POST['end-hour'] . ':' . $_POST['end-minute'] . $_POST['end-xm'];
		}
		if ($_POST['noend'] == 'yes') {
			$time = 'Starts @ ' . $_POST['hour'] . ':' . $_POST['minute'] . $_POST['xm'];
		}
		if ($_POST['noend'] == 'yes' && $_POST['nostart'] == 'yes') {
			$time = '';
		}
		elseif ($_POST['noend'] != 'yes' && $_POST['nostart'] != 'yes') {
			$time = $_POST['hour'] . ':' . $_POST['minute'] . $_POST['xm'] . ' - ' . $_POST['end-hour'] . ':' . $_POST['end-minute'] . $_POST['end-xm'];
		}
	}
	
	// Check the event class. Multiday or not.
	if ($_POST['recur'] == 'yes') {
		$type = 'multiday';
	}
	else {
		$type = 'event';
	}

	// Set some variables
	$filename = 'data/' . $_POST['year'] . $_POST['month'] . $_POST['day'] . $_POST['hour'] . $_POST['minute'] . $_POST['xm'] . '.txt';
	$newevent = $_POST['title'] . '|-NN-|' . $_POST['description'] . '|-NN-|' . $time . '|-NN-|' . $type;
	$event = stripslashes($newevent);
	
	//if event exists for that date and time change the filename a little
	if (file_exists($filename)) {
		$somenum = mt_rand('0', '999');
		$filename = 'data/' . $_POST['year'] . $_POST['month'] . $_POST['day'] . $_POST['hour'] . $_POST['minute'] . ++$somenum . $_POST['xm'] . '.txt';
	}
	
	if ($_POST['recur'] != 'yes') {
		// Open and write event to data file
		$handle = fopen($filename, 'w');
		fwrite($handle, $event);
		fclose($handle);
	}
	if ($_POST['recur'] == 'yes') {
		// Print out the recuring event
		
		if ($_POST['currence'] == 'daily') {
			//Make sure event does not go over 28 days
			if ($_POST['days'] > '28') {
				echo '<span style="color: red;">Event must last for less than 28 days.</span>';
				exit;
			}
			
			//Check for required fields
			if ($_POST['days'] == '' || $_POST['days'] == ' ') {
				echo '<span style="color: red;">You did not fill all required fields!</span>';
				exit;
			}
			
			//Get max days
			if ($_POST['month'] == '01' || $_POST['month'] == '03' || $_POST['month'] == '05' || $_POST['month'] == '07' || $_POST['month'] == '08' || $_POST['month'] == '10' || $_POST['month'] == '12') {
				$maxdays = '31';
			}
			if ($_POST['month'] == '04' || $_POST['month'] == '06' || $_POST['month'] == '09' || $_POST['month'] == '11') {
				$maxdays = '30';
			}
			if ($_POST['month'] == '02') {
				if ($_POST['year'] == '2004' || $_POST['year'] == '2008' || $_POST['year'] == '2012') {
					$maxdays = '29';
				}
				else {
					$maxdays = '28';
				}
			}
		
			//Set some variables
			$count = $_POST['days'];
			$num = '1';
			$month = $_POST['month'];
			$day = $_POST['day'];
			
			while ($num <= $count) {
				$file = 'data/' . $_POST['year'] . $month . $day . $_POST['hour'] . $_POST['minute'] . $_POST['xm'] . $num . '.txt';
				//if event exists for that date and time change the filename a little
				if (file_exists($file)) {
					$somenum = mt_rand('0', '999');
					$file = 'data/' . $_POST['year'] . $_POST['month'] . $_POST['day'] . $_POST['hour'] . $_POST['minute'] . ++$somenum . $_POST['xm'] . '.txt';
				}
				// Open and write event to data file
				$handle = fopen($file, 'w');
				fwrite($handle, $event);
				fclose($handle);
				
				$day++;
				$day = sprintf('%02d' , $day);
				$num++;
				
				//If day is a bigger number than days in month start with 1 again
				if ($day > $maxdays) {
					$day = '01';
					if ($month == '12') {
						$month = '01';
					} else {
						$month++;
						$month = sprintf('%02d' , $month);
					}
				}
			}
		}
		
		// If the currence is weekly make the event recur weekly
		if ($_POST['currence'] == 'weekly') {
			if ($_POST['days'] > '200') {
				echo '<span style="color: red;">Event can not recur weekly for more than 200 weeks.</span>';
				exit;
			}
			else {
				$num = '1';
				$year = $_POST['year'];
				$month = $_POST['month'];
				$day = $_POST['day'];
				$timestamp = mktime(0, 0, 0, $month, $day, $year);
				$filelist = array();
				
				while ($num <= $_POST['days']) {
					if ($num == '1') {
						$filelist[] = 'data/' . date('Ymd', $timestamp) . $_POST['hour'] . $_POST['minute'] . $_POST['xm'] . '.txt';
					}
					else {
						$testday = $day + '7';
						$timestamp = mktime(0, 0, 0, $month, $day, $year);
						$maxdays = time('t', $timestamp);
						if ($testday > $maxdays) {
							$day = $testdays - $maxdays;
							$month++;
						} else {
							$day = $testday;
						}
						
						// If need start months over
						if ($month > '12') {
							$month = '01';
						}
						$timestamp = mktime(0, 0, 0, $month, $day, $year);
						$filelist[] = 'data/' . date('Ymd', $timestamp) . $_POST['hour'] . $_POST['minute'] . $_POST['xm'] . '.txt';
					}
					
					// Increment the loop count
					$num++;
				}
				// Write out the events
				foreach ($filelist as $file) {
					$handle = fopen($file, 'w');
					fwrite($handle, $event);
					fclose($handle);
				}
			}
		}
		
		// Recur event every month
		if ($_POST['currence'] == 'monthly') {
			$num = '1';
			$filelist = array();
			$month = $_POST['month'];
			$day = $_POST['day'];
			$year = $_POST['year'];
			while ($num <= $_POST['days']) {
				if ($num == '1') {
					$timestamp = mktime(0, 0, 0, $month, $day, $year);
					$filelist[] = 'data/' . date('Ymd', $timestamp) . $_POST['hour'] . $_POST['minute'] . $_POST['xm'] . '.txt';
				}
				else {
					if ($month == '12') {
						$month = '1';
						$year++;
					}
					else {
						$month++;
					}
					$timestamp = mktime(0, 0, 0, $month, $day, $year);
					$maxdays = time('t', $timestamp);
					if ($day <= $maxdays && date('d', $timestamp) == $day) {
						$filelist[] = 'data/' . date('Ymd', $timestamp) . $_POST['hour'] . $_POST['minute'] . $_POST['xm'] . '.txt';
					}
				}
				$num++;
			}
			// Write out the events
			foreach ($filelist as $file) {
				$handle = fopen($file, 'w');
				fwrite($handle, $event);
				fclose($handle);
			}
		}
	}
		
	// Time to say it was a success even if not true.
	echo '<span style="color: red;">Event has been added.</span>';
}	
?>
    
   </form>
<script type="text/javascript" src="ccode.js"></script>

  </div>
  
  <div class="paneltwo">
  <h2 id="editevent">Edit/Remove Events</h2>

<?php
 if (isset($_GET['mode']) && $_GET['mode'] == 'edit' && $_POST['remove'] != 'yes') {

 	//Now let's put together the event into a flat file format
	$event = $_POST['title'] . '|-NN-|' . $_POST['description'] . '|-NN-|' . $_POST['date'] . '|-NN-|' . 'event';
	$event = stripslashes($event);
	
	//Now write the event to disk
	$handle = fopen('data/' . $_GET['file'], 'w');
	fwrite($handle, $event);
	fclose($handle);
	
	echo '<p style="color: red;">Event has been edited/removed.</p>';
 }
 ?>

<div class="day-elist">
   <?php
	$day = sprintf('%02d' , $_GET['day']);
	$sieve = '|' . $_GET['year'] . $_GET['month'] . $day . '|';
	$marker = '0';
   if ($handle = opendir('data')) {
	while (false !== ($file = readdir($handle))) {
		if (preg_match($sieve, $file)) {
			$marker++;
			$data = file_get_contents('data/' . $file);
			list($title, $desc, $time, $class) = explode("|-NN-|", $data);
			echo '<a href="e_edit.php?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day'] . '&file=' . $file . '#editform">' . $title . '</a>';
		}
		}
		closedir($handle);
	}
	if ($marker < '1') {
	echo '<span>No events to edit.</span>';
	}
   ?>
  </div>
  
  <?php
	if (isset($_GET['file']) && $_GET['file'] != '') {
		//Now since the event to edit has been choosen let's let the user edit it.
		$data = file_get_contents('data/' . $_GET['file']);
		list($title, $desc, $time, $class) = explode("|-NN-|", $data);
		echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '&mode=edit#editform' . '" id="editform" name="editform">';
		echo '<p>Date: <input type="text" size="18" name="date" value="' . $time . '" /></p>';
		echo '<p>Title: <input type="text" size="18" name="title" value="' . $title . '" /></p>';
		echo '<p>Description:<br /><textarea name="description" cols="21" rows="5" style="margin-left: 3px;">' . $desc . '</textarea></p>';
		echo '<p>Remove Event: <input type="checkbox" name="remove" value="yes" /></p>';
		echo '<p><input type="submit" value="Edit/Remove Event" /></p>';
		echo '</form>';
	}
  ?>

  </div>
 </body>
</html>