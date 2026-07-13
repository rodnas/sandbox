<?
 require_once('./check_login.php');
?>
<? include('header.php')?>
<font size=3><b><center>Customize Page</center></b></font>
<center>
<font class="nrm">
    This page lets you change the look and feel of the calendar.<br>
    Make your changes below, and press the Apply button to update.<br>
</font>
</center>
<table>
<tr valign="top">
<td>
<form method="post" name="customize">
<input type="hidden" name="action" value="custom">
<table  cellspacing="0" cellpadding="1">
<?
include_once('calendar.php');
if ($action=="custom")
 {
    $customize_old=Loadcustomize($cfg_dir.'customize.txt');
    $event_color=$customize_old['event_color'];
    $customize=$HTTP_POST_VARS[customize];
	$customize['event_color']=$event_color;
    SaveToFile($cfg_dir."customize.txt",$customize);
 }
 	else
 {
	 $customize=Loadcustomize($cfg_dir.'customize.txt');
 }
?>
<tr valign="top">
 <td>
 <table  style="border: 1px solid #663300;" cellspacing="0" cellpadding="1" bgcolor="FFFFCC">
 <tr bgcolor="#E4D6A6"><td colspan=2 align="middle"><b>Month's name</b></td></tr>
<?
for($i=1;$i<13;$i++)
 {
  $month=$customize[month][$i];
  $e_month=date("F",mktime(0,0,0,$i,1,2000));
  echo<<<EOT
  <tr><td>$e_month</td><td><input size=10  name="customize[month][$i]" value="$month"></td></tr>
EOT;
 }
?>
 </table>
 </td>
 <td>
 <table  style="border: 1px solid #663300;" cellspacing="0" cellpadding="1"  bgcolor="FFFFCC">
 <tr bgcolor="#E4D6A6"><td colspan=2 align="middle"><b>Days of week</b></td></tr>
<?
for($i=1;$i<8;$i++)
 {
  $day=$customize[days][$i];
  $e_day=$week_days[$i-1];
  echo<<<EOT
  <tr><td>$e_day</td><td><input size=10  name="customize[days][$i]" value="$day"></td></tr>
EOT;
 }
?>
 </table>
 </td>
 </td>
 <td>
 <table width="300"  style="border: 1px solid #663300;" cellspacing="0" cellpadding="1" bgcolor="FFFFCC">
 <tr bgcolor="#E4D6A6"><td colspan=2 align="middle"><b>View customize</b></td></tr>
 <tr>
  <td >Table background</td>
  <td><? editColor('customize[table_bg]',$customize[table_bg],"customize")?></td>
 </tr>
 <tr>
  <td>Table border color</td>
  <td><? editColor('customize[table_border_color]',$customize[table_border_color],"customize")?></td>
 </tr>
 <tr>
  <td>Table width</td>
  <td><input size=1 name="customize[t_width]" value=<?=$customize[t_width]?>></td>
 </tr>
 <tr>
  <td>Table border width</td>
  <td><input size=1 name="customize[table_border_width]" value=<?=$customize[table_border_width]?>></td>
 </tr>

 <tr>
  <td>Table padding</td>
  <td><input size=1 name="customize[padding]" value=<?=$customize[padding]?>></td>
 </tr>
 <tr>
  <td>Table spacing</td>
  <td><input size=1 name="customize[spacing]" value=<?=$customize[spacing]?>></td>
 </tr>
 <tr>
  <td>Cell border width</td>
  <td><input size=1 name="customize[cell_border_width]" value=<?=$customize[cell_border_width]?>></td>
 </tr>
 <tr>
  <td>Cell border color</td>
  <td><? editColor('customize[cell_border_color]',$customize[cell_border_color],"customize")?></td>
 </tr>

 <tr>
  <td>Current day bold</td>
  <td>
  	<select name="customize[current_bold]">
    <option <? if ($customize[current_bold]=='true') echo "selected"?>>true</option>
    <option <? if ($customize[current_bold]=='false') echo "selected"?>>false</option>
    </select>
  </td>
 </tr>
 <tr>
  <td>Months row</td>
  <td><input size=1 name="customize[row_number]" value=<?=$customize[row_number]?>></td>
 </tr>
 <tr>

 <tr>
  <td>Month per row</td>
  <td><input size=1 name="customize[m_number]" value=<?=$customize[m_number]?>></td>
 </tr>
 <tr>
  <td>Month to start (0-current,1-next)</td>
  <td><input size=1 name="customize[start_m]" value=<?=$customize[start_m]?>></td>
 </tr>
 <tr>
  <td>Event label layout</td>
  <td>
    <SELECT name="customize[menu_layout]">
     <OPTION value=0 <? if ($customize[menu_layout]==0) echo 'selected'?>>Horizontal</OPTION>
     <OPTION value=1 <? if ($customize[menu_layout]==1) echo 'selected'?>>Vertical</OPTION>
    </SELECT>
  </td>
 </tr>


 </table>
 </td>
</td>
<tr height=10>
 <td > </td>
 <td> </td>
</tr>
<tr valign="top">
 <td colspan=3>
 <table  style="border: 1px solid #663300;" cellspacing="0" cellpadding="1" bgcolor="FFFFCC">
 <tr bgcolor="#E4D6A6"><td colspan=12 align="middle"><b>Font and Colours</b></td></tr>
 <tr bgcolor="#E4D6A6" align="center">
 	<td> </td>
 	<td>Font</td>
 	<td>Font size</td>
 	<td>Color</td>
 	<td>Background color</td>
    <td>Sample</td>
 </tr>
 <tr>
  <td>
   Month
  </td>
  <? editFontColor('customize[fc][month]',$customize[fc][month],"customize"); ?>
 </tr>
 <tr>
  <td>
   Title days
  </td>
  <? editFontColor('customize[fc][t_days]',$customize[fc][t_days],"customize"); ?>
 </tr>
 <tr>
  <td>
   Title weekend days
  </td>
  <? editFontColor('customize[fc][t_wdays]',$customize[fc][t_wdays],"customize"); ?>
 </tr>
 <tr>
  <td>
   Days in past
  </td>
  <? editFontColor('customize[fc][past_days]',$customize[fc][past_days],"customize"); ?>
 </tr>
 <tr>
  <td>
   Weekend days
  </td>
  <? editFontColor('customize[fc][w_days]',$customize[fc][w_days],"customize"); ?>
 </tr>
 <tr>
  <td>
   Days of prev/next month
  </td>
  <? editFontColor('customize[fc][prev_next]',$customize[fc][prev_next],"customize",'bgcolor'); ?>
 </tr>
 <tr>
  <td>
   Current day
  </td>
  <? editFontColor('customize[fc][current_day]',$customize[fc][current_day],"customize"); ?>
 </tr>

 <tr>
  <td>
   No event
  </td>
<?   editFontColor("customize[fc][event0]",$customize[fc]['event0'],"customize");?>
 </tr>

<?
 $event_list=LoadFromFile($cfg_dir.'event_list.txt');
 if (is_array($event_list))
 while (list($key,$val)=each($event_list))
  {
	echo<<<EOT
 <tr>
  <td>
   Event$key
  </td>
EOT;
   editFontColor("customize[fc][event$key]",$customize[fc]['event'.$key],"customize");
   echo ' </tr>';
  }

?>

 </table>
 </td>
</tr>

</table><br>
<input type="submit" value="Apply" >
</form>
<font class="nrm">
Click <img src="images/font_sel.gif"> to select a font.<br>
Click <img src="images/sel.gif"> to select a colour.<br>
</font>

</td>
</tr>
<tr valign="top">
<td>
<b><center class="nrm">Example</center></b><br>
<?
 showcalendar();
?>
</td>

</tr>
</table>
</body>
</html>