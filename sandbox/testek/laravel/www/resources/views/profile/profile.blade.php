@extends("profile/header")

@section("profile_content")
<div class="container">
	<div class="row">

		<!-- MAIN_CONTENT -->
		<div class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">
						Anyagiak
						@if ($user->type == "BABY" || $user->type == "BOY")
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
			@if($user->diamonds > 0 || $user->premium)
			<div class="ui-block">
				@if($user->diamonds > 0)
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
		</div>

		<!-- RIGHT_SIDEBAR -->
		<div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Nyilvános fényképek</h6>
				</div>
				<div class="ui-block-content">

					@if(count($gal_open) > 0)
					<ul class="widget w-last-photo">
						@foreach($gal_open as $gallery)
						<li>
							<a href="/profile/{{ $user->id }}/galleries">
								<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->image) }}">
							</a>
						</li>
						@endforeach
					</ul>
					@else
					<i>A galéria üres!</i>
					@endif

				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Privát fényképek</h6>
				</div>
				<div class="ui-block-content">

					@if(count($gal_private) > 0)
						@if($permission_private && $permission_private->active)
						<ul class="widget w-last-photo">
							@foreach($gal_private as $gallery)
							<li>
								<a href="/profile/{{ $user->id }}/galleries">
									<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
								</a>
							</li>
							@endforeach
						</ul>
						@else
						<ul class="widget w-last-photo w-last-photo-layer w-last">
							@foreach($gal_private as $gallery)
							<li>
								<a href="/profile/{{ $user->id }}/galleries">
									<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->pixelated) }}">
									<svg class="icon"><use xlink:href="/svg-icons/sprites/icons.svg#lock-1"></use></svg>
								</a>
							</li>
							@endforeach
						</ul>
						@endif
					@else
					<i>A galéria üres!</i>
					@endif

				</div>
			</div>

			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Exkluzív fényképek</h6>
				</div>
				<div class="ui-block-content">

					@if(count($gal_exclusive) > 0)
						@if($permission_exclusive && $permission_exclusive->active)
						<ul class="widget w-last-photo">
							@foreach($gal_exclusive as $gallery)
							<li>
								<a href="/profile/{{ $user->id }}/galleries">
									<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
								</a>
							</li>
							@endforeach
						</ul>
						@else
						<ul class="widget w-last-photo w-last-photo-layer w-last">
							@foreach($gal_exclusive as $gallery)
							<li>
								<a href="/profile/{{ $user->id }}/galleries">
									<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->pixelated) }}">
									<svg class="icon"><use xlink:href="/svg-icons/sprites/icons.svg#lock-1"></use></svg>
								</a>
							</li>
							@endforeach
						</ul>
						@endif
					@else
					<i>A galéria üres!</i>
					@endif

				</div>
			</div>
		</div>

	</div>
</div>
@endsection
