@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="/css/account/freedomnet.css" />
<link rel="stylesheet" type="text/css" media="all" href="/css/account/freedomnet-print.css" />
<link rel="stylesheet" type="text/css" media="all" href="/css/account/freedomtag.css" />
@endsection

@section('js')
<script type="text/javascript" src="/js/inputs.js"></script>
<script type="text/javascript" src="/js/freedomtag/freedomtag-validator.js"></script>
<script type="text/javascript" src="/js/freedomtag/freedomtag-randomize.js"></script>
@endsection

@section('content')
<div id="layout-middle">
    <div class="wrapper">
        <div id="content">
            <div id="page-content" class="page-content">
                <h3 class="headline subpage">Спасибо, {{ Auth::user()->email }}! Ваш TagName полностью —</h3>
                <div  class="full-freedomtag">
                    <span class="freedomtag-name">{{ $userTeg['tag'] }}</span><span class="freedomtag-number">#{{ $userTeg['id'] }}</span>
                </div>
                <div  class="black-line-note">
                    <div class="black-line-note-arrow"></div>
                    <div class="black-line-note-content border-3">
                        <p class="desc">Номер после самого TagName называется «код TagName». Он показывает сколько пользователей имеют такой же TagName и позволяет нам различать этих пользователей друг от друга. Ваши друзья смогут находить вас по вашему TagName.</p>
                    </div>
                </div>
                <span class="clear"></span>
                <a class="ui-button button1" href="{{ route('account') }}">
                    <span class="button-left">
                        <span class="button-right">
                            К УПРАВЛЕНИЮ ЗАПИСЬЮ
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="layout-bottom-divider"></div>
@endsection