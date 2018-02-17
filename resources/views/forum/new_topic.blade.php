@guest
@else
<div class="Section Section--secondary is-hidden" id="create-topic-section">
<div class="CreateTopic-container">
<div class="TopicForm TopicForm-group--isActive TopicForm-group--isActivated TopicForm--create is-hidden is-editing" data-topic-form="{'userId': {{ Auth::user()->id }}  }" id="create-topic"><header class="TopicForm-header"><h1 class="TopicForm-heading">Новая тема</h1><a class="TopicForm-button--close" data-trigger="create.topicpost.forum" data-forum-button="true"></a></header>
<div class="TopicForm-content">
<aside class="TopicForm-author" data-topic-form="{'userId': {{ Auth::user()->id }}  }">
<div class="Author" id="" data-topic-post-body-content="true">
<a href="/user/{{ Auth::user()->name }}" class="Author-avatar ">
<img src="/images/avatars/wow/4-0.jpg" alt="" /></a>
<div class="Author-details">
<span class="Author-name">
<a class="Author-name--profileLink" href="/user/{{ Auth::user()->name }}">{{ Auth::user()->name }}</a>
</span>
<span class="Author-posts">
<a class="Author-posts" href="/search?a={{ Auth::user()->name }}" data-toggle="tooltip" data-tooltip-content="Просмотреть историю сообщений" data-original-title="" title="">
Сообщений: {{ Auth::user()->posts_count }}
</a>
</span>
</div>
</div>
</aside>
<form class="Form" action="{{ route('forum.topic.store', $category) }}" method="post" id="create-topic-form" data-post-form="true">
<fieldset>
{{ csrf_field() }}
<input type="hidden" name="sessionPersist" value="" />
</fieldset>
<div class="TopicForm-group">	<i class="Icon Icon-compose"></i>
<input type="text" id="subject" name="subject" autocomplete="off" class="TopicForm-control TopicForm-control--subject TopicForm-subject" data-topic-form-subject="true" placeholder="Заголовок темы" required="required" tabindex="1" fieldType="text" />
</div>
<div class="TopicForm-group TopicForm-group-content">
<textarea id="postCommand.detail" name="messages" class="TopicForm-control TopicForm-control--detail TopicForm-detail" data-topic-form-detail="true" required="required" spellcheck="true" tabindex="1"></textarea>
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
</div>				<div class="CoolDownTimer-message" data-time-left="0" id="post-countdown">
Разместить новое сообщение вы сможете через <span class="time-left-display">1</span> сек.                </div>
<div class="TopicForm-link">
<a class="TopicForm-link--conduct" href="/forum/code-of-conduct/" target="_blank">Правила поведения</a></div>
<div class="TopicForm-action--buttons">
<button type="submit" id="submit-button" class="TopicForm-button TopicForm-button--create" data-topic-post-button="true">
<span class="Button-content">Создать тему</span>
</button>
<button type="button" class="TopicForm-button TopicForm-button--preview" data-topic-post-button="true" data-text="Предпросмотр">
<span class="Button-content">Предпросмотр</span>
</button>
<button type="button" class="TopicForm-button TopicForm-button--edit" data-topic-post-button="true" data-text="Редактировать">
<span class="Button-content">Редактировать</span>
</button>
</div>
</form></div></div>
</div>
</div>
@endguest