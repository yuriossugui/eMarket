<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $products = Product::with('category')->paginate(5);

        return view('Admin.product-index',['categories'=>$categories, 'products'=>$products]); 
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

            $product->save();

            return redirect('/admin/product-index')->with('msgSuccess','Produto cadastrados com sucesso !');

        }catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->withErrors($e->errors())->withInput();
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }

    }

    public function createCategory(Request $request)
    {
        try{

            $validated = $request->validate(
            [
                'category_name'=>'required|min:2|max:50',  
            ],
            [
                'category_name.required' => 'O campo nome é obrigatório.',
                'category_name.min' => 'O nome deve ter pelo menos 2 caracteres.',
                'category_name.max' => 'O nome não pode ter mais de 50 caracteres.',
            ]
            );
    
            $categoryModel = new Category();
    
            $categoryModel->category_name = $validated['category_name'];
    
            $categoryModel->save();
            
            return redirect('/admin/product-index')->with('msgSuccess','Categoria cadastrada com sucesso');

        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }catch(Exception $e){
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }

    }

    public function show(Request $request)
    {
        // try{
        //     $product = 
        // }catch(Exception $e){
        //     return redirect()->back()->withErrors($e->getMessage());
        // }
    }

}
