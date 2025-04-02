<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Log;
use Exception;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('Admin.client-index', compact('clientes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('Admin.client-create', compact('clientes'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            Cliente::create($request->all());
            return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
        }catch (Exception $e){
            Log::error('Erro ao criar cliente: '.$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('clientes.index')->with('failure', 'Erro ao criar o cliente!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clientes = Cliente::findOrFail($id);
        return view('Admin.client-show', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clientes = Cliente::findOrFail($id);
        return view("Admin.client-edit", compact('clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $clientes = Cliente::findOrFail($id);
            $clientes->update($request->all());
            return redirect()->route('clientes.index')
                ->with('sucesso', 'Cliente alterado com sucesso!');
        } catch (Exception $e){
            Log::error("Erro ao atualizar o cliente: ". $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'cliente_id' => $id,
                'request' => $request->all()
            ]);
            return redirect()->route('clientes.index')
                ->with('erro', 'Erro ao atualizar o cliente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return redirect()->route('clientes.index')
                ->with('sucesso', 'Cliente excluído com sucesso!');
        } catch (Exception $e){
            Log::error("Erro ao excluir o cliente: ". $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'produto_id' => $id
            ]);
            return redirect()->route('clientes.index')
                ->with('erro', 'Erro ao excluir o cliente!');
        }
    }
}
