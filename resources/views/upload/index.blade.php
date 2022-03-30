@extends('layouts.master')
@section('title','upload file')

@section('content')
    <div class="row mt-lg-5 mx-0">
        <div class="col-md-3 offset-md-4">
            @if(session('uploaded'))
                <div class="alert alert-success text-center">
                    {{ session('uploaded') }}
                </div>
            @endif
            @if ($errors->any())
                <ul class="alert alert-danger text-center" style="direction: rtl">
                    @foreach($errors->all() as $error)
                        <li style="list-style: none">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('uploading') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex">
                    <input type="file" name="file" class="form-control mx-2">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
