@extends("main")

@section("content")
<ul class="nav mt-4 nav-tab">
    <li>
        <a class="active" id="keys-tab" data-toggle="tab" href="#keys">Tőlem kérték</a>
    </li>
    <li>
        <a id="my-keys-tab" data-toggle="tab" href="#my-keys">Én kértem</a>
    </li>
</ul>

    <div class="alert alert-info">
        <p class="mb-0">
            A privát kulcsokkal engedélyt kaphatsz arra, hogy megtekintsd mások privát galériát.<br />
            <a href="/profile/galleries">Tölts fel te is képeket a privát galériádba</a>, és mikor egyéb felhasználók kérik a privát kulcsodat, akkor itt találod.
        </p>
    </div>

<div class="tab-content">

    <!-- keys -->
    
    <div class="tab-pane show active" id="keys">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav ui-block">
                    <li class="ui-block-title">
                        <a id="keys-tab-1" href="#keys-1" class="h6 title active" data-toggle="tab">Függőben</a>
                    </li>
                    <li class="ui-block-title">
                        <a id="keys-tab-2" href="#keys-2" class="h6 title" data-toggle="tab">Megadva</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-9">
                <div class="tab-content">
                    <div class="tab-pane show active" id="keys-1">
                        <div class="ui-block">
                            @if($pending)
                            <ul class="notification-list friend-requests">
                                @foreach($pending as $user)
                                <li>
                                    <div class="author-thumb">
                                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" width="42">
                                    </div>
                                    <div class="notification-event">
                                        <a href="/profile/{{ $user->id }}" class="h6 notification-friend">{{ $user->name }}</a>
                                        <span class="chat-message-item">{{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</span>
                                    </div>
                                    <span class="notification-icon mt-1">
                                        <a href="/requests/private/{{ $user->from }}/remove" onclick="return confirm('Törlöd a kérést?')" class="btn btn-text">Kérés törlése</a>
                                        <a href="/requests/private/{{ $user->id }}/accept" class="btn btn-green">Engedélyezés</a>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="ui-block-content">
                                <p class="mb-0"><i>Nincs találat.</i></p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane" id="keys-2">
                        <div class="ui-block">
                            @if($accepted)
                            <ul class="notification-list friend-requests">
                                @foreach($accepted as $user)
                                <li>
                                    <div class="author-thumb">
                                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" width="42">
                                    </div>
                                    <div class="notification-event">
                                        <a href="/profile/{{ $user->id }}" class="h6 notification-friend">{{ $user->name }}</a>
                                        <span class="chat-message-item">{{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</span>
                                    </div>
                                    <span class="notification-icon mt-1">
                                        <a href="/requests/private/{{ $user->from }}/remove" onclick="return confirm('Visszavonod az engedélyt?')" class="btn btn-text">Engedély visszavonása</a>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="ui-block-content">
                                <p class="mb-0"><i>Nincs találat.</i></p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ... end keys -->
    
    <!-- my-keys -->
    
    <div class="tab-pane" id="my-keys">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav ui-block">
                    <li class="ui-block-title">
                        <a id="keys-tab-1" href="#mykeys-1" class="h6 title active" data-toggle="tab">Megadva</a>
                    </li>
                    <li class="ui-block-title">
                        <a id="keys-tab-2" href="#mykeys-2" class="h6 title" data-toggle="tab">Függőben</a>
                    </li>
                </ul>
            </div>
            
           <div class="col-lg-9">
                <div class="tab-content">
                    <div class="tab-pane show active" id="mykeys-1">
                        <div class="ui-block">
                            @if($myaccepted)
                            <ul class="notification-list friend-requests">
                                @foreach($myaccepted as $user)
                                <li>
                                    <div class="author-thumb">
                                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" width="42">
                                    </div>
                                    <div class="notification-event">
                                        <a href="/profile/{{ $user->id }}" class="h6 notification-friend">{{ $user->name }}</a>
                                        <span class="chat-message-item">{{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</span>
                                    </div>
                                    <span class="notification-icon mt-1">
                                        <a href="/profile/{{ $user->id }}" class="btn btn-black">Ugrás a profilhoz</a>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="ui-block-content">
                                <p class="mb-0"><i>Nincs találat.</i></p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane" id="mykeys-2">
                        <div class="ui-block">
                            @if($mypending)
                            <ul class="notification-list friend-requests">
                                @foreach($mypending as $user)
                                <li>
                                    <div class="author-thumb">
                                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" width="42">
                                    </div>
                                    <div class="notification-event">
                                        <a href="/profile/{{ $user->id }}" class="h6 notification-friend">{{ $user->name }}</a>
                                        <span class="chat-message-item">{{ getAge($user->birthday) }} éves {{ $user->gender == "F" ? "férfi" : "nő" }}, {{ $user->city }}</span>
                                    </div>
                                    <span class="notification-icon mt-1">
                                        <a href="/profile/{{ $user->id }}" class="btn btn-black">Ugrás a profilhoz</a>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="ui-block-content">
                                <p class="mb-0"><i>Nincs találat.</i></p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ... end my-keys -->
    
</div>
@endsection
