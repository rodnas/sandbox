<?
 require_once('./check_login.php');
?>
<? include('header.php')?>
<script>
function clearAll()
{

 document.links[0].style.fontWeight='normal';
 document.links[1].style.fontWeight='normal';
 document.links[2].style.fontWeight='normal';

 document.links[0].style.color='black';
 document.links[1].style.color='black';
 document.links[2].style.color='black';
}

</script>
<br>
<b><font  align="center" size="-1">Admin Menu</font></b>
<br>
<img src="images/dot.gif" width="7" height="6" align="absmiddle" hspace="5" vspace="10">
<a target="body" href="events_admin.php" class="n14" name="m1" id="m1" onclick="clearAll();this.style.fontWeight='bold';this.style.color='red'">Events</a> <br>
<img src="images/dot.gif" width="7" height="6" align="absmiddle" hspace="5" vspace="10">
<a target="body" href="event_list_admin.php " class="n14" name="m2" onclick="clearAll();this.style.fontWeight='bold';this.style.color='red'">Event types</a> <br>
 <img src="images/dot.gif" width="7" height="6" align="absmiddle" hspace="5" vspace="10">
<a target="body" href="customize_admin.php" class="n14" name="m3" onclick="clearAll();this.style.fontWeight='bold';this.style.color='red'">Customize</a> <br>

<br>
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="images/hline-db.gif"><img src="images/hline-db.gif" width="1" height="4"></td>
  </tr>
</table>
<br>
<p align="justify">
<FONT class="n14" >
You are free to use the <b>Visual Events Calendar</b> as long as our
Copyright Notice and Sponsorship link are left in place.
<FONT>
</p>
<script>
  document.links[0].style.fontWeight='bold';
  document.links[0].style.color='red';
</script>
</body>
</html>