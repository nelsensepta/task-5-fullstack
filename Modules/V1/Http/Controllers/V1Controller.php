<?php

namespace Modules\V1\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

class V1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return response(["status" => 200, "message" => "Hello World"]);
    }

}