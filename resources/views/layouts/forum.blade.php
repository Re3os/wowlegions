<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<title>@yield('title'){{ config('app.name_forum', __('forum.title')) }}</title>
    @yield('og')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset_media('/forums/static/images/icons/wow-favicon.ico') }}" />
    {!! printCssHome() !!}
    <script>var whTooltips = {colorLinks: true, iconizeLinks: true, renameLinks: true};</script>
    <script src="//wow.zamimg.com/widgets/power.js"></script>
    <script type="text/javascript" src="{{ asset_media('/forums/static/js/vendor/jquery/dist/jquery.min.js') }}"></script>
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
		<script type="text/javascript" src="{{ asset_media('/forums/static/js/vendor/jquery-compat/dist/jquery.min.js') }}"></script>
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
		Core.locale				= '{{ app()->getLocale() }}';
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


<body class="{{ app()->getLocale() }} Theme--wow">
    		<script type="text/javascript">
		//<![CDATA[
	var LOCALIZATION = LOCALIZATION || {};

	LOCALIZATION.SPAMMING = "Спам";
	LOCALIZATION.REAL_LIFE_THREATS = "Угрозы в реальной жизни";
	LOCALIZATION.ADVERTISING_STRADING = "Реклама";
	LOCALIZATION.OTHER = "Иное";
	LOCALIZATION.TROLLING = "Троллинг";

	LOCALIZATION.EDIT = "Редактировать"
    LOCALIZATION.SAVE = "Сохранить"
	LOCALIZATION.PREVIEW = "Предпросмотр";
	LOCALIZATION.CANCEL = "Отменить";
	LOCALIZATION.UPDATE_POST = "Сообщение";
	LOCALIZATION.REPORT = "Сообщить модераторам";
    LOCALIZATION.SOLUTION_MARK = "Отмечено как решение вопроса";
    LOCALIZATION.SOLUTION_UNMARK = "Снять пометку «Решение вопроса»";
    LOCALIZATION.COPY_LINK = "Скопировать ссылку:";
    LOCALIZATION.UNPOSTED_PROMPT = "Вы начали писать сообщение...";

	LOCALIZATION.BOLD = "Полужирный";
	LOCALIZATION.ITALICS = "Курсив";
	LOCALIZATION.UNDERLINE = "Подчеркивание";
	LOCALIZATION.LIST = "Несортированный список";
	LOCALIZATION.LIST_ITEM = "Список";
	LOCALIZATION.QUOTE = "Цитирование";
	LOCALIZATION.CODE = "Код";
	LOCALIZATION.URL = "Ссылка";

	LOCALIZATION.DELETE_CONFIRM = "Вы точно хотите удалить это сообщение?";
	LOCALIZATION.ERROR_EDIT = "Ошибка при редактировании";
	LOCALIZATION.ERROR_PREVIEW = "Ошибка при предварительном просмотре";
	LOCALIZATION.DELETE_SUCCESS = "удалено";
	LOCALIZATION.ERROR_DELETE = "Ошибка при удалении";
	LOCALIZATION.REPORT_SUCCESS = "Готово!"
	LOCALIZATION.ERROR_REPORT = "Ошибка при отправлении жалобы";

	LOCALIZATION.ERROR_EMPTY = "Warning! No topics were selected";
    LOCALIZATION.ERROR_UPDATE = "Ошибка при обновлении";
	LOCALIZATION.ERROR_UPDATE_MOD = "Error Updating";
    LOCALIZATION.UPDATE_SUCCESS_MOD = "Update successful";
    LOCALIZATION.UPDATE_SUCCESS = "Update successful";
	LOCALIZATION.ERROR_MOVING = "Error Moving";
	LOCALIZATION.MOVING_SUCCESS = "Move Topic successful";
	LOCALIZATION.DELETE_CONFIRM_MOD = "Are you sure you want to delete this post?";
	LOCALIZATION.DELETE_SUCCESS_MOD = "Delete Successful";
	LOCALIZATION.ERROR_DELETE_MOD = "Error Deleting";
    LOCALIZATION.TOPIC_TITLE = "Заголовок темы";
    LOCALIZATION.TOPIC_POST_LIMIT = "Post Limit";
		//]]>
		</script>
@include('layouts.navbar.forum')
    <div class="Subnav">
    <div class="Container Container--content Container--breadcrumbs">
    <div class="GameSite-link"> <a class="GameSite-link--heading" href="/"> <i class="Icon"></i>World of Warcraft </a> </div>
    @yield('sidebar')
    </div>
</div>
<div role="main">
	@yield('content')
</div>
<footer class="Forums-footer"> @lang('forum.Forums-footer') <a href="{{ route('forums') }}">{{ config('app.name_forum', __('forum.title')) }}</a> ({{ config('app.forum_version') }}) · <a href="{{ route('patch-notes') }}">@lang('forum.Forums-footer-2')</a> </footer>
@include('layouts.footer')
{!! printJsHome() !!}
<script type="text/javascript" src="{{ asset_media('/forums/static/js/main.js') }}"></script>
</body>
</html>