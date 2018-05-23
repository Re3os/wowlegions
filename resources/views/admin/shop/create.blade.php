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

function checkxf ( )
{

var status = '';

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
        <li class="active"><a href="#tabhome" data-toggle="tab"><i class="fa fa-home position-left"></i> Магазин</a></li>
    </ul>
    <div class="heading-elements">
        <ul class="icons-list">
            <li><a href="#" class="panel-fullscreen"><i class="fa fa-expand"></i></a></li>
        </ul>
    </div>
</div>

<form method="post" onsubmit="if(checkxf()=='fail') return false;" class="form-horizontal" enctype="multipart/form-data">
    {{ csrf_field() }}
     <div class="panel-tab-content tab-content">
         <div class="tab-pane active" id="tabhome">
            <div class="panel-body">

                <div class="form-group">
                  <label class="control-label col-sm-2">Название:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control width-550 position-left" name="title" id="title" maxlength="250" >
                  </div>
                </div>

                <div id="xfield_holder_images" class="form-group">
                    <label class="control-label col-sm-2">Картинка: </label>
                    <div class="col-sm-10">
                        <input name="img" id="img" type="file" />
                    </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Цена:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control width-550 position-left" name="price" id="price" maxlength="250" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Ид с WoWHead:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control width-550 position-left" name="item_id" id="item_id" maxlength="250" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Тип:</label>
                  <div class="col-sm-10">
                    <select class="uniform" name="type">
                        <option value="2">Item</option>
                        <option value="3" selected >Mount</option>
                    </select>
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