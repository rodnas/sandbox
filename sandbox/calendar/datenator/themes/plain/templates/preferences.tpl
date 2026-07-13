{include file="common_header.tpl"}
{include file="admin_top.tpl"}

<form action="preferences.php" method="post">
<input type="hidden" name="version" value="{$G.VERSION}" />

<table class="b_table" width="100%" align="center">
	<tr>
		<td colspan="2" class="box_title">
			{lang}Calendar settings{/lang}
		</td>
	</tr>
	<tr>
		<td colspan="2" class="box_subtitle">
			{lang}General{/lang}
		</td>
	</tr>
	<tr>
		<td class="box" width="18%">
			{lang}Page title{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="pagetitle" size="45" value="{$v.pagetitle}" />
		</td>
	</tr>
	<tr>
		<td class="box" width="18%">
			{lang}Calendar logo{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="calendar_logo" size="45" value="{$v.logo}" />
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}META-keywords{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="meta_keywords" size="45" value="{$v.meta_kw}" />
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}META-description{/lang}
		</td>
		<td class="box_value">
			<textarea name="meta_description" rows="4" cols="40">{$v.meta_descr}</textarea>
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Display language{/lang}
		</td>
		<td class="box_value">
			{$language_selection}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Preferred view{/lang}
		</td>
		<td class="box_value">
			{$preferred_view_selection}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Show week numbers{/lang}
		</td>
		<td class="box_value">
			{html_radios name="show_weeks" options=$show_weeks selected=$s_show_weeks"}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Weeks first day{/lang}
		</td>
		<td class="box_value">
			{html_radios name="first_day" options=$first_day selected=$s_first_day"}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Allow guests to add events{/lang}
		</td>
		<td class="box_value">
			{html_radios name="allow_guestadd" options=$guestadd selected=$s_guestadd"}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Event popup{/lang}
		</td>
		<td class="box_value">
			<input type="text" name="event_popup_width" size="3" value="{$v.e_popup_width}" maxlength="3" /> x
			<input type="text" name="event_popup_height" size="3" value="{$v.e_popup_height}" maxlength="3" /> {lang}pixels{/lang}
			({lang}width x height{/lang})
		</td>
	</tr>
	<tr>
		<td colspan="2" class="box_subtitle">
			{lang}Password{/lang}
		</td>
	</tr>
	<tr>
		<td colspan="2" class="box_value">
		You can set a password so only people who know this password can view your calendar. Set password by clicking the checkbox and entering the password to the field below. 
		If the checkbox below is not checked, it means that anyone can view your calendar. You can change password by leaving the checkbox checked, typing a new password and then clicking the update button.
		</td>
	</tr>
	<tr>
		<td class="box">{lang}Password{/lang}</td>
		<td class="box_value">
			{html_checkboxes name="cal_has_pw" options=$cal_pw_check selected=$cal_has_pw} 
			<input type="password" name="cal_password" value="" size="40" />
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
			<input type="submit" name="edit_calendar" value="{lang}Update{/lang}" />
		</td>
	</tr>
</table>

</form>

{include file="admin_footer.tpl"}
{include file="common_footer.tpl"}