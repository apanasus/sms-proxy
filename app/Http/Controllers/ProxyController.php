<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    private $apiUrl = 'https://postback-sms.com/api/';
    private $apiToken = '5994c91001f57eea808aff11738d752a';

    public function proxy(Request $request)
    {
        $action = $request->query('action');
        $allowedActions = ['getNumber', 'getSms', 'cancelNumber', 'getStatus'];

        if (!in_array($action, $allowedActions)) {
            return response()->json(['code' => 'error', 'message' => 'Invalid action'], 400);
        }

        $params = $request->all();
        $params['token'] = $this->apiToken;

        try {
            $response = Http::get($this->apiUrl, $params);
            return response($response->body(), $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'error',
                'message' => 'Failed to connect to the API',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
