@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/management/css/guild_services.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/management/css/payment_history.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/management/css/services.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/management/css/ui.css') }}" />
@endsection

@section('js')
<script type="text/javascript" src="{{ asset_media('/account/management/js/services.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/account/management/js/realm-select.js') }}"></script>
@endsection

@section('content')
<div id="layout-middle">
    <div class="wrapper">
        <div id="content">
            <div class="dashboard service">
                <div class="primary">
                    <div class="service-wrapper">
                        <p class="service-nav">
                            <a href="/account/management/dashboard?accountName=WoW9">К управлению записью</a>
                        </p>
                        <div class="service-info">
                            <div class="service-tag">
                                <div class="service-tag-contents border-3">
                                    <div class="character-icon wow-portrait-64 no-character">
                                    </div>
                                    <div class="service-tag-description">
                                        <span class="character-message caption">Выберите персонажа</span>
                                    </div>
                                    <span class="clear"><!-- --></span>
                                </div>
                            </div>
                        </div>
                        <div class="service-form">
                            <div class="character-list">
                                <ul id="character-list">
                                        @foreach($userCharacters as $characters)
                                        <li class="character border-4" id="WoW9:{{ $characters->guid }}:{{ $characters->name }}">
                                            <div class="character-icon wow-portrait-64-80 wow-{{ $characters->gender }}-{{ $characters->race }}-{{ $characters->class }} glow-shadow-3">
                                                <img src="{{ asset('/uploads/avatar/'.Auth::user()->avatar) }}" width="64" height="64" alt="" />
                                            </div>
                                            <div class="character-description">
                                            <span class="character-name caption">
                                                <a href="{{ route('claim-code-send', ['accountName' => $userGamrAccount[0]->id , 'character' => $characters->name , 'key'=> $key]) }}" class="character-link">
                                                    {{ $characters->name }}
                                                </a>
                                            </span>
                                            <span class="character-class">
                                            - {{ $characters->level }} ур.
                                            </span>
                                            </div>
                                        </li>
                                        @endforeach
                                </ul>
                            </div>
                            <div id="error-container" style="display: none;"></div>
                            <script type="text/javascript">
                                //<![CDATA[
                                var additionalMessages = {
                                    'error': {
                                        'title': 'Ошибка:',
                                        'serverTitle': 'Игровой мир временно закрыт',
                                        'serverDesc': 'Повторите, пожалуйста, попытку позже',
                                        'retry': '<a href="#retry" onclick="return false;">Попробуйте еще раз</a>',
                                        'multiDesc': 'Необходимо разрешить <a href="#retry" onclick="return false;" onmouseover="Tooltip.show(this, \'#error-container\', {\'location\': \'mouse\'});">эту ситуацию</a>.',
                                        '20012Title': 'Персонаж является действующим главой гильдии',
                                        '20012Desc': 'Войдите в игру, распустите гильдию или передайте полномочия главы другому персонажу, затем снова выйдите из игры.',
                                        '20016Title': 'У персонажа есть письма в почтовом ящике',
                                        '20016Desc': 'Войдите в игру, очистите внутриигровой почтовый ящик, затем снова выйдите из игры.',
                                        '20032Title': 'У персонажа больше золота, чем допустимо для переноса на этом уровне.',
                                        '20032Desc': 'Войдите в игру, избавьтесь от излишка золота, затем снова выйдите из игры.',
                                        '20033Title': 'У персонажа имеются открытые аукционные лоты',
                                        '20033Desc': 'Войдите в игру, отмените свои лоты, затем снова выйдите из игры.',
                                        '20034Title': 'Вы только что были в игре',
                                        '20034Desc': 'Персонаж должен быть выведен из игры не менее чем за 20 минут до переноса.',
                                        '20057Title': 'Вы только что были в игре',
                                        '20057Desc': 'Выполняется ранее запрошенная услуга.',
                                        '20064Title': 'Подан запрос',
                                        '20064Desc': 'Войдите в игру, распустите команду или передайте полномочия капитана другому персонажу, затем снова выйдите из игры.',
                                        'unknown': 'Неизвестная ошибка'
                                    },
                                    'loading': {
                                        'title': 'Идет проверка'
                                    },
                                    'active': {
                                        serviceName: '',
                                        viewingRealm: '0'
                                    }
                                };
                                //]]>
                            </script>
                        </div>
                        <span class="clear"></span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                //<![CDATA[
                $(function() {
                    $(".realmselect-dialog").dialog("destroy");
                    $(".realmselect-dialog").dialog({
                        "autoOpen": false,
                        "modal": true,
                        "position": "center",
                        "resizeable": false,
                        "closeText": "Закрыть",
                        "width": 570,
                        "height": 580
                    });
                });
                //]]>
            </script>
        </div>
    </div>
</div>
@endsection