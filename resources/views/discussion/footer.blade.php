    <div class="NavbarFooter is-region-limited" data-timestamp="1523551092553" data-hash="2b7f75c8f75de11932b0ede50f18ba20d1935942" data-region-selection="limited" data-region="eu" data-locale="{{ app()->getLocale() }}" >
			<div class="NavbarFooter-overlay"></div>
			<div class="NavbarFooter-selector">
				<div class="NavbarFooter-selectorToggle">
					<div class="NavbarFooter-icon NavbarFooter-selectorToggleIcon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-globe"></use>
</svg>
					</div>
					<div class="NavbarFooter-selectorToggleLabel">
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
                    </div>
					<div class="NavbarFooter-icon NavbarFooter-selectorToggleArrow">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-selector"></use>
</svg>
					</div>
				</div>
				<div class="NavbarFooter-selectorDropdown">
					<div class="NavbarFooter-selectorDropdownContainer">
						<div class="NavbarFooter-selectorCloser">
							<div class="NavbarFooter-selectorCloserAnchor">
								<div class="NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-close"></use>
</svg>
								</div>
							</div>
						</div>
            			<div class="NavbarFooter-selectorRegions NavbarFooter-selectorSection">
            				<div class="NavbarFooter-selectorLabel">Регион</div>
                            	<a class="NavbarFooter-selectorRegion is-active is-selected NavbarFooter-selectorOption "  data-id="eu" >
                            		<div class="NavbarFooter-selectorOptionLabel">Европа</div>
                            		<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
                                        <use xlink:href="#Navbar-icon-check"></use>
                                    </svg>
                            		</div>
                            	</a>
            				<div class="NavbarFooter-selectorRegionTick">
            					<div class="NavbarFooter-selectorRegionTickOverlay"></div>
            				</div>
            			</div>
						<div class="NavbarFooter-selectorLocales NavbarFooter-selectorSection">
								<div class="NavbarFooter-selectorLabel">Язык</div>
									<div class="NavbarFooter-selectorSectionPage is-open is-active " data-region="eu">
	<div class="NavbarFooter-selectorSectionBlock">
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('de-de')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'de-de']) ?>" data-id="de-de" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">Deutsch</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('en-us')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'en-us']) ?>" data-id="en-us" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">English (US)</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('en-gb')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'en-gb']) ?>" data-id="en-gb" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">English (EU)</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('es-es')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'es-es']) ?>" data-id="es-es" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">Español (EU)</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('fr-fr')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'fr-fr']) ?>" data-id="fr-fr" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">Français</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('it-it')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'it-it']) ?>" data-id="it-it" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">Italiano</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	</div>
	<div class="NavbarFooter-selectorSectionBlock">
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('ru-ru')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'ru-ru']) ?>" data-id="ru-ru" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">Русский</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('ja-jp')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'ja-jp']) ?>" data-id="ja-jp" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">日本</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	<a class="NavbarFooter-selectorLocale @if(App::isLocale('zh-cn')) is-active is-selected @endif NavbarFooter-selectorOption " href="<?= route('lang', ['lang' => 'zh-cn']) ?>" data-id="zh-cn" data-alias="" >
	<div class="NavbarFooter-selectorOptionLabel">简体中文</div>
	<div class="NavbarFooter-selectorOptionCheck NavbarFooter-icon">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" focusable="false" >
    <use xlink:href="#Navbar-icon-check"></use>
</svg>
	</div>
</a>
	</div>
								</div>
						    </div>
						<div class="NavbarFooter-selectorTick"></div>
					</div>
				</div>
			</div>
			<div class="NavbarFooter-logoContainer"><a href="{{ route('home') }}" class="NavbarFooter-logo"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 124 66" class="NavbarFooter-logoUpper"><use xlink:href="#NavbarFooter-blizzard-upper"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 124 66" class="NavbarFooter-logoLower"><use xlink:href="#NavbarFooter-blizzard-lower"></use></svg></a></div>
<div class="NavbarFooter-links NavbarFooter-mainLinks">
    <div class="NavbarFooter-linksLeft">
        <div class="NavbarFooter-link NavbarFooter-mainLink">
            <a href="/" class="NavbarFooter-anchor" data-id="careers" data-analytics="global-nav" data-analytics-placement="Footer - Careers">@lang('forum.Careers')</a>
        </div>
        <div class="NavbarFooter-link NavbarFooter-mainLink">
            <a href="/company/about/" class="NavbarFooter-anchor" data-id="about" data-analytics="global-nav" data-analytics-placement="Footer - About">@lang('forum.About')</a>
        </div>
        <div class="NavbarFooter-link NavbarFooter-mainLink">
            <a href="/support/" class="NavbarFooter-anchor" data-id="support" data-analytics="global-nav" data-analytics-placement="Footer - Support">Поддержка</a>
        </div>
    </div>
<div class="NavbarFooter-linksRight">
    <div class="NavbarFooter-link NavbarFooter-mainLink">
        <a href="/company/about/contact.html" class="NavbarFooter-anchor" data-id="contact" data-analytics="global-nav">Открыть запрос</a>
    </div>
    <div class="NavbarFooter-link NavbarFooter-mainLink">
        <a href="/" class="NavbarFooter-anchor" data-id="press" data-analytics="global-nav" data-analytics-placement="Footer - Press">Пресс-релизы</a>
    </div>
    <div class="NavbarFooter-link NavbarFooter-mainLink">
        <a href="/" class="NavbarFooter-anchor" data-id="api" data-analytics="global-nav" data-analytics-placement="Footer - Battle.net API">API</a>
    </div>
</div>
</div>
<div class="NavbarFooter-copyright">©Blizzard Entertainment, 2018. Все права защищены.</div><div class="NavbarFooter-trademark">Все упомянутые товарные знаки являются собственностью соответствующих владельцев.</div><div class="NavbarFooter-links NavbarFooter-subLinks"><div class="NavbarFooter-link NavbarFooter-subLink"><a href="/company/about/privacy.html" class="NavbarFooter-anchor" data-id="privacy" data-analytics="global-nav" data-analytics-placement="Footer - Privacy">@lang('forum.Privacy')</a></div><div class="NavbarFooter-link NavbarFooter-subLink"><a href="/company/legal/" class="NavbarFooter-anchor" data-id="terms" data-analytics="global-nav" data-analytics-placement="Footer - Terms">@lang('forum.Terms')</a></div></div>
		<div class="NavbarFooter-legal">
		ru-RU

				<div class="NavbarFooter-legalRatings">
				</div>

		</div>
	</div>
