@extends("settings/menu")

@section("settings_content")
<!-- Main Content -->
<div class="col-12 col-lg-8 col-xl-9">
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Általános információk</h6>
        </div>
        <div class="ui-block-content">
            <form action="/settings" method="post">
                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Mottó</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <input type="text" class="form-control" name="motto" value="{{ $details->motto }}" />
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Rólam</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <textarea cols="20" rows="5" class="form-control" name="about" placeholder="Mesélj magadról">{{ $details->about }}</textarea>
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Kit keresek</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <textarea cols="20" rows="5" class="form-control" name="looking_for" placeholder="Írd le, hogy kit keresel">{{ $details->looking_for }}</textarea>
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Vagyon</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <select class="selectpicker form-control" name="wealth">
                            @foreach(getWealthOptions() as $index => $wealth)
                            <option value="{{ $index + 1 }}" @if($details->wealth == ($index + 1)) selected @endif>{{ $wealth }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Életszínvonal</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <select class="selectpicker form-control" name="lifestyle">
                            @foreach(getLifestyleOptions() as $index => $lifestyle)
                            <option value="{{ $index + 1 }}" @if($details->lifestyle == ($index + 1)) selected @endif>{{ $lifestyle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col-sm-4 col-xl-3">
                        <label class="col-form-label bold">Éves jövedelem</label>
                    </div>
                    <div class="col-sm-8 col-xl-5">
                        <select class="selectpicker form-control" name="yearly_income">
                            @foreach(getYearlyIncomeOptions() as $index => $income)
                            <option value="{{ $index + 1 }}" @if($details->yearly_income == ($index + 1)) selected @endif>{{ $income }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @csrf
                <div class="form-row form-group">
                    <div class="col-sm-8 col-xl-5 offset-sm-3 offset-lg-2 text-center">
                        <button type="submit" class="btn btn-gold">Mentés</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- ... end Main Content -->
@endsection
