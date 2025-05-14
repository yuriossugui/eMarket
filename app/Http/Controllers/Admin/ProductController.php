<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $products = Product::with('category')->get();

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

            $product->name = strtoupper($validated['name']);
            $product->description = strtoupper($validated['description']);
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
                    'category_name' => 'required|min:2|max:50',
                ],
                [
                    'category_name.required' => 'O campo nome é obrigatório.',
                    'category_name.min' => 'O nome deve ter pelo menos 2 caracteres.',
                    'category_name.max' => 'O nome não pode ter mais de 50 caracteres.',
                ]
            );

            $categoryModel = new Category();

            $categoryModel->name = $validated['category_name'];

            $categoryModel->slug = Str::slug($validated['category_name']);

            $categoryModel->save();
            
            return redirect('/admin/product-index')->with('msgSuccess','Categoria cadastrada com sucesso');

        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage())->withInput();
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }

    }

    public function show(Request $request)
    {
        try{
            $categories = Category::all();

            $product = Product::with('category')->findOrFail($request->id);

            return view('Admin.product-show',['product'=>$product, 'categories'=>$categories]); 
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit(Request $request)
    {
    try {
        $product = Product::findOrFail($request->id);

        // Atualiza os dados exceto a imagem inicialmente
        $data = $request->except('image');

        // Se o usuário enviou uma nova imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Define um nome único para a imagem
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/productImages'), $imageName);

            // Adiciona a nova imagem ao array de dados
            $data['image'] = $imageName;
        }

        // Atualiza os dados no banco de dados
        $product->update($data);

        return redirect('/admin/product-index')->with('msgSuccess', 'Produto editado com sucesso!');
    } catch (Exception $e) {
        return redirect()->back()->withErrors($e->getMessage());
    }
    }


    public function delete(Request $request)
    {
        try{

            Product::findOrFail($request->id)->delete();
            return redirect('/admin/product-index')->with('msgSuccess','Produto deletado com sucesso !');
            
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
