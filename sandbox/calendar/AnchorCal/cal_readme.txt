AnchorCal
Version 1.10
Original Release: December 25, 2003
Current Version Released: April 4, 2005

By Dale Ray

Copyright December 25, 2003 by Dale Ray

Terms of use: You may use this script freely, redistribute it,
              modify it, redistribute the modifications, or sell
              it as long as the original files are included unaltered
              and it is indicated in the modified copy that they are
              the originals.

Warranty: None, zip, less than zero.

          There is no warranty, express or implied, as to the usability,
          suitability or duality of this script.
         
          Don't use it anywhere you might lose something if it doesn't work
          right.
          
          Oh, yeah - no guarantees either.

-----------
Description
-----------

This script reads a file and finds html anchor tags in it. The tags it
looks for are formatted as a date. A small calendar is then displayed with
the dates that match the anchors linked to the file with the anchors.

I made this script to be used with Coranto, a CMS/ News script, but it
should work with any file that the has anchors in the correct format.

This is a beta version. It is not intended for mission critical applications.
Use this script at your own risk.

------------------------
What Can I Do With This?
------------------------

The script is intended to allow you to place a small calendar on your
web page(s). You can use it simply to show a calendar if you wish or you
can process a file with date related anchors in it and then link from the
calendar to that file.

------------------------
How Do I Use This Thing?
------------------------

Upload it or copy it to your server. Know the path to it's location.

=> Calendar Only - No Links <=

To use the script to just display a calendar simply use SSI or PHP and
include it in your page at the spot you want it to display.

PHP Examples: 

<?php virtual ("yourpath/cal.php"); ?>

or:

<?php include ("yourpathfromroot/cal.php"); ?>

CGI Example: <!--#include virtual="yourpath/cal.php" -->

-- Changes to make to script for Calendar Only --

No changes are required. If you want to customize the appearance of the
calendar read the CSS documentation later on in this file.

=> Calendar With Links <=

See the information on including the calendar in your web page(s) in the
calendar only info.

-- Changes to make to the script for a Calendar with Links --

If you are going to use the same data file and display file all of
the time, open the cal.php file in your text editor and:

change $data_file to the path and filename of the file you want
cal.php to grab your dates from. This is a path not a URL and can
a full path or a relative path.

Example: /home/sites/web/calendar/dates.txt (full path)
         ../web/calendar/dates.txt (relative path)
         dates.txt (data in same directory as cal.php)

Change $display_url to the url of the page you want to display
when the calendar link is clicked.

Example: http://www.mysite.net/events.html
         /calendar/events.html
         /events.html

These can point at the same file if you get the dates form the same
file you use to display the events. If your display page is generated
dynamically you have to point it at a static file for data.

Set $use_day_names to 1 is you want the row of dayname abbreviations to show
and to 0 (zero) if you don't want them.

Here is an example using Coranto. Your profile builds the dates.txt file
and it is dynamically included into events.shtml. You point $data_file at
dates.txt and $display_file at events.shtml. The script reads your anchors
in the dates.txt file and when a link is clicked the events.shtml is
displayed and the browser goes to the spot in your page where the link is at.

I will explain further on how to specify the year and month when you call the
script.

------------------------------------------
What Does cal.php Expect In Order To Work?
------------------------------------------

=> Anchor Format <=

In order to get through the data file quickly, so you don't have to wait for
your page to display I limited the script to reading the first 64 characters of
each line of the file. So if you need to put your anchors at the start of a line.

-- to change the number of characters read find

        $j = fgets($handle, 64);

        and change the 64 to a larger number.

cal.php scans for the anchor format:

<a name="yyyymmdd"></a> using a regular expression. The expression used is:

        \"[0-2]\d{3,3}(0|1)\d[0-3]\d/

This looks for:

\" - will match a double quote
Year:

[0-2] - a digit between 0 and 2
        (I plan to use years 0000 in the future)
\d{3,3} - three digits between 0 and 9

Month:

(0|1) - either a zero or a one
        You have to use two digit months and anchors or you can't
        tell January 11 (111) from November 11 (111)

\d - any digit 0 - 9

Day:

[0-3] - a digit between 0 and 3

/d - any digit

Note: This was only my second regular expression, so the documentation is as
      much for me as for you. If you see a way to make this more super duper
      let me know. I am just glad it works (well I think it does, I am sure
      someone will let me know if it doesn't)


=> Using This With Coranto <=

-- Create or edit a style so that you have --

<If: Sub: isNewDate>
Other style stuff here
<a name="<Field: Year><Field: TwoDigitMonth><Field: TwoDigitDay>"></a>
Other style stuff here
</If>
Other style stuff here

When processed this will give you:

<a name="yyyymmdd">

just like the script looks for.

The other content of your style is up to you.

-- Make a profile point to this style --

Create a new profile or just make sure one of the current is using the style.
Make sure you know the PATH to the data file and the URL to the display file.
Change the variables in the script as outlined above.


--------------------------------------------
Specifying Options at Runtime When Using SSI 
--------------------------------------------

When you call the calendar you can do this:

<!--#include virtual="yourpath/cal.php?m=3&y=2005" -->

m = month to display from 1 - 12
y = year to display from 1970 - 2037

The calendar will then show March, 2005. These parameters
override the variables in the script. You can also use

-- Display a calendar relative to current month --

If you want to last month's calendar on your page use:

<!--#include virtual="yourpath/cal.php?m=p1" -->

The p before the 1 means Past, and the 1 means one month in the Past

A future calendar would be:

<!--#include virtual="yourpath/cal.php?m=f1" -->

The f is Future and the 1 indicates one month in the future.

The range is 1 - 99 and the year is computed based on the relative month.
When using past or future relative month options the y  (year) option is
ignored.

If you want last moth and then the current month always shown on your page
you would use:

<!--#include virtual="yourpath/cal.php?m=p1" -->
<!--#include virtual="yourpath/cal.php" -->

The calendars shown will always be last month and this month, no need to
change the SSI in your page to keep it current.

-- Specify another Data File --

f=anotherdatafile.txt

as part of the call so:

<!--#include virtual="yourpath/cal.php?m=3&y=2005&f=anotherfile.txt" --> 

would show March, 2005 and use a different data file than the default.

-- Turn Dayname Row on and off --

dh= 0 (zero) or 1 (one)

turn on or off the dayname row. If you include more than one calendar
in a page you could choose to only show the daynames on the first.

-- Specify Display File --

display=differentdisplayfile.txt

choose a different display file for the calendar. You can use this to display
multiple calendars pointing at different events files.

-- Specify Sunday or Monday as start of week --

Specify the start day using:

sd= 0 (zero) or 1 (one)

zero means the week will start on Sunday
one means the week will start on Monday

-- Notes about setting options at runtime --

You can use any, none or all of these.

Specifying an invalid parameter ( a 2 instaed of a zero or 1) will result
in the the default value that is in the script being used.

--------------------------------------------
Specifying Options at Runtime When Using PHP
--------------------------------------------

You may have to use:

<?php include ("yourpathfromroot/cal.php"); ?>

if the virtual include does not work.

Specifying options usings the PHP virtual command does not work because the
values of the options are not passed.

In response to questions about using this feature I have come up with a method
that works, but as I am not very experienced with PHP I do not know if this
method has any security risks.

You can use the follwing code to specify options:

<?php
$_REQUEST['sd'] = 0;
$_REQUEST['dh'] = 1;
$_REQUEST['m'] = 7;
$_REQUEST['y'] = 2006;
virtual ("yourpath/cal.php");
?>

This code would display a calendar with Sunday as the first day of week
the day header displayed
for the month of July
and the year 2006

These values will hold for every call of AnchorCal after they are set. If
you want to call AnchorCal with different options you must explicitely
set them.

You could use this method to display a set of calendars for the past month,
current month, and next month using:

<?php
$_REQUEST['m'] = "p1";
$_REQUEST['dh'] = 1;
virtual ("/_cal/new_cal.php");
$_REQUEST['m'] = "";
virtual ("/_cal/new_cal.php");
$_REQUEST['m'] = "f1";
virtual ("/_cal/new_cal.php");
?>


--------
CSS Used
--------

The CSS I use is included below copy and paste into your own
CSS, SHTML, or PHP file if you want to use the same formatting.

table.cal {
	width: 14em;
	border: thin solid black;
	border-collapse: collapse;
	padding: 0em;
	empty-cells: show;
	font-size: 12px;
}

this is how I want my calendar to look
change it to suit your site

td.calcell {
	width: 2em;
	height: 2em;
	border: thin solid black;
	border-collapse: collapse;
	text-align: center;
	vertical-align: middle;
}

this is the info for every cell except TODAY

td.today {
	width: 2em;
	height: 2em;
	border: thin solid black;
	border-collapse: collapse;
	text-align: center;
	background-color: silver;
	color: red;
	vertical-align: middle;
}

this creates the highlight for the cell if it is the
current date.

th.cal {
	width: 14em;
	text-align: center;
	height: 2em;
	border: thin solid black;
	border-collapse: collapse;
	font-size: 14px;
}

this is used for the row with the month and year

-----------
Misc. Notes
-----------

This is my first PHP script.

I wrote this for the learning experience.

I would appreciate constructive comments and suggestions.

You can see this in action or download the latest version at:

http://www.corantodemo.net

--------------
Variables Used
--------------

=> Default Options <=

$data_file - path and filename to be read

$display_url - the url of the file you want to display when the calendar links
               are clicked. This can be the same as $data_file or a different
               file. Ex. If you are using Coranto to create a profile.txt file
               and then including it in another page using SSI or PHP this would
               point to the page displaying the items.

$use_day_names - set to 0 (zero) if you don't want a row of day name
                 abbreviations at the top of the calendar or to 1 if you
                 do.

$first_day_of_week - set to 0 (zero) if you want the week to begin on Sunday
                     set to 1 (one) if you want the week to begin on Monday

$normal_cell - the name of the CSS class you want applied to a cell that isn't
               today

$today_cell - the name of the CSS class you want applied to a cell that is
               today

=> Month and Day Name Arrays <=

$month_names [array] - this is an array of month names that will be shown above
                       the calendar. Edit this array if you want to use
                       abbreviations or another language.

$day_names - this is an array of the day name abbreviations used if use day
             names is set to 1. This as moved from the beginning of the script
             to line 90 in V 1.01 (if you haven't edited the script), after
             checking to see if the start day of the week is specified at
             runtime. 

=> Date Related Variables <=

$today - the date that the script is run

$this_year & $this_mon - the current year and month, These are used as defaults
                         if no other year and month are specified and to set mark
                         the correct day as today

$month_name - the name of the month to be displayed

$month_date - the date, if it's December 12 it will be 12.

$year - the year the calendar will display, defaults to the current year.

$month_number - the month as a number, January is 1, February is 2, etc.
                Defaults to the current month.

$ignore_year - flag that is set to 1 if a relative month is specified in the
               options. This causes any y (year) option to be ignored.

$ num_days - the number of days in the month that is being displayed. This is used
             in the logic that displays the calendar grid

$tag[array] - an array that stores the dates of the days to be tagged as linking
              to events. In use the array element zero is unused so any element
              having a subscript equal to a day with events is set to 1 (one)
              all other elements are 0 (zero).

$pos - this stores the place in the string that the quote before the date string
       is at. The start and end of the year. month, and date are computed
       using this.

$yr - year in a found anchor

$mn - month in a found anchor

$d - date in a found anchor

$first_day - the day of the week that the month starts on. This is a number
             0 = Sunday, 1 = Monday, etc

$start-padding - the number of empty cells at the start of the first
                  week of the month

$last_day - the day of the week that the month ends on.

$end_padding - the number of empty cells at the end of the last week
               of the month.


Uses For AnchorCal

An enterprising Blogger User has made AnchorCal work with
Blogger. You can read about it here:

http://www.bloggerforum.com/modules/newbb/viewtopic.php?topic_id=664&forum=3&jump=1

Unfortunately I have not been able to get a copy of the revised version
to see if any of the changes made should or could be incorporated into
my version.

The site that this is used on is at:

http://engramis.1go.dk/

I have tested these links as of April 4, 2005 and they are working, hope
they are still live when you read this :-)

