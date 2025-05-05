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
            'email'        => 'required|email|unique:clients,email',
            'cpf_numbers'  => 'required|digits:11|unique:clients,cpf_numbers',
            'phone_number' => 'required|min:11|max:25',
            'password'     => 'required|min:6',
            'address'      => 'required|min:5|max:255',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
    
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
    
            'cpf_numbers.required' => 'O campo CPF é obrigatório.',
            'cpf_numbers.digits' => 'O CPF deve conter exatamente 11 dígitos.',
            'cpf_numbers.unique' => 'Este CPF já está cadastrado.',
    
            'phone_number.required' => 'O campo número de telefone é obrigatório.',
            'phone_number.min' => 'O telefone deve ter pelo menos 11 caracteres.',
            'phone_number.max' => 'O telefone não pode ter mais de 25 caracteres.',
    
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
    
            'address.required' => 'O campo endereço é obrigatório.',
            'address.min' => 'O endereço deve ter pelo menos 5 caracteres.',
            'address.max' => 'O endereço não pode ter mais de 255 caracteres.',
        ]);
    
        $client = new Client();
    
        $client->name         = strtoupper($validated['name']);
        $client->email        = $validated['email'];
        $client->cpf_numbers  = $validated['cpf_numbers'];
        $client->phone_number = $validated['phone_number'];
        $client->address      = strtoupper($validated['address']);
        $client->password     = bcrypt($validated['password']);
    
        $client->save();
    
        return redirect('admin/client-index')->with('msgSuccess', 'Cliente cadastrado com sucesso!');
    }
    

    public function show(Request $request)
    {
        $client = Client::findOrFail($request->id);
        return view('Admin.client-show',['client'=>$client]); 
    }

    public function update(Request $request, $id) // Use 'update' para a ação de atualizar
    {
        // 1. Validação dos dados recebidos, ignorando o email e CPF do cliente atual
        $request->validate([
            'name'          => 'required|min:3|max:255',
            'email'         => 'required|email|unique:clients,email,' . $id, // Ignora o email do cliente com este ID
            'cpf_numbers'   => 'required|digits:11|unique:clients,cpf_numbers,' . $id, // Ignora o CPF do cliente com este ID
            'phone_number'  => 'required|min:11|max:25',
            'address'       => 'required|min:5|max:255',
        ]);

        // 2. Encontra o cliente que você quer atualizar usando o ID
        $client = Client::findOrFail($id);

        // 3. Atualiza os atributos do cliente com os dados recebidos do formulário
        $client->update($request->all()); // Passa todos os dados validados para o método update do Model

        // 4. Redireciona o usuário para a página de listagem de clientes com uma mensagem de sucesso
        return redirect('admin/client-index')->with('msgSuccess', 'Cliente atualizado com sucesso!');
    }

    public function delete(Request $request)
    {
        Client::findOrFail($request->id)->delete();
        return redirect('admin/client-index')->with('msgSuccess', 'Cliente excluido com sucesso!');
    }

}
