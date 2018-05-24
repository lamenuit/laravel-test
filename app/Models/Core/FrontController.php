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

    public function ajaxProcess(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($action = $request->input('action')) {
            $action = ucfirst(mb_strtolower($action));
            if (method_exists($this, '_ajax'.$action)) {
                return $this->{'_ajax'.$action}($request);
            }
        } else {
            return response()->json(['error' => 1, 'msg' => 'invalid method']);
        }
    }

    protected function _renderList(Request $request){}
    protected function _renderView(Request $request, int $id, string $slug){}

}