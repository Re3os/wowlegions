@extends('layouts.account')

@section('css')
<link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/lobby.24rnt.css') }}" />
<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/lobby-ie.2vTEB.css') }}" />
<![endif]-->
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="{{ asset_media('/account/static/css/management/lobby-ie6.2nZ0A.css') }}" />
<![endif]-->
@endsection

@section('js')
<script type="text/javascript" src="{{ asset_media('/account/static/js/management/lobby.2ePKQ.js') }}"></script>
@endsection

@section('content')
<div id="layout-middle">
<div class="wrapper">
<div id="content">
<!--div class="alert caution border-4 glow-shadow">
<div class="alert-inner">
<div class="alert-message">
<p class="title"><strong>Защитите свою запись от взлома с помощью бесплатного <a data-context="wasShownAuthWarning" href="/account/management/authenticator.html">Blizzard Mobile Authenticator</a>
.</strong></p>
Blizzard Mobile Authenticator — бесплатный способ защитить вашу учетную запись от взлома.
</div>
</div>
<span class="clear"></span>
</div-->
<div id="lobby">
<div id="page-content" class="page-content">
<div id="lobby-account">
<h3 class="section-title">Информация о записи</h3>
<div class="lobby-box">
<h4 class="subcategory">Название учетной записи</h4>
<p class="account-name">{{ $profileUser->email }}<span class="edit">[<a href="{{ route('change-email') }}">Редактировать</a>]</span></p>
<h4 class="subcategory help-link-right" data-tooltip="Это имя, под которым вас будут знать на {{ config('app.name') }}" data-tooltip-options='{"location": "mouse"}'>Имя</h4>
<p>{{ $profileUser->name }} <span class="edit">[<a href="{{ route('tag-name-change') }}" id="battletag-purchase">Платная смена имени</a>]</span></p>
</div>
<h3 class="section-title">Защита записи</h3>
<div class="lobby-box security-box">
<h4 class="subcategory">E-mail учетной записи</h4>
<p class="has-authenticator-has-active">
Проверен
</p>
</div>
</div>
<div id="lobby-games">
<h3 class="section-title">Ваши учетные записи для игр</h3>
<div id="games-list">
<a href="#wow" class="border-2 games-title opened" rel="game-list-wow">WoW</a>
<ul id="game-list-wow">
@foreach($userGamrAccount as $list)
    <li class="border-4" id="WoW1::EU">
    <span class="game-icon">
    <span class="png-fix"><img src="//bneteu-a.akamaihd.net/account/static/local-common/images/game-icons/wow-32.0ifiC.png" alt="" width="32" height="32" /></span>
    <span class="flag upgrade" data-tooltip="Можно конвертировать" data-tooltip-options='{"location": "mouse"}'></span>
    </span>
    <span class="account-info">
    <span class="account-link">
    <strong><a class="EU-WOW-legion-se" href="{{ route('dashboard') }}?accountName=WoW1&amp;region=EU"> World of Warcraft®: Legion™</a></strong>
    <span class="account-id">
    [WoW1]
    <span class="account-edition">Стандартная версия</span>
    <span class="account-status GOOD">
    активна
    </span>
    </span>
    <span class="account-region">Европа (EU)</span>
    </span>
    </span>
    </li>
@endforeach
</ul>
</div>
<div id="games-tools">
<a href="{{ route('invite') }}" id="add-game" class="border-5">Пригласить друзей</a>
<p>
<a href="{{ route('get-a-game') }}" class="" onclick="">
<span class="icon-16 icon-account-buy"></span>
<span class="icon-16-label">Электронные версии</span>
</a>
</p>
<p>
<a href="{{ route('download-game') }}" class="" onclick="">
<span class="icon-16 icon-account-download"></span>
<span class="icon-16-label">Загрузка клиентов игр</span>
</a>
</p>
<p>
<a href="{{ route('beta-profile') }}" class="" onclick="">
<span class="icon-16 icon-account-beta"></span>
<span class="icon-16-label">Бета-профиль</span>
</a>
</p>
</div>
</div>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
var SecurityStrings = {
'PENDING' : {
'part1': 'Позвоните по номеру',
'part2': '— вам будет назначен PIN-код.'
},
'ERROR': {
'title': 'Blizzard Authenticator по телефону — ошибка',
'desc': 'Нам не удалось найти ваш Blizzard Authenticator по телефону'
},
'EDIT': {
'cancel': 'Отказаться от использования Authenticator по телефону',
'remove': 'Удалить'
}
};
var PaymentStrings = {
'NONE': {
'desc': 'За вашей учетной записью не закреплено других способов оплаты.',
'button': 'Указать основной способ оплаты'
},
'GOOD': {
'desc': 'Обратите внимание: возможно, обычно вы оплачиваете подписку на WoW с помощью другого способа оплаты.',
'CREDIT_CARD': {
'title': 'Способ оплаты по умолчанию',
'label': 'Кредитная карта',
'details': 'PAYMENTSUBTYPE оканчивается на XXX',
'button': 'Редактировать'
},
'DIRECT_DEBIT': {
'title': 'Способ оплаты по умолчанию',
'label': 'Прямой банковский перевод SEPA',
'details': '',
'button': 'Редактировать'
}
},
'ERROR': {
'title': 'Сбой при загрузке платежной информации',
'desc': 'К сожалению, найти вашу платежную информацию не удалось.'
}
};
var GameId = {
'WOWT': ['World of Warcraft®', '\/account/management/wow/dashboard.html'],
'WOWC': ['World of Warcraft®', '\/account/management/wow/dashboard.html'],
'WOWB1': ['World of Warcraft®', '\/account/management/wow/dashboard.html'],
'WOWX1': ['World of Warcraft®', '\/account/management/wow/dashboard.html'],
'WOWX2': ['World of Warcraft®', '\/account/management/wow/dashboard.html'],
'WOWX3': ['World of Warcraft®', '\/account/management/wow/dashboard.html'],
'WOWX4': ['World of Warcraft®: Mists of Pandaria™', '\/account/management/wow/dashboard.html']
};
var IconTag = {
'starter': 'Стартовая версия',
'trial': 'Пробная версия',
'trialSingular': 'остался 1 день',
'trialPlural': 'осталось XXX дн.',
'trialExpired': 'пробный период истек',
'starterUpgrade': 'Стартовая версия (можно конвертировать)',
'upgrade': 'Можно конвертировать'
};
var chargebackTooltip = {
'chargeback': 'Вам следует возместить платеж, произведенный с этой записи и отвергнутый банком.'
};
var MaxBoxLevel = {
'WOWT': 6,
'WOWC': 6,
'WOWB1': 6,
'WOWX1': 6,
'WOWX2': 6,
'WOWX3': 6,
'WOWX4': 6
};
var Maintenance = {
'ERROR': 'Временно недоступно'
};
var Turbo = {
'enabled': false
};
var GameRegions = {
'CN': 'Китай (CN)',
'EU': 'Европа (EU)',
'KR': 'Корея (KR)',
'LA': 'Ю. Америка, Бразилия (LA)',
'NA': 'США и Канада (NA)',
'PTR': 'Тестовый игровой мир (PTR)',
'RU': 'Россия (RU)',
'SE': 'Ю.-В. Азия, Австралия и Океания (SEA)',
'SEA': 'Ю.-В. Азия, Австралия и Океания (SEA)',
'TW': 'Тайвань (TW)',
'US': 'США (US)',
'GLOBAL': 'США (US)'
};
//]]>
</script>
<!--[if IE 6]> <script type="text/javascript" src="{{ asset_media('/account/static/local-common/js/third-party/DD_belatedPNG.4JzIy.js') }}"></script>
<script type="text/javascript">
//<![CDATA[
DD_belatedPNG.fix('.icon-16');
//]]>
</script>
<![endif]-->
</div>
</div>
</div>
@endsection 