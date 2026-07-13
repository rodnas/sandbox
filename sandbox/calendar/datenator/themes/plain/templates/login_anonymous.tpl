{include file="html_top.tpl"}

<table border="0" align="center">
	<tr>
		<td align="center">{$title}</td>
	</tr>
	<tr>
		<td>
			
			This calendar is password protected. Please enter password to view calendar.
			<br /><br />

			<form action="login_anonymous.php" method="post">
			<table class="b_table" width="50%" align="center">
				<tr>
					<td class="box" align="center">Password</td>
					<td class="box_value" align="center"><input type="password" name="password" size="50" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center" class="box_subtitle">
						<input type="submit" name="login" value="Submit" />
					</td>
				</tr>
			</table>
			</form>

		</td>
	</tr>
</table>


{include file="html_footer.tpl"}