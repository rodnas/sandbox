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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div id="top"></div>
<?php require_once('header.php'); ?>
	
	<!-- mobile-header -->
	<div class="mobile-header">
		<div class="container">
			<div class="row">
				<div class="logo"></div>
			</div>
		</div>
	</div>
	<!-- mobile header -->
	
	
	<!-- main-slider -->
	<div class="main-slider">
		<div class="container">
			<div class="row">
				<div class="single-item">
<?php
		foreach ($data['content']['topSlider'] as $key=>$temp) {
?>
					<div>
						<img src="<?php echo $data['content']['topSlidesUrlIMG'].$temp['contentImage']; ?>" alt="" width="1198" height="500" class="img-responsive">
						<div class="text">
							<div class="tt">
								<div class="tc">
									<?php echo $temp['contentHtml']; ?>
								</div>
							</div>
						</div>
					</div>
<?php
		}
?>
				</div>
			</div>
		</div>
	</div>
	<!-- main-slider -->
	
	<!-- main welcome -->
	<div class="main " id="rolunk">
		<div class="container">
			<div class="row">
				
				<div class="welcome-cont">
					<?php echo $data['content']['our_Html']; ?>
				</div>
				
			</div>
		</div>
	</div>
	<!-- main welcome -->
	
	<div class="fullscreen background parallax" style="background-image:url('<?php echo $data['content']['parallaxBackground1_Image']; ?>');" data-img-width="1900" data-img-height="801" data-diff="0" data-oriz-pos="50%"></div>
	
	<!-- main services -->
	<div class="main " id="szolgaltatasok">
		<div class="container">
			<div class="row">
				
				<div class="services-cont">
					<?php echo $data['content']['serviceHead_Text']; ?>
					
					<div class="row">
<?php
		foreach ($data['content']['serviceSlider'] as $key=>$temp) {
?>
						<div class="col-md-6">
							<div class="box clearfix">
								<div class="pic">
									<img src="<?php echo $data['content']['topSlidesUrlIMG'].$temp['contentImage']; ?>" alt="" width="280" height="350">
									<span class="text">
										<span class="tt">
											<span class="tc">
												<?php echo $temp['contentText']; ?>
											</span>
										</span>
									</span>
								</div>
								<?php echo $temp['contentHtml']; ?>
							</div>
						</div>
<?php
		}
?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- main services -->
	
	<div class="fullscreen background parallax" style="background-image:url('<?php echo $data['content']['parallaxBackground2_Image']; ?>');" data-img-width="1900" data-img-height="801" data-diff="0" data-oriz-pos="50%"></div>
	
	<!-- member-slider -->
	<div class="member-slider">
		<div class="container">
			<div class="row">
				<div class="member-item">
<?php
		foreach ($data['content']['memberSlider'] as $key=>$temp) {
?>
					<div>
						<div class="text clearfix">
							<div class="pic"><img src="<?php echo $data['content']['topSlidesUrlIMG'].$temp['contentImage']; ?>" alt="" width="200" height="200"></div>
							<h2><?php echo $temp['contentLabel']; ?></h2>
							<p><i class="quote"></i><?php echo $temp['contentText']; ?></p>
						</div>
					</div>
<?php
		}
?>
				</div>
			</div>
		</div>
	</div>
	<!-- member-slider -->
	
	<div class="fullscreen background parallax" style="background-image:url('<?php echo $data['content']['parallaxBackground3_Image']; ?>');" data-img-width="1900" data-img-height="801" data-diff="0" data-oriz-pos="50%"></div>
	
	<!-- main brands -->
	<div class="main brands" id="markak">
		<div class="container">
			<div class="row">
				
				<?php echo $data['content']['brandsHead_Text']; ?>
				
				<div class="brands-cont">
					<div class="grid-sizer"></div>
<?php
		$topText=1;
		$counter=0;
		foreach ($data['content']['brandsSlider'] as $key=>$temp) {
?>
					<div class="grid-item">
						<a href="<?php echo ROOT; ?>markak/<?php echo $temp['brandsLink']; ?>">
							<?php 
							if ($topText==1) {
								echo $temp['contentText']; 
							}
							?>
							<img src="<?php echo $data['content']['topSlidesUrlIMG'].$temp['contentImage']; ?>" alt="" width="360" height="450" class="img-responsive">
							<?php 
							if ($topText!=1) {
								echo $temp['contentText']; 
								$topText=1;
							} else {
								$topText=0;
							}
							if ($counter==2) {
								$topText=1;
								$counter=0;
							} else {
								$counter++;
							}
							?>
						</a>
					</div>
<?php
		}
?>
				</div>
				
			</div>
		</div>
	</div>
	<!-- main brands -->
	
	<div class="fullscreen background parallax" style="background-image:url('<?php echo $data['content']['parallaxBackground4_Image']; ?>');" data-img-width="1900" data-img-height="801" data-diff="0" data-oriz-pos="50%"></div>
	
	<!-- main news -->
	<div class="main " id="hirek">
		<div class="container">
			<div class="row">
				
				<div class="news-cont">
					<?php echo $data['content']['newsHead_Text']; ?>
					
					<div class="row">
<?php
		$newsCounter=0;
		foreach ($data['content']['newsSlider'] as $key=>$temp) {
?>
						<div class="col-sm-4">
							<p><a href="" data-toggle="modal" data-target="#basicModal<?php echo $newsCounter; ?>"><img src="<?php echo $data['content']['topSlidesUrlIMG'].$temp['contentImage']; ?>" alt="" width="380" height="225" class="img-responsive"></a></p>
							<h3><?php echo $temp['contentLabel']; ?></h3>
							<p><?php echo $temp['contentText']; ?></p>
							<p class="date"><?php echo str_replace("-",".",substr($temp['insertWhen'],0,10)); ?>. &nbsp;&nbsp;&nbsp; | <a href="" data-toggle="modal" data-target="#basicModal<?php echo $newsCounter; ?>"><strong><?php echo $data['content']['details_Label']; ?></strong></a></p>
						</div>
						<div id="basicModal<?php echo $newsCounter; ?>" class="modal fade" tabindex="-1" data-width="1180" style="display:none;">
							<div class="modal-dialog">
								<div class="modal-body">
									<img src="<?php echo $data['content']['urlModalIMG'].$temp['contentModalImage']; ?>" alt="" width="460" height="273" class="img-responsive img-left">
									<h3><?php echo $temp['contentLabel']; ?></h3>
									<p class="date"><?php echo str_replace("-",".",substr($temp['insertWhen'],0,10)); ?>. </p>
									<p><?php echo $temp['contentText']; ?></p>
									<div class="clearfix"></div>
									<?php echo $temp['contentHtml']; ?>
								</div>
								<div class="modal-footer">
									<a href="" data-dismiss="modal" aria-hidden="true"><i></i><?php echo $data['content']['close_Label']; ?></a>
								</div>
							</div>
						</div>
<?php
			$newsCounter++;
			if ($newsCounter == 3 ) {
				break;
			}
		}
?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- main news -->
	
	<div class="fullscreen background parallax" style="background-image:url('<?php echo $data['content']['parallaxBackground5_Image']; ?>');" data-img-width="1900" data-img-height="801" data-diff="0" data-oriz-pos="50%"></div>
	
	<!-- main partners -->
	<div class="main partners" id="partnereink">
		<div class="container">
			<div class="row">
				
				<h1><?php echo $data['content']['partnerHead_Label']; ?></h1>
				
			</div>
		</div>
		
		<div class="slider-ticker autoplay">
<?php
		foreach ($data['content']['partnerSlider'] as $key=>$temp) {
?>
			<div <?php echo $temp['contentLabel']; ?>>
				<div class="tt">
					<div class="tc"><img src="<?php echo $data['content']['topSlidesUrlIMG'].$temp['contentImage']; ?>" alt="" width="<?php echo $temp['imageWidth']; ?>" height="<?php echo $temp['imageHeight']; ?>"></div>
				</div>
			</div>
<?php
		}
?>
		</div>
	</div>
	<!-- main partners -->
	
	<!-- main contact -->
	<div class="main " id="kapcsolat">
		<div class="container">
			<div class="row">
				
				<div class="contact-cont">
					<?php echo $data['content']['contactHead_Text']; ?>
					
					<div class="row">
						<div class="col-md-6 pull-right">
							<div class="address clearfix">
								<i></i>
								<?php echo $data['content']['contactAddress_Text']; ?>
							</div>
							
							<?php echo $data['content']['facebook_Html']; ?>
							
							<div class="fb">
								<div class="fb-page" data-href="https://www.facebook.com/whitecollarfashion" data-tabs="timeline" data-width="479" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
									<div class="fb-xfbml-parse-ignore">
										<blockquote cite="https://www.facebook.com/whitecollarfashion">
											<a href="https://www.facebook.com/whitecollarfashion">White Collar Fashion</a>
										</blockquote>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-5 col-lg-4">
							<form name="writeUS" method="POST" action="">
								<div class="form-group">
									<label for=""><?php echo $data['content']['writeUsName_Label']; ?></label>
									<input type="text" name="name" id="name" value="<?php if (isset($_POST['name'])) {echo $_POST['name'];} ?>" class="form-control">
								</div>
								<div class="form-group"> <!-- +error class a hiba ellenőrzés után -->
									<label for=""><?php echo $data['content']['writeUsEmail_Label']; ?></label>
									<input type="email" name="email" id="email" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];} ?>" class="form-control">
								</div>
								<div class="form-group">
									<label for=""><?php echo $data['content']['writeUsSubject_Label']; ?></label>
									<input type="text" name="subject" id="subject" value="<?php if (isset($_POST['subject'])) {echo $_POST['subject'];} ?>" class="form-control">
								</div>
								<div class="form-group">
									<label for=""><?php echo $data['content']['writeUsMessage_Label']; ?></label>
									<textarea name="message" id="message" class="form-control"><?php if (isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
								</div>
								<div class="form-group">
									<input type="submit" name="send" id="send" value="<?php echo $data['content']['send_Label']; ?>" class="btn btn-primary">
								</div>
							</form>
						</div>
					</div>
					
					<ul>
						<?php
						if (isset($data['content']['facebook_Link'])) {
						?>
						<li class=""><a href="<?php echo $data['content']['facebook_Link']; ?>" class="facebook"><i class="fa fa-facebook-f"></i></a></li>
						<?php
						}
						if (isset($data['content']['googleplus_Link'])) {
						?>
						<li class=""><a href="<?php echo $data['content']['googleplus_Link']; ?>" class="google"><i class="fa fa-google-plus"></i></a></li>
						<?php
						}
						?>
					</ul>
				</div>
				
			</div>
		</div>
	</div>
	<!-- main contact -->
	
	<div id="map" class="g_map" style="width:100%; height:500px"></div>
	
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
	<script src="<?php echo ROOT; ?>js/responsive-tabs.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.uniform.js"></script>
	<script src="<?php echo ROOT; ?>js/slick.min.js"></script>
	<script src="<?php echo ROOT; ?>js/parallax.min.js"></script>
	<script src="<?php echo ROOT; ?>js/isotope.pkgd.min.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.easing.1.3.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.lavalamp.min.js"></script>
	<script src="<?php echo ROOT; ?>js/bg.js"></script>
	<script src="<?php echo ROOT; ?>js/jquery.scrollTo-1.4.3.1-min.js"></script>
	
	<!-- frontend js -->
	<script src="<?php echo ROOT; ?>js/frontend.js"></script>
	
	<script src='http://maps.google.com/maps/api/js?sensor=false'></script> 
	<script>
		var map;
		function initialize_map() {
		if ($('#map').length) {
		  var myLatLng = new google.maps.LatLng(47.508756, 19.027239);
		  var mapOptions = {
			zoom: 17,
			center: myLatLng,
			scrollwheel: false,
			panControl: false,
			zoomControl: true,
			scaleControl: false,
			mapTypeControl: false,
			streetViewControl: false
		  };
		  map = new google.maps.Map(document.getElementById('map'), mapOptions);
		  var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: '<?php echo $data['content']['siteTitle_Label']; ?>',
			icon: '<?php echo $data['content']['googleMapMarker_Image']; ?>'
		  });
		} else {
		  return false;
		}
		}
		google.maps.event.addDomListener(window, 'load', initialize_map);
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
/*
	$(window).load(function(){
		$('#basicModal').modal('show');
	});
	$('#basicModal').on('click', function () {
		$('#basicModal').modal('hide');
	});
*/
</script>
</body>
</html>