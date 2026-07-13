Visual Events Calendar v1.0 [8 Aug 2003]
http://www.web-scripts.biz/calendar.php

Free for personal use.
$15 if you wish to remove the commercial links described below.
$25 for commercial use.
See Terms of Use, below.


Summary

Do you need to show your customers on which days you are full booked? Perhaps you need to highlight on which days you are running certain courses.

The Visual Events Calendar lets you do just this. What's more, it's easy to add your own events, and to customize the look and feel of the calendar, via a password-protected Web-based control panel.

Features

  * Display one or more months, in one or more rows/columns
  * Highlighting of one or more days with events in different colours
  * Password protected control panel to:
    o Add new events
    o Assign events to specific days
    o Change colours, font styles and sizes, of names of months and days, "today", previous days, weekends, events, and event labels 
  * To install, simply:
    o Copy a folder of files to your Web server
    o Change the "permissions" of three files
    o Add the some code to the HTML in your PHP file:


Installation

1. If you are already reading this text, then you have successfully inzipped the required files into a directory (folder) called /calendar which should include two sub-directories, /images and /templates.

2. Copy the directory /calendar/ (and the sub-directories) to your server.

3. Change the permissions of the following files to 766 (7=read/write/execute 6=read/write):
   (Please check your FTP software, if you are not sure how to do this)
   * customize.txt
   * events.txt
   * event_list.txt

4. To display the calendar in your HTML file:
   a. Your HTML file must be saved as a PHP file, ie. with a .php suffix.
      For example, events.php
   b. Your HTML file should include the following code:
      <?
      include_once('calendar/calendar.php');
      showcalendar();
      ?>



Trouble shooting

If the calendar does not appear on your Web page, then perhaps your server does not support PHP.

To test whether your server supports PHP, copy the file test.php to your server, and point your Web Browser to the file, eg. www.mydomain.com/test.php

1. If you get a "404" error message, then you have entered the wrong filename, and will need to re-enter the Web address in your Browser.

2. If you get a blank page, then your server does not support PHP. You can try contacting your ISP to see whether they can activate PHP pages on your server.

3. If PHP is supported, you will see your PHP version number, and several pages of information about your server's PHP support.


Terms of use

1. The Visual Events Calendar is free to use for (a) personal use (b) non-profit making Web sites.
2. On the Visual Events Calendar, you must retain the link to (a) Web-scripts.com (b) the sponsor.
3. Individuals that wish to remove the links described in (2) above, can do so for a nominal charge of $15.
4. Commercial Web site must make a charge of $25, and may also remove the links described in (2) above.
