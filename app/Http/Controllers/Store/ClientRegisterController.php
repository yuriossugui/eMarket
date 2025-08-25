<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('Store.client-register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'cpf_numbers' => 'required|string|unique:clients,cpf_numbers',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Client::create($validated);

        return redirect()->route('client.login')->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }
}
