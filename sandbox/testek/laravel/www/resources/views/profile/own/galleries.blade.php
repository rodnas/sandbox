@extends("profile/own/header") @section("profile_content")
<div class="container">
	<div class="row">

		<div class="col-12 col-lg-4 col-xl-3">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">
						Engedélyek kezelése <br />
						<small>A legfrissebb 10 engedély kérés:</small>
					</h6>
				</div>

				<ul class="notification-list friend-requests">
					@foreach($requests as $request)
					<li>
						<div class="author-thumb">
							<img src="{{ Storage::url(App::environment() . '/avatar/' . $request->avatar) }}" width="42">
						</div>
						<div class="notification-event">
							<a href="/profile/{{ $request->from }}" class="h6 notification-friend">{{ $request->name }}</a>
							@if($request->active)
							<span class="badge bg-green c-white">Engedélyezve</span>
							@else
							<span class="badge bg-grey c-white">Függőben</span>
							@endif
						</div>

						<div class="more">
							@if($request->active == 0)
							<a href="/requests/private/{{ $request->from }}/accept" class="icon-accept c-green" data-toggle="tooltip" data-placement="top" data-original-title="Engedélyezés">
								<svg>
									<use xlink:href="/svg-icons/sprites/icons.svg#tick"></use>
								</svg>
							</a>
							@endif
							<a href="/requests/private/{{ $request->from }}/remove" onclick="return confirm('Törlöd a kérést?')" class="icon-delete c-orange" data-toggle="tooltip" data-placement="top" data-original-title="Törlés">
								<svg>
									<use xlink:href="/svg-icons/sprites/icons.svg#cancel"></use>
								</svg>
							</a>
						</div>
					</li>
					@endforeach
				</ul>

			</div>
		</div>

		<div class="col-12 col-lg-8 col-xl-9">
			<div class="ui-block mb-5">
				<div class="ui-block-title">
					<div class="h6 title">Nyilvános galéria</div>
				</div>

				<div class="ui-block-content">
					<div class="photo-album-wrapper js-zoom-gallery">

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

						<form id="upload_open" action="/profile/galleries/open" class="dropzone" method="post" enctype="multipart/form-data">
							<div class="dz-message" data-dz-message>
								<span>Kattints ide az új képek feltöltéséhez!</span>
							</div>
							@csrf
						</form>

					</div>
				</div>
			</div>

			<div class="ui-block mb-5">
				<div class="ui-block-title">
					<div class="h6 title">
						Privát galéria<br />
						<small>A privát galériádat csak az általad engedélyezett felhasználók nézhetik meg.</small>
					</div>
				</div>

				<div class="ui-block-content">
					<div class="photo-album-wrapper js-zoom-gallery">

						@foreach($gal_private as $gallery)
						<div class="photo-album-item-wrap col-4-width">
							<div class="photo-album-item">
								<div class="photo-item">
									<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
									<div class="overlay overlay-dark"></div>

									<a href="{{ Storage::url(App::environment() . '/large/' . $gallery->original) }}" class="full-block"></a>
								</div>
							</div>
						</div>
						@endforeach

						<form id="upload_private" action="/profile/galleries/private" class="dropzone" method="post" enctype="multipart/form-data">
							<div class="dz-message" data-dz-message>
								<span>Kattints ide az új képek feltöltéséhez!</span>
							</div>
							@csrf
						</form>

					</div>
				</div>
			</div>

			<div class="ui-block mb-5">
				<div class="ui-block-title">
					<div class="h6 title">
						Exkluzív galéria<br />
						<small>Állítsd be, hogy hány kreditért lehet a hozzáférést megvásárolni. A kreditek 90%-a a tied!</small>
					</div>

					<div class="align-right">
						<form action="/profile/galleries/price" method="post">
							<button type="submit" class="btn btn-black">Ár mentése</button>
							<input id="exclusive_price" type="hidden" name="exclusive">
							@csrf
						</form>
					</div>
				</div>

				<div class="ui-block-content">
					<div id="credit-open-slider" class="mb-2 mt-4"></div>
					<p class="mb-4 text-center d-flex justify-content-space-between">
						<span class="float-left">Szexi képek</span>
						<span class="float-right">Ruha nélküli képek</span>
					</p>

					<div class="photo-album-wrapper js-zoom-gallery">

						@foreach($gal_exclusive as $gallery)
						<div class="photo-album-item-wrap col-4-width">
							<div class="photo-album-item">
								<div class="photo-item">
									<img src="{{ Storage::url(App::environment() . '/small/' . $gallery->small) }}">
									<div class="overlay overlay-dark"></div>

									<a href="{{ Storage::url(App::environment() . '/large/' . $gallery->original) }}" class="full-block"></a>
								</div>
							</div>
						</div>
						@endforeach

						<form id="upload_exclusive" action="/profile/galleries/exclusive" class="dropzone" method="post" enctype="multipart/form-data">
							<div class="dz-message" data-dz-message>
								<span>Kattints ide az új képek feltöltéséhez!</span>
							</div>
							@csrf
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<div id="preview" style="display: none;">
	<div class="dz-preview dz-file-preview">
		<div class="dz-image">
			<img data-dz-thumbnail />
		</div>
		<div class="dz-progress">
			<span class="dz-upload" data-dz-uploadprogress></span>
		</div>
		<div class="dz-success-mark">
			<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			 xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
					<path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
					 id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
				</g>
			</svg>
		</div>
		<div class="dz-error-mark">
			<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			 xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
					<g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
						<path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
						 id="Oval-2" sketch:type="MSShapeGroup"></path>
					</g>
				</g>
			</svg>
		</div>
	</div>
</div>
@endsection @section("scripts")
<script type="text/javascript">
	Dropzone.options.uploadOpen = {
		paramName: "picture",
		uploadMultiple: true,
		parallelUploads: 1,
		maxFilesize: 8,
		acceptedFiles: "image/jpeg,image/png",
		previewTemplate: document.querySelector('#preview').innerHTML,
		init: function () {
			this.on("queuecomplete", function () {
				location.reload();
			});
		}
	};

	Dropzone.options.uploadPrivate = {
		paramName: "picture",
		uploadMultiple: true,
		parallelUploads: 1,
		maxFilesize: 8,
		acceptedFiles: "image/jpeg,image/png",
		previewTemplate: document.querySelector('#preview').innerHTML,
		init: function () {
			this.on("queuecomplete", function () {
				location.reload();
			});
		}
	};

	Dropzone.options.uploadExclusive = {
		paramName: "picture",
		uploadMultiple: true,
		parallelUploads: 1,
		maxFilesize: 8,
		acceptedFiles: "image/jpeg,image/png",
		previewTemplate: document.querySelector('#preview').innerHTML,
		init: function () {
			this.on("queuecomplete", function () {
				location.reload();
			});
		}
	};

	var creditOpenSlider = document.getElementById("credit-open-slider");
    if (creditOpenSlider != null) {
        noUiSlider.create(creditOpenSlider, {
            start: [{{ Auth::user()->exclusive }}],
            step: 50,
            range: {
                min: [100],
                max: [1000]
            },
            connect: [true, false],
            tooltips: true,
            format: wNumb({
                decimals: 0
            })
		});

		creditOpenSlider.noUiSlider.on('update', function( values, handle ) {
			$("#exclusive_price").val(values[handle]);
		});
    }
</script>
@endsection
