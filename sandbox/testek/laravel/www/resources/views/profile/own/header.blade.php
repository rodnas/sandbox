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
							<a href="/requests" class="btn btn-control">
								<svg><use xlink:href="/svg-icons/sprites/icons.svg#users"></use></svg>
							</a>

							<a href="/messages" class="btn btn-control">
								<svg><use xlink:href="/svg-icons/sprites/icons.svg#email"></use></svg>
							</a>

							<div class="btn btn-control more">
								<svg><use xlink:href="/svg-icons/sprites/icons.svg#setup"></use></svg>
								<ul class="more-dropdown more-with-triangle triangle-bottom-right">
									<li>
										<a href="/settings">Beállítások</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="top-header-author">
						<div class="author-thumb">
							<img src="{{ Storage::url(App::environment() . '/avatar/' . Auth::user()->avatar) }}" alt="author">
						</div>
						<div class="author-content">
							<span class="h4 author-name">{{ Auth::user()->name }}</span>
							<div class="country">
								{{ getUserType(Auth::user()->type) }}, {{ getAge(Auth::user()->birthday) }} éves {{ Auth::user()->gender == "F" ? "férfi" : "nő" }}, {{ Auth::user()->city }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@yield("profile_content") @endsection
