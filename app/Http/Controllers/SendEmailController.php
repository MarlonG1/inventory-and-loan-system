<?php

namespace App\Http\Controllers;

use App\Mail\InformationMail;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function send($prestamoId){
        try {
            $emailData = Prestamo::with ('equipos', 'aula', 'user')->findOrFail($prestamoId);
            Mail::to($emailData->user->email)->send(new InformationMail($emailData));
            return response()->json(['icon' => 'success', 'title' => 'Exito!', 'text' => 'Prestamo registrado correctamente, se envio un correo electronico a tu cuenta con los detalles']);
        } catch (\Exception $e){
            return response()->json(['icon' => 'error', 'title' => 'Error', 'text' => 'Algo malo ocurrio, no pudimos enviarte un correo con los detalles a tu cuenta.']);
        }
    }
}
