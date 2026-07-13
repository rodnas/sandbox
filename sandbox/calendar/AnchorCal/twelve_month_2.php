<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Sample 12 month calendar</title>
<style type="text/css">
	body {
		background: #80c1ff;
	}
	table {
		border: none;
		margin-left: auto;
		margin-right: auto;
		background: transparent;
		border-collapse: collapse;
	}
    td {
        padding: 5px;
		vertical-align: text-top;    
    }
	table.cal {
		width: 14em;
		border: thin solid black;
		border-collapse: collapse;
		empty-cells: show;
		vertical-align: text-top;
		font-size: 12px;
        margin-top: 0px;
        margin-bottom: auto;
	}
	td.calcell {
		width: 2em;
		height: 2em;
		border: thin solid black;
		border-collapse: collapse;
		text-align: center;
		vertical-align: middle;
	}
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
	th.cal {
		width: 14em;
		text-align: center;
		height: 2em;
		border: thin solid black;
		border-collapse: collapse;
		font-size: 14px;
	}
</style>
  
</head>

<body>
<div align="center">
<h1>Twelve Month Calendar</h1>
<p>This calendar will show the current month, the five previous months, and the next six months</p>
<table>
<tr>
<td><?php
$_REQUEST['m'] = "p5";
$_REQUEST['dh'] = 1;
include ("cal.php");
?> </td>
<td><?php
$_REQUEST['m'] = "p4";
include ("cal.php");
?></td>
<td><?php
$_REQUEST['m'] = "p3";
include ("cal.php");
?></td>
<td><?php
$_REQUEST['m'] = "p2";
include ("cal.php");
?></td>
</tr>
<tr>
<td><?php
$_REQUEST['m'] = "p1";
include ("cal.php");
?> </td>
<td><?php
$_REQUEST['m'] = "";
include ("cal.php");
?></td>
<td><?php
$_REQUEST['m'] = "f1";
include ("cal.php");
?></td>
<td><?php
$_REQUEST['m'] = "f2";
include ("cal.php");
?></td>
</tr>
<tr>
<td><?php
$_REQUEST['m'] = "f3";
include ("cal.php");
?> </td>
<td><?php
$_REQUEST['m'] = "f4";
include ("cal.php");
?></td>
<td><?php
$_REQUEST['m'] = "f5";
include ("cal.php");
?></td>
<td><?php
$_REQUEST['m'] = "f6";
include ("cal.php");
?></td>
</tr>
</table>
</div>
</body>
</html>
