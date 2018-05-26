<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TagRequest as StoreRequest;
use App\Http\Requests\TagRequest as UpdateRequest;

class TagCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Models\Tag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tag');
        $this->crud->setEntityNameStrings('tag', 'tags');

        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => 'Nom du tag',
                'type'  => 'text'
            ],
            [
                'name'        => 'type',
                'label'       => 'Type de tag',
                'type'        => 'radio',
                'options'     => [0 => 'M',1 => 'F', 2 => 'NA'],
                'inline'      => true
            ]
        ], 'both');

        $this->crud->addColumns([
            [
                'name'  => 'id',
                'label' => 'ID',
                'type'  => 'number'
            ],
            [
                'name'  => 'name',
                'label' => 'Nom du tag',
                'type'  => 'text'
            ],
            [
                'name'  => 'type',
                'label' => 'Genre',
                'type'  => 'radio',
                'options' => [0 => 'Male', 1 => 'Female', 2 => 'Neutral']
            ]
        ]);
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
