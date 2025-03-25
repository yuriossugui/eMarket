<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('Admin.product-index'); 
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name'=>'',
            'description'=>'',
            'price'=>'',
            'category_id'=>'',
            'image'=>''
        ]);
    }

    public function createCategory(Request $request)
    {
        try{

            $validated = $request->validate(
            [
                'name'=>'required|min:2|max:50',  
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'name.min' => 'O nome deve ter pelo menos 2 caracteres.',
                'name.max' => 'O nome não pode ter mais de 50 caracteres.',
            ]
            );
    
            $categoryModel = new Category();
    
            $categoryModel->name = $validated['name'];
    
            $categoryModel->save();
            
            return redirect('/admin/product-index')->with('msgSuccess','Categoria cadastrada com sucesso');

        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

    }

}
