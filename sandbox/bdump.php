<?php

// BigDump ver. 0.22b from 2006-04-15
// Staggered import of an large MySQL Dump (like phpMyAdmin 2.x Dump)
// Even through the webservers with hard runtime limit and those in safe mode
// Works fine with Internet Explorer 6.0, Firefox 1.x and even Netscape 4.8

// Author:       Alexey Ozerov (alexey at ozerov dot de) 
// Copyright:    GPL (C) 2003-2006
// More Infos:   http://www.ozerov.de/bigdump

// This program is free software; you can redistribute it and/or modify it under the
// terms of the GNU General Public License as published by the Free Software Foundation; 
// either version 2 of the License, or (at your option) any later version.

// THIS SCRIPT IS PROVIDED AS IS, WITHOUT ANY WARRANTY OR GUARANTEE OF ANY KIND

// USAGE

// 1. Adjust the database configuration in this file
// 2. Drop the old tables on the target database if your dump doesn't contain "DROP TABLE"
// 3. Create the working directory (e.g. dump) on your web-server 
// 4. Upload bigdump.php and your dump files (.sql, .gz) via FTP to the working directory
// 5. Run the bigdump.php from your browser via URL like http://www.yourdomain.com/dump/bigdump.php
// 6. BigDump can start the next import session automatically if you enable the JavaScript
// 7. Wait for the script to finish, do not close the browser window
// 8. IMPORTANT: Remove bigdump.php and your dump files from the web-server

// If Timeout errors still occure you may need to adjust the $linepersession setting in this file

// LAST CHANGES

// *** minor bugfix for gzip mode
// *** per cent progress indication
// *** try to set time limit to unlimited
// *** read dump lines longer than 65536 characters
// *** HTML related improvements

// Database configuration

$db_server   = 'localhost';
$db_name     = 'ncorp_hu';
$db_username = 'SzSanyi';
$db_password = 'phoenix';

// Other Settings

$filename        = 'ncorp_hu.sql';     // Specify the dump filename to suppress the file selection dialog
$linespersession = 3000;   // Lines to be executed per one import session
$delaypersession = 0;      // You can specify a sleep time in milliseconds after each session
                           // Works only if JavaScript is activated. Use to reduce server overrun

// Allowed comment delimiters: lines starting with these strings will be dropped by BigDump

$comment[]='#';           // Standard comment lines are dropped by default
$comment[]='-- ';
// $comment[]='---';      // Uncomment this line if using proprietary dump created by outdated mysqldump
// $comment[]='/*!';         // Or add your own string to leave out other proprietary things


// *******************************************************************************************
// If not familiar with PHP please don't change anything below this line
// *******************************************************************************************

define ('VERSION','0.22b');
define ('DATA_CHUNK_LENGTH',16384);  // How many chars are read per time
define ('MAX_QUERY_LINES',300);      // How many lines may be considered to be one query (except text lines)

ini_set('auto_detect_line_endings', true);
set_time_limit(0);

header("Expires: Mon, 1 Dec 2003 01:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>BigDump ver. <?php echo (VERSION); ?></title>
<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; CHARSET=iso-8859-1">
<META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="EN">

<META http-equiv="Cache-Control" content="no-cache">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1">

<style type="text/css">
<!--

body
{ background-color:#FFFFF0;
}

h1 
{ font-size:25px;
  line-height:28px;
  font-family:Arial,Helvetica,sans-serif;
  margin-top:5px;
  margin-bottom:5px;
}

p,td,th
{ font-size:14px;
  line-height:18px;
  font-family:Arial,Helvetica,sans-serif;
  margin-top:5px;
  margin-bottom:5px;
  text-align:justify;
  vertical-align:top;
}

p.error
{ color:#FF0000;
  font-weight:bold;
}

p.success
{ color:#00DD00;
  font-weight:bold;
}

td
{ background-color:#F8F8F8;
  text-align:left;
}

td.transparent
{ background-color:#FFFFF0;
}

th
{ font-weight:bold;
  color:#FFFFFF;
  background-color:#008080;
  text-align:left;
}

td.right
{ text-align:right;
}

form
{ margin-top:5px;
  margin-bottom:5px;
}

-->
</style>

</head>

<body>

<table width="780" cellspacing="0" cellpadding="0">
<tr><td class="transparent">

<h1>BigDump: Staggered MySQL Dump Importer ver. <?php echo (VERSION); ?></h1>

<?php

$error = false;
$file  = false;

// Check PHP version

if (!$error && !function_exists("version_compare"))
{ echo ("<p class=\"error\">PHP version 4.1.0 is required for BigDump to proceed. You have PHP ".phpversion()." installed. Sorry!</p>\n");
  $error=true;
}

// Calculate PHP max upload size (handle settings like 10M or 100K)

if (!$error)
{ $upload_max_filesize=ini_get("upload_max_filesize");
  if (eregi("([0-9]+)K",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024;
  if (eregi("([0-9]+)M",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024*1024;
  if (eregi("([0-9]+)G",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024*1024*1024;
}

// Handle file upload

$upload_dir=dirname($_SERVER["SCRIPT_FILENAME"]);

if (!$error && isset($_REQUEST["uploadbutton"]))
{ if (is_uploaded_file($_FILES["dumpfile"]["tmp_name"]) && ($_FILES["dumpfile"]["error"])==0)
  { 
    $uploaded_filename=str_replace(" ","_",$_FILES["dumpfile"]["name"]);
    $uploaded_filepath=str_replace("\\","/",$upload_dir."/".$uploaded_filename);
    	
    if (file_exists($uploaded_filename))
    { echo ("<p class=\"error\">File $uploaded_filename already exist! Delete and upload again!</p>\n");
    }
    else if (eregi("(\.php|\.php3|\.php4|\.php5)$",$uploaded_filename))
    { echo ("<p class=\"error\">You may not upload this type of files.</p>\n");
    }
    else if (!@move_uploaded_file($_FILES["dumpfile"]["tmp_name"],$uploaded_filepath))
    { echo ("<p class=\"error\">Error moving uploaded file ".$_FILES["dumpfile"]["tmp_name"]." to the $uploaded_filepath</p>\n");
      echo ("<p>Check the directory permissions for $upload_dir (must be 777)!</p>\n");
    }
    else
    { echo ("<p class=\"success\">Uploaded file saved as $uploaded_filename</p>\n");
    }
  }
  else
  { echo ("<p class=\"error\">Error uploading file ".$_FILES["dumpfile"]["name"]."</p>\n");
  }
}


// Handle file deletion (delete only in the current directory for security reasons)

if (!$error && isset($_REQUEST["delete"]) && $_REQUEST["delete"]!=basename($_SERVER["SCRIPT_FILENAME"]))
{ if (@unlink(basename($_REQUEST["delete"])))
    echo ("<p class=\"success\">".$_REQUEST["delete"]." was removed successfully</p>\n");
  else
    echo ("<p class=\"error\">Can't remove ".$_REQUEST["delete"]."</p>\n");
}


// Open the database

if (!$error)
{ $dbconnection = @mysql_connect($db_server,$db_username,$db_password); 
  if ($dbconnection) 
    $db = mysql_select_db($db_name);
  if (!$dbconnection || !$db) 
  { echo ("<p class=\"error\">Database connection failed due to ".mysql_error()."</p>\n");
    echo ("<p>Edit the database settings in ".$_SERVER["SCRIPT_FILENAME"]." or contact your database provider</p>\n");
    $error=true;
  }
}


// List uploaded files in multifile mode

if (!$error && !isset($_REQUEST["fn"]) && $filename=="")
{ if ($dirhandle = opendir($upload_dir)) 
  { $dirhead=false;
    while (false !== ($dirfile = readdir($dirhandle)))
    { if ($dirfile != "." && $dirfile != ".." && $dirfile!=basename($_SERVER["SCRIPT_FILENAME"]))
      { if (!$dirhead)
        { echo ("<table cellspacing=\"2\" cellpadding=\"2\">\n");
          echo ("<tr><th>Filename</th><th>Size</th><th>Date&amp;Time</th><th>Type</th><th>&nbsp;</th><th>&nbsp;</th>\n");
          $dirhead=true;
        }
        echo ("<tr><td>$dirfile</td><td class=\"right\">".filesize($dirfile)."</td><td>".date ("Y-m-d H:i:s", filemtime($dirfile))."</td>");
        if (eregi("\.gz$",$dirfile)) 
          echo ("<td>GZip</td>");
        else 
          echo ("<td>SQL</td>");
        if (!eregi("\.gz$",$dirfile) || function_exists("gzopen")) 
          echo ("<td><a href=\"".$_SERVER["PHP_SELF"]."?start=1&amp;fn=$dirfile&amp;foffset=0&amp;totalqueries=0\">Start Import</a> into $db_name at $db_server</td>\n");
        else
          echo ("<td>&nbsp;</td>\n");
        echo ("<td><a href=\"".$_SERVER["PHP_SELF"]."?delete=$dirfile\">Delete file</a></td></tr>\n");
      } 

    }
    if ($dirhead) echo ("</table>\n");
    else echo ("<p>No uploaded files found in the working directory</p>\n");
    closedir($dirhandle); 
  }
  else
  { echo ("<p class=\"error\">Error listing directory $upload_dir</p>\n");
    $error=true;
  }
}


// Single file mode

if (!$error && !isset ($_REQUEST["fn"]) && $filename!="")
{ echo ("<p><a href=\"".$_SERVER["PHP_SELF"]."?start=1&amp;fn=$filename&amp;foffset=0&amp;totalqueries=0\">Start Import</a> from $filename into $db_name at $db_server</p>\n");
}


// File Upload Form

if (!$error && !isset($_REQUEST["fn"]) && $filename=="")
{ 

// Test permissions on working directory

  do { $tempfilename=time().".tmp"; } while (file_exists($tempfilename));
  if (!($tempfile=@fopen($tempfilename,"w")))
  { echo ("<p>Upload form disabled. Permissions for the working directory <i>$upload_dir</i> <b>must be set to 777</b> in order ");
    echo ("to upload files from here. Alternatively you can upload your dump files via FTP.</p>\n");
  }
  else
  { fclose($tempfile);
    unlink ($tempfilename);
 
    echo ("<p>You can now upload your dump file up to $upload_max_filesize bytes (".round ($upload_max_filesize/1024/1024)." Mbytes)  ");
    echo ("directly from your browser to the server. Alternatively you can upload your dump files of any size via FTP.</p>\n");
?>
<form method="POST" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="$upload_max_filesize">
<p>Dump file: <input type="file" name="dumpfile" accept="*/*" size=60"></p>
<p><input type="submit" name="uploadbutton" value="Upload"></p>
</form>
<?php
  }
}


// Open the file

if (!$error && isset($_REQUEST["fn"]))
{ 

// Recognize GZip filename

  if (eregi("\.gz$",$_REQUEST["fn"])) 
    $gzipmode=true;
  else
    $gzipmode=false;

  if ((!$gzipmode && !$file=fopen($_REQUEST["fn"],"rt")) || ($gzipmode && !$file=gzopen($_REQUEST["fn"],"rt")))
  { echo ("<p class=\"error\">Can't open ".$_REQUEST["fn"]." for import</p>\n");
    echo ("<p>You have to upload the ".$_REQUEST["fn"]." to the server</p>\n");
    $error=true;
  }

// Get the file size (can't do it fast on gzipped files, no idea how)

  else if ((!$gzipmode && fseek($file, 0, SEEK_END)==0) || ($gzipmode && gzseek($file, 0)==0))
  { if (!$gzipmode) $filesize = ftell($file);
    else $filesize = gztell($file);                   // Always zero, ignore
  }
  else
  { echo ("<p class=\"error\">I can't get the filesize of ".$_REQUEST["fn"]."</p>\n");
    $error=true;
  }
}


// ****************************************************
// START IMPORT SESSION HERE
// ****************************************************

if (!$error && isset($_REQUEST["start"]) && isset($_REQUEST["foffset"]))
{

// Check start and foffset are numeric values

  if (!is_numeric($_REQUEST["start"]) || !is_numeric($_REQUEST["foffset"]))
  { echo ("<p class=\"error\">UNEXPECTED: Non-Numeric values for start and foffset</p>\n");
    $error=true;
  }

  if (!$error)
  { $_REQUEST["start"]   = floor($_REQUEST["start"]);
    $_REQUEST["foffset"] = floor($_REQUEST["foffset"]);
    echo ("<p>Processing file: ".$_REQUEST["fn"]."</p>\n");
    echo ("<p>Starting at the line: ".$_REQUEST["start"]."</p>\n");
  }

// Check $_REQUEST["foffset"] upon $filesize (can't do it on gzipped files)

  if (!$error && !$gzipmode && $_REQUEST["foffset"]>$filesize)
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer behind the end of file</p>\n");
    $error=true;
  }

// Set file pointer to $_REQUEST["foffset"]

  if (!$error && ((!$gzipmode && fseek($file, $_REQUEST["foffset"])!=0) || ($gzipmode && gzseek($file, $_REQUEST["foffset"])!=0)))
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer to offset: ".$_REQUEST["foffset"]."</p>\n");
    $error=true;
  }

// Start processing queries from $file

  if (!$error)
  { $query="";
    $queries=0;
    $totalqueries=$_REQUEST["totalqueries"];
    $linenumber=$_REQUEST["start"];
    $querylines=0;
    $inparents=false;

// Stay processing as long as the $linespersession is not reached or the query is still incomplete

    while ($linenumber<$_REQUEST["start"]+$linespersession || $query!="")
    { 

// Read the whole next line

      $dumpline = "";
      while (!feof($file) && substr ($dumpline, -1) != "\n") 
      { if (!$gzipmode)
          $dumpline .= fgets($file, DATA_CHUNK_LENGTH);
        else
          $dumpline .= gzgets($file, DATA_CHUNK_LENGTH);
      }
      if ($dumpline==="") break;
      
// Handle DOS and Mac encoded linebreaks (I don't know if it will work on Win32 or Mac Servers)

      $dumpline=ereg_replace("\r\n$", "\n", $dumpline);
      $dumpline=ereg_replace("\r$", "\n", $dumpline);
      
// DIAGNOSTIC
// echo ("<p>Line $linenumber: $dumpline</p>\n");

// Skip comments and blank lines only if NOT in parents

      if (!$inparents)
      { $skipline=false;
        reset($comment);
        foreach ($comment as $comment_value)
        { if (!$inparents && (trim($dumpline)=="" || strpos ($dumpline, $comment_value) === 0))
          { $skipline=true;
            break;
          }
        }
        if ($skipline)
        { $linenumber++;
          continue;
        }
      }

// Remove double back-slashes from the dumpline prior to count the quotes ('\\' can only be within strings)
      
      $dumpline_deslashed = str_replace ("\\\\","",$dumpline);

// Count ' and \' in the dumpline to avoid query break within a text field ending by ;
// Please don't use double quotes ('"')to surround strings, it wont work

      $parents=substr_count ($dumpline_deslashed, "'")-substr_count ($dumpline_deslashed, "\\'");
      if ($parents % 2 != 0)
        $inparents=!$inparents;

// Add the line to query

      $query .= $dumpline;

// Don't count the line if in parents (text fields may include unlimited linebreaks)
      
      if (!$inparents)
        $querylines++;
      
// Stop if query contains more lines as defined by MAX_QUERY_LINES

      if ($querylines>MAX_QUERY_LINES)
      {
        echo ("<p class=\"error\">Stopped at the line $linenumber. </p>");
        echo ("<p>At this place the current query includes more than ".MAX_QUERY_LINES." dump lines. That can happen if your dump file was ");
        echo ("created by some tool which doesn't place a semicolon followed by a linebreak at the end of each query, or if your dump contains ");
        echo ("extended inserts. Please read the BigDump FAQs for more infos.</p>\n");
        $error=true;
        break;
      }

// Execute query if end of query detected (; as last character) AND NOT in parents

      if (ereg(";$",trim($dumpline)) && !$inparents)
      { if (!mysql_query(trim($query), $dbconnection))
        { echo ("<p class=\"error\">Error at the line $linenumber: ". trim($dumpline)."</p>\n");
          echo ("<p>Query: ".trim($query)."</p>\n");
          echo ("<p>MySQL: ".mysql_error()."</p>\n");
          $error=true;
          break;
        }
        $totalqueries++;
        $queries++;
        $query="";
        $querylines=0;
      }
      $linenumber++;
    }
  }

// Get the current file position

  if (!$error)
  { if (!$gzipmode) 
      $foffset = ftell($file);
    else
      $foffset = gztell($file);
    if (!$foffset)
    { echo ("<p class=\"error\">UNEXPECTED: Can't read the file pointer offset</p>\n");
      $error=true;
    }
  }

// Finish message and restart the script

  if (!$error)
  { echo ("<p>Stopping at the line: ".($linenumber-1)."</p>\n");
    echo ("<p>Queries performed (this session/total): $queries/$totalqueries</p>\n");
    echo ("<p>Total bytes processed: $foffset (".round($foffset/1024)." KB)");
    if ($filesize>0)
      echo (" or ".round($foffset/$filesize*100)."%");
    echo ("</p>\n");
    if ($linenumber<$_REQUEST["start"]+$linespersession)
    { echo ("<p class=\"success\">Congratulations: End of file reached, assuming OK</p>\n");
      echo ("<p>Thank you for using! Please rate <a href=\"http://www.hotscripts.com/Detailed/20922.html\" target=\"_blank\">Bigdump at Hotscripts.com</a></p>\n");
      echo ("<p>You can send me some bucks or euros as appreciation <a href=\"http://www.ozerov.de/bigdump\" target=\"_blank\">via PayPal</a></p>\n");
      $error=true;
    }
    else
    { if ($delaypersession!=0)
        echo ("<p>Now I'm <b>waiting $delaypersession milliseconds</b> before starting next session...</p>\n");
      echo ("<script language=\"JavaScript\" type=\"text/javascript\">window.setTimeout('location.href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&fn=".$_REQUEST["fn"]."&foffset=$foffset&totalqueries=$totalqueries\";',500+$delaypersession);</script>\n");
      echo ("<noscript>\n");
      echo ("<p><a href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&amp;fn=".$_REQUEST["fn"]."&amp;foffset=$foffset&amp;totalqueries=$totalqueries\">Continue from the line $linenumber</a> (Enable JavaScript to do it automatically)</p>\n");
      echo ("</noscript>\n");
      echo ("<p>Press <a href=\"".$_SERVER["PHP_SELF"]."\">STOP</a> to abort the import <b>OR WAIT!</b></p>\n");
    }
  }
  else 
    echo ("<p class=\"error\">Stopped on error</p>\n");
}

if ($error)
  echo ("<p><a href=\"".$_SERVER["PHP_SELF"]."\">Start from the beginning</a> (DROP the old tables before restarting)</p>\n");

if ($dbconnection) mysql_close();
if ($file && !$gzipmode) fclose($file);
else if ($file && $gzipmode) gzclose($file);

?>

<p>© 2003-2006 <a href="mailto:alexey@ozerov.de">Alexey Ozerov</a> - <a href="http://www.ozerov.de/bigdump" target="_blank">BigDump Home</a></p>

</td></tr></table>

</body>
</html>