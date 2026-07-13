@extends("auth/main")

@section("content")
<div class="row">
	<div class="col-xl-9 m-auto">
		<h2 class="text-center">A milliók csábítása</h2>
		<h4 class="text-center mb-5">Tedd a fejedre a koronát építs luxus kapcsolatokat</h4>

		<div class="row prereg-form">
			<div class="col-sm-12 col-md-7 m-auto prereg-form-col">
				<form accept="/prereg" method="post">
					@if($errors->any())
					<div class="alert alert-danger text-center">
						<strong>Hiba történt!</strong><br />
						Az egyik mező nem lett megfelelően kitöltve!
					</div>
					@endif
					@if (!empty($success))
						<div class="alert alert-success text-center">
						    {{ $success }}
						</div>
					@endif				
					<div class="row form-group">
						<label class="col-md-4 col-form-label">Felhasználónév</label>

						<div class="col-md-8">
							<input class="form-control" name="name" placeholder="Felhasználónév" type="text" value="{{ old('name') }}">
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-4 col-form-label">E-mail cím vagy Telefon</label>

						<div class="col-md-8">
							<input name="identifier" class="form-control identifier-toggle-field" placeholder="E-mail cím vagy Telefon" type="text" value="{{ old('identifier') }}">
						</div>
					</div>
					
					<div class="row form-group">
						<label class="col-md-4 col-form-label">Hozzájárulás</label>

						<div class="col-md-8 checkbox">
							<label class="c-grey-lighter link-underline">
								<input name="accepted" type="checkbox">Elfogadom a <a href="">Felhasználási feltételeket</a>, az <a href="">Adatvédelmi szabályzatot</a> és a <a href="">Sütihasználati szabályzatot</a>
							</label>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-8 offset-md-4">
							<button type="submit" class="btn btn-black">Regisztrálok</button>
						</div>
					</div>

					@csrf
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
