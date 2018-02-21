@extends('layouts.forum')

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content is-active">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> Форумы </a> </span>
 <span class="Breadcrumb"> <span class="Breadcrumb-divider"> <i class="Icon"></i> </span>
 <a href="" class="Breadcrumb-content is-active"> Результаты поиска </a> </span></div>
@endsection

@section('content')
<div role="main">

<section class="Search">
    <header class="Search-header">
    <div class="Container Container--content"> <h1 class="Search-heading"> <a class="Game-logo" href="/forums/ru/wow/"></a> Результаты поиска по запросу «wow» </h1> <div class="Search-controls"> <div class="Search-option"> <select class="Search-forum-dropdown"> <option value="">Все форумы</option> <optgroup label="ПОДДЕРЖКА"> <option name="forum" value="975484">Служба поддержки</option> <option name="forum" value="975483">Техническая поддержка</option> <option name="forum" value="896179">Перевод и локализация</option> </optgroup> <optgroup label="СООБЩЕСТВО"> <option name="forum" value="896071">Ролевая игра</option> <option name="forum" value="896072">История</option> <option name="forum" value="896074">Общие темы</option> <option name="forum" value="19369484">Поиск игроков</option> <option name="forum" value="896079">Жизнь сообщества</option> <option name="forum" value="19369735">World of Warcraft: Classic</option> </optgroup> <optgroup label="ИГРОВОЙ ПРОЦЕСС"> <option name="forum" value="896045">Помощь новичкам и руководства</option> <option name="forum" value="19369589">Подземелья и рейды</option> <option name="forum" value="19369485">Задания и достижения </option> <option name="forum" value="6088594">Бои питомцев</option> <option name="forum" value="896047">Профессии</option> <option name="forum" value="19369576">Трансмогрификация</option> <option name="forum" value="896076">Интерфейс и макросы</option> <option name="forum" value="19369526">Архив Blizzard</option> <option name="forum" value="896178">Тестовый игровой мир</option> </optgroup> <optgroup label=" БОИ МЕЖДУ ИГРОКАМИ (PVP)"> <option name="forum" value="19369585">Арена</option> <option name="forum" value="19369586">PvP на полях боя и за их пределами</option> </optgroup> <optgroup label="КЛАССЫ"> <option name="forum" value="19369487">Охотник на демонов</option> <option name="forum" value="896177">Воин</option> <option name="forum" value="896081">Друид</option> <option name="forum" value="896173">Жрец</option> <option name="forum" value="896171">Маг</option> <option name="forum" value="6038098">Монах</option> <option name="forum" value="896170">Охотник</option> <option name="forum" value="896172">Паладин</option> <option name="forum" value="896174">Разбойник</option> <option name="forum" value="896080">Рыцарь смерти</option> <option name="forum" value="896176">Чернокнижник</option> <option name="forum" value="896175">Шаман</option> </optgroup> <optgroup label="ИГРОВЫЕ МИРЫ"> <option name="forum" value="940979">Азурегос</option> <option name="forum" value="940978">Борейская тундра</option> <option name="forum" value="940976">Вечная Песня</option> <option name="forum" value="940975">Галакронд</option> <option name="forum" value="1318339">Голдринн</option> <option name="forum" value="940974">Гордунни</option> <option name="forum" value="12643302">Гром / Термоштепсель</option> <option name="forum" value="940917">Дракономор</option> <option name="forum" value="12481142">Пиратская бухта / Ткач Смерти</option> <option name="forum" value="12309730">Король-лич / Седогрив</option> <option name="forum" value="10635503">Подземье / Разувий</option> <option name="forum" value="940912">Ревущий фьорд</option> <option name="forum" value="940911">Свежеватель душ</option> <option name="forum" value="940909">Страж Смерти</option> <option name="forum" value="940653">Черный Шрам</option> <option name="forum" value="940652">Ясеневый лес</option> </optgroup> </select> </div>

<form action="{{ route('forum.search') }}" class="Form" id="search-form"> <div class="Form-group"> <div class="Input Input--large Input--search"> <input id="search-input" name="q" placeholder="Поиск по..." type="search" value="{{ old('q') }}" autocomplete='off'/> <input data-search-forum="true" type="hidden" name="forum"/> <div class="Input-border"></div> </div> <button class="Search-button" type="submit"><span class="Button-content"><i class="Icon Icon--32 Icon--search"></i></span></button></div></form> </div> </div> </header>

<div class="Search-content">
@if ($result->isEmpty())
<div class="Search-noResults"> Поиск не дал результатов. Пожалуйста, проверьте правильность написания или используйте другие критерии поиска. </div>
@else
<div class="Page-searchSummary"> <div class="Page-searchSummary--results"> <span class="Search-result--numbers">{{$result->firstItem()}}&#8211; {{ $result->lastItem() }}</span> <span class="Search-result--text"> из</span> <span class="Search-result--numbers">{{ $result->total() }}</span> <span class="Search-result--text"> Сообщения</span> </div> </div>
@endif

@foreach($result as $item)
<div class="Post--searchPage" id="post-{{ $item->id }}"> <a href="{{ route('forum.topic', [$item->category->id, $item->id])}}"> <div class="Post-content Post-content--searchPage"> <aside class="TopicPost-author"> <div class="Author"> <div class="Author" id="" data-topic-post-body-content="true"><a href="/user/{{ $item->user->name }}" class="Author-avatar " ><img src="/forums/static/images/avatars/wow/4-1.jpg" alt="" /></a><div class="Author-details"> <span class="Author-name"> <a class="Author-name--profileLink" href="/user/{{ $item->user->name }}">{{ $item->user->name }}</a> </span> <span class="Author-posts"> <a class="Author-posts" href="/forum/search?a={{ $item->user->name }}" data-toggle="tooltip" data-tooltip-content="Просмотреть историю сообщений"> Сообщений: {{ $item->user->posts_count }} </a> </span></div></div> <div class="Author-ignored is-hidden" data-topic-post-ignored-author="true"> <span class="Author-name"> <a class="Author-name--profileLink" href="/user/{{ $item->user->name }}">{{ $item->user->name }}</a> </span><div class="Author-posts Author-posts--ignored">проигнорировано</div></div> </div> </aside> <div class="Post-body Post-body--searchPage"> <div class="Post-body Post-body--topicTitle">{{ $item->title }} </div> <span class="Post-body Post-body--forumName"> {{ $item->category->name }} </span> <span class="Post-timestamp Post-timestamp--searchPage"> {{ $item->created_at->diffForHumans() }} <span class="TopicPost-rank TopicPost-rank--none" data-topic-post-rank="true"></span> </span> <div class="Post-body--postContent"> {{ $item->content }} </div> </div> </div> </a> </div>
@endforeach

@if (!$result->isEmpty())
{{ $result->appends(['q' => \Illuminate\Support\Facades\Input::get('q')])->links('forum.paginate') }}
@endif
</div>
</section>
 </div>
@endsection