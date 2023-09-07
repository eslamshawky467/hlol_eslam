<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLanguage
{
    public function handle($request, Closure $next)
    {
        $language = $request->header('language');
        app()->setLocale($language);
        return $next($request);
    }
}
