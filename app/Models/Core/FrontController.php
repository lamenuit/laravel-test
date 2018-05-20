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

    public function initView(Request $request, int $id, string $slug)
    {
        $this->_model = $this->modelName::find($id);
        if ($this->_model === null) {
            return redirect()->route($this->routePrefix.'-listing');
        }

        $this->_user = $request->user();

        return $this->_renderView($request, $id, $slug);
    }

    protected function _renderList(Request $request){}
    protected function _renderView(Request $request, int $id, string $slug){}

}