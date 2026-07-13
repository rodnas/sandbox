@extends("profile/own/header")

@section("profile_content")
<div class="container">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-12 col-lg-4 col-xl-3">
            <div class="ui-block">

                <!-- Your Profile  -->

                <div class="your-profile">
                    <div class="ui-block-title ui-block-title-small">
                        <h6 class="title">Saját profilod</h6>
                    </div>

                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Beállítások
                                    </a>
                                </h6>
                            </div>

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                <ul class="your-profile-menu">
                                    <li>
                                        <a href="/settings">Általános információk</a>
                                    </li>
                                    <li>
                                        <a href="/profile/galleries">Fotók és privát képek</a>
                                    </li>
                                    <li>
                                        <a href="/settings/password">Jelszó csere</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ui-block-title text-center">
                        <a href="/" class="btn btn-border-gold">Prémium vásárlás</a>
                    </div>
                    <div class="ui-block-title text-center">
                        <a href="/" class="btn btn-border-gold" data-toggle="modal" data-target="#modal-credit">Kredit feltöltés</a>
                    </div>
                </div>

                <!-- ... end Your Profile  -->

            </div>
        </div>
        <!-- ... end Left Sidebar -->

        @yield("settings_content")

    </div>
</div>
@endsection
