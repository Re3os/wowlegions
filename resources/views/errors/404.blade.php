@extends('layouts.app')

@section('css')
<link href="https://media.wowlegions.ru/static/styles.1a45ed68c2232ee19386.bundle.css" rel="stylesheet">
<style>.error-page[_ngcontent-c37]{position:relative}.error-page[_ngcontent-c37]   .error-container[_ngcontent-c37]{position:relative;height:800px;overflow:hidden}.error-page[_ngcontent-c37]   .error-container[_ngcontent-c37]:before{content:"";display:block;clear:both;height:0}.error-page[_ngcontent-c37]   .error-container[_ngcontent-c37]   .error-background-image[_ngcontent-c37]{position:absolute;top:0;bottom:0;left:0;right:0;display:block;background-repeat:no-repeat;background-position:top;background-size:cover}.error-page[_ngcontent-c37]   .error-container[_ngcontent-c37]   .error-video-container[_ngcontent-c37]{position:absolute;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%);height:100%}.error-page[_ngcontent-c37]   .error-container[_ngcontent-c37]   .error-video-container[_ngcontent-c37]   video[_ngcontent-c37]{display:block}.error-page[_ngcontent-c37]   .error-container[_ngcontent-c37]   .error-content-container[_ngcontent-c37]{position:absolute;bottom:0;left:50%;top:56%;-webkit-transform:translateX(-50%);transform:translateX(-50%);text-align:center;padding:0 20px;width:100%}.error-page[_ngcontent-c37]   .error-container[_ngcontent-c37]   .error-content-container[_ngcontent-c37]   .error-content-actions[_ngcontent-c37]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}</style>
@endsection

@section('content')
<div class="page-Home">
<storefront-error-page _nghost-c37="" class="ng-star-inserted"><div _ngcontent-c37="" class="error-page">
	<div _ngcontent-c37="" class="error-container">
		<div _ngcontent-c37="" class="error-background-image" style=""></div>
		<div _ngcontent-c37="" class="error-video-container">
			<video _ngcontent-c37="" autoplay="autoplay" class="HttpErrorPane-video" loop="loop" muted="muted" preload="preload" webkit-playsinline="true">
				<source _ngcontent-c37="" type="video/webm" src="{{ asset_media('/cms/gallery/c6/C6KLQ8BWWSKR1496179646097.webm') }}">
				<source _ngcontent-c37="" type="video/mp4" src="{{ asset_media('/cms/gallery/kr/KRYSJPOOWXX51496179560105.mp4') }}">
			</video>
		</div>
		<div _ngcontent-c37="" class="error-content-container">
			<h2 _ngcontent-c37="">404 — СТРАНИЦА НЕ НАЙДЕНА</h2>
			<p _ngcontent-c37="">Мы выслали за вами спасательный отряд мурлоков, они отведут вас в безопасное место.</p>
            			<div _ngcontent-c37="" class="error-content-actions">
				<a _ngcontent-c37="" class="btn btn-primary" href="{{ route('home') }}">Главная</a>
			</div>
		</div>
	</div>
</div>
</storefront-error-page>
</div>
@endsection