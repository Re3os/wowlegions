@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/add-game.1y5GJ.css') }}" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/add-game-ie7.3qZni.css') }}" /><![endif]-->
@endsection

@section('js')
<script type="text/javascript" src="{{ asset_media('/account/static/js/management/add-game.4G4gU.js') }}"></script>
@endsection

@section('content')
<div id="layout-middle">
			<div class="wrapper">
				<div id="content">@if (session('error'))
				    <div class="alert error border-4 glow-shadow closeable">
			<div class="alert-inner">
				<div class="alert-message">
						<p class="title"><strong>Произошла ошибка.</strong></p>

						<p class="error.addGame.gameKey.invalid">{{ session('error') }}</p>
				</div>
			</div>
				<a class="alert-close" href="#" onclick="$(this).parent().fadeOut(250, function() { $(this).css({opacity:0}).animate({height: 0}, 100, function() { $(this).remove(); }); }); return false;">Закрыть</a>
	<span class="clear"><!-- --></span>
		</div> @endif
         @if (session('success'))
				    <div class="alert success border-4 glow-shadow closeable">
			<div class="alert-inner">
				<div class="alert-message">
						<p class="title"><strong>Ваше приглашение успешно отправлено.</strong></p>
						<p class="success.addGame.gameKey.invalid">{{ session('success') }}</p>
				</div>
			</div>
				<a class="alert-close" href="#" onclick="$(this).parent().fadeOut(250, function() { $(this).css({opacity:0}).animate({height: 0}, 100, function() { $(this).remove(); }); }); return false;">Закрыть</a>
	<span class="clear"><!-- --></span>
		</div> @endif
	<div class="add-game">
		<div id="page-header">
			<h2 class="subcategory">Управление игрой</h2>
			<h3 class="headline">Приглашение друга</h3>
		</div>
		<div class="introduction"><p>В этом разделе вы можете пригласить друга в игру, за это вы получите подарки</p>
</div>

	<div class="section-box border-5 code-claim">
		<form method="post" action="{{ route('process') }}">
		    {{ csrf_field() }}

			<p class="caption"><label for="key">Введите E-Mail</label></p>
			<p class="simple-input required">
                <input type="email" id="email" name="email" value="" class="input border-5 glow-shadow-2 inline-input" maxlength="320" tabindex="1"    />
			</p>

	<fieldset class="ui-controls " >
        <button class="ui-button button1" type="submit">
            <span class="button-left">
                <span class="button-right">Пригласить</span>
            </span>
        </button>
	</fieldset>
		</form>
	</div>
    <div class="code-claim-information">
			<h4 class="headline">Информаци</h4>

    <ul class="form-titles">
    <li>
        <a href="#form-gameItem" class="form-anchor">
            <span class="icon-32 closed"></span>
            <span class="icon-32-label form-name">Какую награду вы получите?</span>
        </a>

    <div class="sub-form hide-element" id="form-gameItem">
        <ul>
            <li>За одного приглашённого друга 15 золотых монет</li>
            <li>За второго приглашённого друга 40 золотых монет</li>
            <li>За пять приглашённых друзей 85 золотых монет и маунта "кобальтового дракона из стаи крыльев пустоты" </li>
            <li>За десять приглашённых друзей вы получите 100 золотых монет, "Краткую историю эпох" и спутника "Мятежного беса"</li>
			<li>За тридцать приглашённых друзей вы получите 100 000 золотых монет и спутника "Сувенирный мурлок"</li>
        </ul>

        <p>Награды могут менятся*</p>
    </div>

    </li>
    </ul>
	<span class="clear"><!-- --></span>
		<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function() {
			FormAnchor.initialize();
		});
		//]]>
		</script>
		</div>
	</div>

</div>
</div>
</div>
<div id="layout-bottom-divider"></div>

@endsection