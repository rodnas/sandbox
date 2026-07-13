{include file="common_header.tpl"}

<table border="0" width="100%">
	<tr>
		<td width="70%">
			<b>{$G.DAY_NAME} {$G.DAY}{$G.DAY_SUFFIX}, {$G.MONTH_NAME} {$G.YEAR}</b><br /><br />
			<table class="b_table" width="100%">
				{$dayview_html}
			</table>
		</td>
		<td valign="top" width="30%" align="center">
			{$little_cal}
		</td>
	</tr>
</table>

{include file="common_footer.tpl"}