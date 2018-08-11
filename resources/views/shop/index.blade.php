@extends('layouts.shop')

@section('content')
<router-outlet _ngcontent-c0="" class="ng-tns-c0-0"></router-outlet>
<storefront-browsing-page _nghost-c27="" class="ng-star-inserted">
    <div _ngcontent-c27="" class="browsing-page">
<header _ngcontent-c27="">
		<storefront-page-header _ngcontent-c27="" _nghost-c9="" class="ng-tns-c9-17"><!----><div _ngcontent-c9="" class="storefront-page-header ng-tns-c9-17 ng-star-inserted">
	<!---->

	<!----><!---->
		<!----><!---->
			<storefront-banner _ngcontent-c9="" _nghost-c13="" class="ng-tns-c13-19 ng-tns-c9-17 ng-star-inserted"><!----><div _ngcontent-c13="" class="storefront-banner ng-tns-c13-19 ng-trigger ng-trigger-fadeInOut ng-star-inserted" style="background-color: rgb(32, 33, 37);">
	<div _ngcontent-c13="" class="background-container">
		<picture _ngcontent-c13="" class="ng-tns-c13-19">

			<source _ngcontent-c13="" class="ng-tns-c13-19" media="(min-width: 1921px) and (min-height: 1460px)" srcset="//bnetproduct-a.akamaihd.net//fed/f77ddebad0d9a5ebc511cf06ea11d5d3-2200x700.jpg">


			<source _ngcontent-c13="" class="ng-tns-c13-19" media="(min-width: 1921px) and (min-height: 1160px)" srcset="//bnetproduct-a.akamaihd.net//fca/d7d4efa036b09ea723b0c3a1907e730c-2200x500.jpg">


			<source _ngcontent-c13="" class="ng-tns-c13-19" media="(min-width: 1921px)" srcset="//bnetproduct-a.akamaihd.net//fef/8cc096cf6cb93886d5d4aa57c466fae6-2200x300.jpg">
			<source _ngcontent-c13="" class="ng-tns-c13-19" media="(min-width: 1601px)" srcset="//bnetproduct-a.akamaihd.net//ff1/bd35ef603d006396ee75068c097fc861-1900x300.jpg">
			<source _ngcontent-c13="" class="ng-tns-c13-19" media="(min-width: 1025px)" srcset="//bnetproduct-a.akamaihd.net//f83/19a4efb87217ea4f2094a9e50166a733-1600x300.jpg">
			<source _ngcontent-c13="" class="ng-tns-c13-19" media="(min-width: 768px)" srcset="//bnetproduct-a.akamaihd.net//7c/0f988d135c272fe04dbf9a0eae5f07b8-1024x300.jpg">


			<source _ngcontent-c13="" class="ng-tns-c13-19" media="(max-width: 768px)" srcset="//bnetproduct-a.akamaihd.net//fbb/a803abd5915831deb6002f08b98fd4cf-1534x640.jpg">


			<img _ngcontent-c13="" class="ng-tns-c13-19" src="//bnetproduct-a.akamaihd.net//fed/f77ddebad0d9a5ebc511cf06ea11d5d3-2200x700.jpg">
		</picture>
		<!---->
	</div>
	<div _ngcontent-c13="" class="content-container app-container">
		<storefront-banner-call-to-action _ngcontent-c13="" class="ng-tns-c13-19 ng-tns-c23-20" _nghost-c23=""><!----><div _ngcontent-c23="" class="storefront-banner-call-to-action ng-tns-c23-20 ng-star-inserted" style="">
	<!----><img _ngcontent-c23="" class="ng-tns-c23-20 height-responsive ng-star-inserted" src="//bnetproduct-a.akamaihd.net//79/5c8570d050e162e091b699bea4c7bcd8-battle-for-azeroth-en-clipped-1200x536.png">
	<!---->
	<!---->
	<!---->
</div>
</storefront-banner-call-to-action>
	</div>
</div>
</storefront-banner>


		<!---->

</div>
</storefront-page-header>
	</header>

    <main _ngcontent-c27="">
		<!----><!---->
			<storefront-browsing-card-group-nav _ngcontent-c27="" _nghost-c28="" class="ng-tns-c28-18 ng-star-inserted"><div _ngcontent-c28="" class="browsing-card-group-nav app-container">
	<!----><div _ngcontent-c28="" class="group-link-container ng-tns-c28-18 ng-trigger ng-trigger-fadeInOutStaggered ng-star-inserted">
		<!---->@foreach($data as $item)<div _ngcontent-c28="" class="group-link ng-tns-c28-18 ng-star-inserted" id="group-link-{{ $item['key'] }}" style="">
			<span _ngcontent-c28="" class="group-name h7">{{ $item['title_cat'] }}</span>
		</div>@endforeach
	</div>
	<div _ngcontent-c28="" class="group-filter-container">
		<!----><storefront-browsing-card-group-filter _ngcontent-c28="" _nghost-c29="" class="ng-tns-c28-18 ng-star-inserted"><div _ngcontent-c29="" class="browse-page-filter">
	<form _ngcontent-c29="" class="form-inline mt-2 mt-sm-0 ng-untouched ng-pristine ng-valid" novalidate="">
		<div _ngcontent-c29="" class="form-group">
			<label _ngcontent-c29="" class="mr-sm-2" for="browse-page-filter-group-by">
				Группировка
			</label>
			<select _ngcontent-c29="" class="custom-select" id="browse-page-filter-group-by">
				<!----><option _ngcontent-c29="" value="1" class="ng-star-inserted">
					Категории
				</option><option _ngcontent-c29="" value="0" class="ng-star-inserted">
					Без группировки
				</option>
			</select>
		</div>
		<div _ngcontent-c29="" class="form-group">
			<label _ngcontent-c29="" class="mr-sm-2" for="browse-page-filter-sort-by">
				Сортировка
			</label>
			<select _ngcontent-c29="" class="custom-select" id="browse-page-filter-sort-by">
				<!----><option _ngcontent-c29="" value="0" class="ng-star-inserted">
					Популярное
				</option><option _ngcontent-c29="" value="1" class="ng-star-inserted">
					Цена: низкая
				</option><option _ngcontent-c29="" value="2" class="ng-star-inserted">
					Цена: высокая
				</option><option _ngcontent-c29="" value="3" class="ng-star-inserted">
					Скидка
				</option><option _ngcontent-c29="" value="4" class="ng-star-inserted">
					Название
				</option>
			</select>
		</div>
	</form>
</div>
</storefront-browsing-card-group-filter>
	</div>
</div>
</storefront-browsing-card-group-nav>
<div _ngcontent-c27="" class="app-container ng-star-inserted">
    <storefront-browsing-card-group _ngcontent-c27="" _nghost-c5="" class="ng-star-inserted"><div _ngcontent-c5="" class="browsing-card-group has-blurb quantity-responsive" id="recommended" data-max-rows="2"></div>
</storefront-browsing-card-group>
    @foreach($data as $item)
<storefront-browsing-card-group _ngcontent-c27="" _nghost-c11="" class="ng-star-inserted"><div _ngcontent-c11="" class="browsing-card-group has-blurb" id="{{ $item['key'] }}">

	<!----><!---->
		<div _ngcontent-c11="" class="header ng-star-inserted">
			<div _ngcontent-c11="" class="header-content">
				<h3 _ngcontent-c11="" class="blz-gap-bottom-md">{{ $item['title_cat'] }}</h3>
				<!----><p _ngcontent-c11="" class="blurb ng-star-inserted">
					{{ $item['description'] }}</p>
			</div>
		</div>

		<storefront-browsing-card-group-animated _ngcontent-c11="" class="main ng-tns-c20-26 ng-trigger ng-trigger-growInOutStaggered ng-star-inserted">
		@foreach($item['shop'] as $items)<!----><storefront-browsing-card _ngcontent-c11="" storefront-browsing-card-group-animated-item="" _nghost-c21="" class="ng-star-inserted" style=""><div _ngcontent-c21="" class="browsing-card">
	<!---->

	<storefront-link _ngcontent-c21="" _nghost-c3=""><!---->

<!---->

<!----><a _ngcontent-c3="" title="" href="{{ route('shop.item', ['name' => $items->short_code ]) }}" class="ng-star-inserted">

	<!---->

		<!---->
		<div _ngcontent-c21="" class="background ng-star-inserted">
			<div _ngcontent-c21="" class="vertical" style="background: url(&quot;/uploads/shop/{{ $items->vertical }}&quot;) rgb(51, 4, 4);"></div>
			<div _ngcontent-c21="" class="horizontal" style="background: url(&quot;/uploads/shop/{{ $items->horizontal }}&quot;) rgb(51, 4, 4);"></div>
		</div>

		<div _ngcontent-c21="" class="content ng-star-inserted">
			<div _ngcontent-c21="" class="family-img-container">
				<!----><div _ngcontent-c21="" class="family-icon-container ng-star-inserted">
					<img _ngcontent-c21="" src="{{ asset_media('/static/2.4.0/images/family-icons/world-of-warcraft.svg') }}">
				</div>
			</div>

			<h6 _ngcontent-c21="" class="name">{{ $items['title'] }}<!----></h6>


			<!---->
			<div _ngcontent-c21="" class="description">{{ $item['title_cat'] }}</div>

			<!----><div _ngcontent-c21="" class="price ng-star-inserted">
				<storefront-price _ngcontent-c21="" _nghost-c24=""><span _ngcontent-c24="" class="price"><span class="full">{{ $items['price'] }}&nbsp;₽</span></span>
</storefront-price>
			</div>
		</div>



</a>
</storefront-link>
</div>

</storefront-browsing-card>
@endforeach
</storefront-browsing-card-group-animated>

	<!---->

</div>
</storefront-browsing-card-group>
    @endforeach
</div>

</main>
    </div>
</storefront-browsing-page>
@endsection