@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/common-game-site.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/expansion-Legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/wow-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/nav-client-desktop-legion.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/lightbox.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/profile.css') }}" />
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/profile-ie.css') }}" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/profile-ie6.css') }}" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/wiki/zone.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/character/summary.css') }}" />
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/character/summary-ie.css') }}" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/character/summary-ie6.css') }}" /><![endif]-->
<!--[if IE 8]><link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/character/summary-ie8.css') }}" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/character/pet.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('wow/css/locale/'.app()->getLocale().'.css') }}" />
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('wow/js/character/profile.js') }}"></script>
<script type="text/javascript" src="{{ asset('wow/js/character/collectible-popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('wow/js/character/summary.js') }}"></script>
<script type="text/javascript" src="{{ asset('wow/js/utility/model-rotator.js') }}"></script>
@endsection

@section('body')
logged-in without-nav
@endsection

@section('content')
<style type="text/css">
#content .content-top { background: url("/wow/images/character/summary/backgrounds/race/{{ $char['class'] }}.jpg") left top no-repeat; }
.profile-wrapper { background-image: url("/wow/images/2d/profilemain/race/{{ $char['class'] }}-{{ $char['gender'] }}.jpg"); }
</style>
<div id="content">
<div class="content-top body-top">
<div class="content-trail"></div>
<div class="content-bot clear">
    <div id="profile-wrapper" class="profile-wrapper profile-wrapper-alliance">

        <div class="profile-sidebar-anchor">
            <div class="profile-sidebar-outer">
                <div class="profile-sidebar-inner">
                    <div class="profile-sidebar-contents">
        <div class="profile-info-anchor">
            <div class="profile-info">
                <div class="name"><a href="{{ route('characters-simple', [$char['name']]) }}" rel="np">{{ $char['name'] }}</a></div>
                <div class="title-guild">
                    <div class="title"> <!--покоритель сумрака--></div>
                </div>
    <span class="clear"><!-- --></span>
                <div class="under-name color-c12">
                        <a href="/game/race/human" class="race"></a>-<a href="/game/class/paladin" class="class"></a> (<a id="profile-info-spec" href="#talents" class="spec tip">Месть</a>) <span class="level"><strong>{{ $char['level'] }}</strong></span> ур.<span class="comma">,</span>
                    <span class="realm tip" id="profile-info-realm" data-battlegroup="Vindication">
                        ElisGrimm
                    </span>
                </div>
                <div class="achievements"><a href="/character/ElisGrimm/Rock/achievement">0</a></div>
            </div>
        </div>
    <ul class="profile-sidebar-menu" id="profile-sidebar-menu">
            <li class=" active">
        <a href="{{ route('characters-simple', [$char['name']]) }}" class="" rel="np">
            <span class="arrow"><span class="icon">
                Сводная информация
            </span></span>
        </a>
            </li>
            <li class="">
        <a href="/vault/character/auction/" class=" has-submenu vault" rel="np">
            <span class="arrow"><span class="icon">
                Лоты
            </span></span>
        </a>
            </li>
            <li class="">
        <a href="/vault/character/event" class=" vault" rel="np">
            <span class="arrow"><span class="icon">
                События
            </span></span>
        </a>
            </li>
            <li class="">
        <a href="/character/ElisGrimm/Rock/achievement" class=" has-submenu" rel="np">
            <span class="arrow"><span class="icon">
                Достижения
            </span></span>
        </a>
            </li>
            <li class="">

        <a href="/character/ElisGrimm/Rock/pet" class="" rel="np">
            <span class="arrow"><span class="icon">
                Спутники и транспорт
            </span></span>
        </a>
            </li>
            <li class="">
        <a href="/character/ElisGrimm/Rock/profession/" class=" has-submenu" rel="np">
            <span class="arrow"><span class="icon">
                Профессии
            </span></span>
        </a>
            </li>
            <li class="">
        <a href="/character/ElisGrimm/Rock/reputation/" class="" rel="np">
            <span class="arrow"><span class="icon">
                Репутация
            </span></span>
        </a>
            </li>
            <li class="">
        <a href="/character/ElisGrimm/Rock/pvp" class="" rel="np">
            <span class="arrow"><span class="icon">
                PvP
            </span></span>
        </a>
            </li>
            <li class="">
        <a href="/character/ElisGrimm/Rock/feed" class="" rel="np">
            <span class="arrow"><span class="icon">
                Лента новостей
            </span></span>
        </a>

            </li>
    </ul>
                            <div class="summary-sidebar-links">
                                <span class="summary-sidebar-button">
                                    <a href="javascript:;" id="summary-link-tools" class="summary-link-tools"></a>
                                </span>

                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-contents">

        <div class="summary-top">

            <div class="summary-top-right">


    <ul class="profile-view-options" id="profile-view-options-summary">
            <li>
                <a href="/character/ElisGrimm/Rock/advanced" rel="np" class="advanced">
                    Развернутый
                </a>
            </li>
            <li class="current">
                <a href="{{ route('characters-simple', [$char['name']]) }}" rel="np" class="simple">
                    Простой
                </a>
            </li>
    </ul>


                    <div class="summary-averageilvl">
    <div class="rest">
        Средний<br />
        (<span class="equipped">{{-- \App\Characters::GetAVGItemLevel() --}}</span> Экипирован)
    </div>
    <div id="summary-averageilvl-best" class="best tip" data-id="averageilvl">
       750    </div>
                    </div>

            </div>

                <div class="summary-top-inventory">
                <div id="summary-inventory" class="summary-inventory summary-inventory-simple">
<div data-id="0" data-type="1" class="slot slot-1" style=" left: 0px; top: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="1" data-type="2" class="slot slot-2" style=" left: 0px; top: 58px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="2" data-type="3" class="slot slot-3" style="left: 0px; top: 116px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="15" data-type="16" class="slot slot-16" style=" left: 0px; top: 174px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="4" data-type="5" class="slot slot-5" style=" left: 0px; top: 232px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="3" data-type="4" class="slot slot-4" style=" left: 0px; top: 290px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="18" data-type="19" class="slot slot-19" style=" left: 0px; top: 348px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="8" data-type="9" class="slot slot-9" style=" left: 0px; top: 406px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="9" data-type="10" class="slot slot-10" style=" top: 0px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="5" data-type="6" class="slot slot-6" style=" top: 58px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="6" data-type="7" class="slot slot-7" style=" top: 116px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="7" data-type="8" class="slot slot-8" style=" top: 174px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="10" data-type="11" class="slot slot-11" style=" top: 232px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="10" data-type="11" class="slot slot-11" style=" top: 290px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="11" data-type="12" class="slot slot-12" style=" top: 348px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="11" data-type="12" class="slot slot-12" style=" top: 406px; right: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div><div data-id="20" data-type="21" class="slot slot-21 slot-align-right item-quality-6" style=" left: 273.5px; bottom: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="/item/21460" class="item" data-item="21460" data-tooltip="#tooltip-0">
            <img src="https://render-eu.worldofwarcraft.com/icons/56/.jpg" alt="" />
            <span class="frame"></span></a>
            <!--a class="transmog-frame" data-item="t=120978&amp;cc=0" href="/item/120978"></a-->
            </div>
            </div>
            </div><div data-id="21" data-type="22" class="slot slot-22" style=" left: 338.5px; bottom: 0px;">
            <div class="slot-inner">
            <div class="slot-contents"><a href="javascript:;" class="empty"><span class="frame"></span></a>
            </div>
            </div>
            </div>    </div>

        <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {
            var summaryInventory = new Summary.Inventory({ view: "simple" }, {

            15: {
                    name: "灰烬使者",
                    quality: 6,
                    icon: ""
                },            });
        });
        //]]>
        </script>                </div>

        </div>


            <div class="summary-bottom">

                <div class="summary-bottom-right">
                    <div class="summary-talents" id="summary-talents">
    <h3 class="category ">							<span class="title">Таланты</span>
                            <a name="talents" href="/wow/ru/tool/talent-calculator#gZ!1021200!" target="_blank" id="export-build" class="talent-export">Просмотреть в калькуляторе талантов<span class="arrow"></span></a>
</h3>


    <div class="profile-box-simple">
        <div class="talent-specs" data-class-name="demon-hunter">


    <a data-spec-id="0" class="spec-button spec-0 selected active" href="javascript:;" data-spec-name="vengeance" data-tooltip="Использует силу внутреннего демона, чтобы испепелять противников и защищать союзников."><span class="inner">
        <span class="checkmark"></span>
            <span class="frame">
                <span class="icon"><img src="http://media.blizzard.com/wow/icons/36/ability_demonhunter_spectank.jpg" alt="" /></span>
            </span>
        <span class="roles">
                <span class="icon-tank"></span>
        </span>
        <span class="name-build">
            <span class="name ">Месть</span>
        </span>
    </span></a>


    <a data-spec-id="1" class="spec-button spec-1" href="javascript:;" data-spec-name="havoc" data-tooltip="Мрачный мастер боевых клинков и разрушительной магии Скверны."><span class="inner">

            <span class="frame">
                <span class="icon"><img src="http://media.blizzard.com/wow/icons/36/ability_demonhunter_specdps.jpg" alt="" /></span>
            </span>
        <span class="roles">
                <span class="icon-dps"></span>
        </span>
        <span class="name-build">
            <span class="name ">Истребление</span>
        </span>
    </span></a>




    <span class="clear"><!-- --></span>
        </div>



    <div class="talent-build selected" id="talent-build-0">
    @include('characters.block.talents_bild_0')
    </div>


    <div class="talent-build " id="talent-build-1">
        @include('characters.block.talents_bild_1')
    </div>


    <div class="talent-build " id="talent-build-2">
            <div class="talents">
                <ul>

                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>


                </ul>
            </div>
        </div>


    <div class="talent-build " id="talent-build-3">
            <div class="talents">
                <ul>

                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>



                            <li class="talent empty"><span class="icon-frame frame-18"></span><span class="spell-name">Пусто</span></li>


                </ul>
            </div>
        </div>

    </div>

        <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {

            var specLinks = {};

                specLinks[0] = "/wow/ru/tool/talent-calculator#gZ!1021200!";
                specLinks[1] = "/wow/ru/tool/talent-calculator#ga!0201101!";
                specLinks[2] = "/wow/ru/tool/talent-calculator#g!!";
                specLinks[3] = "/wow/ru/tool/talent-calculator#g!!";

            Summary.Talents(specLinks);
        });
        //]]>
        </script>


                    </div>
                </div>
                <div class="summary-bottom-left">
    <div class="summary-health-resource">
        <ul>
            <li class="health" id="summary-health" data-id="health"><span class="name">Health</span><span class="value">{{ $char['health'] }}</span></li>
            <li class="resource-18" id="summary-power" data-id="power-18"><span class="name">Pain</span><span class="value">100</span></li>
        </ul>
    </div>
    <div class="summary-stats-profs-bgs">
        @include('characters.block.summary_stats', ['char' => $char])
        </div>
    </div>
    <span class="clear"><!-- --></span>
                <div class="summary-bottom-sub-content">
                <div class="summary-bottom-right">
                        <div class="profile-recentactivity">
    <h3 class="category ">								<a href="feed" class="view-more">Последние новости</a>
</h3>
                            <div class="profile-box-simple">
    <ul class="activity-feed">



    <li class="ach ">
    <dl>
        <dd>

        <a href="achievement#168:15255:a10820" data-achievement="10820">





        <span  class="icon-frame frame-18 " style='background-image: url("http://media.blizzard.com/wow/icons/18/achievement_emeraldnightmare_xavius.jpg");'>
        </span>
        </a>

    Заработано достижение <a href="achievement#168:15255:a10820"  data-achievement="10820">Провал Альн</a> за 10 очков.
</dd>
        <dt>04/01/2017</dt>
    </dl>
    </li>



    <li class="crit ">
    <dl>
        <dd>

<a href="achievement#15078:a5171" class="icon" data-achievement="5171"></a>
    Завершен шаг <strong>Рыцарь смерти</strong> для достижения <a href="achievement#15078:a5171" data-achievement="5171">Убийца эльфов крови</a>.
</dd>
        <dt>15/12/2016</dt>
    </dl>
    </li>



    <li class="crit ">
    <dl>
        <dd>

<a href="achievement#15078:a5170" class="icon" data-achievement="5170"></a>
    Завершен шаг <strong>Охотник</strong> для достижения <a href="achievement#15078:a5170" data-achievement="5170">Убийца троллей</a>.
</dd>
        <dt>15/12/2016</dt>
    </dl>
    </li>



    <li class="crit ">
    <dl>
        <dd>

<a href="achievement#15078:a5168" class="icon" data-achievement="5168"></a>
    Завершен шаг <strong>Рыцарь смерти</strong> для достижения <a href="achievement#15078:a5168" data-achievement="5168">Убийца тауренов</a>.
</dd>
        <dt>15/12/2016</dt>
    </dl>
    </li>
    </ul>
    <div class="profile-linktomore">
        <a href="/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/feed" rel="np">Смотреть более ранние новости</a>
    </div>

    <span class="clear"><!-- --></span>
                            </div>
                        </div>
                    </div>                <div class="summary-bottom-left">
                        <div class="summary-battlegrounds">

    <a href="/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/pvp" class="link">PvP</a>
    <ul>
        <li class="rating">
            <span class="value">0</span>
            <span class="name">Рейтинг на полях боя</span>
        </li>
        <li class="kills">
            <span class="value">1914</span>
            <span class="name">Почетные победы</span>
        </li>
    </ul>
                        </div>

                        <div class="summary-professions">
    <h3 class="category ">								<a href="/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/profession/" class="view-more">Профессии</a>
</h3>
    <ul>
                <li>




    <div class="profile-progress border-3" >
        <div class="bar border-3 hover" style="width: 3%"></div>
            <div class="bar-contents">						<a class="profession-details" href="/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/profession/leatherworking">
                            <span class="icon">




        <span class="icon-frame frame-12 ">
            <img src="http://media.blizzard.com/wow/icons/18/trade_leatherworking.jpg" alt="" width="12" height="12" />
        </span>
</span>
                            <span class="name">Кожевничество</span>
                            <span class="value">26</span>
                        </a>
</div>
    </div>
                </li>
                <li>




    <div class="profile-progress border-3" >
        <div class="bar border-3 hover" style="width: 21%"></div>
            <div class="bar-contents">						<a class="profession-details" href="/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/profession/skinning">
                            <span class="icon">




        <span class="icon-frame frame-12 ">
            <img src="http://media.blizzard.com/wow/icons/18/inv_misc_pelt_wolf_01.jpg" alt="" width="12" height="12" />
        </span>
</span>
                            <span class="name">Снятие шкур</span>
                            <span class="value">174</span>
                        </a>
</div>
    </div>
                </li>
    </ul>
                        </div>

                        <div class="summary-pets">
    <h3 class="category ">								<a href="/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/pet" class="view-more">Спутники</a>
</h3>
    <div id="battle-pet-summary">

                <div class="pet-summary-slot ">
                    <div class="character">
                        <div class="family-icon-small undead" data-pet-type="3" ></div>
                        <a class="preview" rel="np" data-collectible="1639" data-collectible-slug="pet" data-collectible-info="rO0ABXcjAAAAAAADAAACiQAABcsAAAFeAAAABmcAAAARAAAAAwAAAAE=">
                            <img src="http://media.blizzard.com/wow/renders/npcs/grid/creature91226.jpg" />
                        </a>
                    </div>
                    <div class="pet-info">
                            <a class="name color-q3" href="/wow/ru/item/118518"><strong class="level">1</strong> Кладбоша</a>
                    </div>
                </div>

                <div class="pet-summary-slot ">
                    <div class="character">
                        <div class="family-icon-small dragonkin" data-pet-type="1" ></div>
                        <a class="preview" rel="np" data-collectible="489" data-collectible-slug="pet" data-collectible-info="rO0ABXcjAAAAAAADAAAAqAAAAKoAAAB6AAAAAekAAAAEAAAAAwAAABk=">
                            <img src="http://media.blizzard.com/wow/renders/npcs/grid/creature62201.jpg" />
                        </a>
                    </div>
                    <div class="pet-info">
                            <span class="name color-q3"><strong class="level">25</strong> Порождение Ониксии</span>
                    </div>
                </div>

                <div class="pet-summary-slot end">
                    <div class="character">
                        <div class="family-icon-small elemental" data-pet-type="6" ></div>
                        <a class="preview" rel="np" data-collectible="1451" data-collectible-slug="pet" data-collectible-info="rO0ABXcjAAAAAAADAAAB9wAABUoAAACtAAAABasAAAAPAAAAAwAAABk=">
                            <img src="http://media.blizzard.com/wow/renders/npcs/grid/creature84915.jpg" />
                        </a>
                    </div>
                    <div class="pet-info">
                            <a class="name color-q3" href="/wow/ru/item/115301"><strong class="level">25</strong> Пылающий корги</a>
                    </div>
                </div>
    <span class="clear"><!-- --></span>
    </div>
                        </div>


    <span class="clear"><!-- --></span>
                    </div>                </div>

    <span class="clear"><!-- --></span>
                    <div id="summary-raid" class="summary-raid">
                        <h3 class="category">Рейдовый прогресс</h3>
                        <div class="profile-box-full">

        <div class="prestige"><div>Самое престижное рейдовое звание:
            <strong>
                    <a href="/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/achievement#168:15068:a5116" data-achievement="5116"> Гроза черных драконов</a>
            </strong>
        </div></div>

    <div class="summary-raid-wrapper">

        <div class="summary-raid-wrapper-left">

            <a id="summary-raid-arrow-left" class="arrow-left" href="javascript:;"></a>
            <a id="summary-raid-arrow-right" class="arrow-right" href="javascript:;"></a>

                <div class="lfr"><span>СПР</span></div>
            <div class="normal"><span>Нормальный ур.</span></div>
            <div class="heroic"><span>Героический ур.</span></div>
            <div class="mythic"><span>Эпохальный</span></div>

        </div>

        <div id="summary-raid-wrapper-table" class="summary-raid-wrapper-table">

            <table cellspacing="0">
    <thead>
        <tr>
            <th class="spacer-left"><div></div></th>
                <th class="trivial" colspan="69">
                    <div class="name-anchor">
                        <div class="name" id="summary-raid-head-trivial">Легко</div>
                    </div>
                    <div class="marker"></div>
                </th>
                <th></th>
                <th class="optimal" colspan="5">
                    <div class="name-anchor">
                        <div class="name">Средне</div>
                    </div>
                    <div class="marker"></div>
                </th>
                <th></th>
                <th class="challenging" colspan="1">
                    <div class="name-anchor">
                        <div class="name">Сложно</div>
                    </div>
                    <div class="marker"></div>
                </th>
        </tr>
    </thead>
    <tbody>
        <tr class="icons">
            <td></td>
                <td class="mc expansion-0" data-raid="mc">
                    <div class="icon">
                            <a href="/zone/molten-core/" data-zone="2717">ОН</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="bwl expansion-0" data-raid="bwl">
                    <div class="icon">
                            <a href="/zone/blackwing-lair/" data-zone="2677">ЛКТ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="aq10 expansion-0" data-raid="aq10">
                    <div class="icon">
                            <a href="/zone/ruins-of-ahnqiraj/" data-zone="3429">АК10</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="aq40 expansion-0" data-raid="aq40">
                    <div class="icon">
                            <a href="/zone/ahnqiraj-temple/" data-zone="3428">АК40</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="kar expansion-1" data-raid="kar">
                    <div class="icon">
                            <a href="/zone/karazhan/" data-zone="3457">Кар</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="mag expansion-1" data-raid="mag">
                    <div class="icon">
                            <a href="/zone/magtheridons-lair/" data-zone="3836">Маг</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="gru expansion-1" data-raid="gru">
                    <div class="icon">
                            <a href="/zone/gruuls-lair/" data-zone="3923">Гру</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="ssc expansion-1" data-raid="ssc">
                    <div class="icon">
                            <a href="/zone/serpentshrine-cavern/" data-zone="3607">ЗС</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="tk expansion-1" data-raid="tk">
                    <div class="icon">
                            <a href="/zone/tempest-keep/" data-zone="3845">КБ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="mh expansion-1" data-raid="mh">
                    <div class="icon">
                            <a href="/zone/the-battle-for-mount-hyjal/" data-zone="3606">ГХ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="bt expansion-1" data-raid="bt">
                    <div class="icon">
                            <a href="/zone/black-temple/" data-zone="3959">ЧХ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="sp expansion-1" data-raid="sp">
                    <div class="icon">
                            <a href="/zone/the-sunwell/" data-zone="4075">ПСК</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="voa expansion-2" data-raid="voa">
                    <div class="icon">
                            <a href="/zone/vault-of-archavon/" data-zone="4603">СА</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="nax expansion-2" data-raid="nax">
                    <div class="icon">
                            <a href="/zone/naxxramas/" data-zone="3456">Накс</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="os expansion-2" data-raid="os">
                    <div class="icon">
                            <a href="/zone/the-obsidian-sanctum/" data-zone="4493">ОС</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="eoe expansion-2" data-raid="eoe">
                    <div class="icon">
                            <a href="/zone/the-eye-of-eternity/" data-zone="4500">ОВ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="uld expansion-2" data-raid="uld">
                    <div class="icon">
                            <a href="/zone/ulduar/" data-zone="4273">Ульд</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="ony expansion-0" data-raid="ony">
                    <div class="icon">
                            <a href="/zone/onyxias-lair/" data-zone="2159">Они</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="toc expansion-2" data-raid="toc">
                    <div class="icon">
                            <a href="/zone/trial-of-the-crusader/" data-zone="4722">ИК</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="icc expansion-2" data-raid="icc">
                    <div class="icon">
                            <a href="/zone/icecrown-citadel/" data-zone="4812">ЦЛК</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="rs expansion-2" data-raid="rs">
                    <div class="icon">
                            <a href="/zone/the-ruby-sanctum/" data-zone="4987">РС</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="bh expansion-3" data-raid="bh">
                    <div class="icon">
                            <a href="/zone/baradin-hold/" data-zone="5600">КБар</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="bd expansion-3" data-raid="bd">
                    <div class="icon">
                            <a href="/zone/blackwing-descent/" data-zone="5094">ТКТ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="bot expansion-3" data-raid="bot">
                    <div class="icon">
                            <a href="/zone/the-bastion-of-twilight/" data-zone="5334">СБ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="tfw expansion-3" data-raid="tfw">
                    <div class="icon">
                            <a href="/zone/throne-of-the-four-winds/" data-zone="5638">ТЧВ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="fl expansion-3" data-raid="fl">
                    <div class="icon">
                            <a href="/zone/firelands/" data-zone="5723">ОП</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="ds expansion-3" data-raid="ds">
                    <div class="icon">
                            <a href="/zone/dragon-soul/" data-zone="5892">ДД</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="mv expansion-4" data-raid="mv">
                    <div class="icon">
                            <a href="/zone/mogushan-vaults/" data-zone="6125">ПМ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="hf expansion-4" data-raid="hf">
                    <div class="icon">
                            <a href="/zone/heart-of-fear/" data-zone="6297">СС</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="tes expansion-4" data-raid="tes">
                    <div class="icon">
                            <a href="/zone/terrace-of-endless-spring/" data-zone="6067">ТВВ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="tot expansion-4" data-raid="tot">
                    <div class="icon">
                            <a href="/zone/throne-of-thunder/" data-zone="6622">ПГ</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="soo expansion-4" data-raid="soo">
                    <div class="icon">
                            <a href="/zone/siege-of-orgrimmar/" data-zone="6738">ОО</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="hm expansion-5" data-raid="hm">
                    <div class="icon">
                            <a href="/zone/highmaul/" data-zone="6996">Верховный молот</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="brf expansion-5" data-raid="brf">
                    <div class="icon">
                            <a href="/zone/blackrock-foundry/" data-zone="6967">Литейная клана Черной горы</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="hfc expansion-5" data-raid="hfc">
                    <div class="icon">
                            <a href="/zone/hellfire-citadel/" data-zone="7545">ЦАП</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="en expansion-6" data-raid="en">
                    <div class="icon">
                            <a href="/zone/the-emerald-nightmare/" data-zone="8026">ИК</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="tov expansion-6" data-raid="tov">
                    <div class="icon">
                            <a href="/zone/trial-of-valor/" data-zone="8440">ToV</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="nh expansion-6" data-raid="nh">
                    <div class="icon">
                            <a href="/zone/the-nighthold/" data-zone="8025">ЦН</a>
                    </div>
                </td>
                    <td class="spacer"><div></div></td>
                <td class="is expansion-6" data-raid="is">
                    <div class="icon">
                            <a href="/zone/tomb-of-sargeras/" data-zone="8524">ГС</a>
                    </div>
                </td>
            <td class="spacer-edge"><div></div></td>
        </tr>
            <tr class="lfr">
                <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
    <td data-raid="ds" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="mv" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="hf" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="tes" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="tot" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="soo" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="hm" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="brf" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="hfc" class="status status-in-progress"><div></div></td>
                        <td></td>
    <td data-raid="en" class="status status-in-progress"><div></div></td>
                        <td></td>
    <td data-raid="tov" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="nh" class="status status-incomplete"><div></div></td>
                        <td></td>
    <td data-raid="gs" class="status status-incomplete"><div></div></td>
            </tr>
        <tr class="normal">
            <td></td>
    <td data-raid="mc" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="bwl" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="aq10" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="aq40" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="kar" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="mag" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="gru" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="ssc" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tk" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="mh" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="bt" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="sp" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="voa" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="nax" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="os" class="status status-completed"><div></div></td>
                    <td></td>
    <td data-raid="eoe" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="uld" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="ony" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="toc" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="icc" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="rs" class="status status-completed"><div></div></td>
                    <td></td>
    <td data-raid="bh" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="bd" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="bot" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tfw" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="fl" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="ds" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="mv" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hf" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tes" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tot" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="soo" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hm" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="brf" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hfc" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="en" class="status status-in-progress"><div></div></td>
                    <td></td>
    <td data-raid="tov" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="nh" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="gs" class="status status-incomplete"><div></div></td>
        </tr>
        <tr class="heroic">
            <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
    <td data-raid="toc" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="icc" class="status status-in-progress"><div></div></td>
                    <td></td>
    <td data-raid="rs" class="status status-incomplete"><div></div></td>
                    <td></td>
                    <td></td>
                    <td></td>
    <td data-raid="bd" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="bot" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tfw" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="fl" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="ds" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="mv" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hf" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tes" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tot" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="soo" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hm" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="brf" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hfc" class="status status-in-progress"><div></div></td>
                    <td></td>
    <td data-raid="en" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tov" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="nh" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="gs" class="status status-incomplete"><div></div></td>
        </tr>
        <tr class="mythic">
            <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
    <td data-raid="soo" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hm" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="brf" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="hfc" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="en" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="tov" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="nh" class="status status-incomplete"><div></div></td>
                    <td></td>
    <td data-raid="gs" class="status status-incomplete"><div></div></td>
        </tr>
    </tbody>
            </table>

        </div>

    <span class="clear"><!-- --></span>
    </div>

    <div class="summary-raid-legend">
        <span class="completed">Завершено</span>
        <span class="in-progress">В процессе</span>
    </div>

        <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function() {
            new Summary.RaidProgression({ nTrivialRaids: 35, nOptimalRaids: 2, nChallengingRaids: 1  }, {
        mc: {
            name: "Огненные Недра",
            playerLevel: 60,
            nPlayers: 40,
            location: "Черная гора",
            expansion: 0,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Рагнарос", nKills: 0 }
]
        },
        bwl: {
            name: "Логово Крыла Тьмы",
            playerLevel: 60,
            nPlayers: 40,
            location: "Черная гора",
            expansion: 0,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Нефариан", nKills: 0 }
]
        },
        aq10: {
            name: "Руины Ан\'Киража",
            playerLevel: 60,
            nPlayers: 10,
            location: "Силитус",
            expansion: 0,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Оссириан Неуязвимый", nKills: 0 }
]
        },
        aq40: {
            name: "Храм Ан\'Киража",
            playerLevel: 60,
            nPlayers: 40,
            location: "Силитус",
            expansion: 0,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "К\'Тун", nKills: 0 }
]
        },
        kar: {
            name: "Каражан",
            playerLevel: 70,
            nPlayers: 10,
            location: "Перевал Мертвого Ветра",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Принц Малчезар", nKills: 0 }
]
        },
        mag: {
            name: "Логово Магтеридона",
            playerLevel: 70,
            nPlayers: 25,
            location: "Полуостров Адского Пламени",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Магтеридон", nKills: 0 }
]
        },
        gru: {
            name: "Логово Груула",
            playerLevel: 70,
            nPlayers: 25,
            location: "Острогорье",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Груул Драконобой", nKills: 0 }
]
        },
        ssc: {
            name: "Змеиное святилище",
            playerLevel: 70,
            nPlayers: 25,
            location: "Зангартопь",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Леди Вайш", nKills: 0 }
]
        },
        tk: {
            name: "Крепость Бурь",
            playerLevel: 70,
            nPlayers: 25,
            location: "Пустоверть",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Кель\'тас Солнечный Скиталец", nKills: 0 }
]
        },
        mh: {
            name: "Битва за гору Хиджал",
            playerLevel: 70,
            nPlayers: 25,
            location: "Пещеры Времени",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Архимонд", nKills: 0 }
]
        },
        bt: {
            name: "Черный храм",
            playerLevel: 70,
            nPlayers: 25,
            location: "Долина Призрачной Луны",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Иллидан Ярость Бури", nKills: 0 }
]
        },
        sp: {
            name: "Солнечный Колодец",
            playerLevel: 70,
            nPlayers: 25,
            location: "Остров Кель\'Данас",
            expansion: 1,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Кил\'джеден", nKills: 0 }
]
        },
        voa: {
            name: "Склеп Аркавона",
            playerLevel: 80,
            nPlayers: -10,
            location: "Озеро Ледяных Оков",
            expansion: 2,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Аркавон Страж Камня", nKills: 0 },
            { name: "Эмалон Страж Бури", nKills: 0 },
            { name: "Коралон Страж Огня", nKills: 0 },
            { name: "Торавон Страж Льда", nKills: 0 }
]
        },
        nax: {
            name: "Наксрамас",
            playerLevel: 80,
            nPlayers: -10,
            location: "Драконий Погост",
            expansion: 2,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Ануб\'Рекан", nKills: 0 },
            { name: "Великая вдова Фарлина", nKills: 0 },
            { name: "Мексна", nKills: 0 },
            { name: "Нот Чумной", nKills: 0 },
            { name: "Хейган Нечестивый", nKills: 0 },
            { name: "Лотхиб", nKills: 0 },
            { name: "Инструктор Разувий", nKills: 0 },
            { name: "Готик Жнец", nKills: 0 },
            { name: "Четыре всадника", nKills: 0 },
            { name: "Лоскутик", nKills: 0 },
            { name: "Гроббулус", nKills: 0 },
            { name: "Глут", nKills: 0 },
            { name: "Таддиус", nKills: 0 },
            { name: "Сапфирон", nKills: 0 },
            { name: "Кел\'Тузад", nKills: 0 }
]
        },
        os: {
            name: "Обсидиановое святилище",
            playerLevel: 80,
            nPlayers: -10,
            location: "Драконий Погост",
            expansion: 2,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Сартарион", nKills: 1 }
]
        },
        eoe: {
            name: "Око Вечности",
            playerLevel: 80,
            nPlayers: -10,
            location: "Борейская тундра",
            expansion: 2,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Малигос", nKills: 0 }
]
        },
        uld: {
            name: "Ульдуар",
            playerLevel: 80,
            nPlayers: -10,
            location: "Грозовая гряда",
            expansion: 2,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Огненный Левиафан", nKills: 0 },
            { name: "Повелитель Горнов Игнис", nKills: 0, optional: true },
            { name: "Острокрылая", nKills: 0, optional: true },
            { name: "Разрушитель XT-002", nKills: 0 },
            { name: "Железное Собрание", nKills: 0 },
            { name: "Кологарн", nKills: 0 },
            { name: "Ауриайя", nKills: 0 },
            { name: "Ходир", nKills: 0 },
            { name: "Торим", nKills: 0 },
            { name: "Фрейя", nKills: 0 },
            { name: "Мимирон", nKills: 0 },
            { name: "Генерал Везакс", nKills: 0 },
            { name: "Йогг-Сарон", nKills: 0 },
            { name: "Алгалон Наблюдатель", nKills: 0, optional: true }
]
        },
        ony: {
            name: "Логово Ониксии",
            playerLevel: 80,
            nPlayers: -10,
            location: "Пылевые топи",
            expansion: 0,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Ониксия", nKills: 0 }
]
        },
        toc: {
            name: "Испытание крестоносца",
            playerLevel: 80,
            nPlayers: -10,
            location: "Ледяная Корона",
            expansion: 2,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Чудовища Нордскола", nKills: 0, nHeroicKills: 0 },
            { name: "Лорд Джараксус", nKills: 0, nHeroicKills: 0 },
            { name: "Чемпионы фракций", nKills: 0, nHeroicKills: 0 },
            { name: "Валь\'киры-близнецы", nKills: 0, nHeroicKills: 0 },
            { name: "Ануб\'арак", nKills: 0, nHeroicKills: 0 }
]
        },
        icc: {
            name: "Цитадель Ледяной Короны",
            playerLevel: 80,
            nPlayers: -10,
            location: "Ледяная Корона",
            expansion: 2,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Лорд Ребрад", nKills: 0, nHeroicKills: 1 },
            { name: "Леди Смертный Шепот", nKills: 0, nHeroicKills: 1 },
            { name: "Битва на кораблях в Ледяной Короне", nKills: 0, nHeroicKills: 1 },
            { name: "Саурфанг Смертоносный", nKills: 0, nHeroicKills: 1 },
            { name: "Гниломорд", nKills: 0, nHeroicKills: 1 },
            { name: "Тухлопуз", nKills: 0, nHeroicKills: 1 },
            { name: "Профессор Мерзоцид", nKills: 0, nHeroicKills: 1 },
            { name: "Кровавый Совет", nKills: 0, nHeroicKills: 1 },
            { name: "Кровавая королева Лана\'тель", nKills: 0, nHeroicKills: 1 },
            { name: "Валитрия Сноходица", nKills: 0, nHeroicKills: 0 },
            { name: "Синдрагоса", nKills: 0, nHeroicKills: 1 },
            { name: "Король-лич", nKills: 0, nHeroicKills: 1 }
]
        },
        rs: {
            name: "Рубиновое святилище",
            playerLevel: 80,
            nPlayers: -10,
            location: "Драконий Погост",
            expansion: 2,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Халион", nKills: 1, nHeroicKills: 0 }
]
        },
        bh: {
            name: "Крепость Барадин",
            playerLevel: 85,
            nPlayers: -10,
            location: "Тол Барад",
            expansion: 3,
            heroicMode: false,
            mythicMode: false,
            bosses: 	[
            { name: "Аргалот", nKills: 0 },
            { name: "Оку\'тар", nKills: 0 },
            { name: "Ализабаль", nKills: 0 }
]
        },
        bd: {
            name: "Твердыня Крыла Тьмы",
            playerLevel: 85,
            nPlayers: -10,
            location: "Черная гора",
            expansion: 3,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Защитная система \"Омнитрон\"", nKills: 0, nHeroicKills: 0 },
            { name: "Магмарь", nKills: 0, nHeroicKills: 0 },
            { name: "Атрамед", nKills: 0, nHeroicKills: 0 },
            { name: "Химерон", nKills: 0, nHeroicKills: 0 },
            { name: "Малориак", nKills: 0, nHeroicKills: 0 },
            { name: "Гибель Нефариана", nKills: 0, nHeroicKills: 0 }
]
        },
        bot: {
            name: "Сумеречный бастион",
            playerLevel: 85,
            nPlayers: -10,
            location: "Сумеречное нагорье",
            expansion: 3,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Халфий Змеерез", nKills: 0, nHeroicKills: 0 },
            { name: "Тералион и Валиона", nKills: 0, nHeroicKills: 0 },
            { name: "Совет Перерожденных", nKills: 0, nHeroicKills: 0 },
            { name: "Чо\'Галл", nKills: 0, nHeroicKills: 0 },
            { name: "Синестра", nHeroicKills: 0, optional: true }
]
        },
        tfw: {
            name: "Трон Четырех Ветров",
            playerLevel: 85,
            nPlayers: -10,
            location: "Ульдум",
            expansion: 3,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Конклав ветра", nKills: 0, nHeroicKills: 0 },
            { name: "Ал\'акир", nKills: 0, nHeroicKills: 0 }
]
        },
        fl: {
            name: "Огненные Просторы",
            playerLevel: 85,
            nPlayers: -10,
            location: "Гора Хиджал",
            expansion: 3,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Бет\'тилак", nKills: 0, nHeroicKills: 0 },
            { name: "Повелитель Риолит", nKills: 0, nHeroicKills: 0 },
            { name: "Шэннокс", nKills: 0, nHeroicKills: 0 },
            { name: "Алисразор", nKills: 0, nHeroicKills: 0 },
            { name: "Бейлрок, привратник", nKills: 0, nHeroicKills: 0 },
            { name: "Мажордом Фэндрал Олений Шлем", nKills: 0, nHeroicKills: 0 },
            { name: "Рагнарос", nKills: 0, nHeroicKills: 0 }
]
        },
        ds: {
            name: "Душа Дракона",
            playerLevel: 85,
            nPlayers: -10,
            location: "Душа Дракона",
            expansion: 3,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Морхок", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Полководец Зон\'озз", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Йор\'садж Неспящий", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Хагара Владычица Штормов", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Ультраксион", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Воевода Черный Рог", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Хребет Смертокрыла", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Безумие Смертокрыла", nLfrKills: 0, nKills: 0, nHeroicKills: 0 }
]
        },
        mv: {
            name: "Подземелья Могу\'шан",
            playerLevel: 90,
            nPlayers: -10,
            location: "Вершина Кунь-Лай",
            expansion: 4,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Каменные стражи", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Фэн Проклятый", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Душелов Гара\'джал", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Призрачные короли", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Элегон", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Воля императора", nLfrKills: 0, nKills: 0, nHeroicKills: 0 }
]
        },
        hf: {
            name: "Сердце Страха",
            playerLevel: 90,
            nPlayers: -10,
            location: "Жуткие пустоши",
            expansion: 4,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Императорский визирь Зор\'лок", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Повелитель клинков Та\'як", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Гаралон", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Повелитель ветров Мел\'джарак", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Ваятель янтаря Ун\'сок", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Великая императрица Шек\'зир", nLfrKills: 0, nKills: 0, nHeroicKills: 0 }
]
        },
        tes: {
            name: "Терраса Вечной Весны",
            playerLevel: 90,
            nPlayers: -10,
            location: "Сокрытая лестница",
            expansion: 4,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Вечные защитники", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Цулон", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Лэй Ши", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Ша Страха", nLfrKills: 0, nKills: 0, nHeroicKills: 0 }
]
        },
        tot: {
            name: "Престол Гроз",
            playerLevel: 90,
            nPlayers: -10,
            location: "Остров Грома",
            expansion: 4,
            heroicMode: true,
            mythicMode: false,
            bosses: 	[
            { name: "Джин\'рок Разрушитель", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Хорридон", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Совет старейшин", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Тортос", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Мегера", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Цзи-Кунь", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Дуруму Позабытый", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Изначалий", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Темный Анимус", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Кон Железный", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Наложницы-близнецы", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Лэй Шэнь", nLfrKills: 0, nKills: 0, nHeroicKills: 0 },
            { name: "Ра-ден", nHeroicKills: 0, optional: true }
]
        },
        soo: {
            name: "Осада Оргриммара",
            playerLevel: 90,
            nPlayers: -20,
            location: "Оргриммар",
            expansion: 4,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Глубиний", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Павшие защитники", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Норусхен", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ша Гордыни", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Галакрас", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Железный исполин", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Кор\'кронские темные шаманы", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Генерал Назгрим", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Малкорок", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Пандарийские трофеи", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ток Кровожадный", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Мастер осады Черноплавс", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Идеалы клакси", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Гаррош Адский Крик", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 }
]
        },
        hm: {
            name: "Земли клана Верховного Молота",
            playerLevel: 100,
            nPlayers: -20,
            location: "Награнд",
            expansion: 5,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Каргат Острорук", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Мясник", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Бурогриб", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Тектоник", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Огроны-близнецы", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ко\'раг", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Император Мар\'гок", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 }
]
        },
        brf: {
            name: "Литейная клана Черной горы",
            playerLevel: 100,
            nPlayers: -20,
            location: "Горгронд",
            expansion: 5,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Рудожуй", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Груул", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Горнило", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ганс\'гар и Франзок", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ка\'граз Пламенная", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Кромог", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Дармак Повелитель Зверей", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Оператор Тогар", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Железные леди", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Чернорук", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 }
]
        },
        hfc: {
            name: "Цитадель Адского Пламени",
            playerLevel: 100,
            nPlayers: -20,
            location: "Танаанские джунгли",
            expansion: 5,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Штурм Цитадели Адского Пламени", nLfrKills: 0, nKills: 0, nHeroicKills: 3, nMythicKills: 0 },
            { name: "Железный разоритель", nLfrKills: 0, nKills: 0, nHeroicKills: 1, nMythicKills: 0 },
            { name: "Кормрок", nLfrKills: 0, nKills: 0, nHeroicKills: 1, nMythicKills: 0 },
            { name: "Килрогг Мертвый Глаз", nLfrKills: 0, nKills: 0, nHeroicKills: 1, nMythicKills: 0 },
            { name: "Верховный совет Адского Пламени", nLfrKills: 0, nKills: 0, nHeroicKills: 1, nMythicKills: 0 },
            { name: "Кровожад", nLfrKills: 0, nKills: 0, nHeroicKills: 1, nMythicKills: 0 },
            { name: "Повелитель теней Искар", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Сокретар Вечный", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Деспотичная Велари", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Повелитель Скверны Закуун", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ксул\'горак", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Маннорот", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Архимонд", nLfrKills: 2, nKills: 0, nHeroicKills: 1, nMythicKills: 0 }
]
        },
        en: {
            name: "Изумрудный Кошмар",
            playerLevel: 110,
            nPlayers: -20,
            location: "Изумрудный Кошмар",
            expansion: 6,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Низендра", nLfrKills: 1, nKills: 1, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Элерет Дикая Лань", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ил\'гинот, Сердце Порчи", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Урсок", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Драконы Кошмара", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Кенарий", nLfrKills: 1, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Ксавий", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 }
]
        },
        tov: {
            name: "Испытание доблести",
            playerLevel: 110,
            nPlayers: -20,
            location: "Хельхейм",
            expansion: 6,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Один", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Гарм", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Хелия", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 }
]
        },
        nh: {
            name: "Цитадель Ночи",
            playerLevel: 110,
            nPlayers: -20,
            location: "Сурамар",
            expansion: 6,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Скорпирон", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Хрономатическая аномалия", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Триллиакс", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Заклинательница клинков Алуриэль", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Тихондрий", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Крос", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Верховный ботаник Тел\'арн", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Звездный авгур Этрей", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Великий магистр Элисанда", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Гул\'дан", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 }
]
        },
        gs: {
            name: "Гробница Саргераса",
            playerLevel: 110,
            nPlayers: -20,
            location: "Расколотый берег",
            expansion: 6,
            heroicMode: true,
            mythicMode: true,
            bosses: 	[
            { name: "Горот", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Демоническая инквизиция", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Харджатан", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Сестры Луны", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Госпожа Сашж\'ин", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Сонм страданий", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Бдительная дева", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Аватара Падшего", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 },
            { name: "Кил\'джеден", nLfrKills: 0, nKills: 0, nHeroicKills: 0, nMythicKills: 0 }
]
        }
            });
        });
        //]]>
        </script>
                        </div>
                    </div>    <span class="clear"><!-- --></span>

                <div class="summary-lastupdate">
                    Последнее обновление: 15/12/2016
                </div>

            </div>


        </div>

    <span class="clear"><!-- --></span>
    </div>

        <script type="text/javascript">
        //<![CDATA[
        $(function() {
            Profile.url = '/wow/ru/character/%D1%81%D1%82%D1%80%D0%B0%D0%B6-%D1%81%D0%BC%D0%B5%D1%80%D1%82%D0%B8/%D0%9F%D1%80%D0%BE%D0%BA%D0%BB%D1%8F%D1%82%D1%8B%D0%B9%D1%8F/summary';
        });

            var MsgProfile = {
                tooltip: {
                    feature: {
                        notYetAvailable: "Эта функция пока недоступна."
                    },
                    vault: {
                        character: "Этот раздел доступен только для авторизованных пользователей.",
                        guild: "Этот раздел доступен, только если вы авторизовались с персонажа — члена данной гильдии."
                    }
                }
            };
        //]]>
        </script>

                <script type="text/javascript">
        //<![CDATA[
        var MsgSummary = {
            inventory: {
                slots: {
                    1: "Голова",
                    2: "Шея",
                    3: "Плечи",
                    4: "Рубашка",
                    5: "Грудь",
                    6: "Пояс",
                    7: "Ноги",
                    8: "Ступни",
                    9: "Запястья",
                    10: "Руки",
                    11: "Палец",
                    12: "Аксессуар",
                    15: "Дальний бой",
                    16: "Спина",
                    19: "Гербовая накидка",
                    21: "Правая рука",
                    22: "Левая рука",
                    28: "Реликвия",
                    empty: "Эта ячейка пуста"
                }
            },
            audit: {
                whatIsThis: "С помощью этой функции вы можете узнать, как улучшить характеристики своего персонажа. Функция ищет:<br /><br />- пустые ячейки символов;<br />- неиспользованные очки талантов;<br />- незачарованные предметы;<br />- пустые гнезда для самоцветов;<br />- неподходящую броню;<br />- отсутствующую пряжку в поясе;<br />- отсутствующие бонусы за профессии.",
                missing: "Не хватает: {0}",
                enchants: {
                    tooltip: "Не зачаровано"
                },
                sockets: {
                    singular: "пустое гнездо",
                    plural: "пустых гнезда"
                },
                armor: {
                    tooltip: "Не {0}",
                    1: "Ткань",
                    2: "Кожа",
                    3: "Кольчуга",
                    4: "Латы"
                },
                lowLevel: {
                    tooltip: "Низкий уровень"
                },
                blacksmithing: {
                    name: "Кузнечное дело",
                    tooltip: "Отсутствует гнездо"
                },
                enchanting: {
                    name: "Наложение чар",
                    tooltip: "Не зачаровано"
                },
                engineering: {
                    name: "Инженерное дело",
                    tooltip: "Нет улучшения"
                },
                inscription: {
                    name: "Начертание",
                    tooltip: "Не зачаровано"
                },
                leatherworking: {
                    name: "Кожевенное дело",
                    tooltip: "Не зачаровано"
                }
            },
            talents: {
                specTooltip: {
                    title: "Специализация",
                    primary: "Основная:",
                    secondary: "Второстепенная:",
                    active: "Активная"
                }
            },
            stats: {
                toggle: {
                    all: "Показать все характеристики",
                    core: "Показать только основные характеристики"
                },
                increases: {
                    attackPower: "Увеличивает силу атаки на {0}.",
                    critChance: "Увеличивает шанс критического удара {0}%.",
                    spellCritChance: "Увеличивает шанс нанесения критического урона магией на {0}%.",
                    spellPower: "Увеличивает силу заклинаний на {0}.",
                    health: "Увеличивает здоровье на {0}.",
                    mana: "Увеличивает количество маны на {0}.",
                    manaRegen: "Увеличивает восполнение маны на {0} ед. каждые 5 сек., пока не произносятся заклинания.",
                    meleeDps: "Увеличивает урон, наносимый в ближнем бою, на {0} ед. в секунду.",
                    rangedDps: "Увеличивает урон, наносимый в дальнем бою, на {0} ед. в секунду.",
                    petArmor: "Увеличивает броню питомца на {0} ед.",
                    petAttackPower: "Увеличивает силу атаки питомца на {0} ед.",
                    petSpellDamage: "Увеличивает урон от заклинаний питомца на {0} ед.",
                    petAttackPowerSpellDamage: "Увеличивает силу атаки питомца на {0} ед. и урон от его заклинаний на {1} ед."
                },
                decreases: {
                    damageTaken: "Снижает получаемый физический урон на {0}%.",
                    enemyRes: "Снижает сопротивляемость противника на {0} ед.",
                    dodgeParry: "Снижает вероятность того, что ваш удар будет парирован или от вашего удара уклонятся, на {0}%."
                },
                noBenefits: "Не предоставляет бонусов вашему классу.",
                beforeReturns: "(До снижения действенности повторяющихся эффектов)",
                damage: {
                    speed: "Скорость атаки (сек.):",
                    damage: "Урон:",
                    dps: "Урон в сек.:"
                },
                averageItemLevel: {
                    title: "Уровень предмета {0}",
                    description: "Средний уровень вашего лучшего снаряжения. С его повышением вы сможете вставать в очередь в более сложные для прохождения подземелья."
                },
                health: {
                    title: "Здоровье {0}",
                    description: "Максимальный запас здоровья. Когда запас здоровья падает до нуля, вы погибаете."
                },
                mana: {
                    title: "Мана {0}",
                    description: "Максимальный запас маны. Мана расходуется на произнесение заклинаний."
                },
                rage: {
                    title: "Ярость {0}",
                    description: "Максимальный запас ярости. Ярость расходуется при применении способностей и накапливается, когда персонаж атакует врагов или получает урон."
                },
                focus: {
                    title: "Концентрация {0}",
                    description: "Максимальный уровень концентрации. Концентрация понижается при применении способностей и повышается со временем."
                },
                energy: {
                    title: "Энергия {0}",
                    description: "Максимальный запас энергии. Энергия расходуется при применении способностей и восстанавливается со временем."
                },
                runic: {
                    title: "Сила рун {0}",
                    description: "Максимальный запас силы рун."
                },
                maelstrom: {
                    title: "Энергия Водоворота: {0}",
                    description: "Ваш максимальный показатель энергии Водоворота."
                },
                insanity: {
                    title: "Безумие {0}",
                    description: "Ваш максимальный показатель безумия."
                },
                fury: {
                    title: "Гнев {0}",
                    description: "Ваш максимальный показатель гнева."
                },
                pain: {
                    title: "Боль {0}",
                    description: "Ваш максимальный показатель боли."
                },
                strength: {
                    title: "Сила{0}"
                },
                agility: {
                    title: "Ловкость {0}"
                },
                stamina: {
                    title: "Выносливость {0}"
                },
                intellect: {
                    title: "Интеллект {0}"
                },
                mastery: {
                    title: "Искусность {0}",
                    description: "Рейтинг искусности {0} увеличивает значение искусности на {1}% ед.",
                    unknown: "Вы должны сперва изучить искусность у учителя.",
                    unspecced: "Выберите специализацию, чтобы активировать бонус рейтинга искусности. "
                },
                crit: {
                    title: "Критический удар {0}%",
                    description: "Вероятность нанести дополнительный урон и восстановить дополнительное здоровье.",
                    description2: "Показатель критического удара: {0} [+{1}%]"
                },
                haste: {
                    title: "Скорость +{0}%",
                    description: "Увеличивает скорость атаки и применения заклинаний.",
                    description2: "Скорость: {0} [+{1}%]"
                },
                meleeDps: {
                    title: "Урон в секунду"
                },
                meleeSpeed: {
                    title: "Скорость атаки в ближнем бою {0}"
                },
                meleeHaste: {
                    title: "Скорость в ближнем бою {0}%",
                    description: "Рейтинг {0} увеличивает скорость атаки на {1}%.",
                    description2: "Увеличивает скорость атаки в ближнем бою."
                },
                meleeHit: {
                    title: "Рейтинг меткости в ближнем бою {0}%",
                    description: "Рейтинг {0} увеличивает шанс попадания на {1}%."
                },
                meleeCrit: {
                    title: "Рейтинг критического удара в ближнем бою {0}%",
                    description: "Рейтинг {0} увеличивает шанс нанести критический удар {1}%.",
                    description2: "Шанс нанести дополнительный урон в ближнем бою."
                },
                expertise: {
                    title: "Мастерство {0}",
                    description: "Рейтинг {0} увеличивает значение мастерства на {1} ед."
                },
                rangedDps: {
                    title: "Урон в секунду"
                },
                rangedSpeed: {
                    title: "Скорость атаки в дальнем бою {0}"
                },
                rangedHaste: {
                    title: "Скорость в дальнем бою {0}%",
                    description: "Рейтинг {0} увеличивает скорость атаки на {1}%.",
                    description2: "Увеличивает скорость атаки в дальнем бою."
                },
                rangedHit: {
                    title: "Рейтинг меткости в дальнем бою {0}%",
                    description: "Рейтинг {0} увеличивает шанс попадания на {1}%."
                },
                rangedCrit: {
                    title: "Рейтинг критического удара в дальнем бою {0}%",
                    description: "Рейтинг {0} увеличивает шанс нанести критический удар {1}%.",
                    description2: "Шанс нанести дополнительный урон в дальнем бою."
                },
                spellHaste: {
                    title: "Скорость произнесения заклинаний {0}%",
                    description: "Рейтинг {0} увеличивает скорость произнесения заклинаний на {1}%.",
                    description2: "Увеличивает скорость произнесения заклинаний."
                },
                spellHit: {
                    title: "Вероятность попадания заклинанием {0}%",
                    description: "Рейтинг меткости {0} увеличивает шанс попадания на {1}%."
                },
                spellCrit: {
                    title: "Вероятность критического эффекта заклинания {0}%",
                    description: "Рейтинг критического удара {0} увеличивает шанс нанести критический удар {1}%.",
                    description2: "Шанс нанести заклинанием дополнительный урон или исцеление."
                },
                manaRegen: {
                    title: "Восполнение маны",
                    description: "{0} ед. маны восполняется раз в 5 сек. вне боя."
                },
                combatRegen: {
                    title: "Восполнение в бою",
                    description: "{0} ед. маны восполняется раз в 5 сек. в бою."
                },
                armor: {
                    title: "Броня {0}"
                },
                dodge: {
                    title: "Шанс уклонения {0}%",
                    description: "Рейтинг {0} увеличивает шанс уклониться от удара на {1}%."
                },
                parry: {
                    title: "Шанс парировать удар {0}%",
                    description: "Рейтинг  {0} увеличивает шанс парировать удар на {1}%."
                },
                block: {
                    title: "Шанс блокирования {0}%",
                    description: "Рейтинг  {0} увеличивает шанс блокировать удар на {1}%.",
                    description2: "Блокирование останавливает {0}% наносимого вам урона."
                },
                resilience: {
                    title: "PvP-устойчивость {0}%",
                    description: "Снижает урон, наносимого вам другими игроками и их питомцами или прислужниками.",
                    description2: "Рейтинг устойчивости {0} (увеличивает значение устойчивости на {1}% ед.)"
                },
                pvppower: {
                    title: "PvP-сила {0}%",
                    description: "Увеличивает урон, наносимый игрокам и их питомцам и прислужникам, а также повышает эффективность лечения, применяемого в PvP-зонах.",
                    description2: "Рейтинг силы {0}",
                    description3: "+{0}% к лечению",
                    description4: "+{0}% к урону"
                },
                arcaneRes: {
                    title: "Сопротивление тайной магии {0}",
                    description: "Снижает урон от тайной магии в среднем на {0}%."
                },
                fireRes: {
                    title: "Сопротивление магии огня {0}",
                    description: "Снижает урон от магии огня в среднем на {0}%."
                },
                frostRes: {
                    title: "Сопротивление магии льдя {0}",
                    description: "Снижает урон от магии льдя в среднем на {0}%."
                },
                natureRes: {
                    title: "Сопротивление силам природы {0}",
                    description: "Снижает урон от сил природы в среднем на {0}%."
                },
                shadowRes: {
                    title: "Сопротивление темной магии {0}",
                    description: "Снижает урон от темной магии в среднем на {0}%."
                },
                leech: {
                    title: "Cамоисцеление {0}%",
                    description: "Часть нанесенного вами урона и произведенного исцеления возвращается вам в виде здоровья.",
                    description2: "Cамоисцеление: {0} [+{1}%]"
                },
                versatility: {
                    title: "Универсальность {0}%/{1}%",
                    description: "Увеличивает наносимый урон и эффективность исцеления на {0}% и уменьшает получаемый урон на {1}%.",
                    description2: "Показатель универсальности: {0} [{1}%/{2}%]"
                },
                avoidance: {
                    title: "Избегание {0}%",
                    description: "Уменьшает урон от заклинаний с действием по области.",
                    description2: "Показатель избегания: {0} [+{1}%]"
                }
            },
            recentActivity: {
                subscribe: "Подписаться на эту ленту новостей"
            },
            raid: {
                tooltip: {
                    lfr: "(СПР)",
                    flex: "(Гибкий)",
                    normal: "(норм.)",
                    heroic: "(героич.)",
                    mythic: "(эпохальный)",
                    complete: "{0}% завершено ({1}/{2})",
                    optional: "(на выбор)"
                    }
                },
            links: {
                tools: "Инструментарий",
                saveImage: "Сохранить изображение персонажа",
                saveimageTitle: "Сохранить изображение персонажа для дальнейшего использования на кредитной карте World of Warcraft Rewards Visa."
                }
        };
        //]]>
        </script>

</div>
</div>
</div>
 @endsection