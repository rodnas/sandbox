<?php
/* Author: Dale Ray */
/* Last Revised: April 4, 2005 */
/* AnchorCal Version 1.10 */
/* Copyright December 25, 2003 by Dale Ray */

/* Terms of use: You may use this script freely, redistribute it, */
/*               modify it, redistribute the modifications, or sell */
/*               it as long as the original files are included unaltered */
/*               and it is indicated in the modified copy that they are */
/*               the originals.                                         */

/* ************************************************ */
/* This section sets default values for the options */
/* ************************************************ */

/* data file name  - include path if needed */
$data_file = "../_news/events.txt";

/* events file to link to */
$display_url = "http://www.corantodemo.net/eventlist.shtml";

/* Show Day Names 0 = NO, 1 = YES */
$use_day_names = 1;

/* First Day of Week 0 = sunday, 1 = monday */
$first_day_of_week = 1;

/* CSS class names for styles used for calendar cells */
/* set these to match your pages CSS classes */
$normal_cell = "class=\"calcell\"";
$today_cell = "class=\"today\"";

/* *********************************** */
/* Build arrays of month and day names */
/* edit these for other languages      */
/* *********************************** */

/* Month names stored in an array, array index value starts at 1, ie January = 1, */
$month_names = array(1 => "January","February","March","April","May","June","July","August","September","October","November","December");


/* ****************************************** */
/* Get the information about the current date */
/* ****************************************** */

/*Get today's date variables into the array $today */
$today = getdate();

/* get the date information needed */
$this_year = $today["year"];
$this_month = $today["mon"];
$month_date = $today["mday"];

/* set year and month to values for current date */
$year = $this_year;
$month_number = $this_month;

/* ************************************** */
/* Check for options specified at runtime */
/* ************************************** */

/* Check to see if data file is specified in url.
   If not the default data file will be used. */
if (isset($_REQUEST['f']) && file_exists($_REQUEST['f']) ) {
    $data_file = $_REQUEST['f'];
}

/* Check to see if a display url is specified in url. */
/* If not the default display file will be used.      */
/* There is no error checking for this value          */
if (isset($_REQUEST['display']) ) {
    $display_url = $_REQUEST['display'];
}

/* check to see if the dayname header is wanted 1 = YES, 0 = NO */
if (isset($_REQUEST['dh']) ) {
    if (($_REQUEST['dh']) == 0 || ($_REQUEST['dh']) == 1) {
    $use_day_names = $_REQUEST['dh'];
    }
}

/* check to see if start of week is Sunday or Monday - Sunday = 0, Monday = 1 */
if (isset($_REQUEST['sd']) ) {
    if (($_REQUEST['sd']) == 0 || ($_REQUEST['sd']) == 1) {
    $first_day_of_week = $_REQUEST['sd'];
    }
}

/* day name abbreviations stored in an array - edit to your liking */
if ($first_day_of_week == 1) {
$day_names = array("M","Tu","W","Th","F","St","Sn");
} else if ($first_day_of_week == 0) {
$day_names = array("Sn","M","Tu","W","Th","F","St");
}

/* ********************************************************************** */
/* This section determines if options were set when the script was called
   to set the month displayed. No options will display the current month.

   You can specify the following options to show a specific month
   y = year
   m = month
   
   To specify a month relative to the current month use
   m=fxx - f = future xx = number between 1 and 99
   m=pxx - p = past xx = number between 1 and 99
   The year is increased or decreased as needed.
   When you use a relative month the year option is ignored               */
/* ********************************************************************** */

/* Check to see if  a month was specified  */
if (isset($_REQUEST['m']) && !isset($_REQUEST['pl']) ) {
    $ignore_year = 0;
    /* check for future relative month */
    if ( substr($_REQUEST['m'],0,1) == "f" ) {
        $ignore_year = 1;
        $month_number = $month_number + substr($_REQUEST['m'],1,2);
        while ( $month_number > 12 ) {
            $month_number = $month_number - 12;
            $year = $year + 1;
            }
    }
    /* check for past relative month */
    if ( substr($_REQUEST['m'],0,1) == "p" ) {
        $ignore_year = 1;
        $month_number = $month_number - substr($_REQUEST['m'],1,2);
        $add = substr($_REQUEST['m'],1,2);
        while ( $month_number < 1 ) {
            $month_number = $month_number + 12;
            $year = $year - 1;
            }
    }
    if (is_numeric($_REQUEST['m']) && $_REQUEST['m'] >= 1 && $_REQUEST['m'] <= 12 ) {
        $month_number = $_REQUEST['m'];
        $month_number = preg_replace("/^0/","",$month_number);
    }
}

/* Check to see if a year was specified and if it is valid. If it is, set the year.
   The current year will be used if argument missing or invalid. */
   if (isset($_REQUEST['y']) && (!$ignore_year)) {
    if (is_numeric($_REQUEST['y']) && $_REQUEST['y'] >= 1970 && $_REQUEST['y'] <= 2037) {
        $year = $_REQUEST['y'];
    }
}

/* Set Month Name  */
$month_name = $month_names[$month_number];

/* ********************************************************* */
/* determine the number of days in the month to be displayed */
/* ********************************************************* */
$num_days   = date("t",mktime(0,0,0,$month_number,1,$year));

/* ************************************************************** */
/* Read data file and build an array with the proper dates tagged */
/* ************************************************************** */

if (file_exists($data_file)  && (filesize($data_file)) > 0) {
    for ($i =1; $i <= $num_days; $i++) {
        $tag[$i] = 0;
    }
    $handle = fopen($data_file, "r") or die("Unable to open file");
    if ($handle) {
        while (!feof($handle)) {
            $j = fgets($handle, 64);
            $j = trim($j);
            if (preg_match("/\"[0-2]\d{3,3}(0|1)\d[0-3]\d/",$j)) {
                $pos = strpos($j,"\"");
                $yr = substr($j, $pos +1, 4);
                $mn = substr($j, $pos +5, 2);
                $d = substr($j, $pos +7, 2);
                if (($yr == $year) && ($mn == $month_number)) {
                    /*strip leading zero */
                    $k = preg_replace("/^0/","",$d);
                    $tag[$k] = 1;
                }
            }
        }
        /* end of while loop */
    }
    /* end of file read loop */
    fclose($handle);
    
}
/* end of file read loop */

/* *************************************************************** */
/* Determine if empty cells are needed for the first and last rows */
/* and assign the proper amount of padding to a variable used by   */
/* the calendar print routine                                      */
/* *************************************************************** */

/* the padding routines check for start of week on Sunday or Monday */
/* and adjust accordingly by checking the value of $first_day_of_week */

/* first week padding                                                      */
/* get day of week as number to use for table layout of month's first week */

$first_day = date("w",mktime(0,0,0,$month_number,1,$year));
if ($first_day_of_week == 0) {
	if ($first_day == 0) {
    	$start_padding ="";
	} else if ($first_day == 1) {
    	$start_padding = "\n    <td $normal_cell></td>";
	} else {
    	$start_padding = "\n    <td $normal_cell colspan=\"$first_day\"></td>";
	}
} else if ($first_day_of_week == 1) {
	if ($first_day == 1) {
    	$start_padding ="";
	} else if ($first_day == 2) {
    	$start_padding = "\n    <td $normal_cell></td>";
	} else {
		if ($first_day == 0) {
			$first_day = 7;
			}
		$pad_cells = $first_day - 1;
    	$start_padding = "\n    <td $normal_cell colspan=\"$pad_cells\"></td>";
	}
}

/* last week padding                                                                */
/* get day of week as number and subtract from 6 for padding for last week of month */
/* $last_day = 6 - date("w",mktime(0,0,0,$month_number,$num_days,$year)); */
$last_day = date("w",mktime(0,0,0,$month_number,$num_days,$year));
if ($first_day_of_week == 0) {
	$last_day = 6 - $last_day;
} else if ($first_day_of_week == 1) {
	if ($last_day == 0) {
		$last_day = 6;
	} else {
		$last_day = $last_day - 1;
	}
		$last_day = 6 - $last_day;
}
if ($last_day == 0) {
    $end_padding = "</table>";
} else if ($last_day == 1) {
    $end_padding = "\n    <td $normal_cell></td>\n</tr>\n</table>";
} else {
    $end_padding = "\n    <td $normal_cell colspan=\"$last_day\"></td>\n</tr>\n</table>";
}

/* ****************** */
/* print the calendar */
/* ****************** */

/* print start of table and header row */
print <<<END
<table class="cal">
<tr>
<th class="cal" colspan="7">
$month_name $year
</th>
</tr>
<tr>
END;
if ($use_day_names) {
    for ($i = 0; $i <= 6; $i++) {
    echo "\n    <td $normal_cell>$day_names[$i]</td>";
    }
    echo "</tr><tr>\n";
}

/* print paddng for first row*/
echo $start_padding;

/* print calendar cells with dates */
for ($d = 1 ; $d <= $num_days ; $d++) {
    
    /* set style - highlights date if today */
    if ($d != $month_date) {
        $style = $normal_cell;
    } else if ($d == $month_date && $month_number == $this_month && $year == $this_year) {
        $style = $today_cell;
    } else {
        $style = $normal_cell;
    }
    
    /* print each cell - ad link tags if in $tag array */
    
    if (isset($tag[$d]) && ($tag[$d])) {
        $k = ( $d < 10 ? "0".$d : $d);
        $m = ( strlen($month_number) < 2 ? "0".$month_number : $month_number);
        echo "\n    <td $style><a href=\"$display_url#$year$m$k\">$d</a></td>";
    } else {
        echo "\n    <td $style>$d</td>";
    }
    
    /* check for end of week, close current row and open new row if it is */
    $s = date("w",mktime(0,0,0,$month_number,$d,$year));

if ($first_day_of_week == 0) {
    if ($s == 6) {
        if ($d != $num_days) {
        echo "\n</tr>\n<tr>";
        } else {
        echo "\n</tr>";
        }
    }
} else if ($first_day_of_week == 1) {
    if ($s == 0) {
        if ($d != $num_days) {
        echo "\n</tr>\n<tr>";
        } else {
        echo "\n</tr>";
        }	
	}
}
}

/* print padding for last row if needed and close table */
echo $end_padding;

?>

