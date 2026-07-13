@extends("profile/own/header")

@section("profile_content")
<div class="container">
	<div class="row">

		<!-- MAIN_CONTENT -->
		<div class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-content">
					<div class="row">
						<div class="col-4">
							<div class="icon-box">
								<div class="icon-box-top h6">Prémium vásárlás</div>
								<div class="icon-box-middle">
									<svg class="c-gold"><use xlink:href="svg-icons/sprites/icons.svg#crown"></use></svg>
								</div>
								<div class="icon-box-bottom">
									<a href="">
										<svg class="c-gold"><use xlink:href="svg-icons/sprites/icons.svg#add"></use></svg>
										Vásárlás
									</a>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="icon-box">
								<div class="icon-box-top h6">Kreditek</div>
								<div class="icon-box-middle">
									{{ Auth::user()->credits }}
								</div>
								<div class="icon-box-bottom">
									<a href="">
										<svg class="c-gold"><use xlink:href="svg-icons/sprites/icons.svg#add"></use></svg>
										Vásárlás
									</a>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="icon-box">
								<div class="icon-box-top h6">Prémium</div>
								@if(Auth::user()->premium)
								<div class="icon-box-middle c-green">
									Igen
								</div>
								@else
								<div class="icon-box-middle c-red">
									Nem
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">
						Anyagiak
						@if(Auth::user()->type == "BABY" || Auth::user()->type == "BOY")
						- elvárt
						@else
						- saját
						@endif
					</h6>
				</div>
				<div class="ui-block-content">
					<ul class="list-unstyled list-col no-margin">
						<li><strong>Vagyon:</strong>{{ getWealth($details->wealth) }}</li>
						<li><strong>Életszínvonal:</strong>{{ getLifestyle($details->lifestyle) }}</li>
						<li><strong>Éves jövedelem:</strong>{{ getYearlyIncome($details->yearly_income) }}</li>
					</ul>
				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Rólam</h6>
				</div>
				<div class="ui-block-content">
					@if($details->about)
					<p>{{ $details->about }}</p>
					@else
					<p>Még nincs kitöltve</p>
					@endif
				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Akit keresek</h6>
				</div>
				<div class="ui-block-content">
					@if($details->looking_for)
					<p>{{ $details->looking_for }}</p>
					@else
					<p>Még nincs kitöltve</p>
					@endif
				</div>
			</div>
		</div>

		<!-- LEFT_SIDEBAR -->
		<div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
			@if(Auth::user()->diamonds > 0 || Auth::user()->premium)
			<div class="ui-block">
				@if(Auth::user()->diamonds > 0)
				<div class="ui-block-title">
					<svg class="olymp- c-gold"><use xlink:href="/svg-icons/sprites/icons.svg#diamond"></use></svg>
					<h5 class="title">Gyémánt tag</h5>
				</div>
				@else
				<div class="ui-block-title">
					<svg class="olymp- c-gold"><use xlink:href="/svg-icons/sprites/icons.svg#crown"></use></svg>
					<h5 class="title">Prémium tag</h5>
				</div>
				@endif
			</div>
			@endif

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Keress pénzt a képeiddel</h6>
				</div>

				<div class="ui-block-content">
					<p>Tölts fel jobbnál jobb képeket, szerezz ajándékokat...</p>
					<a href="/profile/galleries" class="btn btn-black btn-icon-left btn-block">
						Galériák
					</a>
				</div>
			</div>
		</div>

		<!-- RIGHT_SIDEBAR -->
		<div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Nyilvános fényképeim</h6>
				</div>
				<div class="ui-block-content">

					@if(count($gal_open) > 0)
					<ul class="widget w-last-photo">
						@foreach($gal_open as $gallery)
						<li>
							<a href="/profile/galleries">
								<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->image) }}">
							</a>
						</li>
						@endforeach
					</ul>
					@else
					<i>A galéria üres!</i><br />
					<a href="/profile/galleries">Új kép feltöltése</a>
					@endif

				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Privát fényképeim</h6>
				</div>
				<div class="ui-block-content">

					@if(count($gal_private) > 0)
					<ul class="widget w-last-photo">
						@foreach($gal_private as $gallery)
						<li>
							<a href="/profile/galleries">
								<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
							</a>
						</li>
						@endforeach
					</ul>
					@else
					<i>A galéria üres!</i><br />
					<a href="/profile/galleries">Új kép feltöltése</a>
					@endif

				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Exkluzív fényképeim</h6>
				</div>
				<div class="ui-block-content">

					@if(count($gal_exclusive) > 0)
					<ul class="widget w-last-photo">
						@foreach($gal_exclusive as $gallery)
						<li>
							<a href="/profile/galleries">
								<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
							</a>
						</li>
						@endforeach
					</ul>
					@else
					<i>A galéria üres!</i><br />
					<a href="/profile/galleries">Új kép feltöltése</a>
					@endif

				</div>
			</div>
		</div>

	</div>
</div>
@endsection
