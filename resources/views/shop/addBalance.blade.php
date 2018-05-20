@extends('layouts.shop')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="/wow/css/account/balance.min-1c28a40d9c.css?v58" />
@endsection

@section('style')
browse-template product-family-wow
@endsection

@section('content')
<style>
    html {
        height: auto;
        min-width: 480px;
    }
    body {
        height: 100%;
    }
    html,
    body {
        background: #0f2a48 url("/wow/images/backgrounds/bnet-background-1920.jpg") no-repeat center -200px !important;
    }
    .body-content {
        background: none !important;
    }
    .navbar-static {
        background: #0f2a48 url("/wow/images/backgrounds/bnet-background-1920.jpg") no-repeat center 0 !important;
    }
    @media (max-width: 1280px) {
        html,
        body {
            background: #0f2a48 url("/wow/images/backgrounds/bnet-background-1280.jpg") no-repeat center -200px !important;
        }
        .body-content {
            background: none !important;
        }
        .navbar-static {
            background: #0f2a48 url("/wow/images/backgrounds/bnet-background-1280.jpg") no-repeat center 0 !important;
        }
    }
    @media (max-width: 1024px) {
        html,
        body {
            background: #0f2a48 url("/wow/images/backgrounds/bnet-background-1024.jpg") no-repeat center -200px !important;
        }
        .body-content {
            background: none !important;
        }
        .navbar-static {
            background: #0f2a48 url("/wow/images/backgrounds/bnet-background-1024.jpg") no-repeat center 0 !important;
        }
    }
</style>
<div class="body-content">
<div class="grid-container">
<div class="balance-wrapper">
<div class="grid-100">
<h1>Кошелек WoWLegions</h1>
<h2 class="heading-6">Пополнение баланса кошелька WoWLegions</h2>
</div>
<div class="balance-misc-warning">
<div class="grid-66 suffix-33 mobile-grid-100">
<div class="alert alert-icon alert-warning">
<p>Средства, зачисленные в кошелек WoWLegions, поступают в ваше распоряжение в течение суток после осуществления платежа.</p>
</div>
</div>
</div>
<form class="add-balance-form" id="add-balance-form" action="{{ route('pay-balanceAction') }}" method="post">
    {{ csrf_field() }}
<fieldset class="grid-66 suffix-33 mobile-grid-100">
<legend>Введите сумму, которую вы хотите зачислить:</legend>
<div class="control-group balance-input-control-group">
<div class="controls">
<div class="balance-input-wrapper mobile-grid-100">
<div id="balance-input" class="balance-input input-prepend">
<span class="currency-display add-on grid-10 mobile-grid-20">RUB.</span>
<input type="text" class="balance-input-text grid-40 mobile-grid-80" id="balance-input-text" name="balanceAmount" autocomplete="off" autofocus="autofocus" />
</div>
</div>
<div class="tooltip-wrapper grid-50 mobile-grid-100">
<span class="tooltip right" id="purchase-warning-tooltip">
<span class="tooltip-arrow"></span>
<span class="tooltip-inner alert-icon"></span>
</span>
</div>
</div>
</div>
<span id="balance-input-help" class="help-block balance-help-block"><i class="icon-exclamation-circle icon-gray"></i>У вас в кошельке должно быть не менее 10,00 RUB и не более 9 999,00 RUB.</span>
</fieldset>
<div class="form-actions">
<button class="btn btn-primary" id="payment-submit" data-gtm-id="payment-submit" tabindex="1" type="submit" disabled="disabled" data-bnet-shop="payment-submit">Перейти к платежу</button>
<a class="btn" href="{{ route('shop') }}" data-bnet-shop="cancel-btn">Отмена</a>
</div>
<div class="form-foot-notes">
<p>У вас есть карта предоплаты? Тогда вы можете <a href="/account/management/claim-code.html" target="_blank" data-bnet-shop="balance-redeem-lnk">использовать ее</a>.</p>
<div class="balance-legal-disclaimer">
<p>
Средства, зачисляемые в кошелек, не подлежат возмещению и не могут быть перечислены из кошелька обратно.<br/>
</p>
</div>
</div>
</form>
<script type="text/javascript">
//<![CDATA[
var addBalanceSettings = {
decimalPointChar: ",",
currencyFractionDigits: 2,
maxBalanceAllowed: 10000,
remainingMaxBalanceAllowed: 9959,
maxBalanceAllowedType: "max",
minBalanceRequired: 10,
hasAuthenticator: false,
authenticatorCap: 5000,
remainingAuthenticatorLimit: 4959
};
var addBalanceMsgs = {
authenticatorRequired: "Чтобы зачислить в кошелек сумму свыше 5 000,00 RUB, необходимо прикрепить к вашей записи Blizzard Authenticator.",
capped: {
max: "Такую сумму зачислить нельзя, иначе объем средств в кошельке превысит допустимый максимум (10 000,00 RUB).",
},
minRequired: {
minRequired: "Минимальная сумма — 10,00 RUB."
},
wrongFormat: {
wrongFormat: "Укажите сумму в корректном формате, например: 15,23"
}
};
//]]>
</script>
</div>
</div>
</div>
<script type="text/javascript" src="/wow/js/account/balance.min-2aaad4fc44.js"></script>
@endsection