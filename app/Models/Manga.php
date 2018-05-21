<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Backpack\CRUD\CrudTrait;
use Storage;

use App\Models\Mpage;

class Manga extends Model
{
    use CrudTrait;

    const EXTRACT_FOLDER = '/upload_buffer';
    const ALLOWED_IMAGE_EXTENSIONS = array('jpg', 'png', 'jpeg');

    protected $table = 'mangas';
    protected $primaryKey = 'id';
    protected $fillable = ['author_id', 'title', 'title_2', 'language'];

    public $timestamps = true;

    /**************************************************************************
    *                               FUNCTIONS                                 *
    **************************************************************************/
    public function processArchive(UploadedFile $archive): bool
    {
        // Clean extract folder
        $files = glob(public_path('storage').self::EXTRACT_FOLDER.'/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        // Extract new archive
        $zip = new \ZipArchive();
        if ($zip->open($archive) === true) {
            if ($zip->extractTo(public_path('storage').self::EXTRACT_FOLDER)) {
                $zip->close();
            } else {
                return false;
            }
        }

        // Check and order files
        $pages = array();
        foreach (new \DirectoryIterator(public_path('storage').self::EXTRACT_FOLDER) as $fileInfo) {
            if ($fileInfo->isDot()) {
                var_dump('continue 1');
                continue;
            }

            $fileName = $fileInfo->getFilename();
            $extension = explode('.', $fileName);
            if (!array_key_exists(1, $extension) || !in_array($extension[1], self::ALLOWED_IMAGE_EXTENSIONS)) {
                if (is_file(public_path('storage').self::EXTRACT_FOLDER.'/'.$fileName)) {
                    unlink(public_path('storage').self::EXTRACT_FOLDER.'/'.$fileName);
                }
                continue;
            }
            $pages[$fileName] = array(
                'path' => public_path('storage').self::EXTRACT_FOLDER.'/'.$fileName,
                'ext'  => $extension[1],
                'name' => $fileName
            );
        }
        usort($pages, function($a, $b){
            return strnatcmp($a['path'],$b['path']);
        });

        // Create and move pages
        foreach ($pages as $key => $pageData) {
            $page = new Mpage();
            $page->manga_id  = $this->id;
            $page->extension = $pageData['ext'];
            $page->number    = (int)($key + 1);
            if ($page->save()) {
                // var_dump($key);
                // echo "<pre>";var_dump($page->getMPagePath(), $pageData['name']);echo "</pre>";
                Storage::disk('local')->put($page->getMPagePath().$pageData['name'], file_get_contents($pageData['path']));
            }
        }

        return true;
    }

    /**************************************************************************
    *                               RELATIONS                                 *
    **************************************************************************/
    public function pages()
    {
        return $this->hasMany('App\Models\Mpage');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'manga_tag');
    }

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
