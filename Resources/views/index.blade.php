@extends('layouts.admin')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('plaka.name') !!}
    </p>
@stop
