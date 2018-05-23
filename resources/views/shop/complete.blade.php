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
                    Поздравляем с покупкой!                </h1>
                <div class="grid-75 suffix-25 app-grid-100 app-suffix-0">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Код Активации</label>
                            <span class="uneditable-input input-block saved-payment-info">{{ $code->digital_key }}</span>
                        </div>
                    </fieldset>
                </div>
                <div class="grid-70 suffix-30 app-grid-100 app-suffix-0">
                    <p class="purchase-help-text">Это ваш код активации предмета.<br />Для получения {{ $code->item_name }} вам необходимо перейти в  раздел <a href="{{ route('claim-code') }}"> Активации Кодов </a>, выбрать персонажа и ввести данный код<br/><h2>Внимание</h2> Данный код показан вам в первый и последний раз. Сохраните его, поскольку восстановление кода невозможно.<br />Вы так же получите копию кода по E-Mail</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection