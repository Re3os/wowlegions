<div class="SiteNav-menuListItem SiteNav-menuListItem--user SiteNav-menuListItem--userLoggedIn List-item">
    <div class="SiteNav-menuListItemWrap">
        <div class="List">
            <div class="List-item">
                <a class="Link Link--block" href="{{ route('characters', [$active->name]) }}">
                    <div class="Avatar Avatar--goldLarge SiteNav-avatar">
                        <div class="Avatar-image" style="background-image:url(&quot;{{ Auth::user()->avatar }}&quot;);"></div>
                    </div>
                </a>
            </div>
            <div class="List-item">
                <a class="Link DropdownLink--gold DropdownLink--goldWithHover SiteNav-menuListLink" data-dropdown="SiteNav-character" tabIndex="2">
                    <span class="SiteNav-menuListLinkText" data-text="{{ $active->name }}">{{ $active->name }}</span>
                    <span class="SiteNav-dropdownIndicator DropdownLink-indicator"></span>
                    <span class="SiteNav-menuListUserInfo">
                        <span class="SiteNav-characterLevelLabel">Уровень</span>{{ $active->level }} @lang('forum.class_'.$active->class)</span>
                </a>
            </div>
        </div>
    </div>
</div>