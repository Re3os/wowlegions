@extends('layouts.shop')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="/wow/css/browse.css?v58" />
<link rel="stylesheet" type="text/css" media="all" href="/wow/css/shop/index.css?v58" />
@endsection

@section('style')
browse-template product-family-wow
@endsection

@section('content')
<div class="grid-container browse game wow">
        <div  class="logo-banner">
            <img class="family-logo" src="/wow/images/logos/logo-family-wow.png" alt="" />
        </div>
        <div class="browse-container">
            <div class="browse-column sidebar">
                <div class="sidebar-content">
                    <h3 class="heading-6 filter-by-type">
                        Фильтры                    </h3>
                    <ul class="filter-list nav nav-list">
                                                        <li>
                                    <a href="{{ $mount->appends(['sort' => 'votes'])->links() }}" class="checkbox-label">
                                            <span class="input-checkbox "></span>
                                            <span class="">
                                                <span class="filter-text">
                                                    mounts                                                </span>
                                                <span class="count">
                                                    (1)
                                                </span>
                                            </span>
                                    </a>
                                </li>
                                                        <li>
                                    <a href="/shop/?categories=pets" class="checkbox-label">
                                            <span class="input-checkbox "></span>
                                            <span class="">
                                                <span class="filter-text">
                                                    pets                                                </span>
                                                <span class="count">
                                                    (1)
                                                </span>
                                            </span>
                                    </a>
                                </li>
                                                        <li>
                                    <a href="/shop/?categories=items" class="checkbox-label">
                                            <span class="input-checkbox "></span>
                                            <span class="">
                                                <span class="filter-text">
                                                    items                                                </span>
                                                <span class="count">
                                                    (1)
                                                </span>
                                            </span>
                                    </a>
                                </li>
                                            </ul>
                </div>
            </div>
            <div class="browse-column main">
                                                <h2 class="filter-title">Mounts</h2>
                    <ul class="product-card-container thumbnails">
                    @foreach($mount as $item)
                    <li>
                        <a class="product-link" href="{{ route('shop.mount', ['name' => $item->short_code ]) }}" tabindex="1" data-gtm-click="productCardClick" data-gtm-product-name="In-Game Mount: {{ $item->title }}">
                            <div class="cover"></div>
                            <div class="thumbnail">
                                <img src="/wow/images/shop/mounts/{{ $item->images }}.jpg" alt="{{ $item->title }}" />
                                <div class="product-card-info">
                                    <h3 class="product-name">{{ $item->title }}</h3>
                                    <p class="product-price ">USD {{ $item->price }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    </ul>
                    <h2 class="filter-title">Items</h2>
                    <ul class="product-card-container thumbnails">
                    @foreach($items as $item)
                    <li>
                        <a class="product-link" href="{{ route('shop.item', ['name' => $item->short_code ]) }}" tabindex="1" data-gtm-click="productCardClick" data-gtm-product-name="In-Game Mount: {{ $item->title }}">
                            <div class="cover"></div>
                            <div class="thumbnail">
                                <img src="/wow/images/shop/items/{{ $item->images }}.jpg" alt="{{ $item->title }}" />
                                <div class="product-card-info">
                                    <h3 class="product-name">{{ $item->title }}</h3>
                                    <p class="product-price ">USD {{ $item->price }}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="grid-100 banner-spacer"></div>
    </div>
@endsection