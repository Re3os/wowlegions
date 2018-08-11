<div class="CharacterHeader CharacterHeader--@lang('forum.class_key_'.$char->class)">
    <div class="CharacterHeader-character">
        <div class="CharacterHeader-logoArea">
            <div class="Logo Logo--smaller CharacterHeader-logo Logo--{{ $char->side }}"></div>
        </div>
        <div class="CharacterHeader-nameArea">
            <div class="CharacterHeader-nameTitle">
                <a class="Link CharacterHeader-name" href="{{ route('characters', [$char->name]) }}">{{ $char->name }}</a>
                <!--div class="CharacterHeader-title CharacterHeader-suffix">хранитель Г'ханира</div-->
            </div>
        </div>
    </div>
    <div class="CharacterHeader-info">
        <div class="CharacterHeader-links">
            <a class="Link CharacterHeader-achievement" href="{{ route('achievements', [$char->name ]) }}">
                <div class="Media Media--flush Media--tiny CharacterHeader-media">
                    <div class="Media-image">
                        <span class="Icon Icon--achievement-shield Media-icon">
                            <svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#achievement-shield"></use></svg></span>
                    </div>
                    <div class="Media-text">{{ \App\Services\Achievements::GetAchievementsPoints() }}</div>
                </div>
            </a>
            <a class="Link CharacterHeader-ilvl" href="{{ route('characters', [$char->name ]) }}">
                <div class="Media Media--flush Media--tiny CharacterHeader-media">
                    <div class="Media-image">
                        <span class="Icon Icon--swords Media-icon"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64">
                            <use xlink:href="/static/components/Icon/Icon.svg#swords"></use>
                        </svg>
                        </span>
                    </div>
                    <div class="Media-text">{{ \App\Services\Characters::GetAVGItemLevel() }} ур. предметов</div>
                </div>
            </a>
        </div>
    <div class="CharacterHeader-details">
        <div class="CharacterHeader-detail">{{ $char->level }} @lang('forum.race_'.$char->race) @lang('forum.class_'.$char->class) <!-- (Исцеление) --></div>
        <!--div class="CharacterHeader-detail">
            <a class="Link color-gold-light" href="http://eu.battle.net/wow/ru/guild/deathguard/Тёмноё_Братство/" target="_blank">
                &nbsp;❮Тёмноё Братство❯
            </a>
        </div-->
        <div class="CharacterHeader-detail">&nbsp;ElisGrimm</div>
    </div>
</div>
</div>