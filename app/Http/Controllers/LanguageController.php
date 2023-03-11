<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        // echo "hello";
        app()->setLocale('bn');
        // return redirect()->back();
    }
}
