@extends('layouts.admin')

@section('content')
<div class="content">
            <form method="post" action="{{ route('admin-forum-save') }}" class="form-horizontal" autocomplete="off">
                {{ csrf_field() }}
<div class="panel panel-default">
  <div class="panel-heading">
    Редактирование категории
  </div>
  <div class="panel-body">

		<div class="form-group">
		  <label class="control-label col-md-2 col-sm-3">Имя:</label>
		  <div class="col-md-10 col-sm-9">
			<input class="form-control width-350" value="{{ $edit->name }}" maxlength="50" type="text" name="cat_name"><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Имя вашей новой категории. Данное поле обязательно к заполнению."></i>
		  </div>
		 </div>
		<div class="form-group">
		  <label class="control-label col-md-2 col-sm-3">Иконка:</label>
		  <div class="col-md-10 col-sm-9">
			<input class="form-control width-550" value="{{ $edit->icons }}" maxlength="200" type="text" name="cat_icon"><i class="help-button visible-lg-inline-block text-primary-600 fa fa-question-circle position-right" data-rel="popover" data-trigger="hover" data-placement="right" data-content="Ссылка на иконку для данной категории, вывод настраивается в шаблонах."></i>
		  </div>
		 </div>

		<div class="form-group">
		  <label class="control-label col-md-2 col-sm-3">Описание категории:</label>
		  <div class="col-md-10 col-sm-9">
			<textarea name="fulldescr" class="classic" style="width:100%;" rows="5">{{ $edit->category_description }}</textarea>
		  </div>
		 </div>
		<div class="form-group">
		  <label class="control-label col-md-2 col-sm-3">Основная категория:</label>
		  <div class="col-md-10 col-sm-9">
			<select class="uniform" name="parentid" >
			    <option value="0"></option>
                @foreach($list as $item)
                <option style="color: black" value="{{ $item->id }}" @if($item->parent_id === $edit->id) selected @endif>{{ $item->name }}</option>
                    @foreach($item->forums as $parent)
                    <option style="color: black" value="{{ $parent->id }}" @if($parent->parent_id === $edit->id) selected @endif>&nbsp;-{{ $parent->name }}</option>
                    @endforeach
                @endforeach
            </select>
		  </div>
		 </div>
   </div>
	<div class="panel-footer">
		<button type="submit" class="btn bg-teal btn-sm btn-raised position-left"><i class="fa fa-floppy-o position-left"></i>Сохранить</button>
        <input type="hidden" name="id" value="{{ $edit->id }}" />
	</div>
</div>
</form>
@endsection