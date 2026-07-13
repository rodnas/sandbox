{include file="html_top.tpl"}

<table class="b_table" width="100%">
	<tr>
		<td colspan="2" class="box_title">
			{$v.title} <span class="minitext">({lang}Author{/lang}: {$v.author})</span>
		</td>
	</tr>
	<tr>
		<td class="box" width="20%">
			{lang}Date{/lang}:
		</td>
		<td class="box_value">
			{$v.date}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Time{/lang}:
		</td>
		<td class="box_value">
			{$v.time}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Location{/lang}:
		</td>
		<td class="box_value">
			{$v.location}
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Contact{/lang}:
		</td>
		<td class="box_value">
			{$v.contact} <a href="mailto: {$v.contact_email}">({$v.contact_email})</a>
		</td>
	</tr>
	<tr>
		<td class="box">
			{lang}Link{/lang}:
		</td>
		<td class="box_value">
			<a href="{$v.link}">{$v.link}</a>
		</td>
	</tr>
</table>

<table border="0" width="100%">
	<tr>
		<td class="box_value">
			{$v.description}
		</td>
	</tr>
</table>

<br />

<table border="0" width="100%">
	<tr>
		<td class="box_value" align="right">
			[<a href="javascript:window.print()">{lang}Print{/lang}</a>] - [<a href="javascript:parent.close()">{lang}Close window{/lang}</a>]
		</td>
	</tr>
</table>

{include file="html_footer.tpl"}