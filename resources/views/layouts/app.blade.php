<!DOCTYPE HTML>
<html xml:lang="{{ app()->getLocale() }}" class="{{ app()->getLocale() }}">
<head xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
    <meta http-equiv="imagetoolbar" content="false" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Join thousands of mighty heroes in an online world of magic and limitless adventure. World of Warcraft is a role-playing game from Blizzard Entertainment for the PC and Mac.">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="{{ asset('wow/images/meta/favicon.ico') }}" />
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ asset('wow/js/third-party.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wow/js/common-game-site.js') }}"></script>
    <script type="text/javascript">
    //<![CDATA[
        var Core = Core || {},
        Login = Login || {};
        Core.staticUrl = '/';
        Core.sharedStaticUrl = '/';
        Core.baseUrl = '{{ config('app.url') }}';
        Core.projectUrl = '/';
        Core.cdnUrl = '/';
        Core.supportUrl = '/';
        Core.secureSupportUrl = '/';
        Core.project = '/';
        Core.locale = '{{ app()->getLocale() }}';
        Core.language = '{{ app()->getLocale() }}';
        Core.region = 'eu';
        Core.shortDateFormat = 'dd/MM/yyyy';
        Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
        Core.loggedIn =@guest false; @else true; @endguest
        Core.userAgent = 'web';
        Login.embeddedUrl = '/{{ app()->getLocale() }}/login';
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '']);
        _gaq.push(['_setDomainName', '']);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);
        //]]>
    </script>
</head>
<body class="{{ app()->getLocale() }} @yield('body')">
        @include('layouts.navbar')
    <div id="wrapper">
        <div id="header">
            <div class="search-bar">
                <form action="/search" method="get" autocomplete="off">
                    <div>
                        <div class="ui-typeahead-ghost">
                            <input type="text" value="" autocomplete="off" readonly="readonly" class="search-field input input-ghost" />
                            <input type="search" class="search-field input" name="q" id="search-field" maxlength="200" tabindex="40" alt="Поиск предметов, персонажей, сообщений на форумах и т.д." value="Поиск предметов, персонажей, сообщений на форумах и т.д." />
                        </div>
                        <input type="submit" class="search-button" value="" tabindex="41" />
                    </div>
                </form>
            </div>
            <h1 id="logo">
                <a href="/">World of Warcraft</a>
            </h1>

            <div class="header-plate">
            <ul class="menu" id="menu">
                <li class="menu-home"><a href="{{ route('home') }}" class="menu-active"><span>@lang('site.home')</span></a></li>
                <li class="menu-game"><a href="/game/"><span>@lang('site.game')</span></a></li>
                <li class="menu-community"><a href="{{ route('community') }}"><span>@lang('site.community')</span></a></li>
                <li class="menu-media"><a href="/media/"><span>@lang('site.media')</span></a></li>
                <li class="menu-forums"><a href="{{ route('forums') }}"><span>@lang('site.forums')</span></a></li>
                <li class="menu-services"><a href="{{ route('shop') }}"><span>@lang('site.shop')</span></a></li>

                </ul>
                @guest
                <div class="user-plate">
                <a href="{{ route('login') }}" class="card-character plate-logged-out">
                <span class="card-portrait"></span>
                <span class="wow-login-key"></span>
                <span class="login-msg">@lang('site.login-msg')</span>
                </a>
                </div>
                @else
                <div class="user-plate">
                <div class="card-character plate-default no-character"></div>
                <div class="meta-wrapper meta-no-character ajax-update">
                <div class="meta">
                <div class="player-name">{{ Auth::user()->name }}</div>
                    @lang('site.no-characters')
                </div>
                </div>
                </div>
                @endguest
            </div>
        </div>

@yield('content')
@include('layouts.footer')
</div>
    <script>
    //<![CDATA[
    var xsToken = '';
    var supportToken = '';
    var jsonSearchHandlerUrl = '/';
    var Msg = Msg || {};
    Msg.support = {
        ticketNew: 'Открыт запрос № {0}.',
        ticketStatus: 'Запросу № {0} присвоен статус «{1}».',
        ticketOpen: 'Открыт',
        ticketAnswered: 'Дан ответ',
        ticketResolved: 'Разрешен',
        ticketCanceled: 'Отменен',
        ticketArchived: 'Перемещен в архив',
        ticketInfo: 'Уточнить',
        ticketAll: 'Все запросы'
    };
    Msg.cms = {
        requestError: 'Ваш запрос не может быть завершен.',
        ignoreNot: 'Этот пользователь не в черном списке.',
        ignoreAlready: 'Этот пользователь уже в черном списке.',
        stickyRequested: 'Отправлена просьба прикрепить тему.',
        stickyHasBeenRequested: 'Вы уже отправили просьбу прикрепить эту тему.',
        postAdded: 'Сообщение отслеживается',
        postRemoved: 'Сообщение больше не отслеживается',
        userAdded: 'Сообщения пользователя отслеживаются',
        userRemoved: 'Сообщения пользователя больше не отслеживается',
        validationError: 'Обязательное поле не заполнено',
        characterExceed: 'В сообщении превышено допустимое число символов.',
        searchFor: 'Поиск по',
        searchTags: 'Помеченные статьи:',
        characterAjaxError: 'Возможно, вы вышли из системы. Обновите страницу и повторите попытку.',
        ilvl: "Уровень {0}",
        shortQuery: 'Запрос для поиска должен состоять не менее чем из двух букв.',
        editSuccess: 'Success. Reload?',
        postDelete: 'Вы точно хотите удалить это сообщение?',
        throttleError: 'Вы должны подождать некоторое время, прежде чем вы сможете опубликовать новое сообщение.',
    };
    Msg.bml= {
        bold: 'Полужирный',
        italics: 'Курсив',
        underline: 'Подчеркивание',
        list: 'Несортированный список',
        listItem: 'Список',
        quote: 'Цитирование',
        quoteBy: 'Размещено {0}',
        unformat: 'Отменить форматирование',
        cleanup: 'Исправить переносы строки',
        code: 'Код',
        item: 'Предмет WoW',
        itemPrompt: 'Идентификатор предмета:',
        url: 'Ссылка',
        urlPrompt: 'Ссылка на страницу:'
    };
    Msg.ui= {
        submit: 'Отправить',
        cancel: 'Отмена',
        reset: 'Сброс',
        viewInGallery: 'Галерея',
        loading: 'Подождите, пожалуйста.',
        unexpectedError: 'Произошла ошибка.',
        fansiteFind: 'Найти на…',
        fansiteFindType: '{0}: поиск на…',
        fansiteNone: 'Нет доступных сайтов.',
        flashErrorHeader: 'Необходимо установить Adobe Flash Player.',
        flashErrorText: 'Загрузить Adobe Flash Player',
        flashErrorUrl: 'http://get.adobe.com/flashplayer/',
        save: 'Сохранить'
    };
    Msg.grammar= {
        colon: '{0}:',
        first: 'Первая стр.',
        last: 'Последняя стр.',
        ellipsis: '...'
    };
    Msg.fansite= {
        achievement: 'Достижение',
        character: 'Персонаж',
        faction: 'Фракция',
        'class': 'Класс',
        object: 'Объект',
        talentcalc: 'Таланты',
        skill: 'Профессия',
        quest: 'Задание',
        spell: 'Заклинания',
        event: 'Событие',
        title: 'Звание',
        arena: 'Команда Арены',
        guild: 'Гильдия',
        zone: 'Территория',
        item: 'Предмет',
        race: 'Раса',
        npc: 'НПС',
        pet: 'Питомец'
    };
    Msg.search= {
        noResults: 'Нет результатов для отображения',
        kb: 'Поддержка',
        post: 'Форумы',
        article: 'Статьи',
        static: 'Материалы',
        wowcharacter: 'Персонаж',
        wowitem: 'Предмет',
        wowguild: 'Гильдии',
        wowarenateam: 'Команды Арены',
        url: 'Вам может быть интересно',
        friend: 'Друзья',
        product: 'Продукция',
        other: 'Другое'
    };
    //]]>
</script>

    <script type="text/javascript" src="{{ asset('wow/js/menu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wow/js/wow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wow/js/navbar-tk.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('wow/js/common/search-pane.js') }}"></script>
    <script type="text/javascript">
        //<![CDATA[
        $(function() {
            Menu.initialize('/data/menu.json');
            Search.initialize('/search/ta');
        });
        //]]>
    </script>
            <script type="text/javascript" src="{{ asset('wow/js/cms.min.js') }}"></script>
    </body>
</html>