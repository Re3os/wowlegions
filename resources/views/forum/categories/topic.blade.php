@extends('layouts.forum')

@section('title'){{ $thread->title }} -@endsection

@section('og')
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ route('forum.topic', [$thread->id])}}" />
<meta property="og:title" content="{{ $thread->title }} - {{ config('app.name_forum') }}" />
<meta property="og:image" content="{{ asset_media('/forums/static/images/social-thumbs/wow.png') }}" />
<meta property="og:description" content="{!! $thread->body !!}" />
@endsection

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span>@lang('navbar.Navbar-forums')</a> </span>
<span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
<a href="{{ route('forum', [$thread->channel->id])}}" class="Breadcrumb-content"> {{ $thread->channel->name }} </a> </span>
<span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
<a href="{{ route('forum.topic', [$thread->id])}}" class="Breadcrumb-content is-active"> {{ $thread->title }} </a> </span> </div>
@endsection

@section('content')
<section class="Topic" data-topic='{ "id":{{ $thread->channel->id }}, "lastPosition":2,"forum":{"id":{{ $thread->id }} },"isSticky":false,"isFeatured":false,"isLocked":false,"isHidden":false,"isFrozen":false, "isSpam":false, "pollId":0 }' data-user='{"id":{{ $thread->user->id }} }'>
<header class="Topic-header">
<div class="Container Container--content">
<h1 class="Topic-heading">
<a class="Game-logo" href="/"></a>
<span class="Topic-title" data-topic-heading="true">{{ $thread->title }}</span>
</h1>
<span class="Topic-subheading">
<a class="Topic-subheading--link" href="{{ route('forum', $thread->channel->id)}}">{{ $thread->channel->name }} </a>
</span>

<div class="Topic-controls">
@if(Auth::user() && $thread->locked)
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

{{ $topics->links('forum.categories.paginateposthead') }}
<div class="Topic-content">
<div class="TopicPost @if($thread->creator->role == 2) TopicPost--blizzard @endif @if($thread->creator->role == 1) TopicPost--mvp @endif" id="post-{{ $thread->id }}" data-topic-post="{&quot;id&quot;:&quot;{{ $thread->id }}&quot;,&quot;valueVoted&quot;:{{ $thread->up }},&quot;rank&quot;:{&quot;voteUp&quot;:{{ $thread->up }},&quot;voteDown&quot;:0},&quot;author&quot;:{&quot;id&quot;:&quot;{{ $thread->creator->id }}&quot;,&quot;name&quot;:&quot;{{ $thread->creator->name }}&quot;}}" data-topic="{ &quot;sticky&quot;:&quot;false&quot;,&quot;featured&quot;:&quot;false&quot;,&quot;locked&quot;:&quot;false&quot;,&quot;frozen&quot;:&quot;false&quot;,&quot;hidden&quot;:&quot;false&quot;,&quot;pollId&quot;:&quot;0&quot;}">
<span id="{{ $thread->id }}"></span>
<div class="TopicPost-content">
<div class="TopicPost-authorIcon @if($thread->creator->role == 2) TopicPost-authorIcon--blizzard @endif">
<svg xmlns="http://www.w3.org/2000/svg">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-blizzard"/>
</svg>
</div>
<aside class="TopicPost-author">
<div class="Author-block">
<div class="Author @if($thread->creator->role == 2) Author--blizzard @endif @if($thread->creator->role == 1) Author--mvp @endif" id="" data-topic-post-body-content="true"><a href="{{ route('profiles', [$thread->creator->name]) }}" class="Author-avatar hasNoProfile"><img src="{{ asset('/uploads/avatar/'.$thread->creator->avatar) }}" alt="" /></a>
<div class="Author-details">
@if($thread->creator->role == 2)
<span class="Author-name">{{ $thread->creator->name }}</span>
@else
<a class="Author-name--profileLink" href="{{ route('profiles', [$thread->creator->name]) }}">{{ $thread->creator->name }}</a>
@endif
@if($thread->creator->role == 2)
<span class="Author-job">Customer Service</span>
@elseif($thread->creator->role == 1)
<span class="Author-job">MVP</span>
@endif
<span class="Author-posts">
<a class="Author-posts" href="/forum/search?a={{ $thread->creator->name }}" data-toggle="tooltip" data-tooltip-content="@lang('forum.view_message_history')" data-original-title="" title="">
 @lang('forum.count_messages', ['count' => $thread->creator->posts_count])</a>
</span></div></div>
</div>
</aside>
<div class="TopicPost-body" data-topic-post-body="true">
    <div class="TopicPost-details">
        <div class="Timestamp-details">
        <a class="TopicPost-timestamp" href="#post-{{ $thread->id }}" data-toggle="tooltip" data-tooltip-content="{{ $thread->created_at->format('m/d/Y H:i') }}" data-original-title="" title="">{{ $thread->created_at->diffForHumans() }}</a>
        <!--a class="TopicPost-timestamp" href="#post-{{ $thread->id }}" data-toggle="tooltip" data-tooltip-content="Гринфайр {{ $thread->updated_at->format('m/d/Y H:i') }}"> &#160;(Отредактировано) </a-->
            @if($thread->up)<span class="TopicPost-rank TopicPost-rank--up" data-topic-post-rank="true">{{ $thread->up }}</span>@endif
            <span class="TopicPost-rank TopicPost-rank--none" data-topic-post-rank="true"></span>
    </div>
@guest
@else
<aside class="TopicPost-control">
<div class="TopicPost-menu Dropdown"><button class="Button-dropdown Button--secondary Button--icon" data-trigger="toggle.dropdown.menu" data-toggle="tooltip" data-tooltip-content="@lang('forum.dropdown')" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon Icon--16 Icon--blue Icon--button Icon--caretdown"></i></span></button><div class="Dropdown-menu"><span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span><div class="Dropdown-items">
@if(Auth::user()->name == $thread->creator->name)
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
<div class="TopicPost-bodyContent" data-topic-post-body-content="true"><b>{!! $thread->body !!}</b></div>
@guest
@else<footer class="TopicPost-actions" data-topic-post-body-content="true"><button class="TopicPost-button TopicPost-button--like" data-topic-post-button="true" data-trigger="vote.up.topicpost" type="button"><span class="Button-content"><i class="Icon"></i>Нравится</span></button><a href="#detail" class="TopicPost-button TopicPost-button--quote" data-topic-post-button="true" data-trigger="quote.topicpost" type="button"><span class="Button-content"><svg xmlns="http://www.w3.org/2000/svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-quote"/></svg>Цитирование</span></a></footer>@endguest
            </div>
        </div>
    </div>
    @foreach ($topics as $reply)

<div class="TopicPost @if($reply->creator->role == 2) TopicPost--blizzard @endif @if($reply->creator->role == 1) TopicPost--mvp @endif" id="post-{{ $reply->id }}" data-topic-post="{&quot;id&quot;:&quot;{{ $reply->id }}&quot;,&quot;valueVoted&quot;:{{ $reply->up }},&quot;rank&quot;:{&quot;voteUp&quot;:{{ $reply->up }},&quot;voteDown&quot;:0},&quot;author&quot;:{&quot;id&quot;:&quot;{{ $reply->creator->id }}&quot;,&quot;name&quot;:&quot;{{ $reply->creator->name }}&quot;}}" data-topic="{ &quot;sticky&quot;:&quot;false&quot;,&quot;featured&quot;:&quot;false&quot;,&quot;locked&quot;:&quot;false&quot;,&quot;frozen&quot;:&quot;false&quot;,&quot;hidden&quot;:&quot;false&quot;,&quot;pollId&quot;:&quot;0&quot;}">
<span id="{{ $reply->id }}"></span>
<div class="TopicPost-content">
<div class="TopicPost-authorIcon @if($reply->creator->role == 2) TopicPost-authorIcon--blizzard @endif">
<svg xmlns="http://www.w3.org/2000/svg">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-blizzard"/>
</svg>
</div>
<aside class="TopicPost-author">
<div class="Author-block">
<div class="Author @if($reply->creator->role == 2) Author--blizzard @endif @if($reply->creator->role == 1) Author--mvp @endif" id="" data-topic-post-body-content="true"><a href="{{ route('profiles', [$reply->creator->name]) }}" class="Author-avatar hasNoProfile"><img src="{{ asset('/uploads/avatar/'.$reply->creator->avatar) }}" alt="" /></a>
<div class="Author-details">
    @if($reply->creator->role == 2)
    <span class="Author-name">{{ $reply->creator->name }}</span>
    @else
    <a class="Author-name--profileLink" href="{{ route('profiles', [$reply->creator->name]) }}">{{ $reply->creator->name }}</a>
    @endif
    @if($reply->creator->role == 2)
    <span class="Author-job">Customer Service</span>
    @elseif($reply->creator->role == 1)
    <span class="Author-job">MVP</span>
    @endif
<span class="Author-posts">
<a class="Author-posts" href="/forum/search?a={{ $reply->creator->name }}" data-toggle="tooltip" data-tooltip-content="@lang('forum.view_message_history')" data-original-title="" title="">
@lang('forum.count_messages', ['count' => $reply->creator->posts_count])</a>
</span></div></div>
</div>
</aside>

            <div class="TopicPost-body" data-topic-post-body="true">
                <div class="TopicPost-details">
                    <div class="Timestamp-details">
                    <a class="TopicPost-timestamp" data-toggle="tooltip" data-tooltip-content="{{ $reply->created_at->diffForHumans() }}" data-original-title="" title="">{{ $reply->created_at->diffForHumans() }}</a>
                     <!--a class="TopicPost-timestamp" href="#post-1" data-toggle="tooltip" data-tooltip-content="Ник 11/03/2017 15:16">
                            &#160;(Отредактировано)
</a-->
                        @if($reply->up)<span class="TopicPost-rank TopicPost-rank--up" data-topic-post-rank="true">{{ $reply->up }}</span>@endif
                        <span class="TopicPost-rank TopicPost-rank--none" data-topic-post-rank="true"></span>
                </div>
@guest
@else
<aside class="TopicPost-control">
<div class="TopicPost-menu Dropdown"><button class="Button-dropdown Button--secondary Button--icon" data-trigger="toggle.dropdown.menu" data-toggle="tooltip" data-tooltip-content="@lang('forum.dropdown')" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon Icon--16 Icon--blue Icon--button Icon--caretdown"></i></span></button><div class="Dropdown-menu"><span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span><div class="Dropdown-items">
@if(Auth::user()->name == $reply->creator->name)
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
<div class="TopicPost-bodyContent" data-topic-post-body-content="true"><b>{!! $reply->body !!}</b></div>
@guest
@else<footer class="TopicPost-actions" data-topic-post-body-content="true"><button class="TopicPost-button TopicPost-button--like" data-topic-post-button="true" data-trigger="vote.up.topicpost" type="button"><span class="Button-content"><i class="Icon"></i>Нравится</span></button><a href="#detail" class="TopicPost-button TopicPost-button--quote" data-topic-post-button="true" data-trigger="quote.topicpost" type="button"><span class="Button-content"><svg xmlns="http://www.w3.org/2000/svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-quote"/></svg>Цитирование</span></a></footer>@endguest
</div>
</div>
</div>
@endforeach
</div>
    {{ $topics->links('forum.categories.paginatepost') }}


    </section>
    @guest
        <section class="Section Section--secondary">
        <div data-topic-post="true" tabindex="0" class="TopicForm is-editing" id="topic-reply">

        <div class="LoginPlaceholder-content"> <aside class="LoginPlaceholder-author"> <div class="Author" id="" data-topic-post-body-content="true"><div class="Author-avatar Author-avatar--default"></div><div class="Author-details"><span class="Author-name is-blank"></span> <span class="Author-posts is-blank"></span></div></div> <div class="Author-ignored is-hidden" data-topic-post-ignored-author="true"> <span class="Author-name"> </span><div class="Author-posts Author-posts--ignored">@lang('forum.ignored')</div></div> </aside> <div class="LoginPlaceholder-details"> <div class="LogIn-message">@lang('forum.logIn_message')</div> <a class="LogIn-button" href="{{ route('login') }}"> <span class="LogIn-button-content" >@lang('forum.logIn_content')</span> </a> </div> </div>

        </div>
        </section>
    @else
        @if(Auth::user()->confirmed)
            @if($thread->locked)
                @include('forum.new_reply_topic_closed')
            @else
                @include('forum.new_reply')
            @endif
        @else
            @include('forum.new_reply_no_confirmed')
        @endif
    @endguest
  <div class="Topic-container--bottomNav">
    <a class="Topic-button--parentForum" href="{{ route('forum', [$thread->channel->id])}}" type="button">
      <span class="Button-content"><i class="Icon"></i>@lang('forum.parentForum')</span>
    </a>
  </div>
@endsection