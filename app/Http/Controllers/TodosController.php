<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|min:3',
            'publication' => 'required|min:3'
        ]);
    
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->publication = $request->publication;
        $todo->category_id = $request->category_id;
        $todo->description_id = $request->description_id;
        $todo->save();
    
        return redirect()->route('todos')->with('success', 'Todo created successfully');
    }

    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'Todo deleted successfully');
    }

    public function show($id){
        $todo = Todo::find($id);
        $categories = Category::all();
        return view('todos.show', ['todo' => $todo, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {

        // Valida los datos del formulario
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'description_id' => 'required',
            'publication' => 'required',
        ]);

        // Encuentra el registro que deseas actualizar
        $todo = Todo::find($id);

        // Actualiza los campos del modelo
        $todo->title = $validatedData['title'];
        $todo->category_id = $validatedData['category_id'];
        $todo->description_id = $validatedData['description_id'];
        $todo->publication = $validatedData['publication'];

        // Guarda los cambios
        $todo->save();

        // Redirecciona con un mensaje de éxito
        return redirect()->route('todos')->with('success', 'Listado actualizada con éxito.');
    }
}
