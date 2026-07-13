@extends("main")

@section("content")
<h6>Látogatók</h6>
<hr />

<div class="tab-content">
    <div class="tab-pane show active" id="my-favs">
        <div class="ui-block">
            <ul class="notification-list friend-requests">
                @foreach($visitors as $user)
                <li>
                    <div class="author-thumb thumb-heart">
                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" width="42">
                    </div>
                    <div class="notification-event">
                        <a href="/profile/{{ $user->id }}" class="h6 notification-friend">{{ $user->name }}</a>
                        <span class="chat-message-item">{{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</span><br />
                        <span class="chat-message-item">Meglátogatta az adatlapodat: {{ getTimeAgo(strtotime($user->created_at)) }}</span>
                    </div>
                    <span class="notification-icon mt-2">
                        <a href="/messages/new/{{ $user->id }}" class="btn btn-gold mb-0">
                            <svg class="olymp-happy-face-icon"><use xlink:href="/svg-icons/sprites/icons.svg#speech-bubble"></use></svg>
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
