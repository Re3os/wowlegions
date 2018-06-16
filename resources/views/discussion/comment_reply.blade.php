@foreach($items as $comm)
<li class=" comment-nested" id="post-{{ $comm->id }}">
<div class="comment-tile">
<!--div class="rate-post-wrapper rate-post-login comment-rating comment-rating-positive">
+1
</div-->
<div class="rate-post-wrapper rate-post-login">
Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
</div>
<div class="comment-head">
<div class="CommentAuthor Author" id="" data-topic-post-body-content="true"><a href="{{ route('characters', [$comm->characters->name]) }}" class="Author-avatar "><img src="/images/avatars/wow/avatar-wow-default.png" alt=""></a><div class="Author-details"> <span class="Author-name">
<a class="Author-name--profileLink" href="{{ route('characters', [$comm->characters->name]) }}">{{ $comm->characters->name }}</a>
<span class="Author-timestamp">{{ $comm->created_at->format('d M Y H:i') }}</span>
</span>
<span class="Author-class @lang('forum.character_class_key_'.$comm->characters->class)">
{{ $comm->characters->level }} @lang('forum.race_'.$comm->characters->race) @lang('forum.class_'.$comm->characters->class)
</span>
<!--a class="Author-guild" href="http://eu.battle.net/wow/ru/guild/%D0%B1%D0%BE%D1%80%D0%B5%D0%B8%D1%81%D0%BA%D0%B0%D1%8F-%D1%82%D1%83%D0%BD%D0%B4%D1%80%D0%B0/%D0%9C%D0%9E%D0%93%D0%A3%D0%A7%D0%90%D0%AF%20%D0%9A%D0%A3%D0%A7%D0%9A%D0%90/">МОГУЧАЯ КУЧКА</a-->
<span class="Author-realm">
ElisGrimm
</span>
<span class="Author-posts is-blank"></span><span class="Author-comment">{{ $comm->text }}</span></div></div>
<div class="Author-ignored is-hidden" data-topic-post-ignored-author="true">
<span class="Author-name">
<a class="Author-name--profileLink" href="{{ route('characters', [$comm->characters->name]) }}">{{ $comm->characters->name }}</a>
</span><div class="Author-posts Author-posts--ignored">проигнорировано</div></div>
</div>
<div class="comment-foot">
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
</li>
@endforeach