<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Psy\Util\Json;

class TodoController extends Controller
{

    public function index()
    {
        $user = User::with('tasks')->where('id',\auth()->id())->first();
        $response = response()->json(['todos' => $user->tasks],200);
        return $response;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
//        dd($users);
        $todo = new Todo();
        $todo->name = $request->task;
        $todo->save();
        $todo->users()->sync([Auth::id()]);
        $response = response()->json(['todo' => $todo],200);
        return $response;
    }

//    public function assignTodo($users)
//    {
//        dd($users);
//    }

    public function show(Todo $todo)
    {
        //
    }

    public function edit($id)
    {
        if (Gate::allows('task-assign',\auth()->user())) {
            $users = User::with('tasks')->where('id','!=',auth()->id())->get();
            $todo = Todo::findOrFail($id);
            return view('todo.assignTodo',compact(['todo','users']));
        }else {
            return abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('task-assign',\auth()->user())) {
            $todo = Todo::findOrFail($id);
            $users = $request->usersList;
            array_push($users,\auth()->id());
            $todo->users()->sync($users);

            Session::flash('success','با موفقیت تخصیص داده شد');
            return to_route('todo');
        }else {
            return abort(403);
        }
    }

    public function destroy($id)
    {
//        if (Gate::allows('task-assign',\auth()->user())) {
            $todo = Todo::with('users')->findOrFail($id);
            $todo->users()->detach();
            $todo->delete();

            $response = response()->json(['todo' => $todo], 200);
            return $response;
//        }else {
//            return abort(403);
//        }
    }
}
