<div class="Pane Pane--dirtDark Pane--above">
    <div class="Pane-bg">
        <div class="Pane-overlay"></div>
    </div>
<div class="Pane-content">
    <div class="SiteFooter">
        <div class="NavbarFooter is-regionless" data-hash="5fa0a9ec7c8b160b81e2c9c81792d7976df4bffa" data-region-selection="none" data-region="eu" data-locale="">
            <div class="NavbarFooter-overlay"></div>
            <div class="NavbarFooter-selector">
                <div class="NavbarFooter-selectorToggle">
                        <div class="NavbarFooter-icon NavbarFooter-selectorToggleIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                <use xlink:href="#Navbar-icon-globe"></use>
                            </svg>
                        </div>
                    <div class="NavbarFooter-selectorToggleLabel">@if(App::isLocale('de-de'))
                    Deutsch
                    @elseif(App::isLocale('en-us'))
                    English (US)
                    @elseif(App::isLocale('en-gb'))
                    English (EU)
                    @elseif(App::isLocale('es-es'))
                    Español (EU)
                    @elseif(App::isLocale('fr-fr'))
                    Français
                    @elseif(App::isLocale('it-it'))
                    Italiano
                    @elseif(App::isLocale('ru-ru'))
                    Русский
                    @elseif(App::isLocale('ja-jp'))
                    日本
                    @elseif(App::isLocale('zh-cn'))
                    简体中文
                    @endif</div>
                    <div class="NavbarFooter-icon NavbarFooter-selectorToggleArrow">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                            <use xlink:href="#Navbar-icon-selector"></use>
                        </svg>
                    </div>
                </div>
            <div class="NavbarFooter-selectorDropdown">
                <div class="NavbarFooter-selectorDropdownContainer">
                    <div class="NavbarFooter-selectorCloser">
                        <div class="NavbarFooter-selectorCloserAnchor">
                            <div class="NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-close"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                <div class="NavbarFooter-selectorLocales NavbarFooter-selectorSection">
                    <div class="NavbarFooter-selectorSectionBlock">
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('de-de')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'de-de', 'current' => app()->getLocale()]) ?>" data-id="de-de">
                            <div class="NavbarFooter-selectorOptionLabel">Deutsch</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('en-us')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'en-us', 'current' => app()->getLocale()]) ?>" data-id="en-us">
                            <div class="NavbarFooter-selectorOptionLabel">English (US)</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('en-gb')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'en-gb', 'current' => app()->getLocale()]) ?>" data-id="en-gb">
                            <div class="NavbarFooter-selectorOptionLabel">English (EU)</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('es-es')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'es-es', 'current' => app()->getLocale()]) ?>" data-id="es-es">
                            <div class="NavbarFooter-selectorOptionLabel">Español (EU)</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('fr-fr')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'fr-fr', 'current' => app()->getLocale()]) ?>" data-id="fr-fr">
                            <div class="NavbarFooter-selectorOptionLabel">Français</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('it-it')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'it-it', 'current' => app()->getLocale()]) ?>" data-id="it-it">
                            <div class="NavbarFooter-selectorOptionLabel">Italiano</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="NavbarFooter-selectorSectionBlock">
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('ru-ru')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'ru-ru', 'current' => app()->getLocale()]) ?>" data-id="ru-ru">
                            <div class="NavbarFooter-selectorOptionLabel">Русский</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('ja-jp')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'ja-jp', 'current' => app()->getLocale()]) ?>" data-id="ja-jp">
                            <div class="NavbarFooter-selectorOptionLabel">日本</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        <a class="NavbarFooter-selectorLocale @if(App::isLocale('zh-cn')) is-active is-selected @endif NavbarFooter-selectorOption" href="<?= route('lang', ['lang' => 'zh-cn', 'current' => app()->getLocale()]) ?>" data-id="zh-cn">
                            <div class="NavbarFooter-selectorOptionLabel">繁體中文</div>
                            <div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false">
                                    <use xlink:href="#Navbar-icon-check"></use>
                                </svg>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="NavbarFooter-selectorTick"></div>
                </div>
            </div>
        </div>
<div class="NavbarFooter-logoContainer">
<a href="/" class="NavbarFooter-logo"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 124 66" class="NavbarFooter-logoUpper"><use xlink:href="#NavbarFooter-blizzard-upper"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 124 66" class="NavbarFooter-logoLower"><use xlink:href="#NavbarFooter-blizzard-lower"></use></svg></a></div>

<div class="NavbarFooter-links NavbarFooter-mainLinks"><div class="NavbarFooter-linksLeft"><div class="NavbarFooter-link NavbarFooter-mainLink"><a href="/" class="NavbarFooter-anchor" data-id="careers" data-analytics="global-nav" data-analytics-placement="Footer - Careers">@lang('forum.Careers')</a></div><div class="NavbarFooter-link NavbarFooter-mainLink"><a href="/company/about/" class="NavbarFooter-anchor" data-id="about" data-analytics="global-nav" data-analytics-placement="Footer - About">@lang('forum.Impressum')</a></div><div class="NavbarFooter-link NavbarFooter-mainLink"><a href="https://eu.support.blizzard.com/" class="NavbarFooter-anchor" data-id="support" data-analytics="global-nav" data-analytics-placement="Footer - Support">@lang('forum.Kundendienst')</a></div></div><div class="NavbarFooter-linksRight"><div class="NavbarFooter-link NavbarFooter-mainLink"><a href="/company/about/contact.html" class="NavbarFooter-anchor" data-id="contact" data-analytics="global-nav">@lang('forum.Kontakt')</a></div><div class="NavbarFooter-link NavbarFooter-mainLink"><a href="/" class="NavbarFooter-anchor" data-id="api" data-analytics="global-nav" data-analytics-placement="Footer - Battle.net API">API</a></div></div></div>

<div class="NavbarFooter-copyright">©Blizzard Entertainment, 2018. @lang('forum.copyright')</div>
<div class="NavbarFooter-trademark">Developed by <a href="https://forum.wowlegions.ru/">WoWLegions</a> (ver. {{ config('app.app_version') }})</div>
</div></div></div></div>