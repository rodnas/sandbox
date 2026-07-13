@extends("auth/main")

@section("content")
<div class="row">
	<div class="col-xl-9 m-auto">
		<h2 class="text-center">Új fiók létrehozása</h2>
		<h4 class="text-center mb-5">Flörtölj, barátkozz, randizz!<br />Magyarország legjobb társkeresőjén.</h4>

		<div class="row login-form">
			<div class="col-sm-12 col-md-7 m-auto login-form-col">
				<form accept="/registration" method="post">
					@if($errors->any())
					<div class="alert alert-danger text-center">
						<strong>Hiba történt!</strong><br />
						Az egyik mező nem lett megfelelően kitöltve!
					</div>
					@endif

					<div class="row form-group">
						<label class="col-md-4 col-form-label">Felhasználónév</label>

						<div class="col-md-8">
							<input class="form-control" name="name" placeholder="Felhasználónév" type="text" value="{{ old('name') }}">
						</div>
					</div>

					<div class="row">
						<label class="col-md-4 col-form-label">Típus</label>

						<div class="col-md-8">
							<div class="form-group">
								<select name="type" class="selectpicker form-control">
									<option value="BABY" @if(old('type') == "BABY") selected @endif>Million Baby</option>
									<option value="DADDY" @if(old('type') == "DADDY") selected @endif>Million Daddy</option>
									<option value="BOY" @if(old('type') == "BOY") selected @endif>Million Boy</option>
									<option value="MOMMY" @if(old('type') == "MOMMY") selected @endif>Million Mommy</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<label class="col-md-4 col-form-label">Születési idő</label>

						<div class="col-md-8">
							<div class="form-row">
								<div class="col-3">
									<div class="form-group">
										<select name="year" class="selectpicker form-control">
											@for($year = 2005; $year >= 1950; $year--)
											<option value="{{ $year }}" @if(old('year') == $year) selected @endif>{{ $year }}</option>
											@endfor
										</select>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group">
										<select name="month" class="selectpicker form-control">
											@for($month = 1; $month < 13; $month++)
											<option value="{{ str_pad($month, 2, "0", STR_PAD_LEFT) }}" @if(old('month') == str_pad($month, 2, "0", STR_PAD_LEFT)) selected @endif>@lang(getMonth($month))</option>
											@endfor
										</select>
									</div>
								</div>

								<div class="col-3">
									<div class="form-group">
										<select name="day" class="selectpicker form-control">
											@for($day = 1; $day < 32; $day++)
											<option value="{{ str_pad($day, 2, "0", STR_PAD_LEFT) }}" @if(old('day') == str_pad($day, 2, "0", STR_PAD_LEFT)) selected @endif>{{ str_pad($day, 2, "0", STR_PAD_LEFT) }}</option>
											@endfor
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-4 col-form-label">Város</label>

						<div class="col-md-8">
							<input name="city" class="form-control" placeholder="Város" type="text" value="{{ old('city') }}">
						</div>
					</div>

					<div class="row">
						<label class="col-md-4 col-form-label">Nem</label>

						<div class="col-md-8">
							<div class="form-group">
								<select name="gender" class="selectpicker form-control">
									<option value="F" @if(old('gender') == "F") selected @endif>Férfi</option>
									<option value="N" @if(old('gender') == "N") selected @endif>Nő</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-4 col-form-label">E-mail cím</label>

						<div class="col-md-8">
							<input name="email" class="form-control email-toggle-field" placeholder="E-mail cím" type="text" value="{{ old('email') }}">
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-4 col-form-label">Jelszó</label>

						<div class="col-md-8">
							<input name="password" class="form-control email-toggle-field" placeholder="Jelszó beállítása" type="password" value="{{ old('password') }}">
							<p class="form-text mb-0 c-grey-lighter">A jelszó minimális hossza 6 karakter.</p>
						</div>
					</div>

					<div class="row form-group">
						<label class="col-md-4 col-form-label">Hozzájárulás</label>

						<div class="col-md-8 checkbox">
							<label class="c-grey-lighter link-underline">
								<input name="agree" type="checkbox">Elfogadom a <a href="">Felhasználási feltételeket</a>, az <a href="">Adatvédelmi szabályzatot</a> és a <a href="">Sütihasználati szabályzatot</a>
							</label>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-8 offset-md-4">
							<button type="submit" class="btn btn-black">Regisztráció</button>
						</div>
					</div>

					@csrf
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
