<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class LayoutComposer
{
    const JS_LIBS = [
        'js/libs/jquery.min.js'
    ];
    const CSS_LIBS = [
        'css/libs/bootstrap.min.css',
        'css/app.css'
    ];


    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'js_libs'  => self::JS_LIBS,
            'css_libs' => self::CSS_LIBS
        ]);
    }
}