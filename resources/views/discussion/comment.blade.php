@foreach($items as $comm)
<li class="" id="post-{{ $comm->id }}">
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
 @if(isset($com[$comm->id]))
    @include('discussion.comment_reply', ['items' => $com[$comm->id]])
 @endif
@endforeach