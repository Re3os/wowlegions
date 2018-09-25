@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/wallet.2HJc9.css') }}" />
@endsection

@section('js')
<script type="text/javascript" src="{{ asset_media('/account/static/js/inputs.2gjKG.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/account/static/js/management/wallet.0jDRy.js') }}"></script>
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
		<h4>Кошелек<span class="help-link-right" data-tooltip="Кошелек Blizzard можно использовать для покупок и в игре, и на сайте."></span></h4>
	</div>
	<div class="wallet-balance">
		<h5>
			{{ $profileUser->balance }} {{ $profileUser->currency }}
		</h5>
	<div class="info-section">
		<div class="info-section pending-balance-section  " style="display: inline-block">
			<div class="help-link-right" data-tooltip="Средствами, которые вы зачислите в кошелек, можно пользоваться не сразу. Операция должна пройти проверку. Это может занять до 3 дней.">
				ПРОВЕРКА ОПЕРАЦИИ
			</div>
			<div>0,00 РУБ</div>
		</div>
		<div class="info-section options">
				<a href="{{ route('claim-code') }}">
    				<span class="icon-16 icon-account-key"></span>
					<span class="icon-16-label">Использовать код</span>
				</a>
		</div>
	</div>

	<div>

<a class="ui-button button1" href="{{ route('add-balance') }}"
><span class="button-left"><span class="button-right">Пополнить счет</span></span></a>
	</div>
	</div>
	</div>
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