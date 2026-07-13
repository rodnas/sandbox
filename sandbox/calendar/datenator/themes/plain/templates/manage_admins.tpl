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
			{lang}Edit admins{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">
				
				<table border="1">
				{foreach from=$admins item=data}
					<tr>
						<td>{$data.userName}</td>
						<td>{$data.userRealName}</td>
						<td><a href="edituser.php?id={$data.userId}">Modify info</a></td>
						<td>{$data.removeLink}</td>
					</tr>
				{/foreach}
				</table>	
				<p>* Super admin cannot be deleted</p>
		</td>
	</tr>
	<tr>
		<td class="box_subtitle">
			{lang}Add a new administrator{/lang}
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