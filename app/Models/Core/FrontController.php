<?php

namespace App\Models\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function initList(Request $request)
    {
        return $this->_renderList($request);
    }

    protected function _renderList(Request $request){}

}