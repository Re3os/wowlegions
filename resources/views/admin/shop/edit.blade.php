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
                text: 'Заголовок является обязательным'
            }); return false; }
    else{
        dd=window.open('','prv','height=400,width=750,left=0,top=0,resizable=1,scrollbars=1')
        document.addnews.mod.value='preview';document.addnews.target='prv'
        document.addnews.submit();dd.focus()
        setTimeout("document.addnews.mod.value='editnews';document.addnews.target='_self'",500)
    }
    }

    function confirmDelete(url, id){

        var b = {};

        b[dle_act_lang[1]] = function() {
                        $(this).dialog("close");
                    };
        b[dle_act_lang[0]] = function() {
                        $(this).dialog("close");
                        document.location=url;
                    };

        $("#dlepopup").remove();

        $("body").append("<div id='dlepopup' title='Подтверждение' class='dle-promt' style='display:none'><div id='dlepopupmessage'>Вы действительно хотите удалить ?</div></div>");

        $('#dlepopup').dialog({
            autoOpen: true,
            width: 500,
            resizable: false,
            buttons: b
        });


    }

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
                    <li class="active"><a href="#tabhome" data-toggle="tab"><i class="fa fa-home position-left"></i> Магазин</a></li>
                </ul>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a href="#" class="panel-fullscreen"><i class="fa fa-expand"></i></a></li>
                    </ul>
                </div>
            </div>

            <form method="post" class="form-horizontal" name="addnews" id="addnews" onsubmit="if(checkxf()=='fail') return false;" action="{{ route('admin-shop-save') }}">
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
                  <label class="control-label col-sm-2">Название:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control width-550 position-left" name="title" id="title" value="{{ $blog->title }}" maxlength="250" >
                  </div>
                </div>

                <div id="xfield_holder_images" class="form-group">
                    <label class="control-label col-sm-2">Картинка: </label>
                    <div class="col-sm-10">
                        <input name="img" id="img" type="file" value="{{ $blog->images }}"/>
                    </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Цена:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control width-550 position-left" name="price" id="price" value="{{ $blog->price }}" maxlength="250" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Ид с WoWHead:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control width-550 position-left" name="item_id" id="item_id" value="{{ $blog->item_id }}" maxlength="250" >
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


                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn bg-teal btn-sm btn-raised position-left"><i class="fa fa-floppy-o position-left"></i>Сохранить</button>
                    <button onclick="confirmDelete('{{ route('admin-shop-delete', ['id' => $blog->id]) }}', '{{ $blog->id }}'); return false;" class="btn bg-danger btn-sm btn-raised"><i class="fa fa-trash-o position-left"></i>Удалить</button>
                    <input type="hidden" name="id" value="{{ $blog->id }}" />
                </div>
</form>
</div>
@endsection