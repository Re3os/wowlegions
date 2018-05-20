@extends('layouts.forum')

@section('title')
{{ $topic->title }} -
@endsection

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> @lang('forum.forum') </a> </span>
<span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
<a href="{{ route('forum', [$topic->category->id])}}" class="Breadcrumb-content"> {{ $topic->category->name }} </a> </span>
<span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
<a href="{{ route('forum.topic', [$topic->category->id, $topic->id])}}" class="Breadcrumb-content is-active"> {{ $topic->title }} </a> </span> </div>
@endsection

@section('content')
<section class="Topic" data-topic='{ "id":{{ $topic->category->id }}, "lastPosition":2,"forum":{"id":{{ $topic->id }} },"isSticky":false,"isFeatured":false,"isLocked":false,"isHidden":false,"isFrozen":false, "isSpam":false, "pollId":0 }' data-user='{"id":{{ $topic->user->id }} }'>
<header class="Topic-header">
<div class="Container Container--content">
<h1 class="Topic-heading">
<a class="Game-logo" href="/"></a>
<span class="Topic-title" data-topic-heading="true">{{ $topic->title }}</span>
</h1>
<span class="Topic-subheading">
<a class="Topic-subheading--link" href="{{ route('forum', $topic->category->id)}}">{{ $topic->category->name }} </a>
</span>

<div class="Topic-controls">
@if(Auth::user() && $topic->closed)
<button class="Topic-button Topic-button--reply" id="Button-reply" disabled="disabled" data-toggle="tooltip" data-tooltip-content="@lang('forum.thread_is_locked')">
<span class="Overlay-element" disabled="disabled" data-toggle="tooltip" data-tooltip-content="@lang('forum.thread_is_locked')"></span>
<span class="Button-content"><i class="Icon"></i>@lang('forum.TopicFormReplyTopic')</span></button>
@else
<button class="Topic-button Topic-button--reply" id="Button-reply">
<span class="Overlay-element"></span>
<span class="Button-content"><i class="Icon"></i>@lang('forum.TopicFormReplyTopic')</span></button>
@endif
</div>
</div>
</header>

<div class="Container Container--content Topic-container">
<div class="Topic-pagination--header">
    {{ $replies->links('forum.categories.paginatepost') }}
</div>
<div class="Topic-pagination--mobile">
</div>
</div>
<div class="Topic-content">
        <div class="TopicPost @if($topic->user->role > 1) TopicPost--blizzard @endif @if($topic->user->role == 1) TopicPost--mvp @endif" id="post-1" data-topic-post='{"id":"{{ $topic->id }}","valueVoted":0,"rank":{"voteUp":0,"voteDown":0},"author":{"id":"{{ $topic->user->id }}","name":"{{ $topic->user->name }}"}}" data-topic="{"sticky":"false","featured":"false","locked":"false","frozen":"false","hidden":"false","pollId":"0"}'>
<span id="1"></span>
<div class="TopicPost-content">
<div class="TopicPost-authorIcon @if($topic->user->role > 1) TopicPost-authorIcon--blizzard @endif">
<svg xmlns="http://www.w3.org/2000/svg">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-blizzard"/>
</svg>
</div>
<aside class="TopicPost-author">
<div class="Author-block">
<div class="Author @if($topic->user->role > 1) Author--blizzard @endif @if($topic->user->role == 1) Author--mvp @endif" id="" data-topic-post-body-content="true"><a href="{{ route('characters-simple', [$topic->characters->name]) }}" class="Author-avatar hasNoProfile"><img src="/images/avatars/wow/4-0.jpg" alt="" /></a>
<div class="Author-details">
    @if($topic->user->role > 1)
    <span class="Author-name">{{ $topic->characters->name }}</span>
    @else
    <a class="Author-name--profileLink" href="{{ route('characters-simple', [$topic->characters->name]) }}">{{ $topic->characters->name }}</a>
    @endif
    @if($topic->user->role == 6)
    <span class="Author-job">Curator</span>
    @elseif($topic->user->role == 5)
    <span class="Author-job">Developer</span>
    @elseif($topic->user->role == 4)
    <span class="Author-job">Game Master</span>
    @elseif($topic->user->role == 3)
    <span class="Author-job">Moderator</span>
    @elseif($topic->user->role == 2)
    <span class="Author-job">Customer Service</span>
    @elseif($topic->user->role == 1)
    <span class="Author-job">MVP</span>
    @endif
<span class="Author-posts">
<a class="Author-posts" href="/forum/search?a={{ $topic->characters->name }}" data-toggle="tooltip" data-tooltip-content="@lang('forum.view_message_history')" data-original-title="" title="">
 @lang('forum.count_messages', ['count' => $topic->user->posts_count])</a>
</span></div></div>
</div>
</aside>
<script>
    var TOPIC_POST = {{ $topic->id }};
</script>
            <div class="TopicPost-body" data-topic-post-body="true">
                <div class="TopicPost-details">
                    <div class="Timestamp-details">
                    <a class="TopicPost-timestamp" href="#post-{{ $topic->id }}" data-toggle="tooltip" data-tooltip-content="{{ $topic->created_at->format('m/d/Y H:i') }}" data-original-title="" title="">{{ $topic->created_at->diffForHumans() }}</a>
                        <!--a class="TopicPost-timestamp" href="#post-{{ $topic->id }}" data-toggle="tooltip" data-tooltip-content="Гринфайр {{ $topic->updated_at->format('m/d/Y H:i') }}">
                            &#160;(Отредактировано)
                        </a>
                        <span class="TopicPost-rank TopicPost-rank--up" data-topic-post-rank="true"
data-toggle="tooltip" data-tooltip-content="Нравится: 0. Не нравится: 0.">1</span>
                        <span class="TopicPost-rank TopicPost-rank--none" data-topic-post-rank="true"></span>
                        <span class="TopicPost-rank TopicPost-rank--down" data-topic-post-rank="true"
data-toggle="tooltip" data-tooltip-content="Нравится: 0. Не нравится: 0.">1</span-->
                </div>
@guest
@else
<aside class="TopicPost-control">
<div class="TopicPost-menu Dropdown"><button class="Button-dropdown Button--secondary Button--icon" data-trigger="toggle.dropdown.menu" data-toggle="tooltip" data-tooltip-content="@lang('forum.dropdown')" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon Icon--16 Icon--blue Icon--button Icon--caretdown"></i></span></button><div class="Dropdown-menu"><span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span><div class="Dropdown-items">
@if(Auth::user()->name == $topic->user->name)
<span class="Dropdown-item" data-topic-post-button="true" data-trigger="edit.topicpost">@lang('forum.edit_topicpost')</span>
<span class="Dropdown-item" data-topic-post-button="true" data-trigger="delete.topicpost">@lang('forum.delete_topicpost')</span>
@else
<span class="Dropdown-item" data-topic-post-button="true" data-trigger="report.preview.topicpost">@lang('forum.report_topicpost')</span>
<span class="Dropdown-item" data-topic-post-button="true" data-topic-post-ignore-button="true" data-trigger="ignore.user.topicpost">@lang('forum.ignore_user_topicpost')</span>
<span class="Dropdown-item is-hidden" data-topic-post-button="true" data-topic-post-unignore-button="true" data-trigger="unignore.user.topicpost">@lang('forum.unignore_user_topicpost')</span>
@endif

</div></div></div>
                    </aside>   @endguest
                </div>

                <button class="TopicPost-button TopicPost-button--viewPost is-hidden" data-topic-post-button="true" data-topic-viewpost-button="true" data-trigger="view.post.topicpost">
                    <span class="Button-content">@lang('forum.view_post_topicpost')</span>
                </button>
<div class="TopicPost-bodyContent" data-topic-post-body-content="true"><b>{!! $topic->content !!}</b></div>
@guest
@else
<!--footer class="TopicPost-actions" data-topic-post-body-content="true">
<button class="TopicPost-button TopicPost-button--like" data-topic-post-button="true" data-trigger="vote.up.topicpost" type="button"><span class="Button-content"><i class="Icon"></i>Нравится</span></button>						<button class="TopicPost-button TopicPost-button--dislike only-icon" data-topic-post-button="true" data-toggle="tooltip" data-tooltip-content="Не нравитсяНе нравится" data-trigger="vote.down.topicpost" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon"></i></span></button><a href="#detail" class="TopicPost-button TopicPost-button--quote" data-topic-post-button="true" data-trigger="quote.topicpost" type="button">							<span class="Button-content">
<svg xmlns="http://www.w3.org/2000/svg">
<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-quote"/>
</svg>
Цитирование</span></a>					</footer--> @endguest
            </div>
        </div>
    </div>
    @foreach ($replies as $reply)
<div class="TopicPost @if($reply->user->role > 1) TopicPost--blizzard @endif @if($reply->user->role == 1) TopicPost--mvp @endif" id="post-{{ $reply->id }}" data-topic-post="{'id':'{{ $reply->id }}','valueVoted':0,'rank':{'voteUp':0,'voteDown':0},'author':{'id':'{{ $reply->user->id }}','name':'{{ $reply->user->name }}'}}" data-topic="{'sticky':'false','featured':'false','locked':'false','frozen':'false','hidden':'false','pollId':'0'}">
<span id="1"></span>
<div class="TopicPost-content">
<div class="TopicPost-authorIcon @if($reply->user->role > 1) TopicPost-authorIcon--blizzard @endif">
<svg xmlns="http://www.w3.org/2000/svg">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-blizzard"/>
</svg>
</div>
<aside class="TopicPost-author">
<div class="Author-block">
<div class="Author @if($reply->user->role > 1) Author--blizzard @endif @if($reply->user->role == 1) Author--mvp @endif" id="" data-topic-post-body-content="true"><a href="{{ route('characters-simple', [$reply->characters->name]) }}" class="Author-avatar hasNoProfile"><img src="/images/avatars/wow/4-1.jpg" alt="" /></a>
<div class="Author-details">
    @if($reply->user->role > 1)
    <span class="Author-name">{{ $reply->characters->name }}</span>
    @else
    <a class="Author-name--profileLink" href="{{ route('characters-simple', [$reply->characters->name]) }}">{{ $reply->characters->name }}</a>
    @endif
    @if($reply->user->role == 6)
    <span class="Author-job">Curator</span>
    @elseif($reply->user->role == 5)
    <span class="Author-job">Developer</span>
    @elseif($reply->user->role == 4)
    <span class="Author-job">Game Master</span>
    @elseif($reply->user->role == 3)
    <span class="Author-job">Moderator</span>
    @elseif($reply->user->role == 2)
    <span class="Author-job">Customer Service</span>
    @elseif($reply->user->role == 1)
    <span class="Author-job">MVP</span>
    @endif
<span class="Author-posts">
<a class="Author-posts" href="/forum/search?a={{ $reply->characters->name }}" data-toggle="tooltip" data-tooltip-content="@lang('forum.view_message_history')" data-original-title="" title="">
@lang('forum.count_messages', ['count' => $topic->user->posts_count])</a>
</span></div></div>
</div>
</aside>

            <div class="TopicPost-body" data-topic-post-body="true">
                <div class="TopicPost-details">
                    <div class="Timestamp-details">
                    <a class="TopicPost-timestamp" href="#post-1" data-toggle="tooltip" data-tooltip-content="{{ $reply->created_at->diffForHumans() }}" data-original-title="" title="">{{ $reply->created_at->diffForHumans() }}</a>
                     <!--a class="TopicPost-timestamp" href="#post-1" data-toggle="tooltip" data-tooltip-content="Гринфайр 11/03/2017 15:16">
                            &#160;(Отредактировано)
</a>
                        <span class="TopicPost-rank TopicPost-rank--up" data-topic-post-rank="true"
data-toggle="tooltip" data-tooltip-content="Нравится: 0. Не нравится: 0.">1</span>
                        <span class="TopicPost-rank TopicPost-rank--none" data-topic-post-rank="true"></span>
                        <span class="TopicPost-rank TopicPost-rank--down" data-topic-post-rank="true"
data-toggle="tooltip" data-tooltip-content="Нравится: 0. Не нравится: 0.">1</span-->
                </div>
@guest
@else
<aside class="TopicPost-control">
<div class="TopicPost-menu Dropdown"><button class="Button-dropdown Button--secondary Button--icon" data-trigger="toggle.dropdown.menu" data-toggle="tooltip" data-tooltip-content="@lang('forum.dropdown')" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon Icon--16 Icon--blue Icon--button Icon--caretdown"></i></span></button><div class="Dropdown-menu"><span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span><div class="Dropdown-items">
@if(Auth::user()->name == $reply->user->name)
<span class="Dropdown-item" data-topic-post-button="true" data-trigger="edit.topicpost">@lang('forum.edit_topicpost')</span>
<span class="Dropdown-item" data-topic-post-button="true" data-trigger="delete.topicpost">@lang('forum.delete_topicpost')</span>
@else
<span class="Dropdown-item" data-topic-post-button="true" data-trigger="report.preview.topicpost">@lang('forum.report_topicpost')</span>
<span class="Dropdown-item" data-topic-post-button="true" data-topic-post-ignore-button="true" data-trigger="ignore.user.topicpost">@lang('forum.ignore_user_topicpost')</span>
<span class="Dropdown-item is-hidden" data-topic-post-button="true" data-topic-post-unignore-button="true" data-trigger="unignore.user.topicpost">@lang('forum.unignore_user_topicpost')</span>
@endif

</div></div></div>
                    </aside>  @endguest
                </div>

                <button class="TopicPost-button TopicPost-button--viewPost is-hidden" data-topic-post-button="true" data-topic-viewpost-button="true" data-trigger="view.post.topicpost">
                    <span class="Button-content">@lang('forum.view_post_topicpost')</span>
                </button>
<div class="TopicPost-bodyContent" data-topic-post-body-content="true"><b>{!! $reply->content !!}</b></div>
@guest
@else<!--footer class="TopicPost-actions" data-topic-post-body-content="true">
<button class="TopicPost-button TopicPost-button--like" data-topic-post-button="true" data-trigger="vote.up.topicpost" type="button"><span class="Button-content"><i class="Icon"></i>Нравится</span></button>						<button class="TopicPost-button TopicPost-button--dislike only-icon" data-topic-post-button="true" data-toggle="tooltip" data-tooltip-content="Не нравитсяНе нравится" data-trigger="vote.down.topicpost" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon"></i></span></button><a href="#detail" class="TopicPost-button TopicPost-button--quote" data-topic-post-button="true" data-trigger="quote.topicpost" type="button">							<span class="Button-content">
<svg xmlns="http://www.w3.org/2000/svg">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-quote"/>
</svg>
Цитирование</span></a>					</footer-->   @endguest
            </div>
        </div>
    </div>
    @endforeach
</div>

{{ $replies->links('forum.categories.paginatepost') }}

    </section>
    @guest
        <section class="Section Section--secondary">
        <div data-topic-post="true" tabindex="0" class="TopicForm is-editing" id="topic-reply">

        <div class="LoginPlaceholder-content"> <aside class="LoginPlaceholder-author"> <div class="Author" id="" data-topic-post-body-content="true"><div class="Author-avatar Author-avatar--default"></div><div class="Author-details"><span class="Author-name is-blank"></span> <span class="Author-posts is-blank"></span></div></div> <div class="Author-ignored is-hidden" data-topic-post-ignored-author="true"> <span class="Author-name"> </span><div class="Author-posts Author-posts--ignored">@lang('forum.ignored')</div></div> </aside> <div class="LoginPlaceholder-details"> <div class="LogIn-message">@lang('forum.logIn_message')</div> <a class="LogIn-button" href="{{ route('login') }}"> <span class="LogIn-button-content" >@lang('forum.logIn_content')</span> </a> </div> </div>

        </div>
        </section>
    @else
        @if(Auth::user()->charactersActive)
            @include('forum.new_reply', ['active' => \App\Characters::activeUserCharacters(Auth::user()->charactersActive)])
        @else
            @include('forum.new_reply_no_characters')
        @endif
    @endguest
  <div class="Topic-container--bottomNav">
    <a class="Topic-button--parentForum" href="{{ route('forum', [$topic->category->id])}}" type="button">
      <span class="Button-content"><i class="Icon"></i>@lang('forum.parentForum')</span>
    </a>
  </div>
@endsection