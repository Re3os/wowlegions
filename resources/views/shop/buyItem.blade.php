<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru" class="ru-ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if IE 8]>
<script>
document.createElement("article");
document.createElement("aside");
document.createElement("details");
document.createElement("figcaption");
document.createElement("figure");
document.createElement("footer");
document.createElement("header");
document.createElement("hgroup");
document.createElement("main");
document.createElement("nav");
document.createElement("section");
document.createElement("summary");
document.createElement("template");
</script>
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/shop/static/css/global/ie8.min-68218abd52.css') }}}" />
<![endif]-->
<!--[if IE 6]> <script type="text/javascript">
//<![CDATA[
try { document.execCommand('BackgroundImageCache', false, true) } catch(e) {}
//]]>
</script>
<![endif]-->
<title>Магазин {{ config('app.name', 'WoWLegions') }}</title>
<link rel="shortcut icon" href="{{ asset_media('/shop/static/images/meta/favicon-dc50e9bcb8.ico') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/static/styles/navbar.css') }}" />
<!--[if gt IE 8]><!--><link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/shop/static/css/toolkit/checkout-responsive.min-666f75ac04.css') }}" /><!-- <![endif]-->
<!--[if IE 8]><link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/shop/static/css/toolkit/checkout-web-ie8.min.css') }}" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/shop/static/css/global/global.min-c76b5bef17.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/shop/static/css/purchase/purchase.min-2db9a42c2c.css') }}" />

<script src="{{ asset_media('/shop/static/local-common/js/third-party/jquery-1.11.0.min-8fc25e27d4.js') }}"></script>
<script src="{{ asset_media('/shop/static/local-common/js/core.min-e41a582124.js') }}"></script>
<style>
body {
background: #002650 url({{ asset_media('/shop/static/images/backgrounds/v2/bg_bottom_mobile-c2cc1fa8b7.png')}}) no-repeat bottom;
background-size: contain;
}
@media screen and (min-width: 1280px) {
body {
background-color: #002650;
background-image: url({{ asset_media('/shop/static/images/backgrounds/v2/bg_bottom_left-6c1522731b.png')}}), url({{ asset_media('/shop/static/images/backgrounds/v2/bg_bottom_right-ed141418a7.png') }});
background-repeat: no-repeat, no-repeat;
background-position: 0 100%, 100% 100%;
background-size: auto;
}
}
.background-wrapper {
background: url({{ asset_media('/shop/static/images/backgrounds/v2/bg_top-c571367918.png') }}) no-repeat top;
min-height: 400px;
}
.body-content {
background: transparent;
}
</style>
<style>
html {
height: auto;
min-height: 100%;
min-width: 320px;
}
body {
height: auto;
min-height: 100%;
position: absolute;
width: 100%;
}
</style>
<script type="text/javascript">
//<![CDATA[
var Core = Core || {},
Login = Login || {};
Core.staticUrl = '/shop/static';
Core.sharedStaticUrl = '/shop/static/local-common';
Core.baseUrl = '/shop/ru';
Core.projectUrl = '/shop';
Core.cdnUrl = 'http://media.blizzard.com';
Core.supportUrl = 'http://eu.battle.net/support/';
Core.secureSupportUrl = 'https://eu.battle.net/support/';
Core.project = 'shop';
Core.locale = 'ru-ru';
Core.language = 'ru';
Core.region = 'eu';
Core.shortDateFormat = 'dd/MM/yyyy';
Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
Core.loggedIn = true;
Core.userAgent = 'web';
Login.embeddedUrl = 'https://eu.battle.net/login/login.frag';
var Flash = Flash || {};
Flash.videoPlayer = 'http://media.blizzard.com/global-video-player/themes/shop/video-player.swf';
Flash.videoBase = 'http://media.blizzard.com/shop/media/videos';
Flash.ratingImage = 'http://media.blizzard.com/global-video-player/ratings/shop/ru-ru.jpg';
Flash.expressInstall = 'http://media.blizzard.com/global-video-player/expressInstall.swf';
//]]>
</script>
<meta name="viewport" content="width=device-width" />
</head>
<body class="payment purchase-template ua-web js-enabled">
<div class="background-wrapper">
<script>
//<![CDATA[
var dataLayer = [{
"userAgent": "web" , "currencyCode": "RUB" , "region": "eu" , "productName": "Grinning Reaver" , "userId": "135198324" , "authenticated": "1" , "analyticsViewName": "\/shop/ru/checkout/select-payment/15163" }];
//]]>
</script>
<!--[if lt IE 11]>
<div style="height: 91px;"></div>
<div style="position: absolute; top: 0; left: 0; width: 100%; height: 50px; padding: 20px 0; border-bottom: 1px solid #774f1c; background: #5d3100; color: #fff; font-family: Arial, sans-serif; text-align: center;">
<h1 style="font-size: 17px; line-height: 20px; font-weight: bold; margin: 0 0 10px 0; padding: 0;">У вас устаревшая версия браузера.</h1>
<p style="font-size: 13px; line-height: 20px; margin: 0; padding: 0;">Пожалуйста, обновите Internet Explorer до последней версии, чтобы воспользоваться всеми возможностями Магазина Blizzard. К тому же, пользоваться сетью Интернет станет быстрее и надежнее.</p>
</div>
<![endif]-->
<div id="nav-client-header">
@include('layouts.navbar.shop')
</div>
<div class="body-content">
<div class="grid-container purchase-content " >
<div class="purchase-container">
<div class="purchase-column grid-parent">
<div class="purchase-sidebar">
<div class="product-summary clearfix">
<div class="product-image thumbnail">
<img src="/uploads/shop/{{ $item->mobile }}" alt="{{ $item->title }}" title="" />
</div>
<div class="mobile-grid-100">
<div class="product-name-group">
<h6>Вы приобретаете</h6>
<p class="product-name">
{{ $item->title }}
</p>
</div>
<div id="price-breakdown">
<div class="tax-breakdown hide subtotal">
<h6>Всего</h6>
<p class="price"></p>
</div>
<div class="tax-breakdown hide tax">
<h6>Налоги</h6>
<p class="price"></p>
</div>
<div class="checkout-total">
<h6>
Итого
<br /> Включая НДС.
</h6>
<p class="price">{{ $item->price }} ₽</p>
</div>
<div class="partial-breakdown balance-applied hide">
<h6>Использовано</h6>
<p class="price"></p>
</div>
<div class="partial-breakdown checkout-total-minus-balance-applied hide">
<h6>Вы оплачиваете</h6>
<p class="price"></p>
</div>
</div>
<div class="hide hide-on-mobile" id="payment-icons">
</div>
</div>
</div>
</div>
</div>
<div class="purchase-column content-column grid-parent">
<div class="content-container loading">

<div data-bnet-shop-product-id="362">
<form id="payment-form" action="{{ route('shop.complete', ['name' => $item->short_code ]) }}" method="post" novalidate="novalidate" data-payment-method-id="WALLET7753431" data-offsite-link="false" data-tracking-url="/checkout/payment-info/saved-creditcard/362">
    {{ csrf_field() }}
@if(Auth::user()->balance < $item->price)
<div class="alert alert-error alert-icon">
<p>В вашем кошельке {{ config('app.name', 'WoWLegions') }} недостаточно средств для оплаты этой покупки.</p>
<p><a class="wrap" href="{{ route('add-balance') }}">Зачислите средства в кошелек {{ config('app.name', 'WoWLegions') }}</a> и попробуйте снова.</p>
</div>
@endif
<div id="checkout-payment-icons">
<div class="hide" id="payment-icons-container">
<span class="control-label">Мы принимаем:</span>
<div class="controls">
<div class="accepted-payment-icons">
<span class="icon-24-payment-battlenet-balance">battlenet-balance</span>
</div>
</div>
</div>
</div>
<fieldset class="pay-with">
<div class="control-group">
<label class="control-label" for="payment-option">Способ оплаты</label>
<div class="controls">
<select tabindex="1" id="payment-option" name="paymentOption" class="input-block" required="required">
<option value="balance">
Кошелек {{ config('app.name', 'WoWLegions') }}&nbsp;– ({{Auth::user()->balance}} ₽)
</option>
</select>
</div>
</div>
</fieldset>
<p class="purchase-help-text">Нажимая кнопку «Оплатить», вы принимаете условия следующих документов: <a class="wrap" href="/" target="_blank" tabindex="1">Лицензионное соглашение с конечным пользователем ({{ config('app.name', 'WoWLegions') }})<i class="icon-external-link"></i></a> и <a href="/" target="_blank" tabindex="1">Условия продажи<i class="icon-external-link"></i></a>, а также соглашаетесь на немедленное выполнение вашего заказа. Как только выполнение заказа начинается, вы теряете право отменить его.</p>
<div class="form-actions purchase-form-actions">
@if(Auth::user()->balance >= $item->price)
<button class="btn btn-primary btn-extra-large" id="payment-submit" data-gtm-id="payment-submit" tabindex="1">Оплатить</button>
@else
@endif
<a id="payment-cancel" class="cancel purchase-cancel btn btn-extra-large" onclick="history.go(-2);" tabindex="1">
Отмена
</a>
</div>
</form>

</div>
</div>
</div>
</div>
</div>
</div>
@include('layouts.footer')
<script>
//<![CDATA[
if (typeof Msg === "undefined") {
var Msg = {};
}
Msg.userCurrency = "RUB";
//]]>
</script>
<script src="{{ asset_media('/shop/static/js/third-party/hammer-mod-min-aec019a8e3.js') }}"></script>
<script>
//<![CDATA[
var xsToken = '67e4bf31-29d9-4d14-b631-a11df3679aef';
var supportToken = '';
var jsonSearchHandlerUrl = '\//eu.battle.net';
var Msg = Msg || {};
Msg.analytics = {
account: 'UA-544112-16',
domainName: '.battle.net',
pageUrl: '',
eventPrefix: '',
pagePrefix: '',
pageSuffix: '-TRACKING'
};
Msg.support = {
ticketNew: 'Открыт запрос № {0}.',
ticketStatus: 'Запросу № {0} присвоен статус «{1}».',
ticketOpen: 'Открыт',
ticketAnswered: 'Дан ответ',
ticketResolved: 'Разрешен',
ticketCanceled: 'Отменен',
ticketArchived: 'Перемещен в архив',
ticketInfo: 'Уточнить',
ticketAll: 'Все запросы'
};
Msg.ui= {
submit: 'Отправить',
cancel: 'Отмена',
reset: 'Сброс',
viewInGallery: 'Галерея',
loading: 'Подождите, пожалуйста.',
unexpectedError: 'Произошла ошибка.',
fansiteFind: 'Найти на…',
fansiteFindType: '{0}: поиск на…',
fansiteNone: 'Нет доступных сайтов.',
flashErrorHeader: 'Необходимо установить Adobe Flash Player.',
flashErrorText: 'Загрузить Adobe Flash Player',
flashErrorUrl: 'http://get.adobe.com/flashplayer/',
save: 'Сохранить'
};
Msg.grammar= {
colon: '{0}:',
first: 'Первая стр.',
last: 'Последняя стр.',
ellipsis: '…'
};
Msg.search= {
noResults: 'Нет результатов для отображения',
kb: 'Поддержка',
post: 'Форумы',
article: 'Статьи',
static: 'Материалы',
wowcharacter: 'Персонаж',
wowitem: 'Предмет',
wowguild: 'Гильдии',
wowarenateam: 'Команды Арены',
url: 'Вам может быть интересно',
friend: 'Друзья',
product: 'Продукция',
other: 'Другое'
};
//]]>
</script>
<script src="{{ asset_media('/shop/static/js/toolkit/toolkit.min-26864331d3.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/shop/static/js/global/global.min-f61c50a4b6.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/shop/static/js/purchase/purchase.min-71fee2c8c2.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/shop/static/js/wallet-sdk/wallet-sdk.min-c0dff07ead.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/shop/static/js/payment/payment.min-28077a5c29.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/shop/static/js/third-party/kr/pay40_sec-ff0c17c2c0.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/shop/static/js/navbar-1050a7d3cb.js') }}"></script>
<script src="{{ asset_media('/shop/static/js/legal/legal.min-1ec7ee2d0b.js') }}"></script>
<script src="{{ asset_media('/shop/static/js/third-party/q.min-996165a84f.js') }}"></script>
<script src="{{ asset_media('/shop/static/js/third-party/hashtable-224698bf70.js') }}"></script>
<script src="{{ asset_media('/shop/static/js/third-party/jquery-numberformatter.min-03e030e913.js') }}"></script>
<div id="ajax-indicator" class="ajax-indicator"></div>
</div>
</body>
</html>