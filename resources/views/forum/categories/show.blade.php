@extends('layouts.forum')

@section('title')
{{ $category->name }} -
@endsection

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> @lang('forum.forum') </a> </span>
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
                            <input name="q" placeholder="@lang('forum.search_forum')" type="search" autocomplete="off" />
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
                                <input name="q" placeholder="@lang('forum.search_forum')" type="search" autocomplete="off" />
                                <input type="hidden" name="forum" value="{{ $category->id }}" />
                                <i class="Icon Icon--prefix Icon--search"></i>
                                <div class="Input-border"></div>
                            </div>
                        </div>
                    </form>
<button class="Forum-button Forum-button--new" id="toggle-create-topic" data-forum-button="true" data-trigger="create.topicpost.forum" type="button">							<span class="Overlay-element"></span>
<span class="Button-content"><i class="Icon"></i>@lang('forum.create_topic')</span></button>				</div>
            </div>
            @include('forum.new_topic')
        </header>

        <div class="Forum-content" data-track="nexus.checkbox" id="forum-topics">

            <div class="Forum-ForumTopicList ">
@if ($topics->isEmpty())
<div data-topics-container="featured">@lang('forum.no_topic_in_category')</div>
@endif
@if (isset($topics[0]->sticky) == 1)
<div data-topics-container="sticky">
@foreach ($topics as $topic)
@if($topic->sticky == 1)
<a class="ForumTopic ForumTopic--sticky @if($topic->user->role >= 2) ForumTopic--featured has-blizzard-post @endif @if($topic->user->role == 1) has-mvp-post @endif @if($topic->closed) is-locked @endif" href="{{ route('forum.topic', [$category->id, $topic])}}" data-forum-topic="{'id':29,'lastPosition':0,'isSticky':false,'isFeatured':false,'isLocked':@if($topic->closed) true @esle false @endif,'isHidden':false,'isSpam':false}">
<span class="ForumTopic-type">
<i class="Icon"></i>
@if($topic->user->role >= 2)
<i class="BlizzIcon" data-toggle="tooltip" data-tooltip-content="@lang('forum.messages_gm')" data-original-title="" title=""></i>
@endif
@if($topic->user->role == 1)
<i class="MvpIcon" data-toggle="tooltip" data-tooltip-content="@lang('forum.messages_cuf')"></i>
@endif
</span>
<div class="ForumTopic-details">
<span class="ForumTopic-heading">
<span class="ForumTopic-title--wrapper">

<span class="ForumTopic-timestamp on-mobile">
<span class="ForumTopic-timestamp--lastPost" href="{{ route('forum.topic', [$category->id, $topic])}}" >
</span>
</span>

<span class="ForumTopic-title" data-toggle="tooltip" data-tooltip-content="" data-original-title="" title="">{{ $topic->title }} <i class="statusIcon statusIcon-desktop" data-toggle="tooltip" data-tooltip-content="Закрыто" data-original-title="" title=""></i>
</span>
</span>
</span>
<span class="ForumTopic--preview">{!! $topic->content !!}</span>
<span class="ForumTopic-author @if($topic->user->role >= 2) ForumTopic-author--blizzard @endif @if($topic->user->role == 1) ForumTopic-author--mvp @endif">{{ $topic->user->name }}</span>

<span class="ForumTopic-replies">
<i class="Icon"></i>
<span>{{ $topic->replies->count() }}</span>
</span>

<span class="ForumTopic-timestamp">
<span class="ForumTopic-timestamp--lastPost" href="{{ route('forum.topic', [$category->id, $topic])}}">{{ $topic->updated_at->diffForHumans() }}</span>
</span>
</div>
</a>
@endif
@endforeach
</div>
@endif
@foreach ($topics as $topic)
@if($topic->sticky != 1)
<a class="ForumTopic @if($topic->user->role >= 2) has-blizzard-post @endif @if($topic->user->role == 1) has-mvp-post @endif @if($topic->closed) is-locked @endif" href="{{ route('forum.topic', [$category->id, $topic])}}" data-forum-topic="{'id':29,'lastPosition':0,'isSticky':false,'isFeatured':false,'isLocked':@if($topic->closed) true @esle false @endif,'isHidden':false,'isSpam':false}">
<span class="ForumTopic-type">
<i class="Icon"></i>
@if($topic->user->role >= 2)
<i class="BlizzIcon" data-toggle="tooltip" data-tooltip-content="@lang('forum.messages_gm')" data-original-title="" title=""></i>
@endif
@if($topic->user->role == 1)
<i class="MvpIcon" data-toggle="tooltip" data-tooltip-content="@lang('forum.messages_cuf')"></i>
@endif
</span>
<div class="ForumTopic-details">
<span class="ForumTopic-heading">
<span class="ForumTopic-title--wrapper">

<span class="ForumTopic-timestamp on-mobile">
<span class="ForumTopic-timestamp--lastPost" href="{{ route('forum.topic', [$category->id, $topic])}}" >
</span>
</span>

<span class="ForumTopic-title" data-toggle="tooltip" data-tooltip-content="" data-original-title="" title="">{{ $topic->title }}</span>
<i class="statusIcon statusIcon-desktop" data-toggle="tooltip" data-tooltip-content="@lang('forum.topic_closed')" data-original-title="" title=""></i>
</span>
</span>
<span class="ForumTopic--preview">{!! $topic->content !!}</span>
<span class="ForumTopic-author @if($topic->user->role >= 2) ForumTopic-author--blizzard @endif @if($topic->user->role == 1) ForumTopic-author--mvp @endif">{{ $topic->user->name }}</span>

<span class="ForumTopic-replies">
<i class="Icon"></i>
<span>{{ $topic->replies->count() }}</span>
</span>

<span class="ForumTopic-timestamp">
<span class="ForumTopic-timestamp--lastPost" href="{{ route('forum.topic', [$category->id, $topic])}}">{{ $topic->updated_at->diffForHumans() }}</span>
</span>
</div>
</a>
@endif
@endforeach
</div>
{{ $topics->links('forum.categories.paginatecat') }}
</div>
</section>
@endsection