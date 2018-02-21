@extends('layouts.forum')

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> Форумы </a> </span>
<span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
<a href="{{ route('forum', [$category->id])}}" class="Breadcrumb-content is-active"> {{ $category->name }} </a> </span>
</div>
@endsection

@section('content')
<section class="Forum" data-forum="{'id': '{{ $category->id }}'}">
        <header class="Forum-header">
            <div class="Container Container--content">
                <form action="{{ route('forum.search') }}" class="Form Form--searchMobile" id="forum-search-form">
                    <div class="Form-group">
                        <div class="Input Input--iconPrefix Input--search">
                            <input name="q" placeholder="Поиск по" type="search" autocomplete="off" />
                            <input type="hidden" name="forum" value="{{ $category->id }}" />
                            <i class="Icon Icon--prefix Icon--search"></i>
                            <div class="Input-border"></div>
                        </div>
                    </div>
                </form>
                <h1 class="Forum-heading">
                    <a class="Game-logo" href="/"></a>
                    {{ $category->name }}<button class="Forum-button Forum-button--searchButton" id="toggle-search-field" data-trigger="toggle.search.field" type="button"><span class="Button-content"><i class="Icon"></i></span></button>				</h1>
                <div class="Forum-controls">
                    <form action="{{ route('forum.search') }}" class="Form" id="forum-search-form">
                        <div class="Form-group">
                            <div class="Input Input--iconPrefix Input--search">
                                <input name="q" placeholder="Поиск по" type="search" autocomplete="off" />
                                <input type="hidden" name="forum" value="{{ $category->id }}" />
                                <i class="Icon Icon--prefix Icon--search"></i>
                                <div class="Input-border"></div>
                            </div>
                        </div>
                    </form>
<button class="Forum-button Forum-button--new" id="toggle-create-topic" data-forum-button="true" data-trigger="create.topicpost.forum" type="button">							<span class="Overlay-element"></span>
<span class="Button-content"><i class="Icon"></i>Новая тема</span></button>				</div>
            </div>
            @include('forum.new_topic')
        </header>

        <div class="Forum-content" data-track="nexus.checkbox" id="forum-topics">

            <div class="Forum-ForumTopicList ">
@if ($topics->isEmpty())
<div data-topics-container="featured">No topics in this category :(</div>
@endif
@foreach ($topics as $topic)
<a class="ForumTopic" href="{{ route('forum.topic', [$category->id, $topic])}}" data-forum-topic="{'id':29,'lastPosition':0,'isSticky':false,'isFeatured':false,'isLocked':false,'isHidden':false,'isSpam':false}">
<span class="ForumTopic-type">
<i class="Icon"></i>
<i class="BlizzIcon" data-toggle="tooltip" data-tooltip-content="Сообщение Blizzard" data-original-title="" title=""></i></span>
<div class="ForumTopic-details">
<span class="ForumTopic-heading">
<span class="ForumTopic-title--wrapper">

<span class="ForumTopic-timestamp on-mobile">
<span class="ForumTopic-timestamp--lastPost" href="{{ route('forum.topic', [$category->id, $topic])}}" >
</span>
</span>

<span class="ForumTopic-title" data-toggle="tooltip" data-tooltip-content="" data-original-title="" title="">{{ $topic->title }}</span>
<i class="statusIcon statusIcon-desktop" data-toggle="tooltip" data-tooltip-content="Закрыто" data-original-title="" title=""></i>
</span>
</span>
<span class="ForumTopic--preview"></span>
<span class="ForumTopic-author">{{ $topic->user->name }}</span>

<span class="ForumTopic-replies">
<i class="Icon"></i>
<span>{{ $topic->replies->count() }}</span>
</span>

<span class="ForumTopic-timestamp">
<span class="ForumTopic-timestamp--lastPost" href="{{ route('forum.topic', [$category->id, $topic])}}">{{ $topic->updated_at->diffForHumans() }}</span>
</span>
</div>
</a>
@endforeach
</div>
<!--div class="Pagination-footer">
<a class="Pagination-button Pagination-button--onlyNext" href="?page=2"><span class="Button-content">След.<i class="Icon"></i></span></a>			</div-->
</div>
</section>
@endsection