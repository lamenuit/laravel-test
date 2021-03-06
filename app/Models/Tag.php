<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Tag extends Model
{
    use CrudTrait;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'type'];

    public $timestamps = false;

    /**************************************************************************
    *                               FUNCTIONS                                 *
    **************************************************************************/

    /**************************************************************************
    *                               RELATIONS                                 *
    **************************************************************************/

    /**************************************************************************
    *                               SCOPES                                    *
    **************************************************************************/

    /**************************************************************************
    *                               ACCESSORS                                 *
    **************************************************************************/

    /**************************************************************************
    *                               MUTATORS                                  *
    **************************************************************************/
}
