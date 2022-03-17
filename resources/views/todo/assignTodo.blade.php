@extends('layouts.master')

@section('style')
    <style>
        #task{
            border: 1px inset gray;
        }
    </style>
@endsection
@section('content')
        <div class="row mt-lg-5 mx-0">
            <div class="col-md-3 offset-md-4">
                <h3  dir="rtl">تخصیص کار "{{ $todo->name }}" به:</h3>
                <form action="{{ route('todos.update',$todo->id) }}" method="post">
                    @csrf
                    @method('put')
                    <select name="usersList[]" class="form-select" multiple>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" id="{{ $user->id }}"
                                @foreach ($user->tasks as $task)
                                    @if($todo->id == $task->id) selected @endif
                                @endforeach
                            >{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success mt-3">Confirm</button>
                </form>
            </div>
        </div>
@endsection
