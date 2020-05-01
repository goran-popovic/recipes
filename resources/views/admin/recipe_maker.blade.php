@extends('voyager::master')

@section('page_title', 'Recipe maker')

@section('css')
@endsection

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-params"></i>
            Recipe Maker
        </h1>
    </div>
@stop

@section('content')
    <div id="recipes-admin" class="page-content browse container-fluid">
        <test></test>
{{--        @include('voyager::alerts')--}}

{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-11 col-md-offset-1">--}}
{{--                    <div class="fpd-clearfix py-3 py-sm-5">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 border-right">--}}
{{--                                <h5 class="mb-2">Save new template</h5>--}}
{{--                                <p>1. Select an industry</p>--}}
{{--                                <select id="industry" class="mb-2 selectpicker">--}}
{{--                                    @foreach($industries as $industry)--}}
{{--                                        <option value="{{ $industry->id }}">{{ $industry->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <p class="mb-1">2. Save the template to database</p>--}}
{{--                                <button id="save-db" class="btn btn-primary">Save to DB</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@stop

@section('javascript')
    <script src="{{ asset('/js/admin/app.js') }}"></script>
@endsection
