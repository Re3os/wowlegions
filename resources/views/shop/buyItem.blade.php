@extends('layouts.shop')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="/wow/css/purchase.css?v58" />
@endsection

@section('style')
product-template video-enabled product-family-wow
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
    <div class="grid-container purchase-content">
        <div class="purchase-container">
            <div class="purchase-column grid-25 grid-parent">
                <div class="purchase-sidebar">
                    <div class="product-summary clearfix">
                        <div class="product-image thumbnail">
                            <img src="/uploads/shop/{{ $item->images }}" alt="{{ $item->title }}" title="" />
                        </div>
                        <div class="product-name-group">
                            <h6 class="product-desc-label">Вы приобретаете</h6>
                            <p class="product-name">
                                World of Warcraft&reg; In-Game Item:  {{ $item->title }}                            </p>
                        </div>
                        <div class="product-summary-information" id="product-summary-information">
                            <div class="product-price-group">
                                <h6 class="product-desc-label">Цена</h6>
                                <p class="mp-product-price">
                                    <span class="currency-code">₽</span> {{ $item->price }} </p>
                            </div>
                            <div class="product-details-group">
                                <h6 class="product-desc-label">Детали</h6>
                                <ul class="product-features">
                                    <li>
                                        <i class="icon-shopping-cart icon-gray"></i>
                                        Цифровая Загрузка                                    </li>
                                    <li>
                                        <i class="icon-globe-alt icon-gray"></i>
                                        Без привязки к региону                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="purchase-column grid-75 grid-parent">
                <h1 class="heading-1 purchase-heading">
                    Оплата <i class="icon-32-secure icon-32-white"></i>
                </h1>
                <div class="grid-70 suffix-30">
                    @if(Auth::user()->balance < $item->price)
                    <div class="alert alert-error alert-icon">
                        <p>В вашем кошельке недостаточно средств для оплаты этой покупки.</p>
                        <p><a href="{{ route('add-balance') }}" data-external="sso">Зачислите средства в кошелек </a> и попробуйте снова.</p>
                    </div>
                    @endif
                </div>
                <div class="grid-60 prefix-5 push-35 app-grid-100 app-prefix-0 app-push-0" id="checkout-payment-icons">
                    <span class="control-label">Мы принимаем:</span>
                    <div class="controls">
                        <div class="accepted-payment-icons">
                            <span class="icon-24-payment-battlenet-balance">battlenet-balance</span>
                        </div>
                    </div>
                </div>
                <div class="grid-35 pull-65 app-grid-70 app-pull-0" id="checkout-pay-with">
                    <fieldset class="pay-with">
                        <div class="control-group">
                            <label class="control-label" for="payment-option">Способы оплаты</label>
                            <div class="controls">
                                <div tabindex="1" class="select-box input-block" id="select-box-payment-option" data-select="select" data-original-id="payment-option" data-select-id="select-box-payment-option">
                                    <span class="current">
                                        <i class="icon-payment-battlenet-balance"></i>
                                        <span class="text">Purse {{ config('app.name', 'Laravel') }}</span>
                                    </span>
                                    <span class="arrow"></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="grid-35 suffix-65 app-grid-100 app-suffix-0">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Подробнее</label>
                            <span class="uneditable-input input-block saved-payment-info">
                                Баланс: {{ Auth::user()->balance }} ₽
                            </span>
                        </div>
                    </fieldset>
                </div>
                <div class="grid-70 suffix-30 app-grid-100 app-suffix-0">
                    <div class="checkout-total" id="checkout-total">
                        <div class="total">
                            <h2 class="heading-6 total-heading">
                                <span id="total-heading">
                                    <span data-tooltips="tap" class="tooltipstered">
                                        Итого <span>(включая налоги)</span>
                                        <i class="icon-question-circle icon-blue"></i>
                                    </span>
                                </span>
                            </h2>
                            <h3 class="heading-1 total-cost" id="total-cost" data-base-cost="{{ $item->price }}">
                               <span class="currency-code">₽</span> {{ $item->price }} </h3>
                        </div>
                    </div>
                        @if(Auth::user()->balance >= $item->price)
                        <form action="{{ route('shop.complete', ['name' => $item->short_code ]) }}" method="post">
                            {{ csrf_field() }}
                        <div class="form-actions purchase-form-actions">
                            <input type="hidden" value="{{ $item->title }}" name="itemName">
                            <button type="submit" class="btn btn-primary btn-wide" id="payment-submit" data-gtm-id="payment-submit" tabindex="1">
                                Оплатить
                            </button>
                            <a id="payment-cancel" class="cancel purchase-cancel btn" onclick="history.go(-2);" tabindex="1">Отмена</a>
                        </div>
                        </form>
                        @else
                        <a id="payment-cancel" class="cancel purchase-cancel btn" onclick="history.go(-2);" tabindex="1">Отмена</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection