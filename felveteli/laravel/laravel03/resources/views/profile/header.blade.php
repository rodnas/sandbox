@extends("main") @section("content")
<div class="container">
	<div class="row">
		<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="ui-block">
				<div class="top-header">
					<div class="top-header-thumb">
						<img src="/img/top-header4.png" alt="nature">
					</div>
					<div class="profile-section">
						<div class="profile-section-text">{{ $details->motto }}</div>

						<div class="control-block-button">
							<a href="/messages/new/{{ $user->id }}" class="btn btn-control" title="Új üzenet küldése">
								<svg><use xlink:href="/svg-icons/sprites/icons.svg#email"></use></svg>
							</a>
						</div>
					</div>
					<div class="top-header-author">
						<div class="author-thumb">
							<img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" alt="author">
						</div>
						<div class="author-content">
							<span class="h4 author-name">{{ $user->name }}</span>
							<div class="country">
								{{ getUserType($user->type) }}, {{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@yield("profile_content") @endsection
