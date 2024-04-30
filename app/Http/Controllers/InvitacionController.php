<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class InvitacionController extends Controller
{
    public function anadir(Request $request)
    {
        $data = [
            'fecha' =>  date("Y-m-d H:i:s"),
            'nombre' => $request->input('nombre'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'id_participante' => $request->input('id_participante'),
            'id_partida' => $request->input('id_partida'),
        ];
        $response = Http::post(env('URL_BACK_API') . 'invitaciones', $data);
        $jsonResponse = $response->json();
        $status = $jsonResponse['status'];

        if ($status == 'Success') {
            return redirect()->route('registrar-invitacion', ['id_partida' => $request->input('id_partida')]);
        }
    }
}
