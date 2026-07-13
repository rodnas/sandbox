<!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="<?php echo $data['content']['metaDescription_Text']; ?>">
	<meta name="keywords" content="<?php echo $data['content']['metaKeywords_Text']; ?>">
	<meta name="author" content="<?php echo $data['content']['metaAuthor_Text']; ?>">
	<!--<link rel="icon" href="/favicon.ico">-->
	
	<title><?php echo $data['content']['siteTitle_Label']; ?></title>
	
	<!--<link href="css/bootstrap.min.css" rel="stylesheet">-->
	<link href="<?php echo ROOT; ?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo ROOT; ?>css/bootstrap-select.css" rel="stylesheet">
	<link href="<?php echo ROOT; ?>css/slick.css" rel="stylesheet">
	
	<link href="<?php echo ROOT; ?>css/site.css" rel="stylesheet">
	<link href="<?php echo ROOT; ?>css/queries.css" rel="stylesheet">
	<link href="<?php echo ROOT; ?>css/font-awesome.min.css" rel="stylesheet">
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	  <script src="http://html5shiv-printshiv.googlecode.com/svn/trunk/html5shiv-printshiv.js"></script>
	<![endif]-->
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?php echo ROOT; ?>js/classie.js"></script>
	<script>
		function init() {
		window.addEventListener('scroll', function(e){
			var distanceY = window.pageYOffset || document.documentElement.scrollTop,
				shrinkOn = 120,
				header = document.querySelector("#sticky-header");
			if (distanceY > shrinkOn) {
				classie.add(header,"smaller");
			} else {
				if (classie.has(header,"smaller")) {
					classie.remove(header,"smaller");
				}
			}
		});
	}
	window.onload = init();
	</script>
</head>


<body class="" data-spy="scroll" data-target="#myNavbar">

<div id="top"></div>
	
	<!-- mobile-header -->
	<div class="mobile-header">
		<div class="container">
			<div class="row">
				<div class="logo"></div>
			</div>
		</div>
	</div>
	<!-- mobile header -->
	
	
	<!-- main services -->
	<div class="main " id="szolgaltatasok">
		<div class="container">
				
			<div class="services-cont">
					
<?php
		foreach ($data['content']['items'] as $key=>$temp) {
?>
				<div class="row">
					<div class="col-md-12 text-left"><?php echo $temp['insertWhen']; ?></div>
				<div>
				<div class="row">
					<div class="col-md-12 text-left"><?php echo $temp['label']; ?></div>
				<div>
				<div class="row">
					<div class="col-md-12 text-left"><?php echo $temp['shortDescription']; ?></div>
				<div>
				<div class="col-md-12 text-left">
					<img src="<?php echo $data['content']['newsIMG'].$temp['listIMG']; ?>" alt="" width="150" height="150">
				</div>
				<div style="clear:both;height:10px;"></div>
				<div class="row text-left">
					<a class="btn btn-primary" href="<?php echo ROOT; ?>news/<?php echo $temp['id']; ?>" role="button">Tovább</a>
				</div>
				<div style="clear:both;height:40px;"></div>
<?php
		}
?>
			</div>
				
		</div>
	</div>
	<!-- main services -->
	
	<div id="map" class="g_map" style="width:100%; height:500px"></div>
	

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo ROOT; ?>js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="<?php echo ROOT; ?>js/ie10-viewport-bug-workaround.js"></script>
	
	<script src="<?php echo ROOT; ?>js/bootstrap-datepicker.js"></script>
	<script src="<?php echo ROOT; ?>js/bootstrap-datepicker.hu.js"></script>
	<script src="<?php echo ROOT; ?>js/bootstrap-select.js"></script>
	<script src="<?php echo ROOT; ?>js/responsive-tabs.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.uniform.js"></script>
	<script src="<?php echo ROOT; ?>js/slick.min.js"></script>
	<script src="<?php echo ROOT; ?>js/parallax.min.js"></script>
	<script src="<?php echo ROOT; ?>js/isotope.pkgd.min.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.easing.1.3.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.lavalamp.min.js"></script>
	<script src="<?php echo ROOT; ?>js/bg.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.scrollTo-1.4.3.1-min.js"></script>
	
</body>
</html>