<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        // session(['user_id'=>$_ENV('USER_ID')]);
        $consulta = env('URL_BACK_API').'jugadores/partidas/'.env('USER_ID');

        
        $response = Http::get($consulta);
        $jsonResponse = $response->json();
        $participaciones = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];
        Log::info('respuesta: ' . json_encode($participaciones));
        
 
        return view('admin.index', ['participaciones' => $participaciones]);
    }

    public function registrarPartida()
    {
        $response = Http::get(env('URL_BACK_API').'monedas');
        $jsonResponse = $response->json();
        $monedas = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];
        return view('partida.registrar', ['monedas' => $monedas]);
    }

    public function registrarInvitacion($id_partida)
    {
        $id_participante=null;
        $response = Http::get(env('URL_BACK_API').'invitaciones/partida/'.$id_partida);
        $jsonResponse = $response->json();
        $invitaciones = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];
    
        $response = Http::get(env('URL_BACK_API').'participantes');
        $jsonResponse = $response->json();
        $participantes = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];

        foreach ($participantes as $participante) {
            if ($participante['id_partida']==$id_partida){
                $id_participante =$participante['id'];
            }
        }

        return view('invitacion.registrar', ['invitaciones' => $invitaciones, 'id_partida' => $id_partida, 'id_participante' => $id_participante]);
    }
}
