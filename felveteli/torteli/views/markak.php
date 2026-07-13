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
	<link href="<?php echo ROOT; ?>css/bootstrap-modal-bs3patch.css" rel="stylesheet">
	<link href="<?php echo ROOT; ?>css/bootstrap-modal.css" rel="stylesheet">
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
<?php require_once('header.php'); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="breadcrumb">
				<?php echo $data['content']['brandHead_Label']; ?> <span class="arrow">»</span><span> <?php echo $data['content']['mainContentLabel']; ?></span>
			</div>
			
			<!-- brands-list -->
			<div class="brands-list">
				<div class="grid-sizer"></div>
<?php
		foreach ($data['content']['brandGallery'] as $key=>$temp) {
?>
				<div class="grid-item"><a href="<?php echo $data['content']['subGalleryUrlIMG'].$temp['contentImage']; ?>" rel="gallery" title="" class="fancybox"><img src="<?php echo $data['content']['subGalleryUrlIMG'].$temp['contentImage']; ?>" alt="" width="<?php echo $temp['imageWidth']; ?>" height="<?php echo $temp['imageHeight']; ?>"></a></div>
<?php
		}
?>
			</div>
			<!-- brands-list -->
			
			<div class="back-link"><a href="<?php echo ROOT; ?>"><?php echo $data['content']['backHome_Label']; ?></a></div>
		</div>
	</div>
	
	<?php require_once('footer.php'); ?>

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
	<script src="<?php echo ROOT; ?>js/bootstrap-modal.js"></script>
	<script src="<?php echo ROOT; ?>js/bootstrap-modalmanager.js"></script>
	<script src="<?php echo ROOT; ?>js/responsive-tabs.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.uniform.js"></script>
	<script src="<?php echo ROOT; ?>js/slick.min.js"></script>
	<script src="<?php echo ROOT; ?>js/parallax.min.js"></script>
	<script src="<?php echo ROOT; ?>js/isotope.pkgd.min.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.easing.1.3.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.lavalamp.min.js"></script>
	<script src="<?php echo ROOT; ?>js/bg.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.scrollTo-1.4.3.1-min.js"></script>
	
	<link rel="stylesheet" href="<?php echo ROOT; ?>js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo ROOT; ?>js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
	
	<!-- frontend js -->
	<script src="<?php echo ROOT; ?>js/frontend.js"></script>
	
	<script>
		$(document).ready(function() {
			$(".fancybox").fancybox({
				 margin:50,
				 padding:0,
				 maxWidth:'1125px'
			});
		});
	</script>
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body clearfix">
                    <br><br><br><br>
                    <h3 align="center">feltöltés alatt</h3>
                    <br><br><br>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div -->
<script>
	$(window).load(function(){
		$('#basicModal').modal('show');
	});
	$('#basicModal').on('click', function () {
		$('#basicModal').modal('hide');
	});
</script>
</body>
</html>