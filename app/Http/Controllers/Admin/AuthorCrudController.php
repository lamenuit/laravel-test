<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AuthorRequest as StoreRequest;
use App\Http\Requests\AuthorRequest as UpdateRequest;

class AuthorCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel('App\Models\Author');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/author');
        $this->crud->setEntityNameStrings('author', 'authors');

        $this->crud->addFields([
            [
                'name'  => 'firstname',
                'label' => 'Prénom',
                'type'  => 'text'
            ],
            [
                'name'  => 'name',
                'label' => 'Nom',
                'type'  => 'text'
            ],
            [
                'name'  => 'alias',
                'label' => 'Alias',
                'type'  => 'text',
                'hint'  => 'Pseudonyme si l\'auteur ne divulgue pas son nom'
            ],
            [
                'name'        => 'deceased',
                'label'       => 'Décédé',
                'type'        => 'radio',
                'options'     => [0 => 'Non',1 => 'Oui'],
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
                'name'  => 'full_name',
                'label' => 'Prénom & Nom',
                'type'  => 'model_function',
                'function_name' => 'getFullName',
            ],
            [
                'name'  => 'alias',
                'label' => 'Alias',
                'type'  => 'text'
            ],
            [
                'name'  => 'deceased',
                'label' => 'Décédé',
                'type'  => 'boolean',
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
