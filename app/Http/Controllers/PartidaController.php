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
            'duracion_oferta' => $request->input('duracion_oferta'),
        ];
        $response = Http::post('http://127.0.0.1:8000/api/partidas', $data);

        $jsonResponse = $response->json();
        $status = $jsonResponse['status'];


        if ($status=='success'){
            
            $partida =  $jsonResponse['data']['id'];
            $dataParticipante = [
                'ci_jugador' => env('USER_ID'),
                'id_rol' => 1,
                'id_partida' => $partida,
            ];
            $responseParticipante = Http::post('http://127.0.0.1:8000/api/participantes', $dataParticipante);
            Log::info($responseParticipante);
            
            return redirect()->route('/');       
        }
         
        return view('partida.registrar')->with('message', $jsonResponse['message']);
    }

    public function detalles($id)
    {
        $consultaRol = 'http://127.0.0.1:8000/api/participante/partida-jugador/'.$id.'/'.env('USER_ID');
        Log::info('rol: ' . $consultaRol);
        $responseRol = Http::get($consultaRol);
        $jsonResponseRol = $responseRol->json();
        Log::info('rol: ' . json_encode($jsonResponseRol));
        $rol = isset($jsonResponseRol['data']) ? $jsonResponseRol['data'] : [];

        $consulta = 'http://127.0.0.1:8000/api/detalles-partida/'.$id;
    
        Log::info('respuesta: ' . $consulta);
        $response = Http::get($consulta);
        $jsonResponse = $response->json();
        Log::info('respuesta: ' . json_encode($jsonResponse));
        $detalles = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];
        $numeroParticipantes = count($detalles['participantes']);
        return view('partida.detalles', ['detalles' => $detalles, 'rol'=> $rol, 'numeroParticipantes' =>$numeroParticipantes]);
    }
}


