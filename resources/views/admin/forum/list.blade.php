@extends('layouts.admin')

@section('content')
<div class="content">
            <div class="modal fade" id="newcats" tabindex="-1" role="dialog" aria-labelledby="newcatsLabel">
<form method="post" action="/dashboard/forum/new" autocomplete="off">
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
                    <label>Описание категории (текст который можно вывести на страницах сайта, допускаются BB теги и HTML)</label>
                    <textarea name="fulldescr" class="classic" style="width:100%;" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label>Иконка:</label>
                    <div class="input-group">
                        <input name="cat_icon" type="text" class="form-control" maxlength="200">
                        <span class="input-group-addon"><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Ссылка на иконку для данной категории, вывод настраивается в шаблонах." ></i></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label>Основная категория:</label>
                    <select name='forum' class='uniform'><option value="0"></option><option value="1">Support</option>
<option value="6">&nbsp;-Customer Support</option>
<option value="7">&nbsp;-Technical Support</option>
<option value="8">&nbsp;-Translation and localization</option>
<option value="2">Community</option>
<option value="9">&nbsp;-Role-Playing</option>
<option value="10">&nbsp;-Common themes</option>
<option value="11">&nbsp;-Search for players</option>
<option value="12">&nbsp;-Life of community</option>
<option value="3">Gameplay</option>
<option value="13">&nbsp;-New/Returning Player Questions &amp; Guides</option>
<option value="14">&nbsp;-Dungeons &amp; Raids</option>
<option value="15">&nbsp;-Quests &amp; Achievements</option>
<option value="16">&nbsp;-Pet Battles</option>
<option value="17">&nbsp;-Professions</option>
<option value="19">&nbsp;-Interface and Macros</option>
<option value="18">&nbsp;-Transmogrification</option>
<option value="4">PvP</option>
<option value="20">&nbsp;-Arenas</option>
<option value="21">&nbsp;-Battlegrounds</option>
<option value="5">Classes</option>
<option value="22">&nbsp;-Demon Hunter</option>
<option value="23">&nbsp;-Warrior</option>
<option value="24">&nbsp;-Druid</option>
<option value="25">&nbsp;-Priest</option>
<option value="26">&nbsp;-Mage</option>
<option value="27">&nbsp;-Monk</option>
<option value="28">&nbsp;-Hunter</option>
<option value="29">&nbsp;-Paladin</option>
<option value="30">&nbsp;-Rogue</option>
<option value="31">&nbsp;-Death Knight</option>
<option value="33">&nbsp;-Shaman</option>
<option value="32">&nbsp;-Warlock</option>
</select>                </div>
            </div>
        </div>
        </div>
            <div class="modal-footer" style="margin-top:-20px;">
        <button type="submit" class="btn bg-teal btn-sm btn-raised position-left"><i class="fa fa-floppy-o position-left"></i>Сохранить</button>
                <button type="button" class="btn bg-slate-600 btn-sm btn-raised" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>
</form>

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
            <ol name='' class='dd-list'><option value="0"></option><li class="dd-item" data-id="1"><div class="dd-handle"></div>
            <div class="dd-content"><b>ID:1</b>
            <a href="/dashboard/forum/edit/1" target="_blank">Support</a>
            <div class="pull-right"><a href="/dashboard/forum/edit/1"><i title="������" alt="������" class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a onclick="javascript:cdelete('1'); return(false);" href="/dashboard/forum/remove/1"><i title="�������" alt="�������" class="fa fa-trash-o text-danger"></i></a></div></div>
            <ol class="dd-list">
            <li class="dd-item" data-id="6"><div class="dd-handle"></div>
            <div class="dd-content"><b>ID:6</b>
            <a href="/dashboard/forum/edit/6" target="_blank">Customer Support</a>
            <div class="pull-right"><a href="/dashboard/forum/edit/6"><i title="������" alt="������" class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a onclick="javascript:cdelete('6'); return(false);" href="/dashboard/forum/remove/6"><i title="�������" alt="�������" class="fa fa-trash-o text-danger"></i></a></div></div>
            </li><li class="dd-item" data-id="7"><div class="dd-handle"></div>
            <div class="dd-content"><b>ID:7</b>
            <a href="/dashboard/forum/edit/7" target="_blank">Technical Support</a>
            <div class="pull-right"><a href="/dashboard/forum/edit/7"><i title="������" alt="������" class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a onclick="javascript:cdelete('7'); return(false);" href="/dashboard/forum/remove/7"><i title="�������" alt="�������" class="fa fa-trash-o text-danger"></i></a></div></div>
            </li><li class="dd-item" data-id="8"><div class="dd-handle"></div>
            <div class="dd-content"><b>ID:8</b>
            <a href="/dashboard/forum/edit/8" target="_blank">Translation and localization</a>
            <div class="pull-right"><a href="/dashboard/forum/edit/8"><i title="������" alt="������" class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;<a onclick="javascript:cdelete('8'); return(false);" href="/dashboard/forum/remove/8"><i title="�������" alt="�������" class="fa fa-trash-o text-danger"></i></a></div></div>
            </li></ol>
            </li></ol>
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
            $.post('/dashboard/forum/sort&list='+window.JSON.stringify($('.dd').nestable('serialize')), function(data){
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
            document.location='/dashboard/forum/remove&id=' + id + '';
        } );
    }
</script>
@endsection