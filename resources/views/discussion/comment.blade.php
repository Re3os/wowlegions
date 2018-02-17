@foreach($items as $comm)
<li class="" id="post-{{ $comm->id }}">
<div class="comment-tile">
    <div class="rate-post-wrapper rate-post-login comment-rating"></div>
        <div class="rate-post-wrapper">
        <a href="javascript:;" class="rate-option rate-up" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->username }}" data-vote-type="up" data-report-type="1">
        <span class="button-left">
            <span class="button-right">
                Like
            </span>
        </span>
        </a>
        <div class="rate-option downvote-wrapper">
            <a href="javascript:;" onclick="$(this).next('.downvote-menu').toggle();" class="rate-down"/>
            <div class="downvote-menu" style="display:none">
                <div class="ui-dropdown">
                    <div class="dropdown-wrapper">
                        <ul>
                            <li>
                                <a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->username }}" data-vote-type="down" data-report-type="1">
                                    Dislike
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->username }}" data-vote-type="down" data-report-type="2">
                                    Trolling
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->username }}" data-vote-type="down" data-report-type="3">
                                    Spam
                                </a>
                            </li>
                            <li class="report-comment">
                                <a href="javascript:;" data-post-id="{{ $comm->id }}" data-post-author="{{ $comm->user->username }}" data-vote-type="report">
                                    Report
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <span class="clear"></span>
    </div>
    <div class="bnet-avatar">
        <div class="avatar-outer">
            <a href="/user/{{ $comm->user->name }}">
                <img height="64" width="64" src="/wow/images/2d/avatar/4-0.jpg" alt=""/>
                <span class="avatar-inner"/></span>
            </a>
        </div>
    </div>
    <div class="comment-head">
        <div class="bnet-username" itemscope="itemscope" itemprop="author" itemtype="http://schema.org/Person">
            <div id="context-3" class="ui-context">
                <div class="context">
                    <a href="javascript:;" clas="close" onclick="return CharSelect.close(this);"/>
                    <div class="context-user">
                        <strong>{{ $comm->user->name }}</strong>
                    </div>
                    </a>
                    <div class="context-links">
                        <a href="/user/{{ $comm->user->name }}" title="Profile" rel="np" class="icon-profile link-first">
                            <span class="context-icon"/>
                            Profile</span>
                        </a>
                        <a href="/search?f=post&a={{ $comm->user->name }}&sort=time" title="View posts" rel="np" class="icon-posts link-last">
                            <span class="context-icon"/> </span>
                        </a>
                    </div>
                </div>
            </div>
            <a href="/user/{{ $comm->user->name }}"  itemprop="url" class="context-link wow-class-9">
                <span itemprop="name" class="poster-name">{{ $comm->user->name }}</span>
            </a>
            <span class="timestamp">{{ $comm->created_at->format('d M Y H:i') }}</span>
        </div>
    </div>
    <div class="comment-body">{{ $comm->text }}</div>
            @guest

            @else
            <div class="comment-foot">
                <button class="ui-button button2" type="button" onclick="Comments.toggleDelete('{{ $comm->id }}');" data-tooltip="Posts may be deleted within 15 minutes of posting.">
                <span class="button-left">
                    <span class="button-right">
                        Delete
                    </span>
                </span>
                    </button>
                <button class="ui-button button2 reply-button" type="button" onclick="Comments.reply('{{ $comm->id }}', {{ $comm->id }}, '{{ $comm->user->name }}'); return false;">
                <span class="button-left">
                    <span class="button-right">
                        Reply
                    </span>
                </span>
                </button>
                <span class="clear"><!-- --></span>
            </div>
            @endguest
    <span class="clear"></span>
</div>
</li>
 @if(isset($com[$comm->id]))
    @include('discussion.comment_reply', ['items' => $com[$comm->id]])
 @endif
@endforeach