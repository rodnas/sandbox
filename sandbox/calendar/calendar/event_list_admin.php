<?
 require_once('./check_login.php');
?>
<? include('header.php')?>
<font size=3><b><center>Events Type</center></b></font><br><br>
<form method="post" name="event_type">
<input type="hidden" name="action" value="types">
<table class="nrm" cellspacing="0" cellpadding="0"  style="border: 1px solid #663300;" bgcolor="#FAECBC">
       <tr bgcolor="#E4D6A6">
        <td width=100>Class name</td>
        <td width=100>Event Type</td>
        <td width=30>Delete</td>
       </tr>

<?
include_once('calendar.php');
if ($action=="types")
 {
    if (is_array($del))
	while (list($key,$val)=each($del))
             {
             	unset($event_list[$key]);

             }
    reset($event_list);
    $new_a=array();
    $i=1;
    while (list($key,$val)=each($event_list))
             {
				$new_a[$i++]=$val;
             }
	$event_list=$new_a;
    SaveToFile($cfg_dir."event_list.txt",$event_list);
 }
 	else
 {
	 $event_list=LoadFromFile($cfg_dir.'event_list.txt');
 }
 if ($action=='add')
 {
    $event_list[$number]='new Event Type';
    SaveToFile($cfg_dir."event_list.txt",$event_list);
 }

 if (empty($event_list))
	$event_list=array();

 $number=0;
while (list($key,$val)=each($event_list))
 {
       $number++;
       echo<<<EOT
       <tr>
        <td class="txt_w" bgcolor="#FAECBC">event$key</td>
        <td class="txt_w" bgcolor="#FAECBC"><input class="nrm" name="event_list[$key]" value="$val"></td>
        <td class="txt_w" bgcolor="#FAECBC"><input type="checkbox" name="del[$key]"></td>
       </tr>
EOT;
 }

?>
</table>
<input class="nrm" type="submit" value="Apply">
</form>
<form>
<input type="hidden" name="action" value=add>
<input type="hidden" name="number" value=<?=$number+1?>>
<input class="nrm" type="submit" value="Add Event Type">
</form>
<font class="n14">
  <ul>
    <li>To add a new Event, press the Add Event Type button.</li>
    <li>To specify the name of the event, enter its details in the Event
Type box, and press Apply.</li>
  </ul>
</font>