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
        $mangas = Manga::all();

        return View::make('front.manga.manga-list-core', array(
            'mangas' => $mangas,
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

    /*****************************************************************************************************************
    *                                               AJAX                                                             *
    *****************************************************************************************************************/
    protected function _ajaxFilter(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$type = $request->input('type')) {
             return response()->json(['error' => 1]);
        }
        if (!$search = $request->input('search')) {
             return response()->json(['error' => 1]);
        }

        switch ($type) {
            case 'title':
                $mangas = Manga::where('title', 'like', '%'.$search.'%')->get();
            break;

            case 'author':
                $mangas = Manga::with(['author'])
                    ->whereHas('author', function($q) use($search) {
                        $q->where('name', 'like', '%'.$search.'%')
                          ->orWhere('alias', 'like', '%'.$search.'%');
                    })->get();
            break;

            case 'feature':
                $mangas = Manga::with(['tags'])
                    ->whereHas('tags', function($q) use($search) {
                        $q->where('name', '=', $search);
                    })->get();
            break;

            default:
                return response()->json(['error' => 1]);
            break;
        }

        return response()->json([
            'error' => 0,
            'msg'   => View::make('front.manga.manga-list', array(
                'mangas' => $mangas,
            ))->render()
        ]);
    }

}