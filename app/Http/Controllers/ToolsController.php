<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Serializers\ToolResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ToolsController extends Controller
{
    /**
     * Show a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $tools = Tool::latest()
            ->hasTag($request->input('tag'))
            ->with('tags')
            ->get();

        return (ToolResource::collection($tools))->response();
    }

    /**
     * Store a new resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules());

        $tool = Tool::create($request->all())
            ->withTags($request->input('tags', []));

        return (ToolResource::make($tool))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Delete a existing resource.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function delete(string $id)
    {
        Tool::where(['id' => $id])->delete() ?: abort(404);

        return response()->json('', Response::HTTP_NO_CONTENT);
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
            'tags' => ['nullable', 'array'],
            'tags.*' => ['required', 'alpha_dash'],
        ];
    }
}
