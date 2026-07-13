@extends("main")

@section("content")
<div class="row">
    <div class="col-lg-4">
        <div class="ui-block search-extended">
            <div class="ui-block-title">
                <h6 class="title">Keresés</h6>

                <div class="more d-lg-none">
                    <svg><use xlink:href="/svg-icons/sprites/icons.svg#download"></use></svg>
                </div>
            </div>

            <div class="ui-block-content d-lg-block">
                <form action="/search" method="post">
                    <div class="form-group">
                        <label for="">Találatok rendezése:</label>
                        <select class="form-control" name="order" id="">
                            <option value="1">Legutóbb aktív</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Név alapján:</label>
                        <input type="text" class="form-control" name="name" id="" />
                    </div>

                    <div class="form-group">
                        <label for="">Lakhely alapján:</label>
                        <input type="text" class="form-control" name="city" id="" />
                    </div>

                    <div class="form-group">
                        <label for="">Életkor alapján:</label>
                        <input type="text" class="form-control" name="age" id="" />
                    </div>

                    @csrf
                    <button type="submit" class="btn btn-block btn-black">Keresés</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="ui-block">
            <div class="ui-block-title">
                <h6 class="title">Keresési eredmények</h6>
            </div>

            @foreach($users as $user)
            <div class="search-result">
                <div class="row">
                    <div class="col-3 author-thumb">
                        <a href="/profile/{{ $user->id }}"><img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" alt="author"></a>
                    </div>
                    <div class="col-9 search-result-content">
                        <h6 class="title"><a href="/profile/{{ $user->id }}">{{ $user->name }}</a></h6>
                        <p class="c-grey-lighter">{{ getUserType($user->type) }}, {{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</p>

                        <p class="c-grey-lighter"><em>{{ $user->motto }}</em></p>

                        <ul class="row">
                            <li class="col-md-6"><strong>Vagyon:</strong> {{ getWealth($user->wealth) }}</li>
                            <li class="col-md-6"><strong>Életszínvonal:</strong> {{ getLifestyle($user->lifestyle) }}</li>
                            <li class="col-md-6"><strong>Éves jövedelem:</strong> {{ getYearlyIncome($user->yearly_income) }}</li>
                        </ul>

                        <a href="/messages/new/{{ $user->id }}" class="btn btn-gold">Új üzenet írása</a>&nbsp;
                        <a href="/favorites/{{ $user->id }}/add" class="btn btn-black"><svg><use xlink:href="/svg-icons/sprites/icons.svg#heart-2"></use></svg> Kedvencekhez adás</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
