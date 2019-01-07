<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ToolsController extends Controller
{
    /**
     * Show a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tools = Tool::latest()->get();

        return response()->json($tools);
    }

    /**
     * Store a new resource.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules());

        $tool = Tool::create($request->all());

        return response()->json($tool, Response::HTTP_CREATED);
    }

    /**
     * Validation rules for tools.
     *
     * @return array
     */
    private function validationRules()
    {
        return [
            'title' => ['required', 'min:1', 'max:240'],
            'link' => ['required', 'url', 'min:1', 'max:240'],
            'description' => ['required', 'min:1', 'max:1000'],
        ];
    }
}
