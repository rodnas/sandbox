<html>
<head>
<title>MINTA</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<meta http-equiv="content-language" content="hu">
<meta name="language" content="hu">
<link rel='STYLESHEET' type='text/css' href='<?php echo ROOT; ?>css/style.css'>
<body >
<div class='content w800'>
  <div class="logo"><img style="logo" src="<?php echo ROOT; ?>image/ylogo_coming_time.jpg" alt=""/></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="ertekeles">
  <tbody>
    <tr>
      <td>Név</td>
      <td>Születési dátum</td>
      <td>E-mail</td>
      <td>Pontszám</td>
    </tr>
<?php
	foreach ($data['content']['scoreData'] as $key=>$temp) {
	if ($temp['score'] == $data['content']['scoreMax']) {
		$setClass = ' class="max"';
	} else if ($temp['score'] == $data['content']['scoreMin']) {
		$setClass = ' class="min"';
	} else {
		$setClass = '';
	}
?>
	
	<tr<?php echo $setClass; ?>>
		<td><?php echo $temp['name']; ?></td>
		<td><?php echo str_replace('-','.',$temp['birthWhen']); ?></td>
		<td><?php echo $temp['email']; ?></td>
		<td><?php echo $temp['score']; ?></td>
	</tr>
<?php
	}
?>
    <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Átlag</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?php echo $data['content']['scoreAvg']; ?></td>
    </tr>
  </tbody>
</table>
<input class="butt_vissza" onclick="location.href='?Feladat=Bekero';" value="Vissza" type="submit">    
</div>    