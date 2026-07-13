<?php
if (version_compare(phpversion(), '5.3.10', '>'))
	{
//	echo 'Current PHP version: '.phpversion().'<br>';
	error_reporting(0);
	}
session_start();
$ctype = "month";
if (isset($_GET["type"]) && !empty($_GET["type"])) {
	$ctype = $_GET["type"];
} else if (isset($_POST["type"]) && !empty($_POST["type"])){
	$ctype = $_POST["type"];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Calendar</title>
		<link rel="stylesheet" href="cal.css">
	</head>
	<body>
		<div align="center">
			<input type="hidden" name="ctype" value="<?php echo $ctype ?>">
			<table>
				<tr>
					<td><a href="index.php?type=month">Havi</a>&nbsp;</td>
					<td><a href="index.php?type=halfyear">Féléves</a>&nbsp;</td>
					<td><a href="index.php?type=year">Éves</a></td>
				</tr>
			</table>
<?php
switch ($ctype) {
	case "month":
		$mn=0;
		$totalSumDist=0;
		$totalSumKcal=0;
		$_REQUEST['m'] = "";
		if (intval($_REQUEST["way"])<0)
			{
			$_REQUEST['m'] = "p".abs($_REQUEST["way"]);
			$point=intval($_REQUEST["way"]);
		 	}
		else if (intval($_REQUEST["way"])>0)
			{
			$_REQUEST['m'] = "f".$_REQUEST["way"];
			$point=intval($_REQUEST["way"]);
		 	}
		else
			{
			$point=0;
			}
		$prev=$point;
		$forw=$point;
		$prev--;
		$forw++;
		?>
			<table>
				<tr>
					<td><?php echo '<a href="index.php?way='.$prev.'"><</a>'; ?> </td>
					<td><?php require_once ("cal.php"); ?></td>
					<td><?php echo '<a href="index.php?way='.$forw.'">></a>';?></td>
				</tr>
			</table>
		<?php
		break;
	case "halfyear":
		?>
			<table>
				<tr>
					<td><?php $_REQUEST['m'] = "p5";virtual ("cal.php"); //include ("cal.php"); ?></td>
					<td><?php $_REQUEST['m'] = "p4";virtual ("cal.php");//include ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "p3";virtual ("cal.php");//include ("cal.php");?> </td>
				</tr>
				<tr>
					<td><?php $_REQUEST['m'] = "p2";virtual ("cal.php");//include ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "p1";virtual ("cal.php");//include ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "";virtual ("cal.php");//include ("cal.php");?></td>
				</tr>
			</table>
		<?php
		break;
	case "year":
		?>
			<table>
				<tr>
					<td><?php $_REQUEST['m'] = "p11";$_REQUEST['dh'] = 1;virtual ("cal.php");?> </td>
					<td><?php $_REQUEST['m'] = "p10";virtual ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "p9";virtual ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "p8";virtual ("cal.php");?></td>
				</tr>
				<tr>
					<td><?php $_REQUEST['m'] = "p7";virtual ("cal.php");?> </td>
					<td><?php $_REQUEST['m'] = "p6";virtual ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "p5";virtual ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "p4";virtual ("cal.php");?></td>
				</tr>
				<tr>
					<td><?php $_REQUEST['m'] = "p3";virtual ("cal.php");?> </td>
					<td><?php $_REQUEST['m'] = "p2";virtual ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "p1";virtual ("cal.php");?></td>
					<td><?php $_REQUEST['m'] = "";virtual ("cal.php");?></td>
				</tr>
			</table>
		<?php
		break;
}
?>
		</div>
	</body>
</html>
