@extends("settings/menu")

@section("settings_content")
<!-- Main Content -->
<div class="col-12 col-lg-8 col-xl-9">
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Jelszó csere</h6>
        </div>
        <div class="ui-block-content">
            <form action="/settings/password" method="post">
                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Jelenlegi jelszó <svg data-toggle="tooltip" data-placement="top" title="Segítség a régi jelszóhoz"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg></label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <input type="password" name="actual" class="form-control" />
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Új jelszó</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <input type="password" name="password" class="form-control" />
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Jelszó megerősítése</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <input type="password" name="confirm" class="form-control" />
                    </div>
                </div>

                @csrf
                <div class="form-row form-group">
                    <div class="col-sm-8 col-xl-5 offset-sm-4 offset-lg-3 text-center">
                        <button type="submit" class="btn btn-gold">Mentés</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ... end Main Content -->
@endsection
