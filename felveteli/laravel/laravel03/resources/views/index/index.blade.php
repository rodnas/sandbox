@extends("main")

@section("content")
<div class="mb-4 mt-3">
		<div class="form-control-radio d-inline-block">
			<a href="/?order=newest" class="btn @if($order == 'newest') btn-smoke btn-light-bg @else btn-black @endif">Legújabb felhasználók</a>
		</div>
		&nbsp;
		<div class="form-control-radio d-inline-block">
			<a href="/?order=active" class="btn @if($order == 'active') btn-smoke btn-light-bg @else btn-black @endif">Utoljára aktív felhasználók</a>
		</div>
		&nbsp;
		<div class="form-control-radio d-inline-block">
			<a href="/?order=youngest" class="btn @if($order == 'youngest') btn-smoke btn-light-bg @else btn-black @endif">Legfiatalabb felhasználók</a>
		</div>
</div>

<div class="row">
	@foreach($users as $user)
	<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
		<div class="ui-block user-box">
			<div class="user-box-image">
				<a href="/profile/{{ $user->id }}">
					<img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" alt="" />
				</a>

				<div class="user-box-icons-top control-block-button">
					<a href="/profile/{{ $user->id }}/galleries" class="btn btn-control c-black" data-toggle="tooltip" data-placement="top" data-original-title="Képek">
						<svg><use xlink:href="/svg-icons/sprites/icons.svg#photo-camera"></use></svg>
						<span class="count">{{ $user->images }}</span>
					</a>
					@if($user->id != Auth::id())
					<a href="/favorites/{{ $user->id }}/add" class="btn btn-control c-orange" data-toggle="tooltip" data-placement="top" data-original-title="Tetszik">
						<svg><use xlink:href="/svg-icons/sprites/icons.svg#heart-2"></use></svg>
					</a>
					<a href="/messages/new/{{ $user->id }}" class="btn btn-control c-blue" data-toggle="tooltip" data-placement="top" data-original-title="Üzenet">
						<svg><use xlink:href="/svg-icons/sprites/icons.svg#speech-bubble"></use></svg>
					</a>
					@endif
				</div>
			</div>

			<div class="user-box-content">
				<a href="/profile/{{ $user->id }}">
					<div class="user-box-title">
						<strong>{{ $user->name }}</strong>
						@if($user->diamonds > 0)
						<svg width="15" height="15"><use xlink:href="/svg-icons/sprites/icons.svg#diamond"></use></svg>
						@endif
					</div>
				</a>
				<div class="user-box-subtitle">
					{{ getUserType($user->type) }}<br />
					{{ getAge($user->birthday) }}, {{ $user->city }}
				</div>

				<!--
				<div class="user-box-icons-bottom control-block-button">
					<a href="/" class="btn btn-control bg-blue">
						<svg class="olymp-star-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>
					</a>
					<a href="/" class="btn btn-control bg-green">
						<svg class="olymp-star-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>
					</a>
					<a href="/" class="btn btn-control bg-purple">
						<svg class="olymp-star-icon"><use xlink:href="/svg-icons/sprites/icons.svg#olymp-star-icon"></use></svg>
					</a>
				</div>
				-->
			</div>
		</div>
	</div>
	@endforeach
</div>

{{ $users->links() }}
@endsection
