@extends('voyager::master')

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <div class="container text-center">
            <h1 class="mb-2">Quick navigation</h1>
            @if(auth()->user()->role_id != 3)<a href="/{{ config('app.admin_route') }}/users" class="btn btn-primary">Users</a>@endif
            <a href="/{{ config('app.admin_route') }}/recipe-maker" class="btn btn-primary">Recipe Maker</a>
        </div>
    </div>
@stop
