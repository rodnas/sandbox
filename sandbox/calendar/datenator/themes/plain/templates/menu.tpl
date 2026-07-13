<table width="100%">
	<tr>
		<td class="admin_menu">
			<b>{lang}View{/lang}:</b> | <a class="admin_menu" href="month.php" title="{lang}Month{/lang}">{lang}Month{/lang}</a> | 
			<a class="admin_menu" href="day.php" title="{lang}Day{/lang}">{lang}Day{/lang}</a> | 
			<a class="admin_menu" href="year.php" title="{lang}Year{/lang}">{lang}Year{/lang}</a> | 
			<a class="admin_menu" href="admin.php" title="{lang}Admin{/lang}">{lang}Admin{/lang}</a> | 
			<b>{lang}User{/lang}:</b> | {$G.C_USER_NAME} 
			{if $c_user_logged_in eq 1}
				<a class="admin_menu" href="logout.php" title="{lang}Log out{/lang}">({lang}Log out{/lang})</a>
			{/if}
			 | {$G.LOGIN_LINK}
		</td>
	</tr>
</table>