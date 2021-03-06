@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="{{ route('todo') }}">Your Todo List</a>
                        <span class="mx-3"></span>
                        <a href="{{ route('upload') }}">Upload</a>
                        @can('notification-admin')
                            <span class="mx-3"></span>
                            <a href="{{ route('notification.index') }}">Notifications</a>
                        @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
