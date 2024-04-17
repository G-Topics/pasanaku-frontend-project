<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class InvitacionController extends Controller
{
    public function anadir(Request $request)
    {
        $data = [
            'fecha' =>   Carbon::now(),
            'nombre' => $request->input('nombre'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'id_participante' => $request->input('id_participante'),
            'id_partida' => $request->input('id_partida'),
        ];
        $response = Http::post('http://127.0.0.1:8000/api/invitaciones', $data);


        $jsonResponse = $response->json();
        $status = $jsonResponse['status'];

        $invitacion =  $jsonResponse['data']['id'];

        if ($status == 'success') {


            $dataDetalleInvitacion = [
                'fecha' =>  $date = Carbon::now(),
                'id_estado_invitacion' => 3,
                'id_invitacion' => $invitacion,

            ];
            $responseParticipante = Http::post('http://127.0.0.1:8000/api/detalles_estados_invitaciones', $dataDetalleInvitacion);
            Log::info($responseParticipante);

            return redirect()->route('registrar-invitacion', ['id_partida' => $request->input('id_partida')]);
        }

        return view('partida.registrar')->with('message', $jsonResponse['message']);
    }

    public function eliminar($id)
    {
        $response = Http::delete('http://127.0.0.1:8000/api/invitaciones/'.$id);
        Log::info($response);
        
    }


}
