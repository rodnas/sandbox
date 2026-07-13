{include file="html_top.tpl"}

<br /><br />

{if $event_is_deleted eq 0}

<table border="0" align="center">
	<tr>
		<td align="center">
			{lang}Are you sure you want to delete{/lang}<br />
			<b style="font-size:20px;">{$event.name}</b<br />
			?
		</td>
	</tr>
	<tr>
		<td align="center">

			<form action="delete_event.php" method="post" name="delete_form">
				<input type="hidden" name="delete_id" value="{$event.id}">
				<input type="submit" name="delete" value="Delete" onclick="window.opener.window.location.reload(true);">
				<input type="submit" value="Cancel" onclick="parent.close();">
			</form>
		
		</td>
	</tr>
</table>

{/if}
{if $event_is_deleted eq 1}

<table border="0" align="center">
	<tr>
		<td align="center">
			{lang}Event succesfully deleted{/lang}.
		</td>
	</tr>
	<tr>
		<td align="center">
			<a href="#" onclick="javascript:parent.close();">{lang}Close window{/lang}</a>
		</td>
	</tr>
</table>

{/if}

{include file="html_footer.tpl"}