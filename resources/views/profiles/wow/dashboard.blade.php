@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/dashboard.0eBg2.css') }}" />
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/wow/dashboard.3qBrx.css') }}" />
<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/wow/dashboard-ie.1muX5.css') }}" />
<![endif]-->
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/dashboard-ie6.2v0KO.css') }}" />
<![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/wow/dashboard-trial.2MuzP.css') }}" />
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/wow/dashboard-trial-ie6.22CbS.css') }}" />
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
<dt class="subcategory">Регион</dt>
<dd class="account-region EU">Европа (EU)</dd>
</dl>
</div>
<div class="section available-actions">
<ul class="game-time">
<li class="download-client">
<a href="{{ route('download-game') }}">Установить или переустановить игру</a>
</li>
<div class="starter-button-wrapper">
<button type="button" class="starter-button" onclick="DashboardForm.show($('#enter-game-key'));">Введите ключ</button>
</div>
</ul>
</div>
<div class="clear"></div>
</div>
<div class="dashboard-form" id="enter-game-key">
<form action="{{ route('claim-code-action') }}" method="post">
{{ csrf_field() }}
<div class="hiddenInputWrapper">
<input type="hidden" name="confirmed" value="true" />
<input type="hidden" name="codeType" value="WOW" />
<input type="hidden" name="wowAccountLabel" value="WoW1" />
<input type="hidden" name="legalAgreementAccepted" value="false" />
<input type="hidden" name="product" value="" />
<input type="hidden" name="region" value="EU" />
</div>
<h4>Введите ключ</h4>
<p></p>
<p class="simple-input">
<input type="text" name="key" value="" class="input border-5 glow-shadow-2" maxlength="320" tabindex="1" />
<button class="ui-button button1 disabled" type="submit" disabled="disabled" tabindex="1"><span class="button-left"><span class="button-right">Активировать</span></span></button>
<a class="ui-cancel "
href="#"
onclick="DashboardForm.hide($('#enter-game-key')); return false;"
tabindex="1">
<span>
Отмена </span>
</a>
</p>
<p>Пример: EQX1Z94-IWJFYBI-ZQKGH1E-L586RZU-PE8QAR3-QDO6I5S-J2I5CPT-629ZC98</p>
</form>
</div>
<script type="text/javascript">
//<![CDATA[
$(function() {
});
//]]>
</script>
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
</div>
</div>
</div>
</div>
@endsection