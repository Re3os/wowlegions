<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Resources\{User, Navigation};

class NavigationController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index() {
        return new Navigation(\Auth::user());
    }

    public function navigation() {
        echo '{"homeTitle":"Главная","menuTitle":"Услуги","games":[{"title":"WoWLegions","navigationLinks":[{"destination":"/family/world-of-warcraft","name":"World of Warcraft","iconUrl":"/static/1.12.1/images/family-icons/world-of-warcraft.svg"}]}],"balance":{"title":"Кошелек WoWLegions","navigationLinks":[{"destination":"/product/balance","name":"Пополнить кошелек WoWLegions","iconUrl":"/static/1.12.1/images/nav-icons/add-balance.svg"},{"destination":"/account/management/claim-code.html","name":"Использовать карту предоплаты","iconUrl":"/static/1.12.1/images/nav-icons/add-pre-paid-card.svg"},{"destination":"/account/management/transaction-history.html","name":"История кошелька","iconUrl":"/static/1.12.1/images/nav-icons/balance-history.svg"}]},"services":{"title":"Дополнительные услуги","navigationLinks":[{"destination":"/product/battle-tag-name-change","name":"Смена WoWLegionsTeg","iconUrl":"/static/1.12.1/images/nav-icons/battle-tag-name-change.svg"},{"destination":"/account/management/claim-code.html","name":"Использовать код","iconUrl":"/static/1.12.1/images/nav-icons/add-balance.svg"}]},"userBalance":{"available":"242.0","availableLocalized":"250 ₽","queued":"0.0","queuedLocalized":"0 ₽","queuedWarning":null,"queuedWarningHelp":null,"queuedWarningHelpUrl":null},"taxonomyLinks":[]}';
    }

}