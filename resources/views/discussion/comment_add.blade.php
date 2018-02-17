<form id="comments-reply-form" class="comments-form" action="" method="post" style="display: none">
    {{ csrf_field() }}
    <div class="bnet-avatar">
        <div class="avatar-outer">
            <a href="/user/{{ Auth::user()->name }}">
                <img height="64" width="64" src="/wow/images/2d/avatar/4-0.jpg" alt=""/>
                <span class="avatar-inner"/></span>
            </a>
        </div>
    </div>
    <div class="text-wrapper">
        <div class="input-wrapper">
            <textarea name="detail" class="input textarea"/></textarea>
        </div>
        <ul class="comments-error-form">
            <li class="error-required">Field required</li>
            <li class="error-throttled">You cannot post at this time</li>
            <li class="error-length">This field is too long</li>
            <li class="error-title">Account Banned</li>
            <li class="error-frozen">This game license has expired or been frozen.</li>
            <li class="error-locked">
                This account has had its communication ability disabled.
            </li>
            <li class="error-cancelled">This game license has expired or been cancelled.</li>
            <li class="error-trial">
                Starter Edition accounts do not have the ability to create posts or use the rating buttons. Please upgrade to a full account to enable these features.
            </li>
            <li class="error-unknown">
                An error occurred. Please log out and back in, and try again.
            </li>
        </ul>
        <div class="comments-action">
            <button class="ui-button button1" type="button" onclick="return Comments.add(this, true);">
                <span class="buton-left">
                    <span class="button-left">
                        <span class="button-right">
                            Post
                        </span>
                    </span>
                </span>
            </button>
            <a class="ui-cancel" href="#" onclick="return Comments.cancelReply(this);">
                <span>
                    Cancel
                </span>
            </a>
        </div>
    </div>
</form>
<form id="comments-add-form" class="comments-form" action="" method="post">
    {{ csrf_field() }}
    <div class="bnet-avatar">
        <div class="avatar-outer">
            <a href="/user/{{ Auth::user()->name }}">
                <img height="64" width="64" src="/wow/images/2d/avatar/4-0.jpg" alt=""/>
                <span class="avatar-inner"/></span>
            </a>
        </div>
    </div>
    <div class="text-wrapper">
        <div class="input-wrapper">
            <textarea name="detail" class="input textarea"></textarea>
        </div>
        <ul class="comments-error-form">
            <li class="error-required">Field required</li>
            <li class="error-throttled">You cannot post at this time</li>
            <li class="error-length">This field is too long</li>
            <li class="error-title">Account Banned</li>
            <li class="error-frozen">This game license has expired or been frozen.</li>
            <li class="error-locked">
                This account has had its communication ability disabled.
            </li>
            <li class="error-cancelled">This game license has expired or been cancelled.</li>
            <li class="error-trial">
                Starter Edition accounts do not have the ability to create posts or use the rating buttons. Please upgrade to a full account to enable these features.
            </li>
            <li class="error-unknown">
                An error occurred. Please log out and back in, and try again.
            </li>
        </ul>
        <div class="comments-action">
            <button class="ui-button button1 comment-submit" type="button" onclick="return Comments.add(this);">
                <span class="button-left">
                    <span class="button-right">
                        Post
                    </span>
                </span>
            </button>
        </div>
        <div class="comments-throttler">
            Time till next post:
            <span class="throttle-time">
                60
            </span>
        </div>
    </div>
</form>