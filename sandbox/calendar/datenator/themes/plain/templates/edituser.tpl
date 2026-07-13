{include file="common_header.tpl"}
{include file="admin_top.tpl"}

<table class="b_table" width="100%" align="center">
	<tr>
		<td class="box_title">
			{lang}Edit user{/lang}
		</td>
	</tr>
	<tr>
		<td class="box_subtitle">
			{lang}Modifying user info{/lang}: {$v.username}
		</td>
	</tr>
	<tr>
		<td class="box">

			<form action="edituser.php" method="post">
			<input type="hidden" name="uid" value="{$v.user_id}">
			<table border="0">
				<tr>
					<td>{lang}User ID{/lang}:</td>
					<td>{$v.user_id}</td>
				</tr>
				<tr>
					<td>{lang}Username{/lang}:</td>
					<td><input type="text" name="username" value="{$v.username}" size="30" /> (required)</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="text" name="email" value="{$v.email}" size="30" /> (required)</td>
				</tr>
				<tr>
					<td>Real name:</td>
					<td><input type="text" name="realname" value="{$v.realname}" size="30" /></td>
				</tr>
				<tr>
					<td>{lang}New password{/lang}:</td>
					<td><input type="password" name="password" value="" size="30" /> Leave empty if you don't want to change password.(must be at least 6 characters long)</td>
				</tr>
				<tr>
					<td>{lang}New password{/lang}:</td>
					<td><input type="password" name="password_conf" value="" size="30" /> [Confirm]</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="edit_user" value="Save changes" /></td>
				</tr>
			</table>
			</form>

		</td>
	</tr>
</table>

{include file="admin_footer.tpl"}
{include file="common_footer.tpl"}