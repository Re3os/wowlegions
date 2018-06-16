<div id="nav-client-footer" class="nav-client">
    <div class="mobileFooterEnabled footer-content footer-desktop grid-container">	<div class="nav-section support-feedback">
            <div class="nav-left">
                <div id="nav-feedback">
<a id="nav-client-news" class="nav-item nav-a nav-item-btn" href="/support/" data-analytics="global-nav" data-analytics-placement="Footer - Support"><i class="nav-icon-24-blue nav-icon-question-circle"></i>@lang('forum.support')</a>
                </div>
            </div>
                <div class="nav-right">
    <div id="nav-client-region-select">
        <div class="dropdown dropup pull-right">
            <a class="dropdown-toggle nav-item" data-toggle="dropdown">
                <i class="nav-icon-24-blue nav-icon-globe"></i>
                Europe -
            @if(App::isLocale('de-de'))
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
            @endif
                <b class="caret"></b>
            </a>
            <div class="dropdown-menu" data-placement="top">
                <div class="arrow bottom"></div>
                <div id="nav-client-international-desktop">
    <div class="nav-international-container">
        <div class="dropdown-section nav-column-container">
            <div class="nav-column-50">
                <div id="select-regions" class="nav-box regions">
                    <h3>Регион</h3>
                    <ul class="region-ul">
                        <li class="region active current"><a class="nav-item select-region" href="javascript:;" data-target="eu">Europe</a></li>
                    </ul>
                </div>
            </div>
            <div class="nav-column-50">
                <div id="select-language" class="nav-box languages">
                    <h3>Язык</h3>
                        <div class="region region-languages active current" data-region="eu">
                            <ul class="region-ul">
                                <li class="@if(App::isLocale('de-de')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'de-de']) ?>" data-target="eu" data-language="de-de">Deutsch</a>
                                </li>
                                <li class="@if(App::isLocale('en-us')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'en-us']) ?>" data-target="eu" data-language="en-us">English (US)</a>
                                </li>
                                <li class="@if(App::isLocale('en-gb')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'en-gb']) ?>" data-target="eu" data-language="en-gb">English (EU)</a>
                                </li>
                                <li class="@if(App::isLocale('es-es')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'es-es']) ?>" data-target="eu" data-language="es-es">Español (EU)</a>
                                </li>
                                <li class="@if(App::isLocale('fr-fr')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'fr-fr']) ?>" data-target="eu" data-language="fr-fr">Français</a>
                                </li>
                                <li class="@if(App::isLocale('it-it')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'it-it']) ?>" data-target="eu" data-language="it-it">Italiano</a>
                                </li>
                                <li class="@if(App::isLocale('ru-ru')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'ru-ru']) ?>" data-target="eu" data-language="ru-ru">Русский</a>
                                </li>
                                <li class="@if(App::isLocale('ja-jp')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'ja-jp']) ?>" data-target="eu" data-language="ja-jp">日本</a>
                                </li>
                                <li class="@if(App::isLocale('zh-cn')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'zh-cn']) ?>" data-target="eu" data-language="zh-cn">简体中文</a>
                                </li>
                            </ul>
                        </div>

                </div>
            </div>
        </div>
    </div>
                    <div class="dropdown-section dropdown-well nav-box localeChange">
                        <a id="nav-client-change-language-desktop" href="javascript:;" class="nav-lang-change nav-btn">@lang('forum.change_lang')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
                </div>
    </div>
    <div class="nav-section">
            <div class="nav-left nav-logo-group">
                    <div class="footer-logo nav-left">




<a class="nav-item logo-link" href="http://eu.blizzard.com/" data-analytics="global-nav" data-analytics-placement="Footer - Blizzard Logo"><img class="blizzard-logo" src="/images/nav-client/blizzard.png?v=58-84" alt="" /></a>

                    </div>
                <div class="footer-links nav-left">






<a class="nav-item nav-a" href="/" data-analytics="global-nav" data-analytics-placement="Footer - Careers">@lang('forum.Careers')</a>

            <span>|</span>





<a class="nav-item nav-a" href="/company/about/" data-analytics="global-nav" data-analytics-placement="Footer - About">@lang('forum.About')</a>

            <span>|</span>





<a class="nav-item nav-a" href="/company/about/privacy.html" data-analytics="global-nav" data-analytics-placement="Footer - Privacy">@lang('forum.Privacy')</a>

            <span>|</span>





<a class="nav-item nav-a" href="/company/legal/" data-analytics="global-nav" data-analytics-placement="Footer - Terms">@lang('forum.Terms')</a>

            <span>|</span>





<a class="nav-item nav-a" href="/" data-analytics="global-nav" data-analytics-placement="Footer - API">API</a>

    <div class="copyright">© Blizzard Entertainment, 2017 г.</div>
    <div class="nav-footer-icon-container">
        <ul class="nav-footer-icon-list">
        </ul>
    </div>
                </div>
            </div>
            <div class="nav-ratings">
            <div class="legal-rating">



    <div class="product-rating mkrf-rating clearfix">
        <a href="http://mkrf.ru/" tabindex="1" rel="external" target="_blank"><img class="mkrf-logo" src="/images/legal/ratings/mkrf/12.png?v=58-84" alt="12+" width="65" height="72" /></a>
    </div>
            </div>


            </div>
    </div>
</div>


    <div class="mobileFooterEnabled footer-content footer-mobile grid-container">	<div class="nav-section support-feedback">
                <div class="nav-client-feedback" id="nav-client-feedback">




<a id="nav-client-news" class="nav-item nav-a nav-item-btn" href="/support/" data-analytics="global-nav" data-analytics-placement="Footer - Support"><i class="nav-icon-24-blue nav-icon-question-circle"></i>@lang('forum.support')</a>


                </div>
    </div>
    <div class="nav-section locale-selector">
    <div id="nav-client-region-select">
        <a href="javascript:;" data-toggle="nav-collapse" data-target="#nav-client-collapsible-languages" class="nav-item dropdown dropdown-toggle collapsible-btn-mobile">
            <i class="nav-icon-24-blue nav-icon-globe"></i>
            Europe -
            @if(App::isLocale('de-de'))
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
            @endif
            <b class="caret"></b>
        </a>
        <div class="nav-collapse dropdown-well" id="nav-client-collapsible-languages">
            <div id="nav-client-international-mobile" class="nav-container region-container-mobile">
    <div class="nav-international-container">
        <div class="dropdown-section nav-column-container">
            <div class="nav-column-50">
                <div id="select-regions" class="nav-box regions">
                    <h3>Регион</h3>
                    <ul class="region-ul">
                            <li class="region active current"><a class="nav-item select-region" href="javascript:;" data-target="eu">Europe</a></li>
                    </ul>
                </div>
            </div>
            <div class="nav-column-50">
                <div id="select-language" class="nav-box languages">
                    <h3>Язык</h3>
                        <div class="region region-languages active current" data-region="eu">
                            <ul class="region-ul">
                                <li class="@if(App::isLocale('de-de')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'de-de']) ?>" data-target="eu" data-language="de-de">Deutsch</a>
                                </li>
                                <li class="@if(App::isLocale('en-us')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'en-us']) ?>" data-target="eu" data-language="en-us">English (US)</a>
                                </li>
                                <li class="@if(App::isLocale('en-gb')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'en-gb']) ?>" data-target="eu" data-language="en-gb">English (EU)</a>
                                </li>
                                <li class="@if(App::isLocale('es-es')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'es-es']) ?>" data-target="eu" data-language="es-es">Español (EU)</a>
                                </li>
                                <li class="@if(App::isLocale('fr-fr')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'fr-fr']) ?>" data-target="eu" data-language="fr-fr">Français</a>
                                </li>
                                <li class="@if(App::isLocale('it-it')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'it-it']) ?>" data-target="eu" data-language="it-it">Italiano</a>
                                </li>
                                <li class="@if(App::isLocale('ru-ru')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'ru-ru']) ?>" data-target="eu" data-language="ru-ru">Русский</a>
                                </li>
                                <li class="@if(App::isLocale('ja-jp')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'ja-jp']) ?>" data-target="eu" data-language="ja-jp">日本</a>
                                </li>
                                <li class="@if(App::isLocale('zh-cn')) active current @endif">
                                <a class="nav-item select-language" href="<?= route('lang', ['lang' => 'zh-cn']) ?>" data-target="eu" data-language="zh-cn">简体中文</a>
                                </li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </div>
                <div class="dropdown-section nav-box">
                    <a id="nav-client-change-language-mobile" href="javascript:;" class="nav-a nav-lang-change nav-btn">@lang('forum.change_lang')</a>
                </div>
            </div>
        </div>
    </div>
    </div>
        <div class="nav-logo-group">
                <div class="footer-logo">
<a class="nav-item logo-link" href="http://eu.blizzard.com/" data-analytics="global-nav" data-analytics-placement="Footer - Blizzard Logo"><img class="blizzard-logo" src="/images/nav-client/blizzard.png?v=58-84" alt="" /></a>
                </div>
            <div class="footer-links">
<a class="nav-item nav-a" href="/" data-analytics="global-nav" data-analytics-placement="Footer - Careers">@lang('forum.Careers')</a>
            <span>|</span>
<a class="nav-item nav-a" href="/company/about/" data-analytics="global-nav" data-analytics-placement="Footer - About">@lang('forum.About')</a>
            <span>|</span>
<a class="nav-item nav-a" href="/company/about/privacy.html" data-analytics="global-nav" data-analytics-placement="Footer - Privacy">@lang('forum.Privacy')</a>
            <span>|</span>
<a class="nav-item nav-a" href="/company/legal/" data-analytics="global-nav" data-analytics-placement="Footer - Terms">@lang('forum.Terms')</a>
            <span>|</span>
<a class="nav-item nav-a" href="/" data-analytics="global-nav" data-analytics-placement="Footer - API">API</a>
            </div>

    <div class="copyright">© Blizzard Entertainment, 2017 г.</div>
    <div class="nav-footer-icon-container">
        <ul class="nav-footer-icon-list">
        </ul>
    </div>
            <div class="nav-ratings">
            <div class="legal-rating">

    <div class="product-rating mkrf-rating clearfix">
        <a href="http://mkrf.ru/" tabindex="1" rel="external" target="_blank"><img class="mkrf-logo" src="/images/legal/ratings/mkrf/12.png?v=58-84" alt="12+" width="65" height="72" /></a>
    </div>
            </div>


            </div>
        </div>
</div>
    </div>