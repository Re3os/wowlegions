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
            <div class="alert caution closeable border-4 glow-shadow">
                <div class="alert-inner">
                    <div class="alert-message">
                        <p class="title"><strong>Изменить TagName можно только один раз.</strong></p>
                        <p>Вы можете взять любое имя, если оно отвечает правилам выбора имени для TagName.</p>
                    </div>
                </div>
                <a class="alert-close" href="#" onclick="$(this).parent().fadeOut(250, function() { $(this).css({opacity:0}).animate({height: 0}, 100, function() { $(this).remove(); }); }); return false;">
                    Закрыть                </a>
                <span class="clear"><!-- --></span>
            </div>
            <div id="page-header">
                <h3 class="headline">TagName — Ваше имя на </h3>
            </div>
            <div id="page-content" class="page-content">
                <form method="POST" action="{{ route('create-name-action') }}" id="freedomcoreIdForm" novalidate="novalidate">
                    {{ csrf_field() }}
                    <div class="freedomtag-field">
                        <span class="randomize-freedomTag">
                            <span class="input-text input-text-medium">
                            <input type="text" name="freedomTag" value="" id="freedomTag" class="medium border-5 glow-shadow-2" autocomplete="off" maxlength="12" tabindex="1" required="required" placeholder="Введите имя" />
                                <span class="inline-message " id="freedomTag-message"> </span>
                            </span>
                            <a class="dice" href="javascript:void(0)" id="generate-random-freedomtag">Сгенерировать</a>
                        </span>
                        <input type="hidden" id="skip" name="skip" value="false" />
                        <input type="hidden" id="ret" name="ret" value="" />
                        <input type="hidden" id="type" name="type" value="FREE" />
                        <div id="freedomTag-Alert" class="alert error border-4">
                            <div class="alert-inner">
                                <div class="alert-message">
                                    <p class="error-desc" id="latinbasic"><strong>TagName может включать от 3 до 12 символов.</strong></p>
                                    <p class="error-desc" id="latin"><strong>TagName может включать от 3 до 12 символов.</strong></p>
                                    <p class="error-desc" id="cyrillic"><strong>TagName может включать от 3 до 12 символов.</strong></p>
                                    <p class="error-desc" id="korean"><strong>TagName может включать от 3 до 12 символов.</strong></p>
                                    <p class="error-desc" id="chinese"><strong>TagName может включать от 3 до 12 символов.</strong></p>
                                    <p class="error-desc" id="result2"><strong>TagName не может начинаться с цифры.</strong></p>
                                    <p class="error-desc" id="result3"><strong>TagName не может включать специальных символов.</strong></p>
                                    <p class="error-desc" id="result4"><strong>TagName может включать только буквы латинского алфавита (A-Z) и цифры (0-9).</strong></p>
                                    <p class="error-desc" id="result5"><strong>Имя, которое вы хотите взять, является нарушением равил выбора имени для TagName. Придумайте другое имя.</strong></p>
                                    <p class="error-desc" id="result6"><strong>Новый TagName должен отличаться от нынешнего.</strong></p>
                                </div>
                            </div>
                            <span class="clear"><!-- --></span>
                        </div>
                    </div>
                    <div class="submit-field">
                        <div class="submit-field">
                            <a class="ui-button button1 disabled" href="#" id="button-submit" tabindex="2">
                                <span class="button-left">
                                    <span class="button-right">
                                        Создать TagName                                    </span>
                                </span>
                            </a>
                            <div class="submit-cancel">
                                <a id="skipFtag" href="{{ route('account') }}" tabindex="1">
                                    Спасибо, в другой раз                                </a>
                            </div>
                        </div>
                    </div>
                </form>
                <span class="clear"></span>
            </div>
            <script type="text/javascript">
                //<![CDATA[
                $(function() {
                    var inputs = new Inputs('#freedomcoreIdForm');
                    FreedomTagValidator.accountRegion = "EU";
                    FreedomTagValidator.characterLength = {
                        "latinbasic" : {
                            "min" : 3,
                            "max" : 12
                        },
                        "latin" : {
                            "min" : 3,
                            "max" : 12
                        },
                        "cyrillic" : {
                            "min" : 3,
                            "max" : 12
                        },
                        "korean" : {
                            "min" : 2,
                            "max" : 8
                        },
                        "chinese" : {
                            "min" : 2,
                            "max" : 8
                        }
                    };

                });

                //]]>
            </script>
        </div>
    </div>
</div>
<div id="layout-bottom-divider"></div>
@endsection