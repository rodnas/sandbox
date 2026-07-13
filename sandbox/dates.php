<?php
$d1 = mktime(0,0,0, 11,12,2014);
$d2 = mktime(0,0,0, 13,12,2014);
$d3 = mktime(0,0,0, 02,30,2014);
echo $d1."<br>";
echo $d2."<br>";
echo $d3."<br>";

$work=date('Y.m.d',mktime(0,0,0,date("m"),date('d'),date("Y")));
$zs=date('H:i:s',mktime(0,0,109,0,0,0));
echo $zs."<br>";
	$NapszamHo[1]   = 31;
  	$NapszamHo[2]   = 28;
  	$NapszamHo[3]   = 31;
  	$NapszamHo[4]   = 30;
  	$NapszamHo[5]   = 31;
  	$NapszamHo[6]   = 30;
  	$NapszamHo[7]   = 31;
  	$NapszamHo[8]   = 31;
  	$NapszamHo[9]   = 30;
  	$NapszamHo[10]  = 31;
  	$NapszamHo[11]  = 30;
  	$NapszamHo[12]  = 31;
$zipcode ="2010";
$pos = strpos($zipcode,"1");
if ($pos === false)
	{
	echo "nincs<br>";
	}
else if ($pos == 0)
	{
	ECHO "Ahol kell<br>";
	}
else
	{
	ECHO "Ahol nem ‚rdekes<br>";
	}


echo "[".strpos($zipcode,"1")."]<br>";
$mlmTop = ARRAY(1);
for ($mlmTopCount=0;$mlmTopCount<count($mlmTop);$mlmTopCount++)
	{
	echo $mlmTopCount.". ".$mlmTop[$mlmTopCount]."<br>";
	}
echo date('Y.m.d',1273294799).'<br>'; 
echo date('Y.m.d',time()+86400).'<br>';
$holnap      = mktime(date("H"), date("i"), date("s"), date("m"),   date("d")+1, date("Y"));
$ubday      = mktime(date("H"), date("i"), date("s"), date("m"),   date("d")+3, date("Y"));
$utolsohonap = mktime(date("H"), date("i"), date("s"), date("m")-1, date("d"),   date("Y"));
$kovetkezoev = mktime(date("H"), date("i"), date("s"), date("m"),   date("d"),   date("Y")+1);
// ezek mind mûk”dnek h¢nap v‚g‚n, ill. janu rban is. Ha nem hiszed, pr¢b ld ki!
echo 'holnap: '.date('Y-m-d H:i:s',$holnap).'<br>';
echo 'mai nap: '.date('Y.m.d',time()).'<br>';
echo 'ubday: '.date('Y-m-d H:i:s',$ubday).'<br>';
echo 'utolsohonap: '.date('Y-m-d H:i:s',$utolsohonap).'<br>';
echo 'kovetkezoev: '.date('Y-m-d H:i:s',$kovetkezoev).'<br>';
echo str_replace("www.","","biztositas.haon.hu")."<br>";
$config['serverName'] 		= strtolower($_SERVER['SERVER_NAME']);
$config['serverName']		= str_replace("www.","",$config['serverName']);
echo $config['serverName'];
//$tol = date('Y').".".date(.".10";
$ig = date('Y.m.d',mktime(0,0,0,date("m")+1,$NapszamHo[date('n')+1],date("Y")));
echo "tol:[".$tol."]<br>";
echo "ig:[".$ig."]<br>";
$datum['ig']=$ig;
echo date('Y.m.d').' '.date('H').' óra '.date('i').' perc<br>';

$pro=$datum['ig'];
$mezo='holnap: {$pro}';
echo ParseTpl($mezo);
$i = "alma";

switch ($i) {
case "alma-ata":
    echo "i most 1";
    break;
case "alma":
    echo "i most 0";
    break;
}

function ParseTpl($tpl)
	{
	$qs=array();
	$qv=array();
	$ex=explode ('{$',$tpl);
	for ($i=0; $i<sizeof($ex); $i++)
		{
		if (substr_count($ex[$i],'}')>0)
			{
			$xx=explode('}',$ex[$i]);
			if (substr_count($xx[0],'[')>0)
				{
				$clr=explode ('[',$xx[0]); 
				$sp=str_replace('$','',substr($clr[1],0,strlen($clr[1])-1)); 
				if(!is_integer($sp) and isset($GLOBALS[$sp])) $sp=$GLOBALS[$sp]; 
				$clr=$clr[0];
				if (!in_array($clr,$qs))
					{
					$qs[]=$clr;
					}
				if(isset($GLOBALS[$clr][$sp])) $to=$GLOBALS[$clr][$sp]; 
				else $to='';
				}
			else 
				{
				if(!in_array($xx[0], $qv))
					{
					$qv[]=$xx[0];
					}
				if(isset($GLOBALS[$xx[0]])) $to=$GLOBALS[$xx[0]];
				else $to='';
				}
			$tpl=str_replace('{$'.$xx[0].'}', $to, $tpl);
			}
		}
	return $tpl;
	}


?>