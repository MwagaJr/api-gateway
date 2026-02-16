<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleApiController extends Controller
{
    // GET: Simple ping
    public function ping()
    {
        return response()->json([
            'message' => 'API is alive',
            'timestamp' => now(),
        ]);
    }

    // POST: Echo back request
    public function echo(Request $request)
    {
        return response()->json([
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'query' => $request->query(),
            'body' => $request->all(),
        ]);
    }

    // GET: Secured endpoint
    public function secure(Request $request)
    {
        $token = $request->header('Authorization');

        if ($token !== 'Bearer test-token-123') {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'message' => 'Authorized access granted',
            'user' => 'Test User',
        ]);
    }

    // GET: Error simulation
    public function error()
    {
        return response()->json([
            'error' => 'This is a simulated server error'
        ], 500);
    }
}
