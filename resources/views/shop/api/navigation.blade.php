{"blizzardGames":[{
    "destination":"/family/world-of-warcraft",
    "name":"World of Warcraft",
    "iconUrl":"/static/2.2.0/images/family-icons/world-of-warcraft.svg",
    "iconName":null
}],
"balance":[{
    "destination":"/product/balance",
    "name":"Пополнить кошелек Blizzard",
    "iconUrl":null,"iconName":"balance-add"
    },{
        "destination":"/product/balance",
        "name":"Подарочный баланс",
        "iconUrl":null,
        "iconName":"balance-gift"
    },{
        "destination":"/account/management/transaction-history.html",
        "name":"История кошелька",
        "iconUrl":null,
        "iconName":"balance-history"
    }],
"services":[{
    "destination":"/product/battle-tag-name-change",
    "name":"Смена BattleTag",
    "iconUrl":null,
    "iconName":"battle-tag-name-change"
    },{
        "destination":"/account/management/claim-code.html",
        "name":"Использовать код",
        "iconUrl":null,
        "iconName":"key-claim"
    }],
    "userBalance":{
        "available":"{{ Auth::user()->balance }}",
        "availableLocalized":"{{ Auth::user()->balance }} ₽",
        "queued":"0.0",
        "queuedLocalized":"0 ₽",
        "queuedWarning":null,
        "queuedWarningHelp":null,
        "queuedWarningHelpUrl":null},
        "taxonomyLinks":[]
}