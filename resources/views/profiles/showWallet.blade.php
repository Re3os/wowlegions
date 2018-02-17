@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="//bneteu-a.akamaihd.net/account/static/css/management/wallet.4BCfm.css" />
@endsection

@section('js')
<script type="text/javascript" src="//bneteu-a.akamaihd.net/account/static/js/inputs.0VDAS.js"></script>
<script type="text/javascript" src="//bneteu-a.akamaihd.net/account/static/js/management/wallet.22EU8.js"></script>
@endsection

@section('content')
<div id="layout-middle">
			<div class="wrapper">
				<div id="content">

    <div id="page-header">
        <h2 class="subcategory">Параметры</h2>
		<h3 class="headline">Оплата и подписка</h3>
    </div>
	<p>На этой странице вы можете указать, какими способами оплаты вы будете пользоваться в игре и в Интернет-магазине Blizzard.</p>
	<p><strong>Чтобы совершать покупки в игре, нужно либо указать основной способ оплаты, либо держать средства в кошельке Blizzard.</strong></p>
	<div class="wallet-container columns-2">

	<div class="column column-left">
	<div class="subtitle">
		<h4 class="help-link-right" data-tooltip="Ваш основной способ оплаты используется для покупок в игре и при оплате электронных товаров в Интернет-магазине Blizzard.">Основной способ оплаты</h4>
	</div>
	<div class="primary-payment">
	<h5>
		MASTERCARD XXXX
	</h5>

		<dl class="info-section name">
			<dt>Владелец карты</dt>
			<dd>
				NAME FAMILY
			</dd>
		</dl>

    <dl class="info-section options">
				<dd>
					<a href="/account/management/edit-payment-method.html?id=7753431" tabindex="1">
						<span class="icon-16 icon-account-edit"></span>
						<span class="icon-16-label">Обновить</span>
					</a>
				</dd>
			<dd>
				<a href="#" onclick="closeActionType='primary';$('#wallet-dialog-7753431').dialog('open'); return false;" tabindex="1" data-label="delete-default">
					<span class="icon-16 icon-account-delete"></span>
					<span class="icon-16-label">Удалить</span>
				</a>
			</dd>
		</dl>
	<div class="wallet-dialog-with-subs" style="display: none" id="wallet-dialog-7753431" title="Удалить?">

            <p>Подписок с таким способом оплаты: 1</p>
			<ul class="affected-subs-list">
					<li>World of Warcraft® Подписка на World of Warcraft® — 3 месяца</li>
			</ul>
            <div class="subscription-warning">Удалив этот способ оплаты, вы автоматически отмените все привязанные к нему подписки. Чтобы продолжать пользоваться услугой подписки, пожалуйста, укажите новый способ оплаты для автоматического списания средств.</div>
		<input type="hidden" class="wallet-id" value="7753431" />
	</div>


        <div>

<a class="ui-button button1" href="/account/management/add-payment-method.html"
><span class="button-left"><span class="button-right">Добавить способ оплаты</span></span></a>
        </div>

	</div>
	</div>

	<div class="column column-right">
	<div class="subtitle">
		<h4>
			Кошелек
			<span class="help-link-right" data-tooltip="Кошелек Blizzard можно использовать для покупок и в игре, и на сайте."></span>
		</h4>
	</div>
	<div class="wallet-balance">
		<h5>
			242,00 РУБ
		</h5>
	<div class="info-section">
		<div class="info-section pending-balance-section  " style="display: inline-block">
			<div class="help-link-right" data-tooltip="Средствами, которые вы зачислите в кошелек, можно пользоваться не сразу. Операция должна пройти проверку. Это может занять до 3 дней.">
				ПРОВЕРКА ОПЕРАЦИИ
			</div>
			<div>0,00 РУБ</div>
		</div>
		<div class="info-section options">
				<a href="/account/management/claim-code.html">
    				<span class="icon-16 icon-account-key"></span>
					<span class="icon-16-label">Использовать код</span>
				</a>
		</div>
	</div>

	<div>

<a class="ui-button button1" href="https://eu.battle.net/shop/checkout/add-balance"
><span class="button-left"><span class="button-right">Пополнить счет</span></span></a>
	</div>

	</div>

	</div>

	</div>

		<div class="other-payment-methods">
			<h4>
				Другие способы оплаты
				<span class="help-link-right" data-tooltip="С помощью опции «Сделать основным способом оплаты» вы можете изменить способ оплаты, указанный для вашей записи в качестве основного."></span>
			</h4>
			<table>
				<thead>
					<tr>
						<th scope="col">Тип платежа</th>
						<th scope="col">Информация о записи</th>
						<th scope="col" colspan="3"></th>
					</tr>
				</thead>
				<tbody>
	<tr>
		<th scope="row">VISAELECTRON XXXX</th>
		<td>
				&nbsp;
		</td>
		<td>
			<a href="#" onclick="return Wallet.setPrimary(27370512);" data-label="set-as-primary">
				<span class="icon-16 icon-up"></span>
				<span class="icon-16-label">Сделать основным способом оплаты</span>
			</a>
		</td>
		<td>
				<a href="/account/management/edit-payment-method.html?id=27370512">
					<span class="icon-16 icon-account-edit"></span>
					<span class="icon-16-label">Обновить</span>
				</a>
		</td>
		<td>
			<a href="#" onclick="closeActionType='other';$('#wallet-dialog-27370512').dialog('open'); return false;" tabindex="1" data-label="delete-other">
				<span class="icon-16 icon-account-delete"></span>
				<span class="icon-16-label">Удалить</span>
			</a>

	<div class="wallet-dialog" style="display: none" id="wallet-dialog-27370512" title="Удалить?">

            <p>Вы действительно хотите удалить этот способ оплаты?</p>
            <div class="subscription-warning"></div>
		<input type="hidden" class="wallet-id" value="27370512" />
	</div>
		</td>
	</tr>
	<tr>
		<th scope="row">PayPal</th>
		<td>
				    Название записи: PayPal@EMAIL.RU
		</td>
		<td>
			<a href="#" onclick="return Wallet.setPrimary(32564836);" data-label="set-as-primary">
				<span class="icon-16 icon-up"></span>
				<span class="icon-16-label">Сделать основным способом оплаты</span>
			</a>
		</td>
		<td>
				<a href="https://www.paypal.com/" target="_blank">
					<span class="icon-16 icon-account-external"></span>
					<span class="icon-16-label">Управление счетом PayPal</span>
				</a>
		</td>
		<td>
			<a href="#" onclick="closeActionType='other';$('#wallet-dialog-32564836').dialog('open'); return false;" tabindex="1" data-label="delete-other">
				<span class="icon-16 icon-account-delete"></span>
				<span class="icon-16-label">Удалить</span>
			</a>

	<div class="wallet-dialog" style="display: none" id="wallet-dialog-32564836" title="Удалить?">

            <p>Вы действительно хотите удалить этот способ оплаты?</p>
            <div class="subscription-warning"></div>
		<input type="hidden" class="wallet-id" value="32564836" />
	</div>
		</td>
	</tr>
				</tbody>
			</table>
		</div>
	<div class="subscriptions">
		<h4>Подписки</h4>
			<table>
				<thead>
				<tr>
					<th scope="col">Подписка</th>
					<th scope="col">Статус</th>
					<th scope="col">Следующий платеж</th>
					<th scope="col">Способ оплаты</th>
					<th scope="col" colspan="2"></th>
				</tr>
				</thead>
				<tbody>


						<tr>
							<th scope="row" class="subscription-description">
									<a href="/account/management/wow/dashboard.html?accountName=WoW1&amp;region=EU">World of Warcraft® - Подписка на World of Warcraft® — 3 месяца</a>
								<br/>								WoW1 - Legion™ - Европа (EU)

							</th>
							<td>
									<span >активна</span>
							</td>
							<td>
									<time datetime="2018-04-07T06:10+03:00">07.04.18 6:10:44 MSK</time>
							</td>
							<td>
										MASTERCARD XXXX
										<a class="subswallet-editpayment" href="#" onclick="closeActionType='primary';$('#subs-change-paymentMethod-dialog-EU682788').dialog('open'); Cookie.create('registeredDialog','#subs-change-paymentMethod-dialog-48480830'); return false;" tabindex="1" data-label="delete-other">
											Изменить
										</a>
	<div class="subs-change-paymentMethod-dialog sub-dialog" style="display: none" id="subs-change-paymentMethod-dialog-EU682788" title="">
		<h3>Выберите новый способ оплаты подписки.</h3>
		<p class="error" id="subs-change-paymentMethod-error-EU682788"></p>
		<p>World of Warcraft® - Подписка на World of Warcraft® — 3 месяца</p>
		<select id="subs-change-paymentMethod-select-EU682788 border-5" class="subscription-walletInfo">
			<option>Выберите способ оплаты</option>
					<option value="7753431|MC">MASTERCARD XXXX</option>
					<option value="27370512|EL">VISAELECTRON XXXX</option>
					<option value="32564836|PYPL">PayPal</option>
		</select>
		<input type="hidden" class="subscription-id" value="EU682788" />
		<input type="hidden" class="subscription-version" value="2" />
		<p><a href="/account/management/add-payment-method.html">Добавить новый способ оплаты</a></p>
		<p class="agree-save">Нажимая кнопку «Сохранить», вы принимаете <a href="http://eu.blizzard.com/ru-ru/company/about/termsofsale.html">Условия продажи</a> и <a href="http://eu.blizzard.com/ru-ru/company/about/privacy.html">Политику конфиденциальности</a>.</p>
	</div>
							</td>
							<td>


									<a href="https://eu.battle.net/shop/checkout/subscribe/2750?gameAccountId=48480830&amp;gameAccountRegion=EU" class="subswallet-editplan">
									<span class="icon-16 icon-account-edit"></span>
									<span class="icon-16-label">Изменить подписку</span>
								</a>
							</td>
							<td>
									<a class="subswallet-cancelsub" href="#" onclick="closeActionType='primary';$('#cancel-subs-dialog-EU682788').dialog('open'); return false;" tabindex="1" data-label="delete-other">
									<span class="icon-16 icon-account-delete"></span>
									<span class="icon-16-label">Отменить</span>
								</a>
	<div class="cancel-subs-dialog" style="display: none" id="cancel-subs-dialog-EU682788" title="Отменить">
		<p class="error" id="cancel-subs-error-EU682788"></p>
		<p>Вы точно хотите отменить эту подписку?</p>
		<input type="hidden" class="subscription-id" value="EU682788" />
	</div>
							</td>
						</tr>
				</tbody>
			</table>
	</div>
	<div id="changeCurrency-menu" class="flyout-menu" style="display: none;">
		<ul>
				<li><a href="#" class="switch-currency" id="EUR">Евро</a></li>
				<li><a href="#" class="switch-currency" id="RUB">Российский рубль</a></li>
			<li><a href="#" onclick="$('#account-balance-dialog').dialog('open'); return false;">Другие денежные единицы</a></li>
		</ul>
	</div>
		<script type="text/javascript">
		//<![CDATA[
		var closeActionType = null;
		$(function() {
			var closeLabel = 'no';
			$(".wallet-dialog").dialog("destroy");
			$('.wallet-dialog').dialog({
				autoOpen: false,
				modal: true,
				position: "center",
				resizeable: false,
				closeText: "Закрыть",
				buttons: {
					'Да': function() {
						var id = $(this).find('.wallet-id').val();
						Wallet.deletePaymentMethod(id);
						closeLabel = 'yes';
						$(this).dialog("close");
					},
					'Отмена': function() {
						$(this).dialog("close");
					}
				},
				open: function() {
					$(".ui-dialog-buttonpane").find("button").addClass("button1").find(":first").addClass("first");
				},
				close: function() {
					Core.trackEvent('payment-method', 'confirm-delete-' + closeActionType, closeLabel);
					closeLabel = 'no';
				}
			});
			$(".wallet-dialog-with-subs").dialog("destroy");
			$('.wallet-dialog-with-subs').dialog({
				autoOpen: false,
				modal: true,
				width: 500,
				position: "center",
				resizeable: false,
				closeText: "Закрыть",
				buttons: {
					'Изменить способ оплаты': function() {
						$(this).dialog("close");
					},
					'Удалить этот способ оплаты': function() {
						var id = $(this).find('.wallet-id').val();
						Wallet.deletePaymentMethod(id);
						closeLabel = 'yes';
						$(this).dialog("close");
					}
				},
				open: function() {
					$(".ui-dialog-buttonpane").find("button").addClass("button1").find(":first").addClass("first");
				},
				close: function() {
					Core.trackEvent('payment-method', 'confirm-delete-' + closeActionType, closeLabel);
					closeLabel = 'no';
				}
			});
    		$(".cancel-subs-dialog").dialog("destroy");
			$('.cancel-subs-dialog').dialog({
				autoOpen: false,
				modal: true,
				position: "center",
				resizeable: false,
				closeText: "Закрыть",
				buttons: {
					'Да': function() {
    					var subscriptionId = $(this).find('.subscription-id').val();
					    Wallet.cancelSubscription(subscriptionId);
					},
					'Нет': function() {
						$(this).dialog("close");
					}
				},
				open: function() {
					$(".ui-dialog-buttonpane").find("button").addClass("button1").find(":first").addClass("first");
				},
				close: function() {
					Core.trackEvent('subscriptions', 'confirm-cancel-' + closeActionType, closeLabel);
					closeLabel = 'no';
				}
			});
    		accountBalance.changeCurrencyMenuFlag = true;
			$(".subs-change-paymentMethod-dialog").dialog("destroy");
			$('.subs-change-paymentMethod-dialog').dialog({
				autoOpen: false,
				modal: true,
				position: "center",
				resizeable: false,
				width: 500,
				closeText: "Закрыть",
				buttons: {
					'Сохранить': function() {
						var walletInfo = $(this).find('.subscription-walletInfo').val().split("|");
						var walletId = walletInfo[0];
    					var subscriptionId = $(this).find('.subscription-id').val();
    					var subscriptionVersion = $(this).find('.subscription-version').val();
    					Wallet.changePaymentMethod(subscriptionId, walletId, subscriptionVersion);
    				},
    				'Отмена': function() {
    					$(this).dialog("close");
    				}
    			},
    			open: function() {
    				$(".ui-dialog-buttonpane").find("button").addClass("button1").find(":first").addClass("first");
    			},
    			close: function() {
    				Core.trackEvent('subscriptions', 'confirm-cancel-' + closeActionType, closeLabel);
    				closeLabel = 'no';
    			}
    		});

			$(".subs-set-paymentMethod-and-reactivate-dialog").dialog("destroy");
			$('.subs-set-paymentMethod-and-reactivate-dialog').dialog({
				autoOpen: false,
				modal: true,
				position: "center",
				resizeable: false,
				width: 500,
				closeText: "Закрыть",
				buttons: {
					'Оформить подписку': function() {
						var walletInfo = $(this).find('.subscription-walletInfo').val().split("|");
						var walletId = walletInfo[0];
						var subscriptionId = $(this).find('.subscription-id').val();
						var subscriptionVersion = $(this).find('.subscription-version').val();
						Wallet.setPaymentMethodAndReactivate(subscriptionId, walletId, subscriptionVersion);
					},
					'Отмена': function() {
						$(this).dialog("close");
					}
				},
				open: function() {
					$(".ui-dialog-buttonpane").find("button").addClass("button1").find(":first").addClass("first");
				},
				close: function() {
					Core.trackEvent('subscriptions', 'confirm-cancel-' + closeActionType, closeLabel);
					closeLabel = 'no';
				}
			});

    		$(".legacysubs-change-paymentMethod-dialog").dialog("destroy");
    		$('.legacysubs-change-paymentMethod-dialog').dialog({
				autoOpen: false,
				modal: true,
				position: "center",
				resizeable: false,
				width: 500,
				closeText: "Закрыть",
				buttons: {
					'Сохранить': function() {
						var walletInfo = $(this).find('.subscription-walletInfo').val().split("|");
						var walletId = walletInfo[0];
						var productId = $(this).find('.subscription-productId').val();
						var verificationNumber = $(this).find('.subscription-cvv').val();
						var paymentMethod = walletInfo[1];
						var gameAccountLabel = $(this).find('.subscription-gameAccountLabel').val();
						var gameAccountRegion = $(this).find('.subscription-gameAccountRegion').val();
						var gameLicenseId = $(this).find('.subscription-gameLicenseId').val();
						Wallet.changeWowPaymentMethod(walletId, productId, verificationNumber, paymentMethod, gameAccountLabel, gameAccountRegion, gameLicenseId);
					},
					'Отмена': function() {
						$(this).dialog("close");
					}
				},
				open: function() {
					$(".ui-dialog-buttonpane").find("button").addClass("button1").find(":first").addClass("first");
				},
				close: function() {
					Core.trackEvent('subscriptions', 'confirm-cancel-' + closeActionType, closeLabel);
					closeLabel = 'no';
				}
			});


    });
	    var balanceOptOutMsg = {
		    saving: "Сохранение параметров...",
		    saved: "Параметры сохранены",
		    error: "При обработке вашего запроса произошел сбой. Попробуйте, пожалуйста, еще раз попозже."
	    };
	    var allowBalanceOptOut = true;
		$(function() {
			var category = 'payment-method';
			Core.bindTrackEvent('a[data-label*=delete-]', category, 'click-delete');
			Core.bindTrackEvent('a[data-label=set-as-primary]', category, 'set-as-primary');
		});

		//]]>
		</script>

				</div>
			</div>
		</div>
		<div id="layout-bottom-divider"></div>

@endsection