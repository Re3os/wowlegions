@extends('layouts.admin')

@section('content')
<div class="content">

<script type="text/javascript">
  function ShowOrHideEx(id, show) {
    var item = null;

    if (document.getElementById) {
      item = document.getElementById(id);
    } else if (document.all) {
      item = document.all[id];
    } else if (document.layers){
      item = document.layers[id];
    }
    if (item && item.style) {
      item.style.display = show ? "" : "none";
    }
  }

  function onCategoryChange(obj) {

    var value = $(obj).val();

    if ($.isArray(value)) {
    } else {
    }

  }
</script>
    <script type="text/javascript">
    function preview(){if(document.addnews.title.value == ''){ Growl.error({
                title: 'Информация',
                text: 'Заголовок является обязательным при написании статьи'
            }); return false; }
    else{
        dd=window.open('','prv','height=400,width=750,left=0,top=0,resizable=1,scrollbars=1')
        document.addnews.mod.value='preview';document.addnews.target='prv'
        document.addnews.submit();dd.focus()
        setTimeout("document.addnews.mod.value='editnews';document.addnews.target='_self'",500)
    }
    }
    function sendNotice( id ){
        var b = {};

        b[dle_act_lang[3]] = function() {
            $(this).dialog('close');
        };

        b['Отправить'] = function() {
            if ( $('#dle-promt-text').val().length < 1) {
                $('#dle-promt-text').addClass('ui-state-error');
            } else {
                var response = $('#dle-promt-text').val()
                $(this).dialog('close');
                $('#dlepopup').remove();
                $.post('engine/ajax/message.php', { id: id,  text: response, user_hash: '6acc39500426d77e6a32d576b88fa77bd717de3d', allowdelete: "no" },
                    function(data){
                        if (data == 'ok') { DLEalert('Уведомление успешно отправлено', 'Информация'); }
                    });

            }
        };

        $('#dlepopup').remove();

        $('body').append("<div id='dlepopup' class='dle-promt' title='Уведомление' style='display:none'>Введите текст уведомления автору статьи, которое он получит персональным сообщением:<br /><br /><textarea name='dle-promt-text' id='dle-promt-text' class='classic' style='width:100%;height:100px; padding: .4em;'></textarea></div>");

        $('#dlepopup').dialog({
            autoOpen: true,
            width: 500,
            resizable: false,
            buttons: b
        });

    }

    function confirmDelete(url, id){

        var b = {};

        b[dle_act_lang[1]] = function() {
                        $(this).dialog("close");
                    };

        b['Да, и отправить уведомление'] = function() {
                        $(this).dialog("close");

                        var bt = {};

                        bt[dle_act_lang[3]] = function() {
                                        $(this).dialog('close');
                                    };

                        bt['Отправить'] = function() {
                                        if ( $('#dle-promt-text').val().length < 1) {
                                             $('#dle-promt-text').addClass('ui-state-error');
                                        } else {
                                            var response = $('#dle-promt-text').val()
                                            $(this).dialog('close');
                                            $('#dlepopup').remove();
                                            $.post('engine/ajax/message.php', { id: id,  text: response, user_hash: '6acc39500426d77e6a32d576b88fa77bd717de3d' },
                                              function(data){
                                                if (data == 'ok') { document.location=url; } else { DLEalert('Уведомление не было отправлено', 'Информация'); }
                                          });

                                        }
                                    };

                        $('#dlepopup').remove();

                        $('body').append("<div id='dlepopup' title='Уведомление' class='dle-promt' style='display:none'>Введите текст уведомления автору статьи, которое он получит персональным сообщением:<br /><br /><textarea name='dle-promt-text' id='dle-promt-text' class='classic' style='width:100%;height:100px;'></textarea></div>");

                        $('#dlepopup').dialog({
                            autoOpen: true,
                            width: 500,
                            resizable: false,
                            buttons: bt
                        });

                    };

        b[dle_act_lang[0]] = function() {
                        $(this).dialog("close");
                        document.location=url;
                    };

        $("#dlepopup").remove();

        $("body").append("<div id='dlepopup' title='Подтверждение' class='dle-promt' style='display:none'><div id='dlepopupmessage'>Вы действительно хотите удалить эту статью?</div></div>");

        $('#dlepopup').dialog({
            autoOpen: true,
            width: 500,
            resizable: false,
            buttons: b
        });


    }

    function auto_keywords ( key )
    {
        var wysiwyg = '1';

        if (wysiwyg == "2") {
            tinyMCE.triggerSave();
        }

        var short_txt = document.getElementById('short_story').value;
        var full_txt = document.getElementById('full_story').value;

        ShowLoading('');

        $.post("engine/ajax/keywords.php", { short_txt: short_txt, full_txt: full_txt, key: key, user_hash: '6acc39500426d77e6a32d576b88fa77bd717de3d' }, function(data){

            HideLoading('');

            if (key == 1) { $('#autodescr').val(data); }
            else { $('#keywords').tokenfield('setTokens', data);}

        });

        return false;
    }

    function find_relates ()
    {
        var title = document.getElementById('title').value;

        ShowLoading('');

        $.post('engine/ajax/find_relates.php', { title: title, id: '1', user_hash: '6acc39500426d77e6a32d576b88fa77bd717de3d' }, function(data){

            HideLoading('');

            $('#related_news').html(data);

        });

        return false;

    };

    function xfimagedelete( xfname, xfvalue )
    {

        DLEconfirm( 'Вы действительно хотите удалить изображение?', 'Информация', function () {

            ShowLoading('');

            $.post('engine/ajax/upload.php', { subaction: 'deluploads', user_hash: '6acc39500426d77e6a32d576b88fa77bd717de3d', news_id: '1', author: 'TheRock', 'images[]' : xfvalue }, function(data){

                HideLoading('');

                $('#uploadedfile_'+xfname).html('');
                $('#xf_'+xfname).val('');
                $('#xfupload_' + xfname + ' .qq-upload-button, #xfupload_' + xfname + ' .qq-upload-button input').removeAttr('disabled');
            });

        } );

        return false;

    };

    function xffiledelete( xfname, xfvalue )
    {

        DLEconfirm( 'Вы действительно хотите удалить данный файл?', 'Информация', function () {

            ShowLoading('');

            $.post('engine/ajax/upload.php', { subaction: 'deluploads', user_hash: '6acc39500426d77e6a32d576b88fa77bd717de3d', news_id: '1', author: 'TheRock', 'files[]' : xfvalue }, function(data){

                HideLoading('');

                $('#uploadedfile_'+xfname).html('');
                $('#xf_'+xfname).val('');
                $('#xf_'+xfname).hide('');
                $('#xfupload_' + xfname + ' .qq-upload-button, #xfupload_' + xfname + ' .qq-upload-button input').removeAttr('disabled');
            });

        } );

        return false;

    };

    function checkxf ( )
    {
        var wysiwyg = '1';
        var status = '';

        if (wysiwyg == "2") {
            tinyMCE.triggerSave();
        }

        if(document.addnews.title.value == ''){

            Growl.error({
                title: 'Информация',
                text: 'Заголовок является обязательным при написании статьи'
            });

            status = 'fail';

        }

        return status;

    };

    </script><div class="panel panel-default">

            <div class="panel-heading">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="active"><a href="#tabhome" data-toggle="tab"><i class="fa fa-home position-left"></i> Новость</a></li>
                    <li><a href="#tabvote" data-toggle="tab"><i class="fa fa-bar-chart position-left"></i> Опрос</a></li>
                    <li><a href="#tabextra" data-toggle="tab"><i class="fa fa-tasks position-left"></i> Дополнительно</a></li>
                </ul>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a href="#" class="panel-fullscreen"><i class="fa fa-expand"></i></a></li>
                    </ul>
                </div>
            </div>

            <form method="post" class="form-horizontal" name="addnews" id="addnews" onsubmit="if(checkxf()=='fail') return false;" action="{{ route('admin-news-save') }}">
                {{ csrf_field() }}
                 <div class="panel-tab-content tab-content">
                     <div class="tab-pane active" id="tabhome">
                        <div class="panel-body">

                            <div class="form-group">
                              <label class="control-label col-sm-2">Информация:</label>
                              <div class="col-sm-10">
                                <span class="position-left">ID=<b>{{ $blog->id }}</b></span>
                              </div>
                             </div>

                            <div class="form-group">
                              <label class="control-label col-sm-2">Заголовок:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control width-550 position-left" name="title" id="title" value="{{ $blog->title }}" maxlength="250">
                              </div>
                             </div>

                             <div class="form-group editor-group">
                              <label class="control-label col-md-2">Краткое описание:</label>
                              <div class="col-md-10">
    <div class="editor-panel">
        <textarea id="short_story" name="short_story" class="wysiwygeditor" style="width:98%;height:300px;">{{ $blog->desc_blog }}</textarea>
        </div>
        </div>
                            </div>

                             <div class="form-group editor-group">
                              <label class="control-label col-md-2">Полное описание:</label>
                              <div class="col-md-10"><div class="editor-panel"><textarea id="full_story" name="full_story" class="wysiwygeditor" style="width:98%;height:300px;">{{ $blog->full_blog }}</textarea></div>							  </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2">Опции новости:</label>
                              <div class="col-md-10">
                                  <div class="row">
                                    <div class="col-sm-6" style="max-width:300px;"><div class="checkbox"><label><input class="icheck" type="checkbox" id="approve" name="approve" value="1" checked>Опубликовать новость на сайте</label></div></div>
                                    <div class="col-sm-6"><div class="checkbox"><label><input class="icheck" type="checkbox" id="allow_comm" name="allow_comm" value="1" checked>Разрешить комментарии</label></div></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6"><div class="checkbox"><label><input class="icheck" type="checkbox" id="news_fixed" name="news_fixed" value="1" >Зафиксировать новость</label></div></div>
                                  </div>
                              </div>
                             </div>


                        </div>
                    </div>
                    <div class="tab-pane" id="tabvote" >
                        <div class="panel-body">

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Заголовок Опроса</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="vote_title" class="form-control width-400" maxlength="200" value=""><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Укажите заголовок вашего опроса." ></i>
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Вопрос</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="frage" class="form-control width-400" maxlength="200" value=""><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Укажите вопрос вашего голосования." ></i>
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Варианты ответов<div class="text-muted text-size-small">Каждая новая строка является новым вариантом ответа</div></label>
                              <div class="col-md-10 col-sm-9">
                                <textarea rows="7" class="classic width-400" name="vote_body"></textarea>
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3"></label>
                              <div class="col-md-10 col-sm-9">
                                <div class="checkbox"><label><input class="icheck" type="checkbox" id="allow_m_vote" name="allow_m_vote" value="1" >Разрешить выбор нескольких вариантов</label></div>
                                <br />
                              </div>
                             </div>

                            <div class="form-group">
                                <div class="col-md-12"><span class="text-muted text-size-small"> <i class="fa fa-exclamation-triangle position-left"></i>Добавление опроса к новости является необязательным параметром, поэтому если вы не хотите добавлять опрос к данной новости, то просто оставьте все поля пустыми.</span></div>
                            </div>


                        </div>
                     </div>
                    <div class="tab-pane" id="tabextra" >
                        <div class="panel-body">

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Символьный код:</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="catalog_url" class="form-control" maxlength="3" style="width:55px;" value=""><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Символьный код предназначен для объединения группы новостей в каталоги, например, если задать группе новостей один символьный код 'a', то эта группа новостей будет доступна по адресу: http:/site.ru/catalog/a/. Допускается максимально использовать только три символа" ></i>
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">ЧПУ URL статьи:</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="alt_name" class="form-control width-500" maxlength="190" value="post1"><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="ЧПУ URL статьи ссылка для просмотра статьи в браузере. Необязательный параметр. Допустимы только латинские символы." ></i>
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Ключевые слова для облака тегов:</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="tags" id="tags" autocomplete="off" value="по, новости" />
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Срок действия до:</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="expires" data-rel="calendardate" class="form-control" style="width:200px;" value=""><span class="position-right position-left">Действие:</span><select class="uniform" name="expires_action" id="expires_action" onchange="moveCategoryChange(this)"><option value="0">Выберите действие</option><option value="1" >Удалить</option><option value="2" >Отправить на модерацию</option><option value="3" >Снять публикацию на главной</option><option value="4" >Снять фиксацию</option><option value="5" >Переместить в другую категорию</option></select><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Ваша новость будет автоматически удалена или отправлена на модерацию, при наступлении указанного времени. Оставьте данное поле пустым, если хотите чтобы новость имела неограниченный срок действия." ></i>
                              </div>
                             </div>
                             <div class="form-group" id="movecatlist" style="display:none;">
                              <label class="control-label col-sm-2">Переместить в категорию:</label>
                              <div class="col-sm-10">
                                <select data-placeholder="Выберите категорию ..." title="Выберите категорию ..." name="movecat[]" class="categoryselect" multiple style="width:100%;max-width:350px;"><option value="0"></option><option value="1" >О скрипте</option><option value="2" >В мире</option><option value="3" >Экономика</option><option value="4" >Религия</option><option value="5" >Криминал</option><option value="6" >Спорт</option><option value="7" >Культура</option><option value="8" >Инопресса</option></select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3"></label>
                              <div class="col-md-10 col-sm-9">
                                <div class="checkbox"><label><input class="icheck" type="checkbox" id="need_pass" name="need_pass" onchange="onPassChange(this)" value="1" >Назначить пароль для просмотра публикации</label></div>
                              </div>
                             </div>
                            <div class="form-group" id="passlist" style="display:none;">
                              <label class="control-label col-md-2 col-sm-3">Список паролей<div class="text-muted text-size-small">Каждая новая строка является новым паролем</div></label>
                              <div class="col-md-10 col-sm-9">
                                <textarea rows="5" class="classic width-500" name="password"></textarea>
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3"></label>
                              <div class="col-md-10 col-sm-9">
                                <span class="text-muted text-size-small">Ручное добавление метатегов для статьи</span><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Метатеги для данной статьи могут быть добавлены вручную либо сгенерированы автоматически. Оставьте поля пустыми и метатеги будут сформированы автоматически." ></i>
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Метатег Title:</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="meta_title" class="form-control width-500" maxlength="140" value="">
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Метатег Description:</label>
                              <div class="col-md-10 col-sm-9">
                                <input type="text" name="descr" id="autodescr" class="form-control width-500" maxlength="200" value="">
                              </div>
                             </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3">Метатег Keywords:</label>
                              <div class="col-md-10 col-sm-9">
                                <textarea class="tags" name="keywords" id='keywords'></textarea><br /><br />
                                    <button onclick="auto_keywords(1); return false;" class="btn bg-primary-600 btn-sm btn-raised position-left"><i class="fa fa-exchange position-left"></i>Сгенерировать описание</button>
                                    <button onclick="auto_keywords(2); return false;" class="btn bg-primary-600 btn-sm btn-raised"><i class="fa fa-exchange position-left"></i>Сгенерировать ключевые слова</button>
                              </div>
                             </div>

                        </div>
                     </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn bg-teal btn-sm btn-raised position-left"><i class="fa fa-floppy-o position-left"></i>Сохранить</button>
                    <button onclick="confirmDelete('{{ route('admin-news-delete', ['id' => $blog->id]) }}', '{{ $blog->id }}'); return false;" class="btn bg-danger btn-sm btn-raised"><i class="fa fa-trash-o position-left"></i>Удалить</button>
                    <input type="hidden" name="id" value="1" />
                    <input type="hidden" name="expires_alt" value="" />
                    <input type="hidden" name="action" value="doeditnews" />
                    <input type="hidden" name="mod" value="editnews" />
                </div>
</form>
</div>
@endsection