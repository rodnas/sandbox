@extends("main")

@section("content")
<ul class="nav mt-4 nav-tab" role="tablist">
    <li>
        <a class="active" id="favs-tab" data-toggle="tab" href="#my-favs">Kedvenceim</a>
    </li>
    <li>
        <a id="my-favs-tab" data-toggle="tab" href="#favs">Kedvencnek jelöltek</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane show active" id="my-favs">
        <div class="ui-block">
            <ul class="notification-list friend-requests">
                @foreach($myfavorites as $user)
                <li>
                    <div class="author-thumb thumb-heart">
                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" width="42">
                        <svg><use xlink:href="/svg-icons/sprites/icons.svg#heart-2"></use></svg>
                    </div>
                    <div class="notification-event">
                        <a href="/profile/{{ $user->id }}" class="h6 notification-friend">{{ $user->name }}</a>
                        <span class="chat-message-item">{{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</span>
                    </div>
                    <span class="notification-icon mt-1">
                        <a href="/messages/new/{{ $user->id }}" class="btn btn-gold mb-0">
                            <svg class="olymp-happy-face-icon"><use xlink:href="/svg-icons/sprites/icons.svg#speech-bubble"></use></svg>
                            Üzenet küldése
                        </a>
                    </span>

                    <div class="more">
                        <a href="/favorites/{{ $user->id }}/remove"><svg class="olymp-little-delete"><use xlink:href="/svg-icons/sprites/icons.svg#cancel"></use></svg></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="tab-pane" id="favs">
        <div class="ui-block">
            <ul class="notification-list friend-requests">
                @foreach($favorites as $user)
                <li>
                    <div class="author-thumb">
                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" width="42">
                    </div>
                    <div class="notification-event">
                        <a href="/profile/{{ $user->id }}" class="h6 notification-friend">{{ $user->name }}</a>
                        <span class="chat-message-item">{{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</span>
                    </div>
                    <span class="notification-icon mt-1">
                        <a href="/messages/new/{{ $user->id }}" class="btn btn-gold mb-0">
                            <svg><use xlink:href="/svg-icons/sprites/icons.svg#speech-bubble"></use></svg>
                            Üzenet küldése
                        </a>
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
