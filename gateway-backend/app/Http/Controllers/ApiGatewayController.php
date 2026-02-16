<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\RequestLog;
use App\Models\Collection;
use App\Models\SavedRequest;
use Illuminate\Support\Facades\Log;

class ApiGatewayController extends Controller
{
    public function index()
    {
        $collections = Collection::with('requests')->get();
        return view('gateway.index', compact('collections'));
    }


    public function send(Request $request)
    {
        $startTime = microtime(true);

        $method = strtolower($request->input('method'));
        $url    = $request->input('url');

        // ALWAYS force arrays
        $headers = $request->input('headers', []);
        $params  = $request->input('query_params', []);
        $body    = $request->input('body', []);

        if (!is_array($headers)) $headers = [];
        if (!is_array($params))  $params  = [];
        if (!is_array($body))    $body    = [];

        // 🔹 LOG: Incoming request
        Log::info('GATEWAY REQUEST RECEIVED', [
            'method' => strtoupper($method),
            'url'    => $url,
            'headers'=> $headers,
            'params' => $params,
            'body'   => $body,
            'ip'     => $request->ip(),
        ]);

        try {
            $http = Http::withHeaders($headers)
                ->timeout(30);

            if (!empty($params)) {
                $http = $http->withOptions([
                    'query' => $params
                ]);
            }

            // 🔹 LOG: Sending request
            Log::info('GATEWAY FORWARDING REQUEST', [
                'method' => strtoupper($method),
                'url'    => $url,
            ]);

            $response = $http->send(strtoupper($method), $url, [
                'json' => $body
            ]);

            $duration = round((microtime(true) - $startTime) * 1000, 2);

            // 🔹 LOG: Response received
            Log::info('GATEWAY RESPONSE RECEIVED', [
                'status'   => $response->status(),
                'duration' => $duration . ' ms',
                'headers'  => $response->headers(),
                'body'     => $response->json() ?? $response->body(),
            ]);

            return response()->json([
                'status'   => $response->status(),
                'duration' => $duration . ' ms',
                'headers'  => $response->headers(),
                'body'     => $response->json() ?? $response->body(),
            ]);

        } catch (\Throwable $e) {

            // 🔹 LOG: Error
            Log::error('GATEWAY REQUEST FAILED', [
                'message' => $e->getMessage(),
                'url'     => $url,
                'method'  => strtoupper($method),
                'trace'   => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function saveRequest(Request $request)
    {
        SavedRequest::create([
            "collection_id" => $request->collection_id,
            "name" => $request->name,
            "method" => $request->method,
            "url" => $request->url,
            "headers" => $request->headers,
            "query_params" => $request->query_params,
            "body" => $request->body,
        ]);

        return back()->with('success', 'Request saved to collection!');
    }
}


