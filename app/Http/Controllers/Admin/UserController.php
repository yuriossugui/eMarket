<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return view('Admin.user-index',['users'=>$users]);
    }

    public function show(Request $request){
        $user = User::findOrFail($request->id);

        return view('Admin.user-show',['user'=>$user]);
    }

    public function update(Request $request){
        $user = User::findOrFail($request->id);

        $user->update($request->all());

        return redirect('admin/user-index')->with('msgSuccess', 'Usuário atualizado com sucesso!');
    }

    public function delete(Request $request){
        $user = User::findOrFail($request->id);

        $user->delete();

        return redirect('admin/user-index')->with('msgSuccess', 'Usuário excluído com sucesso!');
    }
}
