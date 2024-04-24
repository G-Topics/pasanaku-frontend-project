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
        $response = Http::post(env('URL_BACK_API').'invitaciones', $data);


        $jsonResponse = $response->json();
        $status = $jsonResponse['status'];

        $invitacion =  $jsonResponse['data']['id'];

        if ($status == 'success') {


            $dataDetalleInvitacion = [
                'fecha' => date("Y-m-d H:i:s"),
                'id_estado_invitacion' => 3,
                'id_invitacion' => $invitacion,

            ];
            $responseParticipante = Http::post(env('URL_BACK_API').'detalles_estados_invitaciones', $dataDetalleInvitacion);
            Log::info($responseParticipante);

            return redirect()->route('registrar-invitacion', ['id_partida' => $request->input('id_partida')]);
        }

        return view('partida.registrar')->with('message', $jsonResponse['message']);
    }

    public function eliminar($id)
    {
        $response = Http::delete(env('URL_BACK_API').'nvitaciones/'.$id);
        Log::info($response);
        
    }


}
