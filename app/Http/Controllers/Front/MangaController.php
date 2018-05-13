<?php

namespace App\Http\Controllers\Front;

use App\Models\Core\FrontController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MangaController extends FrontController
{
    protected function _renderList(Request $request)
    {
        return View::make('front.manga.manga-list-core');
    }
}