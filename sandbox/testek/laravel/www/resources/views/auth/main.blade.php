<!DOCTYPE html>
<html lang="en">
<head>

	<title>Milliomosok.hu</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="/Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="/Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/Bootstrap/dist/css/bootstrap-grid.css">

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="/css/main.min.css">
	<link rel="stylesheet" type="text/css" href="/css/fonts.min.css">

	<!-- Main Font -->
	<script src="/js/webfontloader.min.js"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

	@yield("styles")

</head>
<body class="has-standard-header body-bg-white">

	<!-- Header Standard -->

	<div class="header--standard header--standard-dark" id="header--standard">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-4 d-none d-md-block">
				</div>
				
				<div class="col-6 col-md-4 text-left text-md-center">
					<a href="/" class="logo logo-inline">
						<div class="img-wrap">
							<img src="/img/logo.png" alt="Milliomosok">
						</div>
						<div class="title-block">
							<h6 class="logo-title">Milliomosok.hu</h6>
						</div>
					</a>
				</div>
				
				<div class="col-6 col-md-4 text-right">
					<div class="nav nav-pills nav1 header-menu f-right">
						<ul>
							@if (Auth::check() == false)
							<li class="nav-item">
								<a href="/login" class="nav-link">Bejelentkezés</a>
							</li>
							@endif
							<li class="close-responsive-menu js-close-responsive-menu">
								<svg class="olymp-close-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
							</li>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	<!-- ... end Header Standard -->

	<div class="header-spacer--standard"></div>
</div>

<section class="medium-padding80">
	<div class="container">
		
		@yield("content")

	</div>
</section>


<!-- Footer Full Width -->

<div class="footer footer-full-width" id="footer">
	<div class="container">
		<div class="row">
			<div class="col col-lg-4 col-md-4 col-sm-6 col-6">
				<div class="widget w-about">
				
					<a href="02-ProfilePage.html" class="logo">
						<div class="img-wrap">
							<img src="/img/logo-colored.png" alt="Milliomosok">
						</div>
						<div class="title-block">
							<h6 class="logo-title">Milliomosok.hu</h6>
						</div>
					</a>

					<p>
						Flörtölj, barátkozz, randizz!<br />
						Magyarország legjobb társkeresőjén.
					</p>

					<ul class="socials">
						<li>
							<a href="#">
								<i class="fab fa-facebook-square" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fab fa-twitter" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fab fa-youtube" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fab fa-google-plus-g" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fab fa-instagram" aria-hidden="true"></i>
							</a>
						</li>
					</ul>

				</div>
			</div>

			<!-- SUB FOOTER -->

			<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="sub-footer-copyright">
					<span>
						&copy; {{ date("Y") }} <a href="/">Milliomosok.hu</a> - Minden jog fenntartva.<br />
						{{ Storage::disk("local")->get("version.txt") }}
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- JS Scripts -->
<script src="/js/jquery-3.2.1.js"></script>
<script src="/js/jquery.appear.js"></script>
<script src="/js/jquery.mousewheel.js"></script>
<script src="/js/perfect-scrollbar.js"></script>
<script src="/js/jquery.matchHeight.js"></script>
<script src="/js/svgxuse.js"></script>
<script src="/js/imagesloaded.pkgd.js"></script>
<script src="/js/Headroom.js"></script>
<script src="/js/velocity.js"></script>
<script src="/js/ScrollMagic.js"></script>
<script src="/js/jquery.waypoints.js"></script>
<script src="/js/jquery.countTo.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/material.min.js"></script>
<script src="/js/bootstrap-select.js"></script>
<script src="/js/smooth-scroll.js"></script>
<script src="/js/selectize.js"></script>
<script src="/js/swiper.jquery.js"></script>
<script src="/js/moment.js"></script>
<script src="/js/daterangepicker.js"></script>
<script src="/js/dropzone.min.js"></script>
<script src="/js/simplecalendar.js"></script>
<script src="/js/fullcalendar.js"></script>
<script src="/js/isotope.pkgd.js"></script>
<script src="/js/ajax-pagination.js"></script>
<script src="/js/Chart.js"></script>
<script src="/js/chartjs-plugin-deferred.js"></script>
<script src="/js/circle-progress.js"></script>
<script src="/js/loader.js"></script>
<script src="/js/run-chart.js"></script>
<script src="/js/jquery.magnific-popup.js"></script>
<script src="/js/jquery.gifplayer.js"></script>
<script src="/js/mediaelement-and-player.js"></script>
<script src="/js/mediaelement-playlist-plugin.min.js"></script>
<script src="/js/nouislider.min.js"></script>
<script src="/js/wNumb.js"></script>

<script src="/js/base-init.js"></script>
<script defer src="/fonts/fontawesome-all.js"></script>

<script src="/Bootstrap/dist/js/bootstrap.bundle.js"></script>

@yield("scripts")

</body>
</html>
