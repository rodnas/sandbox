<?php
$error_out=false;

if (empty($template_dir))
	$template_dir='calendar/templates';
if (empty($cfg_dir))
	$cfg_dir='./calendar/';
include $cfg_dir."customize_text.php";
function LoadFromFile($file)
{
   if (!$fp = @fopen ($file, "r"))
      	{
          PermissinError();
          return "";
        }

	$contents = "";
	do {
	    $data = fread($fp, 8192);
	    if (strlen($data) == 0) {
	        break;
	    }
    	$contents .= $data;
	} while(true);
	fclose ($fp);
    $ret=unserialize($contents);
//    reset($ret);
	return $ret;
}

function SaveToFile($file,$value)
{
   if (!$fp = @fopen ($file, "w"))
      	{
          PermissinError();
          return "";
        }

	fwrite($fp, serialize($value));
}

function PermissinError()
{
    GLOBAL $error_out,$err_permissions;
    if (!$error_out)
    	{
            $error_out=true;
            echo $err_permissions;
		}
}



		//печать одного мес€ца
function   setFontColorVar($T,$customize,$name)
{
                  $T->SetVar($name.'_bg',$customize[fc][$name][bgcolor]);
                  $T->SetVar($name.'_font',$customize[fc][$name][font]);
                  $T->SetVar($name.'_size',$customize[fc][$name][size]);
                  $T->SetVar($name.'_color',$customize[fc][$name][color]);
}

function print_month($first_day,$m_events,$call_back="",&$customize,$extra_row)
{
	GLOBAL $events_list,$template_dir,$cfg_dir;
//$c_fon='#FAECBC';
//$c_pl ='#944A00';
//$c_pd='#66330';
//$c_sel='#66330';
//$c_ar='#E4D6A6';
//$c_ho='#E4D6A6';

                include_once($cfg_dir.'template_class.php');
                $T = new YaTemplate($template_dir);
				$T->SetFile("main","calendar.tpl");
				$T->SetBlockTree("main", array("row"=>"day"));
                 if (empty($customize))
                      $customize=LoadCustomize($cfg_dir.'customize.txt');

                  for($i=1;$i<8;$i++)
						$T->SetVar('week'.$i,$customize['days'][$i]);

                  $month=$customize['month'][date('n',$first_day)];
                  $T->SetVar(month,$month);

				  $T->SetVar('padding',$customize['padding']);
				  $T->SetVar('spacing',$customize['spacing']);
				  $T->SetVar('table_width',$customize['t_width']);
				  $T->SetVar('table_bg',$customize['table_bg']);
				  $T->SetVar('table_border_width',$customize['table_border_width']);
				  $T->SetVar('table_border_color',$customize['table_border_color']);
				  $T->SetVar('cell_border_width',$customize['cell_border_width']);
				  $T->SetVar('cell_border_color',$customize['cell_border_color']);

// 	$customize[t_width]=1;
//    	$customize[t_cell_width]=1;


                  $today=getdate();
                  $showed_y=date('Y',$first_day);
                  $showed_m=date('n',$first_day);

                  $month_day=date('t',$first_day);
                  $day_of_week=date('w',$first_day);
                  if ($day_of_week==0) $day_of_week=7;
                  $start=$day_of_week;
                  $column=$start-1;

                  $T->SetVar("day_name",'');
                  $T->SetVar("bgcolor",'');
                  if ($first_day>time())
                  	$day_in_past=false;
                    	else
                  	$day_in_past=true;

                  for ($i=1;$i<$start;$i++)
                  {
                        $T->SetVar("class",'prev_next');
            		    $T->SetVar("day_name",'&nbsp;');
                        $T->ParseBlock("day");
                  }
                  for ($i=1;$i<=43-$start;$i++)
                  {
                  if ($month_day>=$i)
                  {
         		    $T->SetVar("class",'event0');
                    if (($showed_y==$today['year']) and ($showed_m==$today['mon'])
                  		and ($i==$today['mday'])
                       )
                     	{
                        $day_in_past=false;
                        $T->SetVar("class",'current_day');
                        if  ($customize[current_bold]=='true')
                        	{
		                        $bold_start="<b>";
		                        $bold_end="</b>";
                            }
                        }
	                    	else
	                    {
                      	 $bold_start="";
                         $bold_end="";
	                    }
                  	if (!empty($call_back))
                    	{
	                     $admin_text="<br>".call_user_func($call_back,array('day'=>$i,'month'=>$showed_m,'cur_event'=>$m_events[$i]));
	                    }
    	                	else
        	            {
	        	           $admin_text="";
	                    }
            		  $T->SetVar("day_name",$bold_start.$i.$bold_end.$admin_text);

	          	    if ($day_in_past)
	                        $T->SetVar("class",'days_in_past');
                            else
		                  	 if ((!empty($m_events[$i])))
	    	                	$T->SetVar("class",'event'.$m_events[$i]);
		                            else
					                  if (($column==5) or ($column==6))
		        		     		        $T->SetVar("class", 'w_days');



//
                  }
                  		else
                  {
                    //$T->CleanVar("day");
        		    $T->SetVar("bgcolor", $customize['prev_next']);
           		    $T->SetVar("day_name",'&nbsp;');
                    $T->SetVar('class','prev_next');
                  }
                  $T->ParseBlock("day");
                  $column++;
                  if ($column == 7)
                  {
              	  	$T->ParseBlock("row");
				    $T->CleanVar("day");
                    $column = 0;
                    if (($month_day<=$i) and (!$extra_row))
                         break;
                  }
                }

                $T->Parse("OUT", "main");
                return $T->getvar("OUT");
//				$T->PrintOut();
}

$week_days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
function LoadCustomize($file)
{
 GLOBAL $week_days;
 $customize=loadfromfile($file);
 if (empty($customize))
 	$customize=array();
 if (empty($customize['month']))
 	$customize['month']=array();
 if (empty($customize['days']))
 	$customize['days']=array();

 for ($i=1;$i<8;$i++)
  if (empty($customize['days'][$i]))
  	$customize['days'][$i]=$week_days[$i-1];

 for ($i=1;$i<13;$i++)
  if (empty($customize['month'][$i]))
   {
    $month=date("F",mktime(0,0,0,$i,1,2000));
    $customize['month'][$i]=$month;
   }
 if (empty($customize[spacing]))
 	$customize[spacing]=0;

 if (empty($customize[table_bg]))
 	$customize[table_bg]='';

 if (empty($customize[table_border_color]))
 	$customize[table_border_color]='black';


 if (empty($customize[table_border_width]))
 	$customize[table_border_width]='1';



 if (empty($customize[padding]))
 	$customize[padding]=1;
 if (empty($customize[current_bold]))
 	$customize[current_bold]=true;
 if (empty($customize[days_past]))
 	$customize[days_past]='gray';
 if (empty($customize[prev_next]))
 	$customize[prev_next]='light gray';

 if (!isset($customize[event_color]))
 	$customize[event_color]=array();
 if (empty($customize[event_color][0]))
 	$customize[event_color][0]='white';
 if (empty($customize[event_color][1]))
 	$customize[event_color][1]='red';
 if (empty($customize[event_color][2]))
 	$customize[event_color][2]='orange';
 if (empty($customize[event_color][3]))
 	$customize[event_color][3]='light blue';
 if (empty($customize[m_number]))
 	$customize[m_number]=1;
 if (empty($customize[row_number]))
 	$customize[row_number]=1;

 if (empty($customize[start_m]))
 	$customize[start_m]=0;
 if (empty($customize[t_width]))
 	$customize[t_width]=1;
 if (empty($customize[t_cell_width]))
    	$customize[t_cell_width]=1;
 if (empty($customize[hol_color]))
    	$customize[hol_color]='#E4D6A6';

 return $customize;

}

function editColor($param_name,$value,$form_name)
{
  echo<<<EOT
  <table>
  <tr>
  <td>
   <input size=6 name="$param_name" value="$value">
  </td>
  <td>
   <a href="javascript:TCP.popup(document.forms['$form_name'].elements['$param_name'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" title="Click Here to Pick up the color" src="images/sel.gif"></a>
  </td>
  </tr>
  </table>
EOT;
}

function showcalendar()
{
    GLOBAL $template_dir,$cfg_dir;
    include_once($cfg_dir.'template_class.php');
    $T = new YaTemplate($template_dir);
	$T->SetFile("main","all_month.tpl");
	//$T->SetBlockTree("main", array("event_style","row_month"=>"one_month",'event_color'));
    $T->SetBlockTree("main", array("event_style","row_month"=>"one_month",'hor_events','ver_events'));

	$events_list=LoadFromFile($cfg_dir.'event_list.txt');
	$events=LoadFromFile($cfg_dir.'events.txt');
	$customize=loadCustomize($cfg_dir.'customize.txt');

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



    $T->SetVar('table_bg',$customize['table_bg']);
    $T->SetVar('table_border_width',$customize['table_border_width']);
    $T->SetVar('table_border_color',$customize['table_border_color']);
	$T->SetVar('padding',$customize['padding']);
    $T->SetVar('spacing',$customize['spacing']);

	$month=date('n');
	$year=date('Y');
    $month=$month+$customize[start_m];
    if ($month>13)
            {
            	$month=$month-12;
                $year++;
            }
            $date=mktime(0,0,0,$month,1,$year);

    $extra_row=false;
    $month1=$month;
    $year1=$year;
    for ($i=0;$i<$customize[m_number]*$customize[row_number];$i++)
    {
        $date=mktime(0,0,0,$month1,1,$year);
        $day_of_week=date('w',$date);
        if ($day_of_week==0) $day_of_week=7;
        $day_of_week--;
        $day_of_week+=date('t',$date);
        if ($day_of_week/7>5)
            {
              $extra_row=true;
              break;
            }

        $month1++;
        if ($month1==13)
            {
                $month1=1;
                $year1++;
            }
    }


	for ($i=0;$i<$customize[m_number]*$customize[row_number];$i++)
	{
        $date=mktime(0,0,0,$month,1,$year);
        $one_month=print_month($date,$events[$month],$call_back,&$customize,$extra_row);
		$T->SetVar('month',$one_month);
		$T->ParseBlock('one_month');
        if (($i+1) % $customize[m_number]==0)
        	{
				$T->ParseBlock('row_month');
                $T->CleanVar('one_month');
            }
        $month++;
        if ($month==13)
            {
            	$month=1;
                $year++;
            }
	}

    if (is_array($events_list))
    {
		while (list($key,$val)=each($events_list))
		{
    		$T->SetVar('name',$val);
            $T->SetVar('event_class','event'.$key);
            if ($customize[menu_layout]!=1)
                {
                  $T->ParseBlock('hor_events');
                  $T->SetVar('ver_events','');
                }
                  else
                {
                  $T->ParseBlock('ver_events');
                  $T->SetVar('hor_events','');
                }
	    }
/*    	reset($events_list);
		while (list($key,$val)=each($events_list))
		{

    		$T->SetVar('color',$customize['event_color'][$key]);
            $T->ParseBlock('event_color');
	    }
*/
	 }
     $T->Parse("OUT", "main");
	 $T->PrintOut();
}


function editFontColor($param_name,$value,$form_name,$param="")
{
  $font=$param_name.'[font]';
  $font_v=$value[font];

  $size=$param_name.'[size]';
  $size_v=$value[size];
  $size_r=$size_v.'px';

  $color=$param_name.'[color]';
  $color_v=$value[color];

  $bgcolor=$param_name.'[bgcolor]';
  $bgcolor_v=$value[bgcolor];

  if ($param<>'bgcolor')
  echo<<<EOT
  <td>
  <table>
  <tr>
  <td>
   <input size=6 name="$font" value="$font_v">
  </td>
  <td>
   <a href="javascript:FSelector.popup(document.forms['$form_name'].elements['$font'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the Font" title="Click Here to Pick up the Font" src="images/font_sel.gif"></a>
  </td>
  </tr>
  </table>
  </td>

  <td>
   <input size=1 name="$size" value="$size_v">
  </td>

  <td>
  <table>
  <tr>
  <td>
   <input size=6 name="$color" value="$color_v">
  </td>
  <td>
   <a href="javascript:TCP.popup(document.forms['$form_name'].elements['$color'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" title="Click Here to Pick up the color" src="images/sel.gif"></a>
  </td>
  </tr>
  </table>
  </td>
EOT;
    else
    echo<<<EOT
  <td> </td><td> </td><td> </td>
EOT;

echo<<<EOT
  <td>
  <table>
  <tr>
  <td>
   <input size=6 name="$bgcolor" value="$bgcolor_v">
  </td>
  <td>
   <a href="javascript:TCP.popup(document.forms['$form_name'].elements['$bgcolor'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" title="Click Here to Pick up the color" src="images/sel.gif"></a>
  </td>
  </tr>
  </table>
  </td>
  <td style='font-size: $size_r;font-family: $font_v;background-color: $bgcolor_v; color: $color_v'>
   Sample text 123
  </td>

EOT;
}
?>