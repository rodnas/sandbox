{include file="common_header.tpl"}

<br />

<form action="login.php" method="post">

<table class="b_table" width="50%" align="center">
<tr>
<td class="box_title" colspan="2" align="center">{$G.PAGE_TITLE_TEXT} - {lang}Administration{/lang}</td>
</tr>
<tr>
<td class="box" align="center">{lang}Username{/lang}</td>
<td class="box_value" align="center"><input type="text" name="username" size="50" /></td>
</tr>
<tr>
<td class="box" align="center">{lang}Password{/lang}</td>
<td class="box_value" align="center"><input type="password" name="password" size="50" /></td>
</tr>
<tr>
<td colspan="2" align="center" class="box_subtitle">
<input type="submit" name="login" value="{lang}Log in{/lang}" />
</td>
</tr>
</table>

</form>

{if $print_login_error eq 1}
	<p align="center"><b>{lang}Wrong username/password!{/lang}</b></p>
{/if}

{include file="common_footer.tpl"}