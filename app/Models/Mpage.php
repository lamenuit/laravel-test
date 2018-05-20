<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Mpage extends Model
{
    use CrudTrait;

    const MPAGE_FOLDER = 'public/mpages/';

    protected $table = 'mpages';
    protected $primaryKey = 'id';
    protected $fillable = ['manga_id', 'extension', 'number'];

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
    public function getMPagePath(): string
    {
        $path = str_split((string)$this->id);
        $path = implode('/', $path);
        return self::MPAGE_FOLDER.$path.'/';
    }

    /**************************************************************************
    *                               MUTATORS                                  *
    **************************************************************************/
}