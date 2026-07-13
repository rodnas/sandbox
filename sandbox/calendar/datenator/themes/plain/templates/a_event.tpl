{include file="common_header.tpl"}
{include file="admin_top.tpl"}

{if $print_messages eq 1}

<table class="b_table" width="100%" align="center">
	<tr>
		<td class="box_subtitle">
			{if $message_type eq "error"}
				{lang}Errors occured{/lang}
			{elseif $message_type eq "success"}
				{lang}OK{/lang}
			{/if}
		</td>
	</tr>
	<tr>
		<td class="box">

			<table border="0" width="100%">
				<tr>
					<td valign="top" width="38"><img src="images/{$message_type}.gif" alt="{$message_type}" /></td>
					<td align="left">
						{foreach from=$messages item=message}
						- {$message}<br>
						{/foreach}
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>

<br>

{/if}

<form action="a_event.php" method="post">
<input type="hidden" name="edit_id" value="{$edit_id}" />

<table class="b_table" width="100%" align="center">
	<tr>
		<td colspan="2" class="box_title">
			{lang}{$f.text}{/lang}
		</td>
	</tr>
	<tr>
		<td colspan="2" class="box_subtitle">
			{lang}Event information{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Title{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="title" size="40" value="{$v.title}" />
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Description{/lang}
		</td>
		<td class="box_value">
			<textarea rows="6" cols="50" name="descr">{$v.description}</textarea>
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Location{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="location" size="40" value="{$v.location}" />
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Contact name{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="contact" size="50" value="{$v.contact}" />
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Contact email{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="contact_email" size="50" value="{$v.contactemail}" />
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Link{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="link" size="50" value="{$v.link}" />
		</td>
	</tr>
	<tr>
		<td colspan="2" class="box_subtitle">
			{lang}Date/Time{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Date{/lang}
		</td>
		<td class="box_value">
			{$start_month} 
			{html_select_date start_year="-10" end_year="+10" prefix="start_" time=$s.startdate display_months=false}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Start time{/lang}
		</td>
		<td class="box_value">
			{html_select_time prefix="start_" display_seconds=false time=$s.starttime}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}End time{/lang}
		</td>
		<td class="box_value">
			{html_select_time prefix="end_" display_seconds=false time=$s.endtime}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Repeat type{/lang}
		</td>
		<td class="box_value">
			{html_radios name="repeat" options=$repeat_types selected=$s.type}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Repeat closedate{/lang}
		</td>
		<td class="box_value">
			{html_checkboxes name="useclosedate" options=$useclosedate selected=$s.useclosedate} 
			{$close_month}
			{html_select_date start_year="-10" end_year="+10" prefix="end_" time=$s.closedate display_months=false}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Weekdays (on weekly){/lang}
		</td>
		<td class="box_value">
			{html_checkboxes name="weekdays" options=$weekdays selected=$s.weekday}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Repeat frequency{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="frequency" value="{$v.frequency}" size="5" /> 
			{lang}(e.g 1 = every day/year/month/week, 2 = every other... etc){/lang}
		</td>
	</tr>
	<tr>
		<td colspan="2" class="box_subtitle">
			{lang}Appearance{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Font{/lang}
		</td>
		<td class="box_value">
			{html_radios name="font" options=$font selected=$s.font}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Size{/lang}
		</td>
		<td class="box_value">
			{html_radios name="font_size" options=$font_size selected=$s.font_size}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Style{/lang}
		</td>
		<td class="box_value">
			{html_radios name="font_styles" options=$font_styles selected=$s.font_style}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Color{/lang}
		</td>
		<td class="box_value">
			{html_radios name="font_color" options=$font_color selected=$s.font_color}
		</td>
	</tr>
	<tr>
		<td colspan="2" class="box_subtitle">
			{lang}Choose{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Confirm{/lang}
		</td>
		<td class="box_value">
			<input type="submit" name="{$f.action}" value="{lang}{$f.text}{/lang}" />
		</td>
	</tr>
</table>

</form>

{include file="admin_footer.tpl"}
{include file="common_footer.tpl"}