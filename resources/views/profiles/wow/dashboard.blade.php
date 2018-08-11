@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/dashboard.0eBg2.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/wow/dashboard.3qBrx.css') }}" />
<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/wow/dashboard-ie.1muX5.css') }}" />
<![endif]-->
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/dashboard-ie6.2v0KO.css') }}" />
<![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/compiled/wow/full-page-upsell.0VWHy.css') }}" />
@endsection

@section('js')
<script type="text/javascript" src="{{ asset_media('/account/static/js/management/dashboard.1OOFS.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/account/static/js/management/wow/dashboard.3697j.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/account/static/js/inputs.2gjKG.js') }}"></script>
@endsection

@section('content')
<div id="layout-middle">
<div class="wrapper">
<div id="content">
<div class="dashboard wowx6 eu">
<div class="primary">
<div class="header">
<h2 class="subcategory">Управление игрой</h2>
<h3 class="headline">World of Warcraft®: Legion™</h3>
<a href="{{ route('dashboard') }}?region=EU&amp;accountName=WoW1"><img src="{{ asset_media('/account/static/local-common/images/game-icons/wowx6.1S2j7.png') }}" title="" width="48" height="48" /></a>
</div>
<div class="account-summary">
<div class="account-management">
<div class="section box-art" id="box-art">
<img src="{{ asset_media('/account/static/images/products/box-art/games/world-of-warcraft/a9d740a4-7c18-4331-af1e-617492905888/default/3d.2mYed.png') }}" alt="World of Warcraft" title="" width="242" height="288" id="box-img" />
<span class="upgrade-available" data-tooltip="Можно конвертировать" data-tooltip-options='{"location": "mouse"}'></span>
</div>
<div class="section account-details">
<dl>
<dt class="subcategory">Учетная запись</dt>
<dd class="account-name">WoW1</dd>
<dt class="subcategory">Состояние записи</dt>
<dd class="account-status">
<strong class="active">активна</strong>
</dd>
<dt class="subcategory">Категория</dt>
<dd class="account primary-account account-status">
<span class="account-history">Legion
<em>Стандартная версия</em>
</span>
</dd>
<dd class="account secondary-account">Warlords of Draenor™
<em>Стандартная версия</em>
</dd>
<dd class="account secondary-account">Mists of Pandaria™
<em>Стандартная версия</em>
</dd>
<dd class="account secondary-account">Cataclysm®
<em>Стандартная версия</em>
</dd>
<dd class="account secondary-account">Wrath of the Lich King™
<em>Стандартная версия</em>
</dd>
<dd class="account secondary-account">The Burning Crusade™
<em>Стандартная версия</em>
</dd>
<dd class="account secondary-account">World of Warcraft
<em>Стандартная версия</em>
</dd>
<dt class="subcategory">Регион</dt>
<dd class="account-region EU">Европа (EU)</dd>
</dl>
</div>
<div class="section available-actions">
<ul class="game-time">
<li class="redeem-code">
<a href="{{ route('claim-code') }}">Использовать код</a>
</li>
<li class="payment-history">
<a href="{{ route('transaction-history') }}">История заказов</a>
</li>
<li class="download-client">
<a href="{{ route('download-game') }}">Установить или переустановить игру</a>
</li>
<li class="cancel-subscription">
<a href="#" id="wow-cancel-subscription">Отмена подписки</a>
</li>
</ul>
</div>
<div class="clear"></div>
</div>
</div>
</div>
<div class="subs-option-container">
<h4 class="section-title">Подписки</h4>
<div class="subs-options">
<table class="dashboard-subs">
<thead>
<th class="sub-products" scope="col">Подписка</th>
<th class="next-billing-dates" scope="col">Следующий платеж</th>
</thead>
<tbody>
<tr>
<td>
<p class="sub-details active-sub"><span >Подписка на World of Warcraft® — 3 месяца</span></p>
</td>
<td class="next-billing-date">
<time datetime="2018-04-07T06:10+03:00">07.04.18 6:10:44 MSK</time>
</td>
</tr>
</tbody>
</table>
<div class="manage">
<a href="{{ route('wallet') }}">Управление подпиской</a>
</div>
</div>
</div>
<div class="secondary">
<div class="service-selection character-services">
<ul class="wow-services">
<li class="category"><a href="#character-services" class="character-services">Услуги для персонажа и гильдии</a></li>
<li class="category"><a href="#additional-services" class="additional-services">Дополнительные услуги</a></li>
<li class="category"><a href="#referrals-rewards" class="referrals-rewards">Приглашения и награды</a></li>
<li class="category"><a href="#game-time-subscriptions" class="game-time-subscriptions">Игровое время и подписка</a></li>
</ul>
<div class="service-links">
<div class="position"></div>
<div class="content character-services" id="character-services">
<ul>
<li class="wow-service pct">
<a href="/account/management/wow/services/character-services.html?l=WoW1&amp;r=EU&amp;s=PCT" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Перенос персонажа</strong>
Перенесите персонажа в другой игровой мир или на другую учетную запись.
</a>
</li>
<li class="wow-service fcm">
<a href="/account/management/wow/services/character-services.html?l=WoW1&amp;r=EU&amp;s=FCM" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Бесплатный перенос персонажа</strong>
Перенесите своего персонажа в менее населенный игровой мир.
</a>
</li>
<li class="wow-service pfc">
<a href="/account/management/wow/services/character-services.html?l=WoW1&amp;r=EU&amp;s=PFC" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Смена фракции</strong>
Смените фракцию своего персонажа (Альянс на Орду или наоборот).
</a>
</li>
<li class="wow-service prc">
<a href="/account/management/wow/services/character-services.html?l=WoW1&amp;r=EU&amp;s=PRC" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Смена расы</strong>
Смените расу вашего персонажа (не меняя фракцию)
</a>
</li>
<li class="wow-service pcc">
<a href="/account/management/wow/services/character-services.html?l=WoW1&amp;r=EU&amp;s=PCC" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Измени персонажа</strong>
Измените внешний облик и, при желании, имя вашего персонажа.
</a>
</li>
<li class="wow-service pnc">
<a href="/account/management/wow/services/character-services.html?l=WoW1&amp;r=EU&amp;s=PNC" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Cмена имени</strong>
Переименуйте своего персонажа.
</a>
</li>
<li class="wow-service pgs">
<a href="/account/management/wow/services/pgs-select.html?l=WoW1&amp;r=EU&amp;s=PGS" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Услуги для гильдии</strong>
Переносите главу гильдии в другой игровой мир и (или) в другую фракцию. Вы также можете переименовать свою гильдию.
</a>
</li>
</ul>
</div>
<div class="content additional-services" id="additional-services">
<ul>
<li class="wow-service wow_ptr">
<span>
<span class="icon glow-shadow-3"></span>
<strong>Тестовый игровой мир</strong>
С этой записи можно играть в тестовом игровом мире.
<a class="icon-set download-client" href="/account/management/download/?show=wow">Установить или переустановить игру</a>
</span>
</li>
<li class="wow-service wow_esl">
<a href="http://www.esl.tv/game/wow/" onclick="">
<span class="icon glow-shadow-3"></span>
<strong>Blizzard eSports на ESL TV</strong>
Захватывающие поединки и яркие шоу: все киберсражения по играм Blizzard Entertainment® на одном канале!
</a>
</li>
</ul>
</div>
<div class="content referrals-rewards" id="referrals-rewards">
<p class="no-subcategory-desc">У вас сейчас нет активных приглашений. Подробнее об услуге «Пригласи друга» см. <a href="http://eu.battle.net/wow/shop/recruit-a-friend/" target="_blank">здесь</a>.</p>
</div>
<div class="content game-time-subscriptions" id="game-time-subscriptions">
<ul>
<li class="wow-service wow_agc">
<a href="/account/management/add-game.html?accountName=WoW1" onclick="DashboardForm.show($('#add-game-time')); return false;">
<span class="icon glow-shadow-3"></span>
<strong>Карта игрового времени</strong>
С помощью карты предоплаты игрового времени для World of Warcraft вы можете оплачивать подписку поэтапно.
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="cancel-subs-dialog" style="display: none" id="cancel-subs-dialog-EU682788" title="Отменить">
<p class="error" id="cancel-subs-error-EU682788"></p>
<p>Вы точно хотите отменить эту подписку?</p>
</div>
<script type="text/javascript">
//<![CDATA[
$(function() {
var inputs = new Inputs('#game-time, #limited-game-time-purchase');
$('#game-time [checked]').parents('label').addClass('selected');
var cancelSubDialog = $('.cancel-subs-dialog').dialog({
autoOpen: false,
modal: true,
position: "center",
resizeable: false,
closeText: "Закрыть",
buttons: {
'Да': function() {
$.ajax({
url: "/account//management/subscriptions/cancel.html",
data: {
subscriptionId: "EU682788",
csrftoken: "8a348f2f-4bcb-4342-b9ec-ef8421ee1271"
},
type: 'POST',
success: function(r) {
if (r.subscriptionError) {
$("#cancel-subs-" + subscriptionId).text(r.subscriptionError);
} else {
window.location.reload();
}
}
});
return false;
},
'Нет': function() {
$(this).dialog("close");
}
},
open: function() {
$(".ui-dialog-buttonpane").find("button").addClass("button1").find(":first").addClass("first");
},
close: function() {
Core.trackEvent('subscriptions', 'confirm-cancel-primary', 'yes');
}
});
$("#wow-cancel-subscription").click(function(e) {
cancelSubDialog.dialog("open");
e.preventDefault();
});
});
//]]>
</script>
</div>
</div>
</div>
@endsection