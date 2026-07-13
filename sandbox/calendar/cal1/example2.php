<html>
<head>
<title>HTML-Calendar Example</title>
</head>
<body>
<h3>HTML-Calendar Example</h3>
<table border="0" cellspacing="0" cellpadding="5"><tr valign="top">
<td>
<?php
  include('calendar.inc.php');

  $year = date('Y');
  $month = date('n');

  $y = $year;
  $m = $month - 2;
  if($m <= 0) {
    $m += 12;
    $y--;
  }

  $cal = new CALENDAR($y, $m);
  $cal->offset = $offset;
  $cal->weekNumbers = $weeks;
  $cal->tFontSize = 12;
  $cal->hFontSize = 9;
  $cal->dFontSize = 9;
  $cal->wFontSize = 9;
  echo $cal->create() . '<br>';

  $y = $year;
  $m = $month - 1;
  if($m <= 0) {
    $m += 12;
    $y--;
  }

  $cal = new CALENDAR($y, $m);
  $cal->offset = $offset;
  $cal->weekNumbers = $weeks;
  $cal->tFontSize = 12;
  $cal->hFontSize = 9;
  $cal->dFontSize = 9;
  $cal->wFontSize = 9;
  echo $cal->create();
?>
</td>
<td>
<?php
  $cal = new CALENDAR($year, $month);
  $cal->offset = $offset;
  $cal->weekNumbers = $weeks;
  $cal->tFontSize = 24;
  $cal->hFontSize = 18;
  $cal->dFontSize = 24;
  $cal->wFontSize = 18;
  $cal->viewEvent(6, 8, "#E0E0FF", "Seminar &quot;How to use HTML-Calendar&quot;");
  $cal->viewEvent(7, 7, "#A0B0C0", "Peter's birthday");
  $cal->viewEvent(15, 19, "#D0FFD0", "Trip to Hawaii!");
  $cal->viewEventEach(2, "#FFFFA0", "I hate Mondays!");
  echo $cal->create();
?>
</td>
<td>
<?php
  $y = $year;
  $m = $month + 1;
  if($m > 12) {
    $m -= 12;
    $y++;
  }

  $cal = new CALENDAR($y, $m);
  $cal->offset = $offset;
  $cal->weekNumbers = $weeks;
  $cal->tFontSize = 12;
  $cal->hFontSize = 9;
  $cal->dFontSize = 9;
  $cal->wFontSize = 9;
  echo $cal->create() . '<br>';

  $y = $year;
  $m = $month + 2;
  if($m > 12) {
    $m -= 12;
    $y++;
  }

  $cal = new CALENDAR($y, $m);
  $cal->offset = $offset;
  $cal->weekNumbers = $weeks;
  $cal->tFontSize = 12;
  $cal->hFontSize = 9;
  $cal->dFontSize = 9;
  $cal->wFontSize = 9;
  echo $cal->create();
?>
</td>
</tr></table>
</body>
</html>
