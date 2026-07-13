<?php
// If clicked on link to get to month view include that instead of this.

if ($_POST['remove'] == 'yes' && $_GET['mode'] == 'edit') {
	unlink($path . 'data/' . $_GET['file']);
	header('Location: ' . $_SERVER['SCRIPT_NAME'] . '?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day'] . '&view=day');
	exit;
}

// Include some files
include $path . 'functions.php';
include $path . 'data/prefs.php';

// Turn debug mode on if set
if ($debug == 'on') {
	ini_set('display_errors', '1');
}

// Authentication
session_start();
if ($protectionType == 'all') {
	if ($_SESSION['ACalAuthenticate'] != 'inside') {
		header('Location: ' . $path . 'login.php');
		exit;
	}
}

if (!isset($_GET['year']) || !isset($_GET['month']) || !isset($_GET['day'])) {
	$_GET['year'] = date('Y');
	$_GET['month'] = date('m');
	$_GET['day'] = date('d');
}

// Check out if it's static or dynamic embedding
$checkstr = $_SERVER['REQUEST_URI'];
if (preg_match('/\?/', $checkstr)) {
	$get = '&';
}
else {
	$get = '?';
}

// Make timestamp
$timestamp = mktime(0, 0, 0, $_GET['month'], $_GET['day'], $_GET['year']);

$monthLink = '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&view=month">' . date('F', $timestamp) . '</a>';
?>

<?php
include $path . 'header.php';
?>

<?php
echo '<h1 class="day-title">' . $_GET['year'] . ' - ' . $monthLink . ' -&gt;' . $_GET['day'] . '</h1>';

?>

<div class="day-bar">
</div>

<div class="day-sidebar">

<?php
if ($_COOKIE['ACalAuthenticate'] == 'inside') {
?>
 <div ckass="day-addevent">
 
<?php
if (isset($_GET['action']) && $_GET['action'] == 'addevent') {
	//Check for required fields
	if ($_POST['title'] == '') {
		echo '<span style="color: red;">You did not give your event a title and so the event could not be added.</span>';
		exit;
	}
	
	//We need to figure out the date and time, or if there is none that's alright too.
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
	
	//Now since the time is figured out let's figure out the filename
	$day = sprintf('%02d' , $_POST['day']);
	$filename = $path . 'data/' . $_POST['year'] . $_POST['month'] . $day . $_POST['hour'] . $_POST['minute'] . $_POST['xm'] . '.txt';
	
	//Now let's put together the event into a flat file format
	$event = $_POST['title'] . '|-NN-|' . $_POST['description'] . '|-NN-|' . $time . '|-NN-|' . 'event';
	$event = stripslashes($event);
	
	//Now write the event to disk
	
	if (file_exists($filename)) {
		$somenum = mt_rand('0', '999');
		$filename = $path . 'data/' . $_POST['year'] . $_POST['month'] . $day . $_POST['hour'] . $_POST['minute'] . $somenum . $_POST['xm'] . '.txt';
	}
	
	$handle = fopen($filename, 'w');
	fwrite($handle, $event);
	fclose($handle);
	
	echo '<span style="color: red;">The event has been added to your calendar.</span>';
}
?>
 
<?php
echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . $get . 'action=addevent">' . '&view=day';
?>
  
  <?php
  //Send out the year and month and day via post too
  echo '<input type="hidden" name="year" value="' . $_GET['year'] . '" />';
  echo '<input type="hidden" name="month" value="' . $_GET['month'] . '" />';
  echo '<input type="hidden" name="day" value="' . $_GET['day'] . '" />';
  ?>
  
   <p>Start: <select name="hour">
    <option value="01" selected="selected">1</option>
    <option value="02">2</option>
    <option value="03">3</option>
    <option value="04">4</option>
    <option value="05">5</option>
    <option value="06">6</option>
    <option value="07">7</option>
    <option value="08">8</option>
    <option value="09">9</option>
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
   </select>:<select name="minute">
    <option value="00" selected="selected">00</option>
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
   </select> <select name="xm">
    <option value="pm" selected="selected">PM</option>
    <option value="am">AM</option>
    <option value="">GMT</option>
   </select><br />
   No Start Time: <input type="checkbox" name="nostart" value="yes" />
   </p>
   
   <p>End: <select name="end-hour">
    <option value="01" selected="selected">1</option>
    <option value="02">2</option>
    <option value="03">3</option>
    <option value="04">4</option>
    <option value="05">5</option>
    <option value="06">6</option>
    <option value="07">7</option>
    <option value="08">8</option>
    <option value="09">9</option>
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
   </select>:<select name="end-minute">
    <option value="00" selected="selected">00</option>
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
   </select> <select name="end-xm">
    <option value="pm" selected="selected">PM</option>
    <option value="am">AM</option>
    <option value="">GMT</option>
   </select><br />
   No End Time: <input type="checkbox" name="noend" value="yes" />
   </p>
   
   <p>Title: <input type="text" name="title" size="18" /></p>
   <p>Description:<br />
   <textarea name="description" cols="21" rows="5" style="margin-left: 3px;"></textarea></p>
   <p><input type="submit" value="Add Event" /></p>
  </form>
 </div>
 
 <div class="day-editevent">
 
 <?php
 if (isset($_GET['mode']) && $_GET['mode'] == 'edit' && $_POST['remove'] != 'yes') {

 	//Now let's put together the event into a flat file format
	$event = $_POST['title'] . '|-NN-|' . $_POST['description'] . '|-NN-|' . $_POST['date'] . '|-NN-|' . 'event';
	$event = stripslashes($event);
	
	//Now write the event to disk
	$handle = fopen($path . 'data/' . $_GET['file'], 'w');
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
   if ($handle = opendir($path . 'data')) {
	while (false !== ($file = readdir($handle))) {
		if (preg_match($sieve, $file)) {
			$marker++;
			$data = file_get_contents($path . 'data/' . $file);
			list($title, $desc, $time, $class) = explode("|-NN-|", $data);
			echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day'] . '&file=' . $file . '&view=day' . '#editform">' . $title . '</a>';
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
		$data = file_get_contents($path . 'data/' . $_GET['file']);
		list($title, $desc, $time, $class) = explode("|-NN-|", $data);
		echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '&mode=edit' . '&view=day' . '" id="editform" name="editform">';
		echo '<p>Date: <input type="text" size="18" name="date" value="' . $time . '" /></p>';
		echo '<p>Title: <input type="text" size="18" name="title" value="' . $title . '" /></p>';
		echo '<p>Description:<br /><textarea name="description" cols="21" rows="5" style="margin-left: 3px;">' . $desc . '</textarea></p>';
		echo '<p>Remove Event: <input type="checkbox" name="remove" value="yes" /></p>';
		echo '<p><input type="submit" value="Edit/Remove Event" /></p>';
		echo '</form>';
	}
  ?>
 </div>
 
<?php
}
else {
?>
<div class="day-login"><a href="admin/">Login/Admin</a></div>
<?php
}
?>
</div>

<?php

echo '<div class="day-crack"></div>';

$datadir = $path . 'data/';
acal_loadeventsDay($datadir, $_GET['year'], $_GET['month'], $_GET['day']);

?>


<?php
include $path . 'footer.php';
?>