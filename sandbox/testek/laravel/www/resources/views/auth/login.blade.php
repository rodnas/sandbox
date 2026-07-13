@extends("auth/main")

@section("content")
<div class="row">
	<div class="col-xl-9 m-auto">
		<h2 class="text-center">Bejelentkezés</h2>
		<h4 class="text-center mb-5">Flörtölj, barátkozz, randizz!<br />Magyarország legjobb társkeresőjén.</h4>
		
		<div class="row login-form">
			<div class="col-sm-12 col-md-7 m-auto login-form-col">
				<form action="/login" method="post">
					@if(session()->get("error"))
					<div class="alert alert-danger text-center">
						<strong>Hiba történt!</strong><br />
						Ismeretlen e-mail cím, vagy hibás jelszó!
					</div>
					@endif

					<div class="row form-group">
						<label class="col-md-4 col-form-label">E-mail cím</label>
						
						<div class="col-md-8">
							<input name="email" class="form-control" type="text" required>
						</div>
					</div>
					
					<div class="row form-group">
						<label class="col-md-4 col-form-label">Jelszó</label>
						
						<div class="col-md-8">
							<input name="password" class="form-control" type="password" required>
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col-md-8 offset-md-4">
							<button type="submit" class="btn btn-black">Bejelentkezés</button>
							<a href="/registration" class="btn btn-secondary" style="margin-left:20px">Regisztráció</a>
						</div>
					</div>

					@csrf
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
