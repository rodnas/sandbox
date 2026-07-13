		<table bgcolor="{{table_bg}}" width="{{table_width}}" cellspacing="{{spacing}}" cellpadding="{{padding}}"  style="border: {{table_border_width}}px solid {{table_border_color}}">
                <tr>
                <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" height="20">
                  <tr>
                    <td width="100%" align="center" class="month">{{month}}</td>
                  </tr>
                </table>
                <table bgcolor="{{table_bg}}" width="100%" border="0" cellspacing="0" cellpadding="0" class="nrm">
                  <tr align="center" valign="middle">
                    <td height="20" width="20" class="t_days">{{week1}}</td>
                    <td height="20" width="20" class="t_days">{{week2}}</td>
                    <td height="20" width="20" class="t_days">{{week3}}</td>
                    <td height="20" width="20" class="t_days">{{week4}}</td>
                    <td height="20" width="20" class="t_days">{{week5}}</td>
                    <td height="20" width="20" class="t_wdays">{{week6}}</td>
                    <td height="20" width="20" class="t_wdays">{{week7}}</td>
                  </tr>
<!-- BEGIN BLOCK row -->
                  <tr align="center" valign="middle" bgcolor="#FAECBC">
<!-- BEGIN BLOCK day -->
	  		<td height="20" style="border: {{cell_border_width}}px solid {{cell_border_color}}" width="20" class="{{class}}">{{day_name}}</td>
<!-- END BLOCK day -->
                  </tr>
<!-- END BLOCK row -->
                  <tr align="center" valign="middle" bgcolor="#FAECBC">
                  </tr>
                </table>
                </td>
                </tr>
                </table>