<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\PendingRequest;


class PartidaController extends Controller
{
    public function consumir( Request $request ){
        $data = [
            'nombre' => $request->input('nombre'),
            'frecuencia' => $request->input('frecuencia'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'descripcion' => $request->input('descripcion'),
            'monto' => $request->input('monto'),
            'id_moneda' => $request->input('id_moneda'),
            'capacidad' => $request->input('capacidad'),
            'multa' => $request->input('multa'),
        ];
        $response = Http::post('http://127.0.0.1:8000/api/partidas', $data);

        $jsonResponse = $response->json();
        $status = $jsonResponse['status'];


        if ($status=='success')
            return view('admin.index')->with('message', $jsonResponse['message']);    
        return view('partida.registrar')->with('message', $jsonResponse['message']);
    }
}


