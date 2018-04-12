@extends('layouts.shop')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="/wow/css/product.css?v58" />
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
        background: {{ $item->item_background_color }} url("/wow/images/shop/mounts/{{ $item->item_background }}_1920.jpg") no-repeat center -200px !important;
    }
    .body-content {
        background: none !important;
    }
    .navbar-static {
        background: {{ $item->item_background_color }} url("/wow/images/shop/mounts/{{ $item->item_background }}_1920.jpg") no-repeat center 0 !important;
    }
    @media (max-width: 1280px) {
        html,
        body {
            background: {{ $item->item_background_color }} url("/wow/images/shop/mounts/{{ $item->item_background }}_1280.jpg") no-repeat center -200px !important;
        }
        .body-content {
            background: none !important;
        }
        .navbar-static {
            background: {{ $item->item_background_color }} url("/wow/images/shop/mounts/{{ $item->item_background }}_1280.jpg") no-repeat center 0 !important;
        }
    }
    @media (max-width: 1024px) {
        html,
        body {
            background: {{ $item->item_background_color }} url("/wow/images/shop/mounts/{{ $item->item_background }}_1024.jpg") no-repeat center -200px !important;
        }
        .body-content {
            background: none !important;
        }
        .navbar-static {
            background: {{ $item->item_background_color }} url("/wow/images/shop/mounts/{{ $item->item_background }}_1024.jpg") no-repeat center 0 !important;
        }
    }
</style>
<div class="body-content">
    <div class="product-container" id="pageTop">
        <div class="grid-container">
            <div class="grid-50 app-grid-100 buybox no-logo">
                <div  class="product-badge-and-title">
                    <div class="product-badge-container">
                        <i class="product-badge wow-product-badge"></i>
                    </div>
                    <div class="product-title-and-type">
                        <h1 class="product-title">{{ $item->title }}</h1>
                        <h2 class="heading-6 product-type">World of Warcraft&reg; In-Game Mount </h2>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="product-single">
                        <span class="heading-1 product-priceline">
                            <span class="product-price ">
                                <span class="currency-code">
                                    USD
                                </span>
                                {{ $item->price }}
                            </span>
                        </span>
                    <div class="product-actions" data-bnet-shop="product-action-holder">
                        @guest
                        <a class="btn btn-large btn-primary" href="{{ route('login') }}" tabindex="1" data-gtm-product-name="EU World of Warcraft� In-Game Mount:Celestial Steed">Приобрести</a>
                        @else
                        <a class="btn btn-large btn-primary" href="{{ route('shop.buy', ['name' => $item->short_code]) }}" tabindex="1" data-gtm-product-name="EU World of Warcraft� In-Game Mount:Celestial Steed">Приобрести</a>
                        @endguest
                    </div>
                </div>
                <div class="product-requirements" id="product-requirements">
                    <ul>
                        <li>
                            Требуется базовая игра World of Warcraft                        </li>
                        <li>
                            <a href="{{ route('claim-code') }}" data-external="sso">
                               Использовать код                                <i class="icon-blue icon-external-link"></i>
                            </a>
                        </li>
                        <li>Стоимость с учетом любых налогов и сборов</li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <script>
        //<![CDATA[
        var Msg = Msg || {},
        disablePurchaseAndMedia = false;
        Msg.productSlug = "mount-Celestial Steed";
        $(function() {
            $("#featureMediaLightbox").mediaLightbox();
        });
        (function() {
            var tag = document.createElement("script");
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName("script")[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        })();
        //]]>
    </script>
</div>
@endsection