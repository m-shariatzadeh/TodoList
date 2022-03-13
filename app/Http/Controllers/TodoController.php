<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::with('user')->where('user_id',\auth()->id())->get();

        $response = response()->json(['todos' => $todos],200);
        return $response;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->name = $request->task;
        $todo->user_id = Auth::id();
        $todo->save();

        $response = response()->json(['todo' => $todo],200);
        return $response;
    }

    public function show(Todo $todo)
    {
        //
    }

    public function edit(Todo $todo)
    {
        //
    }

    public function update(Request $request, Todo $todo)
    {
        //
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        $response = response()->json(['todo' => $todo],200);
        return $response;
    }
}
