@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="/css/account/freedomnet.css" />
<link rel="stylesheet" type="text/css" media="all" href="/css/account/freedomnet-print.css" />
<link rel="stylesheet" type="text/css" media="all" href="/css/account/freedomtag.css" />
@endsection

@section('js')
<script type="text/javascript" src="/wow/js/account/services.js"></script>
<script type="text/javascript" src="/wow/js/account/realm-select.js"></script>
@endsection

@section('content')
<div id="layout-middle">
    <div class="wrapper">
        <div id="content">
            <div id="page-content" class="page-content">
                <h3 class="headline subpage">Код успешно использован</h3>
                <div  class="full-freedomtag">
                    <span class="freedomtag-name"></span><span class="freedomtag-number"></span>
                </div>
                <div  class="black-line-note">
                    <div class="black-line-note-arrow"></div>
                    <div class="black-line-note-content border-3">
                        <p class="desc">Код был успешно использован, товар был отправлен вам на внутреигровую почту.</p>
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