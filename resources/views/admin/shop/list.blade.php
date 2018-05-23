@extends('layouts.admin')

@section('content')
<div class="content">
            <script language="javascript">
    function search_submit(prm){
      document.optionsbar.start_from.value=prm;
      document.optionsbar.submit();
      return false;
    }
    function gopage_submit(prm){
      document.optionsbar.start_from.value= (prm - 1) * 50;
      document.optionsbar.submit();
      return false;
    }
</script>
<script type="text/javascript">
<!--
function ckeck_uncheck_all() {

    var frm = document.editnews;
    for (var i=0;i<frm.elements.length;i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox') {
            if(frm.master_box.checked == true){ elmnt.checked=false; $(elmnt).parents('tr').removeClass('warning'); }
            else{ elmnt.checked=true; $(elmnt).parents('tr').addClass('warning'); }
        }
    }
    if(frm.master_box.checked == true){ frm.master_box.checked = false; }
    else{ frm.master_box.checked = true; }

	$(frm.master_box).parents('tr').removeClass('warning');

	$.uniform.update();
}
$(function() {
    $('.table').find('tr > td:last-child').find('input[type=checkbox]').on('change', function() {
        if($(this).is(':checked')) {
            $(this).parents('tr').addClass('warning');
        }
        else {
            $(this).parents('tr').removeClass('warning');
        }
    });
});
-->
</script>
<form action="" method="post" name="editnews">
<input type=hidden name="mod" value="massactions">
<div class="panel panel-default">
  <div class="panel-heading">Список товаров на сайте</div>

    <table class="table table-striped table-xs">
      <thead>
           <tr>
                <th class="hidden-xs hidden-sm" style="width: 60px;">&nbsp;</th>
                <th>Заголовок</th>
                <th style="width: 150px;text-align:center;">Тип</th>
                <th style="width: 100px;text-align:center;">Цена</th>
                <th style="width: 30px;text-align:center;">&nbsp;</th>
                <th style="width: 40px"><input type="checkbox" name="master" title="Выбрать все" onclick="javascript:ckeck_uncheck_all();" class="icheck"></th>
           </tr>
       </thead>
	   <tbody>
	    @foreach($list as $item)
            <tr>
            <td class="hidden-xs hidden-sm text-nowrap">{{ $item->created_at->format('d M Y') }}</td>
            <td><a title='Редактировать' href="{{ route('admin-shop-edit', ['id' => $item->id]) }}">{{ $item->title }}</a></td>
            <td style="text-align: center">{{ $item->item_type }}</td>
            <td style="text-align: center">{{ $item->price }}</td>
            <td style="text-align: center"><span class="text-success"><b><i class="fa fa-check-circle"></i></b></span></td>
            <td style="text-align: center"><input name="selected_news[]" value="1" type="checkbox" class="icheck"></td>
            </tr>
        @endforeach
        </tbody>
	</table>

	<div class="panel-footer">
			  <div class="pull-right">
				<select name="action" class="uniform position-left">
					<option value="">-- Действие --</option>
					<option value="mass_date">Установить текущую дату</option>
					<option value="mass_approve">Опубликовать новости</option>
					<option value="mass_fixed">Зафиксировать новости</option>
					<option value="mass_not_fixed">Снять фиксацию</option>
					<option value="mass_comments">Разрешить комментарии</option>
					<option value="mass_not_comments">Запретить комментарии</option>
					<option value="mass_delete">Удалить</option>
				</select><input class="btn bg-teal btn-sm btn-raised" type="submit" value="Выполнить">
			  </div>
	</div>
</div>
</form>
@endsection