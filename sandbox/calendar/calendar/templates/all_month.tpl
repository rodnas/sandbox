<!-- BEGIN BLOCK styles -->
<style>
.nrm { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 7pt; color: #000000; text-decoration: none}
.nrm_link { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 7pt; color: #000000;}
a:hover.nrm {color:#B61A1A; text-decoration: underline;}
a:hover.nrm_link {color:#B61A1A; text-decoration: underline;}

.days_in_past
{
	font-size: {{past_days_size}}px;
	font-family: {{past_days_font}};
	background-color: {{past_days_bg}};
	color: {{past_days_color}}
}

.current_day
{
	font-size: {{current_day_size}}px;
	font-family: {{current_day_font}};
	background-color: {{current_day_bg}};
	color: {{current_day_color}}
}

.t_days
{
	font-size: {{t_days_size}};
	font-family: {{t_days_font}};
	background-color: {{t_days_bg}};
	color: {{t_days_color}}
}

.t_wdays
{
	font-size: {{t_wdays_size}};
	font-family: {{t_wdays_font}};
	background-color: {{t_wdays_bg}};
	color: {{t_wdays_color}}
}

.w_days
{
	font-size: {{w_days_size}};
	font-family: {{w_days_font}};
	background-color: {{w_days_bg}};
	color: {{w_days_color}}
}

.month
{
	font-size: {{month_size}};
	font-family: {{month_font}};
	background-color: {{month_bg}};
    color: {{month_color}}
}

.prev_next
{
	font-size: {{prev_next_size}};
	font-family: {{prev_next_font}};
	background-color: {{prev_next_bg}};
    color: {{prev_next_color}}
}

<!-- BEGIN BLOCK event_style -->
.{{event}}
{
	font-size: {{size}};
	font-family: {{font}};
	background-color: {{bg}};
    color: {{color}}
}
<!-- END BLOCK event_style -->
</style>
<!-- END BLOCK styles -->

<table bgcolor="{{table_bg}}" width="1" cellspacing="{{spacing}}" cellpadding="{{padding}}"  style="border: {{table_border_width}}px solid {{table_border_color}}">
<!-- BEGIN BLOCK row_month -->
	<tr>
<!-- BEGIN BLOCK one_month -->
	 <td>
         {{month}}
     </td>
<!-- END BLOCK one_month -->
	</tr>
<!-- END BLOCK row_month -->
	<tr>
	<td colspan=100 align=center width=100% height="5">
	</td>
	</tr>
	<tr>
	<td colspan=100 align=center width=100%>
	<table bgcolor="{{table_bg}}" cellspacing="{{spacing}}" cellpadding="{{padding}}"  style="border: {{table_border_width}}px solid {{table_border_color}}">
<!-- BEGIN BLOCK hor_events -->
          <TD class={{event_class}}>{{name}}</TD>
<!-- END BLOCK hor_events -->
<!-- BEGIN BLOCK ver_events -->
          <tr><TD class={{event_class}}>{{name}}</TD></tr>
<!-- END BLOCK ver_events -->
	</TABLE>
    <font class="nrm">
        <a class="nrm_link" href="http://www.web-scripts.biz">(c)2003 Visual Events Calendar, v1.0</a><br>
        Sponsored by <a class="nrm_link"  href="http://www.abcdating.com">ABC Dating</a><br>
    </font>
	</td>
	</tr>
	<tr>
	<td colspan=100 align=center width=100% height="5">
	</td>
	</tr>
</table>