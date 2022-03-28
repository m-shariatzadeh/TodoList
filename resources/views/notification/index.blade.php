@extends('layouts.master')
@section('title','Notifications')

@section('content')
    <div class="row mt-lg-5 mx-0">
        <div class="col-md-3 offset-md-4">
            <form action="{{ route('notification.store') }}" method="post">
                @csrf
                <div>
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject">
                </div>
                <div class="my-3">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection
