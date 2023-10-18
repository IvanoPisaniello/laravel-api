<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //usiamo la stessa terminologia delle crud per comodità
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $newContact = new Contact();

        $newContact->name = $data["name"];
        $newContact->email = $data["email"];
        $newContact->message = $data["message"];

        $newContact->save();

        return response()->json([
            'message' => 'Grazie per averci contattato, la risponderò il prima possibile!'
        ], 201);
    }
}
