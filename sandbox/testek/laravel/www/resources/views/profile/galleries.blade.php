@extends("profile/header")

@section("profile_content")
<div class="container">
	<div class="row">

		<div class="col-12 col-lg-4 col-xl-3">
		</div>

		<div class="col-12 col-lg-8 col-xl-9">
			<div class="ui-block mb-5">
				<div class="ui-block-title">
					<div class="h6 title">Nyilvános galéria</div>
				</div>

				<div class="ui-block-content">
					<div class="photo-album-wrapper @if(count($gal_open) > 0) js-zoom-gallery @endif">

						@if(count($gal_open) > 0)
							@foreach($gal_open as $gallery)
							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item">
									<div class="photo-item">
										<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->image) }}">
										<div class="overlay overlay-dark"></div>

										<a href="{{ Storage::url(App::environment() . '/large/' . $gallery->image) }}" class="full-block"></a>
									</div>
								</div>
							</div>
							@endforeach
						@else
						<i>A galéria még üres. <a href="/messages/new/{{ $user->id }}">Kérd meg {{ $user->name }}t üzenetben, hogy töltsön fel képeket.</a></i>
						@endif

					</div>
				</div>
			</div>

			<div class="ui-block mb-5">
				<div class="ui-block-title">
					<div class="h6 title">
						Privát galéria<br />

						@if($permission_private && $permission_private->active)
						@else
						<small>Kérd meg {{ $user->name }}t, hogy engedélyezze a hozzáférést neked a privát képeihez.</small>
						@endif
					</div>
					<div class="align-right">
						@if($permission_private)
							@if($permission_private->active == 0)
								<span class="btn btn-smoke btn-light-bg">Engedély kérve</span>
							@endif
						@else
							<a href="/profile/{{ $user->id }}/galleries/private" class="btn btn-black">Engedély kérése</a>
						@endif
					</div>
				</div>

				<div class="ui-block-content">
					<div class="photo-album-wrapper @if(count($gal_private) > 0) js-zoom-gallery @endif">

						@if(count($gal_private) > 0)
							@foreach($gal_private as $gallery)
							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item">
									@if($permission_private && $permission_private->active)
									<div class="photo-item">
										<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
										<a href="{{ Storage::url(App::environment() . '/large/' . $gallery->original) }}" class="full-block"></a>
									</div>
									@else
									<div class="photo-item locked">
										<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->pixelated) }}">
										<div class="overlay overlay-dark">
											<svg class="icon"><use xlink:href="/svg-icons/sprites/icons.svg#lock-1"></use></svg>
										</div>
									</div>
									@endif
								</div>
							</div>
							@endforeach
						@else
						<i>A galéria még üres. <a href="/messages/new/{{ $user->id }}">Kérd meg {{ $user->name }}t üzenetben, hogy töltsön fel képeket.</a></i>
						@endif

					</div>
				</div>
			</div>

			<div class="ui-block mb-5">
				<div class="ui-block-title">
					<div class="h6 title">
						Exkluzív galéria<br />

						@if($permission_exclusive && $permission_exclusive->active)
						@else
						<small>Megvásárolhatod a hozzáférést kreditekért.</small>
						@endif
					</div>

					@if($permission_exclusive && $permission_exclusive->active)
					@else
					<div class="align-right">
						@if(Auth::user()->credits >= $user->exclusive)
						<a href="/profile/{{ $user->id }}/galleries/exclusive" class="btn btn-black">Vásárlás {{ $user->exclusive }} kreditért</a>
						@else
						<span onclick="alert('Az egyenleged: {{ Auth::user()->credits }} kredit')" class="btn btn-black">Vásárlás {{ $user->exclusive }} kreditért</span>
						@endif
					</div>
					@endif
				</div>

				<div class="ui-block-content">
					<div class="photo-album-wrapper @if(count($gal_exclusive) > 0) js-zoom-gallery @endif">

						@if(count($gal_exclusive) > 0)
							@foreach($gal_exclusive as $gallery)
							<div class="photo-album-item-wrap col-4-width">
								<div class="photo-album-item">
									@if($permission_exclusive && $permission_exclusive->active)
									<div class="photo-item">
										<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
										<a href="{{ Storage::url(App::environment() . '/large/' . $gallery->original) }}" class="full-block"></a>
									</div>
									@else
									<div class="photo-item locked">
										<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->pixelated) }}">
										<div class="overlay overlay-dark">
											<svg class="icon"><use xlink:href="/svg-icons/sprites/icons.svg#lock-1"></use></svg>
										</div>
									</div>
									@endif
								</div>
							</div>
							@endforeach
						@else
						<i>A galéria még üres. <a href="/messages/new/{{ $user->id }}">Kérd meg {{ $user->name }}t üzenetben, hogy töltsön fel képeket.</a></i>
						@endif

					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection
