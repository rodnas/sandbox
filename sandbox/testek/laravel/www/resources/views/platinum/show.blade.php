@extends("main")

@section("content")
<div class="row">
    <div class="col-xl-7">
        <div class="ui-block">
            <ul class="notification-list friend-requests">
                @foreach($platinums as $platinum)
                <li>
                    <div class="author-thumb thumb-heart">
                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $platinum->avatar) }}" width="42">
                    </div>
                    <div class="notification-event">
                        <a href="/profile/{{ $platinum->id }}" class="h6 notification-friend">{{ $platinum->name }}</a>
                        <span class="chat-message-item">{{ getAge($platinum->birthday) }} éves {{ $platinum->gender == "F" ? "férfi" : "nő" }}, {{ $platinum->city }}</span>
                    </div>
                    <span class="notification-icon mt-0">
                        <span class="c-grey">{{ $platinum->diamonds }} db</span>
                        @if($platinum->id != Auth::id())
                        <a href="/messages/new/{{ $platinum->id }}" class="btn btn-gold mb-0">
                            <svg class="olymp-happy-face-icon"><use xlink:href="/svg-icons/sprites/icons.svg#speech-bubble"></use></svg>
                            Üzenet küldése
                        </a>
                        @endif
                        <div class="diamond-list text-sm-right mt-2">
                            @for($i = 0; $i < $platinum->dia; $i++)
                            <svg><use xlink:href="/svg-icons/sprites/icons.svg#diamond"></use></svg>
                            @endfor
                        </div>
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="ui-block">
            <div class="ui-block-content">
                <h3>Mit jelentenek a Sugar Daddyk adatlapján a gyémántok?</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                dignissim felis in libero dignissim scelerisque. Fusce nec vestibulum lectus.
                Vestibulum a neque magna. Aliquam quis nisl eu nisi molestie ultrices.
                Ut sed nibh eros. Donec a purus vel nisl efficitur vehicula. Nam ac
                condimentum tortor.</p>

                <ul class="list-with-icon">
                    <li>
                        <svg class="list-icon"><use xlink:href="svg-icons/sprites/icons.svg#tick"></use></svg>
                        Kerülj az üzenetek élére!
                    </li>
                    <li>
                        <svg class="list-icon"><use xlink:href="svg-icons/sprites/icons.svg#tick"></use></svg>
                        Kerülj a böngésző középpontjába!
                    </li>
                    <li>
                        <svg class="list-icon"><use xlink:href="svg-icons/sprites/icons.svg#tick"></use></svg>
                        Kiemelheted a fotódat az oldalsávba: reflektorfény funkció megsokszorozza az adatlapod megtekintéseit.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
