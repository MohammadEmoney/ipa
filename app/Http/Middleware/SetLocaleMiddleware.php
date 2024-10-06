<?php

namespace App\Http\Middleware;

use App\Enums\EnumLanguages;
use App\Repositories\SettingsRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $defaultLocale = app()->getLocale();
        $locale = $request->segment(1); // Get the first segment from the URL (e.g., 'en' or 'de')

        // Define allowed languages
        // $allowedLocales = ['fr', 'fa']; // Add your allowed languages here
        $settings = new SettingsRepository();
        $allowedLocales = $settings->getLanguages()->data;

        // Check if the locale is valid
        if($locale !== 'livewire' && !is_null($locale)){
            if (!is_array($allowedLocales) || empty($allowedLocales) || !in_array($locale, $allowedLocales)) {
                abort(404); // Show 404 page if the language is not allowed
            }
        }

        if (!EnumLanguages::getKeyByValue($locale)) {
            if (Auth::check()) {
                $locale = auth()->user()->lang ?: $defaultLocale;
            }else{
                $locale = $defaultLocale;
            }
        } else {
            if (Auth::check())
                auth()->user()->update(['lang' => $locale]);
        }
        app()->setLocale($locale);
        request()->session()->put('locale', $locale);

        return $next($request);
    }
}
