@extends("main")

@section("content")
<div class="ui-block mb-0">
    <div class="row chat-container">
        <div class="col col-lg-4 col-sm-5 pr-sm-0">
            <!-- Notification List Chat Messages -->
            <div class="chat-notification">
                <ul class="nav nav-tab" role="tablist">
                    <li><a class="active" id="inbox-tab" data-toggle="tab" href="#inbox">Összes</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="inbox">
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            @if($recipients)
                            <ul class="notification-list chat-message">
                                @foreach($recipients as $user)
                                <a href="/messages/{{ $user->group }}">
                                <li @if($user->group == $messageid) class="highlighted" @endif>
                                    <div class="author-thumb">
                                        <img src="{{ Storage::url(App::environment() . '/avatar/' . $user->avatar) }}">
                                    </div>
                                    <div class="notification-event">
                                        <span class="h6 notification-friend">{{ $user->name }}</span>
                                        <span class="chat-message-item">Utolsó üzenet: {{ getTimeAgo(strtotime($user->last_timestamp)) }}</span>
                                    </div>
                                </li>
                                </a>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- ... end Notification List Chat Messages -->
        </div>

        @if(isset($recipient))
        <div class="col col-lg-5 col-sm-7 px-lg-0 pl-sm-0">
            <!-- Chat Field -->

            <div class="chat-field">
                <div class="ui-block-title">
                    <h6 class="title">
                        <a href="">{{ $recipient->name }}</a>
                        <small>{{ getAge($recipient->birthday) }} éves {{ $recipient->gender == "F" ? "férfi" : "nő" }}, {{ $recipient->city }}</small>
                    </h6>

                    <div class="more">
                        <svg class="c-grey-lighter"><use xlink:href="/svg-icons/sprites/icons.svg#three-dots-punctuation-sign"></use></svg>

                        <ul class="more-dropdown more-with-triangle triangle-bottom-right">
                            <!-- <li><a href="#">Tiltás</a></li> -->
                            <!-- <li><a href="#">Némítás</a></li> -->
                            <li><a href="/messages/{{ $messageid }}/delete" onclick="return confirm('A törléssel a beszélgetés nálad lévő példányát törlöd.\nA másik fél továbbra is látni fogja.\nTörlöd a beszélgetést?')">Törlés</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mCustomScrollbar chat-window" id="chatWindow" data-mcs-theme="dark">
                    <ul class="notification-list chat-message chat-message-field">
                        @foreach($messages as $message)
                            @if($message->user == Auth::id())
                            <li class="my-message">
                                <div class="notification-event">
                                    <span class="chat-message-item">{{ $message->message }}</span>
                                    <time class="entry-date updated">{{ getTimeAgo(strtotime($message->created_at)) }}</time>
                                </div>
                            </li>
                            @else
                            <li>
                                <div class="author-thumb">
                                    <img src="{{ Storage::url(App::environment() . '/avatar/' . $message->avatar) }}" style="width:29px;height:29px">
                                </div>
                                <div class="notification-event">
                                    <span class="chat-message-item">{{ $message->message }}</span>
                                    <time class="entry-date updated">{{ getTimeAgo(strtotime($message->created_at)) }}</time>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <form action="/messages/{{ $messageid }}" method="post" class="chat-form">
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Írd ide az üzenetedet...</label>
                        <textarea class="form-control" placeholder="" name="message"></textarea>
                    </div>

                    <div class="add-options-message" style="height:38px">
                        <button class="btn btn-sm">
                            <svg><use xlink:href="/svg-icons/sprites/icons.svg#paper-plane"></use></svg>
                        </button>
                    </div>

                    @csrf
                </form>
            </div>
            <!-- ... end Chat Field -->
        </div>

        <div class="col-lg-3 d-none d-lg-block pl-0">
            <div class="mCustomScrollbar">
                <div class="fixed-sidebar-article author-block pb-1">
                    <a href="/profile/{{ $recipient->id }}" class="author-thumb">
                        <img alt="author" src="{{ Storage::url(App::environment() . '/avatar/' . $recipient->avatar) }}" class="avatar">
                    </a>
                    <a href="/profile/{{ $recipient->id }}" class="author-name">
                        <div class="author-title h6">{{ $recipient->name }}</div>
                    </a>

                    <a href="/profile/{{ $recipient->id }}" class="btn btn-gold btn-icon-left btn-block mb-0">Profil megtekintése</a>
                </div>
                <hr />
            </div>
        </div>
        @else
        <div class="col col-lg-5 col-sm-7 px-lg-0 pl-sm-0">
        df
        </div>
        <div class="col-lg-3 d-none d-lg-block pl-0">
        </div>
        @endif
    </div>
</div>
@endsection

@section("scripts")
<script>
    $(function() {
        $("#chatWindow").scrollTop($("#chatWindow").height());
    });
</script>
@endsection
