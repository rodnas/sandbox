<?php
header("Content-Type: application/xml");
print '<?xml version="1.0"?>';
include('includes/functions.php');
$datenator = new Datenator;
?>
<rss version="2.0">
	<channel>
		<title>Datenator</title>
		<link>http://www.lol.fi</link>
		<lastBuildDate><?php print date('r'); ?></lastBuildDate>
		<description>My calendar</description>
		<docs>http://blogs.law.harvard.edu/tech/rss</docs>
		<generator>Datenator <?php print $datenator->_sets['version']; ?>, http://indom.sf.net</generator>
			<?php
			$datenator->db_connect();
			$sql = "SELECT * FROM dat_events";
			$query=mysql_query($sql);
			while($data=mysql_fetch_array($query))
			{
			?>
				<item>
					<title><?php print $data['event_name']; ?></title>
					<link>http://localhost/Datenator-dev/event.php?id=<?php print $data['event_id']; ?></link>
					<description><?php print $data['event_description']; ?></description>
					<date><?php print date('Y/m/d', mktime($datenator->get_hour($data['event_starttime']), $datenator->get_mins($data['event_starttime']), 0, $data['event_month'],$data['event_day'],$data['event_year'])); ?></date>
					<starttime><?php print $data['event_starttime']; ?></starttime>
					<endtime><?php print $data['event_endtime']; ?></endtime>
					<author><?php print $data['event_author']; ?></author>
				</item>
			<?php
			}
			?>
	</channel>
</rss>
<?php

/*
 * $Id$
**/
?>