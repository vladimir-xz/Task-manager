<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setLanguage(Request $request, string $local)
    {
        // if (!in_array($locale, ['en', 'ru'])) {
        //     abort(404);
        // }
         // Save selected Locale to current "Session"
        //  $locale = $request->locale ?? 'en';
        // App::setLocale($locale); --> There is no need for this here, as the middleware will run after the redirect() 
        // where it has already been set.

        $request->session()->put('local', $local);

         return redirect()->back();
    }
}
