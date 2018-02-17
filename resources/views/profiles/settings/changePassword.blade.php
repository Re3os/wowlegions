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
@if (session('error'))
<div xmlns="http://www.w3.org/1999/xhtml" class="alert error closeable border-4 glow-shadow">
    <div class="alert-inner">
        <div class="alert-message">
            <p class="title"><strong><a name="form-errors">Исправьте, пожалуйста, следующее.</a></strong></p>
            <p>{{ session('error') }} </p>
        </div>
    </div>
</div>
@endif
@if (session('success'))
<div xmlns="http://www.w3.org/1999/xhtml" class="alert success closeable border-4 glow-shadow">
    <div class="alert-inner">
        <div class="alert-message">
            <p class="title"><strong><a name="form-errors">{{ session('success') }}</a></strong></p>
        </div>
    </div>
</div>
@endif
<div id="page-header">
<span class="required-legend"><span class="form-required">*</span> <span class="subcategory">Необходимо указать</span></span>
<h2 class="subcategory">Параметры</h2>
<h3 class="headline">Выберите новый пароль для своей записи</h3>
</div>
<div id="page-content" class="page-content">
<div class="columns-2-1 settings-content">
<div class="column column-left">
<div class="password-entry">
<span class="clear"><!-- --></span>
<form method="post" action="{{ route('change-password') }}" id="change-settings">
<div class="input-hidden">
{{ csrf_field() }}
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="oldPassword">
<span class="label-text">
Прежний пароль:
</span>
<span class="input-required">*</span>
</label>
</span><!--
--><span class="input-right{{ $errors->has('oldPassword') ? ' input-error' : '' }}">
<span class="input-text input-text-small">
<input type="password" id="oldPassword" name="oldPassword" value="" class="small border-5 glow-shadow-2" autocomplete="off" maxlength="16" tabindex="1" required="required" placeholder="Введите прежний пароль" />
<span class="inline-message " id="oldPassword-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="newPassword">
<span class="label-text">
Новый пароль:
</span>
<span class="input-required">*</span>
</label>
</span><!--
--><span class="input-right {{ $errors->has('newPassword') ? ' input-error' : '' }}">
<span class="input-text input-text-small">
<input type="password" id="newPassword" name="newPassword" value="" class="small border-5 glow-shadow-2" autocomplete="off" maxlength="16" tabindex="1" required="required" placeholder="Введите новый пароль" />
<span class="inline-message " id="newPassword-message"> </span>
</span>
</span>
</div>
<div class="input-row input-row-note" id="password-strength" style="display: none">
<div class="input-note input-text-small border-5 glow-shadow">
<div class="input-note-content">
<div class="password-strength">
<span class="password-result">
Уровень надежности:
<strong id="password-result"></strong>
</span>
<span class="password-rating"><span class="rating rating-default" id="password-rating"></span></span>
</div>
</div>
<div class="input-note-arrow"></div>
</div>
</div>
<div class="input-row input-row-text">
<span class="input-left">
<label for="newPasswordVerify">
<span class="label-text">
Подтвердите новый пароль:
</span>
<span class="input-required">*</span>
</label>
</span><!--
--><span class="input-right {{ $errors->has('newPasswordVerify') ? ' input-error' : '' }}">
<span class="input-text input-text-small">
<input type="password" id="newPasswordVerify" name="newPasswordVerify" value="" class="small border-5 glow-shadow-2" autocomplete="off" maxlength="16" tabindex="1" required="required" placeholder="Подтвердите новый пароль" />
<span class="inline-message " id="newPasswordVerify-message"> </span>
</span>
</span>
</div>
<div class="submit-row" id="submit-row">
<div class="input-left"></div><!--
--><div class="input-right">
<button class="ui-button button1" type="submit" id="password-submit" tabindex="1"><span class="button-left"><span class="button-right">Далее</span></span></button>
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
, 'passwordError1': 'Ваш пароль не отвечает требованиям.'
, 'passwordError2': 'Пароли должны совпадать друг с другом.'
, 'passwordStrength0': 'Слишком короткий'
, 'passwordStrength1': 'низкий'
, 'passwordStrength2': 'приемлемый'
, 'passwordStrength3': 'высокий'
};
//]]>
</script>
</div>
</div>
<div class="column column-right">
<div class="password-requirements">
<ul class="password-level" id="password-level">
<li id="password-level-0"><!--
--><span class="icon-16"></span><!--
--><span class="icon-16-label">Пароль должен состоять из 8—16 символов.</span><!--
--></li>
<li id="password-level-1"><!--
--><span class="icon-16"></span><!--
--><span class="icon-16-label">Пароль может содержать только буквы (A—Z), цифры (0—9) и знаки пунктуации.</span><!--
--></li>
<li id="password-level-2"><!--
--><span class="icon-16"></span><!--
--><span class="icon-16-label">Пароль должен включать в себя хотя бы одну букву и хотя бы одну цифру.</span><!--
--></li>
<li id="password-level-3"><!--
--><span class="icon-16"></span><!--
--><span class="icon-16-label">Пароль не должен совпадать с названием учетной записи.</span><!--
--></li>
<li id="password-level-4"><!--
--><span class="icon-16"></span><!--
--><span class="icon-16-label">Пароли должны совпадать друг с другом.</span><!--
--></li>
</ul>
<p class="caption">Из соображений безопасности советуем вам использовать особый пароль, который вы больше не используете нигде в Интернете.</p>
</div>
</div>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
$(function() {
var inputs = new Inputs('#change-settings');
var settings = new ChangePassword('#change-settings', {
passwordFields: [
'#newPassword',
'#newPasswordVerify'
],
emailAddress: '{{ $profileUser->email }}'
});
});
//]]>
</script>
</div>
</div>
</div>
@endsection