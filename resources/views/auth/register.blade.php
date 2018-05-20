<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ app()->getLocale() }}" class="{{ app()->getLocale() }}">
    <head xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
        <meta http-equiv="imagetoolbar" content="false" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Создание учетной записи -  World of Warcraft</title>
        <link rel="shortcut icon" href="{{ asset('images/meta/favicon.ico') }}" />
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/toolkit/freedomnet-web.min.css') }}" />
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/login/global.min.css') }}" />
        <script type="text/javascript" src="{{ asset('js/third-party/jquery-1.11.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/core.min.js') }}"></script>
        <meta name="viewport" content="width=device-width" />

    </head>
    <body class="{{ app()->getLocale() }} login-template web wow WotLK" data-embedded-state="STATE_LOGIN">
    <div class="grid-container wrapper">
        <h1 class="logo" style="height:91px;">Создание учетной записи</h1>

        <div class="hide" id="info-wrapper">
            <h2><strong class="info-title"></strong></h2>

            <p class="info-body"></p><button class="btn btn-block hide visible-phone" id="info-phone-close">Close</button>
        </div>
        <div class="input-container" id="registration-wrapper">

            <form action="{{ route('register') }}" class=" username-required input-focus" id="password-form" method="post" name="password-form">
                {{ csrf_field() }}
                @if ($errors->has('name') && $errors->has('email') && $errors->has('password'))
                <div id="error" class="alert alert-error alert-icon">Исправьте, пожалуйста, следующее.
                    <ul>
                        @if ($errors->has('name'))<li>{{ $errors->first('name') }}</li>@endif
                        @if ($errors->has('email'))<li>{{ $errors->first('email') }}</li>@endif
                        @if ($errors->has('password'))<li>{{ $errors->first('password') }}</li>@endif
                    </ul>
                </div>
                @endif

                <div class="control-group {{ $errors->has('email') ? 'control-error text-error' : '' }}">
                    <label class="control-label" for="email" id="email-label">E-Mail</label>

                    <div class="controls">
                        <input class="input-block input-large" id="email" maxlength="320" name="email" placeholder="E-Mail" spellcheck="false" tabindex="1" title="E-Mail" type="text" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="control-group {{ $errors->has('password') ? 'control-error text-error' : '' }}">
                    <label class="control-label" for="password" id="password-label">Password</label>

                    <div class="controls">
                        <input autocomplete="off" class="input-block input-large" id="password" maxlength="16" name="password" placeholder="Password" spellcheck="false" tabindex="1" title="Password" type="password" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="password" id=
                    "password-label">Confirm Password</label>

                    <div class="controls">
                        <input autocomplete="off" class="input-block input-large" id="rpassword" maxlength="16" name="password_confirmation" placeholder="Confirm Password" spellcheck="false" tabindex="1" title="Confirm Password" type="password" required>
                    </div>
                </div>

                <div class="control-group submit">
                    <button class="btn btn-primary btn-large btn-block" data-loading-text="" id="submit" tabindex="1" type="submit">Register<i class="spinner-battlenet"></i></button>
                </div>

                <ul id="help-links">
                    <li>
                        <a class="btn btn-block btn-large" href="{{ route('login') }}"rel="external" tabindex="1">You already have an account?<i class="icon-external-link"></i></a>
                    </li>

                    <li>
                        <a class="" href="{{ route('password.request') }}"rel="external" tabindex="1">Can't log in?<i class="icon-external-link"></i></a>
                    </li>
                </ul>
            </form>
        </div>

        <footer class="footer footer-eu">
            <div class="lower-footer-wrapper">
                <div class="lower-footer">
                    <div id="copyright">
                        © World of Warcraft, 2017 г.
                    </div>

                    <div id="legal">
                        <div class="png-fix" id="legal-ratings"></div><span class="clear"><!-- --></span>
                    </div>
                </div>

                <div id="marketing-trackers">
                    <div class="marketing-cover"></div>
                </div>
            </div>
        </footer>
    </div>
    <script type="text/javascript" src="{{ asset('js/embed-0.1.5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/login/toolkit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/login/global.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/login/login.min.js') }}"></script>
    </body>
</html>