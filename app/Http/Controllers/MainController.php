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
        $consulta = 'http://3.137.171.204/api/jugadores/partidas/'.env('USER_ID');

        Log::info('respuesta: ' . $consulta);
        $response = Http::get($consulta);
        $jsonResponse = $response->json();
        $partidas = isset($jsonResponse) ? $jsonResponse : [];
        return view('admin.index', ['partidas' => $partidas]);
    }

    public function registrarPartida()
    {
        $response = Http::get('http://3.137.171.204/api/monedas');
        $jsonResponse = $response->json();
        $monedas = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];
        return view('partida.registrar', ['monedas' => $monedas]);
    }

    public function registrarInvitacion($id_partida)
    {
        $id_participante=null;
        $response = Http::get('http://3.137.171.204/api/invitaciones/partida/'.$id_partida);
        $jsonResponse = $response->json();
        $invitaciones = isset($jsonResponse['data']) ? $jsonResponse['data'] : [];
    
        $response = Http::get('http://3.137.171.204/api/participantes');
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
