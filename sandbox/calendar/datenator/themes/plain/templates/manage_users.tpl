{include file="common_header.tpl"}
{include file="admin_top.tpl"}

<table class="b_table" width="100%" align="center">
	<tr>
		<td class="box_title">
			{lang}Manage users{/lang}
		</td>
	</tr>
	<tr>
		<td class="box_subtitle">
			{lang}Edit user{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">
			<form action="manage_users.php" method="post">
				{lang}Type username{/lang}: <input type="text" name="username" value="" size="30" />
				<input type="submit" name="search_user" value="{lang}Edit{/lang}" />
			</form>
		</td>
	</tr>
	<tr>
		<td class="box_subtitle">
			{lang}New user{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">

			{include file="add_user_form.tpl"}

		</td>
	</tr>
</table>

{include file="admin_footer.tpl"}
{include file="common_footer.tpl"}