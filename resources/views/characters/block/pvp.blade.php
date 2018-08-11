<div class="Grid Grid--gutters SyncHeight">
    <div class="Grid-1of2" media-large="Grid-1of3" media-huge="Grid-1of6">
        <div class="Box Box--flush Box--borderGrey Box--leatherGrey SyncHeight-item position-relative align-center">
            <div class="space-small"></div>
            <div class="contain-center" style="max-width:100px;" media-medium="hide">
                <div class="Art Art--above">
                    <div class="Art-size" style="padding-top:100%"></div>
                    <div class="Art-image" style="background-image:url({{ asset_media('/cms/template_resource/03/03FRAF878XNR1487976145561.png') }});"></div>
                    <div class="Art-overlay"></div>
                </div>
            </div>
            <div class="contain-center hide" style="max-width:128px;" media-medium="!hide">
                <div class="Art Art--above">
                    <div class="Art-size" style="padding-top:100%"></div>
                    <div class="Art-image" style="background-image:url({{ asset_media('/cms/template_resource/03/03FRAF878XNR1487976145561.png') }});"></div>
                    <div class="Art-overlay"></div>
                </div>
            </div>
            <div class="font-bliz-light-medium-white">Уровень престижа</div>
            <div class="space-tiny"></div>
            <div class="font-semp-xSmall-white text-upper">Уровень: {{ $char->prestigeLevel }}</div>
            <div class="space-normal"></div>
        </div>
    </div>
    <div class="Grid-1of2" media-large="Grid-1of3" media-huge="Grid-1of6">
        <div class="Box Box--flush Box--borderGrey Box--leatherGrey SyncHeight-item position-relative align-center">
            <div class="space-small"></div>
            <div class="contain-center" style="max-width:100px;" media-medium="hide">
                <div class="Art Art--above">
                    <div class="Art-size" style="padding-top:100%"></div>
                    <div class="Art-image" style="background-image:url({{ asset_media('/cms/template_resource/RLPMIYZ1KPMB1485566658000.png') }});"></div>
                    <div class="Art-overlay"></div>
                </div>
            </div>
            <div class="contain-center hide" style="max-width:128px;" media-medium="!hide">
                <div class="Art Art--above">
                    <div class="Art-size" style="padding-top:100%"></div>
                    <div class="Art-image" style="background-image:url({{ asset_media('/cms/template_resource/'.$char->side) }}.png);"></div>
                    <div class="Art-overlay"></div>
                </div>
            </div>
            <div class="font-bliz-light-medium-white">Очки чести</div>
            <div class="space-tiny"></div>
            <div class="font-semp-xSmall-white text-upper">Уровень: {{ $char->honorLevel }}</div>
            <div class="space-normal"></div>
        </div>
    </div>
    <div class="Grid-1of2" media-large="Grid-1of3" media-huge="Grid-1of6">
        <div class="Box Box--flush Box--borderGrey Box--leatherGrey SyncHeight-item position-relative align-center">
            <div class="space-small"></div>
            <div class="contain-center" style="max-width:100px;" media-medium="hide">
                <div class="Art Art--above">
                    <div class="Art-size" style="padding-top:100%"></div>
                    <div class="Art-image" style="background-image:url({{ asset_media('/cms/template_resource/8T1RRX8QDSII1488401955399.png') }});"></div>
                    <div class="Art-overlay"></div>
                </div>
            </div>
            <div class="contain-center hide" style="max-width:128px;" media-medium="!hide">
                <div class="Art Art--above">
                    <div class="Art-size" style="padding-top:100%"></div>
                    <div class="Art-image" style="background-image:url({{ asset_media('/cms/template_resource/8T1RRX8QDSII1488401955399.png') }});"></div>
                    <div class="Art-overlay"></div>
                </div>
            </div>
            <div class="font-bliz-light-medium-white">Почетные победы</div>
            <div class="space-tiny"></div>
            <div class="font-semp-xSmall-white text-upper">{{ $char->totalKills }}</div>
            <div class="space-normal"></div>
        </div>
    </div>
    <div class="Grid-1of2" media-large="Grid-1of3" media-huge="Grid-1of6">
        <div class="Box Box--flush Box--borderGrey Box--leatherGrey Box--hover SyncHeight-item position-relative align-center">
            <div class="space-small"></div>
            <a class="Link Link--block" data-modal="pvp-rating-stats-modal" data-modal-analytics-type="PvP Statistic" data-tooltip="tooltip-pvp-stat-2v2">
                <div class="Chakram Chakram--small Chakram--pvpFrame Chakram--textTiny contain-center" media-medium="!Chakram--textTiny !Chakram--small Chakram--textSmall">
                    <div class="Chakram-text">0</div>
                </div>
            </a>
            <div class="Tooltip" name="tooltip-pvp-stat-2v2">
                <div class="GameTooltip">
                    <div class="ui-tooltip">
                        <div class="space-small"></div>
                        <div class="SortTable SortTable--stretch">
                            <div class="SortTable-body">
                                <div class="SortTable-row">
                                    <div class="SortTable-col SortTable-data">
                                        <div class="font-bliz-light-xSmall-lightGold">Игр</div>
                                    </div>
                                    <div class="SortTable-col SortTable-data">
                                        <div class="font-bliz-light-xSmall-white align-right"></div>
                                    </div>
                                </div>
                                <div class="SortTable-row">
                                    <div class="SortTable-col SortTable-data">
                                        <div class="font-bliz-light-xSmall-lightGold">Побед</div>
                                    </div>
                                    <div class="SortTable-col SortTable-data">
                                        <div class="font-bliz-light-xSmall-white color-win align-right">0</div>
                                    </div>
                                </div>
                                <div class="SortTable-row">
                                    <div class="SortTable-col SortTable-data">
                                        <div class="font-bliz-light-xSmall-lightGold">% побед</div>
                                    </div>
                                    <div class="SortTable-col SortTable-data">
                                        <div class="font-bliz-light-xSmall-white align-right">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="Modal Modal--modalCompact" data-modal="pvp-rating-stats-modal" data-analytics-type="PvP Statistic" style="display: none;">
            <div class="Modal-back" title="Назад">
                <div class="List">
                    <div class="List-item">
                        <span class="Icon Icon--back Icon--small Modal-icon">
                            <svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64">
                                <use xlink:href="/static/components/Icon/Icon.svg#back"></use>
                            </svg>
                        </span>
                    </div>
                    <div class="List-item">
                        <div class="Modal-backText">Назад</div>
                    </div>
                </div>
            </div>
            <div class="Modal-close" data-izimodal-close="data-izimodal-close">
                <span class="Icon Icon--close Icon--small Modal-icon">
                    <svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64">
                        <use xlink:href="/static/components/Icon/Icon.svg#close"></use>
                    </svg>
                </span>
            </div>
            <div class="hide" media-wide="!hide">
                <div class="SortTable SortTable--stretch">
                    <div class="SortTable-head">
                        <div class="SortTable-row">
                            <div class="SortTable-col SortTable-label SortTable-label--left" data-priority="1" name="name">
                                <div class="SortTable-labelOuter">
                                    <div class="SortTable-labelInner">
                                        <div class="SortTable-labelText">
                                            <span>Seasonal Match History</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="SortTable-col SortTable-label" data-priority="3" name="games">
                                <div class="SortTable-labelOuter">
                                    <div class="SortTable-labelInner">
                                        <div class="SortTable-labelText">
                                            <span>Игр</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="SortTable-col SortTable-label" data-priority="2" name="win">
                                <div class="SortTable-labelOuter">
                                    <div class="SortTable-labelInner">
                                        <div class="SortTable-labelText">
                                            <span>Побед</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="SortTable-col SortTable-label" data-priority="2" name="winLoss">
                                <div class="SortTable-labelOuter">
                                    <div class="SortTable-labelInner">
                                        <div class="SortTable-labelText">
                                            <span>% побед</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="SortTable-body">
                    <div class="SortTable-row">
                        <div class="SortTable-col SortTable-data">
                            <div class="font-size-small color-beige-medium">2x2</div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center" data-value="0">
                            <div class="font-bliz-light-xSmall-white"></div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0">
                            <div class="font-bliz-light-xSmall-white color-win">0</div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0">
                            <div class="font-bliz-light-xSmall-white gutter-small">-</div>
                        </div>
                    </div>
                    <div class="SortTable-row">
                        <div class="SortTable-col SortTable-data">
                            <div class="font-size-small color-beige-medium">3x3</div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center" data-value="0">
                            <div class="font-bliz-light-xSmall-white"></div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0">
                            <div class="font-bliz-light-xSmall-white color-win">0</div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0">
                            <div class="font-bliz-light-xSmall-white gutter-small">-</div>
                        </div>
                    </div>
                    <div class="SortTable-row">
                        <div class="SortTable-col SortTable-data">
                            <div class="font-size-small color-beige-medium">Поля боя</div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center" data-value="0">
                            <div class="font-bliz-light-xSmall-white"></div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0">
                            <div class="font-bliz-light-xSmall-white color-win">0</div>
                        </div>
                        <div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0">
                            <div class="font-bliz-light-xSmall-white gutter-small">-</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="font-bliz-light-medium-lightGold">2x2</div>
    <div class="space-tiny"></div>
    <div class="font-semp-xSmall-white text-upper">Рейтинг</div>
    <div class="space-normal"></div>
    </div>
</div>
<div class="Grid-1of2" media-large="Grid-1of3" media-huge="Grid-1of6"><div class="Box Box--flush Box--borderGrey Box--leatherGrey Box--hover SyncHeight-item position-relative align-center"><div class="space-small"></div><a class="Link Link--block" data-modal="pvp-rating-stats-modal" data-modal-analytics-type="PvP Statistic" data-tooltip="tooltip-pvp-stat-3v3"><div class="Chakram Chakram--small Chakram--pvpFrame Chakram--textTiny contain-center" media-medium="!Chakram--textTiny !Chakram--small Chakram--textSmall"><div class="Chakram-text">0</div></div></a><div class="Tooltip" name="tooltip-pvp-stat-3v3"><div class="GameTooltip"><div class="ui-tooltip"><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-lightGold">Игр</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-lightGold">Побед</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-lightGold">% побед</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div></div></div></div><div class="Modal Modal--modalCompact" data-modal="pvp-rating-stats-modal" data-analytics-type="PvP Statistic" style="display: none;"><div class="Modal-back" title="Назад"><div class="List"><div class="List-item"><span class="Icon Icon--back Icon--small Modal-icon"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#back"></use></svg></span></div><div class="List-item"><div class="Modal-backText">Назад</div></div></div></div><div class="Modal-close" data-izimodal-close="data-izimodal-close"><span class="Icon Icon--close Icon--small Modal-icon"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#close"></use></svg></span></div><div class="hide" media-wide="!hide"><div class="SortTable SortTable--stretch"><div class="SortTable-head"><div class="SortTable-row"><div class="SortTable-col SortTable-label SortTable-label--left" data-priority="1" name="name"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>Seasonal Match History</span></div></div></div></div><div class="SortTable-col SortTable-label" data-priority="3" name="games"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>Игр</span></div></div></div></div><div class="SortTable-col SortTable-label" data-priority="2" name="win"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>Побед</span></div></div></div></div><div class="SortTable-col SortTable-label" data-priority="2" name="winLoss"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>% побед</span></div></div></div></div></div></div><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">2x2</div></div><div class="SortTable-col SortTable-data align-center" data-value="0"><div class="font-bliz-light-xSmall-white"></div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white color-win">0</div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white gutter-small">-</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">3x3</div></div><div class="SortTable-col SortTable-data align-center" data-value="0"><div class="font-bliz-light-xSmall-white"></div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white color-win">0</div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white gutter-small">-</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Поля боя</div></div><div class="SortTable-col SortTable-data align-center" data-value="0"><div class="font-bliz-light-xSmall-white"></div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white color-win">0</div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white gutter-small">-</div></div></div></div></div></div><div media-wide="hide"><div class="space-normal"></div><div class="font-bliz-light-small-lightGold">2x2</div><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Games</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Wins</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Win %</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div><div class="space-normal"></div><div class="font-bliz-light-small-lightGold">3x3</div><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Games</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Wins</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Win %</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div><div class="space-normal"></div><div class="font-bliz-light-small-lightGold">Поля боя</div><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Games</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Wins</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Win %</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div></div></div><div class="font-bliz-light-medium-lightGold">3x3</div><div class="space-tiny"></div><div class="font-semp-xSmall-white text-upper">Рейтинг</div><div class="space-normal"></div></div></div><div class="Grid-1of2" media-large="Grid-1of3" media-huge="Grid-1of6"><div class="Box Box--flush Box--borderGrey Box--leatherGrey Box--hover SyncHeight-item position-relative align-center"><div class="space-small"></div><a class="Link Link--block" data-modal="pvp-rating-stats-modal" data-modal-analytics-type="PvP Statistic" data-tooltip="tooltip-pvp-stat-rbgs"><div class="Chakram Chakram--small Chakram--pvpFrame Chakram--textTiny contain-center" media-medium="!Chakram--textTiny !Chakram--small Chakram--textSmall"><div class="Chakram-text">0</div></div></a><div class="Tooltip" name="tooltip-pvp-stat-rbgs"><div class="GameTooltip"><div class="ui-tooltip"><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-lightGold">Игр</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-lightGold">Побед</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-lightGold">% побед</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div></div></div></div><div class="Modal Modal--modalCompact" data-modal="pvp-rating-stats-modal" data-analytics-type="PvP Statistic" style="display: none;"><div class="Modal-back" title="Назад"><div class="List"><div class="List-item"><span class="Icon Icon--back Icon--small Modal-icon"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#back"></use></svg></span></div><div class="List-item"><div class="Modal-backText">Назад</div></div></div></div><div class="Modal-close" data-izimodal-close="data-izimodal-close"><span class="Icon Icon--close Icon--small Modal-icon"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#close"></use></svg></span></div><div class="hide" media-wide="!hide"><div class="SortTable SortTable--stretch"><div class="SortTable-head"><div class="SortTable-row"><div class="SortTable-col SortTable-label SortTable-label--left" data-priority="1" name="name"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>Seasonal Match History</span></div></div></div></div><div class="SortTable-col SortTable-label" data-priority="3" name="games"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>Игр</span></div></div></div></div><div class="SortTable-col SortTable-label" data-priority="2" name="win"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>Побед</span></div></div></div></div><div class="SortTable-col SortTable-label" data-priority="2" name="winLoss"><div class="SortTable-labelOuter"><div class="SortTable-labelInner"><div class="SortTable-labelText"><span>% побед</span></div></div></div></div></div></div><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">2x2</div></div><div class="SortTable-col SortTable-data align-center" data-value="0"><div class="font-bliz-light-xSmall-white"></div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white color-win">0</div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white gutter-small">-</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">3x3</div></div><div class="SortTable-col SortTable-data align-center" data-value="0"><div class="font-bliz-light-xSmall-white"></div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white color-win">0</div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white gutter-small">-</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Поля боя</div></div><div class="SortTable-col SortTable-data align-center" data-value="0"><div class="font-bliz-light-xSmall-white"></div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white color-win">0</div></div><div class="SortTable-col SortTable-data align-center text-nowrap" data-value="0"><div class="font-bliz-light-xSmall-white gutter-small">-</div></div></div></div></div></div><div media-wide="hide"><div class="space-normal"></div><div class="font-bliz-light-small-lightGold">2x2</div><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Games</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Wins</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Win %</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div><div class="space-normal"></div><div class="font-bliz-light-small-lightGold">3x3</div><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Games</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Wins</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Win %</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div><div class="space-normal"></div><div class="font-bliz-light-small-lightGold">Поля боя</div><div class="space-small"></div><div class="SortTable SortTable--stretch"><div class="SortTable-body"><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Games</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right"></div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Wins</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white color-win align-right">0</div></div></div><div class="SortTable-row"><div class="SortTable-col SortTable-data"><div class="font-size-small color-beige-medium">Win %</div></div><div class="SortTable-col SortTable-data"><div class="font-bliz-light-xSmall-white align-right">-</div></div></div></div></div></div></div><div class="font-bliz-light-medium-lightGold">Поля боя</div><div class="space-tiny"></div><div class="font-semp-xSmall-white text-upper">Рейтинг</div><div class="space-normal"></div></div></div></div>