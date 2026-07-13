<?php
if (isset($_POST['jumper'])) {
	$year = $_GET['year'];
	$month = $_GET['month'];
	header("Location: " . $_SERVER['SCRIPT_NAME'] . "?year=$year&month=$month" . '&view=month');
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

// Get the year
if ($_GET['year'] != '') {
	$year = $_GET['year'];
}
else {
	$year = date('Y');
}

// Get the month
if ($_GET['month'] != '') {
	$month = $_GET['month'];
}
else {
	$month = date('m');
}

// Get some dates and time
$mkdate = mktime(0,0,0, $month, 1, $year);
$weekday = date('w', $mkdate);
$pweekday = date('w', $mkdate);
$firstday = date('w', $mkdate);
$day = '1';
$days = date('t', $mkdate);
$sieve = $year . $month . '01';
?>

<?php
 include $path . 'header.php';
?>

  <table class="header" cellpadding="0" cellspacing="0">
   <tbody>
    <tr>
     <td class="back">
      <?php
      if ($month == '01') {
      	$backy = $year;
      	echo "<a href=\"" . $_SERVER['SCRIPT_NAME'] . "?year=" . --$backy . '&month=12' . '&view=month">';
      }
      else {
      	$bmonth = $month;
      	$bmonth--;
      	$bmonth = sprintf('%02d' , $bmonth);
      	echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . $year . '&month=' . $bmonth . '&view=month">';
      }
      
      echo '<img src="' . $path . 'images/back.png" alt="Back" /></a>';
      ?>
      
     </td>
     <td class="title">
      <?php echo $year . ' - '; echo date('F', $mkdate); ?>
     </td>
     <td class="next">
      <?php
      if ($month == '12') {
      	$nexty = $year;
      	echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . ++$nexty . '&month=01' . '&view=month">';
      }
      else {
      	$nmonth = $month;
      	$nmonth++;
      	$nmonth = sprintf('%02d' , $nmonth);
      	echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . $year . '&month=' . $nmonth . '&view=month">';
      }
      
      echo '<img src="' . $path . 'images/next.png" alt="Next" /></a>';
      ?>
      
     </td>
    </tr>
   </tbody>
  </table>
  
  <table class="calendar" cellpadding="0" cellspacing="0">
   <tbody>
    <tr>
     <td class="weekday">Sunday</td>
     <td class="weekday">Monday</td>
     <td class="weekday">Tuesday</td>
     <td class="weekday">Wednesday</td>
     <td class="weekday">Thursday</td>
     <td class="weekday">Friday</td>
     <td class="weekday">Saturday</td>
    </tr>
    <tr>

<?php
$weeks = '1';

$loopCount = '1';
while ($loopCount <= $weekday) {
	echo '<td class="day"><img src="' . $path . 'images/something.gif" alt="0" /> </td>';
	$loopCount++;
}

//Now generate all the days

$weekday++;

while ($day <= $days) {
	
	echo "\r<td class=\"day\"";
	
	//Check if this is the current day
	if (date("d") == $day && date("m") == $month && date("Y") == $year) {
    	echo ' id="now"';
    }
    
    echo '>';

	$lday = sprintf('%02d' , $day);
	
	if ($showButtons == 'yes') {
		echo "<a style=\"float: right;\" href=\"#\"" . "onclick=\"popUp('" . $path . "e_edit.php?year=" . $year . '&month=' . $month . '&day=' . $lday . "')\">" . '<img src="' . $path . 'images/control.png" alt="o" style="margin-right: 3px;" /></a>';
	}
	
	echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . $year . '&month=' . $month . '&day=' . $lday . '&view=day">' . $day . '</a>';
	
	if ($handle = opendir($path . 'data')) {
     	while (false !== ($file = readdir($handle))) {
     		if (preg_match("/$sieve/", "$file")) {
     			$data = file_get_contents($path . 'data/' . $file);
     			list($title, $desc, $time, $class) = explode("|-NN-|", $data);
    			echo '<div class="' . $class . '"><span>' . $title . '</span>';
     			echo $desc;
     			echo '<span>' . $time . '</span></div>';
     		}
     	}
     	closedir($handle);
     }
	
	echo "\r</td>";
	
	//If last day of week then start new week
	if ($weekday == '7') {
		echo '</tr><tr>';
		$weekday = '0';
		$weeks++;
	}
	
	$day++;
	$sieve++;
	$weekday++;
}

$dim = $weeks * '7';
$lastdays = $dim - ($days + $pweekday);
$lc = '1';
while ($lc <= $lastdays) {
	echo '<td class="day"><img src="' . $path . 'images/something.gif" alt="0" /> </td>';
	$lc++;
}
?>

</tr>
    
   </tbody>
  </table>
  
  <table class="footer" cellpadding="0" cellspacing="0">
   <tbody>
    <tr>
     <td class="fback">
      <?php
      if ($month == '01') {
      	$backy = $year;
      	echo "<a href=\"" . $_SERVER['SCRIPT_NAME'] . "?year=" . --$backy . '&month=12&view=month">';
      }
      else {
      	$bmonth = $month;
      	$bmonth--;
      	$bmonth = sprintf('%02d' , $bmonth);
      	echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . $year . '&month=' . $bmonth . '&view=month">';
      }
      echo '<img src="' . $path . 'images/back.png" alt="Back" /></a>';
      ?>
      
     </td>
     <td class="jump">
     <?php
     echo '<form method="get" action="' . $_SERVER['REQUEST_URI'] . '">';
     ?>
     <input type="hidden" name="jumper" value="jump" />
     Jump to: <select name="year">
      <?php
       echo '<option value="2004"';
       if (date('Y') == '2004') {
       	echo ' selected="selected"';
       }
       echo '>2004</option>';
       
       echo '<option value="2005"';
       if (date('Y') == '2005') {
       	echo ' selected="selected"';
       }
       echo '>2005</option>';
       
       echo '<option value="2006"';
       if (date('Y') == '2006') {
       	echo ' selected="selected"';
       }
       echo '>2006</option>';
       
       echo '<option value="2007"';
       if (date('Y') == '2007') {
       	echo ' selected="selected"';
       }
       echo '>2007</option>';
       
       echo '<option value="2008"';
       if (date('Y') == '2008') {
       	echo ' selected="selected"';
       }
       echo '>2008</option>';
       
       echo '<option value="2009"';
       if (date('Y') == '2009') {
       	echo ' selected="selected"';
       }
       echo '>2009</option>';
       
       echo '<option value="2010"';
       if (date('Y') == '2010') {
       	echo ' selected="selected"';
       }
       echo '>2010 </option>';
      ?>
     </select>
     <select name="month">
      <option value="01"<?php
      if (date('m') == '01') {
      	echo " selected=\"selected\"";
      }
      ?>>January</option>
      <option value="02"<?php
      if (date('m') == '02') {
      	echo " selected=\"selected\"";
      }
      ?>>February</option>
      <option value="03"<?php
      if (date('m') == '03') {
      	echo " selected=\"selected\"";
      }
      ?>>March</option>
      <option value="04"<?php
      if (date('m') == '04') {
      	echo " selected=\"selected\"";
      }
      ?>>April</option>
      <option value="05"<?php
      if (date('m') == '05') {
      	echo " selected=\"selected\"";
      }
      ?>>May</option>
      <option value="06"<?php
      if (date('m') == '06') {
      	echo " selected=\"selected\"";
      }
      ?>>June</option>
      <option value="07"<?php
      if (date('m') == '07') {
      	echo " selected=\"selected\"";
      }
      ?>>July</option>
      <option value="08"<?php
      if (date('m') == '08') {
      	echo " selected=\"selected\"";
      }
      ?>>August</option>
      <option value="09"<?php
      if (date('m') == '09') {
      	echo " selected=\"selected\"";
      }
      ?>>September</option>
      <option value="10"<?php
      if (date('m') == '10') {
      	echo " selected=\"selected\"";
      }
      ?>>October</option>
      <option value="11"<?php
      if (date('m') == '11') {
      	echo " selected=\"selected\"";
      }
      ?>>November</option>
      <option value="12"<?php
      if (date('m') == '12') {
      	echo " selected=\"selected\"";
      }
      ?>>December</option>
     </select><img src="images/arrow.png" alt="&gt;" />
     <input type="submit" value="Go" />
     <?php
     //Check whether or not you're logged in
     if ($_COOKIE['ACalAuthenticate'] == 'inside' || $protectionType == 'none') {
     	echo '<span style="display: block; margin-top: 5px;"><a href="' . $path . 'admin/">Administration</a>';
     	if ($protectionType != 'none') {
     		echo ' [ <a href="' . $path . 'login.php?log=out">Logout</a> ]</span>';
     	}
     }
     else {
     	echo '<span style="display: block; margin-top: 5px;"><a href="login.php" title="Login">Login</a></span>';
     }
     ?>
     </form>
     </td>
     <td class="fnext">
      <?php
      if ($month == '12') {
      	$nexty = $year;
      	echo "<a href=\"" . $_SERVER['SCRIPT_NAME'] . "?year=" . ++$nexty . '&month=01&view=month">';
      }
      else {
      	$nmonth = $month;
      	$nmonth++;
      	$nmonth = sprintf('%02d' , $nmonth);
      	echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?year=' . $year . '&month=' . $nmonth . '&view=month">';
      }
      
      echo '<img src="' . $path . 'images/next.png" alt="Next" /></a>'
      ?>
      
     </td>
    </tr>
   </tbody>
  </table>
  
  
<?php
 include $path . 'footer.php';
?>
  </body>
</html>