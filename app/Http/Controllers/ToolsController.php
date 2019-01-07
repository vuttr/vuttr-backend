<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Response;

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

        return $tools;
    }
}
