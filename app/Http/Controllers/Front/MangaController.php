<?php

namespace App\Http\Controllers\Front;

use App\Models\Core\FrontController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\Manga;

class MangaController extends FrontController
{
    protected function _renderList(Request $request)
    {
        $manga = Manga::find(1)->pages;
        dd($manga);

        return View::make('front.manga.manga-list-core');
    }
}