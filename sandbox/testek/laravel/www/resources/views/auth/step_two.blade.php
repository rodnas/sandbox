@extends("auth/main")

@section("content")
<div class="row">
	<div class="col-xl-8 m-auto text-center">
		<div class="mb-4">
			<img src="/img/guy-small.png" alt="" />
		</div>
		
		<h2>Tölts fel egy profilképet magadról!</h2>
		<h4 class="mb-4">Tölts fel egy fotót, hogy üzeneteket kapj és ismerkedhess!</h4>
		
		<form id="upload_form" action="/registration/picture" method="post" enctype="multipart/form-data" class="dropzone mb-5">
			<div class="dropzone-btn">
				<span class="btn btn-lg bg-black no-margin btn-icon-left fileinput-button"><i class="fas fa-arrow-alt-circle-up" aria-hidden="true"></i> Tölts fel egy profilképet a számítógépedről!</span>
			</div>

			<div class="dz-message">Vagy húzd ide...</div>
			@csrf
		</form>
		
		<p></p>
		<p>JPG és PNG formátumú fájlokat támogatunk.<br /> A feltölthető fénykép maximális mérete 8 MB.</p>
	</div>
</div>
@endsection

@section("scripts")
<script type="text/javascript">
	Dropzone.options.uploadForm = {
		paramName: "picture",
		maxFilesize: 8,
		maxFiles: 1,
		clickable: ".fileinput-button",
		acceptedFiles: "image/jpeg,image/png",
		accept: function (file, done) {
			if (file.type != "image/jpeg" && file.type != "image/png") {
				done("Hiba! Nem megfelelő kép formátum!");
			} else {
				done();
			}
		},
		init: function () {
			this.on("success", function () {
				window.location.replace("/registration/email");
			});
		}
	};
</script>
@endsection
