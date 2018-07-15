<div class="SiteNav">
    <div class="Sticky SiteNav-sticky">
        <div class="Sticky-content">
            <div class="SiteNav-area">
                <div class="SiteNav-bar">
                    <div class="SiteNav-menu">
                        <a class="Link Link--block SiteNav-logo" href="{{ route('home') }}" data-analytics="main-nav" data-analytics-placement="Logo" tabIndex="2">
                            <div class="Logo Logo--wow SiteNav-logo-full"></div>
                            <div class="Logo Logo--wowIcon SiteNav-logo-icon"></div>
                        </a>
                        <div class="SiteNav-sectionLeft">
                            <div class="SiteNav-menuList List">
                                <div class="SiteNav-menuListItem List-item">
                                    <a class="Link Link--block SiteNav-menuListLink" data-dropdown="SiteNav-game">
                                        <div class="DropdownLink DropdownLink--gold DropdownLink--goldWithHover text-upper no-focus" tabIndex="2">
                                            <span class="SiteNav-menuListLinkText" data-text="@lang('navbar.Navbar-game-mobile')">@lang('navbar.Navbar-game-mobile')</span>
                                            <span class="SiteNav-dropdownIndicator DropdownLink-indicator"></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="SiteNav-menuListItem List-item">
                                    <a class="Link Link--block SiteNav-menuListLink text-upper no-focus" href="{{ route('news.index') }}" data-analytics="main-nav" data-analytics-placement="News" tabIndex="2"><span class="SiteNav-menuListLinkText" data-text="@lang('navbar.Navbar-news')">@lang('navbar.Navbar-news')</span>
                                    </a>
                                </div>
                                <div class="SiteNav-menuListItem List-item">
                                    <a class="Link Link--block SiteNav-menuListLink text-upper no-focus" href="{{ route('forums') }}" data-analytics="main-nav" data-analytics-placement="Forums" tabIndex="2"><span class="SiteNav-menuListLinkText" data-text="@lang('navbar.Navbar-forums')">@lang('navbar.Navbar-forums')</span>
                                    </a>
                                </div>
                                <div class="SiteNav-menuListItem List-item">
                                    <a class="Link Link--block SiteNav-menuListLink text-upper no-focus" href="{{ route('shop') }}" data-analytics="shop-link" data-analytics-placement="Shop || Nav" tabIndex="2"><span class="SiteNav-menuListLinkText" data-text="@lang('navbar.Navbar-shop')">@lang('navbar.Navbar-shop')</span></a>
                                </div>
                            </div>
                        </div>
                    <div class="SiteNav-sectionRight">
                        <div class="SiteNav-menuList List">
                            <div class="SiteNav-menuListItem List-item">
                                    @php
                                    $online = App\Services\Server::playersOnline();
                                    @endphp
                                <a class="Link Link--block SiteNav-menuListLink text-upper no-focus" href="{{ route('community-status') }}">
                                    <span class="SiteNav-menuListLinkText" data-text="Онлайн Игроки">Онлайн: {{ $online->alliance + $online->horde ?: '0' }}</span>
                                </a>
                                </div>
                            <div class="SiteNav-menuListItem SiteNav-menuListItem--search List-item">
                                <a class="Link Link--block SiteNav-menuListLink SiteNav-searchLink no-focus" data-dropdown="SiteNav-search" tabIndex="1">
                                    <span class="Icon Icon--searchGold SiteNav-searchOpen"></span>
                                    <span class="Icon Icon--close SiteNav-searchClose">
                                        <svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64">
                                            <use xlink:href="/static/components/Icon/Icon.svg#close"></use>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            @guest
                            <div class="SiteNav-menuListItem List-item"><a class="Link Link--block SiteNav-menuListLink text-upper" href="{{ route('login') }}" data-analytics="main-nav" data-analytics-placement="Community - Log In"><span class="SiteNav-menuListLinkText" data-text="@lang('navbar.Navbar-accountDropdownButtonLink')">@lang('navbar.Navbar-accountDropdownButtonLink')</span></a></div>
                            <div class="SiteNav-menuListItem SiteNav-menuListItem--user List-item"><div class="SiteNav-menuListItemWrap"><a class="Link Link--block SiteNav-menuListLink text-upper" href="{{ route('register') }}" data-analytics="account-creation-link" data-analytics-placement="Nav"><span class="SiteNav-menuListLinkText" data-text="@lang('navbar.Navbar-accountCreateLinkLabel')">@lang('navbar.Navbar-accountCreateLinkLabel')</span></a></div></div>
                            @else
                            @if(count(\App\Account::userGameCharacters(\App\Account::userGameAccount()[0]->id)))
                                @if(Auth::user()->charactersActive === NULL)
                                    @php
                                    $user = \Auth::user();
                                    $user->charactersActive = \App\Account::userGameCharacters(\App\Account::userGameAccount()[0]->id)[0]->guid;
                                    $user->save();
                                    @endphp
                                @else
    							    @include('layouts.navbar.characters', ['active' => \App\Characters::activeUserCharacters(Auth::user()->charactersActive)])
                                @endif
                            @else
                            <div class="SiteNav-menuListItem SiteNav-menuListItem--user SiteNav-menuListItem--userLoggedIn List-item">
                                <div class="SiteNav-menuListItemWrap">
                                    <div class="List">
                                        <div class="List-item">
                                            <a class="Link Link--block" href="/">
                                                <div class="Avatar Avatar--goldLarge SiteNav-avatar">
                        <div class="Avatar-image" style="background-image:url(&quot;{{ asset('/uploads/avatar/'.Auth::user()->avatar) }}&quot;);"></div>
                    </div>
                                            </a>
                                        </div>
                                        <div class="List-item">
                                            <a class="Link SiteNav-menuListLink" data-dropdown="SiteNav-user" tabIndex="2">
                                                <div class="DropdownLink DropdownLink--gold DropdownLink--goldWithHover">
                                                    <span class="SiteNav-menuListLinkText" data-text="{{ Auth::user()->email }}">{{ Auth::user()->email }}</span>
                                                    <span class="SiteNav-dropdownIndicator DropdownLink-indicator"></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    <div class="Dropdown SiteNav-doormat" name="SiteNav-game">
        <div class="SiteNav-doormatContent">
            <div class="Grid Grid--gutters">
                <div class="Grid-1of3" media-wide="!hide Grid-1of4">
                    <div class="List List--full List--vertical List--separator List--separatorBrownMedium">
                        <div class="List-item gutter-tiny gutter-vertical">
                            <div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-game-process')</div>
                        </div>
                        <div class="List-item gutter-tiny gutter-vertical">
                            <div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="/ru-ru/game/races" data-analytics="main-nav" data-analytics-placement="Game - Gameplay - Races">@lang('navbar.Navbar-races')</a></div>
                            <div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="/ru-ru/game/classes" data-analytics="main-nav" data-analytics-placement="Game - Gameplay - Classes">@lang('navbar.Navbar-classes')</a></div>
                            <div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="{{ route('community-status') }}" data-analytics="main-nav" data-analytics-placement="Game - Gameplay - Realm Status">@lang('navbar.Navbar-status')</a></div>
                        </div>
                    </div>
                </div>
            <div class="Grid-1of3" media-wide="!hide Grid-1of4"><div class="List List--full List--vertical List--separator List--separatorBrownMedium"><div class="List-item gutter-tiny gutter-vertical"><div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-game-indicator')</div></div><div class="List-item gutter-tiny gutter-vertical"><div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="{{ route('community-start') }}" data-analytics="main-nav" data-analytics-placement="Game - Guides - New Players">@lang('navbar.Navbar-new-players-guide')</a></div><div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="{{ route('community-return') }}" data-analytics="main-nav" data-analytics-placement="Game - Guides - Returning Players">@lang('navbar.Navbar-returning-players-guide')</a></div></div></div></div>
            <div class="Grid-1of3" media-wide="!hide Grid-1of4"><div class="List List--full List--vertical List--separator List--separatorBrownMedium"><div class="List-item gutter-tiny gutter-vertical"><div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-competitive-game')</div></div><div class="List-item gutter-tiny gutter-vertical"><div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="/ru-ru/game/pve/leaderboards" data-analytics="main-nav" data-analytics-placement="Game - Gameplay - Mythic Leaderboards">@lang('navbar.Navbar-mythic-leaderboards')</a></div><div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="/ru-ru/game/pvp/leaderboards/3v3" data-analytics="main-nav" data-analytics-placement="Game - Gameplay - Leaderboards">@lang('navbar.Navbar-leaderboards-pvp')</a></div></div></div></div>
            <div class="hide" media-wide="!hide Grid-1of4"><div class="List List--full List--vertical List--separator List--separatorBrownMedium"><div class="List-item gutter-tiny gutter-vertical"><div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-download')</div></div><div class="List-item gutter-tiny gutter-vertical"><div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="{{ asset('uploads/file/PatchEG.zip') }}" data-analytics="Game - Expansions - Battle for Azeroth" data-analytics-placement="main-nav">@lang('navbar.Navbar-download-1')</a></div><div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="{{ asset('uploads/file/Blizzard.zip') }}" data-analytics="Game - Expansions - Legion" data-analytics-placement="main-nav">@lang('navbar.Navbar-download-2')</a></div></div></div></div>
            </div>
        </div>
    </div>

<div class="Dropdown SiteNav-doormat SiteNav-searchDropdown" name="SiteNav-search">
    <div class="SiteNav-doormatContent">
        <form class="SiteNav-searchBox" action="/search" method="GET">
            <span class="Icon Icon--searchGold SiteNav-searchIcon"></span>
            <input class="SiteNav-searchInput" id="searchInput" name="q" type="search" placeholder="@lang('navbar.Navbar-search')" autocomplete="off" tabIndex="1"/>
        </form>
    <div class="space-medium"></div>
        <div class="Grid Grid--gutters">
            <div class="Grid-1of3" media-wide="!hide Grid-1of4">
                <div class="List List--full List--vertical List--separator List--separatorBrownMedium">
                    <div class="List-item gutter-tiny gutter-vertical">
                        <div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-game-indicator')</div>
                    </div>
                    <div class="List-item gutter-tiny gutter-vertical">
                        <div class="gutter-vertical gutter-tiny">
                            <a class="Link Link--block SiteNav-pageLink" href="{{ route('community-start') }}" data-analytics="main-nav" data-analytics-placement="Search - Resources - New Players">@lang('navbar.Navbar-new-players-guide')</a>
                        </div>
                        <div class="gutter-vertical gutter-tiny">
                            <a class="Link Link--block SiteNav-pageLink" href="{{ route('community-return') }}" data-analytics="main-nav" data-analytics-placement="Search - Resources - Returning Players">@lang('navbar.Navbar-returning-players-guide')</a>
                        </div>
                        <div class="gutter-vertical gutter-tiny"><a class="Link Link--block SiteNav-pageLink" href="{{ route('community-status') }}" data-analytics="main-nav" data-analytics-placement="Search - Resources - Realm Status">@lang('navbar.Navbar-status')</a>
                        </div>
                    </div>
                </div>
            </div>
        <div class="Grid-1of3" media-wide="!hide Grid-1of4">
            <div class="List List--full List--vertical List--separator List--separatorBrownMedium">
                <div class="List-item gutter-tiny gutter-vertical">
                    <div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-news')</div>
                </div>
                <div class="List-item gutter-tiny gutter-vertical">
                    <div class="gutter-vertical gutter-tiny">
                        <a class="Link Link--block SiteNav-pageLink" href="{{ route('news.index') }}" data-analytics="main-nav" data-analytics-placement="Search - News - Most Recent">@lang('navbar.Navbar-news-1')</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="Grid-1of3" media-wide="!hide Grid-1of4">
        <div class="List List--full List--vertical List--separator List--separatorBrownMedium">
            <div class="List-item gutter-tiny gutter-vertical">
                <div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-competitive-game')</div>
            </div>
            <div class="List-item gutter-tiny gutter-vertical">
                <div class="gutter-vertical gutter-tiny">
                    <a class="Link Link--block SiteNav-pageLink" href="/ru-ru/game/races" data-analytics="main-nav" data-analytics-placement="Search - Gameplay - Races">@lang('navbar.Navbar-races')</a>
                </div>
                <div class="gutter-vertical gutter-tiny">
                    <a class="Link Link--block SiteNav-pageLink" href="/ru-ru/game/classes" data-analytics="main-nav" data-analytics-placement="Search - Gameplay - Classes">@lang('navbar.Navbar-classes')</a>
                </div>
            </div>
        </div>
    </div>
<div class="hide" media-wide="!hide Grid-1of4">
    <div class="List List--full List--vertical List--separator List--separatorBrownMedium">
        <div class="List-item gutter-tiny gutter-vertical">
            <div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-forums')</div>
        </div>
        <div class="List-item gutter-tiny gutter-vertical">
            <div class="gutter-vertical gutter-tiny">
                <a class="Link Link--external Link--block SiteNav-pageLink" href="{{ route('forums') }}" data-analytics="main-nav" data-analytics-placement="Search - Forums - Support">@lang('navbar.Navbar-support')</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@guest
@else
<div class="Dropdown SiteNav-doormat SiteNav-characterDropdown" name="SiteNav-character">
    <div class="SiteNav-doormatContent">
        <div class="Grid Grid--gutters">
            <div class="Grid--full">
                <div class="gutter-tiny gutter-vertical">
                    <div class="SiteNav-sectionTitle font-title-tiny-onDark">@lang('navbar.Navbar-choose-another-character')</div>
                </div>
            </div>
        </div>
        @php
            $all = \App\Characters::userGameCharacters(\App\Account::userGameAccount()[0]->id);
        @endphp
        <div class="Grid Grid--gutters SyncHeight">
        @foreach($all as $item)
            <div class="Grid-1of2 SyncHeight-item" media-small="" media-wide="Grid-1of3" media-huge="Grid-1of4 !hide">
                <a class="Link Character Character--@lang('forum.class_key_'.$item->class) Character--avatar Character--level Character--realm Character--onDark" href="{{ route('characters', [$item->name]) }}">
                    <div class="Character-table">
                        <div class="Character-bust">
                            <div class="Art Art--above">
                                <div class="Art-size" style="padding-top:50.43478260869565%"></div>
                                <div class="Art-image" style="background-image:url({{ asset('/uploads/avatar/'.Auth::user()->avatar) }});"></div>
                                <div class="Art-overlay"></div>
                            </div>
                        </div>
                    <div class="Character-avatar">
                        <div class="Avatar">
                            <div class="Avatar-image" style="background-image:url(&quot;{{ asset('/uploads/avatar/'.Auth::user()->avatar) }}&quot;);"></div>
                        </div>
                    </div>
                    <div class="Character-details">
                        <div class="Character-role"></div>
                        <div class="Character-name">{{ $item->name }}</div>
                        <div class="Character-level"><b>{{ $item->level }}</b> @lang('forum.class_'.$item->class) <!-- (Исцеление) --></div>
                        <div class="Character-realm">ElisGrimm</div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
<div>
</div>
<div class="List List--vertical List--right">
    <div class="List-item"><a class="SiteNav-pageLink" href="{{ route('characters-list') }}">@lang('navbar.Navbar-characters-list')</a></div>
    <div class="List-item"><a class="SiteNav-pageLink" href="{{ route('logout') }}" data-analytics="main-nav" data-analytics-placement="Community - Log Out">@lang('navbar.Navbar-accountLogOut')</a></div></div>
</div>
</div>
@endguest
</div>
</div>
</div>
</div>