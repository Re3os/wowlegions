
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Панель управления</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link href="/skins/fonts/fontawesome/styles.min.css?v=22" rel="stylesheet" type="text/css">
    <link href="/skins/stylesheets/application.css?v=22" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/skins/javascripts/application.js?v=22"></script>
</head>
<body>
<script type="text/javascript">
<!--
var dle_act_lang   = ["Да", "Нет", "Ввод", "Отмена", "Загрузка изображений и файлов на сервер"];
var cal_language   = {en:{months:['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],dayOfWeek:["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]}};
var filedefaulttext= 'Файл не выбран';
var filebtntext    = 'Выберите файл';
var dle_login_hash = '6acc39500426d77e6a32d576b88fa77bd717de3d';
//-->
</script>
<div id="loading-layer" class="shadow-depth3"><i class="fa fa-spinner fa-spin"></i></div>
    <div class="navbar navbar-inverse bg-primary-700">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('admin-home') }}">WoWLegions</a>
            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-angle-double-down"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="fa fa-bars"></i></a></li>
            </ul>
        </div>
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="fa fa-bars"></i></a></li>
            </ul>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="/" title="Просмотр сайта" target="_blank"><i class="fa fa-globe"></i><span class="visible-xs-inline-block position-right">Просмотр сайта</span></a></li>
                    <li><a class="sidebar-control hidden-xs" id="full_screen_toggle" title="Перейти в полноэкранный режим"><i class="fa fa-expand"></i></a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Персональные сообщения"><i class="fa fa-envelope"></i><span class="visible-xs-inline-block position-right">Персональные сообщения</span></a>
                        <div class="dropdown-menu dropdown-content" style="min-width:350px;">
                            <div class="dropdown-content-heading">
                                Персональные сообщения                                <ul class="icons-list">
                                    <li><a href="/" target="_blank"><i class="fa fa-envelope-o"></i></a></li>
                                </ul>
                            </div>
                            <div class="panel-body">На данный момент у Вас нет персональных сообщений</div>
                            <div class="dropdown-content-footer">
                                <a href="/" data-popup="tooltip" title="Все сообщения" target="_blank"><i class="fa fa-ellipsis-h"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="page-content">
            <div class="sidebar sidebar-main sidebar-default">
                <div class="sidebar-content">
                    <div class="sidebar-user-material">
                        <div class="category-content">
                            <div class="sidebar-user-material-content">
                                <img src="/skins/images/noavatar.png" class="img-circle img-responsive" alt="">
                                <h6>TheRock</h6>
                                <span class="text-size-small">Администраторы</span>
                            </div>
                            <div class="sidebar-user-material-menu">
                                <a href="#user-nav" data-toggle="collapse"><span>Аккаунт</span> <i class="caret"></i></a>
                            </div>
                        </div>
                        <div class="navigation-wrapper collapse" id="user-nav">
                            <ul class="navigation">
                                <li><a href="" target="_blank"><i class="fa fa-user"></i> <span>Просмотр профиля</span></a></li>
                                <li><a href="" target="_blank"><i class="fa fa-envelope"></i> <span><span class="badge bg-teal pull-right">0</span> Сообщения</span></a></li>
                                <li class="divider"></li>
                                <li><a href=""><i class="fa fa-cog"></i> <span>Настройки профиля</span></a></li>
                                <li><a href="/account/signout"><i class="fa fa-power-off text-danger-800"></i><span>Выход</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">
                                <li class="navigation-header"><span>Список разделов</span> <i class="fa fa-ellipsis-h" title="Список разделов"></i></li>
                                <li>
                                    <a href="#" class="has-ul"><i class="fa fa-wrench"></i> <span>Настройки скрипта</span></a>
                                <ul class="hidden-ul">
                                    <li><a href="/dashboard/options">Настройка системы</a></li>
                                    <li><a href="{{ route('admin-forum-list') }}">Настройки форума</a></li>
                                    <li><a href="/dashboard/slideshow">Настройки слайдшоу</a></li>
                                    <li><a href="/dashboard/protection">Вопросы и ответы для защиты от спама</a></li>
                                </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-ul"><i class="fa fa-user"></i> <span>Пользователи</span></a>
                                <ul class="hidden-ul">
                                    <li><a href="/dashboard/user">Редактирование пользователей</a></li>
                                    <li><a href="/dashboard/user/balance">User balanceБаланс пользователя</a></li>
                                    <li><a href="/dashboard/user/profile">Настройка профилей пользователей</a></li>
                                    <li><a href="/dashboard/user/groups">Настройка групп пользователей</a></li>
                                </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-ul"><i class="fa fa-leaf"></i> <span>Магазин</span></a>
                                <ul class="hidden-ul">
                                    <li><a href="{{ route('admin-shop-add') }}">Добавить</a></li>
                                    <li><a href="{{ route('admin-shop-list') }}">Список</a></li>
                                </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-ul"><i class="fa fa-laptop"></i> <span>Управление шаблонами</span></a>
                                <ul class="hidden-ul">
                                    <li><a href="">Шаблоны сайта</a></li>
                                    <li><a href="">Шаблоны E-Mail сообщений</a></li>
                                </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-ul"><i class="fa fa-leaf"></i> <span>Утилиты</span></a>
                                <ul class="hidden-ul">
                                    <li><a href="/dashboard/complaint">Список жалоб</a></li>
                                </ul>
                                </li>
                                <li>
                                    <a href="#" class="has-ul"><i class="fa fa-link"></i> <span>Другие разделы</span></a>
                                <ul class="hidden-ul">
                                    <li><a href="/dashboard/static/rules">Правила на сайте</a></li>
                                    <li><a href="/dashboard/static">Статические страницы</a></li>
                                    <li><a href="/dashboard/newsletter">Рассылка сообщений</a></li>
                                    <li><a href="/dashboard/editvote">Управление голосованиями</a></li>
                                    <li><a href="/dashboard/logs">Список действий в админпанели</a></li>
                                </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-wrapper">
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="fa fa-home position-left"></i><span class="text-semibold">Главная страница</span></h4>
                        </div>
                        <div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="{{ route('admin-news-add') }}" class="btn btn-link btn-float text-size-small has-text"><i class="fa fa-file-text-o text-primary"></i> <span>Добавить новость</span></a>
                                <a href="{{ route('admin-news-list') }}" class="btn btn-link btn-float text-size-small has-text"><i class="fa fa-edit text-primary"></i> <span>Редактировать новости</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('admin-home') }}"><i class="fa fa-home position-left"></i>Главная</a></li><li class="active">Главная страница панели управления</li>                        </ul>
                        <ul class="breadcrumb-elements">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog position-left"></i>Настройки<span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a id="style_switcher_toggle"><i class="fa fa-paint-brush"></i>Настройки панели</a></li>
                                    <li><a href="/account/management/"><i class="fa fa-user"></i>Настройки профиля</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/dashboard/options"><i class="fa fa-cogs"></i>Настройки скрипта</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                @yield('content')
                <div class="footer text-muted text-size-small">
WoWLegion&reg;  Copyright 2017-2018 &copy; <a href="https://wowlegions.ru/" target="_blank">WoWLegion</a> All rights reserved.
                </div>
            </div>
        </div>
    </div>
    <div id="style_switcher" title="Выбор оформления панели" style="display: none;">
        <div>
            <h5>Цвета</h5>
            <ul class="switcher_app_themes" id="theme_switcher">
                <li class="app_style_default" data-app-theme="">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_a" data-app-theme="dle_theme_a">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_b" data-app-theme="dle_theme_b">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_c" data-app-theme="dle_theme_c">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_d" data-app-theme="dle_theme_d">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_e" data-app-theme="dle_theme_e">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_f" data-app-theme="dle_theme_f">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_g" data-app-theme="dle_theme_g">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_h" data-app-theme="dle_theme_h">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_i" data-app-theme="dle_theme_i">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_dark" data-app-theme="dle_theme_dark">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
            </ul>
        </div>
        <div>
            <h5>Боковая панель</h5>
            <div class="checkbox">
                <label><input type="checkbox" name="style_sidebar_mini" id="style_sidebar_mini" class="icheck">Уменьшенный вид</label>
            </div>
        </div>
        <div>
            <h5>Ширина панели</h5>
            <div class="checkbox">
                <label><input type="checkbox" name="style_layout_boxed" id="style_layout_boxed" class="icheck">Фиксированная ширина панели</label>
            </div>
        </div>
        <div>
            <h5>Дизайн полей</h5>
            <label class="radio-inline"><input class="icheck" type="radio" name="style_input" value="0">Материальный</label>
            <label class="radio-inline"><input class="icheck" type="radio" name="style_input" value="1">Классический</label>
        </div>
    </div>
</body>
</html>