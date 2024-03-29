<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/partidas');
        $jsonResponse = $response->json();
        $partidas = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];

        return view('admin.index', ['partidas' => $partidas]);
    }
}
