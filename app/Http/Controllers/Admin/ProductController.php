<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('Admin.product-index',['categories'=>$categories]); 
    }

    public function create(Request $request)
    {
        try{

            $validated = $request->validate(
                [
                    'name'=>'required|min:3|max:50',
                    'description'=>'required|min:2|max:255',
                    'price'=>'required|numeric|min:1',
                    'category_id'=>'required',
                    'image'=>'required'
                ],
                [
                    'name.required' => 'O campo nome é obrigatório.',
                    'name.min' => 'O nome deve ter pelo menos 2 caracteres.',
                    'name.max' => 'O nome não pode ter mais de 50 caracteres.',
    
                    'description.required' => 'O campo descrição é obrigatório.',
                    'description.min' => 'O campo descrição deve ter pelo menos 2 caracteres.',
                    'description.max' => 'O campo descrição não pode ter mais de 255 caracteres.',
    
                    'price.required' => 'O campo preço é obrigatório.',
                    'price.numeric' => 'O preço deve ser um número.',
                    'price.min' => 'O preço nao pode ser menor que 1.',
    
                    'category_id.required' => 'O campo categoria é obrigatório.',
    
                ]
            );

            $product = new Product();

            $product->name = $validated['name'];
            $product->description = $validated['description'];
            $product->price = $validated['price'];
            $product->category_id = $validated['category_id'];
            
            if($request->hasFile('image') && $request->file('image')->isValid())
            {
                $requestImg = $request->image;

                $extension = $requestImg->extension();
                
                $imageName = md5($requestImg->getClientOriginalName().strtotime("now")) . '.' . $extension;

                $requestImg->move(public_path('img/productImages'), $imageName);
    
                $product->image = $imageName; 
            }

            

        }catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

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
