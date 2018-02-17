@extends('layouts.forum')

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="/" class="Breadcrumb-content">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> Форумы </a> </span>
<span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
<a href="{{ route('forum', [$topic->category->id])}}" class="Breadcrumb-content"> {{ $topic->category->name }} </a> </span>
<span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
<a href="{{ route('forum.topic', [$topic->category->id, $topic->id])}}" class="Breadcrumb-content is-active"> {{ $topic->title }} </a> </span> </div>
@endsection

@section('content')
<section class="Topic" data-topic="{ 'id':17614932085, 'lastPosition':6,'forum':{'id':975484},'isSticky':false,'isFeatured':false,'isLocked':false,'isHidden':false,'isFrozen':false, 'isSpam':false, 'pollId':0 }" data-user="{'id':56484562}">
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
<button class="Topic-button Topic-button--reply" id="Button-reply">
<span class="Overlay-element"></span>
<span class="Button-content"><i class="Icon"></i>Ответить</span></button>
</div>
</div>
</header>

<div class="Container Container--content Topic-container">
<div class="Topic-pagination--header">
</div>
<div class="Topic-pagination--mobile">
</div>
</div>
<div class="Topic-content">
        <div class="TopicPost TopicPost--blizzard" id="post-1" data-topic-post="{'id':'{{ $topic->id }}','valueVoted':0,'rank':{'voteUp':0,'voteDown':0},'author':{'id':'{{ $topic->user->id }}','name':'{{ $topic->user->name }}'}}" data-topic="{'sticky':'false','featured':'false','locked':'false','frozen':'false','hidden':'false','pollId':'0'}">
<span id="1"></span>
<div class="TopicPost-content">
<div class="TopicPost-authorIcon TopicPost-authorIcon--blizzard">
<svg xmlns="http://www.w3.org/2000/svg">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-blizzard"/>
</svg>
</div>
<aside class="TopicPost-author">
<div class="Author-block">
<div class="Author Author--blizzard" id="" data-topic-post-body-content="true"><a href="/user/{{ $topic->user->name }}" class="Author-avatar hasNoProfile"><img src="/images/avatars/wow/4-0.jpg" alt="" /></a>
<div class="Author-details">
    <a class="Author-name--profileLink" href="/user/{{ $topic->user->name }}">{{ $topic->user->name }}</a>
    <span class="Author-job">Customer Service {{ $topic->user->top_role }}</span>
<span class="Author-posts">
<a class="Author-posts" href="/forum/search?a={{ $topic->user->name }}" data-toggle="tooltip" data-tooltip-content="Просмотреть историю сообщений" data-original-title="" title="">
Сообщений: {{ $topic->user->posts_count }}</a>
</span></div></div>
</div>
</aside>
<script>
    var TOPIC_POST = {{ $topic->id }};
</script>
            <div class="TopicPost-body" data-topic-post-body="true">
                <div class="TopicPost-details">
                    <div class="Timestamp-details">
                    <a class="TopicPost-timestamp" href="#post-1" data-toggle="tooltip" data-tooltip-content="{{ $topic->created_at->format('m/d/Y H:i') }}" data-original-title="" title="">{{ $topic->created_at->diffForHumans() }}</a>
                     <!--a class="TopicPost-timestamp" href="#post-1" data-toggle="tooltip" data-tooltip-content="Гринфайр 11/03/2017 15:16">
                            &#160;(Отредактировано)
</a-->
                        <span class="TopicPost-rank TopicPost-rank--up" data-topic-post-rank="true"
data-toggle="tooltip" data-tooltip-content="Нравится: 0. Не нравится: 0.">1</span>
                        <span class="TopicPost-rank TopicPost-rank--none" data-topic-post-rank="true"></span>
                </div>
                    <aside class="TopicPost-control">
<div class="TopicPost-menu Dropdown"><button class="Button-dropdown Button--secondary Button--icon" data-trigger="toggle.dropdown.menu" data-toggle="tooltip" data-tooltip-content="Дополнительные настройки" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon Icon--16 Icon--blue Icon--button Icon--caretdown"></i></span></button><div class="Dropdown-menu"><span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span><div class="Dropdown-items"><span class="Dropdown-item" data-clipboard-text="/forum/topic/17614932085#post-1">Копировать ссылку</span>
@guest
@else
<div class="Dropdown-divider"></div>
    @if(Auth::user()->name == $topic->user->name)
    <span class="Dropdown-item" data-topic-post-button="true" data-trigger="edit.topicpost">Редактировать</span>
    <span class="Dropdown-item" data-topic-post-button="true" data-trigger="delete.topicpost">Удалить</span>
    @else
    <span class="Dropdown-item" data-topic-post-button="true" data-trigger="report.preview.topicpost">Сообщить модераторам</span>
    <span class="Dropdown-item" data-topic-post-button="true" data-topic-post-ignore-button="true" data-trigger="ignore.user.topicpost">Игнорировать</span>
<span class="Dropdown-item is-hidden" data-topic-post-button="true" data-topic-post-unignore-button="true" data-trigger="unignore.user.topicpost">Перестать игнорировать</span>
    @endif
@endguest
</div></div></div>
                    </aside>
                </div>

                <button class="TopicPost-button TopicPost-button--viewPost is-hidden" data-topic-post-button="true" data-topic-viewpost-button="true" data-trigger="view.post.topicpost">
                    <span class="Button-content">Открыть сообщение</span>
                </button>
<div class="TopicPost-bodyContent" data-topic-post-body-content="true"><b>{{ $topic->content }}</b></div>
@guest
@else
<footer class="TopicPost-actions" data-topic-post-body-content="true">
<button class="TopicPost-button TopicPost-button--like" data-topic-post-button="true" data-trigger="vote.up.topicpost" type="button"><span class="Button-content"><i class="Icon"></i>Нравится</span></button>						<button class="TopicPost-button TopicPost-button--dislike only-icon" data-topic-post-button="true" data-toggle="tooltip" data-tooltip-content="Не нравитсяНе нравится" data-trigger="vote.down.topicpost" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon"></i></span></button><a href="#detail" class="TopicPost-button TopicPost-button--quote" data-topic-post-button="true" data-trigger="quote.topicpost" type="button">							<span class="Button-content">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-quote"/>
                                </svg>
                                Цитирование</span></a>					</footer> @endguest             </div>
        </div>
    </div>
    @foreach ($replies as $reply)
<div class="TopicPost TopicPost--blizzard" id="post-{{ $reply->id }}" data-topic-post="{'id':'{{ $reply->id }}','valueVoted':0,'rank':{'voteUp':0,'voteDown':0},'author':{'id':'{{ Auth::user()->id }}','name':'{{ Auth::user()->name }}'}}" data-topic="{'sticky':'false','featured':'false','locked':'false','frozen':'false','hidden':'false','pollId':'0'}">
<span id="1"></span>
<div class="TopicPost-content">
<div class="TopicPost-authorIcon TopicPost-authorIcon--blizzard">
<svg xmlns="http://www.w3.org/2000/svg">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-blizzard"/>
</svg>
</div>
<aside class="TopicPost-author">
<div class="Author-block">
<div class="Author Author--blizzard" id="" data-topic-post-body-content="true"><a href="/user/{{ $reply->user->name }}" class="Author-avatar hasNoProfile"><img src="/forums/static/images/avatars/wow/4-0.jpg" alt="" /></a>
<div class="Author-details">
<span class="Author-name">{{ $reply->user->name }}</span>
    <span class="Author-job">Customer Service </span>
<span class="Author-posts">
<a class="Author-posts" href="/forum/search?a={{ $reply->user->name }}" data-toggle="tooltip" data-tooltip-content="Просмотреть историю сообщений" data-original-title="" title="">
Сообщений: {{ $reply->user->posts_count }}</a>
</span></div></div>
</div>
</aside>

            <div class="TopicPost-body" data-topic-post-body="true">
                <div class="TopicPost-details">
                    <div class="Timestamp-details">
                    <a class="TopicPost-timestamp" href="#post-1" data-toggle="tooltip" data-tooltip-content="{{ $reply->created_at->diffForHumans() }}" data-original-title="" title="">{{ $reply->created_at->diffForHumans() }}</a>
                     <!--a class="TopicPost-timestamp" href="#post-1" data-toggle="tooltip" data-tooltip-content="Гринфайр 11/03/2017 15:16">
                            &#160;(Отредактировано)
</a-->
                        <span class="TopicPost-rank TopicPost-rank--up" data-topic-post-rank="true"
data-toggle="tooltip" data-tooltip-content="Нравится: 0. Не нравится: 0.">1</span>
                        <span class="TopicPost-rank TopicPost-rank--none" data-topic-post-rank="true"></span>
                </div>
                    <aside class="TopicPost-control">
<div class="TopicPost-menu Dropdown"><button class="Button-dropdown Button--secondary Button--icon" data-trigger="toggle.dropdown.menu" data-toggle="tooltip" data-tooltip-content="Дополнительные настройки" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon Icon--16 Icon--blue Icon--button Icon--caretdown"></i></span></button><div class="Dropdown-menu"><span class="Dropdown-arrow Dropdown-arrow--up" data-attachment="top right" data-target-attachment="bottom center"></span><div class="Dropdown-items"><span class="Dropdown-item" data-clipboard-text="/forum/topic/17614932085#post-1">Копировать ссылку</span>
@guest
@else
<div class="Dropdown-divider"></div>
    @if(Auth::user()->name == $reply->user->name)
    <span class="Dropdown-item" data-topic-post-button="true" data-trigger="edit.topicpost">Редактировать</span>
    <span class="Dropdown-item" data-topic-post-button="true" data-trigger="delete.topicpost">Удалить</span>
    @else
    <span class="Dropdown-item" data-topic-post-button="true" data-trigger="report.preview.topicpost">Сообщить модераторам</span>
<span class="Dropdown-item" data-topic-post-button="true" data-topic-post-ignore-button="true" data-trigger="ignore.user.topicpost">Игнорировать</span>
<span class="Dropdown-item is-hidden" data-topic-post-button="true" data-topic-post-unignore-button="true" data-trigger="unignore.user.topicpost">Перестать игнорировать</span>
    @endif
@endguest
</div></div></div>
                    </aside>
                </div>

                <button class="TopicPost-button TopicPost-button--viewPost is-hidden" data-topic-post-button="true" data-topic-viewpost-button="true" data-trigger="view.post.topicpost">
                    <span class="Button-content">Открыть сообщение</span>
                </button>
<div class="TopicPost-bodyContent" data-topic-post-body-content="true"><b>{{ $reply->content }}</b></div>
@guest
@else<footer class="TopicPost-actions" data-topic-post-body-content="true">
<button class="TopicPost-button TopicPost-button--like" data-topic-post-button="true" data-trigger="vote.up.topicpost" type="button"><span class="Button-content"><i class="Icon"></i>Нравится</span></button>						<button class="TopicPost-button TopicPost-button--dislike only-icon" data-topic-post-button="true" data-toggle="tooltip" data-tooltip-content="Не нравитсяНе нравится" data-trigger="vote.down.topicpost" type="button" data-original-title="" title=""><span class="Button-content"><i class="Icon"></i></span></button><a href="#detail" class="TopicPost-button TopicPost-button--quote" data-topic-post-button="true" data-trigger="quote.topicpost" type="button">							<span class="Button-content">
                                <svg xmlns="http://www.w3.org/2000/svg">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-quote"/>
                                </svg>
                                Цитирование</span></a>					</footer>   @endguest           </div>
        </div>
    </div>
    @endforeach
</div>

        <footer class="Topic-footer">
            <div class="Container Container--content">
                <div class="Topic-pagination--footer">
                </div>
                <div class="Topic-pagination--mobile">
                </div>
            </div>
        </footer>
    </section>
    @guest
    <section class="Section Section--secondary">
        <div data-topic-post="true" tabindex="0" class="TopicForm is-editing" id="topic-reply">

        <div class="LoginPlaceholder-content"> <aside class="LoginPlaceholder-author"> <div class="Author" id="" data-topic-post-body-content="true"><div class="Author-avatar Author-avatar--default"></div><div class="Author-details"><span class="Author-name is-blank"></span> <span class="Author-posts is-blank"></span></div></div> <div class="Author-ignored is-hidden" data-topic-post-ignored-author="true"> <span class="Author-name"> </span><div class="Author-posts Author-posts--ignored">проигнорировано</div></div> </aside> <div class="LoginPlaceholder-details"> <div class="LogIn-message">Вам есть что сказать? Авторизуйтесь, чтобы присоединиться к обсуждению.</div> <a class="LogIn-button" href="?login"> <span class="LogIn-button-content" >Авторизация</span> </a> </div> </div>

        </div>
    </section>
    @else
    <section class="Section Section--secondary">
    <div data-topic-post="true" tabindex="0" class="TopicForm is-editing" id="topic-reply">

<header class="TopicForm-header">
<h1 class="TopicForm-heading">Обсудить</h1>
</header>
<div class="TopicForm-content">
<aside class="TopicForm-author" data-topic-form="{'userId': {{ Auth::user()->id }}}">
<div class="Author" id="" data-topic-post-body-content="true"><a href="/user/{{ Auth::user()->name }}" class="Author-avatar "><img src="/images/avatars/wow/4-0.jpg" alt="" /></a><div class="Author-details"> <span class="Author-name">
<a class="Author-name--profileLink" href="/user/{{ Auth::user()->name }}">{{ Auth::user()->name }}</a>
</span>
<span class="Author-posts">
<a class="Author-posts" href="/search?a={{ Auth::user()->name }}" data-toggle="tooltip" data-tooltip-content="Просмотреть историю сообщений" data-original-title="" title="">
Сообщений: {{ Auth::user()->posts_count }}
</a>
</span></div></div>
<div class="Author-ignored is-hidden" data-topic-post-ignored-author="true">
<span class="Author-name">
<a class="Author-name--profileLink" href="/user/{{ Auth::user()->name }}">{{ Auth::user()->name }}</a>
</span>
<div class="Author-posts Author-posts--ignored">проигнорировано</div></div>
</aside>

<form class="Form" action="{{ route('forum.topic.reply.create', [$topic->category->id, $topic->id])}}" id="topic-reply-form" method="post" data-post-form="true">
<fieldset>
{{ csrf_field() }}
<input type="hidden" name="sessionPersist" value="forum.topic.post"/>
</fieldset>
<div class="TopicForm-group TopicForm-group-content TopicForm-group--isActivated" data-topic-form="true">
<textarea id="detail" name="detail" class="TopicForm-control needsclick TopicForm-control--detail" data-topic-post-body-edit="true" tabindex="1" spellcheck="true" required="required"></textarea>
<div class="BmlToolbar" id="BmlToolbar">
    <div class="BmlToolbar--content">
    <span data-toggle="tooltip" data-tooltip-content="Полужирный шрифт" data-topic-post-button="true" data-trigger="bml.bold.bmltoolbar" class="BmlToolbar-button" data-original-title="" title="">
        <i class="Icon Icon--16 Icon--bold"></i>
    </span>
    <span data-toggle="tooltip" data-tooltip-content="Курсив" data-topic-post-button="true" data-trigger="bml.italics.bmltoolbar" class="BmlToolbar-button" data-original-title="" title=""><i class="Icon Icon--16 Icon--italics"></i>
    </span>
    <span data-toggle="tooltip" data-tooltip-content="Подчеркивание" data-topic-post-button="true" data-trigger="bml.underline.bmltoolbar" class="BmlToolbar-button" data-original-title="" title="">
        <i class="Icon Icon--16 Icon--underline"></i>
    </span>
    <span class="BmlToolbar-divider"></span>
    <span data-toggle="tooltip" data-tooltip-content="Список" data-topic-post-button="true" data-trigger="bml.list.bmltoolbar" class="BmlToolbar-button" data-original-title="" title="">
        <i class="Icon Icon--16 Icon--list"></i>
    </span>
    <span data-toggle="tooltip" data-tooltip-content="Пункт списка" data-topic-post-button="true" data-trigger="bml.listItem.bmltoolbar" class="BmlToolbar-button" data-original-title="" title="">
        <i class="Icon Icon--16 Icon--list-item"></i>
    </span>
    <span class="BmlToolbar-divider"></span>
    <span data-toggle="tooltip" data-tooltip-content="Цитата" data-topic-post-button="true" data-trigger="bml.quote.bmltoolbar" class="BmlToolbar-button" data-original-title="" title="">
        <i class="Icon Icon--16 Icon--quote"></i>
    </span>
    <span data-toggle="tooltip" data-tooltip-content="Код" data-topic-post-button="true" data-trigger="bml.code.bmltoolbar" class="BmlToolbar-button" data-original-title="" title="">
        <i class="Icon Icon--16 Icon--code"></i>
    </span>
    </div>
</div>
        <div class="PostForm-errors"></div>
    </div>
  <span class="TopicForm-link">
     <a href="/code-of-conduct" class="TopicForm-link--conduct">Правила поведения</a>
  </span>

<div class="TopicForm-action--buttons">
    <button type="submit" class="TopicForm-button TopicForm-button--reply" id="submit-button"><span class="Button-content">Ответить</span></button>
        <button type="button" data-topic-button="true" data-trigger="edit.topic.reply" class="TopicForm-button TopicForm-button--edit">
            <span class="Button-content">Редактировать</span></button>
</div>
</form>
</div>
  </div>
    </section>
    @endguest
  <div class="Topic-container--bottomNav">
    <a class="Topic-button--parentForum" href="/forum/{{ $topic->category->id }}" type="button">
      <span class="Button-content"><i class="Icon"></i>К форуму</span>
    </a>
  </div>
@endsection