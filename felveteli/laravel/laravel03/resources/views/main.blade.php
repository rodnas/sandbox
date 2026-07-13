<!DOCTYPE html>
<html lang="en">
<head>

	<title>Milliomosok.hu</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Main Font -->
	<script src="/js/webfontloader.min.js"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="/Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="/Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/Bootstrap/dist/css/bootstrap-grid.css">

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="/css/main.min.css">
	<link rel="stylesheet" type="text/css" href="/css/fonts.min.css">

	@yield("header")

</head>
<body class="private">

<!-- Fixed Sidebar Left -->

<div class="fixed-sidebar fixed-sidebar-responsive">
	<div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive">
		<a href="/" class="logo js-sidebar-open active">
			<img src="/img/logo.png" alt="Milliomosok.hu">
		</a>
	</div>

	<div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
		<a href="/" class="logo">
			<div class="img-wrap">
				<img src="/img/logo.png" alt="Milliomosok.hu">
			</div>
			<div class="title-block">
				<h6 class="logo-title">Milliomosok.hu</h6>
				<!-- <div class="sub-title">Ahová csak szeretnéd</div> -->
			</div>
		</a>

		<div class="mCustomScrollbar" data-mcs-theme="dark">

			<div class="fixed-sidebar-article author-block">
				<a href="/profile" class="author-thumb">
					<img alt="author" src="{{ Storage::url(App::environment() . '/avatar/' . Auth::user()->avatar) }}" class="avatar">
				</a>
				<a href="/profile" class="author-name">
					<div class="author-title h6">{{ Auth::user()->name }}</div>
					<div class="author-subtitle">{{ getAge(Auth::user()->birthday) }}, {{ Auth::user()->city }}</div>
					<div class="author-status">{{ getUserType(Auth::user()->type) }}</div>
				</a>
				<a href="/profile" class="btn btn-black btn-icon-left btn-block">
					<svg><use xlink:href="/svg-icons/sprites/icons.svg#power"></use></svg>
					Saját profilom
					<div class="ripple-container"></div>
				</a>
				<div class="row">
					<div class="col">
						<a href="/" class="author-option" data-toggle="modal" data-target="#modal-credit">
							<svg><use xlink:href="/svg-icons/sprites/icons.svg#money"></use></svg>
							Kerdit feltöltés
						</a>
					</div>
					<div class="col">
						<a href="/" class="author-option">
							<svg><use xlink:href="/svg-icons/sprites/icons.svg#crown"></use></svg>
							Prémium vásárlás
						</a>
					</div>
				</div>
			</div>

			<div class="ui-block-title ui-block-title-small">
				<h6 class="title">Gyémánt tagok</h6>

				<svg class="ui-block-icon" data-toggle="tooltip" data-placement="top" data-original-title="Kik azok a platina tagok?"><use xlink:href="/svg-icons/sprites/icons.svg#icon-info"></use></svg>
			</div>

			<ul class="left-menu left-menu-authors">
				@foreach ($diamonds as $index => $diamond)
				<li class="author-started">
					<a href="/profile/{{ $diamond->id }}">
						<span class="author-pos">{{ $index + 1 }}.</span>
						<div class="author-thumb"><img src="{{ Storage::url(App::environment() . '/avatar/' . $diamond->avatar) }}" alt="author" /></div>
						{{ $diamond->name }}
					</a>

					<div class="author-icons">
						@for ($i = 0; $i < $diamond->diamonds; $i++)
						<svg><use xlink:href="/svg-icons/sprites/icons.svg#diamond"></use></svg>
						@endfor
					</div>
				</li>
				@endforeach
			</ul>

			<div class="text-center mb-3"><a class="c-black" href="/platinum">Teljes lista megtekintése</a></div>

			<div class="fixed-sidebar-article">
				<a href="/platinum/buy" class="btn btn-black btn-block btn-icon-left mb-0">
					<svg><use xlink:href="/svg-icons/sprites/icons.svg#diamond"></use></svg>
					Gyémánt tagság vásárlás
				</a>
			</div>

			<hr />

			<ul class="left-menu">
				<li>
					<a href="#" class="js-sidebar-open">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#cancel"></use></svg>
						<span class="left-menu-title">Menü Bezárás</span>
					</a>
				</li>
				<li>
					<a href="/search">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#search"></use></svg>
						<span class="left-menu-title">Keresés</span>
					</a>
				</li>
				<li>
					<a href="/">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#user-1"></use></svg>
						<span class="left-menu-title">Böngészés</span>
					</a>
				</li>
				<li>
					<a href="/visitors">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#eye"></use></svg>
						<span class="left-menu-title">Látogatók</span>
						@if(count($unread_visitors) > 0)
						<span class="label-avatar bg-black">{{ count($unread_visitors) }}</span>
						@endif
					</a>
				</li>
				<li>
					<a href="/messages">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#email-1"></use></svg>
						<span class="left-menu-title">Üzenetek</span>
						<!-- <span class="label-avatar bg-black">6</span> -->
					</a>
				</li>
				<li>
					<a href="/favorites">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#heart-1"></use></svg>
						<span class="left-menu-title">Kedvencek</span>
					</a>
				</li>
				<li>
					<a href="/requests">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#key"></use></svg>
						<span class="left-menu-title">Privát kulcsok</span>
					</a>
				</li>
				<li>
					<a href="/logout">
						<svg class="left-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#logout-1"></use></svg>
						<span class="left-menu-title">Kilépés</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- ... end Fixed Sidebar Left -->


<!-- Fixed Sidebar Right -->

<div class="fixed-sidebar right">
	<div class="fixed-sidebar-right sidebar--small" id="sidebar-right">

		<div class="mCustomScrollbar" data-mcs-theme="dark">
			<ul class="chat-users">
				<li class="inline-items">
					<a href="#" class="author-thumb" data-toggle="tooltip" data-placement="left" data-original-title="Legyél te is kiemelve!">
						<img alt="author" src="/img/avatar64-sm.jpg" class="avatar">
						<span class="author-thumb-overlay">
							<svg class="olymp-accordion-open-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-accordion-open-icon"></use></svg>
						</span>
					</a>
				</li>
				@foreach($sideusers as $su)
				<li class="inline-items">
					<a href="/profile/{{ $su->id }}" class="author-thumb">
						<img class="avatar" src="{{ Storage::url(App::environment() . '/avatar/' . $su->avatar) }}">
					</a>
				</li>
				@endforeach
			</ul>
		</div>

	</div>

</div>

<!-- ... end Fixed Sidebar Right -->


<!-- Header-BP -->

<header class="header" id="site-header">
	<div class="header-content-wrapper">
		<form class="search-bar w-search notification-list friend-requests">
			<div class="form-group with-button">
				<input class="form-control js-user-search" placeholder="Keresés..." type="text">
				<button>
					<svg class="olymp-magnifying-glass-icon"><use xlink:href="/svg-icons/sprites/icons.svg#search"></use></svg>
				</button>
			</div>
		</form>

		<div class="control-block">
			<a href="/messages">
				<div class="control-icon more has-items">
					<svg><use xlink:href="svg-icons/sprites/icons.svg#email"></use></svg>
				</div>
			</a>

			<div class="control-icon more has-items">
				<svg><use xlink:href="/svg-icons/sprites/icons.svg#bell"></use></svg>

				@if(count($notifications) > 0)
				<div class="label-avatar bg-black">{{ count($notifications) }}</div>
				@endif

				<div class="more-dropdown more-with-triangle triangle-top-center">
					<div class="ui-block-title ui-block-title-small">
						<h6 class="title">Értesítések</h6>
					</div>

					<div class="mCustomScrollbar" data-mcs-theme="dark">
						@if(count($notifications) > 0)
						<ul class="notification-list">
							@foreach($notifications as $notification)
							<li>
								<div class="author-thumb">
									<img src="{{ Storage::url(App::environment() . '/avatar/' . $notification->avatar) }}" width="42">
								</div>
								<div class="notification-event">
									<div><a href="/profile/{{ $notification->from }}" class="h6 notification-friend">{{ $notification->name }}</a> {{ $notification->notification }}</div>
									<span class="notification-date"><time class="entry-date updated">{{ getTimeAgo(strtotime($notification->created_at)) }}</time></span>
								</div>
							</li>
							@endforeach
						</ul>
						@else
						<ul class="notification-list">
							<li>
								<div class="notification-event">
									<i>Nincs új értesítés</i>
								</div>
							</li>
						</ul>
						@endif
					</div>
				</div>
			</div>

			<div class="author-page author vcard inline-items more">
				<div class="author-thumb">
					<img alt="author" src="{{ Storage::url(App::environment() . '/avatar/' . Auth::user()->avatar) }}" class="avatar" width="36" height="36">
					<div class="more-dropdown more-with-triangle">
						<div class="mCustomScrollbar" data-mcs-theme="dark">
							<div class="ui-block-title ui-block-title-small">
								<h6 class="title">Felhasználói Fiók</h6>
							</div>

							<ul class="account-settings">
								<li>
									<a href="/settings">
										<svg class="olymp-menu-icon"><use xlink:href="/svg-icons/sprites/icons.svg#setup"></use></svg>
										<span>Profil beállítások</span>
									</a>
								</li>
								<li>
									<a href="/logout">
										<svg class="olymp-logout-icon"><use xlink:href="/svg-icons/sprites/icons.svg#logout-1"></use></svg>
										<span>Kijelentkezés</span>
									</a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>

</header>

<!-- ... end Header-BP -->

<div class="header-spacer"></div>


<div class="container">

	@yield("content")

</div>

<!-- Window-popup Credit -->

<div class="modal modal-style-2 fade" id="modal-credit" tabindex="-1" role="dialog" aria-labelledby="modal-credit" aria-hidden="true">
	<div class="modal-dialog window-popup modal-lg modal-credit" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="/svg-icons/sprites/icons.svg#cancel"></use></svg>
				</a>
				<h6 class="title">Fizetés</h6>
			</div>

			<div class="modal-body no-padding">

				<!-- Payments -->

				<div class="row no-gutters payments">
					<div class="col-md-9 payments-container">
						<div class="nav payments-tab" role="tablist">
							<a class="nav-link active" data-toggle="pill" href="#pills-paypal">
								<div class="payments-tab-icon">
									<svg><use xlink:href="/svg-icons/sprites/icons.svgsvg-icons/sprites/icons.svg#tick"></use></svg>
								</div>
								<span>PayPal</span>
							</a>
						</div>

						<div class="tab-content payments-content">

							<!-- Pills Paypal -->

							<div class="tab-pane show active" id="pills-paypal">
								<p class="text-center h4 mb-5">Minél többet veszel, annál kevesebbet fizetsz kreditenként:</p>

								<div class="row no-gutters pricing-table mb-4">
									<div id="CR1" class="col-12 col-sm-4 pricing-table-col">
										<div class="pricing-table-figure">
											<img src="/img/info1.png" />
										</div>

										<h5 class="pricing-table-title">250<br />kredit</h5>

										<br />
										<!-- <div class="pricing-table-price-old">6000 Ft</div> -->
										<div class="pricing-table-price-new">5000 Ft</div>
									</div>

									<div id="CR2" class="col-12 col-sm-4 pricing-table-col highligted">
										<div class="pricing-table-label">Legnépszerűbb</div>

										<div class="pricing-table-figure">
											<img src="/img/info2.png" />
										</div>

										<h5 class="pricing-table-title">500 + 50<br />ajándék kredit</h5>

										<br />
										<!-- <div class="pricing-table-price-old">12000 Ft</div> -->
										<div class="pricing-table-price-new">10000 Ft</div>

										<div class="pricing-table-save">Megtakarítás: 1000 Ft</div>
									</div>

									<div id="CR3" class="col-12 col-sm-4 pricing-table-col">
										<div class="pricing-table-figure">
											<img src="/img/info3.png" />
										</div>

										<h5 class="pricing-table-title">750 + 100<br />ajándék kredit</h5>

										<br />
										<!-- <div class="pricing-table-price-old">18000 Ft</div> -->
										<div class="pricing-table-price-new">15000 Ft</div>

										<div class="pricing-table-save">Megtakarítás: 2000 Ft</div>
									</div>
								</div>

								<form class="mb-5">
									<div class="text-center">
										<div id="credit_paypal_button"></div>
									</div>
								</form>
							</div>

							<!-- ... end Pills Paypal -->

						</div>
					</div>

					<div class="col-md-3 payments-sidebar">
						<div class="payments-sidebar-intro">
							<svg class="list-icon"><use xlink:href="/svg-icons/sprites/icons.svgsvg-icons/sprites/icons.svg#tick"></use></svg>
							<p>Akik <strong>Extra</strong> megjelenéseket vesznek <strong>3x</strong> több szavazatot kapnak!</p>
						</div>

						<p>Mire használhatod fel kreditedet?</p>

						<ul class="list-with-icon">
							<li>
								<svg class="list-icon"><use xlink:href="/svg-icons/sprites/icons.svgsvg-icons/sprites/icons.svg#tick"></use></svg>
								Kerülj az üzenetek élére!
							</li>
							<li>
								<svg class="list-icon"><use xlink:href="/svg-icons/sprites/icons.svgsvg-icons/sprites/icons.svg#tick"></use></svg>
								Kerülj a böngésző középpontjába!
							</li>
							<li>
								<svg class="list-icon"><use xlink:href="/svg-icons/sprites/icons.svgsvg-icons/sprites/icons.svg#tick"></use></svg>
								Kiemelheted a fotódat az oldalsávba: reflektorfény funkció megsokszorozza az adatlapod megtekintéseit.
							</li>
						</ul>
					</div>

				</div>

				<!-- ... end Payments -->

			</div>
		</div>
	</div>
</div>

<!-- ... end Window-popup Credit -->

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
<script src="/js/sticky-sidebar.js"></script>
<script src="/js/nouislider.min.js"></script>
<script src="/js/wNumb.js"></script>

<script src="/js/base-init.js"></script>
<script defer src="/fonts/fontawesome-all.js"></script>

<script src="/Bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>

@yield("scripts")

<script type="text/javascript">
	var selected = "CR2";
	$("#CR1").on("click", function() {
		selected = "CR1";
		$("#CR1").addClass("highligted");
		$("#CR2").removeClass("highligted");
		$("#CR3").removeClass("highligted");
	});
	$("#CR2").on("click", function() {
		selected = "CR2";
		$("#CR1").removeClass("highligted");
		$("#CR2").addClass("highligted");
		$("#CR3").removeClass("highligted");
	});
	$("#CR3").on("click", function() {
		selected = "CR3";
		$("#CR1").removeClass("highligted");
		$("#CR2").removeClass("highligted");
		$("#CR3").addClass("highligted");
	});

	paypal.Button.render({
        env: "production",
        locale: "hu_HU",
        style: {
            color: "gold",
            size: "medium",
            tagline: false,
            fundingicons: true
        },
        commit: true,
        payment: function () {
            return new paypal.Promise(function(resolve, reject) {
                jQuery.post("/payments/create/paypal/" + selected, {"_token": "{{ csrf_token() }}"})
                .done(function(data) { resolve(data.paymentID); })
                .fail(function(err) { reject(err); })
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(response) {
                switch (response.state) {
                    case "failed": jQuery.post("/payments/fail", {"paymentID": data.paymentID, "_token": "{{ csrf_token() }}"});
                    default: window.location.replace("/payments");
                }
            });
        },
        onCancel: function(data) {
            jQuery.post("/payments/cancel", {"paymentID": data.paymentID, "_token": "{{ csrf_token() }}"});
        }
    }, "#credit_paypal_button");
</script>

</body>
</html>
