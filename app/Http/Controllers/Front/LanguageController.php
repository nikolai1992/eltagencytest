<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Middleware\SetLocaleMiddleware;

class LanguageController extends Controller
{
    //
    public function setPrefix($lang)
    {
        $referer = str_replace("/public", "", redirect()->back()->getTargetUrl()); //URL предыдущей страницы

        $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

        //разбиваем на массив по разделителю
        $segments = explode('/', $parse_url);

        //Если URL (где нажали на переключение языка) содержал корректную метку языка
        if (in_array($segments[1], config('app.languages'))) {
            unset($segments[1]); //удаляем метку
        }

        //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
        if ($lang != SetLocaleMiddleware::$mainLanguage) {
            array_splice($segments, 1, 0, $lang);
        }

        //формируем полный URL
        $url = request()->root() . implode("/", $segments);

        //если были еще GET-параметры - добавляем их
        if (parse_url($referer, PHP_URL_QUERY)) {
            $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }

        $url = str_replace(env('APP_URL'),"",$url);

        return redirect($url); //Перенаправляем назад на ту же страницу

    }
}
