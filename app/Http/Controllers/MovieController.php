<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class MovieController extends Controller
{
     public function index(Request $request)
    {
        if ($request->ajax()) {
            $client = new Client();
            $response = $client->get(config('services.omdb.url'), [
                'query' => [
                    'apikey' => config('services.omdb.key'),
                    's' => $request->search,
                    'page' => $request->page
                ],
                'http_errors' => false
            ]);

            $data = json_decode((string) $response->getBody(), true);

            return response()->json($data);
        }

        return view('movies.index');
    }

    public function detail($id)
    {
        $client = new Client();
        $response = $client->get(config('services.omdb.url'), [
            'query' => [
                'apikey' => config('services.omdb.key'),
                'i' => $id,
                'plot' => 'full'
            ],
            'http_errors' => false
        ]);

        $movie = json_decode((string) $response->getBody(), true);

        return view('movies.detail', compact('movie'));
    }
}
