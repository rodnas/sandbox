{include file="html_top.tpl"}

<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<table border="0" width="100%" align="center">
<tr>
	<td>

		<table border="0" width="100%">
			<tr>
				<td>
					<span class="cal_name">{$G.PAGE_TITLE}</span>
					<br /><br />
				</td>
			</tr>
			<tr>
					<td width="20%">
						<form action="month.php" method="get" name="selectmonth">
						{lang}Month{/lang} {$G.PD_MONTHS} 
						<input type="submit" value="{lang}Go{/lang}" />
						</form>
					</td>
					<td width="80%">
						<form action="year.php" method="get" name="selectyear">
						{lang}Year{/lang} 
						{html_select_date all_extra="onchange=\"document.selectyear.submit()\"" prefix="jump_" start_year=$G.PD_START_YEAR end_year=$G.PD_END_YEAR time=$G.PD_S_YEAR display_months=false display_days=false}
						<input type="submit" value="{lang}Go{/lang}" />
						</form>
					</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td>{include file="menu.tpl"}</td>
</tr>
<tr>
	<td>