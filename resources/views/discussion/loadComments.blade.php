<div id="comments" class="bnet-comments " data-xstoken="67e4bf31-29d9-4d14-b631-a11df3679aef">
<script type="text/javascript">
//<![CDATA[
var Msg = Msg || {};
Msg.cms = Msg.cms || {};
Msg.cms.throttleError = "Вы должны подождать некоторое время, прежде чем вы сможете опубликовать новое сообщение.";
//]]>
</script>
<h2 class="subheader-2">Комментарии (<span id="comments-total">{{ $count }}</span>)</h2>

		<a href="javascript:;" class="comments-pull-link" id="comments-pull" onclick="Comments.loadBase();" style="display: none">
			<span class="pull-single" style="display: none">Новые комментарии: <span>{0}</span>. <strong>Обновить?</strong></span>
			<span class="pull-multiple" style="display: none">Новые комментарии: <span>{0}</span>. <strong>Обновить?</strong></span>
		</a>


	<div class="comments-form-wrapper">
    <div class="comments-error-gate">
    <p></p>
    <ul>
        <li>Срок действия игровой лицензии истек или нет текущей подписки.</li>
    </ul>
    <p></p>
    </div>
	</div>


		<div id="comments-pages-wrapper">
			<div class="comments-pages">
				<div id="comments-list-wrapper">

		<script type="text/javascript">
			var xstoken = '67e4bf31-29d9-4d14-b631-a11df3679aef';
		</script>


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

	<div id="report-post" class="report-post type-forums">
		<div id="report-table">

			<div class="report-desc">
			</div>
			<div class="report-detail report-data">



	<h3 class="subheader-3">					Сообщить модераторам о сообщении #<span id="offensive-post-id"></span> игрока <span id="offensive-post-author"></span>
</h3>
			</div>

			<div class="report-desc">
				Причина
			</div>
			<div class="report-detail">
				<select id="report-reason" required="required">
							<option value="ILLEGAL">Противозаконно</option>
							<option value="OTHER">Иное</option>
							<option value="TROLLING">Троллинг</option>
							<option value="HARASSMENT">Оскорбления</option>
							<option value="ADVERTISING_STRADING">Реклама</option>
							<option value="REAL_LIFE_THREATS">Угрозы в реальной жизни</option>
							<option value="NOT_SPECIFIED">Не указано</option>
							<option value="BAD_LINK">«Битая» ссылка</option>
							<option value="SPAMMING">Спам</option>
				</select>
			</div>

			<div class="report-desc">
				Объяснение <small>(не более 256 символов)</small>
			</div>
			<div class="report-detail">
				<textarea id="report-detail" class="post-editor" cols="78" rows="13" required="required" maxlength="256"></textarea>
			</div>
			<div class="report-submit-wrapper">

<a class="ui-button button1 report-submit" href="javascript:;"><span class="button-left"><span class="button-right">Отправить</span></span></a>
				<a class="cancel-report" href="javascript:;">Отмена</a>
			</div>
		</div>
		<div id="report-success" class="report-success">


	<h3 class="header-3">Готово!</h3>

			[<a href="javascript:;" onclick="$(&quot;#report-post&quot;).hide()">Закрыть</a>]
		</div>
	</div>
	<div id="ban-user" class="report-post type-forums">
	    <div id="ban-table">

            <div class="report-detail report-data">



	<h3 class="subheader-3">Ban User</h3>

            </div>

            <div class="report-detail">
                <span id="author-first-name"></span> <span id="author-last-name"></span> (<span id="account-email"></span>)
            </div>

            <div class="report-desc">
		    Причина закрытия
            </div>
            <div class="report-detail">
                <select id="ban-reason" required="required">
                        <option value="ILLEGAL">Противозаконно</option>
                        <option value="OTHER">Иное</option>
                        <option value="IN_GAME">внутриигровые действия, нарушающие Соглашение об использовании.</option>
                        <option value="HARASSMENT">Оскорбления</option>
                        <option value="RACIAL_HATRED">Расовая ненависть</option>
                        <option value="ADVERTISING">Реклама</option>
                        <option value="SPAMMING_TROLLING">Спам&nbsp;/ Trolling</option>
                        <option value="REAL_LIFE_THREATS">Угрозы в реальной жизни</option>
                        <option value="RELIGION_HATRED">Религиозная ненависть</option>
                        <option value="BAD_LINK">«Битая» ссылка</option>
                        <option value="OBSCENE_LANGUAGE">Обсценная лексика</option>
                </select>
            </div>

            <div class="report-desc">
		    Тип закрытия
            </div>
            <div class="report-detail">
                <select id="ban-type" required="required">
                        <option value="SUSPENSION">Приостановление</option>
                        <option value="PERMANENT">Постоянно</option>
                </select>
            </div>

            <div id="ban-duration" style="">
                <div class="report-desc">
	                Продолжительность
                </div>
	            <div class="report-detail">
                    <label class="ban-duration-radio">
                        <input type="radio" value="24" checked="checked" name="bantime">
		            1 дн.
                    </label>
                    <label class="ban-duration-radio">
                        <input type="radio" value="168" name="bantime">
		            1 нед.
                    </label>
                    <label class="ban-duration-radio">
                        <input type="radio" value="720" name="bantime">
		            30 дн.
                    </label>
                    <label class="ban-duration-custom-radio">
                        <input id="custom-duration-input" type="radio" value="custom" name="bantime">
		            Custom
                    </label>
					<span id="ban-length-span" style="margin-left:10px; display:none;">
						<input id="ban-length" name="ban-duration" type="text" value="24" size="6" maxlength="6">
					hours
					</span>
	            </div>
            </div>

            <div class="report-desc">
		    Личное замечание
            </div>
            <div class="report-detail">
                <textarea id="private-note" class="post-editor" cols="78" rows="13" required="required" maxlength="256"></textarea>
            </div>

            <div class="report-desc">
		    Открытое замечание
            </div>
            <div class="report-detail">
                <textarea id="public-note" class="post-editor" cols="78" rows="13" required="required" maxlength="256"></textarea>
            </div>
	        <div class="report-submit-wrapper">

<a class="ui-button button1 ban-submit" href="javascript:;"><span class="button-left"><span class="button-right">Отправить</span></span></a>
	            <a class="ban-cancel" href="javascript:;">Отмена</a>
	        </div>
	    </div>
	    <div id="ban-success" class="report-success">


	<h3 class="header-3">Учетная запись заблокирована на форумах</h3>

				[<a href="javascript:;" onclick="$(&quot;#ban-user&quot;).hide()">Закрыть</a>]
	    </div>
	</div>

		<script type="text/javascript">
		//<![CDATA[
			Comments.count = {{ $count }};
		//]]>
		</script>
	</div>