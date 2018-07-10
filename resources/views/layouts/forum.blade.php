<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<title>@yield('title') {{ config('app.name_forum', __('forum.title')) }}</title>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://eu.battle.net/forums/ru/wow/" />
	<meta property="og:title" content="@yield('title') {{ config('app.name_forum', __('forum.title')) }}" />
    <meta property="og:image" content="https://eu.battle.net/forums/static/images/social-thumbs/wow.png" />
    <meta property="og:description" content="@lang('forum.description')" />

    <link rel="shortcut icon" type="image/x-icon" href="https://eu.battle.net/forums/static/images/icons/wow-favicon.ico" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('forums/static/css/navbar.css') }}?v=58-88" />

    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('forums/static/css/main-9296f9fec4.css') }}?v=58-88" />
    <script>var whTooltips = {colorLinks: true, iconizeLinks: true, renameLinks: true};</script>
    <script src="//wow.zamimg.com/widgets/power.js"></script>
    <script type="text/javascript" src="{{ asset('forums/static/js/vendor/jquery/dist/jquery.min.js') }}?v=88"></script>
	<script type="text/javascript">
		$(document).ready( function() {
			$('body').removeClass('no-js');
			if (location.href.indexOf('#') > -1) {
   			location.href+='';
			}
		})
	</script>
	<!--[if lte IE 8]>
		<script type="text/javascript" src="https://eu.battle.net/forums/static/js/vendor/jquery-compat/dist/jquery.min.js?v=88"></script>
	<![endif]-->

		<script type="text/javascript">
		//<![CDATA[
		var Core = Core || {},
			Login = Login || {};
		Core.staticUrl			= '/forums/static';
		Core.sharedStaticUrl 	= '/forums/static/local-common';
		Core.baseUrl			= '/forums';
		Core.projectUrl     	= '/forums';
		Core.cdnUrl         	= 'http://media.blizzard.com';
		Core.supportUrl			= 'http://eu.battle.net/support/';
		Core.secureSupportUrl 	= 'https://eu.battle.net/support/';
		Core.project			= 'forums';
		Core.locale				= 'ru-ru';
		Core.language			= 'ru';
		Core.region				= 'eu';
		Core.shortDateFormat 	= 'dd/MM/yyyy';
		Core.dateTimeFormat		= 'dd/MM/yyyy HH:mm';
		Core.loggedIn			= @guest false; @else true; @endguest
		Core.userAgent			= 'web';
		Login.embeddedUrl 		= '/{{ app()->getLocale() }}/login';
		Core.community = 'wow';
		//]]>
		</script>

		<script type="text/javascript">
		//<![CDATA[
		var LOCALIZATION = LOCALIZATION || {};
		LOCALIZATION.URL_PROMPT = "@lang('forum.urlprompt')";
		//]]>
		</script>
</head>


<body class="ru-ru Theme--wow glass-header preload">

@include('layouts.navbar.forum')

    <div class="Subnav">
    <div class="Container Container--content Container--breadcrumbs">
    <div class="GameSite-link"> <a class="GameSite-link--heading" href="/"> <i class="Icon"></i>World of Warcraft </a> </div>
    @yield('sidebar')
    @guest
    @else
        @if(Auth::user()->charactersActive === NULL)
            <div class="User-menu"> <span class="User-menu-label">@lang('forum.User-menu-label')</span> <div class="Dropdown"> <span class="User-menu-heading" data-trigger="toggle.dropdown.menu"><div class="Author-avatar Author-avatar--default"></div> <i class="Icon"></i> </span> <div class="Dropdown-menu Dropdown-menu--userMenu"> <span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span> <div class="Dropdown-items"> <a href="/" class="Dropdown-item Dropdown-item--postHistory">@lang('forum.postHistory')</a> </div> </div> </div> </div>
        @else
            @php
                $active = \App\Characters::activeUserCharacters(Auth::user()->charactersActive);
            @endphp
            <div class="User-menu"> <span class="User-menu-label">@lang('forum.User-menu-label')</span> <div class="Dropdown"> <span class="User-menu-heading" data-trigger="toggle.dropdown.menu"><div class="Author-avatar" ><img src="{{ Auth::user()->avatar }}/images/avatars/wow/{{ $active->race }}-{{ $active->gender }}.jpg" alt="" /></div> <i class="Icon"></i> </span> <div class="Dropdown-menu Dropdown-menu--userMenu"> <span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span> <div class="Dropdown-items"> <a href="/forum/search?a={{ $active->name }}" class="Dropdown-item Dropdown-item--postHistory">@lang('forum.postHistory')</a> <a href="{{ route('characters', [$active->name]) }}" class="Dropdown-item Dropdown-item--profileLink"> @lang('forum.profileLink')<i class="Icon-profileLink"></i></a><div class="Dropdown-divider"></div> <span class="Dropdown-item" data-select-character="true"> @lang('forum.data-select-character')</span> </div> </div> </div> </div>
        @endif
    @endguest
    </div>
</div>




<div role="main">
	@yield('content')

@guest
@else
@if(count(\App\Account::userGameCharacters(\App\Account::userGameAccount()[0]->id)))
@php
    $all = \App\Characters::userGameCharacters(\App\Account::userGameAccount()[0]->id);
@endphp
<div class="CharacterSelect-modal" id="CharacterSelect-modal">
<div class="CharacterSelect-modal--inner"> <div class="CharacterSelect-title">
<span class="Title">@lang('forum.data-select-filter')</span> <a class="TopicForm-button--close is-active close" id="CharacterSelect-modal--close" type="button"></a> </div>
<div class="Characters" data-loc-attr='{ "topicId":"", "forumId":"" }' >
<div class="CharacterSelect-search"> <i class="Icon"></i> <input class="CharacterSelect-search--input" placeholder="@lang('forum.data-filter')" type="text"/> </div>
@foreach($all as $char)
<div class="Author UserCharacter" id="{{ $char->guid }}" data-topic-post-body-content="true">
    <a href="{{ route('characters', [$char->name]) }}" class="Author-avatar " >
        <img src="{{ Auth::user()->avatar }}" alt="" />
    </a>
<div class="Author-details">
    <span class="Author-name">
        <a class="Author-name--profileLink" href="{{ route('characters', [$char->name]) }}">{{ $char->name }}</a>
    </span>
<span class="Author-class paladin"> {{ $char->level }}   @lang('forum.race_'.$char->race) @lang('forum.class_'.$char->class)</span>
<span class="Author-realm"> ElisGrimm </span>
<span class="Author-posts"> <a class="Author-posts" href="/forum/search?a={{ $char->name }}" data-toggle="tooltip" data-tooltip-content="@lang('forum.Author-posts')"> Сообщений: NaN </a>
</span>
</div>
</div>
<div class="Author-ignored is-hidden" data-topic-post-ignored-author="true"> <span class="Author-name"> <a class="Author-name--profileLink" href="{{ route('characters', [$char->name]) }}">{{ $char->name }}</a> </span><div class="Author-posts Author-posts--ignored">@lang('forum.data-Ignoriert')</div></div>
@endforeach
</div>
</div>
</div>
@endif
@endguest
</div>

<footer class="Forums-footer"> @lang('forum.Forums-footer') <a href="{{ route('forums') }}">{{ config('app.name_forum', __('forum.title')) }}</a> (0.1.6) · <a href="{{ route('forums') }}">@lang('forum.Forums-footer-2')</a> </footer>

@include('layouts.footer')


<script type="text/javascript" src="{{ asset('forums/static/js/vendor/tether/dist/js/tether.js') }}"></script>
<script type="text/javascript" src="{{ asset('forums/static/js/vendor/waypoints/lib/jquery.waypoints.js') }}"></script>
<script type="text/javascript" src="{{ asset('forums/static/js/vendor/waypoints/lib/shortcuts/sticky.js') }}"></script>
<script type="text/javascript" src="{{ asset('forums/static/js/vendor/instanttouch.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('forums/static/js/vendor/clipboard.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('forums/static/js/vendor/d3/tooltips.js') }}"></script>
<script type="text/javascript" src="{{ asset('forums/static/js/navbar.js') }}?v=88"></script>
<script type="text/javascript" src="https://eu.battle.net/forums/static/js/main-5c4116b063.js"></script>
</body>
</html>