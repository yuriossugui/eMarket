<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockEntry;
use App\Models\StockOutput;
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

            $product->name = mb_strtoupper($validated['name'], 'UTF-8');
            $product->description = mb_strtoupper($validated['description'], 'UTF-8');
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
                    'category_name' => 'required|min:2|max:50|unique:categories,name',
                ],
                [
                    'category_name.required' => 'O campo nome é obrigatório.',
                    'category_name.min' => 'O nome deve ter pelo menos 2 caracteres.',
                    'category_name.max' => 'O nome não pode ter mais de 50 caracteres.',
                    'category_name.unique' => 'Este nome de categoria já está em uso.',
                ]
            );

            $categoryModel = new Category();

            $categoryModel->name = mb_strtoupper($validated['category_name'], 'UTF-8');

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

    // public function inbound(Request $request)
    // {
    //     $products = Product::all();

    //     $entries = StockEntry::with(['product','user'])->get();

    //     return view('Admin.movement-inbound',['products'=>$products,'entries'=>$entries]);
    // }

    public function inbound(Request $request)
    {
        $products = Product::all();
        
        $entries = StockEntry::with(['product', 'user'])->get();
        
        // Filtra apenas os registros onde 'product' e 'user' não são null
        $entries = $entries->filter(function ($entry) {
            return $entry->product !== null && $entry->user !== null;
        });
    
        return view('Admin.movement-inbound', [
            'products' => $products,
            'entries' => $entries
        ]);
    }


    public function entry(Request $request)
    {

        $validated = $request->validate(
            [
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ],
            [
                'product_id.required' => 'O produto é obrigatório !',
                'product_id.integer' => 'Produto inválido',
                'product_id.min' => 'Insira uma quantidade válida',
                'quantity.required' => 'A quantidade é obrigatória !',
                'quantity.integer' => 'Quantidade inválida'
            ]
        );
    
        // Corrigido o nome do método: findOrFail
        $product = Product::findOrFail($request->product_id);
    
        // Soma a quantidade recebida ao estoque atual
        $product->stock += $request->quantity;

        // Salva a atualização
        $product->save();

        $userId = auth()->user()->id;

        StockEntry::create([
            'product_id' => $product->id,
            'user_id' => $userId,
            'quantity' => $request->quantity,
        ]);
    
        return redirect('/admin/inbound')->with('msgSuccess','Quantidade inserida com sucesso !');
    }

    public function outbound(Request $request)
    {
        $products = Product::all();

        $stock_outputs = StockOutput::with(['product','user'])->get();

        return view('Admin.movement-outbound',['products'=>$products,'outputs'=>$stock_outputs]);
    }

    public function output(Request $request)
    {
        $validated = $request->validate(
            [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1|max:' . Product::findOrFail($request->product_id)->stock
            ],
            [
            'product_id.required' => 'O produto é obrigatório !',
            'product_id.integer' => 'Produto inválido',
            'product_id.exists' => 'O produto selecionado não existe.',
            'quantity.required' => 'A quantidade é obrigatória !',
            'quantity.integer' => 'Quantidade inválida',
            'quantity.max' => 'A quantidade não pode ser superior ao estoque disponível.'
            ]
        );

        $product = Product::findOrFail($request->product_id);
    
        // Soma a quantidade recebida ao estoque atual
        $product->stock -= $validated['quantity'];

        // Salva a atualização
        $product->save();

        $userId = auth()->user()->id;
        
        StockOutput::create([
            'product_id' => $product->id,
            'user_id' => $userId,
            'quantity' => $request->quantity,
        ]);

        return redirect('/admin/outbound')->with('msgSuccess','Quantidade subtraída com sucesso !');

    }

    public function storage(Request $request)
    {
        $products = Product::with('category')->get();

        return view('Admin.storage',['products'=>$products]);
    }

}
