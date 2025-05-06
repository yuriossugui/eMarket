<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(20);

        return view('admin.category-index', ['categories'=>$categories]);
    }

    public function show(Request $request)
    {   
        try{

            $category = Category::findOrFail($request->id);

            return view('admin.category-show', ['category'=>$category]);    

        }catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->withErrors($e->errors())->withInput();
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }
    }

    public function update(Request $request)
    {   
        try{

            $request->validate([
                'name' => 'required|min:3|max:255',
                'slug' => 'required|min:3|max:255|unique'
            ]);

            $category = Category::findOrFail($request->id);

            $category->update($request->all());

            return redirect('admin/category-index')->with('msgSuccess', 'Categoria atualizada com sucesso!');

        }catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->withErrors($e->errors())->withInput();
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }
        catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
            Log::error('Erro: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        }
    }

    public function delete(Request $request)
    {
        Category::findOrFail($request->id)->delete();
        return redirect('admin/category-index')->with('msgSuccess', 'Categoria excluida com sucesso!');
    }
}
