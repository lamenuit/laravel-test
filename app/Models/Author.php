<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Author extends Model
{
    use CrudTrait;

    protected $table = 'authors';
    protected $primaryKey = 'id';
    protected $fillable = ['firstname', 'name', 'alias', 'deceased'];

    public $timestamps = false;

    /**************************************************************************
    *                               FUNCTIONS                                 *
    **************************************************************************/
    public static function getAllAuthorFullNames(): array
    {
        $authors = [];
        foreach (Author::all() as $author) {
            $authors[$author->id] = $author->firstname.' '.$author->name.' | '.$author->alias;
        }

        return $authors;
    }

    /**************************************************************************
    *                               RELATIONS                                 *
    **************************************************************************/

    /**************************************************************************
    *                               SCOPES                                    *
    **************************************************************************/

    /**************************************************************************
    *                               ACCESSORS                                 *
    **************************************************************************/
    public function getFullName(): string
    {
        return $this->firstname.' '.$this->name;
    }

    public function mangas()
    {
        return $this->hasMany('App\Models\Manga');
    }

    /**************************************************************************
    *                               MUTATORS                                  *
    **************************************************************************/
}
