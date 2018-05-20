<div class="user-plate">
<a id="user-plate" class="card-character plate-alliance ajax-update" rel="np" href="{{ route('characters-simple', [$active->name]) }}"></a>
<div class="meta-wrapper meta-alliance ajax-update">
<div class="character-card card-game-char ajax-update">
<div class="message">
<span class="player-name">
@if(Auth::user()->name) {{ Auth::user()->name }} @else {{ Auth::user()->email }} @endif</span>
<div class="character">
<a class="character-name context-link serif name-small" href="{{ route('characters-simple', [$active->name]) }}" rel="np">
{{ $active->name }}</a>
<span class="avatar-frame">
<img src="/wow/images/2d/avatar/{{ $active->race }}-{{ $active->gender }}.jpg" class="avatar avatar-wow" />
<span class="border"></span>
<span class="icon icon-wow"></span>
</span>
<div id="context-1" class="ui-context character-select">
<div class="context">
<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>
<div class="context-user">
<strong>{{ $active->name }}</strong>
</div>
<div class="context-links">
<a href="{{ route('characters-simple', [$active->name]) }}" title="Профиль" rel="np"
class="icon-profile link-first"
>
<span class="context-icon"></span>Профиль
</a>
<a href="/search?f=post&amp;a=Fanaticus&amp;sort=time" title="Мои сообщения" rel="np"
class="icon-posts"
>
<span class="context-icon"></span>
</a>
<a href="/vault/character/auction/" title="Просмотреть аукцион" rel="np"
class="icon-auctions"
>
<span class="context-icon"></span>
</a>
<a href="/vault/character/event" title="Просмотреть события" rel="np"
class="icon-events link-last"
>
<span class="context-icon"></span>
</a>
</div>
</div>
<div class="character-list">
<div class="primary chars-pane">
<div class="char-wrapper">
@foreach($all as $item)
<a href="{{ route('characters-simple', [$item->name]) }}"
onclick="CharSelect.pin({{ $item->guid }}, this); return false;"  class="char @if($item->guid === Auth::user()->charactersActive) pinned @endif"  rel="np">
<span class="pin"></span>
<span class="name">{{ $item->name }}</span>
<span class="class wow-class-paladin"> – , {{ $item->level }} ур.</span>
<span class="realm up">ElisGrimm</span>
</a>
@endforeach
</div>
<a href="javascript:;" class="manage-chars" onclick="CharSelect.swipe('in', this); return false;">
<span class="plus"></span>
Управление персонажами<br />
<span>Настройте выпадающее меню персонажа.</span>
</a>
</div>
<div class="secondary chars-pane" style="display: none">
<div class="char-wrapper scrollbar-wrapper" id="scroll">
<div class="scrollbar">
<div class="track"><div class="thumb"></div></div>
</div>
<div class="viewport">
<div class="overview">
@foreach($all as $item)
<a href="{{ route('characters-simple', [$item->name]) }}" class="wow-class-paladin @if($item->guid === Auth::user()->charactersActive) pinned @endif" rel="np" data-tooltip="  (ElisGrimm)">
<span class="icon icon-race">
<img src="/wow/images/icons/small/race_1_0.jpg" alt="" width="14" height="14" />
</span>
<span class="icon icon-class">
<img src="/wow/images/icons/small/class_{{ $item->class }}.jpg" alt="" width="14" height="14" />
</span>
{{ $item->level }} {{ $item->name }}</a>
@endforeach
<div class="no-results hide">Персонажей не найдено</div>
</div>
</div>
</div>
<div class="filter">
<input type="input" class="input character-filter" value="Фильтр" alt="Фильтр" /><br />
<a href="javascript:;" onclick="CharSelect.swipe('out', this); return false;">К списку персонажей</a>
</div>
</div>
</div> </div>
</div>
</div>
</div>
</div>
</div>