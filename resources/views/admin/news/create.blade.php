@extends('layouts.admin')

@section('content')
<div class="content">
<link href="/skins/editor/jscripts/froala/css/editor.css?v=22" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/skins/codemirror/js/code.js?v=22"></script>
<script type="text/javascript" src="/skins/editor/jscripts/froala/editor.js?v=22"></script>
<script type="text/javascript" src="/skins/editor/jscripts/froala/languages/en.js?v=22"></script>
<script type="text/javascript" src="/skins/uploads/fileuploader.js?v=22"></script>

<!-- maincontent beginn -->
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
function auto_keywords ( key )
{

var wysiwyg = '1';

if (wysiwyg == "2") {
tinyMCE.triggerSave();
}

var short_txt = document.getElementById('short_story').value;
var full_txt = document.getElementById('full_story').value;

ShowLoading('');

$.post("engine/ajax/keywords.php", { short_txt: short_txt, full_txt: full_txt, key: key }, function(data){

HideLoading('');

if (key == 1) { $('#autodescr').val(data); }
else { $('#keywords').tokenfield('setTokens', data); }

});

return false;
}

function find_relates ( )
{
var title = document.getElementById('title').value;

ShowLoading('');

$.post('engine/ajax/find_relates.php', { title: title }, function(data){

HideLoading('');

$('#related_news').html(data);

});

return false;

};


function xfimagedelete( xfname, xfvalue )
{

DLEconfirm( 'Вы действительно хотите удалить изображение?', 'Информация', function () {

ShowLoading('');

$.post('engine/ajax/upload.php', { subaction: 'deluploads', news_id: '', author: '', 'images[]' : xfvalue }, function(data){

    HideLoading('');

    $('#uploadedfile_'+xfname).html('');
    $('#xf_'+xfname).val('');
    $('#xfupload_' + xfname + ' .qq-upload-button, #xfupload_' + xfname + ' .qq-upload-button input').removeAttr('disabled');
});

} );

return false;

};

function checkxf ( )
{

var status = '';



$('[uid="essential"]:visible').each(function(indx) {

if($.trim($(this).find('[rel="essential"]').val()).length < 1) {
    Growl.error({
        title: 'Информация',
        text: 'Не заполнены необходимые дополнительные поля'
    });
    status = 'fail';

}

});

if(document.addnews.title.value == ''){

Growl.error({
    title: 'Информация',
    text: 'Заголовок является обязательным при написании статьи'
});

status = 'fail';

}

return status;

};


$(function(){

$('#tags').tokenfield({
autocomplete: {
source: '/ajax/find_tags',
minLength: 3,
delay: 500
},
createTokensOnBlur:true
});

$('[data-rel=links]').tokenfield({
autocomplete: {
source: '/ajax/find_tags',
minLength: 3,
delay: 500
},
createTokensOnBlur:true
});

});
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

<form method="post" name="addnews" id="addnews" onsubmit="if(checkxf()=='fail') return false;" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}
     <div class="panel-tab-content tab-content">
         <div class="tab-pane active" id="tabhome">
            <div class="panel-body">

                <div class="form-group">
                  <label class="control-label col-sm-2">Заголовок:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control width-550 position-left" name="title" id="title" maxlength="250" >
                  </div>
                </div>

                <div id="xfield_holder_images" class="form-group">
                    <label class="control-label col-sm-2">images: </label>
                    <div class="col-sm-10">
                        <input name="img" id="img" type="file" />
                    </div>
                </div>

                 <div class="form-group editor-group">
                  <label class="control-label col-md-2">Краткое описание:</label>
                  <div class="col-md-10">
<div class="editor-panel"><textarea id="short_story" name="short_story" class="wysiwygeditor" style="width:98%;height:300px;"></textarea></div>							  </div>
                </div>

                 <div class="form-group editor-group">
                  <label class="control-label col-md-2">Полное описание:</label>
                  <div class="col-md-10"><div class="editor-panel"><textarea id="full_story" name="full_story" class="wysiwygeditor" style="width:98%;height:300px;"></textarea></div>							  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Опции новости:</label>
                  <div class="col-md-10">
                      <div class="row">
                        <div class="col-sm-6" style="max-width:300px;"><div class="checkbox"><label><input class="icheck" type="checkbox" id="approve" name="approve" value="1" checked>Опубликовать новость на сайте</label></div></div>
                        <div class="col-sm-6"><div class="checkbox"><label><input class="icheck" type="checkbox" id="allow_comm" name="allow_comm" value="1" checked>Разрешить комментарии</label></div></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6"><div class="checkbox"><label><input class="icheck" type="checkbox" id="news_fixed" name="news_fixed" value="1">Зафиксировать новость</label></div></div>
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
                    <input type="text" name="vote_title" class="form-control width-400" maxlength="200"><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Укажите заголовок вашего опроса." ></i>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3">Вопрос</label>
                  <div class="col-md-10 col-sm-9">
                    <input type="text" name="frage" class="form-control width-400" maxlength="200"><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right position-left" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Укажите вопрос вашего голосования." ></i>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3">Варианты ответов<div class="text-muted text-size-small">Каждая новая строка является новым вариантом ответа</div></label>
                  <div class="col-md-10 col-sm-9">
                    <textarea rows="7" class="classic width-400" name="vote_body"></textarea>
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
                  <label class="control-label col-md-2 col-sm-3">Метатег Title:</label>
                  <div class="col-md-10 col-sm-9">
                    <input type="text" name="meta_title" class="form-control width-500" maxlength="140">
                  </div>
                 </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3">Метатег Description:</label>
                  <div class="col-md-10 col-sm-9">
                    <input type="text" name="descr" id="autodescr" class="form-control width-500" maxlength="200">
                  </div>
                 </div>
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-3">Метатег Keywords:</label>
                  <div class="col-md-10 col-sm-9">
                    <textarea class="tags" name="keywords" id="keywords"></textarea><br /><br />
                        <button onclick="auto_keywords(1); return false;" class="btn bg-primary-600 btn-sm btn-raised position-left"><i class="fa fa-exchange position-left"></i>Сгенерировать описание</button>
                        <button onclick="auto_keywords(2); return false;" class="btn bg-primary-600 btn-sm btn-raised"><i class="fa fa-exchange position-left"></i>Сгенерировать ключевые слова</button>
                  </div>
                 </div>

            </div>
         </div>
    <div class="panel-footer">
        <button type="submit" class="btn bg-teal btn-sm btn-raised position-left"><i class="fa fa-floppy-o position-left"></i>Сохранить</button>
    </div>

</form>
</div>
</div>
@endsection