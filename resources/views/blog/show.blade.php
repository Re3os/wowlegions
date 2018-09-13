@extends('layouts.app')

@section('js')
<script src="{{ asset_media('/static/scripts/blog.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/forums/static/js/vendor/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/forums/static/js/comment-cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset_media('/forums/static/js/vendor/tether/dist/js/tether.min.js') }}"></script>
<script type="text/javascript">$(function() {
	Comments.initialize('{{ $blog->id }}', '{{ $blog->id }}', '/', 'wow');
});
</script>
@endsection

@section('blogjs')
<script>var dataLayer = dataLayer || [];
dataLayer.push({"blog":{"author":"{{ $blog->user->name }}","id":{{ $blog->id }},"publishDate":"{{ $blog->created_at->format('Y-M-d') }}","title":"{{ $blog->title }}"}});
</script>
@endsection

@section('content')
<div class="Pane Pane--underSiteNav Pane--fadeBottom bordered" data-url="{{ asset('uploads/images/'.$blog->images) }}">
    <div class="Pane-bg" style="background-color:#000000;background-image:url(&quot;{{ asset('uploads/images/'.$blog->images) }}&quot;);">
        <div class="Pane-overlay"></div>
    </div>
<div class="Pane-content">
    <div class="space-huge"></div>
    <div class="space-large" media-large="!space-large"></div>
    <div media-medium="space-medium" media-large="!space-medium space-huge"></div>
    <div media-wide="space-huge"></div>
    <div media-wide="space-huge"></div>
    <div media-huge="space-huge"></div>
    <div media-huge="space-huge"></div>
    <div class="contain-max">
        <div class="font-title-large-onDark">{{ $blog->title }}</div>
        <div class="space-small"></div>
        <div class="List">
            <div class="font-bliz-light-small-beige" media-medium="List-item gutter-tiny">
                <div class="Content">
                    <a href="/search/blog?a={{ $blog->user->name }}">{{ $blog->user->name }}</a>, {{ $blog->created_at->format('d M Y') }}
                </div>
            </div>
        <div class="List-item gutter-tiny">
            <a class="Link" href="#comments">
                <div class="CommentTotal CommentTotal--horizontal CommentTotal--transition">
                    <span class="Icon Icon--comment Icon--small CommentTotal-icon">
                        <svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#comment"></use></svg>
                    </span>
                    <div class="CommentTotal-number">{{ App\Comment::where('blog_id', $blog->id)->count() }}</div>
                </div>
            </a>
        </div>
    </div>
<div class="space-medium" media-large="space-large"></div>
</div>
</div>
</div>
<div class="Pane Pane--dirtDark">
    <div class="Pane-bg">
        <div class="Pane-overlay"></div>
    </div>
<div class="Pane-content">
    <div class="space-medium" media-large="space-large"></div>
    <div class="contain-wide">
        <div class="SocialButtons font-none">
            <div class="SocialButtons-button">
                <a class="SocialButtons-link SocialButtons-link--facebook font-size-xSmall" href="https://www.facebook.com/sharer/sharer.php?u={{ route('news.show', ['id' => $blog->id, 't' => $blog->title ]) }}" data-popup-height="450" data-popup-width="550" data-analytics="sns-share" data-analytics-placement="News - facebook"><span class="Icon Icon--social-facebook SocialButtons-icon SocialButtons-icon--facebook"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#social-facebook"></use></svg></span>Поделиться</a></div><div class="SocialButtons-button"><a class="SocialButtons-link SocialButtons-link--twitter font-size-xSmall" href="https://twitter.com/intent/tweet?text={{ $blog->title }}&amp;amp;url={{ route('news.show', ['id' => $blog->id, 't' => $blog->title ]) }}" data-popup-height="450" data-popup-width="550" data-analytics="sns-share" data-analytics-placement="News - twitter"><span class="Icon Icon--social-twitter SocialButtons-icon SocialButtons-icon--twitter"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#social-twitter"></use></svg></span>Твитнуть</a></div><div class="SocialButtons-button"><a class="SocialButtons-link SocialButtons-link--vkontakte font-size-xSmall" href="http://vkontakte.ru/share.php?url={{ route('news.show', ['id' => $blog->id, 't' => $blog->title ]) }}" data-popup-height="280" data-popup-width="550" data-analytics="sns-share" data-analytics-placement="News - vkontakte"><span class="Icon Icon--social-vkontakte SocialButtons-icon SocialButtons-icon--vkontakte"><svg class="Icon-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"><use xlink:href="/static/components/Icon/Icon.svg#social-vkontakte"></use></svg></span>Поделиться</a></div></div>
<div class="space-medium"></div>
<div id="blog">
<div class="Blog">
    <article class="detail">{!! $blog->full_blog !!}</article>
</div>
</div>
<div class="space-medium"></div>
<div class="space-medium"></div>
<div class="space-normal"></div>
<contain-wide>
    <div class="Comments">
        <iframe id="bnet-comments-noop"></iframe>
        <div class="bnet-comments" id="comments">
            <h2 class="subheader-2">Идет загрузка комментариев…</h2>
            <h2 class="hide">Сбой при загрузке комментариев.</h2>
        </div>
    <div class="comments-loading"></div>
</div>
</contain-wide>
</div>
<div class="space-normal"></div>
<div class="space-normal"></div>
</div>
</div>
<div class="Divider"></div>
@endsection