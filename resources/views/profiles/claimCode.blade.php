@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="//bneteu-a.akamaihd.net/account/static/css/management/add-game.3obun.css" />
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="//bneteu-a.akamaihd.net/account/static/css/management/add-game-ie7.2qMph.css" /><![endif]-->

@endsection

@section('js')
<script type="text/javascript" src="//bneteu-a.akamaihd.net/account/static/js/management/add-game.0t7VS.js"></script>
@endsection

@section('content')
<div id="layout-middle">
			<div class="wrapper">
				<div id="content">
	<div class="add-game">
		<div id="page-header">
			<h2 class="subcategory">Управление игрой</h2>
			<h3 class="headline">Использование кода</h3>
		</div>

		<div class="introduction">			<p>В этом разделе вы можете прикрепить игру с помощью ключа, использовать код для оплаты игрового времени или предмета, пополнить кошелек Blizzard с помощью карты предоплаты.</p>
</div>

	<div class="section-box border-5 code-claim">
		<form method="post" action="{{ route('claim-code') }}" id="add-game" onsubmit="return checkEntry(this);">
		{{ csrf_field() }}

			<p class="caption"><label for="key">Введите код</label></p>
			<p class="simple-input required">
                <input type="text" id="key" name="key" value="" class="input border-5 glow-shadow-2 inline-input" maxlength="320" tabindex="1"    />
			</p>

	<fieldset class="ui-controls " >

<button class="ui-button button1" type="submit" id="add-game-submit"><span class="button-left"><span class="button-right">Использовать код</span></span></button>
	</fieldset>
		</form>
	</div>

		<script type="text/javascript">
		//<![CDATA[
			function checkEntry(form) {
				if (!form.key.value) {
					$('#add-game p.caption, #key').addClass('form-error');
					$('#content').prepend(makeErrorBox(['Заполните, пожалуйста, все обязательные поля.']));
					UI.enableButton($('#add-game-submit'));
					return false;
				}
				return true;
			}

			function makeErrorBox(errorMsgs) {
				$('#content .alert').remove();
				var errorCount = errorMsgs.length;
				var errorHtml = ''
								+ '<div class="alert error closeable border-4 glow-shadow">'
								+ '<div class="alert-inner">'
								+ '<div class="alert-message">'
								+ '<p class="title"><strong>Произошла ошибка.</strong></p>';
				if (errorCount>1) {
					errorHtml += '<ul>';
					for (var i=0;i<errorCount;i++) {
						errorHtml += '<li>' + errorMsgs[i] + '</li>';
					}
					errorHtml += '</ul>';
				} else {
					errorHtml += '<p>' +errorMsgs[0]+ '</p>';
				}
				errorHtml += ''
							+ '</div>'
							+ '</div>'
							+ '</div>';
				return errorHtml;
			}
		//]]>
		</script>

		<div class="code-claim-information">
			<h4 class="headline">Вы не знаете, как использовать код?</h4>
			<p class="">Выберите, о каком коде речь.</p>

    <ul class="form-titles">
    <li>
        <a href="#form-game" class="form-anchor">
            <span class="icon-32 closed"></span>
            <span class="icon-32-label form-name">Ключ игры</span>
        </a>

    <div class="sub-form hide-element" id="form-game">
        <ul>
            <li>Если вы приобрели розничный экземпляр игры в магазине, то ключ — в коробке.</li>
                <li>Если вы получили электронную версию игры в подарок, то ключ — в письме, которое вы получили по электронной почте. Вы можете ввести его здесь или просто щелкнуть по ссылке в этом письме.</li>
        </ul>
    </div>

    </li>
    <li>
        <a href="#form-gameTime" class="form-anchor">
            <span class="icon-32 closed"></span>
            <span class="icon-32-label form-name">Код для оплаты игрового времени</span>
        </a>

    <div class="sub-form hide-element" id="form-gameTime">
        <div class="prepaid-card-image"></div>
        <ul>
            <li>Если вы приобрели карту для оплаты игрового времени, сотрите защитный слой (серебристая полоска на карте): код указан под ней. Учтите, что когда вы сотрете защитный слой, карта будет считаться использованной, и вы больше не сможете вернуть ее в магазин.</li>
            <li>Если вы получили игровое время в подарок, то ключ — в письме, которое вы получили по электронной почте. Вы можете ввести его здесь или просто щелкнуть по ссылке в этом письме.</li>
        </ul>
    </div>

    </li>
    <li>
        <a href="#form-gameItem" class="form-anchor">
            <span class="icon-32 closed"></span>
            <span class="icon-32-label form-name">Код для получения предмета</span>
        </a>

    <div class="sub-form hide-element" id="form-gameItem">
        <ul>
            <li>Если вы получили предмет в подарок, то ключ — в письме, которое вы получили по электронной почте. Вы можете ввести его здесь или просто щелкнуть по ссылке в этом письме.</li>
                <li><strong>Если вы хотите использовать код из ККИ World of Warcraft или код для получения предмета или питомца, выпущенный до BlizzCon 2009, сделать это вы можете на странице <a href="http://www.worldofwarcraft.com/misc/promotion.html" onclick="window.open(this.href);return false">использования кода для World of Warcraft</a>.</strong></li>
        </ul>

        <p>Предмет будет выслан по внутриигровой почте каждому персонажу, который может его получить, на вашей записи Blizzard или World of Warcraft (подробнее см. в описании предмета). Прежде чем забирать предмет, проверьте, хватит ли у персонажа места в сумках.</p>
    </div>

    </li>
    <li>
        <a href="#form-balance" class="form-anchor">
            <span class="icon-32 closed"></span>
            <span class="icon-32-label form-name">Код для пополнения кошелька</span>
        </a>

    <div class="sub-form hide-element" id="form-balance">
        <div class="prepaid-card-image"></div>
        <ul>
            <li>Если вы приобрели карту предоплаты для пополнения кошелька, сотрите защитный слой (серебристая полоска на карте): код указан под ней. Учтите, что когда вы сотрете защитный слой, карта будет считаться использованной, и вы больше не сможете вернуть ее в магазин.</li>
        </ul>

        <p>
                Подробнее читайте в разделе <a href="http://eu.battle.net/support/article/balance-card-faq" onclick="window.open(this.href);return false">вопросов и ответов по кошельку Blizzard</a>.
        </p>
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

		<script type="text/javascript">
		//<![CDATA[
        Cookie.create('DIABLOIIISIGNUP', '1', {
            expires: 2160,
            path: '/account'
        });
		//]]>
		</script>


				</div>
			</div>
		</div>
		<div id="layout-bottom-divider"></div>

@endsection