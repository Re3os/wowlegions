<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Navigation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            "homeTitle" => "Главная",
            "menuTitle" => "Услуги",
            "games" => [
                "title" => "WoWLegions",
                "navigationLinks" => [
                    "destination" => "/family/world-of-warcraft",
                    "name" => "World of Warcraft",
                    "iconUrl" => "/static/1.12.1/images/family-icons/world-of-warcraft.svg"
                    ]
                ],
            "balance" => [
                "title" => "Кошелек WoWLegions",
                "navigationLinks" => [
                    "destination" => "/product/balance",
                    "name" => "Пополнить кошелек WoWLegions",
                    "iconUrl" => "/static/1.12.1/images/nav-icons/add-balance.svg"
                    ]
                ],
            "services" => [
                "title" => "Дополнительные услуги",
                "navigationLinks" => [
                    "destination" => "/product/battle-tag-name-change",
                    "name" => "Смена WoWLegionsTeg",
                    "iconUrl" => "/static/1.12.1/images/nav-icons/battle-tag-name-change.svg",
                    ]
            ],
            "userBalance" => [
                "available" => \Auth::user()->balance,
                "availableLocalized" => \Auth::user()->balance ." ₽",
                "queued" => "0.0",
                "queuedLocalized" => "0 ₽",
                "queuedWarning" => null,
                "queuedWarningHelp" => null,
                "queuedWarningHelpUrl" => null
                ],
            "taxonomyLinks" => []
        ];
    }
}