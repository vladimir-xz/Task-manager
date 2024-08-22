<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setLanguage(Request $request, string $locale)
    {
        $request->session()->put('locale', $locale);

         return redirect()->back();
    }
}
