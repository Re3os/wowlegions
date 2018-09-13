@foreach($items as $comm)
<li class="nested-reply" id="post-{{ $comm->id }}">
<div class="comment-tile">
<div class="rate-post-wrapper rate-post-login comment-rating comment-rating-positive">
+4
</div>
<div class="rate-post-wrapper">
<a href="javascript:;" class="rate-option rate-up" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->name }}" data-vote-type="up" data-report-type="1">
<span class="button-left">
<span class="button-right">Нравится</span>
</span>
</a>
<div class="rate-option downvote-wrapper">
<a href="javascript:;" onclick="$(this).next('.downvote-menu').toggle();" class="rate-down"></a>
<div class="downvote-menu" style="display:none">
<div class="ui-dropdown">
<div class="dropdown-wrapper">
<ul>
<li>
<a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->name }}" data-vote-type="down" data-report-type="1">Не нравится</a>
</li>
<li>
<a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->name }}" data-vote-type="down" data-report-type="2">Троллинг</a>
</li>
<li>
<a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->name }}" data-vote-type="down" data-report-type="3">Спам</a>
</li>
<li class="report-comment">
<a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->name }}" data-vote-type="report">Сообщить модераторам</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<span class="clear"><!-- --></span>
</div>
<div class="comment-head">
<div class="CommentAuthor Author" id="" data-topic-post-body-content="true"><a href="{{ route('profiles', [$comm->user->name]) }}" class="Author-avatar "><img src="{{ asset('/uploads/avatar/'.$comm->user->avatar) }}" alt=""></a><div class="Author-details"> <span class="Author-name">
<a class="Author-name--profileLink" href="{{ route('profiles', [$comm->user->name]) }}">{{ $comm->user->name }}</a>
<span class="Author-timestamp">{{ $comm->created_at->format('d M Y H:i') }}</span>
</span>
<span class="Author-realm">
ElisGrimm
</span>
<span class="Author-posts is-blank"></span><span class="Author-comment">{{ $comm->text }}</span></div></div>
<div class="Author-ignored is-hidden" data-topic-post-ignored-author="true">
<span class="Author-name">
<a class="Author-name--profileLink" href="{{ route('profiles', [$comm->user->name]) }}">{{ $comm->user->name }}</a>
</span><div class="Author-posts Author-posts--ignored">проигнорировано</div></div>
</div>
<div class="comment-foot">
<button class="ui-button btn button2 reply-button" type="button" onclick="Comments.reply('{{ $comm->id }}', '{{ $comm->user->id }}', '{{ $comm->user->name }}'); return false;"><span class="button-left"><span class="button-right"> Ответить
</span></span></button>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
</li>
<form id="comments-reply-form" class="comments-form" action="" method="post" style="display: none;">

<div class="character-info user ajax-update">
<div class="CommentAuthor Author" id="" data-topic-post-body-content="true"><a href="{{ route('profiles', [Auth::user()->name]) }}" class="Author-avatar "><img src="{{ asset('/uploads/avatar/'.Auth::user()->avatar) }}" alt=""></a><div class="Author-details"> <span class="Author-name">
<a class="Author-name--profileLink" href="{{ route('profiles', [Auth::user()->name]) }}">{{ Auth::user()->name }}</a>
</span>
<span class="Author-realm">
ElisGrimm
</span>
<span class="Author-posts is-blank"></span></div></div>
<div class="Author-ignored is-hidden" data-topic-post-ignored-author="true">
<span class="Author-name">
<a class="Author-name--profileLink" href="{{ route('profiles', [Auth::user()->name]) }}">{{ Auth::user()->name }}</a>
</span><div class="Author-posts Author-posts--ignored">проигнорировано</div></div>
</div>
<div class="text-wrapper">
<div class="input-wrapper">
<textarea name="detail" class="input textarea"></textarea>
</div>
<ul class="comments-error-form">
<li class="error-required">Обязательное для заполнения поле</li>
<li class="error-throttled">Вы сейчас не можете размещать сообщения</li>
<li class="error-length">Превышено максимальное количество символов</li>
<li class="error-title">Учетная запись заблокирована на форумах</li>
<li class="error-frozen">Срок действия игровой лицензии истек или нет текущей подписки.</li>
<li class="error-locked">Возможность размещения сообщения с этой учетной записи была отключена.</li>
<li class="error-cancelled">Срок действия игровой лицензии истек или лицензия была отменена.</li>
<li class="error-trial">На этом форуме нельзя размещать и оценивать сообщения со стартовой учетной записи. Конвертируйте учетную запись в полную, чтобы активировать эти функции.</li><li class="error-unknown">Произошла ошибка. Попробуйте, пожалуйста, еще раз. Но сначала выйдите из системы и авторизуйтесь заново.</li></ul><div class="comments-action"><button class="ui-button btn button1" type="button" onclick="return Comments.add(this, true);"><span class="button-left"><span class="button-right"> Сообщение</span></span></button><a class="ui-cancel " href="#" onclick="return Comments.cancelReply(this);"><span>Отмена</span></a></div></div></form>
 @if(isset($com[$comm->id]))
    @include('discussion.comment_reply', ['items' => $com[$comm->id]])
 @endif
@endforeach