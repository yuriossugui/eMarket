<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::paginate(10);
        return view('Admin.client-index',['clients'=>$clients]); 
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|min:3|max:255',
            'email'        => 'required|email',
            'password'     => 'required',
            'phone_number' => 'required|min:11|max:25'
        ], [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O email deve ser um endereço de email válido',
            'password.required' => 'O campo senha é obrigatório',
            'phone_number.required' => 'O campo número de telefone é obrigatório',
            'phone_number.min' => 'O número de telefone deve ter pelo menos 11 caracteres.',
            'phone_number.max' => 'O número de telefone não pode ter mais de 25 caracteres.'
        ]);

        $client = new Client();

        $client->name = strtoupper($validated['name']);

        $client->email = $validated['email'];

        $client->password = bcrypt($validated['password']);
    
        $client->phone_number = $validated['phone_number'];

        $client->save();

        return redirect('admin/client-index')->with('msgSuccess','Cliente cadastrado com sucesso !');
    }

    public function show(Request $request)
    {
        $client = Client::findOrFail($request->id);
        return view('Admin.client-show',['client'=>$client]); 
    }

}
