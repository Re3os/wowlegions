<div class="sidebar-module " id="sidebar-forums">
<div class="sidebar-title">
    <h3 class="header-3 title-forums"><a href="{{ route('forums') }}">Последние темы</a></h3>
</div>

<div class="sidebar-content">
<ul class="articles-list-plain">
    @foreach($forum as $cnc)
<li>
<a href="{{ route('forum.topic', [$cnc->category->id, $cnc])}}" class="topic">{{ $cnc->title }}</a>
<a href="{{ route('forum', [$cnc->category->id])}}" class="forum">{{ $cnc->category->name }}</a>
-
<span class="date">{{ $cnc->created_at->format('d M Y H:i:s') }}</span>
</li>
    @endforeach
</ul>

</div>
</div>