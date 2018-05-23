@extends('layouts.shop')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="/wow/css/account/balance.min-1c28a40d9c.css?v58" />
<link rel="stylesheet" type="text/css" media="all" href="/wow/css/account/purchase.min-423a24256b.css?v58" />
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
<div class="grid-container purchase-content ">
<div class="purchase-container">
<div class="purchase-column grid-parent mobile-grid-100">
<div class="purchase-sidebar">
<div class="product-summary clearfix">
<div class="product-image thumbnail">
<img src="//bnetproduct-a.akamaihd.net//22/b37dfded6404a8f84c07d8c1125719f3-blizzard-balance-640x360.jpg" alt="Кошелек Blizzard" title="" />
</div>
<div class="mobile-grid-100">
<div class="product-name-group">
<h6 class="product-desc-label">Вы приобретаете</h6>
<p class="product-name">
Кошелек Blizzard</p>
</div>
<div class="hide-on-mobile" id="payment-icons">
<span class="control-label">Мы принимаем:</span>
<div class="controls">
<div class="accepted-payment-icons">
<span class="icon-24-payment-paypal">paypal</span>
</div>
</div>
</div>
<div class="product-summary-information hide-on-mobile">
<div class="product-details-group">
<h6 class="product-desc-label">Подробнее</h6>
<ul class="product-features">
<li>
Покупка на сайте</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="purchase-column content-column grid-parent mobile-grid-100">
<div class="content-container">
<div id="payment-interface" data-bnet-shop-product-id="15989">
<div class="fragment-wrapper ru-ru" data-actionfield-option="PAYPAL">
<form id="payment-form" method="post" novalidate="novalidate" data-payment-method-id="PAYPAL">
<fieldset class="offsite-data">
<div class="grid-100 mobile-grid-100">
<div class="control-group">
<span class="help-block">
На Ваш счет зачислено <span id="total-cost-offsite" data-base-cost="{{ $balance }}"><span class="price-container">{{ $balance }}</span> <span class="currency-code">₽</span></span>.
</span>
</div>
</div>
</fieldset>
<div class="price-breakdown">
<div class="tax-breakdown hide">
<div>Всего</div>
<div><span class="price-container">{{ $balance }}</span><span class="currency-code">₽</span></div>
</div>
<div class="tax-breakdown hide">
<div>Налоги</div>
<div id="tax"><span class="price-container">0,00</span> <span class="currency-code">₽</span></div>
</div>
<div class="checkout-total spacious-total">
<div>
Итого (включая налоги)<span class="icon-question-circle tooltipstered" data-tooltips="tap" id="total-heading"></span>
</div>
<div data-base-cost="" id="total-cost">
<span class="price-container">{{ $balance }}</span> <span class="currency-code">₽</span> </div>
</div>
</div>
<div class="form-actions purchase-form-actions"></div>
</form>
</div></div>
</div>
</div>
<div class="hide-on-app hide-on-web hide-on-simple-checkout product-summary product-summary-information small-screen-details">
<div class="product-summary-information">
<div class="product-details-group">
<h6 class="product-desc-label">Подробнее</h6>
<ul class="product-features">
<li>
Покупка на сайте</li>
</ul>
</div>
</div>
</div>
</div>
<div class="grid-100 mobile-grid-100">
<div class="legal-info">
<div class="supplemental">
</div>
</div>
</div>
</div>
</div>
@endsection