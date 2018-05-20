@extends('layouts.forum')

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content is-active">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> Форумы </a> </span>
 <span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
 <a href="" class="Breadcrumb-content is-active"> Результаты поиска </a> </span></div>
@endsection

@section('content')
<div role="main">

<section class="Search">
    <header class="Search-header">
    <div class="Container Container--content"> <h1 class="Search-heading"> <a class="Game-logo" href="/forums/ru/wow/"></a> Результаты поиска по запросу «{{ request('q') }}» </h1> <div class="Search-controls">

<form action="{{ route('forum.search') }}" class="Form" id="search-form"> <div class="Form-group"> <div class="Input Input--large Input--search"> <input id="search-input" name="q" placeholder="Поиск по..." type="search" value="{{ request('q') }}" autocomplete='off'/> <input data-search-forum="true" type="hidden" name="forum"/> <div class="Input-border"></div> </div> <button class="Search-button" type="submit"><span class="Button-content"><i class="Icon Icon--32 Icon--search"></i></span></button></div></form> </div> </div> </header>

<div class="Search-content">
@if ($result->isEmpty())
<div class="Search-noResults"> Поиск не дал результатов. Пожалуйста, проверьте правильность написания или используйте другие критерии поиска. </div>
@else
<div class="Page-searchSummary"> <div class="Page-searchSummary--results"> <span class="Search-result--numbers">{{$result->firstItem()}}&#8211; {{ $result->lastItem() }}</span> <span class="Search-result--text"> из</span> <span class="Search-result--numbers">{{ $result->total() }}</span> <span class="Search-result--text"> Сообщения</span> </div> </div>
@endif

@foreach($result as $item)
<div class="Post--searchPage" id="post-{{ $item->id }}">
    <a href="{{ route('forum.topic', [$item->category->id, $item->id]) }}#post-1">
    <div class="Post-content Post-content--searchPage">
    <aside class="TopicPost-author">
    <div class="Author">
    <div class="Author" id="" data-topic-post-body-content="true">
        <a href="{{ route('characters-simple', [$item->characters->name]) }}" class="Author-avatar " >
            <img src="/images/avatars/wow/{{ $item->characters->class }}-{{ $item->characters->gender }}.jpg" alt="" /></a>
            <div class="Author-details">
    <span class="Author-name">
        <a class="Author-name--profileLink" href="{{ route('characters-simple', [$item->characters->name]) }}">{{ $item->characters->name }}</a>
    </span>
    <span class="Author-posts">
        <a class="Author-posts" href="/forum/search?a={{ $item->user->name }}" data-toggle="tooltip" data-tooltip-content="Просмотреть историю сообщений"> Сообщений: {{ $item->user->posts_count }} </a>
    </span>
</div>
</div>
<div class="Author-ignored is-hidden" data-topic-post-ignored-author="true">
<span class="Author-name">
    <a class="Author-name--profileLink" href="{{ route('characters-simple', [$item->characters->name]) }}">{{ $item->characters->name }}</a>
</span>
<div class="Author-posts Author-posts--ignored">проигнорировано</div></div> </div> </aside>
<div class="Post-body Post-body--searchPage">
<div class="Post-body Post-body--topicTitle">{{ $item->title }} </div>
<span class="Post-body Post-body--forumName"> {{ $item->category->name }} </span>
<span class="Post-timestamp Post-timestamp--searchPage"> {{ $item->created_at->diffForHumans() }}
<span class="TopicPost-rank TopicPost-rank--down" data-topic-post-rank="true">-16</span>
<span class="TopicPost-rank TopicPost-rank--up" data-topic-post-rank="true">20</span> </span>
<div class="Post-body--postContent"> {{ $item->content }} </div>
</div>
</div>
</a>
</div>
@endforeach

@if (!$result->isEmpty())
{{ $result->appends(['q' => \Illuminate\Support\Facades\Input::get('q')])->links('forum.paginate') }}
@endif
</div>
</section>
 </div>
@endsection