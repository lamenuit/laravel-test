<?php

namespace App\Http\Controllers\Front;

use App\Models\Core\FrontController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Models\Manga;

class MangaController extends FrontController
{
    protected $modelName   = 'App\Models\Manga';
    protected $routePrefix = 'manga';

    protected function _renderList(Request $request)
    {
        $manga = Manga::find(1);

        return View::make('front.manga.manga-list-core', array(
            'mangas' => $manga,
        ));
    }

    protected function _renderView(Request $request, int $id, string $slug)
    {
        // Check slug
        if ($slug !== str_slug($this->_model->title)) {
            return redirect()->route('manga-view', ['id' => $id, 'slug' => str_slug($this->_model->title)]);
        }

        $pages = $this->_model->pages;
        foreach ($pages as $key => $page) {
            $pages[$key]->image = $page->getImagePath();
        }

        return View::make('front.manga.manga-view', array(
            'manga'  => $this->_model,
            'pages'  => $pages,
            'author' => $this->_model->author
        ));
    }
}