@extends("auth/main")

@section("content")
<div class="row">
	<div class="col-xl-8 m-auto">
		<div class="row mb-3">
			<div class="col-sm-12 col-md-7">
				<h2>Sikeres regisztráció!<br />Nézd meg az e-mailjeidet!</h2>
				<h4>Regisztrációd befejezéséhez kattints a linkre levelünkben, melyet elküldtünk e-mail címedre ({{ Auth::user()->email }}).</h4>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12 col-md-7">
				<a href="/" class="btn btn-black">Tovább a főoldalra</a>
			</div>
		</div>

	</div>
</div>
@endsection
