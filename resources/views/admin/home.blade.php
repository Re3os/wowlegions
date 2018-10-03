@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="panel panel-default">
<div class="panel-heading">
Быстрый доступ к разделам сайта  </div>
<div class="list-bordered">

<div class="row box-section">
<div class="col-sm-6 media-list media-list-linked">
<a class="media-link" href="/dashboard/user">
<div class="media-left"><img src="/skins/images/uset.png" class="img-lg section_icon"></div>
<div class="media-body">
    <h6 class="media-heading  text-semibold">Редактирование пользователей</h6>
    <span class="text-muted text-size-small">Управление зарегистрированными пользователями, редактирование их профилей и блокировка аккаунта</span>
</div>
</a>
</div>
<div class="col-sm-6 media-list media-list-linked">
<a class="media-link" href="/dashboard/banners">
<div class="media-left"><img src="/skins/images/rkl.png" class="img-lg section_icon"></div>
<div class="media-body">
    <h6 class="media-heading  text-semibold">Рекламные материалы</h6>
    <span class="text-muted text-size-small">Добавление и управление рекламными материалами, которые публикуются на сайте</span>
</div>
</a>
</div>
</div>

<div class="row box-section">
<div class="col-sm-6 media-list media-list-linked">
<a class="media-link" href="{{ route('options-index') }}">
<div class="media-left"><img src="/skins/images/tools.png" class="img-lg section_icon"></div>
<div class="media-body">
    <h6 class="media-heading  text-semibold">Настройка системы</h6>
    <span class="text-muted text-size-small">Настройка общих параметров скрипта</span>
</div>
</a>
</div>
<div class="col-sm-6 media-list media-list-linked">
<a class="media-link" href="/dashboard/newsletter">
<div class="media-left"><img src="/skins/images/nset.png" class="img-lg section_icon"></div>
<div class="media-body">
    <h6 class="media-heading  text-semibold">Рассылка сообщений</h6>
    <span class="text-muted text-size-small">Создание и массовая отправка E-Mail, для зарегистрированных пользователей</span>
</div>
</a>
</div>
</div>

<div class="row box-section">
<div class="col-sm-6 media-list media-list-linked">
<a class="media-link" href="/dashboard/static">
<div class="media-left"><img src="/skins/images/spset.png" class="img-lg section_icon"></div>
<div class="media-body">
    <h6 class="media-heading  text-semibold">Статические страницы</h6>
    <span class="text-muted text-size-small">Создание и редактирование страниц, которые как правило редко изменяются и имеют постоянный адрес</span>
</div>
</a>
</div>
<div class="col-sm-6 media-list media-list-linked">
<a class="media-link" href="/dashboard/clean">
<div class="media-left"><img src="/skins/images/clean.png" class="img-lg section_icon"></div>
<div class="media-body">
    <h6 class="media-heading  text-semibold">Мастер оптимизации</h6>
    <span class="text-muted text-size-small">Мастер оптимизации и очистки базы данных, позволяющий существенно увеличить скорость работы сайта</span>
</div>
</a>
</div>
</div>

</div>
</div>
<script language="javascript" type="text/javascript">
<!--
$(function(){

$.ajaxSetup({
    cache: false
});

$('#clearbutton').click(function() {

    $.get("/admin/clearcache", function( data ){

        $('#cachesize').html('0 b');
        Growl.info({
            title: 'Информация',
            text: data
        });

    });
    return false;
});

$('#check_updates').click(function() {

    ShowLoading('');

    $.get("/ajax/updates.html?versionid=v1.9.0", function( data ){
        HideLoading('');
        DLEalert(data, 'Информация');
    });
    return false;
});

});
//-->
</script>

<div class="panel panel-default">

<div class="panel-heading">
    <ul class="nav nav-tabs nav-tabs-solid">
        <li class="active"><a href="#statall" data-toggle="tab"><i class="fa fa-bar-chart position-left"></i> Общая статистика сайта</a></li>
        <li id="dlestats"><a href="#statauto" data-toggle="tab"><i class="fa fa-cog position-left"></i> Автопроверка системы</a></li>
    </ul>
</div>

     <div class="panel-tab-content tab-content">
         <div class="tab-pane active" id="statall">

            <table class="table table-sm">
                <tr>
                    <td class="col-md-3">Режим работы сайта:</td>
                    <td class="col-md-9">Включен</td>
                </tr>
                <tr>
                    <td>Общее количество новостей:</td>
                    <td>{{ $news }}</td>
                </tr>
                <tr>
                    <td>Поступившие жалобы:</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>Зарегистрировано пользователей:</td>
                    <td>{{ $account }}</td>
                </tr>
                <tr>
                    <td>Из них было забанено:</td>
                    <td><span class="text-danger">{{ $banned }}</span></td>
                </tr>
                <tr>
                    <td>Общий размер кэша:</td>
                    <td><span id="cachesize">{{ $cacheSize }}</span></td>
                </tr>
            </table>

            <div class="panel-footer"><button id="check_updates" name="check_updates" class="btn bg-slate-600 btn-sm btn-raised"><i class="fa fa-exclamation-circle"></i> Проверить наличие обновлений</button>&nbsp;<button id="clearbutton" name="clearbutton" class="btn bg-danger-600 btn-sm btn-raised"><i class="fa fa-trash"></i> Очистить кеш</button>						</div>
        </div>
         <div class="tab-pane" id="statauto" >
            <table class="table table-sm">
                <tr>
                    <td class="col-md-3">Версия:</td>
                    <td class="col-md-9">v1.9.0</td>
                </tr>
                <tr>
                    <td>Тип лицензии скрипта:</td>
                    <td>Лицензия активирована</td>
                </tr>
                <tr>
                    <td>Операционная система:</td>
                    <td>Linux 4.9.79-timeweb</td>
                </tr>
                <tr>
                    <td>Версия PHP:</td>
                    <td> {{ phpversion() }}</td>
                </tr>
                <tr>
                    <td>Версия MySQL:</td>
                    <td>5.6.39-83.1 mysql</td>
                </tr>
            </table>
         </div>
     </div>
 </div>            <!--div class="alert alert-danger alert-styled-left alert-arrow-left alert-component">После установки скрипта на сервер Вы не удалили файл <b>install.php</b> - это делает Ваш сайт уязвимым. Прежде чем продолжить работу, удалите данный файл с Вашего сервера!</div-->
@endsection