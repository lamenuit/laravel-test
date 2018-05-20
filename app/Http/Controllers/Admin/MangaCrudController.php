<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Input;
use App\Models\Manga;
use Storage;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\MangaRequest as StoreRequest;
use App\Http\Requests\MangaRequest as UpdateRequest;

class MangaCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Models\Manga');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/manga');
        $this->crud->setEntityNameStrings('manga', 'mangas');

        $this->crud->addFields([
            [
                'name'  => 'title',
                'label' => 'Titre',
                'type'  => 'text'
            ],
            [
                'name'  => 'title_2',
                'label' => 'Titre 2',
                'type'  => 'text',
                'hint'  => 'Si on a les deux versions/langues du titre'
            ],
            [
                'name'    => 'language',
                'label'   => 'Langue',
                'type'    => 'select_from_array',
                'options' => ['english' => 'English', 'japanese' => 'Japanese'],
                'default' => 'English',
                'allows_null' => false
            ],
            [
                'label'     => 'Auteur',
                'type'      => 'select2',
                'name'      => 'author_id',
                'entity'    => 'author',
                'attribute' => 'name',
                'model'     => 'App\Models\Author'
            ]
        ], 'both');
        $this->crud->addFields([
            [
                'name'   => 'manga',
                'label'  => 'Archive du manga',
                'type'   => 'upload',
                'upload' => true
            ]
        ], 'update');

        $this->crud->addColumns([
            [
                'name'  => 'id',
                'label' => 'ID',
                'type'  => 'number'
            ],
            [
                'name'  => 'title',
                'label' => 'Titre',
                'type'  => 'text'
            ],
        ]);
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);

        $manga = Input::file('manga');
        if ($manga !== null) {
            $res = $this->crud->entry->processArchive($manga);
        }

        return $redirect_location;
    }
}
