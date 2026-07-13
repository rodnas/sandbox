<?
 require_once('./check_login.php');
?>
<? include('header.php')?>
<font size=3><b><center>Events</center></b></font><br>
<?
	include_once('./calendar.php');
    include_once('./template_class.php');
	$customize=loadCustomize($cfg_dir.'customize.txt');

?>
<form>
<input type="hidden" name="action" value="events_admin">
<table cellspacing="0" cellpadding="1" >
	<tr>
    <td>
<?
//           мес€ц  событи€ по дн€м



?>
<?php


if ($action=='events_admin')
 {

//    $events=array('8'=>array(1=>1,10=>3,11=>1),'9'=>array(1=>1,10=>2,11=>1));
//    while (list($key,$val)=each($events))
//     {
//     }

    if (!empty($events))
     {
        $events_full=LoadFromFile($cfg_dir.'events.txt');
        $prev_month=date('n')-1;
        if ($prev_month==0)
			$prev_month=12;
        unset($events_full[$prev_month]);
        $month=key($events);
        $events=$events[$month];
		while (list($key,$val)=each($events))
               {
                 if ($event_type!=-1)
	                 $events_full[$month][$key]=$event_type;
                     	else
                     unset($events_full[$month][$key]);
               }
       SaveToFile($cfg_dir."events.txt",$events_full);
       $events=$events_full;
     }
     	else
	 $events=LoadFromFile($cfg_dir.'events.txt');
 }
 	else
 $events=LoadFromFile($cfg_dir.'events.txt');




    $T = new YaTemplate($template_dir);
	$T->SetFile("main","all_month.tpl");
	$T->SetBlockTree("main", array("styles"=>"event_style","row_month"=>"one_month",'hor_events','ver_events'));

	$events_list=LoadFromFile($cfg_dir.'event_list.txt');



    setFontColorVar(&$T,&$customize,'month');
	setFontColorVar(&$T,&$customize,'t_days');
	setFontColorVar(&$T,&$customize,'t_wdays');
	setFontColorVar(&$T,&$customize,'past_days');
	setFontColorVar(&$T,&$customize,'w_days');
	setFontColorVar(&$T,&$customize,'prev_next');
	setFontColorVar(&$T,&$customize,'current_day');


    for ($i=0;$i<=sizeof($events_list);$i++)
     {
        $T->SetVar('event','event'.$i);
        $T->SetVar('bg',$customize[fc]['event'.$i][bgcolor]);
        $T->SetVar('font',$customize[fc]['event'.$i][font]);
        $T->SetVar('size',$customize[fc]['event'.$i][size]);
        $T->SetVar('color',$customize[fc]['event'.$i][color]);
        $T->ParseBlock('event_style');
     }
    $T->ParseBlock('styles');
    echo $T->GetVar('styles');






function one_day($val)
{
    return '<input type="checkbox" name="events['.$val[month].']['.$val[day].']">';
//    print_r($val);
}

$call_back='one_day';
if (empty($month))
	{
		$month=date('n');
		$year=date('Y');
    }
    else
    if ($month==13)
    	{
        	$month=1;
            $year++;
        }
        else
       	if ($month==0)
        	{
            	$month=12;
                $year--;
            }

        $date=mktime(0,0,0,$month,1,$year);
        $empty="";
        echo print_month($date,$events[$month],$call_back,$empty,true);
?>
</td>
</tr>
<tr>
<td colspan=100 align=center width=100%>
<table>
<tr>
<?
if (is_array($events_list))
{
	while (list($key,$val)=each($events_list))
	{
	 echo<<<EOT
 <td height="20" class="event$key">$val</td>
EOT;
	}
}
?>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan=100 align=center width=100%>
Select Event:
<select name="event_type">
 <option value="-1">no event</option>
<?
reset($events_list);
while (list($key,$val)=each($events_list))
{
 echo<<<EOT
 <option value="$key">$val</option>
EOT;
}
?>
</select>
</td>
</tr>

</table>
<br>
<b>
<a href="?month=<?=$month-1?>&year=<?=$year?>" ><font size=4>prev month</a>
<input type="submit" value="Apply" >
<a href="?month=<?=$month+1?>&year=<?=$year?>">next month</a>
</b>
<input type="hidden" name="month" value=<?=$month?>>
<input type="hidden" name="year" value=<?=$year?>>
</form><font class="n14">
To change an event:
   <ul>
       <li>check the days you want to set</li>
       <li>select the event required, or No Event</li>
       <li>press the Apply button.</li>
   </ul>
You can add new events on the <a href="event_list_admin.php">Event Types</a> page.<br>
To display the next month, click on "next month".<br>
To display the previous month, click on "prev month".<br>
</font>