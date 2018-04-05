@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/common-game-site.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/expansion-Legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/wow-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/nav-client-desktop-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/community.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/lightbox.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/build/cms.min.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/cms.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/sidebar.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/realmstatus.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/game/events.css') }}" />
@endsection

@section('body')
community-home
@endsection

@section('content')
<div id="content">
    <div class="content-top body-top">
        <div class="content-trail">
            <ol class="ui-breadcrumb">
                <li itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="/" rel="np" class="breadcrumb-arrow" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">World of Warcraft</span>
                    </a>
                </li>
                <li class="last children" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <a href="/community/" rel="np" itemprop="url">
                        <span class="breadcrumb-text" itemprop="name">Сообщество</span>
                    </a>
                </li>
            </ol>
        </div>
        <div class="content-bot clear">
            <script type="text/javascript">
                //<![CDATA[
                $(document).ready(function(){
                    Input.bind('#wowcharacter');
                    Input.bind('#wowguild');
                });
                //]]>
            </script>
            <div id="left">
                <div class="profiles">
                    <h4>Сообщество</h4>
                    <div class="profile-section">
                        <div class="sidebar-module " id="sidebar-profiles-search">
                            <div class="sidebar-title">
                                <h3 class="header-3 title-profiles-search">
                                    Профили                                </h3>
                            </div>

                            <div class="sidebar-content">
                                <div class="profiles-search-block">
                                    <span class="profiles-search-title">Персонаж</span>
                                    <form action="/search" method="get">
                                        <input type="hidden" name="f" value="wowcharacter" />
                                        <input type="text" id="wowcharacter" alt="Имя" name="q" />

                                        <button class="ui-button button1" type="submit"><span class="button-left"><span class="button-right">Поиск</span></span></button>
                                    </form>
                                </div>
                                <div class="profiles-search-block">
                                    <span class="profiles-search-title">Гильдия</span>
                                    <form action="/search" method="get">
                                        <input type="hidden" name="f" value="wowguild" />
                                        <input type="text" id="wowguild" alt="Имя" name="q" />

                                        <button class="ui-button button1" type="submit"><span class="button-left"><span class="button-right">Поиск</span></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="profiles-tip">
                            Чтобы перейти к своему профилю, авторизуйтесь на сайте.                        </p>
                    </div>
                </div>
                <div class="main-feature">
                    <div class="main-feature-wrapper">
                        <div class="sidebar-module" id="sidebar-leaderboards">
                            <div class="sidebar-title">
                                <h3 class="header-3 title-leaderboards">
                                    Таблицы рейтингов                                </h3>
                            </div>
                            <div class="sidebar-content">
                                <div id="challenge-mode" class="leaderboard-content-block">
                                    <a href="/challenge/dungeon/nei" class="leaderboard-content-title">Режимы испытаний</a>
                                    <span class="leaderboard-content-desc">Рекорды прохождения для каждого подземелья и игрового мира.</span>
                                </div>
                                <div id="pvp-ladder" class="leaderboard-content-block">
                                    <a href="/pvp/leaderboards/3v3" class="leaderboard-content-title">Рейтинги PVP</a>
                                    <span class="leaderboard-content-desc">Здесь вы можете посмотреть текущие рейтинги Арены и полей боя.</span>
                                    <div class="group">
                                        <a href="/pvp/leaderboards/rbg">
                                            <span class="group-thumbnail thumb-battlegrounds"></span>
                                            <span class="group-name">
                                                Поля боя                                            </span>
                                            <span class="clear"><!-- --></span>
                                        </a>
                                        <a href="/pvp/leaderboards/2v2">
                                            <span class="group-thumbnail thumb-arena-2v2"></span>
                                            <span class="group-name">
                                                2 vs 2
                                            </span>
                                            <span class="clear"><!-- --></span>
                                        </a>
                                        <a href="/pvp/leaderboards/3v3">
                                            <span class="group-thumbnail thumb-arena-3v3"></span>
                                            <span class="group-name">
                                                3 vs 3
                                            </span>
                                            <span class="clear"><!-- --></span>
                                        </a>
                                        <a href="/pvp/leaderboards/5v5">
                                            <span class="group-thumbnail thumb-arena-5v5"></span>
                                            <span class="group-name">
                                                5 vs 5
                                            </span>
                                            <span class="clear"><!-- --></span>
                                        </a>
                                    </div>
                                </div>
                                <span class="clear"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="right">
                <div class="sidebar-module " id="sidebar-game-realms">
                    <div class="sidebar-title">
                        <h3 class="header-3 title-game-realms">
                            Аукционный дом                        </h3>
                    </div>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <a href="/vault/character/auction/" class="web-auction-house block">
                                    <span class="content-icon"></span>
                                    <span class="content-title">Мобильный аукцион</span>
                                    <span class="content-desc">Просматривайте, покупайте и продавайте предметы прямо на сайте!</span>
                                    <span class="clear"><!-- --></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-module " id="sidebar-game-realms">
                    <div class="sidebar-title">
                        <h3 class="header-3 title-game-realms">
                            Информация                        </h3>
                    </div>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <a href="/community/changelog" class="web-auction-house block">
                                    <span class="content-icon"></span>
                                    <span class="content-title">Changelog</span>
                                    <span class="content-desc">List of changes in the game and on the website</span>
                                    <span class="clear"><!-- --></span>
                                </a>
                            </li>
                            <li>
                                <a href="/community/bugtracker" class="web-auction-house block">
                                    <span class="content-icon"></span>
                                    <span class="content-title">Bugtracker</span>
                                    <span class="content-desc">Found a bug? Report it</span>
                                    <span class="clear"><!-- --></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-module " id="sidebar-game-realms">
                    <div class="sidebar-title">
                        <h3 class="header-3 title-game-realms">
                            Игровые миры                        </h3>
                    </div>
                    <div class="sidebar-content">
                        <ul>
                            <li>
                                <a href="/community/status" class="realm-status block">
                                    <span class="content-icon"></span>
                                    <span class="content-title">Состояние игровых миров</span>
                                    <span class="content-desc">Список игровых миров и состояние каждого мира.</span>
                                    <span class="clear"><!-- --></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <span class="clear"></span>
        </div>
    </div>
@endsection