@extends('layouts.account')

@section('css')
    <link rel="stylesheet" type="text/css" media="all" href="//bneteu-a.akamaihd.net/account/static/css/management/settings.35TLB.css?v=58-29" />
@endsection

@section('js')
    <script type="text/javascript" src="//bneteu-a.akamaihd.net/account/static/js/inputs.0VDAS.js"></script>
    <script type="text/javascript" src="//bneteu-a.akamaihd.net/account/static/js/settings/password.1pKXz.js"></script>
@endsection

@section('content')
<div id="layout-middle">
<div class="wrapper">
<div id="content">
<div id="page-header">
<span class="required-legend"><span class="form-required">*</span> <span class="subcategory">Необходимо указать</span></span>
<h2 class="subcategory">Параметры</h2>
<h3 class="headline">Укажите новый E-mail для своей записи</h3>
</div>
<div id="page-content" class="page-content">
<div class="columns-2-1 settings-content">
<div class="column column-left">
<div class="email-entry">
<span class="clear"><!-- --></span>
<form method="post" action="/account/management/settings/change-email.html" id="change-settings">
<div class="input-hidden">
<input type="hidden" id="csrftoken" name="csrftoken" value="e6eb0239-cab8-43d7-85b1-2c6d88f69fe9" />
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="newEmail">
<span class="label-text">
Новый E-mail:
</span>
<span class="input-required">*</span>
</label>
</span><!--
--><span class="input-right">
<span class="input-text input-text-small">
<input type="email" name="newEmail" value="" id="newEmail" class="small border-5 glow-shadow-2" autocomplete="off" onpaste="return false;" maxlength="319" tabindex="1" required="required" placeholder="Укажите электронный адрес" />
<span class="inline-message " id="newEmail-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="newEmailVerify">
<span class="label-text">
Подтвердите новый E-mail:
</span>
<span class="input-required">*</span>
</label>
</span><!--
--><span class="input-right">
<span class="input-text input-text-small">
<input type="email" name="newEmailVerify" value="" id="newEmailVerify" class="small border-5 glow-shadow-2" autocomplete="off" onpaste="return false;" maxlength="319" tabindex="1" required="required" placeholder="Подтвердите электронный адрес" />
<span class="inline-message " id="newEmailVerify-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="password">
<span class="label-text">
Пароль:
</span>
<span class="input-required">*</span>
</label>
</span><!--
--><span class="input-right">
<span class="input-text input-text-small">
<input type="password" id="password" name="password" value="" class="small border-5 glow-shadow-2" autocomplete="off" onpaste="return false;" maxlength="16" tabindex="1" required="required" placeholder="Введите пароль" />
<span class="inline-message " id="password-message"> </span>
</span>
</span>
</div>
<div class="submit-row" id="submit-row">
<div class="input-left"></div><!--
--><div class="input-right">
<button class="ui-button button1" type="submit" id="email-submit" tabindex="1"><span class="button-left"><span class="button-right">Далее</span></span></button>
<a class="ui-cancel "
href="{{ route('account') }}"
tabindex="1">
<span>
Отмена </span>
</a>
</div>
</div>
</form>
<script type="text/javascript">
//<![CDATA[
var FormMsg = {
'headerSingular': 'Исправьте, пожалуйста, следующее.',
'headerMultiple': 'Исправьте, пожалуйста, следующее.',
'fieldMissing': 'Это поле необходимо заполнить.',
'fieldsMissing': 'Заполните, пожалуйста, все обязательные поля.',
'emailInfo': 'Это ваше имя пользователя при авторизации.',
'emailMissing': 'Укажите, пожалуйста, действующий E-mail.',
'emailInvalid': 'Электронный адрес указан некорректно.',
'emailMismatch': 'Электронные адреса должны совпадать друг с другом.',
'passwordInvalid': 'Ваш пароль не отвечает требованиям.',
'passwordMismatch': 'Пароли должны совпадать друг с другом.',
'tosDisagree': 'Чтобы перейти к следующему шагу, нужно выразить согласие с условиями.',
'taxInvoiceSelect': 'Please select a tax invoice option'
, 'emailError1': 'Электронный адрес указан некорректно.'
, 'emailError2': 'Электронные адреса должны совпадать друг с другом.'
};
//]]>
</script>
</div>
</div>
<div class="column column-right">
<div class="email-information">
<p class="caption">Введите новый электронный адрес: он будет использоваться и в качестве нового названия этой учетной записи Blizzard.</p>
<p>На новый адрес сразу будет выслано контрольное сообщение: для завершения смены адреса вам нужно будет перейти по указанной в нем ссылке.</p>
</div>
</div>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
$(function() {
var inputs = new Inputs('#change-settings');
var settings = new ChangeEmail('#change-settings', {
emailFields: [
'#newEmail',
'#newEmailVerify'
],
domains: [
]
});
});
//]]>
</script>
</div>
</div>
</div>
@endsection