<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <title>{{ config('app.name', 'Форум World of Warcraft') }}</title>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://eu.battle.net/forums/ru/wow/" />
    <meta property="og:title" content="Форум World of Warcraft" />
    <meta property="og:image" content="/images/social-thumbs/wow.png" />
    <meta property="og:description" content="Добро пожаловать на официальные форумы World of Warcraft" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icons/wow-favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/nav-client/nav-client.css') }}" />
    <link rel="stylesheet" type="text/css" media="(max-width:800px)" href="{{ asset('css/nav-client/nav-client-responsive.css') }}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/main-c21d6d8877.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ asset('js/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready( function() {
            $('body').removeClass('no-js');

            // TODO: Remove the following code when fixing the white flash issue.
            // Its here to fix the deeplinking bug in Firefox
            if (location.href.indexOf('#') > -1) {
   			location.href+='';
            }
        })
    </script>
    <!--[if lte IE 8]>
        <script type="text/javascript" src="{{ asset('js/vendor/jquery-compat/dist/jquery.min.js') }}"></script>
    <![endif]-->

        <script type="text/javascript">
        //<![CDATA[
        var Core = Core || {},
        Login = Login || {};
        Core.staticUrl			= '';
        Core.sharedStaticUrl 	= '';
        Core.baseUrl			= '{{ route("forums") }}';
        Core.projectUrl     	= '{{ route("forums") }}';
        Core.cdnUrl         	= 'http://media.blizzard.com';
        Core.supportUrl			= '/support/';
        Core.secureSupportUrl 	= '/support/';
        Core.project			= '';
        Core.locale				= 'ru-ru';
        Core.language			= 'ru';
        Core.region				= 'eu';
        Core.shortDateFormat 	= 'dd/MM/yyyy';
        Core.dateTimeFormat		= 'dd/MM/yyyy HH:mm';
        Core.loggedIn			= @guest false; @else true; @endguest
        Core.userAgent			= 'web';
        Login.embeddedUrl 		= '/{{ app()->getLocale() }}/login';
        Core.community = '';
        //]]>
        </script>
        <script type="text/javascript" src="{{ asset('js/nav-client/navbar-tk.min.js') }}"></script>
        <script type="text/javascript">
        //<![CDATA[
        window.nav.notifications.endpoint = "\/notification/list";
        //]]>
        </script>
        <script type="text/javascript">
        //<![CDATA[
        var LOCALIZATION = LOCALIZATION || {};
        LOCALIZATION.URL_PROMPT = "@lang('forum.urlprompt')";
        //]]>
        </script>
</head>
<body class="ru-ru Theme--wow no-js preload">
<script type="text/javascript">
//<![CDATA[
var LOCALIZATION = LOCALIZATION || {};

LOCALIZATION.ERROR_EMPTY = "Warning! No topics were selected";
LOCALIZATION.DELETE_SUCCESS = "Deleted";
LOCALIZATION.DELETE_CHANGES = "Success! the selected topic(s) have been deleted. Please wait up to 60 seconds for your changes to appear.";
LOCALIZATION.ERROR_DELETE = "Error Deleting";
LOCALIZATION.ERROR_DELETE_DETAILED = "Error! the selected topic(s) were not deleted.";
LOCALIZATION.UPDATE_SUCCESS_MOD = "Update successful";
LOCALIZATION.ERROR_UPDATE_MOD = "Error Updating";
LOCALIZATION.UNPOSTED_PROMPT = "You've started writing a post...";
//]]>
</script>

    <div class="Navbar-overlay"></div>
    <div id="nav-client-header" class="nav-client mobileEnabled default">
            <!--[if !IE|(gt IE 8)]> <!-->	<div class="nav-mobile-menubar">
        <div class="nav-hamburger-menu-icon"></div>
        <div class="nav-mobile-menu-title">Форумы</div>
        <div class="nav-global-menu-icon"></div>
    <div class="nav-notification-icon">
        <a class="dropdown-toggle needsclick nav-item" rel="navbar">
            <i class="needsclick nav-icon-bell"></i>
        </a>
    <div class="nav-notification-dropdown dropdown-menu">
        <div class="arrow top"></div>
    </div>
    </div>
    </div>
    <div class="nav-mobile-menu-wrap right">
        <div class="menu-relative-wrap">
            <div class="menu-header global-menu">
                <div class="nav-remove-icon-wrap">
                    <div class="nav-remove-icon"></div>
                </div>
            </div>
            <div class="menu-content">
                <div id="user-account" class="nav-box">
                            <div class="label">
                                <span class="battletag">TheRock33</span>
                                <span class="code">#2255</span>
                            </div>
                            <div class="email">site@mail.com</div>
                </div>
                <div id="general-menu" class="nav-box">
                    <ul class="menu-list global-menu-main">
                        <li class="menu-list-item">




<a id="nav-client-shop" class="nav-item" href="/shop/" data-analytics="global-nav" data-analytics-placement="Nav - Shop"><i class="nav-icon-24-blue nav-icon-shopping-cart"></i>Магазин</a>

                        </li>
                        <li class="menu-list-item">
<a id="nav-client-support" class="nav-item" href="/support/" data-analytics="global-nav" data-analytics-placement="Nav - Support"><i class="nav-icon-24-blue nav-icon-question-circle"></i>Поддержка <span id="support-counter" class="no-updates nav-support-ticket-counter nav-counter"></span> </a>

                        </li>
                        <li class="menu-list-item">




<a id="nav-client-account-settings" class="nav-item" href="/account/" data-analytics="global-nav" data-analytics-placement="Nav - Account - Settings"><i class="nav-icon-24-blue nav-icon-character-cog"></i>Параметры</a>

                        </li>
                    </ul>
                </div>
                    <div class="nav-box" id="logout-nav-box">
<a id="nav-client-logout" class="nav-item" href="?logout" data-analytics="global-nav" data-analytics-placement="Nav - Account - Log Out"><i class="nav-icon-24-blue nav-icon-logout"></i>Выход</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="nav-mobile-menu-wrap left">
        <div class="menu-relative-wrap">


    <i class="Icon" data-hamburger-close="data-hamburger-close"></i><div class="nav-mobile-menu-title">Форумы</div>
    <div class="menu-content">
        <div class="menu-userDetails">
<a href="/forum/search?a=" class="menu-item menu-item--postHistory">История сообщений</a>
                <a href="/character///" class="menu-item menu-item--profileLink">
Профиль<i class="Icon-profileLink"></i></a>
                <span class="menu-item" data-select-character="true">
Изменить персонажа</span>
        </div>

        <a href="/" class="Community-banner">
            <div class="Community-header-menu">
                <img class="Community-logo" src="/images/game-logos/game-logo-wow.png"/>
            </div>
        </a>

                <div class="menu-divider"></div>
                <span class="menu-item menu-item-disabled">ПОДДЕРЖКА</span>

                        <a href="/forums/ru/wow/975484/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/H7630A7DXOFY1465340163715.png')"></i>Служба поддержки</a>

                        <a href="/forums/ru/wow/975483/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/3J7DYJXHUEAL1465340164010.png')"></i>Техническая поддержка</a>

                        <a href="/forums/ru/wow/896179/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/Y3H0ZXKW6BS11465340163386.png')"></i>Перевод и локализация</a>

                <div class="menu-divider"></div>
                <span class="menu-item menu-item-disabled">СООБЩЕСТВО</span>

                        <a href="/forums/ru/wow/896071/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/ADSIU5U7W1F91465340164046.png')"></i>Ролевая игра</a>

                        <a href="/forums/ru/wow/896072/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/OHIIWXOXTQLV1465340163985.png')"></i>История</a>

                        <a href="/forums/ru/wow/896074/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/631CI140DCFX1465340163772.png')"></i>Общие темы</a>

                        <a href="/forums/ru/wow/19369484/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/C8J7S9HL8RHB1465340163811.png')"></i>Поиск игроков</a>

                        <a href="/forums/ru/wow/896079/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/OHIIWXOXTQLV1465340163985.png')"></i>Жизнь сообщества</a>
                <div class="menu-divider"></div>
                <span class="menu-item menu-item-disabled">ИГРОВОЙ ПРОЦЕСС</span>

                        <a href="/forums/ru/wow/896045/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/OB1XX71CH6CZ1465340163932.png')"></i>Помощь новичкам и руководства</a>

                        <a href="/forums/ru/wow/19369589/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/CGFP3LH4T20Y1465340163753.png')"></i>Подземелья и рейды</a>

                        <a href="/forums/ru/wow/19369485/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Задания и достижения	</a>

                        <a href="/forums/ru/wow/6088594/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/ZUFAMWGTP3KU1465340163878.png')"></i>Бои питомцев</a>

                        <a href="/forums/ru/wow/896047/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/A14TA6QKYP7I1465340163883.png')"></i>Профессии</a>

                        <a href="/forums/ru/wow/19369576/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/2EDXXX9GSQ411465340164020.png')"></i>Трансмогрификация</a>

                        <a href="/forums/ru/wow/896076/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/1ANVSA4Z07B71465340164025.png')"></i>Интерфейс и макросы</a>

                        <a href="/forums/ru/wow/19369526/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/OHIIWXOXTQLV1465340163985.png')"></i>Архив Blizzard</a>

                        <a href="/forums/ru/wow/896178/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/C8J7S9HL8RHB1465340163811.png')"></i>Тестовый игровой мир</a>
                <div class="menu-divider"></div>
                <span class="menu-item menu-item-disabled"> БОИ МЕЖДУ ИГРОКАМИ (PVP)</span>

                        <a href="/forums/ru/wow/19369585/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/0DHCTVAA3F731465340163891.png')"></i>Арена</a>

                        <a href="/forums/ru/wow/19369586/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/0DHCTVAA3F731465340163891.png')"></i>PvP на полях боя и за их пределами</a>
                <div class="menu-divider"></div>
                <span class="menu-item menu-item-disabled">КЛАССЫ</span>

                        <a href="/forums/ru/wow/19369487/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/742W2C4VQJ651465340163518.png')"></i>Охотник на демонов</a>

                        <a href="/forums/ru/wow/896177/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/Q21ASBT2SDXX1465340163697.png')"></i>Воин</a>

                        <a href="/forums/ru/wow/896081/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/BIML5YS7P8XA1465340163522.png')"></i>Друид</a>

                        <a href="/forums/ru/wow/896173/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/MMF2M70OD4PY1465340163646.png')"></i>Жрец</a>

                        <a href="/forums/ru/wow/896171/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/KONFY3G21NRT1465340163602.png')"></i>Маг</a>

                        <a href="/forums/ru/wow/6038098/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/MD3875H6PEN31465340163613.png')"></i>Монах</a>

                        <a href="/forums/ru/wow/896170/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/3AP8QPDFMH191465340163595.png')"></i>Охотник</a>

                        <a href="/forums/ru/wow/896172/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/FTPZBBV8LWHM1465340163625.png')"></i>Паладин</a>

                        <a href="/forums/ru/wow/896174/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/4K4NG17DH5OC1465340163651.png')"></i>Разбойник</a>

                        <a href="/forums/ru/wow/896080/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/6D5HKWY2GULD1465340163386.png')"></i>Рыцарь смерти</a>

                        <a href="/forums/ru/wow/896176/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/Y65BR5SJIAKM1465340163689.png')"></i>Чернокнижник</a>

                        <a href="/forums/ru/wow/896175/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/TGVJ0Y6O051R1465340163670.png')"></i>Шаман</a>
                <div class="menu-divider"></div>
                <span class="menu-item menu-item-disabled">ИГРОВЫЕ МИРЫ</span>

                        <a href="/forums/ru/wow/940979/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Азурегос</a>

                        <a href="/forums/ru/wow/940978/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Борейская тундра</a>

                        <a href="/forums/ru/wow/940976/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Вечная Песня</a>



                        <a href="/forums/ru/wow/940975/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Галакронд</a>


                        <a href="/forums/ru/wow/1318339/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Голдринн</a>



                        <a href="/forums/ru/wow/940974/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Гордунни</a>

                        <a href="/forums/ru/wow/12643302/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Гром / Термоштепсель</a>



                        <a href="/forums/ru/wow/940917/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Дракономор</a>


                        <a href="/forums/ru/wow/12481142/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Пиратская бухта / Ткач Смерти</a>

                        <a href="/forums/ru/wow/12309730/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Король-лич / Седогрив</a>

                        <a href="/forums/ru/wow/10635503/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Подземье / Разувий</a>

                        <a href="/forums/ru/wow/940912/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Ревущий фьорд</a>

                        <a href="/forums/ru/wow/940911/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Свежеватель душ</a>

                        <a href="/forums/ru/wow/940909/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Страж Смерти</a>

                        <a href="/forums/ru/wow/940653/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Черный Шрам</a>

                        <a href="/forums/ru/wow/940652/" class="menu-item "><i class="Forum-icon" style="background-image: url('/cms/forum_icon/L3B2BXGBMI8F1465340163947.png')"></i>Ясеневый лес</a>
    </div>
        </div>
    </div>
    <div id="nav-blackout" style="display:none"></div>
<!--<![endif]-->
    @include('layouts.navbar')
    <div class="nav-notification-responsive-container">
    <div class="nav-notification-dropdown dropdown-menu">
        <div class="arrow top"></div>
    </div>
        </div>
    </div><div class="Subnav">
    <div class="Container Container--content">
    <div class="GameSite-link"> <a class="GameSite-link--heading" href="/"> <i class="Icon"></i>World of Warcraft </a> </div>
    @yield('sidebar')
    </div>
</div>
<div role="main">
    @yield('content')
</div>
<footer class="Forums-footer"> Спасибо, что заглянули на <a href="{{ route('forums') }}">Форумы WoWLegions</a> (0.0.1) · <a href="{{ route('forums') }}">Описание обновлений</a> </footer>
@include('layouts.footer')

<script type="text/javascript" src="{{ asset('js/vendor/tether/dist/js/tether.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor/waypoints/lib/jquery.waypoints.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor/waypoints/lib/shortcuts/sticky.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor/instanttouch.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor/clipboard.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vendor/d3/tooltips.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main-7ba3dece36.js') }}"></script>

</body>
</html>