@extends('layouts.admin')

@section('content')
<div class="content">
            <div class="modal fade" id="newcats" tabindex="-1" role="dialog" aria-labelledby="newcatsLabel">
<form method="post" action="{{ route('admin-forum-add') }}" autocomplete="off" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ui-dialog-titlebar">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="ui-dialog-title" id="newcatsLabel">Добавление новой категории</span>
            </div>
            <div class="modal-body">

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label>Имя:</label>
                    <div class="input-group">
                        <input name="cat_name" type="text" class="form-control" maxlength="50" required>
                        <span class="input-group-addon"><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Имя вашей новой категории. Данное поле обязательно к заполнению." ></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label>Описание категории</label>
                    <textarea name="fulldescr" class="classic" style="width:100%;" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label>Иконка:</label>
                    <div class="input-group">
                        <input name="img" id="img" type="file" />
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>Основная категория:</label>
                    <select name='forum' class='uniform'>
                        <option value="0"></option>
                        @foreach($list as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @foreach($item->forums as $parent)
                            <option value="{{ $parent->id }}">&nbsp;-{{ $parent->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        </div>
            <div class="modal-footer" style="margin-top:-20px;">
        <button type="submit" class="btn bg-teal btn-sm btn-raised position-left"><i class="fa fa-floppy-o position-left"></i>Сохранить</button>
                <button type="button" class="btn bg-slate-600 btn-sm btn-raised" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</form>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Список категорий
    <div class="heading-elements">
        <ul class="icons-list">
            <li><a href="#" data-toggle="modal" data-target="#newcats"><i class="fa fa-plus-circle"></i> Добавить новую категорию</a></li>
        </ul>
    </div>
    </div>
    <div class="panel-body">

        <div class="dd">
            @foreach($list as $item)
            <ol class='dd-list'>
            <li class="dd-item" data-id="{{ $item->id }}"><div class="dd-handle"></div>
            <div class="dd-content"><b>ID:{{ $item->id }}</b>
            <a href="{{ route('admin-forum-edit', ['id' => $item->id]) }}" target="_blank">{{ $item->name }}</a>
            <div class="pull-right"><a href="{{ route('admin-forum-edit', ['id' => $item->id]) }}"><i title="Редактировать" alt="Редактировать" class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a onclick="javascript:cdelete('{{ $item->id }}'); return(false);" href="{{ route('admin-forum-delete', ['id' => $item->id]) }}"><i title="Удалить" alt="Удалить" class="fa fa-trash-o text-danger"></i></a></div></div>
                <ol class="dd-list">
                    @foreach($item->forums as $parent)
                        <li class="dd-item" data-id="{{ $parent->id }}"><div class="dd-handle"></div>
                        <div class="dd-content"><b>ID:{{ $parent->id }}</b>
                        <a href="{{ route('admin-forum-edit', ['id' => $parent->id]) }}" target="_blank">{{ $parent->name }}</a>
                        <div class="pull-right">
                            <a href="{{ route('admin-forum-edit', ['id' => $parent->id]) }}"><i title="Редактировать" alt="Редактировать" class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;
                            <a onclick="javascript:cdelete('{{ $parent->id }}'); return(false);" href="{{ route('admin-forum-delete', ['id' => $parent->id]) }}"><i title="Удалить" alt="Удалить" class="fa fa-trash-o text-danger"></i></a>
                        </div>
                        </div>
                        </li>
                    @endforeach
                </ol>
            </li>
            </ol>
            @endforeach
        </div>
    </div>
    <div class="panel-footer">
        <button id="catsort" class="btn bg-primary-600 btn-sm btn-raised position-left">Сохранить порядок сортировки и порядок вложенности категорий</button><button class="btn bg-primary-600 btn-sm btn-raised position-left nestable-action" data-action="expand-all">Развернуть все</button><button class="btn bg-primary-600 btn-sm btn-raised nestable-action" data-action="collapse-all">Свернуть все</button>
    </div>
</div>
<script>
    jQuery(function($){

        $('.dd').nestable({
            maxDepth: 500
        });

        $('.dd').nestable('collapseAll');

        $('.dd-handle a').on('mousedown', function(e){
            e.stopPropagation();
        });

        $('.dd-handle a').on('touchstart', function(e){
            e.stopPropagation();
        });

        $('.nestable-action').on('click', function(e)
        {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('#catsort').click(function(){
            ShowLoading('');
            $.post('/admin/forum/sort&list='+window.JSON.stringify($('.dd').nestable('serialize')), function(data){
                HideLoading('');
                if (data == 'ok') {
                    DLEalert('Sorting has been successfully saved.', 'Information');
                } else {
                    DLEalert('Sorting failed.', 'Information');
                }
            });
        });
    });

    function cdelete(id){

        DLEconfirm( 'Are you sure you want to delete the selected forum? This action cannot be undone.', 'Confirmation', function () {
            document.location='/admin/forum/delete/' + id + '';
        } );
    }
</script>
@endsection