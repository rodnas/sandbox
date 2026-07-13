@extends("main")

@section("content")
<div class="ui-block mb-0">
    <div class="row chat-container">
        <div class="col col-lg-4 col-sm-5 pr-sm-0">
            <!-- Notification List Chat Messages -->
            <div class="chat-notification">
                <ul class="nav nav-tab" role="tablist">
                    <li><a class="" id="inbox-tab" href="/messages">Összes</a></li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="inbox">
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list chat-message">
                                <li>
                                    <div class="author-thumb">
                                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" alt="author">
                                    </div>
                                    <div class="notification-event">
                                        <span class="h6 notification-friend">{{ $user->name }}</span>
                                        <span class="chat-message-item">Új üzenet...</span>
                                    </div>
                                    <time class="notification-icon mt-0" datetime="2018-07-20T16:03">16:03</time>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ... end Notification List Chat Messages -->
        </div>

        <div class="col col-lg-5 col-sm-7 px-lg-0 pl-sm-0">
            <!-- Chat Field -->
            
            <div class="chat-field">
                <div class="ui-block-title">
                    <h6 class="title">
                        <a href="">{{ $user->name }}</a><br />
                        <small>{{ getAge(Auth::user()->birthday) }} éves {{ Auth::user()->gender == "F" ? "férfi" : "nő" }}, {{ Auth::user()->city }}</small>
                    </h6>
                </div>
                
                <div class="mCustomScrollbar chat-window" id="chatWindow" data-mcs-theme="dark">
                    <ul class="notification-list chat-message chat-message-field">
                        
                    </ul>
                </div>
            
                <form action="/messages/new" method="post" class="chat-form">
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Írd ide az üzenetedet...</label>
                        <textarea class="form-control" placeholder="" name="message"></textarea>
                    </div>
            
                    <div class="add-options-message" style="height:38px">
                        <button class="btn btn-sm">
                            <svg><use xlink:href="/svg-icons/sprites/icons.svg#paper-plane"></use></svg>
                        </button>
                    </div>

                    <input type="hidden" name="user" value="{{ $user->id }}">
                    @csrf
                </form>
            </div>
            <!-- ... end Chat Field -->
        </div>
        
        <div class="col-lg-3 d-none d-lg-block pl-0">
            <div class="mCustomScrollbar">
                <div class="fixed-sidebar-article author-block pb-1">
                    <a href="/profile/{{ $user->id }}" class="author-thumb">
                        <img alt="author" src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}" class="avatar">
                    </a>
                    <a href="/profile/{{ $user->id }}" class="author-name">
                        <div class="author-title h6">{{ $user->name }}</div>
                    </a>
                    
                    <a href="/profile/{{ $user->id }}" class="btn btn-gold btn-icon-left btn-block mb-0">Profil megtekintése</a>
                </div>
                <hr />
            </div>
        </div>
    </div>
</div>
@endsection