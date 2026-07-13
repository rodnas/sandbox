{include file="common_header.tpl"}
{include file="admin_top.tpl"}

<table class="b_table" width="100%" align="center">
	<tr>
		<td class="box_title">
			{lang}Themes{/lang}
		</td>
	</tr>
	<tr>
		<td class="box_subtitle">
			{lang}Themes available{/lang}
		</td>
	</tr>
	<tr>
		<td class="box">

			<table width="98%" align="center">
				<tr>
					<td>{lang}Theme name{/lang}</td>
					<td>{lang}Author{/lang}</td>
					<td>{lang}URL{/lang}</td>
					<td>{lang}Description{/lang}</td>
					<td>{lang}Actions{/lang}</td>
				</tr>
				{foreach from=$themes item=data}
					<tr>
						<td class="{$data.tdStyle}">{$data.name}</td>
						<td class="{$data.tdStyle}">{$data.author}</td>
						<td class="{$data.tdStyle}">{$data.URL}</td>
						<td class="{$data.tdStyle}">{$data.info}</td>
						<td class="{$data.tdStyle}">{$data.activateText}</td>
					</tr>
				{/foreach}
				</table>	

		</td>
	</tr>
</table>

{include file="admin_footer.tpl"}
{include file="common_footer.tpl"}