<div class="HorizontalNav HorizontalNav--gutters HorizontalNav--upper" media-small="hide" media-wide="!hide">
    <div class="List HorizontalNav-itemsContainer">
        <a class="Link HorizontalNav-link List-item is-active" href="{{ route('characters', [$char->name ]) }}" type="SUMMARY">
            <div class="HorizontalNav-item" data-text="Персонаж">Персонаж</div>
        </a>
        <a class="Link HorizontalNav-link List-item" href="{{ route('achievements', [$char->name ]) }}" type="ACHIEVEMENTS">
            <div class="HorizontalNav-item" data-text="Достижения">Достижения</div>
        </a>
        <a class="Link HorizontalNav-link List-item" href="{{ route('collections', [$char->name ]) }}" type="COLLECTIONS">
            <div class="HorizontalNav-item" data-text="Коллекции">Коллекции</div>
        </a>
        <a class="Link HorizontalNav-link List-item" href="{{ route('characters-pve', [$char->name ]) }}" type="PVE">
            <div class="HorizontalNav-item" data-text="Рейдовый прогресс">Рейдовый прогресс</div>
        </a>
        <a class="Link HorizontalNav-link List-item" href="{{ route('characters-pvp', [$char->name ]) }}" type="PVP">
            <div class="HorizontalNav-item" data-text="PvP">PvP</div>
        </a>
        <a class="Link HorizontalNav-link List-item" href="{{ route('reputation', [$char->name ]) }}" type="REPUTATION">
            <div class="HorizontalNav-item" data-text="Репутация">Репутация</div>
        </a>
    </div>
</div>

<div class="align-left">
    <div class="SelectMenu SelectMenu--alignable SelectMenu--fullscreen" media-medium="!SelectMenu--fullscreen SelectMenu--small" media-wide="hide">
        <div class="SelectMenu-toggle">Персонаж</div>
        <div class="SelectMenu-menu">
            <div class="SelectMenu-close">
                <span class="Icon Icon--closeGold SelectMenu-close-icon"></span>
            </div>
        <div class="SelectMenu-inputContainer">
            <input class="SelectMenu-input" type="search"/></div>
            <div class="SelectMenu-items">
                <div class="SelectMenu-item">
                    <a class="Link SelectMenu-link" href="{{ route('characters', [$char->name ]) }}">Персонаж</a>
                </div>
                <div class="SelectMenu-item">
                    <a class="Link SelectMenu-link" href="/achievements">Достижения</a>
                </div>
                <div class="SelectMenu-item">
                    <a class="Link SelectMenu-link" href="/collections">Коллекции</a>
                </div>
                <div class="SelectMenu-item">
                    <a class="Link SelectMenu-link" href="/pve">Рейдовый прогресс</a>
                </div>
                <div class="SelectMenu-item">
                    <a class="Link SelectMenu-link" href="{{ route('characters-pvp', [$char->name ]) }}">PvP</a>
                </div>
                <div class="SelectMenu-item">
                    <a class="Link SelectMenu-link" href="/reputation">Репутация</a>
                </div>
                <div class="SelectMenu-exception">Результатов не найдено.</div>
            </div>
        </div>
    </div>
</div>