<div id="nav-client-header" class="nav-client compact"> <!-- default -->
    <div id="nav-client-bar">
        <div class="grid-container nav-header-content">
            <ul class="nav-list nav-left" id="nav-client-main-menu">
                <li>
                    <a id="nav-client-home" class="nav-item nav-home" href="{{ route('home') }}" data-analytics="global-nav" data-analytics-placement="Nav - World of Warcraft Icon"></a>
                </li>
                <li>
                    <a id="nav-client-shop" class="nav-item nav-link" href="{{ route('shop') }}" data-analytics="global-nav" data-analytics-placement="Nav - @lang('forum.shop')">@lang('forum.shop')</a>
                </li>
                <li>
                    <a id="nav-client-api" class="nav-item nav-link" href="/api" data-analytics="global-nav" data-analytics-placement="Nav - API">API</a>
                </li>
            </ul>@guest
            <ul class="nav-list nav-right" id="nav-client-account-menu">
                <li>
                    <div id="username">
                        <div class="dropdown pull-right">
                            <a class="nav-link username dropdown-toggle" data-toggle="dropdown" rel="navbar">
                                @lang('forum.username_navbar')                                    <b class="caret"></b>
                            </a>

                            <div class="dropdown-menu">
                                <div class="arrow top"></div>
                                <div class="user-profile">
                                    <div class="dropdown-section">

                                        <div class="nav-box">
                                            <a class="nav-item nav-btn nav-btn-block nav-login-btn" href="{{ route('login') }}" data-analytics="global-nav" data-analytics-placement="Nav - Account - Log In">@lang('forum.login')</a>
                                        </div>
                                        <div class="nav-box">
                                            <a class="nav-item nav-btn nav-btn-block nav-login-btn" href="{{ route('register') }}" data-analytics="global-nav" data-analytics-placement="Nav - Account - Register">@lang('forum.register')</a>
                                        </div>
                                    </div>
                                    <div class="dropdown-section">
                                        <ul class="nav-list">
                                            <li>
                                                <a class="nav-item nav-a nav-item-box" href="{{ route('account') }}" data-analytics="global-nav" data-analytics-placement="Nav - Account - Settings">
                                                    <i class="nav-icon-24-blue nav-icon-character-cog"></i>
                                                    @lang('forum.account') </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
                <li>
                    <a id="nav-client-support-link" class="nav-item nav-link" href="/support/" data-analytics="global-nav" data-analytics-placement="Nav - Support">@lang('forum.support') </a>
                </li>
            </ul>@else
<ul class="nav-list nav-right" id="nav-client-account-menu">
                    <li>
                        <div id="username">
                            <div class="dropdown pull-right">
                                <a class="nav-link username dropdown-toggle" data-toggle="dropdown" rel="navbar">
                                    {{ Auth::user()->name }}<b class="caret"></b>
                                </a>
                                <div class="dropdown-menu pull-right">
                                    <div class="arrow top"></div>
                                    <div class="user-profile">
                                        <div class="dropdown-section">
                                            <div class="nav-box selectable">
                                                    <div class="label">
                                                        <span class="battletag">{{ Auth::user()->name }}</span>
                                                        <span class="code">#{{ Auth::user()->name_id }}</span>
                                                    </div>
                                                    <div class="email">{{ Auth::user()->email }}</div>
                                            </div>
                                        </div>
                                        <div class="dropdown-section">
                                            <ul class="nav-list">
                                                <li>
                                                    <a class="nav-item nav-a nav-item-box" href="/dashboard" data-analytics="global-nav" data-analytics-placement="Nav - Account - Settings">
                                                        <i class="nav-icon-24-blue nav-icon-character-cog"></i>Dashboard</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-section">
                                            <ul class="nav-list">
                                                <li>
                                                    <a class="nav-item nav-a nav-item-box" href="{{ route('account') }}" data-analytics="global-nav" data-analytics-placement="Nav - Account - Settings">
                                                        <i class="nav-icon-24-blue nav-icon-character-cog"></i>@lang('forum.account')</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="dropdown-section">
                                            <a class="nav-item nav-item-box" href="{{ route('logout') }}" data-analytics="global-nav" data-analytics-placement="Nav - Account - Log Out"><i class="nav-icon-24-blue nav-icon-logout"></i>@lang('forum.logout')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a id="nav-client-support-link" class="nav-item nav-link" href="/support/" data-analytics="global-nav" data-analytics-placement="Nav - Support">@lang('forum.support')</a>
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</div>