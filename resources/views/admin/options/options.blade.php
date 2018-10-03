@extends('layouts.admin')

@section('content')
<div class="content">
<script type="text/javascript">
<!--
    function ChangeOption(selectedOption) {
        document.getElementById('general').style.display = "none";
        document.getElementById('shop').style.display = "none";
        document.getElementById('news').style.display = "none";
        document.getElementById('comments').style.display = "none";
        document.getElementById('optimisation').style.display = "none";
        document.getElementById('mail').style.display = "none";
        document.getElementById('users').style.display = "none";
        document.getElementById(selectedOption).style.display = "";
   }
//-->
</script>
<!-- Toolbar -->
<div class="navbar navbar-default navbar-component navbar-xs systemsettings">
    <ul class="nav navbar-nav visible-xs-block">
        <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
    </ul>
    <div class="navbar-collapse collapse" id="navbar-filter">
        <ul class="nav navbar-nav">
            <li><a href="javascript:ChangeOption('general');" class="tip" title="Общие настройки скрипта"><i class="fa fa-cog"></i> Общие</a></li>
            <li><a href="javascript:ChangeOption('shop');" class="tip" title="Настройки магазина"><i class="fa fa-shopping-cart"></i> Магазин</a></li>
            <li><a href="javascript:ChangeOption('news');" class="tip" title="Настройки вывода новостей"><i class="fa fa-file-text-o"></i> Новости</a></li>
            <li><a href="javascript:ChangeOption('comments');" class="tip" title="Настройка комментариев"><i class="fa fa-commenting-o"></i> Комментарии</a></li>
            <li><a href="javascript:ChangeOption('optimisation');" class="tip" title="Оптимизация запросов к базе данных"><i class="fa fa-bar-chart"></i> Оптимизация</a></li>
            <li><a href="javascript:ChangeOption('mail');" class="tip" title="Настройки E-Mail"><i class="fa fa-envelope-o"></i> Почта</a></li>
            <li><a href="javascript:ChangeOption('users');" class="tip" title="Настройки для пользователей"><i class="fa fa-user-circle-o"></i> Посетители</a></li>
        </ul>
    </div>
</div>
<!-- /toolbar --><form action="/dashboard/options/save" method="post" class="systemsettings">
<div id="general" class="panel panel-flat">
  <div class="panel-body">
    Общие настройки  </div>
  <div class="table-responsive">
  <table class="table table-striped"><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Название сайта:</h6><span class="text-muted text-size-small hidden-xs">например: "Моя домашняя страница"</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" name="save_con[server_name]" value="{{ $info['APP_NAME'] }}"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Домашняя страница сайта:</h6><span class="text-muted text-size-small hidden-xs">Укажите имя основного домена на котором располагается ваш сайт. Например: http://yoursite.com/ Внимание, наличие слеша на конце в имени домена обязательно.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" name="save_con[server_url]" value="https://legion.wowlegions.ru/"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Домашняя страница сайта:</h6><span class="text-muted text-size-small hidden-xs">Укажите имя основного домена на котором располагается ваш сайт. Например: http://yoursite.com/ Внимание, наличие слеша на конце в имени домена обязательно.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" name="save_con[download_url]" value="https://legion.wowlegions.ru/"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Используемая кодировка на сайте:</h6><span class="text-muted text-size-small hidden-xs">Укажите кодировку, которую использует ваш сайт</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" name="save_con[server_charset]" value="utf-8"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Описание (Description) сайта:</h6><span class="text-muted text-size-small hidden-xs">Краткое описание, не более 200 символов</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" name="save_con[server_desc]" value="Demo page engine WoWLegions"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Ключевые слова (Keywords) для сайта:</h6><span class="text-muted text-size-small hidden-xs">Введите через запятую основные ключевые слова для вашего сайта</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><textarea class="classic" style="width:100%;height:100px;" name="save_con[server_keywords]">WoWLegions, wow, CMS, PHP engine</textarea></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Используемый язык:</h6><span class="text-muted text-size-small hidden-xs">Выберите язык, который будет использоваться при работе с системой</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[default_lang]">
<option value="Espanol">Espanol</option>
<option value="Francais">Francais</option>
<option value="English">English</option>
<option value="China">China</option>
<option value="Russian" selected >Russian</option>
<option value="Deutsch">Deutsch</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Шаблон сайта по умолчанию:</h6><span class="text-muted text-size-small hidden-xs">Выберите шаблон, который будет использоваться на сайте</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[template]">
<option value="Legion">Legion</option>
<option value="Default" selected >Default</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Версия сервера</h6><span class="text-muted text-size-small hidden-xs">Выберите версию сервера</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[game_core]">
<option value="0">Vanilla</option>
<option value="1">Burning Crusade</option>
<option value="2">Wrath of Lich King</option>
<option value="3">Cataclysm</option>
<option value="4">Mists of Pandaria</option>
<option value="5">Warlords of Draenor</option>
<option value="6" selected >Legion</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">MultiCore</h6><span class="text-muted text-size-small hidden-xs">Разрешить использывать более 1 игрового аккаунта игроку ( Доступтно только с Дренора )</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[multi_core]" value="1" checked></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Выключить сайт:</h6><span class="text-muted text-size-small hidden-xs">Перевести сайт в состояние offline, для проведения технических работ</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[site_offline]" value="1" checked></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Причина отключения сайта:</h6><span class="text-muted text-size-small hidden-xs">Сообщение для отображения в режиме отключенного сайта</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><textarea class="classic" style="width:100%;height:150px;" name="save_con[offline_reason]">Сайт находится на текущей реконструкции, после завершения всех работ сайт будет открыт.

Приносим вам свои извинения за доставленные неудобства.</textarea></td>
        </tr></table></div></div><div id="shop" class="panel panel-flat" style='display:none'>
    <div class="panel-body">
        Настройки магазина    </div>
    <div class="table-responsive">
    <table class="table table-striped"><tr>
                <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">PayPal E-mail</h6><span class="text-muted text-size-small hidden-xs">Укажите ваш емайл на PayPal</span></td>
                <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" style="max-width:150px; text-align: center;"  name="save_con[paypal_email]" value="eurostar33rus@gmail.com"></td>
                </tr><tr>
                <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Валюта сервера</h6><span class="text-muted text-size-small hidden-xs">Укажите валюту сервера, Доллары, Рубли, Евро</span></td>
                <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[currency_code]">
<option value="RUB">Рубли</option>
<option value="USD" selected >Доллары</option>
<option value="EUR">Евро</option>
</select></td>
                </tr><tr>
                <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Soap Host</h6><span class="text-muted text-size-small hidden-xs">Обычно — localhost</span></td>
                <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" style="max-width:150px; text-align: center;"  name="save_con[soap_host]" value=""></td>
                </tr><tr>
                <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Soap Port</h6><span class="text-muted text-size-small hidden-xs">Обычно — 7878</span></td>
                <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" style="max-width:150px; text-align: center;"  name="save_con[soap_port]" value=""></td>
                </tr><tr>
                <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Soap User</h6><span class="text-muted text-size-small hidden-xs">Логин для аккаунта с 4 уровнем доступа (консольным)</span></td>
                <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" class="form-control" style="max-width:150px; text-align: center;" name="save_con[soap_user]" value=""></td>
                </tr><tr>
                <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Soap Pass</h6><span class="text-muted text-size-small hidden-xs">Пароль для аккаунта с 4 уровнем доступа (консольным)</span></td>
                <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" class="form-control" style="max-width:150px; text-align: center;" name="save_con[soap_pass]" value=""></td>
                </tr></table></div></div><div id="news" class="panel panel-flat" style='display:none'>
  <div class="panel-body">
    Настройки вывода новостей  </div>
  <div class="table-responsive">
  <table class="table table-striped"><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Количество новостей на страницу</h6><span class="text-muted text-size-small hidden-xs">Количество кратких новостей, которое будет выводиться на страницу</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" style="max-width:150px; text-align: center;"  name="save_con[news_number]" value="10"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Количество статей на страницу в результатах поиска</h6><span class="text-muted text-size-small hidden-xs">Количество найденных статей при поиске, которое будет выводиться на одну страницу в результатах поиска.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" style="max-width:150px; text-align: center;"  name="save_con[search_number]" value="10"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Количество страниц в результатах поиска</h6><span class="text-muted text-size-small hidden-xs">Укажите максимальное количество страниц, которое будет показано в результатах поиска. Для снятия ограничений, вы можете указать 0, в таком случае будет показаны все найденные результаты. Ограничение на количество отображаемых страниц может снизить нагрузку на ваш сервер</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" style="max-width:150px; text-align: center;"  name="save_con[search_pages]" value="5"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Количество похожих новостей</h6><span class="text-muted text-size-small hidden-xs">Введите количество похожих новостей, которые будут выводится при просмотре полных новостей</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input type="text" class="form-control" style="max-width:150px; text-align: center;"  name="save_con[related_number]" value="5"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Формат времени для новостей:</h6><span class="text-muted text-size-small hidden-xs"><a onclick="javascript:Help('date'); return false;" href="#">помощь по работе функции</a></span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" class="form-control" style="max-width:150px; text-align: center;" name="save_con[timestamp_active]" value="j-m-Y, H:i"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Порядок сортировки новостей</h6><span class="text-muted text-size-small hidden-xs">Выберите порядок сортировки новостей</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[news_msort]">
<option value="DESC" selected >По убыванию</option>
<option value="ASC">По возрастанию</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Автоматическое формирование метатегов 'description' и 'keywords' для публикаций</h6><span class="text-muted text-size-small hidden-xs">Вы можете включить автоматическое заполнение метатегов 'description' и 'keywords' для публикаций. Если при добавлении публикаций на сайт данные поля не были заполнены, то скрипт автоматически создаст их.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[create_metatags]" value="1" checked></td>
        </tr></table></div></div><div id="comments" class="panel panel-flat" style='display:none'>
  <div class="panel-body">
    Настройки комментариев  </div>
  <div class="table-responsive">
  <table class="table table-striped"><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Разрешить комментировать новости</h6><span class="text-muted text-size-small hidden-xs">Включение или отключение комментариев для всех новостей</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[allow_comments]" value="1" checked></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Минимальное количество символов в комментариях</h6><span class="text-muted text-size-small hidden-xs">Укажите минимальное количество символов, которое должно присутствовать в комментарии для того чтобы комментарий мог быть добавлен на сайт. Если вы не хотите вводить ограничение на минимальное количество символов, установите 0.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" class="form-control" style="max-width:150px; text-align: center;"  name='save_con[comments_minlen]' value="10"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Максимальное количество символов в комментариях</h6><span class="text-muted text-size-small hidden-xs">Укажите максимальное количество символов, которое может использовать пользователь при написании комментариев на сайте</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" class="form-control" style="max-width:150px; text-align: center;"  name='save_con[comments_maxlen]' value="3000"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Порядок сортировки комментариев</h6><span class="text-muted text-size-small hidden-xs">Выберите порядок сортировки комментариев</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[comm_msort]">
<option value="DESC">По убыванию</option>
<option value="ASC" selected >По возрастанию</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Защита от флуда:</h6><span class="text-muted text-size-small hidden-xs">указывается в секундах; 0 = защиты нет</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" class="form-control" style="max-width:150px; text-align: center;"  name='save_con[flood_time]' value="30"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Формат времени для комментариев:</h6><span class="text-muted text-size-small hidden-xs"><a onClick="javascript:Help('date')" href="#">помощь по работе функции</a></span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" class="form-control" style="max-width:150px; text-align: center;" name='save_con[timestamp_comment]' value="j F Y H:i"></td>
        </tr></table></div></div><div id="optimisation" class="panel panel-flat" style='display:none'>
  <div class="panel-body">
     Оптимизация запросов к базе данных  </div>
  <div class="table-responsive">
  <table class="table table-striped"><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Включить кеширование на сайте</h6><span class="text-muted text-size-small hidden-xs">Кеширование существенно сокращает нагрузку на сервер, сводя количество запросов к минимуму</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[allow_cache]" value="1" ></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Включить кеширование комментариев на сайте</h6><span class="text-muted text-size-small hidden-xs">Данная опция позволяет включить на сайте кеширование комментариев при показе полной новости, что позволяет снизить нагрузку на сайт. Кеширование комментариев работает только при совместном включении общего кеширования на сайте. Если вы используете на страницах комментариев вывод статуса <b>online</b> пользователей, то включение кеширования может показывать частично устаревшую информацию в данном статусе.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[allow_comments_cache]" value="1" checked></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Включить Gzip сжатие HTML страниц:</h6><span class="text-muted text-size-small hidden-xs">Данная опция позволяет существенно сжать выход сгенерированного кода, и тем самым сэкономить на траффике</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[allow_gzip]" value="1" ></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Включить Gzip сжатие JS и CSS файлов</h6><span class="text-muted text-size-small hidden-xs">Eсли 'Включено', то JavaScript и CSS файлы будут сжаты при помощи Gzip, это позволит уменьшить вес файлов до 70%, а также в 6 раз снизить количество HTTP запросов, что существенно ускоряет время загрузки ваших страниц.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[js_min]" value="1" ></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Включить поддержку авторизации на сайте:</h6><span class="text-muted text-size-small hidden-xs">Отключение поддержи авторизации на сайте позволяет сэкономить два запроса к базе данных. При этом все посетители для скрипта становятся гостями, любые попытки авторизоваться игнорируются. Также автоматически отключается и регистрация новых пользователей на сайте.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[allow_registration]" value="1" checked></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Отображение похожих новостей</h6><span class="text-muted text-size-small hidden-xs">Данный модуль производит контекстовый поиск похожих новостей, при просмотре полной новости. Отключение данного модуля позволит снизить нагрузку на MySQL сервер</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[related_news]" value="1" checked></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Включить голосования на сайте</h6><span class="text-muted text-size-small hidden-xs">Включение или отключения модуля общего голосования на сайте</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[allow_votes]" value="1" checked></td>
        </tr></table></div></div><div id="mail" class="panel panel-flat" style='display:none'>
  <div class="panel-body">
    Настройки E-Mail  </div>
  <div class="table-responsive">
  <table class="table table-striped"><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Системный E-Mail адрес администратора:</h6><span class="text-muted text-size-small hidden-xs">Введите E-Mail адрес администратора сайта. От имени данного адреса будут отправляться служебные сообщения скрипта, например уведомления пользователей о новом персональном сообщении и т.д. А также на этот адрес будут отправляться системные уведомления для администрации сайта, например, уведомления о новых комментариях и т.д.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" name='save_con[admin_mail]' value='fanaticus3@gmail.com' class="form-control" style="width:100%;max-width:250px"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Заголовок отправителя писем, при отправке писем</h6><span class="text-muted text-size-small hidden-xs">При отправке писем с сайта вы можете указать заголовок, который будет добавляться к почте отправителя. Например, вы можете там указать краткое название вашего сайта</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" name='save_con[mail_title]' value="" class="form-control" style="width:100%;max-width:250px"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Метод отправки почты</h6><span class="text-muted text-size-small hidden-xs">Если функция PHP mail() недоступна, выберите метод SMTP</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[mail_metod]">
<option value="php" selected >PHP Mail()</option>
<option value="smtp">SMTP</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">SMTP хост</h6><span class="text-muted text-size-small hidden-xs">Обычно — localhost</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" name='save_con[smtp_host]' value="localhost" class="form-control" style="width:100%;max-width:250px"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">SMTP Порт</h6><span class="text-muted text-size-small hidden-xs">Обычно — 25</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" name='save_con[smtp_port]' class="form-control" style="max-width:150px; text-align: center;" value="25"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">SMTP Имя пользователя</h6><span class="text-muted text-size-small hidden-xs">Не требуется в большинстве случаев, когда используется 'localhost'</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" name='save_con[smtp_user]' value="" class="form-control" style="width:100%;max-width:250px"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">SMTP Пароль</h6><span class="text-muted text-size-small hidden-xs">Не требуется в большинстве случаев, когда используется 'localhost'</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" name='save_con[smtp_pass]' value="" class="form-control" style="width:100%;max-width:250px"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Использовать защищенный протокол для отправки писем через SMTP сервер</h6><span class="text-muted text-size-small hidden-xs">Выберите протокол шифрования при отправке писем с использованием SMTP сервера</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[smtp_secure]">
<option value="" selected >Нет</option>
<option value="ssl">SSL</option>
<option value="tls">TLS</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">E-mail для авторизации на SMTP сервере в качестве отправителя</h6><span class="text-muted text-size-small hidden-xs">Данная настройка является необязательной, однако некоторые бесплатные почтовые сервисы, например yandex.ru, требуют, чтобы в качестве E-mail адреса отправителя был указан именно адрес, зарегистрированный на их почтовом сервисе.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input  type="text" name='save_con[smtp_mail]' value="" class="form-control" style="width:100%;max-width:250px"></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Использовать поле BCC для рассылки</h6><span class="text-muted text-size-small hidden-xs">Если вы выберете 'Включено' то при рассылке сообщений в качестве получателей будет указано несколько адресатов, что позволяет сократить общее время отправки сообщений и количество отправленных сообщений.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[mail_bcc]" value="1" ></td>
        </tr></table></div></div><div id="users" class="panel panel-flat" style='display:none'>
  <div class="panel-body">
    Настройки пользователей  </div>
  <div class="table-responsive">
  <table class="table table-striped"><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Способ регистрации на сайте:</h6><span class="text-muted text-size-small hidden-xs">При включении упрощенной системы регистрации не будет отсылаться письмо с активацией аккаунта</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><select class="uniform" name="save_con[registration_type]">
<option value="0" selected >Упрощенный</option>
<option value="1">Расширенный</option>
</select></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Разрешить регистрацию нескольких пользователей с одного IP</h6><span class="text-muted text-size-small hidden-xs">При включении данной опции, будет разрешена пользователю регистрация нескольких логинов с одного IP адреса, в противном случае если IP посетителя использовался другим зарегистрированным пользователем, то регистрация будет запрещена.</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[reg_multi_ip]" value="1" checked></td>
        </tr><tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">Код безопасности</h6><span class="text-muted text-size-small hidden-xs">Отображение кода безопасности при регистрации для защиты от автоматической регистрации</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5"><input class="switch" type="checkbox" name="save_con[allow_sec_code]" value="1" checked></td>
        </tr></table></div></div>
<div style="margin-bottom:30px;">
<button type="submit" class="btn bg-teal btn-raised position-left"><i class="fa fa-floppy-o position-left"></i>Сохранить</button>
</div>
</form>
</div>
@endsection