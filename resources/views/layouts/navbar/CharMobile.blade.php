<div class="BnetNav-mobileSiteMenuListItemWrap">
    <a class="Link" data-dropdown="BnetNav-mobileSiteMenuCharacter">
        <div class="DropdownLink DropdownLink--gold BnetNav-mobileSiteMenuLink">
            <div class="List">
                <div class="List-item">
                    <div class="Avatar Avatar--goldMedium BnetNav-mobileAvatar">
                        <div class="Avatar-image" style="background-image:url(&quot;{{ asset('/uploads/avatar/'.Auth::user()->avatar) }}&quot;);"></div>
                    </div>
                </div>
                <div class="List-item">
                    <span class="BnetNav-mobileSiteMenuLinkText" data-text="{{ $active->name }}">{{ $active->name }}</span>
                    <span class="BnetNav-mobileDropdownIndicator DropdownLink-indicator"></span>
                    <span class="BnetNav-mobileMenuListUserInfo">Уровень {{ $active->level }} @lang('forum.class_'.$active->class)</span>
                </div>
            </div>
        </div>
    </a>
</div>