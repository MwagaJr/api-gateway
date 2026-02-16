<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function save(Request $request)
    {
        return Collection::create([
            "name" => $request->name,
            "method" => $request->method,
            "url" => $request->url,
            "headers" => json_encode($request->headers),
            "query_params" => json_encode($request->query_params),
            "body" => $request->body,
        ]);
    }

    public function index()
    {
        return Collection::all();
    }
}

