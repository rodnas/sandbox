<form action="add_user.php" method="post">
	<table border="0">
		<tr>
			<td>{lang}Username{/lang}:</td>
			<td><input type="text" name="name" value="" size="30" /> (required)</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" value="" size="30" /> (required)</td>
		</tr>
		<tr>
			<td>Real name:</td>
			<td><input type="text" name="realname" value="" size="30" /></td>
		</tr>
		<tr>
			<td>{lang}Password{/lang}:</td>
			<td><input type="password" name="password" value="" size="30" /> (required, at least 6 characters long)</td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="add" value="Add" /></td>
		</tr>
	</table>
</form>