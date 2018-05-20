<?php
namespace App\Http\Middleware;

use Closure;
use App;
use Request;

class LocaleMiddleware
{
    public static $mainLanguage = 'ru-ru';
    public static $languages = ['de-de', 'en-us', 'en-gb', 'es-es', 'fr-fr', 'it-it', 'ru-ru', 'ja-jp', 'zh-cn'];

    public static function getLocale() {
        $uri = Request::path();
        $segmentsURI = explode('/',$uri);
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {

            return $segmentsURI[0];

        } else {
            return  self::$mainLanguage;
        }
    }

    public function handle($request, Closure $next) {
        $locale = self::getLocale();

        if($locale) App::setLocale($locale);

        return $next($request);
    }

}