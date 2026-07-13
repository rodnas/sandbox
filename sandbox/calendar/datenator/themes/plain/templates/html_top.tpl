<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
		<link rel="stylesheet" href="{$G.CALENDAR_URL}/themes/{$G.THEME_NAME}/css/{$G.CSS_FILE}" type="text/css" />
		<script type="text/javascript" src="overlib.js"></script>
		<script type="text/javascript">
		{literal}
			function popup(url, name, x, y) 
			{
				window.open(url, name, "resizable=no, scrollbars=yes, width="+x+", height="+y+", top=100, left=150")
			}

			function conf(text)
			{
				var agree=confirm(text);
				if (agree) {
					return true;
				} else {
					return false;
				}
			}
		{/literal}
		</script>

		<meta name="keywords" content="{$G.META_KEYWORDS}" />
		<meta name="description" content="{$G.META_DESCRIPTION}" />

		<title>{$G.PAGE_TITLE_TEXT}</title>
</head>
<body>