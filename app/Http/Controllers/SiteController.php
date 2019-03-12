<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{

    /**
     * Display the specified resource.
     */
    public static function show(): View
    {
        return view('shared.menu', [
            'category' => Category::all()
        ]);
    }
}
