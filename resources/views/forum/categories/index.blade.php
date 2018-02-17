@extends('layouts.forum')

@section('sidebar')
<div class="Breadcrumbs"> <span class="Breadcrumb"> <a href="{{ route('forums') }}" class="Breadcrumb-content is-active">
<span class="Breadcrumb-divider Home"> <i class="Icon"></i> </span> Форумы </a> </span> </div>
@endsection

@section('content')
<section class="Community">
 <header class="Community-header">
    <div class="Community-wrapper">
    <div class="Welcome">
        <div class="Welcome-logo--container">
            <img class="Welcome-logo" src="/images/game-logos/game-logo-wow.png"/>
            <p class="Welcome-text">Добро пожаловать на официальные форумы <span class='CommunityName'>World of Warcraft</span></p>
        </div>
    </div>
</div>
</header>
@foreach ($categories as $category)
<div class="ForumCategory ">
        <header class="ForumCategory-header">
            <h1 class="ForumCategory-heading">{{$category->name}}</h1>@if($category->id == 1)<button class="Community-button--search" id="toggle-search-field" data-trigger="toggle.search.field" type="button"><span class="Button-content"><i class="Icon"></i></span></button><form action="/search" class="Form Form--search" data-search-all="true" id="forum-search-form">
                    <div class="Form-group">
                        <div class="Input Input--iconPrefix Input--search">
                            <input name="q" placeholder="Поиск по всем форумам" type="search" autocomplete='off' />
                            <i class="Icon Icon--prefix Icon--search"></i>
                            <div class="Input-border"></div>
                        </div>
                    </div>
                </form>  @endif                  </header>
        <div class="ForumCards ">
        @foreach ($category->forums as $forum)
            <a href="{{ route('forum', [$forum->id])}}" class="ForumCard ForumCard--content  ">
                <i class="ForumCard-icon" style="background-image: url('/cms/forum_icon/{{$forum->icons}}')"></i>
                <div class="ForumCard-details">
                    <h1 class="ForumCard-heading">{{$forum->name}}</h1>
                        <span class="ForumCard-description">{{$forum->category_description}}</span>    </div>
            </a>
        @endforeach
    </div>
</div>
@endforeach
</section>
@endsection