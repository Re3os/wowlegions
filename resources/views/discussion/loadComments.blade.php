@if($count == 0)
    <div id="comments" class="bnet-comments comments-error">
        <h2 class="subheader-2">К данной статье еще нет ни одного комментария. </h2>
        @include('discussion.comment_add')
    </div>
@elseif($count > 0)
<div id="comments" class="bnet-comments ">
<h2 class="subheader-2">Комментарии (<span id="comments-total">{{ $count }}</span>)</h2>
<a class="comments-pull-link" href="javascript:;" id="comments-pull" onclick="Comments.loadBase();" style="display: none">
    <span class="pull-single" style="display: block">: <span>{0}</span>.<strong>Обновить?</strong></span>
    <span class="pull-multiple" style="display: none">: <span>{0}</span>.<strong>Обновить?</strong></span>
</a>

<div class="comments-form-wrapper">
    @guest
    <div class="comments-error-gate">
        <p>Вы должны <a href="{{ route('login') }}">авторизоваться</a> со своей учетной записи, чтобы оставить комментарий.</p>
        <a href="{{ route('login') }}"><button class="ui-button button1" type="button">
            <span class="button-left">
                <span class="button-right">Вход</span>
            </span>
        </button></a>
    </div>
    @else
    @include('discussion.comment_add')
    @endguest
</div>
<div id="comments-pages-wrapper">
    <div class="comments-pages">
        <div id="comments-list-wrapper">
            <div class="comments-controls">
                <!-- Pagination is not yet done -->
            </div>
            <ul class="comments-list" id="comments-1">
                @foreach($com as $k => $comments)
                @if($k)
                @break
                @endif
                @include('discussion.comment', ['items' => $comments])
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    //<![CDATA[
    Comments.count = {{ $count }};
    //]]>
</script>
</div>
@else
    <div id="comments" class="bnet-comments comments-error">
        <h2 class="subheader-2">К данной статье еще нет ни одного комментария.</h2>
        <div class="comments-loading"/></div>
    </div>
@endif