<div class="HorizontalNav HorizontalNav--gutters HorizontalNav--upper" media-small="hide" media-wide="!hide">
    <div class="List HorizontalNav-itemsContainer">
        <a class="Link HorizontalNav-link List-item is-active" href="{{ route('profiles', [$profileUser->name]) }}" type="SUMMARY">
            <div class="HorizontalNav-item" data-text="Персонажи">Персонажи</div>
        </a>
        <a class="Link HorizontalNav-link List-item" href="{{ route('profiles-activity', [$profileUser->name]) }}" type="ACHIEVEMENTS">
            <div class="HorizontalNav-item" data-text="Активность">Активность</div>
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
                    <a class="Link SelectMenu-link" href="{{ route('profiles', [$profileUser->name]) }}">Персонажи</a>
                </div>
                <div class="SelectMenu-item">
                    <a class="Link SelectMenu-link" href="{{ route('profiles-activity', [$profileUser->name]) }}">Активность</a>
                </div>
                <div class="SelectMenu-exception">Результатов не найдено.</div>
            </div>
        </div>
    </div>
</div>